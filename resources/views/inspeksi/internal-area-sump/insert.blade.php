@include('layout.head', ['title' => 'Inspeksi Internal Area Sump'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Internal Area Sump</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.internalareasump.post') }}" method="POST" id="submitformInspeksiInternalAreaSump" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal_inspeksi" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="nama_lokasi">Nama Lokasi</label>
                                        <input type="text" class="form-control form-control-sm" id="nama_lokasi" name="nama_lokasi" required>
                                    </div>
                                </div>
                                <hr>
                                <h5>1. Pekerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>1.1. Jumlah pekerja minimal 2 orang</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pekerja_1_s">
                                            <input type="radio" id="pekerja_1_s" name="pekerja_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pekerja_1_ts">
                                            <input type="radio" id="pekerja_1_ts" name="pekerja_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pekerja_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pekerja_1_action" name="pekerja_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pekerja_1_due">Due Date</label>
                                            <input type="date" id="pekerja_1_due" name="pekerja_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2. Pengawas operasional melakukan pengawasan melekat</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pekerja_2_s">
                                            <input type="radio" id="pekerja_2_s" name="pekerja_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pekerja_2_ts">
                                            <input type="radio" id="pekerja_2_ts" name="pekerja_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pekerja_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pekerja_2_action" name="pekerja_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pekerja_2_due">Due Date</label>
                                            <input type="date" id="pekerja_2_due" name="pekerja_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3. Pekerja memiliki Kartu High Risk (izin kerja di area berisiko tinggi)</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pekerja_3_s">
                                            <input type="radio" id="pekerja_3_s" name="pekerja_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pekerja_3_ts">
                                            <input type="radio" id="pekerja_3_ts" name="pekerja_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pekerja_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pekerja_3_action" name="pekerja_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pekerja_3_due">Due Date</label>
                                            <input type="date" id="pekerja_3_due" name="pekerja_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4. P2H ada dan telah diverifikasi</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pekerja_4_s">
                                            <input type="radio" id="pekerja_4_s" name="pekerja_4_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pekerja_4_ts">
                                            <input type="radio" id="pekerja_4_ts" name="pekerja_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pekerja_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pekerja_4_action" name="pekerja_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pekerja_4_due">Due Date</label>
                                            <input type="date" id="pekerja_4_due" name="pekerja_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5. KLKH telah dibuat</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pekerja_5_s">
                                            <input type="radio" id="pekerja_5_s" name="pekerja_5_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pekerja_5_ts">
                                            <input type="radio" id="pekerja_5_ts" name="pekerja_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pekerja_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pekerja_5_action" name="pekerja_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pekerja_5_due">Due Date</label>
                                            <input type="date" id="pekerja_5_due" name="pekerja_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>2. Pondok dan Fasilitas</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1. Atap pondok dalam keadaan baik dan tidak ada kebocoran</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_1_s">
                                            <input type="radio" id="pondok_fasilitas_1_s" name="pondok_fasilitas_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_1_ts">
                                            <input type="radio" id="pondok_fasilitas_1_ts" name="pondok_fasilitas_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_1_action" name="pondok_fasilitas_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_1_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_1_due" name="pondok_fasilitas_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2. Dinding pondok dalam keadaan baik dan tidak ada kerusakan</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_2_s">
                                            <input type="radio" id="pondok_fasilitas_2_s" name="pondok_fasilitas_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_2_ts">
                                            <input type="radio" id="pondok_fasilitas_2_ts" name="pondok_fasilitas_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_2_action" name="pondok_fasilitas_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_2_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_2_due" name="pondok_fasilitas_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3. Lantai dalam keadaan baik dan bersih</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_3_s">
                                            <input type="radio" id="pondok_fasilitas_3_s" name="pondok_fasilitas_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_3_ts">
                                            <input type="radio" id="pondok_fasilitas_3_ts" name="pondok_fasilitas_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_3_action" name="pondok_fasilitas_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_3_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_3_due" name="pondok_fasilitas_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4. Pintu, jendela, dan sirkulasi udara di dalam pondok baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_4_s">
                                            <input type="radio" id="pondok_fasilitas_4_s" name="pondok_fasilitas_4_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_4_ts">
                                            <input type="radio" id="pondok_fasilitas_4_ts" name="pondok_fasilitas_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_4_action" name="pondok_fasilitas_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_4_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_4_due" name="pondok_fasilitas_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5. Lampu menyala dengan baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_5_s">
                                            <input type="radio" id="pondok_fasilitas_5_s" name="pondok_fasilitas_5_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_5_ts">
                                            <input type="radio" id="pondok_fasilitas_5_ts" name="pondok_fasilitas_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_5_action" name="pondok_fasilitas_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_5_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_5_due" name="pondok_fasilitas_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.6. Radio komunikasi berfungsi dan tidak ada kerusakan</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_6_s">
                                            <input type="radio" id="pondok_fasilitas_6_s" name="pondok_fasilitas_6_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_6_ts">
                                            <input type="radio" id="pondok_fasilitas_6_ts" name="pondok_fasilitas_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_6_action" name="pondok_fasilitas_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_6_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_6_due" name="pondok_fasilitas_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.7. Kotak P3K di pondok operator lengkap dan mudah diakses</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_7_s">
                                            <input type="radio" id="pondok_fasilitas_7_s" name="pondok_fasilitas_7_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_7_ts">
                                            <input type="radio" id="pondok_fasilitas_7_ts" name="pondok_fasilitas_7_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_7_action" name="pondok_fasilitas_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_7_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_7_due" name="pondok_fasilitas_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.8. Kondisi di dalam pondok bersih dan bebas sampah</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_8_s">
                                            <input type="radio" id="pondok_fasilitas_8_s" name="pondok_fasilitas_8_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_8_ts">
                                            <input type="radio" id="pondok_fasilitas_8_ts" name="pondok_fasilitas_8_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_8_action" name="pondok_fasilitas_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_8_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_8_due" name="pondok_fasilitas_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.9. Kondisi dinding di luar pondok bersih</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_9_s">
                                            <input type="radio" id="pondok_fasilitas_9_s" name="pondok_fasilitas_9_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pondok_fasilitas_9_ts">
                                            <input type="radio" id="pondok_fasilitas_9_ts" name="pondok_fasilitas_9_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pondok_fasilitas_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pondok_fasilitas_9_action" name="pondok_fasilitas_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pondok_fasilitas_9_due">Due Date</label>
                                            <input type="date" id="pondok_fasilitas_9_due" name="pondok_fasilitas_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>3. Electrical</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1. Kabel rapi, dalam kondisi baik dan tidak terkelupas</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="electrical_1_s">
                                            <input type="radio" id="electrical_1_s" name="electrical_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="electrical_1_ts">
                                            <input type="radio" id="electrical_1_ts" name="electrical_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="electrical_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="electrical_1_action" name="electrical_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="electrical_1_due">Due Date</label>
                                            <input type="date" id="electrical_1_due" name="electrical_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2. Stop kontak/sambungan ke sumber listrik baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="electrical_2_s">
                                            <input type="radio" id="electrical_2_s" name="electrical_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="electrical_2_ts">
                                            <input type="radio" id="electrical_2_ts" name="electrical_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="electrical_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="electrical_2_action" name="electrical_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="electrical_2_due">Due Date</label>
                                            <input type="date" id="electrical_2_due" name="electrical_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3. Energi listrik/mesin-mesin tidak running tanpa aktivitas</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="electrical_3_s">
                                            <input type="radio" id="electrical_3_s" name="electrical_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="electrical_3_ts">
                                            <input type="radio" id="electrical_3_ts" name="electrical_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="electrical_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="electrical_3_action" name="electrical_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="electrical_3_due">Due Date</label>
                                            <input type="date" id="electrical_3_due" name="electrical_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>4. Fasilitas dan Keselamatan</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>4.1. Ketersediaan APAR: ada, tekanan normal, dan masih valid (cek tanggal kedaluwarsa)</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_1_s">
                                            <input type="radio" id="fasilitas_keselamatan_1_s" name="fasilitas_keselamatan_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_1_ts">
                                            <input type="radio" id="fasilitas_keselamatan_1_ts" name="fasilitas_keselamatan_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keselamatan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keselamatan_1_action" name="fasilitas_keselamatan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keselamatan_1_due">Due Date</label>
                                            <input type="date" id="fasilitas_keselamatan_1_due" name="fasilitas_keselamatan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2. Perlengkapan APD operator: helm, rompi reflektif, sepatu safety, sarung tangan, life jacket</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_2_s">
                                            <input type="radio" id="fasilitas_keselamatan_2_s" name="fasilitas_keselamatan_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_2_ts">
                                            <input type="radio" id="fasilitas_keselamatan_2_ts" name="fasilitas_keselamatan_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keselamatan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keselamatan_2_action" name="fasilitas_keselamatan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keselamatan_2_due">Due Date</label>
                                            <input type="date" id="fasilitas_keselamatan_2_due" name="fasilitas_keselamatan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3. Ketersediaan logbook/checklist manual di pondok operator</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_3_s">
                                            <input type="radio" id="fasilitas_keselamatan_3_s" name="fasilitas_keselamatan_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_3_ts">
                                            <input type="radio" id="fasilitas_keselamatan_3_ts" name="fasilitas_keselamatan_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keselamatan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keselamatan_3_action" name="fasilitas_keselamatan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keselamatan_3_due">Due Date</label>
                                            <input type="date" id="fasilitas_keselamatan_3_due" name="fasilitas_keselamatan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.4. Tersedia senter</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_4_s">
                                            <input type="radio" id="fasilitas_keselamatan_4_s" name="fasilitas_keselamatan_4_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_4_ts">
                                            <input type="radio" id="fasilitas_keselamatan_4_ts" name="fasilitas_keselamatan_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keselamatan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keselamatan_4_action" name="fasilitas_keselamatan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keselamatan_4_due">Due Date</label>
                                            <input type="date" id="fasilitas_keselamatan_4_due" name="fasilitas_keselamatan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.5. Tersedia ear plug</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_5_s">
                                            <input type="radio" id="fasilitas_keselamatan_5_s" name="fasilitas_keselamatan_5_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_5_ts">
                                            <input type="radio" id="fasilitas_keselamatan_5_ts" name="fasilitas_keselamatan_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keselamatan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keselamatan_5_action" name="fasilitas_keselamatan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keselamatan_5_due">Due Date</label>
                                            <input type="date" id="fasilitas_keselamatan_5_due" name="fasilitas_keselamatan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.6. Tersedia raincoat (jas hujan)</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_6_s">
                                            <input type="radio" id="fasilitas_keselamatan_6_s" name="fasilitas_keselamatan_6_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_6_ts">
                                            <input type="radio" id="fasilitas_keselamatan_6_ts" name="fasilitas_keselamatan_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keselamatan_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keselamatan_6_action" name="fasilitas_keselamatan_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keselamatan_6_due">Due Date</label>
                                            <input type="date" id="fasilitas_keselamatan_6_due" name="fasilitas_keselamatan_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.7. Tersedia eye wash</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_7_s">
                                            <input type="radio" id="fasilitas_keselamatan_7_s" name="fasilitas_keselamatan_7_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="fasilitas_keselamatan_7_ts">
                                            <input type="radio" id="fasilitas_keselamatan_7_ts" name="fasilitas_keselamatan_7_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="fasilitas_keselamatan_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="fasilitas_keselamatan_7_action" name="fasilitas_keselamatan_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="fasilitas_keselamatan_7_due">Due Date</label>
                                            <input type="date" id="fasilitas_keselamatan_7_due" name="fasilitas_keselamatan_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>5. Lingkungan</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>5.1. Kondisi rambu dan pagar pengaman di sekitar kolam terpasang dan terbaca jelas</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="lingkungan_1_s">
                                            <input type="radio" id="lingkungan_1_s" name="lingkungan_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="lingkungan_1_ts">
                                            <input type="radio" id="lingkungan_1_ts" name="lingkungan_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_1_action" name="lingkungan_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_1_due">Due Date</label>
                                            <input type="date" id="lingkungan_1_due" name="lingkungan_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2. Kondisi lingkungan kerja bersih dan bebas sampah</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="lingkungan_2_s">
                                            <input type="radio" id="lingkungan_2_s" name="lingkungan_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="lingkungan_2_ts">
                                            <input type="radio" id="lingkungan_2_ts" name="lingkungan_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_2_action" name="lingkungan_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_2_due">Due Date</label>
                                            <input type="date" id="lingkungan_2_due" name="lingkungan_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3. Memiliki tempat sampah bertutup dan dalam kondisi baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="lingkungan_3_s">
                                            <input type="radio" id="lingkungan_3_s" name="lingkungan_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="lingkungan_3_ts">
                                            <input type="radio" id="lingkungan_3_ts" name="lingkungan_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_3_action" name="lingkungan_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_3_due">Due Date</label>
                                            <input type="date" id="lingkungan_3_due" name="lingkungan_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.4. Lampu penerangan cukup untuk pekerjaan pada malam hari</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="lingkungan_4_s">
                                            <input type="radio" id="lingkungan_4_s" name="lingkungan_4_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="lingkungan_4_ts">
                                            <input type="radio" id="lingkungan_4_ts" name="lingkungan_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_4_action" name="lingkungan_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_4_due">Due Date</label>
                                            <input type="date" id="lingkungan_4_due" name="lingkungan_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5. Tidak terdapat ceceran limbah B3</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="lingkungan_5_s">
                                            <input type="radio" id="lingkungan_5_s" name="lingkungan_5_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="lingkungan_5_ts">
                                            <input type="radio" id="lingkungan_5_ts" name="lingkungan_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="lingkungan_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="lingkungan_5_action" name="lingkungan_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="lingkungan_5_due">Due Date</label>
                                            <input type="date" id="lingkungan_5_due" name="lingkungan_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>6. Engine & Pompa</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>6.1. Kondisi pompa bersih dari sampah dan ceceran limbah B3</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_1_s">
                                            <input type="radio" id="engine_pompa_1_s" name="engine_pompa_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_1_ts">
                                            <input type="radio" id="engine_pompa_1_ts" name="engine_pompa_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_1_action" name="engine_pompa_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_1_due">Due Date</label>
                                            <input type="date" id="engine_pompa_1_due" name="engine_pompa_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2. Lantai ponton bersih dari sampah dan ceceran limbah B3</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_2_s">
                                            <input type="radio" id="engine_pompa_2_s" name="engine_pompa_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_2_ts">
                                            <input type="radio" id="engine_pompa_2_ts" name="engine_pompa_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_2_action" name="engine_pompa_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_2_due">Due Date</label>
                                            <input type="date" id="engine_pompa_2_due" name="engine_pompa_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.3. Ponton tidak miring maupun bocor</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_3_s">
                                            <input type="radio" id="engine_pompa_3_s" name="engine_pompa_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_3_ts">
                                            <input type="radio" id="engine_pompa_3_ts" name="engine_pompa_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_3_action" name="engine_pompa_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_3_due">Due Date</label>
                                            <input type="date" id="engine_pompa_3_due" name="engine_pompa_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.4. Rotary lamp menyala dengan baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_4_s">
                                            <input type="radio" id="engine_pompa_4_s" name="engine_pompa_4_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_4_ts">
                                            <input type="radio" id="engine_pompa_4_ts" name="engine_pompa_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_4_action" name="engine_pompa_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_4_due">Due Date</label>
                                            <input type="date" id="engine_pompa_4_due" name="engine_pompa_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.5. Kondisi hose-hose dalam keadaan baik dan tidak ada kebocoran</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_5_s">
                                            <input type="radio" id="engine_pompa_5_s" name="engine_pompa_5_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_5_ts">
                                            <input type="radio" id="engine_pompa_5_ts" name="engine_pompa_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_5_action" name="engine_pompa_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_5_due">Due Date</label>
                                            <input type="date" id="engine_pompa_5_due" name="engine_pompa_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.6. Kondisi coupling/kopel pompa dan motor, alignment dan getaran dalam batas normal</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_6_s">
                                            <input type="radio" id="engine_pompa_6_s" name="engine_pompa_6_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_6_ts">
                                            <input type="radio" id="engine_pompa_6_ts" name="engine_pompa_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_6_action" name="engine_pompa_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_6_due">Due Date</label>
                                            <input type="date" id="engine_pompa_6_due" name="engine_pompa_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.7. Kondisi bearing/bantalan pompa tidak terdapat bunyi abnormal atau panas berlebih</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_7_s">
                                            <input type="radio" id="engine_pompa_7_s" name="engine_pompa_7_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_7_ts">
                                            <input type="radio" id="engine_pompa_7_ts" name="engine_pompa_7_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_7_action" name="engine_pompa_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_7_due">Due Date</label>
                                            <input type="date" id="engine_pompa_7_due" name="engine_pompa_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.8. Kondisi saringan/strainer inlet tidak tersumbat</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_8_s">
                                            <input type="radio" id="engine_pompa_8_s" name="engine_pompa_8_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_8_ts">
                                            <input type="radio" id="engine_pompa_8_ts" name="engine_pompa_8_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_8_action" name="engine_pompa_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_8_due">Due Date</label>
                                            <input type="date" id="engine_pompa_8_due" name="engine_pompa_8_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.9. Kondisi selang hisap: clamp kuat dan tidak terpelintir</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_9_s">
                                            <input type="radio" id="engine_pompa_9_s" name="engine_pompa_9_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_9_ts">
                                            <input type="radio" id="engine_pompa_9_ts" name="engine_pompa_9_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_9_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_9_action" name="engine_pompa_9_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_9_due">Due Date</label>
                                            <input type="date" id="engine_pompa_9_due" name="engine_pompa_9_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.10. Kondisi check valve, duty valve, dan drain valve berfungsi dengan baik dan tidak keras</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_10_s">
                                            <input type="radio" id="engine_pompa_10_s" name="engine_pompa_10_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_10_ts">
                                            <input type="radio" id="engine_pompa_10_ts" name="engine_pompa_10_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_10_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_10_action" name="engine_pompa_10_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_10_due">Due Date</label>
                                            <input type="date" id="engine_pompa_10_due" name="engine_pompa_10_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.11. Pipa penyalur tidak bocor atau retak dan telah dilakukan pemeriksaan NDT</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_11_s">
                                            <input type="radio" id="engine_pompa_11_s" name="engine_pompa_11_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_11_ts">
                                            <input type="radio" id="engine_pompa_11_ts" name="engine_pompa_11_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_11_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_11_action" name="engine_pompa_11_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_11_due">Due Date</label>
                                            <input type="date" id="engine_pompa_11_due" name="engine_pompa_11_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.12. Kondisi level oli pompa dan mesin penggerak dalam batas aman</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_12_s">
                                            <input type="radio" id="engine_pompa_12_s" name="engine_pompa_12_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_12_ts">
                                            <input type="radio" id="engine_pompa_12_ts" name="engine_pompa_12_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_12_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_12_action" name="engine_pompa_12_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_12_due">Due Date</label>
                                            <input type="date" id="engine_pompa_12_due" name="engine_pompa_12_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.13. Kebersihan radiator/pendingin mesin bebas dari lumpur dan kotoran lain</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_13_s">
                                            <input type="radio" id="engine_pompa_13_s" name="engine_pompa_13_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_13_ts">
                                            <input type="radio" id="engine_pompa_13_ts" name="engine_pompa_13_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_13_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_13_action" name="engine_pompa_13_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_13_due">Due Date</label>
                                            <input type="date" id="engine_pompa_13_due" name="engine_pompa_13_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.14. Kondisi battery dan koneksi kabel: terminal bersih, tidak longgar, tegangan sesuai</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_14_s">
                                            <input type="radio" id="engine_pompa_14_s" name="engine_pompa_14_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_14_ts">
                                            <input type="radio" id="engine_pompa_14_ts" name="engine_pompa_14_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_14_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_14_action" name="engine_pompa_14_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_14_due">Due Date</label>
                                            <input type="date" id="engine_pompa_14_due" name="engine_pompa_14_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.15. Kondisi fuel line dan tangki solar tidak bocor, filter bersih</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="engine_pompa_15_s">
                                            <input type="radio" id="engine_pompa_15_s" name="engine_pompa_15_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="engine_pompa_15_ts">
                                            <input type="radio" id="engine_pompa_15_ts" name="engine_pompa_15_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="engine_pompa_15_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="engine_pompa_15_action" name="engine_pompa_15_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="engine_pompa_15_due">Due Date</label>
                                            <input type="date" id="engine_pompa_15_due" name="engine_pompa_15_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>7. Sump (Kolam)</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1. Jumlah life jacket memadai dan dalam keadaan baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="sump_1_s">
                                            <input type="radio" id="sump_1_s" name="sump_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="sump_1_ts">
                                            <input type="radio" id="sump_1_ts" name="sump_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sump_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sump_1_action" name="sump_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sump_1_due">Due Date</label>
                                            <input type="date" id="sump_1_due" name="sump_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2. Terdapat ring buoy dan dalam keadaan baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="sump_2_s">
                                            <input type="radio" id="sump_2_s" name="sump_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="sump_2_ts">
                                            <input type="radio" id="sump_2_ts" name="sump_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sump_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sump_2_action" name="sump_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sump_2_due">Due Date</label>
                                            <input type="date" id="sump_2_due" name="sump_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3. Jembatan penyeberangan dalam kondisi baik (ponton tidak bocor)</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="sump_3_s">
                                            <input type="radio" id="sump_3_s" name="sump_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="sump_3_ts">
                                            <input type="radio" id="sump_3_ts" name="sump_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sump_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sump_3_action" name="sump_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sump_3_due">Due Date</label>
                                            <input type="date" id="sump_3_due" name="sump_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.4. Kondisi lantai jembatan masih normal</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="sump_4_s">
                                            <input type="radio" id="sump_4_s" name="sump_4_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="sump_4_ts">
                                            <input type="radio" id="sump_4_ts" name="sump_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sump_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sump_4_action" name="sump_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sump_4_due">Due Date</label>
                                            <input type="date" id="sump_4_due" name="sump_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.5. Perahu penyeberangan normal (sump yang tidak ada jembatan)</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="sump_5_s">
                                            <input type="radio" id="sump_5_s" name="sump_5_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="sump_5_ts">
                                            <input type="radio" id="sump_5_ts" name="sump_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sump_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sump_5_action" name="sump_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sump_5_due">Due Date</label>
                                            <input type="date" id="sump_5_due" name="sump_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.6. Kondisi pelampung pipa HDPE dan hose dalam keadaan baik</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="sump_6_s">
                                            <input type="radio" id="sump_6_s" name="sump_6_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="sump_6_ts">
                                            <input type="radio" id="sump_6_ts" name="sump_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="sump_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="sump_6_action" name="sump_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="sump_6_due">Due Date</label>
                                            <input type="date" id="sump_6_due" name="sump_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>8. Pipa HDPE</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>8.1. Kondisi fisik pipa HDPE baik (tidak retak, abrasi, deformasi)</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_1_s">
                                            <input type="radio" id="pipa_hdpe_1_s" name="pipa_hdpe_1_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_1_ts">
                                            <input type="radio" id="pipa_hdpe_1_ts" name="pipa_hdpe_1_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_1_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_1_action" name="pipa_hdpe_1_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_1_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_1_due" name="pipa_hdpe_1_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.2. Potongan pipa HDPE telah dirapikan</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_2_s">
                                            <input type="radio" id="pipa_hdpe_2_s" name="pipa_hdpe_2_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_2_ts">
                                            <input type="radio" id="pipa_hdpe_2_ts" name="pipa_hdpe_2_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_2_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_2_action" name="pipa_hdpe_2_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_2_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_2_due" name="pipa_hdpe_2_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.3. Kondisi sambungan baik, tidak bocor, sambungan rapi</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_3_s">
                                            <input type="radio" id="pipa_hdpe_3_s" name="pipa_hdpe_3_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_3_ts">
                                            <input type="radio" id="pipa_hdpe_3_ts" name="pipa_hdpe_3_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_3_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_3_action" name="pipa_hdpe_3_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_3_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_3_due" name="pipa_hdpe_3_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.4. Kondisi fitting dan valve connection</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_4_s">
                                            <input type="radio" id="pipa_hdpe_4_s" name="pipa_hdpe_4_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_4_ts">
                                            <input type="radio" id="pipa_hdpe_4_ts" name="pipa_hdpe_4_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_4_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_4_action" name="pipa_hdpe_4_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_4_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_4_due" name="pipa_hdpe_4_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.5. Jalur pipa tidak tertekuk, tidak ada erosi dan potensi terkena longsoran</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_5_s">
                                            <input type="radio" id="pipa_hdpe_5_s" name="pipa_hdpe_5_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_5_ts">
                                            <input type="radio" id="pipa_hdpe_5_ts" name="pipa_hdpe_5_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_5_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_5_action" name="pipa_hdpe_5_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_5_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_5_due" name="pipa_hdpe_5_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.6. Kondisi pelampung (floating HDPE) stabil, tidak bocor, terikat kuat di pipa</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_6_s">
                                            <input type="radio" id="pipa_hdpe_6_s" name="pipa_hdpe_6_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_6_ts">
                                            <input type="radio" id="pipa_hdpe_6_ts" name="pipa_hdpe_6_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_6_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_6_action" name="pipa_hdpe_6_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_6_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_6_due" name="pipa_hdpe_6_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.7. Tidak ada kebocoran selama operasi</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_7_s">
                                            <input type="radio" id="pipa_hdpe_7_s" name="pipa_hdpe_7_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_7_ts">
                                            <input type="radio" id="pipa_hdpe_7_ts" name="pipa_hdpe_7_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_7_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_7_action" name="pipa_hdpe_7_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_7_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_7_due" name="pipa_hdpe_7_due" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.8. Tersedia label dan rambu keselamatan jalur pipa</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_8_s">
                                            <input type="radio" id="pipa_hdpe_8_s" name="pipa_hdpe_8_check" value="S" required> Sesuai
                                        </label>
                                        <label class="me-3 px-2 py-2" for="pipa_hdpe_8_ts">
                                            <input type="radio" id="pipa_hdpe_8_ts" name="pipa_hdpe_8_check" value="TS"> Tidak Sesuai
                                        </label>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 col-md-8">
                                            <label for="pipa_hdpe_8_action">Tindak Lanjut Perbaikan</label>
                                            <input type="text" id="pipa_hdpe_8_action" name="pipa_hdpe_8_action" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-12 col-md-4 mt-2 mt-md-0">
                                            <label for="pipa_hdpe_8_due">Due Date</label>
                                            <input type="date" id="pipa_hdpe_8_due" name="pipa_hdpe_8_due" class="form-control form-control-sm">
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonInspeksiSlurryPump">Submit</button>
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

    const formInspeksiInternalAreaSump = document.getElementById('submitformInspeksiInternalAreaSump');
    const submitButtonInspeksiInternalAreaSump = document.getElementById('submitButtonInspeksiInternalAreaSump');

    formInspeksiInternalAreaSump.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiInternalAreaSump.disabled = true;
        submitButtonInspeksiInternalAreaSump.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiInternalAreaSump.disabled = false;
            submitButtonInspeksiInternalAreaSump.innerText = 'Submit';
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
