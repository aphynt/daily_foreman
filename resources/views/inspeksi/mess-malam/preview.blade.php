@include('layout.head', ['title' => 'Inspeksi Mess (Malam)'])
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
                                        <h6>FM-SHE-175/01/14/04/21</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">INSPEKSI MESS (MALAM)</h5>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Perusahaan:</h6>
                                    <h5>{{ $mm->perusahaan }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pukul:</h6>
                                    <h5>{{ Carbon::parse($mm->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($mm->jam_inspeksi)->locale('id')->isoFormat('HH:mm') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">PIC:</h6>
                                    <h5>{{ $mm->nik_pic }} | {{ $mm->pic }}</h5>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="font-weight: bold;">
                                                <td>I</td>
                                                <td colspan="4">PEKERJA</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Terdapat pekerja yang belum tidur di sekitar Mess </td>
                                                <td style="text-align:center;">{{ $mm->pekerja_11_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->pekerja_11_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Terdapat pekerja yang berada di dalam kamar tetapi tidak tidur</td>
                                                <td style="text-align:center;">{{ $mm->pekerja_12_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->pekerja_12_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>II</td>
                                                <td colspan="4">FASILITAS</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>TV sudah OFF keseluruhan di sekitar Mess</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_21_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_21_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>TV masih ada yang ON di sekitar Mess/ Kamar</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_22_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_22_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Terdapat TV di ruang khusus untuk nonton bersama</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_23_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_23_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Sekitar bangunan mess kondisi suara cukup tenang untuk istirahat </td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_24_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_24_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Terdapat Petugas Keamanan / Security</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_25_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->fasilitas_25_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>III</td>
                                                <td colspan="4">CAMPAIGN</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Surat Edaran Cukup Istirahat</td>
                                                <td style="text-align:center;">{{ $mm->campaign_31_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->campaign_31_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Safety Awareness Pengelolaan Fatique di Bulan Puasa </td>
                                                <td style="text-align:center;">{{ $mm->campaign_32_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->campaign_32_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Healhty Awareness Asupan Gizi Pekerja</td>
                                                <td style="text-align:center;">{{ $mm->campaign_33_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->campaign_33_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Spanduk Pola Hidup Sehat dan atau Tata Kelola Fatique</td>
                                                <td style="text-align:center;">{{ $mm->campaign_34_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $mm->campaign_34_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    @if($mm->dokumentasi_1)
                                        <div class="col-6 text-center">
                                            <img src="{{ $mm->dokumentasi_1 }}" class="img-thumbnail evidence-thumb">
                                            <a href="{{ $mm->dokumentasi_1 }}" target="_blank"
                                               class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                <i class="fas fa-search"></i> Lihat Foto
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    @if($mm->dokumentasi_2)
                                        <div class="col-6 text-center">
                                            <img src="{{ $mm->dokumentasi_2 }}" class="img-thumbnail evidence-thumb">
                                            <a href="{{ $mm->dokumentasi_2 }}" target="_blank"
                                               class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                <i class="fas fa-search"></i> Lihat Foto
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    @if($mm->dokumentasi_3)
                                        <div class="col-6 text-center">
                                            <img src="{{ $mm->dokumentasi_3 }}" class="img-thumbnail evidence-thumb">
                                            <a href="{{ $mm->dokumentasi_3 }}" target="_blank"
                                               class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                <i class="fas fa-search"></i> Lihat Foto
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $mm->additional_notes }}</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Inspektor</h6>

                                    @if ($mm->verified_inspektor)
                                        <h5>
                                            <img src="{{ $mm->verified_inspektor }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $mm->nama_inspektor ?? '.......................' }}</h5>

                                    @if ($mm->catatan_verified_inspektor)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $mm->catatan_verified_inspektor }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Pendamping</h6>

                                    @if ($mm->verified_pendamping)
                                        <h5>
                                            <img src="{{ $mm->verified_pendamping }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $mm->nama_pendamping ?? '.......................' }}</h5>

                                    @if ($mm->catatan_verified_pendamping)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $mm->catatan_verified_pendamping }}
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
                                        <a href="{{ route('klkh.loading-point.download', $mm->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $mm->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


