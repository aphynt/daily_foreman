<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Models\KLKHKantorWorkshop;
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

class KLKHKantorWorkshopController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeKantorWorkshop' => $request->all()]);

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

        $baseQuery = DB::table('ws_klkh_kantorworkshop as ws')
            ->leftJoin('users as us', 'ws.pic', '=', 'us.id')
            ->leftJoin('users as us3', 'ws.pengawas', '=', 'us3.nik')
            ->leftJoin('users as us4', 'ws.diketahui', '=', 'us4.nik')
            ->select(
                'ws.id',
                'ws.uuid',
                'ws.pic as pic_id',
                'us.name as pic',
                'us.nik as nik_pic',
                DB::raw('CONVERT(varchar, ws.created_at, 120) as tanggal_pembuatan'),
                'ws.statusenabled',
                'ws.lokasi',
                'ws.pengawas as nik_pengawas',
                'us3.name as nama_pengawas',
                'ws.diketahui as nik_diketahui',
                'us4.name as nama_diketahui',
                'ws.verified_pengawas',
                'ws.verified_diketahui',
                'ws.date',
                'ws.time'
            )
            ->where('ws.statusenabled', 1)
            ->whereBetween(
                DB::raw('CONVERT(varchar, ws.date, 23)'),
                [$startTimeFormatted, $endTimeFormatted]
            );

        if (!in_array($user->nik, $nikBypass)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('ws.pengawas', $user->nik)
                    ->orWhere('ws.diketahui', $user->nik);
            });
        }

        $ws = $baseQuery->get();

        return view('klkh.kantor-workshop.index', compact('ws'));
    }

    public function insert()
    {
        $diketahui = User::where('departemen_id', 11)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $users = [
            'diketahui' => $diketahui,
        ];

        return view('klkh.kantor-workshop.insert', compact('users'));
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
                    $path = "klkh/kantorworkshop/{$field}";

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
                // Bangunan dan Fasilitas
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
                // Lantai Kerja
                'lantai_kerja_1_check' => $data['lantai_kerja_1_check'] ?? null,
                'lantai_kerja_1_note' => $data['lantai_kerja_1_note'] ?? null,
                // Peralatan Kerja
                'peralatan_kerja_1_check' => $data['peralatan_kerja_1_check'] ?? null,
                'peralatan_kerja_1_note' => $data['peralatan_kerja_1_note'] ?? null,
                // Electric
                'electric_1_check' => $data['electric_1_check'] ?? null,
                'electric_1_note' => $data['electric_1_note'] ?? null,
                'electric_2_check' => $data['electric_2_check'] ?? null,
                'electric_2_note' => $data['electric_2_note'] ?? null,
                'electric_3_check' => $data['electric_3_check'] ?? null,
                'electric_3_note' => $data['electric_3_note'] ?? null,
                'electric_4_check' => $data['electric_4_check'] ?? null,
                'electric_4_note' => $data['electric_4_note'] ?? null,
                // APAR
                'apar_1_check' => $data['apar_1_check'] ?? null,
                'apar_1_note' => $data['apar_1_note'] ?? null,
                'apar_2_check' => $data['apar_2_check'] ?? null,
                'apar_2_note' => $data['apar_2_note'] ?? null,
                'apar_3_check' => $data['apar_3_check'] ?? null,
                'apar_3_note' => $data['apar_3_note'] ?? null,
                'apar_4_check' => $data['apar_4_check'] ?? null,
                'apar_4_note' => $data['apar_4_note'] ?? null,
                // Rambu-rambu Bahaya
                'rambu_bahaya_1_check' => $data['rambu_bahaya_1_check'] ?? null,
                'rambu_bahaya_1_note' => $data['rambu_bahaya_1_note'] ?? null,
                // Tempat Sampah Domestik
                'sampah_domestik_1_check' => $data['sampah_domestik_1_check'] ?? null,
                'sampah_domestik_1_note' => $data['sampah_domestik_1_note'] ?? null,
                'sampah_domestik_2_check' => $data['sampah_domestik_2_check'] ?? null,
                'sampah_domestik_2_note' => $data['sampah_domestik_2_note'] ?? null,
                'sampah_domestik_3_check' => $data['sampah_domestik_3_check'] ?? null,
                'sampah_domestik_3_note' => $data['sampah_domestik_3_note'] ?? null,
                // Pemadam Hydran
                'pemadam_hydran_1_check' => $data['pemadam_hydran_1_check'] ?? null,
                'pemadam_hydran_1_note' => $data['pemadam_hydran_1_note'] ?? null,
                'pemadam_hydran_2_check' => $data['pemadam_hydran_2_check'] ?? null,
                'pemadam_hydran_2_note' => $data['pemadam_hydran_2_note'] ?? null,
                'pemadam_hydran_3_check' => $data['pemadam_hydran_3_check'] ?? null,
                'pemadam_hydran_3_note' => $data['pemadam_hydran_3_note'] ?? null,
                'pemadam_hydran_4_check' => $data['pemadam_hydran_4_check'] ?? null,
                'pemadam_hydran_4_note' => $data['pemadam_hydran_4_note'] ?? null,
                // Paparan Debu
                'paparan_debu_1_check' => $data['paparan_debu_1_check'] ?? null,
                'paparan_debu_1_note' => $data['paparan_debu_1_note'] ?? null,
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


            KLKHKantorWorkshop::create($dataToInsert);

            return redirect()->route('klkh.kantorworkshop')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            KLKHKantorWorkshop::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.kantorworkshop')->with('success', 'KLKH berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.kantorworkshop')->with('info', nl2br('KLKH gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ws = DB::table('ws_klkh_kantorworkshop as ws')
        ->leftJoin('users as us', 'ws.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'ws.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ws.diketahui', '=', 'us4.nik')
        ->select(
            'ws.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui'
            )
        ->where('ws.statusenabled', true)
        ->where('ws.uuid', $uuid)->first();

        if($ws == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $ws;

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

        return view('klkh.kantor-workshop.preview', compact('ws'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHKantorWorkshop::where('uuid', $uuid)->first();

        try {
            KLKHKantorWorkshop::where('id', $klkh->id)->update([
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
        $klkh =  KLKHKantorWorkshop::where('uuid', $uuid)->first();

        try {
            KLKHKantorWorkshop::where('id', $klkh->id)->update([
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
        $klkh =  KLKHKantorWorkshop::where('uuid', $uuid)->first();

        try {
            KLKHKantorWorkshop::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.kantorworkshop')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function cetak($uuid)
    {
        $ws = DB::table('ws_klkh_kantorworkshop as ws')
        ->leftJoin('users as us', 'ws.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'ws.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ws.diketahui', '=', 'us4.nik')
        ->select(
            'ws.*',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui'
            )
        ->where('ws.statusenabled', true)
        ->where('ws.uuid', $uuid)->first();

        if($ws == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $ws;

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

        return view('klkh.kantor-workshop.cetak', compact('ws'));
    }
}
