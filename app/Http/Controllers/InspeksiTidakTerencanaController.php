<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\FLTVehicle;
use App\Models\InspeksiTidakTerencana;
use App\Models\Personal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use DateTime;

class InspeksiTidakTerencanaController extends Controller
{
    //
    public function index(Request $request)
    {
        session(['requestTimeInspeksiTidakTerencana' => $request->all()]);

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

        $data = InspeksiTidakTerencana::where('statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, tanggal, 23)'), [$startTimeFormatted, $endTimeFormatted])
        ->get();
        return view('inspeksi.tidak-terencana.index', compact('data'));
    }

    public function operatorFocus($unit)
    {
        try {
            $operator = FLTVehicle::where('VHC_ACTIVE', 1)
                ->where('VHC_ID', $unit)
                ->select('OPR_NRP', 'OPR_NAME')
                ->first();

            return response()->json([
                'nik' => $operator->OPR_NRP ?? null,
                'nama_panggil' => $operator->OPR_NAME ?? null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function insert()
    {
        $users = User::where('statusenabled', 1)->whereNotIn('role', ['ADMIN', 'MANAGEMENT'])->get();
        $operator = FLTVehicle::where('VHC_ACTIVE', 1)->get();
        return view('inspeksi.tidak-terencana.insert', compact('operator', 'users'));
    }

    public function post(Request $request)
    {

        DB::beginTransaction();

        try {
            $nik = null;
            $nama = null;
            $pelanggaran = $request->pelanggaran ?? [];

            if (in_array('K', $pelanggaran) && empty($request->pelanggaran_lainnya)) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'pelanggaran_lainnya' => 'Pelanggaran lainnya wajib diisi.',
                    ]);
            }

            if ($request->searching_by === 'nik') {
                $nik = $request->nik;
                $nama = $request->nama;

                if (empty($nik) || empty($nama)) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            'nik' => 'Data NIK/Nama dari pilihan NIK tidak valid.',
                        ]);
                }
            }

            if ($request->searching_by === 'focus') {
                $nik = $request->nik;
                $nama = $request->nama;

                if (empty($nik) || empty($nama)) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            'focus_unit_hd' => 'Data operator dari unit focus tidak ditemukan.',
                        ]);
                }
            }

            // Simpan kode pelanggaran
            $pelanggaranString = implode(',', $pelanggaran);

            // Mapping kode -> deskripsi
            $pelanggaranMap = [
                'A' => 'Melebihi batas kecepatan',
                'B' => 'Pelanggaran rambu (STOP, mendahului, parkir, dll)',
                'C' => 'Tidak menjaga jarak aman',
                'D' => 'No seat belt',
                'E' => 'Tidak menggunakan APD sesuai pekerjaan',
                'F' => 'Merokok di area terlarang',
                'G' => 'Tidak membawa mine permit / kimper',
                'H' => 'Tidak melaksanakan LOTO',
                'I' => 'Tidak melakukan P2H',
                'J' => 'Tidak mengisi KKH',
                'K' => 'Lainnya',
            ];

            // Susun detail pelanggaran dalam bentuk teks deskripsi
            $pelanggaranDetailItems = [];

            foreach ($pelanggaran as $kode) {
                if ($kode === 'K') {
                    continue;
                }

                if (isset($pelanggaranMap[$kode])) {
                    $pelanggaranDetailItems[] = '- ' . $pelanggaranMap[$kode];
                }
            }

            if (!empty($request->pelanggaran_lainnya)) {
                $pelanggaranDetailItems[] = '- Lainnya: ' . $request->pelanggaran_lainnya;
            }

            $pelanggaranDetail = implode("\n", $pelanggaranDetailItems);

            InspeksiTidakTerencana::create([
                'uuid'                => (string) Uuid::uuid4()->toString(),
                'pic'                 => Auth::user()->id,
                'searching_by'        => $request->searching_by,
                'nik'                 => $nik,
                'nama'                => $nama,
                'tanggal'             => $request->tanggal,
                'waktu'               => $request->waktu,
                'pelanggaran'         => $pelanggaranString,
                'pelanggaran_lainnya' => $request->pelanggaran_lainnya,
                'pelanggaran_detail'  => $pelanggaranDetail,
                'keterangan'          => $request->keterangan,
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Data inspeksi berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data gagal disimpan. ' . $th->getMessage());
        }
    }
}
