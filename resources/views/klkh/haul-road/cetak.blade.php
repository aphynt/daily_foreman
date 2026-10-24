<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan KKH & KLKH Area Haul Road</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/fonts/fontawesome.css">
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }
        body {
            font-family: Arial, sans-serif;
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
            padding: 3px;
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
            break-before: page;
            page-break-before: always;
            width: 100%;
            box-sizing: border-box;
            color: #111;
        }
        .klkh-photo-page .klkh-photo-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }
        .klkh-photo-page .klkh-photo-header img {
            width: 205px;
            max-height: 55px;
            object-fit: contain;
        }
        .klkh-photo-page .klkh-photo-code {
            font-size: 11px;
            text-align: right;
        }
        .klkh-photo-page h2 {
            font-size: 19px;
            line-height: 1.3;
            margin: 14px 0 5px;
            text-align: center;
        }
        .klkh-photo-page .klkh-photo-subtitle {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .klkh-photo-page .klkh-photo-info td {
            padding: 7px 9px;
            font-size: 11px;
            border: 1px solid #aaa;
        }
        .klkh-photo-page .klkh-photo-info .klkh-photo-label {
            font-weight: bold;
            background: #f0f2f5;
            width: 17%;
        }
        .klkh-photo-page .klkh-photo-bar {
            padding: 9px;
            font-weight: bold;
            text-align: center;
            background: #e8edf4;
            border: 1px solid #b8c5d4;
            margin: 12px 0;
        }
        .klkh-photo-page .klkh-photo-grid {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-spacing: 8px 0;
        }
        .klkh-photo-page .klkh-photo-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            border: 1px solid #c5cbd3;
        }
        .klkh-photo-page .klkh-photo-caption {
            text-align: center;
            padding: 9px;
            font-weight: bold;
            background: #f4f6f8;
            border-bottom: 1px solid #c5cbd3;
        }
        .klkh-photo-page .klkh-photo-frame {
            height: 570px;
            text-align: center;
            padding: 8px;
            box-sizing: border-box;
        }
        .klkh-photo-page .klkh-photo-frame img {
            display: block;
            max-width: 100%;
            max-height: 545px;
            width: auto;
            height: auto;
            margin: 0 auto;
            object-fit: contain;
        }
        .klkh-photo-page .klkh-photo-empty {
            padding: 200px 4px 0;
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
                    <th class="noborder nobg" style="padding: 0px; margin-bottom: 0px;"><img src="{{ asset('dashboard/assets') }}/images/logo-full.png" width="240px"></th>
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-PRD-51/01/18/10/22</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>Pemeriksaan Kesiapan Kerja Harian & Kelayakan Lingkungan Kerja Harian (KLKH) Departemen Produksi Area Haul Road</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">PIT</th>
                    <th class="noborder nobg">: {{ $hr->pit }}</th>
                    <th colspan="" class="noborder nobg">Shift</th>
                    <th colspan="3" class="noborder nobg">: {{ $hr->shift }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($hr->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($hr->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                    <td class="center">1</td>
                    <td>Lebar jalan angkut 3,5x unit terbesar</td>
                    <td class="center">{!! $hr->road_width_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $hr->road_width_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->road_width_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->road_width_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Lebar jalan tikungan 4x unit terbesar</td>
                    <td class="center">{!! $hr->curve_width_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->curve_width_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->curve_width_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->curve_width_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Super elevasi sesuai dengan standar</td>
                    <td class="center">{!! $hr->super_elevation_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->super_elevation_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->super_elevation_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->super_elevation_note !!}</td>
                <tr>
                    <td class="center">4</td>
                    <td>Tersedia safety berm pada areal yang mempunyai beda tinggi lebih dari 1 meter</td>
                    <td class="center">{!! $hr->safety_berm_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->safety_berm_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->safety_berm_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->safety_berm_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Tanggul jalan minimal 3/4 tinggi ban unit terbesar</td>
                    <td class="center">{!! $hr->tanggul_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->tanggul_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->tanggul_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->tanggul_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat patok safety pada jarak 20 meter dengan tinggi 2 meter</td>
                    <td class="center">{!! $hr->safety_patok_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->safety_patok_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->safety_patok_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->safety_patok_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Tersedia drainage dan tidak ada genangan air di jalan angkut</td>
                    <td class="center">{!! $hr->drainage_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->drainage_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->drainage_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->drainage_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Terdapat median jalan pada tikungan yang sudutnya lebih besar dari 60o</td>
                    <td class="center">{!! $hr->median_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->median_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->median_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->median_note !!}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Intersection sesuai dengan standar</td>
                    <td class="center">{!! $hr->intersection_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->intersection_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->intersection_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->intersection_note !!}</td>
                </tr>
                <tr>
                    <td class="center">10</td>
                    <td>Tersedia rambu-rambu lalu lintas jalan dan post guide lengkap (ada lapisan pantul cahaya)</td>
                    <td class="center">{!! $hr->traffic_sign_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->traffic_sign_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->traffic_sign_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->traffic_sign_note !!}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Tersedia rambu-rambu dan lampu (  untuk pekerjaan malam hari ) di persimpangan jalan dan tidak ada blind spot</td>
                    <td class="center">{!! $hr->night_work_sign_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->night_work_sign_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->night_work_sign_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->night_work_sign_note !!}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Kondisi jalan cross fall dan tidak bergelombang</td>
                    <td class="center">{!! $hr->road_condition_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->road_condition_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->road_condition_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->road_condition_note !!}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Adanya jalur pemisah atau marka jalan, bila diperlukan</td>
                    <td class="center">{!! $hr->divider_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->divider_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->divider_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->divider_note !!}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Jalur angkut rata, tidak bergelombang, dan bebas dari tumpahan material dan spoil-spoil</td>
                    <td class="center">{!! $hr->haul_route_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->haul_route_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->haul_route_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->haul_route_note !!}</td>
                </tr>
                <tr>
                    <td class="center">15</td>
                    <td>Terdapat penyiraman jalan sebagai pengendalian debu pada jalan</td>
                    <td class="center">{!! $hr->dust_control_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->dust_control_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->dust_control_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->dust_control_note !!}</td>
                </tr>
                <tr>
                    <td class="center">16</td>
                    <td>Tersedia petugas pengatur simpang- 4</td>
                    <td class="center">{!! $hr->intersection_officer_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->intersection_officer_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->intersection_officer_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->intersection_officer_note !!}</td>
                </tr>
                <tr>
                    <td class="center">17</td>
                    <td>Lampu merah berfungsi baik</td>
                    <td class="center">{!! $hr->red_light_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->red_light_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $hr->red_light_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $hr->red_light_note !!}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $hr->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Foremen</td>
                    <td class="noborder nobg">Supervisor</td>
                    <td class="noborder nobg">Superintendent</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($hr->verified_foreman != null)<img src="{{ $hr->verified_foreman }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($hr->verified_supervisor != null)<img src="{{ $hr->verified_supervisor }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($hr->verified_superintendent != null)<img src="{{ $hr->verified_superintendent }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $hr->nama_foreman ? $hr->nama_foreman : '.......................' }}</td>
                    <td class="noborder nobg">{{ $hr->nama_supervisor ? $hr->nama_supervisor : '.......................' }}</td>
                    <td class="noborder nobg">{{ $hr->nama_superintendent ? $hr->nama_superintendent : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $hr->catatan_verified_foreman != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $hr->catatan_verified_foreman
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $hr->catatan_verified_supervisor != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $hr->catatan_verified_supervisor
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $hr->catatan_verified_superintendent != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $hr->catatan_verified_superintendent
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
            if (preg_match('#^https?://#i', $value)) {
                return $value;
            }
            if (str_starts_with($value, '/storage/')) {
                return asset(ltrim($value, '/'));
            }
            if (str_starts_with($value, 'storage/')) {
                return asset($value);
            }
            return asset('storage/' . ltrim($value, '/'));
        };
        $documentation1 = $photoUrl($hr->dokumentasi_1 ?? $hr->dokumentasi_foto_1 ?? $hr->foto_1 ?? null);
        $documentation2 = $photoUrl($hr->dokumentasi_2 ?? $hr->dokumentasi_foto_2 ?? $hr->foto_2 ?? null);
    @endphp
    <section class="klkh-photo-page">
        <div class="klkh-photo-header">
            <img src="{{ asset('dashboard/assets/images/logo-full.png') }}" alt="Logo SIMS">
            <div class="klkh-photo-code">FM-PRD-51/01/18/10/22</div>
        </div>
        <hr>
        <h2>DOKUMENTASI FOTO</h2>
        <div class="klkh-photo-subtitle">Pemeriksaan KKH &amp; KLKH Departemen Produksi Area Haul Road</div>
        <table class="klkh-photo-info">
            <tr>
                <td class="klkh-photo-label">PIT</td>
                <td>{{ $hr->pit ?? '-' }}</td>
                <td class="klkh-photo-label">Shift</td>
                <td>{{ $hr->shift ?? '-' }}</td>
            </tr>
            <tr>
                <td class="klkh-photo-label">Hari/Tanggal</td>
                <td>{{ !empty($hr->date) ? Carbon::parse($hr->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') : '-' }}</td>
                <td class="klkh-photo-label">Jam</td>
                <td>{{ !empty($hr->time) ? Carbon::parse($hr->time)->format('H:i') : '-' }}</td>
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
