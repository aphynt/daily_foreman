@include('layout.head', ['title' => 'KLKH Workshop Electric'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Workshop Electric</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.workshopelectric.post') }}" method="POST" id="submitFormKLKHWorkshopElectric" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control form-control-sm pb-2 mt-2" placeholder="Lokasi" value="Workshop Electric" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="date">Hari/ Tanggal</label>
                                        <input type="date" class="form-control form-control-sm pb-2" id="date" name="date" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="time">Jam</label>
                                        <input type="time" class="form-control form-control-sm pb-2" id="time" name="time" required>
                                    </div>
                                </div>
                                <hr>
                                <h5>Ruangan dan Fasilitas</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="ruangan_fasilitas_1_check">1. Terdapat Rak Arsip (SOP, JSA, Buku Service).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ruangan_fasilitas_1_true" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_1_true" name="ruangan_fasilitas_1_check" value="true" required /> Ya</label>
                                        <label for="ruangan_fasilitas_1_false" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_1_false" name="ruangan_fasilitas_1_check" value="false" /> Tidak</label>
                                        <label for="ruangan_fasilitas_1_na" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_1_na" name="ruangan_fasilitas_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="ruangan_fasilitas_1_note" id="ruangan_fasilitas_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="ruangan_fasilitas_2_check">2. Terdapat ruang tools room yang memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ruangan_fasilitas_2_true" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_2_true" name="ruangan_fasilitas_2_check" value="true" required /> Ya</label>
                                        <label for="ruangan_fasilitas_2_false" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_2_false" name="ruangan_fasilitas_2_check" value="false" /> Tidak</label>
                                        <label for="ruangan_fasilitas_2_na" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_2_na" name="ruangan_fasilitas_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="ruangan_fasilitas_2_note" id="ruangan_fasilitas_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="ruangan_fasilitas_3_check">3. Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ruangan_fasilitas_3_true" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_3_true" name="ruangan_fasilitas_3_check" value="true" required /> Ya</label>
                                        <label for="ruangan_fasilitas_3_false" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_3_false" name="ruangan_fasilitas_3_check" value="false" /> Tidak</label>
                                        <label for="ruangan_fasilitas_3_na" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_3_na" name="ruangan_fasilitas_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="ruangan_fasilitas_3_note" id="ruangan_fasilitas_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="ruangan_fasilitas_4_check">4. Lampu emergency berfungsi dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="ruangan_fasilitas_4_true" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_4_true" name="ruangan_fasilitas_4_check" value="true" required /> Ya</label>
                                        <label for="ruangan_fasilitas_4_false" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_4_false" name="ruangan_fasilitas_4_check" value="false" /> Tidak</label>
                                        <label for="ruangan_fasilitas_4_na" class="me-3 px-2 py-2"><input type="radio" id="ruangan_fasilitas_4_na" name="ruangan_fasilitas_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="ruangan_fasilitas_4_note" id="ruangan_fasilitas_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Lantai Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="lantai_kerja_1_check">1. Kebersihan lantai dijaga.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="lantai_kerja_1_true" class="me-3 px-2 py-2"><input type="radio" id="lantai_kerja_1_true" name="lantai_kerja_1_check" value="true" required /> Ya</label>
                                        <label for="lantai_kerja_1_false" class="me-3 px-2 py-2"><input type="radio" id="lantai_kerja_1_false" name="lantai_kerja_1_check" value="false" /> Tidak</label>
                                        <label for="lantai_kerja_1_na" class="me-3 px-2 py-2"><input type="radio" id="lantai_kerja_1_na" name="lantai_kerja_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="lantai_kerja_1_note" id="lantai_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Peralatan Kerja</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="peralatan_kerja_1_check">1. Ditata dengan rapi, tidak berserakan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="peralatan_kerja_1_true" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_true" name="peralatan_kerja_1_check" value="true" required /> Ya</label>
                                        <label for="peralatan_kerja_1_false" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_false" name="peralatan_kerja_1_check" value="false" /> Tidak</label>
                                        <label for="peralatan_kerja_1_na" class="me-3 px-2 py-2"><input type="radio" id="peralatan_kerja_1_na" name="peralatan_kerja_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="peralatan_kerja_1_note" id="peralatan_kerja_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Electrical</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="electrical_1_check">1. Kabel tidak terkelupas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electrical_1_true" class="me-3 px-2 py-2"><input type="radio" id="electrical_1_true" name="electrical_1_check" value="true" required /> Ya</label>
                                        <label for="electrical_1_false" class="me-3 px-2 py-2"><input type="radio" id="electrical_1_false" name="electrical_1_check" value="false" /> Tidak</label>
                                        <label for="electrical_1_na" class="me-3 px-2 py-2"><input type="radio" id="electrical_1_na" name="electrical_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electrical_1_note" id="electrical_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electrical_2_check">2. Kabel berkualitas baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electrical_2_true" class="me-3 px-2 py-2"><input type="radio" id="electrical_2_true" name="electrical_2_check" value="true" required /> Ya</label>
                                        <label for="electrical_2_false" class="me-3 px-2 py-2"><input type="radio" id="electrical_2_false" name="electrical_2_check" value="false" /> Tidak</label>
                                        <label for="electrical_2_na" class="me-3 px-2 py-2"><input type="radio" id="electrical_2_na" name="electrical_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electrical_2_note" id="electrical_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electrical_3_check">3. Colokan / sambungan ke sumber listrik cukup aman.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electrical_3_true" class="me-3 px-2 py-2"><input type="radio" id="electrical_3_true" name="electrical_3_check" value="true" required /> Ya</label>
                                        <label for="electrical_3_false" class="me-3 px-2 py-2"><input type="radio" id="electrical_3_false" name="electrical_3_check" value="false" /> Tidak</label>
                                        <label for="electrical_3_na" class="me-3 px-2 py-2"><input type="radio" id="electrical_3_na" name="electrical_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electrical_3_note" id="electrical_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="electrical_4_check">4. Energi listrik / mesin-mesin menyala tanpa aktivitas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="electrical_4_true" class="me-3 px-2 py-2"><input type="radio" id="electrical_4_true" name="electrical_4_check" value="true" required /> Ya</label>
                                        <label for="electrical_4_false" class="me-3 px-2 py-2"><input type="radio" id="electrical_4_false" name="electrical_4_check" value="false" /> Tidak</label>
                                        <label for="electrical_4_na" class="me-3 px-2 py-2"><input type="radio" id="electrical_4_na" name="electrical_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="electrical_4_note" id="electrical_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Sistem Loto</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="sistem_loto_1_check">1. Dipasang pada saat peralatan mesin diservice.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sistem_loto_1_true" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_true" name="sistem_loto_1_check" value="true" required /> Ya</label>
                                        <label for="sistem_loto_1_false" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_false" name="sistem_loto_1_check" value="false" /> Tidak</label>
                                        <label for="sistem_loto_1_na" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_1_na" name="sistem_loto_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sistem_loto_1_note" id="sistem_loto_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sistem_loto_2_check">2. Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sistem_loto_2_true" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_true" name="sistem_loto_2_check" value="true" required /> Ya</label>
                                        <label for="sistem_loto_2_false" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_false" name="sistem_loto_2_check" value="false" /> Tidak</label>
                                        <label for="sistem_loto_2_na" class="me-3 px-2 py-2"><input type="radio" id="sistem_loto_2_na" name="sistem_loto_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sistem_loto_2_note" id="sistem_loto_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Sparepart Bekas (Bisa Dipakai)</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="sparepart_bekas_1_check">1. Dirapikan dan dikelompokkan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sparepart_bekas_1_true" class="me-3 px-2 py-2"><input type="radio" id="sparepart_bekas_1_true" name="sparepart_bekas_1_check" value="true" required /> Ya</label>
                                        <label for="sparepart_bekas_1_false" class="me-3 px-2 py-2"><input type="radio" id="sparepart_bekas_1_false" name="sparepart_bekas_1_check" value="false" /> Tidak</label>
                                        <label for="sparepart_bekas_1_na" class="me-3 px-2 py-2"><input type="radio" id="sparepart_bekas_1_na" name="sparepart_bekas_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sparepart_bekas_1_note" id="sparepart_bekas_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>APAR</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_1_check">1. Jumlahnya memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_1_true" class="me-3 px-2 py-2"><input type="radio" id="apar_1_true" name="apar_1_check" value="true" required /> Ya</label>
                                        <label for="apar_1_false" class="me-3 px-2 py-2"><input type="radio" id="apar_1_false" name="apar_1_check" value="false" /> Tidak</label>
                                        <label for="apar_1_na" class="me-3 px-2 py-2"><input type="radio" id="apar_1_na" name="apar_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_1_note" id="apar_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_2_check">2. Mudah dilihat dan dapat dijangkau.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_2_true" class="me-3 px-2 py-2"><input type="radio" id="apar_2_true" name="apar_2_check" value="true" required /> Ya</label>
                                        <label for="apar_2_false" class="me-3 px-2 py-2"><input type="radio" id="apar_2_false" name="apar_2_check" value="false" /> Tidak</label>
                                        <label for="apar_2_na" class="me-3 px-2 py-2"><input type="radio" id="apar_2_na" name="apar_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_2_note" id="apar_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_3_check">3. Tekanan APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_3_true" class="me-3 px-2 py-2"><input type="radio" id="apar_3_true" name="apar_3_check" value="true" required /> Ya</label>
                                        <label for="apar_3_false" class="me-3 px-2 py-2"><input type="radio" id="apar_3_false" name="apar_3_check" value="false" /> Tidak</label>
                                        <label for="apar_3_na" class="me-3 px-2 py-2"><input type="radio" id="apar_3_na" name="apar_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_3_note" id="apar_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="apar_4_check">4. Isi APAR normal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="apar_4_true" class="me-3 px-2 py-2"><input type="radio" id="apar_4_true" name="apar_4_check" value="true" required /> Ya</label>
                                        <label for="apar_4_false" class="me-3 px-2 py-2"><input type="radio" id="apar_4_false" name="apar_4_check" value="false" /> Tidak</label>
                                        <label for="apar_4_na" class="me-3 px-2 py-2"><input type="radio" id="apar_4_na" name="apar_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="apar_4_note" id="apar_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Rambu-rambu Bahaya</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="rambu_bahaya_1_check">1. Dilarang menyalakan api / merokok.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="rambu_bahaya_1_true" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_true" name="rambu_bahaya_1_check" value="true" required /> Ya</label>
                                        <label for="rambu_bahaya_1_false" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_false" name="rambu_bahaya_1_check" value="false" /> Tidak</label>
                                        <label for="rambu_bahaya_1_na" class="me-3 px-2 py-2"><input type="radio" id="rambu_bahaya_1_na" name="rambu_bahaya_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="rambu_bahaya_1_note" id="rambu_bahaya_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Tempat Sampah Domestik</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_1_check">1. Kelayakan tempat sampah, bertutup dan tidak bocor.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_1_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_true" name="sampah_domestik_1_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_1_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_false" name="sampah_domestik_1_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_1_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_1_na" name="sampah_domestik_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_1_note" id="sampah_domestik_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="sampah_domestik_2_check">2. Sampah dibuang ke tempat pembuangan sampah.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="sampah_domestik_2_true" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_true" name="sampah_domestik_2_check" value="true" required /> Ya</label>
                                        <label for="sampah_domestik_2_false" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_false" name="sampah_domestik_2_check" value="false" /> Tidak</label>
                                        <label for="sampah_domestik_2_na" class="me-3 px-2 py-2"><input type="radio" id="sampah_domestik_2_na" name="sampah_domestik_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="sampah_domestik_2_note" id="sampah_domestik_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Generator Listrik</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="generator_listrik_1_check">1. Kabel listrik dari bahan berkualitas baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="generator_listrik_1_true" class="me-3 px-2 py-2"><input type="radio" id="generator_listrik_1_true" name="generator_listrik_1_check" value="true" required /> Ya</label>
                                        <label for="generator_listrik_1_false" class="me-3 px-2 py-2"><input type="radio" id="generator_listrik_1_false" name="generator_listrik_1_check" value="false" /> Tidak</label>
                                        <label for="generator_listrik_1_na" class="me-3 px-2 py-2"><input type="radio" id="generator_listrik_1_na" name="generator_listrik_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="generator_listrik_1_note" id="generator_listrik_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="generator_listrik_2_check">2. Stop kontak, saklar, isolasi berfungsi dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="generator_listrik_2_true" class="me-3 px-2 py-2"><input type="radio" id="generator_listrik_2_true" name="generator_listrik_2_check" value="true" required /> Ya</label>
                                        <label for="generator_listrik_2_false" class="me-3 px-2 py-2"><input type="radio" id="generator_listrik_2_false" name="generator_listrik_2_check" value="false" /> Tidak</label>
                                        <label for="generator_listrik_2_na" class="me-3 px-2 py-2"><input type="radio" id="generator_listrik_2_na" name="generator_listrik_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="generator_listrik_2_note" id="generator_listrik_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>Limbah B3</h5>
                                <hr>
                                <div class="mb-3">
                                    <label for="limbah_b3_1_check">1. Battery bekas dan accu dikelola dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="limbah_b3_1_true" class="me-3 px-2 py-2"><input type="radio" id="limbah_b3_1_true" name="limbah_b3_1_check" value="true" required /> Ya</label>
                                        <label for="limbah_b3_1_false" class="me-3 px-2 py-2"><input type="radio" id="limbah_b3_1_false" name="limbah_b3_1_check" value="false" /> Tidak</label>
                                        <label for="limbah_b3_1_na" class="me-3 px-2 py-2"><input type="radio" id="limbah_b3_1_na" name="limbah_b3_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="limbah_b3_1_note" id="limbah_b3_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <!-- Catatan -->
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHWorkshopElectric">
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

    const formKLKHWorkshopElectric = document.getElementById('submitFormKLKHWorkshopElectric');
    const submitButtonKLKHWorkshopElectric = document.getElementById('submitButtonKLKHWorkshopElectric');

    formKLKHWorkshopElectric.addEventListener('submit', function() {
    
        submitButtonKLKHWorkshopElectric.disabled = true;
        submitButtonKLKHWorkshopElectric.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHWorkshopElectric.disabled = false;
            submitButtonKLKHWorkshopElectric.innerText = 'Submit';
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
