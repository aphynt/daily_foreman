<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Workshop Rebuild</title>
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-WS-68/02/17/03/24</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN WORKSHOP REBUILD</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $rb->lokasi }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($rb->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($rb->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                    <th>Bangunan dan Fasilitas</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Struktur bangunan kokoh, Lantai diconcreat dan beratap.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Tinggi bangunan sesuai dengan kendaraan yang diservice.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Terdapat ruang admin (utk info sparepart, SOP, buku service).</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Terdapat ruang tools room yang memadai.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Jumlah dan standard ganjal, TAG, penopang A2B memadai.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_5_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_5_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_5_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_6_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_6_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_6_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Lampu emergency berfungsi dengan baik.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_7_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_7_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_7_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_7_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Denah evakuasi ditempel dengan jelas.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_8_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_8_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_8_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_8_note }}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_9_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_9_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bangunan_fasilitas_9_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bangunan_fasilitas_9_note }}</td>
                </tr>
                <tr>
                    <th class="center">B</th>
                    <th>Lantai Kerja</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Bersih, Tidak ada tanah, Tidak becek.</td>
                    <td class="center">{!! $rb->lantai_kerja_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->lantai_kerja_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->lantai_kerja_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->lantai_kerja_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Tidak ada ceceran oli.</td>
                    <td class="center">{!! $rb->lantai_kerja_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->lantai_kerja_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->lantai_kerja_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->lantai_kerja_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">C</th>
                    <th>Peralatan Kerja</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Ditata dengan rapi, Tidak berserakan.</td>
                    <td class="center">{!! $rb->peralatan_kerja_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->peralatan_kerja_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->peralatan_kerja_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">D</th>
                    <th>TAG / Pelabelan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dipasang pada saat peralatan mesin diservice.</td>
                    <td class="center">{!! $rb->tag_pelabelan_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tag_pelabelan_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tag_pelabelan_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tag_pelabelan_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                    <td class="center">{!! $rb->tag_pelabelan_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tag_pelabelan_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tag_pelabelan_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tag_pelabelan_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">E</th>
                    <th>Sparepart Bekas (bisa dipakai)</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dirapikan dan dikelompokkan.</td>
                    <td class="center">{!! $rb->sparepart_bekas_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sparepart_bekas_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sparepart_bekas_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->sparepart_bekas_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">F</th>
                    <th>Selang Angin</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Berkualitas baik dan tanpa sambungan.</td>
                    <td class="center">{!! $rb->selang_angin_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->selang_angin_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->selang_angin_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->selang_angin_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">G</th>
                    <th>Tabung Gas Bertekanan (Untuk Welding)</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dalam posisi tegak.</td>
                    <td class="center">{!! $rb->tabung_gas_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tabung_gas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Menggunakan pengikat agar tidak terguling.</td>
                    <td class="center">{!! $rb->tabung_gas_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tabung_gas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Menggunakan regulator flashback arrestore pada tabung oxigen dan acetyline.</td>
                    <td class="center">{!! $rb->tabung_gas_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tabung_gas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Nozzle kontrol pengeluaran gas (oxigen, acetyline) berfungsi dengan baik.</td>
                    <td class="center">{!! $rb->tabung_gas_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tabung_gas_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Saat memindahkan menggunakan trolly.</td>
                    <td class="center">{!! $rb->tabung_gas_5_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_5_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_5_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tabung_gas_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Menggunakan label ISI atau KOSONG.</td>
                    <td class="center">{!! $rb->tabung_gas_6_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_6_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tabung_gas_6_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tabung_gas_6_note }}</td>
                </tr>
                <tr>
                    <th class="center">H</th>
                    <th>Mesin Las</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kabel (+) dan (-) tidak ada yang terkelupas.</td>
                    <td class="center">{!! $rb->mesin_las_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_las_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_las_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->mesin_las_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Bila ada sambungan maksimal 2 (dua) sambungan.</td>
                    <td class="center">{!! $rb->mesin_las_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_las_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_las_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->mesin_las_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Isolasi harus sempurna.</td>
                    <td class="center">{!! $rb->mesin_las_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_las_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_las_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->mesin_las_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">I</th>
                    <th>Pekerjaan Pengelasan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Adanya ruang khusus pengelasan.</td>
                    <td class="center">{!! $rb->pekerjaan_pengelasan_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pekerjaan_pengelasan_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pekerjaan_pengelasan_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->pekerjaan_pengelasan_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Terdapat sarana welding screen.</td>
                    <td class="center">{!! $rb->pekerjaan_pengelasan_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pekerjaan_pengelasan_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pekerjaan_pengelasan_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->pekerjaan_pengelasan_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">J</th>
                    <th>Mesin Compressor</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Tabung compressor memiliki petunjuk tekanan angin.</td>
                    <td class="center">{!! $rb->mesin_compressor_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_compressor_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_compressor_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->mesin_compressor_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Selang angin berkualitas baik, tanpa sambungan.</td>
                    <td class="center">{!! $rb->mesin_compressor_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_compressor_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->mesin_compressor_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->mesin_compressor_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">K</th>
                    <th>Electric</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kabel tidak terkelupas.</td>
                    <td class="center">{!! $rb->electric_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->electric_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Kabel berkualitas baik.</td>
                    <td class="center">{!! $rb->electric_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->electric_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                    <td class="center">{!! $rb->electric_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->electric_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Energi listrik / mesin-mesin menyala tanpa aktivitas.</td>
                    <td class="center">{!! $rb->electric_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->electric_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->electric_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">L</th>
                    <th>Bongkar Mesin / Sparepart</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Memiliki tempat mencuci yang memadai.</td>
                    <td class="center">{!! $rb->bongkar_mesin_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bongkar_mesin_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->bongkar_mesin_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->bongkar_mesin_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">M</th>
                    <th>APAR</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Jumlahnya memadai.</td>
                    <td class="center">{!! $rb->apar_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->apar_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{!! $rb->apar_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->apar_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tekanan APAR normal.</td>
                    <td class="center">{!! $rb->apar_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->apar_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Isi APAR normal.</td>
                    <td class="center">{!! $rb->apar_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->apar_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->apar_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">N</th>
                    <th>Rambu-rambu Bahaya</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dilarang menyalakan api / merokok.</td>
                    <td class="center">{!! $rb->rambu_bahaya_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->rambu_bahaya_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->rambu_bahaya_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Instruksi / gambar APD yang harus digunakan.</td>
                    <td class="center">{!! $rb->rambu_bahaya_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->rambu_bahaya_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->rambu_bahaya_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->rambu_bahaya_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Larangan penggunaan selang angin sembarangan.</td>
                    <td class="center">{!! $rb->rambu_bahaya_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->rambu_bahaya_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->rambu_bahaya_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->rambu_bahaya_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">O</th>
                    <th>Tempat Parkir Kendaraan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Rata, tidak becek, tidak ada ceceran oli.</td>
                    <td class="center">{!! $rb->tempat_parkir_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tempat_parkir_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->tempat_parkir_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->tempat_parkir_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">P</th>
                    <th>Besi Scrap</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Ditempatkan minimal 200 meter dari area workshop.</td>
                    <td class="center">{!! $rb->besi_scrap_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->besi_scrap_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->besi_scrap_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->besi_scrap_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">Q</th>
                    <th>Tempat Sampah Domestik</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                    <td class="center">{!! $rb->sampah_domestik_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sampah_domestik_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sampah_domestik_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->sampah_domestik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                    <td class="center">{!! $rb->sampah_domestik_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sampah_domestik_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sampah_domestik_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->sampah_domestik_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                    <td class="center">{!! $rb->sampah_domestik_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sampah_domestik_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->sampah_domestik_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->sampah_domestik_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">R</th>
                    <th>Oil Trap</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Volume dan fungsi oil trap terkontrol.</td>
                    <td class="center">{!! $rb->oil_trap_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->oil_trap_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Bagian atas ditutup sehingga air hujan tidak masuk.</td>
                    <td class="center">{!! $rb->oil_trap_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->oil_trap_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Air hujan tidak masuk ke paret oil trap.</td>
                    <td class="center">{!! $rb->oil_trap_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->oil_trap_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Komparment ke-3 tidak mengandung minyak atau oli.</td>
                    <td class="center">{!! $rb->oil_trap_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->oil_trap_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->oil_trap_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">S</th>
                    <th>Generator Listrik</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kabel listrik dari bahan berkualitas baik.</td>
                    <td class="center">{!! $rb->generator_listrik_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->generator_listrik_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->generator_listrik_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->generator_listrik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Stop kontak, saklar, isolasi berfungsi dengan baik.</td>
                    <td class="center">{!! $rb->generator_listrik_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->generator_listrik_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->generator_listrik_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->generator_listrik_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tidak menimbulkan kebisingan di tempat kerja.</td>
                    <td class="center">{!! $rb->generator_listrik_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->generator_listrik_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->generator_listrik_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->generator_listrik_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">T</th>
                    <th>Jalan Untuk Keluar Masuk</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Terdapat rambu-rambu jalan masuk / keluar bagi kendaraan HD dan A2B yang lain.</td>
                    <td class="center">{!! $rb->jalan_keluar_masuk_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->jalan_keluar_masuk_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->jalan_keluar_masuk_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->jalan_keluar_masuk_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">U</th>
                    <th>Pemadam Hydran</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Tempat hose air mudah dibuka.</td>
                    <td class="center">{!! $rb->pemadam_hydran_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->pemadam_hydran_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Kran air berfungsi dengan baik.</td>
                    <td class="center">{!! $rb->pemadam_hydran_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->pemadam_hydran_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Pompa air berfungsi dengan baik.</td>
                    <td class="center">{!! $rb->pemadam_hydran_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->pemadam_hydran_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Kapasitas air memadai.</td>
                    <td class="center">{!! $rb->pemadam_hydran_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->pemadam_hydran_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->pemadam_hydran_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">V</th>
                    <th>Limbah B3</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Limbah oli, limbah solar, limbah filter dan majun terkontaminasi oli / grease dikelola dengan baik.</td>
                    <td class="center">{!! $rb->limbah_b3_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->limbah_b3_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $rb->limbah_b3_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{{ $rb->limbah_b3_1_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $rb->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Mengetahui</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($rb->verified_pengawas != null)<img src="{{ $rb->verified_pengawas }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($rb->verified_diketahui != null)<img src="{{ $rb->verified_diketahui }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $rb->nama_pengawas ? $rb->nama_pengawas : '.......................' }}</td>
                    <td class="noborder nobg">{{ $rb->nama_diketahui ? $rb->nama_diketahui : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $rb->catatan_verified_pengawas != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $rb->catatan_verified_pengawas
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $rb->catatan_verified_diketahui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $rb->catatan_verified_diketahui
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($rb, 'dokumentasi_1') ?: data_get($rb, 'dokumentasi_foto_1') ?: data_get($rb, 'foto_1');
            $photoTwo = data_get($rb, 'dokumentasi_2') ?: data_get($rb, 'dokumentasi_foto_2') ?: data_get($rb, 'foto_2');
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
                <td style="text-align: right;">FM-WS-68/02/17/03/24</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH WORKSHOP REBUILD</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $rb->lokasi }}</td>
            </tr>
            <tr>
                <td><strong>Hari/Tanggal</strong></td>
                <td>: {{ Carbon::parse($rb->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td><strong>Jam</strong></td>
                <td>: {{ Carbon::parse($rb->time)->locale('id')->isoFormat('HH:mm') }}</td>
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
