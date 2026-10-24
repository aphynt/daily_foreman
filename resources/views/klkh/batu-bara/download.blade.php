<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
@php
    $fotoDokumentasi = [];
    foreach (['dokumentasi_1', 'dokumentasi_2'] as $field) {
        $value = trim((string) ($bb->{$field} ?? ''));
        if ($value === '') {
            continue;
        }
        $pathUrl = parse_url($value, PHP_URL_PATH) ?: $value;
        $storagePart = strstr($pathUrl, '/storage/');
        $localPath = null;
        if ($storagePart !== false) {
            $relativePath = ltrim(substr($storagePart, strlen('/storage/')), '/');
            $candidate = storage_path('app/public/' . $relativePath);
            if (is_file($candidate)) {
                $localPath = $candidate;
            } else {
                $candidate = public_path('storage/' . $relativePath);
                if (is_file($candidate)) {
                    $localPath = $candidate;
                }
            }
        }
        if (!$localPath && !preg_match('~^https?://~i', $value)) {
            $candidate = public_path(ltrim($value, '/'));
            if (is_file($candidate)) {
                $localPath = $candidate;
            }
        }
        $fotoDokumentasi[] = [
            'label' => $field === 'dokumentasi_1' ? 'Dokumentasi 1' : 'Dokumentasi 2',
            'src' => $localPath ?: $value,
        ];
    }
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan KKH & KLKH Area Batu Bara</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/fonts/fontawesome.css">
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }
        body {
            font-family: Arial, sans-serif;
            /\ line-height: 1.6; \/
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
            padding: 3px;
            /\text-align: center;\/
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

        .lampiran-foto {
            page-break-before: always;
            break-before: page;
            width: 100%;
            color: #111;
            font-family: Arial, sans-serif;
        }
        .lampiran-header {
            width: 100%;
            border-collapse: collapse;
        }
        .lampiran-header td {
            border: none;
            background: white;
            padding: 0;
        }
        .lampiran-header img {
            width: 200px;
            max-height: 65px;
            object-fit: contain;
        }
        .lampiran-title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            margin: 12px 0 4px;
        }
        .lampiran-subtitle {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .lampiran-meta td {
            border: 1px solid #bbb;
            padding: 6px;
            font-size: 11px;
        }
        .lampiran-label {
            background: #f1f3f5;
            font-weight: bold;
            width: 15%;
        }
        .lampiran-foto-heading {
            margin: 14px 0 10px;
            padding: 9px;
            background: #0d6efd;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
        }
        .lampiran-foto-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }
        .lampiran-foto-table td {
            width: 50%;
            vertical-align: top;
            border: none;
            padding: 0 5px;
        }
        .lampiran-foto-card {
            border: 1px solid #b5bdc8;
            page-break-inside: avoid;
        }
        .lampiran-foto-caption {
            text-align: center;
            font-weight: bold;
            background: #eef2f6;
            border-bottom: 1px solid #b5bdc8;
            padding: 8px;
            font-size: 12px;
        }
        .lampiran-foto-box {
            height: 220mm;
            text-align: center;
            padding: 7px;
        }
        .lampiran-foto-box img {
            max-width: 100%;
            max-height: 213mm;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        .lampiran-kosong {
            padding: 60px 10px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg" style="padding: 0px'margin-bttom:0px"><img src="{{ public_path('dashboard/assets/images/logo-full.png') }}" width="240px"></th>
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-PRD-72/00/12/03/24</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>Pemeriksaan Kesiapan Kerja Harian & Kelayakan Lingkungan Kerja Harian (KLKH) Departemen Produksi Area Batubara</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">PIT</th>
                    <th class="noborder nobg">: {{ $bb->pit }}</th>
                    <th colspan="" class="noborder nobg">Shift</th>
                    <th colspan="3" class="noborder nobg">: {{ $bb->shift }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($bb->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($bb->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                    <th>Coal Loading Point</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">1</td>
                    <td>Lokasi loading point tidak dibawah batuan menggantung</td>
                    <td class="center">{!! $bb->loading_point_check == 'true' ? '<img src="' . public_path('check.png') . '">' : '' !!}</td>
                    <td class="center">{!! $bb->loading_point_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->loading_point_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->loading_point_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Permukaan front aman dari bahaya terjatuh atau terperosok</td>
                    <td class="center">{!! $bb->permukaan_front_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->permukaan_front_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->permukaan_front_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->permukaan_front_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tinggi dan lebar bench kerja sesuai dengan standar</td>
                    <td class="center">{!! $bb->tinggi_bench_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_bench_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_bench_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->tinggi_bench_note !!}</td>
                <tr>
                    <td class="center">4</td>
                    <td>Lebar loading point sesuai dengan standar pada spesifikasi unit loading</td>
                    <td class="center">{!! $bb->lebar_loading_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_loading_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_loading_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->lebar_loading_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Terdapat drainase atau paritan ke arah sump</td>
                    <td class="center">{!! $bb->drainase_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->drainase_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Penempatan unit loading sesuai dengan volume Batubara</td>
                    <td class="center">{!! $bb->penempatan_unit_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->penempatan_unit_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->penempatan_unit_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->penempatan_unit_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Terdapat pelabelan seam batubara di unit (hauler dan loader)</td>
                    <td class="center">{!! $bb->pelabelan_seam_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->pelabelan_seam_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->pelabelan_seam_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->pelabelan_seam_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Unit yang bekerja memiliki lampu dengan intensitas cahaya yang tinggi
                    </td>
                    <td class="center">{!! $bb->lampu_unit_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lampu_unit_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lampu_unit_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->lampu_unit_note !!}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Unit yang bekerja bersih dan sudah dicuci</td>
                    <td class="center">{!! $bb->unit_bersih_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->unit_bersih_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->unit_bersih_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->unit_bersih_note !!}</td>
                </tr>
                <tr>
                    <td class="center">10</td>
                    <td>Penerangan area kerja mencukupi dan terarah untuk pekerjaan malam hari (20-50 lux)</td>
                    <td class="center">{!! $bb->penerangan_area_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->penerangan_area_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->penerangan_area_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->penerangan_area_note !!}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Housekeeping baik (bebas sampah)</td>
                    <td class="center">{!! $bb->housekeeping_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->housekeeping_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->housekeeping_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->housekeeping_note !!}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Telah dilakukan pengukuran roof Batubara oleh survey</td>
                    <td class="center">{!! $bb->pengukuran_roof_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->pengukuran_roof_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->pengukuran_roof_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->pengukuran_roof_note !!}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Telah dilakukan cleaning pada Batubara dan Batubara bebas kontaminan</td>
                    <td class="center">{!! $bb->cleaning_batubara_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->cleaning_batubara_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->cleaning_batubara_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->cleaning_batubara_note !!}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Tidak terdapat genangan air pada Batubara</td>
                    <td class="center">{!! $bb->genangan_air_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->genangan_air_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->genangan_air_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->genangan_air_note !!}</td>
                </tr>
                <tr>
                    <td class="center">15</td>
                    <td>Tidak terdapat big coal</td>
                    <td class="center">{!! $bb->big_coal_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->big_coal_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->big_coal_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->big_coal_note !!}</td>
                </tr>
                <tr>
                    <td class="center">16</td>
                    <td>Stock material cukup</td>
                    <td class="center">{!! $bb->stock_material_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->stock_material_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->stock_material_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->stock_material_note !!}</td>
                </tr>
                <th class="center">B</th>
                <th>Jalan Tambang</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Lebar jalan angkut 3.5 x lebar unit terbesar</td>
                    <td class="center">{!! $bb->lebar_jalan_angkut_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_angkut_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_angkut_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->lebar_jalan_angkut_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Lebar jalan tikungan 4 x lebar unit terbesar</td>
                    <td class="center">{!! $bb->lebar_jalan_tikungan_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_tikungan_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_tikungan_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->lebar_jalan_tikungan_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Super elevasi sesuai standar</td>
                    <td class="center">{!! $bb->super_elevasi_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->super_elevasi_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->super_elevasi_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->super_elevasi_note !!}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Tersedia safety berm pada areal yang mempunyai beda tinggi lebih dari 1 meter</td>
                    <td class="center">{!! $bb->safety_berm_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->safety_berm_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->safety_berm_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->safety_berm_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Tinggi tanggul minimal 2/3 tinggi ban unit terbesar</td>
                    <td class="center">{!! $bb->tinggi_tanggul_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_tanggul_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_tanggul_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->tinggi_tanggul_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat safety post pada tanggul jalan</td>
                    <td class="center">{!! $bb->safety_post_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->safety_post_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->safety_post_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->safety_post_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Tersedia drainase dan tidak ada genangan air di jalan angkut</td>
                    <td class="center">{!! $bb->drainase_genangan_air_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_genangan_air_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_genangan_air_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->drainase_genangan_air_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Terdapat median jalan pada tikungan yang sudutnya lebih besar dari 60°</td>
                    <td class="center">{!! $bb->median_jalan_check == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->median_jalan_check == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $bb->median_jalan_check == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $bb->median_jalan_note !!}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $bb->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Foremen</td>
                    <td class="noborder nobg">Supervisor</td>
                    <td class="noborder nobg">Superintendent</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($bb->verified_foreman != null)<img src="{{ $bb->verified_foreman }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($bb->verified_supervisor != null)<img src="{{ $bb->verified_supervisor }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($bb->verified_superintendent != null)<img src="{{ $bb->verified_superintendent }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $bb->nama_foreman ? $bb->nama_foreman : '.......................' }}</td>
                    <td class="noborder nobg">{{ $bb->nama_supervisor ? $bb->nama_supervisor : '.......................' }}</td>
                    <td class="noborder nobg">{{ $bb->nama_superintendent ? $bb->nama_superintendent : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $bb->catatan_verified_foreman != null
                            ? '<img src="' . public_path("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $bb->catatan_verified_foreman
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $bb->catatan_verified_supervisor != null
                            ? '<img src="' . public_path("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $bb->catatan_verified_supervisor
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $bb->catatan_verified_superintendent != null
                            ? '<img src="' . public_path("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $bb->catatan_verified_superintendent
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="lampiran-foto">
        <table class="lampiran-header">
            <tr>
                <td><img src="{{ public_path('dashboard/assets/images/logo-full.png') }}" alt="SIMS"></td>
                <td style="text-align:right;vertical-align:top;font-size:11px;font-weight:bold;">FM-PRD-72/00/12/03/24</td>
            </tr>
        </table>
        <hr>
        <div class="lampiran-title">DOKUMENTASI FOTO</div>
        <div class="lampiran-subtitle">PEMERIKSAAN KKH &amp; KLKH AREA BATUBARA</div>
        <table class="lampiran-meta">
            <tr>
                <td class="lampiran-label">PIT</td>
                <td>{{ $bb->pit ?? '-' }}</td>
                <td class="lampiran-label">Shift</td>
                <td>{{ $bb->shift ?? '-' }}</td>
            </tr>
            <tr>
                <td class="lampiran-label">Tanggal</td>
                <td>{{ !empty($bb->date) ? Carbon::parse($bb->date)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}</td>
                <td class="lampiran-label">Jam</td>
                <td>{{ !empty($bb->time) ? Carbon::parse($bb->time)->format('H:i') : '-' }}</td>
            </tr>
        </table>
        <div class="lampiran-foto-heading">DOKUMENTASI PEMERIKSAAN</div>
        @if(count($fotoDokumentasi))
            <table class="lampiran-foto-table">
                <tr>
                    @foreach($fotoDokumentasi as $foto)
                        <td>
                            <div class="lampiran-foto-card">
                                <div class="lampiran-foto-caption">{{ $foto['label'] }}</div>
                                <div class="lampiran-foto-box">
                                    <img src="{{ $foto['src'] }}" alt="{{ $foto['label'] }}">
                                </div>
                            </div>
                        </td>
                    @endforeach
                    @if(count($fotoDokumentasi) === 1)
                        <td></td>
                    @endif
                </tr>
            </table>
        @else
            <div class="lampiran-kosong">Belum ada foto dokumentasi.</div>
        @endif
    </div>
</body>
</html>
