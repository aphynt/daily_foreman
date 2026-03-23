@include('layout.head', ['title' => 'Inspeksi Slurry Pump'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
@endphp
<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="row align-items-center g-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('dashboard/assets') }}/images/logo-full.png"
                                                class="img-fluid"
                                                alt="images"
                                                style="max-width:200px;">
                                        </div>
                                    </div>

                                    <div class="col-6 text-end">
                                        <h6>FM-SE-05/00/03/02/26</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">DAFTAR PERIKSA INSPEKSI SLURRY PUMP</h5>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Tanggal:</h6>
                                    <h5>{{ Carbon::parse($sp->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Nama Lokasi:</h6>
                                    <h5>{{ $sp->nama_lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi Pit:</h6>
                                    <h5>{{ $sp->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Penanggung Jawab Area:</h6>
                                    <h5>{{ $sp->nik_penanggungjawab }} | {{ $sp->nama_penanggungjawab }}</h5>
                                </div>
                            </div>
                            <div class="alert alert-primary">
                                <div class="d-flex align-items-center"><i class="ti ti-info-circle h2 f-w-400 mb-0"></i>
                                    <div class="flex-grow-1 ms-3">Tuliskan S <i>(sesuai)</i> atau TS <i>(Tidak Sesuai)</i> pada kolom Kesesuaian sesuai hasil pengamatan</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Deskripsi Pemeriksaan</th>
                                                <th>Kesesuaian</th>
                                                <th>Tindak Lanjut Perbaikan</th>
                                                <th>Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="font-weight: bold;">
                                                <td>1</td>
                                                <td colspan="4">Kelengkapan Dokumen</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Apakah Form P2H ada di lokasi dan sudah di isi</td>
                                                <td style="text-align:center;">{{ $sp->kelengkapan_11_check }}</td>
                                                {{-- <td>{{ $sp->kelengkapan_11_check === null ? '' : ($sp->kelengkapan_11_check === 'S' ? 'Setuju' : 'Tidak Setuju') }}</td> --}}
                                                <td>{{ $sp->kelengkapan_11_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kelengkapan_11_due ? \Carbon\Carbon::parse($sp->kelengkapan_11_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Apakah dilokasi terdapat JSA dan IK atau SOP</td>
                                                <td style="text-align:center;">{{ $sp->kelengkapan_12_check }}</td>
                                                <td>{{ $sp->kelengkapan_12_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kelengkapan_12_due ? \Carbon\Carbon::parse($sp->kelengkapan_12_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Apakah kondisi fisik front loading memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Kondisi Kebersihan Pontoon secara keseluruhan </td>
                                                <td style="text-align:center;">{{ $sp->kondisi_21_check }}</td>
                                                <td>{{ $sp->kondisi_21_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_21_due ? \Carbon\Carbon::parse($sp->kondisi_21_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Kondisi Rel tangan dan pegangan  ( keliling unti Pontoon )</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_22_check }}</td>
                                                <td>{{ $sp->kondisi_22_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_22_due ? \Carbon\Carbon::parse($sp->kondisi_22_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Kondisi Ring buoy dan tali ring buoy 15 meter </td>
                                                <td style="text-align:center;">{{ $sp->kondisi_23_check }}</td>
                                                <td>{{ $sp->kondisi_23_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_23_due ? \Carbon\Carbon::parse($sp->kondisi_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Kondisi apar dan bracket di Pontoon </td>
                                                <td style="text-align:center;">{{ $sp->kondisi_24_check }}</td>
                                                <td>{{ $sp->kondisi_24_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_24_due ? \Carbon\Carbon::parse($sp->kondisi_24_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Kondisi Tangga dan tempat pijakan Pontoon</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_25_check }}</td>
                                                <td>{{ $sp->kondisi_25_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_25_due ? \Carbon\Carbon::parse($sp->kondisi_25_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.6</td>
                                                <td>Kondisi Plat tanda keselamatan terpasang di Pontoon</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_26_check }}</td>
                                                <td>{{ $sp->kondisi_26_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_26_due ? \Carbon\Carbon::parse($sp->kondisi_26_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">Sticker dan Rambu</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Terdapat Logo perusahaan </td>
                                                <td style="text-align:center;">{{ $sp->sticker_31_check }}</td>
                                                <td>{{ $sp->sticker_31_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_31_due ? \Carbon\Carbon::parse($sp->sticker_31_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Terdapat No unit/lambung terpasang 4 sisi</td>
                                                <td style="text-align:center;">{{ $sp->sticker_32_check }}</td>
                                                <td>{{ $sp->sticker_32_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_32_due ? \Carbon\Carbon::parse($sp->sticker_32_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Apakah Sudah terpasang sign LOTO</td>
                                                <td style="text-align:center;">{{ $sp->sticker_33_check }}</td>
                                                <td>{{ $sp->sticker_33_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_33_due ? \Carbon\Carbon::parse($sp->sticker_33_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Apakah Emergency shut down sudah terpasang </td>
                                                <td style="text-align:center;">{{ $sp->sticker_34_check }}</td>
                                                <td>{{ $sp->sticker_34_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_34_due ? \Carbon\Carbon::parse($sp->sticker_34_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.5</td>
                                                <td>Apakah Stiker titik jepit  sudah terpasang </td>
                                                <td style="text-align:center;">{{ $sp->sticker_35_check }}</td>
                                                <td>{{ $sp->sticker_35_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_35_due ? \Carbon\Carbon::parse($sp->sticker_35_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.6</td>
                                                <td>Apakah rambu “Di larang merokok’’ sudah terpasang </td>
                                                <td style="text-align:center;">{{ $sp->sticker_36_check }}</td>
                                                <td>{{ $sp->sticker_36_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_36_due ? \Carbon\Carbon::parse($sp->sticker_36_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.7</td>
                                                <td>Apakah rambu ‘Di larang menggunakan handphone saat mengoperasikan alat’’ sudah terpasang </td>
                                                <td style="text-align:center;">{{ $sp->sticker_37_check }}</td>
                                                <td>{{ $sp->sticker_37_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_37_due ? \Carbon\Carbon::parse($sp->sticker_37_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.8</td>
                                                <td>Apakah rambu APD , pelampung , earmuff, kacamata, gloves, shoes, helmet sudah terpasang </td>
                                                <td style="text-align:center;">{{ $sp->sticker_38_check }}</td>
                                                <td>{{ $sp->sticker_38_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_38_due ? \Carbon\Carbon::parse($sp->sticker_38_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.9</td>
                                                <td>Apakah rambu Bahaya Mesin berputar dan permukaan panas sudah terpasang </td>
                                                <td style="text-align:center;">{{ $sp->sticker_39_check }}</td>
                                                <td>{{ $sp->sticker_39_action }}</td>
                                                <td style="text-align:center;">{{ $sp->sticker_39_due ? \Carbon\Carbon::parse($sp->sticker_39_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Lampu dan aksesoris listrik</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Kondisi Lampu depan berfungsi dengan baik</td>
                                                <td style="text-align:center;">{{ $sp->lampu_41_check }}</td>
                                                <td>{{ $sp->lampu_41_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lampu_41_due ? \Carbon\Carbon::parse($sp->lampu_41_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Kondsi Lampu belakang berfungsi dengan baik</td>
                                                <td style="text-align:center;">{{ $sp->lampu_42_check }}</td>
                                                <td>{{ $sp->lampu_42_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lampu_42_due ? \Carbon\Carbon::parse($sp->lampu_42_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Kondisi Lampu samping berfungsi dengan baik</td>
                                                <td style="text-align:center;">{{ $sp->lampu_43_check }}</td>
                                                <td>{{ $sp->lampu_43_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lampu_43_due ? \Carbon\Carbon::parse($sp->lampu_43_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.4</td>
                                                <td>Kondisi battery dan kabel-kabel baik</td>
                                                <td style="text-align:center;">{{ $sp->lampu_44_check }}</td>
                                                <td>{{ $sp->lampu_44_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lampu_44_due ? \Carbon\Carbon::parse($sp->lampu_44_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.5</td>
                                                <td>Kondisi cover dan kunci battery baik</td>
                                                <td style="text-align:center;">{{ $sp->lampu_45_check }}</td>
                                                <td>{{ $sp->lampu_45_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lampu_45_due ? \Carbon\Carbon::parse($sp->lampu_45_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.6</td>
                                                <td>Kondisi lampu rotary berfungsi dengan baik</td>
                                                <td style="text-align:center;">{{ $sp->lampu_46_check }}</td>
                                                <td>{{ $sp->lampu_46_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lampu_46_due ? \Carbon\Carbon::parse($sp->lampu_46_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.7</td>
                                                <td>Kondisi Kotak isolasi dan stop darurat baik</td>
                                                <td style="text-align:center;">{{ $sp->lampu_47_check }}</td>
                                                <td>{{ $sp->lampu_47_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lampu_47_due ? \Carbon\Carbon::parse($sp->lampu_47_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>5</td>
                                                <td colspan="4">Mesin</td>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Kondisi mesin dan kebersihan  baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_51_check }}</td>
                                                <td>{{ $sp->mesin_51_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_51_due ? \Carbon\Carbon::parse($sp->mesin_51_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Semua kondisi selang, cylinder, hydrolik, dan saluran baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_52_check }}</td>
                                                <td>{{ $sp->mesin_52_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_52_due ? \Carbon\Carbon::parse($sp->mesin_52_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.3</td>
                                                <td>Kondisi indicator panel dan fungsi pengukur baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_53_check }}</td>
                                                <td>{{ $sp->mesin_53_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_53_due ? \Carbon\Carbon::parse($sp->mesin_53_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.4</td>
                                                <td>Kondisi Cover engine baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_54_check }}</td>
                                                <td>{{ $sp->mesin_54_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_54_due ? \Carbon\Carbon::parse($sp->mesin_54_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.5</td>
                                                <td>Kondisi Cover radiator baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_55_check }}</td>
                                                <td>{{ $sp->mesin_55_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_55_due ? \Carbon\Carbon::parse($sp->mesin_55_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.6</td>
                                                <td>Kondisi Winch, Sling, hook & shackle baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_56_check }}</td>
                                                <td>{{ $sp->mesin_56_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_56_due ? \Carbon\Carbon::parse($sp->mesin_56_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.7</td>
                                                <td>Kondisi saringan selang hisap baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_57_check }}</td>
                                                <td>{{ $sp->mesin_57_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_57_due ? \Carbon\Carbon::parse($sp->mesin_57_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.8</td>
                                                <td>Kondisi Tutup bahan bakar, pengukur pada tangki baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_58_check }}</td>
                                                <td>{{ $sp->mesin_58_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_58_due ? \Carbon\Carbon::parse($sp->mesin_58_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.9</td>
                                                <td>Kondisi Tangga, tempat pijakan, dan pegangan ke atas engine baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_59_check }}</td>
                                                <td>{{ $sp->mesin_59_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_59_due ? \Carbon\Carbon::parse($sp->mesin_59_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.10</td>
                                                <td>Kondisi Pelindung knalpot dan tutup knalpot baik</td>
                                                <td style="text-align:center;">{{ $sp->mesin_510_check }}</td>
                                                <td>{{ $sp->mesin_510_action }}</td>
                                                <td style="text-align:center;">{{ $sp->mesin_510_due ? \Carbon\Carbon::parse($sp->mesin_510_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>6</td>
                                                <td colspan="4">Lain-lain</td>
                                            </tr>
                                            <tr>
                                                <td>6.1</td>
                                                <td>Apakah Oil spill kit ( Absorbent ) tersedia </td>
                                                <td style="text-align:center;">{{ $sp->lain_61_check }}</td>
                                                <td>{{ $sp->lain_61_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lain_61_due ? \Carbon\Carbon::parse($sp->lain_61_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.2</td>
                                                <td>Apakah Tempat sampah/limbah B3 sementara tersedia</td>
                                                <td style="text-align:center;">{{ $sp->lain_62_check }}</td>
                                                <td>{{ $sp->lain_62_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lain_62_due ? \Carbon\Carbon::parse($sp->lain_62_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.3</td>
                                                <td>Radio komunikasi tersedia</td>
                                                <td style="text-align:center;">{{ $sp->lain_63_check }}</td>
                                                <td>{{ $sp->lain_63_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lain_63_due ? \Carbon\Carbon::parse($sp->lain_63_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.4</td>
                                                <td>Kondisi Life jacket baik</td>
                                                <td style="text-align:center;">{{ $sp->lain_64_check }}</td>
                                                <td>{{ $sp->lain_64_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lain_64_due ? \Carbon\Carbon::parse($sp->lain_64_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.5</td>
                                                <td>Kondisi perahu baik</td>
                                                <td style="text-align:center;">{{ $sp->lain_65_check }}</td>
                                                <td>{{ $sp->lain_65_action }}</td>
                                                <td style="text-align:center;">{{ $sp->lain_65_due ? \Carbon\Carbon::parse($sp->lain_65_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $sp->additional_notes }}</p>
                            </div>
                             <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Inspektor</th>
                                                <th>NIK</th>
                                                <th>Jabatan</th>
                                                <th>Tanda Tangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $sp->nama_inspektor1 }}</td>
                                                <td>{{ $sp->nik_inspektor1 }}</td>
                                                <td></td>
                                                <td><img src="{{ $sp->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $sp->nama_inspektor2 }}</td>
                                                <td>{{ $sp->nik_inspektor2 }}</td>
                                                <td></td>
                                                <td><img src="{{ $sp->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $sp->nama_inspektor3 }}</td>
                                                <td>{{ $sp->nik_inspektor3 }}</td>
                                                <td></td>
                                                <td><img src="{{ $sp->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $sp->nama_inspektor4 }}</td>
                                                <td>{{ $sp->nik_inspektor4 }}</td>
                                                <td></td>
                                                <td><img src="{{ $sp->verified_inspektor4 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>{{ $sp->nama_inspektor5 }}</td>
                                                <td>{{ $sp->nik_inspektor5 }}</td>
                                                <td></td>
                                                <td><img src="{{ $sp->verified_inspektor5 }}" style="max-width: 70px;"></td>
                                            </tr>
                                        </tbody>


                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.download', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $sp->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-printer f-22"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')


