<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\KLKHWorkshopElectric;
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

class KLKHWorkshopElectricController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeElectric' => $request->all()]);

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

        $baseQuery = DB::table('ws_klkh_electric as el')
            ->leftJoin('users as us', 'el.pic', '=', 'us.id')
            ->leftJoin('users as us3', 'el.pengawas', '=', 'us3.nik')
            ->leftJoin('users as us4', 'el.diketahui', '=', 'us4.nik')
            ->select(
                'el.id',
                'el.uuid',
                'el.pic as pic_id',
                'us.name as pic',
                'us.nik as nik_pic',
                DB::raw('CONVERT(varchar, el.created_at, 120) as tanggal_pembuatan'),
                'el.statusenabled',
                'el.lokasi',
                'el.pengawas as nik_pengawas',
                'us3.name as nama_pengawas',
                'el.diketahui as nik_diketahui',
                'us4.name as nama_diketahui',
                'el.verified_pengawas',
                'el.verified_diketahui',
                'el.date',
                'el.time'
            )
            ->where('el.statusenabled', 1)
            ->whereBetween(
                DB::raw('CONVERT(varchar, el.date, 23)'),
                [$startTimeFormatted, $endTimeFormatted]
            );

        if (!in_array($user->nik, $nikBypass)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('el.pengawas', $user->nik)
                    ->orWhere('el.diketahui', $user->nik);
            });
        }

        $el = $baseQuery->get();

        return view('klkh.workshop-electric.index', compact('el'));
    }

    public function insert()
    {
        $diketahui = User::where('departemen_id', 11)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $users = [
            'diketahui' => $diketahui,
        ];

        return view('klkh.workshop-electric.insert', compact('users'));
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
                    $path = "klkh/workshopelectric/{$field}";

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

                // 1. Ruangan dan Fasilitas
                'ruangan_fasilitas_1_check' => $data['ruangan_fasilitas_1_check'] ?? null,
                'ruangan_fasilitas_1_note' => $data['ruangan_fasilitas_1_note'] ?? null,
                'ruangan_fasilitas_2_check' => $data['ruangan_fasilitas_2_check'] ?? null,
                'ruangan_fasilitas_2_note' => $data['ruangan_fasilitas_2_note'] ?? null,
                'ruangan_fasilitas_3_check' => $data['ruangan_fasilitas_3_check'] ?? null,
                'ruangan_fasilitas_3_note' => $data['ruangan_fasilitas_3_note'] ?? null,
                'ruangan_fasilitas_4_check' => $data['ruangan_fasilitas_4_check'] ?? null,
                'ruangan_fasilitas_4_note' => $data['ruangan_fasilitas_4_note'] ?? null,

                // 2. Lantai Kerja
                'lantai_kerja_1_check' => $data['lantai_kerja_1_check'] ?? null,
                'lantai_kerja_1_note' => $data['lantai_kerja_1_note'] ?? null,

                // 3. Peralatan Kerja
                'peralatan_kerja_1_check' => $data['peralatan_kerja_1_check'] ?? null,
                'peralatan_kerja_1_note' => $data['peralatan_kerja_1_note'] ?? null,

                // 4. Electrical
                'electrical_1_check' => $data['electrical_1_check'] ?? null,
                'electrical_1_note' => $data['electrical_1_note'] ?? null,
                'electrical_2_check' => $data['electrical_2_check'] ?? null,
                'electrical_2_note' => $data['electrical_2_note'] ?? null,
                'electrical_3_check' => $data['electrical_3_check'] ?? null,
                'electrical_3_note' => $data['electrical_3_note'] ?? null,
                'electrical_4_check' => $data['electrical_4_check'] ?? null,
                'electrical_4_note' => $data['electrical_4_note'] ?? null,

                // 5. Sistem Loto
                'sistem_loto_1_check' => $data['sistem_loto_1_check'] ?? null,
                'sistem_loto_1_note' => $data['sistem_loto_1_note'] ?? null,
                'sistem_loto_2_check' => $data['sistem_loto_2_check'] ?? null,
                'sistem_loto_2_note' => $data['sistem_loto_2_note'] ?? null,

                // 6. Sparepart Bekas (Bisa Dipakai)
                'sparepart_bekas_1_check' => $data['sparepart_bekas_1_check'] ?? null,
                'sparepart_bekas_1_note' => $data['sparepart_bekas_1_note'] ?? null,

                // 7. APAR
                'apar_1_check' => $data['apar_1_check'] ?? null,
                'apar_1_note' => $data['apar_1_note'] ?? null,
                'apar_2_check' => $data['apar_2_check'] ?? null,
                'apar_2_note' => $data['apar_2_note'] ?? null,
                'apar_3_check' => $data['apar_3_check'] ?? null,
                'apar_3_note' => $data['apar_3_note'] ?? null,
                'apar_4_check' => $data['apar_4_check'] ?? null,
                'apar_4_note' => $data['apar_4_note'] ?? null,

                // 8. Rambu-rambu Bahaya
                'rambu_bahaya_1_check' => $data['rambu_bahaya_1_check'] ?? null,
                'rambu_bahaya_1_note' => $data['rambu_bahaya_1_note'] ?? null,

                // 9. Tempat Sampah Domestik
                'sampah_domestik_1_check' => $data['sampah_domestik_1_check'] ?? null,
                'sampah_domestik_1_note' => $data['sampah_domestik_1_note'] ?? null,
                'sampah_domestik_2_check' => $data['sampah_domestik_2_check'] ?? null,
                'sampah_domestik_2_note' => $data['sampah_domestik_2_note'] ?? null,

                // 10. Generator Listrik
                'generator_listrik_1_check' => $data['generator_listrik_1_check'] ?? null,
                'generator_listrik_1_note' => $data['generator_listrik_1_note'] ?? null,
                'generator_listrik_2_check' => $data['generator_listrik_2_check'] ?? null,
                'generator_listrik_2_note' => $data['generator_listrik_2_note'] ?? null,

                // 11. Limbah B3
                'limbah_b3_1_check' => $data['limbah_b3_1_check'] ?? null,
                'limbah_b3_1_note' => $data['limbah_b3_1_note'] ?? null,
                
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


            KLKHWorkshopElectric::create($dataToInsert);

            return redirect()->route('klkh.workshopelectric')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            KLKHWorkshopElectric::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.workshopelectric')->with('success', 'KLKH berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.workshopelectric')->with('info', nl2br('KLKH gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $el = DB::table('ws_klkh_electric as el')
        ->leftJoin('users as us', 'el.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'el.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'el.diketahui', '=', 'us4.nik')
        ->select(
            'el.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui'
            )
        ->where('el.statusenabled', true)
        ->where('el.uuid', $uuid)->first();

        if($el == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $el;

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

        return view('klkh.workshop-electric.preview', compact('el'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHWorkshopElectric::where('uuid', $uuid)->first();

        try {
            KLKHWorkshopElectric::where('id', $klkh->id)->update([
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
        $klkh =  KLKHWorkshopElectric::where('uuid', $uuid)->first();

        try {
            KLKHWorkshopElectric::where('id', $klkh->id)->update([
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
        $klkh =  KLKHWorkshopElectric::where('uuid', $uuid)->first();

        try {
            KLKHWorkshopElectric::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.workshopelectric')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function cetak($uuid)
    {
        $el = DB::table('ws_klkh_electric as el')
        ->leftJoin('users as us', 'el.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'el.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'el.diketahui', '=', 'us4.nik')
        ->select(
            'el.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui'
            )
        ->where('el.statusenabled', true)
        ->where('el.uuid', $uuid)->first();

        if($el == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $el;

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

        return view('klkh.workshop-electric.cetak', compact('el'));
    }
}
