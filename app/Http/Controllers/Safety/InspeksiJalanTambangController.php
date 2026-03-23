<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiJalanTambang;
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

class InspeksiJalanTambangController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiJalanTambang' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_jalantambang as jt')
        ->leftJoin('users as us', 'jt.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'jt.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'jt.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'jt.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'jt.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'jt.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'jt.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'jt.penanggungjawab', '=', 'us6.nik')
        ->select(
            'jt.id',
            'jt.uuid',
            'jt.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, jt.created_at, 120) as tanggal_pembuatan'),
            'jt.statusenabled',
            'jt.nama_lokasi',
            'ar.keterangan as pit',
            'jt.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'jt.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'jt.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'jt.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'jt.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'jt.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            'jt.verified_inspektor1',
            'jt.verified_penanggungjawab',
            'jt.tanggal_inspeksi',
        )
        ->where('jt.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, jt.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

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
                $query->where('jt.penanggungjawab', Auth::user()->nik)
                    ->orWhere('jt.inspektor1', Auth::user()->nik);
            });
        }

        $jt = $baseQuery->get();


        return view('inspeksi.jalan-tambang.index', compact('jt'));
    }

    public function insert()
    {
        $pit = Area::where('statusenabled', true)->get();
        $penanggungjawab = Personal::whereIn('ROLETYPE', [2, 3, 4])->orderBy('PERSONALNAME')->get();
        $inspektor = User::whereIn('departemen_id', [9])->orderBy('name')->get();

        $users = [
            'pit' => $pit,
            'penanggungjawab' => $penanggungjawab,
            'inspektor' => $inspektor,
        ];

        return view('inspeksi.jalan-tambang.insert', compact('users'));
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

                /*
                =======================
                SECTION 1 — DIMENSI JALAN
                =======================
                */

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


                /*
                =======================
                SECTION 2 — KONDISI FISIK
                =======================
                */

                'fisik_21_check' => $data['fisik_21_check'] ?? null,
                'fisik_21_action' => $data['fisik_21_action'] ?? null,
                'fisik_21_due' => $data['fisik_21_due'] ?? null,

                'fisik_22_check' => $data['fisik_22_check'] ?? null,
                'fisik_22_action' => $data['fisik_22_action'] ?? null,
                'fisik_22_due' => $data['fisik_22_due'] ?? null,

                'fisik_23_check' => $data['fisik_23_check'] ?? null,
                'fisik_23_action' => $data['fisik_23_action'] ?? null,
                'fisik_23_due' => $data['fisik_23_due'] ?? null,

                'fisik_24_check' => $data['fisik_24_check'] ?? null,
                'fisik_24_action' => $data['fisik_24_action'] ?? null,
                'fisik_24_due' => $data['fisik_24_due'] ?? null,


                /*
                =======================
                SECTION 3 — TANGGUL
                =======================
                */

                'tanggul_31_check' => $data['tanggul_31_check'] ?? null,
                'tanggul_31_action' => $data['tanggul_31_action'] ?? null,
                'tanggul_31_due' => $data['tanggul_31_due'] ?? null,

                'tanggul_32_check' => $data['tanggul_32_check'] ?? null,
                'tanggul_32_action' => $data['tanggul_32_action'] ?? null,
                'tanggul_32_due' => $data['tanggul_32_due'] ?? null,

                'tanggul_33_check' => $data['tanggul_33_check'] ?? null,
                'tanggul_33_action' => $data['tanggul_33_action'] ?? null,
                'tanggul_33_due' => $data['tanggul_33_due'] ?? null,

                'tanggul_34_check' => $data['tanggul_34_check'] ?? null,
                'tanggul_34_action' => $data['tanggul_34_action'] ?? null,
                'tanggul_34_due' => $data['tanggul_34_due'] ?? null,

                'tanggul_35_check' => $data['tanggul_35_check'] ?? null,
                'tanggul_35_action' => $data['tanggul_35_action'] ?? null,
                'tanggul_35_due' => $data['tanggul_35_due'] ?? null,


                /*
                =======================
                SECTION 4 — PATOK
                =======================
                */

                'patok_41_check' => $data['patok_41_check'] ?? null,
                'patok_41_action' => $data['patok_41_action'] ?? null,
                'patok_41_due' => $data['patok_41_due'] ?? null,

                'patok_42_check' => $data['patok_42_check'] ?? null,
                'patok_42_action' => $data['patok_42_action'] ?? null,
                'patok_42_due' => $data['patok_42_due'] ?? null,

                'patok_43_check' => $data['patok_43_check'] ?? null,
                'patok_43_action' => $data['patok_43_action'] ?? null,
                'patok_43_due' => $data['patok_43_due'] ?? null,

                'patok_44_check' => $data['patok_44_check'] ?? null,
                'patok_44_action' => $data['patok_44_action'] ?? null,
                'patok_44_due' => $data['patok_44_due'] ?? null,


                /*
                =======================
                SECTION 5 — RAMBU
                =======================
                */

                'rambu_51_check' => $data['rambu_51_check'] ?? null,
                'rambu_51_action' => $data['rambu_51_action'] ?? null,
                'rambu_51_due' => $data['rambu_51_due'] ?? null,

                'rambu_52_check' => $data['rambu_52_check'] ?? null,
                'rambu_52_action' => $data['rambu_52_action'] ?? null,
                'rambu_52_due' => $data['rambu_52_due'] ?? null,

                'rambu_53_check' => $data['rambu_53_check'] ?? null,
                'rambu_53_action' => $data['rambu_53_action'] ?? null,
                'rambu_53_due' => $data['rambu_53_due'] ?? null,

                'rambu_54_check' => $data['rambu_54_check'] ?? null,
                'rambu_54_action' => $data['rambu_54_action'] ?? null,
                'rambu_54_due' => $data['rambu_54_due'] ?? null,

                'rambu_55_check' => $data['rambu_55_check'] ?? null,
                'rambu_55_action' => $data['rambu_55_action'] ?? null,
                'rambu_55_due' => $data['rambu_55_due'] ?? null,


                /*
                =======================
                SECTION 6 — PERSIMPANGAN
                =======================
                */

                'simpang_61_check' => $data['simpang_61_check'] ?? null,
                'simpang_61_action' => $data['simpang_61_action'] ?? null,
                'simpang_61_due' => $data['simpang_61_due'] ?? null,

                'simpang_62_check' => $data['simpang_62_check'] ?? null,
                'simpang_62_action' => $data['simpang_62_action'] ?? null,
                'simpang_62_due' => $data['simpang_62_due'] ?? null,

                'simpang_63_check' => $data['simpang_63_check'] ?? null,
                'simpang_63_action' => $data['simpang_63_action'] ?? null,
                'simpang_63_due' => $data['simpang_63_due'] ?? null,

                'simpang_64_check' => $data['simpang_64_check'] ?? null,
                'simpang_64_action' => $data['simpang_64_action'] ?? null,
                'simpang_64_due' => $data['simpang_64_due'] ?? null,

                'simpang_65_check' => $data['simpang_65_check'] ?? null,
                'simpang_65_action' => $data['simpang_65_action'] ?? null,
                'simpang_65_due' => $data['simpang_65_due'] ?? null,

                'simpang_66_check' => $data['simpang_66_check'] ?? null,
                'simpang_66_action' => $data['simpang_66_action'] ?? null,
                'simpang_66_due' => $data['simpang_66_due'] ?? null,

                'simpang_67_check' => $data['simpang_67_check'] ?? null,
                'simpang_67_action' => $data['simpang_67_action'] ?? null,
                'simpang_67_due' => $data['simpang_67_due'] ?? null,

                'simpang_68_check' => $data['simpang_68_check'] ?? null,
                'simpang_68_action' => $data['simpang_68_action'] ?? null,
                'simpang_68_due' => $data['simpang_68_due'] ?? null,

                'simpang_69_check' => $data['simpang_69_check'] ?? null,
                'simpang_69_action' => $data['simpang_69_action'] ?? null,
                'simpang_69_due' => $data['simpang_69_due'] ?? null,

                'simpang_610_check' => $data['simpang_610_check'] ?? null,
                'simpang_610_action' => $data['simpang_610_action'] ?? null,
                'simpang_610_due' => $data['simpang_610_due'] ?? null,

                'simpang_611_check' => $data['simpang_611_check'] ?? null,
                'simpang_611_action' => $data['simpang_611_action'] ?? null,
                'simpang_611_due' => $data['simpang_611_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
            ];


            InspeksiJalanTambang::create($dataToInsert);

            return redirect()->route('inspeksi.jalantambang')->with('success', 'Inspeksi Jalan Tambang berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi Jalan Tambang gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiJalanTambang::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.jalantambang')->with('success', 'Inspeksi Jalan Tambang berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.jalantambang')->with('info', nl2br('Inspeksi Jalan Tambang gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $jt = DB::table('se_inspeksi_jalantambang as jt')
        ->leftJoin('users as us', 'jt.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'jt.pit', '=', 'ar.id')
        ->leftJoin('users as us1', 'jt.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'jt.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'jt.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'jt.inspektor4', '=', 'us4.nik')
        ->leftJoin('users as us5', 'jt.inspektor5', '=', 'us5.nik')
        ->leftJoin('users as us6', 'jt.penanggungjawab', '=', 'us6.nik')

        ->select(
            'jt.*',
            'ar.keterangan as pit',
            'us.name as nama_pic',
            'ar.keterangan as pit',
            'jt.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'jt.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'jt.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'jt.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'jt.inspektor5 as nik_inspektor5',
            'us5.name as nama_inspektor5',
            'jt.penanggungjawab as nik_penanggungjawab',
            'us6.name as nama_penanggungjawab',
            )
        ->where('jt.statusenabled', true)
        ->where('jt.uuid', $uuid)->first();

        if($jt == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $jt;

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

        return view('inspeksi.jalan-tambang.preview', compact('jt'));
    }
}
