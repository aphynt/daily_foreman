@include('layout.head', ['title' => 'Inspeksi Area Office / Perkantoran'])
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
                            <h5 style="text-align: center;">INSPEKSI AREA OFFICE / PERKANTORAN</h5>
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
                                                <td colspan="6">ADMINISTRASI &amp; KESIAPAN K3L</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Terdapat papan nama area serta nama &amp; kontak Penanggung Jawab Area (PJA)</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->administrasi_k3l_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->administrasi_k3l_1_due) ? \Carbon\Carbon::parse($sp->administrasi_k3l_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Kebijakan K3L perusahaan terpasang dan mudah dibaca</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->administrasi_k3l_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->administrasi_k3l_2_due) ? \Carbon\Carbon::parse($sp->administrasi_k3l_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Prosedur tanggap darurat, struktur tim darurat, dan nomor telepon darurat terpasang</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->administrasi_k3l_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->administrasi_k3l_3_due) ? \Carbon\Carbon::parse($sp->administrasi_k3l_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Denah / peta jalur evakuasi terpasang di setiap lantai dan lorong utama</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->administrasi_k3l_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->administrasi_k3l_4_due) ? \Carbon\Carbon::parse($sp->administrasi_k3l_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Simulasi evakuasi darurat (fire drill) dilaksanakan dan terdokumentasi secara berkala</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->administrasi_k3l_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->administrasi_k3l_5_due) ? \Carbon\Carbon::parse($sp->administrasi_k3l_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Pemeriksaan dan pengujian sarana proteksi kebakaran &amp; instalasi listrik terdokumentasi</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->administrasi_k3l_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->administrasi_k3l_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->administrasi_k3l_6_due) ? \Carbon\Carbon::parse($sp->administrasi_k3l_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>B</td>
                                                <td colspan="6">BANGUNAN DAN TATA RUANG</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Struktur bangunan (dinding, atap, plafon) dalam kondisi baik, tidak retak/bocor/rembes</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->bangunan_tata_ruang_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->bangunan_tata_ruang_1_due) ? \Carbon\Carbon::parse($sp->bangunan_tata_ruang_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Lantai rata, tidak licin, tidak berlubang, dan bebas dari bahaya tersandung</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->bangunan_tata_ruang_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->bangunan_tata_ruang_2_due) ? \Carbon\Carbon::parse($sp->bangunan_tata_ruang_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Tangga dilengkapi pegangan (handrail), anti-slip, dan bebas dari barang</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->bangunan_tata_ruang_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->bangunan_tata_ruang_3_due) ? \Carbon\Carbon::parse($sp->bangunan_tata_ruang_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Lorong, jalan keluar, dan pintu darurat bebas hambatan dan tidak terkunci dari dalam</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->bangunan_tata_ruang_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->bangunan_tata_ruang_4_due) ? \Carbon\Carbon::parse($sp->bangunan_tata_ruang_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Pintu darurat membuka ke arah luar / arah evakuasi</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->bangunan_tata_ruang_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->bangunan_tata_ruang_5_due) ? \Carbon\Carbon::parse($sp->bangunan_tata_ruang_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Lemari, rak arsip, dan perabot berat stabil atau diangkat/diikat ke dinding</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->bangunan_tata_ruang_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->bangunan_tata_ruang_6_due) ? \Carbon\Carbon::parse($sp->bangunan_tata_ruang_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Penataan ruang kerja tidak padat dan memiliki ruang gerak yang memadai</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->bangunan_tata_ruang_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->bangunan_tata_ruang_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->bangunan_tata_ruang_7_due) ? \Carbon\Carbon::parse($sp->bangunan_tata_ruang_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>C</td>
                                                <td colspan="6">LINGKUNGAN KERJA DAN ERGONOMI</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Pencahayaan ruang kerja memadai (± 300 lux untuk pekerjaan kantor)</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lingkungan_ergonomi_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lingkungan_ergonomi_1_due) ? \Carbon\Carbon::parse($sp->lingkungan_ergonomi_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>Suhu ruang nyaman (± 23–26 °C) dan kelembaban ± 40–60%</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lingkungan_ergonomi_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lingkungan_ergonomi_2_due) ? \Carbon\Carbon::parse($sp->lingkungan_ergonomi_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Ventilasi / sirkulasi udara baik; AC berfungsi dan filter dibersihkan berkala</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lingkungan_ergonomi_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lingkungan_ergonomi_3_due) ? \Carbon\Carbon::parse($sp->lingkungan_ergonomi_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>Tingkat kebisingan nyaman dan tidak mengganggu konsentrasi kerja</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lingkungan_ergonomi_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lingkungan_ergonomi_4_due) ? \Carbon\Carbon::parse($sp->lingkungan_ergonomi_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Kursi kerja dapat diatur (tinggi, sandaran) dan dalam kondisi baik</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lingkungan_ergonomi_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lingkungan_ergonomi_5_due) ? \Carbon\Carbon::parse($sp->lingkungan_ergonomi_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>Posisi monitor sejajar / sedikit di bawah mata dengan jarak ± 1 lengan</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lingkungan_ergonomi_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lingkungan_ergonomi_6_due) ? \Carbon\Carbon::parse($sp->lingkungan_ergonomi_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Meja kerja memadai dan bebas dari tumpukan barang berlebih</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->lingkungan_ergonomi_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->lingkungan_ergonomi_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->lingkungan_ergonomi_7_due) ? \Carbon\Carbon::parse($sp->lingkungan_ergonomi_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>D</td>
                                                <td colspan="6">INSTALASI LISTRIK DAN PERALATAN KANTOR</td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Panel listrik tertutup, berlabel, terkunci, dan area depannya bebas hambatan</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->instalasi_listrik_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->instalasi_listrik_1_due) ? \Carbon\Carbon::parse($sp->instalasi_listrik_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>Tidak ada kabel terkelupas, terbuka, atau melintang di jalur jalan</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->instalasi_listrik_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->instalasi_listrik_2_due) ? \Carbon\Carbon::parse($sp->instalasi_listrik_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>23</td>
                                                <td>Tidak ada penggunaan stop kontak bertumpuk (overload / steker bertingkat)</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->instalasi_listrik_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->instalasi_listrik_3_due) ? \Carbon\Carbon::parse($sp->instalasi_listrik_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>24</td>
                                                <td>Peralatan elektronik dimatikan / dicabut setelah jam kerja (sesuai prosedur)</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->instalasi_listrik_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->instalasi_listrik_4_due) ? \Carbon\Carbon::parse($sp->instalasi_listrik_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>Terdapat grounding dan pengaman arus (MCB/ELCB) yang berfungsi</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->instalasi_listrik_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->instalasi_listrik_5_due) ? \Carbon\Carbon::parse($sp->instalasi_listrik_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>26</td>
                                                <td>Genset / UPS (bila ada) dalam kondisi baik, berpagar, dan berventilasi</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->instalasi_listrik_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->instalasi_listrik_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->instalasi_listrik_6_due) ? \Carbon\Carbon::parse($sp->instalasi_listrik_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>E</td>
                                                <td colspan="6">PROTEKSI KEBAKARAN DAN TANGGAP DARURAT</td>
                                            </tr>
                                            <tr>
                                                <td>27</td>
                                                <td>Terdapat APAR sesuai kelas kebakaran, tidak kedaluwarsa, dan berkartu inspeksi</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_1_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>28</td>
                                                <td>APAR dipasang dengan tinggi puncak ≤ 1,2 m dan jarak antar APAR ≤ 15 m</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_2_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>29</td>
                                                <td>Detektor asap / alarm kebakaran tersedia dan berfungsi</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_3_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>30</td>
                                                <td>Hydrant / sprinkler (bila ada) dalam kondisi baik dan tidak terhalang</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_4_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>31</td>
                                                <td>Lampu darurat (emergency lamp) dan tanda EXIT menyala / berfungsi</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_5_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>32</td>
                                                <td>Terdapat rambu &amp; lokasi EMERGENCY MUSTER POINT yang jelas</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_6_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>33</td>
                                                <td>Kotak P3K tersedia dengan isi lengkap dan tidak kedaluwarsa</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_7_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>34</td>
                                                <td>Terdapat unit penyalur petir dengan tahanan maksimal 5 Ω</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_8_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_8_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->proteksi_kebakaran_8_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->proteksi_kebakaran_8_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->proteksi_kebakaran_8_due) ? \Carbon\Carbon::parse($sp->proteksi_kebakaran_8_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>F</td>
                                                <td colspan="6">SANITASI DAN FASILITAS PENDUKUNG</td>
                                            </tr>
                                            <tr>
                                                <td>35</td>
                                                <td>Toilet bersih, tidak berbau, air mengalir, dan terpisah pria / wanita</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->sanitasi_fasilitas_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sanitasi_fasilitas_1_due) ? \Carbon\Carbon::parse($sp->sanitasi_fasilitas_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>36</td>
                                                <td>Tersedia sabun cuci tangan dan tisu / pengering tangan</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->sanitasi_fasilitas_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sanitasi_fasilitas_2_due) ? \Carbon\Carbon::parse($sp->sanitasi_fasilitas_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>37</td>
                                                <td>Tersedia air minum yang laik minum</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->sanitasi_fasilitas_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sanitasi_fasilitas_3_due) ? \Carbon\Carbon::parse($sp->sanitasi_fasilitas_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>38</td>
                                                <td>Tersedia ruang / pantry yang bersih dan bebas serangga / tikus</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->sanitasi_fasilitas_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sanitasi_fasilitas_4_due) ? \Carbon\Carbon::parse($sp->sanitasi_fasilitas_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>39</td>
                                                <td>Tersedia tempat sampah terpilah (organik / anorganik / B3) dan bertutup</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->sanitasi_fasilitas_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sanitasi_fasilitas_5_due) ? \Carbon\Carbon::parse($sp->sanitasi_fasilitas_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>40</td>
                                                <td>Tersedia ruang laktasi dan ruang ibadah yang layak</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_6_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_6_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_6_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->sanitasi_fasilitas_6_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sanitasi_fasilitas_6_due) ? \Carbon\Carbon::parse($sp->sanitasi_fasilitas_6_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>41</td>
                                                <td>Area dalam gedung bebas asap rokok; tersedia area merokok khusus di luar gedung</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_7_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_7_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->sanitasi_fasilitas_7_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->sanitasi_fasilitas_7_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->sanitasi_fasilitas_7_due) ? \Carbon\Carbon::parse($sp->sanitasi_fasilitas_7_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>G</td>
                                                <td colspan="6">AREA LUAR DAN RAMBU KESELAMATAN</td>
                                            </tr>
                                            <tr>
                                                <td>42</td>
                                                <td>Area parkir tertata, terpisah antara kendaraan ringan dan alat berat</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_1_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_1_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_1_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->area_luar_rambu_1_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->area_luar_rambu_1_due) ? \Carbon\Carbon::parse($sp->area_luar_rambu_1_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>43</td>
                                                <td>Terdapat rambu batas kecepatan dan arah lalu lintas di area kantor</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_2_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_2_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_2_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->area_luar_rambu_2_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->area_luar_rambu_2_due) ? \Carbon\Carbon::parse($sp->area_luar_rambu_2_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>44</td>
                                                <td>Terdapat jalur pejalan kaki yang aman dan terpisah dari jalur kendaraan</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_3_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_3_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_3_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->area_luar_rambu_3_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->area_luar_rambu_3_due) ? \Carbon\Carbon::parse($sp->area_luar_rambu_3_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>45</td>
                                                <td>Saluran drainase di sekitar gedung berfungsi dan tidak tersumbat</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_4_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_4_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_4_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->area_luar_rambu_4_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->area_luar_rambu_4_due) ? \Carbon\Carbon::parse($sp->area_luar_rambu_4_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>46</td>
                                                <td>Terdapat rambu wajib APD saat keluar area kantor menuju area operasional</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_5_check ?? '') === 'Ya' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_5_check ?? '') === 'Tidak' ? '✔️' : '' }}</td>
                                                <td style="text-align:center;">{{ ($sp->area_luar_rambu_5_check ?? '') === 'N/A' ? '✔️' : '' }}</td>
                                                <td>{{ $sp->area_luar_rambu_5_action ?? '' }}</td>
                                                <td style="text-align:center;">{{ !empty($sp->area_luar_rambu_5_due) ? \Carbon\Carbon::parse($sp->area_luar_rambu_5_due)->locale('id')->isoFormat('D MMMM YYYY') : '' }}</td>
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
                                        <a href="{{ route('klkh.area-office.download', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.area-office.cetak', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


