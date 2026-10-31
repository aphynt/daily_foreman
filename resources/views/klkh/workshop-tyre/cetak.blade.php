<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Workshop Tyre</title>
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-WS-69/01/17/03/24</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN WORKSHOP TYRE</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $tr->lokasi }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($tr->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($tr->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                <!-- 1. Bangunan dan Fasilitas -->
                <tr>
                    <th class="center">1</th>
                    <th>Bangunan dan Fasilitas</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Struktur bangunan kokoh, lantai diconcreat dan beratap.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Tinggi bangunan sesuai dengan kendaraan yang diservice.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Terdapat tempat arsip (untuk SOP, JSA).</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Terdapat ruang tools room yang memadai.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Jumlah dan standar ganjal, Loto, penopang A2B memadai.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Lampu emergency berfungsi dengan baik.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_7_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_7_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_7_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_7_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Denah evakuasi ditempel dengan jelas.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_8_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_8_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_8_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_8_note }}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_9_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_9_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bangunan_fasilitas_9_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bangunan_fasilitas_9_note }}</td>
                </tr>
                <!-- 2. Tempat Kerja -->
                <tr>
                    <th class="center">2</th>
                    <th>Tempat Kerja</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Ada tempat khusus dan rata.</td>
                    <td class="center">{{ $tr->tempat_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->tempat_kerja_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Fasilitas bongkar pasang ban (wheel loader).</td>
                    <td class="center">{{ $tr->tempat_kerja_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->tempat_kerja_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Penjepit untuk pemompaan ban.</td>
                    <td class="center">{{ $tr->tempat_kerja_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->tempat_kerja_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Pengukur tekanan angin.</td>
                    <td class="center">{{ $tr->tempat_kerja_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->tempat_kerja_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Tidak ada ceceran oli.</td>
                    <td class="center">{{ $tr->tempat_kerja_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->tempat_kerja_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->tempat_kerja_5_note }}</td>
                </tr>
                <!-- 3. Peralatan Kerja -->
                <tr>
                    <th class="center">3</th>
                    <th>Peralatan Kerja</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Ditata dengan rapi, tidak berserakan.</td>
                    <td class="center">{{ $tr->peralatan_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->peralatan_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->peralatan_kerja_1_note }}</td>
                </tr>
                <!-- 4. Sistem Loto -->
                <tr>
                    <th class="center">4</th>
                    <th>Sistem Loto</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dipasang pada saat bongkar-pasang tyre.</td>
                    <td class="center">{{ $tr->sistem_loto_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sistem_loto_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sistem_loto_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->sistem_loto_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                    <td class="center">{{ $tr->sistem_loto_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sistem_loto_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sistem_loto_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->sistem_loto_2_note }}</td>
                </tr>
                <!-- 5. Selang Angin -->
                <tr>
                    <th class="center">5</th>
                    <th>Selang Angin</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Berkualitas baik dan tanpa sambungan.</td>
                    <td class="center">{{ $tr->selang_angin_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->selang_angin_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->selang_angin_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->selang_angin_1_note }}</td>
                </tr>
                <!-- 6. Electric -->
                <tr>
                    <th class="center">6</th>
                    <th>Electric</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kabel tidak terkelupas.</td>
                    <td class="center">{{ $tr->electric_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->electric_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Kabel berkualitas baik.</td>
                    <td class="center">{{ $tr->electric_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->electric_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                    <td class="center">{{ $tr->electric_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->electric_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Energi listrik menyala tanpa aktivitas.</td>
                    <td class="center">{{ $tr->electric_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->electric_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->electric_4_note }}</td>
                </tr>
                <!-- 7. Compressor -->
                <tr>
                    <th class="center">7</th>
                    <th>Compressor</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Tabung compressor memiliki petunjuk tekanan angin.</td>
                    <td class="center">{{ $tr->compressor_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->compressor_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->compressor_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->compressor_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Selang angin berkualitas baik, tanpa sambungan.</td>
                    <td class="center">{{ $tr->compressor_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->compressor_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->compressor_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->compressor_2_note }}</td>
                </tr>
                <!-- 8. Bongkar Sparepart -->
                <tr>
                    <th class="center">8</th>
                    <th>Bongkar Sparepart</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Memiliki tempat mencuci yang memadai.</td>
                    <td class="center">{{ $tr->bongkar_sparepart_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bongkar_sparepart_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->bongkar_sparepart_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->bongkar_sparepart_1_note }}</td>
                </tr>
                <!-- 9. APAR -->
                <tr>
                    <th class="center">9</th>
                    <th>APAR</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Jumlahnya memadai.</td>
                    <td class="center">{{ $tr->apar_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->apar_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{{ $tr->apar_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->apar_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tekanan APAR normal.</td>
                    <td class="center">{{ $tr->apar_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->apar_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Isi APAR normal.</td>
                    <td class="center">{{ $tr->apar_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->apar_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->apar_4_note }}</td>
                </tr>
                <!-- 10. Rambu-rambu Bahaya -->
                <tr>
                    <th class="center">10</th>
                    <th>Rambu-rambu Bahaya</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dilarang menyalakan api / merokok.</td>
                    <td class="center">{{ $tr->rambu_bahaya_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->rambu_bahaya_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->rambu_bahaya_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Instruksi / gambar APD yang harus digunakan.</td>
                    <td class="center">{{ $tr->rambu_bahaya_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->rambu_bahaya_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->rambu_bahaya_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->rambu_bahaya_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Larangan penggunaan selang angin sembarangan.</td>
                    <td class="center">{{ $tr->rambu_bahaya_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->rambu_bahaya_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->rambu_bahaya_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->rambu_bahaya_3_note }}</td>
                </tr>
                <!-- 11. Tempat Sampah Domestik -->
                <tr>
                    <th class="center">11</th>
                    <th>Tempat Sampah Domestik</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                    <td class="center">{{ $tr->sampah_domestik_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sampah_domestik_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sampah_domestik_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->sampah_domestik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                    <td class="center">{{ $tr->sampah_domestik_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sampah_domestik_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sampah_domestik_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->sampah_domestik_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                    <td class="center">{{ $tr->sampah_domestik_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sampah_domestik_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->sampah_domestik_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->sampah_domestik_3_note }}</td>
                </tr>
                <!-- 12. Ban Bekas -->
                <tr>
                    <th class="center">12</th>
                    <th>Ban Bekas</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Ditempatkan pada tempat terpisah dari tire baru dan disusun.</td>
                    <td class="center">{{ $tr->ban_bekas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->ban_bekas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->ban_bekas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->ban_bekas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Memiliki catatan keluar-masuk ban bekas.</td>
                    <td class="center">{{ $tr->ban_bekas_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->ban_bekas_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->ban_bekas_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->ban_bekas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Ban bekas tidak dibakar atau dibuang ke waste dump.</td>
                    <td class="center">{{ $tr->ban_bekas_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->ban_bekas_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $tr->ban_bekas_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $tr->ban_bekas_3_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $tr->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Mengetahui</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($tr->verified_pengawas != null)<img src="{{ $tr->verified_pengawas }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($tr->verified_diketahui != null)<img src="{{ $tr->verified_diketahui }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $tr->nama_pengawas ? $tr->nama_pengawas : '.......................' }}</td>
                    <td class="noborder nobg">{{ $tr->nama_diketahui ? $tr->nama_diketahui : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $tr->catatan_verified_pengawas != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $tr->catatan_verified_pengawas
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $tr->catatan_verified_diketahui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $tr->catatan_verified_diketahui
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($tr, 'dokumentasi_1') ?: data_get($tr, 'dokumentasi_foto_1') ?: data_get($tr, 'foto_1');
            $photoTwo = data_get($tr, 'dokumentasi_2') ?: data_get($tr, 'dokumentasi_foto_2') ?: data_get($tr, 'foto_2');
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
                <td style="text-align: right;">FM-WS-69/01/17/03/24</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH WORKSHOP TYRE</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $tr->lokasi }}</td>
            </tr>
            <tr>
                <td><strong>Hari/Tanggal</strong></td>
                <td>: {{ Carbon::parse($tr->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td><strong>Jam</strong></td>
                <td>: {{ Carbon::parse($tr->time)->locale('id')->isoFormat('HH:mm') }}</td>
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
