@include('layout.head', ['title' => 'Preview Observasi BANK'])
@include('layout.sidebar')
@include('layout.header')

@php
    use Illuminate\Support\Str;

    $report = $data['report'] ?? $report;

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

    $foto1 = $imageUrl($report->dokumentasi_foto_1 ?? null);
    $foto2 = $imageUrl($report->dokumentasi_foto_2 ?? null);
    $foto3 = $imageUrl($report->dokumentasi_foto_3 ?? null);
@endphp

<style>
    .table {
        table-layout: fixed;
        width: 100%;
    }

    .table td,
    .table th {
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        vertical-align: middle;
    }

    .preview-input,
    .preview-textarea,
    .preview-select {
        background-color: #f8fafc !important;
        color: #212529 !important;
        border-color: #dee2e6 !important;
        opacity: 1 !important;
        box-shadow: none !important;
    }

    .preview-input[readonly],
    .preview-textarea[readonly],
    .preview-select[disabled] {
        background-color: #f8fafc !important;
        color: #212529 !important;
        border-color: #dee2e6 !important;
        opacity: 1 !important;
        -webkit-text-fill-color: #212529 !important;
        cursor: default;
    }

    .preview-textarea {
        resize: none;
    }

    .note-warning {
        background-color: #fff3cd;
        border-left: 5px solid #9caf88;
        padding: 12px 16px;
        border-radius: 6px;
        font-size: 14px;
        color: #664d03;
    }

    .note-warning p,
    .note-warning strong {
        color: inherit !important;
    }

    input[type="checkbox"].check-readonly {
        -webkit-appearance: none;
        appearance: none;

        width: 16px;
        height: 16px;
        min-width: 16px;
        min-height: 16px;

        margin: 0;
        padding: 0;

        border: 1.5px solid #9ca3af;
        border-radius: 3px;

        background-color: #ffffff;

        display: inline-grid;
        place-content: center;

        vertical-align: middle;

        pointer-events: none;
        cursor: default;

        opacity: 1 !important;
        filter: none !important;

        transition:
            background-color 0.15s ease,
            border-color 0.15s ease;
    }

    /* tanda centang */
    input[type="checkbox"].check-readonly::before {
        content: "";

        width: 5px;
        height: 9px;

        border: solid #ffffff;
        border-width: 0 2px 2px 0;

        transform: rotate(45deg) scale(0);
        transform-origin: center;

        margin-top: -2px;

        transition: transform 0.1s ease;
    }

    /* checkbox tercentang */
    input[type="checkbox"].check-readonly:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    input[type="checkbox"].check-readonly:checked::before {
        transform: rotate(45deg) scale(1);
    }

    /* disabled jangan dibuat transparan oleh browser */
    input[type="checkbox"].check-readonly:disabled {
        opacity: 1 !important;
        filter: none !important;
        cursor: default;
    }

    .table td.text-center input.check-readonly {
        display: inline-grid;
        vertical-align: middle;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .photo-card {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        background: #ffffff;
        overflow: hidden;
    }

    .photo-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        background: #f8fafc;
    }

    .photo-meta {
        padding: 10px 12px;
        font-size: 12px;
        color: #6c757d;
        border-top: 1px solid #dee2e6;
    }

    .empty-photo {
        border: 1px dashed #ced4da;
        border-radius: 10px;
        padding: 24px;
        text-align: center;
        color: #6c757d;
        background: #f8fafc;
    }

    [data-pc-theme="dark"] .preview-input,
    [data-pc-theme="dark"] .preview-textarea,
    [data-pc-theme="dark"] .preview-select,
    [data-bs-theme="dark"] .preview-input,
    [data-bs-theme="dark"] .preview-textarea,
    [data-bs-theme="dark"] .preview-select {
        background-color: #212936 !important;
        color: #e9ecef !important;
        border-color: #3a4553 !important;

        opacity: 1 !important;
        box-shadow: none !important;

        -webkit-text-fill-color: #e9ecef !important;
    }

    [data-pc-theme="dark"] .preview-input[readonly],
    [data-pc-theme="dark"] .preview-textarea[readonly],
    [data-pc-theme="dark"] .preview-select[disabled],
    [data-bs-theme="dark"] .preview-input[readonly],
    [data-bs-theme="dark"] .preview-textarea[readonly],
    [data-bs-theme="dark"] .preview-select[disabled] {
        background-color: #212936 !important;
        color: #e9ecef !important;
        border-color: #3a4553 !important;

        opacity: 1 !important;

        -webkit-text-fill-color: #e9ecef !important;
    }

    /* placeholder dark */
    [data-pc-theme="dark"] .preview-input::placeholder,
    [data-pc-theme="dark"] .preview-textarea::placeholder,
    [data-bs-theme="dark"] .preview-input::placeholder,
    [data-bs-theme="dark"] .preview-textarea::placeholder {
        color: #8c98a5 !important;
        opacity: 1;
    }

    [data-pc-theme="dark"] label:not(.bg-primary),
    [data-bs-theme="dark"] label:not(.bg-primary) {
        color: #e9ecef;
    }

    [data-pc-theme="dark"] h3,
    [data-pc-theme="dark"] h4,
    [data-pc-theme="dark"] h5,
    [data-pc-theme="dark"] h6,
    [data-bs-theme="dark"] h3,
    [data-bs-theme="dark"] h4,
    [data-bs-theme="dark"] h5,
    [data-bs-theme="dark"] h6 {
        color: #f8f9fa;
    }

    [data-pc-theme="dark"] hr,
    [data-bs-theme="dark"] hr {
        border-color: #36404d;
        opacity: 1;
    }

    [data-pc-theme="dark"] .table,
    [data-bs-theme="dark"] .table {
        --bs-table-bg: transparent;
        --bs-table-color: #e9ecef;
        --bs-table-border-color: #3a4553;

        color: #e9ecef;
        border-color: #3a4553;
    }

    [data-pc-theme="dark"] .table > :not(caption) > * > *,
    [data-bs-theme="dark"] .table > :not(caption) > * > * {
        background-color: transparent !important;
        color: #e9ecef !important;
        border-color: #3a4553 !important;
        box-shadow: none !important;
    }

    [data-pc-theme="dark"] .table td,
    [data-pc-theme="dark"] .table th,
    [data-bs-theme="dark"] .table td,
    [data-bs-theme="dark"] .table th {
        color: #e9ecef !important;
        border-color: #3a4553 !important;
    }

    /* Header table */
    [data-pc-theme="dark"] .table-primary,
    [data-pc-theme="dark"] .table-primary > th,
    [data-pc-theme="dark"] .table-primary > td,
    [data-bs-theme="dark"] .table-primary,
    [data-bs-theme="dark"] .table-primary > th,
    [data-bs-theme="dark"] .table-primary > td {
        --bs-table-bg: #263c59;
        --bs-table-color: #ffffff;
        --bs-table-border-color: #3b536f;

        background-color: #263c59 !important;
        color: #ffffff !important;
        border-color: #3b536f !important;
    }

    [data-pc-theme="dark"] input[type="checkbox"].check-readonly,
    [data-bs-theme="dark"] input[type="checkbox"].check-readonly {
        background-color: #18212d !important;
        border-color: #66717f !important;

        opacity: 1 !important;
        filter: none !important;
    }

    /* Sudah dicentang */
    [data-pc-theme="dark"] input[type="checkbox"].check-readonly:checked,
    [data-bs-theme="dark"] input[type="checkbox"].check-readonly:checked {
        background-color: #2684ff !important;
        border-color: #2684ff !important;

        opacity: 1 !important;
        filter: none !important;
    }

    [data-pc-theme="dark"] input[type="checkbox"].check-readonly:checked::before,
    [data-bs-theme="dark"] input[type="checkbox"].check-readonly:checked::before {
        border-color: #ffffff !important;
    }

    [data-pc-theme="dark"] input[type="checkbox"].check-readonly:disabled,
    [data-bs-theme="dark"] input[type="checkbox"].check-readonly:disabled {
        opacity: 1 !important;
        filter: none !important;
    }

    [data-pc-theme="dark"] .note-warning,
    [data-bs-theme="dark"] .note-warning {
        background-color: #332d1b;
        border-left-color: #d4b106;
        color: #ffe69c;
    }

    [data-pc-theme="dark"] .photo-card,
    [data-bs-theme="dark"] .photo-card {
        background: #212936;
        border-color: #3a4553;
    }

    [data-pc-theme="dark"] .photo-card img,
    [data-bs-theme="dark"] .photo-card img {
        background: #18212d;
    }

    [data-pc-theme="dark"] .photo-meta,
    [data-bs-theme="dark"] .photo-meta {
        color: #adb5bd;
        border-color: #3a4553;
    }

    [data-pc-theme="dark"] .empty-photo,
    [data-bs-theme="dark"] .empty-photo {
        background: #212936;
        color: #adb5bd;
        border-color: #495563;
    }

    [data-pc-theme="dark"] input[type="date"].preview-input::-webkit-calendar-picker-indicator,
    [data-pc-theme="dark"] input[type="time"].preview-input::-webkit-calendar-picker-indicator,
    [data-bs-theme="dark"] input[type="date"].preview-input::-webkit-calendar-picker-indicator,
    [data-bs-theme="dark"] input[type="time"].preview-input::-webkit-calendar-picker-indicator {
        filter: invert(1);
        opacity: 0.75;
    }

    @media (max-width: 768px) {
        .photo-grid {
            grid-template-columns: 1fr;
        }

        input[type="checkbox"].check-readonly {
            width: 17px;
            height: 17px;
            min-width: 17px;
            min-height: 17px;
        }
    }
