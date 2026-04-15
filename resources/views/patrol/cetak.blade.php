<!doctype html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FM-SE-72 - Laporan Kegiatan Harian & Job Pending Safety Patrol</title>
   <style>
    @page {
        size: A4 portrait;
        margin: 12mm 10mm 12mm 10mm;
    }

    * {
        box-sizing: border-box;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        color: #222;
        font-size: 11px;
        line-height: 1.35;
        background: #fff;
    }

    .page {
        width: 100%;
        page-break-after: always;
        padding-right: 2px;
    }

    .page:last-child {
        page-break-after: auto;
    }

    .topbar {
        width: 100%;
        border-bottom: 3px solid #111;
        padding-bottom: 6px;
        margin-bottom: 12px;
    }

    .topbar table {
        width: 100%;
        border-collapse: collapse;
    }

    .topbar td {
        border: none;
        vertical-align: top;
        padding: 0;
    }

    .topbar .logo-cell {
        width: 65%;
    }

    .topbar .code-cell {
        width: 35%;
        text-align: right;
        font-size: 12px;
        font-weight: bold;
        color: #1d1d1d;
        padding-top: 8px;
    }

    .logo {
        width: 280px;
        max-width: 100%;
        display: block;
    }

    .title-wrap {
        text-align: center;
        margin-bottom: 14px;
    }

    .title-wrap h1 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 0.2px;
        text-transform: uppercase;
        color: #1a1a1a;
    }

    .title-wrap h1 em {
        font-style: italic;
        font-weight: 700;
    }

    .title-wrap .subtitle {
        margin-top: 6px;
        font-size: 12px;
        font-style: italic;
        font-weight: 700;
        color: #2b6ea3;
        text-transform: uppercase;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .meta-table,
    .section-table,
    .signature-table {
        width: calc(100% - 2px);
        margin-right: 2px;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .meta-table {
        margin-bottom: 10px;
    }

    .meta-table td {
        border: 1px solid #b9c3cf;
        padding: 6px 8px;
        height: 28px;
        vertical-align: middle;
        background: #eef2f6;
        font-size: 10px;
    }

    .meta-table .label {
        width: 14%;
        background: #d7e0e9;
        font-weight: 700;
        color: #2a2a2a;
    }

    .meta-table .value {
        width: 36%;
        background: #f3f6fa;
    }

    .section-table {
        margin-bottom: 16px;
    }

    .section-table th {
        background: #1f4e79;
        color: #fff;
        border: 1px solid #16344f;
        padding: 5px 4px;
        text-align: center;
        font-size: 9px;
        font-weight: 700;
        line-height: 1.2;
    }

    .section-table td {
        border: 1px solid #b8b8b8;
        padding: 5px 4px;
        vertical-align: top;
        font-size: 9px;
        background: #fff;
        line-height: 1.35;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    .section-table .center {
        text-align: center;
        vertical-align: middle;
    }

    .section-table th:last-child {
        border-right: 1px solid #16344f !important;
    }

    .section-table td:last-child,
    .meta-table td:last-child,
    .signature-table th:last-child,
    .signature-table td:last-child {
        border-right: 1px solid #b8b8b8 !important;
    }

    .activity-table tbody tr {
        page-break-inside: avoid;
        break-inside: avoid-page;
    }

    .activity-table td.status-cell {
        text-align: center;
        font-weight: 700;
        font-size: 11px;
        vertical-align: middle;
    }

    .activity-table td.no-cell {
        text-align: center;
        vertical-align: middle;
    }

    .keterangan-cell {
        padding: 4px;
    }

    .keterangan-wrap {
        display: block;
    }

    .keterangan-cell,
    .keterangan-wrap,
    .keterangan-photo-box {
        overflow: hidden;
    }

    .keterangan-text {
        white-space: pre-line;
        line-height: 1.35;
        font-size: 8.8px;
        margin-bottom: 6px;
        text-align: left;
    }

    .keterangan-photos {
        display: flex;
        flex-direction: column;
        gap: 6px;
        align-items: center;
    }

    .keterangan-photo-box {
        width: 100%;
        border: 1px solid #c9d1da;
        padding: 2px;
        background: #fff;
    }

    .keterangan-photo-box img {
        display: block;
        width: 100%;
        max-width: 200px;
        height: auto;
        max-height: 150px;
        object-fit: contain;
        margin: 0 auto;
    }

    .section-title {
        margin: 2px 0 6px;
        font-size: 12px;
        font-weight: 700;
        color: #496a86;
    }

    .section-title .note {
        font-weight: 400;
        font-style: italic;
        color: #6d6d6d;
    }

    .signature-table {
        margin-top: 30px;
    }

    .signature-table th {
        background: #203d73;
        color: #fff;
        border: 1px solid #8f9aad;
        padding: 7px 5px;
        font-size: 11px;
        font-weight: 700;
        text-align: center;
    }

    .signature-table td {
        border: 1px solid #b8b8b8;
        height: 140px;
        vertical-align: bottom;
        text-align: center;
        padding: 0 10px 22px;
        font-size: 11px;
    }

    .signature-name {
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .signature-role {
        margin-top: 2px;
        font-size: 11px;
        font-weight: 700;
    }

    @media print {
        body {
            margin: 0;
        }

        .page {
            padding-right: 2px;
        }
    }
</style>
</head>

<body>
    {{-- HALAMAN 1 --}}
    <div class="page">
        <div class="topbar">
            <table>
                <tr>
                    <td class="logo-cell">
                        <img src="{{ asset('dashboard/assets/images/logo-full.png') }}" alt="Logo" class="logo">
                    </td>
                    <td class="code-cell">FM-SE-72/00/11/03/26</td>
                </tr>
            </table>
        </div>

        <div class="title-wrap">
            <h1>LAPORAN KEGIATAN HARIAN &amp; <em>JOB PENDING</em></h1>
            <div class="subtitle">SECTION SAFETY PATROL</div>
        </div>

        <table class="meta-table">
            <tr>
                <td class="label">Tanggal</td>
                <td class="value">
                    {{ !empty($data['daily']->tanggal) ? Carbon::parse($data['daily']->tanggal)->locale('id')->isoFormat('D MMMM YYYY') : '' }}
                </td>
                <td class="label">Shift</td>
                <td class="value">{{ $data['daily']->shift ?? 'Pagi / Malam' }}</td>
            </tr>
            <tr>
                <td class="label">Nama Petugas</td>
                <td class="value">{{ $data['daily']->nama_petugas ?? '' }}</td>
                <td class="label">Jabatan</td>
                <td class="value">{{ ($data['daily']->position ?? 'Foreman / Supervisor') }} <i>(Safety Patrol)</i></td>
            </tr>
        </table>

        <table class="section-table activity-table">
            <colgroup>
                <col style="width:4%">
                <col style="width:16%">
                <col style="width:15%">
                <col style="width:11%">
                <col style="width:14%">
                <col style="width:6%">
                <col style="width:34%">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Sub Kegiatan / Detail</th>
                    <th>Waktu Pelaksanaan</th>
                    <th>Lokasi</th>
                    <th>Status<br>(✓/✗/–)</th>
                    <th>Keterangan/Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['sub'] as $sub)
                    <tr>
                        <td class="no-cell">{{ $loop->iteration }}</td>
                        <td>{{ $sub->sub }}</td>
                        <td>{{ $sub->kategori }}</td>
                        <td>{{ $sub->frekuensi }}</td>
                        <td>{{ $sub->lokasi }}</td>
                        <td class="status-cell">{{ $sub->status }}</td>
                        <td class="keterangan-cell">
                            <div class="keterangan-wrap">
                                <div class="keterangan-text">
                                    {!! nl2br(e($sub->keterangan ?? '')) !!}
                                </div>

                                @if (!empty($sub->foto_kegiatan))
                                    <div class="keterangan-photos">
                                        <div class="keterangan-photo-box">
                                            <img src="{{ $sub->foto_kegiatan }}" alt="Foto Kegiatan">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- HALAMAN 2 --}}
    <div class="page">
        <div class="topbar">
            <table>
                <tr>
                    <td class="logo-cell">
                        <img src="{{ asset('dashboard/assets/images/logo-full.png') }}" alt="Logo" class="logo">
                    </td>
                    <td class="code-cell">FM-SE-72/00/11/03/26</td>
                </tr>
            </table>
        </div>

        <div class="section-title">Temuan &amp; Tindak Lanjut:</div>
        <table class="section-table activity-table">
            <colgroup>
                <col style="width:4%">
                <col style="width:40%">
                <col style="width:41%">
                <col style="width:15%">
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Temuan &amp; Deskripsi</th>
                    <th>Tindak Lanjut</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['temuan'] as $temuan)
                <tr style="height:44px;">
                    <td class="center">{{ $loop->iteration }}</td>
                    <td class="keterangan-cell">
                        <div class="keterangan-wrap">
                            <div class="keterangan-text">
                                {!! nl2br(e($temuan->deskripsi_temuan ?? '')) !!}
                            </div>

                            @if (!empty($temuan->foto_temuan))
                                <div class="keterangan-photos">
                                    <div class="keterangan-photo-box">
                                        <img src="{{ $temuan->foto_temuan }}" alt="Foto temuan">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td>{{ $temuan->tindak_lanjut }}</td>
                    <td>{{ $temuan->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="section-title">
            Job Pending untuk Shift Berikutnya:
            <span class="note">(Pekerjaan yang belum selesai dan perlu dilanjutkan)</span>
        </div>

        <table class="section-table activity-table">
            <colgroup>
                <col style="width:4%">
                <col style="width:30%">
                <col style="width:18%">
                <col style="width:17%">
                <col style="width:31%">
            </colgroup>
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
                <tr style="height:48px;">
                    <td class="center">{{ $loop->iteration }}</td>
                    <td class="keterangan-cell">
                        <div class="keterangan-wrap">
                            <div class="keterangan-text">
                                {!! nl2br(e($pending->kegiatan_pending ?? '')) !!}
                            </div>

                            @if (!empty($pending->foto_pending))
                                <div class="keterangan-photos">
                                    <div class="keterangan-photo-box">
                                        <img src="{{ $pending->foto_pending }}" alt="Foto pending">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td>{{ $pending->alasan_belum_selesai }}</td>
                    <td class="center">{{ $pending->prioritas }}</td>
                    <td>{{ $pending->instruksi_shift_berikutnya }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="signature-table">
            <colgroup>
                <col style="width:33.33%">
                <col style="width:33.33%">
                <col style="width:33.33%">
            </colgroup>
            <thead>
                <tr>
                    <th>Dibuat dan Petugas saat ini</th>
                    <th>Diterima dan Petugas Selanjutnya</th>
                    <th>Diketahui Oleh</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="signature-name"> @if ($data['daily']->verified_petugas != null) {!! $data['daily']->verified_petugas !!} @endif </div>
                        <div class="signature-name">{{ $data['daily']->nama_petugas ? $data['daily']->nama_petugas : '.......................' }}</div>
                        <div class="signature-role">{{ $data['daily']->nama_petugas ? $data['daily']->position_petugas : '' }}</div>
                    </td>
                    <td>
                        <div class="signature-name"> @if ($data['daily']->verified_penerima != null) {!! $data['daily']->verified_penerima !!} @endif </div>
                        <div class="signature-name">{{ $data['daily']->nama_penerima ? $data['daily']->nama_penerima : '.......................' }}</div>
                        <div class="signature-role">{{ $data['daily']->nama_penerima ? $data['daily']->position_penerima : '' }}</div>
                    </td>
                    <td>
                        <div class="signature-name"> @if ($data['daily']->verified_superintendent != null) {!! $data['daily']->verified_superintendent !!} @endif </div>
                        <div class="signature-name">{{ $data['daily']->nama_superintendent ? $data['daily']->nama_superintendent : '.......................' }}</div>
                        <div class="signature-role">{{ $data['daily']->nama_superintendent ? $data['daily']->position_superintendent : '' }}</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
