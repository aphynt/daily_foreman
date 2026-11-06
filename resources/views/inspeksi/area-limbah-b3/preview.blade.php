@include('layout.head', ['title' => 'Inspeksi Tempat Penyimpanan Sementara Limbah B3 (TPS LB3)'])
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
                            <h5 style="text-align: center;">INSPEKSI TEMPAT PENYIMPANAN SEMENTARA LIMBAH B3 (TPS LB3)</h5>
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
                                                <td colspan="6">PERIZINAN DAN ADMINISTRASI</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>TPS LB3 tercantum dalam Rincian Teknis Penyimpanan Limbah B3 pada Persetujuan Lingkungan yang masih berlaku</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_1_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Terdapat SOP penyimpanan LB3 dan prosedur tanggap darurat yang tersedia/terpasang di TPS</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_2_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Logbook keluar-masuk LB3 tersedia dan diisi terkini (tanggal, jenis, kode, sumber, jumlah, tujuan)</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_3_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Neraca Limbah B3 dibuat dan diperbarui secara berkala</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_4_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Lama penyimpanan LB3 tidak melebihi batas waktu (90 / 180 / 365 hari sesuai jumlah timbulan &amp; kategori)</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_5_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Setiap pengiriman LB3 dilengkapi manifest elektronik (Festronik)</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_6_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Pengangkut dan pengolah/pemanfaat LB3 memiliki izin/persetujuan yang masih berlaku</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_7_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Lembar Data Keselamatan (SDS/MSDS) untuk LB3 yang disimpan tersedia di TPS</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_8_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_8_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_8_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_8_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Petugas/PJA TPS telah mendapatkan pelatihan pengelolaan LB3 dan tanggap darurat</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_9_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_9_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_9_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_9_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_9_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Laporan pengelolaan LB3 disampaikan secara berkala kepada instansi berwenang</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_10_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_10_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->perizinan_administrasi_10_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->perizinan_administrasi_10_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->perizinan_administrasi_10_due) ? \Carbon\Carbon::parse($sp->perizinan_administrasi_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>B</td>
                                                <td colspan="6">LOKASI DAN KONSTRUKSI BANGUNAN</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Lokasi TPS bebas banjir dan tidak rawan bencana alam (atau telah direkayasa secara teknis)</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_1_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Lokasi TPS berjarak aman dari sumber air, area hauling/alat berat, dan sumber api</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_2_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Bangunan beratap, mampu melindungi LB3 dari air hujan dan sinar matahari langsung</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_3_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Lantai kedap air, tidak retak/berlubang, dan bebas genangan</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_4_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>Lantai dibuat landai mengarah ke saluran/bak penampung ceceran</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_5_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Terdapat tanggul/kanstin di pintu masuk untuk mencegah ceceran keluar dan air hujan masuk</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_6_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>Saluran ceceran dan bak penampung (sump) tersedia, tidak tersumbat, terpisah dari drainase air hujan</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_7_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Secondary containment/bund untuk LB3 cair berkapasitas ≥ 110% volume kemasan/tangki terbesar</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_8_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_8_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_8_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_8_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>Dinding/pagar pembatas kokoh dan mencegah akses pihak yang tidak berwenang</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_9_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_9_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_9_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_9_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_9_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Ventilasi udara memadai dan dilengkapi kasa/jaring pencegah masuknya binatang</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_10_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_10_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_10_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_10_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_10_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Pencahayaan memadai; instalasi listrik aman (explosion proof untuk ruang LB3 mudah menyala)</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_11_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_11_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_11_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_11_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_11_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_11_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>Pintu TPS dapat dikunci dan kunci dipegang oleh petugas yang ditunjuk</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_12_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_12_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_12_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_12_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_12_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_12_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>23</td>
                                                <td>Akses bongkar muat (ramp/jalan) aman, bebas hambatan, dan lebarnya memadai untuk forklift/unit</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_13_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_13_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lokasi_konstruksi_13_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lokasi_konstruksi_13_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lokasi_konstruksi_13_due) ? \Carbon\Carbon::parse($sp->lokasi_konstruksi_13_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>C</td>
                                                <td colspan="6">PENGEMASAN, PENYIMPANAN DAN SEGREGASI</td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>LB3 disimpan terpisah per jenis/karakteristik dalam blok/ruang yang ditentukan</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_1_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>LB3 yang tidak saling sesuai (incompatible) tidak disimpan berdekatan</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_2_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>26</td>
                                                <td>Kemasan dalam kondisi baik: tidak bocor, tidak berkarat, tidak rusak, dan tertutup rapat</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_3_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>27</td>
                                                <td>Bahan kemasan sesuai (kompatibel) dengan karakteristik LB3 yang disimpan</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_4_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>28</td>
                                                <td>Kemasan diletakkan di atas palet, tidak langsung bersentuhan dengan lantai</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_5_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>29</td>
                                                <td>Tumpukan kemasan stabil dan tidak melebihi 3 (tiga) lapis</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_6_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>30</td>
                                                <td>Jarak antar blok/lorong ± 60 cm untuk akses inspeksi dan penanganan darurat</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_7_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>31</td>
                                                <td>Kemasan LB3 cair tidak diisi penuh (disisakan ruang ± 10%)</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_8_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_8_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_8_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_8_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>32</td>
                                                <td>Aki bekas disimpan tegak di atas wadah/alas tahan asam</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_9_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_9_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_9_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_9_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_9_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>33</td>
                                                <td>Tangki oli bekas (bila ada) dalam kondisi baik, tidak bocor, dan dilengkapi indikator level</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_10_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_10_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_10_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_10_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_10_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>34</td>
                                                <td>Tidak terdapat ceceran/tumpahan LB3 di lantai, saluran, maupun di luar TPS</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_11_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_11_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_11_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_11_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_11_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_11_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>35</td>
                                                <td>Tidak terdapat sampah domestik/limbah non-B3 yang dicampur di dalam TPS</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_12_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_12_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_12_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_12_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_12_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_12_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>36</td>
                                                <td>Volume LB3 yang disimpan tidak melebihi kapasitas desain TPS</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_13_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_13_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengemasan_penyimpanan_13_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengemasan_penyimpanan_13_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengemasan_penyimpanan_13_due) ? \Carbon\Carbon::parse($sp->pengemasan_penyimpanan_13_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>D</td>
                                                <td colspan="6">SIMBOL, LABEL DAN RAMBU</td>
                                            </tr>
                                            <tr>
                                                <td>37</td>
                                                <td>Terdapat papan nama TPS LB3 serta nama &amp; kontak Penanggung Jawab Area (PJA)</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_1_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>38</td>
                                                <td>Simbol LB3 sesuai karakteristik terpasang pada pintu/dinding tiap ruang/blok (min. 25 x 25 cm)</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_2_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>39</td>
                                                <td>Simbol LB3 sesuai karakteristik terpasang pada setiap kemasan (min. 10 x 10 cm), jelas dan utuh</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_3_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>40</td>
                                                <td>Label identitas LB3 terpasang pada setiap kemasan (penghasil, jenis, kode LB3, tanggal, jumlah)</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_4_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>41</td>
                                                <td>Label penanda posisi tutup kemasan terpasang dan sesuai</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_5_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>42</td>
                                                <td>Terdapat rambu DILARANG MEROKOK / DILARANG MEMBAWA API</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_6_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>43</td>
                                                <td>Terdapat rambu wajib penggunaan APD dan rambu DILARANG MASUK SELAIN PETUGAS</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_7_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>44</td>
                                                <td>Terdapat rambu jalur evakuasi dan EMERGENCY MUSTER POINT</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_8_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_8_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->simbol_label_rambu_8_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->simbol_label_rambu_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->simbol_label_rambu_8_due) ? \Carbon\Carbon::parse($sp->simbol_label_rambu_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>E</td>
                                                <td colspan="6">KESELAMATAN DAN TANGGAP DARURAT</td>
                                            </tr>
                                            <tr>
                                                <td>45</td>
                                                <td>Terdapat APAR sesuai kelas kebakaran, tidak kedaluwarsa, ditempatkan standar, dan berkartu inspeksi</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_1_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>46</td>
                                                <td>Terdapat Spill Kit lengkap (absorben, pad, boom, sekop non-sparking, wadah) dan mudah dijangkau</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_2_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>47</td>
                                                <td>Terdapat Eye Wash / Emergency Shower yang berfungsi dan mudah dijangkau</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_3_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>48</td>
                                                <td>Terdapat kotak P3K dengan isi lengkap</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_4_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>49</td>
                                                <td>APD tersedia sesuai risiko (sarung tangan kimia, kacamata, respirator, apron, safety shoes)</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_5_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>50</td>
                                                <td>Terdapat unit penyalur petir/grounding dengan tahanan maksimal 5 Ω</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_6_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>51</td>
                                                <td>Nomor telepon darurat dan kontak ERT terpasang di area TPS</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_7_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>52</td>
                                                <td>Housekeeping baik; area sekitar TPS bebas semak/gulma dan bahan mudah terbakar</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_8_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_8_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_8_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_8_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>53</td>
                                                <td>Tidak ada sumber api terbuka / pekerjaan panas (hot work) tanpa izin di sekitar TPS</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_9_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_9_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_9_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_9_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_9_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_9_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>54</td>
                                                <td>Bak penampung tidak penuh; ceceran yang terkumpul dikelola sebagai LB3</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_10_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_10_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_10_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_10_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_10_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_10_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>55</td>
                                                <td>Tidak terdapat indikasi pencemaran tanah/air di sekitar TPS (noda/lapisan minyak di drainase)</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_11_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_11_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->keselamatan_darurat_11_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->keselamatan_darurat_11_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->keselamatan_darurat_11_due) ? \Carbon\Carbon::parse($sp->keselamatan_darurat_11_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
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


