<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiAreaLimbahB3;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;

class InspeksiAreaLimbahB3Controller extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiAreaLimbahB3' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_arealimbahb3 as sp')
        ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'sp.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'sp.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'sp.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'sp.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'sp.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'sp.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'sp.inspektor6', '=', 'us6.nik')
        ->leftJoin('users as us7', 'sp.inspektor7', '=', 'us7.nik')
        ->leftJoin('users as us9', 'sp.penanggungjawab', '=', 'us9.nik')
        ->select(
            'sp.id',
            'sp.uuid',
            'sp.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, sp.created_at, 120) as tanggal_pembuatan'),
            'sp.statusenabled',
            'sp.nama_lokasi',
            'ar.keterangan as pit',
            'sp.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'sp.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'sp.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'sp.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'sp.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'sp.inspektor6 as nik_inspektor6',
            'us6.name as nama_inspektor6',
            'sp.inspektor7 as nik_inspektor7',
            'us7.name as nama_inspektor7',
            'sp.penanggungjawab as nik_penanggungjawab',
            'us9.name as nama_penanggungjawab',
            'sp.verified_penanggungjawab',
            'sp.verified_inspektor1',
            'sp.verified_penanggungjawab',
            'sp.tanggal_inspeksi',
        )
        ->where('sp.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, sp.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        $user = Auth::user();

        $nikBypass = array_merge(
            getConfigArrayById(28),
            getConfigArrayById(31)
        );

        if (!in_array($user->nik, $nikBypass)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('ab.pic', $user->id)
                    ->orWhere('ab.penanggungjawab', $user->nik)
                    ->orWhere('ab.inspektor1', $user->nik)
                    ->orWhere('ab.inspektor2', $user->nik)
                    ->orWhere('ab.inspektor3', $user->nik)
                    ->orWhere('ab.inspektor4', $user->nik)
                    ->orWhere('ab.inspektor5', $user->nik)
                    ->orWhere('ab.inspektor6', $user->nik)
                    ->orWhere('ab.inspektor7', $user->nik);
            });
        }

        $sp = $baseQuery->get();

        return view('inspeksi.area-limbah-b3.index', compact('sp'));
    }

    public function insert()
    {
        $pit = Area::where('statusenabled', true)->where('group', 'production')->get();
        // $penanggungjawab = Personal::whereIn('ROLETYPE', [2, 3, 4])->orderBy('PERSONALNAME')->get();
        $penanggungjawab = User::where(function ($query) {
        $query->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT', 'MANAGEMENT'])
                ->orWhereIn('id', [
                    8043, 8044, 8045, 8046, 8047, 8048, 8049,
                    8050, 8051, 8052, 8053, 8054, 8055, 8056, 8058, 8059, 8062,
                    8063, 8066, 8067, 8068, 8069, 8070
                ]);
        })
        ->where('statusenabled', true)
        ->orderBy('name')->get();

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
            'pit' => $pit,
            'penanggungjawab' => $penanggungjawab,
            'inspektor' => $inspektor,
        ];

        return view('inspeksi.area-limbah-b3.insert', compact('users'));
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
                    $path = "inspeksi/arealimbahb3/{$field}";

                    Storage::disk('production_public')->putFileAs($path, $file, $fileName);
                    $dokumentasi[$field] = rtrim(config('app.url'), '/') . "/storage/{$path}/{$fileName}";
                }
            }
            $data = $request->all();
             
            $dataToInsert = [
                'uuid' => (string) Uuid::uuid4(),
                'pic' => Auth::user()->id,
                'statusenabled' => true,
                'tanggal_inspeksi' => $data['tanggal_inspeksi'],
                'nama_lokasi' => $data['nama_lokasi'],
                'pit' => $data['pit'] ?? null,
                'penanggungjawab' => $data['penanggungjawab'] ?? null,
                'inspektor1' => $data['inspektor1'] ?? null,
                'verified_inspektor1' => Auth::user()->nik,
                'date_verified_inspektor1' => Carbon::now(),
                'inspektor2' => $data['inspektor2'] ?? null,
                'verified_inspektor2' => $data['inspektor2'] ?? null,
                'date_verified_inspektor2' => Carbon::now(),
                'inspektor3' => $data['inspektor3'] ?? null,
                'verified_inspektor3' => $data['inspektor3'] ?? null,
                'date_verified_inspektor3' => Carbon::now(),
                'inspektor4' => $data['inspektor4'] ?? null,
                'verified_inspektor4' => $data['inspektor4'] ?? null,
                'date_verified_inspektor4' => Carbon::now(),
                'inspektor5' => $data['inspektor5'] ?? null,
                'verified_inspektor5' => $data['inspektor5'] ?? null,
                'date_verified_inspektor5' => Carbon::now(),
                'inspektor6' => $data['inspektor6'] ?? null,
                'verified_inspektor6' => $data['inspektor6'] ?? null,
                'date_verified_inspektor6' => Carbon::now(),
                'inspektor7' => $data['inspektor7'] ?? null,
                'verified_inspektor7' => $data['inspektor7'] ?? null,
                'date_verified_inspektor7' => Carbon::now(),
                'inspektor8' => $data['inspektor8'] ?? null,
                'verified_inspektor8' => $data['inspektor8'] ?? null,
                'date_verified_inspektor8' => Carbon::now(),

                'perizinan_administrasi_1_check' => $data['perizinan_administrasi_1_check'] ?? null,
                'perizinan_administrasi_1_action' => $data['perizinan_administrasi_1_action'] ?? null,
                'perizinan_administrasi_1_due' => $data['perizinan_administrasi_1_due'] ?? null,
                'perizinan_administrasi_2_check' => $data['perizinan_administrasi_2_check'] ?? null,
                'perizinan_administrasi_2_action' => $data['perizinan_administrasi_2_action'] ?? null,
                'perizinan_administrasi_2_due' => $data['perizinan_administrasi_2_due'] ?? null,
                'perizinan_administrasi_3_check' => $data['perizinan_administrasi_3_check'] ?? null,
                'perizinan_administrasi_3_action' => $data['perizinan_administrasi_3_action'] ?? null,
                'perizinan_administrasi_3_due' => $data['perizinan_administrasi_3_due'] ?? null,
                'perizinan_administrasi_4_check' => $data['perizinan_administrasi_4_check'] ?? null,
                'perizinan_administrasi_4_action' => $data['perizinan_administrasi_4_action'] ?? null,
                'perizinan_administrasi_4_due' => $data['perizinan_administrasi_4_due'] ?? null,
                'perizinan_administrasi_5_check' => $data['perizinan_administrasi_5_check'] ?? null,
                'perizinan_administrasi_5_action' => $data['perizinan_administrasi_5_action'] ?? null,
                'perizinan_administrasi_5_due' => $data['perizinan_administrasi_5_due'] ?? null,
                'perizinan_administrasi_6_check' => $data['perizinan_administrasi_6_check'] ?? null,
                'perizinan_administrasi_6_action' => $data['perizinan_administrasi_6_action'] ?? null,
                'perizinan_administrasi_6_due' => $data['perizinan_administrasi_6_due'] ?? null,
                'perizinan_administrasi_7_check' => $data['perizinan_administrasi_7_check'] ?? null,
                'perizinan_administrasi_7_action' => $data['perizinan_administrasi_7_action'] ?? null,
                'perizinan_administrasi_7_due' => $data['perizinan_administrasi_7_due'] ?? null,
                'perizinan_administrasi_8_check' => $data['perizinan_administrasi_8_check'] ?? null,
                'perizinan_administrasi_8_action' => $data['perizinan_administrasi_8_action'] ?? null,
                'perizinan_administrasi_8_due' => $data['perizinan_administrasi_8_due'] ?? null,
                'perizinan_administrasi_9_check' => $data['perizinan_administrasi_9_check'] ?? null,
                'perizinan_administrasi_9_action' => $data['perizinan_administrasi_9_action'] ?? null,
                'perizinan_administrasi_9_due' => $data['perizinan_administrasi_9_due'] ?? null,
                'perizinan_administrasi_10_check' => $data['perizinan_administrasi_10_check'] ?? null,
                'perizinan_administrasi_10_action' => $data['perizinan_administrasi_10_action'] ?? null,
                'perizinan_administrasi_10_due' => $data['perizinan_administrasi_10_due'] ?? null,

                'lokasi_konstruksi_1_check' => $data['lokasi_konstruksi_1_check'] ?? null,
                'lokasi_konstruksi_1_action' => $data['lokasi_konstruksi_1_action'] ?? null,
                'lokasi_konstruksi_1_due' => $data['lokasi_konstruksi_1_due'] ?? null,
                'lokasi_konstruksi_2_check' => $data['lokasi_konstruksi_2_check'] ?? null,
                'lokasi_konstruksi_2_action' => $data['lokasi_konstruksi_2_action'] ?? null,
                'lokasi_konstruksi_2_due' => $data['lokasi_konstruksi_2_due'] ?? null,
                'lokasi_konstruksi_3_check' => $data['lokasi_konstruksi_3_check'] ?? null,
                'lokasi_konstruksi_3_action' => $data['lokasi_konstruksi_3_action'] ?? null,
                'lokasi_konstruksi_3_due' => $data['lokasi_konstruksi_3_due'] ?? null,
                'lokasi_konstruksi_4_check' => $data['lokasi_konstruksi_4_check'] ?? null,
                'lokasi_konstruksi_4_action' => $data['lokasi_konstruksi_4_action'] ?? null,
                'lokasi_konstruksi_4_due' => $data['lokasi_konstruksi_4_due'] ?? null,
                'lokasi_konstruksi_5_check' => $data['lokasi_konstruksi_5_check'] ?? null,
                'lokasi_konstruksi_5_action' => $data['lokasi_konstruksi_5_action'] ?? null,
                'lokasi_konstruksi_5_due' => $data['lokasi_konstruksi_5_due'] ?? null,
                'lokasi_konstruksi_6_check' => $data['lokasi_konstruksi_6_check'] ?? null,
                'lokasi_konstruksi_6_action' => $data['lokasi_konstruksi_6_action'] ?? null,
                'lokasi_konstruksi_6_due' => $data['lokasi_konstruksi_6_due'] ?? null,
                'lokasi_konstruksi_7_check' => $data['lokasi_konstruksi_7_check'] ?? null,
                'lokasi_konstruksi_7_action' => $data['lokasi_konstruksi_7_action'] ?? null,
                'lokasi_konstruksi_7_due' => $data['lokasi_konstruksi_7_due'] ?? null,
                'lokasi_konstruksi_8_check' => $data['lokasi_konstruksi_8_check'] ?? null,
                'lokasi_konstruksi_8_action' => $data['lokasi_konstruksi_8_action'] ?? null,
                'lokasi_konstruksi_8_due' => $data['lokasi_konstruksi_8_due'] ?? null,
                'lokasi_konstruksi_9_check' => $data['lokasi_konstruksi_9_check'] ?? null,
                'lokasi_konstruksi_9_action' => $data['lokasi_konstruksi_9_action'] ?? null,
                'lokasi_konstruksi_9_due' => $data['lokasi_konstruksi_9_due'] ?? null,
                'lokasi_konstruksi_10_check' => $data['lokasi_konstruksi_10_check'] ?? null,
                'lokasi_konstruksi_10_action' => $data['lokasi_konstruksi_10_action'] ?? null,
                'lokasi_konstruksi_10_due' => $data['lokasi_konstruksi_10_due'] ?? null,
                'lokasi_konstruksi_11_check' => $data['lokasi_konstruksi_11_check'] ?? null,
                'lokasi_konstruksi_11_action' => $data['lokasi_konstruksi_11_action'] ?? null,
                'lokasi_konstruksi_11_due' => $data['lokasi_konstruksi_11_due'] ?? null,
                'lokasi_konstruksi_12_check' => $data['lokasi_konstruksi_12_check'] ?? null,
                'lokasi_konstruksi_12_action' => $data['lokasi_konstruksi_12_action'] ?? null,
                'lokasi_konstruksi_12_due' => $data['lokasi_konstruksi_12_due'] ?? null,
                'lokasi_konstruksi_13_check' => $data['lokasi_konstruksi_13_check'] ?? null,
                'lokasi_konstruksi_13_action' => $data['lokasi_konstruksi_13_action'] ?? null,
                'lokasi_konstruksi_13_due' => $data['lokasi_konstruksi_13_due'] ?? null,

                'pengemasan_penyimpanan_1_check' => $data['pengemasan_penyimpanan_1_check'] ?? null,
                'pengemasan_penyimpanan_1_action' => $data['pengemasan_penyimpanan_1_action'] ?? null,
                'pengemasan_penyimpanan_1_due' => $data['pengemasan_penyimpanan_1_due'] ?? null,
                'pengemasan_penyimpanan_2_check' => $data['pengemasan_penyimpanan_2_check'] ?? null,
                'pengemasan_penyimpanan_2_action' => $data['pengemasan_penyimpanan_2_action'] ?? null,
                'pengemasan_penyimpanan_2_due' => $data['pengemasan_penyimpanan_2_due'] ?? null,
                'pengemasan_penyimpanan_3_check' => $data['pengemasan_penyimpanan_3_check'] ?? null,
                'pengemasan_penyimpanan_3_action' => $data['pengemasan_penyimpanan_3_action'] ?? null,
                'pengemasan_penyimpanan_3_due' => $data['pengemasan_penyimpanan_3_due'] ?? null,
                'pengemasan_penyimpanan_4_check' => $data['pengemasan_penyimpanan_4_check'] ?? null,
                'pengemasan_penyimpanan_4_action' => $data['pengemasan_penyimpanan_4_action'] ?? null,
                'pengemasan_penyimpanan_4_due' => $data['pengemasan_penyimpanan_4_due'] ?? null,
                'pengemasan_penyimpanan_5_check' => $data['pengemasan_penyimpanan_5_check'] ?? null,
                'pengemasan_penyimpanan_5_action' => $data['pengemasan_penyimpanan_5_action'] ?? null,
                'pengemasan_penyimpanan_5_due' => $data['pengemasan_penyimpanan_5_due'] ?? null,
                'pengemasan_penyimpanan_6_check' => $data['pengemasan_penyimpanan_6_check'] ?? null,
                'pengemasan_penyimpanan_6_action' => $data['pengemasan_penyimpanan_6_action'] ?? null,
                'pengemasan_penyimpanan_6_due' => $data['pengemasan_penyimpanan_6_due'] ?? null,
                'pengemasan_penyimpanan_7_check' => $data['pengemasan_penyimpanan_7_check'] ?? null,
                'pengemasan_penyimpanan_7_action' => $data['pengemasan_penyimpanan_7_action'] ?? null,
                'pengemasan_penyimpanan_7_due' => $data['pengemasan_penyimpanan_7_due'] ?? null,
                'pengemasan_penyimpanan_8_check' => $data['pengemasan_penyimpanan_8_check'] ?? null,
                'pengemasan_penyimpanan_8_action' => $data['pengemasan_penyimpanan_8_action'] ?? null,
                'pengemasan_penyimpanan_8_due' => $data['pengemasan_penyimpanan_8_due'] ?? null,
                'pengemasan_penyimpanan_9_check' => $data['pengemasan_penyimpanan_9_check'] ?? null,
                'pengemasan_penyimpanan_9_action' => $data['pengemasan_penyimpanan_9_action'] ?? null,
                'pengemasan_penyimpanan_9_due' => $data['pengemasan_penyimpanan_9_due'] ?? null,
                'pengemasan_penyimpanan_10_check' => $data['pengemasan_penyimpanan_10_check'] ?? null,
                'pengemasan_penyimpanan_10_action' => $data['pengemasan_penyimpanan_10_action'] ?? null,
                'pengemasan_penyimpanan_10_due' => $data['pengemasan_penyimpanan_10_due'] ?? null,
                'pengemasan_penyimpanan_11_check' => $data['pengemasan_penyimpanan_11_check'] ?? null,
                'pengemasan_penyimpanan_11_action' => $data['pengemasan_penyimpanan_11_action'] ?? null,
                'pengemasan_penyimpanan_11_due' => $data['pengemasan_penyimpanan_11_due'] ?? null,
                'pengemasan_penyimpanan_12_check' => $data['pengemasan_penyimpanan_12_check'] ?? null,
                'pengemasan_penyimpanan_12_action' => $data['pengemasan_penyimpanan_12_action'] ?? null,
                'pengemasan_penyimpanan_12_due' => $data['pengemasan_penyimpanan_12_due'] ?? null,
                'pengemasan_penyimpanan_13_check' => $data['pengemasan_penyimpanan_13_check'] ?? null,
                'pengemasan_penyimpanan_13_action' => $data['pengemasan_penyimpanan_13_action'] ?? null,
                'pengemasan_penyimpanan_13_due' => $data['pengemasan_penyimpanan_13_due'] ?? null,

                'simbol_label_rambu_1_check' => $data['simbol_label_rambu_1_check'] ?? null,
                'simbol_label_rambu_1_action' => $data['simbol_label_rambu_1_action'] ?? null,
                'simbol_label_rambu_1_due' => $data['simbol_label_rambu_1_due'] ?? null,
                'simbol_label_rambu_2_check' => $data['simbol_label_rambu_2_check'] ?? null,
                'simbol_label_rambu_2_action' => $data['simbol_label_rambu_2_action'] ?? null,
                'simbol_label_rambu_2_due' => $data['simbol_label_rambu_2_due'] ?? null,
                'simbol_label_rambu_3_check' => $data['simbol_label_rambu_3_check'] ?? null,
                'simbol_label_rambu_3_action' => $data['simbol_label_rambu_3_action'] ?? null,
                'simbol_label_rambu_3_due' => $data['simbol_label_rambu_3_due'] ?? null,
                'simbol_label_rambu_4_check' => $data['simbol_label_rambu_4_check'] ?? null,
                'simbol_label_rambu_4_action' => $data['simbol_label_rambu_4_action'] ?? null,
                'simbol_label_rambu_4_due' => $data['simbol_label_rambu_4_due'] ?? null,
                'simbol_label_rambu_5_check' => $data['simbol_label_rambu_5_check'] ?? null,
                'simbol_label_rambu_5_action' => $data['simbol_label_rambu_5_action'] ?? null,
                'simbol_label_rambu_5_due' => $data['simbol_label_rambu_5_due'] ?? null,
                'simbol_label_rambu_6_check' => $data['simbol_label_rambu_6_check'] ?? null,
                'simbol_label_rambu_6_action' => $data['simbol_label_rambu_6_action'] ?? null,
                'simbol_label_rambu_6_due' => $data['simbol_label_rambu_6_due'] ?? null,
                'simbol_label_rambu_7_check' => $data['simbol_label_rambu_7_check'] ?? null,
                'simbol_label_rambu_7_action' => $data['simbol_label_rambu_7_action'] ?? null,
                'simbol_label_rambu_7_due' => $data['simbol_label_rambu_7_due'] ?? null,
                'simbol_label_rambu_8_check' => $data['simbol_label_rambu_8_check'] ?? null,
                'simbol_label_rambu_8_action' => $data['simbol_label_rambu_8_action'] ?? null,
                'simbol_label_rambu_8_due' => $data['simbol_label_rambu_8_due'] ?? null,

                'keselamatan_darurat_1_check' => $data['keselamatan_darurat_1_check'] ?? null,
                'keselamatan_darurat_1_action' => $data['keselamatan_darurat_1_action'] ?? null,
                'keselamatan_darurat_1_due' => $data['keselamatan_darurat_1_due'] ?? null,
                'keselamatan_darurat_2_check' => $data['keselamatan_darurat_2_check'] ?? null,
                'keselamatan_darurat_2_action' => $data['keselamatan_darurat_2_action'] ?? null,
                'keselamatan_darurat_2_due' => $data['keselamatan_darurat_2_due'] ?? null,
                'keselamatan_darurat_3_check' => $data['keselamatan_darurat_3_check'] ?? null,
                'keselamatan_darurat_3_action' => $data['keselamatan_darurat_3_action'] ?? null,
                'keselamatan_darurat_3_due' => $data['keselamatan_darurat_3_due'] ?? null,
                'keselamatan_darurat_4_check' => $data['keselamatan_darurat_4_check'] ?? null,
                'keselamatan_darurat_4_action' => $data['keselamatan_darurat_4_action'] ?? null,
                'keselamatan_darurat_4_due' => $data['keselamatan_darurat_4_due'] ?? null,
                'keselamatan_darurat_5_check' => $data['keselamatan_darurat_5_check'] ?? null,
                'keselamatan_darurat_5_action' => $data['keselamatan_darurat_5_action'] ?? null,
                'keselamatan_darurat_5_due' => $data['keselamatan_darurat_5_due'] ?? null,
                'keselamatan_darurat_6_check' => $data['keselamatan_darurat_6_check'] ?? null,
                'keselamatan_darurat_6_action' => $data['keselamatan_darurat_6_action'] ?? null,
                'keselamatan_darurat_6_due' => $data['keselamatan_darurat_6_due'] ?? null,
                'keselamatan_darurat_7_check' => $data['keselamatan_darurat_7_check'] ?? null,
                'keselamatan_darurat_7_action' => $data['keselamatan_darurat_7_action'] ?? null,
                'keselamatan_darurat_7_due' => $data['keselamatan_darurat_7_due'] ?? null,
                'keselamatan_darurat_8_check' => $data['keselamatan_darurat_8_check'] ?? null,
                'keselamatan_darurat_8_action' => $data['keselamatan_darurat_8_action'] ?? null,
                'keselamatan_darurat_8_due' => $data['keselamatan_darurat_8_due'] ?? null,
                'keselamatan_darurat_9_check' => $data['keselamatan_darurat_9_check'] ?? null,
                'keselamatan_darurat_9_action' => $data['keselamatan_darurat_9_action'] ?? null,
                'keselamatan_darurat_9_due' => $data['keselamatan_darurat_9_due'] ?? null,
                'keselamatan_darurat_10_check' => $data['keselamatan_darurat_10_check'] ?? null,
                'keselamatan_darurat_10_action' => $data['keselamatan_darurat_10_action'] ?? null,
                'keselamatan_darurat_10_due' => $data['keselamatan_darurat_10_due'] ?? null,
                'keselamatan_darurat_11_check' => $data['keselamatan_darurat_11_check'] ?? null,
                'keselamatan_darurat_11_action' => $data['keselamatan_darurat_11_action'] ?? null,
                'keselamatan_darurat_11_due' => $data['keselamatan_darurat_11_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
                'dokumentasi_1' => $dokumentasi['dokumentasi_1'] ?? null,
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'] ?? null,
            ];



            InspeksiAreaLimbahB3::create($dataToInsert);

            return redirect()->route('inspeksi.arealimbahb3')->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiAreaLimbahB3::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.arealimbahb3')->with('success', 'Inspeksi berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.arealimbahb3')->with('info', nl2br('Inspeksi gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $sp = DB::table('se_inspeksi_arealimbahb3 as sp')
        ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'sp.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'sp.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'sp.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'sp.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'sp.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'sp.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'sp.inspektor6', '=', 'us6.nik')
        ->leftJoin('users as us7', 'sp.inspektor7', '=', 'us7.nik')
        ->leftJoin('users as us9', 'sp.penanggungjawab', '=', 'us9.nik')
        ->select(
            'sp.*',
            'sp.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, sp.created_at, 120) as tanggal_pembuatan'),
            'sp.statusenabled',
            'sp.nama_lokasi',
            'ar.keterangan as pit',
            'sp.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'us1.position as jabatan_inspektor1',
            'sp.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'us2.position as jabatan_inspektor2',
            'sp.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'us3.position as jabatan_inspektor3',
            'sp.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'us4.position as jabatan_inspektor4',
            'sp.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'us5.position as jabatan_inspektor5',
            'sp.inspektor6 as nik_inspektor6',
            'us6.name as nama_inspektor6',
            'us6.position as jabatan_inspektor6',
            'sp.inspektor7 as nik_inspektor7',
            'us7.name as nama_inspektor7',
            'us7.position as jabatan_inspektor7',
            'sp.penanggungjawab as nik_penanggungjawab',
            'us9.name as nama_penanggungjawab',
            'sp.verified_penanggungjawab',
            'sp.tanggal_inspeksi',
        )
        ->where('sp.statusenabled', true)
        ->where('sp.uuid', $uuid)->first();

        if($sp == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $sp;

            $qrTempFolder = storage_path('app/public/qr-temp');
            if (!File::exists($qrTempFolder)) {
                File::makeDirectory($qrTempFolder, 0755, true);
            }

            if ($item->verified_inspektor1 != null) {
                $fileName = 'verified_inspektor1' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor1)]), $filePath);

                $item->verified_inspektor1 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor1 = null;
            }

            if ($item->verified_inspektor2 != null) {
                $fileName = 'verified_inspektor2' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(250)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor2)]), $filePath);

                $item->verified_inspektor2 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor2 = null;
            }

            if ($item->verified_inspektor3 != null) {
                $fileName = 'verified_inspektor3' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(350)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor3)]), $filePath);

                $item->verified_inspektor3 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor3 = null;
            }

            if ($item->verified_inspektor4 != null) {
                $fileName = 'verified_inspektor4' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(450)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor4)]), $filePath);

                $item->verified_inspektor4 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor4 = null;
            }

            if ($item->verified_inspektor5 != null) {
                $fileName = 'verified_inspektor5' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(550)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor5)]), $filePath);

                $item->verified_inspektor5 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor5 = null;
            }

            if ($item->verified_inspektor6 != null) {
                $fileName = 'verified_inspektor6' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(660)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor6)]), $filePath);

                $item->verified_inspektor6 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor6 = null;
            }

            if ($item->verified_inspektor7 != null) {
                $fileName = 'verified_inspektor7' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(660)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor7)]), $filePath);

                $item->verified_inspektor7 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor7 = null;
            }

            if ($item->verified_inspektor8 != null) {
                $fileName = 'verified_inspektor8' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(660)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor8)]), $filePath);

                $item->verified_inspektor8 = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor8 = null;
            }
            
        }

        return view('inspeksi.area-limbah-b3.preview', compact('sp'));
    }
}
