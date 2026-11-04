<?php

namespace App\Http\Controllers\Dewatering;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\InspeksiInternalAreaTandem;
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

class InspeksiInternalAreaTandemController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiInternalAreaTandem' => $request->all()]);

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


        $baseQuery = DB::table('dew_inspeksi_internalareatandem as sp')
        ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
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


        return view('inspeksi.internal-area-tandem.index', compact('sp'));
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

        return view('inspeksi.internal-area-tandem.insert', compact('users'));
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
                    $path = "inspeksi/internalareatandem/{$field}";

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

                'pekerja_1_check' => $data['pekerja_1_check'] ?? null,
                'pekerja_1_action' => $data['pekerja_1_action'] ?? null,
                'pekerja_1_due' => $data['pekerja_1_due'] ?? null,

                'pekerja_2_check' => $data['pekerja_2_check'] ?? null,
                'pekerja_2_action' => $data['pekerja_2_action'] ?? null,
                'pekerja_2_due' => $data['pekerja_2_due'] ?? null,

                'pekerja_3_check' => $data['pekerja_3_check'] ?? null,
                'pekerja_3_action' => $data['pekerja_3_action'] ?? null,
                'pekerja_3_due' => $data['pekerja_3_due'] ?? null,

                'pekerja_4_check' => $data['pekerja_4_check'] ?? null,
                'pekerja_4_action' => $data['pekerja_4_action'] ?? null,
                'pekerja_4_due' => $data['pekerja_4_due'] ?? null,

                'pondok_fasilitas_1_check' => $data['pondok_fasilitas_1_check'] ?? null,
                'pondok_fasilitas_1_action' => $data['pondok_fasilitas_1_action'] ?? null,
                'pondok_fasilitas_1_due' => $data['pondok_fasilitas_1_due'] ?? null,

                'pondok_fasilitas_2_check' => $data['pondok_fasilitas_2_check'] ?? null,
                'pondok_fasilitas_2_action' => $data['pondok_fasilitas_2_action'] ?? null,
                'pondok_fasilitas_2_due' => $data['pondok_fasilitas_2_due'] ?? null,

                'pondok_fasilitas_3_check' => $data['pondok_fasilitas_3_check'] ?? null,
                'pondok_fasilitas_3_action' => $data['pondok_fasilitas_3_action'] ?? null,
                'pondok_fasilitas_3_due' => $data['pondok_fasilitas_3_due'] ?? null,

                'pondok_fasilitas_4_check' => $data['pondok_fasilitas_4_check'] ?? null,
                'pondok_fasilitas_4_action' => $data['pondok_fasilitas_4_action'] ?? null,
                'pondok_fasilitas_4_due' => $data['pondok_fasilitas_4_due'] ?? null,

                'pondok_fasilitas_5_check' => $data['pondok_fasilitas_5_check'] ?? null,
                'pondok_fasilitas_5_action' => $data['pondok_fasilitas_5_action'] ?? null,
                'pondok_fasilitas_5_due' => $data['pondok_fasilitas_5_due'] ?? null,

                'pondok_fasilitas_6_check' => $data['pondok_fasilitas_6_check'] ?? null,
                'pondok_fasilitas_6_action' => $data['pondok_fasilitas_6_action'] ?? null,
                'pondok_fasilitas_6_due' => $data['pondok_fasilitas_6_due'] ?? null,

                'pondok_fasilitas_7_check' => $data['pondok_fasilitas_7_check'] ?? null,
                'pondok_fasilitas_7_action' => $data['pondok_fasilitas_7_action'] ?? null,
                'pondok_fasilitas_7_due' => $data['pondok_fasilitas_7_due'] ?? null,

                'pondok_fasilitas_8_check' => $data['pondok_fasilitas_8_check'] ?? null,
                'pondok_fasilitas_8_action' => $data['pondok_fasilitas_8_action'] ?? null,
                'pondok_fasilitas_8_due' => $data['pondok_fasilitas_8_due'] ?? null,

                'pondok_fasilitas_9_check' => $data['pondok_fasilitas_9_check'] ?? null,
                'pondok_fasilitas_9_action' => $data['pondok_fasilitas_9_action'] ?? null,
                'pondok_fasilitas_9_due' => $data['pondok_fasilitas_9_due'] ?? null,

                'electrical_1_check' => $data['electrical_1_check'] ?? null,
                'electrical_1_action' => $data['electrical_1_action'] ?? null,
                'electrical_1_due' => $data['electrical_1_due'] ?? null,

                'electrical_2_check' => $data['electrical_2_check'] ?? null,
                'electrical_2_action' => $data['electrical_2_action'] ?? null,
                'electrical_2_due' => $data['electrical_2_due'] ?? null,

                'electrical_3_check' => $data['electrical_3_check'] ?? null,
                'electrical_3_action' => $data['electrical_3_action'] ?? null,
                'electrical_3_due' => $data['electrical_3_due'] ?? null,

                'fasilitas_keselamatan_1_check' => $data['fasilitas_keselamatan_1_check'] ?? null,
                'fasilitas_keselamatan_1_action' => $data['fasilitas_keselamatan_1_action'] ?? null,
                'fasilitas_keselamatan_1_due' => $data['fasilitas_keselamatan_1_due'] ?? null,

                'fasilitas_keselamatan_2_check' => $data['fasilitas_keselamatan_2_check'] ?? null,
                'fasilitas_keselamatan_2_action' => $data['fasilitas_keselamatan_2_action'] ?? null,
                'fasilitas_keselamatan_2_due' => $data['fasilitas_keselamatan_2_due'] ?? null,

                'fasilitas_keselamatan_3_check' => $data['fasilitas_keselamatan_3_check'] ?? null,
                'fasilitas_keselamatan_3_action' => $data['fasilitas_keselamatan_3_action'] ?? null,
                'fasilitas_keselamatan_3_due' => $data['fasilitas_keselamatan_3_due'] ?? null,

                'fasilitas_keselamatan_4_check' => $data['fasilitas_keselamatan_4_check'] ?? null,
                'fasilitas_keselamatan_4_action' => $data['fasilitas_keselamatan_4_action'] ?? null,
                'fasilitas_keselamatan_4_due' => $data['fasilitas_keselamatan_4_due'] ?? null,

                'fasilitas_keselamatan_5_check' => $data['fasilitas_keselamatan_5_check'] ?? null,
                'fasilitas_keselamatan_5_action' => $data['fasilitas_keselamatan_5_action'] ?? null,
                'fasilitas_keselamatan_5_due' => $data['fasilitas_keselamatan_5_due'] ?? null,

                'fasilitas_keselamatan_6_check' => $data['fasilitas_keselamatan_6_check'] ?? null,
                'fasilitas_keselamatan_6_action' => $data['fasilitas_keselamatan_6_action'] ?? null,
                'fasilitas_keselamatan_6_due' => $data['fasilitas_keselamatan_6_due'] ?? null,

                'fasilitas_keselamatan_7_check' => $data['fasilitas_keselamatan_7_check'] ?? null,
                'fasilitas_keselamatan_7_action' => $data['fasilitas_keselamatan_7_action'] ?? null,
                'fasilitas_keselamatan_7_due' => $data['fasilitas_keselamatan_7_due'] ?? null,

                'lingkungan_1_check' => $data['lingkungan_1_check'] ?? null,
                'lingkungan_1_action' => $data['lingkungan_1_action'] ?? null,
                'lingkungan_1_due' => $data['lingkungan_1_due'] ?? null,

                'lingkungan_2_check' => $data['lingkungan_2_check'] ?? null,
                'lingkungan_2_action' => $data['lingkungan_2_action'] ?? null,
                'lingkungan_2_due' => $data['lingkungan_2_due'] ?? null,

                'lingkungan_3_check' => $data['lingkungan_3_check'] ?? null,
                'lingkungan_3_action' => $data['lingkungan_3_action'] ?? null,
                'lingkungan_3_due' => $data['lingkungan_3_due'] ?? null,

                'lingkungan_4_check' => $data['lingkungan_4_check'] ?? null,
                'lingkungan_4_action' => $data['lingkungan_4_action'] ?? null,
                'lingkungan_4_due' => $data['lingkungan_4_due'] ?? null,

                'lingkungan_5_check' => $data['lingkungan_5_check'] ?? null,
                'lingkungan_5_action' => $data['lingkungan_5_action'] ?? null,
                'lingkungan_5_due' => $data['lingkungan_5_due'] ?? null,

                'engine_pompa_1_check' => $data['engine_pompa_1_check'] ?? null,
                'engine_pompa_1_action' => $data['engine_pompa_1_action'] ?? null,
                'engine_pompa_1_due' => $data['engine_pompa_1_due'] ?? null,

                'engine_pompa_2_check' => $data['engine_pompa_2_check'] ?? null,
                'engine_pompa_2_action' => $data['engine_pompa_2_action'] ?? null,
                'engine_pompa_2_due' => $data['engine_pompa_2_due'] ?? null,

                'engine_pompa_3_check' => $data['engine_pompa_3_check'] ?? null,
                'engine_pompa_3_action' => $data['engine_pompa_3_action'] ?? null,
                'engine_pompa_3_due' => $data['engine_pompa_3_due'] ?? null,

                'engine_pompa_4_check' => $data['engine_pompa_4_check'] ?? null,
                'engine_pompa_4_action' => $data['engine_pompa_4_action'] ?? null,
                'engine_pompa_4_due' => $data['engine_pompa_4_due'] ?? null,

                'engine_pompa_5_check' => $data['engine_pompa_5_check'] ?? null,
                'engine_pompa_5_action' => $data['engine_pompa_5_action'] ?? null,
                'engine_pompa_5_due' => $data['engine_pompa_5_due'] ?? null,

                'engine_pompa_6_check' => $data['engine_pompa_6_check'] ?? null,
                'engine_pompa_6_action' => $data['engine_pompa_6_action'] ?? null,
                'engine_pompa_6_due' => $data['engine_pompa_6_due'] ?? null,

                'engine_pompa_7_check' => $data['engine_pompa_7_check'] ?? null,
                'engine_pompa_7_action' => $data['engine_pompa_7_action'] ?? null,
                'engine_pompa_7_due' => $data['engine_pompa_7_due'] ?? null,

                'engine_pompa_8_check' => $data['engine_pompa_8_check'] ?? null,
                'engine_pompa_8_action' => $data['engine_pompa_8_action'] ?? null,
                'engine_pompa_8_due' => $data['engine_pompa_8_due'] ?? null,

                'engine_pompa_9_check' => $data['engine_pompa_9_check'] ?? null,
                'engine_pompa_9_action' => $data['engine_pompa_9_action'] ?? null,
                'engine_pompa_9_due' => $data['engine_pompa_9_due'] ?? null,

                'engine_pompa_10_check' => $data['engine_pompa_10_check'] ?? null,
                'engine_pompa_10_action' => $data['engine_pompa_10_action'] ?? null,
                'engine_pompa_10_due' => $data['engine_pompa_10_due'] ?? null,

                'engine_pompa_11_check' => $data['engine_pompa_11_check'] ?? null,
                'engine_pompa_11_action' => $data['engine_pompa_11_action'] ?? null,
                'engine_pompa_11_due' => $data['engine_pompa_11_due'] ?? null,

                'pipa_hdpe_1_check' => $data['pipa_hdpe_1_check'] ?? null,
                'pipa_hdpe_1_action' => $data['pipa_hdpe_1_action'] ?? null,
                'pipa_hdpe_1_due' => $data['pipa_hdpe_1_due'] ?? null,

                'pipa_hdpe_2_check' => $data['pipa_hdpe_2_check'] ?? null,
                'pipa_hdpe_2_action' => $data['pipa_hdpe_2_action'] ?? null,
                'pipa_hdpe_2_due' => $data['pipa_hdpe_2_due'] ?? null,

                'pipa_hdpe_3_check' => $data['pipa_hdpe_3_check'] ?? null,
                'pipa_hdpe_3_action' => $data['pipa_hdpe_3_action'] ?? null,
                'pipa_hdpe_3_due' => $data['pipa_hdpe_3_due'] ?? null,

                'pipa_hdpe_4_check' => $data['pipa_hdpe_4_check'] ?? null,
                'pipa_hdpe_4_action' => $data['pipa_hdpe_4_action'] ?? null,
                'pipa_hdpe_4_due' => $data['pipa_hdpe_4_due'] ?? null,

                'pipa_hdpe_5_check' => $data['pipa_hdpe_5_check'] ?? null,
                'pipa_hdpe_5_action' => $data['pipa_hdpe_5_action'] ?? null,
                'pipa_hdpe_5_due' => $data['pipa_hdpe_5_due'] ?? null,

                'pipa_hdpe_6_check' => $data['pipa_hdpe_6_check'] ?? null,
                'pipa_hdpe_6_action' => $data['pipa_hdpe_6_action'] ?? null,
                'pipa_hdpe_6_due' => $data['pipa_hdpe_6_due'] ?? null,

                'pipa_hdpe_7_check' => $data['pipa_hdpe_7_check'] ?? null,
                'pipa_hdpe_7_action' => $data['pipa_hdpe_7_action'] ?? null,
                'pipa_hdpe_7_due' => $data['pipa_hdpe_7_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
                'dokumentasi_1' => $dokumentasi['dokumentasi_1'] ?? null,
                'dokumentasi_2' => $dokumentasi['dokumentasi_2'] ?? null,
            ];


            InspeksiInternalAreaTandem::create($dataToInsert);

            return redirect()->route('inspeksi.internalareatandem')->with('success', 'Inspeksi berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiInternalAreaTandem::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.internalareatandem')->with('success', 'Inspeksi berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.internalareatandem')->with('info', nl2br('Inspeksi gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $sp = DB::table('dew_inspeksi_internalareatandem as sp')
        ->leftJoin('users as us', 'sp.pic', '=', 'us.id')
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

        return view('inspeksi.internal-area-tandem.preview', compact('sp'));
    }
}
