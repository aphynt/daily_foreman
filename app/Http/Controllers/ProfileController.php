<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {

        $poka =  DB::connection('kkh')->table('db_payroll.dbo.tbl_data_hr as hr')
        ->leftJoin('db_payroll.dbo.tm_departemen as dp', 'hr.Id_Departemen', '=', 'dp.ID_Departemen')
        // ->select('hr.Nik as NIK', 'hr.Nama as NAMA')
        ->where('hr.Nik', Auth::user()->nik)->first();

        $sessions = DB::table('sessions')
        ->where('user_id', Auth::user()->id)
        ->orderBy('last_activity', 'desc')
        ->get();

        return view('profile.index', compact('sessions', 'poka'));
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'password_lama' => ['required', 'min:4'],
                'password_baru' => ['required', 'min:4'],
            ],
            [
                'password_lama.min' => 'Password lama minimal 4 karakter',
                'password_baru.min' => 'Password baru minimal 4 karakter',
            ]);

            if(!Hash::check($request->password_lama, Auth::user()->password)){
                return back()->with("info", "Password lama salah");
            }

            User::whereId(Auth::user()->id)->update([
                'password' => Hash::make($request->password_baru),
                'updated_by' => Auth::user()->id,
                'change_password'   => 1

            ]);

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'User',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Ganti password user dengan nama: '. Auth::user()->name . ', NIK: '. Auth::user()->nik . ', Role: '. Auth::user()->role . ', diganti oleh: '. Auth::user()->name,
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('success', 'Password telah diubah, silakan login kembali');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Maaf, terjadi kesalahan\n', $th->getMessage());
        }
    }
}
