<?php

namespace App\Http\Controllers\TrainingCenter;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DiggibilityTimePass;
use App\Models\DiggibilityTimeSession;
use App\Models\FLTVehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiggibilityController extends Controller
{
    public function index(Request $request)
    {
        $query = DiggibilityTimeSession::query()
            ->leftJoin('users', 'users.id', '=', 'tc_diggibility_timesession.pic')
            ->where('tc_diggibility_timesession.statusenabled', 1)
            ->select(
                'tc_diggibility_timesession.*',
                'users.name as nama_pic'
            );

        if ($request->pengawas) {
            $query->where('nama_pengawas', $request->pengawas);
        }

        if ($request->lokasi) {
            $query->where('lokasi', $request->lokasi);
        }

        if ($request->jenis_material) {
            $query->where('jenis_material', $request->jenis_material);
        }

        if ($request->tanggal_mulai) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->tanggal_sampai) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $data = $query->with('passes')->orderByDesc('id')->get();

        $totalLaporan = $data->count();
        $totalPengawas = $data->pluck('nama_pengawas')->filter()->unique()->count();

        $totalBagus = $data->where('kategori', 'MATERIAL BAGUS')->count();
        $totalIndikasi = $data->where('kategori', 'INDIKASI MATERIAL KERAS')->count();
        $totalKeras = $data->where('kategori', 'MATERIAL KERAS')->count();

        $totalKategori = $totalBagus + $totalIndikasi + $totalKeras;

        $persenBagus = $totalKategori ? round(($totalBagus / $totalKategori) * 100) : 0;
        $persenIndikasi = $totalKategori ? round(($totalIndikasi / $totalKategori) * 100) : 0;
        $persenKeras = $totalKategori ? round(($totalKeras / $totalKategori) * 100) : 0;

        $area = $data->groupBy('keterangan_area')->map(function ($items) {
            return [
                'total' => $items->count(),
                'bagus' => $items->where('kategori', 'MATERIAL BAGUS')->count(),
                'indikasi' => $items->where('kategori', 'INDIKASI MATERIAL KERAS')->count(),
                'keras' => $items->where('kategori', 'MATERIAL KERAS')->count(),
            ];
        });

        $lokasi = $data->groupBy('lokasi')->map(function ($items) {
            return [
                'total' => $items->count(),
                'bagus' => $items->where('kategori', 'MATERIAL BAGUS')->count(),
                'keras' => $items->where('kategori', 'MATERIAL KERAS')->count(),
            ];
        });

        $trend = $data->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
        })->map(function ($items) {
            return [
                'total' => $items->count(),
                'bagus' => $items->where('kategori', 'MATERIAL BAGUS')->count(),
                'keras' => $items->where('kategori', 'MATERIAL KERAS')->count(),
            ];
        })->sortKeys();

        $pengawas = DiggibilityTimeSession::where('statusenabled', 1)
            ->whereNotNull('nama_pengawas')
            ->distinct()
            ->orderBy('nama_pengawas')
            ->pluck('nama_pengawas');

        $lokasiList = DiggibilityTimeSession::where('statusenabled', 1)
            ->whereNotNull('lokasi')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        $materialList = DiggibilityTimeSession::where('statusenabled', 1)
            ->whereNotNull('jenis_material')
            ->distinct()
            ->orderBy('jenis_material')
            ->pluck('jenis_material');

        return view('diggibility.index', compact(
            'data',
            'totalLaporan',
            'totalPengawas',
            'totalBagus',
            'totalIndikasi',
            'totalKeras',
            'persenBagus',
            'persenIndikasi',
            'persenKeras',
            'area',
            'lokasi',
            'trend',
            'pengawas',
            'lokasiList',
            'materialList'
        ));
    }

    public function insert()
    {
        $region = Area::where('group', 'production')->where('statusenabled', true)->get();
        $ex = FLTVehicle::where('VHC_ID', 'LIKE', 'EX%')
        ->where('VHC_ACTIVE', 1)
        ->get();
        $pengawas = User::where(function ($query) {
            $query->whereIn('role', ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT', 'MANAGEMENT'])
                    ->orWhereIn('id', [
                        8043, 8044, 8045, 8046, 8047, 8048, 8049,
                        8050, 8051, 8052, 8053, 8054, 8055, 8056, 8058, 8059, 8062,
                        8063, 8066, 8067, 8068, 8069, 8070
                    ]);
            })->where('statusenabled', true)
        ->orderBy('name')->get();
        $data = DiggibilityTimeSession::with('passes')
            ->where('statusenabled', 1)
            ->orderByDesc('id')
            ->paginate(20);

        return view('diggibility.insert', compact('data', 'region', 'ex', 'pengawas'));
    }

    public function post(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'nullable',
            'no_unit' => 'required|string|max:255',
            'tinggi_jenjang' => 'nullable|numeric',
            'lokasi' => 'required|string|max:100',
            'titik_koordinat' => 'nullable|string|max:150',
            'jenis_material' => 'nullable|string|max:100',
            'nik_operator' => 'nullable|string|max:150',
            'nama_operator' => 'nullable|string|max:150',
            'nik_pengawas' => 'nullable|string|max:150',
            'nama_pengawas' => 'nullable|string|max:500',
            'passes_bucket' => 'nullable|string|max:50',
            'operator_fit' => 'nullable|string|max:10',
            'kinerja_operator_rendah' => 'nullable|string|max:10',
            'keterangan_area' => 'nullable|string|max:500',
            'passes' => 'required|array|min:1|max:20',
            'passes.*.pass_no' => 'required|integer|min:1|max:20',
            'passes.*.digging_time' => 'required|numeric|min:0',
        ]);

        DB::connection('sqlsrv')->beginTransaction();

        try {
            $passes = collect($validated['passes']);
            $totalPasses = $passes->count();
            $totalDiggingTime = $passes->sum(fn($pass) => (float) $pass['digging_time']);
            $average = $totalPasses > 0 ? round($totalDiggingTime / $totalPasses, 2) : 0;

            if ($average <= 12) {
                $kategori = 'MATERIAL BAGUS';
            } elseif ($average < 15) {
                $kategori = 'INDIKASI MATERIAL KERAS';
            } else {
                $kategori = 'MATERIAL KERAS';
            }

            $userId = Auth::id();

            $session = DiggibilityTimeSession::create([
                'uuid' => (string) Str::uuid(),
                'pic' => $userId,
                'statusenabled' => 1,
                'tanggal' => $validated['tanggal'],
                'jam' => $validated['jam'] ?? null,
                'no_unit' => $validated['no_unit'],
                'tinggi_jenjang' => $validated['tinggi_jenjang'] ?? null,
                'lokasi' => $validated['lokasi'],
                'titik_koordinat' => $validated['titik_koordinat'] ?? null,
                'jenis_material' => $validated['jenis_material'] ?? null,
                'nik_operator' => $validated['nik_operator'] ?? null,
                'nama_operator' => $validated['nama_operator'] ?? null,
                'nik_pengawas' => $validated['nik_pengawas'] ?? null,
                'nama_pengawas' => $validated['nama_pengawas'] ?? null,
                'passes_bucket' => $validated['passes_bucket'] ?? null,
                'operator_fit' => $validated['operator_fit'] ?? null,
                'kinerja_operator_rendah' => $validated['kinerja_operator_rendah'] ?? null,
                'keterangan_area' => $validated['keterangan_area'] ?? null,
                'kategori' => $kategori,
                'total_passes' => $totalPasses,
                'total_digging_time' => round($totalDiggingTime, 2),
                'average_digging_time' => $average,
                'status' => 'SUBMITTED',
                'deleted_by' => null,
                'updated_by' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($passes as $pass) {
                $session->passes()->create([
                    'uuid' => (string) Str::uuid(),
                    'pic' => $userId,
                    'statusenabled' => 1,
                    'timesession_id' => $session->id,
                    'pass_no' => $pass['pass_no'],
                    'digging_time' => round((float) $pass['digging_time'], 2),
                    'deleted_by' => null,
                    'updated_by' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::connection('sqlsrv')->commit();

            return response()->json([
                'success' => true,
                'message' => 'Data digging time berhasil disimpan.',
                'data' => [
                    'id' => $session->id,
                    'uuid' => $session->uuid,
                    'kategori' => $kategori,
                    'total_passes' => $totalPasses,
                    'total_digging_time' => round($totalDiggingTime, 2),
                    'average' => $average,
                ],
            ]);
        } catch (\Throwable $e) {
            DB::connection('sqlsrv')->rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function show($id)
    {
        $data = DiggibilityTimeSession::query()
            ->leftJoin('users', 'users.id', '=', 'tc_diggibility_timesession.pic')
            ->where('tc_diggibility_timesession.id', $id)
            ->where('tc_diggibility_timesession.statusenabled', 1)
            ->select(
                'tc_diggibility_timesession.*',
                'users.name as nama_pic'
            )
            ->with('passes')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        try {
            $data = DiggibilityTimeSession::find($id);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data laporan tidak ditemukan.'
                ], 404);
            }

            $data->update([
                'statusenabled' => 0,
                'deleted_by' => Auth::user()->id
            ]);

            DiggibilityTimePass::where('timesession_id', $data->id)
                ->where('statusenabled', 1)
                ->update([
                    'statusenabled' => 0,
                    'deleted_by' => Auth::user()->id
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Laporan dan seluruh pass berhasil dihapus.'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}