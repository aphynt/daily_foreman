@include('layout.head', ['title' => 'Edit Observasi BANK'])
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
                        <h3>Edit Observasi BANK</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('observasibank.update', $observasi->uuid) }}" method="POST" id="submitformObservasiBank" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal" required value="{{ old('tanggal', $observasi->tanggal ? \Illuminate\Support\Carbon::parse($observasi->tanggal)->format('Y-m-d') : '') }}">
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Waktu/Jam</label>
                                        <input type="time" class="form-control form-control-sm" id="time" name="jam" required value="{{ old('jam', $observasi->jam ? substr((string) $observasi->jam, 0, 5) : '') }}">
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Departemen</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect1" name="departemen_id" required data-trigger>
                                            <option value="" disabled>Pilih Departemen</option>
                                            @foreach ($users['departemen'] as $dep)
                                                <option value="{{ $dep->id }}" {{ (string) old('departemen_id', $observasi->departemen_id) === (string) $dep->id ? 'selected' : '' }}>{{ $dep->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Nama Pekerjaan</label>
                                        <input type="text" class="form-control form-control-sm" name="nama_pekerjaan" required value="{{ old('nama_pekerjaan', $observasi->nama_pekerjaan) }}">
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Referensi</label>
                                        <input type="text" class="form-control form-control-sm" name="referensi"  value="{{ old('referensi', $observasi->referensi) }}">
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>No. Referensi</label>
                                        <input type="text" class="form-control form-control-sm" name="no_referensi"  value="{{ old('no_referensi', $observasi->no_referensi) }}">
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Lokasi</label>
                                        <input type="text" class="form-control form-control-sm" name="lokasi"  value="{{ old('lokasi', $observasi->lokasi) }}">
                                    </div>
                                    {{-- <div class="col-md-6 col-12 px-2 py-2">
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
                                    </div> --}}

                                    {{-- <div class="col-md-6 col-12 px-2 py-2" id="lokasi_lain_container" style="display:none;">
                                        <label>Lokasi Lainnya</label>
                                        <input type="text" class="form-control form-control-sm" id="lokasi_lain" name="lokasi_lain" placeholder="Masukkan lokasi lainnya" value="{{ old('lokasi_lain', $observasi->lokasi_lain) }}">
                                    </div> --}}
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
                                                    <input type="checkbox" name="perilaku_posisi_saat_bekerja" value="1" {{ old('perilaku_posisi_saat_bekerja', $observasi->perilaku_posisi_saat_bekerja) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Menggunakan peralatan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_menggunakan_peralatan" value="1" {{ old('perilaku_menggunakan_peralatan', $observasi->perilaku_menggunakan_peralatan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mengangkat barang</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_mengangkat_barang" value="1" {{ old('perilaku_mengangkat_barang', $observasi->perilaku_mengangkat_barang) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mengemudi</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_mengemudi" value="1" {{ old('perilaku_mengemudi', $observasi->perilaku_mengemudi) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Menaiki / Menuruni tangga</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="perilaku_menaiki_menuruni_tangga" value="1" {{ old('perilaku_menaiki_menuruni_tangga', $observasi->perilaku_menaiki_menuruni_tangga) ? 'checked' : '' }}>
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
                                                    <input type="text" name="perilaku_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya..." value="{{ old('perilaku_lain_1', $observasi->perilaku_lain_1) }}">
                                                </td>
                                            </tr>
                                            <tr id="perilaku_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="perilaku_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya..." value="{{ old('perilaku_lain_2', $observasi->perilaku_lain_2) }}">
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
                                                    <input type="checkbox" name="apd_pelindung_kepala" value="1" {{ old('apd_pelindung_kepala', $observasi->apd_pelindung_kepala) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung mata (Kaca Mata)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_mata" value="1" {{ old('apd_pelindung_mata', $observasi->apd_pelindung_mata) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung telinga (Earplug/ Muff)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_telinga" value="1" {{ old('apd_pelindung_telinga', $observasi->apd_pelindung_telinga) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung pernafasan (Masker)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_pernafasan" value="1" {{ old('apd_pelindung_pernafasan', $observasi->apd_pelindung_pernafasan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung tangan (Sarung Tangan)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_tangan" value="1" {{ old('apd_pelindung_tangan', $observasi->apd_pelindung_tangan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung kaki (Safety Shoes)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_kaki" value="1" {{ old('apd_pelindung_kaki', $observasi->apd_pelindung_kaki) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung tenggelam (Life Jacket)</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_pelindung_tenggelam" value="1" {{ old('apd_pelindung_tenggelam', $observasi->apd_pelindung_tenggelam) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>LOTO</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_loto" value="1" {{ old('apd_loto', $observasi->apd_loto) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sabuk Pengaman / Set Belt</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="apd_sabuk_pengaman" value="1" {{ old('apd_sabuk_pengaman', $observasi->apd_sabuk_pengaman) ? 'checked' : '' }}>
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
                                                    <input type="text" name="apd_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya..." value="{{ old('apd_lain_1', $observasi->apd_lain_1) }}">
                                                </td>
                                            </tr>
                                            <tr id="apd_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="apd_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya..." value="{{ old('apd_lain_2', $observasi->apd_lain_2) }}">
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
                                                    <input type="checkbox" name="risiko_menabrak" value="1" {{ old('risiko_menabrak', $observasi->risiko_menabrak) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terjepit</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terjepit" value="1" {{ old('risiko_terjepit', $observasi->risiko_terjepit) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terpukul / terbentur</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terpukul" value="1" {{ old('risiko_terpukul', $observasi->risiko_terpukul) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terpeleset / terguling / terjatuh</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terpeleset" value="1" {{ old('risiko_terpeleset', $observasi->risiko_terpeleset) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sengatan / gigitan binatang</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_sengatan" value="1" {{ old('risiko_sengatan', $observasi->risiko_sengatan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gangguan kesehatan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_gangguan_kesehatan" value="1" {{ old('risiko_gangguan_kesehatan', $observasi->risiko_gangguan_kesehatan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pencemaran Lingkungan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_pencemaran_lingkungan" value="1" {{ old('risiko_pencemaran_lingkungan', $observasi->risiko_pencemaran_lingkungan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Terhirup / terpapar debu / bahan kimia</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_terhirup" value="1" {{ old('risiko_terhirup', $observasi->risiko_terhirup) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kontak dengan panas / listrik</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="risiko_kontak" value="1" {{ old('risiko_kontak', $observasi->risiko_kontak) ? 'checked' : '' }}>
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
                                                    <input type="text" name="risiko_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya..." value="{{ old('risiko_lain_1', $observasi->risiko_lain_1) }}">
                                                </td>
                                            </tr>
                                            <tr id="risiko_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="risiko_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya..." value="{{ old('risiko_lain_2', $observasi->risiko_lain_2) }}">
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
                                                    <input type="checkbox" name="peralatan_sesuai" value="1" {{ old('peralatan_sesuai', $observasi->peralatan_sesuai) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Benar dalam menggunakan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_benar" value="1" {{ old('peralatan_benar', $observasi->peralatan_benar) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kondisi baik dan layak operasi</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_kondisi" value="1" {{ old('peralatan_kondisi', $observasi->peralatan_kondisi) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Taging / KIP ada / telah dilakukan pengecekan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_taging" value="1" {{ old('peralatan_taging', $observasi->peralatan_taging) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pelindung dan pengaman</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="peralatan_pelindung" value="1" {{ old('peralatan_pelindung', $observasi->peralatan_pelindung) ? 'checked' : '' }}>
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
                                                    <input type="text" name="peralatan_lain_1" class="form-control form-control-sm" placeholder="Isi lainnya..." value="{{ old('peralatan_lain_1', $observasi->peralatan_lain_1) }}">
                                                </td>
                                            </tr>
                                            <tr id="peralatan_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="peralatan_lain_2" class="form-control form-control-sm" placeholder="Tambahan lainnya..." value="{{ old('peralatan_lain_2', $observasi->peralatan_lain_2) }}">
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
                                                    <input type="checkbox" name="prosedur_tersedia" value="1" {{ old('prosedur_tersedia', $observasi->prosedur_tersedia) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Diketahui / Dimengerti</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_diketahui" value="1" {{ old('prosedur_diketahui', $observasi->prosedur_diketahui) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dijalankan / dilaksanakan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_dijalankan" value="1" {{ old('prosedur_dijalankan', $observasi->prosedur_dijalankan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Permit / Izin Kerja</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_permit" value="1" {{ old('prosedur_permit', $observasi->prosedur_permit) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>P2H</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="prosedur_p2h" value="1" {{ old('prosedur_p2h', $observasi->prosedur_p2h) ? 'checked' : '' }}>
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
                                                    <input type="text" name="prosedur_kerja_lain" class="form-control form-control-sm" placeholder="Isi lainnya" value="{{ old('prosedur_kerja_lain', $observasi->prosedur_kerja_lain) }}">
                                                </td>
                                            </tr>
                                            <tr id="prosedur_kerja_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="prosedur_kerja_lain_2" class="form-control form-control-sm" placeholder="Isi tambahan lainnya" value="{{ old('prosedur_kerja_lain_2', $observasi->prosedur_kerja_lain_2) }}">
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
                                                    <input type="checkbox" name="kondisi_area_kebersihan" value="1" {{ old('kondisi_area_kebersihan', $observasi->kondisi_area_kebersihan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rambu / Demarkasi</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_rambu" value="1" {{ old('kondisi_area_rambu', $observasi->kondisi_area_rambu) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Akses / jalan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_akses" value="1" {{ old('kondisi_area_akses', $observasi->kondisi_area_akses) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Penyimpanan barang</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_penyimpanan" value="1" {{ old('kondisi_area_penyimpanan', $observasi->kondisi_area_penyimpanan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Suhu</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_suhu" value="1" {{ old('kondisi_area_suhu', $observasi->kondisi_area_suhu) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pencahayaan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_pencahayaan" value="1" {{ old('kondisi_area_pencahayaan', $observasi->kondisi_area_pencahayaan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kebisingan</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_kebisingan" value="1" {{ old('kondisi_area_kebisingan', $observasi->kondisi_area_kebisingan) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cuaca</td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="kondisi_area_cuaca" value="1" {{ old('kondisi_area_cuaca', $observasi->kondisi_area_cuaca) ? 'checked' : '' }}>
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
                                                    <input type="text" name="kondisi_area_lain" class="form-control form-control-sm" placeholder="Isi lainnya" value="{{ old('kondisi_area_lain', $observasi->kondisi_area_lain) }}">
                                                </td>
                                            </tr>
                                            <tr id="kondisi_area_lain_row2" style="display:none;">
                                                <td colspan="2">
                                                    <input type="text" name="kondisi_area_lain_2" class="form-control form-control-sm" placeholder="Isi tambahan lainnya" value="{{ old('kondisi_area_lain_2', $observasi->kondisi_area_lain_2) }}">
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
                                                   <textarea id="perilaku_aman_yang_diamati" name="perilaku_aman_yang_diamati" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan komentar...">{{ old('perilaku_aman_yang_diamati', $observasi->perilaku_aman_yang_diamati) }}</textarea>
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
                                                   <textarea id="perilaku_tidak_aman_yang_diamati" name="perilaku_tidak_aman_yang_diamati" class="form-control form-control-sm pb-2" rows="3" placeholder="Tambahkan komentar...">{{ old('perilaku_tidak_aman_yang_diamati', $observasi->perilaku_tidak_aman_yang_diamati) }}</textarea>
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
                                                <input type="checkbox" name="tindakan_kegiatan" value="1" {{ old('tindakan_kegiatan', $observasi->tindakan_kegiatan) ? 'checked' : '' }}>
                                            </td>
                                            <td>Kegiatan di Hentikan</td>
                                        </tr>
                                        <tr>
                                            <td class="check-col">
                                                <input type="checkbox" name="tindakan_perbaikan_langsung" value="1" {{ old('tindakan_perbaikan_langsung', $observasi->tindakan_perbaikan_langsung) ? 'checked' : '' }}>
                                            </td>
                                            <td>Perbaikan Langsung di Tempat</td>
                                        </tr>
                                        <tr>
                                            <td class="check-col">
                                                <input type="checkbox" name="tindakan_perbaikan_lanjutan" value="1" id="tindakan_lanjutan_check" {{ old('tindakan_perbaikan_lanjutan', $observasi->tindakan_perbaikan_lanjutan) ? 'checked' : '' }}>
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
                                                <input type="text" name="tindakan_lanjutan_1" class="form-control form-control-sm border-0 shadow-none" placeholder="" value="{{ old('tindakan_lanjutan_1', $observasi->tindakan_lanjutan_1) }}">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_1" class="form-control form-control-sm border-0 shadow-none" value="{{ old('tindakan_lanjutan_due_1', $observasi->tindakan_lanjutan_due_1 ? \Illuminate\Support\Carbon::parse($observasi->tindakan_lanjutan_due_1)->format('Y-m-d') : '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_2" class="form-control form-control-sm border-0 shadow-none" placeholder="" value="{{ old('tindakan_lanjutan_2', $observasi->tindakan_lanjutan_2) }}">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_2" class="form-control form-control-sm border-0 shadow-none" value="{{ old('tindakan_lanjutan_due_2', $observasi->tindakan_lanjutan_due_2 ? \Illuminate\Support\Carbon::parse($observasi->tindakan_lanjutan_due_2)->format('Y-m-d') : '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_3" class="form-control form-control-sm border-0 shadow-none" placeholder="" value="{{ old('tindakan_lanjutan_3', $observasi->tindakan_lanjutan_3) }}">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_3" class="form-control form-control-sm border-0 shadow-none" value="{{ old('tindakan_lanjutan_due_3', $observasi->tindakan_lanjutan_due_3 ? \Illuminate\Support\Carbon::parse($observasi->tindakan_lanjutan_due_3)->format('Y-m-d') : '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_4" class="form-control form-control-sm border-0 shadow-none" placeholder="" value="{{ old('tindakan_lanjutan_4', $observasi->tindakan_lanjutan_4) }}">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_4" class="form-control form-control-sm border-0 shadow-none" value="{{ old('tindakan_lanjutan_due_4', $observasi->tindakan_lanjutan_due_4 ? \Illuminate\Support\Carbon::parse($observasi->tindakan_lanjutan_due_4)->format('Y-m-d') : '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="tindakan_lanjutan_5" class="form-control form-control-sm border-0 shadow-none" placeholder="" value="{{ old('tindakan_lanjutan_5', $observasi->tindakan_lanjutan_5) }}">
                                            </td>
                                            <td>
                                                <input type="date" name="tindakan_lanjutan_due_5" class="form-control form-control-sm border-0 shadow-none" value="{{ old('tindakan_lanjutan_due_5', $observasi->tindakan_lanjutan_due_5 ? \Illuminate\Support\Carbon::parse($observasi->tindakan_lanjutan_due_5)->format('Y-m-d') : '') }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                @php
                                    $defaultPengawasValue = Auth::user()->nik . '|' . Auth::user()->name;
                                    $oldPengawasMode = old('pengawas1_mode', blank($observasi->pengawas1) ? 'manual' : 'auto');
                                    $oldPengawasValue = old('pengawas1_auto', $observasi->pengawas1 . '|' . $observasi->nama_pengawas1);
                                 @endphp
                                <hr>
                                <!-- Catatan -->
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan Khusus:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3"
                                        placeholder="Tambahkan catatan...">{{ old('additional_notes', $observasi->additional_notes) }}</textarea>
                                </div>

                                <hr>
                                <div class="row mb-3">
                                    <h5>X. Petugas / Observer</h5>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            $fieldPetugas = 'petugas' . $i;
                                            $nilaiPetugas = old($fieldPetugas, $observasi->{$fieldPetugas});
                                            $petugasTerdaftar = $users['petugas']->contains(function ($petugas) use ($nilaiPetugas) {
                                                return (string) $petugas->nik === (string) $nilaiPetugas
                                                    || (string) $petugas->name === (string) $nilaiPetugas;
                                            });
                                        @endphp
                                        <div class="col-md-12 col-12 px-2 py-2">
                                            <label>Petugas / Observer {{ $i }}</label>
                                            <select class="form-control form-control-sm" name="{{ $fieldPetugas }}" data-trigger>
                                                <option value="">Pilih Petugas</option>
                                                @if(filled($nilaiPetugas) && !$petugasTerdaftar)
                                                    <option value="{{ $nilaiPetugas }}" selected>{{ $nilaiPetugas }} (Data tersimpan)</option>
                                                @endif
                                                @foreach ($users['petugas'] as $petugas)
                                                    <option value="{{ $petugas->nik }}"
                                                        {{ (string) $nilaiPetugas === (string) $petugas->nik || (string) $nilaiPetugas === (string) $petugas->name ? 'selected' : '' }}>
                                                        {{ $petugas->name }} ({{ $petugas->nik }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endfor
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <h5>XI. Pekerja yang di Observasi</h5>

                                    {{-- PATUGAS 1 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 1</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja1" value="{{ old('pekerja1', $observasi->pekerja1) }}">
                                    </div>

                                    {{-- PATUGAS 2 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 2</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja2" value="{{ old('pekerja2', $observasi->pekerja2) }}">
                                    </div>

                                    {{-- PATUGAS 3 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 3</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja3" value="{{ old('pekerja3', $observasi->pekerja3) }}">
                                    </div>

                                    {{-- PATUGAS 4 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 4</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja4" value="{{ old('pekerja4', $observasi->pekerja4) }}">
                                    </div>

                                    {{-- PATUGAS 5 --}}
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pekerja 5</label>
                                        <input type="text" class="form-control form-control-sm" name="pekerja5" value="{{ old('pekerja5', $observasi->pekerja5) }}">
                                    </div>

                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <h5>XII. Validasi Pengawas / Penanggung Jawab</h5>

                                    <div class="col-md-12 col-12 px-2 py-2">

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="pengawas1_mode"
                                                id="pengawas1_mode_auto"
                                                value="auto"
                                                {{ $oldPengawasMode == 'auto' ? 'checked' : '' }}>

                                            <label class="form-check-label" for="pengawas1_mode_auto">
                                                Otomatis / Pilih dari daftar
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="pengawas1_mode"
                                                id="pengawas1_mode_manual"
                                                value="manual"
                                                {{ $oldPengawasMode == 'manual' ? 'checked' : '' }}>

                                            <label class="form-check-label" for="pengawas1_mode_manual">
                                                Masukkan Manual
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12 px-2 py-2" id="pengawas_auto_container">
                                        <label>Pengawas</label>
                                        <select class="form-control form-control-sm" name="pengawas1_auto" id="pengawas1_auto" data-trigger>
                                            <option value="{{ $defaultPengawasValue }}"
                                                {{ $oldPengawasValue == $defaultPengawasValue ? 'selected' : '' }}>
                                                {{ Auth::user()->name }} ({{ Auth::user()->nik }})
                                            </option>

                                            @foreach ($users['pengawas'] as $pengawas)
                                                @php
                                                    $pengawasValue = $pengawas->nik . '|' . $pengawas->name;
                                                @endphp

                                                <option value="{{ $pengawasValue }}"
                                                    {{ $oldPengawasValue == $pengawasValue ? 'selected' : '' }}>
                                                    {{ $pengawas->name }} ({{ $pengawas->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 col-12 px-2 py-2" id="pengawas_manual_container" style="display:none;">
                                        <label>Nama Pengawas</label>
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            name="nama_pengawas1_manual"
                                            id="nama_pengawas1_manual"
                                            value="{{ old('nama_pengawas1_manual', $observasi->nama_pengawas1) }}"
                                            placeholder="Masukkan nama pengawas">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <h5>XIII. Dokumentasi</h5>

                                    <div class="upload-grid">
                                        <div class="upload-card">
                                            <label>Dokumentasi 1</label>
                                            <input type="file"
                                                class="form-control form-control-sm"
                                                name="dokumentasi_foto_1"
                                                accept="image/*">
                                            @if($observasi->dokumentasi_foto_1)
                                                <div class="mt-2"><a href="{{ $observasi->dokumentasi_foto_1 }}" target="_blank" rel="noopener noreferrer">Lihat foto lama 1</a></div>
                                            @endif
                                            <div class="upload-note">Format disarankan: JPG, PNG, WEBP.</div>
                                        </div>

                                        <div class="upload-card">
                                            <label>Dokumentasi 2</label>
                                            <input type="file"
                                                class="form-control form-control-sm"
                                                name="dokumentasi_foto_2"
                                                accept="image/*">
                                            @if($observasi->dokumentasi_foto_2)
                                                <div class="mt-2"><a href="{{ $observasi->dokumentasi_foto_2 }}" target="_blank" rel="noopener noreferrer">Lihat foto lama 2</a></div>
                                            @endif
                                            <div class="upload-note">Opsional, isi jika ada dokumentasi tambahan.</div>
                                        </div>

                                        <div class="upload-card">
                                            <label>Dokumentasi 3</label>
                                            <input type="file"
                                                class="form-control form-control-sm"
                                                name="dokumentasi_foto_3"
                                                accept="image/*">
                                            @if($observasi->dokumentasi_foto_3)
                                                <div class="mt-2"><a href="{{ $observasi->dokumentasi_foto_3 }}" target="_blank" rel="noopener noreferrer">Lihat foto lama 3</a></div>
                                            @endif
                                            <div class="upload-note">Opsional, isi jika ada dokumentasi tambahan.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2" id="submitButtonObservasiBank">Update Data</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const groups = [
        ['perilaku_lain_check', 'perilaku_lain_1', 'perilaku_lain_2'],
        ['apd_lain_check', 'apd_lain_1', 'apd_lain_2'],
        ['risiko_lain_check', 'risiko_lain_1', 'risiko_lain_2'],
        ['peralatan_lain_check', 'peralatan_lain_1', 'peralatan_lain_2'],
        ['prosedur_kerja_lain_check', 'prosedur_kerja_lain', 'prosedur_kerja_lain_2'],
        ['kondisi_area_lain_check', 'kondisi_area_lain', 'kondisi_area_lain_2']
    ];
    for (const [id, ...fields] of groups) {
        const toggle = document.getElementById(id);
        const inputs = fields.map(name => document.querySelector('input[name="' + name + '"]'));
        if (!toggle) continue;
        toggle.checked = inputs.some(el => el && el.value.trim() !== '');
        for (const el of inputs) {
            if (el) {
                const row = el.closest('tr');
                if (row) row.style.display = toggle.checked ? '' : 'none';
            }
        }
    }
});
</script>

@include('layout.footer')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modeAuto = document.getElementById('pengawas1_mode_auto');
    const modeManual = document.getElementById('pengawas1_mode_manual');

    const autoContainer = document.getElementById('pengawas_auto_container');
    const manualContainer = document.getElementById('pengawas_manual_container');

    const selectAuto = document.getElementById('pengawas1_auto');
    const inputManual = document.getElementById('nama_pengawas1_manual');

    function togglePengawasMode() {
        if (modeManual.checked) {
            autoContainer.style.display = 'none';
            manualContainer.style.display = 'block';

            selectAuto.disabled = true;
            inputManual.disabled = false;
            inputManual.required = true;
        } else {
            autoContainer.style.display = 'block';
            manualContainer.style.display = 'none';

            selectAuto.disabled = false;
            inputManual.disabled = true;
            inputManual.required = false;
            inputManual.value = '';
        }
    }

    modeAuto.addEventListener('change', togglePengawasMode);
    modeManual.addEventListener('change', togglePengawasMode);

    togglePengawasMode();
});
</script>
<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const lokasi = document.getElementById('lokasi');
    //     const container = document.getElementById('lokasi_lain_container');
    //     const lokasiLain = document.getElementById('lokasi_lain');

    //     function toggleLokasiLain() {
    //         if (lokasi.value === 'LAIN-LAIN') {
    //             container.style.display = 'block';
    //             lokasiLain.required = true;
    //         } else {
    //             container.style.display = 'none';
    //             lokasiLain.required = false;
    //             lokasiLain.value = '';
    //         }
    //     }

    //     lokasi.addEventListener('change', toggleLokasiLain);
    //     toggleLokasiLain();
    // });

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
