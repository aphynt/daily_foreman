<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->search;

        $user = DB::table('users as us')
        ->leftJoin('ref_departemen as dep', 'us.departemen_id', 'dep.id')
        ->select(
            'us.id',
            'us.role_id',
            'us.name',
            'us.nik',
            'us.role',
            'us.departemen_id',
            'dep.keterangan as departemen',
            'us.position',
            'us.statusenabled'
        )
        ->whereNotIn('us.role', ['ADMIN', 'PUBLIC'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('us.name', 'like', '%' . $search . '%')
                    ->orWhere('us.nik', 'like', '%' . $search . '%')
                    ->orWhere('us.role', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('us.name', 'asc')
            ->paginate(15)
            ->withQueryString();

        $position = Role::all();
        $departemen = Departemen::all();

        return view('user.index', compact('user', 'position', 'departemen', 'search'));
    }

    public function resetPassword($id)
    {
        $user = User::where('id', $id)->first();
        try {
            User::where('id', $id)->update([
                'password'          => Hash::make('12345'),
                'updated_by'        => Auth::user()->id,
                'change_password'   => 0
            ]);

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'User',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Reset password user dengan nama: '. $user->name . ', NIK: '. $user->nik . ', Role: '. $user->role . ', direset oleh: '. Auth::user()->name,
            ]);

            return redirect()->back()->with('success', 'Reset password berhasil');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Reset password gagal...\n' . $th->getMessage()));
        }
    }

    public function changeRole(Request $request, $id)
    {
        // dd($request->all());
        $user = User::where('id', $id)->first();
        if (!$request->filled('position')) {
            return redirect()->back()->with('info', 'Silakan pilih posisi terlebih dahulu.');
        }
        try {
            [$roleId, $roleName] = explode('|', $request->position);

            User::where('id', $id)->update([
                'role_id'           => (int) $roleId,
                'role'              => $request->role,
                'departemen_id'     => $request->departemen_id,
                'position'          => $roleName,
                'updated_by'        => Auth::user()->id,
            ]);

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'User',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Ganti role user dengan nama: '. $user->name . ', NIK: '. $user->nik . ', Role: '. $user->role . ', diganti oleh: '. Auth::user()->name,
            ]);

            return redirect()->back()->with('success', 'Ganti role berhasil');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Ganti role gagal...\n' . $th->getMessage()));
        }
    }

    public function insert(Request $request)
    {
        $user = User::where('nik', strtoupper($request->nik))->first();

        if ($user) {
            return redirect()->back()->with('info', 'Maaf, NIK/User sudah ada');
        }


        try {
            [$roleId, $roleName] = explode('|', $request->role);
            User::create([
                'name' => $request->name,
                'uuid' => (string) Uuid::uuid4()->toString(),
                'nik' => strtoupper($request->nik),
                'role_id'       => (int) $roleId,
                'role'          => $roleName,
                'statusenabled' => true,
                'created_by' => Auth::user()->id,
                'password' => Hash::make('12345'),
            ]);

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'User',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Pendaftaran user dengan nama: '. $request->name . ', NIK: '. $request->nik . ', Role: '. $request->role . ', didaftarkan oleh: '. Auth::user()->name,
            ]);

            return redirect()->back()->with('success', 'User berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('User gagal ditambahn..\n' . $th->getMessage()));
        }
    }

    public function statusEnabled($id)
    {
        $user = User::where('id', $id)->first();

        try {

            if($user->statusenabled == true){

                User::where('id', $id)->update([
                    'statusenabled' => false,
                    'remember_token' => null,
                    'deleted_by' => Auth::user()->id,
                ]);

                Log::create([
                    'tanggal_loging' => now(),
                    'jenis_loging' => 'User',
                    'nama_user' => Auth::user()->id,
                    'nik' => Auth::user()->nik,
                    'keterangan' => 'Disabled user dengan nama: '. $user->name . ', NIK: '. $user->nik . ', dieksekusi oleh: '. Auth::user()->name,
                ]);

            }else{
                User::where('id', $id)->update([
                    'statusenabled' => true,
                    'updated_by' => Auth::user()->id,
                ]);

                Log::create([
                    'tanggal_loging' => now(),
                    'jenis_loging' => 'User',
                    'nama_user' => Auth::user()->id,
                    'nik' => Auth::user()->nik,
                    'keterangan' => 'Enabled user dengan nama: '. $user->name . ', NIK: '. $user->nik . ', dieksekusi oleh: '. Auth::user()->name,
                ]);
            }

            return redirect()->back()->with('success', 'Ubah status berhasil');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Ubah status gagal...\n' . $th->getMessage()));
        }
    }
}
