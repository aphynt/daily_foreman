<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\HazardReport;
use Illuminate\Http\Request;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use DateTime;

class HazardReportController extends Controller
{
    //
    public function index(Request $request)
    {

        session(['requestTimeHazardReport' => $request->all()]);

        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$startDate");
            $end = new DateTime("$endDate");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }


        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');

        $hazard = DB::table('se_hazard_report as hz')
        ->leftJoin('users as us1', 'hz.pic', 'us1.id')
        ->leftJoin('users as us2', 'hz.pelapor', 'us2.nik')
        ->leftJoin('users as us3', 'hz.scc', 'us3.nik')
        ->leftJoin('users as us4', 'hz.penerima', 'us4.nik')
        ->leftJoin('ref_shift as sh', 'hz.shift', 'sh.id')
        ->leftJoin('ref_departemen as dep', 'hz.departemen', 'dep.id')
        ->select(
            'hz.id',
            'hz.uuid',
            'us1.name as pic_name',
            'hz.statusenabled',
            'hz.kepada',
            'sh.keterangan as shift',
            'dep.keterangan as nama_departemen',
            'hz.tanggal_pelaporan',
            'hz.lokasi',
            'hz.bahaya',
            'hz.risiko',
            'hz.tindakan_perbaikan',
            'hz.tingkat_risiko',
            'hz.pengendalian_awal',
            'hz.status',
            'hz.no_inspeksi',
            'hz.pelapor as nik_pelapor',
            'us2.name as nama_pelapor',
            'hz.scc as nik_scc',
            'us2.name as nama_scc',
            'hz.penerima as nik_penerima',
            'us2.name as nama_penerima',
            'hz.created_at',
            'hz.verified_scc',
        )
        ->whereBetween(DB::raw('CONVERT(varchar, hz.tanggal_pelaporan, 23)'), [$startTimeFormatted, $endTimeFormatted])
        ->where('hz.statusenabled', true)->get();
        return view('safety.hazard-report.index', compact('hazard'));
    }

    public function insert()
    {
        $shift = Shift::where('statusenabled', true)->get();
        $dep = Departemen::where('statusenabled', true)->get();
        return view('safety.hazard-report.insert', compact('shift', 'dep'));
    }

    public function post(Request $request)
    {
        DB::beginTransaction();

        try {
            $dokumentasi_1 = null;
            $dokumentasi_2 = null;

            if ($request->dokumentasi_1 != null) {
                $file = $request->file('dokumentasi_1');
                $destinationPath = public_path('storage/hazard_report/dokumentasi_1');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
                $dokumentasi_1 = url('storage/hazard_report/dokumentasi_1/' . $fileName);
            }
            if ($request->dokumentasi_2 != null) {
                $file = $request->file('dokumentasi_2');
                $destinationPath = public_path('storage/hazard_report/dokumentasi_2');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
                $dokumentasi_2 = url('storage/hazard_report/dokumentasi_2/' . $fileName);
            }

            $year = date('Y');
            $prefix = $year . '-HRP-SE-73-01-';

            $last = HazardReport::where('no_inspeksi', 'like', $prefix . '%')
                        ->orderBy('no_inspeksi', 'desc')
                        ->first();

            if ($last) {
                $lastNumber = (int) substr($last->no_inspeksi, -4);
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            $no_inspeksi = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            HazardReport::create([
                'uuid'                      => (string) Uuid::uuid4()->toString(),
                'no_inspeksi' => $no_inspeksi,
                'pic'                       => Auth::user()->id,
                'status'                    => 0,
                'kepada'                    => $request->kepada,
                'departemen'                => $request->departemen,
                'shift'                     => $request->shift,
                'tanggal_pelaporan'         => Carbon::parse($request->tanggal_pelaporan . ' ' . $request->jam_pelaporan),
                'lokasi'                    => $request->lokasi,
                'bahaya'                    => $request->bahaya,
                'risiko'                    => $request->risiko,
                'tingkat_risiko'            => $request->tingkat_risiko,
                'pengendalian_awal'         => $request->pengendalian_awal,
                'tindakan_perbaikan'        => $request->tindakan_perbaikan,
                'lokasi'                    => $request->lokasi,
                'dokumentasi_1'             => $dokumentasi_1,
                'dokumentasi_2'             => $dokumentasi_2,
                'pelapor'                   => Auth::user()->nik,
                'verified_pelapor'          => Auth::user()->nik,
                'verified_datetime_pelapor' => Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('hazard-report.index')->with('success', 'Hazard Report berhasil diposting');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('info', 'Hazard Report gagal diposting'. $th->getMessage());

        }
    }

    public function delete($uuid)
    {
        try {
            HazardReport::where('uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);


            return redirect()->back()->with('success', 'Laporan SAP berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', $th->getMessage());
        }
    }

    public function review($uuid)
    {
        $data = DB::table('se_hazard_report as hz')
        ->leftJoin('users as us1', 'hz.pic', 'us1.id')
        ->leftJoin('users as us2', 'hz.pelapor', 'us2.nik')
        ->leftJoin('users as us3', 'hz.scc', 'us3.nik')
        ->leftJoin('users as us4', 'hz.penerima', 'us4.nik')
        ->leftJoin('ref_shift as sh', 'hz.shift', 'sh.id')
        ->leftJoin('ref_departemen as dep', 'hz.departemen', 'dep.id')
        ->select(
            'hz.id',
            'hz.uuid',
            'us1.name as pic_name',
            'hz.statusenabled',
            'hz.no_inspeksi',
            'hz.kepada',
            'sh.keterangan as shift',
            'hz.departemen',
            'dep.keterangan as nama_departemen',
            'hz.tanggal_pelaporan',
            'hz.lokasi',
            'hz.bahaya',
            'hz.risiko',
            'hz.tindakan_perbaikan',
            'hz.tingkat_risiko',
            'hz.pengendalian_awal',
            'hz.status',
            'hz.dokumentasi_1',
            'hz.dokumentasi_2',
            'hz.pelapor as nik_pelapor',
            'us2.name as nama_pelapor',
            'hz.scc as nik_scc',
            'us3.name as nama_scc',
            'hz.verified_scc',
            'hz.catatan_verified_scc',
            'hz.verified_datetime_scc',
            'hz.penerima as nik_penerima',
            'us4.name as nama_penerima',
            'hz.verified_penerima',
            'hz.catatan_verified_penerima',
            'hz.verified_datetime_penerima',
            'hz.created_at',
            'hz.dokumentasi_perbaikan_1',
            'hz.dokumentasi_perbaikan_2',
        )
        ->where('hz.statusenabled', true)
        ->where('hz.uuid', $uuid)->first();

        if($data->verified_scc == null || $data->verified_scc == ''){
            return view('safety.hazard-report.review', compact('data'));
        }else{
            return view('safety.hazard-report.show', compact('data'));
        }

    }

    public function verifySCC(Request $request)
    {
        $data = HazardReport::where('uuid', $request->uuid)->first();

        $data->scc = Auth::user()->nik;
        $data->verified_scc = $request->status;
        $data->catatan_verified_scc = $request->catatan_scc;
        $data->verified_datetime_scc = now();

        if($request->status == 'accept'){
            $data->status = 1;
        }

        $data->save();

        return back();
    }

    public function closeHazard(Request $request)
    {
        $data = HazardReport::where('uuid', $request->uuid)->first();

        $dokumentasi_perbaikan_1 = null;
        $dokumentasi_perbaikan_2 = null;

        if ($request->dokumentasi_perbaikan_1 != null) {
            $file = $request->file('dokumentasi_perbaikan_1');
            $destinationPath = public_path('storage/hazard_report/dokumentasi_perbaikan_1');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $dokumentasi_perbaikan_1 = url('storage/hazard_report/dokumentasi_perbaikan_1/' . $fileName);
        }
        if ($request->dokumentasi_perbaikan_2 != null) {
            $file = $request->file('dokumentasi_perbaikan_2');
            $destinationPath = public_path('storage/hazard_report/dokumentasi_perbaikan_2');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $dokumentasi_perbaikan_2 = url('storage/hazard_report/dokumentasi_perbaikan_2/' . $fileName);
        }


        $data->penerima = Auth::user()->nik;
        $data->verified_penerima = Auth::user()->nik;
        $data->catatan_verified_penerima = $request->catatan_penerima;
        $data->verified_datetime_penerima = now();
        $data->dokumentasi_perbaikan_1 = $dokumentasi_perbaikan_1;
        $data->dokumentasi_perbaikan_2 = $dokumentasi_perbaikan_2;
        $data->status = 2;

        $data->save();

        return back();
    }
}
