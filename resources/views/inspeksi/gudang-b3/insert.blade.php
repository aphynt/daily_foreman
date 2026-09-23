@include('layout.head', ['title' => 'Checklist Inspeksi Gudang B3'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Checklist Inspeksi Gudang B3</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.gudangb3.post') }}" method="POST" id="submitformInspeksiFuelSkid">
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
                                                                <h5>1. Kemasan B3</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Kondisi baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_11_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_11_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_11_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2 Kemasan dari plastik atau logam</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_12_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_12_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_12_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3 B3 di pisahkan kemasannya sesuai karakteristik jenisnya</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_13_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_13_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_13_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4 Terdapat label B3 yang berisi klasifikasi dan jenis B3</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_14_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_14_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_14_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5 Terdapat simbol B3 sesuai klasifikasi</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_15_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_15_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_15_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.6 Posisi penempelan label dan simbol B3 mudah terlihat</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_16_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_16_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_16_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.7 Posisi penempelan simbol B3 diatas label B3</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_17_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_17_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_17_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.8 Beralaskan balet</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_18_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_18_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_18_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.9 Kemasan di letakan di dalam bangunan penyimpanan B3</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_19_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_19_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_19_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>2. Bangunan Penyimpanan B3</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>2.1 Bangunan dapat menampung semua B3</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_21_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_21_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_21_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 Atap tidak bocor</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_22_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_22_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_22_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Tanpa Plafon</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_23_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_23_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_23_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4 Talang air</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_24_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_24_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_24_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5 Lampu penerangan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_25_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_25_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_25_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.6 Penangkal petir</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_26_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_26_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_26_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.7 Lantai kedap air dan tidak retak</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_27_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_27_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_27_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.8 Saluran bersih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_28_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_28_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_28_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.9 Bebas banjir</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_29_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_29_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_29_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.10 Konkrit lantai lebih tinggi dari halaman luar</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_210_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_210_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_210_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>3. Tanda Informasi</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>3.1 Simbol APD</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_31_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_31_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_31_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Dilarang masuk bagi yang tidak berkepentingan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_33_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_33_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_33_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Dilarang merokok</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_34_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_34_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_34_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.5 Jenis B3 yang disimpan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_35_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_35_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_35_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>4. Fasilitas Bangunan</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>4.1 APAR</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_41_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_41_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_41_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2 Eye Wash</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_42_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_42_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_42_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3 P3K</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_43_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_43_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_43_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.4 Alarm</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_44_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_44_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_44_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>5. Administrasi</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>5.1 MSDS</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_51_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_51_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_51_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2 SOP</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_52_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_52_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_52_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5 Check list inspeksi gudang B3</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_55_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_55_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_55_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>6. Oil Trap</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>6.1 Dalam keadaan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_61_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_61_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="oil_61_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2 Outlet kompartemen 3 close circuit</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_62_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_62_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="oil_62_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.3 Tutup terbuat dari bahan yang kuat</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_63_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_63_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="oil_63_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.4 Tutup terpasang rapi</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_64_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_64_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="oil_64_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.5 Tutup dapat di buka</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_65_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_65_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="oil_65_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>8. House Keeping</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>8.1 Halaman bersih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_81_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_81_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_81_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.2 Tidak ada bercak pada dinding</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_82_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_82_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_82_action"
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
                                        <label>Dibuat Oleh</label>
                                        <select class="form-control form-control-sm" name="dibuat" data-trigger required>
                                            <option value="{{ Auth::user()->nik }}" selected>{{ Auth::user()->name }} ({{ Auth::user()->nik }})</option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('dibuat') == $inspektor->nik ? 'selected' : '' }}>
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

                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiFuelSkid">Submit</button>
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

    const formInspeksiFuelSkid = document.getElementById('submitformInspeksiFuelSkid');
    const submitButtonInspeksiFuelSkid = document.getElementById('submitButtonInspeksiFuelSkid');

    formInspeksiFuelSkid.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiFuelSkid.disabled = true;
        submitButtonInspeksiFuelSkid.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiFuelSkid.disabled = false;
            submitButtonInspeksiFuelSkid.innerText = 'Submit';
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
