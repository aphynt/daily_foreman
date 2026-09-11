@include('layout.head', ['title' => 'Inspeksi Ruang Office'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Ruang Office</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.ruangoffice.post') }}" method="POST" id="submitformInspeksiRuangOffice">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Departemen</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1" name="departemen" data-trigger required>
                                            <option selected disabled></option>
                                            @foreach ($users['departemen'] as $departemen)
                                                <option value="{{ $departemen->id }}">{{ $departemen->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal_inspeksi" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Jam</label>
                                        <input type="time" class="form-control form-control-sm" id="time" name="jam_inspeksi" required>
                                    </div>

                                    

                                </div>
                                <hr>
                                <h5>1. Mesin Foto Copy</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Berfungsi dengan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_11_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_11_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2 Tidak kotor & tidak  berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_12_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_12_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.3 Kabel tidak terkelupas</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_13_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_13_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.4 Stop kontak dan terminal dalam kondisi baik dan aman</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_14_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fotocopy_14_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>2. Mesin Penghancur kertas</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>2.1 Berfungsi dengan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penghancurkertas_21_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penghancurkertas_21_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 Tidak kotor & tidak  berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penghancurkertas_22_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penghancurkertas_22_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Stop kontak dan terminal dalam kondisi baik dan aman</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penghancurkertas_23_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="penghancurkertas_23_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>3. AC</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>3.1 Berfungsi dengan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_31_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_31_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2 Tidak kotor & tidak  berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_32_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_32_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Kartu pemeriksaan dicek secara rutin</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_33_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_33_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Kabel tidak terkelupas</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_34_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="ac_34_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>4. Lampu Penerangan</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>4.1 Reflektor terpasang dengan kuat</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lampupenerangan_41_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lampupenerangan_41_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>4.2 Lampu-lampu berfungsi dengan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lampupenerangan_42_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lampupenerangan_42_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>5. Saklar</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>5.1 Saklar terpasang dengan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="saklar_51_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="saklar_51_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>5.2 Ada tanda-tanda On/Off dan keterangan yang diperlukan</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="saklar_52_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="saklar_52_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>6. Instalasi Listrik</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>6.1 Stop kontak dan terminal dalam kondisi baik dan aman</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="instalasilistrik_61_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="instalasilistrik_61_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.2 Kabel-kabel tidak terkelupas</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="instalasilistrik_62_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="instalasilistrik_62_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>6.3 Penempatan kabel-kabel harus rapih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="instalasilistrik_63_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="instalasilistrik_63_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>7. Lantai, Dinding, Langit-langit, Pintu, Jendela & Partisi (pembatas ruangan)</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>7.1 Lantai dalam kondisi baik, tidak licin dan pecah-pecah</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_71_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_71_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.2 Lantai tidak ada kecoa</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_72_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_72_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.3 Dinding bersih dan tidak ada sarang laba-laba</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_73_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_73_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.4 Langit-langit tidak bocor dan tidak pecah-pecah</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_74_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_74_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.5 Eexhouse fan terpasang dengan kuat dan berfungsi dengan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_75_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_75_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.6 Pintu dalam kondisi baik, aman, bersih dan terbuka ke arah luar</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_76_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_76_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>7.7 Partisi pembatas ruangan berfungsi baik, kuat, aman, dan tidak berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_77_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lantai_77_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>8. Lemari File</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>8.1 Dalam kondisi baik dan aman</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_81_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_81_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.2 File tersusun rapi sesuai nomor dokumentasi</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_82_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_82_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.3 Tidak kotor & tidak  berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_83_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_83_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.4 Selalu dalam keadaan tertutup</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_84_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_84_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.5 Kaca dalam keadaan baik / tidak pecah</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_85_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_85_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>8.6 Pintu lemari berfungsi dengan baik</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_86_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="lemarifile_86_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>9. Lemari File</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>9.1 Meja dalam kondisi aman dan tidak berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_91_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_91_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9.2 Kursi-kursi tidak patah, kuat, aman dan bersih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_92_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_92_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9.3 Papan tulis terpasang dengan baik, kuat, aman dan bersih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_93_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_93_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>9.4 Papan informasi terpasang dengan baik, kuat, aman dan bersih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_94_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="meja_94_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>10. Komputer, Printer, UPS dan telepon</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>10.1 Kabel-kabel tidak terkelupas</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_101_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_101_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10.2 Penempatan kabel-kabel harus rapih</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_102_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_102_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10.3 Komputer diletakkan pada posisi yang aman dan tidak berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_103_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_103_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10.4 Printer diletakkan pada posisi yang aman dan tidak berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_104_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_104_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10.5 Telepon diletakkan pada posisi yang aman dan tidak berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_105_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_105_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>10.6 UPS diletakkan pada posisi yang aman dan tidak berdebu</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_106_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="komputer_106_check" value="false" /> Tidak
                                        </label>
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
                                        <select class="form-control form-control-sm" name="inspektor1" data-trigger required>
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
                                        <select class="form-control form-control-sm" name="inspektor2" data-trigger>
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
                                        <select class="form-control form-control-sm" name="inspektor3" data-trigger>
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
                                        <select class="form-control form-control-sm" name="inspektor4" data-trigger>
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
                                        <input type="text" name="inspektor5" class="form-control form-control-sm">
                                    </div>

                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiRuangOffice">Submit</button>
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

    const formInspeksiRuangOffice = document.getElementById('submitformInspeksiRuangOffice');
    const submitButtonInspeksiRuangOffice = document.getElementById('submitButtonInspeksiRuangOffice');

    formInspeksiRuangOffice.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiRuangOffice.disabled = true;
        submitButtonInspeksiRuangOffice.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiRuangOffice.disabled = false;
            submitButtonInspeksiRuangOffice.innerText = 'Submit';
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
