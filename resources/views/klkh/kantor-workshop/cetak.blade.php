<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Kantor Workshop</title>
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-WS-66/01/17/03/24</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN KANTOR WORKSHOP</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $ws->lokasi }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($ws->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($ws->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                    <td>Struktur bangunan kokoh.</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->bangunan_fasilitas_1_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Terdapat lemari arsip.</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->bangunan_fasilitas_2_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Lampu terang dan jumlahnya memadai.</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->bangunan_fasilitas_3_note !!}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Denah evakuasi ditempel dengan jelas.</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->bangunan_fasilitas_4_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_5_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_5_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->bangunan_fasilitas_5_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->bangunan_fasilitas_5_note !!}</td>
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
                    <td>Kebersihan Lantai.</td>
                    <td class="center">{!! $ws->lantai_kerja_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->lantai_kerja_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->lantai_kerja_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->lantai_kerja_1_note !!}</td>
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
                    <td class="center">{!! $ws->peralatan_kerja_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->peralatan_kerja_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->peralatan_kerja_1_note !!}</td>
                </tr>
                <tr>
                    <th class="center">D</th>
                    <th>Electric</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kabel tidak terkelupas.</td>
                    <td class="center">{!! $ws->electric_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->electric_1_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Kabel berkualitas baik.</td>
                    <td class="center">{!! $ws->electric_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->electric_2_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                    <td class="center">{!! $ws->electric_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->electric_3_note !!}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Energi listrik / mesin-mesin menyala tanpa aktivitas.</td>
                    <td class="center">{!! $ws->electric_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->electric_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->electric_4_note !!}</td>
                </tr>
                <tr>
                    <th class="center">E</th>
                    <th>APAR</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Jumlahnya memadai.</td>
                    <td class="center">{!! $ws->apar_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->apar_1_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{!! $ws->apar_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->apar_2_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tekanan APAR normal.</td>
                    <td class="center">{!! $ws->apar_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->apar_3_note !!}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Isi APAR normal.</td>
                    <td class="center">{!! $ws->apar_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->apar_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->apar_4_note !!}</td>
                </tr>
                <tr>
                    <th class="center">F</th>
                    <th>Rambu-rambu Bahaya</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dilarang menyalakan api / merokok.</td>
                    <td class="center">{!! $ws->rambu_bahaya_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->rambu_bahaya_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->rambu_bahaya_1_note !!}</td>
                </tr>
                <tr>
                    <th class="center">G</th>
                    <th>Tempat Sampah Domestik</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                    <td class="center">{!! $ws->sampah_domestik_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->sampah_domestik_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->sampah_domestik_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->sampah_domestik_1_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                    <td class="center">{!! $ws->sampah_domestik_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->sampah_domestik_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->sampah_domestik_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->sampah_domestik_2_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                    <td class="center">{!! $ws->sampah_domestik_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->sampah_domestik_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->sampah_domestik_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->sampah_domestik_3_note !!}</td>
                </tr>
                <tr>
                    <th class="center">H</th>
                    <th>Pemadam Hydran</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Tempat hose air mudah dibuka.</td>
                    <td class="center">{!! $ws->pemadam_hydran_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->pemadam_hydran_1_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Kran air berfungsi dengan baik.</td>
                    <td class="center">{!! $ws->pemadam_hydran_2_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_2_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_2_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->pemadam_hydran_2_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Pompa air berfungsi dengan baik.</td>
                    <td class="center">{!! $ws->pemadam_hydran_3_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_3_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_3_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->pemadam_hydran_3_note !!}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Kapasitas air memadai.</td>
                    <td class="center">{!! $ws->pemadam_hydran_4_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_4_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->pemadam_hydran_4_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->pemadam_hydran_4_note !!}</td>
                </tr>
                <tr>
                    <th class="center">I</th>
                    <th>Paparan Debu</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Tidak ada paparan debu halus yang melekat pada kisi-kisi AC, horden jendela, bagian atas lemari, sela-sela rak kertas dan lainnya.</td>
                    <td class="center">{!! $ws->paparan_debu_1_check == 'true' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->paparan_debu_1_check == 'false' ? '✔️' : '' !!}</td>
                    <td class="center">{!! $ws->paparan_debu_1_check == 'n/a' ? '✔️' : '' !!}</td>
                    <td>{!! $ws->paparan_debu_1_note !!}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $ws->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Mengetahui</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($ws->verified_pengawas != null)<img src="{{ $ws->verified_pengawas }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($ws->verified_diketahui != null)<img src="{{ $ws->verified_diketahui }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $ws->nama_pengawas ? $ws->nama_pengawas : '.......................' }}</td>
                    <td class="noborder nobg">{{ $ws->nama_diketahui ? $ws->nama_diketahui : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $ws->catatan_verified_pengawas != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $ws->catatan_verified_pengawas
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $ws->catatan_verified_diketahui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $ws->catatan_verified_diketahui
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($ws, 'dokumentasi_1') ?: data_get($ws, 'dokumentasi_foto_1') ?: data_get($ws, 'foto_1');
            $photoTwo = data_get($ws, 'dokumentasi_2') ?: data_get($ws, 'dokumentasi_foto_2') ?: data_get($ws, 'foto_2');
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
                <td style="text-align: right;">FM-WS-66/01/17/03/24</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH KANTOR WORKSHOP</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $ws->lokasi }}</td>
            </tr>
            <tr>
                <td><strong>Hari/Tanggal</strong></td>
                <td>: {{ Carbon::parse($ws->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td><strong>Jam</strong></td>
                <td>: {{ Carbon::parse($ws->time)->locale('id')->isoFormat('HH:mm') }}</td>
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
