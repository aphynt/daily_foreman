<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Workshop LV & Support</title>
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-WS-67/02/17/03/24</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN WORKSHOP LV DAN SUPPORT</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $lv->lokasi }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($lv->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($lv->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                    <th class="center">A</th><th>Bangunan dan Fasilitas</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Struktur bangunan kokoh, Lantai diconcreat dan beratap.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Tinggi bangunan sesuai dengan kendaraan yang diservice.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Terdapat Rak sparepart, SOP dan buku service.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Terdapat rak peralatan kerja.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td><td>Jumlah dan standard ganjal, Loto.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_5_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_5_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_5_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td><td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_6_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_6_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_6_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td><td>Lampu emergency berfungsi dengan baik.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_7_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_7_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_7_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_7_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td><td>Denah evakuasi ditempel dengan jelas.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_8_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_8_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_8_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_8_note }}</td>
                </tr>
                <tr>
                    <td class="center">9</td><td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_9_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_9_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bangunan_fasilitas_9_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bangunan_fasilitas_9_note }}</td>
                </tr>
                <tr><th class="center">B</th><th>Lantai Kerja</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Bersih, Tidak ada tanah, Tidak becek.</td>
                    <td class="center">{!! $lv->lantai_kerja_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->lantai_kerja_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->lantai_kerja_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->lantai_kerja_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Tidak ada ceceran oli.</td>
                    <td class="center">{!! $lv->lantai_kerja_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->lantai_kerja_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->lantai_kerja_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->lantai_kerja_2_note }}</td>
                </tr>
                <tr><th class="center">C</th><th>Peralatan Kerja</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Ditata dengan rapi, Tidak berserakan.</td>
                    <td class="center">{!! $lv->peralatan_kerja_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->peralatan_kerja_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->peralatan_kerja_1_note }}</td>
                </tr>
                <tr><th class="center">D</th><th>Loto</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Dipasang pada saat peralatan mesin diservice.</td>
                    <td class="center">{!! $lv->loto_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->loto_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->loto_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->loto_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                    <td class="center">{!! $lv->loto_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->loto_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->loto_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->loto_2_note }}</td>
                </tr>
                <tr><th class="center">E</th><th>Sparepart Bekas (bisa dipakai)</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Dirapikan dan dikelompokkan.</td>
                    <td class="center">{!! $lv->sparepart_bekas_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sparepart_bekas_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sparepart_bekas_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->sparepart_bekas_1_note }}</td>
                </tr>
                <tr><th class="center">F</th><th>Selang Angin</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Berkualitas baik dan tanpa sambungan.</td>
                    <td class="center">{!! $lv->selang_angin_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->selang_angin_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->selang_angin_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->selang_angin_1_note }}</td>
                </tr>
                <tr><th class="center">G</th><th>Compressor</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Selang angin berkualitas baik, tanpa sambungan.</td>
                    <td class="center">{!! $lv->compressor_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->compressor_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->compressor_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->compressor_1_note }}</td>
                </tr>
                <tr><th class="center">H</th><th>Electric</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Kabel tidak terkelupas.</td>
                    <td class="center">{!! $lv->electric_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->electric_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Kabel berkualitas baik.</td>
                    <td class="center">{!! $lv->electric_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->electric_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                    <td class="center">{!! $lv->electric_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->electric_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Energi listrik menyala tanpa aktivitas.</td>
                    <td class="center">{!! $lv->electric_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->electric_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->electric_4_note }}</td>
                </tr>
                <tr><th class="center">I</th><th>Bongkar Mesin / Sparepart</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Memiliki tempat mencuci yang memadai.</td>
                    <td class="center">{!! $lv->bongkar_mesin_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bongkar_mesin_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->bongkar_mesin_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->bongkar_mesin_1_note }}</td>
                </tr>
                <tr><th class="center">J</th><th>APAR</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Jumlahnya memadai.</td>
                    <td class="center">{!! $lv->apar_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->apar_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{!! $lv->apar_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->apar_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Tekanan APAR normal.</td>
                    <td class="center">{!! $lv->apar_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->apar_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Isi APAR normal.</td>
                    <td class="center">{!! $lv->apar_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->apar_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->apar_4_note }}</td>
                </tr>
                <tr><th class="center">K</th><th>Rambu-rambu Bahaya</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Dilarang menyalakan api / merokok.</td>
                    <td class="center">{!! $lv->rambu_bahaya_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->rambu_bahaya_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->rambu_bahaya_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Instruksi / gambar APD yang harus digunakan.</td>
                    <td class="center">{!! $lv->rambu_bahaya_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->rambu_bahaya_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->rambu_bahaya_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->rambu_bahaya_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Larangan penggunaan selang angin sembarangan.</td>
                    <td class="center">{!! $lv->rambu_bahaya_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->rambu_bahaya_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->rambu_bahaya_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->rambu_bahaya_3_note }}</td>
                </tr>
                <tr><th class="center">L</th><th>Tempat Parkir Kendaraan</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Rata, tidak becek, tidak ada ceceran oli.</td>
                    <td class="center">{!! $lv->tempat_parkir_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->tempat_parkir_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->tempat_parkir_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->tempat_parkir_1_note }}</td>
                </tr>
                <tr><th class="center">M</th><th>Besi Scrap</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Ditempatkan minimal 200 meter dari area workshop.</td>
                    <td class="center">{!! $lv->besi_scrap_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->besi_scrap_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->besi_scrap_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->besi_scrap_1_note }}</td>
                </tr>
                <tr><th class="center">N</th><th>Tempat Sampah Domestik</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                    <td class="center">{!! $lv->sampah_domestik_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sampah_domestik_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sampah_domestik_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->sampah_domestik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                    <td class="center">{!! $lv->sampah_domestik_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sampah_domestik_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sampah_domestik_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->sampah_domestik_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Sampah dibuang ke tempat pembuangan sampah.</td>
                    <td class="center">{!! $lv->sampah_domestik_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sampah_domestik_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->sampah_domestik_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->sampah_domestik_3_note }}</td>
                </tr>
                <tr><th class="center">O</th><th>Oil Trap</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Volume dan fungsi oil trap terkontrol.</td>
                    <td class="center">{!! $lv->oil_trap_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->oil_trap_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Bagian atas ditutup sehingga air hujan tidak masuk.</td>
                    <td class="center">{!! $lv->oil_trap_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->oil_trap_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Air hujan tidak masuk ke paret oil trap.</td>
                    <td class="center">{!! $lv->oil_trap_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->oil_trap_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Komparment ke-3 tidak mengandung minyak atau oli.</td>
                    <td class="center">{!! $lv->oil_trap_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->oil_trap_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->oil_trap_4_note }}</td>
                </tr>
                <tr><th class="center">P</th><th>Pemadam Hydran</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Tempat hose air mudah dibuka.</td>
                    <td class="center">{!! $lv->pemadam_hydran_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->pemadam_hydran_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Kran air berfungsi dengan baik.</td>
                    <td class="center">{!! $lv->pemadam_hydran_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->pemadam_hydran_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Pompa air berfungsi dengan baik.</td>
                    <td class="center">{!! $lv->pemadam_hydran_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->pemadam_hydran_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Kapasitas air memadai.</td>
                    <td class="center">{!! $lv->pemadam_hydran_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pemadam_hydran_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->pemadam_hydran_4_note }}</td>
                </tr>
                <tr><th class="center">Q</th><th>Limbah B3</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Limbah oli, limbah solar, limbah filter dan majun terkontaminasi oli / grease dikelola dengan baik.</td>
                    <td class="center">{!! $lv->limbah_b3_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->limbah_b3_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->limbah_b3_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->limbah_b3_1_note }}</td>
                </tr>
                <tr><th class="center">R</th><th>CT 50 Ton / CT 100 Ton / Manitou</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->ct_manutou_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ct_manutou_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ct_manutou_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->ct_manutou_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->ct_manutou_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ct_manutou_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ct_manutou_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->ct_manutou_2_note }}</td>
                </tr>
                <tr><th class="center">S</th><th>FT / ST / WT</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->ft_st_wt_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ft_st_wt_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ft_st_wt_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->ft_st_wt_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->ft_st_wt_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ft_st_wt_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->ft_st_wt_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->ft_st_wt_2_note }}</td>
                </tr>
                <tr><th class="center">T</th><th>FORKLIFT</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->forklift_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->forklift_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->forklift_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->forklift_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->forklift_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->forklift_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->forklift_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->forklift_2_note }}</td>
                </tr>
                <tr><th class="center">U</th><th>TYRE HANDLER</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->tyre_handler_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->tyre_handler_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->tyre_handler_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->tyre_handler_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                    <td class="center">{!! $lv->tyre_handler_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->tyre_handler_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->tyre_handler_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->tyre_handler_2_note }}</td>
                </tr>
                <tr><th class="center">V</th><th>Pengguna LV</th><th></th><th></th><th></th><th></th></tr>
                <tr>
                    <td class="center">1</td><td>Form kesiapan kerja untuk pengguna LV.</td>
                    <td class="center">{!! $lv->pengguna_lv_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pengguna_lv_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $lv->pengguna_lv_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $lv->pengguna_lv_1_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $lv->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Mengetahui</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($lv->verified_pengawas != null)<img src="{{ $lv->verified_pengawas }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($lv->verified_diketahui != null)<img src="{{ $lv->verified_diketahui }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $lv->nama_pengawas ? $lv->nama_pengawas : '.......................' }}</td>
                    <td class="noborder nobg">{{ $lv->nama_diketahui ? $lv->nama_diketahui : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $lv->catatan_verified_pengawas != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $lv->catatan_verified_pengawas
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $lv->catatan_verified_diketahui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $lv->catatan_verified_diketahui
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($lv, 'dokumentasi_1') ?: data_get($lv, 'dokumentasi_foto_1') ?: data_get($lv, 'foto_1');
            $photoTwo = data_get($lv, 'dokumentasi_2') ?: data_get($lv, 'dokumentasi_foto_2') ?: data_get($lv, 'foto_2');
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
                <td style="text-align: right;">FM-WS-67/02/17/03/24</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH WORKSHOP LV & SUPPORT</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $lv->lokasi }}</td>
            </tr>
            <tr>
                <td><strong>Hari/Tanggal</strong></td>
                <td>: {{ Carbon::parse($lv->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td><strong>Jam</strong></td>
                <td>: {{ Carbon::parse($lv->time)->locale('id')->isoFormat('HH:mm') }}</td>
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
