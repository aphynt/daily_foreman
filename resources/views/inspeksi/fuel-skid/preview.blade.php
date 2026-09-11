@include('layout.head', ['title' => 'Checklist Inspeksi Fuel Skid'])
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
                                        <h6>FM-SHE-140/01/27/06/22</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">CHECKLIST INSPEKSI FUEL SKID</h5>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $fs->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Nomor Tangki:</h6>
                                    <h5>{{ $fs->nomor_tangki }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Kapasitas Tangki:</h6>
                                    <h5>{{ $fs->kapasitas_tangki }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pukul:</h6>
                                    <h5>{{ Carbon::parse($fs->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($fs->jam_inspeksi)->locale('id')->isoFormat('HH:mm') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">PIC:</h6>
                                    <h5>{{ $fs->nik_pic }} | {{ $fs->pic }}</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Deskripsi Pemeriksaan</th>
                                                <th>YA</th>
                                                <th>TIDAK</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr style="font-weight: bold;">
                                                <td>I</td>
                                                <td colspan="4">Lokasi Kerja</td>
                                            </tr>

                                            <tr>
                                                <td>1.1</td>
                                                <td>Terdapat papan informasi yang memadai</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_11_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_11_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_11_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.2</td>
                                                <td>Rambu muster point terpasang di lokasi</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_12_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_12_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_12_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.3</td>
                                                <td>Rambu tanda dilarang masuk bagi yang tidak berkepentingan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_13_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_13_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_13_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.4</td>
                                                <td>Rambu petunjuk / tanda masuk dan keluar terpasang</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_14_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_14_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_14_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.5</td>
                                                <td>Terdapat perlengkapan oil spill (absorbent)</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_15_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_15_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_15_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.6</td>
                                                <td>Terdapat eye wash</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_16_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_16_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_16_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.7</td>
                                                <td>Terdapat tanda evakuasi dan peta evakuasi</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_17_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_17_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_17_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.8</td>
                                                <td>Terdapat SOP Keadaan Darurat</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_18_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_18_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_18_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.9</td>
                                                <td>Terdapat wadah penampung untuk kegiatan re-fuelling</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_19_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->lokasikerja_19_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->lokasikerja_19_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>II</td>
                                                <td colspan="4">Ruang Istirahat dan Pengawas</td>
                                            </tr>

                                            <tr>
                                                <td>2.1</td>
                                                <td>Kondisi bersih dan memadai</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_21_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_21_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->ruangistirahat_21_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.2</td>
                                                <td>Bisa menampung jumlah pekerja</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_22_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_22_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->ruangistirahat_22_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.3</td>
                                                <td>Dilengkapi lampu penerangan, kotak P3K, APAR, radio, dan pendingin ruangan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_23_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_23_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->ruangistirahat_23_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.4</td>
                                                <td>Ruangan tertutup</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_24_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_24_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->ruangistirahat_24_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.5</td>
                                                <td>Terdapat pengawas dan radio komunikasi</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_25_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->ruangistirahat_25_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->ruangistirahat_25_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>III</td>
                                                <td colspan="4">Tempat Sampah</td>
                                            </tr>

                                            <tr>
                                                <td>3.1</td>
                                                <td>Sampah-sampah dipisahkan sesuai jenisnya (Daur Ulang, Organik dan B3)</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_31_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_31_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tempatsampah_31_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>3.2</td>
                                                <td>Terdapat perbedaan warna tempat sampah untuk masing-masing jenis sampah</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_32_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_32_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tempatsampah_32_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>3.3</td>
                                                <td>Terdapat label sesuai jenis sampah</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_33_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_33_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tempatsampah_33_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>3.4</td>
                                                <td>Volume sampah tidak melebihi kapasitas tempat sampah</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_34_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_34_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tempatsampah_34_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>3.5</td>
                                                <td>Terlindung dari air hujan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_35_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatsampah_35_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tempatsampah_35_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>IV</td>
                                                <td colspan="4">Tempat Parkir</td>
                                            </tr>

                                            <tr>
                                                <td>4.1</td>
                                                <td>Rata, tidak ada genangan air</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatparkir_41_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatparkir_41_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tempatparkir_41_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>4.2</td>
                                                <td>Tidak ada ceceran B3</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatparkir_42_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tempatparkir_42_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tempatparkir_42_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>V</td>
                                                <td colspan="4">Wadah / Penampung</td>
                                            </tr>

                                            <tr>
                                                <td>5.1</td>
                                                <td>Terdapat wadah/penampung saat pengisian fuel ke unit</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->wadah_51_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->wadah_51_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->wadah_51_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>VI</td>
                                                <td colspan="4">APAR</td>
                                            </tr>

                                            <tr>
                                                <td>6.1</td>
                                                <td>Alat pemadam kebakaran diinspeksi setiap bulan dan ditandai (masa berlaku belum habis)</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->apar_61_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->apar_61_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->apar_61_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>6.2</td>
                                                <td>Alat pemadam kebakaran mencukupi untuk area Fuel</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->apar_62_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->apar_62_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->apar_62_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>6.3</td>
                                                <td>Posisi APAR tidak terhalang, mudah terjangkau dan siap digunakan saat keadaan darurat</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->apar_63_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->apar_63_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->apar_63_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>VII</td>
                                                <td colspan="4">Rambu / Safety Sign</td>
                                            </tr>

                                            <tr>
                                                <td>7.1</td>
                                                <td>Dinding tangki ditulis Nomor Tangki, Kapasitas Tangki, dan Jenis BBC</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->rambu_71_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->rambu_71_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->rambu_71_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>7.2</td>
                                                <td>Rambu tanda larangan "Dilarang Merokok" terpasang dan tidak ditemukan puntung rokok</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->rambu_72_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->rambu_72_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->rambu_72_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>7.3</td>
                                                <td>Terdapat rambu penggunaan APD (Helmet, Safety Shoes, Safety Glass, Ear Plug, Sarung Tangan, dll.)</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->rambu_73_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->rambu_73_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->rambu_73_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>VIII</td>
                                                <td colspan="4">Alat Operasional</td>
                                            </tr>

                                            <tr>
                                                <td>8.1</td>
                                                <td>Unit dalam kondisi standar dan layak untuk dioperasionalkan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_81_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_81_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->alatoperasional_81_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>8.2</td>
                                                <td>Terdapat dokumen SOP/IK terkait pengoperasian peralatan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_82_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_82_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->alatoperasional_82_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>8.3</td>
                                                <td>Mengisi dan melakukan pemeriksaan harian unit operasional</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_83_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_83_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->alatoperasional_83_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>8.4</td>
                                                <td>Terdapat LOTO pada setiap peralatan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_84_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_84_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->alatoperasional_84_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>8.5</td>
                                                <td>Cover terpasang baik dan kuat</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_85_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_85_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->alatoperasional_85_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>8.6</td>
                                                <td>Dilakukan inspeksi rutin dan dapat dibuktikan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_86_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_86_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->alatoperasional_86_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>8.7</td>
                                                <td>Rambu pinch point atau bahaya terpotong</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_87_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->alatoperasional_87_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->alatoperasional_87_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>IX</td>
                                                <td colspan="4">Tangki Timbun</td>
                                            </tr>

                                            <tr>
                                                <td>9.1</td>
                                                <td>Terdapat bak penampung (110%)</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_91_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_91_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_91_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.2</td>
                                                <td>Terdapat tanggul pengaman</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_92_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_92_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_92_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.3</td>
                                                <td>Pondasi tangki kuat menahan berat beban secara keseluruhan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_93_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_93_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_93_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.4</td>
                                                <td>Tangki timbun ter-instal bonding</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_94_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_94_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_94_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.5</td>
                                                <td>Terdapat pipa pengeluaran gas</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_95_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_95_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_95_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.6</td>
                                                <td>Panel listrik dan pompa ditempatkan terpisah</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_96_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_96_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_96_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.7</td>
                                                <td>Jarak tangki dan tangki lainnya minimal 10 meter</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_97_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_97_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_97_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.8</td>
                                                <td>Terdapat MSDS</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_98_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_98_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_98_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.9</td>
                                                <td>Kegiatan inspeksi tangki timbun dilaksanakan secara berkala</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_99_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_99_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_99_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.10</td>
                                                <td>Material tangki dan pipa tidak korosif</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_910_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_910_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_910_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.11</td>
                                                <td>Terdapat pagar pengaman berjarak 5 meter</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_911_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_911_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_911_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>9.12</td>
                                                <td>Terdapat salinan perizinan</td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_912_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->tangkitimbun_912_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->tangkitimbun_912_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>X</td>
                                                <td colspan="4">Penangkal Petir</td>
                                            </tr>

                                            <tr>
                                                <td>10.1</td>
                                                <td>
                                                    Penangkal petir terpasang dan diukur tahanan pembumian secara berkala
                                                    minimal setiap 6 bulan atau setelah terjadi petir yang hebat
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->penangkalpetir_101_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $fs->penangkalpetir_101_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $fs->penangkalpetir_101_action }}</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $fs->additional_notes }}</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Dibuat</h6>

                                    @if ($fs->verified_dibuat)
                                        <h5>
                                            <img src="{{ $fs->verified_dibuat }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $fs->nama_dibuat ?? '.......................' }}</h5>

                                    @if ($fs->catatan_verified_dibuat)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $fs->catatan_verified_dibuat }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Diperiksa</h6>

                                    @if ($fs->verified_diperiksa)
                                        <h5>
                                            <img src="{{ $fs->verified_diperiksa }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $fs->nama_diperiksa ?? '.......................' }}</h5>

                                    @if ($fs->catatan_verified_diperiksa)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $fs->catatan_verified_diperiksa }}
                                        </p>
                                    @endif
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
                                        <a href="{{ route('klkh.loading-point.download', $fs->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $fs->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


