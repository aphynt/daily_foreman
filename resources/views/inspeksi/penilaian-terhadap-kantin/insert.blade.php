@include('layout.head', ['title' => 'Element Penilaian Terhadap Kantin'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Element Penilaian Terhadap Kantin</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.penilaianterhadapkantin.post') }}" method="POST" id="submitformInspeksiPenilaianTerhadapKantin">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <div class="col-md-4 col-12 px-2 py-2">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal_inspeksi" required>
                                    </div>
                                    <div class="col-md-4 col-12 px-2 py-2">
                                        <label>Jam</label>
                                        <input type="time" class="form-control form-control-sm" id="time" name="jam_inspeksi" required>
                                    </div>
                                    <div class="col-md-4 col-12 px-2 py-2">
                                        <label>Lokasi</label>
                                        <input type="text" class="form-control form-control-sm" name="lokasi" required>
                                    </div>
                                </div>
                                <hr>
                                <h5>A. BANGUNAN / SARANA</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label><strong>1 Atap plafond</strong><br>Kokoh, tidak bocor.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_11_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_11_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_11_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>2 Talang Air</strong><br>Terpasang dengan baik, tidak tersumbat, tidak bocor, mengalir ke selokan air.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_12_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_12_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_12_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>3 Lantai</strong><br>Konkreat, lebih tinggi dari pekarangan, air dari pekarangan tidak masuk ke bagian dalam bangunan.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_13_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_13_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_13_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>4 Drainase / saluran air</strong><br>Tidak tergenang air; tanah dan sampah tidak terakumulasi pada badan saluran.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_14_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_14_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_14_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>5.1 Pekarangan atau tempat parkir</strong><br>Rata, tidak becek, tidak berair.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_15_1_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_15_1_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_15_1_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>5.2 Pekarangan atau tempat parkir</strong><br>Kendaraan parkir pada lokasi parkir sekitar bangunan.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_15_2_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_15_2_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_15_2_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>6.1 Tabung Gas untuk kompor</strong><br>Selalu dalam posisi Tegak dan tidak mudah terguling atau jatuh.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_1_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_1_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_16_1_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>6.2 Tabung Gas untuk kompor</strong><br>Gunakan pengikat/kerangkeng saat disimpan agar tidak terguling.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_2_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_2_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_16_2_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>6.3 Tabung Gas untuk kompor</strong><br>Gunakan trolley (kereta dorong) untuk memindahkan tabung yang besar.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_3_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_3_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_16_3_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>6.4 Tabung Gas untuk kompor</strong><br>Beri label atau keterangan pada tabung "ISI" atau "KOSONG".</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_4_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_16_4_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_16_4_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>7 Lampu penerangan</strong><br>Tersedia lampu penerangan yang memadai untuk dapat bekerja malam.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_17_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_17_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_17_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>8.1 Electric Tool</strong><br>Kabel listrik tidak terkelupas.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_1_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_1_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_18_1_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>8.2 Electric Tool</strong><br>Kabel listrik dari bahan berkualitas baik.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_2_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_2_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_18_2_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>8.3 Electric Tool</strong><br>Kabel listrik terpasang dengan baik.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_3_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_3_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_18_3_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>8.4 Electric Tool</strong><br>Colokan sambungan ke sumber listrik berfungsi dengan baik.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_4_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_18_4_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_18_4_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>9 Tong / Tempat Sampah</strong><br>Tersedia tong sampah berwarna hijau &amp; kuning. Sampah dimasukkan ke dalam tong, dikelompokkan berdasarkan jenisnya.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_19_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_19_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_19_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>10 APAR / Pemadam Api</strong><br>Diletakkan pada lokasi tertentu agar mudah dijangkau dan mudah diperiksa kondisinya.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_110_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_110_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_110_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>11 Cat / Painting</strong><br>Warna cerah (Putih).</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_111_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_111_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_111_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>12 Kitchen sheet / wastafel</strong><br>Tersedia kitchen sheet untuk alat makan, minum dan masak.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_112_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_112_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_112_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>13 Kran Air wastafel</strong><br>Tersedia, berfungsi, ada sabun.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_113_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_113_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_113_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>14 Hand dryer</strong><br>Tersedia, berfungsi.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_114_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_114_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_114_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>B. PAPAN PENGUMUMAN DAN ATURAN</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label><strong>1 Dilarang Merokok</strong><br>Ukuran, gambar dan warna harus standard.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="papan_21_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="papan_21_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="papan_21_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>2 Dilarang menggunakan sepatu di dalam ruang</strong><br>Papan larangan jelas terlihat.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="papan_22_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="papan_22_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="papan_22_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>3 Nama ruangan / bilik</strong><br>Terpasang dengan baik dan tidak kotor.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="papan_23_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="papan_23_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="papan_23_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>C. ADMINISTRASI</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label><strong>1.1 Kotak / Lemari</strong><br>Lemari kecil tempat menyimpan makanan dan minuman.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_31_1_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_31_1_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_31_1_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>1.2 Kotak / Lemari</strong><br>Tersedia kulkas untuk mendinginkan makanan dan minuman.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_31_2_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_31_2_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_31_2_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>2 Daftar Menu</strong><br>Tersedia daftar menu yang tersedia.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_32_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_32_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_32_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>3 Nota Pesanan</strong><br>Tersedia nota pesanan untuk tamu.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_33_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_33_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_33_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>D. HOUSE KEEPING</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label><strong>1 Pekarangan</strong><br>Bersih / bebas dari sampah.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_41_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_41_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_41_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>2 Dinding Bangunan</strong><br>Rapi, tidak ada bercak oli pada dinding bangunan, greese.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_42_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_42_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_42_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>3 Saluran</strong><br>Bebas dari akumulasi tanah, sampah, tumbuhan rumput.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_43_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_43_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_43_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>4 Peralatan dapur</strong><br>Ditata dengan rapi, tidak berserakan.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_44_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_44_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_44_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>5 Peralatan makan</strong><br>Ditata dengan rapi, tidak berserakan.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_45_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_45_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_45_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>6 Meja dan kursi</strong><br>Meja dan kursi di ruang makan tertata rapi.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_46_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_46_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_46_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label><strong>7 Lantai Bangunan</strong><br>Bersih / bebas dari debu dan tumpahan makanan atau minuman.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_47_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_47_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_47_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>E. ALAT ANGKUT</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label><strong>1 Trolley</strong><br>Tersedia untuk pelayanan ke meja makan.</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="alat_51_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="alat_51_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="alat_51_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- Catatan -->
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3"
                                        placeholder="Tambahkan catatan..."></textarea>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Disiapkan Oleh</label>
                                        <select class="form-control form-control-sm" name="disiapkan" data-trigger required>
                                            <option value="{{ Auth::user()->nik }}" selected>{{ Auth::user()->name }} ({{ Auth::user()->nik }})</option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('disiapkan') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Diperiksa Oleh</label>
                                        <select class="form-control form-control-sm" name="diperiksa" data-trigger>
                                            <option value="" disabled selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('diperiksa') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Diketahui Oleh</label>
                                        <select class="form-control form-control-sm" name="diketahui" data-trigger>
                                            <option value="" disabled selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('diketahui') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiPenilaianTerhadapKantin">Submit</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')

<script>

    const formInspeksiPenilaianTerhadapKantin = document.getElementById('submitformInspeksiPenilaianTerhadapKantin');
    const submitButtonInspeksiPenilaianTerhadapKantin = document.getElementById('submitButtonInspeksiPenilaianTerhadapKantin');

    formInspeksiPenilaianTerhadapKantin.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiPenilaianTerhadapKantin.disabled = true;
        submitButtonInspeksiPenilaianTerhadapKantin.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiPenilaianTerhadapKantin.disabled = false;
            submitButtonInspeksiPenilaianTerhadapKantin.innerText = 'Submit';
        }, 7000);
    });
