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
                    ->orWhere('sp.inspektor1', Auth::user()->nik)
                    ->orWhere('sp.inspektor2', Auth::user()->nik)
                    ->orWhere('sp.inspektor3', Auth::user()->nik)
                    ->orWhere('sp.inspektor4', Auth::user()->nik)
                    ->orWhere('sp.inspektor5', Auth::user()->nik);
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
                    8050, 8051, 8052, 8053, 8054, 8055, 8056, 8058, 8059, 8062,
                    8063, 8066, 8067, 8068, 8069, 8070
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

                'fasilitas_11_check' => $data['fasilitas_11_check'] ?? null,
                'fasilitas_11_action' => $data['fasilitas_11_action'] ?? null,
                'fasilitas_11_due' => $data['fasilitas_11_due'] ?? null,

                'fasilitas_12_check' => $data['fasilitas_12_check'] ?? null,
                'fasilitas_12_action' => $data['fasilitas_12_action'] ?? null,
                'fasilitas_12_due' => $data['fasilitas_12_due'] ?? null,

                'fasilitas_13_check' => $data['fasilitas_13_check'] ?? null,
                'fasilitas_13_action' => $data['fasilitas_13_action'] ?? null,
                'fasilitas_13_due' => $data['fasilitas_13_due'] ?? null,

                'fasilitas_14_check' => $data['fasilitas_14_check'] ?? null,
                'fasilitas_14_action' => $data['fasilitas_14_action'] ?? null,
                'fasilitas_14_due' => $data['fasilitas_14_due'] ?? null,

                'fasilitas_15_check' => $data['fasilitas_15_check'] ?? null,
                'fasilitas_15_action' => $data['fasilitas_15_action'] ?? null,
                'fasilitas_15_due' => $data['fasilitas_15_due'] ?? null,

                'fasilitas_16_check' => $data['fasilitas_16_check'] ?? null,
                'fasilitas_16_action' => $data['fasilitas_16_action'] ?? null,
                'fasilitas_16_due' => $data['fasilitas_16_due'] ?? null,

                'fasilitas_17_check' => $data['fasilitas_17_check'] ?? null,
                'fasilitas_17_action' => $data['fasilitas_17_action'] ?? null,
                'fasilitas_17_due' => $data['fasilitas_17_due'] ?? null,

                'fasilitas_18_check' => $data['fasilitas_18_check'] ?? null,
                'fasilitas_18_action' => $data['fasilitas_18_action'] ?? null,
                'fasilitas_18_due' => $data['fasilitas_18_due'] ?? null,

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

                'kondisi_27_check' => $data['kondisi_27_check'] ?? null,
                'kondisi_27_action' => $data['kondisi_27_action'] ?? null,
                'kondisi_27_due' => $data['kondisi_27_due'] ?? null,

                'kondisi_28_check' => $data['kondisi_28_check'] ?? null,
                'kondisi_28_action' => $data['kondisi_28_action'] ?? null,
                'kondisi_28_due' => $data['kondisi_28_due'] ?? null,

                'kondisi_29_check' => $data['kondisi_29_check'] ?? null,
                'kondisi_29_action' => $data['kondisi_29_action'] ?? null,
                'kondisi_29_due' => $data['kondisi_29_due'] ?? null,

                'kondisi_210_check' => $data['kondisi_210_check'] ?? null,
                'kondisi_210_action' => $data['kondisi_210_action'] ?? null,
                'kondisi_210_due' => $data['kondisi_210_due'] ?? null,

                'kondisi_211_check' => $data['kondisi_211_check'] ?? null,
                'kondisi_211_action' => $data['kondisi_211_action'] ?? null,
                'kondisi_211_due' => $data['kondisi_211_due'] ?? null,

                'kondisi_212_check' => $data['kondisi_212_check'] ?? null,
                'kondisi_212_action' => $data['kondisi_212_action'] ?? null,
                'kondisi_212_due' => $data['kondisi_212_due'] ?? null,

                'kondisi_213_check' => $data['kondisi_213_check'] ?? null,
                'kondisi_213_action' => $data['kondisi_213_action'] ?? null,
                'kondisi_213_due' => $data['kondisi_213_due'] ?? null,

                'kondisi_214_check' => $data['kondisi_214_check'] ?? null,
                'kondisi_214_action' => $data['kondisi_214_action'] ?? null,
                'kondisi_214_due' => $data['kondisi_214_due'] ?? null,

                'perahu_31_check' => $data['perahu_31_check'] ?? null,
                'perahu_31_action' => $data['perahu_31_action'] ?? null,
                'perahu_31_due' => $data['perahu_31_due'] ?? null,

                'perahu_32_check' => $data['perahu_32_check'] ?? null,
                'perahu_32_action' => $data['perahu_32_action'] ?? null,
                'perahu_32_due' => $data['perahu_32_due'] ?? null,

                'perahu_33_check' => $data['perahu_33_check'] ?? null,
                'perahu_33_action' => $data['perahu_33_action'] ?? null,
                'perahu_33_due' => $data['perahu_33_due'] ?? null,

                'perahu_34_check' => $data['perahu_34_check'] ?? null,
                'perahu_34_action' => $data['perahu_34_action'] ?? null,
                'perahu_34_due' => $data['perahu_34_due'] ?? null,

                'pengawas_41_check' => $data['pengawas_41_check'] ?? null,
                'pengawas_41_action' => $data['pengawas_41_action'] ?? null,
                'pengawas_41_due' => $data['pengawas_41_due'] ?? null,

                'pengawas_42_check' => $data['pengawas_42_check'] ?? null,
                'pengawas_42_action' => $data['pengawas_42_action'] ?? null,
                'pengawas_42_due' => $data['pengawas_42_due'] ?? null,

                'pengawas_43_check' => $data['pengawas_43_check'] ?? null,
                'pengawas_43_action' => $data['pengawas_43_action'] ?? null,
                'pengawas_43_due' => $data['pengawas_43_due'] ?? null,

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
            'us1.position as jabatan_inspektor1',
            'sp.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'us2.position as jabatan_inspektor2',
            'sp.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'us3.position as jabatan_inspektor3',
            'sp.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'sp.inspektor5 as nik_inspektor5',
            'us4.position as jabatan_inspektor4',
            'us5.name as nama_inspektor5',
            'sp.penanggungjawab as nik_penanggungjawab',
            'us5.position as jabatan_inspektor5',
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
