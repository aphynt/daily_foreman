<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\InspeksiFuelSkid;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;

class InspeksiFuelSkidController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiFuelSkid' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_fuelskid as fs')
        ->leftJoin('users as us', 'fs.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'fs.dibuat', '=', 'us1.nik')
        ->leftJoin('users as us2', 'fs.diperiksa', '=', 'us2.nik')
        ->select(
            'fs.id',
            'fs.uuid',
            'fs.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, fs.created_at, 120) as tanggal_pembuatan'),
            'fs.statusenabled',
            'fs.dibuat as nik_dibuat',
            'us1.name as nama_dibuat',
            'fs.verified_dibuat',
            'fs.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'fs.verified_diperiksa',
            'fs.lokasi',
            'fs.nomor_tangki',
            'fs.kapasitas_tangki',
            'fs.tanggal_inspeksi',
            'fs.jam_inspeksi',
        )
        ->where('fs.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, fs.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        $user = Auth::user();
        $safetyRoles = ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'];

        if (!in_array($user->role, $safetyRoles)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('fs.pic', $user->id)
                    ->orWhere('fs.inspektor', $user->nik)
                    ->orWhere('fs.pendamping', $user->nik);
            });
        }
        $fs = $baseQuery->get();


        return view('inspeksi.fuel-skid.index', compact('fs'));
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

        return view('inspeksi.fuel-skid.insert', compact('users'));
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
                'nomor_tangki'      => $data['nomor_tangki'] ?? null,
                'kapasitas_tangki'  => $data['kapasitas_tangki'] ?? null,
                'tanggal_inspeksi'  => $data['tanggal_inspeksi'] ?? null,
                'jam_inspeksi'      => $data['jam_inspeksi'] ?? null,

                'lokasikerja_11_check'  => $data['lokasikerja_11_check'] ?? null,
                'lokasikerja_11_action' => $data['lokasikerja_11_action'] ?? null,
                'lokasikerja_11_due'    => $data['lokasikerja_11_due'] ?? null,
                'lokasikerja_11_foto'   => $data['lokasikerja_11_foto'] ?? null,

                'lokasikerja_12_check'  => $data['lokasikerja_12_check'] ?? null,
                'lokasikerja_12_action' => $data['lokasikerja_12_action'] ?? null,
                'lokasikerja_12_due'    => $data['lokasikerja_12_due'] ?? null,
                'lokasikerja_12_foto'   => $data['lokasikerja_12_foto'] ?? null,

                'lokasikerja_13_check'  => $data['lokasikerja_13_check'] ?? null,
                'lokasikerja_13_action' => $data['lokasikerja_13_action'] ?? null,
                'lokasikerja_13_due'    => $data['lokasikerja_13_due'] ?? null,
                'lokasikerja_13_foto'   => $data['lokasikerja_13_foto'] ?? null,

                'lokasikerja_14_check'  => $data['lokasikerja_14_check'] ?? null,
                'lokasikerja_14_action' => $data['lokasikerja_14_action'] ?? null,
                'lokasikerja_14_due'    => $data['lokasikerja_14_due'] ?? null,
                'lokasikerja_14_foto'   => $data['lokasikerja_14_foto'] ?? null,

                'lokasikerja_15_check'  => $data['lokasikerja_15_check'] ?? null,
                'lokasikerja_15_action' => $data['lokasikerja_15_action'] ?? null,
                'lokasikerja_15_due'    => $data['lokasikerja_15_due'] ?? null,
                'lokasikerja_15_foto'   => $data['lokasikerja_15_foto'] ?? null,

                'lokasikerja_16_check'  => $data['lokasikerja_16_check'] ?? null,
                'lokasikerja_16_action' => $data['lokasikerja_16_action'] ?? null,
                'lokasikerja_16_due'    => $data['lokasikerja_16_due'] ?? null,
                'lokasikerja_16_foto'   => $data['lokasikerja_16_foto'] ?? null,

                'lokasikerja_17_check'  => $data['lokasikerja_17_check'] ?? null,
                'lokasikerja_17_action' => $data['lokasikerja_17_action'] ?? null,
                'lokasikerja_17_due'    => $data['lokasikerja_17_due'] ?? null,
                'lokasikerja_17_foto'   => $data['lokasikerja_17_foto'] ?? null,

                'lokasikerja_18_check'  => $data['lokasikerja_18_check'] ?? null,
                'lokasikerja_18_action' => $data['lokasikerja_18_action'] ?? null,
                'lokasikerja_18_due'    => $data['lokasikerja_18_due'] ?? null,
                'lokasikerja_18_foto'   => $data['lokasikerja_18_foto'] ?? null,

                'lokasikerja_19_check'  => $data['lokasikerja_19_check'] ?? null,
                'lokasikerja_19_action' => $data['lokasikerja_19_action'] ?? null,
                'lokasikerja_19_due'    => $data['lokasikerja_19_due'] ?? null,
                'lokasikerja_19_foto'   => $data['lokasikerja_19_foto'] ?? null,

                'ruangistirahat_21_check'  => $data['ruangistirahat_21_check'] ?? null,
                'ruangistirahat_21_action' => $data['ruangistirahat_21_action'] ?? null,
                'ruangistirahat_21_due'    => $data['ruangistirahat_21_due'] ?? null,
                'ruangistirahat_21_foto'   => $data['ruangistirahat_21_foto'] ?? null,

                'ruangistirahat_22_check'  => $data['ruangistirahat_22_check'] ?? null,
                'ruangistirahat_22_action' => $data['ruangistirahat_22_action'] ?? null,
                'ruangistirahat_22_due'    => $data['ruangistirahat_22_due'] ?? null,
                'ruangistirahat_22_foto'   => $data['ruangistirahat_22_foto'] ?? null,

                'ruangistirahat_23_check'  => $data['ruangistirahat_23_check'] ?? null,
                'ruangistirahat_23_action' => $data['ruangistirahat_23_action'] ?? null,
                'ruangistirahat_23_due'    => $data['ruangistirahat_23_due'] ?? null,
                'ruangistirahat_23_foto'   => $data['ruangistirahat_23_foto'] ?? null,

                'ruangistirahat_24_check'  => $data['ruangistirahat_24_check'] ?? null,
                'ruangistirahat_24_action' => $data['ruangistirahat_24_action'] ?? null,
                'ruangistirahat_24_due'    => $data['ruangistirahat_24_due'] ?? null,
                'ruangistirahat_24_foto'   => $data['ruangistirahat_24_foto'] ?? null,

                'ruangistirahat_25_check'  => $data['ruangistirahat_25_check'] ?? null,
                'ruangistirahat_25_action' => $data['ruangistirahat_25_action'] ?? null,
                'ruangistirahat_25_due'    => $data['ruangistirahat_25_due'] ?? null,
                'ruangistirahat_25_foto'   => $data['ruangistirahat_25_foto'] ?? null,

                'tempatsampah_31_check'  => $data['tempatsampah_31_check'] ?? null,
                'tempatsampah_31_action' => $data['tempatsampah_31_action'] ?? null,
                'tempatsampah_31_due'    => $data['tempatsampah_31_due'] ?? null,
                'tempatsampah_31_foto'   => $data['tempatsampah_31_foto'] ?? null,

                'tempatsampah_32_check'  => $data['tempatsampah_32_check'] ?? null,
                'tempatsampah_32_action' => $data['tempatsampah_32_action'] ?? null,
                'tempatsampah_32_due'    => $data['tempatsampah_32_due'] ?? null,
                'tempatsampah_32_foto'   => $data['tempatsampah_32_foto'] ?? null,

                'tempatsampah_33_check'  => $data['tempatsampah_33_check'] ?? null,
                'tempatsampah_33_action' => $data['tempatsampah_33_action'] ?? null,
                'tempatsampah_33_due'    => $data['tempatsampah_33_due'] ?? null,
                'tempatsampah_33_foto'   => $data['tempatsampah_33_foto'] ?? null,

                'tempatsampah_34_check'  => $data['tempatsampah_34_check'] ?? null,
                'tempatsampah_34_action' => $data['tempatsampah_34_action'] ?? null,
                'tempatsampah_34_due'    => $data['tempatsampah_34_due'] ?? null,
                'tempatsampah_34_foto'   => $data['tempatsampah_34_foto'] ?? null,

                'tempatsampah_35_check'  => $data['tempatsampah_35_check'] ?? null,
                'tempatsampah_35_action' => $data['tempatsampah_35_action'] ?? null,
                'tempatsampah_35_due'    => $data['tempatsampah_35_due'] ?? null,
                'tempatsampah_35_foto'   => $data['tempatsampah_35_foto'] ?? null,

                'tempatparkir_41_check'  => $data['tempatparkir_41_check'] ?? null,
                'tempatparkir_41_action' => $data['tempatparkir_41_action'] ?? null,
                'tempatparkir_41_due'    => $data['tempatparkir_41_due'] ?? null,
                'tempatparkir_41_foto'   => $data['tempatparkir_41_foto'] ?? null,

                'tempatparkir_42_check'  => $data['tempatparkir_42_check'] ?? null,
                'tempatparkir_42_action' => $data['tempatparkir_42_action'] ?? null,
                'tempatparkir_42_due'    => $data['tempatparkir_42_due'] ?? null,
                'tempatparkir_42_foto'   => $data['tempatparkir_42_foto'] ?? null,

                'wadah_51_check'  => $data['wadah_51_check'] ?? null,
                'wadah_51_action' => $data['wadah_51_action'] ?? null,
                'wadah_51_due'    => $data['wadah_51_due'] ?? null,
                'wadah_51_foto'   => $data['wadah_51_foto'] ?? null,

                'apar_61_check'  => $data['apar_61_check'] ?? null,
                'apar_61_action' => $data['apar_61_action'] ?? null,
                'apar_61_due'    => $data['apar_61_due'] ?? null,
                'apar_61_foto'   => $data['apar_61_foto'] ?? null,

                'apar_62_check'  => $data['apar_62_check'] ?? null,
                'apar_62_action' => $data['apar_62_action'] ?? null,
                'apar_62_due'    => $data['apar_62_due'] ?? null,
                'apar_62_foto'   => $data['apar_62_foto'] ?? null,

                'apar_63_check'  => $data['apar_63_check'] ?? null,
                'apar_63_action' => $data['apar_63_action'] ?? null,
                'apar_63_due'    => $data['apar_63_due'] ?? null,
                'apar_63_foto'   => $data['apar_63_foto'] ?? null,

                'rambu_71_check'  => $data['rambu_71_check'] ?? null,
                'rambu_71_action' => $data['rambu_71_action'] ?? null,
                'rambu_71_due'    => $data['rambu_71_due'] ?? null,
                'rambu_71_foto'   => $data['rambu_71_foto'] ?? null,

                'rambu_72_check'  => $data['rambu_72_check'] ?? null,
                'rambu_72_action' => $data['rambu_72_action'] ?? null,
                'rambu_72_due'    => $data['rambu_72_due'] ?? null,
                'rambu_72_foto'   => $data['rambu_72_foto'] ?? null,

                'rambu_73_check'  => $data['rambu_73_check'] ?? null,
                'rambu_73_action' => $data['rambu_73_action'] ?? null,
                'rambu_73_due'    => $data['rambu_73_due'] ?? null,
                'rambu_73_foto'   => $data['rambu_73_foto'] ?? null,

                'alatoperasional_81_check'  => $data['alatoperasional_81_check'] ?? null,
                'alatoperasional_81_action' => $data['alatoperasional_81_action'] ?? null,
                'alatoperasional_81_due'    => $data['alatoperasional_81_due'] ?? null,
                'alatoperasional_81_foto'   => $data['alatoperasional_81_foto'] ?? null,

                'alatoperasional_82_check'  => $data['alatoperasional_82_check'] ?? null,
                'alatoperasional_82_action' => $data['alatoperasional_82_action'] ?? null,
                'alatoperasional_82_due'    => $data['alatoperasional_82_due'] ?? null,
                'alatoperasional_82_foto'   => $data['alatoperasional_82_foto'] ?? null,

                'alatoperasional_83_check'  => $data['alatoperasional_83_check'] ?? null,
                'alatoperasional_83_action' => $data['alatoperasional_83_action'] ?? null,
                'alatoperasional_83_due'    => $data['alatoperasional_83_due'] ?? null,
                'alatoperasional_83_foto'   => $data['alatoperasional_83_foto'] ?? null,

                'alatoperasional_84_check'  => $data['alatoperasional_84_check'] ?? null,
                'alatoperasional_84_action' => $data['alatoperasional_84_action'] ?? null,
                'alatoperasional_84_due'    => $data['alatoperasional_84_due'] ?? null,
                'alatoperasional_84_foto'   => $data['alatoperasional_84_foto'] ?? null,

                'alatoperasional_85_check'  => $data['alatoperasional_85_check'] ?? null,
                'alatoperasional_85_action' => $data['alatoperasional_85_action'] ?? null,
                'alatoperasional_85_due'    => $data['alatoperasional_85_due'] ?? null,
                'alatoperasional_85_foto'   => $data['alatoperasional_85_foto'] ?? null,

                'alatoperasional_86_check'  => $data['alatoperasional_86_check'] ?? null,
                'alatoperasional_86_action' => $data['alatoperasional_86_action'] ?? null,
                'alatoperasional_86_due'    => $data['alatoperasional_86_due'] ?? null,
                'alatoperasional_86_foto'   => $data['alatoperasional_86_foto'] ?? null,

                'alatoperasional_87_check'  => $data['alatoperasional_87_check'] ?? null,
                'alatoperasional_87_action' => $data['alatoperasional_87_action'] ?? null,
                'alatoperasional_87_due'    => $data['alatoperasional_87_due'] ?? null,
                'alatoperasional_87_foto'   => $data['alatoperasional_87_foto'] ?? null,

                'tangkitimbun_91_check'  => $data['tangkitimbun_91_check'] ?? null,
                'tangkitimbun_91_action' => $data['tangkitimbun_91_action'] ?? null,
                'tangkitimbun_91_due'    => $data['tangkitimbun_91_due'] ?? null,
                'tangkitimbun_91_foto'   => $data['tangkitimbun_91_foto'] ?? null,

                'tangkitimbun_92_check'  => $data['tangkitimbun_92_check'] ?? null,
                'tangkitimbun_92_action' => $data['tangkitimbun_92_action'] ?? null,
                'tangkitimbun_92_due'    => $data['tangkitimbun_92_due'] ?? null,
                'tangkitimbun_92_foto'   => $data['tangkitimbun_92_foto'] ?? null,

                'tangkitimbun_93_check'  => $data['tangkitimbun_93_check'] ?? null,
                'tangkitimbun_93_action' => $data['tangkitimbun_93_action'] ?? null,
                'tangkitimbun_93_due'    => $data['tangkitimbun_93_due'] ?? null,
                'tangkitimbun_93_foto'   => $data['tangkitimbun_93_foto'] ?? null,

                'tangkitimbun_94_check'  => $data['tangkitimbun_94_check'] ?? null,
                'tangkitimbun_94_action' => $data['tangkitimbun_94_action'] ?? null,
                'tangkitimbun_94_due'    => $data['tangkitimbun_94_due'] ?? null,
                'tangkitimbun_94_foto'   => $data['tangkitimbun_94_foto'] ?? null,

                'tangkitimbun_95_check'  => $data['tangkitimbun_95_check'] ?? null,
                'tangkitimbun_95_action' => $data['tangkitimbun_95_action'] ?? null,
                'tangkitimbun_95_due'    => $data['tangkitimbun_95_due'] ?? null,
                'tangkitimbun_95_foto'   => $data['tangkitimbun_95_foto'] ?? null,

                'tangkitimbun_96_check'  => $data['tangkitimbun_96_check'] ?? null,
                'tangkitimbun_96_action' => $data['tangkitimbun_96_action'] ?? null,
                'tangkitimbun_96_due'    => $data['tangkitimbun_96_due'] ?? null,
                'tangkitimbun_96_foto'   => $data['tangkitimbun_96_foto'] ?? null,

                'tangkitimbun_97_check'  => $data['tangkitimbun_97_check'] ?? null,
                'tangkitimbun_97_action' => $data['tangkitimbun_97_action'] ?? null,
                'tangkitimbun_97_due'    => $data['tangkitimbun_97_due'] ?? null,
                'tangkitimbun_97_foto'   => $data['tangkitimbun_97_foto'] ?? null,

                'tangkitimbun_98_check'  => $data['tangkitimbun_98_check'] ?? null,
                'tangkitimbun_98_action' => $data['tangkitimbun_98_action'] ?? null,
                'tangkitimbun_98_due'    => $data['tangkitimbun_98_due'] ?? null,
                'tangkitimbun_98_foto'   => $data['tangkitimbun_98_foto'] ?? null,

                'tangkitimbun_99_check'  => $data['tangkitimbun_99_check'] ?? null,
                'tangkitimbun_99_action' => $data['tangkitimbun_99_action'] ?? null,
                'tangkitimbun_99_due'    => $data['tangkitimbun_99_due'] ?? null,
                'tangkitimbun_99_foto'   => $data['tangkitimbun_99_foto'] ?? null,

                'tangkitimbun_910_check'  => $data['tangkitimbun_910_check'] ?? null,
                'tangkitimbun_910_action' => $data['tangkitimbun_910_action'] ?? null,
                'tangkitimbun_910_due'    => $data['tangkitimbun_910_due'] ?? null,
                'tangkitimbun_910_foto'   => $data['tangkitimbun_910_foto'] ?? null,

                'tangkitimbun_911_check'  => $data['tangkitimbun_911_check'] ?? null,
                'tangkitimbun_911_action' => $data['tangkitimbun_911_action'] ?? null,
                'tangkitimbun_911_due'    => $data['tangkitimbun_911_due'] ?? null,
                'tangkitimbun_911_foto'   => $data['tangkitimbun_911_foto'] ?? null,

                'tangkitimbun_912_check'  => $data['tangkitimbun_912_check'] ?? null,
                'tangkitimbun_912_action' => $data['tangkitimbun_912_action'] ?? null,
                'tangkitimbun_912_due'    => $data['tangkitimbun_912_due'] ?? null,
                'tangkitimbun_912_foto'   => $data['tangkitimbun_912_foto'] ?? null,

                'penangkalpetir_101_check'  => $data['penangkalpetir_101_check'] ?? null,
                'penangkalpetir_101_action' => $data['penangkalpetir_101_action'] ?? null,
                'penangkalpetir_101_due'    => $data['penangkalpetir_101_due'] ?? null,
                'penangkalpetir_101_foto'   => $data['penangkalpetir_101_foto'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,

                'dibuat'                   => $data['dibuat'] ?? null,
                'verified_dibuat'          => $data['dibuat'] ?? null,
                'catatan_verified_dibuat'  => $data['catatan_verified_dibuat'] ?? null,
                'date_verified_dibuat'     => Carbon::now(),

                'diperiksa'                    => $data['diperiksa'] ?? null,
                'verified_diperiksa'           => $data['verified_diperiksa'] ?? null,
                'catatan_verified_diperiksa'   => $data['catatan_verified_diperiksa'] ?? null,
                'date_verified_diperiksa'      => $data['date_verified_diperiksa'] ?? null,

            ];

            InspeksiFuelSkid::create($dataToInsert);

            return redirect()->route('inspeksi.fuelskid')->with('success', 'Checlist Inspeksi Fuel Skid berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Checlist Inspeksi Fuel Skid gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiFuelSkid::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.fuelskid')->with('success', 'Checlist Inspeksi Fuel Skid berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.fuelskid')->with('info', nl2br('Checlist Inspeksi Fuel Skid gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $fs = DB::table('se_inspeksi_fuelskid as fs')
        ->leftJoin('users as us', 'fs.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'fs.dibuat', '=', 'us1.nik')
        ->leftJoin('users as us2', 'fs.diperiksa', '=', 'us2.nik')
        ->select(
            'fs.*',
            'fs.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, fs.created_at, 120) as tanggal_pembuatan'),
            'fs.statusenabled',
            'fs.dibuat as nik_dibuat',
            'us1.name as nama_dibuat',
            'us1.position as jabatan_dibuat',
            'fs.diperiksa as nik_diperiksa',
            'us2.name as nama_diperiksa',
            'us2.position as jabatan_diperiksa',
        )
        ->where('fs.statusenabled', true)
        ->where('fs.uuid', $uuid)->first();

        if($fs == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $fs;

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

        return view('inspeksi.fuel-skid.preview', compact('fs'));
    }
}
