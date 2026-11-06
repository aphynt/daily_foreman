@include('layout.head', ['title' => 'Inspeksi Area Office / Perkantoran'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Area Office / Perkantoran</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.areaoffice.post') }}" method="POST" id="submitformInspeksiAreaOffice" enctype="multipart/form-data">
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
                                <h5>A. ADMINISTRASI &amp; KESIAPAN K3L</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">1. Terdapat papan nama area serta nama &amp; kontak Penanggung Jawab Area (PJA)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="administrasi_k3l_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_1_ya" name="administrasi_k3l_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="administrasi_k3l_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_1_tidak" name="administrasi_k3l_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="administrasi_k3l_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_1_na" name="administrasi_k3l_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="administrasi_k3l_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="administrasi_k3l_1_action" name="administrasi_k3l_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="administrasi_k3l_1_due">Due Date</label>
                                            <input type="date" id="administrasi_k3l_1_due" name="administrasi_k3l_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">2. Kebijakan K3L perusahaan terpasang dan mudah dibaca</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="administrasi_k3l_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_2_ya" name="administrasi_k3l_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="administrasi_k3l_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_2_tidak" name="administrasi_k3l_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="administrasi_k3l_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_2_na" name="administrasi_k3l_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="administrasi_k3l_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="administrasi_k3l_2_action" name="administrasi_k3l_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="administrasi_k3l_2_due">Due Date</label>
                                            <input type="date" id="administrasi_k3l_2_due" name="administrasi_k3l_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">3. Prosedur tanggap darurat, struktur tim darurat, dan nomor telepon darurat terpasang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="administrasi_k3l_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_3_ya" name="administrasi_k3l_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="administrasi_k3l_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_3_tidak" name="administrasi_k3l_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="administrasi_k3l_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_3_na" name="administrasi_k3l_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="administrasi_k3l_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="administrasi_k3l_3_action" name="administrasi_k3l_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="administrasi_k3l_3_due">Due Date</label>
                                            <input type="date" id="administrasi_k3l_3_due" name="administrasi_k3l_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">4. Denah / peta jalur evakuasi terpasang di setiap lantai dan lorong utama</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="administrasi_k3l_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_4_ya" name="administrasi_k3l_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="administrasi_k3l_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_4_tidak" name="administrasi_k3l_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="administrasi_k3l_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_4_na" name="administrasi_k3l_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="administrasi_k3l_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="administrasi_k3l_4_action" name="administrasi_k3l_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="administrasi_k3l_4_due">Due Date</label>
                                            <input type="date" id="administrasi_k3l_4_due" name="administrasi_k3l_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">5. Simulasi evakuasi darurat (fire drill) dilaksanakan dan terdokumentasi secara berkala</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="administrasi_k3l_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_5_ya" name="administrasi_k3l_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="administrasi_k3l_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_5_tidak" name="administrasi_k3l_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="administrasi_k3l_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_5_na" name="administrasi_k3l_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="administrasi_k3l_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="administrasi_k3l_5_action" name="administrasi_k3l_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="administrasi_k3l_5_due">Due Date</label>
                                            <input type="date" id="administrasi_k3l_5_due" name="administrasi_k3l_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">6. Pemeriksaan dan pengujian sarana proteksi kebakaran &amp; instalasi listrik terdokumentasi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="administrasi_k3l_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_6_ya" name="administrasi_k3l_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="administrasi_k3l_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_6_tidak" name="administrasi_k3l_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="administrasi_k3l_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="administrasi_k3l_6_na" name="administrasi_k3l_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="administrasi_k3l_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="administrasi_k3l_6_action" name="administrasi_k3l_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="administrasi_k3l_6_due">Due Date</label>
                                            <input type="date" id="administrasi_k3l_6_due" name="administrasi_k3l_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>B. BANGUNAN DAN TATA RUANG</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">7. Struktur bangunan (dinding, atap, plafon) dalam kondisi baik, tidak retak/bocor/rembes</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_tata_ruang_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_1_ya" name="bangunan_tata_ruang_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_tata_ruang_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_1_tidak" name="bangunan_tata_ruang_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_tata_ruang_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_1_na" name="bangunan_tata_ruang_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_tata_ruang_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_tata_ruang_1_action" name="bangunan_tata_ruang_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_tata_ruang_1_due">Due Date</label>
                                            <input type="date" id="bangunan_tata_ruang_1_due" name="bangunan_tata_ruang_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">8. Lantai rata, tidak licin, tidak berlubang, dan bebas dari bahaya tersandung</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_tata_ruang_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_2_ya" name="bangunan_tata_ruang_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_tata_ruang_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_2_tidak" name="bangunan_tata_ruang_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_tata_ruang_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_2_na" name="bangunan_tata_ruang_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_tata_ruang_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_tata_ruang_2_action" name="bangunan_tata_ruang_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_tata_ruang_2_due">Due Date</label>
                                            <input type="date" id="bangunan_tata_ruang_2_due" name="bangunan_tata_ruang_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">9. Tangga dilengkapi pegangan (handrail), anti-slip, dan bebas dari barang</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_tata_ruang_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_3_ya" name="bangunan_tata_ruang_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_tata_ruang_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_3_tidak" name="bangunan_tata_ruang_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_tata_ruang_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_3_na" name="bangunan_tata_ruang_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_tata_ruang_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_tata_ruang_3_action" name="bangunan_tata_ruang_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_tata_ruang_3_due">Due Date</label>
                                            <input type="date" id="bangunan_tata_ruang_3_due" name="bangunan_tata_ruang_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">10. Lorong, jalan keluar, dan pintu darurat bebas hambatan dan tidak terkunci dari dalam</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_tata_ruang_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_4_ya" name="bangunan_tata_ruang_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_tata_ruang_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_4_tidak" name="bangunan_tata_ruang_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_tata_ruang_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_4_na" name="bangunan_tata_ruang_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_tata_ruang_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_tata_ruang_4_action" name="bangunan_tata_ruang_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_tata_ruang_4_due">Due Date</label>
                                            <input type="date" id="bangunan_tata_ruang_4_due" name="bangunan_tata_ruang_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">11. Pintu darurat membuka ke arah luar / arah evakuasi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_tata_ruang_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_5_ya" name="bangunan_tata_ruang_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_tata_ruang_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_5_tidak" name="bangunan_tata_ruang_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_tata_ruang_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_5_na" name="bangunan_tata_ruang_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_tata_ruang_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_tata_ruang_5_action" name="bangunan_tata_ruang_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_tata_ruang_5_due">Due Date</label>
                                            <input type="date" id="bangunan_tata_ruang_5_due" name="bangunan_tata_ruang_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">12. Lemari, rak arsip, dan perabot berat stabil atau diangkat/diikat ke dinding</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_tata_ruang_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_6_ya" name="bangunan_tata_ruang_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_tata_ruang_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_6_tidak" name="bangunan_tata_ruang_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_tata_ruang_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_6_na" name="bangunan_tata_ruang_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_tata_ruang_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_tata_ruang_6_action" name="bangunan_tata_ruang_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_tata_ruang_6_due">Due Date</label>
                                            <input type="date" id="bangunan_tata_ruang_6_due" name="bangunan_tata_ruang_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">13. Penataan ruang kerja tidak padat dan memiliki ruang gerak yang memadai</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="bangunan_tata_ruang_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_7_ya" name="bangunan_tata_ruang_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="bangunan_tata_ruang_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_7_tidak" name="bangunan_tata_ruang_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="bangunan_tata_ruang_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="bangunan_tata_ruang_7_na" name="bangunan_tata_ruang_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="bangunan_tata_ruang_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="bangunan_tata_ruang_7_action" name="bangunan_tata_ruang_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="bangunan_tata_ruang_7_due">Due Date</label>
                                            <input type="date" id="bangunan_tata_ruang_7_due" name="bangunan_tata_ruang_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>C. LINGKUNGAN KERJA DAN ERGONOMI</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">14. Pencahayaan ruang kerja memadai (± 300 lux untuk pekerjaan kantor)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lingkungan_ergonomi_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_1_ya" name="lingkungan_ergonomi_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lingkungan_ergonomi_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_1_tidak" name="lingkungan_ergonomi_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lingkungan_ergonomi_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_1_na" name="lingkungan_ergonomi_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_ergonomi_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_ergonomi_1_action" name="lingkungan_ergonomi_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_ergonomi_1_due">Due Date</label>
                                            <input type="date" id="lingkungan_ergonomi_1_due" name="lingkungan_ergonomi_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">15. Suhu ruang nyaman (± 23–26 °C) dan kelembaban ± 40–60%</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lingkungan_ergonomi_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_2_ya" name="lingkungan_ergonomi_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lingkungan_ergonomi_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_2_tidak" name="lingkungan_ergonomi_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lingkungan_ergonomi_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_2_na" name="lingkungan_ergonomi_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_ergonomi_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_ergonomi_2_action" name="lingkungan_ergonomi_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_ergonomi_2_due">Due Date</label>
                                            <input type="date" id="lingkungan_ergonomi_2_due" name="lingkungan_ergonomi_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">16. Ventilasi / sirkulasi udara baik; AC berfungsi dan filter dibersihkan berkala</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lingkungan_ergonomi_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_3_ya" name="lingkungan_ergonomi_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lingkungan_ergonomi_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_3_tidak" name="lingkungan_ergonomi_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lingkungan_ergonomi_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_3_na" name="lingkungan_ergonomi_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_ergonomi_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_ergonomi_3_action" name="lingkungan_ergonomi_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_ergonomi_3_due">Due Date</label>
                                            <input type="date" id="lingkungan_ergonomi_3_due" name="lingkungan_ergonomi_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">17. Tingkat kebisingan nyaman dan tidak mengganggu konsentrasi kerja</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lingkungan_ergonomi_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_4_ya" name="lingkungan_ergonomi_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lingkungan_ergonomi_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_4_tidak" name="lingkungan_ergonomi_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lingkungan_ergonomi_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_4_na" name="lingkungan_ergonomi_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_ergonomi_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_ergonomi_4_action" name="lingkungan_ergonomi_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_ergonomi_4_due">Due Date</label>
                                            <input type="date" id="lingkungan_ergonomi_4_due" name="lingkungan_ergonomi_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">18. Kursi kerja dapat diatur (tinggi, sandaran) dan dalam kondisi baik</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lingkungan_ergonomi_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_5_ya" name="lingkungan_ergonomi_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lingkungan_ergonomi_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_5_tidak" name="lingkungan_ergonomi_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lingkungan_ergonomi_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_5_na" name="lingkungan_ergonomi_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_ergonomi_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_ergonomi_5_action" name="lingkungan_ergonomi_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_ergonomi_5_due">Due Date</label>
                                            <input type="date" id="lingkungan_ergonomi_5_due" name="lingkungan_ergonomi_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">19. Posisi monitor sejajar / sedikit di bawah mata dengan jarak ± 1 lengan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lingkungan_ergonomi_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_6_ya" name="lingkungan_ergonomi_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lingkungan_ergonomi_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_6_tidak" name="lingkungan_ergonomi_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lingkungan_ergonomi_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_6_na" name="lingkungan_ergonomi_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_ergonomi_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_ergonomi_6_action" name="lingkungan_ergonomi_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_ergonomi_6_due">Due Date</label>
                                            <input type="date" id="lingkungan_ergonomi_6_due" name="lingkungan_ergonomi_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">20. Meja kerja memadai dan bebas dari tumpukan barang berlebih</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="lingkungan_ergonomi_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_7_ya" name="lingkungan_ergonomi_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="lingkungan_ergonomi_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_7_tidak" name="lingkungan_ergonomi_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="lingkungan_ergonomi_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="lingkungan_ergonomi_7_na" name="lingkungan_ergonomi_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_ergonomi_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_ergonomi_7_action" name="lingkungan_ergonomi_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_ergonomi_7_due">Due Date</label>
                                            <input type="date" id="lingkungan_ergonomi_7_due" name="lingkungan_ergonomi_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>D. INSTALASI LISTRIK DAN PERALATAN KANTOR</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">21. Panel listrik tertutup, berlabel, terkunci, dan area depannya bebas hambatan</label>
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
                                    <label class="fw-semibold">22. Tidak ada kabel terkelupas, terbuka, atau melintang di jalur jalan</label>
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
                                    <label class="fw-semibold">23. Tidak ada penggunaan stop kontak bertumpuk (overload / steker bertingkat)</label>
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
                                    <label class="fw-semibold">24. Peralatan elektronik dimatikan / dicabut setelah jam kerja (sesuai prosedur)</label>
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
                                    <label class="fw-semibold">25. Terdapat grounding dan pengaman arus (MCB/ELCB) yang berfungsi</label>
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
                                    <label class="fw-semibold">26. Genset / UPS (bila ada) dalam kondisi baik, berpagar, dan berventilasi</label>
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
                                    <label class="fw-semibold">27. Terdapat APAR sesuai kelas kebakaran, tidak kedaluwarsa, dan berkartu inspeksi</label>
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
                                    <label class="fw-semibold">28. APAR dipasang dengan tinggi puncak ≤ 1,2 m dan jarak antar APAR ≤ 15 m</label>
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
                                    <label class="fw-semibold">29. Detektor asap / alarm kebakaran tersedia dan berfungsi</label>
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
                                    <label class="fw-semibold">30. Hydrant / sprinkler (bila ada) dalam kondisi baik dan tidak terhalang</label>
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
                                    <label class="fw-semibold">31. Lampu darurat (emergency lamp) dan tanda EXIT menyala / berfungsi</label>
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
                                    <label class="fw-semibold">32. Terdapat rambu &amp; lokasi EMERGENCY MUSTER POINT yang jelas</label>
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
                                    <label class="fw-semibold">33. Kotak P3K tersedia dengan isi lengkap dan tidak kedaluwarsa</label>
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
                                    <label class="fw-semibold">34. Terdapat unit penyalur petir dengan tahanan maksimal 5 Ω</label>
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
                                <h5>F. SANITASI DAN FASILITAS PENDUKUNG</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">35. Toilet bersih, tidak berbau, air mengalir, dan terpisah pria / wanita</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_fasilitas_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_1_ya" name="sanitasi_fasilitas_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_fasilitas_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_1_tidak" name="sanitasi_fasilitas_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_fasilitas_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_1_na" name="sanitasi_fasilitas_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_fasilitas_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_fasilitas_1_action" name="sanitasi_fasilitas_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_fasilitas_1_due">Due Date</label>
                                            <input type="date" id="sanitasi_fasilitas_1_due" name="sanitasi_fasilitas_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">36. Tersedia sabun cuci tangan dan tisu / pengering tangan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_fasilitas_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_2_ya" name="sanitasi_fasilitas_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_fasilitas_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_2_tidak" name="sanitasi_fasilitas_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_fasilitas_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_2_na" name="sanitasi_fasilitas_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_fasilitas_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_fasilitas_2_action" name="sanitasi_fasilitas_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_fasilitas_2_due">Due Date</label>
                                            <input type="date" id="sanitasi_fasilitas_2_due" name="sanitasi_fasilitas_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">37. Tersedia air minum yang laik minum</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_fasilitas_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_3_ya" name="sanitasi_fasilitas_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_fasilitas_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_3_tidak" name="sanitasi_fasilitas_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_fasilitas_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_3_na" name="sanitasi_fasilitas_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_fasilitas_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_fasilitas_3_action" name="sanitasi_fasilitas_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_fasilitas_3_due">Due Date</label>
                                            <input type="date" id="sanitasi_fasilitas_3_due" name="sanitasi_fasilitas_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">38. Tersedia ruang / pantry yang bersih dan bebas serangga / tikus</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_fasilitas_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_4_ya" name="sanitasi_fasilitas_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_fasilitas_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_4_tidak" name="sanitasi_fasilitas_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_fasilitas_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_4_na" name="sanitasi_fasilitas_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_fasilitas_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_fasilitas_4_action" name="sanitasi_fasilitas_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_fasilitas_4_due">Due Date</label>
                                            <input type="date" id="sanitasi_fasilitas_4_due" name="sanitasi_fasilitas_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">39. Tersedia tempat sampah terpilah (organik / anorganik / B3) dan bertutup</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_fasilitas_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_5_ya" name="sanitasi_fasilitas_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_fasilitas_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_5_tidak" name="sanitasi_fasilitas_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_fasilitas_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_5_na" name="sanitasi_fasilitas_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_fasilitas_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_fasilitas_5_action" name="sanitasi_fasilitas_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_fasilitas_5_due">Due Date</label>
                                            <input type="date" id="sanitasi_fasilitas_5_due" name="sanitasi_fasilitas_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">40. Tersedia ruang laktasi dan ruang ibadah yang layak</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_fasilitas_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_6_ya" name="sanitasi_fasilitas_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_fasilitas_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_6_tidak" name="sanitasi_fasilitas_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_fasilitas_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_6_na" name="sanitasi_fasilitas_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_fasilitas_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_fasilitas_6_action" name="sanitasi_fasilitas_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_fasilitas_6_due">Due Date</label>
                                            <input type="date" id="sanitasi_fasilitas_6_due" name="sanitasi_fasilitas_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">41. Area dalam gedung bebas asap rokok; tersedia area merokok khusus di luar gedung</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="sanitasi_fasilitas_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_7_ya" name="sanitasi_fasilitas_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="sanitasi_fasilitas_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_7_tidak" name="sanitasi_fasilitas_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="sanitasi_fasilitas_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="sanitasi_fasilitas_7_na" name="sanitasi_fasilitas_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sanitasi_fasilitas_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sanitasi_fasilitas_7_action" name="sanitasi_fasilitas_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sanitasi_fasilitas_7_due">Due Date</label>
                                            <input type="date" id="sanitasi_fasilitas_7_due" name="sanitasi_fasilitas_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>G. AREA LUAR DAN RAMBU KESELAMATAN</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">42. Area parkir tertata, terpisah antara kendaraan ringan dan alat berat</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="area_luar_rambu_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_1_ya" name="area_luar_rambu_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="area_luar_rambu_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_1_tidak" name="area_luar_rambu_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="area_luar_rambu_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_1_na" name="area_luar_rambu_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="area_luar_rambu_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="area_luar_rambu_1_action" name="area_luar_rambu_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="area_luar_rambu_1_due">Due Date</label>
                                            <input type="date" id="area_luar_rambu_1_due" name="area_luar_rambu_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">43. Terdapat rambu batas kecepatan dan arah lalu lintas di area kantor</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="area_luar_rambu_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_2_ya" name="area_luar_rambu_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="area_luar_rambu_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_2_tidak" name="area_luar_rambu_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="area_luar_rambu_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_2_na" name="area_luar_rambu_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="area_luar_rambu_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="area_luar_rambu_2_action" name="area_luar_rambu_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="area_luar_rambu_2_due">Due Date</label>
                                            <input type="date" id="area_luar_rambu_2_due" name="area_luar_rambu_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">44. Terdapat jalur pejalan kaki yang aman dan terpisah dari jalur kendaraan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="area_luar_rambu_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_3_ya" name="area_luar_rambu_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="area_luar_rambu_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_3_tidak" name="area_luar_rambu_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="area_luar_rambu_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_3_na" name="area_luar_rambu_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="area_luar_rambu_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="area_luar_rambu_3_action" name="area_luar_rambu_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="area_luar_rambu_3_due">Due Date</label>
                                            <input type="date" id="area_luar_rambu_3_due" name="area_luar_rambu_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">45. Saluran drainase di sekitar gedung berfungsi dan tidak tersumbat</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="area_luar_rambu_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_4_ya" name="area_luar_rambu_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="area_luar_rambu_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_4_tidak" name="area_luar_rambu_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="area_luar_rambu_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_4_na" name="area_luar_rambu_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="area_luar_rambu_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="area_luar_rambu_4_action" name="area_luar_rambu_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="area_luar_rambu_4_due">Due Date</label>
                                            <input type="date" id="area_luar_rambu_4_due" name="area_luar_rambu_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">46. Terdapat rambu wajib APD saat keluar area kantor menuju area operasional</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="area_luar_rambu_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_5_ya" name="area_luar_rambu_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="area_luar_rambu_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_5_tidak" name="area_luar_rambu_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="area_luar_rambu_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="area_luar_rambu_5_na" name="area_luar_rambu_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="area_luar_rambu_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="area_luar_rambu_5_action" name="area_luar_rambu_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="area_luar_rambu_5_due">Due Date</label>
                                            <input type="date" id="area_luar_rambu_5_due" name="area_luar_rambu_5_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiAreaOffice">Submit</button>
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

    const formInspeksiAreaOffice = document.getElementById('submitformInspeksiAreaOffice');
    const submitButtonInspeksiAreaOffice = document.getElementById('submitButtonInspeksiAreaOffice');

    formInspeksiAreaOffice.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiAreaOffice.disabled = true;
        submitButtonInspeksiAreaOffice.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiAreaOffice.disabled = false;
            submitButtonInspeksiAreaOffice.innerText = 'Submit';
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
