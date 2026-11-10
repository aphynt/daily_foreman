<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR PERIKSA INSPEKSI AREA OGS</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/fonts/fontawesome.css">
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.35;
            font-size: 11px;
            margin: 0;
        }
        .container {
            width: 100%;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            line-height: 1.3;
            margin: 10px 0 12px;
        }
        h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 15px;
        }
        h5 {
            margin: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        th,
        td {
            border: 1px solid #000;
            padding: 1.4px;
            /* text-align: center; */
        }
        th {
            background-color: #D0CECE;
            text-align: center;
        }
        h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .point-table {
            margin-top: 5px;
        }
        tr th {
            text-align: left;
        }
        .kanan {
            text-align: right;
        }
        .noborder {
            border-top-color: white;
            border-bottom: none;
            border-left: none;
            border-right: none;
        }
        .nobg{
            background-color: white;
        }
        .center {
            text-align: center;
        }
        .box {
            display: flex;
            justify-content: space-between;
        }
        .box-vcenter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            align-content: center;
        }
        .klkh-photo-page {
            page-break-before: always;
            break-before: page;
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .klkh-photo-header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        .klkh-photo-header td {
            border: none;
            padding: 0;
            vertical-align: top;
        }
        .klkh-photo-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 12px 0;
        }
        .klkh-photo-meta {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .klkh-photo-meta td {
            border: none;
            padding: 3px 5px;
        }
        .klkh-photo-grid {
            display: flex;
            gap: 12px;
            width: 100%;
        }
        .klkh-photo-item {
            width: 50%;
            text-align: center;
            border: 1px solid #000;
            padding: 8px;
            box-sizing: border-box;
        }
        .klkh-photo-item img {
            display: block;
            width: 100%;
            height: 330px;
            object-fit: contain;
            margin: 8px auto 0;
        }
        .klkh-photo-empty {
            height: 330px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }
        .inspection-table {
            width: 100%;
            table-layout: fixed;
            font-size: 10px;
            border-collapse: collapse;
        }
        .inspection-table th,
        .inspection-table td {
            padding: 4px 5px;
            border: 1px solid #333;
            line-height: 1.3;
            vertical-align: middle;
            overflow-wrap: break-word;
            word-break: normal;
        }
        .inspection-table th {
            background: #d9e2ef;
            text-align: center;
            font-weight: bold;
        }
        .inspection-table td.center { text-align: center; }
        .inspection-table tbody tr { break-inside: avoid; page-break-inside: avoid; }
        .inspection-table thead { display: table-header-group; }
        .inspection-table .section-row {
            background: #e9ecef;
            font-weight: bold;
            break-after: avoid;
            page-break-after: avoid;
        }
        .inspection-table .section-row td { padding: 5px; }
        .meta-table { table-layout: fixed; margin: 8px 0; }
        .meta-table td, .meta-table th { padding: 3px 5px; vertical-align: middle; }
        .meta-table th { width: 14%; white-space: nowrap; }
        .meta-table td { width: 36%; }
        @media print {
            .klkh-photo-page { page-break-before: always; }
            .inspection-table tr { break-inside: avoid; page-break-inside: avoid; }
        }
</style>
</head>
<body>
    <div class="container">
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg" style="padding: 0px; margin-bottom: 0px"><img src="{{ asset('dashboard/assets') }}/images/logo-full.png" width="240px"></th>
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-SE-03/01/23/09/26</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>DAFTAR PERIKSA INSPEKSI AREA OGS</h1>
        <table class="point-table meta-table">
            <tr><th class="noborder nobg">Tanggal</th><td class="noborder">: {{ !empty($ogs->tanggal_inspeksi) ? Carbon::parse($ogs->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') : '-' }}</td><th class="noborder nobg">Nama Lokasi</th><td class="noborder">: {{ $ogs->nama_lokasi ?? '-' }}</td></tr>
            <tr><th class="noborder nobg">Lokasi Pit</th><td class="noborder">: {{ $ogs->pit ?? '-' }}</td><th class="noborder nobg">Penanggung Jawab</th><td class="noborder">: {{ $ogs->nik_penanggungjawab ?? '-' }} | {{ $ogs->nama_penanggungjawab ?? '-' }}</td></tr>
        </table>
        <table class="point-table inspection-table">
            <thead><tr><th style="width:6%">No</th><th style="width:42%">Deskripsi Pemeriksaan</th><th style="width:10%">Kesesuaian</th><th style="width:27%">Tindak Lanjut Perbaikan</th><th style="width:15%">Due Date</th></tr></thead>
            <tbody>
                <tr class="section-row"><td class="center">A</td><td colspan="4"><strong>Geometri dan Konstruksi</strong></td></tr>
                <tr>
                    <td class="center">1</td>
                    <td>Terdapat tanggul di sekeliling area</td>
                    <td class="center">{{ $ogs->geometri_11_check }}</td>
                    <td>{{ $ogs->geometri_11_action }}</td>
                    <td class="center">{{ $ogs->geometri_11_due ? \Carbon\Carbon::parse($ogs->geometri_11_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Permukaan Base jalan rata</td>
                    <td class="center">{{ $ogs->geometri_12_check }}</td>
                    <td>{{ $ogs->geometri_12_action }}</td>
                    <td class="center">{{ $ogs->geometri_12_due ? \Carbon\Carbon::parse($ogs->geometri_12_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Permukaan tanah rata, maksimal grade 2% tidak ada cekungan di permukaan</td>
                    <td class="center">{{ $ogs->geometri_13_check }}</td>
                    <td>{{ $ogs->geometri_13_action }}</td>
                    <td class="center">{{ $ogs->geometri_13_due ? \Carbon\Carbon::parse($ogs->geometri_13_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Permukaan tanah tidak ada genangan air</td>
                    <td class="center">{{ $ogs->geometri_14_check }}</td>
                    <td>{{ $ogs->geometri_14_action }}</td>
                    <td class="center">{{ $ogs->geometri_14_due ? \Carbon\Carbon::parse($ogs->geometri_14_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Terdapat safety berm pada area yang terdapat perbedaan tinggi ≥ 0.5 meter</td>
                    <td class="center">{{ $ogs->geometri_15_check }}</td>
                    <td>{{ $ogs->geometri_15_action }}</td>
                    <td class="center">{{ $ogs->geometri_15_due ? \Carbon\Carbon::parse($ogs->geometri_15_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat area parkir / akses unit sarana / manhoul yang terpisah dengan alat berat</td>
                    <td class="center">{{ $ogs->geometri_16_check }}</td>
                    <td>{{ $ogs->geometri_16_action }}</td>
                    <td class="center">{{ $ogs->geometri_16_due ? \Carbon\Carbon::parse($ogs->geometri_16_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Lebar akses jalan masuk dan keluar memenuhi  minimal 2x lebar unit hauler terbesar</td>
                    <td class="center">{{ $ogs->geometri_17_check }}</td>
                    <td>{{ $ogs->geometri_17_action }}</td>
                    <td class="center">{{ $ogs->geometri_17_due ? \Carbon\Carbon::parse($ogs->geometri_17_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Terdapat drainase/ditch di sepanjang kaki tanggulan</td>
                    <td class="center">{{ $ogs->geometri_18_check }}</td>
                    <td>{{ $ogs->geometri_18_action }}</td>
                    <td class="center">{{ $ogs->geometri_18_due ? \Carbon\Carbon::parse($ogs->geometri_18_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Terdapat median di area keluar bila terdapat percabangan</td>
                    <td class="center">{{ $ogs->geometri_19_check }}</td>
                    <td>{{ $ogs->geometri_19_action }}</td>
                    <td class="center">{{ $ogs->geometri_19_due ? \Carbon\Carbon::parse($ogs->geometri_19_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr class="section-row"><td class="center">B</td><td colspan="4"><strong>Sarana dan Prasarana</strong></td></tr>
                <tr>
                    <td class="center">10</td>
                    <td>Terdapat tempat ( Kontainer / bangunan ) untuk istirahat yang memadai</td>
                    <td class="center">{{ $ogs->sarana_21_check }}</td>
                    <td>{{ $ogs->sarana_21_action }}</td>
                    <td class="center">{{ $ogs->sarana_21_due ? \Carbon\Carbon::parse($ogs->sarana_21_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Terdapat beda tinggi anatar tempat ( Kontainer / bangunan ) untuk istirahat dengan base unit</td>
                    <td class="center">{{ $ogs->sarana_22_check }}</td>
                    <td>{{ $ogs->sarana_22_action }}</td>
                    <td class="center">{{ $ogs->sarana_22_due ? \Carbon\Carbon::parse($ogs->sarana_22_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Terdapat tangga atau pijakan untuk akses naik turun di tempat ( Kontainer / bangunan ) Istirahat</td>
                    <td class="center">{{ $ogs->sarana_23_check }}</td>
                    <td>{{ $ogs->sarana_23_action }}</td>
                    <td class="center">{{ $ogs->sarana_23_due ? \Carbon\Carbon::parse($ogs->sarana_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Terdapat jamban / toilet yang memadai</td>
                    <td class="center">{{ $ogs->sarana_24_check }}</td>
                    <td>{{ $ogs->sarana_24_action }}</td>
                    <td class="center">{{ $ogs->sarana_24_due ? \Carbon\Carbon::parse($ogs->sarana_24_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Terdapat unit penerangan</td>
                    <td class="center">{{ $ogs->sarana_25_check }}</td>
                    <td>{{ $ogs->sarana_25_action }}</td>
                    <td class="center">{{ $ogs->sarana_25_due ? \Carbon\Carbon::parse($ogs->sarana_25_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">15</td>
                    <td>Ketersediaan air bersih laik minum</td>
                    <td class="center">{{ $ogs->sarana_26_check }}</td>
                    <td>{{ $ogs->sarana_26_action }}</td>
                    <td class="center">{{ $ogs->sarana_26_due ? \Carbon\Carbon::parse($ogs->sarana_26_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr class="section-row"><td class="center">C</td><td colspan="4"><strong>Keselamatan dan Lingkungan</strong></td></tr>
                <tr>
                    <td class="center">16</td>
                    <td>Terdapat APAR yang ditempatkan secara khusus dan standar</td>
                    <td class="center">{{ $ogs->keselamatan_31_check }}</td>
                    <td>{{ $ogs->keselamatan_31_action }}</td>
                    <td class="center">{{ $ogs->keselamatan_31_due ? \Carbon\Carbon::parse($ogs->keselamatan_31_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">17</td>
                    <td>Terdapat unit penyalur petir dengan tahanan maksimal 5 Ω</td>
                    <td class="center">{{ $ogs->keselamatan_32_check }}</td>
                    <td>{{ $ogs->keselamatan_32_action }}</td>
                    <td class="center">{{ $ogs->keselamatan_32_due ? \Carbon\Carbon::parse($ogs->keselamatan_32_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">18</td>
                    <td>Terdapat Eye Wash</td>
                    <td class="center">{{ $ogs->keselamatan_33_check }}</td>
                    <td>{{ $ogs->keselamatan_33_action }}</td>
                    <td class="center">{{ $ogs->keselamatan_33_due ? \Carbon\Carbon::parse($ogs->keselamatan_33_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">19</td>
                    <td>Terdapat tempat sampah 3 warna</td>
                    <td class="center">{{ $ogs->keselamatan_34_check }}</td>
                    <td>{{ $ogs->keselamatan_34_action }}</td>
                    <td class="center">{{ $ogs->keselamatan_34_due ? \Carbon\Carbon::parse($ogs->keselamatan_34_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">20</td>
                    <td>Terdapat wadah penyimpanan ceceran /tumpahan bahan B3 (Spill Kit)</td>
                    <td class="center">{{ $ogs->keselamatan_35_check }}</td>
                    <td>{{ $ogs->keselamatan_35_action }}</td>
                    <td class="center">{{ $ogs->keselamatan_35_due ? \Carbon\Carbon::parse($ogs->keselamatan_35_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">21</td>
                    <td>Terdapat area yang dikhususkan untuk penghijauan</td>
                    <td class="center">{{ $ogs->keselamatan_36_check }}</td>
                    <td>{{ $ogs->keselamatan_36_action }}</td>
                    <td class="center">{{ $ogs->keselamatan_36_due ? \Carbon\Carbon::parse($ogs->keselamatan_36_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr class="section-row"><td class="center">D</td><td colspan="4"><strong>Rambu Keselamatan</strong></td></tr>
                <tr>
                    <td class="center">22</td>
                    <td>Terdapat rambu informasi papan nama area OGS</td>
                    <td class="center">{{ $ogs->rambu_41_check }}</td>
                    <td>{{ $ogs->rambu_41_action }}</td>
                    <td class="center">{{ $ogs->rambu_41_due ? \Carbon\Carbon::parse($ogs->rambu_41_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">23</td>
                    <td>Terdapat papan informasi nama dan kontak Penanggung Jawab Area (PJA)</td>
                    <td class="center">{{ $ogs->rambu_42_check }}</td>
                    <td>{{ $ogs->rambu_42_action }}</td>
                    <td class="center">{{ $ogs->rambu_42_due ? \Carbon\Carbon::parse($ogs->rambu_42_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">24</td>
                    <td>Terdapat rambu wajib penggunaan APD</td>
                    <td class="center">{{ $ogs->rambu_43_check }}</td>
                    <td>{{ $ogs->rambu_43_action }}</td>
                    <td class="center">{{ $ogs->rambu_43_due ? \Carbon\Carbon::parse($ogs->rambu_43_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">25</td>
                    <td>Terdapat rambu informasi EMERGENCY MUSTER POINT</td>
                    <td class="center">{{ $ogs->rambu_44_check }}</td>
                    <td>{{ $ogs->rambu_44_action }}</td>
                    <td class="center">{{ $ogs->rambu_44_due ? \Carbon\Carbon::parse($ogs->rambu_44_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">26</td>
                    <td>Terdapat rambu peringatan jalur kabel bawah tanah</td>
                    <td class="center">{{ $ogs->rambu_45_check }}</td>
                    <td>{{ $ogs->rambu_45_action }}</td>
                    <td class="center">{{ $ogs->rambu_45_due ? \Carbon\Carbon::parse($ogs->rambu_45_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">27</td>
                    <td>Terdapat rambu informasi petunjuk arah akses ( Masuk keluar unit )</td>
                    <td class="center">{{ $ogs->rambu_46_check }}</td>
                    <td>{{ $ogs->rambu_46_action }}</td>
                    <td class="center">{{ $ogs->rambu_46_due ? \Carbon\Carbon::parse($ogs->rambu_46_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">28</td>
                    <td>Terdapat rambu batas kecepatan 15 Km/Jam di pintu masuk OGS</td>
                    <td class="center">{{ $ogs->rambu_47_check }}</td>
                    <td>{{ $ogs->rambu_47_action }}</td>
                    <td class="center">{{ $ogs->rambu_47_due ? \Carbon\Carbon::parse($ogs->rambu_47_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">29</td>
                    <td>Terdapat rambu chanel radio (jika menggunakan chanel khusus)</td>
                    <td class="center">{{ $ogs->rambu_48_check }}</td>
                    <td>{{ $ogs->rambu_48_action }}</td>
                    <td class="center">{{ $ogs->rambu_48_due ? \Carbon\Carbon::parse($ogs->rambu_48_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">30</td>
                    <td>Terdapat rambu-rambu batas parkir unit secara paralel dan seri</td>
                    <td class="center">{{ $ogs->rambu_49_check }}</td>
                    <td>{{ $ogs->rambu_49_action }}</td>
                    <td class="center">{{ $ogs->rambu_49_due ? \Carbon\Carbon::parse($ogs->rambu_49_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">31</td>
                    <td>Terdapat rambu area parkir sarana / Manhoul</td>
                    <td class="center">{{ $ogs->rambu_410_check }}</td>
                    <td>{{ $ogs->rambu_410_action }}</td>
                    <td class="center">{{ $ogs->rambu_410_due ? \Carbon\Carbon::parse($ogs->rambu_410_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">32</td>
                    <td>Terdapat rambu STOP di pintu keluar</td>
                    <td class="center">{{ $ogs->rambu_411_check }}</td>
                    <td>{{ $ogs->rambu_411_action }}</td>
                    <td class="center">{{ $ogs->rambu_411_due ? \Carbon\Carbon::parse($ogs->rambu_411_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">33</td>
                    <td>Terdapat rambu jalur lalu lintas satu arah</td>
                    <td class="center">{{ $ogs->rambu_412_check }}</td>
                    <td>{{ $ogs->rambu_412_action }}</td>
                    <td class="center">{{ $ogs->rambu_412_due ? \Carbon\Carbon::parse($ogs->rambu_412_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">34</td>
                    <td>Posisi Hauler parkir secara seri</td>
                    <td class="center">{{ $ogs->rambu_413_check }}</td>
                    <td>{{ $ogs->rambu_413_action }}</td>
                    <td class="center">{{ $ogs->rambu_413_due ? \Carbon\Carbon::parse($ogs->rambu_413_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">35</td>
                    <td>Terdapat rambu DILARANG MEMBUANG SAMPAH SEMBARANGAN</td>
                    <td class="center">{{ $ogs->rambu_414_check }}</td>
                    <td>{{ $ogs->rambu_414_action }}</td>
                    <td class="center">{{ $ogs->rambu_414_due ? \Carbon\Carbon::parse($ogs->rambu_414_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">36</td>
                    <td>Terdapat rambu unit hauler dilarang parkir mundur</td>
                    <td class="center">{{ $ogs->rambu_415_check }}</td>
                    <td>{{ $ogs->rambu_415_action }}</td>
                    <td class="center">{{ $ogs->rambu_415_due ? \Carbon\Carbon::parse($ogs->rambu_415_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">37</td>
                    <td>Terdapat rambu pengaktifan parking brake bagi hauler yang berhenti/parkir</td>
                    <td class="center">{{ $ogs->rambu_416_check }}</td>
                    <td>{{ $ogs->rambu_416_action }}</td>
                    <td class="center">{{ $ogs->rambu_416_due ? \Carbon\Carbon::parse($ogs->rambu_416_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
                <tr>
                    <td class="center">38</td>
                    <td>Terdapat rambu jam keluar masuk OGS</td>
                    <td class="center">{{ $ogs->rambu_417_check }}</td>
                    <td>{{ $ogs->rambu_417_action }}</td>
                    <td class="center">{{ $ogs->rambu_417_due ? \Carbon\Carbon::parse($ogs->rambu_417_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{{ $ogs->additional_notes ?? '' }}</p>
        <table class="point-table inspection-table" style="margin-top: 12px;">
            <thead><tr><th>No</th><th>Nama Inspektor</th><th>NIK</th><th>Jabatan</th><th>Tertanda</th></tr></thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                    <tr>
                        <td class="center">{{ $i }}</td>
                        <td>{{ $i === 5 ? ($ogs->inspektor5 ?? '-') : data_get($ogs, 'nama_inspektor'.$i, '-') }}</td>
                        <td class="center">{{ $i === 5 ? '-' : data_get($ogs, 'nik_inspektor'.$i, '-') }}</td>
                        <td>{{ $i === 5 ? '-' : data_get($ogs, 'jabatan_inspektor'.$i, '-') }}</td>
                        <td class="center">@if (data_get($ogs, 'verified_inspektor'.$i))<img src="{{ data_get($ogs, 'verified_inspektor'.$i) }}" style="max-width: 70px; max-height: 55px;">@endif</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($ogs, 'dokumentasi_1');
            $photoTwo = data_get($ogs, 'dokumentasi_2');
            $resolveOgsPhoto = function ($path) {
                if (empty($path)) return null;
                if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) return $path;
                if (strpos($path, '/storage/') === 0) return asset(ltrim($path, '/'));
                if (strpos($path, 'storage/') === 0) return asset($path);
                return asset('storage/' . ltrim($path, '/'));
            };
            $photoOneUrl = $resolveOgsPhoto($photoOne);
            $photoTwoUrl = $resolveOgsPhoto($photoTwo);
        @endphp
        <table class="klkh-photo-header">
            <tr>
                <td><img src="{{ asset('dashboard/assets/images/logo-full.png') }}" style="width: 220px;" alt="Logo"></td>
                <td style="text-align: right;">FM-SE-03/01/23/09/26</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO INSPEKSI AREA OGS</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi Pit</strong></td>
                <td>: {{ $ogs->pit ?? '-' }}</td>
                <td><strong>Nama Lokasi</strong></td>
                <td>: {{ $ogs->nama_lokasi ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal</strong></td>
                <td>: {{ !empty($ogs->tanggal_inspeksi) ? Carbon::parse($ogs->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') : '-' }}</td>
                <td><strong>Penanggung Jawab</strong></td>
                <td>: {{ $ogs->nama_penanggungjawab ?? '-' }}</td>
            </tr>
        </table>
        <div class="klkh-photo-grid">
            <div class="klkh-photo-item">
                <strong>Dokumentasi Foto 1</strong>
                @if ($photoOneUrl)
                    <img src="{{ $photoOneUrl }}" alt="Dokumentasi Foto 1">
                @else
                    <div class="klkh-photo-empty">Foto 1 belum tersedia</div>
                @endif
            </div>
            <div class="klkh-photo-item">
                <strong>Dokumentasi Foto 2</strong>
                @if ($photoTwoUrl)
                    <img src="{{ $photoTwoUrl }}" alt="Dokumentasi Foto 2">
                @else
                    <div class="klkh-photo-empty">Foto 2 belum tersedia</div>
                @endif
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>
</html>
