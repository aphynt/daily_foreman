@include('layout.head', ['title' => 'KLKH Workshop Electric'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $report = $el;

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
                                        <h6 class="mb-0">FM-WS-67/02/17/03/24</h6>
                                    </div>

                                </div>
                            </div>
                            <h5 style="text-align: center;">KELAYAKAN LINGKUNGAN KERJA HARIAN WORKSHOP LV DAN SUPPORT</h5>
                            <div class="col-sm-2">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $el->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Hari/ Waktu:</h6>
                                    <h5>{{ Carbon::parse($el->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($el->time)->locale('id')->isoFormat('HH:mm') }}</h5>
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
                                            <!-- 1. Ruangan dan Fasilitas -->
                                            <tr>
                                                <th colspan="6">Ruangan dan Fasilitas</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Terdapat Rak Arsip (SOP, JSA, Buku Service).</td>
                                                <td>{{ $el->ruangan_fasilitas_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Terdapat ruang tools room yang memadai.</td>
                                                <td>{{ $el->ruangan_fasilitas_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                                                <td>{{ $el->ruangan_fasilitas_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Lampu emergency berfungsi dengan baik.</td>
                                                <td>{{ $el->ruangan_fasilitas_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->ruangan_fasilitas_4_note }}</td>
                                            </tr>
                                            <!-- 2. Lantai Kerja -->
                                            <tr>
                                                <th colspan="6">Lantai Kerja</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Kebersihan lantai dijaga.</td>
                                                <td>{{ $el->lantai_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->lantai_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->lantai_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->lantai_kerja_1_note }}</td>
                                            </tr>
                                            <!-- 3. Peralatan Kerja -->
                                            <tr>
                                                <th colspan="6">Peralatan Kerja</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Ditata dengan rapi, tidak berserakan.</td>
                                                <td>{{ $el->peralatan_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->peralatan_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->peralatan_kerja_1_note }}</td>
                                            </tr>
                                            <!-- 4. Electrical -->
                                            <tr>
                                                <th colspan="6">Electrical</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Kabel tidak terkelupas.</td>
                                                <td>{{ $el->electrical_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Kabel berkualitas baik.</td>
                                                <td>{{ $el->electrical_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                                                <td>{{ $el->electrical_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Energi listrik / mesin-mesin menyala tanpa aktivitas.</td>
                                                <td>{{ $el->electrical_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->electrical_4_note }}</td>
                                            </tr>
                                            <!-- 5. Sistem Loto -->
                                            <tr>
                                                <th colspan="6">Sistem Loto</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dipasang pada saat peralatan mesin diservice.</td>
                                                <td>{{ $el->sistem_loto_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sistem_loto_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sistem_loto_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sistem_loto_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                                                <td>{{ $el->sistem_loto_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sistem_loto_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sistem_loto_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sistem_loto_2_note }}</td>
                                            </tr>
                                            <!-- 6. Sparepart Bekas -->
                                            <tr>
                                                <th colspan="6">Sparepart Bekas (Bisa Dipakai)</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dirapikan dan dikelompokkan.</td>
                                                <td>{{ $el->sparepart_bekas_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sparepart_bekas_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sparepart_bekas_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sparepart_bekas_1_note }}</td>
                                            </tr>
                                            <!-- 7. APAR -->
                                            <tr>
                                                <th colspan="6">APAR</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Jumlahnya memadai.</td>
                                                <td>{{ $el->apar_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mudah dilihat dan dapat dijangkau.</td>
                                                <td>{{ $el->apar_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Tekanan APAR normal.</td>
                                                <td>{{ $el->apar_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Isi APAR normal.</td>
                                                <td>{{ $el->apar_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->apar_4_note }}</td>
                                            </tr>
                                            <!-- 8. Rambu-rambu Bahaya -->
                                            <tr>
                                                <th colspan="6">Rambu-rambu Bahaya</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dilarang menyalakan api / merokok.</td>
                                                <td>{{ $el->rambu_bahaya_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->rambu_bahaya_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->rambu_bahaya_1_note }}</td>
                                            </tr>
                                            <!-- 9. Tempat Sampah Domestik -->
                                            <tr>
                                                <th colspan="6">Tempat Sampah Domestik</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                                                <td>{{ $el->sampah_domestik_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sampah_domestik_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sampah_domestik_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sampah_domestik_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                                                <td>{{ $el->sampah_domestik_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sampah_domestik_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sampah_domestik_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->sampah_domestik_2_note }}</td>
                                            </tr>
                                            <!-- 10. Generator Listrik -->
                                            <tr>
                                                <th colspan="6">Generator Listrik</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Kabel listrik dari bahan berkualitas baik.</td>
                                                <td>{{ $el->generator_listrik_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->generator_listrik_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->generator_listrik_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->generator_listrik_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Stop kontak, saklar, isolasi berfungsi dengan baik.</td>
                                                <td>{{ $el->generator_listrik_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->generator_listrik_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->generator_listrik_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->generator_listrik_2_note }}</td>
                                            </tr>
                                            <!-- 11. Limbah B3 -->
                                            <tr>
                                                <th colspan="6">Limbah B3</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Battery bekas dan accu dikelola dengan baik.</td>
                                                <td>{{ $el->limbah_b3_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $el->limbah_b3_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $el->limbah_b3_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $el->limbah_b3_1_note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $el->additional_notes }}</p>
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
                                    <h6>Inspektor</h6>

                                    @if ($el->verified_pengawas)
                                        <h5>
                                            <img src="{{ $el->verified_pengawas }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $el->nama_pengawas ?? '.......................' }}</h5>

                                    @if ($el->catatan_verified_pengawas)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $el->catatan_verified_pengawas }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Mengetahui</h6>

                                    @if ($el->verified_diketahui)
                                        <h5>
                                            <img src="{{ $el->verified_diketahui }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $el->nama_diketahui ?? '.......................' }}</h5>

                                    @if ($el->catatan_verified_diketahui)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $el->catatan_verified_diketahui }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                           <div class="card-body p-3">

                                @if(canAccess('klkh.workshoplvsupport.verified.all'))
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedAll{{ $el->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Semua</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $el->pengawas &&
                                    $el->verified_pengawas == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedPengawas{{ $el->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Pengawas</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $el->diketahui &&
                                    $el->verified_diketahui == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedDiketahui{{ $el->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Diketahui</span>
                                    </a>
                                @endif

                                @include('klkh.workshop-electric.modal.verifiedAll')
                                @include('klkh.workshop-electric.modal.verifiedPengawas')
                                @include('klkh.workshop-electric.modal.verifiedDiketahui')

                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    {{-- <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.workshopelectric.download', $el->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>
                                    --}}

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.workshopelectric.cetak', $el->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


