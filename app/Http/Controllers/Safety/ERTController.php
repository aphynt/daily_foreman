<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WhatsAppController;
use App\Models\ERT;
use App\Models\ERTJobPending;
use App\Models\ERTSubKegiatan;
use App\Models\ERTTemuanTindakLanjut;
use App\Models\Log;
use App\Models\RefConf;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use DateTime;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ERTController extends Controller
{
    //
    public function index()
    {
        $today = now()->toDateString();
        $daily = ERT::where('foreman_id', Auth::user()->id)
            ->where(function ($query) use ($today) {
                $query->where('is_draft', true)
                    ->orWhere(function ($q) use ($today) {
                        $q->where('is_draft', false)
                          ->whereDate('created_at', '!=', $today);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->first();

        if ($daily == null) {
            $daily = null;
        } else {
            if ($daily['is_draft'] == false ) {
                $daily = null;
            }
        }

        $subKegiatan = [];
        $temuanTindakLanjut = [];
        $jobPending = [];

        if ($daily) {
            $daily['nik_supervisor'] = $daily['nik_supervisor'] . '|' . $daily['nama_supervisor'];

            if (!empty($daily['tanggal'])) {
                $tanggalDasar = new DateTimeImmutable($daily['tanggal']);
                $daily['tanggal'] = $tanggalDasar ? $tanggalDasar->format('m/d/Y') : $daily['tanggal'];
            }

            $subKegiatan = ERTSubKegiatan::where('ert_id', $daily->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'uuid' => $item->uuid,
                    'sub' => $item->sub,
                    'kategori' => $item->kategori,
                    'frekuensi' => $item->frekuensi,
                    'lokasi' => $item->lokasi,
                    'status' => $item->status,
                    'keterangan' => $item->keterangan,
                    'existing_foto_kegiatan' => $item->foto_kegiatan,
                    'existing_foto_kegiatan_url' => $item->foto_kegiatan ? asset('storage/' . $item->foto_kegiatan) : null,
                ];
            })
            ->values();


            $temuanTindakLanjut = ERTTemuanTindakLanjut::where('ert_id', $daily->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'uuid' => $item->uuid,
                    'foto_temuan' => $item->foto_temuan,
                    'foto_temuan_url' => $item->foto_temuan ? asset('storage/' . $item->foto_temuan) : null,
                    'deskripsi_temuan' => $item->deskripsi_temuan,
                    'tindak_lanjut' => $item->tindak_lanjut,
                    'status' => $item->status ? $item->status : 'Close',
                ];
            })
            ->values();

            $jobPending = ERTJobPending::where('ert_id', $daily->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'uuid' => $item->uuid,
                    'kegiatan_pending' => $item->kegiatan_pending,
                    'alasan_belum_selesai' => $item->alasan_belum_selesai,
                    'prioritas' => $item->prioritas,
                    'instruksi_shift_berikutnya' => $item->instruksi_shift_berikutnya,
                    'existing_foto_pending' => $item->foto_pending,
                    'existing_foto_pending_url' => $item->foto_pending ? asset('storage/' . $item->foto_pending) : null,
                ];
            })
            ->values();
        }

        $roleSuperintendent = getConfigArrayById(8) ?? [];

        $superintendent = User::select(
                'nik as NRP',
                'name as PERSONALNAME',
                'role as JABATAN'
            )
            ->whereIn('role_id', $roleSuperintendent)
            ->where('statusenabled', true)
            ->get();
        $shift = Shift::where('statusenabled', true)->get();
        $data = [
            'superintendent' => $superintendent,
            'shift' => $shift,

        ];

        return view('ert.index', compact('daily', 'data', 'subKegiatan', 'jobPending', 'temuanTindakLanjut'));
    }

    public function show(Request $request)
    {
        session(['requestTimeLaporanKerjaERT' => $request->all()]);

        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }


        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');


        $daily = DB::table('se_ert_daily as ert')
        ->leftJoin('users as us', 'ert.foreman_id', '=', 'us.id')
        ->leftJoin('ref_shift as sh', 'ert.shift', '=', 'sh.id')
        ->leftJoin('users as us3', 'ert.nik_petugas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ert.nik_penerima', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ert.nik_superintendent', '=', 'us5.nik')
        ->select(
            'ert.id',
            'ert.uuid',
            'ert.tanggal',
            'sh.keterangan as shift',
            'us.name as pic',
            'us.nik as nik_pic',
            'ert.nik_petugas',
            'us3.name as nama_petugas',
            'ert.nik_penerima',
            'us4.name as nama_penerima',
            'ert.nik_superintendent',
            'us5.name as nama_superintendent',
            'ert.is_draft',
            'ert.verified_penerima',
            'ert.verified_superintendent',
            'ert.created_at',
            'ert.updated_at',
            'ert.finished_at',
        )
        ->whereBetween('ert.tanggal', [$startTimeFormatted, $endTimeFormatted])
        ->where('ert.statusenabled', true);


        $daily = $daily->where(function($query) {
            if (!in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT'])) {
                $query->where('ert.nik_petugas', Auth::user()->nik)
                  ->orWhere('ert.nik_penerima', Auth::user()->nik)
                  ->orWhere('ert.nik_superintendent', Auth::user()->nik);
            }
        });


        $daily = $daily->get();

        return view('ert.daftar.index', compact('daily'));
    }

    public function saveAsDraft(Request $request)
    {

        DB::beginTransaction();

        try {
            $typeDraft = true;
            $finished = null;
            if($request->actionType == 'finish'){
                $typeDraft = false;
                $finished = Carbon::now();

                $picName = Auth::user()->name;
                $reportDate = $finished->format('d-m-Y H:i');
                $shift = Shift::where('id', $request->shift_id)->value('keterangan');

                // Kirim WhatsApp
                $waController = new WhatsAppController();
                $number = RefConf::where('id', 11)->value('value');

                $message = <<<MSG
                🔔 *Reminder Verifikasi Laporan Harian ERT*

                PIC: $picName,

                Terdapat laporan yang telah berhasil disubmit pada tanggal: $reportDate
                Shift: $shift

                Mohon bantuannya untuk melakukan pengecekan dan verifikasi laporan tersebut.

                Terima kasih atas perhatian dan kerja samanya.
                _Pesan ini dikirim secara otomatis. Mohon tidak membalas pesan ini._
                MSG;

                $waResult = $waController->sendMessage($number, $message);
                FacadesLog::info('WA Send Result: ', $waResult);
            }
            $uuid = $request->uuid;

            $dailyReport = !empty($uuid) ? ERT::where('uuid', $uuid)->first() : null;

                $uuid = $dailyReport ? $dailyReport->uuid : Uuid::uuid4()->toString();


            $data = [
                'uuid' => $uuid ?? Uuid::uuid4()->toString(),
                'foreman_id' => Auth::id(),
                'statusenabled' => true,
                'tanggal' => $request->filled('date')
                    ? now()->parse($request->date)->format('Y-m-d')
                    : null,
                'shift' => $request->shift_id,
                'nik_petugas' => Auth::user()->nik,
                'nama_petugas' => Auth::user()->name,
                'verified_petugas' => Auth::user()->nik,
                'datetime_verified_petugas' => Carbon::now(),
                'is_draft' => $typeDraft,
                'finished_at' => $finished,
            ];

            $dailyReport = ERT::updateOrCreate(['uuid' => $uuid], $data);

            if (!empty($request->subKegiatan)) {
                $subKegiatan = json_decode($request->subKegiatan, true);

                foreach ($subKegiatan as $value) {
                    $fotoKegiatanPath = $value['existing_foto_kegiatan'] ?? null;

                    if ($request->hasFile('kegiatan_files.' . $value['uuid'])) {
                        $file = $request->file('kegiatan_files.' . $value['uuid']);
                        $fotoKegiatanPath = $file->store('foto_kegiatan', 'public');
                    }

                    ERTSubKegiatan::updateOrCreate(
                        [
                            'uuid' => $value['uuid'],
                        ],
                        [
                            'uuid' => $value['uuid'] ?? Uuid::uuid4()->toString(),
                            'ert_uuid' => $dailyReport->uuid,
                            'ert_id' => $dailyReport->id,
                            'statusenabled' => true,
                            'foto_kegiatan' => $fotoKegiatanPath,
                            'sub' => $value['sub'] ?? null,
                            'kategori' => $value['kategori'] ?? null,
                            'frekuensi' => $value['frekuensi'] ?? null,
                            'lokasi' => $value['lokasi'] ?? null,
                            'status' => $value['status'] ?? null,
                            'keterangan' => $value['keterangan'] ?? null,
                            'is_draft' => $typeDraft,
                        ]
                    );
                }
            }

            if (!empty($request->temuanTindakLanjut)) {
                $temuanTindakLanjut = json_decode($request->temuanTindakLanjut, true);

                foreach ($temuanTindakLanjut as $value) {
                    $fotoTemuanPath = $value['existing_foto_temuan'] ?? null;

                    if ($request->hasFile('temuan_files.' . $value['uuid'])) {
                        $file = $request->file('temuan_files.' . $value['uuid']);
                        $fotoTemuanPath = $file->store('foto_temuan', 'public');
                    }

                    ERTTemuanTindakLanjut::updateOrCreate(
                        [
                            'uuid' => $value['uuid'],
                        ],
                        [
                            'uuid' => $value['uuid'] ?? Uuid::uuid4()->toString(),
                            'ert_uuid' => $dailyReport->uuid,
                            'ert_id' => $dailyReport->id,
                            'statusenabled' => true,
                            'foto_temuan' => $fotoTemuanPath,
                            'deskripsi_temuan' => $value['deskripsi_temuan'] ?? null,
                            'tindak_lanjut' => $value['tindak_lanjut'] ?? null,
                            'status' => $value['status'] ?? null,
                            'is_draft' => $typeDraft,
                        ]
                    );
                }
            }

            if (!empty($request->jobPending)) {
                $jobPending = json_decode($request->jobPending, true);

                foreach ($jobPending as $value) {
                    $fotoPendingPath = $value['existing_foto_pending'] ?? null;

                    if ($request->hasFile('job_pending_files.' . $value['uuid'])) {
                        $file = $request->file('job_pending_files.' . $value['uuid']);
                        $fotoPendingPath = $file->store('foto_pending', 'public');
                    }
                    ERTJobPending::updateOrCreate(
                        [
                            'uuid' => $value['uuid'],
                        ],
                        [
                            'uuid' => $value['uuid'] ?? Uuid::uuid4()->toString(),
                            'ert_uuid' => $dailyReport->uuid,
                            'ert_id' => $dailyReport->id,
                            'statusenabled' => true,
                            'kegiatan_pending' => $value['kegiatan_pending'] ?? null,
                            'alasan_belum_selesai' => $value['alasan_belum_selesai'] ?? null,
                            'prioritas' => $value['prioritas'] ?? null,
                            'instruksi_shift_berikutnya' => $value['instruksi_shift_berikutnya'] ?? null,
                            'is_draft' => $typeDraft,
                            'foto_pending' => $fotoPendingPath,
                        ]
                    );
                }
            }

            $dataSuccess = [
                'dailyReport' => $dailyReport,
                'subKegiatan' => $request->subKegiatan,
                'temuanTindakLanjut' => $request->temuanTindakLanjut,
                'jobPending' => $request->jobPending,
            ];

            DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Draft saved successfully!',
                    'uuid' => $dailyReport->uuid,
                    'data' => $dataSuccess,
                ]);
        } catch (\Throwable $th) {

            DB::rollBack();
                \Illuminate\Support\Facades\Log::error('ERROR SAVE DRAFT ERT', [
                    'message'   => $th->getMessage(),
                    'file'      => $th->getFile(),
                    'line'      => $th->getLine(),
                    'trace'     => $th->getTraceAsString(),
                    'request'   => $request->all(),
                    'user_id'   => Auth::user()->id,
                    'url'       => $request->fullUrl(),
                    'ip'        => $request->ip(),
                ]);

            return response()->json(['error' => 'Failed to save draft: ' . $th->getMessage()], 500);
        }
    }

    public function destroySubKegiatan($id)
    {
        try {
            $data = ERTSubKegiatan::findOrFail($id);
            if ($data->foto_pending && Storage::disk('public')->exists($data->foto_pending)) {
                Storage::disk('public')->delete($data->foto_pending);
            }

            $data->delete();

            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroyTemuanTindakLanjut($id)
    {
        try {
            $data = ERTTemuanTindakLanjut::findOrFail($id);
            if ($data->foto_pending && Storage::disk('public')->exists($data->foto_pending)) {
                Storage::disk('public')->delete($data->foto_pending);
            }

            $data->delete();

            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroyJobPending($id)
    {
        try {
            $data = ERTJobPending::findOrFail($id);
            if ($data->foto_pending && Storage::disk('public')->exists($data->foto_pending)) {
                Storage::disk('public')->delete($data->foto_pending);
            }

            $data->delete();
            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($uuid)
    {
        $daily = ERT::where('uuid', $uuid)->first();

        try {

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'Laporan Kerja ERT',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Hapus laporan kerja ERT dengan PIC: '. $daily->nama_petugas . ', tanggal pembuatan: '. $daily->tanggal .
                ', shift: '. $daily->shift,
            ]);

            ERT::where('uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            ERTSubKegiatan::where('ert_uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            ERTTemuanTindakLanjut::where('ert_uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            ERTJobPending::where('ert_uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('ert.show')->with('success', 'Laporan kerja ERT berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('ert.show')->with('info', 'Laporan kerja ERT gagal dihapus', $th->getMessage());
        }
    }

    public function preview($uuid)
    {
        $daily = DB::table('se_ert_daily as ert')
        ->leftJoin('users as us', 'ert.foreman_id', '=', 'us.id')
        ->leftJoin('ref_shift as sh', 'ert.shift', '=', 'sh.id')
        ->leftJoin('users as us3', 'ert.nik_petugas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'ert.nik_penerima', '=', 'us4.nik')
        ->leftJoin('users as us5', 'ert.nik_superintendent', '=', 'us5.nik')
        ->select(
            'ert.id',
            'ert.uuid',
            'ert.tanggal',
            'us.role',
            'sh.keterangan as shift',
            'us.name as pic',
            'us.nik as nik_pic',
            'ert.nik_petugas',
            'us3.name as nama_petugas',
            'ert.nik_penerima',
            'us4.name as nama_penerima',
            'ert.nik_superintendent',
            'us5.name as nama_superintendent',
            'ert.is_draft',
            'ert.verified_petugas',
            'ert.verified_penerima',
            'ert.verified_superintendent',
            'ert.created_at',
            'ert.updated_at',
            'ert.finished_at',
        )
        ->where('ert.statusenabled', true)
        ->where('ert.uuid', $uuid)->first();

        if($daily == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $daily->verified_petugas = $daily->verified_petugas != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_petugas) : null;
            $daily->verified_penerima = $daily->verified_penerima != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_penerima) : null;
            $daily->verified_superintendent = $daily->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_superintendent) : null;
        }


        $sub = DB::table('se_ert_sub_kegiatan as sub')
        ->leftJoin('se_ert_daily as ert', 'sub.ert_id', '=', 'ert.id')
        ->select(
            'sub.sub',
            'sub.kategori',
            'sub.frekuensi',
            'sub.lokasi',
            'sub.status',
            'sub.keterangan',
            'sub.foto_kegiatan',
        )
        ->where('sub.statusenabled', true)
        ->where('sub.ert_uuid', $uuid)->get();

        $temuan = DB::table('se_ert_temuan_tindak_lanjut as temuan')
        ->leftJoin('se_ert_daily as ert', 'temuan.ert_id', '=', 'ert.id')
        ->select(
            'temuan.foto_temuan',
            'temuan.deskripsi_temuan',
            'temuan.tindak_lanjut',
            'temuan.status',
        )
        ->where('temuan.statusenabled', true)
        ->where('temuan.ert_uuid', $uuid)->get();

        $pending = DB::table('se_ert_job_pending as job')
        ->leftJoin('se_ert_daily as ert', 'job.ert_id', '=', 'ert.id')
        ->select(
            'job.kegiatan_pending',
            'job.alasan_belum_selesai',
            'job.prioritas',
            'job.instruksi_shift_berikutnya',
            'job.foto_pending',
        )
        ->where('job.statusenabled', true)
        ->where('job.ert_uuid', $uuid)->get();

        $data = [
            'daily' => $daily,
            'sub' => $sub,
            'temuan' => $temuan,
            'pending' => $pending,
        ];


        return view('ert.preview', compact(['data']));
    }


    public function verifiedPetugas($uuid)
    {
        $klkh =  ERT::where('uuid', $uuid)->first();

        try {
            ERT::where('id', $klkh->id)->update([
                'nik_petugas'               => (string)Auth::user()->nik,
                'nama_petugas'              => (string)Auth::user()->name,
                'verified_petugas'          => (string)Auth::user()->nik,
                'datetime_verified_petugas' => Carbon::now(),
                'updated_by'                => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Form/laporan berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Form/laporan gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedPenerima($uuid)
    {
        $klkh =  ERT::where('uuid', $uuid)->first();

        try {
            ERT::where('id', $klkh->id)->update([
                'nik_penerima'                  => (string)Auth::user()->nik,
                'nama_penerima'                 => (string)Auth::user()->name,
                'verified_penerima'             => (string)Auth::user()->nik,
                'datetime_verified_penerima'    => Carbon::now(),
                'updated_by'                    => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Form/laporan berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Form/laporan gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedSuperintendent($uuid)
    {
        $klkh =  ERT::where('uuid', $uuid)->first();

        try {
            ERT::where('id', $klkh->id)->update([
                'nik_superintendent'                => (string)Auth::user()->nik,
                'nama_superintendent'               => (string)Auth::user()->name,
                'verified_superintendent'           => (string)Auth::user()->nik,
                'datetime_verified_superintendent'  => Carbon::now(),
                'updated_by'                        => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Form/laporan berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Form/laporan gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

}
