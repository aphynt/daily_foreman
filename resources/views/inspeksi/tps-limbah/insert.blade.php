@include('layout.head', ['title' => 'Checklist TPS Limbah B3'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Checklist TPS Limbah B3</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.tpslimbahb3.post') }}" method="POST" id="submitformInspeksiTPSLimbahB3">
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
                                                                <h5>1. Kemasan Limbah B3</h5>
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
                                    <label>1.2 Tidak berkarat</label>

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
                                    <label>1.3 Tidak Bocor</label>

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
                                    <label>1.4 Kemasan dari plastik atau logam</label>

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
                                    <label>1.5 Limbah di pisahkan kemasannya sesuai jenisnya</label>

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
                                    <label>1.6 Terdapat penutup kemasan</label>

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
                                    <label>1.7 Terdapat Label karakteristik limbah 15 x 15 Cm</label>

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
                                    <label>1.8 Terdapat Label identifikasi / identitas limbah berukuran minimal 15 x 20 CM dan diisi lengkap</label>

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
                                    <label>1.9 Posisi penempelan label terlihat</label>

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
                                <div class="mb-3">
                                    <label>1.10 Posisi penempelan label teridentifikasi/ identitas limbah di atas label karakteristik<br>( Permen LH No. 14 Tahun 2013 )</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_110_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_110_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_110_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.11 Terdapat Status isi kemasan yang "kosong" berukuran mi. 10 x 10 Cm</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_111_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_111_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_111_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.12 Terdapat Label petunjuk tutup kemasan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_112_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kemasan_112_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kemasan_112_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h5>2. Penyimpanan Limbah B3</h5>
                                <hr>

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>2.1 Beralaskan Palet</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_21_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_21_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="penyimpanan_21_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 jarak antar palet min 60 cm</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_22_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_22_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="penyimpanan_22_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Maksimum 3 tingkat</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_23_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_23_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="penyimpanan_23_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4 Apabila bertingkat,min.1 m dari atap</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_24_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_24_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="penyimpanan_24_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5 Accu bekas di letakkan di rak</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_25_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penyimpanan_25_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="penyimpanan_25_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h5>3. Bangunan Penyimpanan Limbah B3</h5>
                                <hr>

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>3.1 Bangunan dapat menampung semua limbah B3 yang dihasilkan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_31_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_31_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_31_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2 Atap tidak bocor</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_32_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_32_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_32_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Tanpa Plafon</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_33_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_33_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_33_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Talang air</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_34_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_34_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_34_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.5 Ventilasi udara</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_35_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_35_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_35_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.6 Lampu penerangan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_36_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_36_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_36_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.7 Posisi saklar di luar ruangan, aman dari limbah dan aktivitas lain</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_37_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_37_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_37_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.8 Penangkal petir</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_38_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_38_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_38_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.9 Lantai kedap air</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_39_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_39_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_39_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.10 Lantai rata</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_310_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_310_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_310_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.11 Lantai tidak retak</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_311_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_311_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_311_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.12 Lantai miring ke arah saluran</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_312_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_312_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_312_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.13 Sekat pemisah antar jenis limbah</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_313_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_313_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_313_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.14 Saluran bersih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_314_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_314_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_314_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.15 Bebas banjir</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_315_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_315_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_315_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.16 Konkrit lantai lebih tinggi dari halaman luar</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_316_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bangunan_316_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bangunan_316_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h5>4. Tanda Informasi</h5>
                                <hr>

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>4.1 Terdapat Simbol APD</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_41_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_41_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_41_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2 Terdapat papan informasi diluar TPS dan berisi lengkap</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_42_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_42_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_42_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3 Papan Informasi Jenis Limbah yang di simpan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_43_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_43_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_43_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.4 Terdapat tanda Dilarang masuk bagi yang tidak berkepentingan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_44_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_44_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_44_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.5 Terdapat rambu Dilarang merokok</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_45_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_45_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_45_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.6 Terdapat tanda Dilarang membawa makanan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_46_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_46_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_46_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.7 No. TPS ( sesuai izin)</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_47_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_47_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_47_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.8 Terdapat papan informasi didalam TPS berisi SOP Penyimpanan limbah B3, SOP Tanggap Darurat, dan Flowchart tanggap darurat</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_48_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanda_48_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="tanda_48_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h5>5. Fasilitas Bangunan</h5>
                                <hr>

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>5.1 Terdapat APAR</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_51_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_51_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_51_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2 Terdapat Eye Wash</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_52_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_52_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_52_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3 Terdapat peta jalur evakuasi</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_53_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_53_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_53_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.4 Terdapat alarm</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_54_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_54_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_54_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5 Terdapat peralatan penanganan evakuasi ( spill kit )</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_55_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_55_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_55_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.6 Terdapat kotak P3K</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_56_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_56_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_56_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.7 Alat komunikasi</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_57_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_57_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_57_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.8 Terdapat lemari / tempat peralatan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_58_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_58_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_58_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.9 Terdapat Pintu darurat</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_59_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_59_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="fasilitas_59_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h5>6. Administrasi</h5>
                                <hr>

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>6.1 Terdapat Lemari Log Book</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_61_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_61_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_61_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2 Terdapat Form saldo limbah B3 diisi dan update</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_62_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_62_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_62_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.4 Terdapat salinan Izin TPS</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_64_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_64_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_64_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.5 Check List Inspeksi TPS</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_65_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="administrasi_65_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="administrasi_65_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h5>7. Bak Penampung</h5>
                                <hr>

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>7.1 Dalam keadaan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_71_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_71_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bak_71_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2 Bak penampung tidak ada sekat dan harus dalam keadaan kering</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_72_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_72_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bak_72_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3 Tutup terbuat dari bahan yang kuat dan terpasang rapi</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_73_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_73_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bak_73_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.4 Tidak terdapat outlet</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_74_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_74_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bak_74_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.5 Terdapat papan informasi berisi SOP dan Form Inspeksi Harian</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_75_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="bak_75_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="bak_75_action"
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
                                <div class="mb-3">
                                    <label>8.3 Ceceran pada lantai</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_83_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_83_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_83_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.4 Penyimpanan filter bekas / majun bekas tidak melebihi kapasitas kenasan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_84_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="house_84_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="house_84_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <h5>9. Kegiatan Inovasi</h5>
                                <hr>

                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>9.1 Melakukan reduce volume limbah B3</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kegiatan_91_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kegiatan_91_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kegiatan_91_action"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9.2 Melakukan re-use limbah B3 ( Berizin )</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kegiatan_92_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kegiatan_92_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                name="kegiatan_92_action"
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiTPSLimbahB3">Submit</button>
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

    const formInspeksiTPSLimbahB3 = document.getElementById('submitformInspeksiTPSLimbahB3');
    const submitButtonInspeksiTPSLimbahB3 = document.getElementById('submitButtonInspeksiTPSLimbahB3');

    formInspeksiTPSLimbahB3.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiTPSLimbahB3.disabled = true;
        submitButtonInspeksiTPSLimbahB3.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiTPSLimbahB3.disabled = false;
            submitButtonInspeksiTPSLimbahB3.innerText = 'Submit';
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
