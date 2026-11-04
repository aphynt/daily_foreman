@include('layout.head', ['title' => 'KLKH Washing Bay'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Washing Bay</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.washingbay.post') }}" method="POST" id="submitFormKLKHWashingbay" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control form-control-sm pb-2 mt-2" placeholder="Lokasi Pemeriksaan" required />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Hari / Tanggal</label>
                                        <input type="date" name="date" id="date" class="form-control form-control-sm pb-2" required />
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="time">Jam</label>
                                        <input type="time" name="time" id="time" class="form-control form-control-sm pb-2" required />
                                    </div>
                                </div>
                                <hr>
                                <h5>1. Bangunan dan Fasilitas</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>1.1. Lantai rata, diconcrete, dan tidak sempit.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_1_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_1_true" name="bangunan_fasilitas_1_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_1_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_1_false" name="bangunan_fasilitas_1_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_1_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_1_na" name="bangunan_fasilitas_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_1_note" id="bangunan_fasilitas_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2. Area pencucian bersih, tidak becek dan tidak berlumpur.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_2_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_2_true" name="bangunan_fasilitas_2_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_2_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_2_false" name="bangunan_fasilitas_2_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_2_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_2_na" name="bangunan_fasilitas_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_2_note" id="bangunan_fasilitas_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3. Akses jalan keluar masuk Room Washing Bay rata dan tidak becek.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_3_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_3_true" name="bangunan_fasilitas_3_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_3_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_3_false" name="bangunan_fasilitas_3_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_3_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_3_na" name="bangunan_fasilitas_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_3_note" id="bangunan_fasilitas_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4. Rata, tidak becek, dan tidak ada ceceran oli.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_4_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_4_true" name="bangunan_fasilitas_4_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_4_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_4_false" name="bangunan_fasilitas_4_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_4_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_4_na" name="bangunan_fasilitas_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_4_note" id="bangunan_fasilitas_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.5. Denah evakuasi ditempel dengan jelas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_5_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_5_true" name="bangunan_fasilitas_5_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_5_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_5_false" name="bangunan_fasilitas_5_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_5_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_5_na" name="bangunan_fasilitas_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_5_note" id="bangunan_fasilitas_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.6. Terdapat toilet, kamar mandi, cuci tangan, eye wash, dan sabun cuci.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="bangunan_fasilitas_6_true" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_6_true" name="bangunan_fasilitas_6_check" value="true" required /> Ya</label>
                                        <label for="bangunan_fasilitas_6_false" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_6_false" name="bangunan_fasilitas_6_check" value="false" /> Tidak</label>
                                        <label for="bangunan_fasilitas_6_na" class="me-3 px-2 py-2"><input type="radio" id="bangunan_fasilitas_6_na" name="bangunan_fasilitas_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="bangunan_fasilitas_6_note" id="bangunan_fasilitas_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>2. Tempat Parkiran Kendaraan</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1. Rata, tidak becek, dan tidak ada ceceran oli.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="parkiran_kendaraan_1_true" class="me-3 px-2 py-2"><input type="radio" id="parkiran_kendaraan_1_true" name="parkiran_kendaraan_1_check" value="true" required /> Ya</label>
                                        <label for="parkiran_kendaraan_1_false" class="me-3 px-2 py-2"><input type="radio" id="parkiran_kendaraan_1_false" name="parkiran_kendaraan_1_check" value="false" /> Tidak</label>
                                        <label for="parkiran_kendaraan_1_na" class="me-3 px-2 py-2"><input type="radio" id="parkiran_kendaraan_1_na" name="parkiran_kendaraan_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="parkiran_kendaraan_1_note" id="parkiran_kendaraan_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>3. Peralatan Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>3.1. Ditata dengan rapi dan tidak berserakan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="peralatan_kerja_1_true" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_true" name="peralatan_kerja_1_check" value="true" required /> Ya</label>
                                        <label for="peralatan_kerja_1_false" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_false" name="peralatan_kerja_1_check" value="false" /> Tidak</label>
                                        <label for="peralatan_kerja_1_na" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_na" name="peralatan_kerja_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="peralatan_kerja_1_note" id="peralatan_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>4. Prosedur Lotto</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>4.1. Dipasang pada saat pencucian unit sedang berjalan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="prosedur_lotto_1_true" class="me-3 px-2 py-2"><input type="radio" id="prosedur_lotto_1_true" name="prosedur_lotto_1_check" value="true" required /> Ya</label>
                                        <label for="prosedur_lotto_1_false" class="me-3 px-2 py-2"><input type="radio" id="prosedur_lotto_1_false" name="prosedur_lotto_1_check" value="false" /> Tidak</label>
                                        <label for="prosedur_lotto_1_na" class="me-3 px-2 py-2"><input type="radio" id="prosedur_lotto_1_na" name="prosedur_lotto_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="prosedur_lotto_1_note" id="prosedur_lotto_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2. Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="prosedur_lotto_2_true" class="me-3 px-2 py-2"><input type="radio" id="prosedur_lotto_2_true" name="prosedur_lotto_2_check" value="true" required /> Ya</label>
                                        <label for="prosedur_lotto_2_false" class="me-3 px-2 py-2"><input type="radio" id="prosedur_lotto_2_false" name="prosedur_lotto_2_check" value="false" /> Tidak</label>
                                        <label for="prosedur_lotto_2_na" class="me-3 px-2 py-2"><input type="radio" id="prosedur_lotto_2_na" name="prosedur_lotto_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="prosedur_lotto_2_note" id="prosedur_lotto_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>5. Rambu-rambu Bahaya</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>5.1. Terdapat rambu-rambu jalan masuk/keluar dan wajib stopper bagi kendaraan HD dan A2B yang lain.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_1_true" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_true" name="rambu_bahaya_1_check" value="true" required /> Ya</label>
                                        <label for="rambu_bahaya_1_false" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_false" name="rambu_bahaya_1_check" value="false" /> Tidak</label>
                                        <label for="rambu_bahaya_1_na" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_na" name="rambu_bahaya_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_1_note" id="rambu_bahaya_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2. Instruksi/gambar APD yang harus digunakan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_2_true" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_2_true" name="rambu_bahaya_2_check" value="true" required /> Ya</label>
                                        <label for="rambu_bahaya_2_false" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_2_false" name="rambu_bahaya_2_check" value="false" /> Tidak</label>
                                        <label for="rambu_bahaya_2_na" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_2_na" name="rambu_bahaya_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_2_note" id="rambu_bahaya_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3. Muster point terpasang.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_3_true" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_3_true" name="rambu_bahaya_3_check" value="true" required /> Ya</label>
                                        <label for="rambu_bahaya_3_false" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_3_false" name="rambu_bahaya_3_check" value="false" /> Tidak</label>
                                        <label for="rambu_bahaya_3_na" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_3_na" name="rambu_bahaya_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_3_note" id="rambu_bahaya_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>6. Lampu Penerangan</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>6.1. Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lampu_penerangan_1_true" class="me-3 px-2 py-2"><input type="radio" id="lampu_penerangan_1_true" name="lampu_penerangan_1_check" value="true" required /> Ya</label>
                                        <label for="lampu_penerangan_1_false" class="me-3 px-2 py-2"><input type="radio" id="lampu_penerangan_1_false" name="lampu_penerangan_1_check" value="false" /> Tidak</label>
                                        <label for="lampu_penerangan_1_na" class="me-3 px-2 py-2"><input type="radio" id="lampu_penerangan_1_na" name="lampu_penerangan_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="lampu_penerangan_1_note" id="lampu_penerangan_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2. Lampu emergency berfungsi dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lampu_penerangan_2_true" class="me-3 px-2 py-2"><input type="radio" id="lampu_penerangan_2_true" name="lampu_penerangan_2_check" value="true" required /> Ya</label>
                                        <label for="lampu_penerangan_2_false" class="me-3 px-2 py-2"><input type="radio" id="lampu_penerangan_2_false" name="lampu_penerangan_2_check" value="false" /> Tidak</label>
                                        <label for="lampu_penerangan_2_na" class="me-3 px-2 py-2"><input type="radio" id="lampu_penerangan_2_na" name="lampu_penerangan_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="lampu_penerangan_2_note" id="lampu_penerangan_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>7. Electric Pump Washing</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>7.1. Kabel tidak terkelupas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_pump_1_true" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_1_true" name="electric_pump_1_check" value="true" required /> Ya</label>
                                        <label for="electric_pump_1_false" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_1_false" name="electric_pump_1_check" value="false" /> Tidak</label>
                                        <label for="electric_pump_1_na" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_1_na" name="electric_pump_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_pump_1_note" id="electric_pump_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2. Kabel dari bahan berkualitas baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_pump_2_true" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_2_true" name="electric_pump_2_check" value="true" required /> Ya</label>
                                        <label for="electric_pump_2_false" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_2_false" name="electric_pump_2_check" value="false" /> Tidak</label>
                                        <label for="electric_pump_2_na" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_2_na" name="electric_pump_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_pump_2_note" id="electric_pump_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3. Stop kontak, saklar, dan isolasi berfungsi dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_pump_3_true" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_3_true" name="electric_pump_3_check" value="true" required /> Ya</label>
                                        <label for="electric_pump_3_false" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_3_false" name="electric_pump_3_check" value="false" /> Tidak</label>
                                        <label for="electric_pump_3_na" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_3_na" name="electric_pump_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_pump_3_note" id="electric_pump_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.4. Energi listrik/mesin-mesin menyala saat beraktivitas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electric_pump_4_true" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_4_true" name="electric_pump_4_check" value="true" required /> Ya</label>
                                        <label for="electric_pump_4_false" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_4_false" name="electric_pump_4_check" value="false" /> Tidak</label>
                                        <label for="electric_pump_4_na" class="me-3 px-2 py-2"><input type="radio" id="electric_pump_4_na" name="electric_pump_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electric_pump_4_note" id="electric_pump_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>8. Tangki Penampungan Air Washing Bay</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>8.1. Kondisi pondasi tangki air rata dan tidak miring.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tangki_air_1_true" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_1_true" name="tangki_air_1_check" value="true" required /> Ya</label>
                                        <label for="tangki_air_1_false" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_1_false" name="tangki_air_1_check" value="false" /> Tidak</label>
                                        <label for="tangki_air_1_na" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_1_na" name="tangki_air_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tangki_air_1_note" id="tangki_air_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.2. Terdapat tangga standar untuk turun naik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tangki_air_2_true" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_2_true" name="tangki_air_2_check" value="true" required /> Ya</label>
                                        <label for="tangki_air_2_false" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_2_false" name="tangki_air_2_check" value="false" /> Tidak</label>
                                        <label for="tangki_air_2_na" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_2_na" name="tangki_air_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tangki_air_2_note" id="tangki_air_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.3. Terdapat pagar pengaman di sekeliling atas tangki air.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tangki_air_3_true" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_3_true" name="tangki_air_3_check" value="true" required /> Ya</label>
                                        <label for="tangki_air_3_false" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_3_false" name="tangki_air_3_check" value="false" /> Tidak</label>
                                        <label for="tangki_air_3_na" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_3_na" name="tangki_air_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tangki_air_3_note" id="tangki_air_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.4. Tidak ada kebocoran pada area tangki air.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="tangki_air_4_true" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_4_true" name="tangki_air_4_check" value="true" required /> Ya</label>
                                        <label for="tangki_air_4_false" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_4_false" name="tangki_air_4_check" value="false" /> Tidak</label>
                                        <label for="tangki_air_4_na" class="me-3 px-2 py-2"><input type="radio" id="tangki_air_4_na" name="tangki_air_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="tangki_air_4_note" id="tangki_air_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>9. Sistem Loto</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>9.1. Dipasang pada saat pencucian unit sedang berjalan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sistem_loto_1_true" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_true" name="sistem_loto_1_check" value="true" required /> Ya</label>
                                        <label for="sistem_loto_1_false" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_false" name="sistem_loto_1_check" value="false" /> Tidak</label>
                                        <label for="sistem_loto_1_na" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_na" name="sistem_loto_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sistem_loto_1_note" id="sistem_loto_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9.2. Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sistem_loto_2_true" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_true" name="sistem_loto_2_check" value="true" required /> Ya</label>
                                        <label for="sistem_loto_2_false" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_false" name="sistem_loto_2_check" value="false" /> Tidak</label>
                                        <label for="sistem_loto_2_na" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_na" name="sistem_loto_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sistem_loto_2_note" id="sistem_loto_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>10. Selang &amp; Air</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>10.1. Berkualitas baik dan tanpa sambungan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="selang_air_1_true" class="me-3 px-2 py-2"><input type="radio" id="selang_air_1_true" name="selang_air_1_check" value="true" required /> Ya</label>
                                        <label for="selang_air_1_false" class="me-3 px-2 py-2"><input type="radio" id="selang_air_1_false" name="selang_air_1_check" value="false" /> Tidak</label>
                                        <label for="selang_air_1_na" class="me-3 px-2 py-2"><input type="radio" id="selang_air_1_na" name="selang_air_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="selang_air_1_note" id="selang_air_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10.2. Terdapat larangan menggunakan pressure air ke anggota badan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="selang_air_2_true" class="me-3 px-2 py-2"><input type="radio" id="selang_air_2_true" name="selang_air_2_check" value="true" required /> Ya</label>
                                        <label for="selang_air_2_false" class="me-3 px-2 py-2"><input type="radio" id="selang_air_2_false" name="selang_air_2_check" value="false" /> Tidak</label>
                                        <label for="selang_air_2_na" class="me-3 px-2 py-2"><input type="radio" id="selang_air_2_na" name="selang_air_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="selang_air_2_note" id="selang_air_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>11. APAR</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>11.1. Jumlahnya memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_1_true" class="me-3 px-2 py-2"><input type="radio" id="apar_1_true" name="apar_1_check" value="true" required /> Ya</label>
                                        <label for="apar_1_false" class="me-3 px-2 py-2"><input type="radio" id="apar_1_false" name="apar_1_check" value="false" /> Tidak</label>
                                        <label for="apar_1_na" class="me-3 px-2 py-2"><input type="radio" id="apar_1_na" name="apar_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_1_note" id="apar_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>11.2. Mudah dilihat dan dapat dijangkau.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_2_true" class="me-3 px-2 py-2"><input type="radio" id="apar_2_true" name="apar_2_check" value="true" required /> Ya</label>
                                        <label for="apar_2_false" class="me-3 px-2 py-2"><input type="radio" id="apar_2_false" name="apar_2_check" value="false" /> Tidak</label>
                                        <label for="apar_2_na" class="me-3 px-2 py-2"><input type="radio" id="apar_2_na" name="apar_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_2_note" id="apar_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>11.3. Tekanan APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_3_true" class="me-3 px-2 py-2"><input type="radio" id="apar_3_true" name="apar_3_check" value="true" required /> Ya</label>
                                        <label for="apar_3_false" class="me-3 px-2 py-2"><input type="radio" id="apar_3_false" name="apar_3_check" value="false" /> Tidak</label>
                                        <label for="apar_3_na" class="me-3 px-2 py-2"><input type="radio" id="apar_3_na" name="apar_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_3_note" id="apar_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>11.4. Isi APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_4_true" class="me-3 px-2 py-2"><input type="radio" id="apar_4_true" name="apar_4_check" value="true" required /> Ya</label>
                                        <label for="apar_4_false" class="me-3 px-2 py-2"><input type="radio" id="apar_4_false" name="apar_4_check" value="false" /> Tidak</label>
                                        <label for="apar_4_na" class="me-3 px-2 py-2"><input type="radio" id="apar_4_na" name="apar_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_4_note" id="apar_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>12. Room Washing Man</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>12.1. Dilarang menyalakan api atau merokok.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="room_washing_1_true" class="me-3 px-2 py-2"><input type="radio" id="room_washing_1_true" name="room_washing_1_check" value="true" required /> Ya</label>
                                        <label for="room_washing_1_false" class="me-3 px-2 py-2"><input type="radio" id="room_washing_1_false" name="room_washing_1_check" value="false" /> Tidak</label>
                                        <label for="room_washing_1_na" class="me-3 px-2 py-2"><input type="radio" id="room_washing_1_na" name="room_washing_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="room_washing_1_note" id="room_washing_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>12.2. Ruangan tertata rapi dan bersih.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="room_washing_2_true" class="me-3 px-2 py-2"><input type="radio" id="room_washing_2_true" name="room_washing_2_check" value="true" required /> Ya</label>
                                        <label for="room_washing_2_false" class="me-3 px-2 py-2"><input type="radio" id="room_washing_2_false" name="room_washing_2_check" value="false" /> Tidak</label>
                                        <label for="room_washing_2_na" class="me-3 px-2 py-2"><input type="radio" id="room_washing_2_na" name="room_washing_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="room_washing_2_note" id="room_washing_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>12.3. Terdapat fasilitas komunikasi radio.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="room_washing_3_true" class="me-3 px-2 py-2"><input type="radio" id="room_washing_3_true" name="room_washing_3_check" value="true" required /> Ya</label>
                                        <label for="room_washing_3_false" class="me-3 px-2 py-2"><input type="radio" id="room_washing_3_false" name="room_washing_3_check" value="false" /> Tidak</label>
                                        <label for="room_washing_3_na" class="me-3 px-2 py-2"><input type="radio" id="room_washing_3_na" name="room_washing_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="room_washing_3_note" id="room_washing_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>12.4. Penerangan ruangan operator memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="room_washing_4_true" class="me-3 px-2 py-2"><input type="radio" id="room_washing_4_true" name="room_washing_4_check" value="true" required /> Ya</label>
                                        <label for="room_washing_4_false" class="me-3 px-2 py-2"><input type="radio" id="room_washing_4_false" name="room_washing_4_check" value="false" /> Tidak</label>
                                        <label for="room_washing_4_na" class="me-3 px-2 py-2"><input type="radio" id="room_washing_4_na" name="room_washing_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="room_washing_4_note" id="room_washing_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>13. Tempat Sampah Domestik</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>13.1. Kelayakan tempat sampah, bertutup dan tidak bocor.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_1_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_true" name="sampah_domestik_1_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_1_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_false" name="sampah_domestik_1_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_1_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_na" name="sampah_domestik_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_1_note" id="sampah_domestik_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>13.2. Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_2_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_true" name="sampah_domestik_2_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_2_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_false" name="sampah_domestik_2_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_2_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_na" name="sampah_domestik_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_2_note" id="sampah_domestik_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>13.3. Sampah dibuang ke tempat pembuangan sampah.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_3_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_3_true" name="sampah_domestik_3_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_3_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_3_false" name="sampah_domestik_3_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_3_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_3_na" name="sampah_domestik_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_3_note" id="sampah_domestik_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>14. Kolam Kompartemen</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>14.1. Terdapat sistem pengendapan lumpur pada bak penampung.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kolam_kompartemen_1_true" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_1_true" name="kolam_kompartemen_1_check" value="true" required /> Ya</label>
                                        <label for="kolam_kompartemen_1_false" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_1_false" name="kolam_kompartemen_1_check" value="false" /> Tidak</label>
                                        <label for="kolam_kompartemen_1_na" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_1_na" name="kolam_kompartemen_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kolam_kompartemen_1_note" id="kolam_kompartemen_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>14.2. Pengurasan lumpur terjadwal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kolam_kompartemen_2_true" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_2_true" name="kolam_kompartemen_2_check" value="true" required /> Ya</label>
                                        <label for="kolam_kompartemen_2_false" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_2_false" name="kolam_kompartemen_2_check" value="false" /> Tidak</label>
                                        <label for="kolam_kompartemen_2_na" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_2_na" name="kolam_kompartemen_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kolam_kompartemen_2_note" id="kolam_kompartemen_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>14.3. Tidak ada air yang keluar dari kompartemen akhir.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kolam_kompartemen_3_true" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_3_true" name="kolam_kompartemen_3_check" value="true" required /> Ya</label>
                                        <label for="kolam_kompartemen_3_false" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_3_false" name="kolam_kompartemen_3_check" value="false" /> Tidak</label>
                                        <label for="kolam_kompartemen_3_na" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_3_na" name="kolam_kompartemen_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kolam_kompartemen_3_note" id="kolam_kompartemen_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>14.4. Kompartemen ke-5 tidak mengandung minyak atau oli.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kolam_kompartemen_4_true" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_4_true" name="kolam_kompartemen_4_check" value="true" required /> Ya</label>
                                        <label for="kolam_kompartemen_4_false" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_4_false" name="kolam_kompartemen_4_check" value="false" /> Tidak</label>
                                        <label for="kolam_kompartemen_4_na" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_4_na" name="kolam_kompartemen_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kolam_kompartemen_4_note" id="kolam_kompartemen_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>14.5. Penggunaan kembali air pada kompartemen akhir menggunakan pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kolam_kompartemen_5_true" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_5_true" name="kolam_kompartemen_5_check" value="true" required /> Ya</label>
                                        <label for="kolam_kompartemen_5_false" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_5_false" name="kolam_kompartemen_5_check" value="false" /> Tidak</label>
                                        <label for="kolam_kompartemen_5_na" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_5_na" name="kolam_kompartemen_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kolam_kompartemen_5_note" id="kolam_kompartemen_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>14.6. Terdapat pagar pengaman sekeliling kolam kompartemen.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="kolam_kompartemen_6_true" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_6_true" name="kolam_kompartemen_6_check" value="true" required /> Ya</label>
                                        <label for="kolam_kompartemen_6_false" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_6_false" name="kolam_kompartemen_6_check" value="false" /> Tidak</label>
                                        <label for="kolam_kompartemen_6_na" class="me-3 px-2 py-2"><input type="radio" id="kolam_kompartemen_6_na" name="kolam_kompartemen_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="kolam_kompartemen_6_note" id="kolam_kompartemen_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>15. Limbah B3</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>15.1. Limbah oli, limbah solar, dan majun terkontaminasi oli/grease dikelola dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="limbah_b3_1_true" class="me-3 px-2 py-2"><input type="radio" id="limbah_b3_1_true" name="limbah_b3_1_check" value="true" required /> Ya</label>
                                        <label for="limbah_b3_1_false" class="me-3 px-2 py-2"><input type="radio" id="limbah_b3_1_false" name="limbah_b3_1_check" value="false" /> Tidak</label>
                                        <label for="limbah_b3_1_na" class="me-3 px-2 py-2"><input type="radio" id="limbah_b3_1_na" name="limbah_b3_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="limbah_b3_1_note" id="limbah_b3_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="additional_notes">Catatan Tambahan</label>
                                    <textarea name="additional_notes" id="additional_notes" class="form-control form-control-sm pb-2 mt-2" rows="3" placeholder="Catatan Tambahan"></textarea>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="diketahui">Diperiksa</label>
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHWashingBay">
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

    const formKLKHWashingBay = document.getElementById('submitFormKLKHWashingBay');
    const submitButtonKLKHWashingBay = document.getElementById('submitButtonKLKHWashingBay');

    formKLKHWashingBay.addEventListener('submit', function() {
    
        submitButtonKLKHWashingBay.disabled = true;
        submitButtonKLKHWashingBay.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHWashingBay.disabled = false;
            submitButtonKLKHWashingBay.innerText = 'Submit';
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
