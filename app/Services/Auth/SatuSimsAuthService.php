<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

class SatuSimsAuthService
{
    public function verify(string $nik, string $plainPassword): bool
    {
        return match (strtolower((string) config('password_recovery.satu_sims.mode', 'database'))) {
            'database' => $this->verifyViaDatabase($nik, $plainPassword),
            'api' => $this->verifyViaApi($nik, $plainPassword),
            default => throw new RuntimeException('SATU_SIMS_AUTH_MODE harus database atau api.'),
        };
    }

    private function verifyViaDatabase(string $nik, string $plainPassword): bool
    {
        $cfg = config('password_recovery.satu_sims.database');

        try {
            $query = DB::connection($cfg['connection'])
                ->table($cfg['table'])
                ->where($cfg['nik_column'], trim($nik));

            if (!empty($cfg['enabled_column'])) {
                $query->where(
                    $cfg['enabled_column'],
                    $cfg['enabled_value']
                );
            }

            $storedPassword = $query->value($cfg['password_column']);

            if ($storedPassword === null || trim((string) $storedPassword) === '') {
                return false;
            }

            return $this->passwordMatches(
                $plainPassword,
                (string) $storedPassword,
                (string) ($cfg['password_scheme'] ?? 'auto')
            );
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

    private function passwordMatches(
        string $plainPassword,
        string $storedPassword,
        string $scheme
    ): bool {
        $scheme = strtolower(trim($scheme));

        return match ($scheme) {
            'laravel', 'bcrypt', 'argon', 'argon2', 'hash' =>
                $this->checkLaravelHash($plainPassword, $storedPassword),

            'plain', 'plaintext' =>
                hash_equals($storedPassword, $plainPassword),

            'md5' =>
                hash_equals(
                    strtolower($storedPassword),
                    md5($plainPassword)
                ),

            'sha1' =>
                hash_equals(
                    strtolower($storedPassword),
                    sha1($plainPassword)
                ),

            'auto' =>
                $this->autoCheckPassword($plainPassword, $storedPassword),

            default =>
                throw new RuntimeException(
                    'SATU_SIMS_PASSWORD_SCHEME tidak dikenali.'
                ),
        };
    }

    private function autoCheckPassword(
        string $plainPassword,
        string $storedPassword
    ): bool {
        $storedPassword = trim($storedPassword);

        // bcrypt: $2y$, $2a$, $2b$
        if (preg_match('/^\$2[ayb]\$/', $storedPassword) === 1) {
            return $this->checkLaravelHash(
                $plainPassword,
                $storedPassword
            );
        }

        if (
            str_starts_with($storedPassword, '$argon2i$') ||
            str_starts_with($storedPassword, '$argon2id$')
        ) {
            return $this->checkLaravelHash(
                $plainPassword,
                $storedPassword
            );
        }

        if (preg_match('/^[a-f0-9]{32}$/i', $storedPassword) === 1) {
            return hash_equals(
                strtolower($storedPassword),
                md5($plainPassword)
            );
        }

        if (preg_match('/^[a-f0-9]{40}$/i', $storedPassword) === 1) {
            return hash_equals(
                strtolower($storedPassword),
                sha1($plainPassword)
            );
        }

        return hash_equals(
            $storedPassword,
            $plainPassword
        );
    }

    private function checkLaravelHash(
        string $plainPassword,
        string $storedPassword
    ): bool {
        try {
            return Hash::check(
                $plainPassword,
                $storedPassword
            );
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

    private function verifyViaApi(string $nik, string $plainPassword): bool
    {
        $cfg = config('password_recovery.satu_sims.api');

        if (empty($cfg['endpoint'])) {
            throw new RuntimeException('SATU_SIMS_AUTH_ENDPOINT belum dikonfigurasi.');
        }

        try {
            $request = Http::acceptJson()
                ->asJson()
                ->timeout($cfg['timeout']);

            if (!empty($cfg['token'])) {
                $request = $request->withToken($cfg['token']);
            }

            $response = $request->post($cfg['endpoint'], [
                $cfg['nik_key'] => $nik,
                $cfg['password_key'] => $plainPassword,
            ]);

            if (!$response->successful()) {
                return false;
            }

            return data_get($response->json(), $cfg['success_key']) === true;
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }
}