</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Preview Observasi BANK</h3>
                    </div>
                    {{-- <div class="col-sm-12 col-md-6 text-md-end mt-2 mt-md-0">
                        <a href="{{ route('observasibank') }}" class="btn btn-primary btn-sm">Kembali</a>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <div class="row align-items-center g-3 mb-3">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ asset('dashboard/assets') }}/images/logo-full.png"
                                             class="img-fluid"
                                             alt="images"
                                             width="200px">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>Tanggal</label>
                                    <input type="date"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ !empty($report->tanggal) ? date('Y-m-d', strtotime($report->tanggal)) : '' }}"
                                           readonly>
                                </div>

                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>Waktu/Jam</label>
                                    <input type="time"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ !empty($report->jam) ? date('H:i', strtotime($report->jam)) : '' }}"
                                           readonly>
                                </div>

                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>Departemen</label>
                                    <input type="text"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ $report->departemen ?? $report->departemen_id ?? '-' }}"
                                           readonly>
                                </div>

                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>Nama Pekerjaan</label>
                                    <input type="text"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ $report->nama_pekerjaan ?? '-' }}"
                                           readonly>
                                </div>

                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>Referensi</label>
                                    <input type="text"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ $report->referensi ?? '-' }}"
                                           readonly>
                                </div>

                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>No. Referensi</label>
                                    <input type="text"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ $report->no_referensi ?? '-' }}"
                                           readonly>
                                </div>

                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>Lokasi</label>
                                    <input type="text"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ $report->lokasi ?? '-' }}"
                                           readonly>
                                </div>

                                <div class="col-md-6 col-12 px-2 py-2">
                                    <label>Lokasi Lainnya</label>
                                    <input type="text"
                                           class="form-control form-control-sm preview-input"
                                           value="{{ $report->lokasi_lain ?? '-' }}"
                                           readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="note-warning">
                                    <strong>NOTE:</strong>
                                    <p class="mb-0">Beri Tanda (✓) Jika Sesuai Prosedur kerja Aman dan (Kosongkan) Jika tidak masuk dalam Kegiatan Observasi</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    I. Perilaku Pekerja Saat Diamati
                                </label>

                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Item</th>
                                            <th style="width: 80px;">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Posisi saat bekerja</td>
                                            <td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->perilaku_posisi_saat_bekerja ?? 0) }} disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Menggunakan peralatan</td>
                                            <td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->perilaku_menggunakan_peralatan ?? 0) }} disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Mengangkat barang</td>
                                            <td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->perilaku_mengangkat_barang ?? 0) }} disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Mengemudi</td>
                                            <td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->perilaku_mengemudi ?? 0) }} disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Menaiki / Menuruni tangga</td>
                                            <td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->perilaku_menaiki_menuruni_tangga ?? 0) }} disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Dan lain-lain:</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="check-readonly" {{ (!empty($report->perilaku_lain_1) || !empty($report->perilaku_lain_2)) ? 'checked' : '' }} disabled>
                                            </td>
                                        </tr>
                                        @if(!empty($report->perilaku_lain_1))
                                            <tr>
                                                <td colspan="2">
                                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->perilaku_lain_1 }}" readonly>
                                                </td>
                                            </tr>
                                        @endif
                                        @if(!empty($report->perilaku_lain_2))
                                            <tr>
                                                <td colspan="2">
                                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->perilaku_lain_2 }}" readonly>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    II. Penggunaan APD / Alat Keselamatan
                                </label>

                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Item</th>
                                            <th style="width: 80px;">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Pelindung kepala (Helmet)</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_pelindung_kepala ?? 0) }} disabled></td></tr>
                                        <tr><td>Pelindung mata (Kaca Mata)</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_pelindung_mata ?? 0) }} disabled></td></tr>
                                        <tr><td>Pelindung telinga (Earplug/ Muff)</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_pelindung_telinga ?? 0) }} disabled></td></tr>
                                        <tr><td>Pelindung pernafasan (Masker)</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_pelindung_pernafasan ?? 0) }} disabled></td></tr>
                                        <tr><td>Pelindung tangan (Sarung Tangan)</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_pelindung_tangan ?? 0) }} disabled></td></tr>
                                        <tr><td>Pelindung kaki (Safety Shoes)</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_pelindung_kaki ?? 0) }} disabled></td></tr>
                                        <tr><td>Pelindung tenggelam (Life Jacket)</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_pelindung_tenggelam ?? 0) }} disabled></td></tr>
                                        <tr><td>LOTO</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_loto ?? 0) }} disabled></td></tr>
                                        <tr><td>Sabuk Pengaman / Set Belt</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->apd_sabuk_pengaman ?? 0) }} disabled></td></tr>
                                        <tr>
                                            <td>Dan lain-lain:</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="check-readonly" {{ (!empty($report->apd_lain_1) || !empty($report->apd_lain_2)) ? 'checked' : '' }} disabled>
                                            </td>
                                        </tr>
                                        @if(!empty($report->apd_lain_1))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->apd_lain_1 }}" readonly></td></tr>
                                        @endif
                                        @if(!empty($report->apd_lain_2))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->apd_lain_2 }}" readonly></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    III. Potensi Risiko dari Pekerja
                                </label>

                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Item</th>
                                            <th style="width: 80px;">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Menabrak / ditabrak</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_menabrak ?? 0) }} disabled></td></tr>
                                        <tr><td>Terjepit</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_terjepit ?? 0) }} disabled></td></tr>
                                        <tr><td>Terpukul / terbentur</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_terpukul ?? 0) }} disabled></td></tr>
                                        <tr><td>Terpeleset / terguling / terjatuh</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_terpeleset ?? 0) }} disabled></td></tr>
                                        <tr><td>Sengatan / gigitan binatang</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_sengatan ?? 0) }} disabled></td></tr>
                                        <tr><td>Gangguan kesehatan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_gangguan_kesehatan ?? 0) }} disabled></td></tr>
                                        <tr><td>Pencemaran Lingkungan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_pencemaran_lingkungan ?? 0) }} disabled></td></tr>
                                        <tr><td>Terhirup / terpapar debu / bahan kimia</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_terhirup ?? 0) }} disabled></td></tr>
                                        <tr><td>Kontak dengan panas / listrik</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->risiko_kontak ?? 0) }} disabled></td></tr>
                                        <tr>
                                            <td>Dan lain-lain:</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="check-readonly" {{ (!empty($report->risiko_lain_1) || !empty($report->risiko_lain_2)) ? 'checked' : '' }} disabled>
                                            </td>
                                        </tr>
                                        @if(!empty($report->risiko_lain_1))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->risiko_lain_1 }}" readonly></td></tr>
                                        @endif
                                        @if(!empty($report->risiko_lain_2))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->risiko_lain_2 }}" readonly></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    IV. Peralatan Kerja
                                </label>

                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Item</th>
                                            <th style="width: 80px;">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Sesuai untuk pekerjaan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->peralatan_sesuai ?? 0) }} disabled></td></tr>
                                        <tr><td>Benar dalam menggunakan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->peralatan_benar ?? 0) }} disabled></td></tr>
                                        <tr><td>Kondisi baik dan layak operasi</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->peralatan_kondisi ?? 0) }} disabled></td></tr>
                                        <tr><td>Taging / KIP ada / telah dilakukan pengecekan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->peralatan_taging ?? 0) }} disabled></td></tr>
                                        <tr><td>Pelindung dan pengaman</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->peralatan_pelindung ?? 0) }} disabled></td></tr>
                                        <tr>
                                            <td>Dan lain-lain:</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="check-readonly" {{ (!empty($report->peralatan_lain_1) || !empty($report->peralatan_lain_2)) ? 'checked' : '' }} disabled>
                                            </td>
                                        </tr>
                                        @if(!empty($report->peralatan_lain_1))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->peralatan_lain_1 }}" readonly></td></tr>
                                        @endif
                                        @if(!empty($report->peralatan_lain_2))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->peralatan_lain_2 }}" readonly></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    V. Prosedur Kerja
                                </label>

                                <table class="table table-bordered table-sm mt-2">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Item</th>
                                            <th style="width: 80px;">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Tersedia / Ada</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->prosedur_tersedia ?? 0) }} disabled></td></tr>
                                        <tr><td>Diketahui / Dimengerti</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->prosedur_diketahui ?? 0) }} disabled></td></tr>
                                        <tr><td>Dijalankan / dilaksanakan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->prosedur_dijalankan ?? 0) }} disabled></td></tr>
                                        <tr><td>Permit / Izin Kerja</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->prosedur_permit ?? 0) }} disabled></td></tr>
                                        <tr><td>P2H</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->prosedur_p2h ?? 0) }} disabled></td></tr>
                                        <tr>
                                            <td>Dan lain-lain:</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="check-readonly" {{ (!empty($report->prosedur_kerja_lain) || !empty($report->prosedur_kerja_lain_2)) ? 'checked' : '' }} disabled>
                                            </td>
                                        </tr>
                                        @if(!empty($report->prosedur_kerja_lain))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->prosedur_kerja_lain }}" readonly></td></tr>
                                        @endif
                                        @if(!empty($report->prosedur_kerja_lain_2))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->prosedur_kerja_lain_2 }}" readonly></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    VI. Kondisi Area / Lingkungan Kerja
                                </label>

                                <table class="table table-bordered table-sm mb-0" style="table-layout: fixed;">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th>Item</th>
                                            <th style="width: 80px;">Check</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Kebersihan / Kerapian</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_kebersihan ?? 0) }} disabled></td></tr>
                                        <tr><td>Rambu / Demarkasi</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_rambu ?? 0) }} disabled></td></tr>
                                        <tr><td>Akses / jalan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_akses ?? 0) }} disabled></td></tr>
                                        <tr><td>Penyimpanan barang</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_penyimpanan ?? 0) }} disabled></td></tr>
                                        <tr><td>Suhu</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_suhu ?? 0) }} disabled></td></tr>
                                        <tr><td>Pencahayaan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_pencahayaan ?? 0) }} disabled></td></tr>
                                        <tr><td>Kebisingan</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_kebisingan ?? 0) }} disabled></td></tr>
                                        <tr><td>Cuaca</td><td class="text-center"><input type="checkbox" class="check-readonly" {{ $isChecked($report->kondisi_area_cuaca ?? 0) }} disabled></td></tr>
                                        <tr>
                                            <td>Dan lain-lain:</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="check-readonly" {{ (!empty($report->kondisi_area_lain) || !empty($report->kondisi_area_lain_2)) ? 'checked' : '' }} disabled>
                                            </td>
                                        </tr>
                                        @if(!empty($report->kondisi_area_lain))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->kondisi_area_lain }}" readonly></td></tr>
                                        @endif
                                        @if(!empty($report->kondisi_area_lain_2))
                                            <tr><td colspan="2"><input type="text" class="form-control form-control-sm preview-input" value="{{ $report->kondisi_area_lain_2 }}" readonly></td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    VII. Perilaku Aman Yang Di Amati (Komentar)
                                </label>

                                <table class="table table-bordered table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control form-control-sm preview-textarea" rows="5" readonly>{{ $report->perilaku_aman_yang_diamati ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    VIII. Perilaku Tidak Aman Yang Di Amati (Komentar)
                                </label>

                                <table class="table table-bordered table-sm mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <textarea class="form-control form-control-sm preview-textarea" rows="5" readonly>{{ $report->perilaku_tidak_aman_yang_diamati ?? '' }}</textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="fw-bold d-block text-white px-2 py-2" style="background-color:#0d6efd;">
                                    IX. Tindakan Koreksi / Tindakan Perbaikan
                                </label>

                                <table class="table table-bordered table-sm mb-4 table-fix">
                                    <tbody>
                                        <tr>
                                            <td class="check-col" style="width:60px; text-align:center;">
                                                <input type="checkbox" class="check-readonly" {{ $isChecked($report->tindakan_kegiatan ?? 0) }} disabled>
                                            </td>
                                            <td>Kegiatan di Hentikan</td>
                                        </tr>
                                        <tr>
                                            <td class="check-col" style="text-align:center;">
                                                <input type="checkbox" class="check-readonly" {{ $isChecked($report->tindakan_perbaikan_langsung ?? 0) }} disabled>
                                            </td>
                                            <td>Perbaikan Langsung di Tempat</td>
                                        </tr>
                                        <tr>
                                            <td class="check-col" style="text-align:center;">
                                                <input type="checkbox" class="check-readonly" {{ $isChecked($report->tindakan_perbaikan_lanjutan ?? 0) }} disabled>
                                            </td>
                                            <td>Perbaikan Lanjutan</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered table-sm mb-0 table-fix">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Tindakan Koreksi / Tindakan Perbaikan Yang dilakukan</th>
                                            <th style="width: 180px;">Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ $report->tindakan_lanjutan_1 ?? '' }}" readonly></td>
                                            <td><input type="date" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ !empty($report->tindakan_lanjutan_due_1) ? date('Y-m-d', strtotime($report->tindakan_lanjutan_due_1)) : '' }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ $report->tindakan_lanjutan_2 ?? '' }}" readonly></td>
                                            <td><input type="date" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ !empty($report->tindakan_lanjutan_due_2) ? date('Y-m-d', strtotime($report->tindakan_lanjutan_due_2)) : '' }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ $report->tindakan_lanjutan_3 ?? '' }}" readonly></td>
                                            <td><input type="date" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ !empty($report->tindakan_lanjutan_due_3) ? date('Y-m-d', strtotime($report->tindakan_lanjutan_due_3)) : '' }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ $report->tindakan_lanjutan_4 ?? '' }}" readonly></td>
                                            <td><input type="date" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ !empty($report->tindakan_lanjutan_due_4) ? date('Y-m-d', strtotime($report->tindakan_lanjutan_due_4)) : '' }}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ $report->tindakan_lanjutan_5 ?? '' }}" readonly></td>
                                            <td><input type="date" class="form-control form-control-sm border-0 shadow-none preview-input" value="{{ !empty($report->tindakan_lanjutan_due_5) ? date('Y-m-d', strtotime($report->tindakan_lanjutan_due_5)) : '' }}" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div class="form-group mt-3">
                                <label for="notes">Catatan Khusus:</label>
                                <textarea id="notes" class="form-control form-control-sm preview-textarea" rows="3" readonly>{{ $report->additional_notes ?? '' }}</textarea>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <h5>X. Petugas / Observer</h5>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Petugas / Observer 1</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->nama_petugas1 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Petugas / Observer 2</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->nama_petugas2 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Petugas / Observer 3</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->nama_petugas3 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Petugas / Observer 4</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->nama_petugas4 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Petugas / Observer 5</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->nama_petugas5 ?? '-' }}" readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <h5>XI. Pekerja yang di Observasi</h5>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Pekerja 1</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->pekerja1 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Pekerja 2</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->pekerja2 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Pekerja 3</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->pekerja3 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Pekerja 4</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->pekerja4 ?? '-' }}" readonly>
                                </div>

                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Pekerja 5</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->pekerja5 ?? '-' }}" readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <h5>XII. Validasi Pengawas / Penanggung Jawab</h5>
                                <div class="col-md-12 col-12 px-2 py-2">
                                    <label>Pengawas</label>
                                    <input type="text" class="form-control form-control-sm preview-input" value="{{ $report->nama_pengawas1 ?? '-' }}" readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <h5>XIII. Dokumentasi Foto</h5>

                                @if($foto1 || $foto2 || $foto3)
                                    <div class="photo-grid">
                                        @if($foto1)
                                            <div class="photo-card">
                                                <a href="{{ $foto1 }}" target="_blank">
                                                    <img src="{{ $foto1 }}" alt="Dokumentasi Foto 1">
                                                </a>
                                                <div class="photo-meta">Dokumentasi Foto 1</div>
                                            </div>
                                        @endif

                                        @if($foto2)
                                            <div class="photo-card">
                                                <a href="{{ $foto2 }}" target="_blank">
                                                    <img src="{{ $foto2 }}" alt="Dokumentasi Foto 2">
                                                </a>
                                                <div class="photo-meta">Dokumentasi Foto 2</div>
                                            </div>
                                        @endif

                                        @if($foto3)
                                            <div class="photo-card">
                                                <a href="{{ $foto3 }}" target="_blank">
                                                    <img src="{{ $foto3 }}" alt="Dokumentasi Foto 3">
                                                </a>
                                                <div class="photo-meta">Dokumentasi Foto 3</div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="empty-photo">
                                        Belum ada dokumentasi foto.
                                    </div>
                                @endif
                            </div>
                           <div class="card-body p-3">
                                <div class="d-flex justify-content-end align-items-center gap-2 flex-wrap">

                                    {{-- Kembali --}}
                                    <a href="javascript:void(0)"
                                    onclick="window.history.back()"
                                    class="btn btn-outline-secondary rounded-pill px-3 py-2 d-flex align-items-center gap-2">
                                        <i class="ti ti-arrow-left fs-5"></i>
                                        <span>Kembali</span>
                                    </a>

                                    {{-- Download --}}
                                    {{-- <a href="{{ route('observasibank.download', $report->uuid) }}"
                                    target="_blank"
                                    class="btn btn-outline-success rounded-pill px-3 py-2 d-flex align-items-center gap-2">
                                        <i class="ph-duotone ph-download-simple fs-5"></i>
                                        <span>Download</span>
                                    </a> --}}

                                    {{-- Cetak --}}
                                    <a href="{{ route('observasibank.cetak', $report->uuid) }}"
                                    target="_blank"
                                    class="btn btn-primary rounded-pill px-3 py-2 d-flex align-items-center gap-2">
                                        <i class="ph-duotone ph-printer fs-5"></i>
                                        <span>Cetak</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
