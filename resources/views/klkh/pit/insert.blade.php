@include('layout.head', ['title' => 'KLKH PIT'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH PIT</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.pit.post') }}" method="POST" id="submitFormKLKHPIT" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="pit">PIT</label>
                                        <select class="form-control form-control-sm pb-2" id="pit" name="pit" required>
                                            <option value="" selected disabled>Pilih PIT</option>
                                            @foreach ($users['pit'] as $pit)
                                                <option value="{{ $pit->id }}">{{ $pit->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control form-control-sm pb-2 mt-2" placeholder="Lokasi">
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control form-control-sm pb-2 mt-2" placeholder="Pekerjaan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Hari/Tanggal</label>
                                        <input type="date" class="form-control form-control-sm pb-2" id="date" name="date" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="time">Jam</label>
                                        <input type="time" class="form-control form-control-sm pb-2" id="time" name="time" required>
                                    </div>
                                </div>
                                <hr>
                                <h5>Lokasi Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="lokasi_kerja_1_true">1. Permukaan tanah rata dan tidak berlubang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_kerja_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_1_true" name="lokasi_kerja_1_check" value="true" required> Ya
                                        </label>
                                        <label for="lokasi_kerja_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_1_false" name="lokasi_kerja_1_check" value="false"> Tidak
                                        </label>
                                        <label for="lokasi_kerja_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_1_na" name="lokasi_kerja_1_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lokasi_kerja_1_note" id="lokasi_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lokasi_kerja_2_true">2. Permukaan tanah tidak licin akibat hujan sebelumnya</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_kerja_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_2_true" name="lokasi_kerja_2_check" value="true" required> Ya
                                        </label>
                                        <label for="lokasi_kerja_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_2_false" name="lokasi_kerja_2_check" value="false"> Tidak
                                        </label>
                                        <label for="lokasi_kerja_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_2_na" name="lokasi_kerja_2_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lokasi_kerja_2_note" id="lokasi_kerja_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lokasi_kerja_3_true">3. Lokasi kerja jauh dengan lintasan aktif angkutan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_kerja_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_3_true" name="lokasi_kerja_3_check" value="true" required> Ya
                                        </label>
                                        <label for="lokasi_kerja_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_3_false" name="lokasi_kerja_3_check" value="false"> Tidak
                                        </label>
                                        <label for="lokasi_kerja_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_3_na" name="lokasi_kerja_3_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lokasi_kerja_3_note" id="lokasi_kerja_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lokasi_kerja_4_true">4. Posisi alat berat jauh dari kaki tebing</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_kerja_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_4_true" name="lokasi_kerja_4_check" value="true" required> Ya
                                        </label>
                                        <label for="lokasi_kerja_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_4_false" name="lokasi_kerja_4_check" value="false"> Tidak
                                        </label>
                                        <label for="lokasi_kerja_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_4_na" name="lokasi_kerja_4_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lokasi_kerja_4_note" id="lokasi_kerja_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lokasi_kerja_5_true">5. Tidak ada batuan menggantung di dinding tebing</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_kerja_5_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_5_true" name="lokasi_kerja_5_check" value="true" required> Ya
                                        </label>
                                        <label for="lokasi_kerja_5_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_5_false" name="lokasi_kerja_5_check" value="false"> Tidak
                                        </label>
                                        <label for="lokasi_kerja_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_5_na" name="lokasi_kerja_5_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lokasi_kerja_5_note" id="lokasi_kerja_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lokasi_kerja_6_true">6. Area kerja cukup untuk parkir kendaraan support</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_kerja_6_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_6_true" name="lokasi_kerja_6_check" value="true" required> Ya
                                        </label>
                                        <label for="lokasi_kerja_6_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_6_false" name="lokasi_kerja_6_check" value="false"> Tidak
                                        </label>
                                        <label for="lokasi_kerja_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_6_na" name="lokasi_kerja_6_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lokasi_kerja_6_note" id="lokasi_kerja_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="lokasi_kerja_7_true">7. Area perbaikan/perawatan unit jauh dari aktivitas peledakan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_kerja_7_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_7_true" name="lokasi_kerja_7_check" value="true" required> Ya
                                        </label>
                                        <label for="lokasi_kerja_7_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_7_false" name="lokasi_kerja_7_check" value="false"> Tidak
                                        </label>
                                        <label for="lokasi_kerja_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_kerja_7_na" name="lokasi_kerja_7_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lokasi_kerja_7_note" id="lokasi_kerja_7_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <hr>
                                <h5>Perlengkapan Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="perlengkapan_kerja_1_true">1. Tersedia SOP/JSA untuk pekerjaan yang akan dilakukan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_kerja_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_1_true" name="perlengkapan_kerja_1_check" value="true" required> Ya
                                        </label>
                                        <label for="perlengkapan_kerja_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_1_false" name="perlengkapan_kerja_1_check" value="false"> Tidak
                                        </label>
                                        <label for="perlengkapan_kerja_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_1_na" name="perlengkapan_kerja_1_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perlengkapan_kerja_1_note" id="perlengkapan_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="perlengkapan_kerja_2_true">2. Terpasang safety line demarkasi di area kegiatan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_kerja_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_2_true" name="perlengkapan_kerja_2_check" value="true" required> Ya
                                        </label>
                                        <label for="perlengkapan_kerja_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_2_false" name="perlengkapan_kerja_2_check" value="false"> Tidak
                                        </label>
                                        <label for="perlengkapan_kerja_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_2_na" name="perlengkapan_kerja_2_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perlengkapan_kerja_2_note" id="perlengkapan_kerja_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="perlengkapan_kerja_3_true">3. Terpasang rambu-rambu peringatan &amp; APD</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_kerja_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_3_true" name="perlengkapan_kerja_3_check" value="true" required> Ya
                                        </label>
                                        <label for="perlengkapan_kerja_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_3_false" name="perlengkapan_kerja_3_check" value="false"> Tidak
                                        </label>
                                        <label for="perlengkapan_kerja_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_3_na" name="perlengkapan_kerja_3_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perlengkapan_kerja_3_note" id="perlengkapan_kerja_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="perlengkapan_kerja_4_true">4. Area parkir khusus untuk LV tersedia</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_kerja_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_4_true" name="perlengkapan_kerja_4_check" value="true" required> Ya
                                        </label>
                                        <label for="perlengkapan_kerja_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_4_false" name="perlengkapan_kerja_4_check" value="false"> Tidak
                                        </label>
                                        <label for="perlengkapan_kerja_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_4_na" name="perlengkapan_kerja_4_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perlengkapan_kerja_4_note" id="perlengkapan_kerja_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="perlengkapan_kerja_5_true">5. Jarak area parkir kendaraan dengan unit 30 m dalam kondisi unit off running dan 50 m kondisi running</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_kerja_5_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_5_true" name="perlengkapan_kerja_5_check" value="true" required> Ya
                                        </label>
                                        <label for="perlengkapan_kerja_5_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_5_false" name="perlengkapan_kerja_5_check" value="false"> Tidak
                                        </label>
                                        <label for="perlengkapan_kerja_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_5_na" name="perlengkapan_kerja_5_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perlengkapan_kerja_5_note" id="perlengkapan_kerja_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="perlengkapan_kerja_6_true">6. Tersedia kotak P3K di tempat kegiatan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_kerja_6_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_6_true" name="perlengkapan_kerja_6_check" value="true" required> Ya
                                        </label>
                                        <label for="perlengkapan_kerja_6_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_6_false" name="perlengkapan_kerja_6_check" value="false"> Tidak
                                        </label>
                                        <label for="perlengkapan_kerja_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_6_na" name="perlengkapan_kerja_6_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perlengkapan_kerja_6_note" id="perlengkapan_kerja_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="perlengkapan_kerja_7_true">7. Tersedia bak sampah dan/atau wadah penampung sampah di area kegiatan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_kerja_7_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_7_true" name="perlengkapan_kerja_7_check" value="true" required> Ya
                                        </label>
                                        <label for="perlengkapan_kerja_7_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_7_false" name="perlengkapan_kerja_7_check" value="false"> Tidak
                                        </label>
                                        <label for="perlengkapan_kerja_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_kerja_7_na" name="perlengkapan_kerja_7_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perlengkapan_kerja_7_note" id="perlengkapan_kerja_7_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <hr>
                                <h5>Kegiatan Perbaikan dan Perawatan Unit</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="kegiatan_1_true">1. Terdapat pekerja yang memiliki izin SIMPER sesuai peralatan yang akan diperbaiki</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kegiatan_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_1_true" name="kegiatan_1_check" value="true" required> Ya
                                        </label>
                                        <label for="kegiatan_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_1_false" name="kegiatan_1_check" value="false"> Tidak
                                        </label>
                                        <label for="kegiatan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_1_na" name="kegiatan_1_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="kegiatan_1_note" id="kegiatan_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="kegiatan_2_true">2. Pekerja/mekanik memiliki padlock</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kegiatan_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_2_true" name="kegiatan_2_check" value="true" required> Ya
                                        </label>
                                        <label for="kegiatan_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_2_false" name="kegiatan_2_check" value="false"> Tidak
                                        </label>
                                        <label for="kegiatan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_2_na" name="kegiatan_2_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="kegiatan_2_note" id="kegiatan_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="kegiatan_3_true">3. Padlock terpasang pada sakelar pemutus (switch) unit yang akan diperbaiki</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kegiatan_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_3_true" name="kegiatan_3_check" value="true" required> Ya
                                        </label>
                                        <label for="kegiatan_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_3_false" name="kegiatan_3_check" value="false"> Tidak
                                        </label>
                                        <label for="kegiatan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_3_na" name="kegiatan_3_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="kegiatan_3_note" id="kegiatan_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="kegiatan_4_true">4. Bak penampung bahan kimia tersedia serta terpal antisipasi ceceran bahan kimia di permukaan tanah</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kegiatan_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_4_true" name="kegiatan_4_check" value="true" required> Ya
                                        </label>
                                        <label for="kegiatan_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_4_false" name="kegiatan_4_check" value="false"> Tidak
                                        </label>
                                        <label for="kegiatan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_4_na" name="kegiatan_4_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="kegiatan_4_note" id="kegiatan_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="kegiatan_5_true">5. Terdapat pekerja yang memiliki izin SIMPER sesuai peralatan yang dipergunakan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kegiatan_5_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_5_true" name="kegiatan_5_check" value="true" required> Ya
                                        </label>
                                        <label for="kegiatan_5_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_5_false" name="kegiatan_5_check" value="false"> Tidak
                                        </label>
                                        <label for="kegiatan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_5_na" name="kegiatan_5_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="kegiatan_5_note" id="kegiatan_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="kegiatan_6_true">6. Pekerja memakai APD standar &amp; APD tambahan jika diperlukan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kegiatan_6_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_6_true" name="kegiatan_6_check" value="true" required> Ya
                                        </label>
                                        <label for="kegiatan_6_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_6_false" name="kegiatan_6_check" value="false"> Tidak
                                        </label>
                                        <label for="kegiatan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kegiatan_6_na" name="kegiatan_6_check" value="n/a"> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="kegiatan_6_note" id="kegiatan_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan">
                                </div>
                                <hr>
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan catatan..."></textarea>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="diketahui">Diketahui</label>
                                        <select class="form-control form-control-sm pb-2" id="diketahui" name="diketahui">
                                            <option value="" selected disabled>Pilih</option>
                                            @foreach ($users['diketahui'] as $si)
                                                <option value="{{ $si->nik }}">{{ $si->name }} ({{ $si->position }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="upload-grid">
                                        <div class="upload-card">
                                            <label for="dokumentasi_1">Dokumentasi/Evidence 1</label>
                                            <input type="file" id="dokumentasi_1" class="form-control form-control-sm" name="dokumentasi_1" accept="image/*">
                                            <div class="upload-note">Format disarankan: JPG, PNG, WEBP.</div>
                                        </div>
                                        <div class="upload-card">
                                            <label for="dokumentasi_2">Dokumentasi/Evidence 2 (jika ada)</label>
                                            <input type="file" id="dokumentasi_2" class="form-control form-control-sm" name="dokumentasi_2" accept="image/*">
                                            <div class="upload-note">Format disarankan: JPG, PNG, WEBP.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHPIT">Submit</button>
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

    const formKLKHPIT = document.getElementById('submitFormKLKHPIT');
    const submitButtonKLKHPIT = document.getElementById('submitButtonKLKHPIT');

    formKLKHPIT.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonKLKHPIT.disabled = true;
        submitButtonKLKHPIT.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHPIT.disabled = false;
            submitButtonKLKHPIT.innerText = 'Submit';
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
