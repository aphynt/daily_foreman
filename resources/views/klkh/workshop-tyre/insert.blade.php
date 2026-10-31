@include('layout.head', ['title' => 'KLKH Workshop Tyre'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Workshop Tyre</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.workshoptyre.post') }}" method="POST" id="submitFormKLKHWorkshopTyre" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control form-control-sm pb-2 mt-2" placeholder="Lokasi" value="Workshop Tyre" />
                                    </div>
                                </div>
                                <div class="row mb-3">
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
                                    <label for="bangunan_fasilitas_1_check">1. Struktur bangunan kokoh, Lantai diconcreat dan beratap.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_1_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_1_true" name="bangunan_fasilitas_1_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_1_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_1_false" name="bangunan_fasilitas_1_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_1_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_1_na" name="bangunan_fasilitas_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_1_note" id="bangunan_fasilitas_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_2_check">2. Tinggi bangunan sesuai dengan kendaraan yang diservice.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_2_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_2_true" name="bangunan_fasilitas_2_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_2_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_2_false" name="bangunan_fasilitas_2_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_2_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_2_na" name="bangunan_fasilitas_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_2_note" id="bangunan_fasilitas_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_3_check">3. Terdapat tempat arsip (utk SOP, JSA).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_3_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_3_true" name="bangunan_fasilitas_3_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_3_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_3_false" name="bangunan_fasilitas_3_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_3_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_3_na" name="bangunan_fasilitas_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_3_note" id="bangunan_fasilitas_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_4_check">4. Terdapat ruang tools room yang memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_4_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_4_true" name="bangunan_fasilitas_4_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_4_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_4_false" name="bangunan_fasilitas_4_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_4_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_4_na" name="bangunan_fasilitas_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_4_note" id="bangunan_fasilitas_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_5_check">5. Jumlah dan standard ganjal, Loto, penopang A2B memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_5_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_5_true" name="bangunan_fasilitas_5_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_5_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_5_false" name="bangunan_fasilitas_5_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_5_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_5_na" name="bangunan_fasilitas_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_5_note" id="bangunan_fasilitas_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_6_check">6. Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_6_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_6_true" name="bangunan_fasilitas_6_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_6_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_6_false" name="bangunan_fasilitas_6_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_6_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_6_na" name="bangunan_fasilitas_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_6_note" id="bangunan_fasilitas_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_7_check">7. Lampu emergency berfungsi dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_7_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_7_true" name="bangunan_fasilitas_7_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_7_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_7_false" name="bangunan_fasilitas_7_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_7_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_7_na" name="bangunan_fasilitas_7_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_7_note" id="bangunan_fasilitas_7_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_8_check">8. Denah evakuasi ditempel dengan jelas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_8_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_8_true" name="bangunan_fasilitas_8_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_8_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_8_false" name="bangunan_fasilitas_8_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_8_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_8_na" name="bangunan_fasilitas_8_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_8_note" id="bangunan_fasilitas_8_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="bangunan_fasilitas_9_check">9. Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_9_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_9_true" name="bangunan_fasilitas_9_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_9_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_9_false" name="bangunan_fasilitas_9_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_9_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_9_na" name="bangunan_fasilitas_9_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_9_note" id="bangunan_fasilitas_9_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Tempat Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="tempat_kerja_1_check">1. Ada tempat khusus dan rata.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tempat_kerja_1_true" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_1_true" name="tempat_kerja_1_check" value="true" required /> Ya</label>
                                        <label for="tempat_kerja_1_false" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_1_false" name="tempat_kerja_1_check" value="false" /> Tidak</label>
                                        <label for="tempat_kerja_1_na" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_1_na" name="tempat_kerja_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tempat_kerja_1_note" id="tempat_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tempat_kerja_2_check">2. Fasilitas bongkar pasang ban (wheel loader).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tempat_kerja_2_true" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_2_true" name="tempat_kerja_2_check" value="true" required /> Ya</label>
                                        <label for="tempat_kerja_2_false" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_2_false" name="tempat_kerja_2_check" value="false" /> Tidak</label>
                                        <label for="tempat_kerja_2_na" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_2_na" name="tempat_kerja_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tempat_kerja_2_note" id="tempat_kerja_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tempat_kerja_3_check">3. Penjepit untuk pemompaan ban.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tempat_kerja_3_true" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_3_true" name="tempat_kerja_3_check" value="true" required /> Ya</label>
                                        <label for="tempat_kerja_3_false" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_3_false" name="tempat_kerja_3_check" value="false" /> Tidak</label>
                                        <label for="tempat_kerja_3_na" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_3_na" name="tempat_kerja_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tempat_kerja_3_note" id="tempat_kerja_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tempat_kerja_4_check">4. Pengukur tekanan angin.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tempat_kerja_4_true" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_4_true" name="tempat_kerja_4_check" value="true" required /> Ya</label>
                                        <label for="tempat_kerja_4_false" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_4_false" name="tempat_kerja_4_check" value="false" /> Tidak</label>
                                        <label for="tempat_kerja_4_na" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_4_na" name="tempat_kerja_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tempat_kerja_4_note" id="tempat_kerja_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="tempat_kerja_5_check">5. Tidak ada ceceran oli.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tempat_kerja_5_true" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_5_true" name="tempat_kerja_5_check" value="true" required /> Ya</label>
                                        <label for="tempat_kerja_5_false" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_5_false" name="tempat_kerja_5_check" value="false" /> Tidak</label>
                                        <label for="tempat_kerja_5_na" class="me-3 px-2 py-2"><input type="radio" id="tempat_kerja_5_na" name="tempat_kerja_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tempat_kerja_5_note" id="tempat_kerja_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Peralatan Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="peralatan_kerja_1_check">1. Ditata dengan rapi, Tidak berserakan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="peralatan_kerja_1_true" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_true" name="peralatan_kerja_1_check" value="true" required /> Ya</label>
                                        <label for="peralatan_kerja_1_false" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_false" name="peralatan_kerja_1_check" value="false" /> Tidak</label>
                                        <label for="peralatan_kerja_1_na" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_na" name="peralatan_kerja_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="peralatan_kerja_1_note" id="peralatan_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Sistem Loto</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="sistem_loto_1_check">1. Dipasang pada saat bongkar-pasang tyre.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sistem_loto_1_true" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_true" name="sistem_loto_1_check" value="true" required /> Ya</label>
                                        <label for="sistem_loto_1_false" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_false" name="sistem_loto_1_check" value="false" /> Tidak</label>
                                        <label for="sistem_loto_1_na" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_na" name="sistem_loto_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sistem_loto_1_note" id="sistem_loto_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sistem_loto_2_check">2. Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sistem_loto_2_true" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_true" name="sistem_loto_2_check" value="true" required /> Ya</label>
                                        <label for="sistem_loto_2_false" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_false" name="sistem_loto_2_check" value="false" /> Tidak</label>
                                        <label for="sistem_loto_2_na" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_na" name="sistem_loto_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sistem_loto_2_note" id="sistem_loto_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Selang Angin</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="selang_angin_1_check">1. Berkualitas baik dan tanpa sambungan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="selang_angin_1_true" class="me-3 px-2 py-2"><input type="radio" id="selang_angin_1_true" name="selang_angin_1_check" value="true" required /> Ya</label>
                                        <label for="selang_angin_1_false" class="me-3 px-2 py-2"><input type="radio" id="selang_angin_1_false" name="selang_angin_1_check" value="false" /> Tidak</label>
                                        <label for="selang_angin_1_na" class="me-3 px-2 py-2"><input type="radio" id="selang_angin_1_na" name="selang_angin_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="selang_angin_1_note" id="selang_angin_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Electric</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_1_check">1. Kabel tidak terkelupas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_1_true" class="me-3 px-2 py-2"><input type="radio" id="electric_1_true" name="electric_1_check" value="true" required /> Ya</label>
                                        <label for="electric_1_false" class="me-3 px-2 py-2"><input type="radio" id="electric_1_false" name="electric_1_check" value="false" /> Tidak</label>
                                        <label for="electric_1_na" class="me-3 px-2 py-2"><input type="radio" id="electric_1_na" name="electric_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_1_note" id="electric_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_2_check">2. Kabel berkualitas baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_2_true" class="me-3 px-2 py-2"><input type="radio" id="electric_2_true" name="electric_2_check" value="true" required /> Ya</label>
                                        <label for="electric_2_false" class="me-3 px-2 py-2"><input type="radio" id="electric_2_false" name="electric_2_check" value="false" /> Tidak</label>
                                        <label for="electric_2_na" class="me-3 px-2 py-2"><input type="radio" id="electric_2_na" name="electric_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_2_note" id="electric_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_3_check">3. Colokan / sambungan ke sumber listrik cukup aman.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_3_true" class="me-3 px-2 py-2"><input type="radio" id="electric_3_true" name="electric_3_check" value="true" required /> Ya</label>
                                        <label for="electric_3_false" class="me-3 px-2 py-2"><input type="radio" id="electric_3_false" name="electric_3_check" value="false" /> Tidak</label>
                                        <label for="electric_3_na" class="me-3 px-2 py-2"><input type="radio" id="electric_3_na" name="electric_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_3_note" id="electric_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electric_4_check">4. Energi listrik menyala tanpa aktivitas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_4_true" class="me-3 px-2 py-2"><input type="radio" id="electric_4_true" name="electric_4_check" value="true" required /> Ya</label>
                                        <label for="electric_4_false" class="me-3 px-2 py-2"><input type="radio" id="electric_4_false" name="electric_4_check" value="false" /> Tidak</label>
                                        <label for="electric_4_na" class="me-3 px-2 py-2"><input type="radio" id="electric_4_na" name="electric_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_4_note" id="electric_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Compressor</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="compressor_1_check">1. Tabung compressor memiliki petunjuk tekanan angin.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="compressor_1_true" class="me-3 px-2 py-2"><input type="radio" id="compressor_1_true" name="compressor_1_check" value="true" required /> Ya</label>
                                        <label for="compressor_1_false" class="me-3 px-2 py-2"><input type="radio" id="compressor_1_false" name="compressor_1_check" value="false" /> Tidak</label>
                                        <label for="compressor_1_na" class="me-3 px-2 py-2"><input type="radio" id="compressor_1_na" name="compressor_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="compressor_1_note" id="compressor_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="compressor_2_check">2. Selang angin berkualitas baik, tanpa sambungan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="compressor_2_true" class="me-3 px-2 py-2"><input type="radio" id="compressor_2_true" name="compressor_2_check" value="true" required /> Ya</label>
                                        <label for="compressor_2_false" class="me-3 px-2 py-2"><input type="radio" id="compressor_2_false" name="compressor_2_check" value="false" /> Tidak</label>
                                        <label for="compressor_2_na" class="me-3 px-2 py-2"><input type="radio" id="compressor_2_na" name="compressor_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="compressor_2_note" id="compressor_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Bongkar Sparepart</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="bongkar_sparepart_1_check">1. Memiliki tempat mencuci yang memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bongkar_sparepart_1_true" class="me-3 px-2 py-2"><input type="radio" id="bongkar_sparepart_1_true" name="bongkar_sparepart_1_check" value="true" required /> Ya</label>
                                        <label for="bongkar_sparepart_1_false" class="me-3 px-2 py-2"><input type="radio" id="bongkar_sparepart_1_false" name="bongkar_sparepart_1_check" value="false" /> Tidak</label>
                                        <label for="bongkar_sparepart_1_na" class="me-3 px-2 py-2"><input type="radio" id="bongkar_sparepart_1_na" name="bongkar_sparepart_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bongkar_sparepart_1_note" id="bongkar_sparepart_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>APAR</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_1_check">1. Jumlahnya memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_1_true" class="me-3 px-2 py-2"><input type="radio" id="apar_1_true" name="apar_1_check" value="true" required /> Ya</label>
                                        <label for="apar_1_false" class="me-3 px-2 py-2"><input type="radio" id="apar_1_false" name="apar_1_check" value="false" /> Tidak</label>
                                        <label for="apar_1_na" class="me-3 px-2 py-2"><input type="radio" id="apar_1_na" name="apar_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_1_note" id="apar_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_2_check">2. Mudah dilihat dan dapat dijangkau.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_2_true" class="me-3 px-2 py-2"><input type="radio" id="apar_2_true" name="apar_2_check" value="true" required /> Ya</label>
                                        <label for="apar_2_false" class="me-3 px-2 py-2"><input type="radio" id="apar_2_false" name="apar_2_check" value="false" /> Tidak</label>
                                        <label for="apar_2_na" class="me-3 px-2 py-2"><input type="radio" id="apar_2_na" name="apar_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_2_note" id="apar_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_3_check">3. Tekanan APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_3_true" class="me-3 px-2 py-2"><input type="radio" id="apar_3_true" name="apar_3_check" value="true" required /> Ya</label>
                                        <label for="apar_3_false" class="me-3 px-2 py-2"><input type="radio" id="apar_3_false" name="apar_3_check" value="false" /> Tidak</label>
                                        <label for="apar_3_na" class="me-3 px-2 py-2"><input type="radio" id="apar_3_na" name="apar_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_3_note" id="apar_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_4_check">4. Isi APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_4_true" class="me-3 px-2 py-2"><input type="radio" id="apar_4_true" name="apar_4_check" value="true" required /> Ya</label>
                                        <label for="apar_4_false" class="me-3 px-2 py-2"><input type="radio" id="apar_4_false" name="apar_4_check" value="false" /> Tidak</label>
                                        <label for="apar_4_na" class="me-3 px-2 py-2"><input type="radio" id="apar_4_na" name="apar_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_4_note" id="apar_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Rambu-rambu Bahaya</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="rambu_bahaya_1_check">1. Dilarang menyalakan api / merokok.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_1_true" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_true" name="rambu_bahaya_1_check" value="true" required /> Ya</label>
                                        <label for="rambu_bahaya_1_false" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_false" name="rambu_bahaya_1_check" value="false" /> Tidak</label>
                                        <label for="rambu_bahaya_1_na" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_na" name="rambu_bahaya_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_1_note" id="rambu_bahaya_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="rambu_bahaya_2_check">2. Instruksi / gambar APD yang harus digunakan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_2_true" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_2_true" name="rambu_bahaya_2_check" value="true" required /> Ya</label>
                                        <label for="rambu_bahaya_2_false" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_2_false" name="rambu_bahaya_2_check" value="false" /> Tidak</label>
                                        <label for="rambu_bahaya_2_na" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_2_na" name="rambu_bahaya_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_2_note" id="rambu_bahaya_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="rambu_bahaya_3_check">3. Larangan penggunaan selang angin sembarangan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_3_true" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_3_true" name="rambu_bahaya_3_check" value="true" required /> Ya</label>
                                        <label for="rambu_bahaya_3_false" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_3_false" name="rambu_bahaya_3_check" value="false" /> Tidak</label>
                                        <label for="rambu_bahaya_3_na" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_3_na" name="rambu_bahaya_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_3_note" id="rambu_bahaya_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Tempat Sampah Domestik</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_1_check">1. Kelayakan tempat sampah, bertutup dan tidak bocor.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_1_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_true" name="sampah_domestik_1_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_1_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_false" name="sampah_domestik_1_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_1_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_na" name="sampah_domestik_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_1_note" id="sampah_domestik_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_2_check">2. Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_2_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_true" name="sampah_domestik_2_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_2_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_false" name="sampah_domestik_2_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_2_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_na" name="sampah_domestik_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_2_note" id="sampah_domestik_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_3_check">3. Sampah dibuang ke tempat pembuangan sampah.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_3_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_3_true" name="sampah_domestik_3_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_3_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_3_false" name="sampah_domestik_3_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_3_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_3_na" name="sampah_domestik_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_3_note" id="sampah_domestik_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Ban Bekas</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="ban_bekas_1_check">1. Ditempatkan pada tempat terpisah dari tire baru dan disusun.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ban_bekas_1_true" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_1_true" name="ban_bekas_1_check" value="true" required /> Ya</label>
                                        <label for="ban_bekas_1_false" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_1_false" name="ban_bekas_1_check" value="false" /> Tidak</label>
                                        <label for="ban_bekas_1_na" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_1_na" name="ban_bekas_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="ban_bekas_1_note" id="ban_bekas_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="ban_bekas_2_check">2. Memiliki catatan keluar-masuk ban bekas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ban_bekas_2_true" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_2_true" name="ban_bekas_2_check" value="true" required /> Ya</label>
                                        <label for="ban_bekas_2_false" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_2_false" name="ban_bekas_2_check" value="false" /> Tidak</label>
                                        <label for="ban_bekas_2_na" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_2_na" name="ban_bekas_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="ban_bekas_2_note" id="ban_bekas_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="ban_bekas_3_check">3. Ban bekas tidak dibakar atau dibuang ke waste dump.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ban_bekas_3_true" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_3_true" name="ban_bekas_3_check" value="true" required /> Ya</label>
                                        <label for="ban_bekas_3_false" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_3_false" name="ban_bekas_3_check" value="false" /> Tidak</label>
                                        <label for="ban_bekas_3_na" class="me-3 px-2 py-2"><input type="radio" id="ban_bekas_3_na" name="ban_bekas_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="ban_bekas_3_note" id="ban_bekas_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHWorkshopTyre">
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

    const formKLKHWorkshopTyre = document.getElementById('submitFormKLKHWorkshopTyre');
    const submitButtonKLKHWorkshopTyre = document.getElementById('submitButtonKLKHWorkshopTyre');

    formKLKHWorkshopTyre.addEventListener('submit', function() {
    
        submitButtonKLKHWorkshopTyre.disabled = true;
        submitButtonKLKHWorkshopTyre.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHWorkshopTyre.disabled = false;
            submitButtonKLKHWorkshopTyre.innerText = 'Submit';
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
