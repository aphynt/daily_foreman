<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\InspeksiGudangB3;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;

class InspeksiGudangB3Controller extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiGudangB3' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_gudangb3 as b3')
        ->leftJoin('users as us', 'b3.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'b3.dibuat', '=', 'us1.nik')
        ->leftJoin('users as us2', 'b3.diperiksa', '=', 'us2.nik')
        ->select(
            'b3.id',
            'b3.uuid',
            'b3.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, b3.created_at, 120) as tanggal_pembuatan'),
            'b3.statusenabled',
            'b3.dibuat as nik_dibuat',
            'us1.name as nama_dibuat',
            'b3.verified_dibuat',
            'b3.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'b3.verified_diperiksa',
            'b3.lokasi',
            'b3.tanggal_inspeksi',
            'b3.jam_inspeksi',
        )
        ->where('b3.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, b3.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        $user = Auth::user();
        $safetyRoles = ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'];

        if (!in_array($user->role, $safetyRoles)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('b3.pic', $user->id)
                    ->orWhere('b3.inspektor', $user->nik)
                    ->orWhere('b3.pendamping', $user->nik);
            });
        }
        $b3 = $baseQuery->get();


        return view('inspeksi.gudang-b3.index', compact('b3'));
    }

    public function insert()
    {

        $inspektor = User::where(function ($query) {
        $query->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT', 'MANAGEMENT'])
                ->orWhereIn('id', [
                    8043, 8044, 8045, 8046, 8047, 8048, 8049,
                    8050, 8051, 8052, 8053, 8054, 8055, 8056, 8058, 8059, 8062,
                    8063, 8066, 8067, 8068, 8069, 8070
                ]);
        })
        ->where('statusenabled', true)
        ->orderBy('name')->get();

        $users = [
            'inspektor' => $inspektor,
        ];

        return view('inspeksi.gudang-b3.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {
            $dokumentasi = [];
            for ($i = 1; $i <= 3; $i++) {
                $field = "dokumentasi_{$i}";
                $dokumentasi[$field] = null;

                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $i . '_' . $file->getClientOriginalName();
                    $path = "inspeksi/gudangb3/{$field}";

                    Storage::disk('production_public')->putFileAs($path, $file, $fileName);
                    $dokumentasi[$field] = rtrim(config('app.url'), '/') . "/storage/{$path}/{$fileName}";
                }
            }
            $data = $request->all();
            // dd($data);

            $dataToInsert = [

                'uuid'              => (string) Uuid::uuid4(),
                'pic'               => Auth::user()->id,
                'statusenabled'     => true,

                'lokasi'            => $data['lokasi'] ?? null,
                'tanggal_inspeksi'  => $data['tanggal_inspeksi'] ?? null,
                'jam_inspeksi'      => $data['jam_inspeksi'] ?? null,

                'kemasan_11_check'  => $data['kemasan_11_check'] ?? null,
                'kemasan_11_action' => $data['kemasan_11_action'] ?? null,
                'kemasan_11_due'    => $data['kemasan_11_due'] ?? null,
                'kemasan_11_foto'   => $data['kemasan_11_foto'] ?? null,

                'kemasan_12_check'  => $data['kemasan_12_check'] ?? null,
                'kemasan_12_action' => $data['kemasan_12_action'] ?? null,
                'kemasan_12_due'    => $data['kemasan_12_due'] ?? null,
                'kemasan_12_foto'   => $data['kemasan_12_foto'] ?? null,

                'kemasan_13_check'  => $data['kemasan_13_check'] ?? null,
                'kemasan_13_action' => $data['kemasan_13_action'] ?? null,
                'kemasan_13_due'    => $data['kemasan_13_due'] ?? null,
                'kemasan_13_foto'   => $data['kemasan_13_foto'] ?? null,

                'kemasan_14_check'  => $data['kemasan_14_check'] ?? null,
                'kemasan_14_action' => $data['kemasan_14_action'] ?? null,
                'kemasan_14_due'    => $data['kemasan_14_due'] ?? null,
                'kemasan_14_foto'   => $data['kemasan_14_foto'] ?? null,

                'kemasan_15_check'  => $data['kemasan_15_check'] ?? null,
                'kemasan_15_action' => $data['kemasan_15_action'] ?? null,
                'kemasan_15_due'    => $data['kemasan_15_due'] ?? null,
                'kemasan_15_foto'   => $data['kemasan_15_foto'] ?? null,

                'kemasan_16_check'  => $data['kemasan_16_check'] ?? null,
                'kemasan_16_action' => $data['kemasan_16_action'] ?? null,
                'kemasan_16_due'    => $data['kemasan_16_due'] ?? null,
                'kemasan_16_foto'   => $data['kemasan_16_foto'] ?? null,

                'kemasan_17_check'  => $data['kemasan_17_check'] ?? null,
                'kemasan_17_action' => $data['kemasan_17_action'] ?? null,
                'kemasan_17_due'    => $data['kemasan_17_due'] ?? null,
                'kemasan_17_foto'   => $data['kemasan_17_foto'] ?? null,

                'kemasan_18_check'  => $data['kemasan_18_check'] ?? null,
                'kemasan_18_action' => $data['kemasan_18_action'] ?? null,
                'kemasan_18_due'    => $data['kemasan_18_due'] ?? null,
                'kemasan_18_foto'   => $data['kemasan_18_foto'] ?? null,

                'kemasan_19_check'  => $data['kemasan_19_check'] ?? null,
                'kemasan_19_action' => $data['kemasan_19_action'] ?? null,
                'kemasan_19_due'    => $data['kemasan_19_due'] ?? null,
                'kemasan_19_foto'   => $data['kemasan_19_foto'] ?? null,

                'bangunan_21_check'  => $data['bangunan_21_check'] ?? null,
                'bangunan_21_action' => $data['bangunan_21_action'] ?? null,
                'bangunan_21_due'    => $data['bangunan_21_due'] ?? null,
                'bangunan_21_foto'   => $data['bangunan_21_foto'] ?? null,

                'bangunan_22_check'  => $data['bangunan_22_check'] ?? null,
                'bangunan_22_action' => $data['bangunan_22_action'] ?? null,
                'bangunan_22_due'    => $data['bangunan_22_due'] ?? null,
                'bangunan_22_foto'   => $data['bangunan_22_foto'] ?? null,

                'bangunan_23_check'  => $data['bangunan_23_check'] ?? null,
                'bangunan_23_action' => $data['bangunan_23_action'] ?? null,
                'bangunan_23_due'    => $data['bangunan_23_due'] ?? null,
                'bangunan_23_foto'   => $data['bangunan_23_foto'] ?? null,

                'bangunan_24_check'  => $data['bangunan_24_check'] ?? null,
                'bangunan_24_action' => $data['bangunan_24_action'] ?? null,
                'bangunan_24_due'    => $data['bangunan_24_due'] ?? null,
                'bangunan_24_foto'   => $data['bangunan_24_foto'] ?? null,

                'bangunan_25_check'  => $data['bangunan_25_check'] ?? null,
                'bangunan_25_action' => $data['bangunan_25_action'] ?? null,
                'bangunan_25_due'    => $data['bangunan_25_due'] ?? null,
                'bangunan_25_foto'   => $data['bangunan_25_foto'] ?? null,

                'bangunan_26_check'  => $data['bangunan_26_check'] ?? null,
                'bangunan_26_action' => $data['bangunan_26_action'] ?? null,
                'bangunan_26_due'    => $data['bangunan_26_due'] ?? null,
                'bangunan_26_foto'   => $data['bangunan_26_foto'] ?? null,

                'bangunan_27_check'  => $data['bangunan_27_check'] ?? null,
                'bangunan_27_action' => $data['bangunan_27_action'] ?? null,
                'bangunan_27_due'    => $data['bangunan_27_due'] ?? null,
                'bangunan_27_foto'   => $data['bangunan_27_foto'] ?? null,

                'bangunan_28_check'  => $data['bangunan_28_check'] ?? null,
                'bangunan_28_action' => $data['bangunan_28_action'] ?? null,
                'bangunan_28_due'    => $data['bangunan_28_due'] ?? null,
                'bangunan_28_foto'   => $data['bangunan_28_foto'] ?? null,

                'bangunan_29_check'  => $data['bangunan_29_check'] ?? null,
                'bangunan_29_action' => $data['bangunan_29_action'] ?? null,
                'bangunan_29_due'    => $data['bangunan_29_due'] ?? null,
                'bangunan_29_foto'   => $data['bangunan_29_foto'] ?? null,

                'bangunan_210_check'  => $data['bangunan_210_check'] ?? null,
                'bangunan_210_action' => $data['bangunan_210_action'] ?? null,
                'bangunan_210_due'    => $data['bangunan_210_due'] ?? null,
                'bangunan_210_foto'   => $data['bangunan_210_foto'] ?? null,

                'tanda_31_check'  => $data['tanda_31_check'] ?? null,
                'tanda_31_action' => $data['tanda_31_action'] ?? null,
                'tanda_31_due'    => $data['tanda_31_due'] ?? null,
                'tanda_31_foto'   => $data['tanda_31_foto'] ?? null,

                'tanda_33_check'  => $data['tanda_33_check'] ?? null,
                'tanda_33_action' => $data['tanda_33_action'] ?? null,
                'tanda_33_due'    => $data['tanda_33_due'] ?? null,
                'tanda_33_foto'   => $data['tanda_33_foto'] ?? null,

                'tanda_34_check'  => $data['tanda_34_check'] ?? null,
                'tanda_34_action' => $data['tanda_34_action'] ?? null,
                'tanda_34_due'    => $data['tanda_34_due'] ?? null,
                'tanda_34_foto'   => $data['tanda_34_foto'] ?? null,

                'tanda_35_check'  => $data['tanda_35_check'] ?? null,
                'tanda_35_action' => $data['tanda_35_action'] ?? null,
                'tanda_35_due'    => $data['tanda_35_due'] ?? null,
                'tanda_35_foto'   => $data['tanda_35_foto'] ?? null,

                'fasilitas_41_check'  => $data['fasilitas_41_check'] ?? null,
                'fasilitas_41_action' => $data['fasilitas_41_action'] ?? null,
                'fasilitas_41_due'    => $data['fasilitas_41_due'] ?? null,
                'fasilitas_41_foto'   => $data['fasilitas_41_foto'] ?? null,

                'fasilitas_42_check'  => $data['fasilitas_42_check'] ?? null,
                'fasilitas_42_action' => $data['fasilitas_42_action'] ?? null,
                'fasilitas_42_due'    => $data['fasilitas_42_due'] ?? null,
                'fasilitas_42_foto'   => $data['fasilitas_42_foto'] ?? null,

                'fasilitas_43_check'  => $data['fasilitas_43_check'] ?? null,
                'fasilitas_43_action' => $data['fasilitas_43_action'] ?? null,
                'fasilitas_43_due'    => $data['fasilitas_43_due'] ?? null,
                'fasilitas_43_foto'   => $data['fasilitas_43_foto'] ?? null,

                'fasilitas_44_check'  => $data['fasilitas_44_check'] ?? null,
                'fasilitas_44_action' => $data['fasilitas_44_action'] ?? null,
                'fasilitas_44_due'    => $data['fasilitas_44_due'] ?? null,
                'fasilitas_44_foto'   => $data['fasilitas_44_foto'] ?? null,

                'administrasi_51_check'  => $data['administrasi_51_check'] ?? null,
                'administrasi_51_action' => $data['administrasi_51_action'] ?? null,
                'administrasi_51_due'    => $data['administrasi_51_due'] ?? null,
                'administrasi_51_foto'   => $data['administrasi_51_foto'] ?? null,

                'administrasi_52_check'  => $data['administrasi_52_check'] ?? null,
                'administrasi_52_action' => $data['administrasi_52_action'] ?? null,
                'administrasi_52_due'    => $data['administrasi_52_due'] ?? null,
                'administrasi_52_foto'   => $data['administrasi_52_foto'] ?? null,

                'administrasi_55_check'  => $data['administrasi_55_check'] ?? null,
                'administrasi_55_action' => $data['administrasi_55_action'] ?? null,
                'administrasi_55_due'    => $data['administrasi_55_due'] ?? null,
                'administrasi_55_foto'   => $data['administrasi_55_foto'] ?? null,

                'oil_61_check'  => $data['oil_61_check'] ?? null,
                'oil_61_action' => $data['oil_61_action'] ?? null,
                'oil_61_due'    => $data['oil_61_due'] ?? null,
                'oil_61_foto'   => $data['oil_61_foto'] ?? null,

                'oil_62_check'  => $data['oil_62_check'] ?? null,
                'oil_62_action' => $data['oil_62_action'] ?? null,
                'oil_62_due'    => $data['oil_62_due'] ?? null,
                'oil_62_foto'   => $data['oil_62_foto'] ?? null,

                'oil_63_check'  => $data['oil_63_check'] ?? null,
                'oil_63_action' => $data['oil_63_action'] ?? null,
                'oil_63_due'    => $data['oil_63_due'] ?? null,
                'oil_63_foto'   => $data['oil_63_foto'] ?? null,

                'oil_64_check'  => $data['oil_64_check'] ?? null,
                'oil_64_action' => $data['oil_64_action'] ?? null,
                'oil_64_due'    => $data['oil_64_due'] ?? null,
                'oil_64_foto'   => $data['oil_64_foto'] ?? null,

                'oil_65_check'  => $data['oil_65_check'] ?? null,
                'oil_65_action' => $data['oil_65_action'] ?? null,
                'oil_65_due'    => $data['oil_65_due'] ?? null,
                'oil_65_foto'   => $data['oil_65_foto'] ?? null,

                'house_81_check'  => $data['house_81_check'] ?? null,
                'house_81_action' => $data['house_81_action'] ?? null,
                'house_81_due'    => $data['house_81_due'] ?? null,
                'house_81_foto'   => $data['house_81_foto'] ?? null,

                'house_82_check'  => $data['house_82_check'] ?? null,
                'house_82_action' => $data['house_82_action'] ?? null,
                'house_82_due'    => $data['house_82_due'] ?? null,
                'house_82_foto'   => $data['house_82_foto'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,

                'dibuat'                   => $data['dibuat'] ?? null,
                'verified_dibuat'          => $data['dibuat'] ?? null,
                'catatan_verified_dibuat'  => $data['catatan_verified_dibuat'] ?? null,
                'date_verified_dibuat'     => Carbon::now(),

                'diperiksa'                    => $data['diperiksa'] ?? null,
                'verified_diperiksa'           => $data['verified_diperiksa'] ?? null,
                'catatan_verified_diperiksa'   => $data['catatan_verified_diperiksa'] ?? null,
                'date_verified_diperiksa'      => $data['date_verified_diperiksa'] ?? null,

                'dokumentasi_1' => $dokumentasi['dokumentasi_1'],
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'],

            ];

            InspeksiGudangB3::create($dataToInsert);

            return redirect()->route('inspeksi.gudangb3')->with('success', 'Checklist Inspeksi Gudang B3 berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Checklist Inspeksi Gudang B3 gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiGudangB3::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.gudangb3')->with('success', 'Checklist Inspeksi Gudang B3 berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.gudangb3')->with('info', nl2br('Checklist Inspeksi Gudang B3 gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $b3 = DB::table('se_inspeksi_gudangb3 as b3')
        ->leftJoin('users as us', 'b3.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'b3.dibuat', '=', 'us1.nik')
        ->leftJoin('users as us2', 'b3.diperiksa', '=', 'us2.nik')
        ->select(
            'b3.*',
            'b3.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, b3.created_at, 120) as tanggal_pembuatan'),
            'b3.statusenabled',
            'b3.dibuat as nik_dibuat',
            'us1.name as nama_dibuat',
            'us1.position as jabatan_dibuat',
            'b3.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'us2.position as jabatan_diperiksa',
        )
        ->where('b3.statusenabled', true)
        ->where('b3.uuid', $uuid)->first();

        if($b3 == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $b3;

            $qrTempFolder = storage_path('app/public/qr-temp');
            if (!File::exists($qrTempFolder)) {
                File::makeDirectory($qrTempFolder, 0755, true);
            }

            if ($item->verified_dibuat != null) {
                $fileName = 'verified_dibuat' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_dibuat)]), $filePath);

                $item->verified_dibuat = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_dibuat = null;
            }
            if ($item->verified_diperiksa != null) {
                $fileName = 'verified_diperiksa' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(250)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_diperiksa)]), $filePath);

                $item->verified_diperiksa = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_diperiksa = null;
            }

        }

        return view('inspeksi.gudang-b3.preview', compact('b3'));
    }
}
