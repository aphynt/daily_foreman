@include('layout.head', ['title' => 'KLKH Disposal'])
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
                                <div class="row align-items-center">

                                    <div class="col-6">
                                        <img src="{{ asset('dashboard/assets') }}/images/logo-full.png"
                                            class="img-fluid"
                                            alt="images"
                                            style="max-width:160px;">
                                    </div>

                                    <div class="col-6 text-end">
                                        <h6 class="mb-0">FM-PRD-52/01/18/10/22</h6>
                                    </div>

                                </div>
                            </div>
                            <h5 style="text-align: center;">Pemeriksaan Kesiapan Kerja Harian & Kelayakan Lingkungan Kerja Harian (KLKH) Departemen Produksi Area Disposal/Dumping Point</h5>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pit:</h6>
                                    <h5>{{ $dp->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Shift:</h6>
                                    <h5>{{ $dp->shift }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Hari/ Tanggal:</h6>
                                    <h5>{{ Carbon::parse($dp->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Jam:</h6>
                                    <h5>{{ Carbon::parse($dp->time)->locale('id')->isoFormat('HH:mm') }}</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Point Yang Diperiksa</th>
                                                <th colspan="3">Cek</th>
                                                <th rowspan="2">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th>Ya</th>
                                                <th>Tidak</th>
                                                <th>N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Lebar dumping point 2x (lebar unit terbesar + turn radius) x N Load</td>
                                                <td>{{ $dp->dumping_point_1 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_1 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_1 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Adanya patok cek elevasi</td>
                                                <td>{{ $dp->dumping_point_2 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_2 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_2 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Tinggi tanggul dumpingan atau dump/bud wall 3/4 tinggi ban unit terbesar</td>
                                                <td>{{ $dp->dumping_point_3 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_3 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_3 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Kondisi permukaan lantai dumping rata dan permukaan tanah tidak lembek dan tidak bergelombang</td>
                                                <td>{{ $dp->dumping_point_4 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_4 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_4 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Tidak ada genangan air di lokasi dumping</td>
                                                <td>{{ $dp->dumping_point_5 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_5 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_5 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_5_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Terdapat unit support bulldozer di lokasi dumping</td>
                                                <td>{{ $dp->dumping_point_6 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_6 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_6 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_6_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Rambu atau papan informasi memadai</td>
                                                <td>{{ $dp->dumping_point_7 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_7 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_7 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_7_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Tersedia lampu penerangan untuk pekerjaan malam hari</td>
                                                <td>{{ $dp->dumping_point_8 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_8 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_8 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_8_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Pengendalian debu sudah dilakukan dengan baik (penyiraman terjadwal dan jumlahnya mencukupi)</td>
                                                <td>{{ $dp->dumping_point_9 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_9 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_9 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_9_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Frame final disposal rapi dan sesuai desain (dimensi slope sesuai dengan standar)</td>
                                                <td>{{ $dp->dumping_point_10 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_10 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_10 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_10_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Terdapat pondok dump man</td>
                                                <td>{{ $dp->dumping_point_11 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_11 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_11 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_11_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Terdapat bendera merah dan hijau untuk penunjuk dumping dan informasi lokasi bahaya untuk dumping</td>
                                                <td>{{ $dp->dumping_point_12 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_12 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_12 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_12_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Housekeeping terjaga (disposal rapi dari tumpukan material yang belum di- spreading)</td>
                                                <td>{{ $dp->dumping_point_13 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_13 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_13 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_13_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Alokasi material di disposal sesuai dengan rencana</td>
                                                <td>{{ $dp->dumping_point_14 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_14 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_14 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_14_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>Operator melakukan metode dumping sesuai dengan prosedur</td>
                                                <td>{{ $dp->dumping_point_15 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_15 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_15 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_15_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Terdapat petugas pemandu HD untuk mundur (Stopper/Pengawas)</td>
                                                <td>{{ $dp->dumping_point_16 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_16 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_16 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_16_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>Petugas memiliki radio komunikasi (HT)</td>
                                                <td>{{ $dp->dumping_point_17 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_17 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_17 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_17_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Terdapat median pemisah ruas jalan akses masuk & keluar area pembuangan</td>
                                                <td>{{ $dp->dumping_point_18 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_18 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_18 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_18_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>19</td>
                                                <td>Tersedia tanggul  (pipa Gorong-gorong) untuk dumping lumpur cair</td>
                                                <td>{{ $dp->dumping_point_19 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_19 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_19 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_19_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Kondisi pasak penahan gorong-gorong kuat tidak goyah</td>
                                                <td>{{ $dp->dumping_point_20 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_20 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_20 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_20_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Kondisi apron masih baik tidak tergerus lumpur cair</td>
                                                <td>{{ $dp->dumping_point_21 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_21 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_21 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_21_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>Material Top Soil di tempatkan khusus dan tidak tercampur material OB</td>
                                                <td>{{ $dp->dumping_point_22 == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_22 == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_22 == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $dp->dumping_point_22_note }}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $dp->additional_notes }}</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Foreman</h6>

                                    @if ($dp->verified_foreman)
                                        <h5>
                                            <img src="{{ $dp->verified_foreman }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $dp->nama_foreman ?? '.......................' }}</h5>

                                    @if ($dp->catatan_verified_foreman)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $dp->catatan_verified_foreman }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Supervisor</h6>

                                    @if ($dp->verified_supervisor)
                                        <h5>
                                            <img src="{{ $dp->verified_supervisor }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $dp->nama_supervisor ?? '.......................' }}</h5>

                                    @if ($dp->catatan_verified_supervisor)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $dp->catatan_verified_supervisor }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Superintendent</h6>

                                    @if ($dp->verified_superintendent)
                                        <h5>
                                            <img src="{{ $dp->verified_superintendent }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $dp->nama_superintendent ?? '.......................' }}</h5>

                                    @if ($dp->catatan_verified_superintendent)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $dp->catatan_verified_superintendent }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body p-3">

                                @if(canAccess('klkh.disposal.verified.all'))
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedAll{{ $dp->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Semua</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $dp->foreman &&
                                    $dp->verified_foreman == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedForeman{{ $dp->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Foreman</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $dp->supervisor &&
                                    $dp->verified_supervisor == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedSupervisor{{ $dp->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Supervisor</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $dp->superintendent &&
                                    $dp->verified_superintendent == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedSuperintendent{{ $dp->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Superintendent</span>
                                    </a>
                                @endif

                                @include('klkh.disposal.modal.verifiedAll')
                                @include('klkh.disposal.modal.verifiedForeman')
                                @include('klkh.disposal.modal.verifiedSupervisor')
                                @include('klkh.disposal.modal.verifiedSuperintendent')


                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            ...
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.disposal.download', $dp->uuid) }}" target="_blank"
                                        class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.disposal.cetak', $dp->uuid) }}" target="_blank"
                                        class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-printer f-22"></i>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            {{-- <div class="col-12 text-end d-print-none">
                                <button class="btn btn-outline-secondary btn-print-invoice">Download</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')


