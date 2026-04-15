<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\ObservasiBank;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ObservasiBankController extends Controller
{
    //
    public function index(Request $request)
    {

    session(['requestTimeObservasiBank' => $request->all()]);

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


        $baseQuery = DB::table('se_observasi_bank as bank')
        ->leftJoin('users as us', 'bank.pic', '=', 'us.id')
        ->leftJoin('ref_departemen as dep', 'bank.departemen_id', '=', 'dep.id')
        ->leftJoin('users as us1', 'bank.pengawas1', '=', 'us1.nik')
        // ->leftJoin('users as us2', 'bank.inspektor2', '=', 'us2.nik')
        // ->leftJoin('users as us3', 'bank.inspektor3', '=', 'us3.nik')
        // ->leftJoin('users as us4', 'bank.inspektor4', '=', 'us4.nik')
        // ->leftJoin('users as us5', 'bank.inspektor5', '=', 'us5.nik')
        // ->leftJoin('users as us6', 'bank.penanggungjawab', '=', 'us6.nik')
        ->select(
            'bank.id',
            'bank.uuid',
            'bank.statusenabled',
            'bank.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            'bank.tanggal',
            'bank.jam',
            DB::raw('CONVERT(varchar, bank.created_at, 120) as tanggal_pembuatan'),
            'dep.keterangan as departemen',
            'bank.nama_pekerjaan',
            'bank.referensi',
            'bank.lokasi',
            'bank.jam',
            'bank.pengawas1 as nik_pengawas1',
            'us1.name as nama_pengawas1',
        )
        ->where('bank.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, bank.tanggal, 23)'), [$startTimeFormatted, $endTimeFormatted]);


        if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'])) {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }

        $baseQuery = $baseQuery->where(function($query) {
            $query->where('bank.pengawas1', Auth::user()->nik)
                    ->orWhere('bank.petugas1', Auth::user()->nik)
                    ->orWhere('bank.petugas2', Auth::user()->nik)
                    ->orWhere('bank.petugas3', Auth::user()->nik)
                    ->orWhere('bank.pekerja1', Auth::user()->nik)
                    ->orWhere('bank.pekerja2', Auth::user()->nik)
                    ->orWhere('bank.pekerja3', Auth::user()->nik);
        });

        $bank = $baseQuery->get();

        return view('observasi-bank.index', compact('bank'));
    }

    public function insert()
    {
        $pit = Area::where('statusenabled', true)->get();
        $departemen = Departemen::where('statusenabled', true)->get();
        $penanggungjawab = User::whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->orderBy('name')->get();
        $petugas = User::whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->orderBy('name')->get();
        $pekerja = User::whereIn('departemen_id', [9])->orderBy('name')->get();
        $pengawas = User::whereIn('departemen_id', [9])->orderBy('name')->get();

        $users = [
            'departemen' => $departemen,
            'pit' => $pit,
            'penanggungjawab' => $penanggungjawab,
            'petugas' => $petugas,
            'pekerja' => $pekerja,
            'pengawas' => $pengawas,
        ];

        return view('observasi-bank.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();
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

            $dokumentasiFoto1 = $saveFile('dokumentasi_foto_1', 'storage/observasi_bank/dokumentasi');
            $dokumentasiFoto2 = $saveFile('dokumentasi_foto_2', 'storage/observasi_bank/dokumentasi');
            $dokumentasiFoto3 = $saveFile('dokumentasi_foto_3', 'storage/observasi_bank/dokumentasi');

            $dataToInsert = [
                'uuid' => (string) Uuid::uuid4(),
                'pic' => Auth::user()->id,
                'statusenabled' => true,

                // HEADER
                'tanggal' => $data['tanggal'] ?? null,
                'jam' => $data['jam'] ?? null,
                'departemen_id' => $data['departemen_id'] ?? null,
                'nama_pekerjaan' => $data['nama_pekerjaan'] ?? null,
                'referensi' => $data['referensi'] ?? null,
                'no_referensi' => $data['no_referensi'] ?? null,
                'lokasi' => ($data['lokasi'] ?? null) === 'LAIN-LAIN'
                    ? ($data['lokasi_lain'] ?? null)
                    : ($data['lokasi'] ?? null),
                'lokasi_lain' => $data['lokasi_lain'] ?? null,

                // I. PERILAKU PEKERJA SAAT DIAMATI
                'perilaku_posisi_saat_bekerja' => $data['perilaku_posisi_saat_bekerja'] ?? 0,
                'perilaku_menggunakan_peralatan' => $data['perilaku_menggunakan_peralatan'] ?? 0,
                'perilaku_mengangkat_barang' => $data['perilaku_mengangkat_barang'] ?? 0,
                'perilaku_mengemudi' => $data['perilaku_mengemudi'] ?? 0,
                'perilaku_menaiki_menuruni_tangga' => $data['perilaku_menaiki_menuruni_tangga'] ?? 0,
                'perilaku_lain_1' => $data['perilaku_lain_1'] ?? null,
                'perilaku_lain_2' => $data['perilaku_lain_2'] ?? null,

                // II. APD / ALAT KESELAMATAN
                'apd_pelindung_kepala' => $data['apd_pelindung_kepala'] ?? 0,
                'apd_pelindung_mata' => $data['apd_pelindung_mata'] ?? 0,
                'apd_pelindung_telinga' => $data['apd_pelindung_telinga'] ?? 0,
                'apd_pelindung_pernafasan' => $data['apd_pelindung_pernafasan'] ?? 0,
                'apd_pelindung_tangan' => $data['apd_pelindung_tangan'] ?? 0,
                'apd_pelindung_kaki' => $data['apd_pelindung_kaki'] ?? 0,
                'apd_pelindung_tenggelam' => $data['apd_pelindung_tenggelam'] ?? 0,
                'apd_loto' => $data['apd_loto'] ?? 0,
                'apd_sabuk_pengaman' => $data['apd_sabuk_pengaman'] ?? 0,
                'apd_lain_1' => $data['apd_lain_1'] ?? null,
                'apd_lain_2' => $data['apd_lain_2'] ?? null,

                // III. POTENSI RISIKO
                'risiko_menabrak' => $data['risiko_menabrak'] ?? 0,
                'risiko_terjepit' => $data['risiko_terjepit'] ?? 0,
                'risiko_terpukul' => $data['risiko_terpukul'] ?? 0,
                'risiko_terpeleset' => $data['risiko_terpeleset'] ?? 0,
                'risiko_sengatan' => $data['risiko_sengatan'] ?? 0,
                'risiko_gangguan_kesehatan' => $data['risiko_gangguan_kesehatan'] ?? 0,
                'risiko_pencemaran_lingkungan' => $data['risiko_pencemaran_lingkungan'] ?? 0,
                'risiko_terhirup' => $data['risiko_terhirup'] ?? 0,
                'risiko_kontak' => $data['risiko_kontak'] ?? 0,
                'risiko_lain_1' => $data['risiko_lain_1'] ?? null,
                'risiko_lain_2' => $data['risiko_lain_2'] ?? null,

                // IV. PERALATAN KERJA
                'peralatan_sesuai' => $data['peralatan_sesuai'] ?? 0,
                'peralatan_benar' => $data['peralatan_benar'] ?? 0,
                'peralatan_kondisi' => $data['peralatan_kondisi'] ?? 0,
                'peralatan_taging' => $data['peralatan_taging'] ?? 0,
                'peralatan_pelindung' => $data['peralatan_pelindung'] ?? 0,
                'peralatan_lain_1' => $data['peralatan_lain_1'] ?? null,
                'peralatan_lain_2' => $data['peralatan_lain_2'] ?? null,

                // V. PROSEDUR KERJA
                'prosedur_tersedia' => $data['prosedur_tersedia'] ?? 0,
                'prosedur_diketahui' => $data['prosedur_diketahui'] ?? 0,
                'prosedur_dijalankan' => $data['prosedur_dijalankan'] ?? 0,
                'prosedur_permit' => $data['prosedur_permit'] ?? 0,
                'prosedur_p2h' => $data['prosedur_p2h'] ?? 0,
                'prosedur_kerja_lain' => $data['prosedur_kerja_lain'] ?? null,
                'prosedur_kerja_lain_2' => $data['prosedur_kerja_lain_2'] ?? null,

                // VI. KONDISI AREA / LINGKUNGAN KERJA
                'kondisi_area_kebersihan' => $data['kondisi_area_kebersihan'] ?? 0,
                'kondisi_area_rambu' => $data['kondisi_area_rambu'] ?? 0,
                'kondisi_area_akses' => $data['kondisi_area_akses'] ?? 0,
                'kondisi_area_penyimpanan' => $data['kondisi_area_penyimpanan'] ?? 0,
                'kondisi_area_suhu' => $data['kondisi_area_suhu'] ?? 0,
                'kondisi_area_pencahayaan' => $data['kondisi_area_pencahayaan'] ?? 0,
                'kondisi_area_kebisingan' => $data['kondisi_area_kebisingan'] ?? 0,
                'kondisi_area_cuaca' => $data['kondisi_area_cuaca'] ?? 0,
                'kondisi_area_lain' => $data['kondisi_area_lain'] ?? null,
                'kondisi_area_lain_2' => $data['kondisi_area_lain_2'] ?? null,

                // VII & VIII
                'perilaku_aman_yang_diamati' => $data['perilaku_aman_yang_diamati'] ?? null,
                'perilaku_tidak_aman_yang_diamati' => $data['perilaku_tidak_aman_yang_diamati'] ?? null,

                // IX. TINDAKAN KOREKSI / PERBAIKAN
                'tindakan_kegiatan' => $data['tindakan_kegiatan'] ?? 0,
                'tindakan_perbaikan_langsung' => $data['tindakan_perbaikan_langsung'] ?? 0,
                'tindakan_perbaikan_lanjutan' => $data['tindakan_perbaikan_lanjutan'] ?? 0,

                'tindakan_lanjutan_1' => $data['tindakan_lanjutan_1'] ?? null,
                'tindakan_lanjutan_due_1' => $data['tindakan_lanjutan_due_1'] ?? null,
                'tindakan_lanjutan_2' => $data['tindakan_lanjutan_2'] ?? null,
                'tindakan_lanjutan_due_2' => $data['tindakan_lanjutan_due_2'] ?? null,
                'tindakan_lanjutan_3' => $data['tindakan_lanjutan_3'] ?? null,
                'tindakan_lanjutan_due_3' => $data['tindakan_lanjutan_due_3'] ?? null,
                'tindakan_lanjutan_4' => $data['tindakan_lanjutan_4'] ?? null,
                'tindakan_lanjutan_due_4' => $data['tindakan_lanjutan_due_4'] ?? null,
                'tindakan_lanjutan_5' => $data['tindakan_lanjutan_5'] ?? null,
                'tindakan_lanjutan_due_5' => $data['tindakan_lanjutan_due_5'] ?? null,

                // CATATAN
                'additional_notes' => $data['additional_notes'] ?? null,

                // X. PETUGAS / OBSERVER
                'petugas1' => $data['petugas1'] ?? null,
                'petugas2' => $data['petugas2'] ?? null,
                'petugas3' => $data['petugas3'] ?? null,

                // XI. PEKERJA YANG DI OBSERVASI
                'pekerja1' => $data['pekerja1'] ?? null,
                'pekerja2' => $data['pekerja2'] ?? null,
                'pekerja3' => $data['pekerja3'] ?? null,

                // XII. VALIDASI PENGAWAS
                'pengawas1' => $data['pengawas1'] ?? null,

                'dokumentasi_foto_1' => $dokumentasiFoto1,
                'dokumentasi_foto_2' => $dokumentasiFoto2,
                'dokumentasi_foto_3' => $dokumentasiFoto3,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];


            ObservasiBank::create($dataToInsert);

            return redirect()->route('observasibank')->with('success', 'Observasi BANK berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Observasi BANK gagal disimpan' . $th->getMessage());
        }
    }

    public function preview($uuid)
    {
        $data['report'] = DB::table('se_observasi_bank as ob')
            ->leftJoin('ref_departemen as dep', 'ob.departemen_id', '=', 'dep.id')
            ->leftJoin('users as us1', 'ob.petugas1', '=', 'us1.nik')
            ->leftJoin('users as us2', 'ob.petugas2', '=', 'us2.nik')
            ->leftJoin('users as us3', 'ob.petugas3', '=', 'us3.nik')
            ->leftJoin('users as us4', 'ob.pengawas1', '=', 'us4.nik')
            ->select(
                'ob.*',
                'dep.keterangan as departemen',
                'us1.name as nama_petugas1',
                'us2.name as nama_petugas2',
                'us3.name as nama_petugas3',
                'us4.name as nama_pengawas1',
            )
            ->where('ob.uuid', $uuid)
            ->where('ob.statusenabled', 1)
            ->first();

        if (!$data['report']) {
            abort(404);
        }

        return view('observasi-bank.preview', compact('data'));
    }


    public function delete($id)
    {
        try {
            ObservasiBank::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('observasibank')->with('success', 'Observasi BANK berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('observasibank')->with('info', nl2br('Observasi BANK gagal dihapus..\n' . $th->getMessage()));
        }
    }
}
