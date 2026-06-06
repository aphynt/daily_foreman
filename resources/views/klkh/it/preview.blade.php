@include('layout.head', ['title' => 'KLKH DEPARTEMEN GA-IT'])
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
                                        <h6 class="mb-0">FM-IT-09/00/13/05/25</h6>
                                    </div>

                                </div>
                            </div>
                            <h5 style="text-align: center;">KELAYAKAN LINGKUNGAN KERJA HARIAN UNIT DEPARTEMEN GA - IT</h5>
                            <div class="col-sm-2">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pit:</h6>
                                    <h5>{{ $it->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $it->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pekerjaan:</h6>
                                    <h5>{{ $it->pekerjaan }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Hari/ Waktu:</h6>
                                    <h5>{{ Carbon::parse($it->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($it->time)->locale('id')->isoFormat('HH:mm') }}</h5>
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
                                                <th colspan="6">Lokasi Kerja</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Permukaan tanah rata dan tidak berlubang</td>
                                                <td>{{ $it->lokasi_kerja_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Permukaan tanah tidak licin akibat hujan sebelumnya</td>
                                                <td>{{ $it->lokasi_kerja_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Lokasi kerja jauh dengan lintasan aktif angkutan</td>
                                                <td>{{ $it->lokasi_kerja_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Posisi alat berat jauh dari kaki tebing</td>
                                                <td>{{ $it->lokasi_kerja_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Tidak ada batuan menggantung di dinding tebing</td>
                                                <td>{{ $it->lokasi_kerja_5_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_5_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_5_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_5_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Area kerja cukup untuk parkir kendaraan support</td>
                                                <td>{{ $it->lokasi_kerja_6_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_6_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_6_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_6_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Area perbaikan / perawatan unit jauh dari aktifitas peledakan</td>
                                                <td>{{ $it->lokasi_kerja_7_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_7_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_7_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_7_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Tersedia bak sampah dan atau wadah penampung sampah di area kegiatan</td>
                                                <td>{{ $it->lokasi_kerja_8_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_8_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_8_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_8_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Jarak area parkir kendaraan dengan unit 30 M dalam kondisi unit off running dan 50 M kondisi running</td>
                                                <td>{{ $it->lokasi_kerja_9_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_9_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_9_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->lokasi_kerja_9_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">Perlengkapan Kerja</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Tersedia JSA untuk pekerjaan yang akan di lakukan</td>
                                                <td>{{ $it->perlengkapan_kerja_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Terpasang rambu rambu peringatan</td>
                                                <td>{{ $it->perlengkapan_kerja_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Area parkir khusus untuk LV tersedia</td>
                                                <td>{{ $it->perlengkapan_kerja_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Tersedia kotak P3K di tempat kegiatan</td>
                                                <td>{{ $it->perlengkapan_kerja_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->perlengkapan_kerja_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">Kegiatan Pemasangan, Perbaikan dan Perawatan Perangkat FOCUS unit</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Pekerja memiliki Pad Lock</td>
                                                <td>{{ $it->kegiatan_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Pad Lock terpasang pada skitsor unit yang akan di perbaiki</td>
                                                <td>{{ $it->kegiatan_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Pekerja memakai APD standar dan APD tambahan jika di perlukan</td>
                                                <td>{{ $it->kegiatan_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Pekerja Memiliki Tools Kit yang standar</td>
                                                <td>{{ $it->kegiatan_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $it->kegiatan_4_note }}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $it->additional_notes }}</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Pengawas</h6>

                                    @if ($it->verified_pengawas)
                                        <h5>
                                            <img src="{{ $it->verified_pengawas }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $it->nama_pengawas ?? '.......................' }}</h5>

                                    @if ($it->catatan_verified_pengawas)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $it->catatan_verified_pengawas }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Diketahui</h6>

                                    @if ($it->verified_diketahui)
                                        <h5>
                                            <img src="{{ $it->verified_diketahui }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $it->nama_diketahui ?? '.......................' }}</h5>

                                    @if ($it->catatan_verified_diketahui)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $it->catatan_verified_diketahui }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                           <div class="card-body p-3">

                                @if(canAccess('klkh.it.verified.all'))
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedAll{{ $it->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Semua</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $it->pengawas &&
                                    $it->verified_pengawas == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedPengawas{{ $it->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Pengawas</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $it->diketahui &&
                                    $it->verified_diketahui == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedDiketahui{{ $it->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Diketahui</span>
                                    </a>
                                @endif

                                @include('klkh.it.modal.verifiedAll')
                                @include('klkh.it.modal.verifiedPengawas')

                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.it.download', $it->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.it.cetak', $it->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


