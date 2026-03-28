<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiOGS;
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

class InspeksiOGSController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiOGS' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_ogs as ogs')
        ->leftJoin('users as us', 'ogs.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'ogs.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'ogs.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'ogs.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'ogs.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ogs.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ogs.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'ogs.penanggungjawab', '=', 'us6.nik')
        ->select(
            'ogs.id',
            'ogs.uuid',
            'ogs.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, ogs.created_at, 120) as tanggal_pembuatan'),
            'ogs.statusenabled',
            'ogs.nama_lokasi',
            'ar.keterangan as pit',
            'ogs.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'ogs.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'ogs.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'ogs.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'ogs.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'ogs.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            'ogs.verified_inspektor1',
            'ogs.verified_penanggungjawab',
            'ogs.tanggal_inspeksi',
        )
        ->where('ogs.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, ogs.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'])) {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }

        $baseQuery = $baseQuery->where(function($query) {
            $query->where('ogs.penanggungjawab', Auth::user()->nik)
                    ->orWhere('ogs.inspektor1', Auth::user()->nik);
        });

        $ogs = $baseQuery->get();


        return view('inspeksi.ogs.index', compact('ogs'));
    }

    public function insert()
    {
        $pit = Area::where('statusenabled', true)->where('group', 'production')->get();
        $penanggungjawab = Personal::whereIn('ROLETYPE', [2, 3, 4])->orderBy('PERSONALNAME')->get();
        $inspektor = User::whereIn('departemen_id', [9])->orderBy('name')->get();

        $users = [
            'pit' => $pit,
            'penanggungjawab' => $penanggungjawab,
            'inspektor' => $inspektor,
        ];

        return view('inspeksi.ogs.insert', compact('users'));
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


                'geometri_11_check' => $data['geometri_11_check'] ?? null,
                'geometri_11_action' => $data['geometri_11_action'] ?? null,
                'geometri_11_due' => $data['geometri_11_due'] ?? null,

                'geometri_12_check' => $data['geometri_12_check'] ?? null,
                'geometri_12_action' => $data['geometri_12_action'] ?? null,
                'geometri_12_due' => $data['geometri_12_due'] ?? null,

                'geometri_13_check' => $data['geometri_13_check'] ?? null,
                'geometri_13_action' => $data['geometri_13_action'] ?? null,
                'geometri_13_due' => $data['geometri_13_due'] ?? null,

                'geometri_14_check' => $data['geometri_14_check'] ?? null,
                'geometri_14_action' => $data['geometri_14_action'] ?? null,
                'geometri_14_due' => $data['geometri_14_due'] ?? null,

                'geometri_15_check' => $data['geometri_15_check'] ?? null,
                'geometri_15_action' => $data['geometri_15_action'] ?? null,
                'geometri_15_due' => $data['geometri_15_due'] ?? null,

                'geometri_16_check' => $data['geometri_16_check'] ?? null,
                'geometri_16_action' => $data['geometri_16_action'] ?? null,
                'geometri_16_due' => $data['geometri_16_due'] ?? null,

                'geometri_17_check' => $data['geometri_17_check'] ?? null,
                'geometri_17_action' => $data['geometri_17_action'] ?? null,
                'geometri_17_due' => $data['geometri_17_due'] ?? null,

                'geometri_18_check' => $data['geometri_18_check'] ?? null,
                'geometri_18_action' => $data['geometri_18_action'] ?? null,
                'geometri_18_due' => $data['geometri_18_due'] ?? null,

                'geometri_19_check' => $data['geometri_19_check'] ?? null,
                'geometri_19_action' => $data['geometri_19_action'] ?? null,
                'geometri_19_due' => $data['geometri_19_due'] ?? null,


                'sarana_21_check' => $data['sarana_21_check'] ?? null,
                'sarana_21_action' => $data['sarana_21_action'] ?? null,
                'sarana_21_due' => $data['sarana_21_due'] ?? null,

                'sarana_22_check' => $data['sarana_22_check'] ?? null,
                'sarana_22_action' => $data['sarana_22_action'] ?? null,
                'sarana_22_due' => $data['sarana_22_due'] ?? null,

                'sarana_23_check' => $data['sarana_23_check'] ?? null,
                'sarana_23_action' => $data['sarana_23_action'] ?? null,
                'sarana_23_due' => $data['sarana_23_due'] ?? null,

                'sarana_24_check' => $data['sarana_24_check'] ?? null,
                'sarana_24_action' => $data['sarana_24_action'] ?? null,
                'sarana_24_due' => $data['sarana_24_due'] ?? null,

                'sarana_25_check' => $data['sarana_25_check'] ?? null,
                'sarana_25_action' => $data['sarana_25_action'] ?? null,
                'sarana_25_due' => $data['sarana_25_due'] ?? null,

                'sarana_26_check' => $data['sarana_26_check'] ?? null,
                'sarana_26_action' => $data['sarana_26_action'] ?? null,
                'sarana_26_due' => $data['sarana_26_due'] ?? null,


                'keselamatan_31_check' => $data['keselamatan_31_check'] ?? null,
                'keselamatan_31_action' => $data['keselamatan_31_action'] ?? null,
                'keselamatan_31_due' => $data['keselamatan_31_due'] ?? null,

                'keselamatan_32_check' => $data['keselamatan_32_check'] ?? null,
                'keselamatan_32_action' => $data['keselamatan_32_action'] ?? null,
                'keselamatan_32_due' => $data['keselamatan_32_due'] ?? null,

                'keselamatan_33_check' => $data['keselamatan_33_check'] ?? null,
                'keselamatan_33_action' => $data['keselamatan_33_action'] ?? null,
                'keselamatan_33_due' => $data['keselamatan_33_due'] ?? null,

                'keselamatan_34_check' => $data['keselamatan_34_check'] ?? null,
                'keselamatan_34_action' => $data['keselamatan_34_action'] ?? null,
                'keselamatan_34_due' => $data['keselamatan_34_due'] ?? null,

                'keselamatan_35_check' => $data['keselamatan_35_check'] ?? null,
                'keselamatan_35_action' => $data['keselamatan_35_action'] ?? null,
                'keselamatan_35_due' => $data['keselamatan_35_due'] ?? null,

                'keselamatan_36_check' => $data['keselamatan_36_check'] ?? null,
                'keselamatan_36_action' => $data['keselamatan_36_action'] ?? null,
                'keselamatan_36_due' => $data['keselamatan_36_due'] ?? null,


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

                'rambu_47_check' => $data['rambu_47_check'] ?? null,
                'rambu_47_action' => $data['rambu_47_action'] ?? null,
                'rambu_47_due' => $data['rambu_47_due'] ?? null,

                'rambu_48_check' => $data['rambu_48_check'] ?? null,
                'rambu_48_action' => $data['rambu_48_action'] ?? null,
                'rambu_48_due' => $data['rambu_48_due'] ?? null,

                'rambu_49_check' => $data['rambu_49_check'] ?? null,
                'rambu_49_action' => $data['rambu_49_action'] ?? null,
                'rambu_49_due' => $data['rambu_49_due'] ?? null,

                'rambu_410_check' => $data['rambu_410_check'] ?? null,
                'rambu_410_action' => $data['rambu_410_action'] ?? null,
                'rambu_410_due' => $data['rambu_410_due'] ?? null,

                'rambu_411_check' => $data['rambu_411_check'] ?? null,
                'rambu_411_action' => $data['rambu_411_action'] ?? null,
                'rambu_411_due' => $data['rambu_411_due'] ?? null,

                'rambu_412_check' => $data['rambu_412_check'] ?? null,
                'rambu_412_action' => $data['rambu_412_action'] ?? null,
                'rambu_412_due' => $data['rambu_412_due'] ?? null,

                'rambu_413_check' => $data['rambu_413_check'] ?? null,
                'rambu_413_action' => $data['rambu_413_action'] ?? null,
                'rambu_413_due' => $data['rambu_413_due'] ?? null,

                'rambu_414_check' => $data['rambu_414_check'] ?? null,
                'rambu_414_action' => $data['rambu_414_action'] ?? null,
                'rambu_414_due' => $data['rambu_414_due'] ?? null,

                'rambu_415_check' => $data['rambu_415_check'] ?? null,
                'rambu_415_action' => $data['rambu_415_action'] ?? null,
                'rambu_415_due' => $data['rambu_415_due'] ?? null,

                'rambu_416_check' => $data['rambu_416_check'] ?? null,
                'rambu_416_action' => $data['rambu_416_action'] ?? null,
                'rambu_416_due' => $data['rambu_416_due'] ?? null,

                'rambu_417_check' => $data['rambu_417_check'] ?? null,
                'rambu_417_action' => $data['rambu_417_action'] ?? null,
                'rambu_417_due' => $data['rambu_417_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
            ];


            InspeksiOGS::create($dataToInsert);

            return redirect()->route('inspeksi.ogs')->with('success', 'Inspeksi OGS berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi OGS gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiOGS::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.ogs')->with('success', 'Inspeksi OGS berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.ogs')->with('info', nl2br('Inspeksi OGS gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ogs = DB::table('se_inspeksi_ogs as ogs')
        ->leftJoin('users as us', 'ogs.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'ogs.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'ogs.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'ogs.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'ogs.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ogs.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ogs.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'ogs.penanggungjawab', '=', 'us6.nik')

        ->select(
            'ogs.*',
            'ar.keterangan as pit',
            'us.name as nama_pic',
            'ar.keterangan as pit',
            'ogs.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'ogs.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'ogs.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'ogs.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'ogs.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'ogs.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            )
        ->where('ogs.statusenabled', true)
        ->where('ogs.uuid', $uuid)->first();

        if($ogs == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $ogs;

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

        return view('inspeksi.ogs.preview', compact('ogs'));
    }
}
