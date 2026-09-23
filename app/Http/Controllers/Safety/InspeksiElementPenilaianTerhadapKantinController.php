<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\InspeksiPenilaianTerhadapKantin;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;

class InspeksiElementPenilaianTerhadapKantinController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiPenilaianTerhadapKantin' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_penilaianterhadapkantin as b3')
        ->leftJoin('users as us', 'b3.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'b3.disiapkan', '=', 'us1.nik')
        ->leftJoin('users as us2', 'b3.diperiksa', '=', 'us2.nik')
        ->leftJoin('users as us3', 'b3.diketahui', '=', 'us3.nik')
        ->select(
            'b3.id',
            'b3.uuid',
            'b3.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, b3.created_at, 120) as tanggal_pembuatan'),
            'b3.statusenabled',
            'b3.disiapkan as nik_disiapkan',
            'us1.name as nama_disiapkan',
            'b3.verified_disiapkan',
            'b3.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'b3.verified_diperiksa',
            'b3.diketahui as nik_diketahui',
            'us3.name as nama_diketahui',
            'b3.verified_diketahui',
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
        $kantin = $baseQuery->get();


        return view('inspeksi.penilaian-terhadap-kantin.index', compact('kantin'));
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

        return view('inspeksi.penilaian-terhadap-kantin.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();
            // dd($data);

            $dataToInsert = [

                'uuid'              => (string) Uuid::uuid4(),
                'pic'               => Auth::user()->id,
                'statusenabled'     => true,

                'lokasi'            => $data['lokasi'] ?? null,
                'tanggal_inspeksi'  => $data['tanggal_inspeksi'] ?? null,
                'jam_inspeksi'      => $data['jam_inspeksi'] ?? null,

                'bangunan_11_check'  => $data['bangunan_11_check'] ?? null,
                'bangunan_11_action' => $data['bangunan_11_action'] ?? null,
                'bangunan_11_due'    => $data['bangunan_11_due'] ?? null,
                'bangunan_11_foto'   => $data['bangunan_11_foto'] ?? null,

                'bangunan_12_check'  => $data['bangunan_12_check'] ?? null,
                'bangunan_12_action' => $data['bangunan_12_action'] ?? null,
                'bangunan_12_due'    => $data['bangunan_12_due'] ?? null,
                'bangunan_12_foto'   => $data['bangunan_12_foto'] ?? null,

                'bangunan_13_check'  => $data['bangunan_13_check'] ?? null,
                'bangunan_13_action' => $data['bangunan_13_action'] ?? null,
                'bangunan_13_due'    => $data['bangunan_13_due'] ?? null,
                'bangunan_13_foto'   => $data['bangunan_13_foto'] ?? null,

                'bangunan_14_check'  => $data['bangunan_14_check'] ?? null,
                'bangunan_14_action' => $data['bangunan_14_action'] ?? null,
                'bangunan_14_due'    => $data['bangunan_14_due'] ?? null,
                'bangunan_14_foto'   => $data['bangunan_14_foto'] ?? null,

                'bangunan_15_1_check'  => $data['bangunan_15_1_check'] ?? null,
                'bangunan_15_1_action' => $data['bangunan_15_1_action'] ?? null,
                'bangunan_15_1_due'    => $data['bangunan_15_1_due'] ?? null,
                'bangunan_15_1_foto'   => $data['bangunan_15_1_foto'] ?? null,

                'bangunan_15_2_check'  => $data['bangunan_15_2_check'] ?? null,
                'bangunan_15_2_action' => $data['bangunan_15_2_action'] ?? null,
                'bangunan_15_2_due'    => $data['bangunan_15_2_due'] ?? null,
                'bangunan_15_2_foto'   => $data['bangunan_15_2_foto'] ?? null,

                'bangunan_16_1_check'  => $data['bangunan_16_1_check'] ?? null,
                'bangunan_16_1_action' => $data['bangunan_16_1_action'] ?? null,
                'bangunan_16_1_due'    => $data['bangunan_16_1_due'] ?? null,
                'bangunan_16_1_foto'   => $data['bangunan_16_1_foto'] ?? null,

                'bangunan_16_2_check'  => $data['bangunan_16_2_check'] ?? null,
                'bangunan_16_2_action' => $data['bangunan_16_2_action'] ?? null,
                'bangunan_16_2_due'    => $data['bangunan_16_2_due'] ?? null,
                'bangunan_16_2_foto'   => $data['bangunan_16_2_foto'] ?? null,

                'bangunan_16_3_check'  => $data['bangunan_16_3_check'] ?? null,
                'bangunan_16_3_action' => $data['bangunan_16_3_action'] ?? null,
                'bangunan_16_3_due'    => $data['bangunan_16_3_due'] ?? null,
                'bangunan_16_3_foto'   => $data['bangunan_16_3_foto'] ?? null,

                'bangunan_16_4_check'  => $data['bangunan_16_4_check'] ?? null,
                'bangunan_16_4_action' => $data['bangunan_16_4_action'] ?? null,
                'bangunan_16_4_due'    => $data['bangunan_16_4_due'] ?? null,
                'bangunan_16_4_foto'   => $data['bangunan_16_4_foto'] ?? null,

                'bangunan_17_check'  => $data['bangunan_17_check'] ?? null,
                'bangunan_17_action' => $data['bangunan_17_action'] ?? null,
                'bangunan_17_due'    => $data['bangunan_17_due'] ?? null,
                'bangunan_17_foto'   => $data['bangunan_17_foto'] ?? null,

                'bangunan_18_1_check'  => $data['bangunan_18_1_check'] ?? null,
                'bangunan_18_1_action' => $data['bangunan_18_1_action'] ?? null,
                'bangunan_18_1_due'    => $data['bangunan_18_1_due'] ?? null,
                'bangunan_18_1_foto'   => $data['bangunan_18_1_foto'] ?? null,

                'bangunan_18_2_check'  => $data['bangunan_18_2_check'] ?? null,
                'bangunan_18_2_action' => $data['bangunan_18_2_action'] ?? null,
                'bangunan_18_2_due'    => $data['bangunan_18_2_due'] ?? null,
                'bangunan_18_2_foto'   => $data['bangunan_18_2_foto'] ?? null,

                'bangunan_18_3_check'  => $data['bangunan_18_3_check'] ?? null,
                'bangunan_18_3_action' => $data['bangunan_18_3_action'] ?? null,
                'bangunan_18_3_due'    => $data['bangunan_18_3_due'] ?? null,
                'bangunan_18_3_foto'   => $data['bangunan_18_3_foto'] ?? null,

                'bangunan_18_4_check'  => $data['bangunan_18_4_check'] ?? null,
                'bangunan_18_4_action' => $data['bangunan_18_4_action'] ?? null,
                'bangunan_18_4_due'    => $data['bangunan_18_4_due'] ?? null,
                'bangunan_18_4_foto'   => $data['bangunan_18_4_foto'] ?? null,

                'bangunan_19_check'  => $data['bangunan_19_check'] ?? null,
                'bangunan_19_action' => $data['bangunan_19_action'] ?? null,
                'bangunan_19_due'    => $data['bangunan_19_due'] ?? null,
                'bangunan_19_foto'   => $data['bangunan_19_foto'] ?? null,

                'bangunan_110_check'  => $data['bangunan_110_check'] ?? null,
                'bangunan_110_action' => $data['bangunan_110_action'] ?? null,
                'bangunan_110_due'    => $data['bangunan_110_due'] ?? null,
                'bangunan_110_foto'   => $data['bangunan_110_foto'] ?? null,

                'bangunan_111_check'  => $data['bangunan_111_check'] ?? null,
                'bangunan_111_action' => $data['bangunan_111_action'] ?? null,
                'bangunan_111_due'    => $data['bangunan_111_due'] ?? null,
                'bangunan_111_foto'   => $data['bangunan_111_foto'] ?? null,

                'bangunan_112_check'  => $data['bangunan_112_check'] ?? null,
                'bangunan_112_action' => $data['bangunan_112_action'] ?? null,
                'bangunan_112_due'    => $data['bangunan_112_due'] ?? null,
                'bangunan_112_foto'   => $data['bangunan_112_foto'] ?? null,

                'bangunan_113_check'  => $data['bangunan_113_check'] ?? null,
                'bangunan_113_action' => $data['bangunan_113_action'] ?? null,
                'bangunan_113_due'    => $data['bangunan_113_due'] ?? null,
                'bangunan_113_foto'   => $data['bangunan_113_foto'] ?? null,

                'bangunan_114_check'  => $data['bangunan_114_check'] ?? null,
                'bangunan_114_action' => $data['bangunan_114_action'] ?? null,
                'bangunan_114_due'    => $data['bangunan_114_due'] ?? null,
                'bangunan_114_foto'   => $data['bangunan_114_foto'] ?? null,

                'papan_21_check'  => $data['papan_21_check'] ?? null,
                'papan_21_action' => $data['papan_21_action'] ?? null,
                'papan_21_due'    => $data['papan_21_due'] ?? null,
                'papan_21_foto'   => $data['papan_21_foto'] ?? null,

                'papan_22_check'  => $data['papan_22_check'] ?? null,
                'papan_22_action' => $data['papan_22_action'] ?? null,
                'papan_22_due'    => $data['papan_22_due'] ?? null,
                'papan_22_foto'   => $data['papan_22_foto'] ?? null,

                'papan_23_check'  => $data['papan_23_check'] ?? null,
                'papan_23_action' => $data['papan_23_action'] ?? null,
                'papan_23_due'    => $data['papan_23_due'] ?? null,
                'papan_23_foto'   => $data['papan_23_foto'] ?? null,

                'administrasi_31_1_check'  => $data['administrasi_31_1_check'] ?? null,
                'administrasi_31_1_action' => $data['administrasi_31_1_action'] ?? null,
                'administrasi_31_1_due'    => $data['administrasi_31_1_due'] ?? null,
                'administrasi_31_1_foto'   => $data['administrasi_31_1_foto'] ?? null,

                'administrasi_31_2_check'  => $data['administrasi_31_2_check'] ?? null,
                'administrasi_31_2_action' => $data['administrasi_31_2_action'] ?? null,
                'administrasi_31_2_due'    => $data['administrasi_31_2_due'] ?? null,
                'administrasi_31_2_foto'   => $data['administrasi_31_2_foto'] ?? null,

                'administrasi_32_check'  => $data['administrasi_32_check'] ?? null,
                'administrasi_32_action' => $data['administrasi_32_action'] ?? null,
                'administrasi_32_due'    => $data['administrasi_32_due'] ?? null,
                'administrasi_32_foto'   => $data['administrasi_32_foto'] ?? null,

                'administrasi_33_check'  => $data['administrasi_33_check'] ?? null,
                'administrasi_33_action' => $data['administrasi_33_action'] ?? null,
                'administrasi_33_due'    => $data['administrasi_33_due'] ?? null,
                'administrasi_33_foto'   => $data['administrasi_33_foto'] ?? null,

                'house_41_check'  => $data['house_41_check'] ?? null,
                'house_41_action' => $data['house_41_action'] ?? null,
                'house_41_due'    => $data['house_41_due'] ?? null,
                'house_41_foto'   => $data['house_41_foto'] ?? null,

                'house_42_check'  => $data['house_42_check'] ?? null,
                'house_42_action' => $data['house_42_action'] ?? null,
                'house_42_due'    => $data['house_42_due'] ?? null,
                'house_42_foto'   => $data['house_42_foto'] ?? null,

                'house_43_check'  => $data['house_43_check'] ?? null,
                'house_43_action' => $data['house_43_action'] ?? null,
                'house_43_due'    => $data['house_43_due'] ?? null,
                'house_43_foto'   => $data['house_43_foto'] ?? null,

                'house_44_check'  => $data['house_44_check'] ?? null,
                'house_44_action' => $data['house_44_action'] ?? null,
                'house_44_due'    => $data['house_44_due'] ?? null,
                'house_44_foto'   => $data['house_44_foto'] ?? null,

                'house_45_check'  => $data['house_45_check'] ?? null,
                'house_45_action' => $data['house_45_action'] ?? null,
                'house_45_due'    => $data['house_45_due'] ?? null,
                'house_45_foto'   => $data['house_45_foto'] ?? null,

                'house_46_check'  => $data['house_46_check'] ?? null,
                'house_46_action' => $data['house_46_action'] ?? null,
                'house_46_due'    => $data['house_46_due'] ?? null,
                'house_46_foto'   => $data['house_46_foto'] ?? null,

                'house_47_check'  => $data['house_47_check'] ?? null,
                'house_47_action' => $data['house_47_action'] ?? null,
                'house_47_due'    => $data['house_47_due'] ?? null,
                'house_47_foto'   => $data['house_47_foto'] ?? null,

                'alat_51_check'  => $data['alat_51_check'] ?? null,
                'alat_51_action' => $data['alat_51_action'] ?? null,
                'alat_51_due'    => $data['alat_51_due'] ?? null,
                'alat_51_foto'   => $data['alat_51_foto'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,

                'disiapkan'                   => $data['disiapkan'] ?? null,
                'verified_disiapkan'          => $data['disiapkan'] ?? null,
                'catatan_verified_disiapkan'  => $data['catatan_verified_disiapkan'] ?? null,
                'date_verified_disiapkan'     => Carbon::now(),

                'diperiksa'                    => $data['diperiksa'] ?? null,
                'verified_diperiksa'           => $data['verified_diperiksa'] ?? null,
                'catatan_verified_diperiksa'   => $data['catatan_verified_diperiksa'] ?? null,
                'date_verified_diperiksa'      => $data['date_verified_diperiksa'] ?? null,

                'diketahui'                    => $data['diketahui'] ?? null,
                'verified_diketahui'           => $data['verified_diketahui'] ?? null,
                'catatan_verified_diketahui'   => $data['catatan_verified_diketahui'] ?? null,
                'date_verified_diketahui'      => $data['date_verified_diketahui'] ?? null,

            ];

            InspeksiPenilaianTerhadapKantin::create($dataToInsert);

            return redirect()->route('inspeksi.penilaianterhadapkantin')->with('success', 'Element Penilaian Terhadap Kantin berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Element Penilaian Terhadap Kantin gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiPenilaianTerhadapKantin::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.penilaianterhadapkantin')->with('success', 'Element Penilaian Terhadap Kantin berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.penilaianterhadapkantin')->with('info', nl2br('Element Penilaian Terhadap Kantin gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $kantin = DB::table('se_inspeksi_penilaianterhadapkantin as kantin')
        ->leftJoin('users as us', 'kantin.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'kantin.disiapkan', '=', 'us1.nik')
        ->leftJoin('users as us2', 'kantin.diperiksa', '=', 'us2.nik')
        ->leftJoin('users as us3', 'kantin.diketahui', '=', 'us3.nik')
        ->select(
            'kantin.*',
            'kantin.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, kantin.created_at, 120) as tanggal_pembuatan'),
            'kantin.statusenabled',
            'kantin.disiapkan as nik_disiapkan',
            'us1.name as nama_disiapkan',
            'us1.position as jabatan_disiapkan',
            'kantin.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'us2.position as jabatan_diperiksa',
            'kantin.diketahui as nik_diketahui',
            'us3.name as nama_diketahui',
            'us3.position as jabatan_diketahui',
        )
        ->where('kantin.statusenabled', true)
        ->where('kantin.uuid', $uuid)->first();

        if($kantin == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $kantin;

            $qrTempFolder = storage_path('app/public/qr-temp');
            if (!File::exists($qrTempFolder)) {
                File::makeDirectory($qrTempFolder, 0755, true);
            }

            if ($item->verified_disiapkan != null) {
                $fileName = 'verified_disiapkan' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_disiapkan)]), $filePath);

                $item->verified_disiapkan = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_disiapkan = null;
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
            if ($item->verified_diketahui != null) {
                $fileName = 'verified_diketahui' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(250)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_diketahui)]), $filePath);

                $item->verified_diketahui = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_diketahui = null;
            }

        }

        return view('inspeksi.penilaian-terhadap-kantin.preview', compact('kantin'));
    }
}
