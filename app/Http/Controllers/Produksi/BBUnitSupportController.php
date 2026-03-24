<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\BBUnitSupport;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BBUnitSupportController extends Controller
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

        $support = DB::table('prd_coal_foreman_unit_support as us')
        ->leftJoin('prd_coal_foreman_daily_report as dr', 'us.daily_report_id', '=', 'dr.id')
        ->leftJoin('prd_ref_subcont as sc', 'us.subcont', '=', 'sc.id')
        ->leftJoin('prd_ref_subcont_jenis_support as js', 'us.jenis', '=', 'js.id')
        ->leftJoin('ref_region as ar',
                DB::raw('TRY_CAST(us.area AS BIGINT)'),
                '=',
                'ar.id'
            )
        ->leftJoin('ref_shift as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->select(
            'us.daily_report_id as id',
            'us.uuid',
            DB::raw('CONVERT(varchar, dr.tanggal_dasar, 23) as tanggal_pelaporan'),
            'sh.keterangan as shift',
            'js.keterangan as jenis',
            'sc.keterangan as subcont',
            'us.nomor_unit',
            'ar.keterangan as area',
            'dr.nik_foreman as nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dr.nik_supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent as nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',
            'us.keterangan',
            'us.is_draft'
        )
        ->where('us.statusenabled', true)
        ->where('dr.statusenabled', true)
        ->whereBetween(DB::raw("CONVERT(varchar, dr.tanggal_dasar, 23)"), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role !== 'ADMIN') {
            $support->where('dr.foreman_id', Auth::user()->id);
        }

        // /** @var \App\Models\User $user */
        // $user = Auth::user();
        // $roleBypass = getConfigArrayById(2);

        // if (! $user->hasRoleId($roleBypass)) {
        //     $support->where('dr.foreman_id', $user->id);
        // }

        $support = $support->get();
        // dd($support);

        return view('batubara.unit-support.index', compact('support'));
    }

    public function destroy($id)
    {
        try {
            BBUnitSupport::findOrFail($id)->delete();
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
