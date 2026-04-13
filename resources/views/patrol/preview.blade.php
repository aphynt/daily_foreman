@include('layout.head', ['title' => 'Laporan Kegiatan Harian & Job Pending Patrol'])
@include('layout.sidebar')
@include('layout.header')

<style>
    .table-responsive table {
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        table {
            font-size: 11px;
        }

        table th,
        table td {
            padding: 6px;
        }
        .action-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .action-btn {
            width: 100%;
            padding: 12px;
            font-size: 15px;
        }

        .verifikasi-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .verifikasi-btn {
            width: 100%;
            text-align: center;
            font-size: 15px;
            padding: 12px;
        }
    }

    @media (max-width: 576px) {
        .col-12 img {
            max-width: 150px;
        }
    }
    .alat-support-table {
        min-width: 1300px;
        table-layout: fixed;
    }

    .alat-support-table th,
    .alat-support-table td {
        /* text-align: center; */
        vertical-align: middle;
        padding: 10px;
        font-size: 11px;

        /* penting untuk wrap */
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .alat-support-table th:nth-child(1),
    .alat-support-table td:nth-child(1) {
        width: 10px;
    }

    .alat-support-table th:nth-child(2),
    .alat-support-table td:nth-child(2) {
        width: 100px;
    }

    .alat-support-table th:nth-child(3),
    .alat-support-table td:nth-child(3) {
        width: 120px;
    }

    .alat-support-table th:nth-child(4),
    .alat-support-table td:nth-child(4) {
        width: 90px;
    }

    .alat-support-table th:nth-child(5),
    .alat-support-table td:nth-child(5) {
        width: 80px;
    }

    .alat-support-table th:nth-child(6),
    .alat-support-table td:nth-child(6) {
        width: 60px;
    }

    .alat-support-table th:nth-child(7),
    .alat-support-table td:nth-child(7) {
        width: 80px;
    }

    table {
        -fs-table-paginate: paginate;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    .alat-support-table thead th {
        background-color: #1e3a8a !important; /* biru gelap */
        color: #ffffff !important; /* putih */
    }

    .ttd-table thead th {
        background-color: #1e3a8a !important; /* biru gelap */
        color: #ffffff !important; /* putih */
    }

    table tr td,
    table tr th {
        font-size: small;
    }

    .info-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2px;
    }

    .info-table td {
        padding: 5px;
    }

    .catatan-table td {
        border-bottom: 1px solid #000;
        padding: 6px 4px;
        font-size: 12px;
    }

    .tanda-tangan-table img {
        max-width: 70px;
    }

    .verifikasi-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: flex-end;
    }

    .verifikasi-btn {
        display: inline-block;
        background-color: #198754;
        color: #fff;
        font-size: 14px;
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        white-space: nowrap;
    }

    .verifikasi-btn:hover {
        background-color: #157347;
        color: #fff;
    }

    .action-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: flex-end;
        margin-top: 12px;
    }

    .action-btn {
        display: inline-block;
        padding: 8px 14px;
        font-size: 14px;
        border-radius: 6px;
        text-decoration: none;
        text-align: center;
        white-space: nowrap;
    }

    .action-primary {
        background-color: #0d6efd;
        color: #fff;
    }

    .action-primary:hover {
        background-color: #0b5ed7;
        color: #fff;
    }

    .action-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .action-secondary:hover {
        background-color: #5c636a;
        color: #fff;
    }

    .action-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .action-danger:hover {
        background-color: #c01a2b;
        color: #fff;
    }

    .action-outline {
        border: 1px solid #0d6efd;
        color: #0d6efd;
        background-color: #fff;
    }

    .action-outline:hover {
        background-color: #0d6efd;
        color: #fff;
    }

