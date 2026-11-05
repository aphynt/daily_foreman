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
                            <form action="{{ route('inspeksi.penimbunandikolamlumpur.post') }}" method="POST" id="submitformInspeksiPenimbunanDiKolamLumpur" enctype="multipart/form-data">
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
                                <h5>A. PERSIAPAN &amp; KESIAPAN AWAL AREA KERJA</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">1. Area dumping sesuai penetapan rencana tambang &amp; rekomendasi geotek; komisioning dilakukan sebelum dioperasikan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="persiapan_area_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_1_ya" name="persiapan_area_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="persiapan_area_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_1_tidak" name="persiapan_area_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="persiapan_area_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_1_na" name="persiapan_area_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="persiapan_area_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="persiapan_area_1_action" name="persiapan_area_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="persiapan_area_1_due">Due Date</label>
                                            <input type="date" id="persiapan_area_1_due" name="persiapan_area_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">2. Material overburden/lumpur dipastikan kelayakannya; tidak ada genangan air, pohon, atau kayu yang menghalangi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="persiapan_area_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_2_ya" name="persiapan_area_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="persiapan_area_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_2_tidak" name="persiapan_area_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="persiapan_area_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_2_na" name="persiapan_area_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="persiapan_area_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="persiapan_area_2_action" name="persiapan_area_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="persiapan_area_2_due">Due Date</label>
                                            <input type="date" id="persiapan_area_2_due" name="persiapan_area_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">3. Penerangan area kerja memadai minimal 20–50 lux untuk kegiatan malam hari</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="persiapan_area_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_3_ya" name="persiapan_area_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="persiapan_area_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_3_tidak" name="persiapan_area_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="persiapan_area_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_3_na" name="persiapan_area_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="persiapan_area_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="persiapan_area_3_action" name="persiapan_area_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="persiapan_area_3_due">Due Date</label>
                                            <input type="date" id="persiapan_area_3_due" name="persiapan_area_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">4. Bendera batas dorong material terpasang jelas dan terlihat oleh operator maupun pengawas</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="persiapan_area_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_4_ya" name="persiapan_area_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="persiapan_area_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_4_tidak" name="persiapan_area_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="persiapan_area_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_4_na" name="persiapan_area_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="persiapan_area_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="persiapan_area_4_action" name="persiapan_area_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="persiapan_area_4_due">Due Date</label>
                                            <input type="date" id="persiapan_area_4_due" name="persiapan_area_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">5. Patok acuan batas pekerjaan &amp; elevasi permukaan lumpur/timbunan tersedia dari Engineer</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="persiapan_area_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_5_ya" name="persiapan_area_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="persiapan_area_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_5_tidak" name="persiapan_area_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="persiapan_area_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="persiapan_area_5_na" name="persiapan_area_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="persiapan_area_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="persiapan_area_5_action" name="persiapan_area_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="persiapan_area_5_due">Due Date</label>
                                            <input type="date" id="persiapan_area_5_due" name="persiapan_area_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>B. KESIAPAN OPERATOR, PENGAWAS &amp; UNIT</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">6. Form KKH operator terverifikasi (kondisi fit to work, jam tidur minimal 6 jam)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kesiapan_operator_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_1_ya" name="kesiapan_operator_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kesiapan_operator_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_1_tidak" name="kesiapan_operator_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kesiapan_operator_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_1_na" name="kesiapan_operator_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kesiapan_operator_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kesiapan_operator_1_action" name="kesiapan_operator_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kesiapan_operator_1_due">Due Date</label>
                                            <input type="date" id="kesiapan_operator_1_due" name="kesiapan_operator_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">7. P2H unit Bulldozer dilakukan dan unit dinyatakan aman untuk dioperasikan</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kesiapan_operator_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_2_ya" name="kesiapan_operator_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kesiapan_operator_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_2_tidak" name="kesiapan_operator_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kesiapan_operator_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_2_na" name="kesiapan_operator_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kesiapan_operator_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kesiapan_operator_2_action" name="kesiapan_operator_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kesiapan_operator_2_due">Due Date</label>
                                            <input type="date" id="kesiapan_operator_2_due" name="kesiapan_operator_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">8. Form KLKH dibuat pengawas pada awal shift; area kerja bebas crack, amblasan, dan genangan air</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kesiapan_operator_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_3_ya" name="kesiapan_operator_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kesiapan_operator_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_3_tidak" name="kesiapan_operator_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kesiapan_operator_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_3_na" name="kesiapan_operator_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kesiapan_operator_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kesiapan_operator_3_action" name="kesiapan_operator_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kesiapan_operator_3_due">Due Date</label>
                                            <input type="date" id="kesiapan_operator_3_due" name="kesiapan_operator_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">9. P5M (Pembicaraan 5 Menit) dilakukan sebelum memulai kegiatan operasi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kesiapan_operator_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_4_ya" name="kesiapan_operator_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kesiapan_operator_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_4_tidak" name="kesiapan_operator_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kesiapan_operator_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_4_na" name="kesiapan_operator_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kesiapan_operator_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kesiapan_operator_4_action" name="kesiapan_operator_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kesiapan_operator_4_due">Due Date</label>
                                            <input type="date" id="kesiapan_operator_4_due" name="kesiapan_operator_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">10. Operator dan Pengawas menggunakan APD lengkap (rompi pantul, safety shoes, masker debu, kacamata pelindung, life jacket)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kesiapan_operator_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_5_ya" name="kesiapan_operator_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kesiapan_operator_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_5_tidak" name="kesiapan_operator_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kesiapan_operator_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapan_operator_5_na" name="kesiapan_operator_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kesiapan_operator_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kesiapan_operator_5_action" name="kesiapan_operator_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kesiapan_operator_5_due">Due Date</label>
                                            <input type="date" id="kesiapan_operator_5_due" name="kesiapan_operator_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>C. PENGAWASAN AREA KERJA</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">11. Minimal 1 pengawas kompeten standby penuh di lokasi, tidak meninggalkan tanpa izin/delegasi setingkat</label>
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
                                    <label class="fw-semibold">12. Radio komunikasi pengawas-operator tersedia dan berfungsi efektif</label>
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
                                    <label class="fw-semibold">13. Beda tinggi elevasi lumpur dengan elevasi timbunan minimum 2 meter terjaga</label>
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
                                    <label class="fw-semibold">14. Tidak terdapat crack/patahan di area permukaan kerja unit Bulldozer</label>
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
                                    <label class="fw-semibold">15. Serah terima shift: pengawas sebelumnya standby hingga pengawas berikutnya tiba di lokasi (job pending)</label>
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
                                <hr>
                                <h5>D. PELAKSANAAN DUMPING &amp; PENDORONGAN MATERIAL</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">16. Dumping material oleh alat angkut dilakukan minimal 7,0 m dari crest lereng timbunan, searah jarum jam</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dumping_pendorongan_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_1_ya" name="dumping_pendorongan_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dumping_pendorongan_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_1_tidak" name="dumping_pendorongan_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dumping_pendorongan_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_1_na" name="dumping_pendorongan_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dumping_pendorongan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dumping_pendorongan_1_action" name="dumping_pendorongan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dumping_pendorongan_1_due">Due Date</label>
                                            <input type="date" id="dumping_pendorongan_1_due" name="dumping_pendorongan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">17. Bila terdapat retakan pada lereng timbunan, dumping dilakukan minimal 7,0 m dari titik retakan terjauh dari crest</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dumping_pendorongan_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_2_ya" name="dumping_pendorongan_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dumping_pendorongan_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_2_tidak" name="dumping_pendorongan_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dumping_pendorongan_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_2_na" name="dumping_pendorongan_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dumping_pendorongan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dumping_pendorongan_2_action" name="dumping_pendorongan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dumping_pendorongan_2_due">Due Date</label>
                                            <input type="date" id="dumping_pendorongan_2_due" name="dumping_pendorongan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">18. Pendorongan bertahap: Bulldozer medium dari titik A (7 m dari crest) sejauh 3 meter menuju titik B</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dumping_pendorongan_3_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_3_ya" name="dumping_pendorongan_3_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dumping_pendorongan_3_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_3_tidak" name="dumping_pendorongan_3_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dumping_pendorongan_3_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_3_na" name="dumping_pendorongan_3_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dumping_pendorongan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dumping_pendorongan_3_action" name="dumping_pendorongan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dumping_pendorongan_3_due">Due Date</label>
                                            <input type="date" id="dumping_pendorongan_3_due" name="dumping_pendorongan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">19. Dilanjutkan Bulldozer small dari titik B sejauh 2 meter ke titik C (2 m dari crest); finishing menyisakan tanggul</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dumping_pendorongan_4_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_4_ya" name="dumping_pendorongan_4_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dumping_pendorongan_4_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_4_tidak" name="dumping_pendorongan_4_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dumping_pendorongan_4_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_4_na" name="dumping_pendorongan_4_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dumping_pendorongan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dumping_pendorongan_4_action" name="dumping_pendorongan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dumping_pendorongan_4_due">Due Date</label>
                                            <input type="date" id="dumping_pendorongan_4_due" name="dumping_pendorongan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">20. Unit Bulldozer tidak melewati batas 2,0 m dari crest/titik patahan saat mendorong material</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dumping_pendorongan_5_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_5_ya" name="dumping_pendorongan_5_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dumping_pendorongan_5_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_5_tidak" name="dumping_pendorongan_5_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dumping_pendorongan_5_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_5_na" name="dumping_pendorongan_5_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dumping_pendorongan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dumping_pendorongan_5_action" name="dumping_pendorongan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dumping_pendorongan_5_due">Due Date</label>
                                            <input type="date" id="dumping_pendorongan_5_due" name="dumping_pendorongan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">21. Jika terdapat crack, pendorongan material dilakukan maksimal 2 meter dari crack terluar</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dumping_pendorongan_6_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_6_ya" name="dumping_pendorongan_6_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dumping_pendorongan_6_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_6_tidak" name="dumping_pendorongan_6_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dumping_pendorongan_6_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_6_na" name="dumping_pendorongan_6_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dumping_pendorongan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dumping_pendorongan_6_action" name="dumping_pendorongan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dumping_pendorongan_6_due">Due Date</label>
                                            <input type="date" id="dumping_pendorongan_6_due" name="dumping_pendorongan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">22. Dilarang mendorong material menyisir/hingga ujung crest permukaan lumpur; tidak gunakan Bulldozer kelas D9/D10 sampai batas 2 m dari crest/crack</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="dumping_pendorongan_7_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_7_ya" name="dumping_pendorongan_7_check" value="Ya" required> Ya
                                        </label>
                                        <label for="dumping_pendorongan_7_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_7_tidak" name="dumping_pendorongan_7_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="dumping_pendorongan_7_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="dumping_pendorongan_7_na" name="dumping_pendorongan_7_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="dumping_pendorongan_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="dumping_pendorongan_7_action" name="dumping_pendorongan_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="dumping_pendorongan_7_due">Due Date</label>
                                            <input type="date" id="dumping_pendorongan_7_due" name="dumping_pendorongan_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>E. KESIAPSIAGAAN KEADAAN DARURAT</h5>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">23. Operator dan Pengawas memahami prosedur darurat unit amblas (dilarang maju/mundur paksa, keluar via pijakan, gunakan sling) dan unit terbakar (aktifkan fire suppression)</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kesiapsiagaan_darurat_1_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapsiagaan_darurat_1_ya" name="kesiapsiagaan_darurat_1_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kesiapsiagaan_darurat_1_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapsiagaan_darurat_1_tidak" name="kesiapsiagaan_darurat_1_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kesiapsiagaan_darurat_1_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapsiagaan_darurat_1_na" name="kesiapsiagaan_darurat_1_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kesiapsiagaan_darurat_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kesiapsiagaan_darurat_1_action" name="kesiapsiagaan_darurat_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kesiapsiagaan_darurat_1_due">Due Date</label>
                                            <input type="date" id="kesiapsiagaan_darurat_1_due" name="kesiapsiagaan_darurat_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-semibold">24. Nomor kontak darurat tersedia di lokasi</label>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <label for="kesiapsiagaan_darurat_2_ya" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapsiagaan_darurat_2_ya" name="kesiapsiagaan_darurat_2_check" value="Ya" required> Ya
                                        </label>
                                        <label for="kesiapsiagaan_darurat_2_tidak" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapsiagaan_darurat_2_tidak" name="kesiapsiagaan_darurat_2_check" value="Tidak"> Tidak
                                        </label>
                                        <label for="kesiapsiagaan_darurat_2_na" class="me-3 px-2 py-2">
                                            <input type="radio" id="kesiapsiagaan_darurat_2_na" name="kesiapsiagaan_darurat_2_check" value="N/A"> N/A
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="kesiapsiagaan_darurat_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="kesiapsiagaan_darurat_2_action" name="kesiapsiagaan_darurat_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="kesiapsiagaan_darurat_2_due">Due Date</label>
                                            <input type="date" id="kesiapsiagaan_darurat_2_due" name="kesiapsiagaan_darurat_2_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiPenimbunanDiKolamLumpur">Submit</button>
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

    const formInspeksiPenimbunanDiKolamLumpur = document.getElementById('submitformInspeksiPenimbunanDiKolamLumpur');
    const submitButtonInspeksiPenimbunanDiKolamLumpur = document.getElementById('submitButtonInspeksiPenimbunanDiKolamLumpur');

    formInspeksiPenimbunanDiKolamLumpur.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiPenimbunanDiKolamLumpur.disabled = true;
        submitButtonInspeksiPenimbunanDiKolamLumpur.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiPenimbunanDiKolamLumpur.disabled = false;
            submitButtonInspeksiPenimbunanDiKolamLumpur.innerText = 'Submit';
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
