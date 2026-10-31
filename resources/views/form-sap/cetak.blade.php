<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Laporan Inspeksi</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 8mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #172033;
            font-size: 12.5px;
            line-height: 1.55;
        }
        .toolbar {
            background: #eef2f7;
            padding: 12px 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .toolbar button {
            border: 0;
            background: #1d4ed8;
            color: white;
            border-radius: 6px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 700;
        }
        .toolbar button.secondary {
            background: #475569;
        }
        .sheet {
            max-width: 210mm;
            margin: 16px auto;
            padding: 12mm 13mm;
            background: white;
            box-shadow: 0 2px 16px #0002;
        }
        .header {
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 2px solid #1e3a5f;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .logo {
            width: 140px;
            max-height: 52px;
            object-fit: contain;
            object-position: left center;
        }
        .header-title {
            flex: 1;
            text-align: right;
        }
        h1 {
            margin: 0;
            font-size: 20px;
            color: #102a47;
        }
        .subtitle {
            font-size: 11.5px;
            color: #64748b;
            margin-top: 3px;
        }
        .summary {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 10px 0 12px;
        }
        .tag {
            border: 1px solid #bdcadd;
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 11.5px;
        }
        .tag strong {
            color: #163d68;
        }
        .section {
            margin-top: 12px;
            break-inside: auto;
        }
        .section h2 {
            font-size: 14px;
            margin: 0 0 7px;
            padding: 7px 9px;
            background: #eaf0f7;
            border-left: 3px solid #1e4d82;
            color: #123456;
            break-after: avoid;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        td,
        th {
            border: 1px solid #cfd8e3;
            padding: 7px 9px;
            vertical-align: top;
            overflow-wrap: anywhere;
        }
        td.label {
            width: 22%;
            background: #f7f9fc;
            font-weight: 700;
        }
        td.value {
            width: 28%;
        }
        .text-box {
            border: 1px solid #cfd8e3;
            padding: 9px 11px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            min-height: 38px;
        }
        .text-label {
            font-weight: 700;
            margin: 10px 0 5px;
            font-size: 12.5px;
        }
        .section-start,
        .field-group {
            break-inside: avoid;
            page-break-inside: avoid;
        }
        .photo-block {
            break-inside: avoid;
            page-break-inside: avoid;
        }
        .photo-block .text-label {
            break-after: avoid;
            page-break-after: avoid;
        }
        .section-start h2,
        .section-start .text-label {
            break-after: avoid-page;
            page-break-after: avoid;
        }
        .checklist {
            margin: 0;
            padding-left: 19px;
        }
        .checklist li {
            margin: 3px 0;
        }
        .photos {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            margin-top: 7px;
        }
        .photo {
            margin: 0;
            border: 1px solid #cfd8e3;
            padding: 5px;
            break-inside: avoid;
            page-break-inside: avoid;
        }
        .photo img {
            display: block;
            width: 100%;
            height: 58mm;
            object-fit: contain;
        }
        .photo figcaption {
            font-size: 11px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 4px;
        }
        .muted {
            color: #64748b;
            font-style: italic;
        }
        .footer {
            border-top: 1px solid #bfcbd8;
            margin-top: 15px;
            padding-top: 5px;
            text-align: right;
            font-size: 10.5px;
            color: #64748b;
        }
        @media print {
            html,
            body {
                width: auto;
                height: auto;
                background: white;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .toolbar {
                display: none !important;
            }
            .sheet {
                box-shadow: none;
                margin: 0;
                padding: 0;
                max-width: none;
                width: var(--print-width, 194mm);
                zoom: var(--print-scale, 1);
            }
            body {
                font-size: 10px;
                line-height: 1.3;
            }
            .header {
                padding-bottom: 5px;
                margin-bottom: 5px;
            }
            .logo {
                width: 105px;
                max-height: 38px;
            }
            h1 {
                font-size: 16px;
            }
            .summary {
                margin: 5px 0;
                gap: 4px;
            }
            .tag {
                font-size: 9px;
                padding: 2px 5px;
            }
            .section {
                margin-top: 6px;
            }
            .section h2 {
                font-size: 11px;
                padding: 3px 6px;
                margin-bottom: 3px;
            }
            td,
            th {
                padding: 3px 5px;
            }
            .text-label {
                font-size: 10px;
                margin: 4px 0 2px;
            }
            .text-box {
                padding: 4px 6px;
                min-height: 0;
            }
            .photos {
                gap: 4px;
                margin-top: 3px;
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            .photo {
                padding: 3px;
            }
            .photo img {
                height: 31mm;
            }
            .photo figcaption {
                font-size: 8px;
                padding-top: 2px;
            }
            .footer {
                margin-top: 6px;
                font-size: 8px;
            }
            .section h2 {
                background: #eaf0f7 !important;
            }
            tr,
            .photo {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
        @media screen and (max-width: 650px) {
            .sheet {
                padding: 15px;
                margin: 0;
            }
            .photos {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
@php
    $report = $data['report'];
    $imageUrl = function ($path) {
        if (!$path) {
            return null;
        }
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        return asset('storage/' . ltrim($path, '/'));
    };
    $temuanImages = array_values(array_filter([
        $imageUrl($report->file_temuan ?? null),
        $imageUrl($report->file_temuan2 ?? null),
        $imageUrl($report->file_temuan3 ?? null)
    ]));
    $tindakLanjutImages = array_values(array_filter([
        $imageUrl($report->file_tindakLanjut ?? null),
        $imageUrl($report->file_tindakLanjut2 ?? null),
        $imageUrl($report->file_tindakLanjut3 ?? null)
    ]));
    $inspektors = array_values(array_filter([
        $report->inspektor1 ?? null,
        $report->inspektor2 ?? null,
        $report->inspektor3 ?? null,
        $report->inspektor4 ?? null,
        $report->inspektor5 ?? null
    ], fn ($value) => filled($value)));
    $detailTemuan = $report->detail_temuan ?? [];
    if (is_string($detailTemuan)) {
        $detailTemuan = json_decode($detailTemuan, true) ?? [];
    }
    if (!is_array($detailTemuan)) {
        $detailTemuan = [];
    }
@endphp
<main class="sheet">
    <header class="header">
        <img class="logo" src="{{ asset('dashboard/assets/images/logo-full.png') }}" alt="Logo Perusahaan">
        <div class="header-title">
            <h1>LAPORAN INSPEKSI</h1>
        </div>
    </header>
    <div class="summary">
        <div class="tag">
            Status: <strong>{{ ($report->is_finish ?? false) ? 'Selesai / Close' : 'Open / Belum Selesai' }}</strong>
        </div>
        <div class="tag">
            Tingkat Risiko: <strong>{{ $report->tingkat_risiko ?? '-' }}</strong>
        </div>
        <div class="tag">
            PICA Level: <strong>{{ $report->level ?? '-' }}</strong>
        </div>
    </div>
    <section class="section">
        <h2>1. Informasi Inspektor</h2>
        @if(count($inspektors))
            <table>
                <tbody>
                    @foreach($inspektors as $index => $inspektor)
                        <tr>
                            <td class="label">Inspektor {{ $index + 1 }}</td>
                            <td>{{ $inspektor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-box muted">Data inspektor tidak tersedia.</div>
        @endif
    </section>
    <section class="section">
        <h2>2. Detail Lokasi dan Waktu</h2>
        <table>
            <tbody>
                <tr>
                    <td class="label">Tanggal Pelaporan</td>
                    <td class="value">{{ !empty($report->tanggal_kejadian) ? date('d-m-Y', strtotime($report->tanggal_kejadian)) : '-' }}</td>
                    <td class="label">Jam Kejadian</td>
                    <td class="value">{{ !empty($report->jam_kejadian) ? date('H:i', strtotime($report->jam_kejadian)) : '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Shift</td>
                    <td class="value">{{ $report->shift ?? '-' }}</td>
                    <td class="label">Area</td>
                    <td class="value">{{ $report->area ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Pembuat</td>
                    <td class="value">{{ $report->pembuat ?? '-' }}</td>
                    <td class="label">PIC Tindak Lanjut</td>
                    <td class="value">{{ $report->nama_pic ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </section>
    <section class="section">
        <div class="section-start">
            <h2>3. Temuan Inspeksi</h2>
            <div class="text-label">Temuan KTA/TTA</div>
            <div class="text-box">{{ $report->temuan ?: '-' }}</div>
        </div>
        <table style="margin-top: 8px">
            <tbody>
                <tr>
                    <td class="label">Tingkat Risiko</td>
                    <td class="value">{{ $report->tingkat_risiko ?? '-' }}</td>
                    <td class="label">Kategori Bahaya</td>
                    <td class="value">{{ $report->kategori_bahaya ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Type Bahaya</td>
                    <td class="value">{{ $report->type_bahaya ?? '-' }}</td>
                    <td class="label">PICA Level</td>
                    <td class="value">{{ $report->level ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-label">Trend Temuan</div>
        <div class="text-box">
            @if(count($detailTemuan))
                <ul class="checklist">
                    @foreach($detailTemuan as $item)
                        <li>{{ is_scalar($item) ? $item : json_encode($item, JSON_UNESCAPED_UNICODE) }}</li>
                    @endforeach
                </ul>
            @else
                <span class="muted">Belum ada trend temuan yang dipilih.</span>
            @endif
        </div>
        <div class="photo-block">
            <div class="text-label">Foto Temuan</div>
            @if(count($temuanImages))
                <div class="photos">
                    @foreach($temuanImages as $index => $img)
                        <figure class="photo">
                            <img src="{{ $img }}" alt="Foto Temuan {{ $index + 1 }}">
                            <figcaption>Foto Temuan {{ $index + 1 }}</figcaption>
                        </figure>
                    @endforeach
                </div>
            @else
                <div class="text-box muted">Belum ada foto temuan.</div>
            @endif
        </div>
    </section>
    <section class="section">
        <div class="section-start">
            <h2>4. Analisis Risiko</h2>
            <div class="text-label">Risiko</div>
            <div class="text-box">{{ $report->risiko ?: '-' }}</div>
        </div>
        <div class="field-group">
            <div class="text-label">Pengendalian Awal Saat Ini</div>
            <div class="text-box">{{ $report->pengendalian ?: '-' }}</div>
        </div>
        <div class="field-group">
            <div class="text-label">Rekomendasi Tindakan Perbaikan</div>
            <div class="text-box">{{ $report->tindakan_perbaikan ?: '-' }}</div>
        </div>
    </section>
    <section class="section">
        <div class="section-start">
            <h2>5. Tindak Lanjut</h2>
            <div class="text-label">Tindak Lanjut</div>
            <div class="text-box">{{ $report->tindak_lanjut ?: '-' }}</div>
        </div>
        <div class="photo-block">
            <div class="text-label">Foto Bukti Tindak Lanjut</div>
            @if(count($tindakLanjutImages))
                <div class="photos">
                    @foreach($tindakLanjutImages as $index => $img)
                        <figure class="photo">
                            <img src="{{ $img }}" alt="Bukti Tindak Lanjut {{ $index + 1 }}">
                            <figcaption>Foto Bukti Tindak Lanjut {{ $index + 1 }}</figcaption>
                        </figure>
                    @endforeach
                </div>
            @else
                <div class="text-box muted">Belum ada foto bukti tindak lanjut.</div>
            @endif
        </div>
    </section>
    <footer class="footer">Dicetak pada {{ now()->timezone('Asia/Makassar')->format('d-m-Y H:i') }} WITA</footer>
</main>
<script>
    function fitPrintToOnePage() {
        const sheet = document.querySelector('.sheet');
        if (!sheet) {
            return;
        }
        sheet.style.removeProperty('--print-scale');
        sheet.style.removeProperty('--print-width');
        const ruler = document.createElement('div');
        ruler.style.cssText = 'position:absolute;visibility:hidden;width:194mm;height:277mm;pointer-events:none';
        document.body.appendChild(ruler);
        const pageHeight = ruler.getBoundingClientRect().height;
        ruler.remove();
        const measure = sheet.cloneNode(true);
        measure.style.cssText = 'position:absolute;visibility:hidden;left:-99999px;top:0;width:194mm;max-width:none;margin:0;padding:0;box-shadow:none;zoom:1';
        const computed = document.createElement('style');
        computed.textContent = '.print-measure{font-size:10px;line-height:1.3}.print-measure .photo img{height:31mm}.print-measure .photos{grid-template-columns:repeat(3,minmax(0,1fr));gap:4px}.print-measure .section{margin-top:6px}.print-measure .text-box{padding:4px 6px;min-height:0}.print-measure .text-label{margin:4px 0 2px}.print-measure td{padding:3px 5px}';
        measure.classList.add('print-measure');
        document.head.appendChild(computed);
        document.body.appendChild(measure);
        const naturalHeight = measure.getBoundingClientRect().height;
        measure.remove();
        computed.remove();
        const scale = Math.min(1, pageHeight / Math.max(naturalHeight, 1)) * 0.97;
        sheet.style.setProperty('--print-scale', scale.toFixed(4));
        sheet.style.setProperty('--print-width', (194 / scale).toFixed(3) + 'mm');
    }
    window.addEventListener('beforeprint', fitPrintToOnePage);
    window.addEventListener('load', fitPrintToOnePage);
    window.print();
</script>

</body>
</html>
