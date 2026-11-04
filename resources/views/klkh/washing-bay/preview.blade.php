@include('layout.head', ['title' => 'KLKH WASHING BAY'])
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
                                        <h6 class="mb-0">FM-WS-09/01/12/10/26</h6>
                                    </div>

                                </div>
                            </div>
                            <h5 style="text-align: center;">KELAYAKAN LINGKUNGAN KERJA HARIAN WASHING BAY</h5>
                            <div class="col-sm-2">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $ab->lokasi }}</h5>
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
                                                <th colspan="6">1. Bangunan dan Fasilitas</th>
                                            </tr>
                                            <tr>
                                                <td>1.1</td>
                                                <td>Lantai rata, diconcrete, dan tidak sempit.</td>
                                                <td>{{ $ab->bangunan_fasilitas_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.2</td>
                                                <td>Area pencucian bersih, tidak becek dan tidak berlumpur.</td>
                                                <td>{{ $ab->bangunan_fasilitas_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.3</td>
                                                <td>Akses jalan keluar masuk Room Washing Bay rata dan tidak becek.</td>
                                                <td>{{ $ab->bangunan_fasilitas_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.4</td>
                                                <td>Rata, tidak becek, dan tidak ada ceceran oli.</td>
                                                <td>{{ $ab->bangunan_fasilitas_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.5</td>
                                                <td>Denah evakuasi ditempel dengan jelas.</td>
                                                <td>{{ $ab->bangunan_fasilitas_5_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_5_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_5_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_5_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>1.6</td>
                                                <td>Terdapat toilet, kamar mandi, cuci tangan, eye wash, dan sabun cuci.</td>
                                                <td>{{ $ab->bangunan_fasilitas_6_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_6_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_6_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->bangunan_fasilitas_6_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">2. Tempat Parkiran Kendaraan</th>
                                            </tr>
                                            <tr>
                                                <td>2.1</td>
                                                <td>Rata, tidak becek, dan tidak ada ceceran oli.</td>
                                                <td>{{ $ab->parkiran_kendaraan_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->parkiran_kendaraan_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->parkiran_kendaraan_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->parkiran_kendaraan_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">3. Peralatan Kerja</th>
                                            </tr>
                                            <tr>
                                                <td>3.1</td>
                                                <td>Ditata dengan rapi dan tidak berserakan.</td>
                                                <td>{{ $ab->peralatan_kerja_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->peralatan_kerja_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->peralatan_kerja_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->peralatan_kerja_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">4. Prosedur Lotto</th>
                                            </tr>
                                            <tr>
                                                <td>4.1</td>
                                                <td>Dipasang pada saat pencucian unit sedang berjalan.</td>
                                                <td>{{ $ab->prosedur_lotto_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->prosedur_lotto_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->prosedur_lotto_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->prosedur_lotto_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>4.2</td>
                                                <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                                                <td>{{ $ab->prosedur_lotto_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->prosedur_lotto_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->prosedur_lotto_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->prosedur_lotto_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">5. Rambu-rambu Bahaya</th>
                                            </tr>
                                            <tr>
                                                <td>5.1</td>
                                                <td>Terdapat rambu-rambu jalan masuk/keluar dan wajib stopper bagi kendaraan HD dan A2B yang lain.</td>
                                                <td>{{ $ab->rambu_bahaya_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.2</td>
                                                <td>Instruksi/gambar APD yang harus digunakan.</td>
                                                <td>{{ $ab->rambu_bahaya_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>5.3</td>
                                                <td>Muster point terpasang.</td>
                                                <td>{{ $ab->rambu_bahaya_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->rambu_bahaya_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">6. Lampu Penerangan</th>
                                            </tr>
                                            <tr>
                                                <td>6.1</td>
                                                <td>Lampu terang dan jumlahnya memadai untuk bekerja pada malam hari.</td>
                                                <td>{{ $ab->lampu_penerangan_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->lampu_penerangan_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->lampu_penerangan_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->lampu_penerangan_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>6.2</td>
                                                <td>Lampu emergency berfungsi dengan baik.</td>
                                                <td>{{ $ab->lampu_penerangan_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->lampu_penerangan_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->lampu_penerangan_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->lampu_penerangan_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">7. Electric Pump Washing</th>
                                            </tr>
                                            <tr>
                                                <td>7.1</td>
                                                <td>Kabel tidak terkelupas.</td>
                                                <td>{{ $ab->electric_pump_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.2</td>
                                                <td>Kabel dari bahan berkualitas baik.</td>
                                                <td>{{ $ab->electric_pump_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.3</td>
                                                <td>Stop kontak, saklar, dan isolasi berfungsi dengan baik.</td>
                                                <td>{{ $ab->electric_pump_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>7.4</td>
                                                <td>Energi listrik/mesin-mesin menyala saat beraktivitas.</td>
                                                <td>{{ $ab->electric_pump_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->electric_pump_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">8. Tangki Penampungan Air Washing Bay</th>
                                            </tr>
                                            <tr>
                                                <td>8.1</td>
                                                <td>Kondisi pondasi tangki air rata dan tidak miring.</td>
                                                <td>{{ $ab->tangki_air_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.2</td>
                                                <td>Terdapat tangga standar untuk turun naik.</td>
                                                <td>{{ $ab->tangki_air_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.3</td>
                                                <td>Terdapat pagar pengaman di sekeliling atas tangki air.</td>
                                                <td>{{ $ab->tangki_air_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>8.4</td>
                                                <td>Tidak ada kebocoran pada area tangki air.</td>
                                                <td>{{ $ab->tangki_air_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->tangki_air_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">9. Sistem Loto</th>
                                            </tr>
                                            <tr>
                                                <td>9.1</td>
                                                <td>Dipasang pada saat pencucian unit sedang berjalan.</td>
                                                <td>{{ $ab->sistem_loto_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sistem_loto_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sistem_loto_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sistem_loto_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>9.2</td>
                                                <td>Dipasang pada bagian yang tidak boleh disentuh oleh orang lain.</td>
                                                <td>{{ $ab->sistem_loto_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sistem_loto_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sistem_loto_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sistem_loto_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">10. Selang &amp; Air</th>
                                            </tr>
                                            <tr>
                                                <td>10.1</td>
                                                <td>Berkualitas baik dan tanpa sambungan.</td>
                                                <td>{{ $ab->selang_air_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->selang_air_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->selang_air_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->selang_air_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>10.2</td>
                                                <td>Terdapat larangan menggunakan pressure air ke anggota badan.</td>
                                                <td>{{ $ab->selang_air_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->selang_air_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->selang_air_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->selang_air_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">11. APAR</th>
                                            </tr>
                                            <tr>
                                                <td>11.1</td>
                                                <td>Jumlahnya memadai.</td>
                                                <td>{{ $ab->apar_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>11.2</td>
                                                <td>Mudah dilihat dan dapat dijangkau.</td>
                                                <td>{{ $ab->apar_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>11.3</td>
                                                <td>Tekanan APAR normal.</td>
                                                <td>{{ $ab->apar_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>11.4</td>
                                                <td>Isi APAR normal.</td>
                                                <td>{{ $ab->apar_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->apar_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">12. Room Washing Man</th>
                                            </tr>
                                            <tr>
                                                <td>12.1</td>
                                                <td>Dilarang menyalakan api atau merokok.</td>
                                                <td>{{ $ab->room_washing_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>12.2</td>
                                                <td>Ruangan tertata rapi dan bersih.</td>
                                                <td>{{ $ab->room_washing_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>12.3</td>
                                                <td>Terdapat fasilitas komunikasi radio.</td>
                                                <td>{{ $ab->room_washing_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>12.4</td>
                                                <td>Penerangan ruangan operator memadai.</td>
                                                <td>{{ $ab->room_washing_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->room_washing_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">13. Tempat Sampah Domestik</th>
                                            </tr>
                                            <tr>
                                                <td>13.1</td>
                                                <td>Kelayakan tempat sampah, bertutup dan tidak bocor.</td>
                                                <td>{{ $ab->sampah_domestik_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>13.2</td>
                                                <td>Tempat sampah dikelompokkan sesuai jenisnya dan diberi label.</td>
                                                <td>{{ $ab->sampah_domestik_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>13.3</td>
                                                <td>Sampah dibuang ke tempat pembuangan sampah.</td>
                                                <td>{{ $ab->sampah_domestik_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->sampah_domestik_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">14. Kolam Kompartemen</th>
                                            </tr>
                                            <tr>
                                                <td>14.1</td>
                                                <td>Terdapat sistem pengendapan lumpur pada bak penampung.</td>
                                                <td>{{ $ab->kolam_kompartemen_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_1_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>14.2</td>
                                                <td>Pengurasan lumpur terjadwal.</td>
                                                <td>{{ $ab->kolam_kompartemen_2_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_2_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_2_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_2_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>14.3</td>
                                                <td>Tidak ada air yang keluar dari kompartemen akhir.</td>
                                                <td>{{ $ab->kolam_kompartemen_3_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_3_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_3_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_3_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>14.4</td>
                                                <td>Kompartemen ke-5 tidak mengandung minyak atau oli.</td>
                                                <td>{{ $ab->kolam_kompartemen_4_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_4_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_4_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_4_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>14.5</td>
                                                <td>Penggunaan kembali air pada kompartemen akhir menggunakan pompa.</td>
                                                <td>{{ $ab->kolam_kompartemen_5_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_5_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_5_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_5_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>14.6</td>
                                                <td>Terdapat pagar pengaman sekeliling kolam kompartemen.</td>
                                                <td>{{ $ab->kolam_kompartemen_6_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_6_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_6_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->kolam_kompartemen_6_note }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">15. Limbah B3</th>
                                            </tr>
                                            <tr>
                                                <td>15.1</td>
                                                <td>Limbah oli, limbah solar, dan majun terkontaminasi oli/grease dikelola dengan baik.</td>
                                                <td>{{ $ab->limbah_b3_1_check == 'true' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->limbah_b3_1_check == 'false' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->limbah_b3_1_check == 'n/a' ? '✔️' : '' }}</td>
                                                <td>{{ $ab->limbah_b3_1_note }}</td>
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
                                    <h6>Diperiksa Oleh</h6>

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
                                    <h6>Disetujui Oleh</h6>

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

                                @if(canAccess('klkh.washingbay.verified.all'))
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

                                @include('klkh.washing-bay.modal.verifiedAll')
                                @include('klkh.washing-bay.modal.verifiedPengawas')
                                @include('klkh.washing-bay.modal.verifiedDiketahui')
                                @include('klkh.washing-bay.modal.verifiedDisetujui')

                                <ul class="list-inline ms-auto mb-0 d-flex justify-content-end flex-wrap">

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="#" onclick="window.history.back()" class="avtar avtar-s btn-link-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs><path id="stashArrowReplyDuotone0" fill="currentColor" d="M10.296 6.889L4.833 11.18a.5.5 0 0 0 0 .786l5.463 4.292a.5.5 0 0 0 .801-.482l-.355-1.955c5.016-1.204 7.108 1.494 7.914 3.235c.118.254.614.205.64-.073c.645-7.201-4.082-8.244-8.57-7.567l.371-2.046a.5.5 0 0 0-.8-.482"/></defs><use href="#stashArrowReplyDuotone0" opacity="0.5"/><use href="#stashArrowReplyDuotone0" fill-opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"/><path fill="currentColor" d="m4.833 11.18l-.308-.392zm5.463-4.291l.31.393zm-5.463 5.078l-.308.393zm5.463 4.292l-.309.394zm.801-.482l.492-.09zm-.355-1.955l-.492.09a.5.5 0 0 1 .375-.576zm7.914 3.235l-.453.21zm.64-.073l-.498-.045zm-8.57-7.567l.074.494a.5.5 0 0 1-.567-.583zm.371-2.046l.492.09zm-6.572 3.417l5.462-4.293l.618.787l-5.463 4.292zm0 1.572a1 1 0 0 1 0-1.572l.617.786zm5.462 4.293L4.525 12.36l.617-.786l5.463 4.292zm1.602-.966c.165.906-.878 1.534-1.602.966l.618-.787zm-.355-1.954l.355 1.954l-.984.18l-.355-1.955zm-.609-.397c2.614-.627 4.528-.249 5.908.57c1.367.81 2.148 2.016 2.577 2.941l-.907.42c-.378-.815-1.046-1.829-2.18-2.501c-1.122-.665-2.762-1.034-5.164-.457zm8.485 3.511a.23.23 0 0 0-.114-.116c-.024-.01-.037-.008-.04-.008a.1.1 0 0 0-.058.028a.27.27 0 0 0-.1.188l.996.09c-.044.486-.481.661-.73.688c-.252.027-.676-.049-.861-.45zm-.312.092c.312-3.488-.68-5.332-2.134-6.273c-1.506-.975-3.657-1.087-5.864-.755l-.15-.988c2.282-.344 4.739-.274 6.557.903c1.87 1.211 2.92 3.489 2.587 7.202zm-7.209-9.478l-.372 2.046l-.984-.18l.372-2.045zm-1.602-.966c.724-.568 1.767.06 1.602.966l-.984-.18z"/></svg>
                                        </a>
                                    </li>

                                    {{-- <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.washingbay.download', $ab->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>
                                    --}}

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.washingbay.cetak', $ab->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


