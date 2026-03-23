@include('layout.head', ['title' => 'Inspeksi Area OGS'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
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
                                        <h6>FM-SE-04/00/03/02/26</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">DAFTAR PERIKSA INSPEKSI TAMBANG - DISPOSAL</h5>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Tanggal:</h6>
                                    <h5>{{ Carbon::parse($ogs->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Nama Lokasi:</h6>
                                    <h5>{{ $ogs->nama_lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi Pit:</h6>
                                    <h5>{{ $ogs->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Penanggung Jawab Area:</h6>
                                    <h5>{{ $ogs->nik_penanggungjawab }} | {{ $ogs->nama_penanggungjawab }}</h5>
                                </div>
                            </div>
                            <div class="alert alert-primary">
                                <div class="d-flex align-items-center"><i class="ti ti-info-circle h2 f-w-400 mb-0"></i>
                                    <div class="flex-grow-1 ms-3">Tuliskan S <i>(sesuai)</i> atau TS <i>(Tidak Sesuai)</i> pada kolom Kesesuaian sesuai hasil pengamatan</div>
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
                                                <td colspan="4">Geometri dan Konstruksi</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Terdapat tanggul di sekeliling area</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_11_check }}</td>
                                                <td>{{ $ogs->geometri_11_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_11_due ? \Carbon\Carbon::parse($ogs->geometri_11_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Permukaan Base jalan rata</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_12_check }}</td>
                                                <td>{{ $ogs->geometri_12_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_12_due ? \Carbon\Carbon::parse($ogs->geometri_12_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Permukaan tanah rata, maksimal grade 2% tidak ada cekungan di permukaan</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_13_check }}</td>
                                                <td>{{ $ogs->geometri_13_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_13_due ? \Carbon\Carbon::parse($ogs->geometri_13_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Permukaan tanah tidak ada genangan air</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_14_check }}</td>
                                                <td>{{ $ogs->geometri_14_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_14_due ? \Carbon\Carbon::parse($ogs->geometri_14_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.5</td>
                                                <td>Terdapat safety berm pada area yang terdapat perbedaan tinggi ≥ 0.5 meter</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_15_check }}</td>
                                                <td>{{ $ogs->geometri_15_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_15_due ? \Carbon\Carbon::parse($ogs->geometri_15_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.6</td>
                                                <td>Terdapat area parkir / akses unit sarana / manhoul yang terpisah dengan alat berat</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_16_check }}</td>
                                                <td>{{ $ogs->geometri_16_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_16_due ? \Carbon\Carbon::parse($ogs->geometri_16_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.7</td>
                                                <td>Lebar akses jalan masuk dan keluar memenuhi  minimal 2x lebar unit hauler terbesar</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_17_check }}</td>
                                                <td>{{ $ogs->geometri_17_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_17_due ? \Carbon\Carbon::parse($ogs->geometri_17_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.8</td>
                                                <td>Terdapat drainase/ditch di sepanjang kaki tanggulan</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_18_check }}</td>
                                                <td>{{ $ogs->geometri_18_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_18_due ? \Carbon\Carbon::parse($ogs->geometri_18_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.9</td>
                                                <td>Terdapat median di area keluar bila terdapat percabangan</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_19_check }}</td>
                                                <td>{{ $ogs->geometri_19_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->geometri_19_due ? \Carbon\Carbon::parse($ogs->geometri_19_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Sarana dan Prasarana</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Terdapat tempat ( Kontainer / bangunan ) untuk istirahat yang memadai</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_21_check }}</td>
                                                <td>{{ $ogs->sarana_21_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_21_due ? \Carbon\Carbon::parse($ogs->sarana_21_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Terdapat beda tinggi anatar tempat ( Kontainer / bangunan ) untuk istirahat dengan base unit</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_22_check }}</td>
                                                <td>{{ $ogs->sarana_22_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_22_due ? \Carbon\Carbon::parse($ogs->sarana_22_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Terdapat tangga atau pijakan untuk akses naik turun di tempat ( Kontainer / bangunan ) Istirahat</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_23_check }}</td>
                                                <td>{{ $ogs->sarana_23_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_23_due ? \Carbon\Carbon::parse($ogs->sarana_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Terdapat jamban / toilet yang memadai</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_24_check }}</td>
                                                <td>{{ $ogs->sarana_24_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_24_due ? \Carbon\Carbon::parse($ogs->sarana_24_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Terdapat unit penerangan</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_25_check }}</td>
                                                <td>{{ $ogs->sarana_25_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_25_due ? \Carbon\Carbon::parse($ogs->sarana_25_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.6</td>
                                                <td>Ketersediaan air bersih laik minum</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_26_check }}</td>
                                                <td>{{ $ogs->sarana_26_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->sarana_26_due ? \Carbon\Carbon::parse($ogs->sarana_26_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">Keselamatan dan Lingkungan</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Terdapat APAR yang ditempatkan secara khusus dan standar</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_31_check }}</td>
                                                <td>{{ $ogs->keselamatan_31_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_31_due ? \Carbon\Carbon::parse($ogs->keselamatan_31_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Terdapat unit penyalur petir dengan tahanan maksimal 5 Ω</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_32_check }}</td>
                                                <td>{{ $ogs->keselamatan_32_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_32_due ? \Carbon\Carbon::parse($ogs->keselamatan_32_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Terdapat Eye Wash</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_33_check }}</td>
                                                <td>{{ $ogs->keselamatan_33_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_33_due ? \Carbon\Carbon::parse($ogs->keselamatan_33_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Terdapat tempat sampah 3 warna</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_34_check }}</td>
                                                <td>{{ $ogs->keselamatan_34_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_34_due ? \Carbon\Carbon::parse($ogs->keselamatan_34_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.5</td>
                                                <td>Terdapat wadah penyimpanan ceceran /tumpahan bahan B3 (Spill Kit)</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_35_check }}</td>
                                                <td>{{ $ogs->keselamatan_35_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_35_due ? \Carbon\Carbon::parse($ogs->keselamatan_35_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.6</td>
                                                <td>Terdapat area yang dikhususkan untuk penghijauan</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_36_check }}</td>
                                                <td>{{ $ogs->keselamatan_36_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->keselamatan_36_due ? \Carbon\Carbon::parse($ogs->keselamatan_36_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Rambu Keselamatan</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Terdapat rambu informasi papan nama area OGS</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_41_check }}</td>
                                                <td>{{ $ogs->rambu_41_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_41_due ? \Carbon\Carbon::parse($ogs->rambu_41_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Terdapat papan informasi nama dan kontak Penanggung Jawab Area (PJA)</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_42_check }}</td>
                                                <td>{{ $ogs->rambu_42_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_42_due ? \Carbon\Carbon::parse($ogs->rambu_42_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Terdapat rambu wajib penggunaan APD</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_43_check }}</td>
                                                <td>{{ $ogs->rambu_43_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_43_due ? \Carbon\Carbon::parse($ogs->rambu_43_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.4</td>
                                                <td>Terdapat rambu informasi EMERGENCY MUSTER POINT</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_44_check }}</td>
                                                <td>{{ $ogs->rambu_44_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_44_due ? \Carbon\Carbon::parse($ogs->rambu_44_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.5</td>
                                                <td>Terdapat rambu peringatan jalur kabel bawah tanah</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_45_check }}</td>
                                                <td>{{ $ogs->rambu_45_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_45_due ? \Carbon\Carbon::parse($ogs->rambu_45_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.6</td>
                                                <td>Terdapat rambu informasi petunjuk arah akses ( Masuk keluar unit )</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_46_check }}</td>
                                                <td>{{ $ogs->rambu_46_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_46_due ? \Carbon\Carbon::parse($ogs->rambu_46_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.7</td>
                                                <td>Terdapat rambu batas kecepatan 15 Km/Jam di pintu masuk OGS</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_47_check }}</td>
                                                <td>{{ $ogs->rambu_47_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_47_due ? \Carbon\Carbon::parse($ogs->rambu_47_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.8</td>
                                                <td>Terdapat rambu chanel radio (jika menggunakan chanel khusus)</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_48_check }}</td>
                                                <td>{{ $ogs->rambu_48_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_48_due ? \Carbon\Carbon::parse($ogs->rambu_48_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.9</td>
                                                <td>Terdapat rambu-rambu batas parkir unit secara paralel dan seri</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_49_check }}</td>
                                                <td>{{ $ogs->rambu_49_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_49_due ? \Carbon\Carbon::parse($ogs->rambu_49_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.10</td>
                                                <td>Terdapat rambu area parkir sarana / Manhoul</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_410_check }}</td>
                                                <td>{{ $ogs->rambu_410_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_410_due ? \Carbon\Carbon::parse($ogs->rambu_410_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.11</td>
                                                <td>Terdapat rambu STOP di pintu keluar</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_411_check }}</td>
                                                <td>{{ $ogs->rambu_411_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_411_due ? \Carbon\Carbon::parse($ogs->rambu_411_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.12</td>
                                                <td>Terdapat rambu jalur lalu lintas satu arah</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_412_check }}</td>
                                                <td>{{ $ogs->rambu_412_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_412_due ? \Carbon\Carbon::parse($ogs->rambu_412_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.13</td>
                                                <td>Posisi Hauler parkir secara seri</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_413_check }}</td>
                                                <td>{{ $ogs->rambu_413_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_413_due ? \Carbon\Carbon::parse($ogs->rambu_413_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.14</td>
                                                <td>Terdapat rambu DILARANG MEMBUANG SAMPAH SEMBARANGAN</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_414_check }}</td>
                                                <td>{{ $ogs->rambu_414_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_414_due ? \Carbon\Carbon::parse($ogs->rambu_414_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.15</td>
                                                <td>Terdapat rambu unit hauler dilarang parkir mundur</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_415_check }}</td>
                                                <td>{{ $ogs->rambu_415_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_415_due ? \Carbon\Carbon::parse($ogs->rambu_415_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.16</td>
                                                <td>Terdapat rambu pengaktifan parking brake bagi hauler yang berhenti/parkir</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_416_check }}</td>
                                                <td>{{ $ogs->rambu_416_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_416_due ? \Carbon\Carbon::parse($ogs->rambu_416_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.17</td>
                                                <td>Terdapat rambu jam keluar masuk OGS</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_417_check }}</td>
                                                <td>{{ $ogs->rambu_417_action }}</td>
                                                <td style="text-align:center;">{{ $ogs->rambu_417_due ? \Carbon\Carbon::parse($ogs->rambu_417_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $ogs->additional_notes }}</p>
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
                                                <th>Tanda Tangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $ogs->nama_inspektor1 }}</td>
                                                <td>{{ $ogs->nik_inspektor1 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ogs->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $ogs->nama_inspektor2 }}</td>
                                                <td>{{ $ogs->nik_inspektor2 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ogs->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $ogs->nama_inspektor3 }}</td>
                                                <td>{{ $ogs->nik_inspektor3 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ogs->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $ogs->nama_inspektor4 }}</td>
                                                <td>{{ $ogs->nik_inspektor4 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ogs->verified_inspektor4 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>{{ $ogs->nama_inspektor5 }}</td>
                                                <td>{{ $ogs->nik_inspektor5 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ogs->verified_inspektor5 }}" style="max-width: 70px;"></td>
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
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.download', $ogs->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $ogs->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-printer f-22"></i>
                                        </a>
                                    </li>

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


