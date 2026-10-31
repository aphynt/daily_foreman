@include('layout.head', ['title' => 'CHECKLIST TPS LIMBAH B3'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $report = $tps;

    $isChecked = function ($value) {
        return (int) $value === 1 ? 'checked' : '';
    };

    $imageUrl = function ($path) {
        if (!$path) return null;

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    };

    $foto1 = $imageUrl($report->dokumentasi_1 ?? null);
    $foto2 = $imageUrl($report->dokumentasi_2 ?? null);
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
                                        <h6>FM-SHE-84/02/24/06/22</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">CHECKLIST TPS LIMBAH B3</h5>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $tps->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pukul:</h6>
                                    <h5>{{ Carbon::parse($tps->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($tps->jam_inspeksi)->locale('id')->isoFormat('HH:mm') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">PIC:</h6>
                                    <h5>{{ $tps->nik_pic }} | {{ $tps->pic }}</h5>
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
                                                    <td colspan="4">Kemasan Limbah B3</td>
                                                </tr>

                                                <tr>
                                                    <td>1.1</td>
                                                    <td>Kondisi baik</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_11_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_11_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_11_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.2</td>
                                                    <td>Tidak berkarat</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_12_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_12_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_12_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.3</td>
                                                    <td>Tidak Bocor</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_13_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_13_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_13_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.4</td>
                                                    <td>Kemasan dari plastik atau logam</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_14_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_14_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_14_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.5</td>
                                                    <td>Limbah di pisahkan kemasannya sesuai jenisnya</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_15_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_15_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_15_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.6</td>
                                                    <td>Terdapat penutup kemasan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_16_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_16_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_16_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.7</td>
                                                    <td>Terdapat Label karakteristik limbah 15 x 15 Cm</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_17_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_17_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_17_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.8</td>
                                                    <td>Terdapat Label identifikasi / identitas limbah berukuran minimal 15 x 20 CM dan diisi lengkap</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_18_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_18_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_18_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.9</td>
                                                    <td>Posisi penempelan label terlihat</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_19_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_19_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_19_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.10</td>
                                                    <td>Posisi penempelan label teridentifikasi/ identitas limbah di atas label karakteristik ( Permen LH No. 14 Tahun 2013 )</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_110_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_110_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_110_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.11</td>
                                                    <td>Terdapat Status isi kemasan yang "kosong" berukuran mi. 10 x 10 Cm</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_111_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_111_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_111_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>1.12</td>
                                                    <td>Terdapat Label petunjuk tutup kemasan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_112_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kemasan_112_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kemasan_112_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>II</td>
                                                    <td colspan="4">Penyimpanan Limbah B3</td>
                                                </tr>

                                                <tr>
                                                    <td>2.1</td>
                                                    <td>Beralaskan Palet</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_21_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_21_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->penyimpanan_21_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>2.2</td>
                                                    <td>jarak antar palet min 60 cm</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_22_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_22_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->penyimpanan_22_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>2.3</td>
                                                    <td>Maksimum 3 tingkat</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_23_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_23_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->penyimpanan_23_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>2.4</td>
                                                    <td>Apabila bertingkat,min.1 m dari atap</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_24_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_24_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->penyimpanan_24_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>2.5</td>
                                                    <td>Accu bekas di letakkan di rak</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_25_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->penyimpanan_25_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->penyimpanan_25_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>III</td>
                                                    <td colspan="4">Bangunan Penyimpanan Limbah B3</td>
                                                </tr>

                                                <tr>
                                                    <td>3.1</td>
                                                    <td>Bangunan dapat menampung semua limbah B3 yang dihasilkan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_31_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_31_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_31_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.2</td>
                                                    <td>Atap tidak bocor</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_32_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_32_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_32_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.3</td>
                                                    <td>Tanpa Plafon</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_33_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_33_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_33_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.4</td>
                                                    <td>Talang air</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_34_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_34_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_34_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.5</td>
                                                    <td>Ventilasi udara</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_35_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_35_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_35_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.6</td>
                                                    <td>Lampu penerangan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_36_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_36_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_36_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.7</td>
                                                    <td>Posisi saklar di luar ruangan, aman dari limbah dan aktivitas lain</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_37_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_37_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_37_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.8</td>
                                                    <td>Penangkal petir</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_38_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_38_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_38_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.9</td>
                                                    <td>Lantai kedap air</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_39_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_39_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_39_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.10</td>
                                                    <td>Lantai rata</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_310_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_310_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_310_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.11</td>
                                                    <td>Lantai tidak retak</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_311_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_311_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_311_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.12</td>
                                                    <td>Lantai miring ke arah saluran</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_312_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_312_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_312_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.13</td>
                                                    <td>Sekat pemisah antar jenis limbah</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_313_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_313_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_313_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.14</td>
                                                    <td>Saluran bersih</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_314_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_314_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_314_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.15</td>
                                                    <td>Bebas banjir</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_315_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_315_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_315_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>3.16</td>
                                                    <td>Konkrit lantai lebih tinggi dari halaman luar</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_316_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bangunan_316_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bangunan_316_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>IV</td>
                                                    <td colspan="4">Tanda Informasi</td>
                                                </tr>

                                                <tr>
                                                    <td>4.1</td>
                                                    <td>Terdapat Simbol APD</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_41_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_41_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_41_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>4.2</td>
                                                    <td>Terdapat papan informasi diluar TPS dan berisi lengkap</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_42_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_42_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_42_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>4.3</td>
                                                    <td>Papan Informasi Jenis Limbah yang di simpan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_43_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_43_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_43_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>4.4</td>
                                                    <td>Terdapat tanda Dilarang masuk bagi yang tidak berkepentingan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_44_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_44_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_44_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>4.5</td>
                                                    <td>Terdapat rambu Dilarang merokok</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_45_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_45_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_45_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>4.6</td>
                                                    <td>Terdapat tanda Dilarang membawa makanan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_46_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_46_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_46_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>4.7</td>
                                                    <td>No. TPS ( sesuai izin)</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_47_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_47_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_47_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>4.8</td>
                                                    <td>Terdapat papan informasi didalam TPS berisi SOP Penyimpanan limbah B3, SOP Tanggap Darurat, dan Flowchart tanggap darurat</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_48_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->tanda_48_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->tanda_48_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>V</td>
                                                    <td colspan="4">Fasilitas Bangunan</td>
                                                </tr>

                                                <tr>
                                                    <td>5.1</td>
                                                    <td>Terdapat APAR</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_51_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_51_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_51_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.2</td>
                                                    <td>Terdapat Eye Wash</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_52_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_52_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_52_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.3</td>
                                                    <td>Terdapat peta jalur evakuasi</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_53_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_53_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_53_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.4</td>
                                                    <td>Terdapat alarm</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_54_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_54_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_54_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.5</td>
                                                    <td>Terdapat peralatan penanganan evakuasi ( spill kit )</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_55_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_55_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_55_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.6</td>
                                                    <td>Terdapat kotak P3K</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_56_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_56_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_56_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.7</td>
                                                    <td>Alat komunikasi</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_57_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_57_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_57_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.8</td>
                                                    <td>Terdapat lemari / tempat peralatan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_58_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_58_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_58_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>5.9</td>
                                                    <td>Terdapat Pintu darurat</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_59_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->fasilitas_59_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->fasilitas_59_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>VI</td>
                                                    <td colspan="4">Administrasi</td>
                                                </tr>

                                                <tr>
                                                    <td>6.1</td>
                                                    <td>Terdapat Lemari Log Book</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_61_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_61_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->administrasi_61_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>6.2</td>
                                                    <td>Terdapat Form saldo limbah B3 diisi dan update</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_62_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_62_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->administrasi_62_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>6.4</td>
                                                    <td>Terdapat salinan Izin TPS</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_64_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_64_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->administrasi_64_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>6.5</td>
                                                    <td>Check List Inspeksi TPS</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_65_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->administrasi_65_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->administrasi_65_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>VII</td>
                                                    <td colspan="4">Bak Penampung</td>
                                                </tr>

                                                <tr>
                                                    <td>7.1</td>
                                                    <td>Dalam keadaan baik</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_71_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_71_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bak_71_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>7.2</td>
                                                    <td>Bak penampung tidak ada sekat dan harus dalam keadaan kering</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_72_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_72_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bak_72_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>7.3</td>
                                                    <td>Tutup terbuat dari bahan yang kuat dan terpasang rapi</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_73_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_73_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bak_73_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>7.4</td>
                                                    <td>Tidak terdapat outlet</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_74_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_74_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bak_74_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>7.5</td>
                                                    <td>Terdapat papan informasi berisi SOP dan Form Inspeksi Harian</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_75_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->bak_75_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->bak_75_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>VIII</td>
                                                    <td colspan="4">House Keeping</td>
                                                </tr>

                                                <tr>
                                                    <td>8.1</td>
                                                    <td>Halaman bersih</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_81_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_81_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->house_81_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>8.2</td>
                                                    <td>Tidak ada bercak pada dinding</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_82_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_82_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->house_82_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>8.3</td>
                                                    <td>Ceceran pada lantai</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_83_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_83_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->house_83_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>8.4</td>
                                                    <td>Penyimpanan filter bekas / majun bekas tidak melebihi kapasitas kenasan</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_84_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->house_84_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->house_84_action }}</td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td>IX</td>
                                                    <td colspan="4">Kegiatan Inovasi</td>
                                                </tr>

                                                <tr>
                                                    <td>9.1</td>
                                                    <td>Melakukan reduce volume limbah B3</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kegiatan_91_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kegiatan_91_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kegiatan_91_action }}</td>
                                                </tr>

                                                <tr>
                                                    <td>9.2</td>
                                                    <td>Melakukan re-use limbah B3 ( Berizin )</td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kegiatan_92_check == 'true' ? "✔️" : "" }}
                                                    </td>
                                                    <td style="text-align:center;">
                                                        {{ $tps->kegiatan_92_check == 'false' ? "✔️" : "" }}
                                                    </td>
                                                    <td>{{ $tps->kegiatan_92_action }}</td>
                                                </tr>

                                            </tbody>


                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $tps->additional_notes }}</p>
                            </div>
                            <div class="row mb-3">
                                @if($foto1 || $foto2)
                                    <div class="photo-grid">
                                        @if($foto1)
                                            <div class="photo-card">
                                                <a href="{{ $foto1 }}" target="_blank">
                                                    <img src="{{ $foto1 }}" alt="Dokumentasi/Evidence 1">
                                                </a>
                                                <div class="photo-meta">Dokumentasi/Evidence 1</div>
                                            </div>
                                        @endif

                                        @if($foto2)
                                            <div class="photo-card">
                                                <a href="{{ $foto2 }}" target="_blank">
                                                    <img src="{{ $foto2 }}" alt="Dokumentasi/Evidence 2">
                                                </a>
                                                <div class="photo-meta">Dokumentasi/Evidence 2</div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="empty-photo">
                                        Tidak ada dokumentasi.
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Dibuat</h6>

                                    @if ($tps->verified_dibuat)
                                        <h5>
                                            <img src="{{ $tps->verified_dibuat }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $tps->nama_dibuat ?? '.......................' }}</h5>

                                    @if ($tps->catatan_verified_dibuat)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $tps->catatan_verified_dibuat }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Diperiksa</h6>

                                    @if ($tps->verified_diperiksa)
                                        <h5>
                                            <img src="{{ $tps->verified_diperiksa }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $tps->nama_diperiksa ?? '.......................' }}</h5>

                                    @if ($tps->catatan_verified_diperiksa)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $tps->catatan_verified_diperiksa }}
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
                                        <a href="{{ route('klkh.loading-point.download', $tps->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $tps->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


