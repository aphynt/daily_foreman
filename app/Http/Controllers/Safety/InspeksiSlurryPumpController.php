<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiSlurryPump;
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

class InspeksiSlurryPumpController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiSlurryPump' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_slurrypump as sp')
        ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'sp.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'sp.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'sp.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'sp.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'sp.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'sp.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'sp.penanggungjawab', '=', 'us6.nik')
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
            'sp.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            'sp.verified_inspektor1',
            'sp.verified_penanggungjawab',
            'sp.tanggal_inspeksi',
        )
        ->where('sp.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, sp.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'])) {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }

        $baseQuery = $baseQuery->where(function($query) {
            $query->where('sp.penanggungjawab', Auth::user()->nik)
                    ->orWhere('sp.inspektor1', Auth::user()->nik);
        });

        $sp = $baseQuery->get();


        return view('inspeksi.slurry-pump.index', compact('sp'));
    }

    public function insert()
    {
        $pit = Area::where('statusenabled', true)->where('group', 'production')->get();
        $penanggungjawab = Personal::whereIn('ROLETYPE', [2, 3, 4])->orderBy('PERSONALNAME')->get();
        $inspektor = User::where(function ($query) {
        $query->whereIn('departemen_id', [9])
                ->orWhereIn('id', [
                    8043, 8044, 8045, 8046, 8047, 8048, 8049,
                    8050, 8051, 8052, 8053, 8054, 8055, 8056
                ]);
        })
        ->orderBy('name')->get();

        $users = [
            'pit' => $pit,
            'penanggungjawab' => $penanggungjawab,
            'inspektor' => $inspektor,
        ];

        return view('inspeksi.slurry-pump.insert', compact('users'));
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


                'kelengkapan_11_check' => $data['kelengkapan_11_check'] ?? null,
                'kelengkapan_11_action' => $data['kelengkapan_11_action'] ?? null,
                'kelengkapan_11_due' => $data['kelengkapan_11_due'] ?? null,

                'kelengkapan_12_check' => $data['kelengkapan_12_check'] ?? null,
                'kelengkapan_12_action' => $data['kelengkapan_12_action'] ?? null,
                'kelengkapan_12_due' => $data['kelengkapan_12_due'] ?? null,

                'kondisi_21_check' => $data['kondisi_21_check'] ?? null,
                'kondisi_21_action' => $data['kondisi_21_action'] ?? null,
                'kondisi_21_due' => $data['kondisi_21_due'] ?? null,

                'kondisi_22_check' => $data['kondisi_22_check'] ?? null,
                'kondisi_22_action' => $data['kondisi_22_action'] ?? null,
                'kondisi_22_due' => $data['kondisi_22_due'] ?? null,

                'kondisi_23_check' => $data['kondisi_23_check'] ?? null,
                'kondisi_23_action' => $data['kondisi_23_action'] ?? null,
                'kondisi_23_due' => $data['kondisi_23_due'] ?? null,

                'kondisi_24_check' => $data['kondisi_24_check'] ?? null,
                'kondisi_24_action' => $data['kondisi_24_action'] ?? null,
                'kondisi_24_due' => $data['kondisi_24_due'] ?? null,

                'kondisi_25_check' => $data['kondisi_25_check'] ?? null,
                'kondisi_25_action' => $data['kondisi_25_action'] ?? null,
                'kondisi_25_due' => $data['kondisi_25_due'] ?? null,

                'kondisi_26_check' => $data['kondisi_26_check'] ?? null,
                'kondisi_26_action' => $data['kondisi_26_action'] ?? null,
                'kondisi_26_due' => $data['kondisi_26_due'] ?? null,

                'sticker_31_check' => $data['sticker_31_check'] ?? null,
                'sticker_31_action' => $data['sticker_31_action'] ?? null,
                'sticker_31_due' => $data['sticker_31_due'] ?? null,

                'sticker_32_check' => $data['sticker_32_check'] ?? null,
                'sticker_32_action' => $data['sticker_32_action'] ?? null,
                'sticker_32_due' => $data['sticker_32_due'] ?? null,

                'sticker_33_check' => $data['sticker_33_check'] ?? null,
                'sticker_33_action' => $data['sticker_33_action'] ?? null,
                'sticker_33_due' => $data['sticker_33_due'] ?? null,

                'sticker_34_check' => $data['sticker_34_check'] ?? null,
                'sticker_34_action' => $data['sticker_34_action'] ?? null,
                'sticker_34_due' => $data['sticker_34_due'] ?? null,

                'sticker_35_check' => $data['sticker_35_check'] ?? null,
                'sticker_35_action' => $data['sticker_35_action'] ?? null,
                'sticker_35_due' => $data['sticker_35_due'] ?? null,

                'sticker_36_check' => $data['sticker_36_check'] ?? null,
                'sticker_36_action' => $data['sticker_36_action'] ?? null,
                'sticker_36_due' => $data['sticker_36_due'] ?? null,

                'sticker_37_check' => $data['sticker_37_check'] ?? null,
                'sticker_37_action' => $data['sticker_37_action'] ?? null,
                'sticker_37_due' => $data['sticker_37_due'] ?? null,

                'sticker_38_check' => $data['sticker_38_check'] ?? null,
                'sticker_38_action' => $data['sticker_38_action'] ?? null,
                'sticker_38_due' => $data['sticker_38_due'] ?? null,

                'sticker_39_check' => $data['sticker_39_check'] ?? null,
                'sticker_39_action' => $data['sticker_39_action'] ?? null,
                'sticker_39_due' => $data['sticker_39_due'] ?? null,

                'lampu_41_check' => $data['lampu_41_check'] ?? null,
                'lampu_41_action' => $data['lampu_41_action'] ?? null,
                'lampu_41_due' => $data['lampu_41_due'] ?? null,

                'lampu_42_check' => $data['lampu_42_check'] ?? null,
                'lampu_42_action' => $data['lampu_42_action'] ?? null,
                'lampu_42_due' => $data['lampu_42_due'] ?? null,

                'lampu_43_check' => $data['lampu_43_check'] ?? null,
                'lampu_43_action' => $data['lampu_43_action'] ?? null,
                'lampu_43_due' => $data['lampu_43_due'] ?? null,

                'lampu_44_check' => $data['lampu_44_check'] ?? null,
                'lampu_44_action' => $data['lampu_44_action'] ?? null,
                'lampu_44_due' => $data['lampu_44_due'] ?? null,

                'lampu_45_check' => $data['lampu_45_check'] ?? null,
                'lampu_45_action' => $data['lampu_45_action'] ?? null,
                'lampu_45_due' => $data['lampu_45_due'] ?? null,

                'lampu_46_check' => $data['lampu_46_check'] ?? null,
                'lampu_46_action' => $data['lampu_46_action'] ?? null,
                'lampu_46_due' => $data['lampu_46_due'] ?? null,

                'lampu_47_check' => $data['lampu_47_check'] ?? null,
                'lampu_47_action' => $data['lampu_47_action'] ?? null,
                'lampu_47_due' => $data['lampu_47_due'] ?? null,

                'mesin_51_check' => $data['mesin_51_check'] ?? null,
                'mesin_51_action' => $data['mesin_51_action'] ?? null,
                'mesin_51_due' => $data['mesin_51_due'] ?? null,

                'mesin_52_check' => $data['mesin_52_check'] ?? null,
                'mesin_52_action' => $data['mesin_52_action'] ?? null,
                'mesin_52_due' => $data['mesin_52_due'] ?? null,

                'mesin_53_check' => $data['mesin_53_check'] ?? null,
                'mesin_53_action' => $data['mesin_53_action'] ?? null,
                'mesin_53_due' => $data['mesin_53_due'] ?? null,

                'mesin_54_check' => $data['mesin_54_check'] ?? null,
                'mesin_54_action' => $data['mesin_54_action'] ?? null,
                'mesin_54_due' => $data['mesin_54_due'] ?? null,

                'mesin_55_check' => $data['mesin_55_check'] ?? null,
                'mesin_55_action' => $data['mesin_55_action'] ?? null,
                'mesin_55_due' => $data['mesin_55_due'] ?? null,

                'mesin_56_check' => $data['mesin_56_check'] ?? null,
                'mesin_56_action' => $data['mesin_56_action'] ?? null,
                'mesin_56_due' => $data['mesin_56_due'] ?? null,

                'mesin_57_check' => $data['mesin_57_check'] ?? null,
                'mesin_57_action' => $data['mesin_57_action'] ?? null,
                'mesin_57_due' => $data['mesin_57_due'] ?? null,

                'mesin_58_check' => $data['mesin_58_check'] ?? null,
                'mesin_58_action' => $data['mesin_58_action'] ?? null,
                'mesin_58_due' => $data['mesin_58_due'] ?? null,

                'mesin_59_check' => $data['mesin_59_check'] ?? null,
                'mesin_59_action' => $data['mesin_59_action'] ?? null,
                'mesin_59_due' => $data['mesin_59_due'] ?? null,

                'mesin_510_check' => $data['mesin_510_check'] ?? null,
                'mesin_510_action' => $data['mesin_510_action'] ?? null,
                'mesin_510_due' => $data['mesin_510_due'] ?? null,

                'lain_61_check' => $data['lain_61_check'] ?? null,
                'lain_61_action' => $data['lain_61_action'] ?? null,
                'lain_61_due' => $data['lain_61_due'] ?? null,

                'lain_62_check' => $data['lain_62_check'] ?? null,
                'lain_62_action' => $data['lain_62_action'] ?? null,
                'lain_62_due' => $data['lain_62_due'] ?? null,

                'lain_63_check' => $data['lain_63_check'] ?? null,
                'lain_63_action' => $data['lain_63_action'] ?? null,
                'lain_63_due' => $data['lain_63_due'] ?? null,

                'lain_64_check' => $data['lain_64_check'] ?? null,
                'lain_64_action' => $data['lain_64_action'] ?? null,
                'lain_64_due' => $data['lain_64_due'] ?? null,

                'lain_65_check' => $data['lain_65_check'] ?? null,
                'lain_65_action' => $data['lain_65_action'] ?? null,
                'lain_65_due' => $data['lain_65_due'] ?? null,
                'additional_notes' => $data['additional_notes'] ?? null,
            ];


            InspeksiSlurryPump::create($dataToInsert);

            return redirect()->route('inspeksi.slurrypump')->with('success', 'Inspeksi Slurry Pump berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi Slurry Pump gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiSlurryPump::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.slurrypump')->with('success', 'Inspeksi Slurry Pump berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.slurrypump')->with('info', nl2br('Inspeksi Slurry Pump gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $sp = DB::table('se_inspeksi_slurrypump as sp')
        ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'sp.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'sp.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'sp.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'sp.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'sp.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'sp.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'sp.penanggungjawab', '=', 'us6.nik')

        ->select(
            'sp.*',
            'ar.keterangan as pit',
            'us.name as nama_pic',
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
            'sp.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
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
        }

        return view('inspeksi.slurry-pump.preview', compact('sp'));
    }
}
