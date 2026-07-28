<?php

namespace App\Http\Controllers\Produksi;

use App\Exports\InspeksiPICAExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\SAPReport;
use App\Models\SAPReportImage;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Log as FacadesLog;
use App\Models\RefConf;
use Illuminate\Support\Facades\Storage;

class FormPengawasSAPController extends Controller
{

    private function handleFileUpload($files, $reportUuid, $folder, $type)
    {
        foreach ($files as $file) {
            $filePath = $file->store($folder, 'public');
            $fileUrl = url('storage/' . $filePath);
            SAPReportImage::create([
                'uuid' => (string) Uuid::uuid4()->toString(),
                'report_uuid' => $reportUuid,
                'path' => $fileUrl,
                'name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'format' => $file->extension(),
                'type' => $type,
            ]);
        }
    }

    //
    public function index()
    {
        $pic = DB::table('users as us')
        ->leftJoin('ref_departemen as dep', 'dep.id', 'us.departemen_id')
        ->select('us.nik', 'us.name', 'dep.keterangan as departemen')
        ->whereNotIn('us.role', ['ADMIN'])
        ->where('us.statusenabled', true)->get();
        $departemen = Departemen::where('statusenabled', true)->get();
        $departemenSelected = Departemen::where('id', Auth::user()->departemen_id)->first();
        $shift = Shift::where('statusenabled', true)->get();
        $area = Area::where('statusenabled', true)->get();
        return view('form-sap.index', compact('area', 'shift', 'pic', 'departemen', 'departemenSelected'));
    }

