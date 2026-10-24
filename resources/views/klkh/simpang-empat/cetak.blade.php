<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan KKH & KLKH Area INTERSECTION (Simpang Empat)</title>
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
            box-sizing: border-box;
            width: 100%;
            color: #111;
        }
        .klkh-photo-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .klkh-photo-header img {
            max-width: 205px;
            max-height: 55px;
            object-fit: contain;
        }
        .klkh-photo-code {
            font-size: 11px;
            text-align: right;
        }
        .klkh-photo-page h2 {
            font-size: 19px;
            text-align: center;
            margin: 14px 0 5px;
        }
        .klkh-photo-subtitle {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .klkh-photo-info td {
            padding: 7px 9px;
            font-size: 11px;
            border: 1px solid #aaa;
        }
        .klkh-photo-label {
            font-weight: bold;
            background: #f0f2f5;
            width: 17%;
        }
        .klkh-photo-bar {
            padding: 9px;
            font-weight: bold;
            text-align: center;
            background: #e8edf4;
            border: 1px solid #b8c5d4;
            margin: 12px 0;
        }
        .klkh-photo-grid {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-spacing: 8px 0;
        }
        .klkh-photo-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            border: 1px solid #c5cbd3;
        }
        .klkh-photo-caption {
            text-align: center;
            padding: 9px;
            font-weight: bold;
            background: #f4f6f8;
            border-bottom: 1px solid #c5cbd3;
        }
        .klkh-photo-frame {
            height: 560px;
            text-align: center;
            padding: 8px;
            box-sizing: border-box;
        }
        .klkh-photo-frame img {
            display: block;
            max-width: 100%;
            max-height: 535px;
            width: auto;
            height: auto;
            margin: 0 auto;
            object-fit: contain;
        }
        .klkh-photo-empty {
            padding: 195px 4px 0;
            color: #777;
            font-style: italic;
            text-align: center;
        }
        @media print {
            .klkh-photo-page {
                page-break-before: always;
                break-before: page;
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg" style="padding: 0px; margin-bottom: 0px"><img src="{{ asset('dashboard/assets') }}/images/logo-full.png" width="240px"></th>
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-PRD-73/00/10/06/24</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>Pemeriksaan Kesiapan Kerja Harian & Kelayakan Lingkungan Kerja Harian (KLKH) Departemen Produksi Area INTERSECTION (Simpang Empat)</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">PIT</th>
                    <th class="noborder nobg">: {{ $se->pit }}</th>
                    <th colspan="" class="noborder nobg">Shift</th>
                    <th colspan="3" class="noborder nobg">: {{ $se->shift }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($se->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($se->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                <tr>
                    <th class="center">A</th>
                    <th>Rambu</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">1</td>
                    <td>Papan informasi nama intersection</td>
                    <td class="center">{!! $se->intersection_name_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $se->intersection_name_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->intersection_name_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->intersection_name_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Rambu batas kecepatan</td>
                    <td class="center">{!! $se->speed_limit_sign_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->speed_limit_sign_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->speed_limit_sign_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->speed_limit_sign_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Rambu simpang 4</td>
                    <td class="center">{!! $se->intersection_sign_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->intersection_sign_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->intersection_sign_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->intersection_sign_note !!}</td>
                <tr>
                    <td class="center">4</td>
                    <td>Rambu hati- hati</td>
                    <td class="center">{!! $se->caution_sign_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->caution_sign_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->caution_sign_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->caution_sign_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Rambu batas berhenti </td>
                    <td class="center">{!! $se->stop_sign_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->stop_sign_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->stop_sign_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->stop_sign_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Rambu mulai & berhenti klakson</td>
                    <td class="center">{!! $se->horn_sign_unit_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->horn_sign_unit_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->horn_sign_unit_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->horn_sign_unit_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Rambu Ganda (stop dan penunjuk ararah)</td>
                    <td class="center">{!! $se->double_sign_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->double_sign_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->double_sign_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->double_sign_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Rambu larangan belok kanan</td>
                    <td class="center">{!! $se->right_turn_prohibited_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->right_turn_prohibited_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->right_turn_prohibited_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->right_turn_prohibited_note !!}</td>
                </tr>
                <th class="center">B</th>
                <th>Lokasi Kerja</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Lampu Trafic berfungsi dengan baik</td>
                    <td class="center">{!! $se->traffic_light_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->traffic_light_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->traffic_light_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->traffic_light_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Terdapat petugas Intersection yang memiliki kartu petugas intersection</td>
                    <td class="center">{!! $se->intersection_officer_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->intersection_officer_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->intersection_officer_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->intersection_officer_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Terdapat radio komunikasi dengan chanel yang sesuai</td>
                    <td class="center">{!! $se->radio_communication_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->radio_communication_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->radio_communication_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->radio_communication_note !!}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Posisi pondok intersection memungkinkan petugas Intersection memantau lalulintas dengan baik diarea intersection</td>
                    <td class="center">{!! $se->intersection_monitoring_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->intersection_monitoring_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->intersection_monitoring_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->intersection_monitoring_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Terdapat median jalan standar dengan rambu ganda</td>
                    <td class="center">{!! $se->standard_road_medium_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->standard_road_medium_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->standard_road_medium_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->standard_road_medium_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Lebar jalan 3,5 x unit terbesar</td>
                    <td class="center">{!! $se->road_width_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->road_width_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->road_width_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->road_width_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Jalur angkut rata, tidak bergelombang, dan bebas dari tumpahan material dan spoil-spoil</td>
                    <td class="center">{!! $se->smooth_transport_path_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->smooth_transport_path_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->smooth_transport_path_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->smooth_transport_path_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Tidak terdapat blind spot</td>
                    <td class="center">{!! $se->blind_spot_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->blind_spot_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->blind_spot_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->blind_spot_note !!}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Pada radius 75 m sebelum intersection, tinggi bund wall / tanggul jalan wall adalah 75 cm</td>
                    <td class="center">{!! $se->radius_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->radius_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->radius_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->radius_note !!}</td>
                </tr>
                <tr>
                    <td class="center">10</td>
                    <td>Terdapat tempat sampah</td>
                    <td class="center">{!! $se->trash_bin_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->trash_bin_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->trash_bin_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->trash_bin_note !!}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Terdapat fasilitas toilet</td>
                    <td class="center">{!! $se->toilet_facility_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->toilet_facility_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->toilet_facility_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->toilet_facility_note !!}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Tingkat pencahayaan minimal 20 Lux</td>
                    <td class="center">{!! $se->lighting_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->lighting_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->lighting_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->lighting_note !!}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Terdapat Kotak P3K</td>
                    <td class="center">{!! $se->first_aid_box_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->first_aid_box_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->first_aid_box_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->first_aid_box_note !!}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Terdapat APAR</td>
                    <td class="center">{!! $se->fire_extinguisher_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->fire_extinguisher_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->fire_extinguisher_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->fire_extinguisher_note !!}</td>
                </tr>
                <tr>
                    <td class="center">15</td>
                    <td>Terdapat Parkir area sarana beserta rambu parkir</td>
                    <td class="center">{!! $se->parking_area_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->parking_area_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->parking_area_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->parking_area_note !!}</td>
                </tr>
                <tr>
                    <td class="center">16</td>
                    <td>Terdapat Penyalur Petir</td>
                    <td class="center">{!! $se->lightning_rod_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->lightning_rod_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->lightning_rod_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->lightning_rod_note !!}</td>
                </tr>
                <tr>
                    <td class="center">17</td>
                    <td>Terdapat SOP intersection dalam pondok</td>
                    <td class="center">{!! $se->sop_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->sop_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $se->sop_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $se->sop_note !!}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $se->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Foremen</td>
                    <td class="noborder nobg">Supervisor</td>
                    <td class="noborder nobg">Superintendent</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($se->verified_foreman != null)<img src="{{ $se->verified_foreman }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($se->verified_supervisor != null)<img src="{{ $se->verified_supervisor }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($se->verified_superintendent != null)<img src="{{ $se->verified_superintendent }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $se->nama_foreman ? $se->nama_foreman : '.......................' }}</td>
                    <td class="noborder nobg">{{ $se->nama_supervisor ? $se->nama_supervisor : '.......................' }}</td>
                    <td class="noborder nobg">{{ $se->nama_superintendent ? $se->nama_superintendent : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $se->catatan_verified_foreman != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $se->catatan_verified_foreman
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $se->catatan_verified_supervisor != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $se->catatan_verified_supervisor
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $se->catatan_verified_superintendent != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $se->catatan_verified_superintendent
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @php
        $photoUrl = function ($value) {
            if (empty($value)) {
                return null;
            }
            $value = trim((string) $value);
            if (str_starts_with(strtolower($value), 'http://') || str_starts_with(strtolower($value), 'https://')) {
                return $value;
            }
            if (str_starts_with($value, '/storage/') || str_starts_with($value, 'storage/')) {
                return asset(ltrim($value, '/'));
            }
            return asset('storage/' . ltrim($value, '/'));
        };
        $documentation1 = $photoUrl($se->dokumentasi_1 ?? $se->dokumentasi_foto_1 ?? $se->foto_1 ?? null);
        $documentation2 = $photoUrl($se->dokumentasi_2 ?? $se->dokumentasi_foto_2 ?? $se->foto_2 ?? null);
    @endphp
    <section class="klkh-photo-page">
        <div class="klkh-photo-header">
            <img src="{{ asset('dashboard/assets/images/logo-full.png') }}" alt="Logo SIMS">
            <div class="klkh-photo-code">FM-PRD-73/00/10/06/24</div>
        </div>
        <hr>
        <h2>DOKUMENTASI FOTO</h2>
        <div class="klkh-photo-subtitle">Pemeriksaan KKH &amp; KLKH Departemen Produksi Area Intersection (Simpang Empat)</div>
        <table class="klkh-photo-info">
            <tr>
                <td class="klkh-photo-label">PIT</td>
                <td>{{ $se->pit ?? '-' }}</td>
                <td class="klkh-photo-label">Shift</td>
                <td>{{ $se->shift ?? '-' }}</td>
            </tr>
            <tr>
                <td class="klkh-photo-label">Hari/Tanggal</td>
                <td>{{ !empty($se->date) ? Carbon::parse($se->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') : '-' }}</td>
                <td class="klkh-photo-label">Jam</td>
                <td>{{ !empty($se->time) ? Carbon::parse($se->time)->format('H:i') : '-' }}</td>
            </tr>
        </table>
        <div class="klkh-photo-grid">
            <div class="klkh-photo-col">
                <div class="klkh-photo-caption">Dokumentasi 1</div>
                <div class="klkh-photo-frame">
                    @if ($documentation1)
                        <img src="{{ $documentation1 }}" alt="Dokumentasi 1">
                    @else
                        <div class="klkh-photo-empty">Tidak ada foto dokumentasi</div>
                    @endif
                </div>
            </div>
            <div class="klkh-photo-col">
                <div class="klkh-photo-caption">Dokumentasi 2</div>
                <div class="klkh-photo-frame">
                    @if ($documentation2)
                        <img src="{{ $documentation2 }}" alt="Dokumentasi 2">
                    @else
                        <div class="klkh-photo-empty">Tidak ada foto dokumentasi</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    window.print();
</script>
</html>
