<?php

namespace App\Http\Controllers\Safety;
use App\Http\Controllers\Controller;
use App\Models\Patrol;
use App\Models\PatrolJobPending;
use App\Models\PatrolSubKegiatan;
use App\Models\PatrolTemuanTindakLanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use DateTime;
use Illuminate\Support\Facades\Storage;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Log;
use DateTimeImmutable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Log as FacadesLog;
use App\Models\RefConf;

class PatrolController extends Controller
{
    //
    public function index()
    {
        $today = now()->toDateString();
        $daily = Patrol::where('foreman_id', Auth::user()->id)
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

            $subKegiatan = PatrolSubKegiatan::where('patrol_id', $daily->id)
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
                    'existing_foto_kegiatan_url' => $item->foto_kegiatan ? asset($item->foto_kegiatan) : null,
                ];
            })
            ->values();


            $temuanTindakLanjut = PatrolTemuanTindakLanjut::where('patrol_id', $daily->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'uuid' => $item->uuid,
                    'foto_temuan' => $item->foto_temuan,
                    'foto_temuan_url' => $item->foto_temuan ? asset($item->foto_temuan) : null,
                    'deskripsi_temuan' => $item->deskripsi_temuan,
                    'tindak_lanjut' => $item->tindak_lanjut,
                    'status' => $item->status ? $item->status : 'Close',
                ];
            })
            ->values();

            $jobPending = PatrolJobPending::where('patrol_id', $daily->id)
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
                    'existing_foto_pending_url' => $item->foto_pending ? asset($item->foto_pending) : null,
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

        return view('patrol.index', compact('daily', 'data', 'subKegiatan', 'jobPending', 'temuanTindakLanjut'));
    }

    public function show(Request $request)
    {
        session(['requestTimeLaporanKerjaPatrol' => $request->all()]);

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


        $daily = DB::table('se_patrol_daily as patrol')
        ->leftJoin('users as us', 'patrol.foreman_id', '=', 'us.id')
        ->leftJoin('ref_shift as sh', 'patrol.shift', '=', 'sh.id')
        ->leftJoin('users as us3', 'patrol.nik_petugas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'patrol.nik_penerima', '=', 'us4.nik')
        ->leftJoin('users as us5', 'patrol.nik_superintendent', '=', 'us5.nik')
        ->select(
            'patrol.id',
            'patrol.uuid',
            'patrol.tanggal',
            'sh.keterangan as shift',
            'us.name as pic',
            'us.nik as nik_pic',
            'patrol.nik_petugas',
            'us3.name as nama_petugas',
            'patrol.nik_penerima',
            'us4.name as nama_penerima',
            'patrol.nik_superintendent',
            'us5.name as nama_superintendent',
            'patrol.is_draft',
            'patrol.verified_penerima',
            'patrol.verified_superintendent',
            'patrol.created_at',
            'patrol.updated_at',
            'patrol.finished_at',
        )
        ->whereBetween('patrol.tanggal', [$startTimeFormatted, $endTimeFormatted])
        ->where('patrol.statusenabled', true);


        $daily = $daily->where(function($query) {
            if (!in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT'])) {
                $query->where('patrol.nik_petugas', Auth::user()->nik)
                  ->orWhere('patrol.nik_penerima', Auth::user()->nik)
                  ->orWhere('patrol.nik_superintendent', Auth::user()->nik);
            }
        });


        $daily = $daily->get();

        return view('patrol.daftar.index', compact('daily'));
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
                🔔 *Reminder Verifikasi Laporan Harian Safety Patrol*

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

            $dailyReport = !empty($uuid) ? Patrol::where('uuid', $uuid)->first() : null;

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

            $dailyReport = Patrol::updateOrCreate(['uuid' => $uuid], $data);

            if (!empty($request->subKegiatan)) {
                $subKegiatan = json_decode($request->subKegiatan, true);

                foreach ($subKegiatan as $value) {

                    $fotoKegiatanPath = $value['existing_foto_kegiatan'] ?? null;

                    if ($request->hasFile('kegiatan_files.' . $value['uuid'])) {
                        $fileKegiatan = $request->file('kegiatan_files.' . $value['uuid']);
                        $destinationPath = public_path('foto_kegiatan');
                        $fileNameKegiatan = time() . '_' . $value['uuid'] . '_' . $fileKegiatan->getClientOriginalName();
                        $fileKegiatan->move($destinationPath, $fileNameKegiatan);
                        $fotoKegiatanPath = url('foto_kegiatan/' . $fileNameKegiatan);
                    }

                    PatrolSubKegiatan::updateOrCreate(
                        [
                            'uuid' => $value['uuid'],
                        ],
                        [
                            'uuid' => $value['uuid'] ?? Uuid::uuid4()->toString(),
                            'patrol_uuid' => $dailyReport->uuid,
                            'patrol_id' => $dailyReport->id,
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
                        $fileTemuan = $request->file('temuan_files.' . $value['uuid']);
                        $destinationPath = public_path('foto_temuan');
                        $fileNameTemuan = time() . '_temuan_' . $value['uuid'] . '_' . $fileTemuan->getClientOriginalName();

                        $fileTemuan->move($destinationPath, $fileNameTemuan);

                        $fotoTemuanPath = url('foto_temuan/' . $fileNameTemuan);
                    }

                    PatrolTemuanTindakLanjut::updateOrCreate(
                        [
                            'uuid' => $value['uuid'],
                        ],
                        [
                            'uuid' => $value['uuid'] ?? Uuid::uuid4()->toString(),
                            'patrol_uuid' => $dailyReport->uuid,
                            'patrol_id' => $dailyReport->id,
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
                        $filePending = $request->file('job_pending_files.' . $value['uuid']);
                        $destinationPath = public_path('foto_pending');
                        $fileNamePending = time() . '_pending_' . $value['uuid'] . '_' . $filePending->getClientOriginalName();

                        $filePending->move($destinationPath, $fileNamePending);

                        $fotoPendingPath = url('foto_pending/' . $fileNamePending);
                    }
                    PatrolJobPending::updateOrCreate(
                        [
                            'uuid' => $value['uuid'],
                        ],
                        [
                            'uuid' => $value['uuid'] ?? Uuid::uuid4()->toString(),
                            'patrol_uuid' => $dailyReport->uuid,
                            'patrol_id' => $dailyReport->id,
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
                \Illuminate\Support\Facades\Log::error('ERROR SAVE DRAFT PATROL', [
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
            $data = PatrolSubKegiatan::findOrFail($id);
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
            $data = PatrolTemuanTindakLanjut::findOrFail($id);
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
            $data = PatrolJobPending::findOrFail($id);
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
        $daily = Patrol::where('uuid', $uuid)->first();

        try {

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'Laporan Kerja Patrol',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Hapus laporan kerja patrol dengan PIC: '. $daily->nama_petugas . ', tanggal pembuatan: '. $daily->tanggal .
                ', shift: '. $daily->shift,
            ]);

            Patrol::where('uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            PatrolSubKegiatan::where('patrol_uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            PatrolTemuanTindakLanjut::where('patrol_uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            PatrolJobPending::where('patrol_uuid', $uuid)->update([
                'statusenabled' => false,
                'is_draft' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('patrol.show')->with('success', 'Laporan kerja Patrol berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('patrol.show')->with('info', 'Laporan kerja Patrol gagal dihapus', $th->getMessage());
        }
    }

    public function preview($uuid)
    {
        $daily = DB::table('se_patrol_daily as patrol')
        ->leftJoin('users as us', 'patrol.foreman_id', '=', 'us.id')
        ->leftJoin('ref_shift as sh', 'patrol.shift', '=', 'sh.id')
        ->leftJoin('users as us3', 'patrol.nik_petugas', '=', 'us3.nik')
        ->leftJoin('users as us4', 'patrol.nik_penerima', '=', 'us4.nik')
        ->leftJoin('users as us5', 'patrol.nik_superintendent', '=', 'us5.nik')
        ->select(
            'patrol.id',
            'patrol.uuid',
            'patrol.tanggal',
            'us.role',
            'sh.keterangan as shift',
            'us.name as pic',
            'us.nik as nik_pic',
            'patrol.nik_petugas',
            'us3.name as nama_petugas',
            'patrol.nik_penerima',
            'us4.name as nama_penerima',
            'patrol.nik_superintendent',
            'us5.name as nama_superintendent',
            'patrol.is_draft',
            'patrol.verified_petugas',
            'patrol.verified_penerima',
            'patrol.verified_superintendent',
            'patrol.created_at',
            'patrol.updated_at',
            'patrol.finished_at',
        )
        ->where('patrol.statusenabled', true)
        ->where('patrol.uuid', $uuid)->first();

        if($daily == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $daily->verified_petugas = $daily->verified_petugas != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_petugas) : null;
            $daily->verified_penerima = $daily->verified_penerima != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_penerima) : null;
            $daily->verified_superintendent = $daily->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_superintendent) : null;
        }


        $sub = DB::table('se_patrol_sub_kegiatan as sub')
        ->leftJoin('se_patrol_daily as patrol', 'sub.patrol_id', '=', 'patrol.id')
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
        ->where('sub.patrol_uuid', $uuid)->get();

        $temuan = DB::table('se_patrol_temuan_tindak_lanjut as temuan')
        ->leftJoin('se_patrol_daily as patrol', 'temuan.patrol_id', '=', 'patrol.id')
        ->select(
            'temuan.foto_temuan',
            'temuan.deskripsi_temuan',
            'temuan.tindak_lanjut',
            'temuan.status',
        )
        ->where('temuan.statusenabled', true)
        ->where('temuan.patrol_uuid', $uuid)->get();

        $pending = DB::table('se_patrol_job_pending as job')
        ->leftJoin('se_patrol_daily as patrol', 'job.patrol_id', '=', 'patrol.id')
        ->select(
            'job.kegiatan_pending',
            'job.alasan_belum_selesai',
            'job.prioritas',
            'job.instruksi_shift_berikutnya',
            'job.foto_pending',
        )
        ->where('job.statusenabled', true)
        ->where('job.patrol_uuid', $uuid)->get();

        $data = [
            'daily' => $daily,
            'sub' => $sub,
            'temuan' => $temuan,
            'pending' => $pending,
        ];


        return view('patrol.preview', compact(['data']));
    }


    public function verifiedPetugas($uuid)
    {
        $klkh =  Patrol::where('uuid', $uuid)->first();

        try {
            Patrol::where('id', $klkh->id)->update([
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
        $klkh =  Patrol::where('uuid', $uuid)->first();

        try {
            Patrol::where('id', $klkh->id)->update([
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
        $klkh =  Patrol::where('uuid', $uuid)->first();

        try {
            Patrol::where('id', $klkh->id)->update([
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
