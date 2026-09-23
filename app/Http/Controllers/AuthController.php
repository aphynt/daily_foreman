<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Auth\EmployeeIdentityService;
use App\Services\Auth\SatuSimsAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthController extends Controller
{
    private const MANUAL_RESET_SESSION = 'password_recovery.manual_verified';

    public function login()
    {
        return view('auth.login');
    }

    public function privacyPolicy()
    {
        return view('auth.privacyPolicy');
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'nik' => $this->normalizeNik($request->nik),
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()
                ->back()
                ->withInput($request->only('nik'))
                ->with('info', 'NIK atau password salah');
        }

        $request->session()->regenerate();

        if (Auth::user()->statusenabled != true) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->back()
                ->with('info', 'Akun Anda tidak diaktifkan.');
        }

        return $this->redirectAfterLogin();
    }

    private function redirectAfterLogin()
    {
        $role = Auth::user()->role;

        if (in_array($role, ['TRAINING CENTER'], true)) {
            return redirect()
                ->route('production.index')
                ->with('alert', 'Selamat Datang');
        }

        if (!in_array($role, [
            'FOREMAN MEKANIK',
            'PJS FOREMAN MEKANIK',
            'JR FOREMAN MEKANIK',
        ], true)) {
            return redirect()
                ->route('dashboard.index')
                ->with('alert', 'Selamat Datang');
        }

        return redirect()
            ->route('p2h.index')
            ->with('alert', 'Selamat Datang');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda telah berhasil keluar');
    }

    public function logout_session(Request $request)
    {
        $request->validate([
            'session_id' => ['required', 'string'],
        ]);

        DB::table('sessions')
            ->where('id', $request->session_id)
            ->delete();

        return back();
    }

    public function forgotPassword()
    {
        return view('auth.password-recovery.index');
    }

    public function resetFromSatuSims(Request $request, SatuSimsAuthService $satuSims)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:50'],
            'satu_sims_password' => ['required', 'string', 'max:255'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'satu_sims_password.required' => 'Password SATU SIMS wajib diisi.',
        ]);

        $nik = $this->normalizeNik($validated['nik']);
        $rateKey = $this->rateKey('satu-sims', $nik, $request->ip());

        $this->guardRateLimit($rateKey);

        $user = $this->findEligibleLocalUser($nik);
        $verified = $user
            ? $satuSims->verify($nik, $validated['satu_sims_password'])
            : false;

        if (!$user || !$verified) {
            RateLimiter::hit(
                $rateKey,
                (int) config('password_recovery.decay_seconds', 300)
            );

            $this->writeResetAudit($nik, 'satu_sims', false, $request);

            throw ValidationException::withMessages([
                'satu_sims' => 'NIK atau password SATU SIMS tidak cocok.',
            ]);
        }

        RateLimiter::clear($rateKey);

        DB::transaction(function () use ($user, $validated) {
            $user->password = Hash::make($validated['satu_sims_password']);
            $user->save();

            $this->revokeUserSessions($user);
        });

        $this->writeResetAudit($nik, 'satu_sims', true, $request);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Password berhasil disamakan dengan SATU SIMS. Silakan login kembali.'
            );
    }

    public function verifyManualReset(Request $request, EmployeeIdentityService $identity)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:50'],
            'no_ktp' => ['required', 'string', 'max:30'],
            'tanggal_lahir' => ['required', 'date_format:Y-m-d'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'no_ktp.required' => 'No. KTP wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date_format' => 'Format tanggal lahir tidak valid.',
        ]);

        $nik = $this->normalizeNik($validated['nik']);
        $rateKey = $this->rateKey('manual', $nik, $request->ip());

        $this->guardRateLimit($rateKey);

        $user = $this->findEligibleLocalUser($nik);
        $matched = $user
            ? $identity->matches(
                $nik,
                $validated['no_ktp'],
                $validated['tanggal_lahir']
            )
            : false;

        if (!$user || !$matched) {
            RateLimiter::hit(
                $rateKey,
                (int) config('password_recovery.decay_seconds', 300)
            );

            $this->writeResetAudit($nik, 'manual_verify', false, $request);

            return back()
                ->withInput(['nik' => $nik])
                ->withErrors([
                    'info' => 'NIK, No. KTP, atau tanggal lahir tidak cocok.',
                ]);
        }

        RateLimiter::clear($rateKey);
        $request->session()->regenerate();

        $request->session()->put(self::MANUAL_RESET_SESSION, [
            'user_id' => $user->getKey(),
            'nik' => $user->nik,
            'verified_at' => now()->timestamp,
            'nonce' => Str::random(40),
        ]);

        $this->writeResetAudit($nik, 'manual_verify', true, $request);

        return redirect()->route('password.recovery.manual.form');
    }

    public function manualResetForm(Request $request)
    {
        $state = $this->getValidManualResetState($request);

        if (!$state) {
            return redirect()
                ->route('password.recovery')
                ->withErrors([
                    'info' => 'Sesi verifikasi telah berakhir. Silakan verifikasi ulang.',
                ]);
        }

        return view('auth.password-recovery.reset', [
            'nik' => $state['nik'],
        ]);
    }

    public function updateManualPassword(Request $request)
    {
        $state = $this->getValidManualResetState($request);

        if (!$state) {
            return redirect()
                ->route('password.recovery')
                ->withErrors([
                    'info' => 'Sesi verifikasi telah berakhir. Silakan verifikasi ulang.',
                ]);
        }

        $validated = $request->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers(),
            ],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user = User::query()->find($state['user_id']);

        if (
            !$user ||
            $this->normalizeNik((string) $user->nik) !==
            $this->normalizeNik((string) $state['nik'])
        ) {
            $request->session()->forget(self::MANUAL_RESET_SESSION);

            return redirect()
                ->route('password.recovery')
                ->withErrors([
                    'info' => 'Verifikasi akun tidak valid. Silakan ulangi proses reset password.',
                ]);
        }

        if (!$this->userIsEnabled($user)) {
            $request->session()->forget(self::MANUAL_RESET_SESSION);

            return redirect()
                ->route('login')
                ->with('info', 'Akun Anda tidak diaktifkan.');
        }

        DB::transaction(function () use ($user, $validated) {
            $user->password = Hash::make($validated['password']);
            $user->save();

            $this->revokeUserSessions($user);
        });

        $this->writeResetAudit((string) $user->nik, 'manual_update', true, $request);

        $request->session()->forget(self::MANUAL_RESET_SESSION);
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Password berhasil diubah. Silakan login menggunakan password baru.'
            );
    }

    private function getValidManualResetState(Request $request): ?array
    {
        $state = $request->session()->get(self::MANUAL_RESET_SESSION);

        if (
            !is_array($state) ||
            empty($state['user_id']) ||
            empty($state['nik']) ||
            empty($state['verified_at']) ||
            empty($state['nonce'])
        ) {
            return null;
        }

        $ttl = (int) config('password_recovery.manual_ttl', 600);
        $age = now()->timestamp - (int) $state['verified_at'];

        if ($age > $ttl) {
            $request->session()->forget(self::MANUAL_RESET_SESSION);

            return null;
        }

        return $state;
    }

    private function findEligibleLocalUser(string $nik): ?User
    {
        $user = User::query()
            ->where('nik', $nik)
            ->first();

        if (!$user) {
            return null;
        }

        return $this->userIsEnabled($user) ? $user : null;
    }

    private function userIsEnabled(User $user): bool
    {
        if (!array_key_exists('statusenabled', $user->getAttributes())) {
            return true;
        }

        $value = strtolower(trim((string) $user->statusenabled));

        return in_array($value, ['1', 'true', 'yes', 'y'], true);
    }

    private function normalizeNik(string $nik): string
    {
        return Str::upper(trim($nik));
    }

    private function rateKey(string $method, string $nik, ?string $ip): string
    {
        return 'password-recovery:'
            . $method
            . ':'
            . hash('sha256', $nik . '|' . ($ip ?? 'unknown'));
    }

    private function guardRateLimit(string $key): void
    {
        $maxAttempts = (int) config('password_recovery.max_attempts', 5);

        if (!RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return;
        }

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'info' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
        ]);
    }

    private function revokeUserSessions(User $user): void
    {
        if (!config('password_recovery.revoke_database_sessions', true)) {
            return;
        }

        if (config('session.driver') !== 'database') {
            return;
        }

        try {
            DB::table(config('session.table', 'sessions'))
                ->where('user_id', $user->getAuthIdentifier())
                ->delete();
        } catch (Throwable $e) {
            report($e);
        }
    }

    private function writeResetAudit(
        string $nik,
        string $method,
        bool $success,
        Request $request
    ): void {
        try {
            DB::table('password_reset_audits')->insert([
                'nik' => $nik,
                'method' => $method,
                'success' => $success ? 1 : 0,
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit((string) $request->userAgent(), 500, ''),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Throwable $e) {
            report($e);
        }
    }
}
