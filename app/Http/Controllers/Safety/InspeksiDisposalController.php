<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiDisposal;
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

class InspeksiDisposalController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiDisposal' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_disposal as dp')
        ->leftJoin('users as us', 'dp.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'dp.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'dp.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'dp.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'dp.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'dp.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'dp.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'dp.penanggungjawab', '=', 'us6.nik')
        ->select(
            'dp.id',
            'dp.uuid',
            'dp.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, dp.created_at, 120) as tanggal_pembuatan'),
            'dp.statusenabled',
            'dp.nama_lokasi',
            'ar.keterangan as pit',
            'dp.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'dp.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'dp.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'dp.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'dp.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'dp.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            'dp.verified_inspektor1',
            'dp.verified_penanggungjawab',
            'dp.tanggal_inspeksi',
        )
        ->where('dp.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, dp.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);


        if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'])) {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }

        $baseQuery = $baseQuery->where(function($query) {
            $query->where('dp.penanggungjawab', Auth::user()->nik)
                    ->orWhere('dp.inspektor1', Auth::user()->nik);
        });

        $dp = $baseQuery->get();


        return view('inspeksi.disposal.index', compact('dp'));
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

        return view('inspeksi.disposal.insert', compact('users'));
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


                'kondisi_fisik_21_check' => $data['kondisi_fisik_21_check'] ?? null,
                'kondisi_fisik_21_action' => $data['kondisi_fisik_21_action'] ?? null,
                'kondisi_fisik_21_due' => $data['kondisi_fisik_21_due'] ?? null,

                'kondisi_fisik_22_check' => $data['kondisi_fisik_22_check'] ?? null,
                'kondisi_fisik_22_action' => $data['kondisi_fisik_22_action'] ?? null,
                'kondisi_fisik_22_due' => $data['kondisi_fisik_22_due'] ?? null,

                'kondisi_fisik_23_check' => $data['kondisi_fisik_23_check'] ?? null,
                'kondisi_fisik_23_action' => $data['kondisi_fisik_23_action'] ?? null,
                'kondisi_fisik_23_due' => $data['kondisi_fisik_23_due'] ?? null,

                'kondisi_fisik_24_check' => $data['kondisi_fisik_24_check'] ?? null,
                'kondisi_fisik_24_action' => $data['kondisi_fisik_24_action'] ?? null,
                'kondisi_fisik_24_due' => $data['kondisi_fisik_24_due'] ?? null,

                'kondisi_fisik_25_check' => $data['kondisi_fisik_25_check'] ?? null,
                'kondisi_fisik_25_action' => $data['kondisi_fisik_25_action'] ?? null,
                'kondisi_fisik_25_due' => $data['kondisi_fisik_25_due'] ?? null,


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

                'pengawas_45_check' => $data['pengawas_45_check'] ?? null,
                'pengawas_45_action' => $data['pengawas_45_action'] ?? null,
                'pengawas_45_due' => $data['pengawas_45_due'] ?? null,

                'pengawas_46_check' => $data['pengawas_46_check'] ?? null,
                'pengawas_46_action' => $data['pengawas_46_action'] ?? null,
                'pengawas_46_due' => $data['pengawas_46_due'] ?? null,

                'pengawas_47_check' => $data['pengawas_47_check'] ?? null,
                'pengawas_47_action' => $data['pengawas_47_action'] ?? null,
                'pengawas_47_due' => $data['pengawas_47_due'] ?? null,

                'pengawas_48_check' => $data['pengawas_48_check'] ?? null,
                'pengawas_48_action' => $data['pengawas_48_action'] ?? null,
                'pengawas_48_due' => $data['pengawas_48_due'] ?? null,


                'kondisi_dumping_51_check' => $data['kondisi_dumping_51_check'] ?? null,
                'kondisi_dumping_51_action' => $data['kondisi_dumping_51_action'] ?? null,
                'kondisi_dumping_51_due' => $data['kondisi_dumping_51_due'] ?? null,

                'kondisi_dumping_52_check' => $data['kondisi_dumping_52_check'] ?? null,
                'kondisi_dumping_52_action' => $data['kondisi_dumping_52_action'] ?? null,
                'kondisi_dumping_52_due' => $data['kondisi_dumping_52_due'] ?? null,

                'kondisi_dumping_53_check' => $data['kondisi_dumping_53_check'] ?? null,
                'kondisi_dumping_53_action' => $data['kondisi_dumping_53_action'] ?? null,
                'kondisi_dumping_53_due' => $data['kondisi_dumping_53_due'] ?? null,

                'kondisi_dumping_54_check' => $data['kondisi_dumping_54_check'] ?? null,
                'kondisi_dumping_54_action' => $data['kondisi_dumping_54_action'] ?? null,
                'kondisi_dumping_54_due' => $data['kondisi_dumping_54_due'] ?? null,

                'kondisi_dumping_55_check' => $data['kondisi_dumping_55_check'] ?? null,
                'kondisi_dumping_55_action' => $data['kondisi_dumping_55_action'] ?? null,
                'kondisi_dumping_55_due' => $data['kondisi_dumping_55_due'] ?? null,

                'kondisi_dumping_56_check' => $data['kondisi_dumping_56_check'] ?? null,
                'kondisi_dumping_56_action' => $data['kondisi_dumping_56_action'] ?? null,
                'kondisi_dumping_56_due' => $data['kondisi_dumping_56_due'] ?? null,

                'kondisi_dumping_57_check' => $data['kondisi_dumping_57_check'] ?? null,
                'kondisi_dumping_57_action' => $data['kondisi_dumping_57_action'] ?? null,
                'kondisi_dumping_57_due' => $data['kondisi_dumping_57_due'] ?? null,

                'kondisi_dumping_58_check' => $data['kondisi_dumping_58_check'] ?? null,
                'kondisi_dumping_58_action' => $data['kondisi_dumping_58_action'] ?? null,
                'kondisi_dumping_58_due' => $data['kondisi_dumping_58_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
            ];


            InspeksiDisposal::create($dataToInsert);

            return redirect()->route('inspeksi.disposal')->with('success', 'Inspeksi Disposal berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi Disposal gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiDisposal::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.disposal')->with('success', 'Inspeksi Disposal berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.disposal')->with('info', nl2br('Inspeksi Disposal gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $dp = DB::table('se_inspeksi_disposal as dp')
        ->leftJoin('users as us', 'dp.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'dp.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'dp.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'dp.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'dp.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'dp.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'dp.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'dp.penanggungjawab', '=', 'us6.nik')

        ->select(
            'dp.*',
            'ar.keterangan as pit',
            'us.name as nama_pic',
            'ar.keterangan as pit',
            'dp.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'dp.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'dp.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'dp.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'dp.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'dp.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            )
        ->where('dp.statusenabled', true)
        ->where('dp.uuid', $uuid)->first();

        if($dp == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $dp;

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

        return view('inspeksi.disposal.preview', compact('dp'));
    }
}
