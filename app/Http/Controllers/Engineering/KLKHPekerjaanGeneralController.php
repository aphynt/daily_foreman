<?php

namespace App\Http\Controllers\Engineering;

use App\Http\Controllers\Controller;
use App\Models\KLKHPekerjaanGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use DateTime;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;

class KLKHPekerjaanGeneralController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimePekerjaanGeneral' => $request->all()]);

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

        $baseQuery = DB::table('eng_klkh_pekerjaangeneral as ab')
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

        return view('klkh.pekerjaan-general.index', compact('ab'));
    }

    public function insert()
    {
        $diketahui = User::where('departemen_id', 2)
        ->whereIn('role', ['SUPERVISOR'])->where('statusenabled', true)->get();

        $disetujui = User::whereIn('role', ['SUPERINTENDENT', 'MANAGER'])->where('statusenabled', true)->get();
        $shift = Shift::where('statusenabled', true)->get();
        $departemen = Departemen::where('statusenabled', true)->get();

        $users = [
            'departemen' => $departemen,
            'shift' => $shift,
            'diketahui' => $diketahui,
            'disetujui' => $disetujui,
        ];

        return view('klkh.pekerjaan-general.insert', compact('users'));
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
                    $path = "klkh/pekerjaangeneral/{$field}";

                    Storage::disk('production_public')->putFileAs($path, $file, $fileName);
                    $dokumentasi[$field] = rtrim(config('app.url'), '/') . "/storage/{$path}/{$fileName}";
                }
            }

            $dataToInsert = [
                'uuid' => (string) Uuid::uuid4(),
                'pic' => Auth::user()->id,
                'statusenabled' => true,
                'departemen' => $data['departemen'],
                'shift' => $data['shift'],
                'lokasi' => $data['lokasi'],
                'date' => $data['date'],
                'time' => $data['time'],

                'perbaikan_jalan_1_check' => $data['perbaikan_jalan_1_check'] ?? null,
                'perbaikan_jalan_1_note' => $data['perbaikan_jalan_1_note'] ?? null,

                'perbaikan_jalan_2_check' => $data['perbaikan_jalan_2_check'] ?? null,
                'perbaikan_jalan_2_note' => $data['perbaikan_jalan_2_note'] ?? null,

                'perbaikan_jalan_3_check' => $data['perbaikan_jalan_3_check'] ?? null,
                'perbaikan_jalan_3_note' => $data['perbaikan_jalan_3_note'] ?? null,

                'perbaikan_jalan_4_check' => $data['perbaikan_jalan_4_check'] ?? null,
                'perbaikan_jalan_4_note' => $data['perbaikan_jalan_4_note'] ?? null,

                'perbaikan_jalan_5_check' => $data['perbaikan_jalan_5_check'] ?? null,
                'perbaikan_jalan_5_note' => $data['perbaikan_jalan_5_note'] ?? null,

                'perbaikan_jalan_6_check' => $data['perbaikan_jalan_6_check'] ?? null,
                'perbaikan_jalan_6_note' => $data['perbaikan_jalan_6_note'] ?? null,

                'perbaikan_jalan_7_check' => $data['perbaikan_jalan_7_check'] ?? null,
                'perbaikan_jalan_7_note' => $data['perbaikan_jalan_7_note'] ?? null,

                'perbaikan_jalan_8_check' => $data['perbaikan_jalan_8_check'] ?? null,
                'perbaikan_jalan_8_note' => $data['perbaikan_jalan_8_note'] ?? null,

                'perbaikan_jalan_9_check' => $data['perbaikan_jalan_9_check'] ?? null,
                'perbaikan_jalan_9_note' => $data['perbaikan_jalan_9_note'] ?? null,

                'perbaikan_jalan_10_check' => $data['perbaikan_jalan_10_check'] ?? null,
                'perbaikan_jalan_10_note' => $data['perbaikan_jalan_10_note'] ?? null,

                'perbaikan_jalan_11_check' => $data['perbaikan_jalan_11_check'] ?? null,
                'perbaikan_jalan_11_note' => $data['perbaikan_jalan_11_note'] ?? null,

                'perbaikan_jalan_12_check' => $data['perbaikan_jalan_12_check'] ?? null,
                'perbaikan_jalan_12_note' => $data['perbaikan_jalan_12_note'] ?? null,

                'perbaikan_jalan_13_check' => $data['perbaikan_jalan_13_check'] ?? null,
                'perbaikan_jalan_13_note' => $data['perbaikan_jalan_13_note'] ?? null,

                'perbaikan_jalan_14_check' => $data['perbaikan_jalan_14_check'] ?? null,
                'perbaikan_jalan_14_note' => $data['perbaikan_jalan_14_note'] ?? null,

                'perbaikan_lereng_1_check' => $data['perbaikan_lereng_1_check'] ?? null,
                'perbaikan_lereng_1_note' => $data['perbaikan_lereng_1_note'] ?? null,

                'perbaikan_lereng_2_check' => $data['perbaikan_lereng_2_check'] ?? null,
                'perbaikan_lereng_2_note' => $data['perbaikan_lereng_2_note'] ?? null,

                'perbaikan_lereng_3_check' => $data['perbaikan_lereng_3_check'] ?? null,
                'perbaikan_lereng_3_note' => $data['perbaikan_lereng_3_note'] ?? null,

                'perbaikan_lereng_4_check' => $data['perbaikan_lereng_4_check'] ?? null,
                'perbaikan_lereng_4_note' => $data['perbaikan_lereng_4_note'] ?? null,

                'perbaikan_lereng_5_check' => $data['perbaikan_lereng_5_check'] ?? null,
                'perbaikan_lereng_5_note' => $data['perbaikan_lereng_5_note'] ?? null,

                'perbaikan_lereng_6_check' => $data['perbaikan_lereng_6_check'] ?? null,
                'perbaikan_lereng_6_note' => $data['perbaikan_lereng_6_note'] ?? null,

                'perbaikan_lereng_7_check' => $data['perbaikan_lereng_7_check'] ?? null,
                'perbaikan_lereng_7_note' => $data['perbaikan_lereng_7_note'] ?? null,

                'perbaikan_lereng_8_check' => $data['perbaikan_lereng_8_check'] ?? null,
                'perbaikan_lereng_8_note' => $data['perbaikan_lereng_8_note'] ?? null,

                'perbaikan_lereng_9_check' => $data['perbaikan_lereng_9_check'] ?? null,
                'perbaikan_lereng_9_note' => $data['perbaikan_lereng_9_note'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,

                'pengawas' => Auth::user()->nik,
                'verified_pengawas' => Auth::user()->nik,
                'date_verified_pengawas' => Carbon::now(),
                'catatan_verified_pengawas' => $data['catatan_verified_pengawas'] ?? null,

                'dokumentasi_1' => $dokumentasi['dokumentasi_1'] ?? null,
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'] ?? null,

                'diketahui' => $data['diketahui'] ?? null,
                'disetujui' => $data['disetujui'] ?? null,
            ];


            KLKHPekerjaanGeneral::create($dataToInsert);

            return redirect()->route('klkh.pekerjaangeneral')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            KLKHPekerjaanGeneral::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.pekerjaangeneral')->with('success', 'KLKH berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.pekerjaangeneral')->with('info', nl2br('KLKH gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ab = DB::table('eng_klkh_pekerjaangeneral as ab')
        ->leftJoin('ref_departemen as dep', 'ab.departemen', '=', 'dep.id')
        ->leftJoin('ref_shift as sh', 'ab.shift', '=', 'sh.id')
        ->leftJoin('users as us', 'ab.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'ab.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ab.diketahui', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ab.disetujui', '=', 'us5.nik')
        ->select(
            'ab.*',
            'sh.keterangan as nama_shift',
            'dep.keterangan as nama_departemen',
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

        return view('klkh.pekerjaan-general.preview', compact('ab'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHPekerjaanGeneral::where('uuid', $uuid)->first();

        try {
            KLKHPekerjaanGeneral::where('id', $klkh->id)->update([
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
        $klkh =  KLKHPekerjaanGeneral::where('uuid', $uuid)->first();

        try {
            KLKHPekerjaanGeneral::where('id', $klkh->id)->update([
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
        $klkh =  KLKHPekerjaanGeneral::where('uuid', $uuid)->first();

        try {
            KLKHPekerjaanGeneral::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.pekerjaangeneral')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedDisetujui(Request $request, $uuid)
    {
        $klkh =  KLKHPekerjaanGeneral::where('uuid', $uuid)->first();

        try {
            KLKHPekerjaanGeneral::where('id', $klkh->id)->update([
                'verified_disetujui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_disetujui' => $request->catatan_verified_disetujui,
                'date_verified_disetujui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.pekerjaangeneral')->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function cetak($uuid)
    {
        $ab = DB::table('eng_klkh_pekerjaangeneral as ab')
        ->leftJoin('ref_departemen as dep', 'ab.departemen', '=', 'dep.id')
        ->leftJoin('ref_shift as sh', 'ab.shift', '=', 'sh.id')
        ->leftJoin('users as us', 'ab.pic', '=', 'us.id')
        ->leftJoin('users as us3', 'ab.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ab.diketahui', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ab.disetujui', '=', 'us5.nik')
        ->select(
            'ab.*',
            'sh.keterangan as nama_shift',
            'dep.keterangan as nama_departemen',
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

        return view('klkh.pekerjaan-general.cetak', compact('ab'));
    }
}
