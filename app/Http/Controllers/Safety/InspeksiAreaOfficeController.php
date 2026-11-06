<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiAreaOffice;
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

class InspeksiAreaOfficeController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiAreaOffice' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_areaoffice as sp')
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

        return view('inspeksi.area-office.index', compact('sp'));
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

        return view('inspeksi.area-office.insert', compact('users'));
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
                    $path = "inspeksi/areaoffice/{$field}";

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

                'administrasi_k3l_1_check' => $data['administrasi_k3l_1_check'] ?? null,
                'administrasi_k3l_1_action' => $data['administrasi_k3l_1_action'] ?? null,
                'administrasi_k3l_1_due' => $data['administrasi_k3l_1_due'] ?? null,
                'administrasi_k3l_2_check' => $data['administrasi_k3l_2_check'] ?? null,
                'administrasi_k3l_2_action' => $data['administrasi_k3l_2_action'] ?? null,
                'administrasi_k3l_2_due' => $data['administrasi_k3l_2_due'] ?? null,
                'administrasi_k3l_3_check' => $data['administrasi_k3l_3_check'] ?? null,
                'administrasi_k3l_3_action' => $data['administrasi_k3l_3_action'] ?? null,
                'administrasi_k3l_3_due' => $data['administrasi_k3l_3_due'] ?? null,
                'administrasi_k3l_4_check' => $data['administrasi_k3l_4_check'] ?? null,
                'administrasi_k3l_4_action' => $data['administrasi_k3l_4_action'] ?? null,
                'administrasi_k3l_4_due' => $data['administrasi_k3l_4_due'] ?? null,
                'administrasi_k3l_5_check' => $data['administrasi_k3l_5_check'] ?? null,
                'administrasi_k3l_5_action' => $data['administrasi_k3l_5_action'] ?? null,
                'administrasi_k3l_5_due' => $data['administrasi_k3l_5_due'] ?? null,
                'administrasi_k3l_6_check' => $data['administrasi_k3l_6_check'] ?? null,
                'administrasi_k3l_6_action' => $data['administrasi_k3l_6_action'] ?? null,
                'administrasi_k3l_6_due' => $data['administrasi_k3l_6_due'] ?? null,

                'bangunan_tata_ruang_1_check' => $data['bangunan_tata_ruang_1_check'] ?? null,
                'bangunan_tata_ruang_1_action' => $data['bangunan_tata_ruang_1_action'] ?? null,
                'bangunan_tata_ruang_1_due' => $data['bangunan_tata_ruang_1_due'] ?? null,
                'bangunan_tata_ruang_2_check' => $data['bangunan_tata_ruang_2_check'] ?? null,
                'bangunan_tata_ruang_2_action' => $data['bangunan_tata_ruang_2_action'] ?? null,
                'bangunan_tata_ruang_2_due' => $data['bangunan_tata_ruang_2_due'] ?? null,
                'bangunan_tata_ruang_3_check' => $data['bangunan_tata_ruang_3_check'] ?? null,
                'bangunan_tata_ruang_3_action' => $data['bangunan_tata_ruang_3_action'] ?? null,
                'bangunan_tata_ruang_3_due' => $data['bangunan_tata_ruang_3_due'] ?? null,
                'bangunan_tata_ruang_4_check' => $data['bangunan_tata_ruang_4_check'] ?? null,
                'bangunan_tata_ruang_4_action' => $data['bangunan_tata_ruang_4_action'] ?? null,
                'bangunan_tata_ruang_4_due' => $data['bangunan_tata_ruang_4_due'] ?? null,
                'bangunan_tata_ruang_5_check' => $data['bangunan_tata_ruang_5_check'] ?? null,
                'bangunan_tata_ruang_5_action' => $data['bangunan_tata_ruang_5_action'] ?? null,
                'bangunan_tata_ruang_5_due' => $data['bangunan_tata_ruang_5_due'] ?? null,
                'bangunan_tata_ruang_6_check' => $data['bangunan_tata_ruang_6_check'] ?? null,
                'bangunan_tata_ruang_6_action' => $data['bangunan_tata_ruang_6_action'] ?? null,
                'bangunan_tata_ruang_6_due' => $data['bangunan_tata_ruang_6_due'] ?? null,
                'bangunan_tata_ruang_7_check' => $data['bangunan_tata_ruang_7_check'] ?? null,
                'bangunan_tata_ruang_7_action' => $data['bangunan_tata_ruang_7_action'] ?? null,
                'bangunan_tata_ruang_7_due' => $data['bangunan_tata_ruang_7_due'] ?? null,

                'lingkungan_ergonomi_1_check' => $data['lingkungan_ergonomi_1_check'] ?? null,
                'lingkungan_ergonomi_1_action' => $data['lingkungan_ergonomi_1_action'] ?? null,
                'lingkungan_ergonomi_1_due' => $data['lingkungan_ergonomi_1_due'] ?? null,
                'lingkungan_ergonomi_2_check' => $data['lingkungan_ergonomi_2_check'] ?? null,
                'lingkungan_ergonomi_2_action' => $data['lingkungan_ergonomi_2_action'] ?? null,
                'lingkungan_ergonomi_2_due' => $data['lingkungan_ergonomi_2_due'] ?? null,
                'lingkungan_ergonomi_3_check' => $data['lingkungan_ergonomi_3_check'] ?? null,
                'lingkungan_ergonomi_3_action' => $data['lingkungan_ergonomi_3_action'] ?? null,
                'lingkungan_ergonomi_3_due' => $data['lingkungan_ergonomi_3_due'] ?? null,
                'lingkungan_ergonomi_4_check' => $data['lingkungan_ergonomi_4_check'] ?? null,
                'lingkungan_ergonomi_4_action' => $data['lingkungan_ergonomi_4_action'] ?? null,
                'lingkungan_ergonomi_4_due' => $data['lingkungan_ergonomi_4_due'] ?? null,
                'lingkungan_ergonomi_5_check' => $data['lingkungan_ergonomi_5_check'] ?? null,
                'lingkungan_ergonomi_5_action' => $data['lingkungan_ergonomi_5_action'] ?? null,
                'lingkungan_ergonomi_5_due' => $data['lingkungan_ergonomi_5_due'] ?? null,
                'lingkungan_ergonomi_6_check' => $data['lingkungan_ergonomi_6_check'] ?? null,
                'lingkungan_ergonomi_6_action' => $data['lingkungan_ergonomi_6_action'] ?? null,
                'lingkungan_ergonomi_6_due' => $data['lingkungan_ergonomi_6_due'] ?? null,
                'lingkungan_ergonomi_7_check' => $data['lingkungan_ergonomi_7_check'] ?? null,
                'lingkungan_ergonomi_7_action' => $data['lingkungan_ergonomi_7_action'] ?? null,
                'lingkungan_ergonomi_7_due' => $data['lingkungan_ergonomi_7_due'] ?? null,

                'instalasi_listrik_1_check' => $data['instalasi_listrik_1_check'] ?? null,
                'instalasi_listrik_1_action' => $data['instalasi_listrik_1_action'] ?? null,
                'instalasi_listrik_1_due' => $data['instalasi_listrik_1_due'] ?? null,
                'instalasi_listrik_2_check' => $data['instalasi_listrik_2_check'] ?? null,
                'instalasi_listrik_2_action' => $data['instalasi_listrik_2_action'] ?? null,
                'instalasi_listrik_2_due' => $data['instalasi_listrik_2_due'] ?? null,
                'instalasi_listrik_3_check' => $data['instalasi_listrik_3_check'] ?? null,
                'instalasi_listrik_3_action' => $data['instalasi_listrik_3_action'] ?? null,
                'instalasi_listrik_3_due' => $data['instalasi_listrik_3_due'] ?? null,
                'instalasi_listrik_4_check' => $data['instalasi_listrik_4_check'] ?? null,
                'instalasi_listrik_4_action' => $data['instalasi_listrik_4_action'] ?? null,
                'instalasi_listrik_4_due' => $data['instalasi_listrik_4_due'] ?? null,
                'instalasi_listrik_5_check' => $data['instalasi_listrik_5_check'] ?? null,
                'instalasi_listrik_5_action' => $data['instalasi_listrik_5_action'] ?? null,
                'instalasi_listrik_5_due' => $data['instalasi_listrik_5_due'] ?? null,
                'instalasi_listrik_6_check' => $data['instalasi_listrik_6_check'] ?? null,
                'instalasi_listrik_6_action' => $data['instalasi_listrik_6_action'] ?? null,
                'instalasi_listrik_6_due' => $data['instalasi_listrik_6_due'] ?? null,

                'proteksi_kebakaran_1_check' => $data['proteksi_kebakaran_1_check'] ?? null,
                'proteksi_kebakaran_1_action' => $data['proteksi_kebakaran_1_action'] ?? null,
                'proteksi_kebakaran_1_due' => $data['proteksi_kebakaran_1_due'] ?? null,
                'proteksi_kebakaran_2_check' => $data['proteksi_kebakaran_2_check'] ?? null,
                'proteksi_kebakaran_2_action' => $data['proteksi_kebakaran_2_action'] ?? null,
                'proteksi_kebakaran_2_due' => $data['proteksi_kebakaran_2_due'] ?? null,
                'proteksi_kebakaran_3_check' => $data['proteksi_kebakaran_3_check'] ?? null,
                'proteksi_kebakaran_3_action' => $data['proteksi_kebakaran_3_action'] ?? null,
                'proteksi_kebakaran_3_due' => $data['proteksi_kebakaran_3_due'] ?? null,
                'proteksi_kebakaran_4_check' => $data['proteksi_kebakaran_4_check'] ?? null,
                'proteksi_kebakaran_4_action' => $data['proteksi_kebakaran_4_action'] ?? null,
                'proteksi_kebakaran_4_due' => $data['proteksi_kebakaran_4_due'] ?? null,
                'proteksi_kebakaran_5_check' => $data['proteksi_kebakaran_5_check'] ?? null,
                'proteksi_kebakaran_5_action' => $data['proteksi_kebakaran_5_action'] ?? null,
                'proteksi_kebakaran_5_due' => $data['proteksi_kebakaran_5_due'] ?? null,
                'proteksi_kebakaran_6_check' => $data['proteksi_kebakaran_6_check'] ?? null,
                'proteksi_kebakaran_6_action' => $data['proteksi_kebakaran_6_action'] ?? null,
                'proteksi_kebakaran_6_due' => $data['proteksi_kebakaran_6_due'] ?? null,
                'proteksi_kebakaran_7_check' => $data['proteksi_kebakaran_7_check'] ?? null,
                'proteksi_kebakaran_7_action' => $data['proteksi_kebakaran_7_action'] ?? null,
                'proteksi_kebakaran_7_due' => $data['proteksi_kebakaran_7_due'] ?? null,
                'proteksi_kebakaran_8_check' => $data['proteksi_kebakaran_8_check'] ?? null,
                'proteksi_kebakaran_8_action' => $data['proteksi_kebakaran_8_action'] ?? null,
                'proteksi_kebakaran_8_due' => $data['proteksi_kebakaran_8_due'] ?? null,

                'sanitasi_fasilitas_1_check' => $data['sanitasi_fasilitas_1_check'] ?? null,
                'sanitasi_fasilitas_1_action' => $data['sanitasi_fasilitas_1_action'] ?? null,
                'sanitasi_fasilitas_1_due' => $data['sanitasi_fasilitas_1_due'] ?? null,
                'sanitasi_fasilitas_2_check' => $data['sanitasi_fasilitas_2_check'] ?? null,
                'sanitasi_fasilitas_2_action' => $data['sanitasi_fasilitas_2_action'] ?? null,
                'sanitasi_fasilitas_2_due' => $data['sanitasi_fasilitas_2_due'] ?? null,
                'sanitasi_fasilitas_3_check' => $data['sanitasi_fasilitas_3_check'] ?? null,
                'sanitasi_fasilitas_3_action' => $data['sanitasi_fasilitas_3_action'] ?? null,
                'sanitasi_fasilitas_3_due' => $data['sanitasi_fasilitas_3_due'] ?? null,
                'sanitasi_fasilitas_4_check' => $data['sanitasi_fasilitas_4_check'] ?? null,
                'sanitasi_fasilitas_4_action' => $data['sanitasi_fasilitas_4_action'] ?? null,
                'sanitasi_fasilitas_4_due' => $data['sanitasi_fasilitas_4_due'] ?? null,
                'sanitasi_fasilitas_5_check' => $data['sanitasi_fasilitas_5_check'] ?? null,
                'sanitasi_fasilitas_5_action' => $data['sanitasi_fasilitas_5_action'] ?? null,
                'sanitasi_fasilitas_5_due' => $data['sanitasi_fasilitas_5_due'] ?? null,
                'sanitasi_fasilitas_6_check' => $data['sanitasi_fasilitas_6_check'] ?? null,
                'sanitasi_fasilitas_6_action' => $data['sanitasi_fasilitas_6_action'] ?? null,
                'sanitasi_fasilitas_6_due' => $data['sanitasi_fasilitas_6_due'] ?? null,
                'sanitasi_fasilitas_7_check' => $data['sanitasi_fasilitas_7_check'] ?? null,
                'sanitasi_fasilitas_7_action' => $data['sanitasi_fasilitas_7_action'] ?? null,
                'sanitasi_fasilitas_7_due' => $data['sanitasi_fasilitas_7_due'] ?? null,

                'area_luar_rambu_1_check' => $data['area_luar_rambu_1_check'] ?? null,
                'area_luar_rambu_1_action' => $data['area_luar_rambu_1_action'] ?? null,
                'area_luar_rambu_1_due' => $data['area_luar_rambu_1_due'] ?? null,
                'area_luar_rambu_2_check' => $data['area_luar_rambu_2_check'] ?? null,
                'area_luar_rambu_2_action' => $data['area_luar_rambu_2_action'] ?? null,
                'area_luar_rambu_2_due' => $data['area_luar_rambu_2_due'] ?? null,
                'area_luar_rambu_3_check' => $data['area_luar_rambu_3_check'] ?? null,
                'area_luar_rambu_3_action' => $data['area_luar_rambu_3_action'] ?? null,
                'area_luar_rambu_3_due' => $data['area_luar_rambu_3_due'] ?? null,
                'area_luar_rambu_4_check' => $data['area_luar_rambu_4_check'] ?? null,
                'area_luar_rambu_4_action' => $data['area_luar_rambu_4_action'] ?? null,
                'area_luar_rambu_4_due' => $data['area_luar_rambu_4_due'] ?? null,
                'area_luar_rambu_5_check' => $data['area_luar_rambu_5_check'] ?? null,
                'area_luar_rambu_5_action' => $data['area_luar_rambu_5_action'] ?? null,
                'area_luar_rambu_5_due' => $data['area_luar_rambu_5_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
                'dokumentasi_1' => $dokumentasi['dokumentasi_1'] ?? null,
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'] ?? null,
            ];


            InspeksiAreaOffice::create($dataToInsert);

            return redirect()->route('inspeksi.areaoffice')->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiAreaOffice::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.areaoffice')->with('success', 'Inspeksi berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.areaoffice')->with('info', nl2br('Inspeksi gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $sp = DB::table('se_inspeksi_areaoffice as sp')
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

        return view('inspeksi.area-office.preview', compact('sp'));
    }
}