    public function post(Request $request)
    {
        DB::beginTransaction();

        try {
            $fileTemuan = null;
            $fileTemuan2 = null;
            $fileTemuan3 = null;
            $fileTindakLanjut = null;
            $fileTindakLanjut2 = null;
            $fileTindakLanjut3 = null;

            // $finishing = !empty($request->tindakLanjut);
            $finishing = false;

            $saveFile = function ($fieldName, $relativeFolder) use ($request) {

                if (!$request->hasFile($fieldName)) {
                    return null;
                }

                $file = $request->file($fieldName);

                $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

                Storage::disk('production_public')->putFileAs(
                    $relativeFolder,
                    $file,
                    $fileName
                );

                return rtrim(config('app.url'), '/')
                    . '/storage/' . trim($relativeFolder, '/') . '/' . $fileName;
            };

            $fileTemuan = $saveFile('file_temuan', 'sap/file_temuan');
            $fileTemuan2 = $saveFile('file_temuan2', 'sap/file_temuan');
            $fileTemuan3 = $saveFile('file_temuan3', 'sap/file_temuan');

            $fileTindakLanjut = $saveFile('file_tindakLanjut', 'sap/file_tindakLanjut');
            $fileTindakLanjut2 = $saveFile('file_tindakLanjut2', 'sap/file_tindakLanjut');
            $fileTindakLanjut3 = $saveFile('file_tindakLanjut3', 'sap/file_tindakLanjut');

            $tanggal_perbaikan = null;

            if ($fileTindakLanjut || $fileTindakLanjut2 || $fileTindakLanjut3) {
                $finishing = true;
                $tanggal_perbaikan = Carbon::now();
            }

            $report = SAPReport::create([
                'uuid' => (string) Uuid::uuid4()->toString(),
                'foreman_id' => Auth::user()->id,
                'statusenabled' => 1,

                'inspektor1' => $request->inspektor1,
                'inspektor2' => $request->inspektor2,
                'inspektor3' => $request->inspektor3,
                'inspektor4' => $request->inspektor4,
                'inspektor5' => $request->inspektor5,

                'shift' => $request->shift,
                'area' => $request->area,
                'level' => $request->level,
                'tanggal_kejadian' => $request->tanggalKejadian,
                'jam_kejadian' => $request->jamKejadian,
                'temuan' => $request->temuan,
                'tingkat_risiko' => $request->tingkatRisiko,
                'kategori_bahaya' => $request->kategoriBahaya,
                'type_bahaya' => $request->typeBahaya,
                'tindak_lanjut' => $request->tindakLanjut,
                'risiko' => $request->risiko,
                'departemen_pic' => $request->departemen,
                'pengendalian' => $request->pengendalian,
                'tindakan_perbaikan' => $request->tindakan_perbaikan,

                'file_temuan' => $fileTemuan,
                'file_temuan2' => $fileTemuan2,
                'file_temuan3' => $fileTemuan3,
                'file_tindakLanjut' => $fileTindakLanjut,
                'file_tindakLanjut2' => $fileTindakLanjut2,
                'file_tindakLanjut3' => $fileTindakLanjut3,

                'is_finish' => $finishing,
                'tanggal_perbaikan' => $tanggal_perbaikan,
            ]);

            if (!$finishing) {
            try {
                $waController = new WhatsAppController();
                $number = RefConf::where('id', 27)->value('value');

                $noLaporan = $report->id ?? '-';
                $hariTanggal = Carbon::parse($report->created_at)->locale('id')->translatedFormat('l d F Y');
                $departemen = Departemen::where('id', $request->departemen)->value('keterangan');
                $jam = !empty($request->jamKejadian)
                    ? Carbon::parse($request->jamKejadian)->format('H:i') . ' WITA'
                    : Carbon::now()->format('H:i') . ' WITA';

                $temuan = trim((string) $request->temuan);
                $temuan = $temuan !== ''
                    ? '· ' . str_replace(["\r\n", "\r", "\n"], "\n· ", $temuan)
                    : '· -';

                $risiko = trim((string) $request->risiko);
                $risiko = $risiko !== ''
                    ? '· ' . str_replace(["\r\n", "\r", "\n"], "\n· ", $risiko)
                    : '· -';

                $pengendalian = trim((string) $request->pengendalian);
                $pengendalian = $pengendalian !== ''
                    ? '· ' . str_replace(["\r\n", "\r", "\n"], "\n· ", $pengendalian)
                    : '· -';

                $message = <<<MSG
《PICA OPEN REPORT》

ID. {$noLaporan}

· Kepada : Tim SCC
· Dept/PIC Terkait : {$departemen}
· Hari/Tgl : {$hariTanggal}
· Jam : {$jam}
· Lokasi : {$request->area}

#TEMUAN / BAHAYA
{$temuan}

#RISIKO
{$risiko}

#PENGENDALIAN AWAL SAAT INI
{$pengendalian}

#TINDAKAN LANJUT YANG PERLU DILAKUKAN
· Mohon bantuan untuk melakukan review atas inspeksi PICA yang masih berstatus open pada _Aplikasi Daily Foreman_
· Mohon diteruskan kepada PIC terkait agar dapat segera ditindaklanjuti

Terima kasih atas perhatian dan kerja samanya.
_Pesan ini dikirim secara otomatis. Kami mohon untuk tidak membalas pesan ini._
MSG;

                $waResult = $waController->sendMessageImage($number, $message, $fileTemuan);
                FacadesLog::info('WA Send Result: ', $waResult);
            } catch (\Throwable $waError) {
                FacadesLog::error('WA gagal dikirim: ' . $waError->getMessage());
            }
        }

            DB::commit();

            return redirect()
                ->route('form-pengawas-sap.show')
                ->with('success', 'SAP berhasil diposting');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'SAP gagal diposting: ' . $th->getMessage());
        }
    }

    public function open(Request $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $report = SAPReport::where('uuid', $uuid)->firstOrFail();


            $dataUpdate = [
                'is_finish' => false,
            ];

            $report->update($dataUpdate);

            DB::commit();

            return redirect()
                ->route('form-pengawas-sap.show')
                ->with('success', 'SAP berhasil dibuka kembali');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'SAP gagal diupdate: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $report = SAPReport::where('uuid', $uuid)->firstOrFail();

            $fileTemuan = $report->file_temuan;
            $fileTemuan2 = $report->file_temuan2;
            $fileTemuan3 = $report->file_temuan3;

            $fileTindakLanjut = $report->file_tindakLanjut;
            $fileTindakLanjut2 = $report->file_tindakLanjut2;
            $fileTindakLanjut3 = $report->file_tindakLanjut3;

            $saveFile = function ($fieldName, $relativeFolder) use ($request) {

                if (!$request->hasFile($fieldName)) {
                    return null;
                }

                $file = $request->file($fieldName);

                $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

                Storage::disk('production_public')->putFileAs(
                    $relativeFolder,
                    $file,
                    $fileName
                );

                return rtrim(config('app.url'), '/')
                    . '/storage/' . trim($relativeFolder, '/') . '/' . $fileName;
            };

            $newFileTemuan = $saveFile('file_temuan', 'sap/file_temuan');
            $newFileTemuan2 = $saveFile('file_temuan2', 'sap/file_temuan');
            $newFileTemuan3 = $saveFile('file_temuan3', 'sap/file_temuan');

            if ($newFileTemuan) {
                $fileTemuan = $newFileTemuan;
            }
            if ($newFileTemuan2) {
                $fileTemuan2 = $newFileTemuan2;
            }
            if ($newFileTemuan3) {
                $fileTemuan3 = $newFileTemuan3;
            }

            $newFileTindakLanjut = $saveFile('file_tindakLanjut', 'sap/file_tindakLanjut');
            $newFileTindakLanjut2 = $saveFile('file_tindakLanjut2', 'sap/file_tindakLanjut');
            $newFileTindakLanjut3 = $saveFile('file_tindakLanjut3', 'sap/file_tindakLanjut');

            if ($newFileTindakLanjut) {
                $fileTindakLanjut = $newFileTindakLanjut;
            }
            if ($newFileTindakLanjut2) {
                $fileTindakLanjut2 = $newFileTindakLanjut2;
            }
            if ($newFileTindakLanjut3) {
                $fileTindakLanjut3 = $newFileTindakLanjut3;
            }

            $dataUpdate = [
                'temuan' => $request->temuan,
                'tindak_lanjut' => $request->tindakLanjut,
                'risiko' => $request->risiko,
                'tingkat_risiko' => $request->tingkatRisiko,
                'kategori_bahaya' => $request->kategoriBahaya,
                'type_bahaya' => $request->typeBahaya,
                'pengendalian' => $request->pengendalian,
                'tindakan_perbaikan' => $request->tindakan_perbaikan,
                'departemen_pic' => $request->pic,

                'file_temuan' => $fileTemuan,
                'file_temuan2' => $fileTemuan2,
                'file_temuan3' => $fileTemuan3,

                'file_tindakLanjut' => $fileTindakLanjut,
                'file_tindakLanjut2' => $fileTindakLanjut2,
                'file_tindakLanjut3' => $fileTindakLanjut3,
                'tanggal_perbaikan' => Carbon::now(),

                'is_finish' => true,
            ];

            $report->update($dataUpdate);

            DB::commit();

            return redirect()
                ->route('form-pengawas-sap.show')
                ->with('success', 'SAP berhasil diclosing');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'SAP gagal diupdate: ' . $e->getMessage());
        }
    }

    public function rincian($uuid)
    {
        $report = DB::table('prd_sap_report as sr')
        ->leftJoin('users as us', 'sr.foreman_id', 'us.id')
        ->leftJoin('ref_departemen as dep', 'sr.departemen_pic', 'dep.id')
        ->leftJoin('ref_shift as sh', 'sr.shift', 'sh.id')
        ->select(
            'sr.*',
            'sh.keterangan as shift',
            'us.nik as nik_pembuat',
            'us.name as pembuat',
            'dep.keterangan as nama_pic',
        )
        ->where('sr.statusenabled', true)
        ->where('sr.uuid', $uuid)->first();

        $departemen = Departemen::where('statusenabled', true)->get();

        if($report == null){
            return redirect()->back()->with('info', 'Maaf, SAP tidak ditemukan');
        }

        $data = [
            'report' => $report,
            'departemen' => $departemen,
        ];

        // dd($data);

        if($report->is_finish == true){
            return view('form-sap.show', compact('data'));
        }else{
            return view('form-sap.update', compact('data'));
        }
    }

    public function delete($uuid)
    {
        try {
            SAPReport::where('uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            // SAPReportImage::where('report_uuid', $uuid)->update([
            //     'statusenabled' => false,
            //     'deleted_by' => Auth::user()->id,
            // ]);

            return redirect()->back()->with('success', 'Laporan SAP berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', $th->getMessage());
        }
    }

    public function show(Request $request)
    {
        $start = $request->filled('rangeStart')
            ? Carbon::parse($request->rangeStart)->startOfDay()
            : now()->startOfDay();

        $end = $request->filled('rangeEnd')
            ? Carbon::parse($request->rangeEnd)->endOfDay()
            : now()->endOfDay();

        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');

        $user = Auth::user();

        $report = DB::table('prd_sap_report as sr')
            ->leftJoin('users as us', 'sr.foreman_id', 'us.id')
            ->leftJoin('ref_departemen as dep', 'sr.departemen_pic', 'dep.id')
            ->leftJoin('ref_departemen as dep2', 'us.departemen_id', 'dep2.id')
            ->leftJoin('users as u1', 'sr.inspektor1', '=', 'u1.name')
            ->leftJoin('users as u2', 'sr.inspektor2', '=', 'u2.name')
            ->leftJoin('users as u3', 'sr.inspektor3', '=', 'u3.name')
            ->leftJoin('users as u4', 'sr.inspektor4', '=', 'u4.name')
            ->leftJoin('users as u5', 'sr.inspektor5', '=', 'u5.name')

            ->leftJoin('ref_departemen as dp1', 'u1.departemen_id', '=', 'dp1.id')
            ->leftJoin('ref_departemen as dp2', 'u2.departemen_id', '=', 'dp2.id')
            ->leftJoin('ref_departemen as dp3', 'u3.departemen_id', '=', 'dp3.id')
            ->leftJoin('ref_departemen as dp4', 'u4.departemen_id', '=', 'dp4.id')
            ->leftJoin('ref_departemen as dp5', 'u5.departemen_id', '=', 'dp5.id')
            ->leftJoin('ref_shift as sh', 'sr.shift', 'sh.id')
            ->select(
                'sr.uuid',
                'sr.statusenabled',
                'sr.created_at',
                'sr.tanggal_kejadian',
                'sr.jam_kejadian',
                'sh.keterangan as shift',
                'us.nik as nik_pic',
                'us.name as pic',
                'sr.area',
                'sr.temuan',
                'sr.risiko',
                'sr.level',
                'sr.inspektor1',
                'sr.inspektor2',
                'sr.inspektor3',
                'sr.inspektor4',
                'sr.inspektor5',
                'dp1.keterangan as departemen_inspektor1',
                'dp2.keterangan as departemen_inspektor2',
                'dp3.keterangan as departemen_inspektor3',
                'dp4.keterangan as departemen_inspektor4',
                'dp5.keterangan as departemen_inspektor5',
                'sr.file_temuan',
                'sr.file_temuan2',
                'sr.file_temuan3',
                'sr.file_tindakLanjut',
                'sr.file_tindakLanjut2',
                'sr.file_tindakLanjut3',
                'sr.tingkat_risiko',
                'sr.kategori_bahaya',
                'sr.type_bahaya',
                'sr.due_date',
                'sr.tanggal_perbaikan',
                'sr.pengendalian',
                'sr.tindakan_perbaikan',
                'sr.tindak_lanjut',
                'sr.is_finish',
                'dep.keterangan as departemen',
                'dep2.keterangan as departemen_pic'
            )
            ->whereBetween('sr.created_at', [
                $start->format('Y-m-d H:i:s'),
                $end->format('Y-m-d H:i:s')
            ])
            ->where('sr.statusenabled', 1);

        // Filter pencarian
        if ($request->filled('search')) {
            $search = trim($request->search);

            $report->where(function ($q) use ($search) {
                $q->where('us.nik', 'like', "%{$search}%")
                    ->orWhere('us.name', 'like', "%{$search}%")
                    ->orWhere('sr.area', 'like', "%{$search}%")
                    ->orWhere('sr.temuan', 'like', "%{$search}%")
                    ->orWhere('sr.level', 'like', "%{$search}%")
                    ->orWhere('dep.keterangan', 'like', "%{$search}%")
                    ->orWhere('sr.inspektor1', 'like', "%{$search}%")
                    ->orWhere('sr.inspektor2', 'like', "%{$search}%")
                    ->orWhere('sr.inspektor3', 'like', "%{$search}%")
                    ->orWhere('sr.inspektor4', 'like', "%{$search}%")
                    ->orWhere('sr.inspektor5', 'like', "%{$search}%");
            });
        }

        // Hak akses
        if (!in_array($user->role, ['ADMIN', 'MANAGEMENT'])) {

            $report->where(function ($query) use ($user) {

                if (in_array($user->role, ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])) {

                    $query->where('sr.departemen_pic', $user->departemen_id)
                        ->orWhere('sr.foreman_id', $user->id)
                        ->orWhere('sr.inspektor1', $user->name)
                        ->orWhere('sr.inspektor2', $user->name)
                        ->orWhere('sr.inspektor3', $user->name)
                        ->orWhere('sr.inspektor4', $user->name)
                        ->orWhere('sr.inspektor5', $user->name);

                } else {

                    $query->where('sr.foreman_id', $user->id);

                }
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $report->where('sr.is_finish', $request->status);
        }

        $report = $report->orderBy('sr.created_at', 'DESC')->get();

        if ($request->get('export') === 'excel') {

            $fileName = "({$startTimeFormatted} - {$endTimeFormatted}) PICA Inspeksi Keselamatan Pertambangan.xlsx";

            return Excel::download(
                new InspeksiPICAExport($report),
                $fileName
            );
        }

        return view('form-sap.daftar.index', compact('report'));
    }

    public function verifySCC(Request $request, $uuid)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {
            $report = SAPReport::where('uuid', $uuid)->firstOrFail();

            // ambil file lama
            $fileTemuan = $report->file_temuan;
            $fileTemuan2 = $report->file_temuan2;
            $fileTemuan3 = $report->file_temuan3;

            $fileTindakLanjut = $report->file_tindakLanjut;
            $fileTindakLanjut2 = $report->file_tindakLanjut2;
            $fileTindakLanjut3 = $report->file_tindakLanjut3;

            $saveFile = function ($fieldName, $relativeFolder) use ($request) {

                if (!$request->hasFile($fieldName)) {
                    return null;
                }

                $file = $request->file($fieldName);

                $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

                Storage::disk('production_public')->putFileAs(
                    $relativeFolder,
                    $file,
                    $fileName
                );

                return rtrim(config('app.url'), '/')
                    . '/storage/' . trim($relativeFolder, '/') . '/' . $fileName;
            };

            $newFileTemuan = $saveFile('file_temuan', 'sap/file_temuan');
            $newFileTemuan2 = $saveFile('file_temuan2', 'sap/file_temuan');
            $newFileTemuan3 = $saveFile('file_temuan3', 'sap/file_temuan');

            if ($newFileTemuan) {
                $fileTemuan = $newFileTemuan;
            }
            if ($newFileTemuan2) {
                $fileTemuan2 = $newFileTemuan2;
            }
            if ($newFileTemuan3) {
                $fileTemuan3 = $newFileTemuan3;
            }

            $newFileTindakLanjut = $saveFile('file_tindakLanjut', 'sap/file_tindakLanjut');
            $newFileTindakLanjut2 = $saveFile('file_tindakLanjut2', 'sap/file_tindakLanjut');
            $newFileTindakLanjut3 = $saveFile('file_tindakLanjut3', 'sap/file_tindakLanjut');

            if ($newFileTindakLanjut) {
                $fileTindakLanjut = $newFileTindakLanjut;
            }
            if ($newFileTindakLanjut2) {
                $fileTindakLanjut2 = $newFileTindakLanjut2;
            }
            if ($newFileTindakLanjut3) {
                $fileTindakLanjut3 = $newFileTindakLanjut3;
            }

            $waController = new WhatsAppController();

                if($request->pic == 2){
                    $verificationNumber = RefConf::where('id', 14)->value('value');
                }else if($request->pic == 3){
                    $verificationNumber = RefConf::where('id', 20)->value('value');
                }else if($request->pic == 4){
                    $verificationNumber = RefConf::where('id', 18)->value('value');
                }else if($request->pic == 5){
                    $verificationNumber = RefConf::where('id', 19)->value('value');
                }else if($request->pic == 6){
                    $verificationNumber = RefConf::where('id', 16)->value('value');
                }else if($request->pic == 7){
                    $verificationNumber = RefConf::where('id', 17)->value('value');
                }else if($request->pic == 8){
                    $verificationNumber = RefConf::where('id', 13)->value('value');
                }else if($request->pic == 10){
                    $verificationNumber = RefConf::where('id', 23)->value('value');
                }else if($request->pic == 11){
                    $verificationNumber = RefConf::where('id', 21)->value('value');
                }else if($request->pic == 17){
                    $verificationNumber = RefConf::where('id', 22)->value('value');
                }else if($request->pic == 9){
                    $verificationNumber = RefConf::where('id', 24)->value('value');
                }

                $tanggalReport = $report->created_at
                    ? Carbon::parse($report->created_at)->format('d-m-Y')
                    : '-';


                $dueDate = $report->created_at
                    ? Carbon::parse($report->created_at)->addDays(7)->format('d-m-Y')
                    : '-';

                $verificationMessage = <<<MSG
                🔔 *Notifikasi Tindak Lanjut PICA Report*

                Yth. PIC,

                Terdapat *PICA Report* yang masih berstatus *Open* dan telah diteruskan kepada Anda untuk segera ditindaklanjuti ke PIC masing-masing.

                Detail temuan:
                - No. Report: {$report->id}
                - Area: {$report->area}
                - Temuan: {$request->temuan}
                - Tingkat Risiko: {$request->tingkatRisiko}
                - Tanggal Submit: {$tanggalReport}
                - Due Date: {$dueDate}

                Mohon segera melakukan tindak lanjut atas temuan tersebut dan memperbarui progres perbaikannya.

                Terima kasih atas perhatian dan kerja samanya.
                _Pesan ini dikirim secara otomatis. Mohon tidak membalas pesan ini._
                MSG;

                $verificationWaResult = $waController->sendMessage($verificationNumber, $verificationMessage);
                if (!empty($verificationNumber)) {

                    FacadesLog::info('WA Send Result Verification', [
                        'number' => $verificationNumber,
                        'result' => $verificationWaResult
                    ]);
                }
                FacadesLog::info('WA Send Result Verification', [
                    'number' => $verificationNumber,
                    'result' => $verificationWaResult
                ]);

            $dataUpdate = [
                'temuan' => $request->temuan,
                'tindak_lanjut' => $request->tindakLanjut,
                'risiko' => $request->risiko,
                'tingkat_risiko' => $request->tingkatRisiko,
                'kategori_bahaya' => $request->kategoriBahaya,
                'type_bahaya' => $request->kategoriBahaya,
                'pengendalian' => $request->pengendalian,
                'tindakan_perbaikan' => $request->tindakan_perbaikan,
                'departemen_pic' => $request->pic,

                'file_temuan' => $fileTemuan,
                'file_temuan2' => $fileTemuan2,
                'file_temuan3' => $fileTemuan3,

                'file_tindakLanjut' => $fileTindakLanjut,
                'file_tindakLanjut2' => $fileTindakLanjut2,
                'file_tindakLanjut3' => $fileTindakLanjut3,
            ];

            $report->update($dataUpdate);
            SAPReport::where('uuid', $uuid)->update([
                    'verified_scc' => Auth::user()->nik,
                    'verified_datetime_scc' => Carbon::now()
                    ]);

            DB::commit();

            return redirect()->route('form-pengawas-sap.show')->with('success', 'Laporan SAP berhasil diverifikasi dan akan diteruskan ke Departemen terkait');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'SAP gagal diupdate: ' . $e->getMessage());
        }
    }

}
