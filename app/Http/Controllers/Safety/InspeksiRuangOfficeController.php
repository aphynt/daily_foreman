<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;
use App\Models\Area;
use App\Models\Departemen;
use App\Models\InspeksiRuangOffice;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;

class InspeksiRuangOfficeController extends Controller
{
    //

    public function index(Request $request)
    {
        session(['requestTimeInspeksiRuangOffice' => $request->all()]);

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


        $baseQuery = DB::table('se_inspeksi_ruangoffice as ro')
        ->leftJoin('users as us', 'ro.pic', '=', 'us.id')
        ->leftJoin('ref_departemen as dep', 'ro.departemen', '=', 'dep.id')
        ->leftJoin('users as us1', 'ro.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'ro.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'ro.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ro.inspektor4', '=', 'us4.nik')
        ->select(
            'ro.id',
            'ro.uuid',
            'ro.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, ro.created_at, 120) as tanggal_pembuatan'),
            'ro.statusenabled',
            'dep.keterangan as departemen',
            'ro.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'ro.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'ro.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'ro.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'ro.tanggal_inspeksi',
            'ro.jam_inspeksi',
        )
        ->where('ro.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, ro.tanggal_inspeksi, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        $user = Auth::user();
        $safetyRoles = ['ADMIN', 'MANAGEMENT', 'SUPERINTENDENT SAFETY', 'SUPERVISOR SAFETY', 'FOREMAN SAFETY', 'PIT CONTROL'];

        if (!in_array($user->role, $safetyRoles)) {
            $baseQuery->where(function ($query) use ($user) {
                $query->where('ro.pic', $user->id)
                    ->orWhere('ro.inspektor', $user->nik)
                    ->orWhere('ro.pendamping', $user->nik);
            });
        }
        $ro = $baseQuery->get();


        return view('inspeksi.ruang-office.index', compact('ro'));
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

        $departemen = Departemen::where('statusenabled', true)->get();

        $users = [
            'inspektor' => $inspektor,
            'departemen' => $departemen,
        ];

        return view('inspeksi.ruang-office.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();
            // dd($data);

            $dataToInsert = [

                'uuid'              => (string) Uuid::uuid4(),
                'pic'               => Auth::user()->id,
                'statusenabled'     => true,
                'departemen'        => $data['departemen'] ?? null,
                'tanggal_inspeksi'  => $data['tanggal_inspeksi'] ?? null,
                'jam_inspeksi'      => $data['jam_inspeksi'] ?? null,


                'fotocopy_11_check'  => $data['fotocopy_11_check'] ?? null,
                'fotocopy_11_action' => $data['fotocopy_11_action'] ?? null,
                'fotocopy_11_due'    => $data['fotocopy_11_due'] ?? null,
                'fotocopy_11_foto'   => $data['fotocopy_11_foto'] ?? null,

                'fotocopy_12_check'  => $data['fotocopy_12_check'] ?? null,
                'fotocopy_12_action' => $data['fotocopy_12_action'] ?? null,
                'fotocopy_12_due'    => $data['fotocopy_12_due'] ?? null,
                'fotocopy_12_foto'   => $data['fotocopy_12_foto'] ?? null,

                'fotocopy_13_check'  => $data['fotocopy_13_check'] ?? null,
                'fotocopy_13_action' => $data['fotocopy_13_action'] ?? null,
                'fotocopy_13_due'    => $data['fotocopy_13_due'] ?? null,
                'fotocopy_13_foto'   => $data['fotocopy_13_foto'] ?? null,

                'fotocopy_14_check'  => $data['fotocopy_14_check'] ?? null,
                'fotocopy_14_action' => $data['fotocopy_14_action'] ?? null,
                'fotocopy_14_due'    => $data['fotocopy_14_due'] ?? null,
                'fotocopy_14_foto'   => $data['fotocopy_14_foto'] ?? null,

                'penghancurkertas_21_check'  => $data['penghancurkertas_21_check'] ?? null,
                'penghancurkertas_21_action' => $data['penghancurkertas_21_action'] ?? null,
                'penghancurkertas_21_due'    => $data['penghancurkertas_21_due'] ?? null,
                'penghancurkertas_21_foto'   => $data['penghancurkertas_21_foto'] ?? null,

                'penghancurkertas_22_check'  => $data['penghancurkertas_22_check'] ?? null,
                'penghancurkertas_22_action' => $data['penghancurkertas_22_action'] ?? null,
                'penghancurkertas_22_due'    => $data['penghancurkertas_22_due'] ?? null,
                'penghancurkertas_22_foto'   => $data['penghancurkertas_22_foto'] ?? null,

                'penghancurkertas_23_check'  => $data['penghancurkertas_23_check'] ?? null,
                'penghancurkertas_23_action' => $data['penghancurkertas_23_action'] ?? null,
                'penghancurkertas_23_due'    => $data['penghancurkertas_23_due'] ?? null,
                'penghancurkertas_23_foto'   => $data['penghancurkertas_23_foto'] ?? null,

                'ac_31_check'  => $data['ac_31_check'] ?? null,
                'ac_31_action' => $data['ac_31_action'] ?? null,
                'ac_31_due'    => $data['ac_31_due'] ?? null,
                'ac_31_foto'   => $data['ac_31_foto'] ?? null,

                'ac_32_check'  => $data['ac_32_check'] ?? null,
                'ac_32_action' => $data['ac_32_action'] ?? null,
                'ac_32_due'    => $data['ac_32_due'] ?? null,
                'ac_32_foto'   => $data['ac_32_foto'] ?? null,

                'ac_33_check'  => $data['ac_33_check'] ?? null,
                'ac_33_action' => $data['ac_33_action'] ?? null,
                'ac_33_due'    => $data['ac_33_due'] ?? null,
                'ac_33_foto'   => $data['ac_33_foto'] ?? null,

                'ac_34_check'  => $data['ac_34_check'] ?? null,
                'ac_34_action' => $data['ac_34_action'] ?? null,
                'ac_34_due'    => $data['ac_34_due'] ?? null,
                'ac_34_foto'   => $data['ac_34_foto'] ?? null,

                'lampupenerangan_41_check'  => $data['lampupenerangan_41_check'] ?? null,
                'lampupenerangan_41_action' => $data['lampupenerangan_41_action'] ?? null,
                'lampupenerangan_41_due'    => $data['lampupenerangan_41_due'] ?? null,
                'lampupenerangan_41_foto'   => $data['lampupenerangan_41_foto'] ?? null,

                'lampupenerangan_42_check'  => $data['lampupenerangan_42_check'] ?? null,
                'lampupenerangan_42_action' => $data['lampupenerangan_42_action'] ?? null,
                'lampupenerangan_42_due'    => $data['lampupenerangan_42_due'] ?? null,
                'lampupenerangan_42_foto'   => $data['lampupenerangan_42_foto'] ?? null,

                'saklar_51_check'  => $data['saklar_51_check'] ?? null,
                'saklar_51_action' => $data['saklar_51_action'] ?? null,
                'saklar_51_due'    => $data['saklar_51_due'] ?? null,
                'saklar_51_foto'   => $data['saklar_51_foto'] ?? null,

                'saklar_52_check'  => $data['saklar_52_check'] ?? null,
                'saklar_52_action' => $data['saklar_52_action'] ?? null,
                'saklar_52_due'    => $data['saklar_52_due'] ?? null,
                'saklar_52_foto'   => $data['saklar_52_foto'] ?? null,

                'instalasilistrik_61_check'  => $data['instalasilistrik_61_check'] ?? null,
                'instalasilistrik_61_action' => $data['instalasilistrik_61_action'] ?? null,
                'instalasilistrik_61_due'    => $data['instalasilistrik_61_due'] ?? null,
                'instalasilistrik_61_foto'   => $data['instalasilistrik_61_foto'] ?? null,

                'instalasilistrik_62_check'  => $data['instalasilistrik_62_check'] ?? null,
                'instalasilistrik_62_action' => $data['instalasilistrik_62_action'] ?? null,
                'instalasilistrik_62_due'    => $data['instalasilistrik_62_due'] ?? null,
                'instalasilistrik_62_foto'   => $data['instalasilistrik_62_foto'] ?? null,

                'instalasilistrik_63_check'  => $data['instalasilistrik_63_check'] ?? null,
                'instalasilistrik_63_action' => $data['instalasilistrik_63_action'] ?? null,
                'instalasilistrik_63_due'    => $data['instalasilistrik_63_due'] ?? null,
                'instalasilistrik_63_foto'   => $data['instalasilistrik_63_foto'] ?? null,

                'lantai_71_check'  => $data['lantai_71_check'] ?? null,
                'lantai_71_action' => $data['lantai_71_action'] ?? null,
                'lantai_71_due'    => $data['lantai_71_due'] ?? null,
                'lantai_71_foto'   => $data['lantai_71_foto'] ?? null,

                'lantai_72_check'  => $data['lantai_72_check'] ?? null,
                'lantai_72_action' => $data['lantai_72_action'] ?? null,
                'lantai_72_due'    => $data['lantai_72_due'] ?? null,
                'lantai_72_foto'   => $data['lantai_72_foto'] ?? null,

                'lantai_73_check'  => $data['lantai_73_check'] ?? null,
                'lantai_73_action' => $data['lantai_73_action'] ?? null,
                'lantai_73_due'    => $data['lantai_73_due'] ?? null,
                'lantai_73_foto'   => $data['lantai_73_foto'] ?? null,

                'lantai_74_check'  => $data['lantai_74_check'] ?? null,
                'lantai_74_action' => $data['lantai_74_action'] ?? null,
                'lantai_74_due'    => $data['lantai_74_due'] ?? null,
                'lantai_74_foto'   => $data['lantai_74_foto'] ?? null,

                'lantai_75_check'  => $data['lantai_75_check'] ?? null,
                'lantai_75_action' => $data['lantai_75_action'] ?? null,
                'lantai_75_due'    => $data['lantai_75_due'] ?? null,
                'lantai_75_foto'   => $data['lantai_75_foto'] ?? null,

                'lantai_76_check'  => $data['lantai_76_check'] ?? null,
                'lantai_76_action' => $data['lantai_76_action'] ?? null,
                'lantai_76_due'    => $data['lantai_76_due'] ?? null,
                'lantai_76_foto'   => $data['lantai_76_foto'] ?? null,

                'lantai_77_check'  => $data['lantai_77_check'] ?? null,
                'lantai_77_action' => $data['lantai_77_action'] ?? null,
                'lantai_77_due'    => $data['lantai_77_due'] ?? null,
                'lantai_77_foto'   => $data['lantai_77_foto'] ?? null,

                'lemarifile_81_check'  => $data['lemarifile_81_check'] ?? null,
                'lemarifile_81_action' => $data['lemarifile_81_action'] ?? null,
                'lemarifile_81_due'    => $data['lemarifile_81_due'] ?? null,
                'lemarifile_81_foto'   => $data['lemarifile_81_foto'] ?? null,

                'lemarifile_82_check'  => $data['lemarifile_82_check'] ?? null,
                'lemarifile_82_action' => $data['lemarifile_82_action'] ?? null,
                'lemarifile_82_due'    => $data['lemarifile_82_due'] ?? null,
                'lemarifile_82_foto'   => $data['lemarifile_82_foto'] ?? null,

                'lemarifile_83_check'  => $data['lemarifile_83_check'] ?? null,
                'lemarifile_83_action' => $data['lemarifile_83_action'] ?? null,
                'lemarifile_83_due'    => $data['lemarifile_83_due'] ?? null,
                'lemarifile_83_foto'   => $data['lemarifile_83_foto'] ?? null,

                'lemarifile_84_check'  => $data['lemarifile_84_check'] ?? null,
                'lemarifile_84_action' => $data['lemarifile_84_action'] ?? null,
                'lemarifile_84_due'    => $data['lemarifile_84_due'] ?? null,
                'lemarifile_84_foto'   => $data['lemarifile_84_foto'] ?? null,

                'lemarifile_85_check'  => $data['lemarifile_85_check'] ?? null,
                'lemarifile_85_action' => $data['lemarifile_85_action'] ?? null,
                'lemarifile_85_due'    => $data['lemarifile_85_due'] ?? null,
                'lemarifile_85_foto'   => $data['lemarifile_85_foto'] ?? null,

                'lemarifile_86_check'  => $data['lemarifile_86_check'] ?? null,
                'lemarifile_86_action' => $data['lemarifile_86_action'] ?? null,
                'lemarifile_86_due'    => $data['lemarifile_86_due'] ?? null,
                'lemarifile_86_foto'   => $data['lemarifile_86_foto'] ?? null,

                'meja_91_check'  => $data['meja_91_check'] ?? null,
                'meja_91_action' => $data['meja_91_action'] ?? null,
                'meja_91_due'    => $data['meja_91_due'] ?? null,
                'meja_91_foto'   => $data['meja_91_foto'] ?? null,

                'meja_92_check'  => $data['meja_92_check'] ?? null,
                'meja_92_action' => $data['meja_92_action'] ?? null,
                'meja_92_due'    => $data['meja_92_due'] ?? null,
                'meja_92_foto'   => $data['meja_92_foto'] ?? null,

                'meja_93_check'  => $data['meja_93_check'] ?? null,
                'meja_93_action' => $data['meja_93_action'] ?? null,
                'meja_93_due'    => $data['meja_93_due'] ?? null,
                'meja_93_foto'   => $data['meja_93_foto'] ?? null,

                'meja_94_check'  => $data['meja_94_check'] ?? null,
                'meja_94_action' => $data['meja_94_action'] ?? null,
                'meja_94_due'    => $data['meja_94_due'] ?? null,
                'meja_94_foto'   => $data['meja_94_foto'] ?? null,

                'komputer_101_check'  => $data['komputer_101_check'] ?? null,
                'komputer_101_action' => $data['komputer_101_action'] ?? null,
                'komputer_101_due'    => $data['komputer_101_due'] ?? null,
                'komputer_101_foto'   => $data['komputer_101_foto'] ?? null,

                'komputer_102_check'  => $data['komputer_102_check'] ?? null,
                'komputer_102_action' => $data['komputer_102_action'] ?? null,
                'komputer_102_due'    => $data['komputer_102_due'] ?? null,
                'komputer_102_foto'   => $data['komputer_102_foto'] ?? null,

                'komputer_103_check'  => $data['komputer_103_check'] ?? null,
                'komputer_103_action' => $data['komputer_103_action'] ?? null,
                'komputer_103_due'    => $data['komputer_103_due'] ?? null,
                'komputer_103_foto'   => $data['komputer_103_foto'] ?? null,

                'komputer_104_check'  => $data['komputer_104_check'] ?? null,
                'komputer_104_action' => $data['komputer_104_action'] ?? null,
                'komputer_104_due'    => $data['komputer_104_due'] ?? null,
                'komputer_104_foto'   => $data['komputer_104_foto'] ?? null,

                'komputer_105_check'  => $data['komputer_105_check'] ?? null,
                'komputer_105_action' => $data['komputer_105_action'] ?? null,
                'komputer_105_due'    => $data['komputer_105_due'] ?? null,
                'komputer_105_foto'   => $data['komputer_105_foto'] ?? null,

                'komputer_106_check'  => $data['komputer_106_check'] ?? null,
                'komputer_106_action' => $data['komputer_106_action'] ?? null,
                'komputer_106_due'    => $data['komputer_106_due'] ?? null,
                'komputer_106_foto'   => $data['komputer_106_foto'] ?? null,

                'additional_notes' => $data['additional_notes'] ?? null,

                'inspektor1' => $data['inspektor1'] ?? null,
                'verified_inspektor1' => $data['inspektor1'] ?? null,
                'inspektor2' => $data['inspektor2'] ?? null,
                'verified_inspektor2' => $data['inspektor2'] ?? null,
                'inspektor3' => $data['inspektor3'] ?? null,
                'verified_inspektor3' => $data['inspektor3'] ?? null,
                'inspektor4' => $data['inspektor4'] ?? null,
                'verified_inspektor4' => $data['inspektor4'] ?? null,

            ];

            InspeksiRuangOffice::create($dataToInsert);

            return redirect()->route('inspeksi.ruangoffice')->with('success', 'Inspeksi Ruang Office berhasil disimpan');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Inspeksi Ruang Office gagal disimpan' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            InspeksiRuangOffice::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.ruangoffice')->with('success', 'Inspeksi Ruang Office berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.ruangoffice')->with('info', nl2br('Inspeksi Ruang Office gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $ro = DB::table('se_inspeksi_ruangoffice as ro')
        ->leftJoin('users as us', 'ro.pic', '=', 'us.id')
        ->leftJoin('ref_departemen as dep', 'ro.departemen', '=', 'dep.id')
        ->leftJoin('users as us1', 'ro.inspektor1', '=', 'us1.nik')
        ->leftJoin('users as us2', 'ro.inspektor2', '=', 'us2.nik')
        ->leftJoin('users as us3', 'ro.inspektor3', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ro.inspektor4', '=', 'us4.nik')
        ->select(
            'ro.*',
            'ro.pic as pic_id',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, ro.created_at, 120) as tanggal_pembuatan'),
            'ro.statusenabled',
            'dep.keterangan as departemen',
            'ro.inspektor1 as nik_inspektor1',
            'us1.name as nama_inspektor1',
            'us1.position as jabatan_inspektor1',
            'ro.inspektor2 as nik_inspektor2',
            'us2.name as nama_inspektor2',
            'us2.position as jabatan_inspektor2',
            'ro.inspektor3 as nik_inspektor3',
            'us3.name as nama_inspektor3',
            'us3.position as jabatan_inspektor3',
            'ro.inspektor4 as nik_inspektor4',
            'us4.name as nama_inspektor4',
            'us4.position as jabatan_inspektor4',
            'ro.tanggal_inspeksi',
            'ro.jam_inspeksi',
        )
        ->where('ro.statusenabled', true)
        ->where('ro.uuid', $uuid)->first();

        if($ro == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $item = $ro;

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
        }

        return view('inspeksi.ruang-office.preview', compact('ro'));
    }
}
