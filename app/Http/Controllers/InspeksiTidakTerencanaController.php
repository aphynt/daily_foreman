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

        if (empty($request->rangeStart) || empty($request->rangeEnd)) {
            $start = Carbon::today()->format('Y-m-d');
            $end   = Carbon::today()->format('Y-m-d');
        } else {
            $start = Carbon::parse($request->rangeStart)->format('Y-m-d');
            $end   = Carbon::parse($request->rangeEnd)->format('Y-m-d');
        }

        $table = (new InspeksiTidakTerencana)->getTable();

        $rawData = InspeksiTidakTerencana::from($table . ' as itt')
            ->leftJoin('users as u', 'itt.pic', '=', 'u.id')
            ->where('itt.statusenabled', true)
            ->whereBetween(DB::raw('CONVERT(varchar, itt.tanggal, 23)'), [$start, $end])
            ->orderBy('itt.nik')
            ->orderBy('itt.tanggal')
            ->orderBy('itt.waktu')
            ->select([
                'itt.*',
                'u.id as pic_user_id',
                'u.nik as pic_nik',
                'u.name as pic_nama',
            ])
            ->get();

        $data = $rawData->groupBy(function ($item) {
            return $item->nik . '|' . Carbon::parse($item->tanggal)->format('Y-m-d');
        })->map(function ($items) {
            $first = $items->first();

            return (object) [
                'id' => $first->id,
                'uuid' => $first->uuid,
                'nik' => $first->nik,
                'nama' => $first->nama,
                'tanggal' => Carbon::parse($first->tanggal)->format('Y-m-d'),
                'waktu' => $items->map(function ($row) {
                    return Carbon::parse($row->waktu)->format('H:i');
                })->unique()->implode(', '),
                'pelanggaran' => $items->map(function ($row) {
                    return trim($row->pelanggaran . ' ' . $row->pelanggaran_detail);
                })->implode(' | '),
                'dokumentasi_foto_1' => $items->pluck('dokumentasi_foto_1')->filter()->unique()->implode(', ') ?: '-',
                'dokumentasi_foto_2' => $items->pluck('dokumentasi_foto_2')->filter()->unique()->implode(', ') ?: '-',

                // PIC hasil join users
                'pic_nik' => $items->pluck('pic_nik')->filter()->unique()->implode(', ') ?: '-',
                'pic_nama' => $items->pluck('pic_nama')->filter()->unique()->implode(', ') ?: '-',

                'jumlah_temuan' => $items->count(),
                'detail' => $items,
            ];
        })->values();

        return view('inspeksi.tidak-terencana.index', compact('data'));
    }

    public function preview(Request $request)
    {
        if (empty($request->rangeStart) || empty($request->rangeEnd)) {
            $start = Carbon::today()->format('Y-m-d');
            $end   = Carbon::today()->format('Y-m-d');
        } else {
            $start = Carbon::parse($request->rangeStart)->format('Y-m-d');
            $end   = Carbon::parse($request->rangeEnd)->format('Y-m-d');
        }

        $rows = InspeksiTidakTerencana::where('statusenabled', true)
            ->whereBetween(DB::raw('CONVERT(varchar, tanggal, 23)'), [$start, $end])
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->get()
            ->map(function ($item, $key) {
                return (object) [
                    'no' => $key + 1,
                    'nama' => $item->nama,
                    'nik' => $item->nik,
                    'tanggal' => Carbon::parse($item->tanggal)->format('d-m-Y'),
                    'waktu' => Carbon::parse($item->waktu)->format('H:i'),
                    'kode_item' => $item->pelanggaran, // A,B,C,dst
                    'level' => null, // nanti isi 1-5 kalau field-nya sudah ada
                    'keterangan' => $item->keterangan,
                ];
            });

        $pages = $rows->chunk(30);

        return view('inspeksi.tidak-terencana.preview', compact('pages'));
    }

    public function delete($uuid)
    {
        try {
            InspeksiTidakTerencana::where('uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('inspeksi.tidakterencana')->with('success', 'Inspeksi Tidak Terencana berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('inspeksi.tidakterencana')->with('info', nl2br('Inspeksi Tidak Terencana gagal dihapus..\n' . $th->getMessage()));
        }
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
        $nik = null;
        $nama = null;
        $pelanggaran = $request->pelanggaran ?? [];

        if (in_array('Z', $pelanggaran) && empty($request->pelanggaran_lainnya)) {
            return back()
                ->withInput()
                ->withErrors([
                    'pelanggaran_lainnya' => 'Pelanggaran lainnya wajib diisi.',
                ]);
        }

        if ($request->searching_by === 'manual') {
            $nik = $request->manual_nik;
            $nama = $request->manual_nama;

            if (empty($nik) || empty($nama)) {
                return back()
                    ->withInput()
                    ->with('info', 'Data NIK/Nama manual tidak valid.');
            }
        }

        if ($request->searching_by === 'nik') {
            $nik = $request->nik;
            $nama = $request->nama;

            if (empty($nik) || empty($nama)) {
                return back()
                    ->withInput()
                    ->with('info', 'Data NIK/Nama dari pilihan NIK tidak valid.');
            }
        }

        if ($request->searching_by === 'focus') {
            $nik = $request->nik;
            $nama = $request->nama;

            if (empty($nik) || empty($nama)) {
                return back()
                    ->withInput()
                    ->with('info', 'Data NIK/Nama dari unit focus tidak valid.');
            }
        }

        DB::beginTransaction();

        try {
            $pelanggaranString = implode(',', $pelanggaran);

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
                'K' => 'Random Fatique',
                'L' => 'Tidak Ada Pelanggaran',
                'Z' => 'Lainnya',
            ];

            $pelanggaranDetailItems = [];

            foreach ($pelanggaran as $kode) {
                if (isset($pelanggaranMap[$kode])) {
                    $pelanggaranDetailItems[] = '- ' . $pelanggaranMap[$kode];
                }
            }

            if (!empty($request->pelanggaran_lainnya)) {
                $pelanggaranDetailItems[] = '- Lainnya: ' . $request->pelanggaran_lainnya;
            }

            $pelanggaranDetail = implode("\n", $pelanggaranDetailItems);

            $saveFile = function ($fieldName, $relativeFolder) use ($request) {
                if (!$request->hasFile($fieldName)) {
                    return null;
                }

                $file = $request->file($fieldName);
                $destinationPath = public_path($relativeFolder);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $fileName);

                return url($relativeFolder . '/' . $fileName);
            };

            $dokumentasiFoto1 = $saveFile('dokumentasi_foto_1', 'storage/inspeksi_tidakterencana/dokumentasi');
            $dokumentasiFoto2 = $saveFile('dokumentasi_foto_2', 'storage/inspeksi_tidakterencana/dokumentasi');

            InspeksiTidakTerencana::create([
                'uuid'                    => (string) Uuid::uuid4()->toString(),
                'pic'                     => Auth::user()->id,
                'inspektor'               => Auth::user()->nik,
                'verified_inspektor'      => Auth::user()->nik,
                'date_verified_inspektor' => Carbon::now(),
                'searching_by'            => $request->searching_by,
                'nik'                     => $nik,
                'nama'                    => $nama,
                'tanggal'                 => $request->tanggal,
                'waktu'                   => $request->waktu,
                'pelanggaran'             => $pelanggaranString,
                'pelanggaran_lainnya'     => $request->pelanggaran_lainnya,
                'pelanggaran_detail'      => $pelanggaranDetail,
                'dokumentasi_foto_1'      => $dokumentasiFoto1,
                'dokumentasi_foto_2'      => $dokumentasiFoto2,
                'keterangan'              => $request->keterangan,
            ]);

            DB::commit();

            return back()->with('success', 'Data inspeksi berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('info', 'Data gagal disimpan. ' . $th->getMessage());
        }
    }
}
