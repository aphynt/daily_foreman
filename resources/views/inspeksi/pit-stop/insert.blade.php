@include('layout.head', ['title' => 'Inspeksi Pit Stop'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Pit Stop</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.pitstop.post') }}" method="POST" id="submitformInspeksiPitStop" enctype="multipart/form-data">
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
                                <h5>A. HOUSEKEEPING</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">1. Apakah area kerja dalam keadaan bersih, rapi dan teratur dan terdapat tempat sampah sesuai jenisnya?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_1_ya" name="housekeeping_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="housekeeping_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_1_tidak" name="housekeeping_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="housekeeping_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_1_na" name="housekeeping_1_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">2. Apakah kondisi lantai bengkel tidak berlubang/rusak?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_2_ya" name="housekeeping_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="housekeeping_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_2_tidak" name="housekeeping_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="housekeeping_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_2_na" name="housekeeping_2_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">3. Apakah meja kerja sudah rapi dari peralatan dan barang-barang lainnya?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_3_ya" name="housekeeping_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="housekeeping_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_3_tidak" name="housekeeping_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="housekeeping_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_3_na" name="housekeeping_3_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">4. Apakah jalur jalan dan lintasan bebas dari gangguan/hambatan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_4_ya" name="housekeeping_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="housekeeping_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_4_tidak" name="housekeeping_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="housekeeping_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_4_na" name="housekeeping_4_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">5. Apakah penerangan termasuk lampu dan bola lampu dalam keadaan bersih dan berfungsi?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_5_ya" name="housekeeping_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="housekeeping_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_5_tidak" name="housekeeping_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="housekeeping_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_5_na" name="housekeeping_5_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">6. Apakah permukaan halaman rata (tidak bergelombang dan becek) dan bersih dari sampah?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="housekeeping_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_6_ya" name="housekeeping_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="housekeeping_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_6_tidak" name="housekeeping_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="housekeeping_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="housekeeping_6_na" name="housekeeping_6_check" value="N/A"> N/A
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
                                <hr>
                                <h5>B. TABUNG BERTEKANAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">7. Apakah tabung bertekanan diletakkan dalam posisi yang benar?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tabung_bertekanan_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_1_ya" name="tabung_bertekanan_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tabung_bertekanan_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_1_tidak" name="tabung_bertekanan_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tabung_bertekanan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_1_na" name="tabung_bertekanan_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tabung_bertekanan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tabung_bertekanan_1_action" name="tabung_bertekanan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tabung_bertekanan_1_due">Due Date</label>
                                            <input type="date" id="tabung_bertekanan_1_due" name="tabung_bertekanan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">8. Apakah tabung gas kosong/berisi pada posisi aman (terikat) dan terdapat penutup besi (cap)?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tabung_bertekanan_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_2_ya" name="tabung_bertekanan_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tabung_bertekanan_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_2_tidak" name="tabung_bertekanan_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tabung_bertekanan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_2_na" name="tabung_bertekanan_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tabung_bertekanan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tabung_bertekanan_2_action" name="tabung_bertekanan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tabung_bertekanan_2_due">Due Date</label>
                                            <input type="date" id="tabung_bertekanan_2_due" name="tabung_bertekanan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">9. Apakah regulator indikator berfungsi dengan baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tabung_bertekanan_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_3_ya" name="tabung_bertekanan_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tabung_bertekanan_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_3_tidak" name="tabung_bertekanan_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tabung_bertekanan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_3_na" name="tabung_bertekanan_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tabung_bertekanan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tabung_bertekanan_3_action" name="tabung_bertekanan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tabung_bertekanan_3_due">Due Date</label>
                                            <input type="date" id="tabung_bertekanan_3_due" name="tabung_bertekanan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">10. Apakah labelling dan warna tabung maupun pelengkapnya jelas/tidak pudar?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tabung_bertekanan_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_4_ya" name="tabung_bertekanan_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tabung_bertekanan_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_4_tidak" name="tabung_bertekanan_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tabung_bertekanan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_4_na" name="tabung_bertekanan_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tabung_bertekanan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tabung_bertekanan_4_action" name="tabung_bertekanan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tabung_bertekanan_4_due">Due Date</label>
                                            <input type="date" id="tabung_bertekanan_4_due" name="tabung_bertekanan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">11. Apakah braket/tempat penyimpanan tabung bertekanan mencukupi dan memadai?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tabung_bertekanan_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_5_ya" name="tabung_bertekanan_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tabung_bertekanan_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_5_tidak" name="tabung_bertekanan_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tabung_bertekanan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_5_na" name="tabung_bertekanan_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tabung_bertekanan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tabung_bertekanan_5_action" name="tabung_bertekanan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tabung_bertekanan_5_due">Due Date</label>
                                            <input type="date" id="tabung_bertekanan_5_due" name="tabung_bertekanan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">12. Apakah tempat penyimpanan tabung bertekanan (bila ada) sudah rapi dan tidak ada tabung bertekanan berserakan?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tabung_bertekanan_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_6_ya" name="tabung_bertekanan_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tabung_bertekanan_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_6_tidak" name="tabung_bertekanan_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tabung_bertekanan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tabung_bertekanan_6_na" name="tabung_bertekanan_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tabung_bertekanan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tabung_bertekanan_6_action" name="tabung_bertekanan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tabung_bertekanan_6_due">Due Date</label>
                                            <input type="date" id="tabung_bertekanan_6_due" name="tabung_bertekanan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>C. EMERGENCY EQUIPMENT</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">13. Apakah APAR mencukupi untuk suatu area, terdapat tanda (marking) dan tidak terhalang?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_1_ya" name="emergency_equipment_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_1_tidak" name="emergency_equipment_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_1_na" name="emergency_equipment_1_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">14. Apakah kondisi tabung APAR tidak rusak?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_2_ya" name="emergency_equipment_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_2_tidak" name="emergency_equipment_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_2_na" name="emergency_equipment_2_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">15. Apakah akses ke alat pemadam kebakaran tidak terhalangi?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_3_ya" name="emergency_equipment_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_3_tidak" name="emergency_equipment_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_3_na" name="emergency_equipment_3_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">16. Apakah APAR diinspeksi secara rutin dan terdapat tag?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_4_ya" name="emergency_equipment_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_4_tidak" name="emergency_equipment_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_4_na" name="emergency_equipment_4_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">17. Apakah hidran untuk kebakaran (bila ada) dan perlengkapannya dalam keadaan baik?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_5_ya" name="emergency_equipment_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_5_tidak" name="emergency_equipment_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_5_na" name="emergency_equipment_5_check" value="N/A"> N/A
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
                                <div class="mb-3">
                                    <label class="fw-semibold">18. Apakah tempat pencucian mata dalam kondisi bersih?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_6_ya" name="emergency_equipment_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_6_tidak" name="emergency_equipment_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_6_na" name="emergency_equipment_6_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">19. Apakah air eyewash diganti secara teratur?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_7_ya" name="emergency_equipment_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_7_tidak" name="emergency_equipment_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_7_na" name="emergency_equipment_7_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">20. Apakah tempat pencucian mata berfungsi dengan baik dan tidak terhalang?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_8_ya" name="emergency_equipment_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_8_tidak" name="emergency_equipment_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_8_na" name="emergency_equipment_8_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">21. Apakah akses ke tempat pencucian mata tidak terhalangi?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_9_ya" name="emergency_equipment_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_9_tidak" name="emergency_equipment_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_9_na" name="emergency_equipment_9_check" value="N/A"> N/A
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
                                <div class="mb-3">
                                    <label class="fw-semibold">22. Apakah kotak P3K berada di tempat yang mudah ditemukan dan diberi sign?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_10_ya" name="emergency_equipment_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_10_tidak" name="emergency_equipment_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_10_na" name="emergency_equipment_10_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">23. Apakah kotak P3K memiliki isi yang lengkap?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_11_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_11_ya" name="emergency_equipment_11_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_11_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_11_tidak" name="emergency_equipment_11_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_11_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_11_na" name="emergency_equipment_11_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">24. Apakah kotak P3K diinspeksi dengan rutin?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_12_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_12_ya" name="emergency_equipment_12_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_12_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_12_tidak" name="emergency_equipment_12_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_12_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_12_na" name="emergency_equipment_12_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">25. Apakah kotak P3K memiliki pencatatan pemakaian?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_13_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_13_ya" name="emergency_equipment_13_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_13_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_13_tidak" name="emergency_equipment_13_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_13_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_13_na" name="emergency_equipment_13_check" value="N/A"> N/A
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
                                <div class="mb-3">
                                    <label class="fw-semibold">26. Apakah ada peta/layout area berkumpul darurat?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_14_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_14_ya" name="emergency_equipment_14_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_14_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_14_tidak" name="emergency_equipment_14_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_14_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_14_na" name="emergency_equipment_14_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_14_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_14_action" name="emergency_equipment_14_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_14_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_14_due" name="emergency_equipment_14_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">27. Apakah area berkumpul darurat ditandai dengan jelas?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="emergency_equipment_15_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_15_ya" name="emergency_equipment_15_check" value="Ya" required> Ya
                                        </label>
                                        <label for="emergency_equipment_15_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_15_tidak" name="emergency_equipment_15_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="emergency_equipment_15_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="emergency_equipment_15_na" name="emergency_equipment_15_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="emergency_equipment_15_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="emergency_equipment_15_action" name="emergency_equipment_15_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="emergency_equipment_15_due">Due Date</label>
                                            <input type="date" id="emergency_equipment_15_due" name="emergency_equipment_15_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>D. RAMBU-RAMBU</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">28. Apakah ada rambu pemakaian “APD Standard”?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_1_ya" name="rambu_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_1_tidak" name="rambu_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_1_na" name="rambu_1_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">29. Apakah ada rambu “Dilarang Merokok” untuk area yang berpotensi terjadi kebakaran?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_2_ya" name="rambu_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_2_tidak" name="rambu_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_2_na" name="rambu_2_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">30. Apakah ada rambu penempatan “Tabung Pemadam Kebakaran”?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_3_ya" name="rambu_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_3_tidak" name="rambu_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_3_na" name="rambu_3_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">31. Apakah ada rambu penempatan “Eye wash”?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_4_ya" name="rambu_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_4_tidak" name="rambu_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_4_na" name="rambu_4_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">32. Apakah chemical sign terpasang pada tempat penyimpanan bahan kimia?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_5_ya" name="rambu_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_5_tidak" name="rambu_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_5_na" name="rambu_5_check" value="N/A"> N/A
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
                                <div class="mb-3">
                                    <label class="fw-semibold">33. Apakah ada tanda-tanda jalur keluar darurat?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_6_ya" name="rambu_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_6_tidak" name="rambu_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_6_na" name="rambu_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_6_action" name="rambu_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_6_due">Due Date</label>
                                            <input type="date" id="rambu_6_due" name="rambu_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">34. Apakah ada rambu tempat berkumpul darurat dan terlihat jelas?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_7_ya" name="rambu_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_7_tidak" name="rambu_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_7_na" name="rambu_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_7_action" name="rambu_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_7_due">Due Date</label>
                                            <input type="date" id="rambu_7_due" name="rambu_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">35. Apakah Emergency Flow Chart tersedia?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_8_ya" name="rambu_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_8_tidak" name="rambu_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_8_na" name="rambu_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_8_action" name="rambu_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_8_due">Due Date</label>
                                            <input type="date" id="rambu_8_due" name="rambu_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">36. Apakah Kebijakan KPLH dipasang di papan pengumuman?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_9_ya" name="rambu_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_9_tidak" name="rambu_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_9_na" name="rambu_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_9_action" name="rambu_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_9_due">Due Date</label>
                                            <input type="date" id="rambu_9_due" name="rambu_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">37. Apakah ada rambu lainnya (Stop, Giveway, Arah, Batas Kecepatan, Parkir/Larangan Parkir)?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="rambu_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_10_ya" name="rambu_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="rambu_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_10_tidak" name="rambu_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="rambu_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="rambu_10_na" name="rambu_10_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="rambu_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="rambu_10_action" name="rambu_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="rambu_10_due">Due Date</label>
                                            <input type="date" id="rambu_10_due" name="rambu_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>E. PENGELOLAAN SAMPAH DAN HIDROKARBON</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">38. Apakah terdapat ceceran hidrokarbon di tanah?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_1_ya" name="sampah_hidrokarbon_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_1_tidak" name="sampah_hidrokarbon_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_1_na" name="sampah_hidrokarbon_1_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">39. Apakah tersedia tempat sampah/limbah dan penampungan tumpahan oli?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_2_ya" name="sampah_hidrokarbon_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_2_tidak" name="sampah_hidrokarbon_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_2_na" name="sampah_hidrokarbon_2_check" value="N/A"> N/A
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
                                    <label class="fw-semibold">40. Apakah tempat pembuangan sampah/limbah sudah diberi nama dan tanda yang benar dan cukup?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_3_ya" name="sampah_hidrokarbon_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_3_tidak" name="sampah_hidrokarbon_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_3_na" name="sampah_hidrokarbon_3_check" value="N/A"> N/A
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
                                <div class="mb-3">
                                    <label class="fw-semibold">41. Apakah limbah besi, domestik dan limbah beroli (filter oli, majun, dll.) diletakkan pada tempat yang sesuai?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_4_ya" name="sampah_hidrokarbon_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_4_tidak" name="sampah_hidrokarbon_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_4_na" name="sampah_hidrokarbon_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_4_action" name="sampah_hidrokarbon_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_4_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_4_due" name="sampah_hidrokarbon_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">42. Apakah terdapat bahan hidrokarbon yang diletakkan di luar area berbunding?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_5_ya" name="sampah_hidrokarbon_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_5_tidak" name="sampah_hidrokarbon_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_5_na" name="sampah_hidrokarbon_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_5_action" name="sampah_hidrokarbon_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_5_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_5_due" name="sampah_hidrokarbon_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">43. Apakah terdapat emergency spill kit di workshop?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_6_ya" name="sampah_hidrokarbon_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_6_tidak" name="sampah_hidrokarbon_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_6_na" name="sampah_hidrokarbon_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_6_action" name="sampah_hidrokarbon_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_6_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_6_due" name="sampah_hidrokarbon_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">44. Apakah terdapat kebocoran pada fasilitas penyimpanan hidrokarbon?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_7_ya" name="sampah_hidrokarbon_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_7_tidak" name="sampah_hidrokarbon_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_7_na" name="sampah_hidrokarbon_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_7_action" name="sampah_hidrokarbon_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_7_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_7_due" name="sampah_hidrokarbon_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">45. Apakah ada kebocoran pada fasilitas pompa, perpipaan dan hose?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_8_ya" name="sampah_hidrokarbon_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_8_tidak" name="sampah_hidrokarbon_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_8_na" name="sampah_hidrokarbon_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_8_action" name="sampah_hidrokarbon_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_8_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_8_due" name="sampah_hidrokarbon_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">46. Apakah valve pembuangan selalu tertutup?</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sampah_hidrokarbon_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_9_ya" name="sampah_hidrokarbon_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sampah_hidrokarbon_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_9_tidak" name="sampah_hidrokarbon_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sampah_hidrokarbon_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sampah_hidrokarbon_9_na" name="sampah_hidrokarbon_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sampah_hidrokarbon_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sampah_hidrokarbon_9_action" name="sampah_hidrokarbon_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sampah_hidrokarbon_9_due">Due Date</label>
                                            <input type="date" id="sampah_hidrokarbon_9_due" name="sampah_hidrokarbon_9_due" class="form-control form-control-sm">
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
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor5') == $inspektor->nik ? 'selected' : '' }}>
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
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor6') == $inspektor->nik ? 'selected' : '' }}>
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
                                                <option value="{{ $inspektor->nik }}" {{ old('inspektor7') == $inspektor->nik ? 'selected' : '' }}>
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiPitStop">Submit</button>
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

    const formInspeksiPitStop = document.getElementById('submitformInspeksiPitStop');
    const submitButtonInspeksiPitStop = document.getElementById('submitButtonInspeksiPitStop');

    formInspeksiPitStop.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiPitStop.disabled = true;
        submitButtonInspeksiPitStop.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiPitStop.disabled = false;
            submitButtonInspeksiPitStop.innerText = 'Submit';
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
