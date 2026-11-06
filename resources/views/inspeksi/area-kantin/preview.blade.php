@include('layout.head', ['title' => 'Inspeksi Area Kantin dan Laundry'])
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
                            <h5 style="text-align: center;">INSPEKSI AREA KANTIN DAN LAUNDRY</h5>
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
                            {{-- <div class="alert alert-primary">
                                <div class="d-flex align-items-center"><i class="ti ti-info-circle h2 f-w-400 mb-0"></i>
                                    <div class="flex-grow-1 ms-3">S <i>(sesuai)</i> atau TS <i>(Tidak Sesuai)</i> pada kolom Kesesuaian sesuai hasil pengamatan</div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Point Yang Diperiksa</th>
                                                <th colspan="3">Cek</th>
                                                <th rowspan="2">Tindak Lanjut Perbaikan</th>
                                                <th rowspan="2">Due Date</th>
                                            </tr>
                                            <tr>
                                                <th>Ya</th>
                                                <th>Tidak</th>
                                                <th>N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="font-weight: bold;">
                                                <td>A</td>
                                                <td colspan="6">DOKUMEN DAN ADMINISTRASI</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Terdapat papan nama area serta nama &amp; kontak Penanggung Jawab Area (PJA)</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dokumen_administrasi_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dokumen_administrasi_1_due) ? \Carbon\Carbon::parse($sp->dokumen_administrasi_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Kantin / katering memiliki Sertifikat Laik Higiene Sanitasi (SLHS) yang masih berlaku</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dokumen_administrasi_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dokumen_administrasi_2_due) ? \Carbon\Carbon::parse($sp->dokumen_administrasi_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Penjamah makanan memiliki sertifikat pelatihan higiene sanitasi pangan</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dokumen_administrasi_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dokumen_administrasi_3_due) ? \Carbon\Carbon::parse($sp->dokumen_administrasi_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Penjamah makanan menjalani pemeriksaan kesehatan berkala (termasuk usap dubur / rectal swab)</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dokumen_administrasi_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dokumen_administrasi_4_due) ? \Carbon\Carbon::parse($sp->dokumen_administrasi_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Hasil uji kualitas air minum dan air untuk pengolahan makanan tersedia dan berlaku</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dokumen_administrasi_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dokumen_administrasi_5_due) ? \Carbon\Carbon::parse($sp->dokumen_administrasi_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Sampel makanan (bank sampel) disimpan per menu / per shift sesuai prosedur</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dokumen_administrasi_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dokumen_administrasi_6_due) ? \Carbon\Carbon::parse($sp->dokumen_administrasi_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Bahan pangan olahan memiliki izin edar (BPOM / PIRT), tidak kedaluwarsa, dan halal</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dokumen_administrasi_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dokumen_administrasi_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dokumen_administrasi_7_due) ? \Carbon\Carbon::parse($sp->dokumen_administrasi_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>B</td>
                                                <td colspan="6">KANTIN – BANGUNAN DAN FASILITAS</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Lantai, dinding, dan langit-langit bersih, kedap air, mudah dibersihkan, dan tidak rusak</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_bangunan_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_bangunan_1_due) ? \Carbon\Carbon::parse($sp->kantin_bangunan_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Ruang pengolahan terpisah dari ruang makan dan toilet</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_bangunan_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_bangunan_2_due) ? \Carbon\Carbon::parse($sp->kantin_bangunan_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Ventilasi / exhaust hood dapur berfungsi dan bebas dari kerak minyak</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_bangunan_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_bangunan_3_due) ? \Carbon\Carbon::parse($sp->kantin_bangunan_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Pencahayaan ruang pengolahan dan ruang makan memadai</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_bangunan_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_bangunan_4_due) ? \Carbon\Carbon::parse($sp->kantin_bangunan_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Pintu dan jendela dilengkapi kasa / tirai plastik pencegah serangga</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_bangunan_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_bangunan_5_due) ? \Carbon\Carbon::parse($sp->kantin_bangunan_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Tersedia wastafel cuci tangan dengan sabun dan air mengalir bagi pengunjung &amp; penjamah</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_bangunan_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_bangunan_6_due) ? \Carbon\Carbon::parse($sp->kantin_bangunan_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Meja, kursi, dan peralatan makan bersih dan dalam kondisi baik</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_bangunan_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_bangunan_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_bangunan_7_due) ? \Carbon\Carbon::parse($sp->kantin_bangunan_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>C</td>
                                                <td colspan="6">KANTIN – HIGIENE PENGOLAHAN DAN PENYAJIAN</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>Penjamah makanan menggunakan celemek, penutup kepala, masker, dan sarung tangan</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_1_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Penjamah makanan tidak merokok, berkuku pendek, dan tidak memakai perhiasan saat bekerja</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_2_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>Bahan mentah dan makanan matang disimpan terpisah (mencegah kontaminasi silang)</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_3_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Talenan / pisau dibedakan untuk bahan mentah dan makanan matang</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_4_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>Chiller ≤ 5 °C dan freezer ≤ -18 °C; tersedia termometer dan catatan suhu</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_5_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Makanan panas disajikan / dipertahankan pada suhu ≥ 60 °C</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_6_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Penyimpanan bahan kering di atas rak / palet (± 15 cm dari lantai) dan menerapkan FIFO/FEFO</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_7_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>Makanan yang disajikan tertutup dan terlindung dari serangga dan debu</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_8_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_8_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_8_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_8_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>23</td>
                                                <td>Peralatan masak dan makan dicuci dengan air mengalir, sabun, dan dikeringkan / disanitasi</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_9_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_9_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_9_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_9_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_9_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>Tidak terdapat tanda keberadaan tikus, kecoa, atau lalat di area dapur</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_10_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_10_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_higiene_10_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_higiene_10_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_higiene_10_due) ? \Carbon\Carbon::parse($sp->kantin_higiene_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>D</td>
                                                <td colspan="6">KANTIN – KESELAMATAN DAPUR DAN GAS</td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>Tabung LPG ditempatkan di area berventilasi baik dan terpisah dari sumber api</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_keselamatan_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_keselamatan_1_due) ? \Carbon\Carbon::parse($sp->kantin_keselamatan_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>26</td>
                                                <td>Regulator, selang, dan klem LPG berstandar SNI, tidak retak, dan tidak bocor</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_keselamatan_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_keselamatan_2_due) ? \Carbon\Carbon::parse($sp->kantin_keselamatan_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>27</td>
                                                <td>Tersedia detektor kebocoran gas (bila ada) dan prosedur penanganan kebocoran gas</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_keselamatan_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_keselamatan_3_due) ? \Carbon\Carbon::parse($sp->kantin_keselamatan_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>28</td>
                                                <td>Tersedia APAR (kelas K / powder) dan fire blanket di dekat area memasak</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_keselamatan_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_keselamatan_4_due) ? \Carbon\Carbon::parse($sp->kantin_keselamatan_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>29</td>
                                                <td>Instalasi listrik dapur aman dari percikan air dan panas</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_keselamatan_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_keselamatan_5_due) ? \Carbon\Carbon::parse($sp->kantin_keselamatan_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>30</td>
                                                <td>Grease trap (penangkap lemak) berfungsi dan dibersihkan secara berkala</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_keselamatan_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_keselamatan_6_due) ? \Carbon\Carbon::parse($sp->kantin_keselamatan_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>31</td>
                                                <td>Tempat sampah dapur bertutup dan sampah sisa makanan diangkut setiap hari</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kantin_keselamatan_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kantin_keselamatan_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kantin_keselamatan_7_due) ? \Carbon\Carbon::parse($sp->kantin_keselamatan_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>E</td>
                                                <td colspan="6">LAUNDRY – FASILITAS DAN PERALATAN</td>
                                            </tr>
                                            <tr>
                                                <td>32</td>
                                                <td>Lantai area laundry kering, anti-slip, dan dilengkapi saluran pembuangan air</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_fasilitas_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_fasilitas_1_due) ? \Carbon\Carbon::parse($sp->laundry_fasilitas_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>33</td>
                                                <td>Mesin cuci &amp; pengering dalam kondisi baik, di-grounding, dan terdapat tombol emergency stop</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_fasilitas_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_fasilitas_2_due) ? \Carbon\Carbon::parse($sp->laundry_fasilitas_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>34</td>
                                                <td>Filter serat (lint filter) mesin pengering dibersihkan setiap selesai pemakaian</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_fasilitas_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_fasilitas_3_due) ? \Carbon\Carbon::parse($sp->laundry_fasilitas_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>35</td>
                                                <td>Saluran pembuangan udara panas mesin pengering (exhaust duct) tidak tersumbat</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_fasilitas_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_fasilitas_4_due) ? \Carbon\Carbon::parse($sp->laundry_fasilitas_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>36</td>
                                                <td>Setrika / alat press dalam kondisi baik dan dimatikan setelah digunakan</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_fasilitas_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_fasilitas_5_due) ? \Carbon\Carbon::parse($sp->laundry_fasilitas_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>37</td>
                                                <td>Ventilasi area laundry memadai untuk mengurangi panas dan kelembaban</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_fasilitas_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_fasilitas_6_due) ? \Carbon\Carbon::parse($sp->laundry_fasilitas_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>38</td>
                                                <td>Instalasi listrik dan stop kontak aman dari percikan air</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_fasilitas_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_fasilitas_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_fasilitas_7_due) ? \Carbon\Carbon::parse($sp->laundry_fasilitas_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>F</td>
                                                <td colspan="6">LAUNDRY – BAHAN KIMIA DAN ALUR KERJA</td>
                                            </tr>
                                            <tr>
                                                <td>39</td>
                                                <td>Bahan kimia (deterjen, pemutih, pelembut) berlabel, tertutup, dan disimpan di rak khusus</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_kimia_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_kimia_1_due) ? \Carbon\Carbon::parse($sp->laundry_kimia_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>40</td>
                                                <td>SDS / MSDS (Material Safety Data Sheet) bahan kimia laundry tersedia di area kerja</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_kimia_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_kimia_2_due) ? \Carbon\Carbon::parse($sp->laundry_kimia_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>41</td>
                                                <td>Petugas menggunakan APD (sarung tangan, masker, apron) saat menangani bahan kimia</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_kimia_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_kimia_3_due) ? \Carbon\Carbon::parse($sp->laundry_kimia_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>42</td>
                                                <td>Alur kerja terpisah antara pakaian / linen kotor dan bersih</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_kimia_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_kimia_4_due) ? \Carbon\Carbon::parse($sp->laundry_kimia_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>43</td>
                                                <td>Pakaian kerja terkontaminasi oli / grease dipisahkan dari linen mess / kantin</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_kimia_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_kimia_5_due) ? \Carbon\Carbon::parse($sp->laundry_kimia_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>44</td>
                                                <td>Air limbah laundry dialirkan ke IPAL / oil trap, tidak langsung ke lingkungan</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_kimia_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_kimia_6_due) ? \Carbon\Carbon::parse($sp->laundry_kimia_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>45</td>
                                                <td>Troli / wadah angkut tersedia untuk mengurangi pengangkatan manual</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->laundry_kimia_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->laundry_kimia_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->laundry_kimia_7_due) ? \Carbon\Carbon::parse($sp->laundry_kimia_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>G</td>
                                                <td colspan="6">TANGGAP DARURAT DAN RAMBU (KANTIN &amp; LAUNDRY)</td>
                                            </tr>
                                            <tr>
                                                <td>46</td>
                                                <td>APAR tidak kedaluwarsa, berkartu inspeksi, tinggi puncak ≤ 1,2 m, dan mudah dijangkau</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->tanggap_darurat_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->tanggap_darurat_1_due) ? \Carbon\Carbon::parse($sp->tanggap_darurat_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>47</td>
                                                <td>Kotak P3K tersedia dengan isi lengkap, termasuk perlengkapan untuk luka bakar</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->tanggap_darurat_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->tanggap_darurat_2_due) ? \Carbon\Carbon::parse($sp->tanggap_darurat_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>48</td>
                                                <td>Eye wash tersedia di area penggunaan bahan kimia laundry</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->tanggap_darurat_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->tanggap_darurat_3_due) ? \Carbon\Carbon::parse($sp->tanggap_darurat_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>49</td>
                                                <td>Jalur evakuasi bebas hambatan dan terdapat rambu EXIT / EMERGENCY MUSTER POINT</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->tanggap_darurat_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->tanggap_darurat_4_due) ? \Carbon\Carbon::parse($sp->tanggap_darurat_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>50</td>
                                                <td>Terdapat rambu DILARANG MEROKOK, rambu wajib cuci tangan, dan rambu lantai licin</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->tanggap_darurat_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->tanggap_darurat_5_due) ? \Carbon\Carbon::parse($sp->tanggap_darurat_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>51</td>
                                                <td>Terdapat rambu wajib APD dan rambu bahaya panas / permukaan panas di area dapur &amp; laundry</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->tanggap_darurat_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->tanggap_darurat_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->tanggap_darurat_6_due) ? \Carbon\Carbon::parse($sp->tanggap_darurat_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
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
                                        <a href="{{ route('klkh.area-mess.download', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.area-mess.cetak', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


