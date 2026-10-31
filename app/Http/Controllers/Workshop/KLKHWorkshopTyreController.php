<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\KLKHWorkshopTyre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use DateTime;
use App\Models\Area;
use App\Models\User;
use Carbon\Carbon;

class KLKHWorkshopTyreController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeTyre' => $request->all()]);

        if (empty($request->rangeStart) || empty($request->rangeEnd)) {
            $start = new DateTime();
            $end = new DateTime();
        } else {
            $start = new DateTime($request->rangeStart);
            $end = new DateTime($request->rangeEnd);
        }

        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');

        $user = Auth::user();

        $nikBypass = array_merge(
            getConfigArrayById(28),
            getConfigArrayById(31)
        );

        $baseQuery = DB::table('ws_klkh_tyre as tr')
            ->leftJoin('users as us', 'tr.pic', '=', 'us.id')
            ->leftJoin('users as us3', 'tr.pengawas', '=', 'us3.nik')
            ->leftJoin('users as us4', 'tr.diketahui', '=', 'us4.nik')
            ->select(
                'tr.id',
                'tr.uuid',
                'tr.pic as pic_id',
                'us.name as pic',
                'us.nik as nik_pic',
                DB::raw('CONVERT(varchar, tr.created_at, 120) as tanggal_pembuatan'),
                'tr.statusenabled',
                'tr.lokasi',
                'tr.pengawas as nik_pengawas',
                'us3.name as nama_pengawas',
                'tr.diketahui as nik_diketahui',
                'us4.name as nama_diketahui',
                'tr.verified_pengawas',
                'tr.verified_diketahui',
                'tr.date',
                'tr.time'
            )
            ->where('tr.statusenabled', 1)
            ->whereBetween(
                DB::raw('CONVERT(varchar, tr.date, 23)'),
                [$startTimeFormatted, $endTimeFormatted]
            );

        if (!in_array($user->nik, $nikBypass)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('tr.pengawas', $user->nik)
                    ->orWhere('tr.diketahui', $user->nik);
            });
        }

        $tr = $baseQuery->get();

        return view('klkh.workshop-tyre.index', compact('tr'));
    }

    public function insert()
    {
        $diketahui = User::where('departemen_id', 11)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $users = [
            'diketahui' => $diketahui,
        ];

        return view('klkh.workshop-tyre.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();
            $dokumentasi = [];
            for ($i = 1; $i <= 3; $i++) {
                $field = "dokumentasi_{$i}";
                $dokumentasi[$field] = null;

                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $i . '_' . $file->getClientOriginalName();
                    $path = "klkh/workshoptyre/{$field}";

                    Storage::disk('production_public')->putFileAs($path, $file, $fileName);
                    $dokumentasi[$field] = rtrim(config('app.url'), '/') . "/storage/{$path}/{$fileName}";
                }
            }

            $dataToInsert = [
                'uuid' => (string) Uuid::uuid4(),
                'pic' => Auth::user()->id,
                'statusenabled' => true,
                'lokasi' => $data['lokasi'],
                'date' => $data['date'],
                'time' => $data['time'],

                // 1. Bangunan dan Fasilitas
                'bangunan_fasilitas_1_check' => $data['bangunan_fasilitas_1_check'] ?? null,
                'bangunan_fasilitas_1_note' => $data['bangunan_fasilitas_1_note'] ?? null,
                'bangunan_fasilitas_2_check' => $data['bangunan_fasilitas_2_check'] ?? null,
                'bangunan_fasilitas_2_note' => $data['bangunan_fasilitas_2_note'] ?? null,
                'bangunan_fasilitas_3_check' => $data['bangunan_fasilitas_3_check'] ?? null,
                'bangunan_fasilitas_3_note' => $data['bangunan_fasilitas_3_note'] ?? null,
                'bangunan_fasilitas_4_check' => $data['bangunan_fasilitas_4_check'] ?? null,
                'bangunan_fasilitas_4_note' => $data['bangunan_fasilitas_4_note'] ?? null,
                'bangunan_fasilitas_5_check' => $data['bangunan_fasilitas_5_check'] ?? null,
                'bangunan_fasilitas_5_note' => $data['bangunan_fasilitas_5_note'] ?? null,
                'bangunan_fasilitas_6_check' => $data['bangunan_fasilitas_6_check'] ?? null,
                'bangunan_fasilitas_6_note' => $data['bangunan_fasilitas_6_note'] ?? null,
                'bangunan_fasilitas_7_check' => $data['bangunan_fasilitas_7_check'] ?? null,
                'bangunan_fasilitas_7_note' => $data['bangunan_fasilitas_7_note'] ?? null,
                'bangunan_fasilitas_8_check' => $data['bangunan_fasilitas_8_check'] ?? null,
                'bangunan_fasilitas_8_note' => $data['bangunan_fasilitas_8_note'] ?? null,
                'bangunan_fasilitas_9_check' => $data['bangunan_fasilitas_9_check'] ?? null,
                'bangunan_fasilitas_9_note' => $data['bangunan_fasilitas_9_note'] ?? null,

                // 2. Tempat Kerja
                'tempat_kerja_1_check' => $data['tempat_kerja_1_check'] ?? null,
                'tempat_kerja_1_note' => $data['tempat_kerja_1_note'] ?? null,
                'tempat_kerja_2_check' => $data['tempat_kerja_2_check'] ?? null,
                'tempat_kerja_2_note' => $data['tempat_kerja_2_note'] ?? null,
                'tempat_kerja_3_check' => $data['tempat_kerja_3_check'] ?? null,
                'tempat_kerja_3_note' => $data['tempat_kerja_3_note'] ?? null,
                'tempat_kerja_4_check' => $data['tempat_kerja_4_check'] ?? null,
                'tempat_kerja_4_note' => $data['tempat_kerja_4_note'] ?? null,
                'tempat_kerja_5_check' => $data['tempat_kerja_5_check'] ?? null,
                'tempat_kerja_5_note' => $data['tempat_kerja_5_note'] ?? null,

                // 3. Peralatan Kerja
                'peralatan_kerja_1_check' => $data['peralatan_kerja_1_check'] ?? null,
                'peralatan_kerja_1_note' => $data['peralatan_kerja_1_note'] ?? null,

                // 4. Sistem Loto
                'sistem_loto_1_check' => $data['sistem_loto_1_check'] ?? null,
                'sistem_loto_1_note' => $data['sistem_loto_1_note'] ?? null,
                'sistem_loto_2_check' => $data['sistem_loto_2_check'] ?? null,
                'sistem_loto_2_note' => $data['sistem_loto_2_note'] ?? null,

                // 5. Selang Angin
                'selang_angin_1_check' => $data['selang_angin_1_check'] ?? null,
                'selang_angin_1_note' => $data['selang_angin_1_note'] ?? null,

                // 6. Electric
                'electric_1_check' => $data['electric_1_check'] ?? null,
                'electric_1_note' => $data['electric_1_note'] ?? null,
                'electric_2_check' => $data['electric_2_check'] ?? null,
                'electric_2_note' => $data['electric_2_note'] ?? null,
                'electric_3_check' => $data['electric_3_check'] ?? null,
                'electric_3_note' => $data['electric_3_note'] ?? null,
                'electric_4_check' => $data['electric_4_check'] ?? null,
                'electric_4_note' => $data['electric_4_note'] ?? null,

                // 7. Compressor
                'compressor_1_check' => $data['compressor_1_check'] ?? null,
                'compressor_1_note' => $data['compressor_1_note'] ?? null,
                'compressor_2_check' => $data['compressor_2_check'] ?? null,
                'compressor_2_note' => $data['compressor_2_note'] ?? null,

                // 8. Bongkar Sparepart
                'bongkar_sparepart_1_check' => $data['bongkar_sparepart_1_check'] ?? null,
                'bongkar_sparepart_1_note' => $data['bongkar_sparepart_1_note'] ?? null,

                // 9. APAR
                'apar_1_check' => $data['apar_1_check'] ?? null,
                'apar_1_note' => $data['apar_1_note'] ?? null,
                'apar_2_check' => $data['apar_2_check'] ?? null,
                'apar_2_note' => $data['apar_2_note'] ?? null,
                'apar_3_check' => $data['apar_3_check'] ?? null,
                'apar_3_note' => $data['apar_3_note'] ?? null,
                'apar_4_check' => $data['apar_4_check'] ?? null,
                'apar_4_note' => $data['apar_4_note'] ?? null,

                // 10. Rambu-rambu Bahaya
                'rambu_bahaya_1_check' => $data['rambu_bahaya_1_check'] ?? null,
                'rambu_bahaya_1_note' => $data['rambu_bahaya_1_note'] ?? null,
                'rambu_bahaya_2_check' => $data['rambu_bahaya_2_check'] ?? null,
                'rambu_bahaya_2_note' => $data['rambu_bahaya_2_note'] ?? null,
                'rambu_bahaya_3_check' => $data['rambu_bahaya_3_check'] ?? null,
                'rambu_bahaya_3_note' => $data['rambu_bahaya_3_note'] ?? null,

                // 11. Tempat Sampah Domestik
                'sampah_domestik_1_check' => $data['sampah_domestik_1_check'] ?? null,
                'sampah_domestik_1_note' => $data['sampah_domestik_1_note'] ?? null,
                'sampah_domestik_2_check' => $data['sampah_domestik_2_check'] ?? null,
                'sampah_domestik_2_note' => $data['sampah_domestik_2_note'] ?? null,
                'sampah_domestik_3_check' => $data['sampah_domestik_3_check'] ?? null,
                'sampah_domestik_3_note' => $data['sampah_domestik_3_note'] ?? null,

                // 12. Ban Bekas
                'ban_bekas_1_check' => $data['ban_bekas_1_check'] ?? null,
                'ban_bekas_1_note' => $data['ban_bekas_1_note'] ?? null,
                'ban_bekas_2_check' => $data['ban_bekas_2_check'] ?? null,
                'ban_bekas_2_note' => $data['ban_bekas_2_note'] ?? null,
                'ban_bekas_3_check' => $data['ban_bekas_3_check'] ?? null,
                'ban_bekas_3_note' => $data['ban_bekas_3_note'] ?? null,
                
                // Informasi Tambahan
                'additional_notes' => $data['additional_notes'] ?? null,
                'pengawas' => Auth::user()->nik,
                'verified_pengawas' => Auth::user()->nik,
                'date_verified_pengawas' => Carbon::now(),
                'catatan_verified_pengawas' => $data['catatan_verified_pengawas'] ?? null,
                'dokumentasi_1' => $dokumentasi['dokumentasi_1'],
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'],
                'diketahui' => $data['diketahui'] ?? null,
            ];


            KLKHWorkshopTyre::create($dataToInsert);

            return redirect()->route('klkh.workshoptyre')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            KLKHWorkshopTyre::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.workshoptyre')->with('success', 'KLKH berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.workshoptyre')->with('info', nl2br('KLKH gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $tr = DB::table('ws_klkh_tyre as tr')
        ->leftJoin('users as us', 'tr.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'tr.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'tr.diketahui', '=', 'us4.nik')
        ->select(
            'tr.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui'
            )
        ->where('tr.statusenabled', true)
        ->where('tr.uuid', $uuid)->first();

        if($tr == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $tr;

            $qrTempFolder = storage_path('app/public/qr-temp');
            if (!File::exists($qrTempFolder)) {
                File::makeDirectory($qrTempFolder, 0755, true);
            }

            if ($item->verified_pengawas != null) {
                $fileName = 'verified_pengawas' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_pengawas)]), $filePath);

                $item->verified_pengawas = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_pengawas = null;
            }

            if ($item->verified_diketahui != null) {
                $fileName = 'verified_diketahui' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_diketahui)]), $filePath);

                $item->verified_diketahui = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_diketahui = null;
            }

        }

        return view('klkh.workshop-tyre.preview', compact('tr'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHWorkshopTyre::where('uuid', $uuid)->first();

        try {
            KLKHWorkshopTyre::where('id', $klkh->id)->update([
                'verified_pengawas' => $klkh->pengawas,
                'verified_diketahui' => $klkh->diketahui,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_all,
                'date_verified_pengawas' => Carbon::now(),
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedPengawas(Request $request, $uuid)
    {
        $klkh =  KLKHWorkshopTyre::where('uuid', $uuid)->first();

        try {
            KLKHWorkshopTyre::where('id', $klkh->id)->update([
                'verified_pengawas' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_pengawas' => $request->catatan_verified_pengawas,
                'date_verified_pengawas' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedDiketahui(Request $request, $uuid)
    {
        $klkh =  KLKHWorkshopTyre::where('uuid', $uuid)->first();

        try {
            KLKHWorkshopTyre::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.workshoptyre')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function cetak($uuid)
    {
        $tr = DB::table('ws_klkh_tyre as tr')
        ->leftJoin('users as us', 'tr.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'tr.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'tr.diketahui', '=', 'us4.nik')
        ->select(
            'tr.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui'
            )
        ->where('tr.statusenabled', true)
        ->where('tr.uuid', $uuid)->first();

        if($tr == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $tr;

            $qrTempFolder = storage_path('app/public/qr-temp');
            if (!File::exists($qrTempFolder)) {
                File::makeDirectory($qrTempFolder, 0755, true);
            }

            if ($item->verified_pengawas != null) {
                $fileName = 'verified_pengawas' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_pengawas)]), $filePath);

                $item->verified_pengawas = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_pengawas = null;
            }


            if ($item->verified_diketahui != null) {
                $fileName = 'verified_diketahui' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_diketahui)]), $filePath);

                $item->verified_diketahui = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_diketahui = null;
            }
        }

        return view('klkh.workshop-tyre.cetak', compact('tr'));
    }
}
