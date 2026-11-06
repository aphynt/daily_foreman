@include('layout.head', ['title' => 'Inspeksi Area Mess / Basecamp'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Area Mess / Basecamp</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.areamess.post') }}" method="POST" id="submitformInspeksiAreaMess" enctype="multipart/form-data">
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
                                <h5>A. DOKUMEN DAN ADMINISTRASI</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">1. Terdapat papan nama area serta nama &amp; kontak Penanggung Jawab Area (PJA) / pengelola mess</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dokumen_administrasi_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_1_ya" name="dokumen_administrasi_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dokumen_administrasi_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_1_tidak" name="dokumen_administrasi_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dokumen_administrasi_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_1_na" name="dokumen_administrasi_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dokumen_administrasi_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dokumen_administrasi_1_action" name="dokumen_administrasi_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dokumen_administrasi_1_due">Due Date</label>
                                            <input type="date" id="dokumen_administrasi_1_due" name="dokumen_administrasi_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">2. Tata tertib penghuni mess terpasang dan disosialisasikan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dokumen_administrasi_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_2_ya" name="dokumen_administrasi_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dokumen_administrasi_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_2_tidak" name="dokumen_administrasi_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dokumen_administrasi_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_2_na" name="dokumen_administrasi_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dokumen_administrasi_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dokumen_administrasi_2_action" name="dokumen_administrasi_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dokumen_administrasi_2_due">Due Date</label>
                                            <input type="date" id="dokumen_administrasi_2_due" name="dokumen_administrasi_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">3. Daftar penghuni per kamar diperbarui (jumlah penghuni sesuai kapasitas kamar)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dokumen_administrasi_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_3_ya" name="dokumen_administrasi_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dokumen_administrasi_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_3_tidak" name="dokumen_administrasi_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dokumen_administrasi_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_3_na" name="dokumen_administrasi_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dokumen_administrasi_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dokumen_administrasi_3_action" name="dokumen_administrasi_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dokumen_administrasi_3_due">Due Date</label>
                                            <input type="date" id="dokumen_administrasi_3_due" name="dokumen_administrasi_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">4. Prosedur tanggap darurat, nomor telepon darurat, dan denah evakuasi terpasang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dokumen_administrasi_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_4_ya" name="dokumen_administrasi_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dokumen_administrasi_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_4_tidak" name="dokumen_administrasi_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dokumen_administrasi_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_4_na" name="dokumen_administrasi_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dokumen_administrasi_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dokumen_administrasi_4_action" name="dokumen_administrasi_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dokumen_administrasi_4_due">Due Date</label>
                                            <input type="date" id="dokumen_administrasi_4_due" name="dokumen_administrasi_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">5. Jadwal kebersihan, pengendalian hama (pest control), dan pemeliharaan terdokumentasi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dokumen_administrasi_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_5_ya" name="dokumen_administrasi_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dokumen_administrasi_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_5_tidak" name="dokumen_administrasi_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dokumen_administrasi_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_5_na" name="dokumen_administrasi_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dokumen_administrasi_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dokumen_administrasi_5_action" name="dokumen_administrasi_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dokumen_administrasi_5_due">Due Date</label>
                                            <input type="date" id="dokumen_administrasi_5_due" name="dokumen_administrasi_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">6. Hasil uji kualitas air bersih / air minum tersedia dan masih berlaku</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dokumen_administrasi_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_6_ya" name="dokumen_administrasi_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dokumen_administrasi_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_6_tidak" name="dokumen_administrasi_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dokumen_administrasi_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_6_na" name="dokumen_administrasi_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dokumen_administrasi_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dokumen_administrasi_6_action" name="dokumen_administrasi_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dokumen_administrasi_6_due">Due Date</label>
                                            <input type="date" id="dokumen_administrasi_6_due" name="dokumen_administrasi_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>B. BANGUNAN DAN KAMAR TIDUR</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">7. Struktur bangunan (dinding, atap, plafon) dalam kondisi baik, tidak retak/bocor</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_1_ya" name="bangunan_kamar_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_1_tidak" name="bangunan_kamar_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_1_na" name="bangunan_kamar_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_1_action" name="bangunan_kamar_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_1_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_1_due" name="bangunan_kamar_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">8. Lantai bersih, kering, tidak licin, dan tidak berlubang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_2_ya" name="bangunan_kamar_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_2_tidak" name="bangunan_kamar_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_2_na" name="bangunan_kamar_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_2_action" name="bangunan_kamar_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_2_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_2_due" name="bangunan_kamar_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">9. Kamar tidak melebihi kapasitas (over capacity) sesuai standar perusahaan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_3_ya" name="bangunan_kamar_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_3_tidak" name="bangunan_kamar_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_3_na" name="bangunan_kamar_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_3_action" name="bangunan_kamar_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_3_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_3_due" name="bangunan_kamar_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">10. Tempat tidur, kasur, dan linen bersih, dalam kondisi baik, dan diganti secara berkala</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_4_ya" name="bangunan_kamar_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_4_tidak" name="bangunan_kamar_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_4_na" name="bangunan_kamar_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_4_action" name="bangunan_kamar_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_4_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_4_due" name="bangunan_kamar_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">11. Tempat tidur susun (bila ada) kokoh dan dilengkapi pagar pengaman di bagian atas</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_5_ya" name="bangunan_kamar_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_5_tidak" name="bangunan_kamar_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_5_na" name="bangunan_kamar_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_5_action" name="bangunan_kamar_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_5_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_5_due" name="bangunan_kamar_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">12. Tersedia lemari / loker pribadi yang dapat dikunci</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_6_ya" name="bangunan_kamar_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_6_tidak" name="bangunan_kamar_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_6_na" name="bangunan_kamar_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_6_action" name="bangunan_kamar_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_6_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_6_due" name="bangunan_kamar_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">13. Pencahayaan, ventilasi, dan pendingin ruangan (AC/kipas) memadai dan berfungsi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_7_ya" name="bangunan_kamar_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_7_tidak" name="bangunan_kamar_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_7_na" name="bangunan_kamar_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_7_action" name="bangunan_kamar_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_7_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_7_due" name="bangunan_kamar_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">14. Kamar cukup gelap &amp; tenang untuk istirahat pekerja shift (gorden/tirai tersedia)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_8_ya" name="bangunan_kamar_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_8_tidak" name="bangunan_kamar_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_8_na" name="bangunan_kamar_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_8_action" name="bangunan_kamar_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_8_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_8_due" name="bangunan_kamar_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">15. Pintu dan jendela dapat dikunci serta dilengkapi kasa nyamuk</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_9_ya" name="bangunan_kamar_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_9_tidak" name="bangunan_kamar_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_9_na" name="bangunan_kamar_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_9_action" name="bangunan_kamar_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_9_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_9_due" name="bangunan_kamar_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">16. Tidak ada penyimpanan bahan mudah terbakar, bahan kimia, atau B3 di dalam kamar</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_kamar_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_10_ya" name="bangunan_kamar_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_kamar_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_10_tidak" name="bangunan_kamar_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_kamar_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_kamar_10_na" name="bangunan_kamar_10_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_kamar_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_kamar_10_action" name="bangunan_kamar_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_kamar_10_due">Due Date</label>
                                            <input type="date" id="bangunan_kamar_10_due" name="bangunan_kamar_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>C. SANITASI DAN KESEHATAN LINGKUNGAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">17. Kamar mandi / toilet bersih, tidak berbau, air mengalir, dan terpisah pria / wanita</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_1_ya" name="sanitasi_kesehatan_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_1_tidak" name="sanitasi_kesehatan_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_1_na" name="sanitasi_kesehatan_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_1_action" name="sanitasi_kesehatan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_1_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_1_due" name="sanitasi_kesehatan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">18. Jumlah toilet dan kamar mandi memadai sesuai jumlah penghuni</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_2_ya" name="sanitasi_kesehatan_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_2_tidak" name="sanitasi_kesehatan_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_2_na" name="sanitasi_kesehatan_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_2_action" name="sanitasi_kesehatan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_2_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_2_due" name="sanitasi_kesehatan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">19. Tersedia air bersih yang cukup dan memenuhi syarat kesehatan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_3_ya" name="sanitasi_kesehatan_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_3_tidak" name="sanitasi_kesehatan_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_3_na" name="sanitasi_kesehatan_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_3_action" name="sanitasi_kesehatan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_3_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_3_due" name="sanitasi_kesehatan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">20. Tersedia air minum yang laik minum (dispenser / galon bersih)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_4_ya" name="sanitasi_kesehatan_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_4_tidak" name="sanitasi_kesehatan_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_4_na" name="sanitasi_kesehatan_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_4_action" name="sanitasi_kesehatan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_4_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_4_due" name="sanitasi_kesehatan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">21. Tandon / tangki air tertutup, bersih, dan dikuras secara berkala</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_5_ya" name="sanitasi_kesehatan_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_5_tidak" name="sanitasi_kesehatan_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_5_na" name="sanitasi_kesehatan_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_5_action" name="sanitasi_kesehatan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_5_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_5_due" name="sanitasi_kesehatan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">22. Tempat sampah terpilah, bertutup, dan sampah diangkut secara rutin</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_6_ya" name="sanitasi_kesehatan_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_6_tidak" name="sanitasi_kesehatan_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_6_na" name="sanitasi_kesehatan_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_6_action" name="sanitasi_kesehatan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_6_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_6_due" name="sanitasi_kesehatan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">23. Septic tank / IPAL domestik berfungsi baik, tidak meluap dan tidak berbau</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_7_ya" name="sanitasi_kesehatan_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_7_tidak" name="sanitasi_kesehatan_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_7_na" name="sanitasi_kesehatan_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_7_action" name="sanitasi_kesehatan_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_7_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_7_due" name="sanitasi_kesehatan_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">24. Saluran pembuangan air (drainase) lancar dan tidak ada genangan air</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_8_ya" name="sanitasi_kesehatan_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_8_tidak" name="sanitasi_kesehatan_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_8_na" name="sanitasi_kesehatan_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_8_action" name="sanitasi_kesehatan_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_8_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_8_due" name="sanitasi_kesehatan_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">25. Tidak terdapat tanda keberadaan vektor (jentik nyamuk, tikus, kecoa, lalat)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_kesehatan_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_9_ya" name="sanitasi_kesehatan_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_kesehatan_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_9_tidak" name="sanitasi_kesehatan_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_kesehatan_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_kesehatan_9_na" name="sanitasi_kesehatan_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_kesehatan_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_kesehatan_9_action" name="sanitasi_kesehatan_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_kesehatan_9_due">Due Date</label>
                                            <input type="date" id="sanitasi_kesehatan_9_due" name="sanitasi_kesehatan_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>D. INSTALASI LISTRIK</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">26. Panel listrik tertutup, berlabel, terkunci, dan area depannya bebas hambatan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="instalasi_listrik_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_1_ya" name="instalasi_listrik_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="instalasi_listrik_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_1_tidak" name="instalasi_listrik_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="instalasi_listrik_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_1_na" name="instalasi_listrik_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="instalasi_listrik_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="instalasi_listrik_1_action" name="instalasi_listrik_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="instalasi_listrik_1_due">Due Date</label>
                                            <input type="date" id="instalasi_listrik_1_due" name="instalasi_listrik_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">27. Tidak ada kabel terkelupas / sambungan tidak standar di kamar dan koridor</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="instalasi_listrik_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_2_ya" name="instalasi_listrik_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="instalasi_listrik_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_2_tidak" name="instalasi_listrik_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="instalasi_listrik_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_2_na" name="instalasi_listrik_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="instalasi_listrik_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="instalasi_listrik_2_action" name="instalasi_listrik_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="instalasi_listrik_2_due">Due Date</label>
                                            <input type="date" id="instalasi_listrik_2_due" name="instalasi_listrik_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">28. Tidak ada penggunaan stop kontak bertumpuk (overload) di kamar</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="instalasi_listrik_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_3_ya" name="instalasi_listrik_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="instalasi_listrik_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_3_tidak" name="instalasi_listrik_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="instalasi_listrik_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_3_na" name="instalasi_listrik_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="instalasi_listrik_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="instalasi_listrik_3_action" name="instalasi_listrik_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="instalasi_listrik_3_due">Due Date</label>
                                            <input type="date" id="instalasi_listrik_3_due" name="instalasi_listrik_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">29. Tidak ada penggunaan alat listrik berdaya tinggi tanpa izin (kompor, heater, rice cooker)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="instalasi_listrik_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_4_ya" name="instalasi_listrik_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="instalasi_listrik_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_4_tidak" name="instalasi_listrik_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="instalasi_listrik_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_4_na" name="instalasi_listrik_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="instalasi_listrik_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="instalasi_listrik_4_action" name="instalasi_listrik_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="instalasi_listrik_4_due">Due Date</label>
                                            <input type="date" id="instalasi_listrik_4_due" name="instalasi_listrik_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">30. Terdapat grounding dan pengaman arus (MCB/ELCB) yang berfungsi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="instalasi_listrik_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_5_ya" name="instalasi_listrik_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="instalasi_listrik_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_5_tidak" name="instalasi_listrik_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="instalasi_listrik_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_5_na" name="instalasi_listrik_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="instalasi_listrik_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="instalasi_listrik_5_action" name="instalasi_listrik_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="instalasi_listrik_5_due">Due Date</label>
                                            <input type="date" id="instalasi_listrik_5_due" name="instalasi_listrik_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">31. Genset / panel distribusi berpagar, berventilasi, dan bebas dari bahan mudah terbakar</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="instalasi_listrik_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_6_ya" name="instalasi_listrik_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="instalasi_listrik_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_6_tidak" name="instalasi_listrik_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="instalasi_listrik_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="instalasi_listrik_6_na" name="instalasi_listrik_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="instalasi_listrik_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="instalasi_listrik_6_action" name="instalasi_listrik_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="instalasi_listrik_6_due">Due Date</label>
                                            <input type="date" id="instalasi_listrik_6_due" name="instalasi_listrik_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>E. PROTEKSI KEBAKARAN DAN TANGGAP DARURAT</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">32. Terdapat APAR sesuai kelas kebakaran, tidak kedaluwarsa, dan berkartu inspeksi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_1_ya" name="proteksi_kebakaran_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_1_tidak" name="proteksi_kebakaran_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_1_na" name="proteksi_kebakaran_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_1_action" name="proteksi_kebakaran_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_1_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_1_due" name="proteksi_kebakaran_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">33. APAR dipasang dengan tinggi puncak ≤ 1,2 m dan jarak antar APAR ≤ 15 m</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_2_ya" name="proteksi_kebakaran_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_2_tidak" name="proteksi_kebakaran_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_2_na" name="proteksi_kebakaran_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_2_action" name="proteksi_kebakaran_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_2_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_2_due" name="proteksi_kebakaran_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">34. Detektor asap / alarm kebakaran tersedia di koridor / kamar dan berfungsi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_3_ya" name="proteksi_kebakaran_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_3_tidak" name="proteksi_kebakaran_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_3_na" name="proteksi_kebakaran_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_3_action" name="proteksi_kebakaran_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_3_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_3_due" name="proteksi_kebakaran_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">35. Jalur evakuasi dan pintu darurat bebas hambatan dan tidak terkunci dari dalam</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_4_ya" name="proteksi_kebakaran_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_4_tidak" name="proteksi_kebakaran_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_4_na" name="proteksi_kebakaran_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_4_action" name="proteksi_kebakaran_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_4_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_4_due" name="proteksi_kebakaran_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">36. Lampu darurat dan tanda EXIT menyala / berfungsi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_5_ya" name="proteksi_kebakaran_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_5_tidak" name="proteksi_kebakaran_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_5_na" name="proteksi_kebakaran_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_5_action" name="proteksi_kebakaran_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_5_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_5_due" name="proteksi_kebakaran_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">37. Terdapat rambu &amp; lokasi EMERGENCY MUSTER POINT yang jelas</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_6_ya" name="proteksi_kebakaran_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_6_tidak" name="proteksi_kebakaran_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_6_na" name="proteksi_kebakaran_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_6_action" name="proteksi_kebakaran_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_6_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_6_due" name="proteksi_kebakaran_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">38. Kotak P3K tersedia dengan isi lengkap dan tidak kedaluwarsa</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_7_ya" name="proteksi_kebakaran_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_7_tidak" name="proteksi_kebakaran_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_7_na" name="proteksi_kebakaran_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_7_action" name="proteksi_kebakaran_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_7_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_7_due" name="proteksi_kebakaran_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">39. Terdapat unit penyalur petir dengan tahanan maksimal 5 Ω</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="proteksi_kebakaran_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_8_ya" name="proteksi_kebakaran_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="proteksi_kebakaran_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_8_tidak" name="proteksi_kebakaran_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="proteksi_kebakaran_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="proteksi_kebakaran_8_na" name="proteksi_kebakaran_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="proteksi_kebakaran_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="proteksi_kebakaran_8_action" name="proteksi_kebakaran_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="proteksi_kebakaran_8_due">Due Date</label>
                                            <input type="date" id="proteksi_kebakaran_8_due" name="proteksi_kebakaran_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>F. FASILITAS UMUM DAN KEAMANAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">40. Area mess bebas asap rokok; tersedia area merokok khusus di luar bangunan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_1_ya" name="fasilitas_keamanan_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_1_tidak" name="fasilitas_keamanan_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_1_na" name="fasilitas_keamanan_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_1_action" name="fasilitas_keamanan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_1_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_1_due" name="fasilitas_keamanan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">41. Tersedia ruang ibadah, ruang rekreasi / TV, dan fasilitas olahraga yang layak</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_2_ya" name="fasilitas_keamanan_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_2_tidak" name="fasilitas_keamanan_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_2_na" name="fasilitas_keamanan_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_2_action" name="fasilitas_keamanan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_2_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_2_due" name="fasilitas_keamanan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">42. Tersedia pos keamanan dan petugas jaga; akses keluar-masuk tamu tercatat</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_3_ya" name="fasilitas_keamanan_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_3_tidak" name="fasilitas_keamanan_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_3_na" name="fasilitas_keamanan_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_3_action" name="fasilitas_keamanan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_3_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_3_due" name="fasilitas_keamanan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">43. Penerangan jalan dan area luar mess memadai pada malam hari</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_4_ya" name="fasilitas_keamanan_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_4_tidak" name="fasilitas_keamanan_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_4_na" name="fasilitas_keamanan_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_4_action" name="fasilitas_keamanan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_4_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_4_due" name="fasilitas_keamanan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">44. Area parkir tertata dan terdapat rambu batas kecepatan di lingkungan mess</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_5_ya" name="fasilitas_keamanan_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_5_tidak" name="fasilitas_keamanan_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_5_na" name="fasilitas_keamanan_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_5_action" name="fasilitas_keamanan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_5_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_5_due" name="fasilitas_keamanan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">45. Jalur pejalan kaki aman dan terpisah dari jalur kendaraan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_6_ya" name="fasilitas_keamanan_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_6_tidak" name="fasilitas_keamanan_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_6_na" name="fasilitas_keamanan_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_6_action" name="fasilitas_keamanan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_6_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_6_due" name="fasilitas_keamanan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">46. Lingkungan sekitar mess bersih; rumput / semak dipangkas secara berkala</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_7_ya" name="fasilitas_keamanan_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_7_tidak" name="fasilitas_keamanan_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_7_na" name="fasilitas_keamanan_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_7_action" name="fasilitas_keamanan_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_7_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_7_due" name="fasilitas_keamanan_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">47. Tidak terdapat alkohol, narkoba, senjata tajam, atau barang terlarang (sesuai tata tertib)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="fasilitas_keamanan_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_8_ya" name="fasilitas_keamanan_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="fasilitas_keamanan_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_8_tidak" name="fasilitas_keamanan_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="fasilitas_keamanan_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="fasilitas_keamanan_8_na" name="fasilitas_keamanan_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keamanan_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keamanan_8_action" name="fasilitas_keamanan_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keamanan_8_due">Due Date</label>
                                            <input type="date" id="fasilitas_keamanan_8_due" name="fasilitas_keamanan_8_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiAreaMess">Submit</button>
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

    const formInspeksiAreaMess = document.getElementById('submitformInspeksiAreaMess');
    const submitButtonInspeksiAreaMess = document.getElementById('submitButtonInspeksiAreaMess');

    formInspeksiAreaMess.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiAreaMess.disabled = true;
        submitButtonInspeksiAreaMess.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiAreaMess.disabled = false;
            submitButtonInspeksiAreaMess.innerText = 'Submit';
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
