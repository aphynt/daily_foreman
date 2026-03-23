@include('layout.head', ['title' => 'Inspeksi Tambang - Jalan Tambang'])
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
                                        <h6>FM-SE-12/00/05/02/26</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">DAFTAR PERIKSA INSPEKSI TAMBANG - JALAN TAMBANG</h5>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Tanggal:</h6>
                                    <h5>{{ Carbon::parse($jt->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Nama Lokasi:</h6>
                                    <h5>{{ $jt->nama_lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi Pit:</h6>
                                    <h5>{{ $jt->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Penanggung Jawab Area:</h6>
                                    <h5>{{ $jt->nik_penanggungjawab }} | {{ $jt->nama_penanggungjawab }}</h5>
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
                                                <td colspan="4">Apakah dimensi jalan memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Lebar jalan untuk jalan satu lajur minimum 2 kali lebar unit terbesar</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_11_check }}</td>
                                                {{-- <td>{{ $jt->dimensi_11_check === null ? '' : ($jt->dimensi_11_check === 'S' ? 'Setuju' : 'Tidak Setuju') }}</td> --}}
                                                <td>{{ $jt->dimensi_11_action }}</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_11_due ? \Carbon\Carbon::parse($jt->dimensi_11_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Lebar jalan untuk jalan dua jalur minimum 3,5 kali lebar unit terbesar</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_12_check }}</td>
                                                <td>{{ $jt->dimensi_12_action }}</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_12_due ? \Carbon\Carbon::parse($jt->dimensi_12_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Kemiringan tanjakan jalan (grade) maksimum 8%</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_13_check }}</td>
                                                <td>{{ $jt->dimensi_13_action }}</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_13_due ? \Carbon\Carbon::parse($jt->dimensi_13_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Kemiringan permukaan jalan (cross fall) antara 2- 4%</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_14_check }}</td>
                                                <td>{{ $jt->dimensi_14_action }}</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_14_due ? \Carbon\Carbon::parse($jt->dimensi_14_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.5</td>
                                                <td>Super Elevasi di tikungan 4-6%</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_15_check }}</td>
                                                <td>{{ $jt->dimensi_15_action }}</td>
                                                <td style="text-align:center;">{{ $jt->dimensi_15_due ? \Carbon\Carbon::parse($jt->dimensi_15_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Apakah kondisi fisik jalan memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Permukaan jalan rata, tidak undulasi, berlubang, lekuk jalan dan bongkah</td>
                                                <td style="text-align:center;">{{ $jt->fisik_21_check }}</td>
                                                <td>{{ $jt->fisik_21_action }}</td>
                                                <td style="text-align:center;">{{ $jt->fisik_21_due ? \Carbon\Carbon::parse($jt->fisik_21_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Drainase baik, tidak ada genangan air di permukaan jalan</td>
                                                <td style="text-align:center;">{{ $jt->fisik_22_check }}</td>
                                                <td>{{ $jt->fisik_22_action }}</td>
                                                <td style="text-align:center;">{{ $jt->fisik_22_due ? \Carbon\Carbon::parse($jt->fisik_22_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Kondisi debu terkontrol dengan baik, jarak padang masih aman</td>
                                                <td style="text-align:center;">{{ $jt->fisik_23_check }}</td>
                                                <td>{{ $jt->fisik_23_action }}</td>
                                                <td style="text-align:center;">{{ $jt->fisik_23_due ? \Carbon\Carbon::parse($jt->fisik_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Tidak terdapat tumpukan spoil yang menyebabkan penyempitan jalan</td>
                                                <td style="text-align:center;">{{ $jt->fisik_24_check }}</td>
                                                <td>{{ $jt->fisik_24_action }}</td>
                                                <td style="text-align:center;">{{ $jt->fisik_24_due ? \Carbon\Carbon::parse($jt->fisik_24_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">Apakah tanggul jalan memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Tanggul jalan trapezium, utuh, tidak tergerus air, lebar atas 1 meter</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_31_check }}</td>
                                                <td>{{ $jt->tanggul_31_action }}</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_31_due ? \Carbon\Carbon::parse($jt->tanggul_31_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Tinggi tanggul jalan kiri kanan minimum ¾ tinggi ban unit terbesar</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_32_check }}</td>
                                                <td>{{ $jt->tanggul_32_action }}</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_32_due ? \Carbon\Carbon::parse($jt->tanggul_32_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Mulai jarak 30 m dari persimpangan tinggi tanggul maksimal 1 meter </td>
                                                <td style="text-align:center;">{{ $jt->tanggul_33_check }}</td>
                                                <td>{{ $jt->tanggul_33_action }}</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_33_due ? \Carbon\Carbon::parse($jt->tanggul_33_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Lereng tanggul jalan dibentuk dengan kemiringan (lebar : tinggi) 1 : 2   </td>
                                                <td style="text-align:center;">{{ $jt->tanggul_34_check }}</td>
                                                <td>{{ $jt->tanggul_34_action }}</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_34_due ? \Carbon\Carbon::parse($jt->tanggul_34_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.5</td>
                                                <td>Setiap 50-100 m panjang tanggul dibuat sodetan dengan lebar 0,5-1m untuk drainase air permukaan jalan</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_35_check }}</td>
                                                <td>{{ $jt->tanggul_35_action }}</td>
                                                <td style="text-align:center;">{{ $jt->tanggul_35_due ? \Carbon\Carbon::parse($jt->tanggul_35_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Apakah patok jalan memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Patok jalan terpasang setiap jarak 50 m jalan lurus dan 15 m di tikungan</td>
                                                <td style="text-align:center;">{{ $jt->patok_41_check }}</td>
                                                <td>{{ $jt->patok_41_action }}</td>
                                                <td style="text-align:center;">{{ $jt->patok_41_due ? \Carbon\Carbon::parse($jt->patok_41_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Patok jalan tinggi minimal 1 meter dari atas tanggul dan dicat warna putih</td>
                                                <td style="text-align:center;">{{ $jt->patok_42_check }}</td>
                                                <td>{{ $jt->patok_42_action }}</td>
                                                <td style="text-align:center;">{{ $jt->patok_42_due ? \Carbon\Carbon::parse($jt->patok_42_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Reflektif patok pada kiri jalan berwarna merah dan kanan jalan warna putih</td>
                                                <td style="text-align:center;">{{ $jt->patok_43_check }}</td>
                                                <td>{{ $jt->patok_43_action }}</td>
                                                <td style="text-align:center;">{{ $jt->patok_43_due ? \Carbon\Carbon::parse($jt->patok_43_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.4</td>
                                                <td>Bahan reflektif dimensi lebar minimal 6 cm dan tinggi minimal 15 cm</td>
                                                <td style="text-align:center;">{{ $jt->patok_44_check }}</td>
                                                <td>{{ $jt->patok_44_action }}</td>
                                                <td style="text-align:center;">{{ $jt->patok_44_due ? \Carbon\Carbon::parse($jt->patok_44_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>5</td>
                                                <td colspan="4">Apakah rambu lalu lintas memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Rambu-rambu terpasang di jalan tambang diameter 90 cm (SNI)</td>
                                                <td style="text-align:center;">{{ $jt->rambu_51_check }}</td>
                                                <td>{{ $jt->rambu_51_action }}</td>
                                                <td style="text-align:center;">{{ $jt->rambu_51_due ? \Carbon\Carbon::parse($jt->rambu_51_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Rambu batas kecepatan terpasang sesuai dengan risk assessment</td>
                                                <td style="text-align:center;">{{ $jt->rambu_52_check }}</td>
                                                <td>{{ $jt->rambu_52_action }}</td>
                                                <td style="text-align:center;">{{ $jt->rambu_52_due ? \Carbon\Carbon::parse($jt->rambu_52_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.3</td>
                                                <td>Rambu jarak aman antar unit 50 m terpasang sesuai risk assessment</td>
                                                <td style="text-align:center;">{{ $jt->rambu_53_check }}</td>
                                                <td>{{ $jt->rambu_53_action }}</td>
                                                <td style="text-align:center;">{{ $jt->rambu_53_due ? \Carbon\Carbon::parse($jt->rambu_53_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.4</td>
                                                <td>Rambu larangan mendahului dipasang 50 m sebelum tikungan dan 50 m setelah tikungan dipasang rambu batas akhir larangan mendahului</td>
                                                <td style="text-align:center;">{{ $jt->rambu_54_check }}</td>
                                                <td>{{ $jt->rambu_54_action }}</td>
                                                <td style="text-align:center;">{{ $jt->rambu_54_due ? \Carbon\Carbon::parse($jt->rambu_54_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.5</td>
                                                <td>Rambu larangan mendahului dipasang 50 m sebelum tanjakan/turunan dan 50 m setelah tanjakan/turunan rambu batas akhir larangan mendahului</td>
                                                <td style="text-align:center;">{{ $jt->rambu_55_check }}</td>
                                                <td>{{ $jt->rambu_55_action }}</td>
                                                <td style="text-align:center;">{{ $jt->rambu_55_due ? \Carbon\Carbon::parse($jt->rambu_55_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>6</td>
                                                <td colspan="4">Apakah kondisi persimpangan jalan memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>6.1</td>
                                                <td>Desain persimpangan jalan memiliki sudut simpang 70° - 90°</td>
                                                <td style="text-align:center;">{{ $jt->simpang_61_check }}</td>
                                                <td>{{ $jt->simpang_61_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_61_due ? \Carbon\Carbon::parse($jt->simpang_61_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.2</td>
                                                <td>Terdapat tanggul pemisah jalur jalan sesuai kebutuhan di persimpangan</td>
                                                <td style="text-align:center;">{{ $jt->simpang_62_check }}</td>
                                                <td>{{ $jt->simpang_62_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_62_due ? \Carbon\Carbon::parse($jt->simpang_62_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.3</td>
                                                <td>Tinggi tanggul pemisah jalan minimal ½ tinggi ban unit terbesar</td>
                                                <td style="text-align:center;">{{ $jt->simpang_63_check }}</td>
                                                <td>{{ $jt->simpang_63_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_63_due ? \Carbon\Carbon::parse($jt->simpang_63_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.4</td>
                                                <td>Lebar tanggul pemisah jalan sama dengan lebar ban unit terbesar</td>
                                                <td style="text-align:center;">{{ $jt->simpang_64_check }}</td>
                                                <td>{{ $jt->simpang_64_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_64_due ? \Carbon\Carbon::parse($jt->simpang_64_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.5</td>
                                                <td>Setiap ujung tanggul pemisah dipasang patok bereflektif</td>
                                                <td style="text-align:center;">{{ $jt->simpang_65_check }}</td>
                                                <td>{{ $jt->simpang_65_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_65_due ? \Carbon\Carbon::parse($jt->simpang_65_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.6</td>
                                                <td>Terdapat rambu peringatan pada 100 meter sebelum persimpangan</td>
                                                <td style="text-align:center;">{{ $jt->simpang_66_check }}</td>
                                                <td>{{ $jt->simpang_66_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_66_due ? \Carbon\Carbon::parse($jt->simpang_66_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.7</td>
                                                <td>Terdapat rambu STOP dan GIVE WAY sesuai dengan risk assessment</td>
                                                <td style="text-align:center;">{{ $jt->simpang_67_check }}</td>
                                                <td>{{ $jt->simpang_67_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_67_due ? \Carbon\Carbon::parse($jt->simpang_67_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.8</td>
                                                <td>Terdapat rambu perpindahan channel sesuai prioritas jalan</td>
                                                <td style="text-align:center;">{{ $jt->simpang_68_check }}</td>
                                                <td>{{ $jt->simpang_68_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_68_due ? \Carbon\Carbon::parse($jt->simpang_68_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.9</td>
                                                <td>Pandangan leluasa, tidak ada blind spot karena terhalang tanggul/objek lain</td>
                                                <td style="text-align:center;">{{ $jt->simpang_69_check }}</td>
                                                <td>{{ $jt->simpang_69_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_69_due ? \Carbon\Carbon::parse($jt->simpang_69_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.10</td>
                                                <td>Terdapat penerangan di persimpangan jalan sesuai risk assessment</td>
                                                <td style="text-align:center;">{{ $jt->simpang_610_check }}</td>
                                                <td>{{ $jt->simpang_610_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_610_due ? \Carbon\Carbon::parse($jt->simpang_610_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.11</td>
                                                <td>Tinggi tanggul tidak lebih 1 M setiap dimulai 30 M dari persimpangan </td>
                                                <td style="text-align:center;">{{ $jt->simpang_611_check }}</td>
                                                <td>{{ $jt->simpang_611_action }}</td>
                                                <td style="text-align:center;">{{ $jt->simpang_611_due ? \Carbon\Carbon::parse($jt->simpang_611_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $jt->additional_notes }}</p>
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
                                                <td>{{ $jt->nama_inspektor1 }}</td>
                                                <td>{{ $jt->nik_inspektor1 }}</td>
                                                <td></td>
                                                <td><img src="{{ $jt->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $jt->nama_inspektor2 }}</td>
                                                <td>{{ $jt->nik_inspektor2 }}</td>
                                                <td></td>
                                                <td><img src="{{ $jt->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $jt->nama_inspektor3 }}</td>
                                                <td>{{ $jt->nik_inspektor3 }}</td>
                                                <td></td>
                                                <td><img src="{{ $jt->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $jt->nama_inspektor4 }}</td>
                                                <td>{{ $jt->nik_inspektor4 }}</td>
                                                <td></td>
                                                <td><img src="{{ $jt->verified_inspektor4 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>{{ $jt->nama_inspektor5 }}</td>
                                                <td>{{ $jt->nik_inspektor5 }}</td>
                                                <td></td>
                                                <td><img src="{{ $jt->verified_inspektor5 }}" style="max-width: 70px;"></td>
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
                                        <a href="{{ route('klkh.loading-point.download', $jt->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $jt->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


