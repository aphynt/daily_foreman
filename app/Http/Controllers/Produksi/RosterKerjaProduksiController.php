<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Exports\RosterKerjaExport;
use App\Imports\RosterKerjaImport;
use App\Models\RosterKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RosterKerjaProduksiController extends Controller
{
    //
    public function index(Request $request)
    {

        session(['requestRosterKerjaProduksi' => $request->all()]);

        if (empty($request->tahun) || empty($request->bulan)){
            $bulan = now()->month; // Mendapatkan bulan sekarang
            $tahun = now()->year;

        }else{
            $bulan = $request->bulan;
            $tahun = $request->tahun;
        }


        $roster = DB::table('prd_ref_roster_kerja as rs')
        ->leftJoin('users as us', 'rs.nik', '=', 'us.nik')
        ->select('rs.*', 'us.name as nama', 'us.position as jabatan')
        ->where('rs.statusenabled', true)
        ->whereRaw('CAST(rs.bulan AS INT) = ?', [$bulan])
        ->whereRaw('CAST(rs.tahun AS INT) = ?', [$tahun])
        ->orderBy('us.id')
        ->get();

        // dd($roster);

        return view('produksi.roster-kerja.index', compact('roster', 'bulan', 'tahun'));
    }

    public function import(Request $request)
    {
        // Validasi file yang di-upload
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Maksimum 10MB
                'tahun' => 'required|numeric',
                'bulan' => 'required|numeric',
            ]);

            $tahun = $request->input('tahun');
            $bulan = $request->input('bulan');

            $file = $request->file('file');
            Excel::import(new RosterKerjaImport($tahun, $bulan), $file);

            return redirect()->back()->with('success', 'Berhasil import excel');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('import excel gagal..\n' . $th->getMessage()));
        }
    }

    public function export(Request $request)
    {
        $tahun = $request->input('tahun', now()->year);
        $bulan = $request->input('bulan', now()->month);

        // Bisa juga simpan ke session jika perlu
        session(['requestRosterKerjaProduksi' => ['tahun' => $tahun, 'bulan' => $bulan]]);


        return Excel::download(new RosterKerjaExport($tahun, $bulan), 'Roster Kerja-'.$bulan.'-'.$tahun.'.xlsx');
    }

    public function templateExcel(Request $request)
    {
        $tahun = $request->input('tahun', now()->year);
        $bulan = $request->input('bulan', now()->month);

        // Bisa juga simpan ke session jika perlu
        session(['requestRosterKerjaProduksi' => ['tahun' => $tahun, 'bulan' => $bulan]]);


        // dd($bulan);


        return Excel::download(new RosterKerjaExport($tahun, $bulan), 'Roster Kerja-'.$bulan.'-'.$tahun.'.xlsx');
    }
}
