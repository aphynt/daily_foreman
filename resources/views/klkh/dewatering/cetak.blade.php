<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Dewatering</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/fonts/fontawesome.css">
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }
        body {
            font-family: Arial, sans-serif;
            /* line-height: 1.6; */
            font-size: 12px;
        }
        .container {
            width: 100%;
        }
        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg" style="padding: 0px; margin-bottom: 0px"><img src="{{ asset('dashboard/assets') }}/images/logo-full.png" width="240px"></th>
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-DEW-11/00/08/05/25</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN DEWATERING</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $ab->lokasi }}</th>
                    <th class="noborder nobg">Perusahaan</th>
                    <th class="noborder nobg">: {{ $ab->perusahaan }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($ab->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($ab->time)->locale('id')->isoFormat('HH:mm') }}</th>
                </tr>
                <tr>
                    <th class="center" rowspan="2">No</th>
                    <th class="center" rowspan="2">Point Yang Diperiksa</th>
                    <th class="center" colspan="3" style="text-align: center;">Cek</th>
                    <th class="center" rowspan="2">Keterangan</th>
                </tr>
                <tr>
                    <th class="center">Ya</th>
                    <th class="center">Tidak</th>
                    <th class="center">N/A</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="center">A</th>
                    <th>AREA POMPA PRIMER</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th class="center">1</th>
                    <th>Akses Jalan Menuju Sump</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1.1</td>
                    <td>Akses jalan menuju sump aman &amp; memadai.</td>
                    <td class="center">{{ $ab->primer_1_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_1_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_1_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_1_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">1.2</td>
                    <td>Tersedia area parkir.</td>
                    <td class="center">{{ $ab->primer_1_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_1_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_1_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_1_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">2</th>
                    <th>Akses Pekerja ke Tepi Sump</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">2.1</td>
                    <td>Tersedia tangga dilengkapi dengan handrail untuk area yang terdapat beda tinggi.</td>
                    <td class="center">{{ $ab->primer_2_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_2_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_2_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_2_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">3</th>
                    <th>Akses Pekerja ke Pompa</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">3.1</td>
                    <td>Tersedia perahu dilengkapi dengan informasi maksimum SWL &amp; Person.</td>
                    <td class="center">{{ $ab->primer_3_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_3_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.2</td>
                    <td>Perahu tersedia 2 dayung.</td>
                    <td class="center">{{ $ab->primer_3_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_3_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.3</td>
                    <td>Perahu layak digunakan (tidak menampung air, tidak bocor/rusak, tidak berubah bentuk).</td>
                    <td class="center">{{ $ab->primer_3_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_3_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.4</td>
                    <td>Tersedia tali sebagai pengikat.</td>
                    <td class="center">{{ $ab->primer_3_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_3_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.5</td>
                    <td>Tersedia kubus apung lebar 1,5 meter, handrail dilengkapi dengan tali.</td>
                    <td class="center">{{ $ab->primer_3_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_3_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.6</td>
                    <td>Akses tersambung dari darat hingga pompa.</td>
                    <td class="center">{{ $ab->primer_3_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_3_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_3_6_note }}</td>
                </tr>
                    <tr>
                    <th class="center">4</th>
                    <th>Pondok</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">4.1</td>
                    <td>Pondok (tertutup) berada di darat.</td>
                    <td class="center">{{ $ab->primer_4_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_4_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">4.2</td>
                    <td>Tersedia penerangan yang memadai.</td>
                    <td class="center">{{ $ab->primer_4_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_4_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">4.3</td>
                    <td>Tersedia toilet dengan air bersih.</td>
                    <td class="center">{{ $ab->primer_4_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_4_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4.4</td>
                    <td>Tersedia tempat sampah tertutup.</td>
                    <td class="center">{{ $ab->primer_4_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_4_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_4_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">5</th>
                    <th>Rambu &amp; Papan Informasi</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">5.1</td>
                    <td>Tersedia rambu/papan informasi area sump &amp; area terbatas.</td>
                    <td class="center">{{ $ab->primer_5_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_5_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.2</td>
                    <td>Tersedia rambu informasi PIC area (Nama, No. telepon).</td>
                    <td class="center">{{ $ab->primer_5_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_5_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.3</td>
                    <td>Tersedia rambu wajib APD (termasuk pelampung).</td>
                    <td class="center">{{ $ab->primer_5_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_5_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.4</td>
                    <td>Tersedia rambu channel radio.</td>
                    <td class="center">{{ $ab->primer_5_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_5_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.5</td>
                    <td>Tersedia rambu emergency call.</td>
                    <td class="center">{{ $ab->primer_5_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_5_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.6</td>
                    <td>Tersedia rambu evakuasi dan muster point.</td>
                    <td class="center">{{ $ab->primer_5_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_5_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.7</td>
                    <td>Tersedia papan informasi sump (Elevasi air, lumpur, &amp; banjir).</td>
                    <td class="center">{{ $ab->primer_5_7_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_7_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_5_7_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_5_7_note }}</td>
                </tr>
                <tr>
                    <th class="center">6</th>
                    <th>Pompa</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">6.1</td>
                    <td>Dilakukan inspeksi pompa secara rutin dan tersedia tagging kelayakan pompa.</td>
                    <td class="center">{{ $ab->primer_6_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_6_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">6.2</td>
                    <td>Pompa dilengkapi tali penambat dan posisi pompa stabil.</td>
                    <td class="center">{{ $ab->primer_6_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_6_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">6.3</td>
                    <td>Telah dilakukan housekeeping area dengan baik.</td>
                    <td class="center">{{ $ab->primer_6_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_6_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">6.4</td>
                    <td>Tersedia ring buoy dengan tali minimal 30 meter.</td>
                    <td class="center">{{ $ab->primer_6_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_6_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">6.5</td>
                    <td>Akses tangga pompa.</td>
                    <td class="center">{{ $ab->primer_6_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_6_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6.6</td>
                    <td>Akses tangga ponton.</td>
                    <td class="center">{{ $ab->primer_6_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_6_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_6_6_note }}</td>
                </tr>
                <tr>
                    <th class="center">7</th>
                    <th>Personil</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">7.1</td>
                    <td>Memiliki izin kerja di atas air.</td>
                    <td class="center">{{ $ab->primer_7_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_7_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_7_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_7_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">7.2</td>
                    <td>KKH.</td>
                    <td class="center">{{ $ab->primer_7_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_7_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_7_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_7_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">7.3</td>
                    <td>Operator telah melakukan P2H unit pompa.</td>
                    <td class="center">{{ $ab->primer_7_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_7_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_7_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_7_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">8</th>
                    <th>Perlengkapan Keselamatan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">8.1</td>
                    <td>Tersedia CCTV.</td>
                    <td class="center">{{ $ab->primer_8_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.2</td>
                    <td>Tersedia penyalur petir.</td>
                    <td class="center">{{ $ab->primer_8_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.3</td>
                    <td>Tersedia kotak P3K.</td>
                    <td class="center">{{ $ab->primer_8_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.4</td>
                    <td>Tersedia eyewash.</td>
                    <td class="center">{{ $ab->primer_8_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.5</td>
                    <td>Tersedia Emergency Escape Plan.</td>
                    <td class="center">{{ $ab->primer_8_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.6</td>
                    <td>Tersedia Working Vest (minimal +1 dari total pekerja).</td>
                    <td class="center">{{ $ab->primer_8_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.7</td>
                    <td>Tersedia radio komunikasi.</td>
                    <td class="center">{{ $ab->primer_8_7_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_7_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_7_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_7_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.8</td>
                    <td>Tersedia earmuff/earplug sesuai hasil pengukuran kebisingan.</td>
                    <td class="center">{{ $ab->primer_8_8_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_8_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_8_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_8_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.9</td>
                    <td>Tersedia penerangan personal.</td>
                    <td class="center">{{ $ab->primer_8_9_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_9_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_9_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_9_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.10</td>
                    <td>Tersedia Spill Kit (Absorbent).</td>
                    <td class="center">{{ $ab->primer_8_10_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_10_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->primer_8_10_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->primer_8_10_note }}</td>
                </tr>
                <tr>
                    <th class="center">B</th>
                    <th>AREA POMPA BOOSTER</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th class="center">1</th>
                    <th>Akses Jalan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1.1</td>
                    <td>Akses jalan menuju pompa aman &amp; memadai.</td>
                    <td class="center">{{ $ab->booster_1_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_1_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_1_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_1_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">2</th>
                    <th>Rambu &amp; Papan Informasi</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">2.1</td>
                    <td>Tersedia rambu/papan informasi area pompa.</td>
                    <td class="center">{{ $ab->booster_2_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_2_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2.2</td>
                    <td>Tersedia rambu informasi PIC area (Nama, No. telepon).</td>
                    <td class="center">{{ $ab->booster_2_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_2_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">2.3</td>
                    <td>Tersedia rambu wajib APD.</td>
                    <td class="center">{{ $ab->booster_2_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_2_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">2.4</td>
                    <td>Tersedia rambu channel radio.</td>
                    <td class="center">{{ $ab->booster_2_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_2_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">2.5</td>
                    <td>Tersedia rambu emergency call.</td>
                    <td class="center">{{ $ab->booster_2_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_2_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">2.6</td>
                    <td>Tersedia rambu evakuasi dan muster point.</td>
                    <td class="center">{{ $ab->booster_2_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_2_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_2_6_note }}</td>
                </tr>
                <tr>
                    <th class="center">3</th>
                    <th>Pompa</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">3.1</td>
                    <td>Dilakukan inspeksi pompa secara rutin dan tersedia tagging kelayakan pompa.</td>
                    <td class="center">{{ $ab->booster_3_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_3_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.2</td>
                    <td>Posisi pompa stabil.</td>
                    <td class="center">{{ $ab->booster_3_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_3_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.3</td>
                    <td>Telah dilakukan housekeeping area dengan baik.</td>
                    <td class="center">{{ $ab->booster_3_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_3_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.4</td>
                    <td>Akses tangga pompa tersedia &amp; memadai.</td>
                    <td class="center">{{ $ab->booster_3_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_3_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_3_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">4</th>
                    <th>Personil</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">4.1</td>
                    <td>Operator mengisi KKH sesuai ketentuan.</td>
                    <td class="center">{{ $ab->booster_4_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_4_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_4_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_4_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">4.2</td>
                    <td>Operator telah melakukan P2H unit pompa.</td>
                    <td class="center">{{ $ab->booster_4_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_4_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_4_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_4_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">5</th>
                    <th>Perlengkapan Keselamatan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">5.1</td>
                    <td>Tersedia Emergency Escape Plan.</td>
                    <td class="center">{{ $ab->booster_5_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_5_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.2</td>
                    <td>Tersedia radio komunikasi.</td>
                    <td class="center">{{ $ab->booster_5_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_5_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.3</td>
                    <td>Tersedia earmuff/earplug sesuai hasil pengukuran kebisingan.</td>
                    <td class="center">{{ $ab->booster_5_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_5_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.4</td>
                    <td>Tersedia penerangan personal.</td>
                    <td class="center">{{ $ab->booster_5_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_5_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.5</td>
                    <td>Tersedia Spill Kit (Absorbent).</td>
                    <td class="center">{{ $ab->booster_5_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->booster_5_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->booster_5_5_note }}</td>
                </tr>
                <tr>
                    <th class="center">C</th>
                    <th>JALUR INSTALASI PIPA HDPE</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th class="center">1</th>
                    <th>Jalur Inspeksi</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1.1</td>
                    <td>Terdapat jalur inspeksi yang aman.</td>
                    <td class="center">{{ $ab->hdpe_1_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_1_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_1_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->hdpe_1_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">2</th>
                    <th>Area Jalur Pipa</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">2.1</td>
                    <td>Area aman dari longsor.</td>
                    <td class="center">{{ $ab->hdpe_2_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_2_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_2_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->hdpe_2_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2.2</td>
                    <td>Tidak berada pada area risiko swabakar batubara.</td>
                    <td class="center">{{ $ab->hdpe_2_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_2_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_2_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->hdpe_2_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">2.3</td>
                    <td>Jarak aman jalur pipa 30 m dari area loading point.</td>
                    <td class="center">{{ $ab->hdpe_2_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_2_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_2_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->hdpe_2_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">3</th>
                    <th>Pipa</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">3.1</td>
                    <td>Terdapat rambu/papan informasi pada pipa yang tertanam.</td>
                    <td class="center">{{ $ab->hdpe_3_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_3_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_3_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->hdpe_3_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.2</td>
                    <td>Kedalaman pipa yang ditanam minimal 2 meter.</td>
                    <td class="center">{{ $ab->hdpe_3_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_3_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_3_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->hdpe_3_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3.3</td>
                    <td>Tidak ada kebocoran pada pipa dan atau sambungan pipa.</td>
                    <td class="center">{{ $ab->hdpe_3_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_3_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->hdpe_3_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->hdpe_3_3_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $ab->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Dilaksanakan</td>
                    <td class="noborder nobg">Diperiksa</td>
                    <td class="noborder nobg">Disetujui</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($ab->verified_pengawas != null)<img src="{{ $ab->verified_pengawas }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($ab->verified_diketahui != null)<img src="{{ $ab->verified_diketahui }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($ab->verified_disetujui != null)<img src="{{ $ab->verified_disetujui }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $ab->nama_pengawas ? $ab->nama_pengawas : '.......................' }}</td>
                    <td class="noborder nobg">{{ $ab->nama_diketahui ? $ab->nama_diketahui : '.......................' }}</td>
                    <td class="noborder nobg">{{ $ab->nama_disetujui ? $ab->nama_disetujui : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $ab->catatan_verified_pengawas != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $ab->catatan_verified_pengawas
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $ab->catatan_verified_diketahui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $ab->catatan_verified_diketahui
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $ab->catatan_verified_disetujui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $ab->catatan_verified_disetujui
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($ab, 'dokumentasi_1') ?: data_get($ab, 'dokumentasi_foto_1') ?: data_get($ab, 'foto_1');
            $photoTwo = data_get($ab, 'dokumentasi_2') ?: data_get($ab, 'dokumentasi_foto_2') ?: data_get($ab, 'foto_2');
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
                <td style="text-align: right;">FM-DEW-11/00/08/05/25</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH DEWATERING</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $ab->lokasi }}</td>
                <td><strong>Perusahaan</strong></td>
                <td>: {{ $ab->perusahaan }}</td>
            </tr>
            <tr>
                <td><strong>Hari/Tanggal</strong></td>
                <td>: {{ Carbon::parse($ab->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td><strong>Jam</strong></td>
                <td>: {{ Carbon::parse($ab->time)->locale('id')->isoFormat('HH:mm') }}</td>
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
