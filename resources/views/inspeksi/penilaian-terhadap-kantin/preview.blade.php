@include('layout.head', ['title' => 'ELEMENT PENILAIAN TERHADAP KANTIN'])
@include('layout.sidebar')
@include('layout.header')
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $report = $kantin;

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
                                        <h6>FM-SHE-59/00/16/10/10</h6>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align: center;">ELEMENT PENILAIAN TERHADAP KANTIN</h5>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Lokasi:</h6>
                                    <h5>{{ $kantin->lokasi }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">Pukul:</h6>
                                    <h5>{{ Carbon::parse($kantin->tanggal_inspeksi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }} {{ Carbon::parse($kantin->jam_inspeksi)->locale('id')->isoFormat('HH:mm') }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6 class="mb-0">PIC:</h6>
                                    <h5>{{ $kantin->nik_pic }} | {{ $kantin->pic }}</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm mb-0" style="width:100%; border-collapse:collapse;">
                                        <thead>
                                            <tr>
                                                <th colspan="6" style="text-align:left; font-weight:bold;">ELEMENT PENILAIAN TERHADAP KANTIN</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th style="width:5%;">NO</th>
                                                <th style="width:25%;">YANG DIPERIKSA</th>
                                                <th style="width:3%;"></th>
                                                <th style="width:55%;">STANDARD</th>
                                                <th style="width:6%;">YA</th>
                                                <th style="width:6%;">TIDAK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td class="text-center">A</td>
                                                <td colspan="5">BANGUNAN/ SARANA.</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">1</td>
                                                <td class="align-middle">Atap plafond</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Kokoh, tidak bocor.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_11_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_11_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">2</td>
                                                <td class="align-middle">Talang Air</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Terpasang dengan baik, tidak tersumbat, tidak bocor, mengalir ke selokan air.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_12_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_12_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">3</td>
                                                <td class="align-middle">Lantai</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Konkreat, lebih tinggi dari pekarangan, air dari pekarangan tidak masuk ke bagian dalam bangunan.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_13_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_13_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">4</td>
                                                <td class="align-middle">Drainase/ saluran air</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tidak tergenang air; Tanah dan Sampah, tidak terakumulasi pada badan saluran.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_14_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_14_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" class="text-center align-middle">5</td>
                                                <td rowspan="2" class="align-middle">Pekarangan atau tempat parkir.</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Rata, tidak becek, tidak berair.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_15_1_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_15_1_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Kendaraan parkir pada lokasi parkir sekitar bangunan.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_15_2_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_15_2_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="4" class="text-center align-middle">6</td>
                                                <td rowspan="4" class="align-middle">Tabung Gas untuk kompor</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Selalu dalam posisi Tegak dan tidak mudah terguling atau jatuh.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_1_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_1_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Gunakan pengikat/kerangkeng saat disimpan agar tidak terguling.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_2_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_2_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Gunakan trolley (kereta dorong) untuk memindahkan tabung yang besar.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_3_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_3_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Beri label atau keterangan pada tabung &quot;ISI&quot; atau &quot;KOSONG&quot;.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_4_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_16_4_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">7</td>
                                                <td class="align-middle">Lampu penerangan</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia lampu penerangan yang memadai untuk dapat bekerja malam.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_17_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_17_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="4" class="text-center align-middle">8</td>
                                                <td rowspan="4" class="align-middle">Electric Tool</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Kabel listrik tidak terkelupas.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_1_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_1_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Kabel listrik dari bahan berkualitas baik.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_2_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_2_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Kabel listrik terpasang dengan baik.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_3_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_3_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Colokan Sambungan ke sumber listrik berfungsi dengan baik.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_4_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_18_4_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">9</td>
                                                <td class="align-middle">Tong /Tempat Sampah</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia tong sampah berwarna hijau &amp; kuning. Sampah dimasukkan ke dalam tong, dikelompokkan berdasarkan jenisnya.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_19_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_19_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">10</td>
                                                <td class="align-middle">APAR/ Pemadam Api</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Diletakkan pada lokasi tertentu agar mudah dijangkau dan mudah diperiksa kondisinya.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_110_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_110_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">11</td>
                                                <td class="align-middle">Cat / Painting</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Warna Cerah (Putih).</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_111_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_111_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">12</td>
                                                <td class="align-middle">Kitchen sheet/ wastafel</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia kitchen sheet untuk alat makan, minum dan masak.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_112_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_112_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">13</td>
                                                <td class="align-middle">Kran Air wastafel</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia, berfungsi, ada sabun.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_113_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_113_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">14</td>
                                                <td class="align-middle">Hand dryer</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia, berfungsi.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_114_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->bangunan_114_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr style="font-weight:bold;">
                                                <td class="text-center">B</td>
                                                <td colspan="5">PAPAN PENGUMUMAN DAN ATURAN.</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">1</td>
                                                <td class="align-middle">Dilarang Merokok</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Ukuran, Gambar dan Warna harus Standard.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->papan_21_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->papan_21_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">2</td>
                                                <td class="align-middle">Dilarang menggunakan sepatu di dalam ruang</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Papan larangan jelas terlihat.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->papan_22_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->papan_22_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">3</td>
                                                <td class="align-middle">Nama ruangan/ bilik</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Terpasang dengan baik dan tidak kotor.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->papan_23_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->papan_23_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr style="font-weight:bold;">
                                                <td class="text-center">C</td>
                                                <td colspan="5">ADMINISTRASI</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" class="text-center align-middle">1</td>
                                                <td rowspan="2" class="align-middle">Kotak/Lemari</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Lemari kecil tempat menyimpan; Makanan, Minuman.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_31_1_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_31_1_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia kulkas untuk mendinginkan; Makanan, Minuman.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_31_2_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_31_2_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">2</td>
                                                <td class="align-middle">Daftar Menu</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia daftar menu yang tersedia.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_32_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_32_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">3</td>
                                                <td class="align-middle">Nota Pesanan</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia nota pesanan untuk tamu.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_33_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->administrasi_33_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr style="font-weight:bold;">
                                                <td class="text-center">D</td>
                                                <td colspan="5">HOUSE KEEPING</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">1</td>
                                                <td class="align-middle">Pekarangan.</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Bersih / bebas dari sampah.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_41_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_41_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">2</td>
                                                <td class="align-middle">Dinding Bangunan.</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Rapi, tidak ada bercak oli pada dinding bangunan, greese.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_42_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_42_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">3</td>
                                                <td class="align-middle">Saluran</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Bebas dari akumulasi tanah, sampah, tumbuhan rumput.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_43_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_43_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">4</td>
                                                <td class="align-middle">Peralatan dapur</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Ditata dengan rapi, tidak berserakan.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_44_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_44_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">5</td>
                                                <td class="align-middle">Peralatan makan</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Ditata dengan rapi, tidak berserakan.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_45_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_45_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">6</td>
                                                <td class="align-middle">Meja dan kursi</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Meja dan kursi di ruang makan tertata rapi.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_46_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_46_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">7</td>
                                                <td class="align-middle">Lantai Bangunan</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Bersih / bebas dari debu dan tumpahan makanan atau minuman.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_47_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->house_47_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                            <tr style="font-weight:bold;">
                                                <td class="text-center">E</td>
                                                <td colspan="5">ALAT ANGKUT</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center align-middle">1</td>
                                                <td class="align-middle">Trolley</td>
                                                <td class="text-center align-middle">*</td>
                                                <td>Tersedia untuk pelayanan ke meja makan.</td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->alat_51_check == 'true' ? "✔️" : "" }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{ $kantin->alat_51_check == 'false' ? "✔️" : "" }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="text-start">
                                    <hr class="mb-2 mt-1 border-secondary border-opacity-50">
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Catatan:</label>
                                <p class="mb-0">{{ $kantin->additional_notes }}</p>
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
                                    <h6>Disiapkan</h6>

                                    @if ($kantin->verified_disiapkan)
                                        <h5>
                                            <img src="{{ $kantin->verified_disiapkan }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $kantin->nama_disiapkan ?? '.......................' }}</h5>

                                    @if ($kantin->catatan_verified_disiapkan)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $kantin->catatan_verified_disiapkan }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Diperiksa</h6>

                                    @if ($kantin->verified_diperiksa)
                                        <h5>
                                            <img src="{{ $kantin->verified_diperiksa }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $kantin->nama_diperiksa ?? '.......................' }}</h5>

                                    @if ($kantin->catatan_verified_diperiksa)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $kantin->catatan_verified_diperiksa }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded p-3">
                                    <h6>Diketahui</h6>

                                    @if ($kantin->verified_diketahui)
                                        <h5>
                                            <img src="{{ $kantin->verified_diketahui }}" style="max-width: 70px;">
                                        </h5>
                                    @endif

                                    <h5>{{ $kantin->nama_diketahui ?? '.......................' }}</h5>

                                    @if ($kantin->catatan_verified_diketahui)
                                        <p>
                                            <img src="{{ asset('dashboard/assets/images/widget/writing.png') }}" alt="">
                                            : {{ $kantin->catatan_verified_diketahui }}
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
                                        <a href="{{ route('klkh.loading-point.download', $kantin->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
                                            <i class="ph-duotone ph-download-simple f-22"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item align-bottom me-2">
                                        <a href="{{ route('klkh.loading-point.cetak', $kantin->uuid) }}" target="_blank" class="avtar avtar-s btn-link-secondary">
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


