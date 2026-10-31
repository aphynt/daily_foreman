@include('layout.head', ['title' => 'KLKH Area Blasting'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Area Blasting</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.areablasting.post') }}" method="POST" id="submitFormKLKHAreaBlasting" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="lokasi">Pit/Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control form-control-sm pb-2 mt-2" placeholder="Lokasi Pemeriksaan" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Hari / Tanggal</label>
                                        <input type="date" class="form-control form-control-sm pb-2" id="date" name="date" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="time">Jam</label>
                                        <input type="time" class="form-control form-control-sm pb-2" id="time" name="time" required>
                                    </div>
                                </div>
                                <hr>
                                <h5>Pekerjaan Drilling & Blasting</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>1. Ditemukannya kondisi material gantung.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_1_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_1_true" name="kondisi_lokasi_1_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_1_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_1_false" name="kondisi_lokasi_1_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_1_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_1_na" name="kondisi_lokasi_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_1_note" id="kondisi_lokasi_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2. Ada aktivitas Loading Coal dan/atau Loading OB DT.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_2_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_2_true" name="kondisi_lokasi_2_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_2_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_2_false" name="kondisi_lokasi_2_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_2_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_2_na" name="kondisi_lokasi_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_2_note" id="kondisi_lokasi_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3. Ada aktivitas Loading OB Unit HD.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_3_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_3_true" name="kondisi_lokasi_3_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_3_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_3_false" name="kondisi_lokasi_3_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_3_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_3_na" name="kondisi_lokasi_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_3_note" id="kondisi_lokasi_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4. Ada unit Break Down dan unit Tower Lamp di dekat lokasi.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_4_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_4_true" name="kondisi_lokasi_4_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_4_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_4_false" name="kondisi_lokasi_4_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_4_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_4_na" name="kondisi_lokasi_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_4_note" id="kondisi_lokasi_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5. Ada genangan air / kantong air di dalam lokasi.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_5_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_5_true" name="kondisi_lokasi_5_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_5_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_5_false" name="kondisi_lokasi_5_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_5_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_5_na" name="kondisi_lokasi_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_5_note" id="kondisi_lokasi_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6. Ada kegiatan coring data eksplorasi di dekat lokasi.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_6_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_6_true" name="kondisi_lokasi_6_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_6_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_6_false" name="kondisi_lokasi_6_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_6_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_6_na" name="kondisi_lokasi_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_6_note" id="kondisi_lokasi_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7. Ada kegiatan pemompaan aktif di kolam air.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_7_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_7_true" name="kondisi_lokasi_7_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_7_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_7_false" name="kondisi_lokasi_7_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_7_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_7_na" name="kondisi_lokasi_7_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_7_note" id="kondisi_lokasi_7_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8. Ada pekerjaan penirisan air (pembuatan parit, pemasangan gorong-gorong).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_8_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_8_true" name="kondisi_lokasi_8_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_8_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_8_false" name="kondisi_lokasi_8_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_8_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_8_na" name="kondisi_lokasi_8_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_8_note" id="kondisi_lokasi_8_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9. Ada bangunan yang masuk radius blasting kurang dari 500 meter.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_9_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_9_true" name="kondisi_lokasi_9_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_9_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_9_false" name="kondisi_lokasi_9_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_9_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_9_na" name="kondisi_lokasi_9_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_9_note" id="kondisi_lokasi_9_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10. Ada aktivitas pengangkutan DT batu bara ke Stock Pile.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_10_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_10_true" name="kondisi_lokasi_10_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_10_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_10_false" name="kondisi_lokasi_10_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_10_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_10_na" name="kondisi_lokasi_10_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_10_note" id="kondisi_lokasi_10_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>11. Ada aktivitas penimbunan batu bara di Stock Room Coal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_11_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_11_true" name="kondisi_lokasi_11_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_11_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_11_false" name="kondisi_lokasi_11_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_11_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_11_na" name="kondisi_lokasi_11_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_11_note" id="kondisi_lokasi_11_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>12. Tidak ditemukan lokasi untuk parkir unit LV Support Drill &amp; Blast di sekitar lokasi blasting.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_12_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_12_true" name="kondisi_lokasi_12_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_12_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_12_false" name="kondisi_lokasi_12_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_12_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_12_na" name="kondisi_lokasi_12_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_12_note" id="kondisi_lokasi_12_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>13. Ada aktivitas perakitan unit.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_13_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_13_true" name="kondisi_lokasi_13_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_13_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_13_false" name="kondisi_lokasi_13_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_13_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_13_na" name="kondisi_lokasi_13_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_13_note" id="kondisi_lokasi_13_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>14. Ada lokasi perbaikan unit (PM).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_14_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_14_true" name="kondisi_lokasi_14_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_14_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_14_false" name="kondisi_lokasi_14_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_14_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_14_na" name="kondisi_lokasi_14_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_14_note" id="kondisi_lokasi_14_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>15. Ada pos checker di dekat lokasi blasting.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_15_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_15_true" name="kondisi_lokasi_15_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_15_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_15_false" name="kondisi_lokasi_15_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_15_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_15_na" name="kondisi_lokasi_15_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_15_note" id="kondisi_lokasi_15_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>16. Ada tempat pemberhentian DT.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_16_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_16_true" name="kondisi_lokasi_16_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_16_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_16_false" name="kondisi_lokasi_16_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_16_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_16_na" name="kondisi_lokasi_16_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_16_note" id="kondisi_lokasi_16_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>17. Ada kontainer tempat peristirahatan operator.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_17_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_17_true" name="kondisi_lokasi_17_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_17_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_17_false" name="kondisi_lokasi_17_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_17_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_17_na" name="kondisi_lokasi_17_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_17_note" id="kondisi_lokasi_17_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>18. Ada akses jalan hauling DT atau HD yang melintas di area lokasi blasting.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_18_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_18_true" name="kondisi_lokasi_18_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_18_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_18_false" name="kondisi_lokasi_18_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_18_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_18_na" name="kondisi_lokasi_18_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_18_note" id="kondisi_lokasi_18_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>19. Ada lokasi tempat berkumpul para pengawas lapangan (View Point).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_19_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_19_true" name="kondisi_lokasi_19_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_19_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_19_false" name="kondisi_lokasi_19_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_19_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_19_na" name="kondisi_lokasi_19_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_19_note" id="kondisi_lokasi_19_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>20. Ada lokasi pengisian fuel (Fuel Station).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_20_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_20_true" name="kondisi_lokasi_20_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_20_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_20_false" name="kondisi_lokasi_20_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_20_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_20_na" name="kondisi_lokasi_20_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_20_note" id="kondisi_lokasi_20_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>21. Ada area zona kritis dari Geotek (Crack, Sliding) dalam radius kurang dari 500 meter.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kondisi_lokasi_21_true" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_21_true" name="kondisi_lokasi_21_check" value="true" required /> Ya</label>
                                        <label for="kondisi_lokasi_21_false" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_21_false" name="kondisi_lokasi_21_check" value="false" /> Tidak</label>
                                        <label for="kondisi_lokasi_21_na" class="me-3 px-2 py-2"><input type="radio" id="kondisi_lokasi_21_na" name="kondisi_lokasi_21_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kondisi_lokasi_21_note" id="kondisi_lokasi_21_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan catatan..."></textarea>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="diketahui">Diketahui</label>
                                        <select class="form-control form-control-sm pb-2" id="diketahui" name="diketahui" data-trigger>
                                            <option selected disabled></option>
                                            @foreach ($users['diketahui'] as $si)
                                                <option value="{{ $si->nik }}">{{ $si->name }} ({{ $si->position }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="disetujui">Disetujui</label>
                                        <select class="form-control form-control-sm pb-2" id="disetujui" name="disetujui" data-trigger>
                                            <option selected disabled></option>
                                            @foreach ($users['disetujui'] as $si)
                                                <option value="{{ $si->nik }}">{{ $si->name }} ({{ $si->position }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="upload-grid">
                                        <div class="upload-card">
                                            <label>Dokumentasi/Evidence 1</label>
                                            <input type="file" class="form-control form-control-sm" name="dokumentasi_1" accept="image/*">
                                            <div class="upload-note">Format disarankan: JPG, PNG, WEBP.</div>
                                        </div>
                                        <div class="upload-card">
                                            <label>Dokumentasi/Evidence 2 (jika ada)</label>
                                            <input type="file" class="form-control form-control-sm" name="dokumentasi_2" accept="image/*">
                                            <div class="upload-note">Opsional, isi jika ada dokumentasi tambahan.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHAreaBlasting">
                                        Submit
                                    </button>
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

    const formKLKHAreaBlasting = document.getElementById('submitFormKLKHAreaBlasting');
    const submitButtonKLKHAreaBlasting = document.getElementById('submitButtonKLKHAreaBlasting');

    formKLKHAreaBlasting.addEventListener('submit', function() {
    
        submitButtonKLKHAreaBlasting.disabled = true;
        submitButtonKLKHAreaBlasting.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHAreaBlasting.disabled = false;
            submitButtonKLKHAreaBlasting.innerText = 'Submit';
        }, 7000);
    });
</script>

<script>
    window.onload = function() {
        var currentDate = new Date();

        // Format tanggal Indonesia (DD-MM-YYYY)
        var dd = ("0" + currentDate.getDate()).slice(-2); 
        var mm = ("0" + (currentDate.getMonth() + 1)).slice(-2); 
        var yyyy = currentDate.getFullYear();
        var formattedDate = yyyy + "-" + mm + "-" + dd;

        var hours = ("0" + currentDate.getHours()).slice(-2); 
        var minutes = ("0" + currentDate.getMinutes()).slice(-2); 
        var formattedTime = hours + ":" + minutes;

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
