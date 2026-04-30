@include('layout.head', ['title' => 'Update Laporan SAP'])
@include('layout.sidebar')
@include('layout.header')

@php
    use Illuminate\Support\Str;

    $report = $data['report'];

    $imageUrl = function ($path) {
        if (!$path) return null;

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    };

    $temuanImages = array_filter([
        $imageUrl($report->file_temuan ?? null),
        $imageUrl($report->file_temuan2 ?? null),
        $imageUrl($report->file_temuan3 ?? null),
    ]);

    $tindakLanjutImages = array_filter([
        $imageUrl($report->file_tindakLanjut ?? null),
        $imageUrl($report->file_tindakLanjut2 ?? null),
        $imageUrl($report->file_tindakLanjut3 ?? null),
    ]);
@endphp

<style>
    :root {
        --sap-primary: #2563eb;
        --sap-primary-soft: rgba(37, 99, 235, 0.08);
        --sap-success: #16a34a;
        --sap-success-soft: rgba(22, 163, 74, 0.1);
        --sap-warning: #f59e0b;
        --sap-warning-soft: rgba(245, 158, 11, 0.12);
        --sap-text: #0f172a;
        --sap-muted: #64748b;
        --sap-border: #e2e8f0;
        --sap-card: #ffffff;
        --sap-radius: 18px;
        --sap-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        --sap-shadow-soft: 0 4px 14px rgba(15, 23, 42, 0.06);
    }

    .pc-container {
        background: linear-gradient(180deg, #f8fbff 0%, #f8fafc 100%);
        min-height: 100vh;
    }

    .pc-content {
        padding-top: 24px;
        padding-bottom: 32px;
    }

    .page-title-wrap {
        margin-bottom: 20px;
    }

    .page-title-wrap h3 {
        margin: 0;
        font-weight: 700;
        color: var(--sap-text);
        letter-spacing: -0.02em;
    }

    .page-subtitle {
        margin-top: 6px;
        color: var(--sap-muted);
        font-size: 0.95rem;
    }

    .report-card {
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: var(--sap-radius);
        box-shadow: var(--sap-shadow);
        overflow: hidden;
        background: var(--sap-card);
    }

    .report-card .card-body {
        padding: 28px;
    }

    .topbar-wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--sap-border);
    }

    .topbar-logo img {
        max-width: 220px;
        height: auto;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        padding: 0 16px;
        border-radius: 12px;
        background: var(--sap-primary-soft);
        color: var(--sap-primary);
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .back-btn:hover {
        background: rgba(37, 99, 235, 0.14);
        color: var(--sap-primary);
    }

    .hero-box {
        border: 1px solid var(--sap-border);
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
        border-radius: 18px;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: var(--sap-shadow-soft);
    }

    .hero-box h2 {
        margin: 0;
        font-weight: 800;
        color: var(--sap-text);
        letter-spacing: -0.02em;
    }

    .hero-box p {
        margin: 8px 0 0;
        color: var(--sap-muted);
    }

    .status-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 16px;
    }

    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 38px;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 0.88rem;
        font-weight: 700;
        border: 1px solid transparent;
    }

    .status-open {
        background: var(--sap-warning-soft);
        color: #b45309;
        border-color: rgba(245, 158, 11, 0.18);
    }

    .status-finish {
        background: var(--sap-success-soft);
        color: #15803d;
        border-color: rgba(22, 163, 74, 0.18);
    }

    .section-card {
        border: 1px solid var(--sap-border);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        box-shadow: var(--sap-shadow-soft);
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .section-badge {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--sap-primary-soft);
        color: var(--sap-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .section-title h5 {
        margin: 0;
        font-weight: 700;
        color: var(--sap-text);
    }

    .section-title p {
        margin: 2px 0 0;
        color: var(--sap-muted);
        font-size: 0.88rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--sap-text);
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        border: 1px solid var(--sap-border);
        min-height: 46px;
        padding: 10px 14px;
        font-size: 0.95rem;
        color: var(--sap-text);
        background-color: #fff;
        transition: all 0.2s ease;
        box-shadow: none;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: rgba(37, 99, 235, 0.45);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    .readonly-field {
        background: #f8fafc !important;
    }

    .field-note {
        display: block;
        margin-top: 6px;
        font-size: 0.82rem;
        color: var(--sap-muted);
    }

    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }

    .image-card {
        border: 1px solid var(--sap-border);
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: var(--sap-shadow-soft);
    }

    .image-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
        background: #f8fafc;
    }

    .image-meta {
        padding: 10px 12px;
        font-size: 0.85rem;
        color: var(--sap-muted);
        border-top: 1px solid var(--sap-border);
    }

    .empty-state {
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        padding: 18px;
        background: #f8fafc;
        color: var(--sap-muted);
        text-align: center;
        font-size: 0.92rem;
    }

    .action-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 28px;
    }

    .submit-wrap {
        flex: 1 1 280px;
    }

    .submit-panel {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        border-radius: 16px;
        padding: 14px;
        height: 100%;
    }

    .btn-finish,
    .btn-verify {
        width: 100%;
        min-height: 50px;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.01em;
        transition: all 0.2s ease;
    }

    .btn-finish {
        background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        color: #fff;
        box-shadow: 0 10px 18px rgba(17, 24, 39, 0.20);
    }

    .btn-finish:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 22px rgba(17, 24, 39, 0.24);
    }

    .verify-wrap {
        width: 220px;
    }

    .verify-panel {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        border-radius: 16px;
        padding: 14px;
        height: 100%;
    }

    .btn-verify {
        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        color: #fff;
        box-shadow: 0 10px 18px rgba(34, 197, 94, 0.22);
    }

    .btn-verify:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 22px rgba(34, 197, 94, 0.25);
    }

    .btn-finish:disabled,
    .btn-verify:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .alert {
        border: none;
        border-radius: 12px;
        font-size: 0.92rem;
    }

    @media (max-width: 768px) {
        .report-card .card-body {
            padding: 18px;
        }

        .hero-box {
            padding: 18px;
        }

        .hero-box h2 {
            font-size: 1.35rem;
        }

        .section-card {
            padding: 16px;
        }

        .topbar-logo img {
            max-width: 170px;
        }

        .action-row {
            flex-direction: column;
        }

        .submit-wrap,
        .verify-wrap {
            width: 100%;
            flex: 1 1 100%;
        }
    }
