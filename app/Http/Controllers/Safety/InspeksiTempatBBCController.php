<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiTempatBBC;
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

class InspeksiTempatBBCController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiTempatBBC' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_tempatbbc as sp')
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

        return view('inspeksi.tempat-bbc.index', compact('sp'));
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

        return view('inspeksi.tempat-bbc.insert', compact('users'));
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
                    $path = "inspeksi/tempatbbc/{$field}";

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

                'inspektor1'                 => $data['inspektor1'] ?? null,
                'verified_inspektor1'        => Auth::user()->nik,
                'date_verified_inspektor1'   => Carbon::now(),
                'inspektor2'                 => $data['inspektor2'] ?? null,
                'verified_inspektor2'        => $data['inspektor2'] ?? null,
                'date_verified_inspektor2'   => Carbon::now(),
                'inspektor3'                 => $data['inspektor3'] ?? null,
                'verified_inspektor3'        => $data['inspektor3'] ?? null,
                'date_verified_inspektor3'   => Carbon::now(),
                'inspektor4'                 => $data['inspektor4'] ?? null,
                'verified_inspektor4'        => $data['inspektor4'] ?? null,
                'date_verified_inspektor4'   => Carbon::now(),
                'inspektor5'                 => $data['inspektor5'] ?? null,
                'verified_inspektor5'        => $data['inspektor5'] ?? null,
                'date_verified_inspektor5'   => Carbon::now(),
                'inspektor6'                 => $data['inspektor6'] ?? null,
                'verified_inspektor6'        => $data['inspektor6'] ?? null,
                'date_verified_inspektor6'   => Carbon::now(),
                'inspektor7'                 => $data['inspektor7'] ?? null,
                'verified_inspektor7'        => $data['inspektor7'] ?? null,
                'date_verified_inspektor7'   => Carbon::now(),
                'inspektor8'                 => $data['inspektor8'] ?? null,
                'verified_inspektor8'        => $data['inspektor8'] ?? null,
                'date_verified_inspektor8'   => Carbon::now(),

                'housekeeping_1_check' => $data['housekeeping_1_check'] ?? null,
                'housekeeping_1_action' => $data['housekeeping_1_action'] ?? null,
                'housekeeping_1_due' => $data['housekeeping_1_due'] ?? null,
                'housekeeping_2_check' => $data['housekeeping_2_check'] ?? null,
                'housekeeping_2_action' => $data['housekeeping_2_action'] ?? null,
                'housekeeping_2_due' => $data['housekeeping_2_due'] ?? null,
                'housekeeping_3_check' => $data['housekeeping_3_check'] ?? null,
                'housekeeping_3_action' => $data['housekeeping_3_action'] ?? null,
                'housekeeping_3_due' => $data['housekeeping_3_due'] ?? null,
                'housekeeping_4_check' => $data['housekeeping_4_check'] ?? null,
                'housekeeping_4_action' => $data['housekeeping_4_action'] ?? null,
                'housekeeping_4_due' => $data['housekeeping_4_due'] ?? null,
                'housekeeping_5_check' => $data['housekeeping_5_check'] ?? null,
                'housekeeping_5_action' => $data['housekeeping_5_action'] ?? null,
                'housekeeping_5_due' => $data['housekeeping_5_due'] ?? null,
                'housekeeping_6_check' => $data['housekeeping_6_check'] ?? null,
                'housekeeping_6_action' => $data['housekeeping_6_action'] ?? null,
                'housekeeping_6_due' => $data['housekeeping_6_due'] ?? null,
                'housekeeping_7_check' => $data['housekeeping_7_check'] ?? null,
                'housekeeping_7_action' => $data['housekeeping_7_action'] ?? null,
                'housekeeping_7_due' => $data['housekeeping_7_due'] ?? null,
                'housekeeping_8_check' => $data['housekeeping_8_check'] ?? null,
                'housekeeping_8_action' => $data['housekeeping_8_action'] ?? null,
                'housekeeping_8_due' => $data['housekeeping_8_due'] ?? null,
                'emergency_equipment_1_check' => $data['emergency_equipment_1_check'] ?? null,
                'emergency_equipment_1_action' => $data['emergency_equipment_1_action'] ?? null,
                'emergency_equipment_1_due' => $data['emergency_equipment_1_due'] ?? null,
                'emergency_equipment_2_check' => $data['emergency_equipment_2_check'] ?? null,
                'emergency_equipment_2_action' => $data['emergency_equipment_2_action'] ?? null,
                'emergency_equipment_2_due' => $data['emergency_equipment_2_due'] ?? null,
                'emergency_equipment_3_check' => $data['emergency_equipment_3_check'] ?? null,
                'emergency_equipment_3_action' => $data['emergency_equipment_3_action'] ?? null,
                'emergency_equipment_3_due' => $data['emergency_equipment_3_due'] ?? null,
                'emergency_equipment_4_check' => $data['emergency_equipment_4_check'] ?? null,
                'emergency_equipment_4_action' => $data['emergency_equipment_4_action'] ?? null,
                'emergency_equipment_4_due' => $data['emergency_equipment_4_due'] ?? null,
                'emergency_equipment_5_check' => $data['emergency_equipment_5_check'] ?? null,
                'emergency_equipment_5_action' => $data['emergency_equipment_5_action'] ?? null,
                'emergency_equipment_5_due' => $data['emergency_equipment_5_due'] ?? null,
                'emergency_equipment_6_check' => $data['emergency_equipment_6_check'] ?? null,
                'emergency_equipment_6_action' => $data['emergency_equipment_6_action'] ?? null,
                'emergency_equipment_6_due' => $data['emergency_equipment_6_due'] ?? null,
                'emergency_equipment_7_check' => $data['emergency_equipment_7_check'] ?? null,
                'emergency_equipment_7_action' => $data['emergency_equipment_7_action'] ?? null,
                'emergency_equipment_7_due' => $data['emergency_equipment_7_due'] ?? null,
                'emergency_equipment_8_check' => $data['emergency_equipment_8_check'] ?? null,
                'emergency_equipment_8_action' => $data['emergency_equipment_8_action'] ?? null,
                'emergency_equipment_8_due' => $data['emergency_equipment_8_due'] ?? null,
                'emergency_equipment_9_check' => $data['emergency_equipment_9_check'] ?? null,
                'emergency_equipment_9_action' => $data['emergency_equipment_9_action'] ?? null,
                'emergency_equipment_9_due' => $data['emergency_equipment_9_due'] ?? null,
                'emergency_equipment_10_check' => $data['emergency_equipment_10_check'] ?? null,
                'emergency_equipment_10_action' => $data['emergency_equipment_10_action'] ?? null,
                'emergency_equipment_10_due' => $data['emergency_equipment_10_due'] ?? null,
                'emergency_equipment_11_check' => $data['emergency_equipment_11_check'] ?? null,
                'emergency_equipment_11_action' => $data['emergency_equipment_11_action'] ?? null,
                'emergency_equipment_11_due' => $data['emergency_equipment_11_due'] ?? null,
                'emergency_equipment_12_check' => $data['emergency_equipment_12_check'] ?? null,
                'emergency_equipment_12_action' => $data['emergency_equipment_12_action'] ?? null,
                'emergency_equipment_12_due' => $data['emergency_equipment_12_due'] ?? null,
                'emergency_equipment_13_check' => $data['emergency_equipment_13_check'] ?? null,
                'emergency_equipment_13_action' => $data['emergency_equipment_13_action'] ?? null,
                'emergency_equipment_13_due' => $data['emergency_equipment_13_due'] ?? null,
                'peralatan_fasilitas_1_check' => $data['peralatan_fasilitas_1_check'] ?? null,
                'peralatan_fasilitas_1_action' => $data['peralatan_fasilitas_1_action'] ?? null,
                'peralatan_fasilitas_1_due' => $data['peralatan_fasilitas_1_due'] ?? null,
                'peralatan_fasilitas_2_check' => $data['peralatan_fasilitas_2_check'] ?? null,
                'peralatan_fasilitas_2_action' => $data['peralatan_fasilitas_2_action'] ?? null,
                'peralatan_fasilitas_2_due' => $data['peralatan_fasilitas_2_due'] ?? null,
                'peralatan_fasilitas_3_check' => $data['peralatan_fasilitas_3_check'] ?? null,
                'peralatan_fasilitas_3_action' => $data['peralatan_fasilitas_3_action'] ?? null,
                'peralatan_fasilitas_3_due' => $data['peralatan_fasilitas_3_due'] ?? null,
                'peralatan_fasilitas_4_check' => $data['peralatan_fasilitas_4_check'] ?? null,
                'peralatan_fasilitas_4_action' => $data['peralatan_fasilitas_4_action'] ?? null,
                'peralatan_fasilitas_4_due' => $data['peralatan_fasilitas_4_due'] ?? null,
                'peralatan_fasilitas_5_check' => $data['peralatan_fasilitas_5_check'] ?? null,
                'peralatan_fasilitas_5_action' => $data['peralatan_fasilitas_5_action'] ?? null,
                'peralatan_fasilitas_5_due' => $data['peralatan_fasilitas_5_due'] ?? null,
                'peralatan_fasilitas_6_check' => $data['peralatan_fasilitas_6_check'] ?? null,
                'peralatan_fasilitas_6_action' => $data['peralatan_fasilitas_6_action'] ?? null,
                'peralatan_fasilitas_6_due' => $data['peralatan_fasilitas_6_due'] ?? null,
                'peralatan_fasilitas_7_check' => $data['peralatan_fasilitas_7_check'] ?? null,
                'peralatan_fasilitas_7_action' => $data['peralatan_fasilitas_7_action'] ?? null,
                'peralatan_fasilitas_7_due' => $data['peralatan_fasilitas_7_due'] ?? null,
                'peralatan_fasilitas_8_check' => $data['peralatan_fasilitas_8_check'] ?? null,
                'peralatan_fasilitas_8_action' => $data['peralatan_fasilitas_8_action'] ?? null,
                'peralatan_fasilitas_8_due' => $data['peralatan_fasilitas_8_due'] ?? null,
                'peralatan_fasilitas_9_check' => $data['peralatan_fasilitas_9_check'] ?? null,
                'peralatan_fasilitas_9_action' => $data['peralatan_fasilitas_9_action'] ?? null,
                'peralatan_fasilitas_9_due' => $data['peralatan_fasilitas_9_due'] ?? null,
                'peralatan_fasilitas_10_check' => $data['peralatan_fasilitas_10_check'] ?? null,
                'peralatan_fasilitas_10_action' => $data['peralatan_fasilitas_10_action'] ?? null,
                'peralatan_fasilitas_10_due' => $data['peralatan_fasilitas_10_due'] ?? null,
                'peralatan_fasilitas_11_check' => $data['peralatan_fasilitas_11_check'] ?? null,
                'peralatan_fasilitas_11_action' => $data['peralatan_fasilitas_11_action'] ?? null,
                'peralatan_fasilitas_11_due' => $data['peralatan_fasilitas_11_due'] ?? null,
                'peralatan_fasilitas_12_check' => $data['peralatan_fasilitas_12_check'] ?? null,
                'peralatan_fasilitas_12_action' => $data['peralatan_fasilitas_12_action'] ?? null,
                'peralatan_fasilitas_12_due' => $data['peralatan_fasilitas_12_due'] ?? null,
                'peralatan_fasilitas_13_check' => $data['peralatan_fasilitas_13_check'] ?? null,
                'peralatan_fasilitas_13_action' => $data['peralatan_fasilitas_13_action'] ?? null,
                'peralatan_fasilitas_13_due' => $data['peralatan_fasilitas_13_due'] ?? null,
                'peralatan_fasilitas_14_check' => $data['peralatan_fasilitas_14_check'] ?? null,
                'peralatan_fasilitas_14_action' => $data['peralatan_fasilitas_14_action'] ?? null,
                'peralatan_fasilitas_14_due' => $data['peralatan_fasilitas_14_due'] ?? null,
                'peralatan_fasilitas_15_check' => $data['peralatan_fasilitas_15_check'] ?? null,
                'peralatan_fasilitas_15_action' => $data['peralatan_fasilitas_15_action'] ?? null,
                'peralatan_fasilitas_15_due' => $data['peralatan_fasilitas_15_due'] ?? null,
                'peralatan_fasilitas_16_check' => $data['peralatan_fasilitas_16_check'] ?? null,
                'peralatan_fasilitas_16_action' => $data['peralatan_fasilitas_16_action'] ?? null,
                'peralatan_fasilitas_16_due' => $data['peralatan_fasilitas_16_due'] ?? null,
                'peralatan_fasilitas_17_check' => $data['peralatan_fasilitas_17_check'] ?? null,
                'peralatan_fasilitas_17_action' => $data['peralatan_fasilitas_17_action'] ?? null,
                'peralatan_fasilitas_17_due' => $data['peralatan_fasilitas_17_due'] ?? null,
                'peralatan_fasilitas_18_check' => $data['peralatan_fasilitas_18_check'] ?? null,
                'peralatan_fasilitas_18_action' => $data['peralatan_fasilitas_18_action'] ?? null,
                'peralatan_fasilitas_18_due' => $data['peralatan_fasilitas_18_due'] ?? null,
                'peralatan_fasilitas_19_check' => $data['peralatan_fasilitas_19_check'] ?? null,
                'peralatan_fasilitas_19_action' => $data['peralatan_fasilitas_19_action'] ?? null,
                'peralatan_fasilitas_19_due' => $data['peralatan_fasilitas_19_due'] ?? null,
                'peralatan_fasilitas_20_check' => $data['peralatan_fasilitas_20_check'] ?? null,
                'peralatan_fasilitas_20_action' => $data['peralatan_fasilitas_20_action'] ?? null,
                'peralatan_fasilitas_20_due' => $data['peralatan_fasilitas_20_due'] ?? null,
                'peralatan_fasilitas_21_check' => $data['peralatan_fasilitas_21_check'] ?? null,
                'peralatan_fasilitas_21_action' => $data['peralatan_fasilitas_21_action'] ?? null,
                'peralatan_fasilitas_21_due' => $data['peralatan_fasilitas_21_due'] ?? null,
                'peralatan_fasilitas_22_check' => $data['peralatan_fasilitas_22_check'] ?? null,
                'peralatan_fasilitas_22_action' => $data['peralatan_fasilitas_22_action'] ?? null,
                'peralatan_fasilitas_22_due' => $data['peralatan_fasilitas_22_due'] ?? null,
                'peralatan_fasilitas_23_check' => $data['peralatan_fasilitas_23_check'] ?? null,
                'peralatan_fasilitas_23_action' => $data['peralatan_fasilitas_23_action'] ?? null,
                'peralatan_fasilitas_23_due' => $data['peralatan_fasilitas_23_due'] ?? null,
                'peralatan_fasilitas_24_check' => $data['peralatan_fasilitas_24_check'] ?? null,
                'peralatan_fasilitas_24_action' => $data['peralatan_fasilitas_24_action'] ?? null,
                'peralatan_fasilitas_24_due' => $data['peralatan_fasilitas_24_due'] ?? null,
                'peralatan_fasilitas_25_check' => $data['peralatan_fasilitas_25_check'] ?? null,
                'peralatan_fasilitas_25_action' => $data['peralatan_fasilitas_25_action'] ?? null,
                'peralatan_fasilitas_25_due' => $data['peralatan_fasilitas_25_due'] ?? null,
                'peralatan_fasilitas_26_check' => $data['peralatan_fasilitas_26_check'] ?? null,
                'peralatan_fasilitas_26_action' => $data['peralatan_fasilitas_26_action'] ?? null,
                'peralatan_fasilitas_26_due' => $data['peralatan_fasilitas_26_due'] ?? null,
                'peralatan_fasilitas_27_check' => $data['peralatan_fasilitas_27_check'] ?? null,
                'peralatan_fasilitas_27_action' => $data['peralatan_fasilitas_27_action'] ?? null,
                'peralatan_fasilitas_27_due' => $data['peralatan_fasilitas_27_due'] ?? null,
                'peralatan_fasilitas_28_check' => $data['peralatan_fasilitas_28_check'] ?? null,
                'peralatan_fasilitas_28_action' => $data['peralatan_fasilitas_28_action'] ?? null,
                'peralatan_fasilitas_28_due' => $data['peralatan_fasilitas_28_due'] ?? null,
                'peralatan_fasilitas_29_check' => $data['peralatan_fasilitas_29_check'] ?? null,
                'peralatan_fasilitas_29_action' => $data['peralatan_fasilitas_29_action'] ?? null,
                'peralatan_fasilitas_29_due' => $data['peralatan_fasilitas_29_due'] ?? null,
                'peralatan_fasilitas_30_check' => $data['peralatan_fasilitas_30_check'] ?? null,
                'peralatan_fasilitas_30_action' => $data['peralatan_fasilitas_30_action'] ?? null,
                'peralatan_fasilitas_30_due' => $data['peralatan_fasilitas_30_due'] ?? null,
                'prosedur_kerja_1_check' => $data['prosedur_kerja_1_check'] ?? null,
                'prosedur_kerja_1_action' => $data['prosedur_kerja_1_action'] ?? null,
                'prosedur_kerja_1_due' => $data['prosedur_kerja_1_due'] ?? null,
                'prosedur_kerja_2_check' => $data['prosedur_kerja_2_check'] ?? null,
                'prosedur_kerja_2_action' => $data['prosedur_kerja_2_action'] ?? null,
                'prosedur_kerja_2_due' => $data['prosedur_kerja_2_due'] ?? null,
                'prosedur_kerja_3_check' => $data['prosedur_kerja_3_check'] ?? null,
                'prosedur_kerja_3_action' => $data['prosedur_kerja_3_action'] ?? null,
                'prosedur_kerja_3_due' => $data['prosedur_kerja_3_due'] ?? null,
                'rambu_1_check' => $data['rambu_1_check'] ?? null,
                'rambu_1_action' => $data['rambu_1_action'] ?? null,
                'rambu_1_due' => $data['rambu_1_due'] ?? null,
                'rambu_2_check' => $data['rambu_2_check'] ?? null,
                'rambu_2_action' => $data['rambu_2_action'] ?? null,
                'rambu_2_due' => $data['rambu_2_due'] ?? null,
                'rambu_3_check' => $data['rambu_3_check'] ?? null,
                'rambu_3_action' => $data['rambu_3_action'] ?? null,
                'rambu_3_due' => $data['rambu_3_due'] ?? null,
                'rambu_4_check' => $data['rambu_4_check'] ?? null,
                'rambu_4_action' => $data['rambu_4_action'] ?? null,
                'rambu_4_due' => $data['rambu_4_due'] ?? null,
                'rambu_5_check' => $data['rambu_5_check'] ?? null,
                'rambu_5_action' => $data['rambu_5_action'] ?? null,
                'rambu_5_due' => $data['rambu_5_due'] ?? null,
                'sampah_hidrokarbon_1_check' => $data['sampah_hidrokarbon_1_check'] ?? null,
                'sampah_hidrokarbon_1_action' => $data['sampah_hidrokarbon_1_action'] ?? null,
                'sampah_hidrokarbon_1_due' => $data['sampah_hidrokarbon_1_due'] ?? null,
                'sampah_hidrokarbon_2_check' => $data['sampah_hidrokarbon_2_check'] ?? null,
                'sampah_hidrokarbon_2_action' => $data['sampah_hidrokarbon_2_action'] ?? null,
                'sampah_hidrokarbon_2_due' => $data['sampah_hidrokarbon_2_due'] ?? null,
                'sampah_hidrokarbon_3_check' => $data['sampah_hidrokarbon_3_check'] ?? null,
                'sampah_hidrokarbon_3_action' => $data['sampah_hidrokarbon_3_action'] ?? null,
                'sampah_hidrokarbon_3_due' => $data['sampah_hidrokarbon_3_due'] ?? null,
                'perlengkapan_personil_1_check' => $data['perlengkapan_personil_1_check'] ?? null,
                'perlengkapan_personil_1_action' => $data['perlengkapan_personil_1_action'] ?? null,
                'perlengkapan_personil_1_due' => $data['perlengkapan_personil_1_due'] ?? null,
                'perlengkapan_personil_2_check' => $data['perlengkapan_personil_2_check'] ?? null,
                'perlengkapan_personil_2_action' => $data['perlengkapan_personil_2_action'] ?? null,
                'perlengkapan_personil_2_due' => $data['perlengkapan_personil_2_due'] ?? null,
                'perlengkapan_personil_3_check' => $data['perlengkapan_personil_3_check'] ?? null,
                'perlengkapan_personil_3_action' => $data['perlengkapan_personil_3_action'] ?? null,
                'perlengkapan_personil_3_due' => $data['perlengkapan_personil_3_due'] ?? null,
                'additional_notes' => $data['additional_notes'] ?? null,
                'dokumentasi_1' => $dokumentasi['dokumentasi_1'] ?? null,
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'] ?? null
            ];



            InspeksiTempatBBC::create($dataToInsert);

            return redirect()->route('inspeksi.tempatbbc')->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiTempatBBC::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.tempatbbc')->with('success', 'Inspeksi berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.tempatbbc')->with('info', nl2br('Inspeksi gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $sp = DB::table('se_inspeksi_tempatbbc as sp')
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

        return view('inspeksi.tempat-bbc.preview', compact('sp'));
    }
}
