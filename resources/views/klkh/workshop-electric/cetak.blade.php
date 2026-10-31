<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLKH Workshop Electric</title>
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
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-WS-65/01/17/03/24</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">
        </div>
        <hr>
        <h1>KELAYAKAN LINGKUNGAN KERJA HARIAN WORKSHOP ELECTRIC</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">Lokasi</th>
                    <th class="noborder nobg">: {{ $el->lokasi }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($el->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($el->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
                <!-- A. Ruangan dan Fasilitas -->
                <tr>
                    <th class="center">A</th>
                    <th>Ruangan dan Fasilitas</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Terdapat Rak Arsip (SOP, JSA, Buku Service).</td>
                    <td class="center">{{ $el->ruangan_fasilitas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->ruangan_fasilitas_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Terdapat ruang tools room yang memadai.</td>
                    <td class="center">{{ $el->ruangan_fasilitas_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->ruangan_fasilitas_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                    <td class="center">{{ $el->ruangan_fasilitas_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->ruangan_fasilitas_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Lampu emergency berfungsi dengan baik.</td>
                    <td class="center">{{ $el->ruangan_fasilitas_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->ruangan_fasilitas_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->ruangan_fasilitas_4_note }}</td>
                </tr>
                <!-- B. Lantai Kerja -->
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
                    <td>Kebersihan lantai dijaga.</td>
                    <td class="center">{{ $el->lantai_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->lantai_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->lantai_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->lantai_kerja_1_note }}</td>
                </tr>
                <!-- C. Peralatan Kerja -->
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
                    <td>Ditata dengan rapi, tidak berserakan.</td>
                    <td class="center">{{ $el->peralatan_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->peralatan_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->peralatan_kerja_1_note }}</td>
                </tr>
                <!-- D. Electrical -->
                <tr>
                    <th class="center">D</th>
                    <th>Electrical</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kabel tidak terkelupas.</td>
                    <td class="center">{{ $el->electrical_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->electrical_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Kabel berkualitas baik.</td>
                    <td class="center">{{ $el->electrical_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->electrical_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                    <td class="center">{{ $el->electrical_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->electrical_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Energi listrik / mesin-mesin menyala tanpa aktivitas.</td>
                    <td class="center">{{ $el->electrical_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->electrical_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->electrical_4_note }}</td>
                </tr>
                <!-- E. Sistem Loto -->
                <tr>
                    <th class="center">E</th>
                    <th>Sistem Loto</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dipasang pada saat peralatan mesin diservice.</td>
                    <td class="center">{{ $el->sistem_loto_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sistem_loto_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sistem_loto_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->sistem_loto_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                    <td class="center">{{ $el->sistem_loto_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sistem_loto_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sistem_loto_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->sistem_loto_2_note }}</td>
                </tr>
                <!-- F. Sparepart Bekas -->
                <tr>
                    <th class="center">F</th>
                    <th>Sparepart Bekas (Bisa Dipakai)</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dirapikan dan dikelompokkan.</td>
                    <td class="center">{{ $el->sparepart_bekas_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sparepart_bekas_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sparepart_bekas_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->sparepart_bekas_1_note }}</td>
                </tr>
                <!-- G. APAR -->
                <tr>
                    <th class="center">G</th>
                    <th>APAR</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Jumlahnya memadai.</td>
                    <td class="center">{{ $el->apar_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->apar_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Mudah dilihat dan dapat dijangkau.</td>
                    <td class="center">{{ $el->apar_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->apar_2_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tekanan APAR normal.</td>
                    <td class="center">{{ $el->apar_3_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_3_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_3_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->apar_3_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Isi APAR normal.</td>
                    <td class="center">{{ $el->apar_4_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_4_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->apar_4_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->apar_4_note }}</td>
                </tr>
                <!-- H. Rambu-rambu Bahaya -->
                <tr>
                    <th class="center">H</th>
                    <th>Rambu-rambu Bahaya</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Dilarang menyalakan api / merokok.</td>
                    <td class="center">{{ $el->rambu_bahaya_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->rambu_bahaya_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->rambu_bahaya_1_note }}</td>
                </tr>
                <!-- I. Tempat Sampah Domestik -->
                <tr>
                    <th class="center">I</th>
                    <th>Tempat Sampah Domestik</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                    <td class="center">{{ $el->sampah_domestik_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sampah_domestik_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sampah_domestik_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->sampah_domestik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                    <td class="center">{{ $el->sampah_domestik_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sampah_domestik_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->sampah_domestik_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->sampah_domestik_2_note }}</td>
                </tr>
                <!-- J. Generator Listrik -->
                <tr>
                    <th class="center">J</th>
                    <th>Generator Listrik</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Kabel listrik dari bahan berkualitas baik.</td>
                    <td class="center">{{ $el->generator_listrik_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->generator_listrik_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->generator_listrik_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->generator_listrik_1_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Stop kontak, saklar, isolasi berfungsi dengan baik.</td>
                    <td class="center">{{ $el->generator_listrik_2_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->generator_listrik_2_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->generator_listrik_2_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->generator_listrik_2_note }}</td>
                </tr>
                <!-- K. Limbah B3 -->
                <tr>
                    <th class="center">K</th>
                    <th>Limbah B3</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Battery bekas dan accu dikelola dengan baik.</td>
                    <td class="center">{{ $el->limbah_b3_1_check == 'true' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->limbah_b3_1_check == 'false' ? '✔️' : '' }}</td>
                    <td class="center">{{ $el->limbah_b3_1_check == 'n/a' ? '✔️' : '' }}</td>
                    <td>{{ $el->limbah_b3_1_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $el->additional_notes !!}</p>
        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Inspektor</td>
                    <td class="noborder nobg">Mengetahui</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($el->verified_pengawas != null)<img src="{{ $el->verified_pengawas }}" style="max-width: 70px;">@endif</td>
                    <td class="noborder nobg">@if ($el->verified_diketahui != null)<img src="{{ $el->verified_diketahui }}" style="max-width: 70px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $el->nama_pengawas ? $el->nama_pengawas : '.......................' }}</td>
                    <td class="noborder nobg">{{ $el->nama_diketahui ? $el->nama_diketahui : '.......................' }}</td>
                </tr>
                <tr style="font-size:8pt;">
                    <td class="noborder nobg">
                        {!! $el->catatan_verified_pengawas != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $el->catatan_verified_pengawas
                            : '' !!}
                    </td>
                    <td class="noborder nobg">
                        {!! $el->catatan_verified_diketahui != null
                            ? '<img src="' . asset("dashboard/assets/images/widget/writing.png") . '" alt="">: ' . $el->catatan_verified_diketahui
                            : '' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="klkh-photo-page">
        @php
            $photoOne = data_get($el, 'dokumentasi_1') ?: data_get($el, 'dokumentasi_foto_1') ?: data_get($el, 'foto_1');
            $photoTwo = data_get($el, 'dokumentasi_2') ?: data_get($el, 'dokumentasi_foto_2') ?: data_get($el, 'foto_2');
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
                <td style="text-align: right;">FM-WS-65/01/17/03/24</td>
            </tr>
        </table>
        <hr>
        <div class="klkh-photo-title">DOKUMENTASI FOTO KLKH WORKSHOP ELECTRIC</div>
        <table class="klkh-photo-meta">
            <tr>
                <td><strong>Lokasi</strong></td>
                <td>: {{ $el->lokasi }}</td>
            </tr>
            <tr>
                <td><strong>Hari/Tanggal</strong></td>
                <td>: {{ Carbon::parse($el->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td><strong>Jam</strong></td>
                <td>: {{ Carbon::parse($el->time)->locale('id')->isoFormat('HH:mm') }}</td>
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
