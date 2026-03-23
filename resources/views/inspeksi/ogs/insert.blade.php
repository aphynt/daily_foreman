@include('layout.head', ['title' => 'Inspeksi Area OGS'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Area OGS</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.ogs.post') }}" method="POST" id="submitformInspeksiOGS">
                                @csrf
                                <!-- Inputan di atas tabel -->
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
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect2" name="penanggungjawab" required>
                                            <option selected disabled></option>
                                            @foreach ($users['penanggungjawab'] as $penanggungjawab)
                                                <option value="{{ $penanggungjawab->NRP }}">{{ $penanggungjawab->PERSONALNAME }} ({{ $penanggungjawab->NRP }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>1. Geometri dan Konstruksi?</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Terdapat tanggul di sekeliling area:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_11_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_11_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <!-- Responsive Row -->
                                    <div class="row mt-2">

                                        <!-- Tindak Lanjut -->
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text"
                                                name="geometri_11_action"
                                                class="form-control form-control-sm">
                                        </div>

                                        <!-- Due Date -->
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date"
                                                name="geometri_11_due"
                                                class="form-control form-control-sm">
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2 Permukaan Base jalan rata:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_12_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_12_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_12_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3 Permukaan tanah rata, maksimal grade 2% tidak ada cekungan di permukaan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_13_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_13_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_13_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4 Permukaan tanah tidak ada genangan air:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_14_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_14_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_14_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_14_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5 Terdapat safety berm pada area yang terdapat perbedaan tinggi ≥ 0.5 meter:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_15_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_15_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_15_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_15_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.6 Terdapat area parkir / akses unit sarana / manhoul yang terpisah dengan alat berat:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_16_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_16_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_16_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_16_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.7 Lebar akses jalan masuk dan keluar memenuhi  minimal 2x lebar unit hauler terbesar:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_17_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_17_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_17_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_17_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.8 Terdapat drainase/ditch di sepanjang kaki tanggulan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_18_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_18_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_18_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_18_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.9 Terdapat median di area keluar bila terdapat percabangan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_19_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="geometri_19_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="geometri_19_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="geometri_19_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>2. Sarana dan Prasarana?</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1 Terdapat tempat ( Kontainer / bangunan ) untuk istirahat yang memadai:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_21_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_21_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="sarana_21_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="sarana_21_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 Terdapat beda tinggi anatar tempat ( Kontainer / bangunan ) untuk istirahat dengan base unit:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_22_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_22_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="sarana_22_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="sarana_22_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Terdapat tangga atau pijakan untuk akses naik turun di tempat (Kontainer / bangunan) Istirahat:</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_23_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_23_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="sarana_23_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="sarana_23_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4 Terdapat jamban / toilet yang memadai:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_24_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_24_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="sarana_24_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="sarana_24_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5 Terdapat unit penerangan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_25_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_25_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="sarana_25_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="sarana_25_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.6 Ketersediaan air bersih laik minum:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_26_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="sarana_26_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="sarana_26_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="sarana_26_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>3. Keselamatan dan Lingkungan?</h5>
                                <div class="mb-3">
                                    <label>3.1 Terdapat APAR yang ditempatkan secara khusus dan standar:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_31_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_31_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="keselamatan_31_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="keselamatan_31_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2 Terdapat unit penyalur petir dengan tahanan maksimal 5 Ω:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_32_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_32_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="keselamatan_32_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="keselamatan_32_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Terdapat Eye Wash:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_33_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_33_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="keselamatan_33_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="keselamatan_33_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Terdapat tempat sampah 3 warna:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_34_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_34_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="keselamatan_34_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="keselamatan_34_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.5 Terdapat wadah penyimpanan ceceran /tumpahan bahan B3 (Spill Kit):</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_35_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_35_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="keselamatan_35_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="keselamatan_35_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.6 Terdapat area yang dikhususkan untuk penghijauan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_36_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="keselamatan_36_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="keselamatan_36_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="keselamatan_36_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>4. Rambu Keselamatan?</h5>
                                <div class="mb-3">
                                    <label>4.1 Terdapat rambu informasi papan nama area OGS:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_41_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_41_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_41_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_41_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2 Terdapat papan informasi nama dan kontak Penanggung Jawab Area (PJA):</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_42_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_42_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_42_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_42_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3 Terdapat rambu wajib penggunaan APD:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_43_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_43_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_43_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_43_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.4 Terdapat rambu informasi EMERGENCY MUSTER POINT:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_44_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_44_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_44_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_44_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.5 Terdapat rambu peringatan jalur kabel bawah tanah:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_45_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_45_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_45_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_45_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.6 Terdapat rambu informasi petunjuk arah akses ( Masuk keluar unit ):</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_46_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_46_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_46_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_46_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.7 Terdapat rambu batas kecepatan 15 Km/Jam di pintu masuk OGS:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_47_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_47_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_47_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_47_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.8 Terdapat rambu chanel radio (jika menggunakan chanel khusus):</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_48_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_48_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_48_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_48_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.9 Terdapat rambu-rambu batas parkir unit secara paralel dan seri:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_49_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_49_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_49_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_49_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.10 Terdapat rambu area parkir sarana / Manhoul:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_410_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_410_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_410_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_410_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.11 Terdapat rambu STOP di pintu keluar:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_411_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_411_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_411_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_411_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.12 Terdapat rambu jalur lalu lintas satu arah:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_412_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_412_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_412_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_412_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.13 Posisi Hauler parkir secara seri:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_413_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_413_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_413_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_413_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.14 Terdapat rambu DILARANG MEMBUANG SAMPAH SEMBARANGAN:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_414_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_414_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_414_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_414_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.15 Terdapat rambu unit hauler dilarang parkir mundur:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_415_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_415_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_415_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_415_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.16 Terdapat rambu pengaktifan parking brake bagi hauler yang berhenti/parkir:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_416_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_416_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_416_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_416_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.17 Terdapat rambu jam keluar masuk OGS:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_417_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_417_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_417_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_417_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>


                                <!-- Catatan -->
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3"
                                        placeholder="Tambahkan catatan..."></textarea>
                                </div>

                                <hr>
                                <div class="row mb-3">

                                    {{-- INSPEKTOR 1 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Inspektor 1</label>
                                        <select class="form-control form-control-sm" name="inspektor1" required>
                                            <option value="{{ Auth::user()->nik }}" selected>{{ Auth::user()->name }} ({{ Auth::user()->nik }})</option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('inspektor1') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- INSPEKTOR 2 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Inspektor 2</label>
                                        <select class="form-control form-control-sm" name="inspektor2">
                                            <option value="" disabled selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('inspektor2') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- INSPEKTOR 3 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Inspektor 3</label>
                                        <select class="form-control form-control-sm" name="inspektor3">
                                            <option value="" disabled selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('inspektor3') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- INSPEKTOR 4 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Inspektor 4</label>
                                        <select class="form-control form-control-sm" name="inspektor4">
                                            <option value="" disabled selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('inspektor4') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- INSPEKTOR 5 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Inspektor 5</label>
                                        <select class="form-control form-control-sm" name="inspektor5">
                                            <option value="" disabled selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('inspektor5') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiOGS">Submit</button>
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

    const formInspeksiOGS = document.getElementById('submitformInspeksiOGS');
    const submitButtonInspeksiOGS = document.getElementById('submitButtonInspeksiOGS');

    formInspeksiOGS.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiOGS.disabled = true;
        submitButtonInspeksiOGS.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiOGS.disabled = false;
            submitButtonInspeksiOGS.innerText = 'Submit';
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
