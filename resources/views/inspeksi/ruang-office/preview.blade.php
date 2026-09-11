@include('layout.head', ['title' => 'Inspeksi Tambang - Jalan Tambang'])
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
                                        <h6>FM-SHE-120/00/26/06/12</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">INSPEKSI RUANG OFFICE</h5>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Departemen:</h6>
                                    <h5>{{ $ro->departemen }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Tanggal:</h6>
                                    <h5>{{ Carbon::parse($ro->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($ro->jam_inspeksi)->locale('id')->isoFormat('HH:mm') }}</h5>
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
                                                <td>1</td>
                                                <td colspan="4">Mesin Foto Copy</td>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Berfungsi dengan baik </td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_11_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_11_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Tidak kotor & tidak  berdebu</td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_12_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_12_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Kabel tidak terkelupas</td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_13_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_13_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Stop kontak dan terminal dalam kondisi baik dan aman</td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_14_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->fotocopy_14_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>2</td>
                                                <td colspan="4">Mesin Penghancur kertas</td>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Berfungsi dengan baik </td>
                                                <td style="text-align:center;">{{ $ro->penghancurkertas_21_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->penghancurkertas_21_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.2</td>
                                                <td>Tidak kotor & tidak  berdebu</td>
                                                <td style="text-align:center;">{{ $ro->penghancurkertas_22_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->penghancurkertas_22_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>2.3</td>
                                                <td>Stop kontak dan terminal dalam kondisi baik dan aman</td>
                                                <td style="text-align:center;">{{ $ro->penghancurkertas_23_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->penghancurkertas_23_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            
                                            <tr style="font-weight: bold;">
                                                <td>3</td>
                                                <td colspan="4">AC</td>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Berfungsi dengan baik </td>
                                                <td style="text-align:center;">{{ $ro->ac_31_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->ac_31_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.2</td>
                                                <td>Tidak kotor & tidak  berdebu</td>
                                                <td style="text-align:center;">{{ $ro->ac_32_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->ac_32_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.3</td>
                                                <td>Kartu pemeriksaan dicek secara rutin</td>
                                                <td style="text-align:center;">{{ $ro->ac_33_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->ac_33_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>3.4</td>
                                                <td>Kabel tidak terkelupas</td>
                                                <td style="text-align:center;">{{ $ro->ac_34_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->ac_34_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>4</td>
                                                <td colspan="4">Lampu Penerangan</td>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Reflektor terpasang dengan kuat</td>
                                                <td style="text-align:center;">{{ $ro->lampupenerangan_41_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lampupenerangan_41_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Lampu-lampu berfungsi dengan baik</td>
                                                <td style="text-align:center;">{{ $ro->lampupenerangan_42_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lampupenerangan_42_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>5</td>
                                                <td colspan="4">Saklar</td>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Saklar terpasang dengan baik</td>
                                                <td style="text-align:center;">{{ $ro->saklar_51_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->saklar_51_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Ada tanda-tanda On/Off dan keterangan yang diperlukan</td>
                                                <td style="text-align:center;">{{ $ro->saklar_52_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->saklar_52_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>6</td>
                                                <td colspan="4">Instalasi Listrik</td>
                                            </tr>
                                            <tr>
                                                <td>6.1</td>
                                                <td>Stop kontak dan terminal dalam kondisi baik dan aman</td>
                                                <td style="text-align:center;">{{ $ro->instalasilistrik_61_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->instalasilistrik_61_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.2</td>
                                                <td>Kabel-kabel tidak terkelupas</td>
                                                <td style="text-align:center;">{{ $ro->instalasilistrik_62_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->instalasilistrik_62_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.3</td>
                                                <td>Penempatan kabel-kabel harus rapih</td>
                                                <td style="text-align:center;">{{ $ro->instalasilistrik_63_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->instalasilistrik_63_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>7</td>
                                                <td colspan="4">Lantai, Dinding, Langit-langit, Pintu, Jendela & Partisi (pembatas ruangan)</td>
                                            </tr>
                                            <tr>
                                                <td>7.1</td>
                                                <td>Lantai dalam kondisi baik, tidak licin dan pecah-pecah</td>
                                                <td style="text-align:center;">{{ $ro->lantai_71_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lantai_71_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.2</td>
                                                <td>Lantai tidak ada kecoa</td>
                                                <td style="text-align:center;">{{ $ro->lantai_72_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lantai_72_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.3</td>
                                                <td>Dinding bersih dan tidak ada sarang laba-laba</td>
                                                <td style="text-align:center;">{{ $ro->lantai_73_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lantai_73_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.4</td>
                                                <td>Langit-langit tidak bocor dan tidak pecah-pecah</td>
                                                <td style="text-align:center;">{{ $ro->lantai_74_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lantai_74_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.5</td>
                                                <td>Eexhouse fan terpasang dengan kuat dan berfungsi dengan baik</td>
                                                <td style="text-align:center;">{{ $ro->lantai_75_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lantai_75_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.6</td>
                                                <td>Pintu dalam kondisi baik, aman, bersih dan terbuka ke arah luar</td>
                                                <td style="text-align:center;">{{ $ro->lantai_76_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lantai_76_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.7</td>
                                                <td>Partisi pembatas ruangan berfungsi baik, kuat, aman, dan tidak berdebu</td>
                                                <td style="text-align:center;">{{ $ro->lantai_77_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lantai_77_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                             <tr style="font-weight: bold;">
                                                <td>8</td>
                                                <td colspan="4">Lemari File</td>
                                            </tr>
                                            <tr>
                                                <td>8.1</td>
                                                <td>Dalam kondisi baik dan aman</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_81_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_81_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.2</td>
                                                <td>File tersusun rapi sesuai nomor dokumentasi</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_82_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_82_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.3</td>
                                                <td>Tidak kotor & tidak  berdebu</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_83_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_83_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.4</td>
                                                <td>Selalu dalam keadaan tertutup</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_84_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_84_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.5</td>
                                                <td>Kaca dalam keadaan baik / tidak pecah</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_85_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_85_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.6</td>
                                                <td>Pintu lemari berfungsi dengan baik</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_86_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->lemarifile_86_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>9</td>
                                                <td colspan="4">Meja, kursi, Papan tulis & Papan informasi</td>
                                            </tr>
                                            <tr>
                                                <td>9.1</td>
                                                <td>Meja dalam kondisi aman dan tidak berdebu</td>
                                                <td style="text-align:center;">{{ $ro->meja_91_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->meja_91_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>9.2</td>
                                                <td>Kursi-kursi tidak patah, kuat, aman dan bersih</td>
                                                <td style="text-align:center;">{{ $ro->meja_92_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->meja_92_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>9.3</td>
                                                <td>Papan tulis terpasang dengan baik, kuat, aman dan bersih</td>
                                                <td style="text-align:center;">{{ $ro->meja_93_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->meja_93_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>9.4</td>
                                                <td>Papan informasi terpasang dengan baik, kuat, aman dan bersih</td>
                                                <td style="text-align:center;">{{ $ro->meja_94_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->meja_94_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>

                                            <tr style="font-weight: bold;">
                                                <td>10</td>
                                                <td colspan="4">Komputer, Printer, UPS dan telepon</td>
                                            </tr>
                                            <tr>
                                                <td>10.1</td>
                                                <td>Kabel-kabel tidak terkelupas</td>
                                                <td style="text-align:center;">{{ $ro->komputer_101_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->komputer_101_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>10.2</td>
                                                <td>Penempatan kabel-kabel harus rapih</td>
                                                <td style="text-align:center;">{{ $ro->komputer_102_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->komputer_102_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>10.3</td>
                                                <td>Komputer diletakkan pada posisi yang aman dan tidak berdebu</td>
                                                <td style="text-align:center;">{{ $ro->komputer_103_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->komputer_103_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>10.4</td>
                                                <td>Printer diletakkan pada posisi yang aman dan tidak berdebu</td>
                                                <td style="text-align:center;">{{ $ro->komputer_104_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->komputer_104_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>10.5</td>
                                                <td>Telepon diletakkan pada posisi yang aman dan tidak berdebu</td>
                                                <td style="text-align:center;">{{ $ro->komputer_105_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->komputer_105_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                            <tr>
                                                <td>10.6</td>
                                                <td>UPS diletakkan pada posisi yang aman dan tidak berdebu</td>
                                                <td style="text-align:center;">{{ $ro->komputer_106_check == 'true' ? "✔️" : "" }}</td>
                                                <td style="text-align:center;">{{ $ro->komputer_106_check == 'false' ? "✔️" : "" }}</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $ro->additional_notes }}</p>
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
                                                <th>Tertanda</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $ro->nama_inspektor1 }}</td>
                                                <td>{{ $ro->nik_inspektor1 }}</td>
                                                <td>{{ $ro->jabatan_inspektor1 }}</td>
                                                <td><img src="{{ $ro->verified_inspektor1 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>{{ $ro->nama_inspektor2 }}</td>
                                                <td>{{ $ro->nik_inspektor2 }}</td>
                                                <td>{{ $ro->jabatan_inspektor2 }}</td>
                                                <td><img src="{{ $ro->verified_inspektor2 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>{{ $ro->nama_inspektor3 }}</td>
                                                <td>{{ $ro->nik_inspektor3 }}</td>
                                                <td>{{ $ro->jabatan_inspektor3 }}</td>
                                                <td><img src="{{ $ro->verified_inspektor3 }}" style="max-width: 70px;"></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>{{ $ro->nama_inspektor4 }}</td>
                                                <td>{{ $ro->nik_inspektor4 }}</td>
                                                <td>{{ $ro->jabatan_inspektor4 }}</td>
                                                <td><img src="{{ $ro->verified_inspektor4 }}" style="max-width: 70px;"></td>
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
                                        <a href="javascript:void(0)"
                                        onclick="window.history.back()"
                                        class="btn btn-light border rounded-pill px-3 py-2 shadow-sm d-flex align-items-center gap-2">
                                            <i class="ti ti-arrow-left"></i>
                                            <span>Kembali</span>
                                        </a>
                                    </li>

                                    {{-- <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.download', $ro->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $ro->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


