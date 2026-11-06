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
                            <form action="{{ route('inspeksi.areakantin.post') }}" method="POST" id="submitformInspeksiAreaKantin" enctype="multipart/form-data">
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
                                    <label class="fw-semibold">1. Terdapat papan nama area serta nama &amp; kontak Penanggung Jawab Area (PJA)</label>
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
                                    <label class="fw-semibold">2. Kantin / katering memiliki Sertifikat Laik Higiene Sanitasi (SLHS) yang masih berlaku</label>
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
                                    <label class="fw-semibold">3. Penjamah makanan memiliki sertifikat pelatihan higiene sanitasi pangan</label>
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
                                    <label class="fw-semibold">4. Penjamah makanan menjalani pemeriksaan kesehatan berkala (termasuk usap dubur / rectal swab)</label>
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
                                    <label class="fw-semibold">5. Hasil uji kualitas air minum dan air untuk pengolahan makanan tersedia dan berlaku</label>
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
                                    <label class="fw-semibold">6. Sampel makanan (bank sampel) disimpan per menu / per shift sesuai prosedur</label>
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
                                <div class="mb-3">
                                    <label class="fw-semibold">7. Bahan pangan olahan memiliki izin edar (BPOM / PIRT), tidak kedaluwarsa, dan halal</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dokumen_administrasi_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_7_ya" name="dokumen_administrasi_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dokumen_administrasi_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_7_tidak" name="dokumen_administrasi_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dokumen_administrasi_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dokumen_administrasi_7_na" name="dokumen_administrasi_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dokumen_administrasi_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dokumen_administrasi_7_action" name="dokumen_administrasi_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dokumen_administrasi_7_due">Due Date</label>
                                            <input type="date" id="dokumen_administrasi_7_due" name="dokumen_administrasi_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>B. KANTIN – BANGUNAN DAN FASILITAS</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">8. Lantai, dinding, dan langit-langit bersih, kedap air, mudah dibersihkan, dan tidak rusak</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_bangunan_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_1_ya" name="kantin_bangunan_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_bangunan_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_1_tidak" name="kantin_bangunan_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_bangunan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_1_na" name="kantin_bangunan_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_bangunan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_bangunan_1_action" name="kantin_bangunan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_bangunan_1_due">Due Date</label>
                                            <input type="date" id="kantin_bangunan_1_due" name="kantin_bangunan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">9. Ruang pengolahan terpisah dari ruang makan dan toilet</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_bangunan_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_2_ya" name="kantin_bangunan_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_bangunan_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_2_tidak" name="kantin_bangunan_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_bangunan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_2_na" name="kantin_bangunan_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_bangunan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_bangunan_2_action" name="kantin_bangunan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_bangunan_2_due">Due Date</label>
                                            <input type="date" id="kantin_bangunan_2_due" name="kantin_bangunan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">10. Ventilasi / exhaust hood dapur berfungsi dan bebas dari kerak minyak</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_bangunan_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_3_ya" name="kantin_bangunan_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_bangunan_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_3_tidak" name="kantin_bangunan_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_bangunan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_3_na" name="kantin_bangunan_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_bangunan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_bangunan_3_action" name="kantin_bangunan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_bangunan_3_due">Due Date</label>
                                            <input type="date" id="kantin_bangunan_3_due" name="kantin_bangunan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">11. Pencahayaan ruang pengolahan dan ruang makan memadai</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_bangunan_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_4_ya" name="kantin_bangunan_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_bangunan_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_4_tidak" name="kantin_bangunan_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_bangunan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_4_na" name="kantin_bangunan_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_bangunan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_bangunan_4_action" name="kantin_bangunan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_bangunan_4_due">Due Date</label>
                                            <input type="date" id="kantin_bangunan_4_due" name="kantin_bangunan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">12. Pintu dan jendela dilengkapi kasa / tirai plastik pencegah serangga</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_bangunan_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_5_ya" name="kantin_bangunan_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_bangunan_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_5_tidak" name="kantin_bangunan_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_bangunan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_5_na" name="kantin_bangunan_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_bangunan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_bangunan_5_action" name="kantin_bangunan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_bangunan_5_due">Due Date</label>
                                            <input type="date" id="kantin_bangunan_5_due" name="kantin_bangunan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">13. Tersedia wastafel cuci tangan dengan sabun dan air mengalir bagi pengunjung &amp; penjamah</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_bangunan_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_6_ya" name="kantin_bangunan_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_bangunan_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_6_tidak" name="kantin_bangunan_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_bangunan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_6_na" name="kantin_bangunan_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_bangunan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_bangunan_6_action" name="kantin_bangunan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_bangunan_6_due">Due Date</label>
                                            <input type="date" id="kantin_bangunan_6_due" name="kantin_bangunan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">14. Meja, kursi, dan peralatan makan bersih dan dalam kondisi baik</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_bangunan_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_7_ya" name="kantin_bangunan_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_bangunan_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_7_tidak" name="kantin_bangunan_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_bangunan_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_bangunan_7_na" name="kantin_bangunan_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_bangunan_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_bangunan_7_action" name="kantin_bangunan_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_bangunan_7_due">Due Date</label>
                                            <input type="date" id="kantin_bangunan_7_due" name="kantin_bangunan_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>C. KANTIN – HIGIENE PENGOLAHAN DAN PENYAJIAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">15. Penjamah makanan menggunakan celemek, penutup kepala, masker, dan sarung tangan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_1_ya" name="kantin_higiene_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_1_tidak" name="kantin_higiene_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_1_na" name="kantin_higiene_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_1_action" name="kantin_higiene_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_1_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_1_due" name="kantin_higiene_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">16. Penjamah makanan tidak merokok, berkuku pendek, dan tidak memakai perhiasan saat bekerja</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_2_ya" name="kantin_higiene_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_2_tidak" name="kantin_higiene_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_2_na" name="kantin_higiene_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_2_action" name="kantin_higiene_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_2_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_2_due" name="kantin_higiene_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">17. Bahan mentah dan makanan matang disimpan terpisah (mencegah kontaminasi silang)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_3_ya" name="kantin_higiene_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_3_tidak" name="kantin_higiene_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_3_na" name="kantin_higiene_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_3_action" name="kantin_higiene_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_3_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_3_due" name="kantin_higiene_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">18. Talenan / pisau dibedakan untuk bahan mentah dan makanan matang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_4_ya" name="kantin_higiene_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_4_tidak" name="kantin_higiene_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_4_na" name="kantin_higiene_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_4_action" name="kantin_higiene_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_4_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_4_due" name="kantin_higiene_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">19. Chiller ≤ 5 °C dan freezer ≤ -18 °C; tersedia termometer dan catatan suhu</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_5_ya" name="kantin_higiene_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_5_tidak" name="kantin_higiene_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_5_na" name="kantin_higiene_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_5_action" name="kantin_higiene_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_5_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_5_due" name="kantin_higiene_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">20. Makanan panas disajikan / dipertahankan pada suhu ≥ 60 °C</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_6_ya" name="kantin_higiene_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_6_tidak" name="kantin_higiene_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_6_na" name="kantin_higiene_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_6_action" name="kantin_higiene_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_6_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_6_due" name="kantin_higiene_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">21. Penyimpanan bahan kering di atas rak / palet (± 15 cm dari lantai) dan menerapkan FIFO/FEFO</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_7_ya" name="kantin_higiene_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_7_tidak" name="kantin_higiene_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_7_na" name="kantin_higiene_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_7_action" name="kantin_higiene_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_7_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_7_due" name="kantin_higiene_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">22. Makanan yang disajikan tertutup dan terlindung dari serangga dan debu</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_8_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_8_ya" name="kantin_higiene_8_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_8_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_8_tidak" name="kantin_higiene_8_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_8_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_8_na" name="kantin_higiene_8_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_8_action" name="kantin_higiene_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_8_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_8_due" name="kantin_higiene_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">23. Peralatan masak dan makan dicuci dengan air mengalir, sabun, dan dikeringkan / disanitasi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_9_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_9_ya" name="kantin_higiene_9_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_9_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_9_tidak" name="kantin_higiene_9_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_9_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_9_na" name="kantin_higiene_9_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_9_action" name="kantin_higiene_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_9_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_9_due" name="kantin_higiene_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">24. Tidak terdapat tanda keberadaan tikus, kecoa, atau lalat di area dapur</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_higiene_10_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_10_ya" name="kantin_higiene_10_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_higiene_10_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_10_tidak" name="kantin_higiene_10_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_higiene_10_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_higiene_10_na" name="kantin_higiene_10_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_higiene_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_higiene_10_action" name="kantin_higiene_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_higiene_10_due">Due Date</label>
                                            <input type="date" id="kantin_higiene_10_due" name="kantin_higiene_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>D. KANTIN – KESELAMATAN DAPUR DAN GAS</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">25. Tabung LPG ditempatkan di area berventilasi baik dan terpisah dari sumber api</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_keselamatan_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_1_ya" name="kantin_keselamatan_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_keselamatan_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_1_tidak" name="kantin_keselamatan_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_keselamatan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_1_na" name="kantin_keselamatan_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_keselamatan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_keselamatan_1_action" name="kantin_keselamatan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_keselamatan_1_due">Due Date</label>
                                            <input type="date" id="kantin_keselamatan_1_due" name="kantin_keselamatan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">26. Regulator, selang, dan klem LPG berstandar SNI, tidak retak, dan tidak bocor</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_keselamatan_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_2_ya" name="kantin_keselamatan_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_keselamatan_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_2_tidak" name="kantin_keselamatan_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_keselamatan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_2_na" name="kantin_keselamatan_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_keselamatan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_keselamatan_2_action" name="kantin_keselamatan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_keselamatan_2_due">Due Date</label>
                                            <input type="date" id="kantin_keselamatan_2_due" name="kantin_keselamatan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">27. Tersedia detektor kebocoran gas (bila ada) dan prosedur penanganan kebocoran gas</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_keselamatan_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_3_ya" name="kantin_keselamatan_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_keselamatan_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_3_tidak" name="kantin_keselamatan_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_keselamatan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_3_na" name="kantin_keselamatan_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_keselamatan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_keselamatan_3_action" name="kantin_keselamatan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_keselamatan_3_due">Due Date</label>
                                            <input type="date" id="kantin_keselamatan_3_due" name="kantin_keselamatan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">28. Tersedia APAR (kelas K / powder) dan fire blanket di dekat area memasak</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_keselamatan_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_4_ya" name="kantin_keselamatan_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_keselamatan_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_4_tidak" name="kantin_keselamatan_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_keselamatan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_4_na" name="kantin_keselamatan_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_keselamatan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_keselamatan_4_action" name="kantin_keselamatan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_keselamatan_4_due">Due Date</label>
                                            <input type="date" id="kantin_keselamatan_4_due" name="kantin_keselamatan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">29. Instalasi listrik dapur aman dari percikan air dan panas</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_keselamatan_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_5_ya" name="kantin_keselamatan_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_keselamatan_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_5_tidak" name="kantin_keselamatan_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_keselamatan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_5_na" name="kantin_keselamatan_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_keselamatan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_keselamatan_5_action" name="kantin_keselamatan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_keselamatan_5_due">Due Date</label>
                                            <input type="date" id="kantin_keselamatan_5_due" name="kantin_keselamatan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">30. Grease trap (penangkap lemak) berfungsi dan dibersihkan secara berkala</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_keselamatan_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_6_ya" name="kantin_keselamatan_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_keselamatan_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_6_tidak" name="kantin_keselamatan_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_keselamatan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_6_na" name="kantin_keselamatan_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_keselamatan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_keselamatan_6_action" name="kantin_keselamatan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_keselamatan_6_due">Due Date</label>
                                            <input type="date" id="kantin_keselamatan_6_due" name="kantin_keselamatan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">31. Tempat sampah dapur bertutup dan sampah sisa makanan diangkut setiap hari</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kantin_keselamatan_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_7_ya" name="kantin_keselamatan_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kantin_keselamatan_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_7_tidak" name="kantin_keselamatan_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kantin_keselamatan_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kantin_keselamatan_7_na" name="kantin_keselamatan_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kantin_keselamatan_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kantin_keselamatan_7_action" name="kantin_keselamatan_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kantin_keselamatan_7_due">Due Date</label>
                                            <input type="date" id="kantin_keselamatan_7_due" name="kantin_keselamatan_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>E. LAUNDRY – FASILITAS DAN PERALATAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">32. Lantai area laundry kering, anti-slip, dan dilengkapi saluran pembuangan air</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_fasilitas_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_1_ya" name="laundry_fasilitas_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_fasilitas_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_1_tidak" name="laundry_fasilitas_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_fasilitas_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_1_na" name="laundry_fasilitas_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_fasilitas_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_fasilitas_1_action" name="laundry_fasilitas_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_fasilitas_1_due">Due Date</label>
                                            <input type="date" id="laundry_fasilitas_1_due" name="laundry_fasilitas_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">33. Mesin cuci &amp; pengering dalam kondisi baik, di-grounding, dan terdapat tombol emergency stop</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_fasilitas_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_2_ya" name="laundry_fasilitas_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_fasilitas_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_2_tidak" name="laundry_fasilitas_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_fasilitas_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_2_na" name="laundry_fasilitas_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_fasilitas_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_fasilitas_2_action" name="laundry_fasilitas_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_fasilitas_2_due">Due Date</label>
                                            <input type="date" id="laundry_fasilitas_2_due" name="laundry_fasilitas_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">34. Filter serat (lint filter) mesin pengering dibersihkan setiap selesai pemakaian</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_fasilitas_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_3_ya" name="laundry_fasilitas_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_fasilitas_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_3_tidak" name="laundry_fasilitas_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_fasilitas_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_3_na" name="laundry_fasilitas_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_fasilitas_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_fasilitas_3_action" name="laundry_fasilitas_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_fasilitas_3_due">Due Date</label>
                                            <input type="date" id="laundry_fasilitas_3_due" name="laundry_fasilitas_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">35. Saluran pembuangan udara panas mesin pengering (exhaust duct) tidak tersumbat</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_fasilitas_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_4_ya" name="laundry_fasilitas_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_fasilitas_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_4_tidak" name="laundry_fasilitas_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_fasilitas_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_4_na" name="laundry_fasilitas_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_fasilitas_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_fasilitas_4_action" name="laundry_fasilitas_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_fasilitas_4_due">Due Date</label>
                                            <input type="date" id="laundry_fasilitas_4_due" name="laundry_fasilitas_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">36. Setrika / alat press dalam kondisi baik dan dimatikan setelah digunakan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_fasilitas_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_5_ya" name="laundry_fasilitas_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_fasilitas_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_5_tidak" name="laundry_fasilitas_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_fasilitas_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_5_na" name="laundry_fasilitas_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_fasilitas_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_fasilitas_5_action" name="laundry_fasilitas_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_fasilitas_5_due">Due Date</label>
                                            <input type="date" id="laundry_fasilitas_5_due" name="laundry_fasilitas_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">37. Ventilasi area laundry memadai untuk mengurangi panas dan kelembaban</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_fasilitas_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_6_ya" name="laundry_fasilitas_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_fasilitas_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_6_tidak" name="laundry_fasilitas_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_fasilitas_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_6_na" name="laundry_fasilitas_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_fasilitas_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_fasilitas_6_action" name="laundry_fasilitas_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_fasilitas_6_due">Due Date</label>
                                            <input type="date" id="laundry_fasilitas_6_due" name="laundry_fasilitas_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">38. Instalasi listrik dan stop kontak aman dari percikan air</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_fasilitas_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_7_ya" name="laundry_fasilitas_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_fasilitas_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_7_tidak" name="laundry_fasilitas_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_fasilitas_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_fasilitas_7_na" name="laundry_fasilitas_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_fasilitas_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_fasilitas_7_action" name="laundry_fasilitas_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_fasilitas_7_due">Due Date</label>
                                            <input type="date" id="laundry_fasilitas_7_due" name="laundry_fasilitas_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>F. LAUNDRY – BAHAN KIMIA DAN ALUR KERJA</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">39. Bahan kimia (deterjen, pemutih, pelembut) berlabel, tertutup, dan disimpan di rak khusus</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_kimia_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_1_ya" name="laundry_kimia_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_kimia_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_1_tidak" name="laundry_kimia_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_kimia_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_1_na" name="laundry_kimia_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_kimia_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_kimia_1_action" name="laundry_kimia_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_kimia_1_due">Due Date</label>
                                            <input type="date" id="laundry_kimia_1_due" name="laundry_kimia_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">40. SDS / MSDS (Material Safety Data Sheet) bahan kimia laundry tersedia di area kerja</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_kimia_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_2_ya" name="laundry_kimia_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_kimia_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_2_tidak" name="laundry_kimia_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_kimia_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_2_na" name="laundry_kimia_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_kimia_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_kimia_2_action" name="laundry_kimia_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_kimia_2_due">Due Date</label>
                                            <input type="date" id="laundry_kimia_2_due" name="laundry_kimia_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">41. Petugas menggunakan APD (sarung tangan, masker, apron) saat menangani bahan kimia</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_kimia_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_3_ya" name="laundry_kimia_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_kimia_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_3_tidak" name="laundry_kimia_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_kimia_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_3_na" name="laundry_kimia_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_kimia_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_kimia_3_action" name="laundry_kimia_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_kimia_3_due">Due Date</label>
                                            <input type="date" id="laundry_kimia_3_due" name="laundry_kimia_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">42. Alur kerja terpisah antara pakaian / linen kotor dan bersih</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_kimia_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_4_ya" name="laundry_kimia_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_kimia_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_4_tidak" name="laundry_kimia_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_kimia_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_4_na" name="laundry_kimia_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_kimia_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_kimia_4_action" name="laundry_kimia_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_kimia_4_due">Due Date</label>
                                            <input type="date" id="laundry_kimia_4_due" name="laundry_kimia_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">43. Pakaian kerja terkontaminasi oli / grease dipisahkan dari linen mess / kantin</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_kimia_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_5_ya" name="laundry_kimia_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_kimia_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_5_tidak" name="laundry_kimia_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_kimia_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_5_na" name="laundry_kimia_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_kimia_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_kimia_5_action" name="laundry_kimia_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_kimia_5_due">Due Date</label>
                                            <input type="date" id="laundry_kimia_5_due" name="laundry_kimia_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">44. Air limbah laundry dialirkan ke IPAL / oil trap, tidak langsung ke lingkungan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_kimia_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_6_ya" name="laundry_kimia_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_kimia_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_6_tidak" name="laundry_kimia_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_kimia_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_6_na" name="laundry_kimia_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_kimia_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_kimia_6_action" name="laundry_kimia_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_kimia_6_due">Due Date</label>
                                            <input type="date" id="laundry_kimia_6_due" name="laundry_kimia_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">45. Troli / wadah angkut tersedia untuk mengurangi pengangkatan manual</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="laundry_kimia_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_7_ya" name="laundry_kimia_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="laundry_kimia_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_7_tidak" name="laundry_kimia_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="laundry_kimia_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="laundry_kimia_7_na" name="laundry_kimia_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="laundry_kimia_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="laundry_kimia_7_action" name="laundry_kimia_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="laundry_kimia_7_due">Due Date</label>
                                            <input type="date" id="laundry_kimia_7_due" name="laundry_kimia_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>G. TANGGAP DARURAT DAN RAMBU (KANTIN &amp; LAUNDRY)</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">46. APAR tidak kedaluwarsa, berkartu inspeksi, tinggi puncak ≤ 1,2 m, dan mudah dijangkau</label>
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
                                    <label class="fw-semibold">47. Kotak P3K tersedia dengan isi lengkap, termasuk perlengkapan untuk luka bakar</label>
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
                                    <label class="fw-semibold">48. Eye wash tersedia di area penggunaan bahan kimia laundry</label>
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
                                    <label class="fw-semibold">49. Jalur evakuasi bebas hambatan dan terdapat rambu EXIT / EMERGENCY MUSTER POINT</label>
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
                                <div class="mb-3">
                                    <label class="fw-semibold">50. Terdapat rambu DILARANG MEROKOK, rambu wajib cuci tangan, dan rambu lantai licin</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tanggap_darurat_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggap_darurat_5_ya" name="tanggap_darurat_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tanggap_darurat_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggap_darurat_5_tidak" name="tanggap_darurat_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tanggap_darurat_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggap_darurat_5_na" name="tanggap_darurat_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tanggap_darurat_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tanggap_darurat_5_action" name="tanggap_darurat_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tanggap_darurat_5_due">Due Date</label>
                                            <input type="date" id="tanggap_darurat_5_due" name="tanggap_darurat_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">51. Terdapat rambu wajib APD dan rambu bahaya panas / permukaan panas di area dapur &amp; laundry</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="tanggap_darurat_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggap_darurat_6_ya" name="tanggap_darurat_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="tanggap_darurat_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggap_darurat_6_tidak" name="tanggap_darurat_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="tanggap_darurat_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="tanggap_darurat_6_na" name="tanggap_darurat_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="tanggap_darurat_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="tanggap_darurat_6_action" name="tanggap_darurat_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="tanggap_darurat_6_due">Due Date</label>
                                            <input type="date" id="tanggap_darurat_6_due" name="tanggap_darurat_6_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiAreaKantin">Submit</button>
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

    const formInspeksiAreaKantin = document.getElementById('submitformInspeksiAreaKantin');
    const submitButtonInspeksiAreaKantin = document.getElementById('submitButtonInspeksiAreaKantin');

    formInspeksiAreaKantin.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiAreaKantin.disabled = true;
        submitButtonInspeksiAreaKantin.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiAreaKantin.disabled = false;
            submitButtonInspeksiAreaKantin.innerText = 'Submit';
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
