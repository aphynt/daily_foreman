<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\InspeksiFrontLoading;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;

class InspeksiFrontLoadingController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiFrontLoading' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_frontloading as fl')
        ->leftJoin('users as us', 'fl.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'fl.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'fl.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'fl.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'fl.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'fl.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'fl.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'fl.penanggungjawab', '=', 'us6.nik')
        ->select(
            'fl.id',
            'fl.uuid',
            'fl.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, fl.created_at, 120) as tanggal_pembuatan'),
            'fl.statusenabled',
            'fl.nama_lokasi',
            'ar.keterangan as pit',
            'fl.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'fl.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'fl.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'fl.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'fl.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'fl.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            'fl.verified_inspektor1',
            'fl.verified_penanggungjawab',
            'fl.tanggal_inspeksi',
        )
        ->where('fl.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, fl.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);


        if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'])) {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }

        $baseQuery = $baseQuery->where(function($query) {
            $query->where('fl.penanggungjawab', Auth::user()->nik)
                    ->orWhere('fl.inspektor1', Auth::user()->nik);
        });

        $fl = $baseQuery->get();


        return view('inspeksi.front-loading.index', compact('fl'));
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

        return view('inspeksi.front-loading.insert', compact('users'));
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


                'dimensi_11_check' => $data['dimensi_11_check'] ?? null,
                'dimensi_11_action' => $data['dimensi_11_action'] ?? null,
                'dimensi_11_due' => $data['dimensi_11_due'] ?? null,

                'dimensi_12_check' => $data['dimensi_12_check'] ?? null,
                'dimensi_12_action' => $data['dimensi_12_action'] ?? null,
                'dimensi_12_due' => $data['dimensi_12_due'] ?? null,

                'dimensi_13_check' => $data['dimensi_13_check'] ?? null,
                'dimensi_13_action' => $data['dimensi_13_action'] ?? null,
                'dimensi_13_due' => $data['dimensi_13_due'] ?? null,

                'dimensi_14_check' => $data['dimensi_14_check'] ?? null,
                'dimensi_14_action' => $data['dimensi_14_action'] ?? null,
                'dimensi_14_due' => $data['dimensi_14_due'] ?? null,

                'dimensi_15_check' => $data['dimensi_15_check'] ?? null,
                'dimensi_15_action' => $data['dimensi_15_action'] ?? null,
                'dimensi_15_due' => $data['dimensi_15_due'] ?? null,


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


                'fasilitas_31_check' => $data['fasilitas_31_check'] ?? null,
                'fasilitas_31_action' => $data['fasilitas_31_action'] ?? null,
                'fasilitas_31_due' => $data['fasilitas_31_due'] ?? null,

                'fasilitas_32_check' => $data['fasilitas_32_check'] ?? null,
                'fasilitas_32_action' => $data['fasilitas_32_action'] ?? null,
                'fasilitas_32_due' => $data['fasilitas_32_due'] ?? null,

                'fasilitas_33_check' => $data['fasilitas_33_check'] ?? null,
                'fasilitas_33_action' => $data['fasilitas_33_action'] ?? null,
                'fasilitas_33_due' => $data['fasilitas_33_due'] ?? null,

                'fasilitas_34_check' => $data['fasilitas_34_check'] ?? null,
                'fasilitas_34_action' => $data['fasilitas_34_action'] ?? null,
                'fasilitas_34_due' => $data['fasilitas_34_due'] ?? null,

                'fasilitas_35_check' => $data['fasilitas_35_check'] ?? null,
                'fasilitas_35_action' => $data['fasilitas_35_action'] ?? null,
                'fasilitas_35_due' => $data['fasilitas_35_due'] ?? null,

                'fasilitas_36_check' => $data['fasilitas_36_check'] ?? null,
                'fasilitas_36_action' => $data['fasilitas_36_action'] ?? null,
                'fasilitas_36_due' => $data['fasilitas_36_due'] ?? null,

                'fasilitas_37_check' => $data['fasilitas_37_check'] ?? null,
                'fasilitas_37_action' => $data['fasilitas_37_action'] ?? null,
                'fasilitas_37_due' => $data['fasilitas_37_due'] ?? null,


                'pengawas_41_check' => $data['pengawas_41_check'] ?? null,
                'pengawas_41_action' => $data['pengawas_41_action'] ?? null,
                'pengawas_41_due' => $data['pengawas_41_due'] ?? null,

                'pengawas_42_check' => $data['pengawas_42_check'] ?? null,
                'pengawas_42_action' => $data['pengawas_42_action'] ?? null,
                'pengawas_42_due' => $data['pengawas_42_due'] ?? null,

                'pengawas_43_check' => $data['pengawas_43_check'] ?? null,
                'pengawas_43_action' => $data['pengawas_43_action'] ?? null,
                'pengawas_43_due' => $data['pengawas_43_due'] ?? null,

                'pengawas_44_check' => $data['pengawas_44_check'] ?? null,
                'pengawas_44_action' => $data['pengawas_44_action'] ?? null,
                'pengawas_44_due' => $data['pengawas_44_due'] ?? null,


                'manuver_51_check' => $data['manuver_51_check'] ?? null,
                'manuver_51_action' => $data['manuver_51_action'] ?? null,
                'manuver_51_due' => $data['manuver_51_due'] ?? null,

                'manuver_52_check' => $data['manuver_52_check'] ?? null,
                'manuver_52_action' => $data['manuver_52_action'] ?? null,
                'manuver_52_due' => $data['manuver_52_due'] ?? null,

                'manuver_53_check' => $data['manuver_53_check'] ?? null,
                'manuver_53_action' => $data['manuver_53_action'] ?? null,
                'manuver_53_due' => $data['manuver_53_due'] ?? null,

                'manuver_54_check' => $data['manuver_54_check'] ?? null,
                'manuver_54_action' => $data['manuver_54_action'] ?? null,
                'manuver_54_due' => $data['manuver_54_due'] ?? null,

                'manuver_55_check' => $data['manuver_55_check'] ?? null,
                'manuver_55_action' => $data['manuver_55_action'] ?? null,
                'manuver_55_due' => $data['manuver_55_due'] ?? null,

                'manuver_56_check' => $data['manuver_56_check'] ?? null,
                'manuver_56_action' => $data['manuver_56_action'] ?? null,
                'manuver_56_due' => $data['manuver_56_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
            ];


            InspeksiFrontLoading::create($dataToInsert);

            return redirect()->route('inspeksi.frontloading')->with('success', 'Inspeksi Front Loading berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi Front Loading gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiFrontLoading::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.frontloading')->with('success', 'Inspeksi Front Loading berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.frontloading')->with('info', nl2br('Inspeksi Front Loading gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $fl = DB::table('se_inspeksi_frontloading as fl')
        ->leftJoin('users as us', 'fl.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'fl.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'fl.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'fl.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'fl.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'fl.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'fl.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'fl.penanggungjawab', '=', 'us6.nik')

        ->select(
            'fl.*',
            'ar.keterangan as pit',
            'us.name as nama_pic',
            'ar.keterangan as pit',
            'fl.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'fl.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'fl.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'fl.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'fl.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'fl.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            )
        ->where('fl.statusenabled', true)
        ->where('fl.uuid', $uuid)->first();

        if($fl == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $fl;

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

        return view('inspeksi.front-loading.preview', compact('fl'));
    }
}
