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
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WhatsAppController;

class DiggibilityController extends Controller
{
    private function kategoriMaterial($area, $jenisMaterial, $average, $kategoriLama = null)
    {
        // Free Dig menggunakan batas tersendiri, terlepas dari sisi area.
        $batas = strcasecmp(trim((string) $jenisMaterial), 'Free Dig') === 0
            ? 15.99
            : (['sisi highwall' => 14.00, 'sisi tengah' => 12.50, 'sisi freeface' => 13.50][strtolower(trim((string) $area))] ?? null);

        if ($batas === null || $average === null || $average === '') {
            return $kategoriLama;
        }

        return round((float) $average, 2) <= $batas ? 'MATERIAL BAGUS' : 'MATERIAL KERAS';
    }

    private function perbaruiKategori($item)
    {
        $item->kategori = $this->kategoriMaterial(
            $item->keterangan_area,
            $item->jenis_material,
            $item->average_digging_time,
            $item->kategori
        );
        return $item;
    }

    public function index(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_sampai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

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

        $tanggalMulai = $request->input('tanggal_mulai') ?: now()->toDateString();
        $tanggalSampai = $request->input('tanggal_sampai') ?: now()->toDateString();

        if ($tanggalMulai > $tanggalSampai) {
            return back()->withErrors(['tanggal_sampai' => 'Tanggal sampai harus sama atau setelah tanggal mulai.']);
        }

        if ($request->input('export') === 'raw') {
            return $this->exportRawData(clone $query, $tanggalMulai, $tanggalSampai);
        }

        // Hanya tren yang memakai 30 hari kalender terakhir, termasuk hari ini.
        // Rekap dihitung langsung oleh SQL Server tanpa memuat seluruh laporan.
        $trendMulai = now()->startOfDay()->subDays(29);
        $trendSampai = now()->startOfDay()->addDay();
        $kategoriSql = "CASE
            WHEN UPPER(LTRIM(RTRIM(tc_diggibility_timesession.jenis_material))) = 'FREE DIG' THEN 15.99
            WHEN UPPER(LTRIM(RTRIM(tc_diggibility_timesession.keterangan_area))) = 'SISI HIGHWALL' THEN 14.00
            WHEN UPPER(LTRIM(RTRIM(tc_diggibility_timesession.keterangan_area))) = 'SISI TENGAH' THEN 12.50
            WHEN UPPER(LTRIM(RTRIM(tc_diggibility_timesession.keterangan_area))) = 'SISI FREEFACE' THEN 13.50
            ELSE NULL END";

        $trend = (clone $query)
            ->select(DB::raw("CAST(tc_diggibility_timesession.tanggal AS date) AS tanggal,
                COUNT(*) AS total,
                SUM(CASE WHEN {$kategoriSql} IS NOT NULL
                    AND ROUND(tc_diggibility_timesession.average_digging_time, 2) <= {$kategoriSql}
                    THEN 1 ELSE 0 END) AS bagus,
                SUM(CASE WHEN {$kategoriSql} IS NOT NULL
                    AND ROUND(tc_diggibility_timesession.average_digging_time, 2) > {$kategoriSql}
                    THEN 1 ELSE 0 END) AS keras"))
            ->where('tc_diggibility_timesession.tanggal', '>=', $trendMulai)
            ->where('tc_diggibility_timesession.tanggal', '<', $trendSampai)
            ->groupByRaw('CAST(tc_diggibility_timesession.tanggal AS date)')
            ->orderBy('tanggal')
            ->get()
            ->mapWithKeys(fn ($item) => [
                \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') => [
                    'total' => (int) $item->total,
                    'bagus' => (int) $item->bagus,
                    'keras' => (int) $item->keras,
                ],
            ]);

        $data = $query
            ->whereDate('tc_diggibility_timesession.tanggal', '>=', $tanggalMulai)
            ->whereDate('tc_diggibility_timesession.tanggal', '<=', $tanggalSampai)
            ->with('passes')
            ->orderByDesc('tc_diggibility_timesession.tanggal')
            ->orderByDesc('tc_diggibility_timesession.id')
            ->get()
            ->map(fn ($item) => $this->perbaruiKategori($item));

        $laporan = $data;

        $totalLaporan = $data->count();

        $totalPengawas = $data
            ->pluck('nama_pengawas')
            ->filter()
            ->unique()
            ->count();

        $totalBagus = $data
            ->where('kategori', 'MATERIAL BAGUS')
            ->count();

        $totalKeras = $data
            ->where('kategori', 'MATERIAL KERAS')
            ->count();

        $totalKategori = $totalBagus + $totalKeras;

        $persenBagus = $totalKategori
            ? round(($totalBagus / $totalKategori) * 100)
            : 0;

        $persenKeras = $totalKategori
            ? round(($totalKeras / $totalKategori) * 100)
            : 0;

        $area = $data
            ->groupBy('keterangan_area')
            ->map(function ($items) {
                return [
                    'total' => $items->count(),

                    'bagus' => $items
                        ->where('kategori', 'MATERIAL BAGUS')
                        ->count(),

                    'keras' => $items
                        ->where('kategori', 'MATERIAL KERAS')
                        ->count(),
                ];
            });

        $lokasi = $data
            ->groupBy('lokasi')
            ->map(function ($items) {
                return [
                    'total' => $items->count(),

                    'bagus' => $items
                        ->where('kategori', 'MATERIAL BAGUS')
                        ->count(),

                    'keras' => $items
                        ->where('kategori', 'MATERIAL KERAS')
                        ->count(),
                ];
            });

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
            'laporan',
            'totalLaporan',
            'totalPengawas',
            'totalBagus',
            'totalKeras',
            'persenBagus',
            'persenKeras',
            'area',
            'lokasi',
            'trend',
            'pengawas',
            'lokasiList',
            'materialList'
        ));
    }

    private function exportRawData($query, $tanggalMulai, $tanggalSampai)
    {
        $namaFile = "diggibility_raw_{$tanggalMulai}_sd_{$tanggalSampai}.csv";

        return response()->streamDownload(function () use ($query, $tanggalMulai, $tanggalSampai) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM agar terbaca baik di Excel.

            fputcsv($output, [
                'ID Laporan', 'UUID Laporan', 'Tanggal', 'Jam', 'No Unit',
                'Tinggi Jenjang', 'Lokasi', 'Titik Koordinat', 'Jenis Material',
                'Keterangan Area', 'NIK Operator', 'Nama Operator',
                'NIK Pengawas', 'Nama Pengawas', 'PIC', 'Passes Bucket',
                'Operator Fit', 'Kinerja Operator Rendah', 'Keterangan Tambahan',
                'Total Passes', 'Total Digging Time (detik)',
                'Average Digging Time (detik)', 'Kategori', 'Status',
                'Pass No', 'Digging Time Pass (detik)', 'UUID Pass', 'Dibuat Pada',
            ]);

            $query->whereDate('tc_diggibility_timesession.tanggal', '>=', $tanggalMulai)
                ->whereDate('tc_diggibility_timesession.tanggal', '<=', $tanggalSampai)
                ->with(['passes' => function ($q) {
                    $q->orderBy('pass_no');
                }])
                ->orderBy('tc_diggibility_timesession.id')
                ->chunk(500, function ($sessions) use ($output) {
                    foreach ($sessions as $session) {
                        $this->perbaruiKategori($session);
                        // Tetap keluarkan laporan meskipun tidak mempunyai detail pass.
                        $passes = $session->passes->isEmpty() ? [null] : $session->passes;
                        foreach ($passes as $pass) {
                            $values = [
                                $session->id, $session->uuid, $session->tanggal,
                                $session->jam, $session->no_unit, $session->tinggi_jenjang,
                                $session->lokasi, $session->titik_koordinat,
                                $session->jenis_material, $session->keterangan_area,
                                $session->nik_operator, $session->nama_operator,
                                $session->nik_pengawas, $session->nama_pengawas,
                                $session->nama_pic, $session->passes_bucket,
                                $session->operator_fit, $session->kinerja_operator_rendah,
                                $session->keterangan_tambahan, $session->total_passes,
                                $session->total_digging_time, $session->average_digging_time,
                                $session->kategori, $session->status,
                                $pass?->pass_no, $pass?->digging_time, $pass?->uuid,
                                $session->created_at,
                            ];
                            // Cegah formula CSV dijalankan ketika file dibuka di Excel.
                            $values = array_map(function ($value) {
                                if (is_string($value) && preg_match('/^[\s]*[=+@\-]/u', $value)) {
                                    return "'" . $value;
                                }
                                return $value;
                            }, $values);
                            fputcsv($output, $values);
                        }
                    }
                    fflush($output);
                });
            fclose($output);
        }, $namaFile, ['Content-Type' => 'text/csv; charset=UTF-8']);
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
            'keterangan_tambahan' => 'nullable|string|max:500',
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

            $kategori = $this->kategoriMaterial(
                $validated['keterangan_area'] ?? null,
                $validated['jenis_material'] ?? null,
                $average
            );
            if ($kategori === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis material atau sisi area tidak valid.',
                ], 422);
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
                'keterangan_tambahan' => $validated['keterangan_tambahan'] ?? null,
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

        $this->perbaruiKategori($data);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function download($id)
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

        $this->perbaruiKategori($data);

        // dd($data);

        //PDF
        $pdf = PDF::loadView('diggibility.pdf', compact('data'));
        return $pdf->download('Digging Time.pdf');
    }

    public function previewTemplate($id)
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

        $this->perbaruiKategori($data);

        return view('diggibility.download', compact('data'));
    }

    public function sendWhatsapp(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // Maks 5MB
        ]);

        $data = DiggibilityTimeSession::query()
            ->leftJoin('users', 'users.id', '=', 'tc_diggibility_timesession.pic')
            ->where('tc_diggibility_timesession.id', $id)
            ->where('tc_diggibility_timesession.statusenabled', 1)
            ->select(
                'tc_diggibility_timesession.*',
                'users.name as nama_pic',
                'users.no_hp'
            )
            ->with('passes')
            ->firstOrFail();

        $this->perbaruiKategori($data);

        $rawNumber = trim($data->no_hp ?? '');
        if ($rawNumber === '') {
            return response()->json([
                'success' => false,
                'message' => 'Nomor WhatsApp PIC kosong atau belum diatur pada profil user.'
            ], 422);
        }

        $targetNumber = $data->no_hp;

        if (empty($targetNumber)) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor WhatsApp tujuan tidak ditemukan pada data profil/laporan ini.'
            ], 422);
        }
        $targetNumber = preg_replace('/[^0-9]/', '', $targetNumber);
        if (str_starts_with($targetNumber, '0')) {
            $targetNumber = '62' . substr($targetNumber, 1);
        } elseif (str_starts_with($targetNumber, '8')) {
            $targetNumber = '62' . $targetNumber;
        }

        $path = $request->file('image')->store('diggibility', 'public');
        $imageUrl = asset('storage/' . $path);

        $caption = "*MONITORING DIGGIBILITY MATERIAL BLASTING*\n\n"
                 . "• Unit: *{$data->no_unit}*\n"
                 . "• Lokasi: {$data->lokasi}\n"
                 . "• Kategori: *{$data->kategori}*\n"
                 . "• Avg Digging Time: *{$data->average_digging_time} Detik*\n"
                 . "• Pengawas: {$data->nama_pengawas}\n\n"
                 . "_Laporan digital diggibility terlampir pada gambar._";

        $waController = new WhatsAppController();
        $result = $waController->sendMessageImage($targetNumber, $caption, $imageUrl);

        if (isset($result['status']) && $result['status'] === 'error') {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Gagal mengirim pesan WhatsApp.',
                'details' => $result
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim ke nomor ' . $targetNumber,
            'data' => $result
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
