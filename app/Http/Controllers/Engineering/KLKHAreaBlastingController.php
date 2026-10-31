<?php

namespace App\Http\Controllers\Engineering;

use App\Http\Controllers\Controller;
use App\Models\KLKHAreaBlasting;
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

class KLKHAreaBlastingController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeAreaBlasting' => $request->all()]);

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

        $baseQuery = DB::table('eng_klkh_areablasting as ab')
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

        return view('klkh.area-blasting.index', compact('ab'));
    }

    public function insert()
    {
        $diketahui = User::where('departemen_id', 2)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $disetujui = User::where('departemen_id', 2)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $users = [
            'diketahui' => $diketahui,
            'disetujui' => $disetujui,
        ];

        return view('klkh.area-blasting.insert', compact('users'));
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
                    $path = "klkh/areablasting/{$field}";

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
                // 1. Kondisi Material Gantung
                'kondisi_lokasi_1_check' => $data['kondisi_lokasi_1_check'] ?? null,
                'kondisi_lokasi_1_note' => $data['kondisi_lokasi_1_note'] ?? null,
                // 2. Aktivitas Loading Coal / Loading OB DT
                'kondisi_lokasi_2_check' => $data['kondisi_lokasi_2_check'] ?? null,
                'kondisi_lokasi_2_note' => $data['kondisi_lokasi_2_note'] ?? null,
                // 3. Aktivitas Loading OB Unit HD
                'kondisi_lokasi_3_check' => $data['kondisi_lokasi_3_check'] ?? null,
                'kondisi_lokasi_3_note' => $data['kondisi_lokasi_3_note'] ?? null,
                // 4. Unit Break Down dan Tower Lamp
                'kondisi_lokasi_4_check' => $data['kondisi_lokasi_4_check'] ?? null,
                'kondisi_lokasi_4_note' => $data['kondisi_lokasi_4_note'] ?? null,
                // 5. Genangan Air / Kantong Air
                'kondisi_lokasi_5_check' => $data['kondisi_lokasi_5_check'] ?? null,
                'kondisi_lokasi_5_note' => $data['kondisi_lokasi_5_note'] ?? null,
                // 6. Kegiatan Coring Eksplorasi
                'kondisi_lokasi_6_check' => $data['kondisi_lokasi_6_check'] ?? null,
                'kondisi_lokasi_6_note' => $data['kondisi_lokasi_6_note'] ?? null,
                // 7. Pemompaan Aktif di Kolam Air
                'kondisi_lokasi_7_check' => $data['kondisi_lokasi_7_check'] ?? null,
                'kondisi_lokasi_7_note' => $data['kondisi_lokasi_7_note'] ?? null,
                // 8. Pekerjaan Penirisan Air
                'kondisi_lokasi_8_check' => $data['kondisi_lokasi_8_check'] ?? null,
                'kondisi_lokasi_8_note' => $data['kondisi_lokasi_8_note'] ?? null,
                // 9. Bangunan dalam Radius Blasting Kurang dari 500 Meter
                'kondisi_lokasi_9_check' => $data['kondisi_lokasi_9_check'] ?? null,
                'kondisi_lokasi_9_note' => $data['kondisi_lokasi_9_note'] ?? null,
                // 10. Pengangkutan DT Batu Bara ke Stock Pile
                'kondisi_lokasi_10_check' => $data['kondisi_lokasi_10_check'] ?? null,
                'kondisi_lokasi_10_note' => $data['kondisi_lokasi_10_note'] ?? null,
                // 11. Penimbunan Batu Bara di Stock Room Coal
                'kondisi_lokasi_11_check' => $data['kondisi_lokasi_11_check'] ?? null,
                'kondisi_lokasi_11_note' => $data['kondisi_lokasi_11_note'] ?? null,
                // 12. Lokasi Parkir LV Support Drill & Blast
                'kondisi_lokasi_12_check' => $data['kondisi_lokasi_12_check'] ?? null,
                'kondisi_lokasi_12_note' => $data['kondisi_lokasi_12_note'] ?? null,
                // 13. Aktivitas Perakitan Unit
                'kondisi_lokasi_13_check' => $data['kondisi_lokasi_13_check'] ?? null,
                'kondisi_lokasi_13_note' => $data['kondisi_lokasi_13_note'] ?? null,
                // 14. Lokasi Perbaikan Unit
                'kondisi_lokasi_14_check' => $data['kondisi_lokasi_14_check'] ?? null,
                'kondisi_lokasi_14_note' => $data['kondisi_lokasi_14_note'] ?? null,
                // 15. Pos Checker Dekat Lokasi Blasting
                'kondisi_lokasi_15_check' => $data['kondisi_lokasi_15_check'] ?? null,
                'kondisi_lokasi_15_note' => $data['kondisi_lokasi_15_note'] ?? null,
                // 16. Tempat Pemberhentian DT
                'kondisi_lokasi_16_check' => $data['kondisi_lokasi_16_check'] ?? null,
                'kondisi_lokasi_16_note' => $data['kondisi_lokasi_16_note'] ?? null,
                // 17. Kontainer Tempat Peristirahatan Operator
                'kondisi_lokasi_17_check' => $data['kondisi_lokasi_17_check'] ?? null,
                'kondisi_lokasi_17_note' => $data['kondisi_lokasi_17_note'] ?? null,
                // 18. Akses Jalan Hauling DT / HD
                'kondisi_lokasi_18_check' => $data['kondisi_lokasi_18_check'] ?? null,
                'kondisi_lokasi_18_note' => $data['kondisi_lokasi_18_note'] ?? null,
                // 19. Lokasi Berkumpul Pengawas Lapangan
                'kondisi_lokasi_19_check' => $data['kondisi_lokasi_19_check'] ?? null,
                'kondisi_lokasi_19_note' => $data['kondisi_lokasi_19_note'] ?? null,
                // 20. Lokasi Pengisian Fuel
                'kondisi_lokasi_20_check' => $data['kondisi_lokasi_20_check'] ?? null,
                'kondisi_lokasi_20_note' => $data['kondisi_lokasi_20_note'] ?? null,
                // 21. Zona Kritis Geotek dalam Radius Kurang dari 500 Meter
                'kondisi_lokasi_21_check' => $data['kondisi_lokasi_21_check'] ?? null,
                'kondisi_lokasi_21_note' => $data['kondisi_lokasi_21_note'] ?? null,
                // Informasi Tambahan
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


            KLKHAreaBlasting::create($dataToInsert);

            return redirect()->route('klkh.areablasting')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            KLKHAreaBlasting::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.areablasting')->with('success', 'KLKH berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.areablasting')->with('info', nl2br('KLKH gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ab = DB::table('eng_klkh_areablasting as ab')
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

        return view('klkh.area-blasting.preview', compact('ab'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHAreaBlasting::where('uuid', $uuid)->first();

        try {
            KLKHAreaBlasting::where('id', $klkh->id)->update([
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
        $klkh =  KLKHAreaBlasting::where('uuid', $uuid)->first();

        try {
            KLKHAreaBlasting::where('id', $klkh->id)->update([
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
        $klkh =  KLKHAreaBlasting::where('uuid', $uuid)->first();

        try {
            KLKHAreaBlasting::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.areablasting')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }
    
    public function verifiedDisetujui(Request $request, $uuid)
    {
        $klkh =  KLKHAreaBlasting::where('uuid', $uuid)->first();

        try {
            KLKHAreaBlasting::where('id', $klkh->id)->update([
                'verified_disetujui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_disetujui' => $request->catatan_verified_disetujui,
                'date_verified_disetujui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.areablasting')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function cetak($uuid)
    {
        $ab = DB::table('eng_klkh_areablasting as ab')
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

        return view('klkh.area-blasting.cetak', compact('ab'));
    }
}
