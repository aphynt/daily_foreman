@php
    use Illuminate\Support\Str;

    $report = $data['report'] ?? $report;

    $isTrue = function ($value) {
        return (int) $value === 1;
    };

    $check = function ($value) use ($isTrue) {
        return $isTrue($value) ? '✓' : '';
    };

    $hasText = function ($value) {
        return $value !== null && trim((string) $value) !== '';
    };

    $formatDate = function ($value) {
        if (empty($value)) return '';

        try {
            return \Carbon\Carbon::parse($value)->format('d/m/Y');
        } catch (\Throwable $e) {
            return $value;
        }
    };

    $formatTime = function ($value) {
        if (empty($value)) return '';

        try {
            return \Carbon\Carbon::parse($value)->format('H:i');
        } catch (\Throwable $e) {
            return $value;
        }
    };

    $imageUrl = function ($path) {
        if (!$path) return null;

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    };

    $foto1 = $imageUrl($report->dokumentasi_foto_1 ?? null);
    $foto2 = $imageUrl($report->dokumentasi_foto_2 ?? null);
    $foto3 = $imageUrl($report->dokumentasi_foto_3 ?? null);

    $photos = array_values(array_filter([
        $foto1,
        $foto2,
        $foto3,
    ]));

    $lokasi = strtolower(trim((string) ($report->lokasi ?? '')));

    $lokasiCheck = function (array $aliases) use ($lokasi) {
        foreach ($aliases as $alias) {
            if ($lokasi === strtolower(trim($alias))) {
                return true;
            }
        }

        return false;
    };

    $petugas = [
        $report->nama_petugas1 ?? '',
        $report->nama_petugas2 ?? '',
        $report->nama_petugas3 ?? '',
        $report->nama_petugas4 ?? '',
        $report->nama_petugas5 ?? '',
    ];

    $pekerja = [
        $report->pekerja1 ?? '',
        $report->pekerja2 ?? '',
        $report->pekerja3 ?? '',
        $report->pekerja4 ?? '',
        $report->pekerja5 ?? '',
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Observasi BANK</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 20px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 210mm;

            background: #ffffff !important;
            color: #111111 !important;

            font-family: Arial, Helvetica, sans-serif;
            font-size: 6pt;
            line-height: 1.05;

            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .page {
            position: relative;
            width: 210mm;
            height: 297mm;
            overflow: hidden !important;

            page-break-inside: avoid !important;
            break-inside: avoid-page !important;
        }
        .page:not(:last-child) {
            page-break-after: always !important;
            break-after: page !important;
        }

        .page:last-child {
            page-break-after: auto !important;
            break-after: auto !important;
        }

        .block {
            position: absolute;
            left: 3mm;
            width: 204mm;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        td,
        th {
            vertical-align: middle;
        }

        .no-border td,
        .no-border th {
            border: 0;
        }

        .header-block {
            top: 3mm;
            height: 31mm;
        }

        .header-table td {
            padding: 0;
        }

        .logo {
            width: 37mm;
            max-height: 8mm;
            object-fit: contain;
        }

        .doc-no {
            text-align: right;
            vertical-align: top;
            font-size: 9pt;
            font-weight: 700;
        }

        .header-line {
            border-top: 1.2px solid #111;
            margin: .8mm 0 1mm;
        }

        .title {
            font-size: 14pt;
            font-weight: 800;
            line-height: 1;
            text-align: center;
        }

        .subtitle {
            margin-top: .5mm;
            margin-bottom: 1mm;
            text-align: center;
            font-size: 6.5pt;
            font-weight: 700;
        }

        .info td {
            padding: .35mm .5mm;
            height: 3.3mm;
        }

        .info-label {
            width: 17%;
        }

        .colon {
            width: 2%;
            text-align: center;
        }

        .info-value {
            width: 31%;
            border-bottom: .25mm solid #777;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
        }

        .location-block {
            top: 34mm;
            height: 20mm;
        }

        .blue {
            background: #0d6efd !important;
            color: #ffffff !important;
            font-weight: 700;
        }

        .area-title {
            height: 5mm;
            line-height: 5mm;
            text-align: center;
            font-size: 6px;
        }

        .locations td {
            border: 0;
            padding: .45mm .3mm;
            text-align: center;
            white-space: nowrap;
            font-size: 5.8pt;
        }

        .box {
            display: inline-block;
            width: 3mm;
            height: 3mm;
            line-height: 2.6mm;
            border: .3mm solid #111;
            background: #fff;
            text-align: center;
            vertical-align: middle;
            font-size: 6pt;
            font-weight: 800;
            margin-right: .5mm;
        }

        .instruction {
            margin-top: .4mm;
            font-size: 5.8pt;
            font-weight: 700;
            white-space: nowrap;
        }

        .row1-block {
            top: 55mm;
            height: 69mm;
        }

        .row2-block {
            top: 125mm;
            height: 64mm;
        }

        .four-col > tbody > tr > td {
            width: 25%;
            border: 0;
            vertical-align: top;
            padding: 0 .45mm;
        }

        .four-col > tbody > tr > td:first-child {
            padding-left: 0;
        }

        .four-col > tbody > tr > td:last-child {
            padding-right: 0;
        }

        .section-title {
            height: 5mm;
            padding: .55mm .55mm;
            font-size: 5.8pt;
            line-height: 1;
            overflow: hidden;
        }

        .item-table td {
            border: 0;
            height: 3.95mm;
            padding: .18mm 0;
        }

        .item-text {
            background: #e2e2e2 !important;
            padding: .45mm .55mm !important;
            font-size: 5.5pt;
            line-height: 1;
            overflow: hidden;
            word-break: break-word;
        }

        .check-cell {
            width: 4mm;
            text-align: right;
            padding-left: .4mm !important;
        }

        .small-box {
            display: inline-block;
            width: 3.2mm;
            height: 3.2mm;
            line-height: 2.8mm;

            border: .28mm solid #111;
            background: #fff;

            text-align: center;
            font-size: 6pt;
            font-weight: 800;
        }

        .other-label {
            height: 3mm !important;
            font-size: 5.5pt;
        }

        .other-text {
            height: 3.8mm !important;
            background: #e2e2e2 !important;
            padding: .4mm .5mm !important;
            font-size: 5.2pt;
            overflow: hidden;
        }

        .comment-wrap {
            border-top: .25mm solid #333;
        }

        .comment-content {
            padding: .55mm .35mm;
            border-bottom: .25mm solid #555;
            word-break: break-word;
            overflow: hidden;
            font-size: 5.5pt;
            line-height: 1.15;
        }

        .comment-line {
            height: 4.4mm;
            border-bottom: .25mm solid #555;
        }

        .correction-block {
            top: 190mm;
            height: 42mm;
        }

        .correction-title {
            height: 5mm;
            line-height: 3.5mm;
            padding: .55mm;
            font-size: 4.3px;
        }

        .actions {
            margin-top: .5mm;
            margin-bottom: .6mm;
        }

        .actions td {
            border: 0;
            padding: .2mm .3mm;
            height: 4mm;
        }

        .action-box {
            width: 8mm;
            text-align: left;
        }

        .action-text {
            font-weight: 700;
            font-size: 5.8pt;
        }

        .grid-table th,
        .grid-table td {
            border: .25mm solid #111;
            padding: .35mm .45mm;
            overflow: hidden;
            word-break: break-word;
        }

        .grid-table th {
            background: #ececec !important;
            font-size: 5.5pt;
            text-align: center;
            height: 4mm;
        }

        .grid-table td {
            font-size: 5.5pt;
            height: 3.8mm;
        }

        .correction-table th:first-child {
            width: 79%;
        }

        .correction-table th:last-child {
            width: 21%;
        }

        .notes-title {
            margin-top: .8mm;
            font-weight: 700;
            font-size: 5.8pt;
        }

        .notes {
            margin-top: .3mm;
            height: 5.5mm;
            border-bottom: .25mm solid #555;
            padding: .3mm;
            overflow: hidden;
            white-space: pre-wrap;
            word-break: break-word;
            font-size: 5.5pt;
        }

        .bottom-block {
            top: 233mm;
            height: 61mm;
        }

        .bottom-grid > tbody > tr > td {
            width: 25%;
            border: 0;
            vertical-align: top;
            padding: 0 .45mm;
        }

        .bottom-grid > tbody > tr > td:first-child {
            padding-left: 0;
        }

        .bottom-grid > tbody > tr > td:last-child {
            padding-right: 0;
        }

        .bottom-title {
            height: 5mm;
            padding: .55mm;
            font-size: 5.8pt;
            overflow: hidden;
        }

        .person-table td {
            height: 4mm;
            padding: .3mm .4mm;
            border: .25mm solid #111;
            font-size: 5.4pt;
        }

        .person-label {
            width: 27%;
        }

        .person-num {
            width: 11%;
            text-align: center;
        }

        .person-value {
            width: 62%;
        }

        .validation-table td {
            height: 4.5mm;
            padding: .35mm .4mm;
            border: .25mm solid #111;
            font-size: 5.4pt;
        }

        .validation-table td:first-child {
            width: 35%;
        }

        .signature {
            height: 70px !important;
        }

        .documentation-page {
            background: #ffffff;
        }

        .documentation-inner {
            position: absolute;
            top: 5mm;
            left: 5mm;
            width: 200mm;
            height: 287mm;
            overflow: hidden;
        }

        .documentation-header {
            height: 29mm;
        }

        .documentation-header-table td {
            padding: 0;
        }

        .documentation-logo {
            width: 40mm;
            max-height: 9mm;
            object-fit: contain;
        }

        .documentation-doc-no {
            text-align: right;
            vertical-align: top;
            font-size: 8pt;
            font-weight: 700;
        }

        .documentation-line {
            border-top: 1.2px solid #111;
            margin: 1mm 0 1.3mm;
        }

        .documentation-main-title {
            text-align: center;
            font-size: 14pt;
            font-weight: 800;
            line-height: 1;
        }

        .documentation-subtitle {
            margin-top: .7mm;
            text-align: center;
            font-size: 7pt;
            font-weight: 700;
        }

        .documentation-info {
            margin-top: 2mm;
            margin-bottom: 2mm;
        }

        .documentation-info td {
            border: .25mm solid #c9c9c9;
            padding: 1mm 1.2mm;
            font-size: 8pt;
        }

        .documentation-info .doc-label {
            width: 16%;
            background: #f1f1f1 !important;
            font-weight: 700;
        }

        .documentation-info .doc-value {
            width: 34%;
        }

        .documentation-title {
            margin-bottom: 3mm;
            padding: 2mm 2.5mm;
            background: #0d6efd !important;
            color: #ffffff !important;
            text-align: center;
            font-size: 12pt;
            font-weight: 700;
        }

        .documentation-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 4mm;
            width: 100%;
        }

        .documentation-card {
            border: .3mm solid #b8b8b8;
            background: #ffffff;
            overflow: hidden;
            page-break-inside: avoid;
        }

        .documentation-card-title {
            height: 8mm;
            line-height: 8mm;
            padding: 0 2mm;
            background: #f0f3f7 !important;
            border-bottom: .3mm solid #b8b8b8;
            font-size: 9pt;
            font-weight: 700;
            text-align: center;
        }

        .documentation-image-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: calc(100% - 8mm);
            padding: 2mm;
            background: #ffffff;
            overflow: hidden;
        }

        .documentation-image {
            display: block;
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            object-position: center;
        }

        .documentation-grid.count-1 {
            grid-template-columns: 1fr;
        }

        .documentation-grid.count-1 .documentation-card {
            height: 226mm;
        }

        .documentation-grid.count-2 .documentation-card {
            height: 226mm;
        }

        .documentation-grid.count-3 .documentation-card {
            height: 109mm;
        }

        .documentation-grid.count-3 .documentation-card:last-child {
            grid-column: 1 / -1;
        }

        .documentation-empty {
            height: 220mm;
            border: .4mm dashed #b8b8b8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777777;
            font-size: 11pt;
            text-align: center;
        }

        .documentation-no-image {
            color: #777777;
            font-size: 9pt;
            text-align: center;
            padding: 5mm;
        }

        @media print {
            html,
            body {
                width: 210mm !important;
                margin: 0 !important;
                padding: 0 !important;
                overflow: visible !important;
            }

            .page {
                width: 210mm !important;
                height: 297mm !important;
                max-height: 297mm !important;
                overflow: hidden !important;
            }

            .page:not(:last-child) {
                page-break-after: always !important;
                break-after: page !important;
            }

            .page:last-child {
                page-break-after: auto !important;
                break-after: auto !important;
            }
        }
    </style>
