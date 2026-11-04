@include('layout.head', ['title' => 'KLKH PEKERJAAN GENERAL'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $report = $ab;

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
                                <div class="row align-items-center">

                                    <div class="col-6">
                                        <img src="{{ asset('dashboard/assets') }}/images/logo-full.png"
                                            class="img-fluid"
                                            alt="images"
                                            style="max-width:160px;">
                                    </div>

                                    <div class="col-6 text-end">
                                        <h6 class="mb-0">FM-ENG-PC-06/00/16/10/23</h6>
                                    </div>

                                </div>
                            </div>
                            <h5 style="text-align: center;">KELAYAKAN LINGKUNGAN KERJA HARIAN PEKERJAAN GENERAL</h5>
                            <div class="col-sm-2">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $ab->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Departemen:</h6>
                                    <h5>{{ $ab->nama_departemen }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Shift:</h6>
                                    <h5>{{ $ab->nama_shift }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Hari/ Waktu:</h6>
                                    <h5>{{ Carbon::parse($ab->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($ab->time)->locale('id')->isoFormat('HH:mm') }}</h5>
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
                                                <th colspan="6">A. PERBAIKAN JALAN & TANGGUL</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Terdapat pengawas pada area kerja</td>
                                                <td>{{ $ab->perbaikan_jalan_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Tersedia alat komunikasi Radio</td>
                                                <td>{{ $ab->perbaikan_jalan_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Terdapat rambu pekerjaan</td>
                                                <td>{{ $ab->perbaikan_jalan_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Terdapat JSA pekerjaan perbaikan jalan & tanggul</td>
                                                <td>{{ $ab->perbaikan_jalan_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Terdapat form KKH operator dengan minimal istirahat 6 jam</td>
                                                <td>{{ $ab->perbaikan_jalan_5_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_5_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_5_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_5_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Terdapat APD lengkap</td>
                                                <td>{{ $ab->perbaikan_jalan_6_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_6_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_6_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_6_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Telah dilakukan P2H alat maintenance</td>
                                                <td>{{ $ab->perbaikan_jalan_7_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_7_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_7_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_7_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Apakah lalu lintas akses jalan area kerja crowded?</td>
                                                <td>{{ $ab->perbaikan_jalan_8_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_8_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_8_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_8_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Lebar jalan sesuai standar 3,5 kali lebar unit terbesar</td>
                                                <td>{{ $ab->perbaikan_jalan_9_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_9_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_9_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_9_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Terbentuk superelevasi pada tikungan jalan</td>
                                                <td>{{ $ab->perbaikan_jalan_10_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_10_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_10_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_10_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Terbentuk crossfall pada badan jalan minimal 2%</td>
                                                <td>{{ $ab->perbaikan_jalan_11_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_11_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_11_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_11_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Dimensi tanggul jalan 3/4 dari diameter ban unit terbesar</td>
                                                <td>{{ $ab->perbaikan_jalan_12_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_12_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_12_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_12_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>13</td>
                                                <td>Apakah terdapat unit support pengendalian debu (Water Truck)?</td>
                                                <td>{{ $ab->perbaikan_jalan_13_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_13_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_13_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_13_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>Apakah terdapat lampu penerangan area kerja?</td>
                                                <td>{{ $ab->perbaikan_jalan_14_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_14_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_14_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_jalan_14_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">B. PERBAIKAN LERENG TAMBANG</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Terdapat pengawas pada area kerja</td>
                                                <td>{{ $ab->perbaikan_lereng_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Terdapat form KKH operator dengan minimal istirahat 6 jam</td>
                                                <td>{{ $ab->perbaikan_lereng_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Terdapat APD lengkap</td>
                                                <td>{{ $ab->perbaikan_lereng_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Tersedia alat komunikasi Radio</td>
                                                <td>{{ $ab->perbaikan_lereng_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Telah dilakukan P2H alat maintenance</td>
                                                <td>{{ $ab->perbaikan_lereng_5_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_5_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_5_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_5_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Terdapat patok acuan pada area rencana kerja</td>
                                                <td>{{ $ab->perbaikan_lereng_6_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_6_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_6_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_6_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Pad excavator stabil dan lebarnya memadai</td>
                                                <td>{{ $ab->perbaikan_lereng_7_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_7_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_7_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_7_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Terdapat potensi rock fall</td>
                                                <td>{{ $ab->perbaikan_lereng_8_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_8_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_8_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_8_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Terdapat crack pada lereng tambang</td>
                                                <td>{{ $ab->perbaikan_lereng_9_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_9_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_9_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->perbaikan_lereng_9_note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $ab->additional_notes }}</p>
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
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Inspektor</h6>

                                    @if ($ab->verified_pengawas)
                                        <h5>
                                            <img src="{{ $ab->verified_pengawas }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $ab->nama_pengawas ?? '.......................' }}</h5>

                                    @if ($ab->catatan_verified_pengawas)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $ab->catatan_verified_pengawas }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Supervisor</h6>

                                    @if ($ab->verified_diketahui)
                                        <h5>
                                            <img src="{{ $ab->verified_diketahui }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $ab->nama_diketahui ?? '.......................' }}</h5>

                                    @if ($ab->catatan_verified_diketahui)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $ab->catatan_verified_diketahui }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Manager</h6>

                                    @if ($ab->verified_disetujui)
                                        <h5>
                                            <img src="{{ $ab->verified_disetujui }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $ab->nama_disetujui ?? '.......................' }}</h5>

                                    @if ($ab->catatan_verified_disetujui)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $ab->catatan_verified_disetujui }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                           <div class="card-body p-3">

                                @if(canAccess('klkh.pekerjaangeneral.verified.all'))
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedAll{{ $ab->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Semua</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $ab->pengawas &&
                                    $ab->verified_pengawas == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedPengawas{{ $ab->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Pengawas</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $ab->diketahui &&
                                    $ab->verified_diketahui == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedDiketahui{{ $ab->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Diketahui</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $ab->disetujui &&
                                    $ab->verified_disetujui == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedDisetujui{{ $ab->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Disetujui</span>
                                    </a>
                                @endif

                                @include('klkh.pekerjaan-general.modal.verifiedAll')
                                @include('klkh.pekerjaan-general.modal.verifiedPengawas')
                                @include('klkh.pekerjaan-general.modal.verifiedDiketahui')
                                @include('klkh.pekerjaan-general.modal.verifiedDisetujui')

                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    {{-- <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.pekerjaangeneral.download', $ab->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>
                                    --}}

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.pekerjaangeneral.cetak', $ab->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


