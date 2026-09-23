@include('layout.head', ['title' => 'CHECKLIST INSPEKSI GUDANG B3'])
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
                                        <h6>FM-SHE-155/00/22/12/14</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">CHECKLIST INSPEKSI GUDANG B3</h5>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $b3->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pukul:</h6>
                                    <h5>{{ Carbon::parse($b3->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($b3->jam_inspeksi)->locale('id')->isoFormat('HH:mm') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">PIC:</h6>
                                    <h5>{{ $b3->nik_pic }} | {{ $b3->pic }}</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Deskripsi Pemeriksaan</th>
                                                <th>YA</th>
                                                <th>TIDAK</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="font-weight: bold;">
                                                <td>I</td>
                                                <td colspan="4">Kemasan B3</td>
                                            </tr>

                                            <tr>
                                                <td>1.1</td>
                                                <td>Kondisi baik</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_11_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_11_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_11_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.2</td>
                                                <td>Kemasan dari plastik atau logam</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_12_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_12_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_12_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.3</td>
                                                <td>B3 di pisahkan kemasannya sesuai karakteristik jenisnya</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_13_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_13_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_13_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.4</td>
                                                <td>Terdapat label B3 yang berisi klasifikasi dan jenis B3</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_14_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_14_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_14_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.5</td>
                                                <td>Terdapat simbol B3 sesuai klasifikasi</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_15_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_15_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_15_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.6</td>
                                                <td>Posisi penempelan label dan simbol B3 mudah terlihat</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_16_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_16_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_16_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.7</td>
                                                <td>Posisi penempelan simbol B3 diatas label B3</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_17_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_17_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_17_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.8</td>
                                                <td>Beralaskan balet</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_18_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_18_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_18_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>1.9</td>
                                                <td>Kemasan di letakan di dalam bangunan penyimpanan B3</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_19_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->kemasan_19_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->kemasan_19_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>II</td>
                                                <td colspan="4">Bangunan Penyimpanan B3</td>
                                            </tr>

                                            <tr>
                                                <td>2.1</td>
                                                <td>Bangunan dapat menampung semua B3</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_21_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_21_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_21_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.2</td>
                                                <td>Atap tidak bocor</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_22_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_22_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_22_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.3</td>
                                                <td>Tanpa Plafon</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_23_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_23_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_23_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.4</td>
                                                <td>Talang air</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_24_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_24_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_24_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.5</td>
                                                <td>Lampu penerangan</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_25_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_25_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_25_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.6</td>
                                                <td>Penangkal petir</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_26_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_26_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_26_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.7</td>
                                                <td>Lantai kedap air dan tidak retak</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_27_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_27_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_27_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.8</td>
                                                <td>Saluran bersih</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_28_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_28_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_28_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.9</td>
                                                <td>Bebas banjir</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_29_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_29_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_29_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>2.10</td>
                                                <td>Konkrit lantai lebih tinggi dari halaman luar</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_210_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->bangunan_210_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->bangunan_210_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>III</td>
                                                <td colspan="4">Tanda Informasi</td>
                                            </tr>

                                            <tr>
                                                <td>3.1</td>
                                                <td>Simbol APD</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_31_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_31_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->tanda_31_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>3.3</td>
                                                <td>Dilarang masuk bagi yang tidak berkepentingan</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_33_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_33_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->tanda_33_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>3.4</td>
                                                <td>Dilarang merokok</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_34_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_34_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->tanda_34_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>3.5</td>
                                                <td>Jenis B3 yang disimpan</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_35_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->tanda_35_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->tanda_35_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>IV</td>
                                                <td colspan="4">Fasilitas Bangunan</td>
                                            </tr>

                                            <tr>
                                                <td>4.1</td>
                                                <td>APAR</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_41_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_41_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->fasilitas_41_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>4.2</td>
                                                <td>Eye Wash</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_42_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_42_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->fasilitas_42_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>4.3</td>
                                                <td>P3K</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_43_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_43_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->fasilitas_43_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>4.4</td>
                                                <td>Alarm</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_44_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->fasilitas_44_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->fasilitas_44_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>V</td>
                                                <td colspan="4">Administrasi</td>
                                            </tr>

                                            <tr>
                                                <td>5.1</td>
                                                <td>MSDS</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->administrasi_51_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->administrasi_51_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->administrasi_51_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>5.2</td>
                                                <td>SOP</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->administrasi_52_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->administrasi_52_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->administrasi_52_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>5.5</td>
                                                <td>Check list inspeksi gudang B3</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->administrasi_55_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->administrasi_55_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->administrasi_55_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>VI</td>
                                                <td colspan="4">Oil Trap</td>
                                            </tr>

                                            <tr>
                                                <td>6.1</td>
                                                <td>Dalam keadaan baik</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_61_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_61_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->oil_61_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>6.2</td>
                                                <td>Outlet kompartemen 3 close circuit</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_62_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_62_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->oil_62_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>6.3</td>
                                                <td>Tutup terbuat dari bahan yang kuat</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_63_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_63_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->oil_63_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>6.4</td>
                                                <td>Tutup terpasang rapi</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_64_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_64_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->oil_64_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>6.5</td>
                                                <td>Tutup dapat di buka</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_65_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->oil_65_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->oil_65_action }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>VIII</td>
                                                <td colspan="4">House Keeping</td>
                                            </tr>

                                            <tr>
                                                <td>8.1</td>
                                                <td>Halaman bersih</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->house_81_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->house_81_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->house_81_action }}</td>
                                            </tr>

                                            <tr>
                                                <td>8.2</td>
                                                <td>Tidak ada bercak pada dinding</td>
                                                <td style="text-align:center;">
                                                    {{ $b3->house_82_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td style="text-align:center;">
                                                    {{ $b3->house_82_check == 'false' ? "✔️" : "" }}
                                                </td>
                                                <td>{{ $b3->house_82_action }}</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $b3->additional_notes }}</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Dibuat</h6>

                                    @if ($b3->verified_dibuat)
                                        <h5>
                                            <img src="{{ $b3->verified_dibuat }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $b3->nama_dibuat ?? '.......................' }}</h5>

                                    @if ($b3->catatan_verified_dibuat)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $b3->catatan_verified_dibuat }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Diperiksa</h6>

                                    @if ($b3->verified_diperiksa)
                                        <h5>
                                            <img src="{{ $b3->verified_diperiksa }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $b3->nama_diperiksa ?? '.......................' }}</h5>

                                    @if ($b3->catatan_verified_diperiksa)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $b3->catatan_verified_diperiksa }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="javascript:void(0)"
                                        onclick="window.history.back()"
                                        class="btn btn-light border rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2">
                                            <i class="ti ti-arrow-left"></i>
                                            <span>Kembali</span>
                                        </a>
                                    </li>

                                    {{-- <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.download', $b3->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $b3->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-printer f-22"></i>
                                        </a>
                                    </li> --}}

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


