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
                                <h5>1. Apakah dimensi front loading memadai?</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Lebar front loading minimal 2x turning radius hauler terbesar di area tersebut:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_11_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_11_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <!-- Responsive Row -->
                                    <div class="row mt-2">

                                        <!-- Tindak Lanjut -->
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text"
                                                name="dimensi_11_action"
                                                class="form-control form-control-sm">
                                        </div>

                                        <!-- Due Date -->
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date"
                                                name="dimensi_11_due"
                                                class="form-control form-control-sm">
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2 Jalan masuk ke area loading point cukup lebar (3,5 x lebar unit terbesar):</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_12_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_12_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="dimensi_12_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="dimensi_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3 Jalan masuk dilengkapi dengan tanggul pengaman di sisi kiri & kanan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_13_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_13_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="dimensi_13_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="dimensi_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4 Grade jalan maksimal 8%:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_14_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_14_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="dimensi_14_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="dimensi_14_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5 Terdapat rambu-rambu jalan yang memadai:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_15_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="dimensi_15_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="dimensi_15_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="dimensi_15_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>2. Apakah kondisi fisik front loading memadai?</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1 Tempat dudukan alat gali/muat stabil dan aman:</label>

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
                                    <label>2.2 Tempat dudukan alat gali/muat aman dari longsoran dan jatuhan batu:</label>

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
                                    <label>2.3 Area untuk antrian unit truck cukup lebar dan kondisi aman:</label>
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
                                    <label>2.4 Permukaan loading point rata, tidak undulasi, dibersihkan secara teratur:</label>

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
                                    <label>2.5 Drainase baik, area loading point tidak ada genangan air:</label>

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
                                    <label>2.6 Untuk Top Loading, terdapat tanggul di belakang Ban Belakang Hauler:</label>

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
                                <h5>3. Apakah fasilitas Front Loading memadai?</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1 Tersedia lampu penerangan dengan pencahayaan 20 Lux:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_31_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_31_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_31_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_31_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2 Lampu penerangan diberi tanggulan setinggi 1 meter:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_32_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_32_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_32_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_32_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Kondisi lampu penerangan standard dan tidak ada ceceran bahan bakar:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_33_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_33_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_33_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_33_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Tersedia tempat parkir LV yang lokasinya aman dari maneuver alat berat:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_34_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_34_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_34_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_34_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.5 Tempat parkir LV dilengkapi tanggul pengaman:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_35_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_35_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_35_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_35_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.6 Terdapat rambu parkir untuk LV:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_36_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_36_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_36_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_36_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.7 Tempat parkir tidak berada di bawah tebing ataupun di bibir tebing:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_37_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_37_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fasilitas_37_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fasilitas_37_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>4. Apakah pengawas front loading memadai?</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>4.1 Terdapat pengawas yang ditunjuk mengawasi aktivitas loading point:</label>

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
                                    <label>4.2 1 Pengawas maksimal mengawasi 3 front loading yang berdekatan dalam radius 300 meter antar front:</label>

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
                                    <label>4.3 Pengawas mengisi form pemeriksaan area kerja di awal shift :</label>

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
                                <div class="mb-3">
                                    <label>4.4 Dilengkapi dengan radio komunikasi yang siap digunakan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_44_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pengawas_44_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="pengawas_44_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="pengawas_44_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>5. Apakah manuver truck dan alat berat memadai?</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>5.1 Manuver alat gali/alat muat leluasa untuk mengisi ke truck:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_51_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_51_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="manuver_51_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="manuver_51_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2 Manuver truck searah dengan jarum jam atau sesuai intruksi atasan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_52_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_52_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="manuver_52_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="manuver_52_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3 Manuver dozer/grader secara berkala membersihkan lantai loading point:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_53_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_53_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="manuver_53_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="manuver_53_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.4 Water truck secara berkala menyiram area loading Point:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_54_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_54_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="manuver_54_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="manuver_54_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5 Posisi antrian unit dump truck teratur (searah):</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_55_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_55_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="manuver_55_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="manuver_55_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.6 Jarak antri antar dump truck minimal 1.5 kali Panjang unit:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_56_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="manuver_56_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="manuver_56_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="manuver_56_due" class="form-control form-control-sm">
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
