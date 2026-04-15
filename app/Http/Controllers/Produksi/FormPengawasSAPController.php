<?php

namespace App\Http\Controllers\Produksi;

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
        ->whereNotIn('us.role', ['ADMIN', 'MANAGEMENT'])
        ->where('us.statusenabled', true)->get();
        $departemen = Departemen::where('statusenabled', true)->get();
        $shift = Shift::where('statusenabled', true)->get();
        $area = Area::where('statusenabled', true)->get();
        return view('form-sap.index', compact('area', 'shift', 'pic', 'departemen'));
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

            $finishing = !empty($request->tindakLanjut);

            $saveFile = function ($fieldName, $relativeFolder) use ($request) {
                if (!$request->hasFile($fieldName)) {
                    return null;
                }

                $file = $request->file($fieldName);
                $destinationPath = public_path($relativeFolder);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $fileName);

                return url($relativeFolder . '/' . $fileName);
            };

            $fileTemuan = $saveFile('file_temuan', 'storage/sap/file_temuan');
            $fileTemuan2 = $saveFile('file_temuan2', 'storage/sap/file_temuan');
            $fileTemuan3 = $saveFile('file_temuan3', 'storage/sap/file_temuan');

            $fileTindakLanjut = $saveFile('file_tindakLanjut', 'storage/sap/file_tindakLanjut');
            $fileTindakLanjut2 = $saveFile('file_tindakLanjut2', 'storage/sap/file_tindakLanjut');
            $fileTindakLanjut3 = $saveFile('file_tindakLanjut3', 'storage/sap/file_tindakLanjut');

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
                'jam_kejadian' => $request->jamKejadian,
                'temuan' => $request->temuan,
                'tingkat_risiko' => $request->tingkatRisiko,
                'tindak_lanjut' => $request->tindakLanjut,
                'risiko' => $request->risiko,
                'departemen_pic' => $request->departemen,
                'pengendalian' => $request->pengendalian,

                'file_temuan' => $fileTemuan,
                'file_temuan2' => $fileTemuan2,
                'file_temuan3' => $fileTemuan3,
                'file_tindakLanjut' => $fileTindakLanjut,
                'file_tindakLanjut2' => $fileTindakLanjut2,
                'file_tindakLanjut3' => $fileTindakLanjut3,

                'is_finish' => $finishing,
                'tanggal_perbaikan' => $tanggal_perbaikan,
            ]);

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


    public function update(Request $request, $uuid)
    {
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
                $destinationPath = public_path($relativeFolder);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $fileName);

                return url($relativeFolder . '/' . $fileName);
            };

            $newFileTemuan = $saveFile('file_temuan', 'storage/sap/file_temuan');
            $newFileTemuan2 = $saveFile('file_temuan2', 'storage/sap/file_temuan');
            $newFileTemuan3 = $saveFile('file_temuan3', 'storage/sap/file_temuan');

            if ($newFileTemuan) {
                $fileTemuan = $newFileTemuan;
            }
            if ($newFileTemuan2) {
                $fileTemuan2 = $newFileTemuan2;
            }
            if ($newFileTemuan3) {
                $fileTemuan3 = $newFileTemuan3;
            }

            $newFileTindakLanjut = $saveFile('file_tindakLanjut', 'storage/sap/file_tindakLanjut');
            $newFileTindakLanjut2 = $saveFile('file_tindakLanjut2', 'storage/sap/file_tindakLanjut');
            $newFileTindakLanjut3 = $saveFile('file_tindakLanjut3', 'storage/sap/file_tindakLanjut');

            if ($newFileTindakLanjut) {
                $fileTindakLanjut = $newFileTindakLanjut;
            }
            if ($newFileTindakLanjut2) {
                $fileTindakLanjut2 = $newFileTindakLanjut2;
            }
            if ($newFileTindakLanjut3) {
                $fileTindakLanjut3 = $newFileTindakLanjut3;
            }

            if(Auth::user()->id == 3){
                $finishing = 0;
            }else{
                $finishing = 1;
            }

            $dataUpdate = [
                'temuan' => $request->temuan,
                'tindak_lanjut' => $request->tindakLanjut,
                'risiko' => $request->risiko,
                'tingkat_risiko' => $request->tingkatRisiko,
                'pengendalian' => $request->pengendalian,
                'departemen_pic' => $request->pic,

                'file_temuan' => $fileTemuan,
                'file_temuan2' => $fileTemuan2,
                'file_temuan3' => $fileTemuan3,

                'file_tindakLanjut' => $fileTindakLanjut,
                'file_tindakLanjut2' => $fileTindakLanjut2,
                'file_tindakLanjut3' => $fileTindakLanjut3,

                'is_finish' => $finishing,
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
        ->leftJoin('ref_region as ar', 'sr.area', 'ar.id')
        ->select(
            'sr.*',
            'sh.keterangan as shift',
            'us.nik as nik_pembuat',
            'us.name as pembuat',
            'dep.keterangan as nama_pic',
            'ar.keterangan as area',
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

            SAPReportImage::where('report_uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Laporan SAP berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', $th->getMessage());
        }
    }

    public function show(Request $request)
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

        $report = DB::table('prd_sap_report as sr')
        ->leftJoin('users as us', 'sr.foreman_id', 'us.id')
        ->leftJoin('ref_departemen as dep', 'sr.departemen_pic', 'dep.id')
        ->leftJoin('ref_shift as sh', 'sr.shift', 'sh.id')
        ->leftJoin('ref_region as ar', 'sr.area', 'ar.id')
        ->select(
            'sr.uuid',
            'sr.created_at',
            'sr.jam_kejadian',
            'sh.keterangan as shift',
            'us.nik as nik_pic',
            'us.name as pic',
            'ar.keterangan as area',
            'sr.temuan',
            'sr.risiko',
            'sr.level',
            'sr.inspektor1',
            'sr.inspektor2',
            'sr.inspektor3',
            'sr.inspektor4',
            'sr.inspektor5',
            'sr.file_temuan',
            'sr.file_temuan2',
            'sr.file_temuan3',
            'sr.file_tindakLanjut',
            'sr.file_tindakLanjut2',
            'sr.file_tindakLanjut3',
            'sr.tingkat_risiko',
            'sr.due_date',
            'sr.tanggal_perbaikan',
            'sr.pengendalian',
            'sr.tindak_lanjut',
            'sr.is_finish',
            'dep.keterangan as departemen',
        )
        ->whereBetween(DB::raw('CONVERT(varchar, sr.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted])
        ->where('sr.statusenabled', true);
        $report = $report->where(function($query) {
            if (!in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT'])) {
                $query->where('sr.foreman_id', Auth::user()->id);
            }
        });
        // /** @var \App\Models\User $user */
        // $user = Auth::user();
        // $roleBypass = getConfigArrayById(5) ?? [];

        // if (! $user->hasRoleId($roleBypass)) {

        //     $report->where(function ($query) use ($user) {
        //         $query->where('sr.foreman_id', $user->id);
        //     });

        // }
        $report = $report->orderBy('created_at', 'DESC')->get();

        return view('form-sap.daftar.index', compact('report'));
    }

    public function verifySCC(Request $request, $id)
    {
        try {
            SAPReport::where('id', $id)
            ->update([
                'verified_scc' => Auth::user()->nik,
                'verified_datetime_scc' => Carbon::now()
                ]);
        return redirect()->back()->with('success', 'Laporan SAP berhasil diverifikasi dan akan diteruskan ke Departemen terkait');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Laporan SAP gagal diverifikasi ');
        }
    }

}
