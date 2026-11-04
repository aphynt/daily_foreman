@include('layout.head', ['title' => 'Inspeksi Internal Area Tandem'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $report = $sp;

    $isChecked = function ($value) {
        return (int) $value === 1 ? 'checked' : '';
    };

    $imageUrl = function ($path) {
        if (!$path) return null;

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    };

    $foto1 = $imageUrl($report->dokumentasi_1 ?? null);
    $foto2 = $imageUrl($report->dokumentasi_2 ?? null);
@endphp
<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="row align-items-center g-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('dashboard/assets') }}/images/logo-full.png"
                                                class="img-fluid"
                                                alt="images"
                                                style="max-width:200px;">
                                        </div>
                                    </div>

                                    <div class="col-6 text-end">
                                        <h6>FM-ENG-DEW-09/02/16/12/25</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">INSPEKSI INTERNAL AREA TANDEM</h5>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Tanggal:</h6>
                                    <h5>{{ Carbon::parse($sp->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Nama Lokasi:</h6>
                                    <h5>{{ $sp->nama_lokasi }}</h5>
                                </div>
                            </div>
                            <div class="alert alert-primary">
                                <div class="d-flex align-items-center"><i class="ti ti-info-circle h2 f-w-400 mb-0"></i>
                                    <div class="flex-grow-1 ms-3">S <i>(sesuai)</i> atau TS <i>(Tidak Sesuai)</i> pada kolom Kesesuaian sesuai hasil pengamatan</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Deskripsi Pemeriksaan</th>
                                                <th>Kesesuaian</th>
                                                <th>Tindak Lanjut Perbaikan</th>
                                                <th>Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="font-weight: bold;">
                                                <td>1</td>
                                                <td colspan="4">Pekerja</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Jumlah pekerja minimal 2 orang</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_1_check }}</td>
                                                <td>{{ $sp->pekerja_1_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_1_due ? \Carbon\Carbon::parse($sp->pekerja_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Pekerja memiliki Kartu High Risk (izin kerja di area berisiko tinggi)</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_2_check }}</td>
                                                <td>{{ $sp->pekerja_2_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_2_due ? \Carbon\Carbon::parse($sp->pekerja_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>P2H ada dan telah diverifikasi</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_3_check }}</td>
                                                <td>{{ $sp->pekerja_3_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_3_due ? \Carbon\Carbon::parse($sp->pekerja_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>KLKH telah dibuat</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_4_check }}</td>
                                                <td>{{ $sp->pekerja_4_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pekerja_4_due ? \Carbon\Carbon::parse($sp->pekerja_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Pondok dan Fasilitas</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Atap pondok dalam keadaan baik dan tidak ada kebocoran</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_1_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_1_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_1_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Dinding pondok dalam keadaan baik dan tidak ada kerusakan</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_2_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_2_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_2_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Lantai dalam keadaan baik dan bersih</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_3_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_3_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_3_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Pintu, jendela, dan sirkulasi udara di dalam pondok baik</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_4_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_4_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_4_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Lampu menyala dengan baik</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_5_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_5_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_5_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.6</td>
                                                <td>Radio komunikasi berfungsi dan tidak ada kerusakan</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_6_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_6_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_6_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.7</td>
                                                <td>Kotak P3K di pondok operator lengkap dan mudah diakses</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_7_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_7_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_7_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.8</td>
                                                <td>Kondisi di dalam pondok bersih dan bebas sampah</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_8_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_8_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_8_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.9</td>
                                                <td>Kondisi dinding di luar pondok bersih</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_9_check }}</td>
                                                <td>{{ $sp->pondok_fasilitas_9_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pondok_fasilitas_9_due ? \Carbon\Carbon::parse($sp->pondok_fasilitas_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">Electrical</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Kabel rapi, dalam kondisi baik dan tidak terkelupas</td>
                                                <td style="text-align:center;">{{ $sp->electrical_1_check }}</td>
                                                <td>{{ $sp->electrical_1_action }}</td>
                                                <td style="text-align:center;">{{ $sp->electrical_1_due ? \Carbon\Carbon::parse($sp->electrical_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Stop kontak/sambungan ke sumber listrik baik</td>
                                                <td style="text-align:center;">{{ $sp->electrical_2_check }}</td>
                                                <td>{{ $sp->electrical_2_action }}</td>
                                                <td style="text-align:center;">{{ $sp->electrical_2_due ? \Carbon\Carbon::parse($sp->electrical_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Energi listrik/mesin-mesin tidak running tanpa aktivitas</td>
                                                <td style="text-align:center;">{{ $sp->electrical_3_check }}</td>
                                                <td>{{ $sp->electrical_3_action }}</td>
                                                <td style="text-align:center;">{{ $sp->electrical_3_due ? \Carbon\Carbon::parse($sp->electrical_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Fasilitas dan Keselamatan</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Ketersediaan APAR: ada, tekanan normal, dan masih valid (cek tanggal kedaluwarsa)</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_1_check }}</td>
                                                <td>{{ $sp->fasilitas_keselamatan_1_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_1_due ? \Carbon\Carbon::parse($sp->fasilitas_keselamatan_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Perlengkapan APD operator: helm, rompi reflektif, sepatu safety, sarung tangan</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_2_check }}</td>
                                                <td>{{ $sp->fasilitas_keselamatan_2_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_2_due ? \Carbon\Carbon::parse($sp->fasilitas_keselamatan_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Ketersediaan logbook/checklist manual di pondok operator</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_3_check }}</td>
                                                <td>{{ $sp->fasilitas_keselamatan_3_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_3_due ? \Carbon\Carbon::parse($sp->fasilitas_keselamatan_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.4</td>
                                                <td>Tersedia senter</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_4_check }}</td>
                                                <td>{{ $sp->fasilitas_keselamatan_4_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_4_due ? \Carbon\Carbon::parse($sp->fasilitas_keselamatan_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.5</td>
                                                <td>Tersedia ear plug</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_5_check }}</td>
                                                <td>{{ $sp->fasilitas_keselamatan_5_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_5_due ? \Carbon\Carbon::parse($sp->fasilitas_keselamatan_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.6</td>
                                                <td>Tersedia raincoat (jas hujan)</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_6_check }}</td>
                                                <td>{{ $sp->fasilitas_keselamatan_6_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_6_due ? \Carbon\Carbon::parse($sp->fasilitas_keselamatan_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.7</td>
                                                <td>Tersedia eye wash</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_7_check }}</td>
                                                <td>{{ $sp->fasilitas_keselamatan_7_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_keselamatan_7_due ? \Carbon\Carbon::parse($sp->fasilitas_keselamatan_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>5</td>
                                                <td colspan="4">Lingkungan</td>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Kondisi rambu di sekitar Tandem terpasang dan terbaca jelas</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_1_check }}</td>
                                                <td>{{ $sp->lingkungan_1_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_1_due ? \Carbon\Carbon::parse($sp->lingkungan_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Kondisi lingkungan kerja bersih dan bebas sampah</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_2_check }}</td>
                                                <td>{{ $sp->lingkungan_2_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_2_due ? \Carbon\Carbon::parse($sp->lingkungan_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.3</td>
                                                <td>Memiliki tempat sampah bertutup dan dalam kondisi baik</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_3_check }}</td>
                                                <td>{{ $sp->lingkungan_3_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_3_due ? \Carbon\Carbon::parse($sp->lingkungan_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.4</td>
                                                <td>Lampu penerangan cukup untuk pekerjaan pada malam hari</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_4_check }}</td>
                                                <td>{{ $sp->lingkungan_4_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_4_due ? \Carbon\Carbon::parse($sp->lingkungan_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.5</td>
                                                <td>Tidak terdapat ceceran limbah B3</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_5_check }}</td>
                                                <td>{{ $sp->lingkungan_5_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lingkungan_5_due ? \Carbon\Carbon::parse($sp->lingkungan_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>6</td>
                                                <td colspan="4">Engine &amp; Pompa</td>
                                            </tr>
                                            <tr>
                                                <td>6.1</td>
                                                <td>Kondisi pompa bersih dari sampah dan ceceran limbah B3</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_1_check }}</td>
                                                <td>{{ $sp->engine_pompa_1_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_1_due ? \Carbon\Carbon::parse($sp->engine_pompa_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.2</td>
                                                <td>Rotary lamp menyala dengan baik</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_2_check }}</td>
                                                <td>{{ $sp->engine_pompa_2_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_2_due ? \Carbon\Carbon::parse($sp->engine_pompa_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.3</td>
                                                <td>Kondisi hose-hose dalam keadaan baik dan tidak ada kebocoran</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_3_check }}</td>
                                                <td>{{ $sp->engine_pompa_3_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_3_due ? \Carbon\Carbon::parse($sp->engine_pompa_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.4</td>
                                                <td>Kondisi coupling/kopel pompa dan motor, alignment dan getaran dalam batas normal</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_4_check }}</td>
                                                <td>{{ $sp->engine_pompa_4_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_4_due ? \Carbon\Carbon::parse($sp->engine_pompa_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.5</td>
                                                <td>Kondisi bearing/bantalan pompa tidak terdapat bunyi abnormal atau panas berlebih</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_5_check }}</td>
                                                <td>{{ $sp->engine_pompa_5_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_5_due ? \Carbon\Carbon::parse($sp->engine_pompa_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.6</td>
                                                <td>Kondisi check valve, duty valve dan drain valve berfungsi dengan baik dan tidak keras</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_6_check }}</td>
                                                <td>{{ $sp->engine_pompa_6_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_6_due ? \Carbon\Carbon::parse($sp->engine_pompa_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.7</td>
                                                <td>Pipa penyalur tidak bocor atau retak dan telah dilakukan pemeriksaan NDT</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_7_check }}</td>
                                                <td>{{ $sp->engine_pompa_7_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_7_due ? \Carbon\Carbon::parse($sp->engine_pompa_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.8</td>
                                                <td>Kondisi level oli pompa dan mesin penggerak dalam batas aman</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_8_check }}</td>
                                                <td>{{ $sp->engine_pompa_8_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_8_due ? \Carbon\Carbon::parse($sp->engine_pompa_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.9</td>
                                                <td>Kebersihan radiator/pendingin mesin bebas dari lumpur dan kotoran lain</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_9_check }}</td>
                                                <td>{{ $sp->engine_pompa_9_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_9_due ? \Carbon\Carbon::parse($sp->engine_pompa_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.10</td>
                                                <td>Kondisi battery dan koneksi kabel: terminal bersih, tidak longgar, tegangan sesuai</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_10_check }}</td>
                                                <td>{{ $sp->engine_pompa_10_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_10_due ? \Carbon\Carbon::parse($sp->engine_pompa_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.11</td>
                                                <td>Kondisi fuel line dan tangki solar tidak bocor, filter bersih</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_11_check }}</td>
                                                <td>{{ $sp->engine_pompa_11_action }}</td>
                                                <td style="text-align:center;">{{ $sp->engine_pompa_11_due ? \Carbon\Carbon::parse($sp->engine_pompa_11_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>7</td>
                                                <td colspan="4">Pipa HDPE</td>
                                            </tr>
                                            <tr>
                                                <td>7.1</td>
                                                <td>Kondisi fisik pipa HDPE baik (tidak retak, abrasi, deformasi)</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_1_check }}</td>
                                                <td>{{ $sp->pipa_hdpe_1_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_1_due ? \Carbon\Carbon::parse($sp->pipa_hdpe_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.2</td>
                                                <td>Potongan pipa HDPE telah dirapikan</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_2_check }}</td>
                                                <td>{{ $sp->pipa_hdpe_2_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_2_due ? \Carbon\Carbon::parse($sp->pipa_hdpe_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.3</td>
                                                <td>Kondisi sambungan baik, tidak bocor, sambungan rapi</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_3_check }}</td>
                                                <td>{{ $sp->pipa_hdpe_3_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_3_due ? \Carbon\Carbon::parse($sp->pipa_hdpe_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.4</td>
                                                <td>Kondisi fitting dan valve connection</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_4_check }}</td>
                                                <td>{{ $sp->pipa_hdpe_4_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_4_due ? \Carbon\Carbon::parse($sp->pipa_hdpe_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.5</td>
                                                <td>Jalur pipa tidak tertekuk, tidak ada erosi dan potensi terkena longsoran</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_5_check }}</td>
                                                <td>{{ $sp->pipa_hdpe_5_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_5_due ? \Carbon\Carbon::parse($sp->pipa_hdpe_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.6</td>
                                                <td>Tidak ada kebocoran selama operasi</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_6_check }}</td>
                                                <td>{{ $sp->pipa_hdpe_6_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_6_due ? \Carbon\Carbon::parse($sp->pipa_hdpe_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.7</td>
                                                <td>Tersedia label dan rambu keselamatan jalur pipa</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_7_check }}</td>
                                                <td>{{ $sp->pipa_hdpe_7_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pipa_hdpe_7_due ? \Carbon\Carbon::parse($sp->pipa_hdpe_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                        </tbody>


                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $sp->additional_notes }}</p>
                            </div>
                            <div class="row mb-3">
                                @if($foto1 || $foto2)
                                    <div class="photo-grid">
                                        @if($foto1)
                                            <div class="photo-card">
                                                <a href="{{ $foto1 }}" target="_blank">
                                                    <img src="{{ $foto1 }}" alt="Dokumentasi/Evidence 1">
                                                </a>
                                                <div class="photo-meta">Dokumentasi/Evidence 1</div>
                                            </div>
                                        @endif

                                        @if($foto2)
                                            <div class="photo-card">
                                                <a href="{{ $foto2 }}" target="_blank">
                                                    <img src="{{ $foto2 }}" alt="Dokumentasi/Evidence 2">
                                                </a>
                                                <div class="photo-meta">Dokumentasi/Evidence 2</div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="empty-photo">
                                        Tidak ada dokumentasi.
                                    </div>
                                @endif
                            </div>
                             <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Inspektor</th>
                                                <th>NIK</th>
                                                <th>Jabatan</th>
                                                <th>Tertanda</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $sp->nama_inspektor1 }}</td>
                                                <td>{{ $sp->nik_inspektor1 }}</td>
                                                <td>{{ $sp->jabatan_inspektor1 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $sp->nama_inspektor2 }}</td>
                                                <td>{{ $sp->nik_inspektor2 }}</td>
                                                <td>{{ $sp->jabatan_inspektor2 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $sp->nama_inspektor3 }}</td>
                                                <td>{{ $sp->nik_inspektor3 }}</td>
                                                <td>{{ $sp->jabatan_inspektor3 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $sp->nama_inspektor4 }}</td>
                                                <td>{{ $sp->nik_inspektor4 }}</td>
                                                <td>{{ $sp->jabatan_inspektor4 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor4 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>{{ $sp->nama_inspektor5 }}</td>
                                                <td>{{ $sp->nik_inspektor5 }}</td>
                                                <td>{{ $sp->jabatan_inspektor5 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor5 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>{{ $sp->nama_inspektor6 }}</td>
                                                <td>{{ $sp->nik_inspektor6 }}</td>
                                                <td>{{ $sp->jabatan_inspektor6 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor6 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>{{ $sp->nama_inspektor7 }}</td>
                                                <td>{{ $sp->nik_inspektor7 }}</td>
                                                <td>{{ $sp->jabatan_inspektor7 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor7 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>{{ $sp->inspektor8 }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><img src="{{ $sp->verified_inspektor8 }}" style="max-width: 70px;"></td>
                                            </tr>
                                        </tbody>


                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="javascript:void(0)"
                                        onclick="window.history.back()"
                                        class="btn btn-light border rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2">
                                            <i class="ti ti-arrow-left"></i>
                                            <span>Kembali</span>
                                        </a>
                                    </li>

                                    {{-- <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.download', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-printer f-22"></i>
                                        </a>
                                    </li> --}}

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')


