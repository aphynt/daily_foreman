@include('layout.head', ['title' => 'KLKH Workshop LV & Support'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $report = $lv;

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
                                    <h5>{{ $lv->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Hari/ Waktu:</h6>
                                    <h5>{{ Carbon::parse($lv->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($lv->time)->locale('id')->isoFormat('HH:mm') }}</h5>
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
                                            <tr><th colspan="6">Bangunan dan Fasilitas</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Struktur bangunan kokoh, Lantai diconcreat dan beratap.</td>
                                                <td>{{ $lv->bangunan_fasilitas_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Tinggi bangunan sesuai dengan kendaraan yang diservice.</td>
                                                <td>{{ $lv->bangunan_fasilitas_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Terdapat Rak sparepart, SOP dan buku service.</td>
                                                <td>{{ $lv->bangunan_fasilitas_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Terdapat rak peralatan kerja.</td>
                                                <td>{{ $lv->bangunan_fasilitas_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Jumlah dan standard ganjal, Loto.</td>
                                                <td>{{ $lv->bangunan_fasilitas_5_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_5_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_5_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_5_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                                                <td>{{ $lv->bangunan_fasilitas_6_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_6_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_6_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_6_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Lampu emergency berfungsi dengan baik.</td>
                                                <td>{{ $lv->bangunan_fasilitas_7_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_7_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_7_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_7_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Denah evakuasi ditempel dengan jelas.</td>
                                                <td>{{ $lv->bangunan_fasilitas_8_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_8_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_8_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_8_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, sabun cuci.</td>
                                                <td>{{ $lv->bangunan_fasilitas_9_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_9_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_9_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bangunan_fasilitas_9_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Lantai Kerja</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Bersih, Tidak ada tanah, Tidak becek.</td>
                                                <td>{{ $lv->lantai_kerja_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->lantai_kerja_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->lantai_kerja_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->lantai_kerja_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Tidak ada ceceran oli.</td>
                                                <td>{{ $lv->lantai_kerja_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->lantai_kerja_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->lantai_kerja_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->lantai_kerja_2_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Peralatan Kerja</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Ditata dengan rapi, Tidak berserakan.</td>
                                                <td>{{ $lv->peralatan_kerja_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->peralatan_kerja_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->peralatan_kerja_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->peralatan_kerja_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Loto</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dipasang pada saat peralatan mesin diservice.</td>
                                                <td>{{ $lv->loto_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->loto_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->loto_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->loto_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                                                <td>{{ $lv->loto_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->loto_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->loto_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->loto_2_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Sparepart Bekas (bisa dipakai)</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dirapikan dan dikelompokkan.</td>
                                                <td>{{ $lv->sparepart_bekas_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sparepart_bekas_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sparepart_bekas_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sparepart_bekas_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Selang Angin</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Berkualitas baik dan tanpa sambungan.</td>
                                                <td>{{ $lv->selang_angin_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->selang_angin_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->selang_angin_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->selang_angin_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Compressor</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Selang angin berkualitas baik, tanpa sambungan.</td>
                                                <td>{{ $lv->compressor_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->compressor_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->compressor_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->compressor_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Electric</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Kabel tidak terkelupas.</td>
                                                <td>{{ $lv->electric_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Kabel berkualitas baik.</td>
                                                <td>{{ $lv->electric_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Colokan / sambungan ke sumber listrik cukup aman.</td>
                                                <td>{{ $lv->electric_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Energi listrik menyala tanpa aktivitas.</td>
                                                <td>{{ $lv->electric_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->electric_4_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Bongkar Mesin / Sparepart</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Memiliki tempat mencuci yang memadai.</td>
                                                <td>{{ $lv->bongkar_mesin_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bongkar_mesin_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bongkar_mesin_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->bongkar_mesin_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">APAR</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Jumlahnya memadai.</td>
                                                <td>{{ $lv->apar_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mudah dilihat dan dapat dijangkau.</td>
                                                <td>{{ $lv->apar_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Tekanan APAR normal.</td>
                                                <td>{{ $lv->apar_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Isi APAR normal.</td>
                                                <td>{{ $lv->apar_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->apar_4_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Rambu-rambu Bahaya</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Dilarang menyalakan api / merokok.</td>
                                                <td>{{ $lv->rambu_bahaya_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Instruksi / gambar APD yang harus digunakan.</td>
                                                <td>{{ $lv->rambu_bahaya_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Larangan penggunaan selang angin sembarangan.</td>
                                                <td>{{ $lv->rambu_bahaya_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->rambu_bahaya_3_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Tempat Parkir Kendaraan</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Rata, tidak becek, tidak ada ceceran oli.</td>
                                                <td>{{ $lv->tempat_parkir_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tempat_parkir_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tempat_parkir_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tempat_parkir_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Besi Scrap</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Ditempatkan minimal 200 meter dari area workshop.</td>
                                                <td>{{ $lv->besi_scrap_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->besi_scrap_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->besi_scrap_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->besi_scrap_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Tempat Sampah Domestik</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                                                <td>{{ $lv->sampah_domestik_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                                                <td>{{ $lv->sampah_domestik_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                                                <td>{{ $lv->sampah_domestik_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->sampah_domestik_3_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Oil Trap</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Volume dan fungsi oil trap terkontrol.</td>
                                                <td>{{ $lv->oil_trap_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Bagian atas ditutup sehingga air hujan tidak masuk.</td>
                                                <td>{{ $lv->oil_trap_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Air hujan tidak masuk ke paret oil trap.</td>
                                                <td>{{ $lv->oil_trap_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Komparment ke-3 tidak mengandung minyak atau oli.</td>
                                                <td>{{ $lv->oil_trap_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->oil_trap_4_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Pemadam Hydran</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Tempat hose air mudah dibuka.</td>
                                                <td>{{ $lv->pemadam_hydran_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Kran air berfungsi dengan baik.</td>
                                                <td>{{ $lv->pemadam_hydran_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Pompa air berfungsi dengan baik.</td>
                                                <td>{{ $lv->pemadam_hydran_3_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_3_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_3_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Kapasitas air memadai.</td>
                                                <td>{{ $lv->pemadam_hydran_4_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_4_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_4_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pemadam_hydran_4_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Limbah B3</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Limbah oli, limbah solar, limbah filter dan majun terkontaminasi oli / grease dikelola dengan baik.</td>
                                                <td>{{ $lv->limbah_b3_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->limbah_b3_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->limbah_b3_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->limbah_b3_1_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">CT 50 Ton / CT 100 Ton / Manitou</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->ct_manutou_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ct_manutou_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ct_manutou_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ct_manutou_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->ct_manutou_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ct_manutou_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ct_manutou_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ct_manutou_2_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">FT / ST / WT</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->ft_st_wt_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ft_st_wt_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ft_st_wt_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ft_st_wt_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->ft_st_wt_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ft_st_wt_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ft_st_wt_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->ft_st_wt_2_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">FORKLIFT</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->forklift_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->forklift_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->forklift_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->forklift_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->forklift_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->forklift_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->forklift_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->forklift_2_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">TYRE HANDLER</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Form P2H diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->tyre_handler_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tyre_handler_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tyre_handler_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tyre_handler_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Form kesiapan kerja diisi dan ditandatangani oleh pengawas.</td>
                                                <td>{{ $lv->tyre_handler_2_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tyre_handler_2_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tyre_handler_2_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->tyre_handler_2_note }}</td>
                                            </tr>
                                            <tr><th colspan="6">Pengguna LV</th></tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Form kesiapan kerja untuk pengguna LV.</td>
                                                <td>{{ $lv->pengguna_lv_1_check == 'true' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pengguna_lv_1_check == 'false' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pengguna_lv_1_check == 'n/a' ? "✔️" : "" }}</td>
                                                <td>{{ $lv->pengguna_lv_1_note }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $lv->additional_notes }}</p>
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

                                    @if ($lv->verified_pengawas)
                                        <h5>
                                            <img src="{{ $lv->verified_pengawas }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $lv->nama_pengawas ?? '.......................' }}</h5>

                                    @if ($lv->catatan_verified_pengawas)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $lv->catatan_verified_pengawas }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded p-3">
                                    <h6>Mengetahui</h6>

                                    @if ($lv->verified_diketahui)
                                        <h5>
                                            <img src="{{ $lv->verified_diketahui }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $lv->nama_diketahui ?? '.......................' }}</h5>

                                    @if ($lv->catatan_verified_diketahui)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $lv->catatan_verified_diketahui }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                           <div class="card-body p-3">

                                @if(canAccess('klkh.workshoplvsupport.verified.all'))
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedAll{{ $lv->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Semua</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $lv->pengawas &&
                                    $lv->verified_pengawas == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedPengawas{{ $lv->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Pengawas</span>
                                    </a>
                                @endif

                                @if(
                                    Auth::user()->nik == $lv->diketahui &&
                                    $lv->verified_diketahui == null
                                )
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#verifiedDiketahui{{ $lv->uuid }}">
                                        <span class="badge bg-success" style="font-size:14px">Verifikasi Diketahui</span>
                                    </a>
                                @endif

                                @include('klkh.workshop-lv-support.modal.verifiedAll')
                                @include('klkh.workshop-lv-support.modal.verifiedPengawas')
                                @include('klkh.workshop-lv-support.modal.verifiedDiketahui')

                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    {{-- <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.workshoplvsupport.download', $lv->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>
                                    --}}

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.workshoplvsupport.cetak', $lv->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


