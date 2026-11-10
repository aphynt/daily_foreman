<?php

namespace App\Console\Commands;

use App\Http\Controllers\WhatsAppController;
use App\Models\RefConf;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendKkhVerificationReminder extends Command
{
    protected $signature = 'kkh:send-verification-reminder {--dry-run}';

    protected $description = 'Mengirim notifikasi WhatsApp KKH berdasarkan departemen';

    public function handle()
    {
        /** @var \Illuminate\Cache\FileStore $fileCache */
        $fileCache = Cache::store('file')->getStore();

        $lock = $fileCache->lock('kkh_verification_reminder_lock', 120);

        if (!$lock->get()) {
            $this->info('Proses notifikasi KKH masih berjalan.');
            return 0;
        }

        try {
            return $this->processReminder();
        } catch (\Throwable $e) {
            Log::error('KKH Reminder Error', [
                'error' => $e->getMessage()
            ]);

            $this->error($e->getMessage());

            return 1;
        } finally {
            $lock->release();
        }
    }

    private function processReminder()
    {
        $tanggal = Carbon::now('Asia/Makassar')->toDateString();

        $mappingDepartemen = [
            1 => ['nama' => 'CMS', 'ref_conf' => 15],
            2 => ['nama' => 'Engineering', 'ref_conf' => 14],
            3 => ['nama' => 'Finance', 'ref_conf' => 20],
            4 => ['nama' => 'General Affair', 'ref_conf' => 18],
            5 => ['nama' => 'HRD', 'ref_conf' => 19],
            6 => ['nama' => 'Logistik', 'ref_conf' => 16],
            7 => ['nama' => 'Planning', 'ref_conf' => 17],
            8 => ['nama' => 'Production', 'ref_conf' => 13],
            9 => ['nama' => 'SE', 'ref_conf' => 24],
            10 => ['nama' => 'Training Centre', 'ref_conf' => 23],
            11 => ['nama' => 'Workshop', 'ref_conf' => 21],
            17 => ['nama' => 'Rebuild', 'ref_conf' => 22],
        ];

        $this->info("Memeriksa KKH tanggal: {$tanggal}");

        $latestIds = DB::connection('kkh')
            ->table('db_payroll.dbo.web_kkh')
            ->whereDate('tgl', $tanggal)
            ->groupBy('nik')
            ->selectRaw('MAX(id) as id');

        $dataKKH = DB::connection('kkh')
            ->table('db_payroll.dbo.web_kkh as kkh')
            ->joinSub($latestIds, 'latest', function ($join) {
                $join->on('kkh.id', '=', 'latest.id');
            })
            ->leftJoin(
                'db_payroll.dbo.tbl_data_hr as hr',
                'kkh.nik',
                '=',
                'hr.nik'
            )
            ->where(function ($query) {
                $query->where('kkh.ferivikasi_pengawas', 0)
                    ->orWhereNull('kkh.ferivikasi_pengawas');
            })
            ->select(
                'kkh.id',
                'kkh.nik',
                'hr.Nama as nama',
                'hr.ID_Departemen as departemen_id',
                'kkh.shift_kkh as shift'
            )
            ->orderBy('kkh.id')
            ->get();

        if ($dataKKH->isEmpty()) {
            $this->info('Tidak ada KKH yang perlu diverifikasi.');
            return 0;
        }

        $dataPerDepartemen = $dataKKH->groupBy(function ($row) {
            return (int) $row->departemen_id;
        });

        $tanggalFormat = Carbon::parse($tanggal)
            ->locale('id')
            ->translatedFormat('l, d F Y');

        $refConfIds = collect($mappingDepartemen)
            ->pluck('ref_conf')
            ->all();

        $nomorKonfigurasi = RefConf::whereIn('id', $refConfIds)
            ->pluck('value', 'id');

        $cache = Cache::store('file');

        $waController = new WhatsAppController();

        $totalTerkirim = 0;
        $totalDilewati = 0;
        $totalGagal = 0;
        $totalTanpaKonfigurasi = 0;
        $totalDryRun = 0;

        foreach ($dataPerDepartemen as $departemenId => $dataDepartemen) {
            if (!isset($mappingDepartemen[$departemenId])) {
                $this->warn("Departemen ID {$departemenId} belum memiliki mapping.");

                $totalTanpaKonfigurasi++;
                continue;
            }

            $config = $mappingDepartemen[$departemenId];

            $namaDepartemen = $config['nama'];
            $refConfId = $config['ref_conf'];

            $nomorRaw = $nomorKonfigurasi->get($refConfId);

            $nomorList = collect(explode('|', (string) $nomorRaw))
                ->map(function ($nomor) {
                    return preg_replace('/\D/', '', trim($nomor));
                })
                ->filter(function ($nomor) {
                    return preg_match('/^62[0-9]{8,13}$/', $nomor) === 1;
                })
                ->unique()
                ->values();

            if ($nomorList->isEmpty()) {
                $this->warn("Nomor WA {$namaDepartemen} belum tersedia atau tidak valid.");

                $totalTanpaKonfigurasi++;
                continue;
            }

            $total = $dataDepartemen->count();

            $idsKKH = $dataDepartemen
                ->pluck('id')
                ->sort()
                ->values()
                ->toArray();

            $hashKKH = hash('sha256', json_encode($idsKKH));

            $listKKH = [];

            foreach ($dataDepartemen->values() as $index => $row) {
                $nomor = $index + 1;
                $nama = trim((string) ($row->nama ?? '')) ?: '-';
                $nik = $row->nik ?? '-';
                $shift = $row->shift ?? '-';

                $listKKH[] = "{$nomor}. {$nama} ({$nik}) - {$shift}";
            }

            $listText = implode("\n", $listKKH);

            $message = <<<MSG
*《PENGINGAT VERIFIKASI KKH》*

Hai, berikut data KKH Departemen *{$namaDepartemen}* yang perlu diverifikasi.

*Tanggal:* {$tanggalFormat}
*Departemen:* {$namaDepartemen}

{$listText}

*Total: {$total} KKH perlu diverifikasi.*

Mohon bantuannya untuk segera melakukan verifikasi melalui aplikasi Daily Foreman.

_Pesan ini dikirim secara otomatis. Mohon tidak membalas pesan ini._
MSG;

            $this->newLine();
            $this->info("Departemen: {$namaDepartemen}");
            $this->info("Total KKH: {$total}");

            foreach ($nomorList as $nomorWA) {
                $cacheKey = 'kkh_wa_' . $tanggal
                    . '_' . $departemenId
                    . '_' . $nomorWA;

                if ($this->option('dry-run')) {
                    $this->warn("DRY RUN: {$nomorWA}");
                    $this->line($message);

                    $totalDryRun++;
                    continue;
                }

                $lastHash = $cache->get($cacheKey);

                if ($lastHash === $hashKKH) {
                    $this->info("{$nomorWA}: Data sama, dilewati.");

                    $totalDilewati++;
                    continue;
                }

                try {
                    $result = $waController->sendMessage(
                        $nomorWA,
                        $message
                    );

                    if (
                        !is_array($result) ||
                        ($result['status'] ?? null) !== true
                    ) {
                        $totalGagal++;

                        Log::error('KKH WhatsApp gagal', [
                            'tanggal' => $tanggal,
                            'departemen' => $namaDepartemen,
                            'nomor' => $nomorWA,
                            'result' => $result
                        ]);

                        $this->error("Gagal mengirim ke {$nomorWA}");

                        continue;
                    }

                    $cache->put(
                        $cacheKey,
                        $hashKKH,
                        Carbon::now('Asia/Makassar')->endOfDay()
                    );

                    $totalTerkirim++;

                    Log::info('KKH WhatsApp terkirim', [
                        'tanggal' => $tanggal,
                        'departemen' => $namaDepartemen,
                        'nomor' => $nomorWA,
                        'total_kkh' => $total,
                        'result' => $result
                    ]);

                    $this->info("Berhasil mengirim ke {$nomorWA}");

                } catch (\Throwable $e) {
                    $totalGagal++;

                    Log::error('KKH WhatsApp error', [
                        'tanggal' => $tanggal,
                        'departemen' => $namaDepartemen,
                        'nomor' => $nomorWA,
                        'error' => $e->getMessage()
                    ]);

                    $this->error($e->getMessage());
                }
            }
        }

        $this->newLine();

        $this->table(
            ['Keterangan', 'Jumlah'],
            [
                ['Berhasil dikirim', $totalTerkirim],
                ['Data sama / dilewati', $totalDilewati],
                ['Gagal dikirim', $totalGagal],
                ['Departemen tanpa konfigurasi', $totalTanpaKonfigurasi],
                ['Simulasi dry-run', $totalDryRun]
            ]
        );

        return $totalGagal > 0 ? 1 : 0;
    }
}
