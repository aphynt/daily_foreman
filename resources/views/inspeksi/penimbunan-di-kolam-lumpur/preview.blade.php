@include('layout.head', ['title' => 'Inspeksi Penimbunan Material di Kolam Lumpur'])
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
                            <h5 style="text-align: center;">INSPEKSI PENIMBUNAN MATERIAL DI KOLAM LUMPUR</h5>
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
                                                <td colspan="6">PERSIAPAN &amp; KESIAPAN AWAL AREA KERJA</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Area dumping sesuai penetapan rencana tambang &amp; rekomendasi geotek; komisioning dilakukan sebelum dioperasikan</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->persiapan_area_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->persiapan_area_1_due) ? \Carbon\Carbon::parse($sp->persiapan_area_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Material overburden/lumpur dipastikan kelayakannya; tidak ada genangan air, pohon, atau kayu yang menghalangi</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->persiapan_area_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->persiapan_area_2_due) ? \Carbon\Carbon::parse($sp->persiapan_area_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Penerangan area kerja memadai minimal 20-50 lux untuk kegiatan malam hari</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->persiapan_area_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->persiapan_area_3_due) ? \Carbon\Carbon::parse($sp->persiapan_area_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Bendera batas dorong material terpasang jelas dan terlihat oleh operator maupun pengawas</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->persiapan_area_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->persiapan_area_4_due) ? \Carbon\Carbon::parse($sp->persiapan_area_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Patok acuan batas pekerjaan &amp; elevasi permukaan lumpur/timbunan tersedia dari Engineer</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->persiapan_area_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->persiapan_area_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->persiapan_area_5_due) ? \Carbon\Carbon::parse($sp->persiapan_area_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>B</td>
                                                <td colspan="6">KESIAPAN OPERATOR, PENGAWAS &amp; UNIT</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Form KKH operator terverifikasi (kondisi fit to work, jam tidur minimal 6 jam)</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kesiapan_operator_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kesiapan_operator_1_due) ? \Carbon\Carbon::parse($sp->kesiapan_operator_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>P2H unit Bulldozer dilakukan dan unit dinyatakan aman untuk dioperasikan</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kesiapan_operator_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kesiapan_operator_2_due) ? \Carbon\Carbon::parse($sp->kesiapan_operator_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Form KLKH dibuat pengawas pada awal shift; area kerja bebas crack, amblasan, dan genangan air</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kesiapan_operator_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kesiapan_operator_3_due) ? \Carbon\Carbon::parse($sp->kesiapan_operator_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>P5M (Pembicaraan 5 Menit) dilakukan sebelum memulai kegiatan operasi</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kesiapan_operator_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kesiapan_operator_4_due) ? \Carbon\Carbon::parse($sp->kesiapan_operator_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Operator dan Pengawas menggunakan APD lengkap (rompi pantul, safety shoes, masker debu, kacamata pelindung, life jacket)</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapan_operator_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kesiapan_operator_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kesiapan_operator_5_due) ? \Carbon\Carbon::parse($sp->kesiapan_operator_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>C</td>
                                                <td colspan="6">PENGAWASAN AREA KERJA</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Minimal 1 pengawas kompeten standby penuh di lokasi, tidak meninggalkan tanpa izin/delegasi setingkat</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengawasan_area_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengawasan_area_1_due) ? \Carbon\Carbon::parse($sp->pengawasan_area_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Radio komunikasi pengawas-operator tersedia dan berfungsi efektif</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengawasan_area_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengawasan_area_2_due) ? \Carbon\Carbon::parse($sp->pengawasan_area_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Beda tinggi elevasi lumpur dengan elevasi timbunan minimum 2 meter terjaga</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengawasan_area_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengawasan_area_3_due) ? \Carbon\Carbon::parse($sp->pengawasan_area_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Tidak terdapat crack/patahan di area permukaan kerja unit Bulldozer</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengawasan_area_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengawasan_area_4_due) ? \Carbon\Carbon::parse($sp->pengawasan_area_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>Serah terima shift: pengawas sebelumnya standby hingga pengawas berikutnya tiba di lokasi (job pending)</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->pengawasan_area_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->pengawasan_area_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->pengawasan_area_5_due) ? \Carbon\Carbon::parse($sp->pengawasan_area_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>D</td>
                                                <td colspan="6">PELAKSANAAN DUMPING &amp; PENDORONGAN MATERIAL</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Dumping material oleh alat angkut dilakukan minimal 7.0 m dari crest lereng timbunan, searah jarum jam</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dumping_pendorongan_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dumping_pendorongan_1_due) ? \Carbon\Carbon::parse($sp->dumping_pendorongan_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>Bila terdapat retakan pada lereng timbunan, dumping dilakukan minimal 7.0 m dari titik retakan terjauh dari crest</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dumping_pendorongan_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dumping_pendorongan_2_due) ? \Carbon\Carbon::parse($sp->dumping_pendorongan_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Pendorongan bertahap: Bulldozer medium dari titik A (7 m dari crest) sejauh 3 meter menuju titik B</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dumping_pendorongan_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dumping_pendorongan_3_due) ? \Carbon\Carbon::parse($sp->dumping_pendorongan_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>Dilanjutkan Bulldozer small dari titik B sejauh 2 meter ke titik C (2 m dari crest); finishing menyisakan tanggul</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dumping_pendorongan_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dumping_pendorongan_4_due) ? \Carbon\Carbon::parse($sp->dumping_pendorongan_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Unit Bulldozer tidak melewati batas 2.0 m dari crest/titik patahan saat mendorong material</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dumping_pendorongan_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dumping_pendorongan_5_due) ? \Carbon\Carbon::parse($sp->dumping_pendorongan_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Jika terdapat crack, pendorongan material dilakukan maksimal 2 meter dari crack terluar</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dumping_pendorongan_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dumping_pendorongan_6_due) ? \Carbon\Carbon::parse($sp->dumping_pendorongan_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>Dilarang mendorong material menyisir/hingga ujung crest permukaan lumpur; tidak gunakan Bulldozer kelas D9/D10 sampai batas 2 m dari crest/crack</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->dumping_pendorongan_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->dumping_pendorongan_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->dumping_pendorongan_7_due) ? \Carbon\Carbon::parse($sp->dumping_pendorongan_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>E</td>
                                                <td colspan="6">KESIAPSIAGAAN KEADAAN DARURAT</td>
                                            </tr>
                                            <tr>
                                                <td>23</td>
                                                <td>Operator dan Pengawas memahami prosedur darurat unit amblas (dilarang maju/mundur paksa, keluar via pijakan, gunakan sling) dan unit terbakar (aktifkan fire suppression)</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapsiagaan_darurat_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapsiagaan_darurat_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapsiagaan_darurat_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kesiapsiagaan_darurat_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kesiapsiagaan_darurat_1_due) ? \Carbon\Carbon::parse($sp->kesiapsiagaan_darurat_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>Nomor kontak darurat tersedia di lokasi</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapsiagaan_darurat_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapsiagaan_darurat_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->kesiapsiagaan_darurat_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->kesiapsiagaan_darurat_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->kesiapsiagaan_darurat_2_due) ? \Carbon\Carbon::parse($sp->kesiapsiagaan_darurat_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
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
                                        <a href="{{ route('klkh.pengangkutan-lumpur.download', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.pengangkutan-lumpur.cetak', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


