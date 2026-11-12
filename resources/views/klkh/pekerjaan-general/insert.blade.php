@include('layout.head', ['title' => 'KLKH Pekerjaan General'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Pekerjaan General</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.pekerjaangeneral.post') }}" method="POST" id="submitFormKLKHPekerjaanGeneral" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="lokasi">Pit</label>
                                        <input type="text" name="lokasi" id="lokasi"
                                            class="form-control form-control-sm pb-2 mt-2"
                                            placeholder="Lokasi Pekerjaan" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="departemen">Departemen</label>
                                        <select class="form-control form-control-sm pb-2" id="departemen" name="departemen" data-trigger>
                                            <option selected disabled></option>
                                            @foreach ($users['departemen'] as $dep)
                                                <option value="{{ $dep->id }}">{{ $dep->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="shift">Shift</label>
                                        <select class="form-control form-control-sm pb-2" id="shift" name="shift" data-trigger required>
                                            <option selected disabled></option>
                                            @foreach ($users['shift'] as $sh)
                                                <option value="{{ $sh->id }}">{{ $sh->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Hari / Tanggal</label>
                                        <input type="date" name="date" id="date"
                                            class="form-control form-control-sm pb-2" required />
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="time">Jam</label>
                                        <input type="time" name="time" id="time"
                                            class="form-control form-control-sm pb-2" required />
                                    </div>
                                </div>
                                <hr>
                                <h5>A. PERBAIKAN JALAN & TANGGUL</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>1. Terdapat pengawas pada area kerja</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_1_true" name="perbaikan_jalan_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_1_false" name="perbaikan_jalan_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_1_na" name="perbaikan_jalan_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_1_note" id="perbaikan_jalan_1_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2. Tersedia alat komunikasi Radio</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_2_true" name="perbaikan_jalan_2_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_2_false" name="perbaikan_jalan_2_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_2_na" name="perbaikan_jalan_2_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_2_note" id="perbaikan_jalan_2_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3. Terdapat rambu pekerjaan</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_3_true" name="perbaikan_jalan_3_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_3_false" name="perbaikan_jalan_3_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_3_na" name="perbaikan_jalan_3_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_3_note" id="perbaikan_jalan_3_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4. Terdapat JSA pekerjaan perbaikan jalan & tanggul</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_4_true" name="perbaikan_jalan_4_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_4_false" name="perbaikan_jalan_4_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_4_na" name="perbaikan_jalan_4_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_4_note" id="perbaikan_jalan_4_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5. Terdapat form KKH operator dengan minimal istirahat 6 jam</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_5_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_5_true" name="perbaikan_jalan_5_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_5_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_5_false" name="perbaikan_jalan_5_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_5_na" name="perbaikan_jalan_5_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_5_note" id="perbaikan_jalan_5_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6. Terdapat APD lengkap</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_6_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_6_true" name="perbaikan_jalan_6_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_6_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_6_false" name="perbaikan_jalan_6_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_6_na" name="perbaikan_jalan_6_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_6_note" id="perbaikan_jalan_6_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7. Telah dilakukan P2H alat maintenance</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_7_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_7_true" name="perbaikan_jalan_7_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_7_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_7_false" name="perbaikan_jalan_7_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_7_na" name="perbaikan_jalan_7_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_7_note" id="perbaikan_jalan_7_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8. Apakah lalu lintas akses jalan area kerja crowded?</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_8_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_8_true" name="perbaikan_jalan_8_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_8_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_8_false" name="perbaikan_jalan_8_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_8_na" name="perbaikan_jalan_8_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_8_note" id="perbaikan_jalan_8_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9. Lebar jalan sesuai standar 3,5 kali lebar unit terbesar</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_9_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_9_true" name="perbaikan_jalan_9_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_9_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_9_false" name="perbaikan_jalan_9_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_9_na" name="perbaikan_jalan_9_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_9_note" id="perbaikan_jalan_9_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10. Terbentuk superelevasi pada tikungan jalan</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_10_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_10_true" name="perbaikan_jalan_10_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_10_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_10_false" name="perbaikan_jalan_10_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_10_na" name="perbaikan_jalan_10_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_10_note" id="perbaikan_jalan_10_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>11. Terbentuk crossfall pada badan jalan minimal 2%</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_11_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_11_true" name="perbaikan_jalan_11_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_11_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_11_false" name="perbaikan_jalan_11_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_11_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_11_na" name="perbaikan_jalan_11_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_11_note" id="perbaikan_jalan_11_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>12. Dimensi tanggul jalan 3/4 dari diameter ban unit terbesar</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_12_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_12_true" name="perbaikan_jalan_12_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_12_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_12_false" name="perbaikan_jalan_12_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_12_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_12_na" name="perbaikan_jalan_12_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_12_note" id="perbaikan_jalan_12_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>13. Apakah terdapat unit support pengendalian debu (Water Truck)?</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_13_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_13_true" name="perbaikan_jalan_13_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_13_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_13_false" name="perbaikan_jalan_13_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_13_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_13_na" name="perbaikan_jalan_13_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_13_note" id="perbaikan_jalan_13_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>14. Apakah terdapat lampu penerangan area kerja?</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_jalan_14_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_14_true" name="perbaikan_jalan_14_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_jalan_14_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_14_false" name="perbaikan_jalan_14_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_jalan_14_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_jalan_14_na" name="perbaikan_jalan_14_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_jalan_14_note" id="perbaikan_jalan_14_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>B. PERBAIKAN LERENG TAMBANG</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>1. Terdapat pengawas pada area kerja</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_1_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_1_true" name="perbaikan_lereng_1_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_1_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_1_false" name="perbaikan_lereng_1_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_1_na" name="perbaikan_lereng_1_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_1_note" id="perbaikan_lereng_1_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2. Terdapat form KKH operator dengan minimal istirahat 6 jam</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_2_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_2_true" name="perbaikan_lereng_2_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_2_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_2_false" name="perbaikan_lereng_2_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_2_na" name="perbaikan_lereng_2_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_2_note" id="perbaikan_lereng_2_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3. Terdapat APD lengkap</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_3_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_3_true" name="perbaikan_lereng_3_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_3_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_3_false" name="perbaikan_lereng_3_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_3_na" name="perbaikan_lereng_3_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_3_note" id="perbaikan_lereng_3_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4. Tersedia alat komunikasi Radio</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_4_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_4_true" name="perbaikan_lereng_4_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_4_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_4_false" name="perbaikan_lereng_4_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_4_na" name="perbaikan_lereng_4_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_4_note" id="perbaikan_lereng_4_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5. Telah dilakukan P2H alat maintenance</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_5_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_5_true" name="perbaikan_lereng_5_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_5_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_5_false" name="perbaikan_lereng_5_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_5_na" name="perbaikan_lereng_5_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_5_note" id="perbaikan_lereng_5_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6. Terdapat patok acuan pada area rencana kerja</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_6_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_6_true" name="perbaikan_lereng_6_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_6_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_6_false" name="perbaikan_lereng_6_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_6_na" name="perbaikan_lereng_6_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_6_note" id="perbaikan_lereng_6_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7. Pad excavator stabil dan lebarnya memadai</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_7_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_7_true" name="perbaikan_lereng_7_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_7_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_7_false" name="perbaikan_lereng_7_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_7_na" name="perbaikan_lereng_7_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_7_note" id="perbaikan_lereng_7_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8. Terdapat potensi rock fall</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_8_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_8_true" name="perbaikan_lereng_8_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_8_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_8_false" name="perbaikan_lereng_8_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_8_na" name="perbaikan_lereng_8_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_8_note" id="perbaikan_lereng_8_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9. Terdapat crack pada lereng tambang</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="perbaikan_lereng_9_true" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_9_true" name="perbaikan_lereng_9_check" value="true" required /> Ya
                                        </label>
                                        <label for="perbaikan_lereng_9_false" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_9_false" name="perbaikan_lereng_9_check" value="false" /> Tidak
                                        </label>
                                        <label for="perbaikan_lereng_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perbaikan_lereng_9_na" name="perbaikan_lereng_9_check" value="n/a" /> N/A
                                        </label>
                                    </div>
                                    <input type="text" name="perbaikan_lereng_9_note" id="perbaikan_lereng_9_note"
                                        class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="additional_notes">Catatan Tambahan</label>
                                    <textarea name="additional_notes" id="additional_notes" class="form-control form-control-sm pb-2 mt-2" rows="3" placeholder="Catatan Tambahan"></textarea>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="diketahui">Supervisor</label>
                                        <select class="form-control form-control-sm pb-2" id="diketahui" name="diketahui" data-trigger>
                                            <option selected disabled></option>
                                            @foreach ($users['diketahui'] as $si)
                                                <option value="{{ $si->nik }}">{{ $si->name }} ({{ $si->position }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="disetujui">Manager</label>
                                        <select class="form-control form-control-sm pb-2" id="disetujui" name="disetujui" data-trigger>
                                            <option selected disabled></option>
                                            @foreach ($users['disetujui'] as $si)
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHWashingBay">
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

    const formKLKHPekerjaanGeneral = document.getElementById('submitFormKLKHPekerjaanGeneral');
    const submitButtonKLKHPekerjaanGeneral = document.getElementById('submitButtonKLKHPekerjaanGeneral');

    formKLKHPekerjaanGeneral.addEventListener('submit', function() {
    
        submitButtonKLKHPekerjaanGeneral.disabled = true;
        submitButtonKLKHPekerjaanGeneral.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHPekerjaanGeneral.disabled = false;
            submitButtonKLKHPekerjaanGeneral.innerText = 'Submit';
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

    document.getElementById('submitFormKLKHPekerjaanGeneral').addEventListener('submit', function(e) {
        const diketahui = document.getElementById('diketahui');
        const disetujui = document.getElementById('disetujui');

        if (!diketahui.value) {
            e.preventDefault();

            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: 'Silakan pilih PIC Diketahui terlebih dahulu.',
                confirmButtonText: 'Mengerti',
                buttonsStyling: false,
                customClass: {
                    popup: 'sims-swal-popup',
                    title: 'sims-swal-title',
                    htmlContainer: 'sims-swal-html',
                    confirmButton: 'sims-swal-confirm',
                    icon: 'sims-swal-icon'
                }
            });

            return;
        }

        if (!disetujui.value) {
            e.preventDefault();

            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: 'Silakan pilih PIC Manager terlebih dahulu.',
                confirmButtonText: 'Mengerti',
                buttonsStyling: false,
                customClass: {
                    popup: 'sims-swal-popup',
                    title: 'sims-swal-title',
                    htmlContainer: 'sims-swal-html',
                    confirmButton: 'sims-swal-confirm',
                    icon: 'sims-swal-icon'
                }
            });

            return;
        }
    });
</script>
