<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\InspeksiTPSLimbahB3;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;

class InspeksiTPSLimbahB3Controller extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiTPSLimbahB3' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_tpslimbahb3 as tps')
        ->leftJoin('users as us', 'tps.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'tps.dibuat', '=', 'us1.nik')
        ->leftJoin('users as us2', 'tps.diperiksa', '=', 'us2.nik')
        ->select(
            'tps.id',
            'tps.uuid',
            'tps.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, tps.created_at, 120) as tanggal_pembuatan'),
            'tps.statusenabled',
            'tps.dibuat as nik_dibuat',
            'us1.name as nama_dibuat',
            'tps.verified_dibuat',
            'tps.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'tps.verified_diperiksa',
            'tps.lokasi',
            'tps.tanggal_inspeksi',
            'tps.jam_inspeksi',
        )
        ->where('tps.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, tps.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        $user = Auth::user();
        $safetyRoles = ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'];

        if (!in_array($user->role, $safetyRoles)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('tps.pic', $user->id)
                    ->orWhere('tps.inspektor', $user->nik)
                    ->orWhere('tps.pendamping', $user->nik);
            });
        }
        $tps = $baseQuery->get();


        return view('inspeksi.tps-limbah.index', compact('tps'));
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

        return view('inspeksi.tps-limbah.insert', compact('users'));
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
                    $path = "inspeksi/tpslimbahb3/{$field}";

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

                'kemasan_110_check'  => $data['kemasan_110_check'] ?? null,
                'kemasan_110_action' => $data['kemasan_110_action'] ?? null,
                'kemasan_110_due'    => $data['kemasan_110_due'] ?? null,
                'kemasan_110_foto'   => $data['kemasan_110_foto'] ?? null,

                'kemasan_111_check'  => $data['kemasan_111_check'] ?? null,
                'kemasan_111_action' => $data['kemasan_111_action'] ?? null,
                'kemasan_111_due'    => $data['kemasan_111_due'] ?? null,
                'kemasan_111_foto'   => $data['kemasan_111_foto'] ?? null,

                'kemasan_112_check'  => $data['kemasan_112_check'] ?? null,
                'kemasan_112_action' => $data['kemasan_112_action'] ?? null,
                'kemasan_112_due'    => $data['kemasan_112_due'] ?? null,
                'kemasan_112_foto'   => $data['kemasan_112_foto'] ?? null,

                'penyimpanan_21_check'  => $data['penyimpanan_21_check'] ?? null,
                'penyimpanan_21_action' => $data['penyimpanan_21_action'] ?? null,
                'penyimpanan_21_due'    => $data['penyimpanan_21_due'] ?? null,
                'penyimpanan_21_foto'   => $data['penyimpanan_21_foto'] ?? null,

                'penyimpanan_22_check'  => $data['penyimpanan_22_check'] ?? null,
                'penyimpanan_22_action' => $data['penyimpanan_22_action'] ?? null,
                'penyimpanan_22_due'    => $data['penyimpanan_22_due'] ?? null,
                'penyimpanan_22_foto'   => $data['penyimpanan_22_foto'] ?? null,

                'penyimpanan_23_check'  => $data['penyimpanan_23_check'] ?? null,
                'penyimpanan_23_action' => $data['penyimpanan_23_action'] ?? null,
                'penyimpanan_23_due'    => $data['penyimpanan_23_due'] ?? null,
                'penyimpanan_23_foto'   => $data['penyimpanan_23_foto'] ?? null,

                'penyimpanan_24_check'  => $data['penyimpanan_24_check'] ?? null,
                'penyimpanan_24_action' => $data['penyimpanan_24_action'] ?? null,
                'penyimpanan_24_due'    => $data['penyimpanan_24_due'] ?? null,
                'penyimpanan_24_foto'   => $data['penyimpanan_24_foto'] ?? null,

                'penyimpanan_25_check'  => $data['penyimpanan_25_check'] ?? null,
                'penyimpanan_25_action' => $data['penyimpanan_25_action'] ?? null,
                'penyimpanan_25_due'    => $data['penyimpanan_25_due'] ?? null,
                'penyimpanan_25_foto'   => $data['penyimpanan_25_foto'] ?? null,

                'bangunan_31_check'  => $data['bangunan_31_check'] ?? null,
                'bangunan_31_action' => $data['bangunan_31_action'] ?? null,
                'bangunan_31_due'    => $data['bangunan_31_due'] ?? null,
                'bangunan_31_foto'   => $data['bangunan_31_foto'] ?? null,

                'bangunan_32_check'  => $data['bangunan_32_check'] ?? null,
                'bangunan_32_action' => $data['bangunan_32_action'] ?? null,
                'bangunan_32_due'    => $data['bangunan_32_due'] ?? null,
                'bangunan_32_foto'   => $data['bangunan_32_foto'] ?? null,

                'bangunan_33_check'  => $data['bangunan_33_check'] ?? null,
                'bangunan_33_action' => $data['bangunan_33_action'] ?? null,
                'bangunan_33_due'    => $data['bangunan_33_due'] ?? null,
                'bangunan_33_foto'   => $data['bangunan_33_foto'] ?? null,

                'bangunan_34_check'  => $data['bangunan_34_check'] ?? null,
                'bangunan_34_action' => $data['bangunan_34_action'] ?? null,
                'bangunan_34_due'    => $data['bangunan_34_due'] ?? null,
                'bangunan_34_foto'   => $data['bangunan_34_foto'] ?? null,

                'bangunan_35_check'  => $data['bangunan_35_check'] ?? null,
                'bangunan_35_action' => $data['bangunan_35_action'] ?? null,
                'bangunan_35_due'    => $data['bangunan_35_due'] ?? null,
                'bangunan_35_foto'   => $data['bangunan_35_foto'] ?? null,

                'bangunan_36_check'  => $data['bangunan_36_check'] ?? null,
                'bangunan_36_action' => $data['bangunan_36_action'] ?? null,
                'bangunan_36_due'    => $data['bangunan_36_due'] ?? null,
                'bangunan_36_foto'   => $data['bangunan_36_foto'] ?? null,

                'bangunan_37_check'  => $data['bangunan_37_check'] ?? null,
                'bangunan_37_action' => $data['bangunan_37_action'] ?? null,
                'bangunan_37_due'    => $data['bangunan_37_due'] ?? null,
                'bangunan_37_foto'   => $data['bangunan_37_foto'] ?? null,

                'bangunan_38_check'  => $data['bangunan_38_check'] ?? null,
                'bangunan_38_action' => $data['bangunan_38_action'] ?? null,
                'bangunan_38_due'    => $data['bangunan_38_due'] ?? null,
                'bangunan_38_foto'   => $data['bangunan_38_foto'] ?? null,

                'bangunan_39_check'  => $data['bangunan_39_check'] ?? null,
                'bangunan_39_action' => $data['bangunan_39_action'] ?? null,
                'bangunan_39_due'    => $data['bangunan_39_due'] ?? null,
                'bangunan_39_foto'   => $data['bangunan_39_foto'] ?? null,

                'bangunan_310_check'  => $data['bangunan_310_check'] ?? null,
                'bangunan_310_action' => $data['bangunan_310_action'] ?? null,
                'bangunan_310_due'    => $data['bangunan_310_due'] ?? null,
                'bangunan_310_foto'   => $data['bangunan_310_foto'] ?? null,

                'bangunan_311_check'  => $data['bangunan_311_check'] ?? null,
                'bangunan_311_action' => $data['bangunan_311_action'] ?? null,
                'bangunan_311_due'    => $data['bangunan_311_due'] ?? null,
                'bangunan_311_foto'   => $data['bangunan_311_foto'] ?? null,

                'bangunan_312_check'  => $data['bangunan_312_check'] ?? null,
                'bangunan_312_action' => $data['bangunan_312_action'] ?? null,
                'bangunan_312_due'    => $data['bangunan_312_due'] ?? null,
                'bangunan_312_foto'   => $data['bangunan_312_foto'] ?? null,

                'bangunan_313_check'  => $data['bangunan_313_check'] ?? null,
                'bangunan_313_action' => $data['bangunan_313_action'] ?? null,
                'bangunan_313_due'    => $data['bangunan_313_due'] ?? null,
                'bangunan_313_foto'   => $data['bangunan_313_foto'] ?? null,

                'bangunan_314_check'  => $data['bangunan_314_check'] ?? null,
                'bangunan_314_action' => $data['bangunan_314_action'] ?? null,
                'bangunan_314_due'    => $data['bangunan_314_due'] ?? null,
                'bangunan_314_foto'   => $data['bangunan_314_foto'] ?? null,

                'bangunan_315_check'  => $data['bangunan_315_check'] ?? null,
                'bangunan_315_action' => $data['bangunan_315_action'] ?? null,
                'bangunan_315_due'    => $data['bangunan_315_due'] ?? null,
                'bangunan_315_foto'   => $data['bangunan_315_foto'] ?? null,

                'bangunan_316_check'  => $data['bangunan_316_check'] ?? null,
                'bangunan_316_action' => $data['bangunan_316_action'] ?? null,
                'bangunan_316_due'    => $data['bangunan_316_due'] ?? null,
                'bangunan_316_foto'   => $data['bangunan_316_foto'] ?? null,

                'tanda_41_check'  => $data['tanda_41_check'] ?? null,
                'tanda_41_action' => $data['tanda_41_action'] ?? null,
                'tanda_41_due'    => $data['tanda_41_due'] ?? null,
                'tanda_41_foto'   => $data['tanda_41_foto'] ?? null,

                'tanda_42_check'  => $data['tanda_42_check'] ?? null,
                'tanda_42_action' => $data['tanda_42_action'] ?? null,
                'tanda_42_due'    => $data['tanda_42_due'] ?? null,
                'tanda_42_foto'   => $data['tanda_42_foto'] ?? null,

                'tanda_43_check'  => $data['tanda_43_check'] ?? null,
                'tanda_43_action' => $data['tanda_43_action'] ?? null,
                'tanda_43_due'    => $data['tanda_43_due'] ?? null,
                'tanda_43_foto'   => $data['tanda_43_foto'] ?? null,

                'tanda_44_check'  => $data['tanda_44_check'] ?? null,
                'tanda_44_action' => $data['tanda_44_action'] ?? null,
                'tanda_44_due'    => $data['tanda_44_due'] ?? null,
                'tanda_44_foto'   => $data['tanda_44_foto'] ?? null,

                'tanda_45_check'  => $data['tanda_45_check'] ?? null,
                'tanda_45_action' => $data['tanda_45_action'] ?? null,
                'tanda_45_due'    => $data['tanda_45_due'] ?? null,
                'tanda_45_foto'   => $data['tanda_45_foto'] ?? null,

                'tanda_46_check'  => $data['tanda_46_check'] ?? null,
                'tanda_46_action' => $data['tanda_46_action'] ?? null,
                'tanda_46_due'    => $data['tanda_46_due'] ?? null,
                'tanda_46_foto'   => $data['tanda_46_foto'] ?? null,

                'tanda_47_check'  => $data['tanda_47_check'] ?? null,
                'tanda_47_action' => $data['tanda_47_action'] ?? null,
                'tanda_47_due'    => $data['tanda_47_due'] ?? null,
                'tanda_47_foto'   => $data['tanda_47_foto'] ?? null,

                'tanda_48_check'  => $data['tanda_48_check'] ?? null,
                'tanda_48_action' => $data['tanda_48_action'] ?? null,
                'tanda_48_due'    => $data['tanda_48_due'] ?? null,
                'tanda_48_foto'   => $data['tanda_48_foto'] ?? null,

                'fasilitas_51_check'  => $data['fasilitas_51_check'] ?? null,
                'fasilitas_51_action' => $data['fasilitas_51_action'] ?? null,
                'fasilitas_51_due'    => $data['fasilitas_51_due'] ?? null,
                'fasilitas_51_foto'   => $data['fasilitas_51_foto'] ?? null,

                'fasilitas_52_check'  => $data['fasilitas_52_check'] ?? null,
                'fasilitas_52_action' => $data['fasilitas_52_action'] ?? null,
                'fasilitas_52_due'    => $data['fasilitas_52_due'] ?? null,
                'fasilitas_52_foto'   => $data['fasilitas_52_foto'] ?? null,

                'fasilitas_53_check'  => $data['fasilitas_53_check'] ?? null,
                'fasilitas_53_action' => $data['fasilitas_53_action'] ?? null,
                'fasilitas_53_due'    => $data['fasilitas_53_due'] ?? null,
                'fasilitas_53_foto'   => $data['fasilitas_53_foto'] ?? null,

                'fasilitas_54_check'  => $data['fasilitas_54_check'] ?? null,
                'fasilitas_54_action' => $data['fasilitas_54_action'] ?? null,
                'fasilitas_54_due'    => $data['fasilitas_54_due'] ?? null,
                'fasilitas_54_foto'   => $data['fasilitas_54_foto'] ?? null,

                'fasilitas_55_check'  => $data['fasilitas_55_check'] ?? null,
                'fasilitas_55_action' => $data['fasilitas_55_action'] ?? null,
                'fasilitas_55_due'    => $data['fasilitas_55_due'] ?? null,
                'fasilitas_55_foto'   => $data['fasilitas_55_foto'] ?? null,

                'fasilitas_56_check'  => $data['fasilitas_56_check'] ?? null,
                'fasilitas_56_action' => $data['fasilitas_56_action'] ?? null,
                'fasilitas_56_due'    => $data['fasilitas_56_due'] ?? null,
                'fasilitas_56_foto'   => $data['fasilitas_56_foto'] ?? null,

                'fasilitas_57_check'  => $data['fasilitas_57_check'] ?? null,
                'fasilitas_57_action' => $data['fasilitas_57_action'] ?? null,
                'fasilitas_57_due'    => $data['fasilitas_57_due'] ?? null,
                'fasilitas_57_foto'   => $data['fasilitas_57_foto'] ?? null,

                'fasilitas_58_check'  => $data['fasilitas_58_check'] ?? null,
                'fasilitas_58_action' => $data['fasilitas_58_action'] ?? null,
                'fasilitas_58_due'    => $data['fasilitas_58_due'] ?? null,
                'fasilitas_58_foto'   => $data['fasilitas_58_foto'] ?? null,

                'fasilitas_59_check'  => $data['fasilitas_59_check'] ?? null,
                'fasilitas_59_action' => $data['fasilitas_59_action'] ?? null,
                'fasilitas_59_due'    => $data['fasilitas_59_due'] ?? null,
                'fasilitas_59_foto'   => $data['fasilitas_59_foto'] ?? null,

                'administrasi_61_check'  => $data['administrasi_61_check'] ?? null,
                'administrasi_61_action' => $data['administrasi_61_action'] ?? null,
                'administrasi_61_due'    => $data['administrasi_61_due'] ?? null,
                'administrasi_61_foto'   => $data['administrasi_61_foto'] ?? null,

                'administrasi_62_check'  => $data['administrasi_62_check'] ?? null,
                'administrasi_62_action' => $data['administrasi_62_action'] ?? null,
                'administrasi_62_due'    => $data['administrasi_62_due'] ?? null,
                'administrasi_62_foto'   => $data['administrasi_62_foto'] ?? null,

                'administrasi_64_check'  => $data['administrasi_64_check'] ?? null,
                'administrasi_64_action' => $data['administrasi_64_action'] ?? null,
                'administrasi_64_due'    => $data['administrasi_64_due'] ?? null,
                'administrasi_64_foto'   => $data['administrasi_64_foto'] ?? null,

                'administrasi_65_check'  => $data['administrasi_65_check'] ?? null,
                'administrasi_65_action' => $data['administrasi_65_action'] ?? null,
                'administrasi_65_due'    => $data['administrasi_65_due'] ?? null,
                'administrasi_65_foto'   => $data['administrasi_65_foto'] ?? null,

                'bak_71_check'  => $data['bak_71_check'] ?? null,
                'bak_71_action' => $data['bak_71_action'] ?? null,
                'bak_71_due'    => $data['bak_71_due'] ?? null,
                'bak_71_foto'   => $data['bak_71_foto'] ?? null,

                'bak_72_check'  => $data['bak_72_check'] ?? null,
                'bak_72_action' => $data['bak_72_action'] ?? null,
                'bak_72_due'    => $data['bak_72_due'] ?? null,
                'bak_72_foto'   => $data['bak_72_foto'] ?? null,

                'bak_73_check'  => $data['bak_73_check'] ?? null,
                'bak_73_action' => $data['bak_73_action'] ?? null,
                'bak_73_due'    => $data['bak_73_due'] ?? null,
                'bak_73_foto'   => $data['bak_73_foto'] ?? null,

                'bak_74_check'  => $data['bak_74_check'] ?? null,
                'bak_74_action' => $data['bak_74_action'] ?? null,
                'bak_74_due'    => $data['bak_74_due'] ?? null,
                'bak_74_foto'   => $data['bak_74_foto'] ?? null,

                'bak_75_check'  => $data['bak_75_check'] ?? null,
                'bak_75_action' => $data['bak_75_action'] ?? null,
                'bak_75_due'    => $data['bak_75_due'] ?? null,
                'bak_75_foto'   => $data['bak_75_foto'] ?? null,

                'house_81_check'  => $data['house_81_check'] ?? null,
                'house_81_action' => $data['house_81_action'] ?? null,
                'house_81_due'    => $data['house_81_due'] ?? null,
                'house_81_foto'   => $data['house_81_foto'] ?? null,

                'house_82_check'  => $data['house_82_check'] ?? null,
                'house_82_action' => $data['house_82_action'] ?? null,
                'house_82_due'    => $data['house_82_due'] ?? null,
                'house_82_foto'   => $data['house_82_foto'] ?? null,

                'house_83_check'  => $data['house_83_check'] ?? null,
                'house_83_action' => $data['house_83_action'] ?? null,
                'house_83_due'    => $data['house_83_due'] ?? null,
                'house_83_foto'   => $data['house_83_foto'] ?? null,

                'house_84_check'  => $data['house_84_check'] ?? null,
                'house_84_action' => $data['house_84_action'] ?? null,
                'house_84_due'    => $data['house_84_due'] ?? null,
                'house_84_foto'   => $data['house_84_foto'] ?? null,

                'kegiatan_91_check'  => $data['kegiatan_91_check'] ?? null,
                'kegiatan_91_action' => $data['kegiatan_91_action'] ?? null,
                'kegiatan_91_due'    => $data['kegiatan_91_due'] ?? null,
                'kegiatan_91_foto'   => $data['kegiatan_91_foto'] ?? null,

                'kegiatan_92_check'  => $data['kegiatan_92_check'] ?? null,
                'kegiatan_92_action' => $data['kegiatan_92_action'] ?? null,
                'kegiatan_92_due'    => $data['kegiatan_92_due'] ?? null,
                'kegiatan_92_foto'   => $data['kegiatan_92_foto'] ?? null,

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

            InspeksiTPSLimbahB3::create($dataToInsert);

            return redirect()->route('inspeksi.tpslimbahb3')->with('success', 'Checklist TPS Limbah B3 berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Checklist TPS Limbah B3 gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiTPSLimbahB3::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.tpslimbahb3')->with('success', 'Checklist TPS Limbah B3 Skid berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.tpslimbahb3')->with('info', nl2br('Checklist TPS Limbah B3 Skid gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $tps = DB::table('se_inspeksi_tpslimbahb3 as tps')
        ->leftJoin('users as us', 'tps.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'tps.dibuat', '=', 'us1.nik')
        ->leftJoin('users as us2', 'tps.diperiksa', '=', 'us2.nik')
        ->select(
            'tps.*',
            'tps.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, tps.created_at, 120) as tanggal_pembuatan'),
            'tps.statusenabled',
            'tps.dibuat as nik_dibuat',
            'us1.name as nama_dibuat',
            'us1.position as jabatan_dibuat',
            'tps.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'us2.position as jabatan_diperiksa',
        )
        ->where('tps.statusenabled', true)
        ->where('tps.uuid', $uuid)->first();

        if($tps == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $tps;

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

        return view('inspeksi.tps-limbah.preview', compact('tps'));
    }
}
