@include('layout.head', ['title' => 'Observasi BANK'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .table {
        table-layout: fixed;
        width: 100%;
    }

    .table td, .table th {
        word-wrap: break-word;
        white-space: normal;
    }

    .col-item {
        width: 85%;
    }

    .col-check {
        width: 15%;
        text-align: center;
    }
    .note-warning {
        background-color: #fff3cd;
        border-left: 5px solid #9caf88;
        padding: 12px 16px;
        border-radius: 6px;
        font-size: 14px;
        color: #664d03;
    }

    .upload-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .upload-card {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 12px;
        background: #fff;
    }

    .upload-card label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .upload-note {
        font-size: 12px;
        color: #6c757d;
        margin-top: 6px;
    }

    @media (max-width: 768px) {
        .upload-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Observasi BANK</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('observasibank.post') }}" method="POST" id="submitformObservasiBank" enctype="multipart/form-data">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Waktu/Jam</label>
                                        <input type="time" class="form-control form-control-sm" id="time" name="jam" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Departemen</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1" name="departemen_id" data-trigger>
                                            <option selected disabled></option>
                                            @foreach ($users['departemen'] as $dep)
                                                <option value="{{ $dep->id }}">{{ $dep->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Nama Pekerjaan</label>
                                        <input type="text" class="form-control form-control-sm" name="nama_pekerjaan" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Referensi</label>
                                        <input type="text" class="form-control form-control-sm" name="referensi" >
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>No. Referensi</label>
                                        <input type="text" class="form-control form-control-sm" name="no_referensi" >
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Lokasi</label>
                                        <select class="form-control form-control-sm pb-2" id="lokasi" name="lokasi" data-trigger="" required>
                                            <option selected disabled></option>
                                            <option value="JALAN HAULING">JALAN HAULING</option>
                                            <option value="LOADING POINT">LOADING POINT</option>
                                            <option value="DUMPING POINT">DUMPING POINT</option>
                                            <option value="SUMP/PUMP">SUMP/PUMP</option>
                                            <option value="FUEL STATION">FUEL STATION</option>
                                            <option value="WARE HOUSE">WARE HOUSE</option>
                                            <option value="WORKSHOP">WORKSHOP</option>
                                            <option value="OFFICE">OFFICE</option>
                                            <option value="LAIN-LAIN">LAIN-LAIN</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2" id="lokasi_lain_container" style="display:none;">
                                        <label>Lokasi Lainnya</label>
                                        <input type="text" class="form-control form-control-sm" id="lokasi_lain" name="lokasi_lain" placeholder="Masukkan lokasi lainnya">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="note-warning">
                                        <strong>NOTE:</strong>
                                        <p>Beri Tanda (✓) Jika Sesuai Prosedur kerja Aman dan (Kosongkan) Jika tidak masuk dalam Kegiatan Observasi</p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        I. Perilaku Pekerja Saat Diamati
                                    </label>

                                    <table class="table table-bordered table-sm mb-0">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Item</th>
                                                <th style="width: 80px;">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Posisi saat bekerja</td>
                                                <td class="text-center" style="width:60px;">
                                                    <input type="checkbox" name="perilaku_posisi_saat_bekerja" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Menggunakan peralatan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_menggunakan_peralatan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mengangkat barang</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_mengangkat_barang" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mengemudi</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_mengemudi" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Menaiki / Menuruni tangga</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_menaiki_menuruni_tangga" value="1">
                                                </td>
                                            </tr>

                                            <!-- LAIN-LAIN -->
                                            <tr>
                                                <td>Dan lain-lain:</td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="perilaku_lain_check">
                                                </td>
                                            </tr>
                                            <tr id="perilaku_lain_row1" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="perilaku_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya...">
                                                </td>
                                            </tr>
                                            <tr id="perilaku_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="perilaku_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya...">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        II. Penggunaan APD / Alat Keselamatan
                                    </label>

                                    <table class="table table-bordered table-sm mb-0">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Item</th>
                                                <th style="width: 80px;">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Pelindung kepala (Helmet)</td>
                                                <td class="text-center" style="width:60px;">
                                                    <input type="checkbox" name="apd_pelindung_kepala" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung mata (Kaca Mata)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_mata" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung telinga (Earplug/ Muff)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_telinga" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung pernafasan (Masker)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_pernafasan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung tangan (Sarung Tangan)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_tangan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung kaki (Safety Shoes)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_kaki" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung tenggelam (Life Jacket)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_tenggelam" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>LOTO</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_loto" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sabuk Pengaman / Set Belt</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_sabuk_pengaman" value="1">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Dan lain-lain:</td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="apd_lain_check">
                                                </td>
                                            </tr>
                                            <tr id="apd_lain_row1" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="apd_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya...">
                                                </td>
                                            </tr>
                                            <tr id="apd_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="apd_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya...">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        III. Potensi Risiko dari Pekerja
                                    </label>

                                    <table class="table table-bordered table-sm mb-0">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Item</th>
                                                <th style="width: 80px;">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Menabrak / ditabrak</td>
                                                <td class="text-center" style="width:60px;">
                                                    <input type="checkbox" name="risiko_menabrak" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terjepit</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terjepit" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terpukul / terbentur</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terpukul" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terpeleset / terguling / terjatuh</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terpeleset" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sengatan / gigitan binatang</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_sengatan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gangguan kesehatan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_gangguan_kesehatan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pencemaran Lingkungan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_pencemaran_lingkungan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terhirup / terpapar debu / bahan kimia</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terhirup" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kontak dengan panas / listrik</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_kontak" value="1">
                                                </td>
                                            </tr>

                                            <!-- LAIN-LAIN -->
                                            <tr>
                                                <td>Dan lain-lain:</td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="risiko_lain_check">
                                                </td>
                                            </tr>
                                            <tr id="risiko_lain_row1" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="risiko_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya...">
                                                </td>
                                            </tr>
                                            <tr id="risiko_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="risiko_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya...">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        IV. Peralatan Kerja
                                    </label>

                                    <table class="table table-bordered table-sm mb-0">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Item</th>
                                                <th style="width: 80px;">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sesuai untuk pekerjaan</td>
                                                <td class="text-center" style="width:60px;">
                                                    <input type="checkbox" name="peralatan_sesuai" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Benar dalam menggunakan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_benar" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kondisi baik dan layak operasi</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_kondisi" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Taging / KIP ada / telah dilakukan pengecekan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_taging" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung dan pengaman</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_pelindung" value="1">
                                                </td>
                                            </tr>

                                            <!-- LAIN-LAIN -->
                                            <tr>
                                                <td>Dan lain-lain:</td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="peralatan_lain_check">
                                                </td>
                                            </tr>
                                            <tr id="peralatan_lain_row1" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="peralatan_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya...">
                                                </td>
                                            </tr>
                                            <tr id="peralatan_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="peralatan_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya...">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        V. Prosedur Kerja
                                    </label>

                                    <table class="table table-bordered table-sm mt-2">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Item</th>
                                                <th style="width: 80px;">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tersedia / Ada</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_tersedia" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Diketahui / Dimengerti</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_diketahui" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dijalankan / dilaksanakan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_dijalankan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Permit / Izin Kerja</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_permit" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>P2H</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_p2h" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dan lain-lain:</td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="prosedur_kerja_lain_check">
                                                </td>
                                            </tr>
                                            <tr id="prosedur_kerja_lain_row" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="prosedur_kerja_lain" class="form-control form-control-sm" placeholder="Isi lainnya">
                                                </td>
                                            </tr>
                                            <tr id="prosedur_kerja_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="prosedur_kerja_lain_2" class="form-control form-control-sm" placeholder="Isi tambahan lainnya">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        VI. Kondisi Area / Lingkungan Kerja
                                    </label>

                                    <table class="table table-bordered table-sm mb-0" style="table-layout: fixed;">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Item</th>
                                                <th style="width: 80px;">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Kebersihan / Kerapian</td>
                                                <td class="text-center" style="width: 60px;">
                                                    <input type="checkbox" name="kondisi_area_kebersihan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rambu / Demarkasi</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_rambu" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Akses / jalan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_akses" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Penyimpanan barang</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_penyimpanan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Suhu</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_suhu" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pencahayaan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_pencahayaan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kebisingan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_kebisingan" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cuaca</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_cuaca" value="1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dan lain-lain:</td>
                                                <td class="text-center">
                                                    <input type="checkbox" id="kondisi_area_lain_check">
                                                </td>
                                            </tr>
                                            <tr id="kondisi_area_lain_row" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="kondisi_area_lain" class="form-control form-control-sm" placeholder="Isi lainnya">
                                                </td>
                                            </tr>
                                            <tr id="kondisi_area_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="kondisi_area_lain_2" class="form-control form-control-sm" placeholder="Isi tambahan lainnya">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        VII. Perilaku Aman Yang Di Amati (Komentar)
                                    </label>

                                    <table class="table table-bordered table-sm mb-0" style="table-layout: fixed;">
                                        <tbody>
                                            <tr>
                                                <td class="text-center" style="width: 60px;">
                                                   <textarea id="perilaku_aman_yang_diamati" name="perilaku_aman_yang_diamati" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan komentar..."></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                        VIII. Perilaku Tidak Aman Yang Di Amati (Komentar)
                                    </label>

                                    <table class="table table-bordered table-sm mb-0" style="table-layout: fixed;">
                                        <tbody>
                                            <tr>
                                                <td class="text-center" style="width: 60px;">
                                                   <textarea id="perilaku_tidak_aman_yang_diamati" name="perilaku_tidak_aman_yang_diamati" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan komentar..."></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>
                                <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    IX. Tindakan Koreksi / Tindakan Perbaikan
                                </label>

                                <!-- Tabel Checklist -->
                                <table class="table table-bordered table-sm mb-4 table-fix">
                                    <tbody>
                                        <tr>
                                            <td class="check-col">
                                                <input type="checkbox" name="tindakan_kegiatan" value="1">
                                            </td>
                                            <td>Kegiatan di Hentikan</td>
                                        </tr>
                                        <tr>
                                            <td class="check-col">
                                                <input type="checkbox" name="tindakan_perbaikan_langsung" value="1">
                                            </td>
                                            <td>Perbaikan Langsung di Tempat</td>
                                        </tr>
                                        <tr>
                                            <td class="check-col">
                                                <input type="checkbox" name="tindakan_perbaikan_lanjutan" value="1" id="tindakan_lanjutan_check">
                                            </td>
                                            <td>Perbaikan Lanjutan</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Tabel Tindakan Perbaikan -->
                                <table class="table table-bordered table-sm mb-0 table-fix">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Tindakan Koreksi / Tindakan Perbaikan Yang dilakukan</th>
                                            <th class="due-col">Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tindakan_lanjutan_body">
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_1" class="form-control form-control-sm border-0 shadow-none" placeholder="">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_1" class="form-control form-control-sm border-0 shadow-none">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_2" class="form-control form-control-sm border-0 shadow-none" placeholder="">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_2" class="form-control form-control-sm border-0 shadow-none">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_3" class="form-control form-control-sm border-0 shadow-none" placeholder="">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_3" class="form-control form-control-sm border-0 shadow-none">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_4" class="form-control form-control-sm border-0 shadow-none" placeholder="">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_4" class="form-control form-control-sm border-0 shadow-none">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_5" class="form-control form-control-sm border-0 shadow-none" placeholder="">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_5" class="form-control form-control-sm border-0 shadow-none">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                <hr>
                                <!-- Catatan -->
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan Khusus:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3"
                                        placeholder="Tambahkan catatan..."></textarea>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <h5>X. Petugas / Observer</h5>

                                    {{-- PATUGAS 1 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Petugas / Observer 1</label>
                                        <select class="form-control form-control-sm" name="petugas1" data-trigger>
                                            <option value="" disabled selected></option>
                                            @foreach ($users['petugas'] as $petugas)
                                                <option value="{{ $petugas->nik }}"
                                                    {{ old('petugas1') == $petugas->nik ? 'selected' : '' }}>
                                                    {{ $petugas->name }} ({{ $petugas->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- PATUGAS 2 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Petugas / Observer 2</label>
                                        <select class="form-control form-control-sm" name="petugas2" data-trigger>
                                            <option value="" disabled selected></option>
                                            @foreach ($users['petugas'] as $petugas)
                                                <option value="{{ $petugas->nik }}"
                                                    {{ old('petugas2') == $petugas->nik ? 'selected' : '' }}>
                                                    {{ $petugas->name }} ({{ $petugas->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- PATUGAS 3 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Petugas / Observer 3</label>
                                        <select class="form-control form-control-sm" name="petugas3" data-trigger>
                                            <option value="" disabled selected></option>
                                            @foreach ($users['petugas'] as $petugas)
                                                <option value="{{ $petugas->nik }}"
                                                    {{ old('petugas3') == $petugas->nik ? 'selected' : '' }}>
                                                    {{ $petugas->name }} ({{ $petugas->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <h5>XI. Pekerja yang di Observasi</h5>

                                    {{-- PATUGAS 1 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 1</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja1">
                                    </div>

                                    {{-- PATUGAS 2 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 2</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja2">
                                    </div>

                                    {{-- PATUGAS 3 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 3</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja3">
                                    </div>

                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <h5>XII. Validasi Pengawas / Penanggung Jawab</h5>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pengawas</label>
                                        <select class="form-control form-control-sm" name="pengawas1" data-trigger>
                                            <option value="{{ Auth::user()->nik }}" selected>{{ Auth::user()->name }} ({{ Auth::user()->nik }})</option>
                                            @foreach ($users['pengawas'] as $pengawas)
                                                <option value="{{ $pengawas->nik }}"
                                                    {{ old('pengawas') == $pengawas->nik ? 'selected' : '' }}>
                                                    {{ $pengawas->name }} ({{ $pengawas->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <h5>XIII. Dokumentasi Foto</h5>

                                    <div class="upload-grid">
                                        <div class="upload-card">
                                            <label>Dokumentasi Foto 1</label>
                                            <input type="file"
                                                class="form-control form-control-sm"
                                                name="dokumentasi_foto_1"
                                                accept="image/*">
                                            <div class="upload-note">Format disarankan: JPG, PNG, WEBP.</div>
                                        </div>

                                        <div class="upload-card">
                                            <label>Dokumentasi Foto 2</label>
                                            <input type="file"
                                                class="form-control form-control-sm"
                                                name="dokumentasi_foto_2"
                                                accept="image/*">
                                            <div class="upload-note">Opsional, isi jika ada dokumentasi tambahan.</div>
                                        </div>

                                        <div class="upload-card">
                                            <label>Dokumentasi Foto 3</label>
                                            <input type="file"
                                                class="form-control form-control-sm"
                                                name="dokumentasi_foto_3"
                                                accept="image/*">
                                            <div class="upload-note">Opsional, isi jika ada dokumentasi tambahan.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonObservasiBank">Submit</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        const lokasi = document.getElementById('lokasi');
        const container = document.getElementById('lokasi_lain_container');
        const lokasiLain = document.getElementById('lokasi_lain');

        function toggleLokasiLain() {
            if (lokasi.value === 'LAIN-LAIN') {
                container.style.display = 'block';
                lokasiLain.required = true;
            } else {
                container.style.display = 'none';
                lokasiLain.required = false;
                lokasiLain.value = '';
            }
        }

        lokasi.addEventListener('change', toggleLokasiLain);
        toggleLokasiLain();
    });

    //1
    document.getElementById('perilaku_lain_check').addEventListener('change', function () {
        const row1 = document.getElementById('perilaku_lain_row1');
        const row2 = document.getElementById('perilaku_lain_row2');

        if (this.checked) {
            row1.style.display = '';
            row2.style.display = '';
        } else {
            row1.style.display = 'none';
            row2.style.display = 'none';

            document.querySelector('input[name="perilaku_lain_1"]').value = '';
            document.querySelector('input[name="perilaku_lain_2"]').value = '';
        }
    });

    //2
    document.getElementById('apd_lain_check').addEventListener('change', function () {
        const row1 = document.getElementById('apd_lain_row1');
        const row2 = document.getElementById('apd_lain_row2');

        if (this.checked) {
            row1.style.display = '';
            row2.style.display = '';
        } else {
            row1.style.display = 'none';
            row2.style.display = 'none';
            document.querySelector('input[name="apd_lain_1"]').value = '';
            document.querySelector('input[name="apd_lain_2"]').value = '';
        }
    });

    //3
    document.getElementById('risiko_lain_check').addEventListener('change', function () {
        const row1 = document.getElementById('risiko_lain_row1');
        const row2 = document.getElementById('risiko_lain_row2');

        if (this.checked) {
            row1.style.display = '';
            row2.style.display = '';
        } else {
            row1.style.display = 'none';
            row2.style.display = 'none';

            document.querySelector('input[name="risiko_lain_1"]').value = '';
            document.querySelector('input[name="risiko_lain_2"]').value = '';
        }
    });

    //4
    document.getElementById('peralatan_lain_check').addEventListener('change', function () {
        const row1 = document.getElementById('peralatan_lain_row1');
        const row2 = document.getElementById('peralatan_lain_row2');

        if (this.checked) {
            row1.style.display = '';
            row2.style.display = '';
        } else {
            row1.style.display = 'none';
            row2.style.display = 'none';

            document.querySelector('input[name="peralatan_lain_1"]').value = '';
            document.querySelector('input[name="peralatan_lain_2"]').value = '';
        }
    });

    //5
    document.getElementById('prosedur_kerja_lain_check').addEventListener('change', function () {
        let row1 = document.getElementById('prosedur_kerja_lain_row');
        let row2 = document.getElementById('prosedur_kerja_lain_row2');

        if (this.checked) {
            row1.style.display = '';
            row2.style.display = '';
        } else {
            row1.style.display = 'none';
            row2.style.display = 'none';
            document.querySelector('input[name="prosedur_kerja_lain"]').value = '';
            document.querySelector('input[name="prosedur_kerja_lain_2"]').value = '';
        }
    });

    //6
    document.getElementById('kondisi_area_lain_check').addEventListener('change', function () {
        const row1 = document.getElementById('kondisi_area_lain_row');
        const row2 = document.getElementById('kondisi_area_lain_row2');

        if (this.checked) {
            row1.style.display = '';
            row2.style.display = '';
        } else {
            row1.style.display = 'none';
            row2.style.display = 'none';
            document.querySelector('input[name="kondisi_area_lain"]').value = '';
            document.querySelector('input[name="kondisi_area_lain_2"]').value = '';
        }
    });
</script>
<script>
    const formInspeksiWorkshop = document.getElementById('submitformObservasiBank');
    const submitButtonObservasiBank = document.getElementById('submitButtonObservasiBank');

    formInspeksiWorkshop.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonObservasiBank.disabled = true;
        submitButtonObservasiBank.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonObservasiBank.disabled = false;
            submitButtonObservasiBank.innerText = 'Submit';
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const formObservasi = document.getElementById('submitformObservasiBank');
    const submitButton = document.getElementById('submitButtonObservasiBank');

    function ensureFile(obj, originalName = 'image.jpg') {
        if (!obj) return null;
        if (obj instanceof File) return obj;
        if (obj instanceof Blob) {
            try {
                return new File([obj], originalName, {
                    type: obj.type || 'image/jpeg',
                    lastModified: Date.now()
                });
            } catch (err) {
                obj.name = originalName;
                return obj;
            }
        }
        return null;
    }

    async function compressFileWithLib(file, options = {}) {
        if (typeof imageCompression === 'undefined') {
            return file;
        }

        try {
            const compressed = await imageCompression(file, options);
            return ensureFile(compressed, file.name);
        } catch (err) {
            console.error('Compression error:', err);
            return file;
        }
    }

    function replaceInputFile(inputElement, file) {
        if (!inputElement || !file) return;

        const fileToAdd = ensureFile(file, file.name || 'image.jpg');
        if (!(fileToAdd instanceof File)) return;

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(fileToAdd);
        inputElement.files = dataTransfer.files;
    }

    formObservasi.addEventListener('submit', async function (e) {
        e.preventDefault();

        submitButton.disabled = true;
        const originalText = submitButton.innerText;
        submitButton.innerText = 'Processing...';

        try {
            const fileFields = [
                'dokumentasi_foto_1',
                'dokumentasi_foto_2',
                'dokumentasi_foto_3'
            ];

            const options = {
                maxSizeMB: 1.0,
                maxWidthOrHeight: 1920,
                useWebWorker: true,
                initialQuality: 0.75
            };

            for (const fieldName of fileFields) {
                const input = formObservasi.querySelector(`input[name="${fieldName}"]`);
                if (input && input.files && input.files.length > 0) {
                    const compressed = await compressFileWithLib(input.files[0], options);
                    if (compressed) {
                        replaceInputFile(input, compressed);
                    }
                }
            }

            formObservasi.submit();
        } catch (err) {
            console.error(err);
            submitButton.disabled = false;
            submitButton.innerText = originalText;
            formObservasi.submit();
        }
    });
});
</script>