</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <div class="row align-items-center g-2 text-center text-sm-start">
                                    <div class="col-12 col-sm-6">
                                        <img
                                            src="{{ asset('dashboard/assets') }}/images/logo-full.png"
                                            class="img-fluid mb-2"
                                            alt="Logo"
                                            style="max-width: 200px;">
                                    </div>
                                    <div class="col-12 col-sm-6 text-sm-end">
                                        <h6 class="mb-0">FM-SE-72/00/11/03/26</h6>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-center">
                                <u>LAPORAN KEGIATAN HARIAN & JOB PENDING</u>
                                <br>
                                <i>SECTION SAFETY PATROL</i>
                            </h3>

                            <div class="table-responsive">
                                <table class="info-table">
                                    <tr class="no-border">
                                    <td class="no-border">Tanggal</td>
                                    <td class="no-border">: {{ date('d-m-Y', strtotime($data['daily']->tanggal)) }}</td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>

                                    <td class="no-border">Shift</td>
                                    <td class="no-border">:</td>
                                    <td class="no-border" colspan="10">{{ $data['daily']->shift }}</td>
                                </tr>
                                <tr>
                                    <td class="no-border">Nama Petugas</td>
                                    <td class="no-border">: {{ $data['daily']->nama_petugas }}</td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>
                                    <td class="no-border"></td>

                                    <td class="no-border">Jabatan</td>
                                    <td class="no-border">:</td>
                                    <td class="no-border" colspan="9">
                                        {{ $data['daily']->role }} (Safety Patrol)
                                    </td>
                                </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm alat-support-table">
                                     <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kegiatan</th>
                                            <th>Sub Kegiatan / Detail</th>
                                            <th>Waktu Pelaksanaan</th>
                                            <th>Lokasi</th>
                                            <th>Status (✓/✗/–)</th>
                                            <th>Keterangan/Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['sub'] as $sub)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sub->kategori }}</td>
                                            <td>{{ $sub->sub }}</td>
                                            <td>{{ $sub->frekuensi }}</td>
                                            <td>{{ $sub->lokasi }}</td>
                                            <td>{{ $sub->status }}</td>
                                            <td style="white-space: normal;">
                                                @if ($sub->foto_kegiatan)
                                                    <div style="margin-bottom: 5px;">
                                                        <img src="{{ asset($sub->foto_kegiatan) }}"
                                                            alt="foto"
                                                            style="max-width: 100px; height: auto; display: block; margin: auto;">
                                                    </div>
                                                @endif

                                                @if ($sub->keterangan)
                                                    <div style="word-break: break-word;">
                                                        {{ $sub->keterangan }}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h6>Temuan & Tindak Lanjut:</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm alat-support-table">
                                     <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Temuan & Deskripsi </th>
                                            <th>Tindak Lanjut</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['temuan'] as $temuan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="white-space: normal;">
                                                @if ($temuan->foto_temuan)
                                                    <div style="margin-bottom: 5px;">
                                                        <img src="{{ asset($temuan->foto_temuan) }}"
                                                            alt="foto"
                                                            style="max-width: 100px; height: auto; display: block; margin: auto;">
                                                    </div>
                                                @endif

                                                @if ($temuan->deskripsi_temuan)
                                                    <div style="word-break: break-word;">
                                                        {{ $temuan->deskripsi_temuan }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $temuan->tindak_lanjut }}</td>
                                            <td>{{ $temuan->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h6>Job Pending untuk Shift Berikutnya: <i>(Pekerjaan yang belum selesai dan perlu dilanjutkan)</i></h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm alat-support-table">
                                     <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pekerjaan / Kegiatan Pending</th>
                                            <th>Alasan Belum Selesai</th>
                                            <th>Prioritas</th>
                                            <th>Instruksi untuk Shift Berikutnya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['pending'] as $pending)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="white-space: normal;">
                                                @if ($pending->foto_pending)
                                                    <div style="margin-bottom: 5px;">
                                                        <img src="{{ asset($pending->foto_pending) }}"
                                                            alt="foto"
                                                            style="max-width: 100px; height: auto; display: block; margin: auto;">
                                                    </div>
                                                @endif

                                                @if ($pending->kegiatan_pending)
                                                    <div style="word-break: break-word;">
                                                        {{ $pending->kegiatan_pending }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $pending->alasan_belum_selesai }}</td>
                                            <td>{{ $pending->prioritas }}</td>
                                            <td>{{ $pending->instruksi_shift_berikutnya }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm ttd-table">
                                     <thead>
                                        <tr>
                                            <th>Dibuat dan Petugas saat ini </th>
                                            <th>Diterima dan Petugas Selanjutnya</th>
                                            <th>Diketahui Oleh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {!! $data['daily']->verified_petugas !!}
                                                <div>{{ $data['daily']->nama_petugas }}</div>
                                            </td>
                                            <td>
                                                {!! $data['daily']->verified_penerima !!}
                                                <div>{{ $data['daily']->nama_penerima }}</div>
                                            </td>
                                            <td>
                                                {!! $data['daily']->verified_superintendent !!}
                                                <div>{{ $data['daily']->nama_superintendent }}</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-body p-3">
                            <div class="verifikasi-actions">

                                @if ((Auth::user()->role == 'FOREMAN' || Auth::user()->role == 'SUPERVISOR') && $data['daily']->verified_penerima == null)
                                    <a href="{{ route('patrol.verified.penerima', $data['daily']->uuid) }}" class="verifikasi-btn">
                                        Verifikasi Penerima
                                    </a>
                                @endif

                                @if (Auth::user()->role == 'SUPERINTENDENT' && $data['daily']->verified_superintendent == null)
                                    <a href="{{ route('patrol.verified.superintendent', $data['daily']->uuid) }}" class="verifikasi-btn">
                                        Verifikasi Superintendent
                                    </a>
                                @endif

                            </div>

                        </div>
                        <div class="action-actions">
                            <a href="#" onclick="window.history.back()" class="action-btn action-secondary">
                                Kembali
                            </a>
                            @if (Auth::user()->role == 'ADMIN' || Auth::user()->id == $data['daily']->pic)
                            <a href="#" class="action-btn action-danger" data-bs-toggle="modal" data-bs-target="#deleteLaporanKerjaPatrol{{ $data['daily']->uuid }}">
                                Hapus
                            </a>
                            <div class="modal fade" id="deleteLaporanKerjaPatrol{{ $data['daily']->uuid }}" aria-hidden="true" aria-labelledby="..." tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center p-5">
                                            <lord-icon
                                                src="/tdrtiskw.json"
                                                trigger="loop"
                                                colors="primary:#f7b84b,secondary:#405189"
                                                style="width:130px;height:130px">
                                            </lord-icon>
                                            <div class="mt-4 pt-4">
                                                <h4>Yakin menghapus Laporan Kerja ini?</h4>
                                                <p class="text-muted"> Data yang dihapus tidak ditampilkan kembali</p>
                                                <!-- Toogle to second dialog -->
                                                <a href="{{ route('patrol.delete', $data['daily']->uuid) }}"><span class="badge bg-danger" style="font-size:14px">Hapus</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif


                            <a href="{{ route('patrol.pdf', $data['daily']->uuid) }}"
                            target="_blank"
                            class="action-btn action-primary">
                                Download PDF
                            </a>

                            <a href="{{ route('patrol.download', $data['daily']->uuid) }}"
                            target="_blank"
                            class="action-btn action-outline">
                                Print
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
