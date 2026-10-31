<?php

namespace App\Http\Controllers\Dewatering;

use App\Http\Controllers\Controller;
use App\Models\KLKHDewatering;
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

class KLKHDewateringController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeDewatering' => $request->all()]);

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

        $baseQuery = DB::table('dew_klkh_dewatering as ab')
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

        return view('klkh.dewatering.index', compact('ab'));
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

        return view('klkh.dewatering.insert', compact('users'));
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
                    $path = "klkh/dewatering/{$field}";

                    Storage::disk('production_public')->putFileAs($path, $file, $fileName);
                    $dokumentasi[$field] = rtrim(config('app.url'), '/') . "/storage/{$path}/{$fileName}";
                }
            }

            $dataToInsert = [
                'uuid' => (string) Uuid::uuid4(),
                'pic' => Auth::user()->id,
                'statusenabled' => true,
                'lokasi' => $data['lokasi'],
                'perusahaan' => $data['perusahaan'],
                'date' => $data['date'],
                'time' => $data['time'],
                'primer_1_1_check' => $data['primer_1_1_check'] ?? null,
                'primer_1_1_note' => $data['primer_1_1_note'] ?? null,
                'primer_1_2_check' => $data['primer_1_2_check'] ?? null,
                'primer_1_2_note' => $data['primer_1_2_note'] ?? null,
                'primer_2_1_check' => $data['primer_2_1_check'] ?? null,
                'primer_2_1_note' => $data['primer_2_1_note'] ?? null,
                'primer_3_1_check' => $data['primer_3_1_check'] ?? null,
                'primer_3_1_note' => $data['primer_3_1_note'] ?? null,
                'primer_3_2_check' => $data['primer_3_2_check'] ?? null,
                'primer_3_2_note' => $data['primer_3_2_note'] ?? null,
                'primer_3_3_check' => $data['primer_3_3_check'] ?? null,
                'primer_3_3_note' => $data['primer_3_3_note'] ?? null,
                'primer_3_4_check' => $data['primer_3_4_check'] ?? null,
                'primer_3_4_note' => $data['primer_3_4_note'] ?? null,
                'primer_3_5_check' => $data['primer_3_5_check'] ?? null,
                'primer_3_5_note' => $data['primer_3_5_note'] ?? null,
                'primer_3_6_check' => $data['primer_3_6_check'] ?? null,
                'primer_3_6_note' => $data['primer_3_6_note'] ?? null,
                'primer_4_1_check' => $data['primer_4_1_check'] ?? null,
                'primer_4_1_note' => $data['primer_4_1_note'] ?? null,
                'primer_4_2_check' => $data['primer_4_2_check'] ?? null,
                'primer_4_2_note' => $data['primer_4_2_note'] ?? null,
                'primer_4_3_check' => $data['primer_4_3_check'] ?? null,
                'primer_4_3_note' => $data['primer_4_3_note'] ?? null,
                'primer_4_4_check' => $data['primer_4_4_check'] ?? null,
                'primer_4_4_note' => $data['primer_4_4_note'] ?? null,
                'primer_5_1_check' => $data['primer_5_1_check'] ?? null,
                'primer_5_1_note' => $data['primer_5_1_note'] ?? null,
                'primer_5_2_check' => $data['primer_5_2_check'] ?? null,
                'primer_5_2_note' => $data['primer_5_2_note'] ?? null,
                'primer_5_3_check' => $data['primer_5_3_check'] ?? null,
                'primer_5_3_note' => $data['primer_5_3_note'] ?? null,
                'primer_5_4_check' => $data['primer_5_4_check'] ?? null,
                'primer_5_4_note' => $data['primer_5_4_note'] ?? null,
                'primer_5_5_check' => $data['primer_5_5_check'] ?? null,
                'primer_5_5_note' => $data['primer_5_5_note'] ?? null,
                'primer_5_6_check' => $data['primer_5_6_check'] ?? null,
                'primer_5_6_note' => $data['primer_5_6_note'] ?? null,
                'primer_5_7_check' => $data['primer_5_7_check'] ?? null,
                'primer_5_7_note' => $data['primer_5_7_note'] ?? null,
                'primer_6_1_check' => $data['primer_6_1_check'] ?? null,
                'primer_6_1_note' => $data['primer_6_1_note'] ?? null,
                'primer_6_2_check' => $data['primer_6_2_check'] ?? null,
                'primer_6_2_note' => $data['primer_6_2_note'] ?? null,
                'primer_6_3_check' => $data['primer_6_3_check'] ?? null,
                'primer_6_3_note' => $data['primer_6_3_note'] ?? null,
                'primer_6_4_check' => $data['primer_6_4_check'] ?? null,
                'primer_6_4_note' => $data['primer_6_4_note'] ?? null,
                'primer_6_5_check' => $data['primer_6_5_check'] ?? null,
                'primer_6_5_note' => $data['primer_6_5_note'] ?? null,
                'primer_6_6_check' => $data['primer_6_6_check'] ?? null,
                'primer_6_6_note' => $data['primer_6_6_note'] ?? null,
                'primer_7_1_check' => $data['primer_7_1_check'] ?? null,
                'primer_7_1_note' => $data['primer_7_1_note'] ?? null,
                'primer_7_2_check' => $data['primer_7_2_check'] ?? null,
                'primer_7_2_note' => $data['primer_7_2_note'] ?? null,
                'primer_7_3_check' => $data['primer_7_3_check'] ?? null,
                'primer_7_3_note' => $data['primer_7_3_note'] ?? null,
                'primer_8_1_check' => $data['primer_8_1_check'] ?? null,
                'primer_8_1_note' => $data['primer_8_1_note'] ?? null,
                'primer_8_2_check' => $data['primer_8_2_check'] ?? null,
                'primer_8_2_note' => $data['primer_8_2_note'] ?? null,
                'primer_8_3_check' => $data['primer_8_3_check'] ?? null,
                'primer_8_3_note' => $data['primer_8_3_note'] ?? null,
                'primer_8_4_check' => $data['primer_8_4_check'] ?? null,
                'primer_8_4_note' => $data['primer_8_4_note'] ?? null,
                'primer_8_5_check' => $data['primer_8_5_check'] ?? null,
                'primer_8_5_note' => $data['primer_8_5_note'] ?? null,
                'primer_8_6_check' => $data['primer_8_6_check'] ?? null,
                'primer_8_6_note' => $data['primer_8_6_note'] ?? null,
                'primer_8_7_check' => $data['primer_8_7_check'] ?? null,
                'primer_8_7_note' => $data['primer_8_7_note'] ?? null,
                'primer_8_8_check' => $data['primer_8_8_check'] ?? null,
                'primer_8_8_note' => $data['primer_8_8_note'] ?? null,
                'primer_8_9_check' => $data['primer_8_9_check'] ?? null,
                'primer_8_9_note' => $data['primer_8_9_note'] ?? null,
                'primer_8_10_check' => $data['primer_8_10_check'] ?? null,
                'primer_8_10_note' => $data['primer_8_10_note'] ?? null,
                'booster_1_1_check' => $data['booster_1_1_check'] ?? null,
                'booster_1_1_note' => $data['booster_1_1_note'] ?? null,
                'booster_2_1_check' => $data['booster_2_1_check'] ?? null,
                'booster_2_1_note' => $data['booster_2_1_note'] ?? null,
                'booster_2_2_check' => $data['booster_2_2_check'] ?? null,
                'booster_2_2_note' => $data['booster_2_2_note'] ?? null,
                'booster_2_3_check' => $data['booster_2_3_check'] ?? null,
                'booster_2_3_note' => $data['booster_2_3_note'] ?? null,
                'booster_2_4_check' => $data['booster_2_4_check'] ?? null,
                'booster_2_4_note' => $data['booster_2_4_note'] ?? null,
                'booster_2_5_check' => $data['booster_2_5_check'] ?? null,
                'booster_2_5_note' => $data['booster_2_5_note'] ?? null,
                'booster_2_6_check' => $data['booster_2_6_check'] ?? null,
                'booster_2_6_note' => $data['booster_2_6_note'] ?? null,
                'booster_3_1_check' => $data['booster_3_1_check'] ?? null,
                'booster_3_1_note' => $data['booster_3_1_note'] ?? null,
                'booster_3_2_check' => $data['booster_3_2_check'] ?? null,
                'booster_3_2_note' => $data['booster_3_2_note'] ?? null,
                'booster_3_3_check' => $data['booster_3_3_check'] ?? null,
                'booster_3_3_note' => $data['booster_3_3_note'] ?? null,
                'booster_3_4_check' => $data['booster_3_4_check'] ?? null,
                'booster_3_4_note' => $data['booster_3_4_note'] ?? null,
                'booster_4_1_check' => $data['booster_4_1_check'] ?? null,
                'booster_4_1_note' => $data['booster_4_1_note'] ?? null,
                'booster_4_2_check' => $data['booster_4_2_check'] ?? null,
                'booster_4_2_note' => $data['booster_4_2_note'] ?? null,
                'booster_5_1_check' => $data['booster_5_1_check'] ?? null,
                'booster_5_1_note' => $data['booster_5_1_note'] ?? null,
                'booster_5_2_check' => $data['booster_5_2_check'] ?? null,
                'booster_5_2_note' => $data['booster_5_2_note'] ?? null,
                'booster_5_3_check' => $data['booster_5_3_check'] ?? null,
                'booster_5_3_note' => $data['booster_5_3_note'] ?? null,
                'booster_5_4_check' => $data['booster_5_4_check'] ?? null,
                'booster_5_4_note' => $data['booster_5_4_note'] ?? null,
                'booster_5_5_check' => $data['booster_5_5_check'] ?? null,
                'booster_5_5_note' => $data['booster_5_5_note'] ?? null,
                'hdpe_1_1_check' => $data['hdpe_1_1_check'] ?? null,
                'hdpe_1_1_note' => $data['hdpe_1_1_note'] ?? null,
                'hdpe_2_1_check' => $data['hdpe_2_1_check'] ?? null,
                'hdpe_2_1_note' => $data['hdpe_2_1_note'] ?? null,
                'hdpe_2_2_check' => $data['hdpe_2_2_check'] ?? null,
                'hdpe_2_2_note' => $data['hdpe_2_2_note'] ?? null,
                'hdpe_2_3_check' => $data['hdpe_2_3_check'] ?? null,
                'hdpe_2_3_note' => $data['hdpe_2_3_note'] ?? null,
                'hdpe_3_1_check' => $data['hdpe_3_1_check'] ?? null,
                'hdpe_3_1_note' => $data['hdpe_3_1_note'] ?? null,
                'hdpe_3_2_check' => $data['hdpe_3_2_check'] ?? null,
                'hdpe_3_2_note' => $data['hdpe_3_2_note'] ?? null,
                'hdpe_3_3_check' => $data['hdpe_3_3_check'] ?? null,
                'hdpe_3_3_note' => $data['hdpe_3_3_note'] ?? null,

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


            KLKHDewatering::create($dataToInsert);

            return redirect()->route('klkh.dewatering')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            KLKHDewatering::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.dewatering')->with('success', 'KLKH berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.dewatering')->with('info', nl2br('KLKH gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ab = DB::table('dew_klkh_dewatering as ab')
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

        return view('klkh.dewatering.preview', compact('ab'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHDewatering::where('uuid', $uuid)->first();

        try {
            KLKHDewatering::where('id', $klkh->id)->update([
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
        $klkh =  KLKHDewatering::where('uuid', $uuid)->first();

        try {
            KLKHDewatering::where('id', $klkh->id)->update([
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
        $klkh =  KLKHDewatering::where('uuid', $uuid)->first();

        try {
            KLKHDewatering::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.dewatering')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }
    
    public function verifiedDisetujui(Request $request, $uuid)
    {
        $klkh =  KLKHDewatering::where('uuid', $uuid)->first();

        try {
            KLKHDewatering::where('id', $klkh->id)->update([
                'verified_disetujui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_disetujui' => $request->catatan_verified_disetujui,
                'date_verified_disetujui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.dewatering')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function cetak($uuid)
    {
        $ab = DB::table('dew_klkh_dewatering as ab')
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

        return view('klkh.dewatering.cetak', compact('ab'));
    }
}