</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-md-10 col-xxl-9 mb-4">
                <div class="page-title-wrap">
                    <h3>Update Laporan SAP</h3>
                    <div class="page-subtitle">Lengkapi tindak lanjut dan perbarui dokumentasi laporan</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card report-card">
                    <div class="card-body">
                        <form id="laporanForm"
                              method="POST"
                              action="{{ route('form-pengawas-sap.update', $report->uuid) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="topbar-wrap">
                                <div class="topbar-logo">
                                    <img src="{{ asset('dashboard/assets/images/logo-full.png') }}" alt="Logo">
                                </div>
                                <a href="{{ route('form-pengawas-sap.show') }}" class="back-btn">← Kembali</a>
                            </div>

                            <div class="hero-box">
                                <h2>Update Laporan SAP Pengawas</h2>
                                <p>Lengkapi tindak lanjut, perbarui foto, dan lakukan verifikasi bila laporan siap diproses.</p>

                                <div class="status-row">
                                    <span class="status-chip {{ (int)($report->is_finish ?? 0) === 1 ? 'status-finish' : 'status-open' }}">
                                        {{ (int)($report->is_finish ?? 0) === 1 ? 'Selesai / Closing' : 'Open / Belum Selesai' }}
                                    </span>

                                    <span class="status-chip" style="background:#eef2ff;color:#4338ca;border-color:#c7d2fe;">
                                        PICA Level: {{ $report->level ?? '-' }}
                                    </span>

                                    <span class="status-chip" style="background:rgba(239,246,255,1);color:#1d4ed8;border-color:#bfdbfe;">
                                        Risiko: {{ $report->tingkat_risiko ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="section-card">
                                <div class="section-title">
                                    <span class="section-badge">1</span>
                                    <div>
                                        <h5>Informasi Dasar</h5>
                                        <p>Data laporan yang sudah tercatat.</p>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal Pelaporan</label>
                                        <input type="text"
                                               class="form-control readonly-field"
                                               value="{{ !empty($report->tanggal_kejadian) ? date('d-m-Y', strtotime($report->tanggal_kejadian)) : '-' }}"
                                               readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Jam Kejadian</label>
                                        <input type="text"
                                               class="form-control readonly-field"
                                               value="{{ !empty($report->jam_kejadian) ? date('H:i', strtotime($report->jam_kejadian)) : '-' }}"
                                               readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Shift</label>
                                        <input type="text"
                                               class="form-control readonly-field"
                                               value="{{ $report->shift ?: '-' }}"
                                               readonly>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Area</label>
                                        <input type="text"
                                               class="form-control readonly-field"
                                               value="{{ $report->area ?: '-' }}"
                                               readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Inspektor 1</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $report->inspektor1 ?: '-' }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Inspektor 2</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $report->inspektor2 ?: '-' }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Inspektor 3</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $report->inspektor3 ?: '-' }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Inspektor 4</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $report->inspektor4 ?: '-' }}" readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Inspektor 5</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $report->inspektor5 ?: '-' }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">PICA Level</label>
                                        <select class="form-select" id="level" name="level" required>
                                            <option value="1" {{ old('level', $report->level) == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('level', $report->level) == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('level', $report->level) == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('level', $report->level) == '4' ? 'selected' : '' }}>4</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">PIC Departemen</label>
                                        <select class="form-select" id="pic" name="pic" required>
                                            @foreach ($data['departemen'] as $dep)
                                                <option value="{{ $dep->id }}"
                                                    {{ old('pic', $report->departemen_pic) == $dep->id ? 'selected' : '' }}>
                                                    {{ $dep->keterangan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Tingkat Risiko</label>
                                        <select class="form-select" id="tingkatRisiko" name="tingkatRisiko" required>
                                            <option value="Ringan" {{ old('tingkatRisiko', $report->tingkat_risiko) == 'Ringan' ? 'selected' : '' }}>Ringan</option>
                                            <option value="Sedang" {{ old('tingkatRisiko', $report->tingkat_risiko) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                            <option value="Tinggi" {{ old('tingkatRisiko', $report->tingkat_risiko) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="section-card">
                                <div class="section-title">
                                    <span class="section-badge">2</span>
                                    <div>
                                        <h5>Temuan & Analisis</h5>
                                        <p>Bagian ini disamakan dengan form utama agar alur pengisian tetap konsisten.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Temuan KTA/TTA</label>
                                    <textarea class="form-control"
                                              rows="5"
                                              name="temuan"
                                              placeholder="Masukkan temuan">{{ old('temuan', $report->temuan) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Risiko</label>
                                    <textarea class="form-control"
                                              rows="5"
                                              name="risiko"
                                              placeholder="Masukkan risiko">{{ old('risiko', $report->risiko) }}</textarea>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Pengendalian Awal</label>
                                    <textarea class="form-control"
                                              rows="5"
                                              name="pengendalian"
                                              placeholder="Masukkan pengendalian">{{ old('pengendalian', $report->pengendalian) }}</textarea>
                                </div>
                            </div>

                            <div class="section-card">
                                <div class="section-title">
                                    <span class="section-badge">3</span>
                                    <div>
                                        <h5>Foto Temuan</h5>
                                        <p>Support hingga 3 foto, sama seperti form input awal.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Temuan 1</label>
                                    <input type="file" class="form-control" name="file_temuan" accept="image/*" />
                                    <small class="field-note">Kosongkan jika tidak ingin mengganti foto.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Temuan 2 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_temuan2" accept="image/*" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Temuan 3 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_temuan3" accept="image/*" />
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Foto Temuan Saat Ini</label>
                                    @if(count($temuanImages) > 0)
                                        <div class="image-grid">
                                            @foreach($temuanImages as $index => $img)
                                                <div class="image-card">
                                                    <a href="{{ $img }}" target="_blank">
                                                        <img src="{{ $img }}" alt="Foto Temuan {{ $index + 1 }}">
                                                    </a>
                                                    <div class="image-meta">Foto Temuan {{ $index + 1 }}. Klik untuk membuka.</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="empty-state">Belum ada foto temuan tersimpan.</div>
                                    @endif
                                </div>
                            </div>

                            <div class="section-card" style="margin-bottom: 0;">
                                <div class="section-title">
                                    <span class="section-badge">4</span>
                                    <div>
                                        <h5>Tindak Lanjut</h5>
                                        <p>Bagian ini juga disamakan dengan form utama, termasuk 3 slot foto bukti.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tindak Lanjut</label>
                                    <textarea class="form-control"
                                              rows="5"
                                              name="tindakLanjut"
                                              placeholder="Masukkan tindak lanjut">{{ old('tindakLanjut', $report->tindak_lanjut) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Bukti Tindak Lanjut 1</label>
                                    <input type="file" class="form-control" name="file_tindakLanjut" accept="image/*" />
                                    <small class="field-note">Kosongkan jika tidak ingin mengganti foto.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Bukti Tindak Lanjut 2 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_tindakLanjut2" accept="image/*" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Bukti Tindak Lanjut 3 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_tindakLanjut3" accept="image/*" />
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Foto Bukti Saat Ini</label>
                                    @if(count($tindakLanjutImages) > 0)
                                        <div class="image-grid">
                                            @foreach($tindakLanjutImages as $index => $img)
                                                <div class="image-card">
                                                    <a href="{{ $img }}" target="_blank">
                                                        <img src="{{ $img }}" alt="Foto Tindak Lanjut {{ $index + 1 }}">
                                                    </a>
                                                    <div class="image-meta">Foto Bukti {{ $index + 1 }}. Klik untuk membuka.</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="empty-state">Belum ada foto bukti tindak lanjut tersimpan.</div>
                                    @endif
                                </div>

                                <div class="action-row">
                                    @if($report->foreman_id == Auth::user()->id || Auth::user()->id == 3)
                                    <div class="submit-wrap">
                                        <div class="submit-panel">
                                            <button type="submit" class="btn-finish" id="submitSAP">
                                                Finish / Update
                                            </button>
                                        </div>
                                    </div>
                                    @endif

                                    @if(Auth::user()->id == 3)
                                        <div class="verify-wrap">
                                            <div class="verify-panel">
                                                <button type="submit"
                                                        class="btn-verify"
                                                        id="submitVerifySCC"
                                                        formaction="{{ route('form-pengawas-sap.verify-scc', $report->uuid) }}"
                                                        formmethod="POST"
                                                        formenctype="multipart/form-data"
                                                        onclick="return confirm('Yakin ingin memverifikasi laporan ini?')">
                                                    Update Form & Teruskan ke PIC
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const formSAP = document.getElementById('laporanForm');
    const submitSAP = document.getElementById('submitSAP');

    function ensureFile(obj, originalName = 'image.jpg') {
        if (!obj) return null;
        if (obj instanceof File) return obj;
        if (obj instanceof Blob) {
            try {
                return new File([obj], originalName, {
                    type: obj.type || 'image/jpeg',
                    lastModified: Date.now()
                });
            } catch (err) {
                obj.name = originalName;
                return obj;
            }
        }
        return null;
    }

    async function compressFileWithLib(file, options = {}) {
        if (typeof imageCompression === 'undefined') {
            console.warn('imageCompression library not found, skipping compression.');
            return file;
        }
        try {
            const compressed = await imageCompression(file, options);
            return ensureFile(compressed, file.name);
        } catch (err) {
            console.error('Compression error:', err);
            return file;
        }
    }

    function replaceInputFile(inputElement, file) {
        if (!inputElement || !file) return;
        const fileToAdd = ensureFile(file, file.name || 'image.jpg');

        if (!(fileToAdd instanceof File)) {
            console.warn('Cannot convert compressed result to File in this browser; skipping replace for', inputElement.name);
            return;
        }

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(fileToAdd);
        inputElement.files = dataTransfer.files;
    }

    formSAP.addEventListener('submit', async function (e) {
        e.preventDefault();

        const submitter = e.submitter || document.activeElement;
        const originalAction = formSAP.getAttribute('action');
        const originalMethod = formSAP.getAttribute('method') || 'POST';
        const originalEnctype = formSAP.getAttribute('enctype') || 'multipart/form-data';

        const targetAction = submitter?.getAttribute('formaction') || originalAction;
        const targetMethod = submitter?.getAttribute('formmethod') || originalMethod;
        const targetEnctype = submitter?.getAttribute('formenctype') || originalEnctype;

        if (submitter) {
            submitter.disabled = true;
        }

        if (submitSAP) {
            submitSAP.disabled = true;
        }

        const originalText = submitter ? submitter.innerText : '';
        if (submitter) {
            submitter.innerText = 'Memproses...';
        }

        const oldAlerts = formSAP.querySelectorAll('.alert');
        oldAlerts.forEach(el => el.remove());

        const safetyTimer = setTimeout(() => {
            if (submitter) {
                submitter.disabled = false;
                submitter.innerText = originalText;
            }
            if (submitSAP && submitSAP !== submitter) {
                submitSAP.disabled = false;
            }
        }, 30000);

        try {
            const fileFields = [
                'file_temuan',
                'file_temuan2',
                'file_temuan3',
                'file_tindakLanjut',
                'file_tindakLanjut2',
                'file_tindakLanjut3'
            ];

            const options = {
                maxSizeMB: 1.0,
                maxWidthOrHeight: 1920,
                useWebWorker: true,
                initialQuality: 0.75
            };

            for (const fieldName of fileFields) {
                const input = formSAP.querySelector(`input[name="${fieldName}"]`);
                if (input && input.files && input.files.length > 0) {
                    const compressed = await compressFileWithLib(input.files[0], options);
                    if (compressed) {
                        replaceInputFile(input, compressed);
                    }
                }
            }

            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-info mt-3';
            alertDiv.innerText = 'Gambar sedang dioptimalkan dan form akan segera dikirim...';
            formSAP.prepend(alertDiv);

            clearTimeout(safetyTimer);

            formSAP.setAttribute('action', targetAction);
            formSAP.setAttribute('method', targetMethod);
            formSAP.setAttribute('enctype', targetEnctype);

            HTMLFormElement.prototype.submit.call(formSAP);
        } catch (err) {
            console.error('Error during compression/submit:', err);
            clearTimeout(safetyTimer);

            if (submitter) {
                submitter.disabled = false;
                submitter.innerText = originalText;
            }

            if (submitSAP && submitSAP !== submitter) {
                submitSAP.disabled = false;
            }

            const errDiv = document.createElement('div');
            errDiv.className = 'alert alert-danger mt-3';
            errDiv.innerText = 'Terjadi kendala saat memproses gambar. Form tetap dikirim tanpa kompresi.';
            formSAP.prepend(errDiv);

            formSAP.setAttribute('action', targetAction);
            formSAP.setAttribute('method', targetMethod);
            formSAP.setAttribute('enctype', targetEnctype);

            HTMLFormElement.prototype.submit.call(formSAP);
        }
    });
});
</script>
