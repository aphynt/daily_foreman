@include('layout.head', ['title' => 'Inspeksi Area Workshop'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Area Workshop</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.workshop.post') }}" method="POST" id="submitformInspeksiWorkshop">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal_inspeksi" required>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Nama Workshop</label>
                                        <input type="text" class="form-control form-control-sm" name="nama_lokasi" required>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Lokasi</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1" name="pit" data-trigger="" required>
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
                                <hr>
                                <h5>1. Housekeeping</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Apakah area kerja dalam keadaan rapi dan teratur?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_11_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_11_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <!-- Responsive Row -->
                                    <div class="row mt-2">

                                        <!-- Tindak Lanjut -->
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text"
                                                name="housekeeping_11_action"
                                                class="form-control form-control-sm">
                                        </div>

                                        <!-- Due Date -->
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date"
                                                name="housekeeping_11_due"
                                                class="form-control form-control-sm">
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2 Apakah lantai kerja bengkel dalam keadaan bersih dan bebas dari benda-benda yang tidak diperlukan?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_12_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_12_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="housekeeping_12_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="housekeeping_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3 Apakah kondisi lantai kerja bengkel tidak rusak?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_13_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_13_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="housekeeping_13_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="housekeeping_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4 Apakah jalur jalan diberi tanda / cat/ demarkasi jelas?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_14_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_14_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="housekeeping_14_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="housekeeping_14_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5 Apakah jalur jalan dan lintasan bebas dari hambatan?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_15_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_15_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="housekeeping_15_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="housekeeping_15_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.6 Apakah penerangan termasuk lampu dan bola lampu ada dalam keadaan yang bersih dan berfungsi?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_16_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_16_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="housekeeping_16_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="housekeeping_16_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.7 Apakah permukaan halaman bengkel tidak bergelombang, tidak becek, dan bersih dari sampah?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_17_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_17_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="housekeeping_17_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="housekeeping_17_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.8 Apakah drainase berfungsi dengan baik?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_18_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="housekeeping_18_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="housekeeping_18_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="housekeeping_18_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h5>2. Tabung Bertekanan</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1 Apakah tabung bertekanan diletakkan dalam posisi berdiri dan terikat kuat?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_21_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_21_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_21_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_21_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 Apakah tabung gas kosong/berisi pada posisi aman (terikat) dan terdapat penutup besi (cap)?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_22_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_22_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_22_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_22_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Apakah regulator indikator berfungsi dengan baik?</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_23_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_23_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_23_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_23_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4 Apakah jarum regulator indikator berada di titik nol pada tabung yang tidak digunakan?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_24_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_24_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_24_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_24_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5 Apakah labelling dan warna tabung jelas/tidak pudar?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_25_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_25_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_25_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_25_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.6 Apakah braket / tempat penyimpanan tabung bertekanan mencukupi dan memadai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_26_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_26_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_26_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_26_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.7 Apakah tempat penyimpanan tabung bertekanan (bila ada), sudah rapi dan tidak berserakan?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_27_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_27_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_27_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_27_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.8 Apakah tempat penyimpanan tabung oksigen dan acetyline dipisahkan dengan jarak minimal 6 meter?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_28_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_28_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_28_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_28_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.9 Apakah terdapat APAR di trolly tabung gas bertekanan yang digunakan saat bekerja?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_29_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_29_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_29_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_29_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.10 Apakah hose tabung bertekanan dalam kondisi baik?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_210_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_210_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_210_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_210_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.11 Apakah terdapat flash back arrestore?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_211_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_211_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_211_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_211_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.12 Terdapat pengaman pada bagian mesin yang berputar?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_212_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_212_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tabung_212_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tabung_212_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4>3. Emergency Equipment</h4>
                                <h5>3.1 APAR & Hydrant</h5>
                                <div class="mb-3">
                                    <label>3.1.1 Apakah APAR mencukupi & terdapat tanda (marking)?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_311_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_311_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="apar_311_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="apar_311_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1.2 Apakah kondisi tabung APAR dalam kondisi tidak rusak?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_312_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_312_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="apar_312_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="apar_312_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1.3 Apakah akses ke alat pemadam tidak terhalangi?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_313_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_313_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="apar_313_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="apar_313_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1.4 Apakah APAR diinspeksi secara rutin dan terdapat tag?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_314_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_314_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="apar_314_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="apar_314_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1.5 Apakah hidran untuk kebakaran (bila ada) dan perlengkapannya dalam keadaan baik?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_315_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="apar_315_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="apar_315_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="apar_315_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>3.2 Eyewash</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2.1 Apakah tempat pencucian mata dalam kondisi bersih?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_321_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_321_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="eyewash_321_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="eyewash_321_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2.2 Apakah eyewash dilakukan inspeksi secara teratur dan terdapat tag yang diisi sesuai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_322_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_322_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="eyewash_322_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="eyewash_322_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2.3 Apakah tempat pencucian mata berfungsi dengan baik?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_323_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_323_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="eyewash_323_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="eyewash_323_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2.4 Apakah akses ke tempat pencucian mata tidak terhalangi?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_324_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="eyewash_324_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="eyewash_324_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="eyewash_324_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>3.3 Assembly Point</h5>
                                <div class="mb-3">
                                    <label>3.3.1 Apakah ada peta /layout area berkumpul darurat?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="assembly_331_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="assembly_331_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="assembly_331_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="assembly_331_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>3.3.2 Apakah area berkumpul darurat diberi rambu “Assembly Point”?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="assembly_332_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="assembly_332_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="assembly_332_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="assembly_332_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>4. Rambu-Rambu</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>4.1 Apakah ada rambu pemakaian “APD Standard”?</label>

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
                                    <label>4.2 Apakah ada rambu “Dilarang Merokok” untuk area yang berpotensi terjadi kebakaran?</label>

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
                                    <label>4.3 Apakah terdapat rambu lalulintas yang memadai?</label>

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
                                    <label>4.4 Apakah ada tanda-tanda jalur keluar darurat ?</label>

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
                                    <label>4.5 Apakah terdapat rambu parkir kendaraan/unit?</label>

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
                                    <label>4.6 Apakah Emergency Flow Chart tersedia?</label>

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
                                <h5>5. Peralatan Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>5.1 Apakah hand tools/power tools layak pakai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_51_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_51_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="peralatan_51_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="peralatan_51_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2 Apakah alat bantu angkat dalam kondisi layak pakai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_52_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_52_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="peralatan_52_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="peralatan_52_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3 Apakah tangga kerja dalam kondisi layak pakai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_53_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_53_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="peralatan_53_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="peralatan_53_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.4 Apakah stand jack dalam kondisi layak pakai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_54_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_54_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="peralatan_54_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="peralatan_54_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5 Apakah alat kerja di ketinggian layak pakai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_55_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_55_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="peralatan_55_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="peralatan_55_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.6 Apakah peralatan pengelasan layak pakai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_56_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="peralatan_56_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="peralatan_56_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="peralatan_56_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>6. Pemasangan LOTO</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>6.1 Apakah semua mekanik memiliki LOTO?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_61_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_61_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="loto_61_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="loto_61_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2 Apakah LOTO terpasang pada unit yang diperbaiki?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_62_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_62_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="loto_62_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="loto_62_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.3 Apakah LOTO yang terpasang sesuai dengan mekanik yang bekerja pada unit tersebut?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_63_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_63_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="loto_63_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="loto_63_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.4 Apakah seluruh sumber energi sudah diputus?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_64_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_64_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="loto_64_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="loto_64_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.5 Apakah bentuk gembok yang terpasang sesuai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_65_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_65_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="loto_65_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="loto_65_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.6 Apakah personal tag dalam kondisi dapat terbaca?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_66_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_66_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="loto_66_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="loto_66_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.7 Apakah box isolasi dalam kondisi baik dan berfungsi?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_67_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="loto_67_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="loto_67_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="loto_67_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4>7. Pengelolaan Sampah Dan Hidrokarbon</h4>
                                <h5>7.1 Kondisi Umum</h5>
                                <div class="mb-3">
                                    <label>7.1.1 Apakah terdapat ceceran hydrokarbon di tanah?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_711_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_711_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_umum_711_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_umum_711_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1.2 Apakah tersedia tempat sampah / limbah dan penampungan tumpahan oli?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_712_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_712_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_umum_712_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_umum_712_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1.3 Apakah tempat pembuangan sampah / limbah sudah diberi nama dan tanda yang benar dan cukup?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_713_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_713_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_umum_713_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_umum_713_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1.4 Apakah limbah besi, domestik dan limbah beroli (Filter oli, majun, dll) diletakkan pada tempat yang sesuai?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_714_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_714_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_umum_714_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_umum_714_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1.5 Apakah terdapat bahan hydrokarbon yang diletakkan diluar area berbunding?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_715_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_715_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_umum_715_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_umum_715_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1.6 Apakah terdapat emergency spill kit di workshop?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_716_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_umum_716_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_umum_716_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_umum_716_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>7.2 Penyimpanan Hydrocarbon</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2.1 Apakah terdapat kebocoran pada fasilitas penyimpanan hidrokarbon?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="hydrocarbon_721_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="hydrocarbon_721_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="hydrocarbon_721_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="hydrocarbon_721_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2.2 Apakah ada kebocoran pada fasilitas pompa, perpipaan dan hose?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="hydrocarbon_722_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="hydrocarbon_722_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="hydrocarbon_722_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="hydrocarbon_722_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2.3 Apakah valve pembuangan selalu tertutup?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="hydrocarbon_723_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="hydrocarbon_723_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="hydrocarbon_723_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="hydrocarbon_723_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>7.3 Oil Trap</h5>
                                <div class="mb-3">
                                    <label>7.3.1 Apakah kondisi kompartemen oil trap sudah bersih (bebas dari lumpur dan oli)?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_731_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_731_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="oil_731_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="oil_731_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3.2 Apakah pijakan (ram) dan pagar dalam keadaan baik?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_732_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_732_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="oil_732_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="oil_732_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3.3 Apakah ada kebocoran pada oil trap atau sistem pelimpasan?</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_733_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="oil_733_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="oil_733_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="oil_733_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiWorkshop">Submit</button>
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

    const formInspeksiWorkshop = document.getElementById('submitformInspeksiWorkshop');
    const submitButtonInspeksiWorkshop = document.getElementById('submitButtonInspeksiWorkshop');

    formInspeksiWorkshop.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiWorkshop.disabled = true;
        submitButtonInspeksiWorkshop.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiWorkshop.disabled = false;
            submitButtonInspeksiWorkshop.innerText = 'Submit';
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
