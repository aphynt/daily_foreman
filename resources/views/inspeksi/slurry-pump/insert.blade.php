@include('layout.head', ['title' => 'Inspeksi Slurry Pump'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Slurry Pump</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.slurrypump.post') }}" method="POST" id="submitformInspeksiSlurryPump">
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
                                <h5>1. Kondisi area dan Fasilitas Sump</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Apakah kondisi highwall / low wall tidak ada potensi longsoran:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_11_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_11_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <!-- Responsive Row -->
                                    <div class="row mt-2">

                                        <!-- Tindak Lanjut -->
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text"
                                                name="fasilitas_11_action"
                                                class="form-control form-control-sm">
                                        </div>

                                        <!-- Due Date -->
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date"
                                                name="fasilitas_11_due"
                                                class="form-control form-control-sm">
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2 Apakah ada ramp jalan yang menuju ke sump:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_12_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_12_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_12_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3 Apakah jalan ke Ponton / rakit dalam kondisi bersih / bebas hambatan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_13_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_13_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_13_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4 Apakah ada rambu wajib pelampung di area sump yang di pasang pada jarak minimal 5 meter dari tepi kolam:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_14_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_14_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_14_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_14_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5 Apakah tersedia rambu dilarang berenang di area sump:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_15_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_15_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_15_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_15_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.6 Apakah tersedia pondok pengawas di area sump:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_16_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_16_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_16_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_16_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.7 Apakah di ringboy tersedia dengan  tali minimal 25 m:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_17_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_17_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_17_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_17_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.8 Apakah ringboy ditempatkan pada posisi aman dan mudah di jangkau:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_18_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_18_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_18_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_18_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>2. Kondisi Pompa dan Pontoon</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1 Apakah ponton dalam kondisi layak dan berfungsi dengan baik:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_21_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_21_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_21_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_21_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 Apakah pagar pengaman tersedia:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_22_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_22_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_22_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_22_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Apakah tersedia High Boy / Ring Boy dengan tali minimal 25 m:</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_23_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_23_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_23_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_23_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4 Apakah tersedia pelampung / Life jacket dengan kondisi baik:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_24_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_24_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_24_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_24_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5 Apakah APAR tersedia dengan kondisi baik:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_25_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_25_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_25_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_25_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.6 Apakah pompa mengambang secara mendatar & tidak miring pada satu sisi:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_26_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_26_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_26_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_26_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.7 Apakah lampu kerja tersedia:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_27_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_27_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_27_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_27_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.8 Apakah tersedia check list P2H pompa:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_28_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_28_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_28_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_28_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.9 Apakah semua pipa dan selang aman:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_29_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_29_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_29_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_29_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.10 Apakah terdapat rambu pada jalan yang dilintasi pipa:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_210_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_210_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_210_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_210_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.11 Apakah terdapat kebocoran fuel / oli:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_211_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_211_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_211_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_211_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.12 Apakah outlet bebas dari penghalang:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_212_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_212_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_212_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_212_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.13 Apakah ada lampu rotary  di pompa dan berfungsi dengan baik:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_213_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_213_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_213_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_213_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.14 Apakah tersedia swith emergency di pompa:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_214_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="kondisi_214_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="kondisi_214_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="kondisi_214_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>3. Perahu Penyeberangan</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1 Apakah tersedia perahu penyeberangan yang baik & layak menuju ponton:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_31_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_31_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="perahu_31_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="perahu_31_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2 Apakah ada rambu batas maksimal muatan perahu penyeberangan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_32_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_32_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="perahu_32_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="perahu_32_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Apakah tersedia dayung di perahu penyebrangan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_33_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_33_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="perahu_33_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="perahu_33_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Apakah tali untuk perahu penyebrangan kondisi layak:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_34_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="perahu_34_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="perahu_34_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="perahu_34_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>4. Pengawasan dan Personil</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>4.1 Pengawas melakukan inspeksi awal shift:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_41_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_41_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="pengawas_41_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="pengawas_41_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2 Pengawas dilengkapi dengan radio tangan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_42_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_42_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="pengawas_42_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="pengawas_42_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3 Personil minimal 2 orang yang bekerja di pontoon dan dilengkapi radio tangan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_43_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_43_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="pengawas_43_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="pengawas_43_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiSlurryPump">Submit</button>
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

    const formInspeksiSlurryPump = document.getElementById('submitformInspeksiSlurryPump');
    const submitButtonInspeksiSlurryPump = document.getElementById('submitButtonInspeksiSlurryPump');

    formInspeksiSlurryPump.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiSlurryPump.disabled = true;
        submitButtonInspeksiSlurryPump.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiSlurryPump.disabled = false;
            submitButtonInspeksiSlurryPump.innerText = 'Submit';
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
