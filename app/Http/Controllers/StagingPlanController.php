<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaStagingPlan;
use App\Models\Shift;
use App\Models\StagingPlan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class StagingPlanController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeStagingPlan' => $request->all()]);

        $filterShift = $request->shift ?? 'Semua';
        $filterPit = $request->pit ?? 5;

        // 1. LOGIKA TANGGAL (Hanya Date, Tanpa Jam)
        if (empty($request->startStagingPlan) || empty($request->endStagingPlan)) {
            // Default: Tampilkan data HARI INI saja
            $today = new DateTime();
            $start = clone $today;
            $end   = clone $today;

            // Opsional: Jika kamu ingin defaultnya menampilkan range 2 hari (Hari ini & Besok):
            // $end = (clone $today)->modify('+1 day');
        } else {
            // Manual Filter dari User
            $start = new DateTime($request->startStagingPlan);
            $end   = new DateTime($request->endStagingPlan);
        }

        // PENTING: Gunakan format 'Y-m-d' saja (Tanpa H:i:s)
        // Agar pencarian murni berdasarkan tanggal kalender.
        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted   = $end->format('Y-m-d');

        $shift = Shift::where('statusenabled', true)->get();
        $pit = AreaStagingPlan::where('statusenabled', true)->orderByDesc('id')->get();

        $stagingQuery = DB::table('STAGING_PLAN as sp')
            ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
            ->leftJoin('REF_SHIFT as sh', 'sp.shift_id', '=', 'sh.id')
            ->leftJoin('REF_AREA_STAGING_PLAN as ar', 'sp.pit_id', '=', 'ar.id')
            ->select(
                'sp.id', 'sp.uuid', 'sp.statusenabled', 'sp.pic',
                'us.name as nama_pic', 'sh.keterangan as shift',
                'ar.keterangan as pit', 'sp.start_date', 'sp.end_date'
            )
            ->where('sp.statusenabled', true);

        // 2. PERBAIKAN QUERY FILTER
        // Kita filter berdasarkan 'start_date' saja.
        // Logika: "Tampilkan Plan yang dimulai pada tanggal X s/d Y"
        $stagingQuery->whereBetween('sp.start_date', [$startTimeFormatted, $endTimeFormatted]);

        /* CATATAN:
        Saya menghapus logika 'orWhereBetween(end_date)' karena itulah yang bikin data tanggal lain ikut muncul.
        Untuk laporan harian, biasanya kita cukup melihat kapan plan itu DIMULAI.
        */

        if ($filterShift != 'Semua') {
            $stagingQuery->where('sp.shift_id', $filterShift);
        }

        if ($filterPit != 5) {
            $stagingQuery->where('sp.pit_id', $filterPit);
        }

        $staging = $stagingQuery->get();

        return view('staging-plan.index', compact('shift', 'staging', 'pit'));
    }

    public function post(Request $request)
    {
        try {
            $startDate = Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d');
            $endDate   = Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');

            $documentPath = null;

            // =========================
            // UPLOAD PDF KE SFTP (10.10.2.6)
            // =========================
            if ($request->hasFile('document')) {
                $documentPath = Storage::disk('sftp_staging')->putFile(
                    'staging_plan',
                    $request->file('document')
                );

                // UBAH KE URL PENUH
                $documentUrl = 'http://10.10.2.6:93/storage/' . $documentPath;
            }

            DB::table('STAGING_PLAN')->insert([
                'pic'           => Auth::user()->id,
                'uuid'          => (string) Uuid::uuid4(),
                'statusenabled' => true,
                'start_date'    => $startDate,
                'end_date'      => $endDate,
                // 'shift_id'      => $request->shift_id,
                'pit_id'        => $request->pit_id,

                // SIMPAN PATH, BUKAN URL
                'document'      => $documentUrl,
            ]);

            return back()->with('success', 'Staging Plan berhasil ditambahkan');

        } catch (\Throwable $th) {
            return back()->with(
                'info',
                'Staging Plan gagal ditambahkan: ' . $th->getMessage()
            );
        }
    }

    public function delete($uuid)
    {
        try {
            StagingPlan::where('uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id
            ]);

            return redirect()->back()->with('success', 'Data berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Data gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $data = DB::table('STAGING_PLAN as sp')
            ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
            ->leftJoin('REF_SHIFT as sh', 'sp.shift_id', '=', 'sh.id')
            ->leftJoin('REF_AREA_STAGING_PLAN as ar', 'sp.pit_id', '=', 'ar.id')
            ->select(
                'sp.id',
                'sp.uuid',
                'sp.statusenabled',
                'sp.pic',
                'us.name as nama_pic',
                'sh.keterangan as shift',
                'ar.keterangan as pit',
                'sp.start_date',
                'sp.end_date'
            )
            ->where('sp.uuid', $uuid)
            ->where('sp.statusenabled', true)->first();

        if (!$data) {
            return redirect()->back()->with('info', 'Maaf, staging plan tidak ditemukan');
        }

        $pdfUrl = route('fileStagingPlan.show', $uuid);

        return view('staging-plan.preview', compact('data', 'pdfUrl'));
    }
}
