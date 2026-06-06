<?php

namespace App\Http\Controllers\IT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\KLKHIT;
use App\Models\Area;
use App\Models\User;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class KLKHITController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeHaulRoad' => $request->all()]);

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


        $baseQuery = DB::table('it_klkh as it')
        ->leftJoin('users as us', 'it.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'it.pit_id', '=', 'ar.id')
        ->leftJoin('users as us3', 'it.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'it.diketahui', '=', 'us4.nik')
        ->select(
            'it.id',
            'it.uuid',
            'it.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, it.created_at, 120) as tanggal_pembuatan'),
            'it.statusenabled',
            'it.lokasi',
            'it.pekerjaan',
            'ar.keterangan as pit',
            'it.pengawas as nik_pengawas',
            'us3.name as nama_pengawas',
            'it.diketahui as nik_diketahui',
            'us4.name as nama_diketahui',
            'it.verified_pengawas',
            'it.verified_diketahui',
            'it.date',
            'it.time',
        )
        ->where('it.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, it.date, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'])) {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }


        // $baseQuery = $baseQuery->where(function($query) {
        //     $query->where('it.pengawas', Auth::user()->nik)
        //           ->orWhere('it.diketahui', Auth::user()->nik);
        // });

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $nikBypass = array_merge(
            getConfigArrayById(28),
            getConfigArrayById(31)
        );


        if (!in_array($user->nik, $nikBypass)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('it.pengawas', $user->nik)
                    ->orWhere('it.diketahui', $user->nik);
            });
        }

        $it = $baseQuery->get();

        return view('klkh.it.index', compact('it'));
    }

    public function insert()
    {
        $diketahui = User::where('departemen_id', 4)
        ->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])->where('statusenabled', true)->get();

        $pit = Area::where('statusenabled', true)->where('group', 'production')->get();

        $users = [
            'diketahui' => $diketahui,
            'pit' => $pit,
        ];

        return view('klkh.it.insert', compact('users'));
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
                'pit_id' => $data['pit'],
                'lokasi' => $data['lokasi'],
                'pekerjaan' => $data['pekerjaan'],
                'date' => $data['date'],
                'time' => $data['time'],


                'lokasi_kerja_1_check' => $data['lokasi_kerja_1_check'] ?? null,
                'lokasi_kerja_1_note' => $data['lokasi_kerja_1_note'] ?? null,

                'lokasi_kerja_2_check' => $data['lokasi_kerja_2_check'] ?? null,
                'lokasi_kerja_2_note' => $data['lokasi_kerja_2_note'] ?? null,

                'lokasi_kerja_3_check' => $data['lokasi_kerja_3_check'] ?? null,
                'lokasi_kerja_3_note' => $data['lokasi_kerja_3_note'] ?? null,

                'lokasi_kerja_4_check' => $data['lokasi_kerja_4_check'] ?? null,
                'lokasi_kerja_4_note' => $data['lokasi_kerja_4_note'] ?? null,

                'lokasi_kerja_5_check' => $data['lokasi_kerja_5_check'] ?? null,
                'lokasi_kerja_5_note' => $data['lokasi_kerja_5_note'] ?? null,

                'lokasi_kerja_6_check' => $data['lokasi_kerja_6_check'] ?? null,
                'lokasi_kerja_6_note' => $data['lokasi_kerja_6_note'] ?? null,

                'lokasi_kerja_7_check' => $data['lokasi_kerja_7_check'] ?? null,
                'lokasi_kerja_7_note' => $data['lokasi_kerja_7_note'] ?? null,

                'lokasi_kerja_8_check' => $data['lokasi_kerja_8_check'] ?? null,
                'lokasi_kerja_8_note' => $data['lokasi_kerja_8_note'] ?? null,

                'lokasi_kerja_9_check' => $data['lokasi_kerja_9_check'] ?? null,
                'lokasi_kerja_9_note' => $data['lokasi_kerja_9_note'] ?? null,

                'perlengkapan_kerja_1_check' => $data['perlengkapan_kerja_1_check'] ?? null,
                'perlengkapan_kerja_1_note' => $data['perlengkapan_kerja_1_note'] ?? null,

                'perlengkapan_kerja_2_check' => $data['perlengkapan_kerja_2_check'] ?? null,
                'perlengkapan_kerja_2_note' => $data['perlengkapan_kerja_2_note'] ?? null,

                'perlengkapan_kerja_3_check' => $data['perlengkapan_kerja_3_check'] ?? null,
                'perlengkapan_kerja_3_note' => $data['perlengkapan_kerja_3_note'] ?? null,

                'perlengkapan_kerja_4_check' => $data['perlengkapan_kerja_4_check'] ?? null,
                'perlengkapan_kerja_4_note' => $data['perlengkapan_kerja_4_note'] ?? null,

                'kegiatan_1_check' => $data['kegiatan_1_check'] ?? null,
                'kegiatan_1_note' => $data['kegiatan_1_note'] ?? null,

                'kegiatan_2_check' => $data['kegiatan_2_check'] ?? null,
                'kegiatan_2_note' => $data['kegiatan_2_note'] ?? null,

                'kegiatan_3_check' => $data['kegiatan_3_check'] ?? null,
                'kegiatan_3_note' => $data['kegiatan_3_note'] ?? null,

                'kegiatan_4_check' => $data['kegiatan_4_check'] ?? null,
                'kegiatan_4_note' => $data['kegiatan_4_note'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,
                'pengawas' => Auth::user()->nik,
                'verified_pengawas' => Auth::user()->nik,
                'date_verified_pengawas' => Carbon::now(),
                'catatan_verified_pengawas' => $data['catatan_verified_pengawas'] ?? null,

                'diketahui' => $data['diketahui'] ?? null,
            ];


            KLKHIT::create($dataToInsert);

            return redirect()->route('klkh.it')->with('success', 'KLKH berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'KLKH gagal disimpan' . $th->getMessage());
        }
    }

    public function preview($uuid)
    {
        $it = DB::table('it_klkh as it')
        ->leftJoin('users as us', 'it.pic', '=', 'us.id')
        ->leftJoin('ref_region as ar', 'it.pit_id', '=', 'ar.id')
        ->leftJoin('users as us3', 'it.pengawas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'it.diketahui', '=', 'us4.nik')
        ->select(
            'it.*',
            'ar.keterangan as pit',
            'us.name as nama_pic',
            'us3.name as nama_pengawas',
            'us4.name as nama_diketahui'
            )
        ->where('it.statusenabled', true)
        ->where('it.uuid', $uuid)->first();

        if($it == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $it;

            $qrTempFolder = storage_path('app/public/qr-temp');
            if (!File::exists($qrTempFolder)) {
                File::makeDirectory($qrTempFolder, 0755, true);
            }

            if ($item->verified_pengawas != null) {
                $fileName = 'verified_pengawas' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_pengawas)]), $filePath);

                $item->verified_pengawas = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_pengawas = null;
            }

            if ($item->verified_diketahui != null) {
                $fileName = 'verified_diketahui' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_diketahui)]), $filePath);

                $item->verified_diketahui = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_diketahui = null;
            }

        }

        return view('klkh.it.preview', compact('it'));
    }

    public function verifiedAll(Request $request, $uuid)
    {
        $klkh =  KLKHIT::where('uuid', $uuid)->first();

        try {
            KLKHIT::where('id', $klkh->id)->update([
                'verified_pengawas' => $klkh->pengawas,
                'verified_diketahui' => $klkh->diketahui,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_all,
                'date_verified_pengawas' => Carbon::now(),
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedPengawas(Request $request, $uuid)
    {
        $klkh =  KLKHIT::where('uuid', $uuid)->first();

        try {
            KLKHIT::where('id', $klkh->id)->update([
                'verified_pengawas' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_pengawas' => $request->catatan_verified_pengawas,
                'date_verified_pengawas' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedDiketahui(Request $request, $uuid)
    {
        $klkh =  KLKHIT::where('uuid', $uuid)->first();

        try {
            KLKHIT::where('id', $klkh->id)->update([
                'verified_diketahui' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
                'catatan_verified_diketahui' => $request->catatan_verified_diketahui,
                'date_verified_diketahui' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'KLKH berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH gagal diverifikasi..\n' . $th->getMessage()));
        }
    }


}
