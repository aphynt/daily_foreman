@include('layout.head', ['title' => 'Inspeksi Tambang - Jalan Tambang'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Tambang - Jalan Tambang</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.jalantambang.post') }}" method="POST" id="submitformInspeksiJalanTambang">
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
                                <h5>1. Apakah dimensi jalan memadai?</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Lebar jalan untuk jalan satu lajur minimum 2 kali lebar unit terbesar:</label>

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
                                    <label>1.2 Lebar jalan untuk jalan dua jalur minimum 3,5 kali lebar unit terbesar:</label>

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
                                    <label>1.3 Kemiringan tanjakan jalan (grade) maksimum 8%:</label>

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
                                    <label>1.4 Kemiringan permukaan jalan (cross fall) antara 2–4%:</label>

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
                                    <label>1.5 Super elevasi di tikungan 4–6%:</label>

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
                                <h5>2. Apakah kondisi fisik jalan memadai?</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1 Permukaan jalan rata, tidak undulasi, berlubang, lekuk jalan dan bongkah:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_21_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_21_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fisik_21_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fisik_21_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 Drainase baik, tidak ada genangan air di permukaan jalan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_22_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_22_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fisik_22_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fisik_22_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Kondisi debu terkontrol dengan baik, jarak pandang masih aman:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_23_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_23_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fisik_23_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fisik_23_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4 Tidak terdapat tumpukan spoil yang menyebabkan penyempitan jalan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_24_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fisik_24_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="fisik_24_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="fisik_24_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>3. Apakah tanggul jalan memadai?</h5>
                                <div class="mb-3">
                                    <label>3.1 Tanggul jalan trapezium, utuh, tidak tergerus air, lebar atas 1 meter:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_31_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_31_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tanggul_31_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tanggul_31_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2 Tinggi tanggul jalan kiri kanan minimum ¾ tinggi ban unit terbesar:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_32_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_32_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tanggul_32_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tanggul_32_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Mulai jarak 30 m dari persimpangan tinggi tanggul maksimal 1 meter:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_33_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_33_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tanggul_33_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tanggul_33_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Lereng tanggul jalan dibentuk dengan kemiringan (lebar : tinggi) 1 : 2:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_34_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_34_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tanggul_34_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tanggul_34_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.5 Setiap 50–100 m panjang tanggul dibuat sodetan dengan lebar 0,5–1 m untuk drainase air permukaan jalan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_35_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tanggul_35_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="tanggul_35_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="tanggul_35_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>4. Apakah patok jalan memadai?</h5>
                                <div class="mb-3">
                                    <label>4.1 Patok jalan terpasang setiap jarak 50 m jalan lurus dan 15 m di tikungan:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_41_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_41_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="patok_41_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="patok_41_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2 Patok jalan tinggi minimal 1 meter dari atas tanggul dan dicat warna putih:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_42_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_42_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="patok_42_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="patok_42_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3 Reflektif patok pada kiri jalan berwarna merah dan kanan jalan warna putih:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_43_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_43_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="patok_43_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="patok_43_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.4 Bahan reflektif dimensi lebar minimal 6 cm dan tinggi minimal 15 cm:</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_44_check" value="S" required /> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="patok_44_check" value="TS" /> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="patok_44_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="patok_44_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>5. Apakah rambu lalu lintas memadai?</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>5.1 Rambu-rambu terpasang di jalan tambang diameter 90 cm (SNI):</label>

                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_51_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_51_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_51_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_51_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2 Rambu batas kecepatan terpasang sesuai dengan risk assessment:</label>

                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_52_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_52_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_52_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_52_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3 Rambu jarak aman antar unit 50 m terpasang sesuai risk assessment:</label>

                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_53_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_53_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_53_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_53_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>
                                        5.4 Rambu larangan mendahului dipasang 50 m sebelum tikungan dan 50 m setelah tikungan,
                                        dipasang rambu batas akhir larangan mendahului:
                                    </label>

                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_54_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_54_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_54_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_54_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>
                                        5.5 Rambu larangan mendahului dipasang 50 m sebelum tanjakan/turunan dan 50 m setelah tanjakan/turunan,
                                        dipasang rambu batas akhir larangan mendahului:
                                    </label>

                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_55_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="rambu_55_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="rambu_55_action" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="rambu_55_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h3>6. Apakah kondisi persimpangan jalan memadai?</h3>
                                <hr>
                                <div class="mb-3">
                                    <label>6.1 Desain persimpangan jalan memiliki sudut simpang 70° - 90°:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_61_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_61_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_61_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_61_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2 Terdapat tanggul pemisah jalur jalan sesuai kebutuhan di persimpangan:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_62_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_62_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_62_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_62_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.3 Tinggi tanggul pemisah jalan minimal ½ tinggi ban unit terbesar:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_63_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_63_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_63_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_63_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.4 Lebar tanggul pemisah jalan sama dengan lebar ban unit terbesar:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_64_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_64_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_64_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_64_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.5 Setiap ujung tanggul pemisah dipasang patok bereflektif:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_65_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_65_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_65_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_65_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.6 Terdapat rambu peringatan pada 100 meter sebelum persimpangan:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_66_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_66_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_66_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_66_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.7 Terdapat rambu STOP dan GIVE WAY sesuai dengan risk assessment:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_67_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_67_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_67_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_67_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.8 Terdapat rambu perpindahan channel sesuai prioritas jalan:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_68_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_68_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_68_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_68_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.9 Pandangan leluasa, tidak ada blind spot karena terhalang tanggul/objek lain:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_69_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_69_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_69_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_69_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.10 Terdapat penerangan di persimpangan jalan sesuai risk assessment:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_610_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_610_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_610_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_610_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.11 Tinggi tanggul tidak lebih 1 M dimulai 30 M dari persimpangan:</label>
                                    <div class="d-flex">
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_611_check" value="S" required> Sesuai</label>
                                        <label class="me-3 px-2 py-2"><input type="radio" name="simpang_611_check" value="TS"> Tidak Sesuai</label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label>Tindak Lanjut Perbaikan</label>
                                            <input type="text" name="simpang_611_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label>Due Date</label>
                                            <input type="date" name="simpang_611_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiJalanTambang">Submit</button>
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

    const formInspeksiJalanTambang = document.getElementById('submitformInspeksiJalanTambang');
    const submitButtonInspeksiJalanTambang = document.getElementById('submitButtonInspeksiJalanTambang');

    formInspeksiJalanTambang.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiJalanTambang.disabled = true;
        submitButtonInspeksiJalanTambang.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiJalanTambang.disabled = false;
            submitButtonInspeksiJalanTambang.innerText = 'Submit';
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
