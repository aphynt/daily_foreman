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
use App\Models\RefConf;
use Illuminate\Support\Facades\Log as FacadesLog;

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

                $waController = new WhatsAppController();

                $tanggalPelaporan = Carbon::parse($request->tanggal_pelaporan . ' ' . $request->jam_pelaporan)->locale('id');
                $hariTanggal = $tanggalPelaporan->translatedFormat('l d F Y');
                $jam = $tanggalPelaporan->format('H:i') . ' Wita';

                // $nomorLaporan = (int) substr($no_inspeksi, -4);
                $nomorLaporan = $no_inspeksi;

                $formatBulletList = function ($text) {
                    $lines = preg_split('/\r\n|\r|\n/', trim((string) $text));
                    $lines = array_filter(array_map('trim', $lines));

                    return count($lines) ? "- " . implode("\n- ", $lines) : "-";
                };

                $risikoText = $formatBulletList($request->risiko);
                $pengendalianAwalText = $formatBulletList($request->pengendalian_awal);
                $tindakanPerbaikanText = $formatBulletList($request->tindakan_perbaikan);

                $hazardReportMessage = <<<MSG
                《HAZARD REPORT》

                No. $nomorLaporan

                - Kepada        : {$request->kepada}
                - Prush/Dept.   : {$request->departemen}
                - Hari/tgl.     : $hariTanggal
                - Jam           : $jam
                - Lokasi        : {$request->lokasi}

                # HAZARD/ BAHAYA
                - {$request->bahaya}

                # RISIKO
                $risikoText

                # PENGENDALIAN AWAL
                $pengendalianAwalText

                # TINDAKAN PERBAIKAN YANG HARUS DI LAKUKAN
                $tindakanPerbaikanText

                Mohon bantuannya untuk melakukan pengecekan dan verifikasi laporan tersebut di aplikasi Daily Foreman
                _Pesan ini dikirim secara otomatis. Mohon tidak membalas pesan ini._
                MSG;

                $verificationNumber = RefConf::where('id', 24)->value('value');
                $verificationWaResult = $waController->sendMessage($verificationNumber, $hazardReportMessage);

                FacadesLog::info('WA Send Result Verification', [
                    'number' => $verificationNumber,
                    'result' => $verificationWaResult
                ]);

                // $reportNotificationNumber = RefConf::where('id', 25)->value('value');
                // $reportNotificationWaResult = $waController->sendMessage($reportNotificationNumber, $hazardReportMessage);

                // FacadesLog::info('WA Send Result Report Notification', [
                //     'number' => $reportNotificationNumber,
                //     'result' => $reportNotificationWaResult
                // ]);

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

        $shift = Shift::where('statusenabled', true)->get();
        $dep = Departemen::where('statusenabled', true)->get();

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
            'hz.shift as shift_id',
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

        if (($data->verified_scc == null || $data->verified_scc == '') && Auth::user()->id == 3) {
            return view('safety.hazard-report.review', compact('data', 'shift', 'dep'));
        }

        if (
            $data->verified_scc == 'accept' &&
            $data->status == 1 &&
            Auth::user()->departemen_id == $data->departemen
        ) {
            return view('safety.hazard-report.review-departemen', compact('data', 'shift', 'dep'));
        }

        return view('safety.hazard-report.show', compact('data'));

    }

    public function updateDepartemen(Request $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $data = HazardReport::where('uuid', $uuid)->firstOrFail();

            if (Auth::user()->departemen_id != $data->departemen) {
                return redirect()->back()->with('info', 'Anda tidak berhak mengupdate data ini.');
            }

            if ($data->verified_scc != 'accept') {
                return redirect()->back()->with('info', 'Hazard belum di-accept oleh SCC.');
            }

            $dokumentasi_perbaikan_1 = $data->dokumentasi_perbaikan_1;
            $dokumentasi_perbaikan_2 = $data->dokumentasi_perbaikan_2;

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

            $data->update([
                'verified_penerima'          => 'accept',
                'status'                     => 2,
                'catatan_verified_penerima'  => $request->catatan_verified_penerima,
                'verified_datetime_penerima' => Carbon::now(),
                'penerima'                   => Auth::user()->nik,
                'dokumentasi_perbaikan_1'    => $dokumentasi_perbaikan_1,
                'dokumentasi_perbaikan_2'    => $dokumentasi_perbaikan_2,
            ]);

            DB::commit();

            return redirect()->route('hazard-report.index')->with('success', 'Tanggapan departemen berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('info', 'Tanggapan departemen gagal diupdate ' . $th->getMessage());
        }
    }

    public function update(Request $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $data = HazardReport::where('uuid', $uuid)->firstOrFail();

            if ($data->verified_penerima || $data->status == 2) {
                return redirect()->back()->with('info', 'Hazard Report tidak bisa diedit karena sudah diproses departemen.');
            }


            $dokumentasi_1 = $data->dokumentasi_1;
            $dokumentasi_2 = $data->dokumentasi_2;

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

            $tanggal_pelaporan = $data->tanggal_pelaporan;
            if ($request->tanggal_pelaporan != null) {
                $tanggal_pelaporan = Carbon::parse($request->tanggal_pelaporan);
            }

            $aksi = $request->aksi;

            $updateData = [
                'kepada'             => $request->kepada,
                'departemen'         => $request->departemen,
                'shift'              => $request->shift,
                'tanggal_pelaporan'  => $tanggal_pelaporan,
                'lokasi'             => $request->lokasi,
                'bahaya'             => $request->bahaya,
                'risiko'             => $request->risiko,
                'tingkat_risiko'     => $request->tingkat_risiko,
                'pengendalian_awal'  => $request->pengendalian_awal,
                'tindakan_perbaikan' => $request->tindakan_perbaikan,
                'dokumentasi_1'      => $dokumentasi_1,
                'dokumentasi_2'      => $dokumentasi_2,
                'catatan_verified_scc' => $request->catatan_verified_scc,
            ];

            if ($aksi == 'terima') {
                $updateData['verified_scc'] = 'accept';
                $updateData['status'] = 1;
                $updateData['catatan_verified_scc'] = $request->catatan_verified_scc;
                $updateData['scc'] = Auth::user()->nik;
                $updateData['verified_datetime_scc'] = Carbon::now();
            }

            if ($aksi == 'tolak') {
                $updateData['verified_scc'] = 'reject';
                $updateData['catatan_verified_scc'] = $request->catatan_verified_scc;
                $updateData['scc'] = Auth::user()->nik;
                $updateData['verified_datetime_scc'] = Carbon::now();
            }

            $data->update($updateData);

            DB::commit();

            if ($aksi == 'terima') {
                return redirect()->route('hazard-report.index')->with('success', 'Hazard Report berhasil diterima');
            }

            if ($aksi == 'tolak') {
                return redirect()->route('hazard-report.index')->with('success', 'Hazard Report berhasil ditolak');
            }

            return redirect()->route('hazard-report.index')->with('success', 'Hazard Report berhasil diupdate');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('info', 'Hazard Report gagal diproses ' . $th->getMessage());
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
