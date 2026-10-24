<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
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

        .documentation-page {
            break-before: page;
            page-break-before: always;
            box-sizing: border-box;
            width: 100%;
            min-height: 277mm;
            padding: 5mm 3mm;
            color: #111;
            background: #fff;
        }
        .documentation-heading {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            margin: 5mm 0 2mm;
        }
        .documentation-subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 5mm;
        }
        .documentation-info td {
            border: 1px solid #ccc;
            padding: 7px;
            font-size: 11px;
        }
        .documentation-info-label {
            background: #eee;
            font-weight: 700;
            width: 16%;
        }
        .documentation-section {
            background: #0d6efd;
            color: #fff;
            font-weight: 700;
            text-align: center;
            padding: 8px;
            margin: 4mm 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .documentation-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 4mm;
        }
        .documentation-card {
            border: 1px solid #bbb;
            min-width: 0;
            height: 210mm;
            break-inside: avoid;
            page-break-inside: avoid;
        }
        .documentation-card-title {
            text-align: center;
            background: #f0f3f7;
            border-bottom: 1px solid #bbb;
            padding: 8px;
            font-weight: 700;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .documentation-image-area {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 198mm;
            padding: 3mm;
            overflow: hidden;
        }
        .documentation-image {
            display: block;
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        .documentation-empty {
            color: #777;
            font-size: 12px;
            text-align: center;
        }
        @media print {
            .documentation-page {
                break-before: page;
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg" style="padding: 0px'margin-bttom:0px"><img src="{{ asset('dashboard/assets') }}/images/logo-full.png" width="240px"></th>
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
                    <td class="center">{!! $bb->loading_point_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $bb->loading_point_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->loading_point_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->loading_point_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Permukaan front aman dari bahaya terjatuh atau terperosok</td>
                    <td class="center">{!! $bb->permukaan_front_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->permukaan_front_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->permukaan_front_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->permukaan_front_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tinggi dan lebar bench kerja sesuai dengan standar</td>
                    <td class="center">{!! $bb->tinggi_bench_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_bench_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_bench_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->tinggi_bench_note !!}</td>
                <tr>
                    <td class="center">4</td>
                    <td>Lebar loading point sesuai dengan standar pada spesifikasi unit loading</td>
                    <td class="center">{!! $bb->lebar_loading_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_loading_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_loading_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->lebar_loading_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Terdapat drainase atau paritan ke arah sump</td>
                    <td class="center">{!! $bb->drainase_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->drainase_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Penempatan unit loading sesuai dengan volume Batubara</td>
                    <td class="center">{!! $bb->penempatan_unit_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->penempatan_unit_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->penempatan_unit_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->penempatan_unit_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Terdapat pelabelan seam batubara di unit (hauler dan loader)</td>
                    <td class="center">{!! $bb->pelabelan_seam_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->pelabelan_seam_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->pelabelan_seam_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->pelabelan_seam_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Unit yang bekerja memiliki lampu dengan intensitas cahaya yang tinggi
                    </td>
                    <td class="center">{!! $bb->lampu_unit_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lampu_unit_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lampu_unit_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->lampu_unit_note !!}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Unit yang bekerja bersih dan sudah dicuci</td>
                    <td class="center">{!! $bb->unit_bersih_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->unit_bersih_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->unit_bersih_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->unit_bersih_note !!}</td>
                </tr>
                <tr>
                    <td class="center">10</td>
                    <td>Penerangan area kerja mencukupi dan terarah untuk pekerjaan malam hari (20-50 lux)</td>
                    <td class="center">{!! $bb->penerangan_area_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->penerangan_area_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->penerangan_area_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->penerangan_area_note !!}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Housekeeping baik (bebas sampah)</td>
                    <td class="center">{!! $bb->housekeeping_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->housekeeping_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->housekeeping_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->housekeeping_note !!}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Telah dilakukan pengukuran roof Batubara oleh survey</td>
                    <td class="center">{!! $bb->pengukuran_roof_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->pengukuran_roof_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->pengukuran_roof_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->pengukuran_roof_note !!}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Telah dilakukan cleaning pada Batubara dan Batubara bebas kontaminan</td>
                    <td class="center">{!! $bb->cleaning_batubara_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->cleaning_batubara_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->cleaning_batubara_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->cleaning_batubara_note !!}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Tidak terdapat genangan air pada Batubara</td>
                    <td class="center">{!! $bb->genangan_air_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->genangan_air_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->genangan_air_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->genangan_air_note !!}</td>
                </tr>
                <tr>
                    <td class="center">15</td>
                    <td>Tidak terdapat big coal</td>
                    <td class="center">{!! $bb->big_coal_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->big_coal_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->big_coal_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->big_coal_note !!}</td>
                </tr>
                <tr>
                    <td class="center">16</td>
                    <td>Stock material cukup</td>
                    <td class="center">{!! $bb->stock_material_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->stock_material_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->stock_material_check == 'n/a' ? '✔️' : "" !!}</td>
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
                    <td class="center">{!! $bb->lebar_jalan_angkut_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_angkut_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_angkut_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->lebar_jalan_angkut_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Lebar jalan tikungan 4 x lebar unit terbesar</td>
                    <td class="center">{!! $bb->lebar_jalan_tikungan_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_tikungan_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->lebar_jalan_tikungan_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->lebar_jalan_tikungan_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Super elevasi sesuai standar</td>
                    <td class="center">{!! $bb->super_elevasi_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->super_elevasi_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->super_elevasi_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->super_elevasi_note !!}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Tersedia safety berm pada areal yang mempunyai beda tinggi lebih dari 1 meter</td>
                    <td class="center">{!! $bb->safety_berm_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->safety_berm_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->safety_berm_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->safety_berm_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Tinggi tanggul minimal 2/3 tinggi ban unit terbesar</td>
                    <td class="center">{!! $bb->tinggi_tanggul_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_tanggul_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->tinggi_tanggul_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->tinggi_tanggul_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat safety post pada tanggul jalan</td>
                    <td class="center">{!! $bb->safety_post_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->safety_post_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->safety_post_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->safety_post_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Tersedia drainase dan tidak ada genangan air di jalan angkut</td>
                    <td class="center">{!! $bb->drainase_genangan_air_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_genangan_air_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->drainase_genangan_air_check == 'n/a' ? '✔️' : "" !!}</td>
                    <td>{!! $bb->drainase_genangan_air_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Terdapat median jalan pada tikungan yang sudutnya lebih besar dari 60°</td>
                    <td class="center">{!! $bb->median_jalan_check == 'true' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->median_jalan_check == 'false' ? '✔️' : "" !!}</td>
                    <td class="center">{!! $bb->median_jalan_check == 'n/a' ? '✔️' : "" !!}</td>
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
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $bb->catatan_verified_foreman
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $bb->catatan_verified_supervisor != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $bb->catatan_verified_supervisor
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $bb->catatan_verified_superintendent != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $bb->catatan_verified_superintendent
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@php
    $getPhotoUrl = function ($path) {
        if (empty($path)) return null;
        $path = trim((string) $path);
        if (preg_match('~^https?://~i', $path)) return $path;
        return asset(ltrim($path, '/'));
    };
    $documentationPhotos = [
        $getPhotoUrl($bb->dokumentasi_1 ?? $bb->dokumentasi_foto_1 ?? $bb->foto_1 ?? null),
        $getPhotoUrl($bb->dokumentasi_2 ?? $bb->dokumentasi_foto_2 ?? $bb->foto_2 ?? null)
    ];
@endphp
<div class="documentation-page">
    <table class="point-table">
        <tr>
            <td class="noborder nobg" style="width:50%;">
                <img src="{{ asset('dashboard/assets') }}/images/logo-full.png" width="240" alt="Logo SIMS">
            </td>
            <td class="noborder nobg kanan" style="width:50%;font-weight:700;">FM-PRD-72/00/12/03/24</td>
        </tr>
    </table>
    <hr>
    <div class="documentation-heading">DOKUMENTASI</div>
    <div class="documentation-subtitle">Pemeriksaan Kesiapan Kerja Harian & Kelayakan Lingkungan Kerja Harian (KLKH) Area Batubara</div>
    <table class="documentation-info">
        <tr>
            <td class="documentation-info-label">Tanggal</td>
            <td>{{ Carbon::parse($bb->date)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
            <td class="documentation-info-label">PIT</td>
            <td>{{ $bb->pit ?? '-' }}</td>
        </tr>
        <tr>
            <td class="documentation-info-label">Shift</td>
            <td>{{ $bb->shift ?? '-' }}</td>
            <td class="documentation-info-label">Jam</td>
            <td>{{ !empty($bb->time) ? Carbon::parse($bb->time)->format('H:i') : '-' }}</td>
        </tr>
    </table>
    <div class="documentation-grid">
        @foreach($documentationPhotos as $index => $photo)
            <div class="documentation-card">
                <div class="documentation-card-title">Dokumentasi Foto {{ $index + 1 }}</div>
                <div class="documentation-image-area">
                    @if($photo)
                        <img class="documentation-image" src="{{ $photo }}" alt="Dokumentasi Foto {{ $index + 1 }}">
                    @else
                        <span class="documentation-empty">Tidak ada foto</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
<script>
    window.print();
</script>
</html>
