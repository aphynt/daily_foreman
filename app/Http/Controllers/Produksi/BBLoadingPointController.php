<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\BBLoadingPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;

class BBLoadingPointController extends Controller
{
    //
    public function index(Request $request)
    {

        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }

        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');

        $loading = DB::table('prd_coal_foreman_loading_point as lp')
        ->leftJoin('prd_coal_foreman_daily_report as dr', 'lp.daily_report_id', '=', 'dr.id')
        ->leftJoin('ref_shift as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('prd_ref_subcont as sc', 'lp.subcont', '=', 'sc.id')
        ->leftJoin('ref_region as ar', 'lp.pit', '=', 'ar.id')
        ->leftJoin('prd_ref_subcont_foreman as pg', 'lp.subcont', '=', 'pg.id')
        ->leftJoin('prd_ref_subcont_unit as su', 'lp.fleet_ex', '=', 'su.id')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->select(
            'lp.daily_report_id as id',
            'lp.uuid',
            DB::raw('CONVERT(varchar, dr.tanggal_dasar, 23) as tanggal_pelaporan'),
            'sh.keterangan as shift',
            'sc.keterangan as subcont',
            'ar.keterangan as pit',
            'pg.keterangan as pengawas',
            'lp.fleet_ex',
            'dr.nik_foreman as nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dr.nik_supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent as nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',
            'lp.jumlah_dt',
            'lp.seam_bb',
            'lp.jarak',
            'lp.keterangan',
            'lp.is_draft'
        )
        ->where('lp.statusenabled', true)
        ->where('dr.statusenabled', true)
        ->whereBetween(DB::raw("CONVERT(varchar, dr.tanggal_dasar, 23)"), [$startTimeFormatted, $endTimeFormatted]);

        // if (Auth::user()->role !== 'ADMIN') {
        //     $loading->where('dr.foreman_id', Auth::user()->id);
        // }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $roleBypass = getConfigArrayById(2);

        if (! $user->hasRoleId($roleBypass)) {
            $loading->where('dr.foreman_id', $user->id);
        }

        $loading = $loading->get();

        // dd($loading);

        return view('batubara.loading-point.index', compact('loading'));
    }

    public function destroy($id)
    {
        try {
            BBLoadingPoint::findOrFail($id)->delete();
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
