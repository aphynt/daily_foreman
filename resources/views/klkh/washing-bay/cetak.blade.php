<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Washing Bay</title>
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-WS-09/01/12/10/26</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN WASHING BAY</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $ab->lokasi }}</th>
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
                    <th class="center">1</th>
                    <th>Bangunan dan Fasilitas</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1.1</td>
                    <td>Lantai rata, diconcrete, dan tidak sempit.</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->bangunan_fasilitas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">1.2</td>
                    <td>Area pencucian bersih, tidak becek dan tidak berlumpur.</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->bangunan_fasilitas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">1.3</td>
                    <td>Akses jalan keluar masuk Room Washing Bay rata dan tidak becek.</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->bangunan_fasilitas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">1.4</td>
                    <td>Rata, tidak becek, dan tidak ada ceceran oli.</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->bangunan_fasilitas_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">1.5</td>
                    <td>Denah evakuasi ditempel dengan jelas.</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->bangunan_fasilitas_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">1.6</td>
                    <td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, dan sabun cuci.</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->bangunan_fasilitas_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->bangunan_fasilitas_6_note }}</td>
                </tr>
                <tr>
                    <th class="center">2</th>
                    <th>Tempat Parkiran Kendaraan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">2.1</td>
                    <td>Rata, tidak becek, dan tidak ada ceceran oli.</td>
                    <td class="center">{{ $ab->parkiran_kendaraan_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->parkiran_kendaraan_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->parkiran_kendaraan_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->parkiran_kendaraan_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">3</th>
                    <th>Peralatan Kerja</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">3.1</td>
                    <td>Ditata dengan rapi dan tidak berserakan.</td>
                    <td class="center">{{ $ab->peralatan_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->peralatan_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->peralatan_kerja_1_note }}</td>
                </tr>
                <tr>
                    <th class="center">4</th>
                    <th>Prosedur Lotto</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">4.1</td>
                    <td>Dipasang pada saat pencucian unit sedang berjalan.</td>
                    <td class="center">{{ $ab->prosedur_lotto_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->prosedur_lotto_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->prosedur_lotto_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->prosedur_lotto_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">4.2</td>
                    <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                    <td class="center">{{ $ab->prosedur_lotto_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->prosedur_lotto_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->prosedur_lotto_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->prosedur_lotto_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">5</th>
                    <th>Rambu-rambu Bahaya</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">5.1</td>
                    <td>Terdapat rambu-rambu jalan masuk/keluar dan wajib stopper bagi kendaraan HD dan A2B yang lain.</td>
                    <td class="center">{{ $ab->rambu_bahaya_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->rambu_bahaya_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->rambu_bahaya_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.2</td>
                    <td>Instruksi/gambar APD yang harus digunakan.</td>
                    <td class="center">{{ $ab->rambu_bahaya_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->rambu_bahaya_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->rambu_bahaya_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->rambu_bahaya_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">5.3</td>
                    <td>Muster point terpasang.</td>
                    <td class="center">{{ $ab->rambu_bahaya_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->rambu_bahaya_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->rambu_bahaya_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->rambu_bahaya_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">6</th>
                    <th>Lampu Penerangan</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">6.1</td>
                    <td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                    <td class="center">{{ $ab->lampu_penerangan_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->lampu_penerangan_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->lampu_penerangan_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->lampu_penerangan_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">6.2</td>
                    <td>Lampu emergency berfungsi dengan baik.</td>
                    <td class="center">{{ $ab->lampu_penerangan_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->lampu_penerangan_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->lampu_penerangan_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->lampu_penerangan_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">7</th>
                    <th>Electric Pump Washing</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">7.1</td>
                    <td>Kabel tidak terkelupas.</td>
                    <td class="center">{{ $ab->electric_pump_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->electric_pump_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">7.2</td>
                    <td>Kabel dari bahan berkualitas baik.</td>
                    <td class="center">{{ $ab->electric_pump_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->electric_pump_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">7.3</td>
                    <td>Stop kontak, saklar, dan isolasi berfungsi dengan baik.</td>
                    <td class="center">{{ $ab->electric_pump_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->electric_pump_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">7.4</td>
                    <td>Energi listrik/mesin-mesin menyala saat beraktivitas.</td>
                    <td class="center">{{ $ab->electric_pump_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->electric_pump_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->electric_pump_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">8</th>
                    <th>Tangki Penampungan Air Washing Bay</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">8.1</td>
                    <td>Kondisi pondasi tangki air rata dan tidak miring.</td>
                    <td class="center">{{ $ab->tangki_air_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->tangki_air_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.2</td>
                    <td>Terdapat tangga standar untuk turun naik.</td>
                    <td class="center">{{ $ab->tangki_air_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->tangki_air_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.3</td>
                    <td>Terdapat pagar pengaman di sekeliling atas tangki air.</td>
                    <td class="center">{{ $ab->tangki_air_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->tangki_air_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">8.4</td>
                    <td>Tidak ada kebocoran pada area tangki air.</td>
                    <td class="center">{{ $ab->tangki_air_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->tangki_air_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->tangki_air_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">9</th>
                    <th>Sistem Loto</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">9.1</td>
                    <td>Dipasang pada saat pencucian unit sedang berjalan.</td>
                    <td class="center">{{ $ab->sistem_loto_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sistem_loto_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sistem_loto_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->sistem_loto_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">9.2</td>
                    <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                    <td class="center">{{ $ab->sistem_loto_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sistem_loto_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sistem_loto_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->sistem_loto_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">10</th>
                    <th>Selang &amp; Air</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">10.1</td>
                    <td>Berkualitas baik dan tanpa sambungan.</td>
                    <td class="center">{{ $ab->selang_air_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->selang_air_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->selang_air_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->selang_air_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">10.2</td>
                    <td>Terdapat larangan menggunakan pressure air ke anggota badan.</td>
                    <td class="center">{{ $ab->selang_air_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->selang_air_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->selang_air_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->selang_air_2_note }}</td>
                </tr>
                <tr>
                    <th class="center">11</th>
                    <th>APAR</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">11.1</td>
                    <td>Jumlahnya memadai.</td>
                    <td class="center">{{ $ab->apar_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->apar_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">11.2</td>
                    <td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{{ $ab->apar_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->apar_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">11.3</td>
                    <td>Tekanan APAR normal.</td>
                    <td class="center">{{ $ab->apar_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->apar_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">11.4</td>
                    <td>Isi APAR normal.</td>
                    <td class="center">{{ $ab->apar_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->apar_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->apar_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">12</th>
                    <th>Room Washing Man</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">12.1</td>
                    <td>Dilarang menyalakan api atau merokok.</td>
                    <td class="center">{{ $ab->room_washing_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->room_washing_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">12.2</td>
                    <td>Ruangan tertata rapi dan bersih.</td>
                    <td class="center">{{ $ab->room_washing_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->room_washing_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">12.3</td>
                    <td>Terdapat fasilitas komunikasi radio.</td>
                    <td class="center">{{ $ab->room_washing_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->room_washing_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">12.4</td>
                    <td>Penerangan ruangan operator memadai.</td>
                    <td class="center">{{ $ab->room_washing_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->room_washing_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->room_washing_4_note }}</td>
                </tr>
                <tr>
                    <th class="center">13</th>
                    <th>Tempat Sampah Domestik</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">13.1</td>
                    <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                    <td class="center">{{ $ab->sampah_domestik_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sampah_domestik_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sampah_domestik_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->sampah_domestik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">13.2</td>
                    <td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                    <td class="center">{{ $ab->sampah_domestik_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sampah_domestik_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sampah_domestik_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->sampah_domestik_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">13.3</td>
                    <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                    <td class="center">{{ $ab->sampah_domestik_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sampah_domestik_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->sampah_domestik_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->sampah_domestik_3_note }}</td>
                </tr>
                <tr>
                    <th class="center">14</th>
                    <th>Kolam Kompartemen</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">14.1</td>
                    <td>Terdapat sistem pengendapan lumpur pada bak penampung.</td>
                    <td class="center">{{ $ab->kolam_kompartemen_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->kolam_kompartemen_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">14.2</td>
                    <td>Pengurasan lumpur terjadwal.</td>
                    <td class="center">{{ $ab->kolam_kompartemen_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->kolam_kompartemen_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">14.3</td>
                    <td>Tidak ada air yang keluar dari kompartemen akhir.</td>
                    <td class="center">{{ $ab->kolam_kompartemen_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->kolam_kompartemen_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">14.4</td>
                    <td>Kompartemen ke-5 tidak mengandung minyak atau oli.</td>
                    <td class="center">{{ $ab->kolam_kompartemen_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->kolam_kompartemen_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">14.5</td>
                    <td>Penggunaan kembali air pada kompartemen akhir menggunakan pompa.</td>
                    <td class="center">{{ $ab->kolam_kompartemen_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->kolam_kompartemen_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">14.6</td>
                    <td>Terdapat pagar pengaman sekeliling kolam kompartemen.</td>
                    <td class="center">{{ $ab->kolam_kompartemen_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->kolam_kompartemen_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->kolam_kompartemen_6_note }}</td>
                </tr>
                <tr>
                    <th class="center">15</th>
                    <th>Limbah B3</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">15.1</td>
                    <td>Limbah oli, limbah solar, dan majun terkontaminasi oli/grease dikelola dengan baik.</td>
                    <td class="center">{{ $ab->limbah_b3_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->limbah_b3_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->limbah_b3_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->limbah_b3_1_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $ab->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Diperiksa Oleh</td>
                    <td class="noborder nobg">Disetujui Oleh</td>
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
                <td style="text-align: right;">FM-WS-09/01/12/10/26</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH WASHING BAY</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $ab->lokasi }}</td>
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
