<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Pekerjaan General</title>
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-ENG-PC-06/00/16/10/23</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN PEKERJAAN GENERAL</h1>
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
                    <th class="noborder nobg">Departemen</th>
                    <th class="noborder nobg">: {{ $ab->nama_departemen }}</th>
                    <th class="noborder nobg" colspan="">Shift</th>
                    <th class="noborder nobg" colspan="3">: {{ $ab->nama_shift }}</th>
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
                    <th>PERBAIKAN JALAN & TANGGUL</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Terdapat pengawas pada area kerja</td>
                    <td class="center">{{ $ab->perbaikan_jalan_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Tersedia alat komunikasi Radio</td>
                    <td class="center">{{ $ab->perbaikan_jalan_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Terdapat rambu pekerjaan</td>
                    <td class="center">{{ $ab->perbaikan_jalan_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Terdapat JSA pekerjaan perbaikan jalan & tanggul</td>
                    <td class="center">{{ $ab->perbaikan_jalan_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Terdapat form KKH operator dengan minimal istirahat 6 jam</td>
                    <td class="center">{{ $ab->perbaikan_jalan_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat APD lengkap</td>
                    <td class="center">{{ $ab->perbaikan_jalan_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Telah dilakukan P2H alat maintenance</td>
                    <td class="center">{{ $ab->perbaikan_jalan_7_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_7_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_7_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_7_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Apakah lalu lintas akses jalan area kerja crowded?</td>
                    <td class="center">{{ $ab->perbaikan_jalan_8_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_8_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_8_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_8_note }}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Lebar jalan sesuai standar 3,5 kali lebar unit terbesar</td>
                    <td class="center">{{ $ab->perbaikan_jalan_9_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_9_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_9_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_9_note }}</td>
                </tr>
                <tr>
                    <td class="center">10</td>
                    <td>Terbentuk superelevasi pada tikungan jalan</td>
                    <td class="center">{{ $ab->perbaikan_jalan_10_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_10_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_10_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_10_note }}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Terbentuk crossfall pada badan jalan minimal 2%</td>
                    <td class="center">{{ $ab->perbaikan_jalan_11_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_11_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_11_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_11_note }}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Dimensi tanggul jalan 3/4 dari diameter ban unit terbesar</td>
                    <td class="center">{{ $ab->perbaikan_jalan_12_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_12_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_12_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_12_note }}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Apakah terdapat unit support pengendalian debu (Water Truck)?</td>
                    <td class="center">{{ $ab->perbaikan_jalan_13_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_13_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_13_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_13_note }}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Apakah terdapat lampu penerangan area kerja?</td>
                    <td class="center">{{ $ab->perbaikan_jalan_14_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_14_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_jalan_14_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_jalan_14_note }}</td>
                </tr>
                <tr>
                    <th class="center">B</th>
                    <th>PERBAIKAN LERENG TAMBANG</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Terdapat pengawas pada area kerja</td>
                    <td class="center">{{ $ab->perbaikan_lereng_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Terdapat form KKH operator dengan minimal istirahat 6 jam</td>
                    <td class="center">{{ $ab->perbaikan_lereng_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Terdapat APD lengkap</td>
                    <td class="center">{{ $ab->perbaikan_lereng_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Tersedia alat komunikasi Radio</td>
                    <td class="center">{{ $ab->perbaikan_lereng_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_4_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Telah dilakukan P2H alat maintenance</td>
                    <td class="center">{{ $ab->perbaikan_lereng_5_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_5_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_5_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_5_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat patok acuan pada area rencana kerja</td>
                    <td class="center">{{ $ab->perbaikan_lereng_6_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_6_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_6_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_6_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Pad excavator stabil dan lebarnya memadai</td>
                    <td class="center">{{ $ab->perbaikan_lereng_7_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_7_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_7_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_7_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Terdapat potensi rock fall</td>
                    <td class="center">{{ $ab->perbaikan_lereng_8_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_8_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_8_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_8_note }}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Terdapat crack pada lereng tambang</td>
                    <td class="center">{{ $ab->perbaikan_lereng_9_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_9_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $ab->perbaikan_lereng_9_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $ab->perbaikan_lereng_9_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $ab->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Supervisor</td>
                    <td class="noborder nobg">Manager</td>
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
                <td style="text-align: right;">FM-ENG-PC-06/00/16/10/23</td>
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
            <tr>
                <td><strong>Departemen</strong></td>
                <td>: {{ $ab->nama_departemen }}</td>
                <td><strong>Shift</strong></td>
                <td>: {{ $ab->nama_shift }}</td>
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
