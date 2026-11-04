@include('layout.head', ['title' => 'Inspeksi Tempat Bahan Bakar Cair'])
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
                                        <h6>FM-SE-03/01/23/09/26</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">INSPEKSI TEMPAT BAHAN BAKAR CAIR (BBC)</h5>
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
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi Pit:</h6>
                                    <h5>{{ $sp->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Penanggung Jawab Area:</h6>
                                    <h5>{{ $sp->nik_penanggungjawab }} | {{ $sp->nama_penanggungjawab }}</h5>
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
                                                <td colspan="4">HOUSEKEEPING</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Apakah area kerja dalam keadaan rapi dan teratur?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_1_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_1_due) ? \Carbon\Carbon::parse($sp->housekeeping_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Apakah lantai kerja dalam keadaan bersih &amp; bebas dari benda-benda yang tidak diperlukan?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_2_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_2_due) ? \Carbon\Carbon::parse($sp->housekeeping_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Apakah kondisi lantai kerja tidak rusak?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_3_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_3_due) ? \Carbon\Carbon::parse($sp->housekeeping_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Apakah jalur jalan diberi tanda/cat/demarkasi jelas?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_4_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_4_due) ? \Carbon\Carbon::parse($sp->housekeeping_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.5</td>
                                                <td>Apakah jalur jalan dan lintasan bebas dari hambatan?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_5_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_5_due) ? \Carbon\Carbon::parse($sp->housekeeping_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.6</td>
                                                <td>Apakah penerangan termasuk lampu dan bola lampu ada dalam keadaan yang bersih dan berfungsi?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_6_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_6_due) ? \Carbon\Carbon::parse($sp->housekeeping_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.7</td>
                                                <td>Apakah permukaan halaman tidak bergelombang &amp; tidak becek?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_7_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_7_due) ? \Carbon\Carbon::parse($sp->housekeeping_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.8</td>
                                                <td>Apakah halaman bersih dari sampah?</td>
                                                <td style="text-align:center;">{{ $sp->housekeeping_8_check ?? '-' }}</td>
                                                <td>{{ $sp->housekeeping_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->housekeeping_8_due) ? \Carbon\Carbon::parse($sp->housekeeping_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">EMERGENCY EQUIPMENT</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Apakah APAR mencukupi &amp; terdapat tanda (marking)?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_1_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_1_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Apakah kondisi tabung APAR dalam kondisi layak?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_2_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_2_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Apakah akses ke alat pemadam tidak terhalang?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_3_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_3_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Apakah APAR diinspeksi secara rutin dan terdapat tag?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_4_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_4_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Apakah hydrant untuk kebakaran (bila ada) dan perlengkapannya dalam keadaan baik?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_5_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_5_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.6</td>
                                                <td>Apakah eyewash dalam kondisi bersih?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_6_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_6_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.7</td>
                                                <td>Apakah eyewash dilakukan inspeksi secara teratur dan terdapat tag yang diisi sesuai?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_7_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_7_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.8</td>
                                                <td>Apakah eyewash berfungsi dengan baik?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_8_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_8_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.9</td>
                                                <td>Apakah akses ke tempat pencucian mata tidak terhalangi?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_9_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_9_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_9_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.10</td>
                                                <td>Apakah ada peta/layout area berkumpul darurat?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_10_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_10_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_10_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.11</td>
                                                <td>Apakah area berkumpul darurat diberi rambu "Assembly Point’?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_11_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_11_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_11_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_11_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.12</td>
                                                <td>Apakah terdapat emergency spill kit yang memadai?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_12_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_12_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_12_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_12_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.13</td>
                                                <td>Apakah terdapat kotak P3K sesuai dengan ketentuan?</td>
                                                <td style="text-align:center;">{{ $sp->emergency_equipment_13_check ?? '-' }}</td>
                                                <td>{{ $sp->emergency_equipment_13_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->emergency_equipment_13_due) ? \Carbon\Carbon::parse($sp->emergency_equipment_13_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">PERALATAN DAN FASILITAS</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Apakah pewarnaan pipa sesuai dengan standar kode warna?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_1_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_1_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Apakah pipa saluran bahan bakar terbuat dari bahan yang tahan api?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_2_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_2_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Apakah tangki penyimpanan terbuat dari bahan yang tahan api?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_3_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_3_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Apakah tangki penyimpanan berdiri kokoh tidak miring dan stabil pada pondasi?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_4_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_4_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.5</td>
                                                <td>Apakah tangki penyimpanan tidak bocor atau tidak ada rembesan?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_5_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_5_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.6</td>
                                                <td>Apakah terdapat ventilasi pembuangan gas/angin diatas tangki?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_6_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_6_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.7</td>
                                                <td>Apakah terdapat drainase tempat pembuangan apabila ada kebocoran dan bermuara pada oil trap?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_7_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_7_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.8</td>
                                                <td>Apakah pompa fuel berada diluar pagar dan kondisi baik?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_8_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_8_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.9</td>
                                                <td>Apakah tanggul dalam kondisi baik/tidak retak?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_9_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_9_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_9_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.10</td>
                                                <td>Apakah tanggul mampu menampung (110% volume total) jika tangki mengalami kebocoran?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_10_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_10_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_10_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.11</td>
                                                <td>Apakah terdapat kran pembuangan yang di hubungkan dengan oil trap?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_11_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_11_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_11_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_11_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.12</td>
                                                <td>Apakah terdapat pagar pengaman yang layak?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_12_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_12_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_12_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_12_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.13</td>
                                                <td>Apakah ada pintu pagar yang dapat dikunci?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_13_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_13_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_13_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_13_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.14</td>
                                                <td>Apakah penyalur petir dalam kondisi baik dan berfungsi? Maks 5 Ω</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_14_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_14_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_14_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_14_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.15</td>
                                                <td>Apakah terdapat oil trap yang berfungsi dengan baik dan dilakukan pembersihan secara berkala?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_15_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_15_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_15_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_15_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.16</td>
                                                <td>Apakah tangki memiliki handrail (susur tangga) dan berfungsi dengan baik?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_16_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_16_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_16_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_16_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.17</td>
                                                <td>Apakah pijakan tangga dalam kondisi baik?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_17_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_17_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_17_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_17_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.18</td>
                                                <td>Apakah handrail dan pijakan tangga memiliki pewarnaan sesuai standar?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_18_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_18_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_18_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_18_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.19</td>
                                                <td>Apakah peralatan yang digunakan telah dikalibrasi/disertifikasi? (Jika ada peralatan yang wajib dilakukan kalibrasi/sertifikasi)</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_19_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_19_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_19_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_19_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.20</td>
                                                <td>Apakah penyalur petir mencakup luasan area yang dilindungi?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_20_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_20_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_20_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_20_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.21</td>
                                                <td>Apakah tangki penyimpanan terdapat tanda kapasitas isi dan jenisnya?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_21_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_21_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_21_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_21_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.22</td>
                                                <td>Apakah semua selang pucuk pengisian dalam kondisi baik?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_22_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_22_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_22_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_22_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.23</td>
                                                <td>Apakah terdapat penghalang tabrakan di sekitar area pengisian?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_23_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_23_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_23_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_23_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.24</td>
                                                <td>Apakah terdapat penampung tetesan?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_24_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_24_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_24_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_24_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.25</td>
                                                <td>Apakah terdapat tongkat untuk mengukur kedalaman?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_25_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_25_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_25_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_25_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.26</td>
                                                <td>Apakah terdapat MSDS yang terpelihara dengan baik dan mudah dibaca dan dipahami?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_26_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_26_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_26_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_26_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.27</td>
                                                <td>Apakah kompartemen oil trap dalam kondisi bersih?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_27_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_27_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_27_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_27_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.28</td>
                                                <td>Apakah unit yang dioperasikan sudah dilakukan P2H?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_28_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_28_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_28_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_28_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.29</td>
                                                <td>Apakah pipa dalam kondisi baik?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_29_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_29_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_29_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_29_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.30</td>
                                                <td>Apakah terdapat ganjal tyre yang dapat digunakan?</td>
                                                <td style="text-align:center;">{{ $sp->peralatan_fasilitas_30_check ?? '-' }}</td>
                                                <td>{{ $sp->peralatan_fasilitas_30_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->peralatan_fasilitas_30_due) ? \Carbon\Carbon::parse($sp->peralatan_fasilitas_30_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">PROSEDUR KERJA AMAN</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Apakah terdapat prosedur di area kerja?</td>
                                                <td style="text-align:center;">{{ $sp->prosedur_kerja_1_check ?? '-' }}</td>
                                                <td>{{ $sp->prosedur_kerja_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->prosedur_kerja_1_due) ? \Carbon\Carbon::parse($sp->prosedur_kerja_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Apakah terdapat prosedur kerja untuk menjalankan aktivitas?</td>
                                                <td style="text-align:center;">{{ $sp->prosedur_kerja_2_check ?? '-' }}</td>
                                                <td>{{ $sp->prosedur_kerja_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->prosedur_kerja_2_due) ? \Carbon\Carbon::parse($sp->prosedur_kerja_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Apakah prosedur kerja dapat diterapkan dilapangan?</td>
                                                <td style="text-align:center;">{{ $sp->prosedur_kerja_3_check ?? '-' }}</td>
                                                <td>{{ $sp->prosedur_kerja_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->prosedur_kerja_3_due) ? \Carbon\Carbon::parse($sp->prosedur_kerja_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>5</td>
                                                <td colspan="4">RAMBU-RAMBU</td>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Apakah ada rambu pemakaian “APD Standard”?</td>
                                                <td style="text-align:center;">{{ $sp->rambu_1_check ?? '-' }}</td>
                                                <td>{{ $sp->rambu_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->rambu_1_due) ? \Carbon\Carbon::parse($sp->rambu_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Apakah ada rambu “Dilarang Merokok” untuk area yang berpotensi terjadi kebakaran dan tidak ditemukan puntung rokok?</td>
                                                <td style="text-align:center;">{{ $sp->rambu_2_check ?? '-' }}</td>
                                                <td>{{ $sp->rambu_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->rambu_2_due) ? \Carbon\Carbon::parse($sp->rambu_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.3</td>
                                                <td>Apakah terdapat rambu lalu lintas yang memadai?</td>
                                                <td style="text-align:center;">{{ $sp->rambu_3_check ?? '-' }}</td>
                                                <td>{{ $sp->rambu_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->rambu_3_due) ? \Carbon\Carbon::parse($sp->rambu_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.4</td>
                                                <td>Apakah ada tanda/jalur keluar darurat?</td>
                                                <td style="text-align:center;">{{ $sp->rambu_4_check ?? '-' }}</td>
                                                <td>{{ $sp->rambu_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->rambu_4_due) ? \Carbon\Carbon::parse($sp->rambu_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.5</td>
                                                <td>Apakah terdapat rambu parkir kendaraan/unit?</td>
                                                <td style="text-align:center;">{{ $sp->rambu_5_check ?? '-' }}</td>
                                                <td>{{ $sp->rambu_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->rambu_5_due) ? \Carbon\Carbon::parse($sp->rambu_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>6</td>
                                                <td colspan="4">PENGELOLAAN SAMPAH DAN HIDROKARBON</td>
                                            </tr>
                                            <tr>
                                                <td>6.1</td>
                                                <td>Apakah terdapat ceceran hidrokarbon di tanah?</td>
                                                <td style="text-align:center;">{{ $sp->sampah_hidrokarbon_1_check ?? '-' }}</td>
                                                <td>{{ $sp->sampah_hidrokarbon_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sampah_hidrokarbon_1_due) ? \Carbon\Carbon::parse($sp->sampah_hidrokarbon_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.2</td>
                                                <td>Apakah tersedia tempat sampah/limbah dan penampungan tumpahan oli?</td>
                                                <td style="text-align:center;">{{ $sp->sampah_hidrokarbon_2_check ?? '-' }}</td>
                                                <td>{{ $sp->sampah_hidrokarbon_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sampah_hidrokarbon_2_due) ? \Carbon\Carbon::parse($sp->sampah_hidrokarbon_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.3</td>
                                                <td>Apakah tempat pembuangan sampah/limbah sudah diberi nama dan tanda yang benar dan cukup?</td>
                                                <td style="text-align:center;">{{ $sp->sampah_hidrokarbon_3_check ?? '-' }}</td>
                                                <td>{{ $sp->sampah_hidrokarbon_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sampah_hidrokarbon_3_due) ? \Carbon\Carbon::parse($sp->sampah_hidrokarbon_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>7</td>
                                                <td colspan="4">PERLENGKAPAN UNTUK PERSONIL</td>
                                            </tr>
                                            <tr>
                                                <td>7.1</td>
                                                <td>Apakah semua personil menggunakan APD yang sesuai?</td>
                                                <td style="text-align:center;">{{ $sp->perlengkapan_personil_1_check ?? '-' }}</td>
                                                <td>{{ $sp->perlengkapan_personil_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perlengkapan_personil_1_due) ? \Carbon\Carbon::parse($sp->perlengkapan_personil_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.2</td>
                                                <td>Apakah semua personil membawa kartu ID (Simper/Permit) yang masih berlaku?</td>
                                                <td style="text-align:center;">{{ $sp->perlengkapan_personil_2_check ?? '-' }}</td>
                                                <td>{{ $sp->perlengkapan_personil_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perlengkapan_personil_2_due) ? \Carbon\Carbon::parse($sp->perlengkapan_personil_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.3</td>
                                                <td>Apakah terdapat tindakan tidak aman?</td>
                                                <td style="text-align:center;">{{ $sp->perlengkapan_personil_3_check ?? '-' }}</td>
                                                <td>{{ $sp->perlengkapan_personil_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perlengkapan_personil_3_due) ? \Carbon\Carbon::parse($sp->perlengkapan_personil_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
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


