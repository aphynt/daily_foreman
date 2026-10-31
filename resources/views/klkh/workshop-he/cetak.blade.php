<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Workshop HE (Wheel/Track)</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/fonts/fontawesome.css">
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }
        body {
            font-family: Arial, sans-serif;
            /* line-height: 1.6; */
            font-size: 11px;
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-WS-51/03/11/10/26</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN WORKSHOP HE (WHEEL/TRACK)</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $he->lokasi }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($he->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($he->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                <!-- A. Bangunan dan Fasilitas -->
                <tr>
                    <th class="center">A</th><th>Bangunan dan Fasilitas</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Struktur bangunan kokoh, lantai diconcreat dan beratap.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Tinggi bangunan sesuai dengan kendaraan yang diservice.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Terdapat ruang admin (untuk informasi sparepart, SOP, buku service).</td>
                    <td class="center">{{ $he->bangunan_fasilitas_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Terdapat ruang tools room yang memadai.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td><td>Jumlah dan standar ganjal, TAG, penopang A2B memadai.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td><td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td><td>Lampu emergency berfungsi dengan baik.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_7_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_7_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_7_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_7_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td><td>Denah evakuasi ditempel dengan jelas.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_8_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_8_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_8_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_8_note }}</td>
                </tr>
                <tr>
                    <td class="center">9</td><td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</td>
                    <td class="center">{{ $he->bangunan_fasilitas_9_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_9_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bangunan_fasilitas_9_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bangunan_fasilitas_9_note }}</td>
                </tr>
                <!-- B. Lantai Kerja -->
                <tr>
                    <th class="center">B</th><th>Lantai Kerja</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Bersih, tidak ada tanah, tidak becek.</td>
                    <td class="center">{{ $he->lantai_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->lantai_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->lantai_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->lantai_kerja_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Tidak ada ceceran oli.</td>
                    <td class="center">{{ $he->lantai_kerja_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->lantai_kerja_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->lantai_kerja_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->lantai_kerja_2_note }}</td>
                </tr>
                <!-- C. Peralatan Kerja -->
                <tr>
                    <th class="center">C</th><th>Peralatan Kerja</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Ditata dengan rapi, tidak berserakan.</td>
                    <td class="center">{{ $he->peralatan_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->peralatan_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->peralatan_kerja_1_note }}</td>
                </tr>
                <!-- D. TAG / Pelabelan -->
                <tr>
                    <th class="center">D</th><th>TAG / Pelabelan</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Dipasang pada saat peralatan mesin diservice.</td>
                    <td class="center">{{ $he->tag_pelabelan_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tag_pelabelan_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tag_pelabelan_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tag_pelabelan_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                    <td class="center">{{ $he->tag_pelabelan_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tag_pelabelan_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tag_pelabelan_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tag_pelabelan_2_note }}</td>
                </tr>
                <!-- E. Sparepart Bekas -->
                <tr>
                    <th class="center">E</th><th>Sparepart Bekas (Bisa Dipakai)</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Dirapikan dan dikelompokkan.</td>
                    <td class="center">{{ $he->sparepart_bekas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sparepart_bekas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sparepart_bekas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->sparepart_bekas_1_note }}</td>
                </tr>
                <!-- F. Selang Angin -->
                <tr>
                    <th class="center">F</th><th>Selang Angin</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Berkualitas baik dan tanpa sambungan.</td>
                    <td class="center">{{ $he->selang_angin_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->selang_angin_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->selang_angin_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->selang_angin_1_note }}</td>
                </tr>
                <!-- G. Tabung Gas Bertekanan -->
                <tr>
                    <th class="center">G</th><th>Tabung Gas Bertekanan (Untuk Welding)</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Dalam posisi tegak.</td>
                    <td class="center">{{ $he->tabung_gas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tabung_gas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Menggunakan pengikat agar tidak terguling.</td>
                    <td class="center">{{ $he->tabung_gas_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tabung_gas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Menggunakan regulator flashback arrestor pada tabung oksigen dan asetilena.</td>
                    <td class="center">{{ $he->tabung_gas_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tabung_gas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Nozzle kontrol pengeluaran gas (oksigen, asetilena) berfungsi dengan baik.</td>
                    <td class="center">{{ $he->tabung_gas_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tabung_gas_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td><td>Saat memindahkan menggunakan troli.</td>
                    <td class="center">{{ $he->tabung_gas_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tabung_gas_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td><td>Menggunakan label ISI atau KOSONG.</td>
                    <td class="center">{{ $he->tabung_gas_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tabung_gas_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tabung_gas_6_note }}</td>
                </tr>
                <!-- H. Mesin Las -->
                <tr>
                    <th class="center">H</th><th>Mesin Las</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Kabel (+) dan (-) tidak ada yang terkelupas.</td>
                    <td class="center">{{ $he->mesin_las_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_las_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_las_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->mesin_las_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Bila ada sambungan maksimal 2 (dua) sambungan.</td>
                    <td class="center">{{ $he->mesin_las_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_las_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_las_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->mesin_las_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Isolasi harus sempurna.</td>
                    <td class="center">{{ $he->mesin_las_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_las_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_las_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->mesin_las_3_note }}</td>
                </tr>
                <!-- I. Pekerjaan Pengelasan -->
                <tr>
                    <th class="center">I</th><th>Pekerjaan Pengelasan</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Adanya ruang khusus pengelasan.</td>
                    <td class="center">{{ $he->pekerjaan_pengelasan_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pekerjaan_pengelasan_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pekerjaan_pengelasan_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->pekerjaan_pengelasan_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Terdapat sarana welding screen.</td>
                    <td class="center">{{ $he->pekerjaan_pengelasan_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pekerjaan_pengelasan_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pekerjaan_pengelasan_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->pekerjaan_pengelasan_2_note }}</td>
                </tr>
                <!-- J. Mesin Compressor -->
                <tr>
                    <th class="center">J</th><th>Mesin Compressor</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Tabung compressor memiliki petunjuk tekanan angin.</td>
                    <td class="center">{{ $he->mesin_compressor_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_compressor_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_compressor_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->mesin_compressor_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Selang angin berkualitas baik, tanpa sambungan.</td>
                    <td class="center">{{ $he->mesin_compressor_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_compressor_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->mesin_compressor_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->mesin_compressor_2_note }}</td>
                </tr>
                <!-- K. Electric -->
                <tr>
                    <th class="center">K</th><th>Electric</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Kabel tidak terkelupas.</td>
                    <td class="center">{{ $he->electric_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->electric_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Kabel berkualitas baik.</td>
                    <td class="center">{{ $he->electric_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->electric_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                    <td class="center">{{ $he->electric_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->electric_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Energi listrik / mesin-mesin menyala tanpa aktivitas.</td>
                    <td class="center">{{ $he->electric_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->electric_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->electric_4_note }}</td>
                </tr>
                <!-- L. Bongkar Mesin / Sparepart -->
                <tr>
                    <th class="center">L</th><th>Bongkar Mesin / Sparepart</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Memiliki tempat mencuci yang memadai.</td>
                    <td class="center">{{ $he->bongkar_mesin_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bongkar_mesin_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->bongkar_mesin_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->bongkar_mesin_1_note }}</td>
                </tr>
                <!-- M. APAR -->
                <tr>
                    <th class="center">M</th><th>APAR</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Jumlahnya memadai.</td>
                    <td class="center">{{ $he->apar_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->apar_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{{ $he->apar_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->apar_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Tekanan APAR normal.</td>
                    <td class="center">{{ $he->apar_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->apar_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Isi APAR normal.</td>
                    <td class="center">{{ $he->apar_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->apar_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->apar_4_note }}</td>
                </tr>
                <!-- N. Rambu-rambu Bahaya -->
                <tr>
                    <th class="center">N</th><th>Rambu-rambu Bahaya</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Dilarang menyalakan api / merokok.</td>
                    <td class="center">{{ $he->rambu_bahaya_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->rambu_bahaya_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->rambu_bahaya_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Instruksi / gambar APD yang harus digunakan.</td>
                    <td class="center">{{ $he->rambu_bahaya_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->rambu_bahaya_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->rambu_bahaya_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->rambu_bahaya_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Larangan penggunaan selang angin sembarangan.</td>
                    <td class="center">{{ $he->rambu_bahaya_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->rambu_bahaya_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->rambu_bahaya_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->rambu_bahaya_3_note }}</td>
                </tr>
                <!-- O. Tempat Parkir Kendaraan -->
                <tr>
                    <th class="center">O</th><th>Tempat Parkir Kendaraan</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Rata, tidak becek, tidak ada ceceran oli.</td>
                    <td class="center">{{ $he->tempat_parkir_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tempat_parkir_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->tempat_parkir_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->tempat_parkir_1_note }}</td>
                </tr>
                <!-- P. Besi Scrap -->
                <tr>
                    <th class="center">P</th><th>Besi Scrap</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Ditempatkan minimal 200 meter dari area workshop.</td>
                    <td class="center">{{ $he->besi_scrap_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->besi_scrap_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->besi_scrap_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->besi_scrap_1_note }}</td>
                </tr>
                <!-- Q. Tempat Sampah Domestik -->
                <tr>
                    <th class="center">Q</th><th>Tempat Sampah Domestik</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                    <td class="center">{{ $he->sampah_domestik_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sampah_domestik_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sampah_domestik_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->sampah_domestik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                    <td class="center">{{ $he->sampah_domestik_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sampah_domestik_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sampah_domestik_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->sampah_domestik_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Sampah dibuang ke tempat pembuangan sampah.</td>
                    <td class="center">{{ $he->sampah_domestik_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sampah_domestik_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->sampah_domestik_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->sampah_domestik_3_note }}</td>
                </tr>
                <!-- R. Oil Trap -->
                <tr>
                    <th class="center">R</th><th>Oil Trap</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Volume dan fungsi oil trap terkontrol.</td>
                    <td class="center">{{ $he->oil_trap_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->oil_trap_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Bagian atas ditutup sehingga air hujan tidak masuk.</td>
                    <td class="center">{{ $he->oil_trap_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->oil_trap_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Air hujan tidak masuk ke parit oil trap.</td>
                    <td class="center">{{ $he->oil_trap_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->oil_trap_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Kompartemen ke-3 tidak mengandung minyak atau oli.</td>
                    <td class="center">{{ $he->oil_trap_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->oil_trap_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->oil_trap_4_note }}</td>
                </tr>
                <!-- S. Generator Listrik -->
                <tr>
                    <th class="center">S</th><th>Generator Listrik</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Kabel listrik dari bahan berkualitas baik.</td>
                    <td class="center">{{ $he->generator_listrik_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->generator_listrik_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->generator_listrik_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->generator_listrik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Stop kontak, saklar, isolasi berfungsi dengan baik.</td>
                    <td class="center">{{ $he->generator_listrik_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->generator_listrik_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->generator_listrik_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->generator_listrik_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Tidak menimbulkan kebisingan di tempat kerja.</td>
                    <td class="center">{{ $he->generator_listrik_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->generator_listrik_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->generator_listrik_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->generator_listrik_3_note }}</td>
                </tr>
                <!-- T. Jalan Untuk Keluar Masuk -->
                <tr>
                    <th class="center">T</th><th>Jalan Untuk Keluar Masuk</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Terdapat rambu-rambu jalan masuk / keluar bagi kendaraan HD dan A2B yang lain.</td>
                    <td class="center">{{ $he->jalan_keluar_masuk_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->jalan_keluar_masuk_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->jalan_keluar_masuk_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->jalan_keluar_masuk_1_note }}</td>
                </tr>
                <!-- U. Pemadam Hydran -->
                <tr>
                    <th class="center">U</th><th>Pemadam Hydran</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Tempat hose air mudah dibuka.</td>
                    <td class="center">{{ $he->pemadam_hydran_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->pemadam_hydran_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Kran air berfungsi dengan baik.</td>
                    <td class="center">{{ $he->pemadam_hydran_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->pemadam_hydran_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Pompa air berfungsi dengan baik.</td>
                    <td class="center">{{ $he->pemadam_hydran_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->pemadam_hydran_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Kapasitas air memadai.</td>
                    <td class="center">{{ $he->pemadam_hydran_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->pemadam_hydran_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->pemadam_hydran_4_note }}</td>
                </tr>
                <!-- V. Washingbay -->
                <tr>
                    <th class="center">V</th><th>Washingbay</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Lantai rata, diconcrete, tidak sempit dan tidak berlumpur.</td>
                    <td class="center">{{ $he->washingbay_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->washingbay_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Terdapat sistem pengendapan lumpur pada bak penampung.</td>
                    <td class="center">{{ $he->washingbay_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->washingbay_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Pengurasan lumpur terjadwal.</td>
                    <td class="center">{{ $he->washingbay_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->washingbay_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td><td>Tidak ada air yang keluar dari kompartemen akhir.</td>
                    <td class="center">{{ $he->washingbay_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->washingbay_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td><td>Penggunaan kembali air pada kompartemen akhir.</td>
                    <td class="center">{{ $he->washingbay_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->washingbay_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->washingbay_5_note }}</td>
                </tr>
                <!-- W. AED -->
                <tr>
                    <th class="center">W</th><th>AED (Automated External Defibrillator)</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Jumlahnya memadai.</td>
                    <td class="center">{{ $he->aed_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->aed_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->aed_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->aed_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td><td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{{ $he->aed_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->aed_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->aed_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->aed_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td><td>Telah dilakukan pemeriksaan secara berkala.</td>
                    <td class="center">{{ $he->aed_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->aed_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->aed_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->aed_3_note }}</td>
                </tr>
                <!-- X. Limbah B3 -->
                <tr>
                    <th class="center">X</th><th>Limbah B3</th><th></th><th></th><th></th><th></th>
                </tr>
                <tr>
                    <td class="center">1</td><td>Limbah oli, limbah solar, limbah filter dan majun terkontaminasi oli / grease dikelola dengan baik.</td>
                    <td class="center">{{ $he->limbah_b3_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->limbah_b3_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $he->limbah_b3_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $he->limbah_b3_1_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $he->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Mengetahui</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($he->verified_pengawas != null)<img src="{{ $he->verified_pengawas }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($he->verified_diketahui != null)<img src="{{ $he->verified_diketahui }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $he->nama_pengawas ? $he->nama_pengawas : '.......................' }}</td>
                    <td class="noborder nobg">{{ $he->nama_diketahui ? $he->nama_diketahui : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $he->catatan_verified_pengawas != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $he->catatan_verified_pengawas
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $he->catatan_verified_diketahui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $he->catatan_verified_diketahui
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($he, 'dokumentasi_1') ?: data_get($he, 'dokumentasi_foto_1') ?: data_get($he, 'foto_1');
            $photoTwo = data_get($he, 'dokumentasi_2') ?: data_get($he, 'dokumentasi_foto_2') ?: data_get($he, 'foto_2');
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
                <td style="text-align: right;">FM-WS-51/03/11/10/26</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH WORKSHOP HE (WHEEL/TRACK)</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $he->lokasi }}</td>
            </tr>
            <tr>
                <td><strong>Hari/Tanggal</strong></td>
                <td>: {{ Carbon::parse($he->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td><strong>Jam</strong></td>
                <td>: {{ Carbon::parse($he->time)->locale('id')->isoFormat('HH:mm') }}</td>
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
