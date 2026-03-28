@include('layout.head', ['title' => 'Inspeksi Area Workshop'])
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
                                        <h6>FM-SE-167/02/19/02/26</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">DAFTAR PERIKSA INSPEKSI WORKSHOP</h5>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Tanggal:</h6>
                                    <h5>{{ Carbon::parse($ws->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Nama Workshop:</h6>
                                    <h5>{{ $ws->nama_lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $ws->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Penanggung Jawab Area:</h6>
                                    <h5>{{ $ws->nik_penanggungjawab }} | {{ $ws->nama_penanggungjawab }}</h5>
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
                                                <td colspan="4">Housekeeping</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Apakah area kerja dalam keadaan rapi dan teratur?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_11_check }}</td>
                                                <td>{{ $ws->housekeeping_11_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_11_due ? \Carbon\Carbon::parse($ws->housekeeping_11_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Apakah lantai kerja bengkel dalam keadaan bersih dan bebas dari benda-benda yang tidak diperlukan?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_12_check }}</td>
                                                <td>{{ $ws->housekeeping_12_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_12_due ? \Carbon\Carbon::parse($ws->housekeeping_12_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Apakah kondisi lantai kerja bengkel tidak rusak?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_13_check }}</td>
                                                <td>{{ $ws->housekeeping_13_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_13_due ? \Carbon\Carbon::parse($ws->housekeeping_13_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Apakah jalur jalan diberi tanda / cat/ demarkasi jelas?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_14_check }}</td>
                                                <td>{{ $ws->housekeeping_14_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_14_due ? \Carbon\Carbon::parse($ws->housekeeping_14_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.5</td>
                                                <td>Apakah jalur jalan dan lintasan bebas dari hambatan?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_15_check }}</td>
                                                <td>{{ $ws->housekeeping_15_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_15_due ? \Carbon\Carbon::parse($ws->housekeeping_15_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.6</td>
                                                <td>Apakah penerangan termasuk lampu dan bola lampu ada dalam keadaan yang bersih dan berfungsi?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_16_check }}</td>
                                                <td>{{ $ws->housekeeping_16_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_16_due ? \Carbon\Carbon::parse($ws->housekeeping_16_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.7</td>
                                                <td>Apakah permukaan halaman bengkel tidak bergelombang, tidak becek, dan bersih dari sampah?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_17_check }}</td>
                                                <td>{{ $ws->housekeeping_17_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_17_due ? \Carbon\Carbon::parse($ws->housekeeping_17_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.8</td>
                                                <td>Apakah drainase berfungsi dengan baik?</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_18_check }}</td>
                                                <td>{{ $ws->housekeeping_18_action }}</td>
                                                <td style="text-align:center;">{{ $ws->housekeeping_18_due ? \Carbon\Carbon::parse($ws->housekeeping_18_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Tabung Bertekanan</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Apakah tabung bertekanan diletakkan dalam posisi berdiri dan terikat kuat?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_21_check }}</td>
                                                <td>{{ $ws->tabung_21_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_21_due ? \Carbon\Carbon::parse($ws->tabung_21_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Apakah tabung gas kosong/berisi pada posisi aman (terikat) dan terdapat penutup besi (cap)?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_22_check }}</td>
                                                <td>{{ $ws->tabung_22_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_22_due ? \Carbon\Carbon::parse($ws->tabung_22_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Apakah regulator indikator berfungsi dengan baik?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_23_check }}</td>
                                                <td>{{ $ws->tabung_23_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_23_due ? \Carbon\Carbon::parse($ws->tabung_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Apakah jarum regulator indikator berada di titik nol pada tabung yang tidak digunakan?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_24_check }}</td>
                                                <td>{{ $ws->tabung_24_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_24_due ? \Carbon\Carbon::parse($ws->tabung_24_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Apakah labelling dan warna tabung jelas/tidak pudar?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_25_check }}</td>
                                                <td>{{ $ws->tabung_25_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_25_due ? \Carbon\Carbon::parse($ws->tabung_25_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.6</td>
                                                <td>Apakah braket / tempat penyimpanan tabung bertekanan mencukupi dan memadai?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_26_check }}</td>
                                                <td>{{ $ws->tabung_26_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_26_due ? \Carbon\Carbon::parse($ws->tabung_26_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.7</td>
                                                <td>Apakah tempat penyimpanan tabung bertekanan (bila ada), sudah rapi dan tidak berserakan?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_27_check }}</td>
                                                <td>{{ $ws->tabung_27_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_27_due ? \Carbon\Carbon::parse($ws->tabung_27_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.8</td>
                                                <td>Apakah tempat penyimpanan tabung oksigen dan acetyline dipisahkan dengan jarak minimal 6 meter?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_28_check }}</td>
                                                <td>{{ $ws->tabung_28_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_28_due ? \Carbon\Carbon::parse($ws->tabung_28_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.9</td>
                                                <td>Apakah terdapat APAR di trolly tabung gas bertekanan yang digunakan saat bekerja?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_29_check }}</td>
                                                <td>{{ $ws->tabung_29_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_29_due ? \Carbon\Carbon::parse($ws->tabung_29_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.10</td>
                                                <td>Apakah hose tabung bertekanan dalam kondisi baik?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_210_check }}</td>
                                                <td>{{ $ws->tabung_210_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_210_due ? \Carbon\Carbon::parse($ws->tabung_210_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.11</td>
                                                <td>Apakah terdapat flash back arrestore?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_211_check }}</td>
                                                <td>{{ $ws->tabung_211_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_211_due ? \Carbon\Carbon::parse($ws->tabung_211_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.12</td>
                                                <td>Terdapat pengaman pada bagian mesin yang berputar?</td>
                                                <td style="text-align:center;">{{ $ws->tabung_212_check }}</td>
                                                <td>{{ $ws->tabung_212_action }}</td>
                                                <td style="text-align:center;">{{ $ws->tabung_212_due ? \Carbon\Carbon::parse($ws->tabung_212_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">Emergency Equipment</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3.1</td>
                                                <td colspan="4">APAR & Hydrant</td>
                                            </tr>
                                            <tr>
                                                <td>3.1.1</td>
                                                <td>Apakah APAR mencukupi & terdapat tanda (marking)?</td>
                                                <td style="text-align:center;">{{ $ws->apar_311_check }}</td>
                                                <td>{{ $ws->apar_311_action }}</td>
                                                <td style="text-align:center;">{{ $ws->apar_311_due ? \Carbon\Carbon::parse($ws->apar_311_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.1.2</td>
                                                <td>Apakah kondisi tabung APAR dalam kondisi tidak rusak?</td>
                                                <td style="text-align:center;">{{ $ws->apar_312_check }}</td>
                                                <td>{{ $ws->apar_312_action }}</td>
                                                <td style="text-align:center;">{{ $ws->apar_312_due ? \Carbon\Carbon::parse($ws->apar_312_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.1.3</td>
                                                <td>Apakah akses ke alat pemadam tidak terhalangi?</td>
                                                <td style="text-align:center;">{{ $ws->apar_313_check }}</td>
                                                <td>{{ $ws->apar_313_action }}</td>
                                                <td style="text-align:center;">{{ $ws->apar_313_due ? \Carbon\Carbon::parse($ws->apar_313_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.1.4</td>
                                                <td>Apakah APAR diinspeksi secara rutin dan terdapat tag?</td>
                                                <td style="text-align:center;">{{ $ws->apar_314_check }}</td>
                                                <td>{{ $ws->apar_314_action }}</td>
                                                <td style="text-align:center;">{{ $ws->apar_314_due ? \Carbon\Carbon::parse($ws->apar_314_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.1.5</td>
                                                <td>Apakah hidran untuk kebakaran (bila ada) dan perlengkapannya dalam keadaan baik?</td>
                                                <td style="text-align:center;">{{ $ws->apar_315_check }}</td>
                                                <td>{{ $ws->apar_315_action }}</td>
                                                <td style="text-align:center;">{{ $ws->apar_315_due ? \Carbon\Carbon::parse($ws->apar_315_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3.2</td>
                                                <td colspan="4">Eyewash</td>
                                            </tr>
                                            <tr>
                                                <td>3.2.1</td>
                                                <td>Apakah tempat pencucian mata dalam kondisi bersih?</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_321_check }}</td>
                                                <td>{{ $ws->eyewash_321_action }}</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_321_due ? \Carbon\Carbon::parse($ws->eyewash_321_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2.2</td>
                                                <td>Apakah eyewash dilakukan inspeksi secara teratur dan terdapat tag yang diisi sesuai?</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_322_check }}</td>
                                                <td>{{ $ws->eyewash_322_action }}</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_322_due ? \Carbon\Carbon::parse($ws->eyewash_322_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2.3</td>
                                                <td>Apakah tempat pencucian mata berfungsi dengan baik?</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_323_check }}</td>
                                                <td>{{ $ws->eyewash_323_action }}</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_323_due ? \Carbon\Carbon::parse($ws->eyewash_323_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2.4</td>
                                                <td>Apakah akses ke tempat pencucian mata tidak terhalangi?</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_324_check }}</td>
                                                <td>{{ $ws->eyewash_324_action }}</td>
                                                <td style="text-align:center;">{{ $ws->eyewash_324_due ? \Carbon\Carbon::parse($ws->eyewash_324_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3.3</td>
                                                <td colspan="4">Assembly Point</td>
                                            </tr>
                                            <tr>
                                                <td>3.3.1</td>
                                                <td>Apakah ada peta /layout area berkumpul darurat?</td>
                                                <td style="text-align:center;">{{ $ws->assembly_331_check }}</td>
                                                <td>{{ $ws->assembly_331_action }}</td>
                                                <td style="text-align:center;">{{ $ws->assembly_331_due ? \Carbon\Carbon::parse($ws->assembly_331_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3.2</td>
                                                <td>Apakah area berkumpul darurat diberi rambu “Assembly Point”?</td>
                                                <td style="text-align:center;">{{ $ws->assembly_332_check }}</td>
                                                <td>{{ $ws->assembly_332_action }}</td>
                                                <td style="text-align:center;">{{ $ws->assembly_332_due ? \Carbon\Carbon::parse($ws->assembly_332_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Rambu-Rambu</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Apakah ada rambu pemakaian “APD Standard”?</td>
                                                <td style="text-align:center;">{{ $ws->rambu_41_check }}</td>
                                                <td>{{ $ws->rambu_41_action }}</td>
                                                <td style="text-align:center;">{{ $ws->rambu_41_due ? \Carbon\Carbon::parse($ws->rambu_41_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Apakah ada rambu “Dilarang Merokok” untuk area yang berpotensi terjadi kebakaran?</td>
                                                <td style="text-align:center;">{{ $ws->rambu_42_check }}</td>
                                                <td>{{ $ws->rambu_42_action }}</td>
                                                <td style="text-align:center;">{{ $ws->rambu_42_due ? \Carbon\Carbon::parse($ws->rambu_42_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Apakah terdapat rambu lalulintas yang memadai?</td>
                                                <td style="text-align:center;">{{ $ws->rambu_43_check }}</td>
                                                <td>{{ $ws->rambu_43_action }}</td>
                                                <td style="text-align:center;">{{ $ws->rambu_43_due ? \Carbon\Carbon::parse($ws->rambu_43_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.4</td>
                                                <td>Apakah ada tanda-tanda jalur keluar darurat ?</td>
                                                <td style="text-align:center;">{{ $ws->rambu_44_check }}</td>
                                                <td>{{ $ws->rambu_44_action }}</td>
                                                <td style="text-align:center;">{{ $ws->rambu_44_due ? \Carbon\Carbon::parse($ws->rambu_44_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.5</td>
                                                <td>Apakah terdapat rambu parkir kendaraan/unit?</td>
                                                <td style="text-align:center;">{{ $ws->rambu_45_check }}</td>
                                                <td>{{ $ws->rambu_45_action }}</td>
                                                <td style="text-align:center;">{{ $ws->rambu_45_due ? \Carbon\Carbon::parse($ws->rambu_45_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.6</td>
                                                <td>Apakah Emergency Flow Chart tersedia?</td>
                                                <td style="text-align:center;">{{ $ws->rambu_46_check }}</td>
                                                <td>{{ $ws->rambu_46_action }}</td>
                                                <td style="text-align:center;">{{ $ws->rambu_46_due ? \Carbon\Carbon::parse($ws->rambu_46_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>5</td>
                                                <td colspan="4">Peralatan Kerja</td>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Apakah hand tools/power tools layak pakai?</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_51_check }}</td>
                                                <td>{{ $ws->peralatan_51_action }}</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_51_due ? \Carbon\Carbon::parse($ws->peralatan_51_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Apakah alat bantu angkat dalam kondisi layak pakai?</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_52_check }}</td>
                                                <td>{{ $ws->peralatan_52_action }}</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_52_due ? \Carbon\Carbon::parse($ws->peralatan_52_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.3</td>
                                                <td>Apakah tangga kerja dalam kondisi layak pakai?</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_53_check }}</td>
                                                <td>{{ $ws->peralatan_53_action }}</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_53_due ? \Carbon\Carbon::parse($ws->peralatan_53_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.4</td>
                                                <td>Apakah stand jack dalam kondisi layak pakai?</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_54_check }}</td>
                                                <td>{{ $ws->peralatan_54_action }}</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_54_due ? \Carbon\Carbon::parse($ws->peralatan_54_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.5</td>
                                                <td>Apakah alat kerja di ketinggian layak pakai?</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_55_check }}</td>
                                                <td>{{ $ws->peralatan_55_action }}</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_55_due ? \Carbon\Carbon::parse($ws->peralatan_55_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.6</td>
                                                <td>Apakah peralatan pengelasan layak pakai?</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_56_check }}</td>
                                                <td>{{ $ws->peralatan_56_action }}</td>
                                                <td style="text-align:center;">{{ $ws->peralatan_56_due ? \Carbon\Carbon::parse($ws->peralatan_56_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>6</td>
                                                <td colspan="4">Pemasangan LOTO</td>
                                            </tr>
                                            <tr>
                                                <td>6.1</td>
                                                <td>Apakah semua mekanik memiliki LOTO?</td>
                                                <td style="text-align:center;">{{ $ws->loto_61_check }}</td>
                                                <td>{{ $ws->loto_61_action }}</td>
                                                <td style="text-align:center;">{{ $ws->loto_61_due ? \Carbon\Carbon::parse($ws->loto_61_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.2</td>
                                                <td>Apakah LOTO terpasang pada unit yang diperbaiki?</td>
                                                <td style="text-align:center;">{{ $ws->loto_62_check }}</td>
                                                <td>{{ $ws->loto_62_action }}</td>
                                                <td style="text-align:center;">{{ $ws->loto_62_due ? \Carbon\Carbon::parse($ws->loto_62_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.3</td>
                                                <td>Apakah LOTO yang terpasang sesuai dengan mekanik yang bekerja pada unit tersebut?</td>
                                                <td style="text-align:center;">{{ $ws->loto_63_check }}</td>
                                                <td>{{ $ws->loto_63_action }}</td>
                                                <td style="text-align:center;">{{ $ws->loto_63_due ? \Carbon\Carbon::parse($ws->loto_63_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.4</td>
                                                <td>Apakah seluruh sumber energi sudah diputus?</td>
                                                <td style="text-align:center;">{{ $ws->loto_64_check }}</td>
                                                <td>{{ $ws->loto_64_action }}</td>
                                                <td style="text-align:center;">{{ $ws->loto_64_due ? \Carbon\Carbon::parse($ws->loto_64_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.5</td>
                                                <td>Apakah bentuk gembok yang terpasang sesuai?</td>
                                                <td style="text-align:center;">{{ $ws->loto_65_check }}</td>
                                                <td>{{ $ws->loto_65_action }}</td>
                                                <td style="text-align:center;">{{ $ws->loto_65_due ? \Carbon\Carbon::parse($ws->loto_65_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.6</td>
                                                <td>Apakah personal tag dalam kondisi dapat terbaca?</td>
                                                <td style="text-align:center;">{{ $ws->loto_66_check }}</td>
                                                <td>{{ $ws->loto_66_action }}</td>
                                                <td style="text-align:center;">{{ $ws->loto_66_due ? \Carbon\Carbon::parse($ws->loto_66_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.7</td>
                                                <td>Apakah box isolasi dalam kondisi baik dan berfungsi?</td>
                                                <td style="text-align:center;">{{ $ws->loto_67_check }}</td>
                                                <td>{{ $ws->loto_67_action }}</td>
                                                <td style="text-align:center;">{{ $ws->loto_67_due ? \Carbon\Carbon::parse($ws->loto_67_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>7</td>
                                                <td colspan="4">Pengelolaan Sampah Dan Hidrokarbon</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>7.1</td>
                                                <td colspan="4">Kondisi Umum</td>
                                            </tr>
                                            <tr>
                                                <td>7.1.1</td>
                                                <td>Apakah terdapat ceceran hydrokarbon di tanah?</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_711_check }}</td>
                                                <td>{{ $ws->kondisi_umum_711_action }}</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_711_due ? \Carbon\Carbon::parse($ws->kondisi_umum_711_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.1.2</td>
                                                <td>Apakah tersedia tempat sampah / limbah dan penampungan tumpahan oli?</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_712_check }}</td>
                                                <td>{{ $ws->kondisi_umum_712_action }}</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_712_due ? \Carbon\Carbon::parse($ws->kondisi_umum_712_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.1.3</td>
                                                <td>Apakah tempat pembuangan sampah / limbah sudah diberi nama dan tanda yang benar dan cukup?</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_713_check }}</td>
                                                <td>{{ $ws->kondisi_umum_713_action }}</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_713_due ? \Carbon\Carbon::parse($ws->kondisi_umum_713_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.1.4</td>
                                                <td>Apakah limbah besi, domestik dan limbah beroli (Filter oli, majun, dll) diletakkan pada tempat yang sesuai?</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_714_check }}</td>
                                                <td>{{ $ws->kondisi_umum_714_action }}</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_714_due ? \Carbon\Carbon::parse($ws->kondisi_umum_714_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.1.5</td>
                                                <td>Apakah terdapat bahan hydrokarbon yang diletakkan diluar area berbunding?</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_715_check }}</td>
                                                <td>{{ $ws->kondisi_umum_715_action }}</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_715_due ? \Carbon\Carbon::parse($ws->kondisi_umum_715_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.1.6</td>
                                                <td>Apakah terdapat emergency spill kit di workshop?</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_716_check }}</td>
                                                <td>{{ $ws->kondisi_umum_716_action }}</td>
                                                <td style="text-align:center;">{{ $ws->kondisi_umum_716_due ? \Carbon\Carbon::parse($ws->kondisi_umum_716_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>7.2</td>
                                                <td colspan="4">Penyimpanan Hydrocarbon</td>
                                            </tr>
                                            <tr>
                                                <td>7.2.1</td>
                                                <td>Apakah terdapat kebocoran pada fasilitas penyimpanan hidrokarbon?</td>
                                                <td style="text-align:center;">{{ $ws->hydrocarbon_721_check }}</td>
                                                <td>{{ $ws->hydrocarbon_721_action }}</td>
                                                <td style="text-align:center;">{{ $ws->hydrocarbon_721_due ? \Carbon\Carbon::parse($ws->hydrocarbon_721_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.2.2</td>
                                                <td>Apakah ada kebocoran pada fasilitas pompa, perpipaan dan hose?</td>
                                                <td style="text-align:center;">{{ $ws->hydrocarbon_722_check }}</td>
                                                <td>{{ $ws->hydrocarbon_722_action }}</td>
                                                <td style="text-align:center;">{{ $ws->hydrocarbon_722_due ? \Carbon\Carbon::parse($ws->hydrocarbon_722_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.2.3</td>
                                                <td>Apakah valve pembuangan selalu tertutup?</td>
                                                <td style="text-align:center;">{{ $ws->hydrocarbon_723_check }}</td>
                                                <td>{{ $ws->hydrocarbon_723_action }}</td>
                                                <td style="text-align:center;">{{ $ws->hydrocarbon_723_due ? \Carbon\Carbon::parse($ws->hydrocarbon_723_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>7.3</td>
                                                <td colspan="4">Oil Trap</td>
                                            </tr>
                                            <tr>
                                                <td>7.3.1</td>
                                                <td>Apakah kondisi kompartemen oil trap sudah bersih (bebas dari lumpur dan oli)?</td>
                                                <td style="text-align:center;">{{ $ws->oil_731_check }}</td>
                                                <td>{{ $ws->oil_731_action }}</td>
                                                <td style="text-align:center;">{{ $ws->oil_731_due ? \Carbon\Carbon::parse($ws->oil_731_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.3.2</td>
                                                <td>Apakah pijakan (ram) dan pagar dalam keadaan baik?</td>
                                                <td style="text-align:center;">{{ $ws->oil_732_check }}</td>
                                                <td>{{ $ws->oil_732_action }}</td>
                                                <td style="text-align:center;">{{ $ws->oil_732_due ? \Carbon\Carbon::parse($ws->oil_732_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.3.3</td>
                                                <td>Apakah ada kebocoran pada oil trap atau sistem pelimpasan?</td>
                                                <td style="text-align:center;">{{ $ws->oil_733_check }}</td>
                                                <td>{{ $ws->oil_733_action }}</td>
                                                <td style="text-align:center;">{{ $ws->oil_733_due ? \Carbon\Carbon::parse($ws->oil_733_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $ws->additional_notes }}</p>
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
                                                <td>{{ $ws->nama_inspektor1 }}</td>
                                                <td>{{ $ws->nik_inspektor1 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ws->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $ws->nama_inspektor2 }}</td>
                                                <td>{{ $ws->nik_inspektor2 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ws->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $ws->nama_inspektor3 }}</td>
                                                <td>{{ $ws->nik_inspektor3 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ws->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $ws->nama_inspektor4 }}</td>
                                                <td>{{ $ws->nik_inspektor4 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ws->verified_inspektor4 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>{{ $ws->nama_inspektor5 }}</td>
                                                <td>{{ $ws->nik_inspektor5 }}</td>
                                                <td></td>
                                                <td><img src="{{ $ws->verified_inspektor5 }}" style="max-width: 70px;"></td>
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
                                        <a href="{{ route('klkh.loading-point.download', $ws->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $ws->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


