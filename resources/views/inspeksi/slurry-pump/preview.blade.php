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
                                        <h6>FM-SE-18/00/05/02/26</h6>
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
                                                <td colspan="4">Kondisi area dan Fasilitas Sump</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Apakah kondisi highwall / low wall tidak ada potensi longsoran</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_11_check }}</td>
                                                {{-- <td>{{ $sp->fasilitas_11_check === null ? '' : ($sp->fasilitas_11_check === 'S' ? 'Setuju' : 'Tidak Setuju') }}</td> --}}
                                                <td>{{ $sp->fasilitas_11_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_11_due ? \Carbon\Carbon::parse($sp->fasilitas_11_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Apakah dilokasi terdapat JSA dan IK atau SOP</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_12_check }}</td>
                                                <td>{{ $sp->fasilitas_12_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_12_due ? \Carbon\Carbon::parse($sp->fasilitas_12_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Apakah jalan ke Ponton / rakit dalam kondisi bersih / bebas hambatan</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_13_check }}</td>
                                                {{-- <td>{{ $sp->fasilitas_13_check === null ? '' : ($sp->fasilitas_13_check === 'S' ? 'Setuju' : 'Tidak Setuju') }}</td> --}}
                                                <td>{{ $sp->fasilitas_13_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_13_due ? \Carbon\Carbon::parse($sp->fasilitas_13_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Apakah ada rambu wajib pelampung di area sump yang di pasang pada jarak minimal 5 meter dari tepi kolam?</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_14_check }}</td>
                                                <td>{{ $sp->fasilitas_14_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_14_due ? \Carbon\Carbon::parse($sp->fasilitas_14_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.5</td>
                                                <td>Apakah tersedia rambu dilarang berenang di area sump?</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_15_check }}</td>
                                                {{-- <td>{{ $sp->fasilitas_15_check === null ? '' : ($sp->fasilitas_15_check === 'S' ? 'Setuju' : 'Tidak Setuju') }}</td> --}}
                                                <td>{{ $sp->fasilitas_15_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_15_due ? \Carbon\Carbon::parse($sp->fasilitas_15_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.6</td>
                                                <td>Apakah tersedia pondok pengawas di area sump?</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_16_check }}</td>
                                                <td>{{ $sp->fasilitas_16_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_16_due ? \Carbon\Carbon::parse($sp->fasilitas_16_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.7</td>
                                                <td>Apakah di ringboy tersedia dengan  tali minimal 25 m?</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_17_check }}</td>
                                                {{-- <td>{{ $sp->fasilitas_17_check === null ? '' : ($sp->fasilitas_17_check === 'S' ? 'Setuju' : 'Tidak Setuju') }}</td> --}}
                                                <td>{{ $sp->fasilitas_17_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_17_due ? \Carbon\Carbon::parse($sp->fasilitas_17_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.8</td>
                                                <td>Apakah ringboy ditempatkan pada posisi aman dan mudah di jangkau?</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_18_check }}</td>
                                                <td>{{ $sp->fasilitas_18_action }}</td>
                                                <td style="text-align:center;">{{ $sp->fasilitas_18_due ? \Carbon\Carbon::parse($sp->fasilitas_18_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Kondisi Pompa dan Pontoon</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Apakah ponton dalam kondisi layak dan berfungsi dengan baik?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_21_check }}</td>
                                                <td>{{ $sp->kondisi_21_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_21_due ? \Carbon\Carbon::parse($sp->kondisi_21_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Apakah pagar pengaman tersedia?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_22_check }}</td>
                                                <td>{{ $sp->kondisi_22_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_22_due ? \Carbon\Carbon::parse($sp->kondisi_22_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Apakah tersedia High Boy / Ring Boy dengan tali minimal 25 m?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_23_check }}</td>
                                                <td>{{ $sp->kondisi_23_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_23_due ? \Carbon\Carbon::parse($sp->kondisi_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Apakah tersedia pelampung / Life jacket dengan kondisi baik?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_24_check }}</td>
                                                <td>{{ $sp->kondisi_24_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_24_due ? \Carbon\Carbon::parse($sp->kondisi_24_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Apakah APAR tersedia dengan kondisi baik?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_25_check }}</td>
                                                <td>{{ $sp->kondisi_25_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_25_due ? \Carbon\Carbon::parse($sp->kondisi_25_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.6</td>
                                                <td>Apakah pompa mengambang secara mendatar & tidak miring pada satu sisi?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_26_check }}</td>
                                                <td>{{ $sp->kondisi_26_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_26_due ? \Carbon\Carbon::parse($sp->kondisi_26_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.7</td>
                                                <td>Apakah lampu kerja tersedia?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_27_check }}</td>
                                                <td>{{ $sp->kondisi_27_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_27_due ? \Carbon\Carbon::parse($sp->kondisi_27_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.8</td>
                                                <td>Apakah tersedia check list P2H pompa?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_28_check }}</td>
                                                <td>{{ $sp->kondisi_28_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_28_due ? \Carbon\Carbon::parse($sp->kondisi_28_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.9</td>
                                                <td>Apakah semua pipa dan selang aman?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_29_check }}</td>
                                                <td>{{ $sp->kondisi_29_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_29_due ? \Carbon\Carbon::parse($sp->kondisi_29_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.10</td>
                                                <td>Apakah terdapat rambu pada jalan yang dilintasi pipa?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_210_check }}</td>
                                                <td>{{ $sp->kondisi_210_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_210_due ? \Carbon\Carbon::parse($sp->kondisi_210_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.11</td>
                                                <td>Apakah terdapat kebocoran fuel / oli?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_212_check }}</td>
                                                <td>{{ $sp->kondisi_212_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_212_due ? \Carbon\Carbon::parse($sp->kondisi_212_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.12</td>
                                                <td>Apakah outlet bebas dari penghalang?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_212_check }}</td>
                                                <td>{{ $sp->kondisi_212_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_212_due ? \Carbon\Carbon::parse($sp->kondisi_212_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.13</td>
                                                <td>Apakah ada lampu rotary  di pompa dan berfungsi dengan baik?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_23_check }}</td>
                                                <td>{{ $sp->kondisi_23_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_23_due ? \Carbon\Carbon::parse($sp->kondisi_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.14</td>
                                                <td>Apakah tersedia swith emergency di pompa?</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_214_check }}</td>
                                                <td>{{ $sp->kondisi_214_action }}</td>
                                                <td style="text-align:center;">{{ $sp->kondisi_214_due ? \Carbon\Carbon::parse($sp->kondisi_214_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>


                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">Perahu Penyeberangan</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Apakah tersedia perahu penyeberangan yang baik & layak menuju ponton?</td>
                                                <td style="text-align:center;">{{ $sp->perahu_31_check }}</td>
                                                <td>{{ $sp->perahu_31_action }}</td>
                                                <td style="text-align:center;">{{ $sp->perahu_31_due ? \Carbon\Carbon::parse($sp->perahu_31_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Apakah ada rambu batas maksimal muatan perahu penyeberangan?</td>
                                                <td style="text-align:center;">{{ $sp->perahu_32_check }}</td>
                                                <td>{{ $sp->perahu_32_action }}</td>
                                                <td style="text-align:center;">{{ $sp->perahu_32_due ? \Carbon\Carbon::parse($sp->perahu_32_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Apakah tersedia dayung di perahu penyebrangan?</td>
                                                <td style="text-align:center;">{{ $sp->perahu_33_check }}</td>
                                                <td>{{ $sp->perahu_33_action }}</td>
                                                <td style="text-align:center;">{{ $sp->perahu_33_due ? \Carbon\Carbon::parse($sp->perahu_33_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Apakah tali untuk perahu penyebrangan kondisi layak?</td>
                                                <td style="text-align:center;">{{ $sp->perahu_34_check }}</td>
                                                <td>{{ $sp->perahu_34_action }}</td>
                                                <td style="text-align:center;">{{ $sp->perahu_34_due ? \Carbon\Carbon::parse($sp->perahu_34_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Pengawasan dan Personil</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Pengawas melakukan inspeksi awal shift</td>
                                                <td style="text-align:center;">{{ $sp->pengawas_41_check }}</td>
                                                <td>{{ $sp->pengawas_41_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pengawas_41_due ? \Carbon\Carbon::parse($sp->pengawas_41_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Pengawas dilengkapi dengan radio tangan</td>
                                                <td style="text-align:center;">{{ $sp->pengawas_42_check }}</td>
                                                <td>{{ $sp->pengawas_42_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pengawas_42_due ? \Carbon\Carbon::parse($sp->pengawas_42_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Personil minimal 2 orang yang bekerja di pontoon dan dilengkapi radio tangan</td>
                                                <td style="text-align:center;">{{ $sp->pengawas_43_check }}</td>
                                                <td>{{ $sp->pengawas_43_action }}</td>
                                                <td style="text-align:center;">{{ $sp->pengawas_43_due ? \Carbon\Carbon::parse($sp->pengawas_43_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
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
                                                <td>{{ $sp->jabatan_inspektor1 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $sp->nama_inspektor2 }}</td>
                                                <td>{{ $sp->nik_inspektor2 }}</td>
                                                <td>{{ $sp->jabatan_inspektor2 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $sp->nama_inspektor3 }}</td>
                                                <td>{{ $sp->nik_inspektor3 }}</td>
                                                <td>{{ $sp->jabatan_inspektor3 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $sp->nama_inspektor4 }}</td>
                                                <td>{{ $sp->nik_inspektor4 }}</td>
                                                <td>{{ $sp->jabatan_inspektor4 }}</td>
                                                <td><img src="{{ $sp->verified_inspektor4 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>{{ $sp->nama_inspektor5 }}</td>
                                                <td>{{ $sp->nik_inspektor5 }}</td>
                                                <td>{{ $sp->jabatan_inspektor5 }}</td>
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


