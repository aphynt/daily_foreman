@include('layout.head', ['title' => 'KLKH Kantor Workshop'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Kantor Workshop</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.kantorworkshop.post') }}" method="POST" id="submitFormKLKHKantorWorkshop" enctype="multipart/form-data">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control form-control-sm pb-2 mt-2" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Kolom 2: Hari/Tanggal dan Jam -->
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Hari/ Tanggal</label>
                                        <input type="date" class="form-control form-control-sm pb-2" id="date" name="date" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="time">Jam</label>
                                        <input type="time" class="form-control form-control-sm pb-2" id="time" name="time" required>
                                    </div>
                                </div>
                                <hr>
                                <h5>Bangunan dan Fasilitas</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_1_check">1. Struktur bangunan kokoh.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_1_true" name="bangunan_fasilitas_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="bangunan_fasilitas_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_1_false" name="bangunan_fasilitas_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="bangunan_fasilitas_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_1_na" name="bangunan_fasilitas_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_1_note" id="bangunan_fasilitas_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_2_check">2. Terdapat lemari arsip.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_2_true" name="bangunan_fasilitas_2_check" value="true" required /> Ya
                                        </label>
                                        <label for="bangunan_fasilitas_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_2_false" name="bangunan_fasilitas_2_check" value="false" /> Tidak
                                        </label>
                                        <label for="bangunan_fasilitas_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_2_na" name="bangunan_fasilitas_2_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_2_note" id="bangunan_fasilitas_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_3_check">3. Lampu terang dan jumlahnya memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_3_true" name="bangunan_fasilitas_3_check" value="true" required /> Ya
                                        </label>
                                        <label for="bangunan_fasilitas_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_3_false" name="bangunan_fasilitas_3_check" value="false" /> Tidak
                                        </label>
                                        <label for="bangunan_fasilitas_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_3_na" name="bangunan_fasilitas_3_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_3_note" id="bangunan_fasilitas_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_4_check">4. Denah evakuasi ditempel dengan jelas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_4_true" name="bangunan_fasilitas_4_check" value="true" required /> Ya
                                        </label>
                                        <label for="bangunan_fasilitas_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_4_false" name="bangunan_fasilitas_4_check" value="false" /> Tidak
                                        </label>
                                        <label for="bangunan_fasilitas_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_4_na" name="bangunan_fasilitas_4_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_4_note" id="bangunan_fasilitas_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_5_check">5. Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_5_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_5_true" name="bangunan_fasilitas_5_check" value="true" required /> Ya
                                        </label>
                                        <label for="bangunan_fasilitas_5_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_5_false" name="bangunan_fasilitas_5_check" value="false" /> Tidak
                                        </label>
                                        <label for="bangunan_fasilitas_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_fasilitas_5_na" name="bangunan_fasilitas_5_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_5_note" id="bangunan_fasilitas_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Lantai Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="lantai_kerja_1_check">1. Kebersihan Lantai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lantai_kerja_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="lantai_kerja_1_true" name="lantai_kerja_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="lantai_kerja_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="lantai_kerja_1_false" name="lantai_kerja_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="lantai_kerja_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lantai_kerja_1_na" name="lantai_kerja_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="lantai_kerja_1_note" id="lantai_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Peralatan Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="peralatan_kerja_1_check">1. Ditata dengan rapi, Tidak berserakan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="peralatan_kerja_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_kerja_1_true" name="peralatan_kerja_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="peralatan_kerja_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_kerja_1_false" name="peralatan_kerja_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="peralatan_kerja_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_kerja_1_na" name="peralatan_kerja_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="peralatan_kerja_1_note" id="peralatan_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Electric</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_1_check">1. Kabel tidak terkelupas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_1_true" name="electric_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="electric_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_1_false" name="electric_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="electric_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_1_na" name="electric_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="electric_1_note" id="electric_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_2_check">2. Kabel berkualitas baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_2_true" name="electric_2_check" value="true" required /> Ya
                                        </label>
                                        <label for="electric_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_2_false" name="electric_2_check" value="false" /> Tidak
                                        </label>
                                        <label for="electric_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_2_na" name="electric_2_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="electric_2_note" id="electric_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_3_check">3. Colokan / sambungan ke sumber listrik cukup aman.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_3_true" name="electric_3_check" value="true" required /> Ya
                                        </label>
                                        <label for="electric_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_3_false" name="electric_3_check" value="false" /> Tidak
                                        </label>
                                        <label for="electric_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_3_na" name="electric_3_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="electric_3_note" id="electric_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_4_check">4. Energi listrik / mesin-mesin menyala tanpa aktivitas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_4_true" name="electric_4_check" value="true" required /> Ya
                                        </label>
                                        <label for="electric_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_4_false" name="electric_4_check" value="false" /> Tidak
                                        </label>
                                        <label for="electric_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="electric_4_na" name="electric_4_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="electric_4_note" id="electric_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>APAR</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_1_check">1. Jumlahnya memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_1_true" name="apar_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="apar_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_1_false" name="apar_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="apar_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_1_na" name="apar_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="apar_1_note" id="apar_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_2_check">2. Mudah dilihat dan dapat dijangkau.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_2_true" name="apar_2_check" value="true" required /> Ya
                                        </label>
                                        <label for="apar_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_2_false" name="apar_2_check" value="false" /> Tidak
                                        </label>
                                        <label for="apar_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_2_na" name="apar_2_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="apar_2_note" id="apar_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_3_check">3. Tekanan APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_3_true" name="apar_3_check" value="true" required /> Ya
                                        </label>
                                        <label for="apar_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_3_false" name="apar_3_check" value="false" /> Tidak
                                        </label>
                                        <label for="apar_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_3_na" name="apar_3_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="apar_3_note" id="apar_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_4_check">4. Isi APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_4_true" name="apar_4_check" value="true" required /> Ya
                                        </label>
                                        <label for="apar_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_4_false" name="apar_4_check" value="false" /> Tidak
                                        </label>
                                        <label for="apar_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="apar_4_na" name="apar_4_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="apar_4_note" id="apar_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Rambu-rambu Bahaya</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="rambu_bahaya_1_check">1. Dilarang menyalakan api / merokok.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_bahaya_1_true" name="rambu_bahaya_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="rambu_bahaya_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_bahaya_1_false" name="rambu_bahaya_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="rambu_bahaya_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_bahaya_1_na" name="rambu_bahaya_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_1_note" id="rambu_bahaya_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Tempat Sampah Domestik</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_1_check">1. Kelayakan tempat sampah, bertutup dan tidak bocor.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_1_true" name="sampah_domestik_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="sampah_domestik_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_1_false" name="sampah_domestik_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="sampah_domestik_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_1_na" name="sampah_domestik_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="sampah_domestik_1_note" id="sampah_domestik_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_2_check">2. Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_2_true" name="sampah_domestik_2_check" value="true" required /> Ya
                                        </label>
                                        <label for="sampah_domestik_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_2_false" name="sampah_domestik_2_check" value="false" /> Tidak
                                        </label>
                                        <label for="sampah_domestik_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_2_na" name="sampah_domestik_2_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="sampah_domestik_2_note" id="sampah_domestik_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_3_check">3. Sampah dibuang ke tempat pembuangan sampah.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_3_true" name="sampah_domestik_3_check" value="true" required /> Ya
                                        </label>
                                        <label for="sampah_domestik_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_3_false" name="sampah_domestik_3_check" value="false" /> Tidak
                                        </label>
                                        <label for="sampah_domestik_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_domestik_3_na" name="sampah_domestik_3_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="sampah_domestik_3_note" id="sampah_domestik_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Pemadam Hydran</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="pemadam_hydran_1_check">1. Tempat hose air mudah dibuka.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pemadam_hydran_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_1_true" name="pemadam_hydran_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="pemadam_hydran_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_1_false" name="pemadam_hydran_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="pemadam_hydran_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_1_na" name="pemadam_hydran_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pemadam_hydran_1_note" id="pemadam_hydran_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="pemadam_hydran_2_check">2. Kran air berfungsi dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pemadam_hydran_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_2_true" name="pemadam_hydran_2_check" value="true" required /> Ya
                                        </label>
                                        <label for="pemadam_hydran_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_2_false" name="pemadam_hydran_2_check" value="false" /> Tidak
                                        </label>
                                        <label for="pemadam_hydran_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_2_na" name="pemadam_hydran_2_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pemadam_hydran_2_note" id="pemadam_hydran_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="pemadam_hydran_3_check">3. Pompa air berfungsi dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pemadam_hydran_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_3_true" name="pemadam_hydran_3_check" value="true" required /> Ya
                                        </label>
                                        <label for="pemadam_hydran_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_3_false" name="pemadam_hydran_3_check" value="false" /> Tidak
                                        </label>
                                        <label for="pemadam_hydran_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_3_na" name="pemadam_hydran_3_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pemadam_hydran_3_note" id="pemadam_hydran_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="pemadam_hydran_4_check">4. Kapasitas air memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="pemadam_hydran_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_4_true" name="pemadam_hydran_4_check" value="true" required /> Ya
                                        </label>
                                        <label for="pemadam_hydran_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_4_false" name="pemadam_hydran_4_check" value="false" /> Tidak
                                        </label>
                                        <label for="pemadam_hydran_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pemadam_hydran_4_na" name="pemadam_hydran_4_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="pemadam_hydran_4_note" id="pemadam_hydran_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Paparan Debu</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="paparan_debu_1_check">1. Tidak ada paparan debu halus yang melekat pada kisi-kisi AC, horden jendela, bagian atas lemari, sela-sela rak kertas dan lainnya.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="paparan_debu_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="paparan_debu_1_true" name="paparan_debu_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="paparan_debu_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="paparan_debu_1_false" name="paparan_debu_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="paparan_debu_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="paparan_debu_1_na" name="paparan_debu_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="paparan_debu_1_note" id="paparan_debu_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Catatan -->
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan catatan..."></textarea>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="diketahui">Diketahui</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1" name="diketahui" data-trigger>
                                            <option selected disabled></option>
                                            @foreach ($users['diketahui'] as $si)
                                                <option value="{{ $si->nik }}">{{ $si->name }} ({{ $si->position }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="upload-grid">
                                        <div class="upload-card">
                                            <label>Dokumentasi/Evidence 1</label>
                                            <input type="file" class="form-control form-control-sm" name="dokumentasi_1" accept="image/*">
                                            <div class="upload-note">Format disarankan: JPG, PNG, WEBP.</div>
                                        </div>
                                        <div class="upload-card">
                                            <label>Dokumentasi/Evidence 2 (jika ada)</label>
                                            <input type="file" class="form-control form-control-sm" name="dokumentasi_2" accept="image/*">
                                            <div class="upload-note">Opsional, isi jika ada dokumentasi tambahan.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHKantorWorkshop">
                                        Submit
                                    </button>
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

    const formKLKHKantorWorkshop = document.getElementById('submitFormKLKHKantorWorkshop');
    const submitButtonKLKHKantorWorkshop = document.getElementById('submitButtonKLKHKantorWorkshop');

    formKLKHKantorWorkshop.addEventListener('submit', function() {
    
        submitButtonKLKHKantorWorkshop.disabled = true;
        submitButtonKLKHKantorWorkshop.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHKantorWorkshop.disabled = false;
            submitButtonKLKHKantorWorkshop.innerText = 'Submit';
        }, 7000);
    });
</script>

<script>
    window.onload = function() {
        var currentDate = new Date();

        // Format tanggal Indonesia (DD-MM-YYYY)
        var dd = ("0" + currentDate.getDate()).slice(-2); 
        var mm = ("0" + (currentDate.getMonth() + 1)).slice(-2); 
        var yyyy = currentDate.getFullYear();
        var formattedDate = yyyy + "-" + mm + "-" + dd;

        var hours = ("0" + currentDate.getHours()).slice(-2); 
        var minutes = ("0" + currentDate.getMinutes()).slice(-2); 
        var formattedTime = hours + ":" + minutes;

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
