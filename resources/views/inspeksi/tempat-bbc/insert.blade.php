@include('layout.head', ['title' => 'Inspeksi Tempat Bahan Bakar Cair (BBC)'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Tempat Bahan Bakar Cair (BBC)</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.tempatbbc.post') }}" method="POST" id="submitformInspeksiTempatBBC" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal_inspeksi" required>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Nama Lokasi</label>
                                        <input type="text" class="form-control form-control-sm" name="nama_lokasi" required>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Lokasi PIT</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1" name="pit" required>
                                            <option selected disabled></option>
                                            @foreach ($users['pit'] as $pit)
                                                <option value="{{ $pit->id }}">{{ $pit->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Penanggung Jawab Area</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect2" name="penanggungjawab" data-trigger required>
                                            <option selected disabled></option>
                                            @foreach ($users['penanggungjawab'] as $penanggungjawab)
                                                <option value="{{ $penanggungjawab->nik }}">{{ $penanggungjawab->name }} ({{ $penanggungjawab->nik }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <h5>1. HOUSEKEEPING</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>1.1. Apakah area kerja dalam keadaan rapi dan teratur?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_1_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_1_s" name="housekeeping_1_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_1_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_1_ts" name="housekeeping_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_1_action" name="housekeeping_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_1_due">Due Date</label>
                                            <input type="date" id="housekeeping_1_due" name="housekeeping_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2. Apakah lantai kerja dalam keadaan bersih &amp; bebas dari benda-benda yang tidak diperlukan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_2_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_2_s" name="housekeeping_2_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_2_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_2_ts" name="housekeeping_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_2_action" name="housekeeping_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_2_due">Due Date</label>
                                            <input type="date" id="housekeeping_2_due" name="housekeeping_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3. Apakah kondisi lantai kerja tidak rusak?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_3_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_3_s" name="housekeeping_3_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_3_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_3_ts" name="housekeeping_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_3_action" name="housekeeping_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_3_due">Due Date</label>
                                            <input type="date" id="housekeeping_3_due" name="housekeeping_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4. Apakah jalur jalan diberi tanda/cat/demarkasi jelas?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_4_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_4_s" name="housekeeping_4_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_4_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_4_ts" name="housekeeping_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_4_action" name="housekeeping_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_4_due">Due Date</label>
                                            <input type="date" id="housekeeping_4_due" name="housekeeping_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5. Apakah jalur jalan dan lintasan bebas dari hambatan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_5_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_5_s" name="housekeeping_5_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_5_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_5_ts" name="housekeeping_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_5_action" name="housekeeping_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_5_due">Due Date</label>
                                            <input type="date" id="housekeeping_5_due" name="housekeeping_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.6. Apakah penerangan termasuk lampu dan bola lampu ada dalam keadaan yang bersih dan berfungsi?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_6_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_6_s" name="housekeeping_6_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_6_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_6_ts" name="housekeeping_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_6_action" name="housekeeping_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_6_due">Due Date</label>
                                            <input type="date" id="housekeeping_6_due" name="housekeeping_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.7. Apakah permukaan halaman tidak bergelombang &amp; tidak becek?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_7_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_7_s" name="housekeeping_7_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_7_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_7_ts" name="housekeeping_7_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_7_action" name="housekeeping_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_7_due">Due Date</label>
                                            <input type="date" id="housekeeping_7_due" name="housekeeping_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.8. Apakah halaman bersih dari sampah?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_8_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_8_s" name="housekeeping_8_check" value="S" required> Sesuai
                                        </label>
                                        <label for="housekeeping_8_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_8_ts" name="housekeeping_8_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="housekeeping_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="housekeeping_8_action" name="housekeeping_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="housekeeping_8_due">Due Date</label>
                                            <input type="date" id="housekeeping_8_due" name="housekeeping_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>2. EMERGENCY EQUIPMENT</h5>
                                <hr>
                                <h6 class="fw-bold mt-3">APAR &amp; HYDRANT</h6>
                                <div class="mb-3">
                                    <label>2.1. Apakah APAR mencukupi &amp; terdapat tanda (marking)?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_1_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_1_s" name="emergency_equipment_1_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_1_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_1_ts" name="emergency_equipment_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_1_action" name="emergency_equipment_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_1_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_1_due" name="emergency_equipment_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2. Apakah kondisi tabung APAR dalam kondisi layak?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_2_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_2_s" name="emergency_equipment_2_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_2_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_2_ts" name="emergency_equipment_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_2_action" name="emergency_equipment_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_2_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_2_due" name="emergency_equipment_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3. Apakah akses ke alat pemadam tidak terhalang?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_3_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_3_s" name="emergency_equipment_3_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_3_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_3_ts" name="emergency_equipment_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_3_action" name="emergency_equipment_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_3_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_3_due" name="emergency_equipment_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4. Apakah APAR diinspeksi secara rutin dan terdapat tag?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_4_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_4_s" name="emergency_equipment_4_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_4_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_4_ts" name="emergency_equipment_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_4_action" name="emergency_equipment_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_4_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_4_due" name="emergency_equipment_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5. Apakah hydrant untuk kebakaran (bila ada) dan perlengkapannya dalam keadaan baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_5_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_5_s" name="emergency_equipment_5_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_5_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_5_ts" name="emergency_equipment_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_5_action" name="emergency_equipment_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_5_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_5_due" name="emergency_equipment_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3">EYEWASH</h6>
                                <div class="mb-3">
                                    <label>2.6. Apakah eyewash dalam kondisi bersih?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_6_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_6_s" name="emergency_equipment_6_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_6_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_6_ts" name="emergency_equipment_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_6_action" name="emergency_equipment_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_6_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_6_due" name="emergency_equipment_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.7. Apakah eyewash dilakukan inspeksi secara teratur dan terdapat tag yang diisi sesuai?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_7_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_7_s" name="emergency_equipment_7_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_7_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_7_ts" name="emergency_equipment_7_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_7_action" name="emergency_equipment_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_7_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_7_due" name="emergency_equipment_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.8. Apakah eyewash berfungsi dengan baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_8_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_8_s" name="emergency_equipment_8_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_8_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_8_ts" name="emergency_equipment_8_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_8_action" name="emergency_equipment_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_8_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_8_due" name="emergency_equipment_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.9. Apakah akses ke tempat pencucian mata tidak terhalangi?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_9_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_9_s" name="emergency_equipment_9_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_9_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_9_ts" name="emergency_equipment_9_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_9_action" name="emergency_equipment_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_9_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_9_due" name="emergency_equipment_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3">ASSEMBLY POINT DAN FASILITAS LAINNYA</h6>
                                <div class="mb-3">
                                    <label>2.10. Apakah ada peta/layout area berkumpul darurat?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_10_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_10_s" name="emergency_equipment_10_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_10_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_10_ts" name="emergency_equipment_10_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_10_action" name="emergency_equipment_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_10_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_10_due" name="emergency_equipment_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.11. Apakah area berkumpul darurat diberi rambu "Assembly Point’?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_11_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_11_s" name="emergency_equipment_11_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_11_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_11_ts" name="emergency_equipment_11_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_11_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_11_action" name="emergency_equipment_11_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_11_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_11_due" name="emergency_equipment_11_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.12. Apakah terdapat emergency spill kit yang memadai?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_12_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_12_s" name="emergency_equipment_12_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_12_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_12_ts" name="emergency_equipment_12_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_12_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_12_action" name="emergency_equipment_12_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_12_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_12_due" name="emergency_equipment_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.13. Apakah terdapat kotak P3K sesuai dengan ketentuan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_13_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_13_s" name="emergency_equipment_13_check" value="S" required> Sesuai
                                        </label>
                                        <label for="emergency_equipment_13_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_13_ts" name="emergency_equipment_13_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_13_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_13_action" name="emergency_equipment_13_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_13_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_13_due" name="emergency_equipment_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>3. PERALATAN DAN FASILITAS</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1. Apakah pewarnaan pipa sesuai dengan standar kode warna?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_1_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_1_s" name="peralatan_fasilitas_1_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_1_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_1_ts" name="peralatan_fasilitas_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_1_action" name="peralatan_fasilitas_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_1_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_1_due" name="peralatan_fasilitas_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2. Apakah pipa saluran bahan bakar terbuat dari bahan yang tahan api?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_2_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_2_s" name="peralatan_fasilitas_2_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_2_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_2_ts" name="peralatan_fasilitas_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_2_action" name="peralatan_fasilitas_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_2_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_2_due" name="peralatan_fasilitas_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3. Apakah tangki penyimpanan terbuat dari bahan yang tahan api?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_3_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_3_s" name="peralatan_fasilitas_3_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_3_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_3_ts" name="peralatan_fasilitas_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_3_action" name="peralatan_fasilitas_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_3_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_3_due" name="peralatan_fasilitas_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4. Apakah tangki penyimpanan berdiri kokoh tidak miring dan stabil pada pondasi?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_4_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_4_s" name="peralatan_fasilitas_4_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_4_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_4_ts" name="peralatan_fasilitas_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_4_action" name="peralatan_fasilitas_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_4_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_4_due" name="peralatan_fasilitas_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.5. Apakah tangki penyimpanan tidak bocor atau tidak ada rembesan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_5_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_5_s" name="peralatan_fasilitas_5_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_5_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_5_ts" name="peralatan_fasilitas_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_5_action" name="peralatan_fasilitas_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_5_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_5_due" name="peralatan_fasilitas_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.6. Apakah terdapat ventilasi pembuangan gas/angin diatas tangki?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_6_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_6_s" name="peralatan_fasilitas_6_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_6_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_6_ts" name="peralatan_fasilitas_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_6_action" name="peralatan_fasilitas_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_6_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_6_due" name="peralatan_fasilitas_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.7. Apakah terdapat drainase tempat pembuangan apabila ada kebocoran dan bermuara pada oil trap?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_7_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_7_s" name="peralatan_fasilitas_7_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_7_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_7_ts" name="peralatan_fasilitas_7_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_7_action" name="peralatan_fasilitas_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_7_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_7_due" name="peralatan_fasilitas_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.8. Apakah pompa fuel berada diluar pagar dan kondisi baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_8_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_8_s" name="peralatan_fasilitas_8_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_8_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_8_ts" name="peralatan_fasilitas_8_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_8_action" name="peralatan_fasilitas_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_8_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_8_due" name="peralatan_fasilitas_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.9. Apakah tanggul dalam kondisi baik/tidak retak?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_9_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_9_s" name="peralatan_fasilitas_9_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_9_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_9_ts" name="peralatan_fasilitas_9_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_9_action" name="peralatan_fasilitas_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_9_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_9_due" name="peralatan_fasilitas_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.10. Apakah tanggul mampu menampung (110% volume total) jika tangki mengalami kebocoran?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_10_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_10_s" name="peralatan_fasilitas_10_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_10_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_10_ts" name="peralatan_fasilitas_10_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_10_action" name="peralatan_fasilitas_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_10_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_10_due" name="peralatan_fasilitas_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.11. Apakah terdapat kran pembuangan yang di hubungkan dengan oil trap?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_11_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_11_s" name="peralatan_fasilitas_11_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_11_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_11_ts" name="peralatan_fasilitas_11_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_11_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_11_action" name="peralatan_fasilitas_11_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_11_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_11_due" name="peralatan_fasilitas_11_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.12. Apakah terdapat pagar pengaman yang layak?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_12_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_12_s" name="peralatan_fasilitas_12_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_12_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_12_ts" name="peralatan_fasilitas_12_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_12_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_12_action" name="peralatan_fasilitas_12_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_12_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_12_due" name="peralatan_fasilitas_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.13. Apakah ada pintu pagar yang dapat dikunci?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_13_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_13_s" name="peralatan_fasilitas_13_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_13_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_13_ts" name="peralatan_fasilitas_13_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_13_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_13_action" name="peralatan_fasilitas_13_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_13_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_13_due" name="peralatan_fasilitas_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.14. Apakah penyalur petir dalam kondisi baik dan berfungsi? Maks 5 Ω</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_14_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_14_s" name="peralatan_fasilitas_14_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_14_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_14_ts" name="peralatan_fasilitas_14_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_14_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_14_action" name="peralatan_fasilitas_14_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_14_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_14_due" name="peralatan_fasilitas_14_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.15. Apakah terdapat oil trap yang berfungsi dengan baik dan dilakukan pembersihan secara berkala?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_15_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_15_s" name="peralatan_fasilitas_15_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_15_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_15_ts" name="peralatan_fasilitas_15_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_15_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_15_action" name="peralatan_fasilitas_15_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_15_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_15_due" name="peralatan_fasilitas_15_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.16. Apakah tangki memiliki handrail (susur tangga) dan berfungsi dengan baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_16_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_16_s" name="peralatan_fasilitas_16_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_16_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_16_ts" name="peralatan_fasilitas_16_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_16_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_16_action" name="peralatan_fasilitas_16_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_16_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_16_due" name="peralatan_fasilitas_16_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.17. Apakah pijakan tangga dalam kondisi baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_17_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_17_s" name="peralatan_fasilitas_17_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_17_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_17_ts" name="peralatan_fasilitas_17_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_17_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_17_action" name="peralatan_fasilitas_17_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_17_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_17_due" name="peralatan_fasilitas_17_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.18. Apakah handrail dan pijakan tangga memiliki pewarnaan sesuai standar?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_18_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_18_s" name="peralatan_fasilitas_18_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_18_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_18_ts" name="peralatan_fasilitas_18_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_18_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_18_action" name="peralatan_fasilitas_18_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_18_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_18_due" name="peralatan_fasilitas_18_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.19. Apakah peralatan yang digunakan telah dikalibrasi/disertifikasi? (Jika ada peralatan yang wajib dilakukan kalibrasi/sertifikasi)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_19_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_19_s" name="peralatan_fasilitas_19_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_19_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_19_ts" name="peralatan_fasilitas_19_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_19_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_19_action" name="peralatan_fasilitas_19_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_19_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_19_due" name="peralatan_fasilitas_19_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.20. Apakah penyalur petir mencakup luasan area yang dilindungi?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_20_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_20_s" name="peralatan_fasilitas_20_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_20_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_20_ts" name="peralatan_fasilitas_20_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_20_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_20_action" name="peralatan_fasilitas_20_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_20_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_20_due" name="peralatan_fasilitas_20_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.21. Apakah tangki penyimpanan terdapat tanda kapasitas isi dan jenisnya?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_21_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_21_s" name="peralatan_fasilitas_21_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_21_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_21_ts" name="peralatan_fasilitas_21_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_21_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_21_action" name="peralatan_fasilitas_21_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_21_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_21_due" name="peralatan_fasilitas_21_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.22. Apakah semua selang pucuk pengisian dalam kondisi baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_22_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_22_s" name="peralatan_fasilitas_22_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_22_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_22_ts" name="peralatan_fasilitas_22_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_22_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_22_action" name="peralatan_fasilitas_22_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_22_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_22_due" name="peralatan_fasilitas_22_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.23. Apakah terdapat penghalang tabrakan di sekitar area pengisian?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_23_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_23_s" name="peralatan_fasilitas_23_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_23_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_23_ts" name="peralatan_fasilitas_23_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_23_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_23_action" name="peralatan_fasilitas_23_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_23_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_23_due" name="peralatan_fasilitas_23_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.24. Apakah terdapat penampung tetesan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_24_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_24_s" name="peralatan_fasilitas_24_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_24_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_24_ts" name="peralatan_fasilitas_24_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_24_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_24_action" name="peralatan_fasilitas_24_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_24_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_24_due" name="peralatan_fasilitas_24_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.25. Apakah terdapat tongkat untuk mengukur kedalaman?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_25_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_25_s" name="peralatan_fasilitas_25_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_25_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_25_ts" name="peralatan_fasilitas_25_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_25_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_25_action" name="peralatan_fasilitas_25_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_25_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_25_due" name="peralatan_fasilitas_25_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.26. Apakah terdapat MSDS yang terpelihara dengan baik dan mudah dibaca dan dipahami?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_26_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_26_s" name="peralatan_fasilitas_26_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_26_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_26_ts" name="peralatan_fasilitas_26_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_26_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_26_action" name="peralatan_fasilitas_26_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_26_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_26_due" name="peralatan_fasilitas_26_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.27. Apakah kompartemen oil trap dalam kondisi bersih?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_27_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_27_s" name="peralatan_fasilitas_27_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_27_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_27_ts" name="peralatan_fasilitas_27_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_27_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_27_action" name="peralatan_fasilitas_27_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_27_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_27_due" name="peralatan_fasilitas_27_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.28. Apakah unit yang dioperasikan sudah dilakukan P2H?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_28_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_28_s" name="peralatan_fasilitas_28_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_28_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_28_ts" name="peralatan_fasilitas_28_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_28_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_28_action" name="peralatan_fasilitas_28_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_28_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_28_due" name="peralatan_fasilitas_28_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.29. Apakah pipa dalam kondisi baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_29_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_29_s" name="peralatan_fasilitas_29_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_29_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_29_ts" name="peralatan_fasilitas_29_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_29_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_29_action" name="peralatan_fasilitas_29_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_29_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_29_due" name="peralatan_fasilitas_29_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.30. Apakah terdapat ganjal tyre yang dapat digunakan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="peralatan_fasilitas_30_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_30_s" name="peralatan_fasilitas_30_check" value="S" required> Sesuai
                                        </label>
                                        <label for="peralatan_fasilitas_30_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="peralatan_fasilitas_30_ts" name="peralatan_fasilitas_30_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="peralatan_fasilitas_30_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="peralatan_fasilitas_30_action" name="peralatan_fasilitas_30_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="peralatan_fasilitas_30_due">Due Date</label>
                                            <input type="date" id="peralatan_fasilitas_30_due" name="peralatan_fasilitas_30_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>4. PROSEDUR KERJA AMAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>4.1. Apakah terdapat prosedur di area kerja?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="prosedur_kerja_1_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="prosedur_kerja_1_s" name="prosedur_kerja_1_check" value="S" required> Sesuai
                                        </label>
                                        <label for="prosedur_kerja_1_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="prosedur_kerja_1_ts" name="prosedur_kerja_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="prosedur_kerja_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="prosedur_kerja_1_action" name="prosedur_kerja_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="prosedur_kerja_1_due">Due Date</label>
                                            <input type="date" id="prosedur_kerja_1_due" name="prosedur_kerja_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2. Apakah terdapat prosedur kerja untuk menjalankan aktivitas?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="prosedur_kerja_2_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="prosedur_kerja_2_s" name="prosedur_kerja_2_check" value="S" required> Sesuai
                                        </label>
                                        <label for="prosedur_kerja_2_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="prosedur_kerja_2_ts" name="prosedur_kerja_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="prosedur_kerja_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="prosedur_kerja_2_action" name="prosedur_kerja_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="prosedur_kerja_2_due">Due Date</label>
                                            <input type="date" id="prosedur_kerja_2_due" name="prosedur_kerja_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3. Apakah prosedur kerja dapat diterapkan dilapangan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="prosedur_kerja_3_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="prosedur_kerja_3_s" name="prosedur_kerja_3_check" value="S" required> Sesuai
                                        </label>
                                        <label for="prosedur_kerja_3_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="prosedur_kerja_3_ts" name="prosedur_kerja_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="prosedur_kerja_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="prosedur_kerja_3_action" name="prosedur_kerja_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="prosedur_kerja_3_due">Due Date</label>
                                            <input type="date" id="prosedur_kerja_3_due" name="prosedur_kerja_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>5. RAMBU-RAMBU</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>5.1. Apakah ada rambu pemakaian “APD Standard”?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_1_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_1_s" name="rambu_1_check" value="S" required> Sesuai
                                        </label>
                                        <label for="rambu_1_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_1_ts" name="rambu_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_1_action" name="rambu_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_1_due">Due Date</label>
                                            <input type="date" id="rambu_1_due" name="rambu_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2. Apakah ada rambu “Dilarang Merokok” untuk area yang berpotensi terjadi kebakaran dan tidak ditemukan puntung rokok?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_2_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_2_s" name="rambu_2_check" value="S" required> Sesuai
                                        </label>
                                        <label for="rambu_2_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_2_ts" name="rambu_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_2_action" name="rambu_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_2_due">Due Date</label>
                                            <input type="date" id="rambu_2_due" name="rambu_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3. Apakah terdapat rambu lalu lintas yang memadai?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_3_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_3_s" name="rambu_3_check" value="S" required> Sesuai
                                        </label>
                                        <label for="rambu_3_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_3_ts" name="rambu_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_3_action" name="rambu_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_3_due">Due Date</label>
                                            <input type="date" id="rambu_3_due" name="rambu_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.4. Apakah ada tanda/jalur keluar darurat?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_4_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_4_s" name="rambu_4_check" value="S" required> Sesuai
                                        </label>
                                        <label for="rambu_4_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_4_ts" name="rambu_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_4_action" name="rambu_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_4_due">Due Date</label>
                                            <input type="date" id="rambu_4_due" name="rambu_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5. Apakah terdapat rambu parkir kendaraan/unit?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_5_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_5_s" name="rambu_5_check" value="S" required> Sesuai
                                        </label>
                                        <label for="rambu_5_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_5_ts" name="rambu_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_5_action" name="rambu_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_5_due">Due Date</label>
                                            <input type="date" id="rambu_5_due" name="rambu_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>6. PENGELOLAAN SAMPAH DAN HIDROKARBON</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>6.1. Apakah terdapat ceceran hidrokarbon di tanah?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_1_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_1_s" name="sampah_hidrokarbon_1_check" value="S" required> Sesuai
                                        </label>
                                        <label for="sampah_hidrokarbon_1_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_1_ts" name="sampah_hidrokarbon_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_1_action" name="sampah_hidrokarbon_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_1_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_1_due" name="sampah_hidrokarbon_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2. Apakah tersedia tempat sampah/limbah dan penampungan tumpahan oli?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_2_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_2_s" name="sampah_hidrokarbon_2_check" value="S" required> Sesuai
                                        </label>
                                        <label for="sampah_hidrokarbon_2_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_2_ts" name="sampah_hidrokarbon_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_2_action" name="sampah_hidrokarbon_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_2_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_2_due" name="sampah_hidrokarbon_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.3. Apakah tempat pembuangan sampah/limbah sudah diberi nama dan tanda yang benar dan cukup?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_3_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_3_s" name="sampah_hidrokarbon_3_check" value="S" required> Sesuai
                                        </label>
                                        <label for="sampah_hidrokarbon_3_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_3_ts" name="sampah_hidrokarbon_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_3_action" name="sampah_hidrokarbon_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_3_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_3_due" name="sampah_hidrokarbon_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>7. PERLENGKAPAN UNTUK PERSONIL</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1. Apakah semua personil menggunakan APD yang sesuai?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_personil_1_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_personil_1_s" name="perlengkapan_personil_1_check" value="S" required> Sesuai
                                        </label>
                                        <label for="perlengkapan_personil_1_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_personil_1_ts" name="perlengkapan_personil_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perlengkapan_personil_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perlengkapan_personil_1_action" name="perlengkapan_personil_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perlengkapan_personil_1_due">Due Date</label>
                                            <input type="date" id="perlengkapan_personil_1_due" name="perlengkapan_personil_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2. Apakah semua personil membawa kartu ID (Simper/Permit) yang masih berlaku?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_personil_2_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_personil_2_s" name="perlengkapan_personil_2_check" value="S" required> Sesuai
                                        </label>
                                        <label for="perlengkapan_personil_2_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_personil_2_ts" name="perlengkapan_personil_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perlengkapan_personil_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perlengkapan_personil_2_action" name="perlengkapan_personil_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perlengkapan_personil_2_due">Due Date</label>
                                            <input type="date" id="perlengkapan_personil_2_due" name="perlengkapan_personil_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3. Apakah terdapat tindakan tidak aman?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perlengkapan_personil_3_s" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_personil_3_s" name="perlengkapan_personil_3_check" value="S" required> Sesuai
                                        </label>
                                        <label for="perlengkapan_personil_3_ts" class="me-3 px-2 py-2">
                                            <input type="radio" id="perlengkapan_personil_3_ts" name="perlengkapan_personil_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perlengkapan_personil_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perlengkapan_personil_3_action" name="perlengkapan_personil_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perlengkapan_personil_3_due">Due Date</label>
                                            <input type="date" id="perlengkapan_personil_3_due" name="perlengkapan_personil_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan catatan..."></textarea>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor1">Inspektor 1</label>
                                        <select class="form-control form-control-sm" id="inspektor1" name="inspektor1" data-trigger required>
                                            <option value="{{ Auth::user()->nik }}" selected>{{ Auth::user()->name }} ({{ Auth::user()->nik }})</option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor1') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor2">Inspektor 2</label>
                                        <select class="form-control form-control-sm" id="inspektor2" name="inspektor2" data-trigger>
                                            <option value="" selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor2') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor3">Inspektor 3</label>
                                        <select class="form-control form-control-sm" id="inspektor3" name="inspektor3" data-trigger>
                                            <option value="" selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor3') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor4">Inspektor 4</label>
                                        <select class="form-control form-control-sm" id="inspektor4" name="inspektor4" data-trigger>
                                            <option value="" selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor4') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor5">Inspektor 5</label>
                                        <select class="form-control form-control-sm" id="inspektor5" name="inspektor5" data-trigger>
                                            <option value="" selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor4') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor6">Inspektor 6</label>
                                        <select class="form-control form-control-sm" id="inspektor6" name="inspektor6" data-trigger>
                                            <option value="" selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor4') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor7">Inspektor 7</label>
                                        <select class="form-control form-control-sm" id="inspektor7" name="inspektor7" data-trigger>
                                            <option value="" selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor4') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="inspektor5">Inspektor 8</label>
                                        <input type="text" id="inspektor8" name="inspektor8" class="form-control form-control-sm">
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
                                            <div class="upload-note">Opsional, isi jika ada dokumentasi tambahan.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiTempatBBC">Submit</button>
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

    const formInspeksiTempatBBC = document.getElementById('submitformInspeksiTempatBBC');
    const submitButtonInspeksiTempatBBC = document.getElementById('submitButtonInspeksiTempatBBC');

    formInspeksiTempatBBC.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiTempatBBC.disabled = true;
        submitButtonInspeksiTempatBBC.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiTempatBBC.disabled = false;
            submitButtonInspeksiTempatBBC.innerText = 'Submit';
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
