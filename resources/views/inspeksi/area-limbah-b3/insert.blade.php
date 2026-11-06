@include('layout.head', ['title' => 'Inspeksi Tempat Penyimpanan Sementara Limbah B3 (TPS LB3)'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Tempat Penyimpanan Sementara Limbah B3 (TPS LB3)</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.arealimbahb3.post') }}" method="POST" id="submitformInspeksiAreaLimbahB3" enctype="multipart/form-data">
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
                                <h5>A. PERIZINAN DAN ADMINISTRASI</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">1. TPS LB3 tercantum dalam Rincian Teknis Penyimpanan Limbah B3 pada Persetujuan Lingkungan yang masih berlaku</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_1_ya" name="perizinan_administrasi_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_1_tidak" name="perizinan_administrasi_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_1_na" name="perizinan_administrasi_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_1_action" name="perizinan_administrasi_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_1_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_1_due" name="perizinan_administrasi_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">2. Terdapat SOP penyimpanan LB3 dan prosedur tanggap darurat yang tersedia/terpasang di TPS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_2_ya" name="perizinan_administrasi_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_2_tidak" name="perizinan_administrasi_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_2_na" name="perizinan_administrasi_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_2_action" name="perizinan_administrasi_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_2_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_2_due" name="perizinan_administrasi_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">3. Logbook keluar-masuk LB3 tersedia dan diisi terkini (tanggal, jenis, kode, sumber, jumlah, tujuan)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_3_ya" name="perizinan_administrasi_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_3_tidak" name="perizinan_administrasi_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_3_na" name="perizinan_administrasi_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_3_action" name="perizinan_administrasi_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_3_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_3_due" name="perizinan_administrasi_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">4. Neraca Limbah B3 dibuat dan diperbarui secara berkala</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_4_ya" name="perizinan_administrasi_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_4_tidak" name="perizinan_administrasi_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_4_na" name="perizinan_administrasi_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_4_action" name="perizinan_administrasi_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_4_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_4_due" name="perizinan_administrasi_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">5. Lama penyimpanan LB3 tidak melebihi batas waktu (90 / 180 / 365 hari sesuai jumlah timbulan &amp; kategori)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_5_ya" name="perizinan_administrasi_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_5_tidak" name="perizinan_administrasi_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_5_na" name="perizinan_administrasi_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_5_action" name="perizinan_administrasi_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_5_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_5_due" name="perizinan_administrasi_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">6. Setiap pengiriman LB3 dilengkapi manifest elektronik (Festronik)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_6_ya" name="perizinan_administrasi_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_6_tidak" name="perizinan_administrasi_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_6_na" name="perizinan_administrasi_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_6_action" name="perizinan_administrasi_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_6_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_6_due" name="perizinan_administrasi_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">7. Pengangkut dan pengolah/pemanfaat LB3 memiliki izin/persetujuan yang masih berlaku</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_7_ya" name="perizinan_administrasi_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_7_tidak" name="perizinan_administrasi_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_7_na" name="perizinan_administrasi_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_7_action" name="perizinan_administrasi_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_7_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_7_due" name="perizinan_administrasi_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">8. Lembar Data Keselamatan (SDS/MSDS) untuk LB3 yang disimpan tersedia di TPS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_8_ya" name="perizinan_administrasi_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_8_tidak" name="perizinan_administrasi_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_8_na" name="perizinan_administrasi_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_8_action" name="perizinan_administrasi_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_8_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_8_due" name="perizinan_administrasi_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">9. Petugas/PJA TPS telah mendapatkan pelatihan pengelolaan LB3 dan tanggap darurat</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_9_ya" name="perizinan_administrasi_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_9_tidak" name="perizinan_administrasi_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_9_na" name="perizinan_administrasi_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_9_action" name="perizinan_administrasi_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_9_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_9_due" name="perizinan_administrasi_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">10. Laporan pengelolaan LB3 disampaikan secara berkala kepada instansi berwenang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="perizinan_administrasi_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_10_ya" name="perizinan_administrasi_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="perizinan_administrasi_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_10_tidak" name="perizinan_administrasi_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="perizinan_administrasi_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="perizinan_administrasi_10_na" name="perizinan_administrasi_10_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="perizinan_administrasi_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="perizinan_administrasi_10_action" name="perizinan_administrasi_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="perizinan_administrasi_10_due">Due Date</label>
                                            <input type="date" id="perizinan_administrasi_10_due" name="perizinan_administrasi_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>B. LOKASI DAN KONSTRUKSI BANGUNAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">11. Lokasi TPS bebas banjir dan tidak rawan bencana alam (atau telah direkayasa secara teknis)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_1_ya" name="lokasi_konstruksi_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_1_tidak" name="lokasi_konstruksi_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_1_na" name="lokasi_konstruksi_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_1_action" name="lokasi_konstruksi_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_1_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_1_due" name="lokasi_konstruksi_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">12. Lokasi TPS berjarak aman dari sumber air, area hauling/alat berat, dan sumber api</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_2_ya" name="lokasi_konstruksi_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_2_tidak" name="lokasi_konstruksi_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_2_na" name="lokasi_konstruksi_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_2_action" name="lokasi_konstruksi_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_2_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_2_due" name="lokasi_konstruksi_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">13. Bangunan beratap, mampu melindungi LB3 dari air hujan dan sinar matahari langsung</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_3_ya" name="lokasi_konstruksi_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_3_tidak" name="lokasi_konstruksi_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_3_na" name="lokasi_konstruksi_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_3_action" name="lokasi_konstruksi_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_3_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_3_due" name="lokasi_konstruksi_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">14. Lantai kedap air, tidak retak/berlubang, dan bebas genangan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_4_ya" name="lokasi_konstruksi_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_4_tidak" name="lokasi_konstruksi_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_4_na" name="lokasi_konstruksi_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_4_action" name="lokasi_konstruksi_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_4_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_4_due" name="lokasi_konstruksi_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">15. Lantai dibuat landai mengarah ke saluran/bak penampung ceceran</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_5_ya" name="lokasi_konstruksi_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_5_tidak" name="lokasi_konstruksi_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_5_na" name="lokasi_konstruksi_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_5_action" name="lokasi_konstruksi_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_5_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_5_due" name="lokasi_konstruksi_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">16. Terdapat tanggul/kanstin di pintu masuk untuk mencegah ceceran keluar dan air hujan masuk</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_6_ya" name="lokasi_konstruksi_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_6_tidak" name="lokasi_konstruksi_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_6_na" name="lokasi_konstruksi_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_6_action" name="lokasi_konstruksi_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_6_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_6_due" name="lokasi_konstruksi_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">17. Saluran ceceran dan bak penampung (sump) tersedia, tidak tersumbat, terpisah dari drainase air hujan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_7_ya" name="lokasi_konstruksi_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_7_tidak" name="lokasi_konstruksi_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_7_na" name="lokasi_konstruksi_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_7_action" name="lokasi_konstruksi_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_7_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_7_due" name="lokasi_konstruksi_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">18. Secondary containment/bund untuk LB3 cair berkapasitas ≥ 110% volume kemasan/tangki terbesar</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_8_ya" name="lokasi_konstruksi_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_8_tidak" name="lokasi_konstruksi_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_8_na" name="lokasi_konstruksi_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_8_action" name="lokasi_konstruksi_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_8_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_8_due" name="lokasi_konstruksi_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">19. Dinding/pagar pembatas kokoh dan mencegah akses pihak yang tidak berwenang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_9_ya" name="lokasi_konstruksi_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_9_tidak" name="lokasi_konstruksi_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_9_na" name="lokasi_konstruksi_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_9_action" name="lokasi_konstruksi_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_9_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_9_due" name="lokasi_konstruksi_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">20. Ventilasi udara memadai dan dilengkapi kasa/jaring pencegah masuknya binatang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_10_ya" name="lokasi_konstruksi_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_10_tidak" name="lokasi_konstruksi_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_10_na" name="lokasi_konstruksi_10_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_10_action" name="lokasi_konstruksi_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_10_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_10_due" name="lokasi_konstruksi_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">21. Pencahayaan memadai; instalasi listrik aman (explosion proof untuk ruang LB3 mudah menyala)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_11_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_11_ya" name="lokasi_konstruksi_11_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_11_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_11_tidak" name="lokasi_konstruksi_11_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_11_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_11_na" name="lokasi_konstruksi_11_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_11_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_11_action" name="lokasi_konstruksi_11_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_11_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_11_due" name="lokasi_konstruksi_11_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">22. Pintu TPS dapat dikunci dan kunci dipegang oleh petugas yang ditunjuk</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_12_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_12_ya" name="lokasi_konstruksi_12_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_12_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_12_tidak" name="lokasi_konstruksi_12_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_12_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_12_na" name="lokasi_konstruksi_12_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_12_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_12_action" name="lokasi_konstruksi_12_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_12_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_12_due" name="lokasi_konstruksi_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">23. Akses bongkar muat (ramp/jalan) aman, bebas hambatan, dan lebarnya memadai untuk forklift/unit</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lokasi_konstruksi_13_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_13_ya" name="lokasi_konstruksi_13_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lokasi_konstruksi_13_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_13_tidak" name="lokasi_konstruksi_13_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lokasi_konstruksi_13_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lokasi_konstruksi_13_na" name="lokasi_konstruksi_13_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lokasi_konstruksi_13_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lokasi_konstruksi_13_action" name="lokasi_konstruksi_13_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lokasi_konstruksi_13_due">Due Date</label>
                                            <input type="date" id="lokasi_konstruksi_13_due" name="lokasi_konstruksi_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>C. PENGEMASAN, PENYIMPANAN DAN SEGREGASI</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">24. LB3 disimpan terpisah per jenis/karakteristik dalam blok/ruang yang ditentukan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_1_ya" name="pengemasan_penyimpanan_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_1_tidak" name="pengemasan_penyimpanan_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_1_na" name="pengemasan_penyimpanan_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_1_action" name="pengemasan_penyimpanan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_1_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_1_due" name="pengemasan_penyimpanan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">25. LB3 yang tidak saling sesuai (incompatible) tidak disimpan berdekatan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_2_ya" name="pengemasan_penyimpanan_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_2_tidak" name="pengemasan_penyimpanan_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_2_na" name="pengemasan_penyimpanan_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_2_action" name="pengemasan_penyimpanan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_2_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_2_due" name="pengemasan_penyimpanan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">26. Kemasan dalam kondisi baik: tidak bocor, tidak berkarat, tidak rusak, dan tertutup rapat</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_3_ya" name="pengemasan_penyimpanan_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_3_tidak" name="pengemasan_penyimpanan_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_3_na" name="pengemasan_penyimpanan_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_3_action" name="pengemasan_penyimpanan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_3_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_3_due" name="pengemasan_penyimpanan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">27. Bahan kemasan sesuai (kompatibel) dengan karakteristik LB3 yang disimpan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_4_ya" name="pengemasan_penyimpanan_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_4_tidak" name="pengemasan_penyimpanan_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_4_na" name="pengemasan_penyimpanan_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_4_action" name="pengemasan_penyimpanan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_4_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_4_due" name="pengemasan_penyimpanan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">28. Kemasan diletakkan di atas palet, tidak langsung bersentuhan dengan lantai</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_5_ya" name="pengemasan_penyimpanan_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_5_tidak" name="pengemasan_penyimpanan_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_5_na" name="pengemasan_penyimpanan_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_5_action" name="pengemasan_penyimpanan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_5_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_5_due" name="pengemasan_penyimpanan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">29. Tumpukan kemasan stabil dan tidak melebihi 3 (tiga) lapis</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_6_ya" name="pengemasan_penyimpanan_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_6_tidak" name="pengemasan_penyimpanan_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_6_na" name="pengemasan_penyimpanan_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_6_action" name="pengemasan_penyimpanan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_6_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_6_due" name="pengemasan_penyimpanan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">30. Jarak antar blok/lorong ± 60 cm untuk akses inspeksi dan penanganan darurat</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_7_ya" name="pengemasan_penyimpanan_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_7_tidak" name="pengemasan_penyimpanan_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_7_na" name="pengemasan_penyimpanan_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_7_action" name="pengemasan_penyimpanan_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_7_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_7_due" name="pengemasan_penyimpanan_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">31. Kemasan LB3 cair tidak diisi penuh (disisakan ruang ± 10%)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_8_ya" name="pengemasan_penyimpanan_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_8_tidak" name="pengemasan_penyimpanan_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_8_na" name="pengemasan_penyimpanan_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_8_action" name="pengemasan_penyimpanan_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_8_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_8_due" name="pengemasan_penyimpanan_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">32. Aki bekas disimpan tegak di atas wadah/alas tahan asam</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_9_ya" name="pengemasan_penyimpanan_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_9_tidak" name="pengemasan_penyimpanan_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_9_na" name="pengemasan_penyimpanan_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_9_action" name="pengemasan_penyimpanan_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_9_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_9_due" name="pengemasan_penyimpanan_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">33. Tangki oli bekas (bila ada) dalam kondisi baik, tidak bocor, dan dilengkapi indikator level</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_10_ya" name="pengemasan_penyimpanan_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_10_tidak" name="pengemasan_penyimpanan_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_10_na" name="pengemasan_penyimpanan_10_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_10_action" name="pengemasan_penyimpanan_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_10_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_10_due" name="pengemasan_penyimpanan_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">34. Tidak terdapat ceceran/tumpahan LB3 di lantai, saluran, maupun di luar TPS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_11_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_11_ya" name="pengemasan_penyimpanan_11_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_11_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_11_tidak" name="pengemasan_penyimpanan_11_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_11_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_11_na" name="pengemasan_penyimpanan_11_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_11_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_11_action" name="pengemasan_penyimpanan_11_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_11_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_11_due" name="pengemasan_penyimpanan_11_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">35. Tidak terdapat sampah domestik/limbah non-B3 yang dicampur di dalam TPS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_12_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_12_ya" name="pengemasan_penyimpanan_12_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_12_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_12_tidak" name="pengemasan_penyimpanan_12_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_12_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_12_na" name="pengemasan_penyimpanan_12_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_12_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_12_action" name="pengemasan_penyimpanan_12_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_12_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_12_due" name="pengemasan_penyimpanan_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">36. Volume LB3 yang disimpan tidak melebihi kapasitas desain TPS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="pengemasan_penyimpanan_13_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_13_ya" name="pengemasan_penyimpanan_13_check" value="Ya" required> Ya
                                        </label>
                                        <label for="pengemasan_penyimpanan_13_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_13_tidak" name="pengemasan_penyimpanan_13_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="pengemasan_penyimpanan_13_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="pengemasan_penyimpanan_13_na" name="pengemasan_penyimpanan_13_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pengemasan_penyimpanan_13_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pengemasan_penyimpanan_13_action" name="pengemasan_penyimpanan_13_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pengemasan_penyimpanan_13_due">Due Date</label>
                                            <input type="date" id="pengemasan_penyimpanan_13_due" name="pengemasan_penyimpanan_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>D. SIMBOL, LABEL DAN RAMBU</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">37. Terdapat papan nama TPS LB3 serta nama &amp; kontak Penanggung Jawab Area (PJA)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_1_ya" name="simbol_label_rambu_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_1_tidak" name="simbol_label_rambu_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_1_na" name="simbol_label_rambu_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_1_action" name="simbol_label_rambu_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_1_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_1_due" name="simbol_label_rambu_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">38. Simbol LB3 sesuai karakteristik terpasang pada pintu/dinding tiap ruang/blok (min. 25 x 25 cm)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_2_ya" name="simbol_label_rambu_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_2_tidak" name="simbol_label_rambu_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_2_na" name="simbol_label_rambu_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_2_action" name="simbol_label_rambu_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_2_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_2_due" name="simbol_label_rambu_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">39. Simbol LB3 sesuai karakteristik terpasang pada setiap kemasan (min. 10 x 10 cm), jelas dan utuh</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_3_ya" name="simbol_label_rambu_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_3_tidak" name="simbol_label_rambu_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_3_na" name="simbol_label_rambu_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_3_action" name="simbol_label_rambu_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_3_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_3_due" name="simbol_label_rambu_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">40. Label identitas LB3 terpasang pada setiap kemasan (penghasil, jenis, kode LB3, tanggal, jumlah)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_4_ya" name="simbol_label_rambu_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_4_tidak" name="simbol_label_rambu_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_4_na" name="simbol_label_rambu_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_4_action" name="simbol_label_rambu_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_4_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_4_due" name="simbol_label_rambu_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">41. Label penanda posisi tutup kemasan terpasang dan sesuai</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_5_ya" name="simbol_label_rambu_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_5_tidak" name="simbol_label_rambu_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_5_na" name="simbol_label_rambu_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_5_action" name="simbol_label_rambu_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_5_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_5_due" name="simbol_label_rambu_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">42. Terdapat rambu DILARANG MEROKOK / DILARANG MEMBAWA API</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_6_ya" name="simbol_label_rambu_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_6_tidak" name="simbol_label_rambu_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_6_na" name="simbol_label_rambu_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_6_action" name="simbol_label_rambu_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_6_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_6_due" name="simbol_label_rambu_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">43. Terdapat rambu wajib penggunaan APD dan rambu DILARANG MASUK SELAIN PETUGAS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_7_ya" name="simbol_label_rambu_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_7_tidak" name="simbol_label_rambu_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_7_na" name="simbol_label_rambu_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_7_action" name="simbol_label_rambu_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_7_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_7_due" name="simbol_label_rambu_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">44. Terdapat rambu jalur evakuasi dan EMERGENCY MUSTER POINT</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="simbol_label_rambu_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_8_ya" name="simbol_label_rambu_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="simbol_label_rambu_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_8_tidak" name="simbol_label_rambu_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="simbol_label_rambu_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="simbol_label_rambu_8_na" name="simbol_label_rambu_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="simbol_label_rambu_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="simbol_label_rambu_8_action" name="simbol_label_rambu_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="simbol_label_rambu_8_due">Due Date</label>
                                            <input type="date" id="simbol_label_rambu_8_due" name="simbol_label_rambu_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>E. KESELAMATAN DAN TANGGAP DARURAT</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">45. Terdapat APAR sesuai kelas kebakaran, tidak kedaluwarsa, ditempatkan standar, dan berkartu inspeksi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_1_ya" name="keselamatan_darurat_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_1_tidak" name="keselamatan_darurat_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_1_na" name="keselamatan_darurat_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_1_action" name="keselamatan_darurat_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_1_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_1_due" name="keselamatan_darurat_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">46. Terdapat Spill Kit lengkap (absorben, pad, boom, sekop non-sparking, wadah) dan mudah dijangkau</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_2_ya" name="keselamatan_darurat_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_2_tidak" name="keselamatan_darurat_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_2_na" name="keselamatan_darurat_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_2_action" name="keselamatan_darurat_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_2_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_2_due" name="keselamatan_darurat_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">47. Terdapat Eye Wash / Emergency Shower yang berfungsi dan mudah dijangkau</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_3_ya" name="keselamatan_darurat_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_3_tidak" name="keselamatan_darurat_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_3_na" name="keselamatan_darurat_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_3_action" name="keselamatan_darurat_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_3_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_3_due" name="keselamatan_darurat_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">48. Terdapat kotak P3K dengan isi lengkap</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_4_ya" name="keselamatan_darurat_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_4_tidak" name="keselamatan_darurat_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_4_na" name="keselamatan_darurat_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_4_action" name="keselamatan_darurat_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_4_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_4_due" name="keselamatan_darurat_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">49. APD tersedia sesuai risiko (sarung tangan kimia, kacamata, respirator, apron, safety shoes)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_5_ya" name="keselamatan_darurat_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_5_tidak" name="keselamatan_darurat_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_5_na" name="keselamatan_darurat_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_5_action" name="keselamatan_darurat_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_5_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_5_due" name="keselamatan_darurat_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">50. Terdapat unit penyalur petir/grounding dengan tahanan maksimal 5 Ω</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_6_ya" name="keselamatan_darurat_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_6_tidak" name="keselamatan_darurat_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_6_na" name="keselamatan_darurat_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_6_action" name="keselamatan_darurat_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_6_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_6_due" name="keselamatan_darurat_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">51. Nomor telepon darurat dan kontak ERT terpasang di area TPS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_7_ya" name="keselamatan_darurat_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_7_tidak" name="keselamatan_darurat_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_7_na" name="keselamatan_darurat_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_7_action" name="keselamatan_darurat_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_7_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_7_due" name="keselamatan_darurat_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">52. Housekeeping baik; area sekitar TPS bebas semak/gulma dan bahan mudah terbakar</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_8_ya" name="keselamatan_darurat_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_8_tidak" name="keselamatan_darurat_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_8_na" name="keselamatan_darurat_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_8_action" name="keselamatan_darurat_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_8_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_8_due" name="keselamatan_darurat_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">53. Tidak ada sumber api terbuka / pekerjaan panas (hot work) tanpa izin di sekitar TPS</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_9_ya" name="keselamatan_darurat_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_9_tidak" name="keselamatan_darurat_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_9_na" name="keselamatan_darurat_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_9_action" name="keselamatan_darurat_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_9_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_9_due" name="keselamatan_darurat_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">54. Bak penampung tidak penuh; ceceran yang terkumpul dikelola sebagai LB3</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_10_ya" name="keselamatan_darurat_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_10_tidak" name="keselamatan_darurat_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_10_na" name="keselamatan_darurat_10_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_10_action" name="keselamatan_darurat_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_10_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_10_due" name="keselamatan_darurat_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">55. Tidak terdapat indikasi pencemaran tanah/air di sekitar TPS (noda/lapisan minyak di drainase)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="keselamatan_darurat_11_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_11_ya" name="keselamatan_darurat_11_check" value="Ya" required> Ya
                                        </label>
                                        <label for="keselamatan_darurat_11_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_11_tidak" name="keselamatan_darurat_11_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="keselamatan_darurat_11_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="keselamatan_darurat_11_na" name="keselamatan_darurat_11_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="keselamatan_darurat_11_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="keselamatan_darurat_11_action" name="keselamatan_darurat_11_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="keselamatan_darurat_11_due">Due Date</label>
                                            <input type="date" id="keselamatan_darurat_11_due" name="keselamatan_darurat_11_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiAreaLimbahB3">Submit</button>
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

    const formInspeksiAreaLimbahB3 = document.getElementById('submitformInspeksiAreaLimbahB3');
    const submitButtonInspeksiAreaLimbahB3 = document.getElementById('submitButtonInspeksiAreaLimbahB3');

    formInspeksiAreaLimbahB3.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiAreaLimbahB3.disabled = true;
        submitButtonInspeksiAreaLimbahB3.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiAreaLimbahB3.disabled = false;
            submitButtonInspeksiAreaLimbahB3.innerText = 'Submit';
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
