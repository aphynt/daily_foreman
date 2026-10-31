@include('layout.head', ['title' => 'KLKH Dewatering'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>KLKH Dewatering</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('klkh.dewatering.post') }}" method="POST" id="submitFormKLKHDewatering" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="lokasi">Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control form-control-sm pb-2 mt-2" placeholder="Lokasi" required />
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label for="perusahaan">Perusahaan</label>
                                        <input type="text" name="perusahaan" id="perusahaan" class="form-control form-control-sm pb-2 mt-2" placeholder="Perusahaan" value="PT. SIMS JAYA KALTIM" required />
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
                                <h5>A. AREA POMPA PRIMER</h5>
                                <hr>
                                <h6>1. Akses Jalan Menuju Sump</h6>
                                <div class="mb-3">
                                    <label>1.1. Akses jalan menuju sump aman &amp; memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_1_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_1_1_true" name="primer_1_1_check" value="true" required /> Ya</label>
                                        <label for="primer_1_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_1_1_false" name="primer_1_1_check" value="false" /> Tidak</label>
                                        <label for="primer_1_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_1_1_na" name="primer_1_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_1_1_note" id="primer_1_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2. Tersedia area parkir.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_1_2_true" class="me-3 px-2 py-2"><input type="radio" id="primer_1_2_true" name="primer_1_2_check" value="true" required /> Ya</label>
                                        <label for="primer_1_2_false" class="me-3 px-2 py-2"><input type="radio" id="primer_1_2_false" name="primer_1_2_check" value="false" /> Tidak</label>
                                        <label for="primer_1_2_na" class="me-3 px-2 py-2"><input type="radio" id="primer_1_2_na" name="primer_1_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_1_2_note" id="primer_1_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>2. Akses Pekerja ke Tepi Sump</h6>
                                <div class="mb-3">
                                    <label>2.1. Tersedia tangga dilengkapi dengan handrail untuk area yang terdapat beda tinggi.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_2_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_2_1_true" name="primer_2_1_check" value="true" required /> Ya</label>
                                        <label for="primer_2_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_2_1_false" name="primer_2_1_check" value="false" /> Tidak</label>
                                        <label for="primer_2_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_2_1_na" name="primer_2_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_2_1_note" id="primer_2_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>3. Akses Pekerja ke Pompa</h6>
                                <div class="mb-3">
                                    <label>3.1. Tersedia perahu dilengkapi dengan informasi maksimum SWL &amp; Person.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_3_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_3_1_true" name="primer_3_1_check" value="true" required /> Ya</label>
                                        <label for="primer_3_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_3_1_false" name="primer_3_1_check" value="false" /> Tidak</label>
                                        <label for="primer_3_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_3_1_na" name="primer_3_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_3_1_note" id="primer_3_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2. Perahu tersedia 2 dayung.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_3_2_true" class="me-3 px-2 py-2"><input type="radio" id="primer_3_2_true" name="primer_3_2_check" value="true" required /> Ya</label>
                                        <label for="primer_3_2_false" class="me-3 px-2 py-2"><input type="radio" id="primer_3_2_false" name="primer_3_2_check" value="false" /> Tidak</label>
                                        <label for="primer_3_2_na" class="me-3 px-2 py-2"><input type="radio" id="primer_3_2_na" name="primer_3_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_3_2_note" id="primer_3_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3. Perahu layak digunakan (tidak menampung air, tidak bocor/rusak, tidak berubah bentuk).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_3_3_true" class="me-3 px-2 py-2"><input type="radio" id="primer_3_3_true" name="primer_3_3_check" value="true" required /> Ya</label>
                                        <label for="primer_3_3_false" class="me-3 px-2 py-2"><input type="radio" id="primer_3_3_false" name="primer_3_3_check" value="false" /> Tidak</label>
                                        <label for="primer_3_3_na" class="me-3 px-2 py-2"><input type="radio" id="primer_3_3_na" name="primer_3_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_3_3_note" id="primer_3_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4. Tersedia tali sebagai pengikat.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_3_4_true" class="me-3 px-2 py-2"><input type="radio" id="primer_3_4_true" name="primer_3_4_check" value="true" required /> Ya</label>
                                        <label for="primer_3_4_false" class="me-3 px-2 py-2"><input type="radio" id="primer_3_4_false" name="primer_3_4_check" value="false" /> Tidak</label>
                                        <label for="primer_3_4_na" class="me-3 px-2 py-2"><input type="radio" id="primer_3_4_na" name="primer_3_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_3_4_note" id="primer_3_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.5. Tersedia kubus apung lebar 1,5 meter, handrail dilengkapi dengan tali.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_3_5_true" class="me-3 px-2 py-2"><input type="radio" id="primer_3_5_true" name="primer_3_5_check" value="true" required /> Ya</label>
                                        <label for="primer_3_5_false" class="me-3 px-2 py-2"><input type="radio" id="primer_3_5_false" name="primer_3_5_check" value="false" /> Tidak</label>
                                        <label for="primer_3_5_na" class="me-3 px-2 py-2"><input type="radio" id="primer_3_5_na" name="primer_3_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_3_5_note" id="primer_3_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.6. Akses tersambung dari darat hingga pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_3_6_true" class="me-3 px-2 py-2"><input type="radio" id="primer_3_6_true" name="primer_3_6_check" value="true" required /> Ya</label>
                                        <label for="primer_3_6_false" class="me-3 px-2 py-2"><input type="radio" id="primer_3_6_false" name="primer_3_6_check" value="false" /> Tidak</label>
                                        <label for="primer_3_6_na" class="me-3 px-2 py-2"><input type="radio" id="primer_3_6_na" name="primer_3_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_3_6_note" id="primer_3_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>4. Pondok</h6>
                                <div class="mb-3">
                                    <label>4.1. Pondok (tertutup) berada di darat.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_4_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_4_1_true" name="primer_4_1_check" value="true" required /> Ya</label>
                                        <label for="primer_4_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_4_1_false" name="primer_4_1_check" value="false" /> Tidak</label>
                                        <label for="primer_4_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_4_1_na" name="primer_4_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_4_1_note" id="primer_4_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2. Tersedia penerangan yang memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_4_2_true" class="me-3 px-2 py-2"><input type="radio" id="primer_4_2_true" name="primer_4_2_check" value="true" required /> Ya</label>
                                        <label for="primer_4_2_false" class="me-3 px-2 py-2"><input type="radio" id="primer_4_2_false" name="primer_4_2_check" value="false" /> Tidak</label>
                                        <label for="primer_4_2_na" class="me-3 px-2 py-2"><input type="radio" id="primer_4_2_na" name="primer_4_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_4_2_note" id="primer_4_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.3. Tersedia toilet dengan air bersih.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_4_3_true" class="me-3 px-2 py-2"><input type="radio" id="primer_4_3_true" name="primer_4_3_check" value="true" required /> Ya</label>
                                        <label for="primer_4_3_false" class="me-3 px-2 py-2"><input type="radio" id="primer_4_3_false" name="primer_4_3_check" value="false" /> Tidak</label>
                                        <label for="primer_4_3_na" class="me-3 px-2 py-2"><input type="radio" id="primer_4_3_na" name="primer_4_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_4_3_note" id="primer_4_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.4. Tersedia tempat sampah tertutup.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_4_4_true" class="me-3 px-2 py-2"><input type="radio" id="primer_4_4_true" name="primer_4_4_check" value="true" required /> Ya</label>
                                        <label for="primer_4_4_false" class="me-3 px-2 py-2"><input type="radio" id="primer_4_4_false" name="primer_4_4_check" value="false" /> Tidak</label>
                                        <label for="primer_4_4_na" class="me-3 px-2 py-2"><input type="radio" id="primer_4_4_na" name="primer_4_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_4_4_note" id="primer_4_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>5. Rambu &amp; Papan Informasi</h6>
                                <div class="mb-3">
                                    <label>5.1. Tersedia rambu/papan informasi area sump &amp; area terbatas.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_5_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_5_1_true" name="primer_5_1_check" value="true" required /> Ya</label>
                                        <label for="primer_5_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_5_1_false" name="primer_5_1_check" value="false" /> Tidak</label>
                                        <label for="primer_5_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_5_1_na" name="primer_5_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_5_1_note" id="primer_5_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2. Tersedia rambu informasi PIC area (Nama, No. telepon).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_5_2_true" class="me-3 px-2 py-2"><input type="radio" id="primer_5_2_true" name="primer_5_2_check" value="true" required /> Ya</label>
                                        <label for="primer_5_2_false" class="me-3 px-2 py-2"><input type="radio" id="primer_5_2_false" name="primer_5_2_check" value="false" /> Tidak</label>
                                        <label for="primer_5_2_na" class="me-3 px-2 py-2"><input type="radio" id="primer_5_2_na" name="primer_5_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_5_2_note" id="primer_5_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3. Tersedia rambu wajib APD (termasuk pelampung).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_5_3_true" class="me-3 px-2 py-2"><input type="radio" id="primer_5_3_true" name="primer_5_3_check" value="true" required /> Ya</label>
                                        <label for="primer_5_3_false" class="me-3 px-2 py-2"><input type="radio" id="primer_5_3_false" name="primer_5_3_check" value="false" /> Tidak</label>
                                        <label for="primer_5_3_na" class="me-3 px-2 py-2"><input type="radio" id="primer_5_3_na" name="primer_5_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_5_3_note" id="primer_5_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.4. Tersedia rambu channel radio.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_5_4_true" class="me-3 px-2 py-2"><input type="radio" id="primer_5_4_true" name="primer_5_4_check" value="true" required /> Ya</label>
                                        <label for="primer_5_4_false" class="me-3 px-2 py-2"><input type="radio" id="primer_5_4_false" name="primer_5_4_check" value="false" /> Tidak</label>
                                        <label for="primer_5_4_na" class="me-3 px-2 py-2"><input type="radio" id="primer_5_4_na" name="primer_5_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_5_4_note" id="primer_5_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5. Tersedia rambu emergency call.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_5_5_true" class="me-3 px-2 py-2"><input type="radio" id="primer_5_5_true" name="primer_5_5_check" value="true" required /> Ya</label>
                                        <label for="primer_5_5_false" class="me-3 px-2 py-2"><input type="radio" id="primer_5_5_false" name="primer_5_5_check" value="false" /> Tidak</label>
                                        <label for="primer_5_5_na" class="me-3 px-2 py-2"><input type="radio" id="primer_5_5_na" name="primer_5_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_5_5_note" id="primer_5_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.6. Tersedia rambu evakuasi dan muster point.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_5_6_true" class="me-3 px-2 py-2"><input type="radio" id="primer_5_6_true" name="primer_5_6_check" value="true" required /> Ya</label>
                                        <label for="primer_5_6_false" class="me-3 px-2 py-2"><input type="radio" id="primer_5_6_false" name="primer_5_6_check" value="false" /> Tidak</label>
                                        <label for="primer_5_6_na" class="me-3 px-2 py-2"><input type="radio" id="primer_5_6_na" name="primer_5_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_5_6_note" id="primer_5_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.7. Tersedia papan informasi sump (Elevasi air, lumpur, &amp; banjir).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_5_7_true" class="me-3 px-2 py-2"><input type="radio" id="primer_5_7_true" name="primer_5_7_check" value="true" required /> Ya</label>
                                        <label for="primer_5_7_false" class="me-3 px-2 py-2"><input type="radio" id="primer_5_7_false" name="primer_5_7_check" value="false" /> Tidak</label>
                                        <label for="primer_5_7_na" class="me-3 px-2 py-2"><input type="radio" id="primer_5_7_na" name="primer_5_7_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_5_7_note" id="primer_5_7_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>6. Pompa</h6>
                                <div class="mb-3">
                                    <label>6.1. Dilakukan inspeksi pompa secara rutin dan tersedia tagging kelayakan pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_6_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_6_1_true" name="primer_6_1_check" value="true" required /> Ya</label>
                                        <label for="primer_6_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_6_1_false" name="primer_6_1_check" value="false" /> Tidak</label>
                                        <label for="primer_6_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_6_1_na" name="primer_6_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_6_1_note" id="primer_6_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2. Pompa dilengkapi tali penambat dan posisi pompa stabil.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_6_2_true" class="me-3 px-2 py-2"><input type="radio" id="primer_6_2_true" name="primer_6_2_check" value="true" required /> Ya</label>
                                        <label for="primer_6_2_false" class="me-3 px-2 py-2"><input type="radio" id="primer_6_2_false" name="primer_6_2_check" value="false" /> Tidak</label>
                                        <label for="primer_6_2_na" class="me-3 px-2 py-2"><input type="radio" id="primer_6_2_na" name="primer_6_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_6_2_note" id="primer_6_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.3. Telah dilakukan housekeeping area dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_6_3_true" class="me-3 px-2 py-2"><input type="radio" id="primer_6_3_true" name="primer_6_3_check" value="true" required /> Ya</label>
                                        <label for="primer_6_3_false" class="me-3 px-2 py-2"><input type="radio" id="primer_6_3_false" name="primer_6_3_check" value="false" /> Tidak</label>
                                        <label for="primer_6_3_na" class="me-3 px-2 py-2"><input type="radio" id="primer_6_3_na" name="primer_6_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_6_3_note" id="primer_6_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.4. Tersedia ring buoy dengan tali minimal 30 meter.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_6_4_true" class="me-3 px-2 py-2"><input type="radio" id="primer_6_4_true" name="primer_6_4_check" value="true" required /> Ya</label>
                                        <label for="primer_6_4_false" class="me-3 px-2 py-2"><input type="radio" id="primer_6_4_false" name="primer_6_4_check" value="false" /> Tidak</label>
                                        <label for="primer_6_4_na" class="me-3 px-2 py-2"><input type="radio" id="primer_6_4_na" name="primer_6_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_6_4_note" id="primer_6_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.5. Akses tangga pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_6_5_true" class="me-3 px-2 py-2"><input type="radio" id="primer_6_5_true" name="primer_6_5_check" value="true" required /> Ya</label>
                                        <label for="primer_6_5_false" class="me-3 px-2 py-2"><input type="radio" id="primer_6_5_false" name="primer_6_5_check" value="false" /> Tidak</label>
                                        <label for="primer_6_5_na" class="me-3 px-2 py-2"><input type="radio" id="primer_6_5_na" name="primer_6_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_6_5_note" id="primer_6_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.6. Akses tangga ponton.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_6_6_true" class="me-3 px-2 py-2"><input type="radio" id="primer_6_6_true" name="primer_6_6_check" value="true" required /> Ya</label>
                                        <label for="primer_6_6_false" class="me-3 px-2 py-2"><input type="radio" id="primer_6_6_false" name="primer_6_6_check" value="false" /> Tidak</label>
                                        <label for="primer_6_6_na" class="me-3 px-2 py-2"><input type="radio" id="primer_6_6_na" name="primer_6_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_6_6_note" id="primer_6_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>7. Personil</h6>
                                <div class="mb-3">
                                    <label>7.1. Memiliki izin kerja di atas air.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_7_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_7_1_true" name="primer_7_1_check" value="true" required /> Ya</label>
                                        <label for="primer_7_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_7_1_false" name="primer_7_1_check" value="false" /> Tidak</label>
                                        <label for="primer_7_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_7_1_na" name="primer_7_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_7_1_note" id="primer_7_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2. KKH.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_7_2_true" class="me-3 px-2 py-2"><input type="radio" id="primer_7_2_true" name="primer_7_2_check" value="true" required /> Ya</label>
                                        <label for="primer_7_2_false" class="me-3 px-2 py-2"><input type="radio" id="primer_7_2_false" name="primer_7_2_check" value="false" /> Tidak</label>
                                        <label for="primer_7_2_na" class="me-3 px-2 py-2"><input type="radio" id="primer_7_2_na" name="primer_7_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_7_2_note" id="primer_7_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3. Operator telah melakukan P2H unit pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_7_3_true" class="me-3 px-2 py-2"><input type="radio" id="primer_7_3_true" name="primer_7_3_check" value="true" required /> Ya</label>
                                        <label for="primer_7_3_false" class="me-3 px-2 py-2"><input type="radio" id="primer_7_3_false" name="primer_7_3_check" value="false" /> Tidak</label>
                                        <label for="primer_7_3_na" class="me-3 px-2 py-2"><input type="radio" id="primer_7_3_na" name="primer_7_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_7_3_note" id="primer_7_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>8. Perlengkapan Keselamatan</h6>
                                <div class="mb-3">
                                    <label>8.1. Tersedia CCTV.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_1_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_1_true" name="primer_8_1_check" value="true" required /> Ya</label>
                                        <label for="primer_8_1_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_1_false" name="primer_8_1_check" value="false" /> Tidak</label>
                                        <label for="primer_8_1_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_1_na" name="primer_8_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_1_note" id="primer_8_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.2. Tersedia penyalur petir.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_2_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_2_true" name="primer_8_2_check" value="true" required /> Ya</label>
                                        <label for="primer_8_2_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_2_false" name="primer_8_2_check" value="false" /> Tidak</label>
                                        <label for="primer_8_2_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_2_na" name="primer_8_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_2_note" id="primer_8_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.3. Tersedia kotak P3K.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_3_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_3_true" name="primer_8_3_check" value="true" required /> Ya</label>
                                        <label for="primer_8_3_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_3_false" name="primer_8_3_check" value="false" /> Tidak</label>
                                        <label for="primer_8_3_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_3_na" name="primer_8_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_3_note" id="primer_8_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.4. Tersedia eyewash.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_4_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_4_true" name="primer_8_4_check" value="true" required /> Ya</label>
                                        <label for="primer_8_4_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_4_false" name="primer_8_4_check" value="false" /> Tidak</label>
                                        <label for="primer_8_4_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_4_na" name="primer_8_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_4_note" id="primer_8_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.5. Tersedia Emergency Escape Plan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_5_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_5_true" name="primer_8_5_check" value="true" required /> Ya</label>
                                        <label for="primer_8_5_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_5_false" name="primer_8_5_check" value="false" /> Tidak</label>
                                        <label for="primer_8_5_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_5_na" name="primer_8_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_5_note" id="primer_8_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.6. Tersedia Working Vest (minimal +1 dari total pekerja).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_6_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_6_true" name="primer_8_6_check" value="true" required /> Ya</label>
                                        <label for="primer_8_6_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_6_false" name="primer_8_6_check" value="false" /> Tidak</label>
                                        <label for="primer_8_6_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_6_na" name="primer_8_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_6_note" id="primer_8_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.7. Tersedia radio komunikasi.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_7_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_7_true" name="primer_8_7_check" value="true" required /> Ya</label>
                                        <label for="primer_8_7_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_7_false" name="primer_8_7_check" value="false" /> Tidak</label>
                                        <label for="primer_8_7_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_7_na" name="primer_8_7_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_7_note" id="primer_8_7_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.8. Tersedia earmuff/earplug sesuai hasil pengukuran kebisingan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_8_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_8_true" name="primer_8_8_check" value="true" required /> Ya</label>
                                        <label for="primer_8_8_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_8_false" name="primer_8_8_check" value="false" /> Tidak</label>
                                        <label for="primer_8_8_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_8_na" name="primer_8_8_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_8_note" id="primer_8_8_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.9. Tersedia penerangan personal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_9_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_9_true" name="primer_8_9_check" value="true" required /> Ya</label>
                                        <label for="primer_8_9_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_9_false" name="primer_8_9_check" value="false" /> Tidak</label>
                                        <label for="primer_8_9_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_9_na" name="primer_8_9_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_9_note" id="primer_8_9_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.10. Tersedia Spill Kit (Absorbent).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="primer_8_10_true" class="me-3 px-2 py-2"><input type="radio" id="primer_8_10_true" name="primer_8_10_check" value="true" required /> Ya</label>
                                        <label for="primer_8_10_false" class="me-3 px-2 py-2"><input type="radio" id="primer_8_10_false" name="primer_8_10_check" value="false" /> Tidak</label>
                                        <label for="primer_8_10_na" class="me-3 px-2 py-2"><input type="radio" id="primer_8_10_na" name="primer_8_10_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="primer_8_10_note" id="primer_8_10_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>B. AREA POMPA BOOSTER</h5>
                                <hr>
                                <h6>1. Akses Jalan</h6>
                                <div class="mb-3">
                                    <label>1.1. Akses jalan menuju pompa aman &amp; memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_1_1_true" class="me-3 px-2 py-2"><input type="radio" id="booster_1_1_true" name="booster_1_1_check" value="true" required /> Ya</label>
                                        <label for="booster_1_1_false" class="me-3 px-2 py-2"><input type="radio" id="booster_1_1_false" name="booster_1_1_check" value="false" /> Tidak</label>
                                        <label for="booster_1_1_na" class="me-3 px-2 py-2"><input type="radio" id="booster_1_1_na" name="booster_1_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_1_1_note" id="booster_1_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>2. Rambu &amp; Papan Informasi</h6>
                                <div class="mb-3">
                                    <label>2.1. Tersedia rambu/papan informasi area pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_2_1_true" class="me-3 px-2 py-2"><input type="radio" id="booster_2_1_true" name="booster_2_1_check" value="true" required /> Ya</label>
                                        <label for="booster_2_1_false" class="me-3 px-2 py-2"><input type="radio" id="booster_2_1_false" name="booster_2_1_check" value="false" /> Tidak</label>
                                        <label for="booster_2_1_na" class="me-3 px-2 py-2"><input type="radio" id="booster_2_1_na" name="booster_2_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_2_1_note" id="booster_2_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2. Tersedia rambu informasi PIC area (Nama, No. telepon).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_2_2_true" class="me-3 px-2 py-2"><input type="radio" id="booster_2_2_true" name="booster_2_2_check" value="true" required /> Ya</label>
                                        <label for="booster_2_2_false" class="me-3 px-2 py-2"><input type="radio" id="booster_2_2_false" name="booster_2_2_check" value="false" /> Tidak</label>
                                        <label for="booster_2_2_na" class="me-3 px-2 py-2"><input type="radio" id="booster_2_2_na" name="booster_2_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_2_2_note" id="booster_2_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3. Tersedia rambu wajib APD.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_2_3_true" class="me-3 px-2 py-2"><input type="radio" id="booster_2_3_true" name="booster_2_3_check" value="true" required /> Ya</label>
                                        <label for="booster_2_3_false" class="me-3 px-2 py-2"><input type="radio" id="booster_2_3_false" name="booster_2_3_check" value="false" /> Tidak</label>
                                        <label for="booster_2_3_na" class="me-3 px-2 py-2"><input type="radio" id="booster_2_3_na" name="booster_2_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_2_3_note" id="booster_2_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4. Tersedia rambu channel radio.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_2_4_true" class="me-3 px-2 py-2"><input type="radio" id="booster_2_4_true" name="booster_2_4_check" value="true" required /> Ya</label>
                                        <label for="booster_2_4_false" class="me-3 px-2 py-2"><input type="radio" id="booster_2_4_false" name="booster_2_4_check" value="false" /> Tidak</label>
                                        <label for="booster_2_4_na" class="me-3 px-2 py-2"><input type="radio" id="booster_2_4_na" name="booster_2_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_2_4_note" id="booster_2_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5. Tersedia rambu emergency call.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_2_5_true" class="me-3 px-2 py-2"><input type="radio" id="booster_2_5_true" name="booster_2_5_check" value="true" required /> Ya</label>
                                        <label for="booster_2_5_false" class="me-3 px-2 py-2"><input type="radio" id="booster_2_5_false" name="booster_2_5_check" value="false" /> Tidak</label>
                                        <label for="booster_2_5_na" class="me-3 px-2 py-2"><input type="radio" id="booster_2_5_na" name="booster_2_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_2_5_note" id="booster_2_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.6. Tersedia rambu evakuasi dan muster point.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_2_6_true" class="me-3 px-2 py-2"><input type="radio" id="booster_2_6_true" name="booster_2_6_check" value="true" required /> Ya</label>
                                        <label for="booster_2_6_false" class="me-3 px-2 py-2"><input type="radio" id="booster_2_6_false" name="booster_2_6_check" value="false" /> Tidak</label>
                                        <label for="booster_2_6_na" class="me-3 px-2 py-2"><input type="radio" id="booster_2_6_na" name="booster_2_6_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_2_6_note" id="booster_2_6_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>3. Pompa</h6>
                                <div class="mb-3">
                                    <label>3.1. Dilakukan inspeksi pompa secara rutin dan tersedia tagging kelayakan pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_3_1_true" class="me-3 px-2 py-2"><input type="radio" id="booster_3_1_true" name="booster_3_1_check" value="true" required /> Ya</label>
                                        <label for="booster_3_1_false" class="me-3 px-2 py-2"><input type="radio" id="booster_3_1_false" name="booster_3_1_check" value="false" /> Tidak</label>
                                        <label for="booster_3_1_na" class="me-3 px-2 py-2"><input type="radio" id="booster_3_1_na" name="booster_3_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_3_1_note" id="booster_3_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2. Posisi pompa stabil.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_3_2_true" class="me-3 px-2 py-2"><input type="radio" id="booster_3_2_true" name="booster_3_2_check" value="true" required /> Ya</label>
                                        <label for="booster_3_2_false" class="me-3 px-2 py-2"><input type="radio" id="booster_3_2_false" name="booster_3_2_check" value="false" /> Tidak</label>
                                        <label for="booster_3_2_na" class="me-3 px-2 py-2"><input type="radio" id="booster_3_2_na" name="booster_3_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_3_2_note" id="booster_3_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3. Telah dilakukan housekeeping area dengan baik.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_3_3_true" class="me-3 px-2 py-2"><input type="radio" id="booster_3_3_true" name="booster_3_3_check" value="true" required /> Ya</label>
                                        <label for="booster_3_3_false" class="me-3 px-2 py-2"><input type="radio" id="booster_3_3_false" name="booster_3_3_check" value="false" /> Tidak</label>
                                        <label for="booster_3_3_na" class="me-3 px-2 py-2"><input type="radio" id="booster_3_3_na" name="booster_3_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_3_3_note" id="booster_3_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4. Akses tangga pompa tersedia &amp; memadai.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_3_4_true" class="me-3 px-2 py-2"><input type="radio" id="booster_3_4_true" name="booster_3_4_check" value="true" required /> Ya</label>
                                        <label for="booster_3_4_false" class="me-3 px-2 py-2"><input type="radio" id="booster_3_4_false" name="booster_3_4_check" value="false" /> Tidak</label>
                                        <label for="booster_3_4_na" class="me-3 px-2 py-2"><input type="radio" id="booster_3_4_na" name="booster_3_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_3_4_note" id="booster_3_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>4. Personil</h6>
                                <div class="mb-3">
                                    <label>4.1. Operator mengisi KKH sesuai ketentuan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_4_1_true" class="me-3 px-2 py-2"><input type="radio" id="booster_4_1_true" name="booster_4_1_check" value="true" required /> Ya</label>
                                        <label for="booster_4_1_false" class="me-3 px-2 py-2"><input type="radio" id="booster_4_1_false" name="booster_4_1_check" value="false" /> Tidak</label>
                                        <label for="booster_4_1_na" class="me-3 px-2 py-2"><input type="radio" id="booster_4_1_na" name="booster_4_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_4_1_note" id="booster_4_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2. Operator telah melakukan P2H unit pompa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_4_2_true" class="me-3 px-2 py-2"><input type="radio" id="booster_4_2_true" name="booster_4_2_check" value="true" required /> Ya</label>
                                        <label for="booster_4_2_false" class="me-3 px-2 py-2"><input type="radio" id="booster_4_2_false" name="booster_4_2_check" value="false" /> Tidak</label>
                                        <label for="booster_4_2_na" class="me-3 px-2 py-2"><input type="radio" id="booster_4_2_na" name="booster_4_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_4_2_note" id="booster_4_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>5. Perlengkapan Keselamatan</h6>
                                <div class="mb-3">
                                    <label>5.1. Tersedia Emergency Escape Plan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_5_1_true" class="me-3 px-2 py-2"><input type="radio" id="booster_5_1_true" name="booster_5_1_check" value="true" required /> Ya</label>
                                        <label for="booster_5_1_false" class="me-3 px-2 py-2"><input type="radio" id="booster_5_1_false" name="booster_5_1_check" value="false" /> Tidak</label>
                                        <label for="booster_5_1_na" class="me-3 px-2 py-2"><input type="radio" id="booster_5_1_na" name="booster_5_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_5_1_note" id="booster_5_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2. Tersedia radio komunikasi.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_5_2_true" class="me-3 px-2 py-2"><input type="radio" id="booster_5_2_true" name="booster_5_2_check" value="true" required /> Ya</label>
                                        <label for="booster_5_2_false" class="me-3 px-2 py-2"><input type="radio" id="booster_5_2_false" name="booster_5_2_check" value="false" /> Tidak</label>
                                        <label for="booster_5_2_na" class="me-3 px-2 py-2"><input type="radio" id="booster_5_2_na" name="booster_5_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_5_2_note" id="booster_5_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.3. Tersedia earmuff/earplug sesuai hasil pengukuran kebisingan.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_5_3_true" class="me-3 px-2 py-2"><input type="radio" id="booster_5_3_true" name="booster_5_3_check" value="true" required /> Ya</label>
                                        <label for="booster_5_3_false" class="me-3 px-2 py-2"><input type="radio" id="booster_5_3_false" name="booster_5_3_check" value="false" /> Tidak</label>
                                        <label for="booster_5_3_na" class="me-3 px-2 py-2"><input type="radio" id="booster_5_3_na" name="booster_5_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_5_3_note" id="booster_5_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.4. Tersedia penerangan personal.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_5_4_true" class="me-3 px-2 py-2"><input type="radio" id="booster_5_4_true" name="booster_5_4_check" value="true" required /> Ya</label>
                                        <label for="booster_5_4_false" class="me-3 px-2 py-2"><input type="radio" id="booster_5_4_false" name="booster_5_4_check" value="false" /> Tidak</label>
                                        <label for="booster_5_4_na" class="me-3 px-2 py-2"><input type="radio" id="booster_5_4_na" name="booster_5_4_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_5_4_note" id="booster_5_4_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.5. Tersedia Spill Kit (Absorbent).</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="booster_5_5_true" class="me-3 px-2 py-2"><input type="radio" id="booster_5_5_true" name="booster_5_5_check" value="true" required /> Ya</label>
                                        <label for="booster_5_5_false" class="me-3 px-2 py-2"><input type="radio" id="booster_5_5_false" name="booster_5_5_check" value="false" /> Tidak</label>
                                        <label for="booster_5_5_na" class="me-3 px-2 py-2"><input type="radio" id="booster_5_5_na" name="booster_5_5_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="booster_5_5_note" id="booster_5_5_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h5>C. JALUR INSTALASI PIPA HDPE</h5>
                                <hr>
                                <h6>1. Jalur Inspeksi</h6>
                                <div class="mb-3">
                                    <label>1.1. Terdapat jalur inspeksi yang aman.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="hdpe_1_1_true" class="me-3 px-2 py-2"><input type="radio" id="hdpe_1_1_true" name="hdpe_1_1_check" value="true" required /> Ya</label>
                                        <label for="hdpe_1_1_false" class="me-3 px-2 py-2"><input type="radio" id="hdpe_1_1_false" name="hdpe_1_1_check" value="false" /> Tidak</label>
                                        <label for="hdpe_1_1_na" class="me-3 px-2 py-2"><input type="radio" id="hdpe_1_1_na" name="hdpe_1_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="hdpe_1_1_note" id="hdpe_1_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>2. Area Jalur Pipa</h6>
                                <div class="mb-3">
                                    <label>2.1. Area aman dari longsor.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="hdpe_2_1_true" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_1_true" name="hdpe_2_1_check" value="true" required /> Ya</label>
                                        <label for="hdpe_2_1_false" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_1_false" name="hdpe_2_1_check" value="false" /> Tidak</label>
                                        <label for="hdpe_2_1_na" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_1_na" name="hdpe_2_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="hdpe_2_1_note" id="hdpe_2_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2. Tidak berada pada area risiko swabakar batubara.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="hdpe_2_2_true" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_2_true" name="hdpe_2_2_check" value="true" required /> Ya</label>
                                        <label for="hdpe_2_2_false" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_2_false" name="hdpe_2_2_check" value="false" /> Tidak</label>
                                        <label for="hdpe_2_2_na" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_2_na" name="hdpe_2_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="hdpe_2_2_note" id="hdpe_2_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3. Jarak aman jalur pipa 30 m dari area loading point.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="hdpe_2_3_true" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_3_true" name="hdpe_2_3_check" value="true" required /> Ya</label>
                                        <label for="hdpe_2_3_false" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_3_false" name="hdpe_2_3_check" value="false" /> Tidak</label>
                                        <label for="hdpe_2_3_na" class="me-3 px-2 py-2"><input type="radio" id="hdpe_2_3_na" name="hdpe_2_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="hdpe_2_3_note" id="hdpe_2_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <h6>3. Pipa</h6>
                                <div class="mb-3">
                                    <label>3.1. Terdapat rambu/papan informasi pada pipa yang tertanam.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="hdpe_3_1_true" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_1_true" name="hdpe_3_1_check" value="true" required /> Ya</label>
                                        <label for="hdpe_3_1_false" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_1_false" name="hdpe_3_1_check" value="false" /> Tidak</label>
                                        <label for="hdpe_3_1_na" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_1_na" name="hdpe_3_1_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="hdpe_3_1_note" id="hdpe_3_1_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2. Kedalaman pipa yang ditanam minimal 2 meter.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="hdpe_3_2_true" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_2_true" name="hdpe_3_2_check" value="true" required /> Ya</label>
                                        <label for="hdpe_3_2_false" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_2_false" name="hdpe_3_2_check" value="false" /> Tidak</label>
                                        <label for="hdpe_3_2_na" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_2_na" name="hdpe_3_2_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="hdpe_3_2_note" id="hdpe_3_2_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3. Tidak ada kebocoran pada pipa dan atau sambungan pipa.</label>
                                    <div class="d-flex justify-content-start">
                                        <label for="hdpe_3_3_true" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_3_true" name="hdpe_3_3_check" value="true" required /> Ya</label>
                                        <label for="hdpe_3_3_false" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_3_false" name="hdpe_3_3_check" value="false" /> Tidak</label>
                                        <label for="hdpe_3_3_na" class="me-3 px-2 py-2"><input type="radio" id="hdpe_3_3_na" name="hdpe_3_3_check" value="n/a" /> N/A</label>
                                    </div>
                                    <input type="text" name="hdpe_3_3_note" id="hdpe_3_3_note" class="form-control form-control-sm pb-2 mt-2" placeholder="Keterangan" />
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
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonKLKHDewatering">
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

    const formKLKHDewatering = document.getElementById('submitFormKLKHDewatering');
    const submitButtonKLKHDewatering = document.getElementById('submitButtonKLKHDewatering');

    formKLKHDewatering.addEventListener('submit', function() {
    
        submitButtonKLKHDewatering.disabled = true;
        submitButtonKLKHDewatering.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonKLKHDewatering.disabled = false;
            submitButtonKLKHDewatering.innerText = 'Submit';
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
