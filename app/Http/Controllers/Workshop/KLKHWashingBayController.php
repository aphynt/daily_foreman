<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\KLKHWashingBay;
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

class KLKHWashingBayController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeWashingBay' => $request->all()]);

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

        $baseQuery = DB::table('ws_klkh_washingbay as ab')
            ->leftJoin('users as us', 'ab.pic', '=', 'us.id')
            ->leftJoin('users as us3', 'ab.pengawas', '=', 'us3.nik')
            ->leftJoin('users as us4', 'ab.diketahui', '=', 'us4.nik')
            ->leftJoin('users as us5', 'ab.disetujui', '=', 'us5.nik')
            ->select(
                'ab.id',
                'ab.uuid',
                'ab.pic as pic_id',
                'us.name as pic',
                'us.nik as nik_pic',
                DB::raw('CONVERT(varchar, ab.created_at, 120) as tanggal_pembuatan'),
                'ab.statusenabled',
                'ab.lokasi',
                'us3.name as nama_pengawas',
                'ab.pengawas as nik_pengawas',
                'ab.verified_pengawas',
                'us4.name as nama_diketahui',
                'ab.diketahui as nik_diketahui',
                'ab.verified_diketahui',
                'us5.name as nama_disetujui',
                'ab.disetujui as nik_disetujui',
                'ab.verified_disetujui',
                'ab.date',
                'ab.time'
            )
            ->where('ab.statusenabled', 1)
            ->whereBetween(
                DB::raw('CONVERT(varchar, ab.date, 23)'),
                [$startTimeFormatted, $endTimeFormatted]
            );

        if (!in_array($user->nik, $nikBypass)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('ab.pengawas', $user->nik)
                    ->orWhere('ab.diketahui', $user->nik)
                    ->orWhere('ab.disetujui', $user->nik);
            });
        }

        $ab = $baseQuery->get();

        return view('klkh.washing-bay.index', compact('ab'));
    }

    public function insert()
    {
        $diketahui = User::where('departemen_id', 11)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $disetujui = User::where('departemen_id', 11)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $users = [
            'diketahui' => $diketahui,
            'disetujui' => $disetujui,
        ];

        return view('klkh.washing-bay.insert', compact('users'));
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
                    $path = "klkh/washingbay/{$field}";

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
                'parkiran_kendaraan_1_check' => $data['parkiran_kendaraan_1_check'] ?? null,
                'parkiran_kendaraan_1_note' => $data['parkiran_kendaraan_1_note'] ?? null,
                'peralatan_kerja_1_check' => $data['peralatan_kerja_1_check'] ?? null,
                'peralatan_kerja_1_note' => $data['peralatan_kerja_1_note'] ?? null,
                'prosedur_lotto_1_check' => $data['prosedur_lotto_1_check'] ?? null,
                'prosedur_lotto_1_note' => $data['prosedur_lotto_1_note'] ?? null,
                'prosedur_lotto_2_check' => $data['prosedur_lotto_2_check'] ?? null,
                'prosedur_lotto_2_note' => $data['prosedur_lotto_2_note'] ?? null,
                'rambu_bahaya_1_check' => $data['rambu_bahaya_1_check'] ?? null,
                'rambu_bahaya_1_note' => $data['rambu_bahaya_1_note'] ?? null,
                'rambu_bahaya_2_check' => $data['rambu_bahaya_2_check'] ?? null,
                'rambu_bahaya_2_note' => $data['rambu_bahaya_2_note'] ?? null,
                'rambu_bahaya_3_check' => $data['rambu_bahaya_3_check'] ?? null,
                'rambu_bahaya_3_note' => $data['rambu_bahaya_3_note'] ?? null,
                'lampu_penerangan_1_check' => $data['lampu_penerangan_1_check'] ?? null,
                'lampu_penerangan_1_note' => $data['lampu_penerangan_1_note'] ?? null,
                'lampu_penerangan_2_check' => $data['lampu_penerangan_2_check'] ?? null,
                'lampu_penerangan_2_note' => $data['lampu_penerangan_2_note'] ?? null,
                'electric_pump_1_check' => $data['electric_pump_1_check'] ?? null,
                'electric_pump_1_note' => $data['electric_pump_1_note'] ?? null,
                'electric_pump_2_check' => $data['electric_pump_2_check'] ?? null,
                'electric_pump_2_note' => $data['electric_pump_2_note'] ?? null,
                'electric_pump_3_check' => $data['electric_pump_3_check'] ?? null,
                'electric_pump_3_note' => $data['electric_pump_3_note'] ?? null,
                'electric_pump_4_check' => $data['electric_pump_4_check'] ?? null,
                'electric_pump_4_note' => $data['electric_pump_4_note'] ?? null,
                'tangki_air_1_check' => $data['tangki_air_1_check'] ?? null,
                'tangki_air_1_note' => $data['tangki_air_1_note'] ?? null,
                'tangki_air_2_check' => $data['tangki_air_2_check'] ?? null,
                'tangki_air_2_note' => $data['tangki_air_2_note'] ?? null,
                'tangki_air_3_check' => $data['tangki_air_3_check'] ?? null,
                'tangki_air_3_note' => $data['tangki_air_3_note'] ?? null,
                'tangki_air_4_check' => $data['tangki_air_4_check'] ?? null,
                'tangki_air_4_note' => $data['tangki_air_4_note'] ?? null,
                'sistem_loto_1_check' => $data['sistem_loto_1_check'] ?? null,
                'sistem_loto_1_note' => $data['sistem_loto_1_note'] ?? null,
                'sistem_loto_2_check' => $data['sistem_loto_2_check'] ?? null,
                'sistem_loto_2_note' => $data['sistem_loto_2_note'] ?? null,
                'selang_air_1_check' => $data['selang_air_1_check'] ?? null,
                'selang_air_1_note' => $data['selang_air_1_note'] ?? null,
                'selang_air_2_check' => $data['selang_air_2_check'] ?? null,
                'selang_air_2_note' => $data['selang_air_2_note'] ?? null,
                'apar_1_check' => $data['apar_1_check'] ?? null,
                'apar_1_note' => $data['apar_1_note'] ?? null,
                'apar_2_check' => $data['apar_2_check'] ?? null,
                'apar_2_note' => $data['apar_2_note'] ?? null,
                'apar_3_check' => $data['apar_3_check'] ?? null,
                'apar_3_note' => $data['apar_3_note'] ?? null,
                'apar_4_check' => $data['apar_4_check'] ?? null,
                'apar_4_note' => $data['apar_4_note'] ?? null,
                'room_washing_1_check' => $data['room_washing_1_check'] ?? null,
                'room_washing_1_note' => $data['room_washing_1_note'] ?? null,
                'room_washing_2_check' => $data['room_washing_2_check'] ?? null,
                'room_washing_2_note' => $data['room_washing_2_note'] ?? null,
                'room_washing_3_check' => $data['room_washing_3_check'] ?? null,
                'room_washing_3_note' => $data['room_washing_3_note'] ?? null,
                'room_washing_4_check' => $data['room_washing_4_check'] ?? null,
                'room_washing_4_note' => $data['room_washing_4_note'] ?? null,
                'sampah_domestik_1_check' => $data['sampah_domestik_1_check'] ?? null,
                'sampah_domestik_1_note' => $data['sampah_domestik_1_note'] ?? null,
                'sampah_domestik_2_check' => $data['sampah_domestik_2_check'] ?? null,
                'sampah_domestik_2_note' => $data['sampah_domestik_2_note'] ?? null,
                'sampah_domestik_3_check' => $data['sampah_domestik_3_check'] ?? null,
                'sampah_domestik_3_note' => $data['sampah_domestik_3_note'] ?? null,
                'kolam_kompartemen_1_check' => $data['kolam_kompartemen_1_check'] ?? null,
                'kolam_kompartemen_1_note' => $data['kolam_kompartemen_1_note'] ?? null,
                'kolam_kompartemen_2_check' => $data['kolam_kompartemen_2_check'] ?? null,
                'kolam_kompartemen_2_note' => $data['kolam_kompartemen_2_note'] ?? null,
                'kolam_kompartemen_3_check' => $data['kolam_kompartemen_3_check'] ?? null,
                'kolam_kompartemen_3_note' => $data['kolam_kompartemen_3_note'] ?? null,
                'kolam_kompartemen_4_check' => $data['kolam_kompartemen_4_check'] ?? null,
                'kolam_kompartemen_4_note' => $data['kolam_kompartemen_4_note'] ?? null,
                'kolam_kompartemen_5_check' => $data['kolam_kompartemen_5_check'] ?? null,
                'kolam_kompartemen_5_note' => $data['kolam_kompartemen_5_note'] ?? null,
                'kolam_kompartemen_6_check' => $data['kolam_kompartemen_6_check'] ?? null,
                'kolam_kompartemen_6_note' => $data['kolam_kompartemen_6_note'] ?? null,
                'limbah_b3_1_check' => $data['limbah_b3_1_check'] ?? null,
                'limbah_b3_1_note' => $data['limbah_b3_1_note'] ?? null,
                'additional_notes' => $data['additional_notes'] ?? null,
                
                'pengawas' => Auth::user()->nik,
                'verified_pengawas' => Auth::user()->nik,
                'date_verified_pengawas' => Carbon::now(),
                'catatan_verified_pengawas' => $data['catatan_verified_pengawas'] ?? null,
                'dokumentasi_1' => $dokumentasi['dokumentasi_1'],
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'],
                'diketahui' => $data['diketahui'] ?? null,
                'disetujui' => $data['disetujui'] ?? null,
            ];


            KLKHWashingBay::create($dataToInsert);

            return redirect()->route('klkh.washingbay')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            KLKHWashingBay::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.washingbay')->with('success', 'KLKH berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.washingbay')->with('info', nl2br('KLKH gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ab = DB::table('ws_klkh_washingbay as ab')
        ->leftJoin('users as us', 'ab.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'ab.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ab.diketahui', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ab.disetujui', '=', 'us5.nik')
        ->select(
            'ab.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui',
            'us5.name as nama_disetujui'
            )
        ->where('ab.statusenabled', true)
        ->where('ab.uuid', $uuid)->first();

        if($ab == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $ab;

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

            if ($item->verified_disetujui != null) {
                $fileName = 'verified_disetujui' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_disetujui)]), $filePath);

                $item->verified_disetujui = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_disetujui = null;
            }

        }

        return view('klkh.washing-bay.preview', compact('ab'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHWashingBay::where('uuid', $uuid)->first();

        try {
            KLKHWashingBay::where('id', $klkh->id)->update([
                'verified_pengawas' => $klkh->pengawas,
                'verified_diketahui' => $klkh->diketahui,
                'verified_disetujui' => $klkh->disetujui,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_all,
                'catatan_verified_disetujui' => $request->catatan_verified_all,
                'date_verified_pengawas' => Carbon::now(),
                'date_verified_diketahui' => Carbon::now(),
                'date_verified_disetujui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedPengawas(Request $request, $uuid)
    {
        $klkh =  KLKHWashingBay::where('uuid', $uuid)->first();

        try {
            KLKHWashingBay::where('id', $klkh->id)->update([
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
        $klkh =  KLKHWashingBay::where('uuid', $uuid)->first();

        try {
            KLKHWashingBay::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.washingbay')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }
    
    public function verifiedDisetujui(Request $request, $uuid)
    {
        $klkh =  KLKHWashingBay::where('uuid', $uuid)->first();

        try {
            KLKHWashingBay::where('id', $klkh->id)->update([
                'verified_disetujui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_disetujui' => $request->catatan_verified_disetujui,
                'date_verified_disetujui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.washingbay')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function cetak($uuid)
    {
        $ab = DB::table('ws_klkh_washingbay as ab')
        ->leftJoin('users as us', 'ab.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'ab.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ab.diketahui', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ab.disetujui', '=', 'us5.nik')
        ->select(
            'ab.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui',
            'us5.name as nama_disetujui'
            )
        ->where('ab.statusenabled', true)
        ->where('ab.uuid', $uuid)->first();

        if($ab == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $ab;

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

            if ($item->verified_disetujui != null) {
                $fileName = 'verified_disetujui' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_disetujui)]), $filePath);

                $item->verified_disetujui = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_disetujui = null;
            }
        }

        return view('klkh.washing-bay.cetak', compact('ab'));
    }
}
