<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use App\Models\Area;
use App\Models\InspeksiMessMalam;
use App\Models\Personal;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;

class InspeksiMessMalamController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiMessMalam' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_messmalam as mm')
        ->leftJoin('users as us', 'mm.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'mm.inspektor', '=', 'us1.nik')
        ->leftJoin('users as us2', 'mm.pendamping', '=', 'us2.nik')
        ->leftJoin('ref_perusahaan as rp', 'mm.perusahaan', '=', 'rp.id')
        ->select(
            'mm.id',
            'mm.uuid',
            'mm.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, mm.created_at, 120) as tanggal_pembuatan'),
            'mm.statusenabled',
            'rp.keterangan as perusahaan',
            'mm.inspektor as nik_inspektor',
            'mm.verified_inspektor',
            'us1.name as nama_inspektor',
            'mm.pendamping as nik_pendamping',
            'mm.verified_pendamping',
            'us2.name as nama_pendamping',
            'mm.tanggal_inspeksi',
            'mm.jam_inspeksi',
        )
        ->where('mm.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, mm.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        $user = Auth::user();
        $safetyRoles = ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'];

        if (!in_array($user->role, $safetyRoles)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('mm.pic', $user->id)
                    ->orWhere('mm.inspektor', $user->nik)
                    ->orWhere('mm.pendamping', $user->nik);
            });
        }
        $mm = $baseQuery->get();


        return view('inspeksi.mess-malam.index', compact('mm'));
    }

    public function insert()
    {

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

        $perusahaan = Perusahaan::where('statusenabled', true)->get();

        $users = [
            'inspektor' => $inspektor,
            'perusahaan' => $perusahaan,
        ];

        return view('inspeksi.mess-malam.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();

            $dokumentasi = [];
            for ($i = 1; $i <= 3; $i++) {
                $field = "dokumentasi_{$i}";
                $dokumentasi[$field] = null;

                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $i . '_' . $file->getClientOriginalName();
                    $path = "inspeksi_messmalam/{$field}";

                    Storage::disk('production_public')->putFileAs($path, $file, $fileName);
                    $dokumentasi[$field] = rtrim(config('app.url'), '/') . "/storage/{$path}/{$fileName}";
                }
            }

            $dataToInsert = [

                'uuid'                       => (string) Uuid::uuid4(),
                'pic'                        => Auth::user()->id,
                'statusenabled'              => true,
                'inspektor'                  => $data['inspektor'] ?? null,
                'verified_inspektor'         => Auth::user()->nik,
                'date_verified_inspektor'    => Carbon::now(),

                'pendamping'                 => $data['pendamping'] ?? null,

                'tanggal_inspeksi'           => $data['tanggal_inspeksi'] ?? null,
                'jam_inspeksi'               => $data['jam_inspeksi'] ?? null,
                'perusahaan'                 => $data['perusahaan'] ?? null,


                'pekerja_11_check' => $data['pekerja_11_check'] ?? null,
                'pekerja_11_action' => $data['pekerja_11_action'] ?? null,
                'pekerja_11_due' => $data['pekerja_11_due'] ?? null,

                'pekerja_12_check' => $data['pekerja_12_check'] ?? null,
                'pekerja_12_action' => $data['pekerja_12_action'] ?? null,
                'pekerja_12_due' => $data['pekerja_12_due'] ?? null,

                'fasilitas_21_check' => $data['fasilitas_21_check'] ?? null,
                'fasilitas_21_action' => $data['fasilitas_21_action'] ?? null,
                'fasilitas_21_due' => $data['fasilitas_21_due'] ?? null,

                'fasilitas_22_check' => $data['fasilitas_22_check'] ?? null,
                'fasilitas_22_action' => $data['fasilitas_22_action'] ?? null,
                'fasilitas_22_due' => $data['fasilitas_22_due'] ?? null,

                'fasilitas_23_check' => $data['fasilitas_23_check'] ?? null,
                'fasilitas_23_action' => $data['fasilitas_23_action'] ?? null,
                'fasilitas_23_due' => $data['fasilitas_23_due'] ?? null,

                'fasilitas_24_check' => $data['fasilitas_24_check'] ?? null,
                'fasilitas_24_action' => $data['fasilitas_24_action'] ?? null,
                'fasilitas_24_due' => $data['fasilitas_24_due'] ?? null,

                'fasilitas_25_check' => $data['fasilitas_25_check'] ?? null,
                'fasilitas_25_action' => $data['fasilitas_25_action'] ?? null,
                'fasilitas_25_due' => $data['fasilitas_25_due'] ?? null,

                'campaign_31_check' => $data['campaign_31_check'] ?? null,
                'campaign_31_action' => $data['campaign_31_action'] ?? null,
                'campaign_31_due' => $data['campaign_31_due'] ?? null,

                'campaign_32_check' => $data['campaign_32_check'] ?? null,
                'campaign_32_action' => $data['campaign_32_action'] ?? null,
                'campaign_32_due' => $data['campaign_32_due'] ?? null,

                'campaign_33_check' => $data['campaign_33_check'] ?? null,
                'campaign_33_action' => $data['campaign_33_action'] ?? null,
                'campaign_33_due' => $data['campaign_33_due'] ?? null,

                'campaign_34_check' => $data['campaign_34_check'] ?? null,
                'campaign_34_action' => $data['campaign_34_action'] ?? null,
                'campaign_34_due' => $data['campaign_34_due'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,

                'dokumentasi_1'           => $dokumentasi['dokumentasi_1'],
                'dokumentasi_2'           => $dokumentasi['dokumentasi_2'],
                'dokumentasi_3'           => $dokumentasi['dokumentasi_3'],
            ];

            InspeksiMessMalam::create($dataToInsert);

            return redirect()->route('inspeksi.messmalam')->with('success', 'Inspeksi Mess berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi Mess gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiMessMalam::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.messmalam')->with('success', 'Inspeksi Mess berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.messmalam')->with('info', nl2br('Inspeksi Mess gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $mm = DB::table('se_inspeksi_messmalam as mm')
        ->leftJoin('users as us', 'mm.pic', '=', 'us.id')
        ->leftJoin('users as us1', 'mm.inspektor', '=', 'us1.nik')
        ->leftJoin('users as us2', 'mm.pendamping', '=', 'us2.nik')
        ->leftJoin('ref_perusahaan as rp', 'mm.perusahaan', '=', 'rp.id')
        ->select(
            'mm.*',
            'mm.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, mm.created_at, 120) as tanggal_pembuatan'),
            'mm.statusenabled',
            'rp.keterangan as perusahaan',
            'mm.inspektor as nik_inspektor',
            'mm.verified_inspektor',
            'us1.name as nama_inspektor',
            'mm.pendamping as nik_pendamping',
            'mm.verified_pendamping',
            'us2.name as nama_pendamping',
            'mm.tanggal_inspeksi',
            'mm.jam_inspeksi',
            )
        ->where('mm.statusenabled', true)
        ->where('mm.uuid', $uuid)->first();

        if($mm == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $mm;

            $qrTempFolder = storage_path('app/public/qr-temp');
            if (!File::exists($qrTempFolder)) {
                File::makeDirectory($qrTempFolder, 0755, true);
            }

            if ($item->verified_inspektor != null) {
                $fileName = 'verified_inspektor' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(150)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_inspektor)]), $filePath);

                $item->verified_inspektor = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_inspektor = null;
            }
            if ($item->verified_pendamping != null) {
                $fileName = 'verified_pendamping' . $item->uuid . '.png';
                $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                QrCode::size(250)
                    ->format('png')
                    ->generate(route('verified.index', ['encodedNik' => base64_encode($item->verified_pendamping)]), $filePath);

                $item->verified_pendamping = asset('storage/qr-temp/' . $fileName);
            } else {
                $item->verified_pendamping = null;
            }
            
        }

        return view('inspeksi.mess-malam.preview', compact('mm'));
    }
}