</head>

<body>
<div class="page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="block header-block">
        <table class="header-table no-border">
            <tr>
                <td style="width:40%;">
                    <img
                        src="{{ asset('dashboard/assets/images/logo-full.png') }}"
                        class="logo"
                        alt="SIMS Jaya Kaltim"
                    >
                </td>
                <td style="width:20%;"></td>
                <td style="width:40%;" class="doc-no">
                    FM-SHE-210/02/31/05/24
                </td>
            </tr>
        </table>

        <div class="header-line"></div>

        <div class="title">OBSERVASI</div>

        <div class="subtitle">
            BERHENTI, AMATI (BAHAYA), NILAI (RISIKO) &amp; KENDALIKAN (BANK)
        </div>

        <table class="info no-border">
            <tr>
                <td class="info-label">Tanggal</td>
                <td class="colon">:</td>
                <td class="info-value">
                    {{ !empty($report->tanggal) ? $formatDate($report->tanggal) : '-' }}
                </td>

                <td class="info-label">Nama Pekerjaan</td>
                <td class="colon">:</td>
                <td class="info-value">{{ $report->nama_pekerjaan ?? '-' }}</td>
            </tr>

            <tr>
                <td class="info-label">Waktu / Jam</td>
                <td class="colon">:</td>
                <td class="info-value">
                    {{ !empty($report->jam) ? $formatTime($report->jam) : '-' }}
                </td>

                <td class="info-label">Referensi</td>
                <td class="colon">:</td>
                <td class="info-value">{{ $report->referensi ?? '-' }}</td>
            </tr>

            <tr>
                <td class="info-label">Departemen</td>
                <td class="colon">:</td>
                <td class="info-value">
                    {{ $report->departemen ?? $report->departemen_id ?? '-' }}
                </td>

                <td class="info-label">Nomor Referensi</td>
                <td class="colon">:</td>
                <td class="info-value">{{ $report->no_referensi ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- =========================================================
         LOCATION
    ========================================================== --}}
    <div class="block location-block">
        <div class="blue area-title">LOKASI / AREA OBSERVASI</div>

        <div class="instruction">
            {{ $report->lokasi ?? '-' }}
        </div>
    </div>

    {{-- =========================================================
         I - IV
    ========================================================== --}}
    <div class="block row1-block">
        <table class="four-col no-border">
            <tr>
                {{-- I --}}
                <td>
                    <div class="blue section-title">I. Perilaku Pekerja Saat Diamati</div>

                    <table class="item-table no-border">
                        @foreach([
                            ['Posisi saat bekerja', 'perilaku_posisi_saat_bekerja'],
                            ['Menggunakan peralatan', 'perilaku_menggunakan_peralatan'],
                            ['Mengangkat barang', 'perilaku_mengangkat_barang'],
                            ['Mengemudi', 'perilaku_mengemudi'],
                            ['Menaiki / Menuruni tangga', 'perilaku_menaiki_menuruni_tangga'],
                        ] as [$label, $field])
                            <tr>
                                <td class="item-text">{{ $label }}</td>
                                <td class="check-cell">
                                    <span class="small-box">{{ $check($report->{$field} ?? 0) }}</span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="other-label">Dan lain-lain:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->perilaku_lain_1 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->perilaku_lain_1 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->perilaku_lain_2 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->perilaku_lain_2 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- II --}}
                <td>
                    <div class="blue section-title">II. Penggunaan APD / Alat Keselamatan</div>

                    <table class="item-table no-border">
                        @foreach([
                            ['Pelindung kepala (Helmet)', 'apd_pelindung_kepala'],
                            ['Pelindung mata (Kaca Mata)', 'apd_pelindung_mata'],
                            ['Pelindung telinga (Earplug/Muff)', 'apd_pelindung_telinga'],
                            ['Pelindung pernafasan (Masker)', 'apd_pelindung_pernafasan'],
                            ['Pelindung tangan (Sarung Tangan)', 'apd_pelindung_tangan'],
                            ['Pelindung kaki (Safety Shoes)', 'apd_pelindung_kaki'],
                            ['Pelindung tenggelam (Life Jacket)', 'apd_pelindung_tenggelam'],
                            ['LOTO', 'apd_loto'],
                            ['Sabuk Pengaman / Set Belt', 'apd_sabuk_pengaman'],
                        ] as [$label, $field])
                            <tr>
                                <td class="item-text">{{ $label }}</td>
                                <td class="check-cell">
                                    <span class="small-box">{{ $check($report->{$field} ?? 0) }}</span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="other-label">Dan lain-lain:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->apd_lain_1 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->apd_lain_1 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->apd_lain_2 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->apd_lain_2 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- III --}}
                <td>
                    <div class="blue section-title">III. Potensi Risiko dari Pekerja</div>

                    <table class="item-table no-border">
                        @foreach([
                            ['Menabrak / ditabrak', 'risiko_menabrak'],
                            ['Terjepit', 'risiko_terjepit'],
                            ['Terpukul / terbentur', 'risiko_terpukul'],
                            ['Terpeleset / terguling / terjatuh', 'risiko_terpeleset'],
                            ['Sengatan / gigitan binatang', 'risiko_sengatan'],
                            ['Gangguan kesehatan', 'risiko_gangguan_kesehatan'],
                            ['Pencemaran Lingkungan', 'risiko_pencemaran_lingkungan'],
                            ['Terhirup / terpapar debu / bahan kimia', 'risiko_terhirup'],
                            ['Kontak dengan panas / listrik', 'risiko_kontak'],
                        ] as [$label, $field])
                            <tr>
                                <td class="item-text">{{ $label }}</td>
                                <td class="check-cell">
                                    <span class="small-box">{{ $check($report->{$field} ?? 0) }}</span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="other-label">Dan lain-lain:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->risiko_lain_1 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->risiko_lain_1 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->risiko_lain_2 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->risiko_lain_2 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- IV --}}
                <td>
                    <div class="blue section-title">IV. Peralatan Kerja</div>

                    <table class="item-table no-border">
                        @foreach([
                            ['Sesuai untuk pekerjaan', 'peralatan_sesuai'],
                            ['Benar dalam menggunakan', 'peralatan_benar'],
                            ['Kondisi baik dan layak operasi', 'peralatan_kondisi'],
                            ['Taging / KIP ada / telah dilakukan pengecekan', 'peralatan_taging'],
                            ['Pelindung dan pengaman', 'peralatan_pelindung'],
                        ] as [$label, $field])
                            <tr>
                                <td class="item-text">{{ $label }}</td>
                                <td class="check-cell">
                                    <span class="small-box">{{ $check($report->{$field} ?? 0) }}</span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="other-label">Dan lain-lain:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->peralatan_lain_1 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->peralatan_lain_1 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->peralatan_lain_2 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->peralatan_lain_2 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    {{-- =========================================================
         V - VIII
    ========================================================== --}}
    <div class="block row2-block">
        <table class="four-col no-border">
            <tr>
                {{-- V --}}
                <td>
                    <div class="blue section-title">V. Prosedur Kerja</div>

                    <table class="item-table no-border">
                        @foreach([
                            ['Tersedia / Ada', 'prosedur_tersedia'],
                            ['Diketahui / Dimengerti', 'prosedur_diketahui'],
                            ['Dijalankan / dilaksanakan', 'prosedur_dijalankan'],
                            ['Permit / Izin Kerja', 'prosedur_permit'],
                            ['P2H', 'prosedur_p2h'],
                        ] as [$label, $field])
                            <tr>
                                <td class="item-text">{{ $label }}</td>
                                <td class="check-cell">
                                    <span class="small-box">{{ $check($report->{$field} ?? 0) }}</span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="other-label">Dan lain-lain:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->prosedur_kerja_lain ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->prosedur_kerja_lain ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->prosedur_kerja_lain_2 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->prosedur_kerja_lain_2 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- VI --}}
                <td>
                    <div class="blue section-title">VI. Kondisi Area / Lingkungan Kerja</div>

                    <table class="item-table no-border">
                        @foreach([
                            ['Kebersihan / Kerapian', 'kondisi_area_kebersihan'],
                            ['Rambu / Demarkasi', 'kondisi_area_rambu'],
                            ['Akses / jalan', 'kondisi_area_akses'],
                            ['Penyimpanan barang', 'kondisi_area_penyimpanan'],
                            ['Suhu', 'kondisi_area_suhu'],
                            ['Pencahayaan', 'kondisi_area_pencahayaan'],
                            ['Kebisingan', 'kondisi_area_kebisingan'],
                            ['Cuaca', 'kondisi_area_cuaca'],
                        ] as [$label, $field])
                            <tr>
                                <td class="item-text">{{ $label }}</td>
                                <td class="check-cell">
                                    <span class="small-box">{{ $check($report->{$field} ?? 0) }}</span>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="other-label">Dan lain-lain:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->kondisi_area_lain ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->kondisi_area_lain ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="other-text">{{ $report->kondisi_area_lain_2 ?? '' }}</td>
                            <td class="check-cell">
                                <span class="small-box">
                                    {{ $hasText($report->kondisi_area_lain_2 ?? null) ? '✓' : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- VII --}}
                <td>
                    <div class="blue section-title">VII. Perilaku Aman Yang Di Amati (Komentar)</div>

                    <div class="comment-wrap">
                        <div class="comment-content">
                            {{ $report->perilaku_aman_yang_diamati ?? '' }}
                        </div>
                    </div>
                </td>

                {{-- VIII --}}
                <td>
                    <div class="blue section-title">VIII. Perilaku Tidak Aman Yang Di Amati (Komentar)</div>

                    <div class="comment-wrap">
                        <div class="comment-content">
                            {{ $report->perilaku_tidak_aman_yang_diamati ?? '' }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- =========================================================
         IX
    ========================================================== --}}
    <div class="block correction-block">
        <div class="blue correction-title">
            IX. Tindakan Koreksi / Tindakan Perbaikan
        </div>

        <table class="actions no-border">
            <tr>
                <td class="action-box">
                    <span class="small-box">{{ $check($report->tindakan_kegiatan ?? 0) }}</span>
                </td>
                <td class="action-text">Kegiatan di Hentikan</td>

                <td class="action-box">
                    <span class="small-box">{{ $check($report->tindakan_perbaikan_langsung ?? 0) }}</span>
                </td>
                <td class="action-text">Perbaikan Langsung di Tempat</td>

                <td class="action-box">
                    <span class="small-box">{{ $check($report->tindakan_perbaikan_lanjutan ?? 0) }}</span>
                </td>
                <td class="action-text">Perbaikan Lanjutan</td>
            </tr>
        </table>

        <table class="grid-table correction-table">
            <thead>
                <tr>
                    <th>Tindakan Koreksi / Tindakan Perbaikan Yang dilakukan</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i <= 5; $i++)
                    @php
                        $field = 'tindakan_lanjutan_' . $i;
                        $due = 'tindakan_lanjutan_due_' . $i;
                    @endphp

                    <tr>
                        <td>{{ $report->{$field} ?? '' }}</td>
                        <td style="text-align:center;">
                            {{ !empty($report->{$due}) ? $formatDate($report->{$due}) : '' }}
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <div class="notes-title">Catatan Khusus:</div>
        <div class="notes">{{ $report->additional_notes ?? '' }}</div>
    </div>

    {{-- =========================================================
         X - XIII
    ========================================================== --}}
    <div class="block bottom-block">
        <table class="bottom-grid no-border">
            <tr>
                {{-- X --}}
                <td>
                    <div class="blue bottom-title">X. Petugas / Observer</div>

                    <table class="person-table">
                        @foreach($petugas as $index => $nama)
                            <tr>
                                @if($index === 0)
                                    <td class="person-label" rowspan="{{ count($petugas) }}">Nama</td>
                                @endif

                                <td class="person-num">{{ $index + 1 }}.</td>
                                <td class="person-value">{{ $nama }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>

                {{-- XI --}}
                <td>
                    <div class="blue bottom-title">XI. Pekerja yang di Observasi</div>

                    <table class="person-table">
                        @foreach($pekerja as $index => $nama)
                            <tr>
                                @if($index === 0)
                                    <td class="person-label" rowspan="{{ count($pekerja) }}">Nama</td>
                                @endif

                                <td class="person-num">{{ $index + 1 }}.</td>
                                <td class="person-value">{{ $nama }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>

                {{-- XII --}}
                <td>
                    <div class="blue bottom-title">XII. Validasi Pengawas / Penanggung Jawab</div>

                    <table class="validation-table">
                        <tr>
                            <td>Nama</td>
                            <td>{{ $report->nama_pengawas1 ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td>Jabatan</td>
                            <td>{{ $report->jabatan_pengawas1 ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td>Tertanda</td>
                            <td class="signature"><img src="{{ $report->verified_pengawas1 }}" style="max-width: 70px;"></td>
                        </tr>

                        <tr>
                            <td>Tanggal</td>
                            <td>
                                {{ !empty($report->tanggal) ? $formatDate($report->tanggal) : '' }}
                            </td>
                        </tr>
                    </table>
                </td>

                {{-- XIII --}}
                <td>
                    <div class="blue bottom-title">
                        XIII. Diterima Safety Personil / Safety Representative
                    </div>

                    <table class="validation-table">
                        <tr>
                            <td>Nama</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Jabatan</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Tanda Tangan</td>
                            <td class="signature"></td>
                        </tr>

                        <tr>
                            <td>Tanggal</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</div>

<div class="page documentation-page">
    <div class="documentation-inner">

        {{-- HEADER HALAMAN 2 --}}
        <div class="documentation-header">
            <table class="documentation-header-table no-border">
                <tr>
                    <td style="width:40%;">
                        <img
                            src="{{ asset('dashboard/assets/images/logo-full.png') }}"
                            class="documentation-logo"
                            alt="SIMS Jaya Kaltim"
                        >
                    </td>

                    <td style="width:20%;"></td>

                    <td style="width:40%;" class="documentation-doc-no">
                        FM-SHE-210/02/31/05/24
                    </td>
                </tr>
            </table>

            <div class="documentation-line"></div>

            <div class="documentation-main-title">
                DOKUMENTASI
            </div>

            <div class="documentation-subtitle">
                OBSERVASI - BERHENTI, AMATI (BAHAYA), NILAI (RISIKO) &amp; KENDALIKAN (BANK)
            </div>
        </div>

        {{-- INFO SINGKAT --}}
        <table class="documentation-info">
            <tr>
                <td class="doc-label">Tanggal</td>
                <td class="doc-value">
                    {{ !empty($report->tanggal) ? $formatDate($report->tanggal) : '-' }}
                </td>

                <td class="doc-label">Nama Pekerjaan</td>
                <td class="doc-value">
                    {{ $report->nama_pekerjaan ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="doc-label">Departemen</td>
                <td class="doc-value">
                    {{ $report->departemen ?? $report->departemen_id ?? '-' }}
                </td>

                <td class="doc-label">Lokasi</td>
                <td class="doc-value">
                    {{ $report->lokasi ?? '-' }}
                    @if(!empty($report->lokasi_lain))
                        - {{ $report->lokasi_lain }}
                    @endif
                </td>
            </tr>
        </table>

        <div class="documentation-title">
            XIV. DOKUMENTASI OBSERVASI
        </div>

        <div class="documentation-grid count-3">

            {{-- FOTO 1 --}}
            <div class="documentation-card">
                <div class="documentation-card-title">
                    Dokumentasi Foto 1
                </div>

                <div class="documentation-image-wrap">
                    @if($foto1)
                        <img
                            src="{{ $foto1 }}"
                            alt="Dokumentasi Foto 1"
                            class="documentation-image"
                        >
                    @else
                        <span class="documentation-no-image">
                            
                        </span>
                    @endif
                </div>
            </div>

            {{-- FOTO 2 --}}
            <div class="documentation-card">
                <div class="documentation-card-title">
                    Dokumentasi Foto 2
                </div>

                <div class="documentation-image-wrap">
                    @if($foto2)
                        <img
                            src="{{ $foto2 }}"
                            alt="Dokumentasi Foto 2"
                            class="documentation-image"
                        >
                    @else
                        <span class="documentation-no-image">
                            
                        </span>
                    @endif
                </div>
            </div>

            {{-- FOTO 3 --}}
            <div class="documentation-card">
                <div class="documentation-card-title">
                    Dokumentasi Foto 3
                </div>

                <div class="documentation-image-wrap">
                    @if($foto3)
                        <img
                            src="{{ $foto3 }}"
                            alt="Dokumentasi Foto 3"
                            class="documentation-image"
                        >
                    @else
                        <span class="documentation-no-image">
                            
                        </span>
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>

</body>
<script>
    window.print();
</script>
</html>
