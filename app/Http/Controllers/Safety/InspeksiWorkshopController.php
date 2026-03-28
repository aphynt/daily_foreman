<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use App\Models\Area;
use App\Models\InspeksiWorkshop;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;

class InspeksiWorkshopController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiWorkshop' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_workshop as ws')
        ->leftJoin('users as us', 'ws.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'ws.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'ws.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'ws.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'ws.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ws.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ws.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'ws.penanggungjawab', '=', 'us6.nik')
        ->select(
            'ws.id',
            'ws.uuid',
            'ws.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, ws.created_at, 120) as tanggal_pembuatan'),
            'ws.statusenabled',
            'ws.nama_lokasi',
            'ar.keterangan as pit',
            'ws.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'ws.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'ws.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'ws.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'ws.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'ws.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            'ws.verified_inspektor1',
            'ws.verified_penanggungjawab',
            'ws.tanggal_inspeksi',
        )
        ->where('ws.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, ws.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $roleBypass = getConfigArrayById(1);
        $roleBypassAdminManagement = getConfigArrayById(5);

        if (!$user->hasRoleId($roleBypassAdminManagement)) {
            if (
                $user->hasRoleId($roleBypass) ||
                $user->inDepartemenId([9])
            ) {
                $baseQuery->where(function ($q) use ($user) {
                    $q->where('pic', $user->id);
                });
            }

            $baseQuery = $baseQuery->where(function($query) {
                $query->where('ws.penanggungjawab', Auth::user()->nik)
                    ->orWhere('ws.inspektor1', Auth::user()->nik);
            });
        }

        $ws = $baseQuery->get();


        return view('inspeksi.workshop.index', compact('ws'));
    }

    public function insert()
    {
        $pit = Area::where('statusenabled', true)->get();
        $penanggungjawab = User::whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->orderBy('name')->get();
        $inspektor = User::whereIn('departemen_id', [9])->orderBy('name')->get();

        $users = [
            'pit' => $pit,
            'penanggungjawab' => $penanggungjawab,
            'inspektor' => $inspektor,
        ];

        return view('inspeksi.workshop.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();
            // dd($data);

            $dataToInsert = [

                'uuid'                       => (string) Uuid::uuid4(),
                'pic'                        => Auth::user()->id,
                'statusenabled'              => true,
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

                'tanggal_inspeksi' => $data['tanggal_inspeksi'] ?? null,
                'nama_lokasi'      => $data['nama_lokasi'] ?? null,
                'pit'              => $data['pit'] ?? null,
                'penanggungjawab' => $data['penanggungjawab'] ?? null,


                'housekeeping_11_check' => $data['housekeeping_11_check'] ?? null,
                'housekeeping_11_action' => $data['housekeeping_11_action'] ?? null,
                'housekeeping_11_due' => $data['housekeeping_11_due'] ?? null,

                'housekeeping_12_check' => $data['housekeeping_12_check'] ?? null,
                'housekeeping_12_action' => $data['housekeeping_12_action'] ?? null,
                'housekeeping_12_due' => $data['housekeeping_12_due'] ?? null,

                'housekeeping_13_check' => $data['housekeeping_13_check'] ?? null,
                'housekeeping_13_action' => $data['housekeeping_13_action'] ?? null,
                'housekeeping_13_due' => $data['housekeeping_13_due'] ?? null,

                'housekeeping_14_check' => $data['housekeeping_14_check'] ?? null,
                'housekeeping_14_action' => $data['housekeeping_14_action'] ?? null,
                'housekeeping_14_due' => $data['housekeeping_14_due'] ?? null,

                'housekeeping_15_check' => $data['housekeeping_15_check'] ?? null,
                'housekeeping_15_action' => $data['housekeeping_15_action'] ?? null,
                'housekeeping_15_due' => $data['housekeeping_15_due'] ?? null,

                'housekeeping_16_check' => $data['housekeeping_16_check'] ?? null,
                'housekeeping_16_action' => $data['housekeeping_16_action'] ?? null,
                'housekeeping_16_due' => $data['housekeeping_16_due'] ?? null,

                'housekeeping_17_check' => $data['housekeeping_17_check'] ?? null,
                'housekeeping_17_action' => $data['housekeeping_17_action'] ?? null,
                'housekeeping_17_due' => $data['housekeeping_17_due'] ?? null,

                'housekeeping_18_check' => $data['housekeeping_18_check'] ?? null,
                'housekeeping_18_action' => $data['housekeeping_18_action'] ?? null,
                'housekeeping_18_due' => $data['housekeeping_18_due'] ?? null,


                'tabung_21_check' => $data['tabung_21_check'] ?? null,
                'tabung_21_action' => $data['tabung_21_action'] ?? null,
                'tabung_21_due' => $data['tabung_21_due'] ?? null,

                'tabung_22_check' => $data['tabung_22_check'] ?? null,
                'tabung_22_action' => $data['tabung_22_action'] ?? null,
                'tabung_22_due' => $data['tabung_22_due'] ?? null,

                'tabung_23_check' => $data['tabung_23_check'] ?? null,
                'tabung_23_action' => $data['tabung_23_action'] ?? null,
                'tabung_23_due' => $data['tabung_23_due'] ?? null,

                'tabung_24_check' => $data['tabung_24_check'] ?? null,
                'tabung_24_action' => $data['tabung_24_action'] ?? null,
                'tabung_24_due' => $data['tabung_24_due'] ?? null,

                'tabung_25_check' => $data['tabung_25_check'] ?? null,
                'tabung_25_action' => $data['tabung_25_action'] ?? null,
                'tabung_25_due' => $data['tabung_25_due'] ?? null,

                'tabung_26_check' => $data['tabung_26_check'] ?? null,
                'tabung_26_action' => $data['tabung_26_action'] ?? null,
                'tabung_26_due' => $data['tabung_26_due'] ?? null,

                'tabung_27_check' => $data['tabung_27_check'] ?? null,
                'tabung_27_action' => $data['tabung_27_action'] ?? null,
                'tabung_27_due' => $data['tabung_27_due'] ?? null,

                'tabung_28_check' => $data['tabung_28_check'] ?? null,
                'tabung_28_action' => $data['tabung_28_action'] ?? null,
                'tabung_28_due' => $data['tabung_28_due'] ?? null,

                'tabung_29_check' => $data['tabung_29_check'] ?? null,
                'tabung_29_action' => $data['tabung_29_action'] ?? null,
                'tabung_29_due' => $data['tabung_29_due'] ?? null,

                'tabung_210_check' => $data['tabung_210_check'] ?? null,
                'tabung_210_action' => $data['tabung_210_action'] ?? null,
                'tabung_210_due' => $data['tabung_210_due'] ?? null,

                'tabung_211_check' => $data['tabung_211_check'] ?? null,
                'tabung_211_action' => $data['tabung_211_action'] ?? null,
                'tabung_211_due' => $data['tabung_211_due'] ?? null,

                'tabung_212_check' => $data['tabung_212_check'] ?? null,
                'tabung_212_action' => $data['tabung_212_action'] ?? null,
                'tabung_212_due' => $data['tabung_212_due'] ?? null,


                'apar_311_check' => $data['apar_311_check'] ?? null,
                'apar_311_action' => $data['apar_311_action'] ?? null,
                'apar_311_due' => $data['apar_311_due'] ?? null,

                'apar_312_check' => $data['apar_312_check'] ?? null,
                'apar_312_action' => $data['apar_312_action'] ?? null,
                'apar_312_due' => $data['apar_312_due'] ?? null,

                'apar_313_check' => $data['apar_313_check'] ?? null,
                'apar_313_action' => $data['apar_313_action'] ?? null,
                'apar_313_due' => $data['apar_313_due'] ?? null,

                'apar_314_check' => $data['apar_314_check'] ?? null,
                'apar_314_action' => $data['apar_314_action'] ?? null,
                'apar_314_due' => $data['apar_314_due'] ?? null,

                'apar_315_check' => $data['apar_315_check'] ?? null,
                'apar_315_action' => $data['apar_315_action'] ?? null,
                'apar_315_due' => $data['apar_315_due'] ?? null,

                'eyewash_321_check' => $data['eyewash_321_check'] ?? null,
                'eyewash_321_action' => $data['eyewash_321_action'] ?? null,
                'eyewash_321_due' => $data['eyewash_321_due'] ?? null,

                'eyewash_322_check' => $data['eyewash_322_check'] ?? null,
                'eyewash_322_action' => $data['eyewash_322_action'] ?? null,
                'eyewash_322_due' => $data['eyewash_322_due'] ?? null,

                'eyewash_323_check' => $data['eyewash_323_check'] ?? null,
                'eyewash_323_action' => $data['eyewash_323_action'] ?? null,
                'eyewash_323_due' => $data['eyewash_323_due'] ?? null,

                'eyewash_324_check' => $data['eyewash_324_check'] ?? null,
                'eyewash_324_action' => $data['eyewash_324_action'] ?? null,
                'eyewash_324_due' => $data['eyewash_324_due'] ?? null,

                'assembly_331_check' => $data['assembly_331_check'] ?? null,
                'assembly_331_action' => $data['assembly_331_action'] ?? null,
                'assembly_331_due' => $data['assembly_331_due'] ?? null,

                'assembly_332_check' => $data['assembly_332_check'] ?? null,
                'assembly_332_action' => $data['assembly_332_action'] ?? null,
                'assembly_332_due' => $data['assembly_332_due'] ?? null,


                'rambu_41_check' => $data['rambu_41_check'] ?? null,
                'rambu_41_action' => $data['rambu_41_action'] ?? null,
                'rambu_41_due' => $data['rambu_41_due'] ?? null,

                'rambu_42_check' => $data['rambu_42_check'] ?? null,
                'rambu_42_action' => $data['rambu_42_action'] ?? null,
                'rambu_42_due' => $data['rambu_42_due'] ?? null,

                'rambu_43_check' => $data['rambu_43_check'] ?? null,
                'rambu_43_action' => $data['rambu_43_action'] ?? null,
                'rambu_43_due' => $data['rambu_43_due'] ?? null,

                'rambu_44_check' => $data['rambu_44_check'] ?? null,
                'rambu_44_action' => $data['rambu_44_action'] ?? null,
                'rambu_44_due' => $data['rambu_44_due'] ?? null,

                'rambu_45_check' => $data['rambu_45_check'] ?? null,
                'rambu_45_action' => $data['rambu_45_action'] ?? null,
                'rambu_45_due' => $data['rambu_45_due'] ?? null,

                'rambu_46_check' => $data['rambu_46_check'] ?? null,
                'rambu_46_action' => $data['rambu_46_action'] ?? null,
                'rambu_46_due' => $data['rambu_46_due'] ?? null,

                'peralatan_51_check' => $data['peralatan_51_check'] ?? null,
                'peralatan_51_action' => $data['peralatan_51_action'] ?? null,
                'peralatan_51_due' => $data['peralatan_51_due'] ?? null,

                'peralatan_52_check' => $data['peralatan_52_check'] ?? null,
                'peralatan_52_action' => $data['peralatan_52_action'] ?? null,
                'peralatan_52_due' => $data['peralatan_52_due'] ?? null,

                'peralatan_53_check' => $data['peralatan_53_check'] ?? null,
                'peralatan_53_action' => $data['peralatan_53_action'] ?? null,
                'peralatan_53_due' => $data['peralatan_53_due'] ?? null,

                'peralatan_54_check' => $data['peralatan_54_check'] ?? null,
                'peralatan_54_action' => $data['peralatan_54_action'] ?? null,
                'peralatan_54_due' => $data['peralatan_54_due'] ?? null,

                'peralatan_55_check' => $data['peralatan_55_check'] ?? null,
                'peralatan_55_action' => $data['peralatan_55_action'] ?? null,
                'peralatan_55_due' => $data['peralatan_55_due'] ?? null,

                'peralatan_56_check' => $data['peralatan_56_check'] ?? null,
                'peralatan_56_action' => $data['peralatan_56_action'] ?? null,
                'peralatan_56_due' => $data['peralatan_56_due'] ?? null,

                'loto_61_check' => $data['loto_61_check'] ?? null,
                'loto_61_action' => $data['loto_61_action'] ?? null,
                'loto_61_due' => $data['loto_61_due'] ?? null,

                'loto_62_check' => $data['loto_62_check'] ?? null,
                'loto_62_action' => $data['loto_62_action'] ?? null,
                'loto_62_due' => $data['loto_62_due'] ?? null,

                'loto_63_check' => $data['loto_63_check'] ?? null,
                'loto_63_action' => $data['loto_63_action'] ?? null,
                'loto_63_due' => $data['loto_63_due'] ?? null,

                'loto_64_check' => $data['loto_64_check'] ?? null,
                'loto_64_action' => $data['loto_64_action'] ?? null,
                'loto_64_due' => $data['loto_64_due'] ?? null,

                'loto_65_check' => $data['loto_65_check'] ?? null,
                'loto_65_action' => $data['loto_65_action'] ?? null,
                'loto_65_due' => $data['loto_65_due'] ?? null,

                'loto_66_check' => $data['loto_66_check'] ?? null,
                'loto_66_action' => $data['loto_66_action'] ?? null,
                'loto_66_due' => $data['loto_66_due'] ?? null,

                'loto_67_check' => $data['loto_67_check'] ?? null,
                'loto_67_action' => $data['loto_67_action'] ?? null,
                'loto_67_due' => $data['loto_67_due'] ?? null,


                'kondisi_umum_711_check' => $data['kondisi_umum_711_check'] ?? null,
                'kondisi_umum_711_action' => $data['kondisi_umum_711_action'] ?? null,
                'kondisi_umum_711_due' => $data['kondisi_umum_711_due'] ?? null,

                'kondisi_umum_712_check' => $data['kondisi_umum_712_check'] ?? null,
                'kondisi_umum_712_action' => $data['kondisi_umum_712_action'] ?? null,
                'kondisi_umum_712_due' => $data['kondisi_umum_712_due'] ?? null,

                'kondisi_umum_713_check' => $data['kondisi_umum_713_check'] ?? null,
                'kondisi_umum_713_action' => $data['kondisi_umum_713_action'] ?? null,
                'kondisi_umum_713_due' => $data['kondisi_umum_713_due'] ?? null,

                'kondisi_umum_714_check' => $data['kondisi_umum_714_check'] ?? null,
                'kondisi_umum_714_action' => $data['kondisi_umum_714_action'] ?? null,
                'kondisi_umum_714_due' => $data['kondisi_umum_714_due'] ?? null,

                'kondisi_umum_715_check' => $data['kondisi_umum_715_check'] ?? null,
                'kondisi_umum_715_action' => $data['kondisi_umum_715_action'] ?? null,
                'kondisi_umum_715_due' => $data['kondisi_umum_715_due'] ?? null,

                'kondisi_umum_716_check' => $data['kondisi_umum_716_check'] ?? null,
                'kondisi_umum_716_action' => $data['kondisi_umum_716_action'] ?? null,
                'kondisi_umum_716_due' => $data['kondisi_umum_716_due'] ?? null,

                'hydrocarbon_721_check' => $data['hydrocarbon_721_check'] ?? null,
                'hydrocarbon_721_action' => $data['hydrocarbon_721_action'] ?? null,
                'hydrocarbon_721_due' => $data['hydrocarbon_721_due'] ?? null,

                'hydrocarbon_722_check' => $data['hydrocarbon_722_check'] ?? null,
                'hydrocarbon_722_action' => $data['hydrocarbon_722_action'] ?? null,
                'hydrocarbon_722_due' => $data['hydrocarbon_722_due'] ?? null,

                'hydrocarbon_723_check' => $data['hydrocarbon_723_check'] ?? null,
                'hydrocarbon_723_action' => $data['hydrocarbon_723_action'] ?? null,
                'hydrocarbon_723_due' => $data['hydrocarbon_723_due'] ?? null,

                'oil_731_check' => $data['oil_731_check'] ?? null,
                'oil_731_action' => $data['oil_731_action'] ?? null,
                'oil_731_due' => $data['oil_731_due'] ?? null,

                'oil_732_check' => $data['oil_732_check'] ?? null,
                'oil_732_action' => $data['oil_732_action'] ?? null,
                'oil_732_due' => $data['oil_732_due'] ?? null,

                'oil_733_check' => $data['oil_733_check'] ?? null,
                'oil_733_action' => $data['oil_733_action'] ?? null,
                'oil_733_due' => $data['oil_733_due'] ?? null,


                'additional_notes' => $data['additional_notes'] ?? null,
            ];


            InspeksiWorkshop::create($dataToInsert);

            return redirect()->route('inspeksi.workshop')->with('success', 'Inspeksi Workshop berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi Workshop gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiWorkshop::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.workshop')->with('success', 'Inspeksi Workshop berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.workshop')->with('info', nl2br('Inspeksi Workshop gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ws = DB::table('se_inspeksi_workshop as ws')
        ->leftJoin('users as us', 'ws.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'ws.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'ws.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'ws.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'ws.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ws.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ws.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'ws.penanggungjawab', '=', 'us6.nik')

        ->select(
            'ws.*',
            'ar.keterangan as pit',
            'us.name as nama_pic',
            'ar.keterangan as pit',
            'ws.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'ws.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'ws.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'ws.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'ws.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'ws.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
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
        }

        return view('inspeksi.workshop.preview', compact('ws'));
    }
}