</script>

<script>
    window.onload = function() {
        var currentDate = new Date();

        // Format tanggal Indonesia (DD-MM-YYYY)
        var dd = ("0" + currentDate.getDate()).slice(-2); // Menambahkan 0 jika tanggal < 10
        var mm = ("0" + (currentDate.getMonth() + 1)).slice(-2); // Menambahkan 0 jika bulan < 10
        var yyyy = currentDate.getFullYear();
        var formattedDate = yyyy + "-" + mm + "-" + dd; // Tanggal untuk input type="date" (YYYY-MM-DD)

        // Format waktu (HH:MM)
        var hours = ("0" + currentDate.getHours()).slice(-2); // Menambahkan 0 jika jam < 10
        var minutes = ("0" + currentDate.getMinutes()).slice(-2); // Menambahkan 0 jika menit < 10
        var formattedTime = hours + ":" + minutes;

        // Isi input dengan tanggal dan waktu saat ini
        document.getElementById("date").value = formattedDate;
        document.getElementById("time").value = formattedTime;
    }
    document.querySelector("form").addEventListener("submit", function(e) {
        const radioGroups = Array.from(new Set([...document.querySelectorAll("input[type='radio']")].map(r => r
            .name)));
        const incompleteGroups = radioGroups.filter(groupName => {
            return !document.querySelector(`input[name="${groupName}"]:checked`);
        });

        if (incompleteGroups.length > 0) {
            e.preventDefault();
            alert("Silakan isi semua pilihan True/False/N/A sebelum mengirimkan form!");
        }
    });
</script>
