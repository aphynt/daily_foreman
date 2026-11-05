@include('layout.head', ['title' => 'Inspeksi Pengangkutan Lumpur'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Pengangkutan Lumpur</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.pengangkutanlumpur.post') }}" method="POST" id="submitformInspeksiPengangkutanLumpur" enctype="multipart/form-data">
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
                                        <select class="form-control form-control-sm pb-2" id="penanggungjawab" name="penanggungjawab" data-trigger required>
                                            <option selected disabled></option>
                                            @foreach ($users['penanggungjawab'] as $penanggungjawab)
                                                <option value="{{ $penanggungjawab->nik }}">{{ $penanggungjawab->name }} ({{ $penanggungjawab->nik }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                        <hr>
                                        <h5>A. PERSIAPAN & KESIAPAN AWAL</h5>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">1. Perizinan/komisioning KJA dari KIDECO sesuai rencana kerja tersedia</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_1_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_1_ya" name="persiapan_kja_1_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_1_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_1_tidak" name="persiapan_kja_1_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_1_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_1_na" name="persiapan_kja_1_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_1_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_1_action" name="persiapan_kja_1_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_1_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_1_due" name="persiapan_kja_1_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">2. Seluruh pekerja terlibat memiliki kartu izin kerja High Risk dari KIDECO</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_2_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_2_ya" name="persiapan_kja_2_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_2_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_2_tidak" name="persiapan_kja_2_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_2_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_2_na" name="persiapan_kja_2_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_2_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_2_action" name="persiapan_kja_2_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_2_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_2_due" name="persiapan_kja_2_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">3. Kajian teknis Geotechnical Engineering &amp; stage plan telah disepakati</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_3_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_3_ya" name="persiapan_kja_3_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_3_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_3_tidak" name="persiapan_kja_3_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_3_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_3_na" name="persiapan_kja_3_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_3_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_3_action" name="persiapan_kja_3_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_3_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_3_due" name="persiapan_kja_3_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">4. Form KKH operator terverifikasi, jam tidur minimal 6 jam</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_4_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_4_ya" name="persiapan_kja_4_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_4_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_4_tidak" name="persiapan_kja_4_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_4_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_4_na" name="persiapan_kja_4_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_4_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_4_action" name="persiapan_kja_4_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_4_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_4_due" name="persiapan_kja_4_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">5. Form KLKH dibuat pengawas pada awal shift</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_5_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_5_ya" name="persiapan_kja_5_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_5_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_5_tidak" name="persiapan_kja_5_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_5_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_5_na" name="persiapan_kja_5_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_5_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_5_action" name="persiapan_kja_5_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_5_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_5_due" name="persiapan_kja_5_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">6. P2H unit Excavator/HD dilakukan &amp; unit dinyatakan aman</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_6_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_6_ya" name="persiapan_kja_6_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_6_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_6_tidak" name="persiapan_kja_6_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_6_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_6_na" name="persiapan_kja_6_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_6_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_6_action" name="persiapan_kja_6_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_6_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_6_due" name="persiapan_kja_6_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">7. Sosialisasi prosedur, kajian teknis &amp; izin operasional dilakukan</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_7_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_7_ya" name="persiapan_kja_7_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_7_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_7_tidak" name="persiapan_kja_7_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_7_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_7_na" name="persiapan_kja_7_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_7_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_7_action" name="persiapan_kja_7_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_7_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_7_due" name="persiapan_kja_7_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">8. Penerangan area kerja 20–50 lux tersedia untuk shift malam</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_8_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_8_ya" name="persiapan_kja_8_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_8_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_8_tidak" name="persiapan_kja_8_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_8_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_8_na" name="persiapan_kja_8_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_8_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_8_action" name="persiapan_kja_8_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_8_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_8_due" name="persiapan_kja_8_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">9. Unit support (PC200/Bulldozer/Motor Grader) tersedia sesuai kebutuhan</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_9_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_9_ya" name="persiapan_kja_9_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_9_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_9_tidak" name="persiapan_kja_9_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_9_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_9_na" name="persiapan_kja_9_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_9_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_9_action" name="persiapan_kja_9_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_9_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_9_due" name="persiapan_kja_9_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">10. Peralatan darurat (life jacket, ring buoy, jalur evakuasi, radio) berfungsi</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="persiapan_kja_10_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_10_ya" name="persiapan_kja_10_check" value="Ya" required> Ya
                                                </label>
                                                <label for="persiapan_kja_10_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_10_tidak" name="persiapan_kja_10_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="persiapan_kja_10_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="persiapan_kja_10_na" name="persiapan_kja_10_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="persiapan_kja_10_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="persiapan_kja_10_action" name="persiapan_kja_10_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="persiapan_kja_10_due">Due Date</label>
                                                    <input type="date" id="persiapan_kja_10_due" name="persiapan_kja_10_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <h5>B. PENGAWASAN AREA KERJA</h5>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">11. Pengawas standby penuh, tidak meninggalkan lokasi tanpa izin/delegasi</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="pengawasan_area_1_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_1_ya" name="pengawasan_area_1_check" value="Ya" required> Ya
                                                </label>
                                                <label for="pengawasan_area_1_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_1_tidak" name="pengawasan_area_1_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="pengawasan_area_1_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_1_na" name="pengawasan_area_1_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="pengawasan_area_1_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="pengawasan_area_1_action" name="pengawasan_area_1_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="pengawasan_area_1_due">Due Date</label>
                                                    <input type="date" id="pengawasan_area_1_due" name="pengawasan_area_1_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">12. Pengawas memiliki kartu High Risk sesuai struktur yang diajukan</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="pengawasan_area_2_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_2_ya" name="pengawasan_area_2_check" value="Ya" required> Ya
                                                </label>
                                                <label for="pengawasan_area_2_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_2_tidak" name="pengawasan_area_2_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="pengawasan_area_2_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_2_na" name="pengawasan_area_2_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="pengawasan_area_2_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="pengawasan_area_2_action" name="pengawasan_area_2_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="pengawasan_area_2_due">Due Date</label>
                                                    <input type="date" id="pengawasan_area_2_due" name="pengawasan_area_2_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">13. Radio komunikasi pengawas-operator berfungsi efektif</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="pengawasan_area_3_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_3_ya" name="pengawasan_area_3_check" value="Ya" required> Ya
                                                </label>
                                                <label for="pengawasan_area_3_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_3_tidak" name="pengawasan_area_3_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="pengawasan_area_3_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_3_na" name="pengawasan_area_3_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="pengawasan_area_3_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="pengawasan_area_3_action" name="pengawasan_area_3_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="pengawasan_area_3_due">Due Date</label>
                                                    <input type="date" id="pengawasan_area_3_due" name="pengawasan_area_3_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">14. Tidak ditemukan crack/patahan di permukaan kerja loading point</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="pengawasan_area_4_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_4_ya" name="pengawasan_area_4_check" value="Ya" required> Ya
                                                </label>
                                                <label for="pengawasan_area_4_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_4_tidak" name="pengawasan_area_4_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="pengawasan_area_4_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_4_na" name="pengawasan_area_4_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="pengawasan_area_4_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="pengawasan_area_4_action" name="pengawasan_area_4_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="pengawasan_area_4_due">Due Date</label>
                                                    <input type="date" id="pengawasan_area_4_due" name="pengawasan_area_4_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">15. Area manuver HD luas &amp; radius unit tercukupi</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="pengawasan_area_5_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_5_ya" name="pengawasan_area_5_check" value="Ya" required> Ya
                                                </label>
                                                <label for="pengawasan_area_5_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_5_tidak" name="pengawasan_area_5_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="pengawasan_area_5_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_5_na" name="pengawasan_area_5_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="pengawasan_area_5_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="pengawasan_area_5_action" name="pengawasan_area_5_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="pengawasan_area_5_due">Due Date</label>
                                                    <input type="date" id="pengawasan_area_5_due" name="pengawasan_area_5_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">16. STOP aktivitas/kegiatan diterapkan bila ada crack, rembesan, lereng tidak stabil</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="pengawasan_area_6_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_6_ya" name="pengawasan_area_6_check" value="Ya" required> Ya
                                                </label>
                                                <label for="pengawasan_area_6_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_6_tidak" name="pengawasan_area_6_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="pengawasan_area_6_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="pengawasan_area_6_na" name="pengawasan_area_6_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="pengawasan_area_6_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="pengawasan_area_6_action" name="pengawasan_area_6_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="pengawasan_area_6_due">Due Date</label>
                                                    <input type="date" id="pengawasan_area_6_due" name="pengawasan_area_6_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <h5>C. LOADING POINT & PEMUATAN LUMPUR</h5>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">17. Ketinggian loading point maksimal 2 meter</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_1_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_1_ya" name="loading_lumpur_1_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_1_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_1_tidak" name="loading_lumpur_1_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_1_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_1_na" name="loading_lumpur_1_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_1_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_1_action" name="loading_lumpur_1_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_1_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_1_due" name="loading_lumpur_1_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">18. Lebar loading point minimal 1x turning radius unit terbesar</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_2_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_2_ya" name="loading_lumpur_2_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_2_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_2_tidak" name="loading_lumpur_2_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_2_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_2_na" name="loading_lumpur_2_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_2_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_2_action" name="loading_lumpur_2_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_2_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_2_due" name="loading_lumpur_2_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">19. Lebar dudukan excavator sesuai standar (HT1200 9,6 m / PC2000 11,8 m)</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_3_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_3_ya" name="loading_lumpur_3_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_3_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_3_tidak" name="loading_lumpur_3_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_3_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_3_na" name="loading_lumpur_3_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_3_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_3_action" name="loading_lumpur_3_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_3_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_3_due" name="loading_lumpur_3_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">20. Track excavator tegak lurus loading point &amp; posisi di atas alat angkut</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_4_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_4_ya" name="loading_lumpur_4_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_4_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_4_tidak" name="loading_lumpur_4_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_4_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_4_na" name="loading_lumpur_4_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_4_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_4_action" name="loading_lumpur_4_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_4_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_4_due" name="loading_lumpur_4_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">21. Swing bucket dilakukan pelan, tidak melewati kabin dump truck</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_5_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_5_ya" name="loading_lumpur_5_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_5_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_5_tidak" name="loading_lumpur_5_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_5_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_5_na" name="loading_lumpur_5_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_5_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_5_action" name="loading_lumpur_5_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_5_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_5_due" name="loading_lumpur_5_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">22. Jumlah bucket pengisian sesuai batas maksimal per tipe HD</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_6_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_6_ya" name="loading_lumpur_6_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_6_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_6_tidak" name="loading_lumpur_6_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_6_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_6_na" name="loading_lumpur_6_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_6_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_6_action" name="loading_lumpur_6_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_6_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_6_due" name="loading_lumpur_6_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">23. Volume &amp; payload lumpur tidak melebihi batas (CAT773 ≤35m³/56T; KOM785 ≤42m³/67T)</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_7_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_7_ya" name="loading_lumpur_7_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_7_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_7_tidak" name="loading_lumpur_7_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_7_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_7_na" name="loading_lumpur_7_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_7_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_7_action" name="loading_lumpur_7_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_7_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_7_due" name="loading_lumpur_7_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">24. Klakson dibunyikan sebagai tanda vessel telah terisi penuh</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_8_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_8_ya" name="loading_lumpur_8_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_8_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_8_tidak" name="loading_lumpur_8_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_8_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_8_na" name="loading_lumpur_8_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_8_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_8_action" name="loading_lumpur_8_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_8_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_8_due" name="loading_lumpur_8_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">25. Operator tidak keluar kabin selama proses pemuatan berlangsung</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="loading_lumpur_9_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_9_ya" name="loading_lumpur_9_check" value="Ya" required> Ya
                                                </label>
                                                <label for="loading_lumpur_9_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_9_tidak" name="loading_lumpur_9_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="loading_lumpur_9_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="loading_lumpur_9_na" name="loading_lumpur_9_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="loading_lumpur_9_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="loading_lumpur_9_action" name="loading_lumpur_9_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="loading_lumpur_9_due">Due Date</label>
                                                    <input type="date" id="loading_lumpur_9_due" name="loading_lumpur_9_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <h5>D. JALAN ANGKUT & DUMPING LUMPUR</h5>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">26. Grade jalan ≤10%, cross angle ≤27°, radius jalan ≥55 m</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_1_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_1_ya" name="jalan_dumping_1_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_1_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_1_tidak" name="jalan_dumping_1_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_1_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_1_na" name="jalan_dumping_1_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_1_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_1_action" name="jalan_dumping_1_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_1_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_1_due" name="jalan_dumping_1_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">27. Kecepatan unit diawasi, maksimal 35 km/jam</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_2_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_2_ya" name="jalan_dumping_2_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_2_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_2_tidak" name="jalan_dumping_2_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_2_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_2_na" name="jalan_dumping_2_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_2_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_2_action" name="jalan_dumping_2_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_2_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_2_due" name="jalan_dumping_2_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">28. Tanggul jalan sesuai standar (¾ tinggi ban terbesar, minimal 1 m)</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_3_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_3_ya" name="jalan_dumping_3_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_3_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_3_tidak" name="jalan_dumping_3_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_3_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_3_na" name="jalan_dumping_3_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_3_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_3_action" name="jalan_dumping_3_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_3_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_3_due" name="jalan_dumping_3_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">29. Rambu-rambu kegiatan lumpur terpasang lengkap di setiap simpangan</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_4_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_4_ya" name="jalan_dumping_4_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_4_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_4_tidak" name="jalan_dumping_4_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_4_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_4_na" name="jalan_dumping_4_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_4_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_4_action" name="jalan_dumping_4_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_4_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_4_due" name="jalan_dumping_4_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">30. Median pemisah lintasan keluar-masuk area dumping tersedia minimal 5 meter, tinggi 1 m</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_5_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_5_ya" name="jalan_dumping_5_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_5_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_5_tidak" name="jalan_dumping_5_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_5_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_5_na" name="jalan_dumping_5_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_5_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_5_action" name="jalan_dumping_5_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_5_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_5_due" name="jalan_dumping_5_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">31. Kecepatan dikurangi saat mendekati area dumping/mudcell</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_6_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_6_ya" name="jalan_dumping_6_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_6_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_6_tidak" name="jalan_dumping_6_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_6_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_6_na" name="jalan_dumping_6_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_6_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_6_action" name="jalan_dumping_6_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_6_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_6_due" name="jalan_dumping_6_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">32. Manuver dumping searah jarum jam, tidak terlalu patah</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_7_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_7_ya" name="jalan_dumping_7_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_7_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_7_tidak" name="jalan_dumping_7_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_7_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_7_na" name="jalan_dumping_7_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_7_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_7_action" name="jalan_dumping_7_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_7_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_7_due" name="jalan_dumping_7_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">33. Bendera arah dumping &amp; petugas pemandu digunakan saat mundur</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_8_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_8_ya" name="jalan_dumping_8_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_8_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_8_tidak" name="jalan_dumping_8_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_8_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_8_na" name="jalan_dumping_8_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_8_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_8_action" name="jalan_dumping_8_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_8_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_8_due" name="jalan_dumping_8_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">34. Vessel diangkat dan diturunkan secara perlahan</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_9_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_9_ya" name="jalan_dumping_9_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_9_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_9_tidak" name="jalan_dumping_9_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_9_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_9_na" name="jalan_dumping_9_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_9_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_9_action" name="jalan_dumping_9_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_9_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_9_due" name="jalan_dumping_9_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">35. Tanggul &amp; apron dumping terawat, unit support tersedia</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_10_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_10_ya" name="jalan_dumping_10_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_10_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_10_tidak" name="jalan_dumping_10_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_10_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_10_na" name="jalan_dumping_10_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_10_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_10_action" name="jalan_dumping_10_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_10_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_10_due" name="jalan_dumping_10_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">36. Kolam lumpur cair bertanggul, tinggi pengisian maksimal 1 meter</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="jalan_dumping_11_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_11_ya" name="jalan_dumping_11_check" value="Ya" required> Ya
                                                </label>
                                                <label for="jalan_dumping_11_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_11_tidak" name="jalan_dumping_11_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="jalan_dumping_11_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="jalan_dumping_11_na" name="jalan_dumping_11_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="jalan_dumping_11_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="jalan_dumping_11_action" name="jalan_dumping_11_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="jalan_dumping_11_due">Due Date</label>
                                                    <input type="date" id="jalan_dumping_11_due" name="jalan_dumping_11_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                        <h5>E. TANGGAP DARURAT & DOKUMENTASI</h5>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">37. Operator memahami prosedur darurat unit amblas/terbakar</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="tanggap_darurat_1_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_1_ya" name="tanggap_darurat_1_check" value="Ya" required> Ya
                                                </label>
                                                <label for="tanggap_darurat_1_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_1_tidak" name="tanggap_darurat_1_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="tanggap_darurat_1_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_1_na" name="tanggap_darurat_1_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="tanggap_darurat_1_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="tanggap_darurat_1_action" name="tanggap_darurat_1_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="tanggap_darurat_1_due">Due Date</label>
                                                    <input type="date" id="tanggap_darurat_1_due" name="tanggap_darurat_1_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">38. Nomor kontak darurat SCC SIMS &amp; Call Center KJA tersedia di unit</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="tanggap_darurat_2_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_2_ya" name="tanggap_darurat_2_check" value="Ya" required> Ya
                                                </label>
                                                <label for="tanggap_darurat_2_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_2_tidak" name="tanggap_darurat_2_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="tanggap_darurat_2_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_2_na" name="tanggap_darurat_2_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="tanggap_darurat_2_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="tanggap_darurat_2_action" name="tanggap_darurat_2_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="tanggap_darurat_2_due">Due Date</label>
                                                    <input type="date" id="tanggap_darurat_2_due" name="tanggap_darurat_2_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">39. Dokumen KKH, KLKH, Inspeksi Berkala &amp; Buku Tamu HR terisi lengkap</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="tanggap_darurat_3_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_3_ya" name="tanggap_darurat_3_check" value="Ya" required> Ya
                                                </label>
                                                <label for="tanggap_darurat_3_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_3_tidak" name="tanggap_darurat_3_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="tanggap_darurat_3_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_3_na" name="tanggap_darurat_3_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="tanggap_darurat_3_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="tanggap_darurat_3_action" name="tanggap_darurat_3_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="tanggap_darurat_3_due">Due Date</label>
                                                    <input type="date" id="tanggap_darurat_3_due" name="tanggap_darurat_3_due" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="fw-semibold">40. Checklist commissioning loading/dumping lumpur tersedia</label>
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <label for="tanggap_darurat_4_ya" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_4_ya" name="tanggap_darurat_4_check" value="Ya" required> Ya
                                                </label>
                                                <label for="tanggap_darurat_4_tidak" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_4_tidak" name="tanggap_darurat_4_check" value="Tidak"> Tidak
                                                </label>
                                                <label for="tanggap_darurat_4_na" class="me-3 px-2 py-2">
                                                    <input type="radio" id="tanggap_darurat_4_na" name="tanggap_darurat_4_check" value="N/A"> N/A
                                                </label>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-8">
                                                    <label for="tanggap_darurat_4_action">Tindak Lanjut Perbaikan</label>
                                                    <input type="text" id="tanggap_darurat_4_action" name="tanggap_darurat_4_action" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-12 col-md-4 mt-2 mt-md-0">
                                                    <label for="tanggap_darurat_4_due">Due Date</label>
                                                    <input type="date" id="tanggap_darurat_4_due" name="tanggap_darurat_4_due" class="form-control form-control-sm">
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
                                            <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiPengangkutanLumpur">Submit</button>
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

    const formInspeksiPengangkutanLumpur = document.getElementById('submitformInspeksiPengangkutanLumpur');
    const submitButtonInspeksiPengangkutanLumpur = document.getElementById('submitButtonInspeksiPengangkutanLumpur');

    formInspeksiPengangkutanLumpur.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiPengangkutanLumpur.disabled = true;
        submitButtonInspeksiPengangkutanLumpur.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiPengangkutanLumpur.disabled = false;
            submitButtonInspeksiPengangkutanLumpur.innerText = 'Submit';
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
