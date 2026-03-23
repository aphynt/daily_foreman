@include('layout.head', ['title' => 'Inspeksi Tambang - Front Loading'])
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
                                        <h6>FM-SE-07/00/05/02/26</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">DAFTAR PERIKSA INSPEKSI TAMBANG - FRONT LOADING</h5>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Tanggal:</h6>
                                    <h5>{{ Carbon::parse($fl->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Nama Lokasi:</h6>
                                    <h5>{{ $fl->nama_lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi Pit:</h6>
                                    <h5>{{ $fl->pit }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Penanggung Jawab Area:</h6>
                                    <h5>{{ $fl->nik_penanggungjawab }} | {{ $fl->nama_penanggungjawab }}</h5>
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
                                                <td colspan="4">Apakah dimensi front loading memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Lebar front loading minimal 2x turning radius hauler terbesar di area tersebut</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_11_check }}</td>
                                                {{-- <td>{{ $fl->dimensi_11_check === null ? '' : ($fl->dimensi_11_check === 'S' ? 'Setuju' : 'Tidak Setuju') }}</td> --}}
                                                <td>{{ $fl->dimensi_11_action }}</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_11_due ? \Carbon\Carbon::parse($fl->dimensi_11_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Jalan masuk ke area loading point cukup lebar (3,5 x lebar unit terbesar)</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_12_check }}</td>
                                                <td>{{ $fl->dimensi_12_action }}</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_12_due ? \Carbon\Carbon::parse($fl->dimensi_12_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Jalan masuk dilengkapi dengan tanggul pengaman di sisi kiri & kanan</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_13_check }}</td>
                                                <td>{{ $fl->dimensi_13_action }}</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_13_due ? \Carbon\Carbon::parse($fl->dimensi_13_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Grade jalan maksimal 8%</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_14_check }}</td>
                                                <td>{{ $fl->dimensi_14_action }}</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_14_due ? \Carbon\Carbon::parse($fl->dimensi_14_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.5</td>
                                                <td>Terdapat rambu-rambu jalan yang memadai</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_15_check }}</td>
                                                <td>{{ $fl->dimensi_15_action }}</td>
                                                <td style="text-align:center;">{{ $fl->dimensi_15_due ? \Carbon\Carbon::parse($fl->dimensi_15_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Apakah kondisi fisik front loading memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Tempat dudukan alat gali/muat stabil dan aman</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_21_check }}</td>
                                                <td>{{ $fl->kondisi_21_action }}</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_21_due ? \Carbon\Carbon::parse($fl->kondisi_21_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Tempat dudukan alat gali/muat aman dari longsoran dan jatuhan batu</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_22_check }}</td>
                                                <td>{{ $fl->kondisi_22_action }}</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_22_due ? \Carbon\Carbon::parse($fl->kondisi_22_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Area untuk antrian unit truck cukup lebar dan kondisi aman</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_23_check }}</td>
                                                <td>{{ $fl->kondisi_23_action }}</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_23_due ? \Carbon\Carbon::parse($fl->kondisi_23_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.4</td>
                                                <td>Permukaan loading point rata, tidak undulasi, dibersihkan secara teratur</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_24_check }}</td>
                                                <td>{{ $fl->kondisi_24_action }}</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_24_due ? \Carbon\Carbon::parse($fl->kondisi_24_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.5</td>
                                                <td>Drainase baik, area loading point tidak ada genangan air</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_25_check }}</td>
                                                <td>{{ $fl->kondisi_25_action }}</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_25_due ? \Carbon\Carbon::parse($fl->kondisi_25_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.6</td>
                                                <td>Untuk Top Loading, terdapat tanggul di belakang Ban Belakang Hauler</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_26_check }}</td>
                                                <td>{{ $fl->kondisi_26_action }}</td>
                                                <td style="text-align:center;">{{ $fl->kondisi_26_due ? \Carbon\Carbon::parse($fl->kondisi_26_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">Apakah fasilitas Front Loading memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Tersedia lampu penerangan dengan pencahayaan 20 Lux</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_31_check }}</td>
                                                <td>{{ $fl->fasilitas_31_action }}</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_31_due ? \Carbon\Carbon::parse($fl->fasilitas_31_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Lampu penerangan diberi tanggulan setinggi 1 meter</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_32_check }}</td>
                                                <td>{{ $fl->fasilitas_32_action }}</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_32_due ? \Carbon\Carbon::parse($fl->fasilitas_32_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Kondisi lampu penerangan standard dan tidak ada ceceran bahan bakar</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_33_check }}</td>
                                                <td>{{ $fl->fasilitas_33_action }}</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_33_due ? \Carbon\Carbon::parse($fl->fasilitas_33_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Tersedia tempat parkir LV yang lokasinya aman dari maneuver alat berat</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_34_check }}</td>
                                                <td>{{ $fl->fasilitas_34_action }}</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_34_due ? \Carbon\Carbon::parse($fl->fasilitas_34_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.5</td>
                                                <td>Tempat parkir LV dilengkapi tanggul pengaman</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_35_check }}</td>
                                                <td>{{ $fl->fasilitas_35_action }}</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_35_due ? \Carbon\Carbon::parse($fl->fasilitas_35_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.6</td>
                                                <td>Terdapat rambu parkir untuk LV</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_36_check }}</td>
                                                <td>{{ $fl->fasilitas_36_action }}</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_36_due ? \Carbon\Carbon::parse($fl->fasilitas_36_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.7</td>
                                                <td>Tempat parkir tidak berada di bawah tebing ataupun di bibir tebing</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_37_check }}</td>
                                                <td>{{ $fl->fasilitas_37_action }}</td>
                                                <td style="text-align:center;">{{ $fl->fasilitas_37_due ? \Carbon\Carbon::parse($fl->fasilitas_37_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Apakah pengawas front loading memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Terdapat pengawas yang ditunjuk mengawasi aktivitas loading point</td>
                                                <td style="text-align:center;">{{ $fl->pengawas_41_check }}</td>
                                                <td>{{ $fl->pengawas_41_action }}</td>
                                                <td style="text-align:center;">{{ $fl->pengawas_41_due ? \Carbon\Carbon::parse($fl->pengawas_41_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>1 Pengawas maksimal mengawasi 3 front loading yang berdekatan dalam radius 300 meter antar front</td>
                                                <td style="text-align:center;">{{ $fl->pengawas_42_check }}</td>
                                                <td>{{ $fl->pengawas_42_action }}</td>
                                                <td style="text-align:center;">{{ $fl->pengawas_42_due ? \Carbon\Carbon::parse($fl->pengawas_42_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.3</td>
                                                <td>Pengawas mengisi form pemeriksaan area kerja di awal shift </td>
                                                <td style="text-align:center;">{{ $fl->pengawas_43_check }}</td>
                                                <td>{{ $fl->pengawas_43_action }}</td>
                                                <td style="text-align:center;">{{ $fl->pengawas_43_due ? \Carbon\Carbon::parse($fl->pengawas_43_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.4</td>
                                                <td>Dilengkapi dengan radio komunikasi yang siap digunakan</td>
                                                <td style="text-align:center;">{{ $fl->pengawas_44_check }}</td>
                                                <td>{{ $fl->pengawas_44_action }}</td>
                                                <td style="text-align:center;">{{ $fl->pengawas_44_due ? \Carbon\Carbon::parse($fl->pengawas_44_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr style="font-weight: bold;">
                                                <td>5</td>
                                                <td colspan="4">Apakah manuver truck dan alat berat memadai?</td>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Manuver alat gali/alat muat leluasa untuk mengisi ke truck</td>
                                                <td style="text-align:center;">{{ $fl->manuver_51_check }}</td>
                                                <td>{{ $fl->manuver_51_action }}</td>
                                                <td style="text-align:center;">{{ $fl->manuver_51_due ? \Carbon\Carbon::parse($fl->manuver_51_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Manuver truck searah dengan jarum jam atau sesuai intruksi atasan</td>
                                                <td style="text-align:center;">{{ $fl->manuver_52_check }}</td>
                                                <td>{{ $fl->manuver_52_action }}</td>
                                                <td style="text-align:center;">{{ $fl->manuver_52_due ? \Carbon\Carbon::parse($fl->manuver_52_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.3</td>
                                                <td>Manuver dozer/grader secara berkala membersihkan lantai loading point</td>
                                                <td style="text-align:center;">{{ $fl->manuver_53_check }}</td>
                                                <td>{{ $fl->manuver_53_action }}</td>
                                                <td style="text-align:center;">{{ $fl->manuver_53_due ? \Carbon\Carbon::parse($fl->manuver_53_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.4</td>
                                                <td>Water truck secara berkala menyiram area loading Point</td>
                                                <td style="text-align:center;">{{ $fl->manuver_54_check }}</td>
                                                <td>{{ $fl->manuver_54_action }}</td>
                                                <td style="text-align:center;">{{ $fl->manuver_54_due ? \Carbon\Carbon::parse($fl->manuver_54_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.5</td>
                                                <td>Posisi antrian unit dump truck teratur (searah)</td>
                                                <td style="text-align:center;">{{ $fl->manuver_55_check }}</td>
                                                <td>{{ $fl->manuver_55_action }}</td>
                                                <td style="text-align:center;">{{ $fl->manuver_55_due ? \Carbon\Carbon::parse($fl->manuver_55_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.6</td>
                                                <td>Jarak antri antar dump truck minimal 1.5 kali Panjang unit</td>
                                                <td style="text-align:center;">{{ $fl->manuver_56_check }}</td>
                                                <td>{{ $fl->manuver_56_action }}</td>
                                                <td style="text-align:center;">{{ $fl->manuver_56_due ? \Carbon\Carbon::parse($fl->manuver_56_due)->locale('id')->isoFormat('D MMMM YYYY'): '' }}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $fl->additional_notes }}</p>
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
                                                <td>{{ $fl->nama_inspektor1 }}</td>
                                                <td>{{ $fl->nik_inspektor1 }}</td>
                                                <td></td>
                                                <td><img src="{{ $fl->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $fl->nama_inspektor2 }}</td>
                                                <td>{{ $fl->nik_inspektor2 }}</td>
                                                <td></td>
                                                <td><img src="{{ $fl->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $fl->nama_inspektor3 }}</td>
                                                <td>{{ $fl->nik_inspektor3 }}</td>
                                                <td></td>
                                                <td><img src="{{ $fl->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $fl->nama_inspektor4 }}</td>
                                                <td>{{ $fl->nik_inspektor4 }}</td>
                                                <td></td>
                                                <td><img src="{{ $fl->verified_inspektor4 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>{{ $fl->nama_inspektor5 }}</td>
                                                <td>{{ $fl->nik_inspektor5 }}</td>
                                                <td></td>
                                                <td><img src="{{ $fl->verified_inspektor5 }}" style="max-width: 70px;"></td>
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
                                        <a href="{{ route('klkh.loading-point.download', $fl->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $fl->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


