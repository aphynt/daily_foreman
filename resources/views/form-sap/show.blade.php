@include('layout.head', ['title' => 'Detail Laporan SAP'])
@include('layout.sidebar')
@include('layout.header')

@php
    $report = $data['report'];

    $imageUrl = function ($path) {
        if (!$path) return null;

        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
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

    $inspektors = array_filter([
        $report->inspektor1 ?? null,
        $report->inspektor2 ?? null,
        $report->inspektor3 ?? null,
        $report->inspektor4 ?? null,
        $report->inspektor5 ?? null,
    ]);
@endphp

<style>
    :root {
        --sap-primary: #2563eb;
        --sap-primary-soft: rgba(37, 99, 235, 0.08);
        --sap-success: #16a34a;
        --sap-warning: #f59e0b;
        --sap-danger: #ef4444;
        --sap-text: #0f172a;
        --sap-muted: #64748b;
        --sap-border: #e2e8f0;
        --sap-bg: #f8fafc;
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

    .report-page-title {
        margin-bottom: 20px;
    }

    .report-page-title h3 {
        margin: 0;
        font-weight: 700;
        color: var(--sap-text);
        letter-spacing: -0.02em;
    }

    .report-page-subtitle {
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

    .status-finish {
        background: rgba(22, 163, 74, 0.10);
        color: #15803d;
        border-color: rgba(22, 163, 74, 0.18);
    }

    .status-open {
        background: rgba(245, 158, 11, 0.12);
        color: #b45309;
        border-color: rgba(245, 158, 11, 0.18);
    }

    .status-risk-ringan {
        background: rgba(34, 197, 94, 0.12);
        color: #15803d;
        border-color: rgba(34, 197, 94, 0.18);
    }

    .status-risk-sedang {
        background: rgba(245, 158, 11, 0.12);
        color: #b45309;
        border-color: rgba(245, 158, 11, 0.18);
    }

    .status-risk-tinggi {
        background: rgba(239, 68, 68, 0.12);
        color: #b91c1c;
        border-color: rgba(239, 68, 68, 0.18);
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

    .field-block {
        margin-bottom: 16px;
    }

    .field-block:last-child {
        margin-bottom: 0;
    }

    .field-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--sap-text);
    }

    .field-value,
    .field-textarea {
        width: 100%;
        min-height: 46px;
        border-radius: 12px;
        border: 1px solid var(--sap-border);
        background: #f8fafc;
        color: var(--sap-text);
        padding: 10px 14px;
        font-size: 0.95rem;
    }

    .field-textarea {
        min-height: 110px;
        resize: none;
    }

    .inspector-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .inspector-chip {
        display: inline-flex;
        align-items: center;
        min-height: 38px;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f8fafc;
        border: 1px solid var(--sap-border);
        color: var(--sap-text);
        font-size: 0.9rem;
        font-weight: 600;
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

        .btn-action {
            width: 100%;
        }
    }
    .action-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 18px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 0 18px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.92rem;
        text-decoration: none;
        border: none;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-verify {
        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        color: #fff;
        box-shadow: 0 10px 18px rgba(34, 197, 94, 0.22);
    }

    .btn-verify:hover {
        transform: translateY(-1px);
        color: #fff;
        box-shadow: 0 14px 22px rgba(34, 197, 94, 0.25);
    }

    .btn-continue {
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, 0.16);
    }

    .btn-continue:hover {
        background: rgba(37, 99, 235, 0.14);
        color: #2563eb;
    }

</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-md-10 col-xxl-9 mb-4">
                <div class="report-page-title">
                    <h3>Detail Laporan SAP</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card report-card">
                    <div class="card-body">
                        <div class="topbar-wrap">
                            <div class="topbar-logo">
                                <img src="{{ asset('dashboard/assets/images/logo-full.png') }}" alt="Logo">
                            </div>

                            <div class="topbar-actions">
                                <a href="{{ route('form-pengawas-sap.show') }}" class="back-btn">← Kembali</a>
                                {{-- @if (Auth::user()->id == 3) --}}

                                <a href="{{ route('form-pengawas-sap.open', $report->uuid) }}" class="back-btn">🔍 Open</a>
                                {{-- @endif --}}
                            </div>
                        </div>

                        <div class="hero-box">
                            <h2>Laporan SAP Pengawas</h2>
                            <p>Ringkasan data inspeksi, temuan, risiko, dan tindak lanjut.</p>

                            <div class="status-row">
                                <span class="status-chip {{ ($report->is_finish ?? false) ? 'status-finish' : 'status-open' }}">
                                    {{ ($report->is_finish ?? false) ? 'Selesai / Closing' : 'Open / Belum Selesai' }}
                                </span>

                                @php
                                    $riskClass = 'status-open';
                                    if (($report->tingkat_risiko ?? '') === 'Ringan') $riskClass = 'status-risk-ringan';
                                    if (($report->tingkat_risiko ?? '') === 'Sedang') $riskClass = 'status-risk-sedang';
                                    if (($report->tingkat_risiko ?? '') === 'Tinggi') $riskClass = 'status-risk-tinggi';
                                @endphp

                                <span class="status-chip {{ $riskClass }}">
                                    Risiko: {{ $report->tingkat_risiko ?? '-' }}
                                </span>

                                <span class="status-chip" style="background:#eef2ff;color:#4338ca;border-color:#c7d2fe;">
                                    PICA Level: {{ $report->level ?? '-' }}
                                </span>

                                @if((int)($report->is_finish ?? 0) === 0)
                                    <div class="action-row">
                                        <form action="{{ route('form-pengawas-sap.verify-scc', $report->uuid ?? $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin memverifikasi laporan ini?')">
                                            @csrf
                                            <button type="submit" class="btn-action btn-verify">
                                                Verifikasi
                                            </button>
                                        </form>

                                        <a href="{{ route('form-pengawas-sap.edit', $report->uuid ?? $report->id) }}" class="btn-action btn-continue">
                                            Teruskan
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <span class="section-badge">1</span>
                                <div>
                                    <h5>Informasi Inspektor</h5>
                                    <p>Data petugas yang terlibat dalam inspeksi.</p>
                                </div>
                            </div>

                            <div class="field-block">
                                <label class="field-label">Daftar Inspektor</label>
                                @if(count($inspektors) > 0)
                                    <div class="inspector-list">
                                        @foreach($inspektors as $index => $inspektor)
                                            <span class="inspector-chip">Inspektor {{ $index + 1 }}: {{ $inspektor }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state">Data inspektor tidak tersedia.</div>
                                @endif
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <span class="section-badge">2</span>
                                <div>
                                    <h5>Detail Lokasi & Waktu</h5>
                                    <p>Konteks dasar dari laporan inspeksi.</p>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="field-block">
                                        <label class="field-label">Tanggal Pelaporan</label>
                                        <input type="text" class="field-value" value="{{ !empty($report->created_at) ? date('d-m-Y', strtotime($report->created_at)) : '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="field-block">
                                        <label class="field-label">Jam Kejadian</label>
                                        <input type="text" class="field-value" value="{{ !empty($report->jam_kejadian) ? date('H:i', strtotime($report->jam_kejadian)) : '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="field-block">
                                        <label class="field-label">Shift</label>
                                        <input type="text" class="field-value" value="{{ $report->shift ?? '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="field-block">
                                        <label class="field-label">Area</label>
                                        <input type="text" class="field-value" value="{{ $report->area ?? '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-block">
                                        <label class="field-label">Pembuat</label>
                                        <input type="text" class="field-value" value="{{ $report->pembuat ?? '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-block">
                                        <label class="field-label">PIC Departemen</label>
                                        <input type="text" class="field-value" value="{{ $report->nama_pic ?? '-' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <span class="section-badge">3</span>
                                <div>
                                    <h5>Temuan Inspeksi</h5>
                                    <p>Rangkuman temuan utama dan dokumentasi lapangan.</p>
                                </div>
                            </div>

                            <div class="field-block">
                                <label class="field-label">Temuan KTA/TTA</label>
                                <textarea class="field-textarea" readonly>{{ $report->temuan ?? '-' }}</textarea>
                            </div>

                            <div class="field-block">
                                <label class="field-label">Foto Temuan</label>
                                @if(count($temuanImages) > 0)
                                    <div class="image-grid">
                                        @foreach($temuanImages as $index => $img)
                                            <div class="image-card">
                                                <a href="{{ $img }}" target="_blank">
                                                    <img src="{{ $img }}" alt="Foto Temuan {{ $index + 1 }}">
                                                </a>
                                                <div class="image-meta">Foto Temuan {{ $index + 1 }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state">Belum ada foto temuan yang diunggah.</div>
                                @endif
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="field-block">
                                        <label class="field-label">Tingkat Risiko</label>
                                        <input type="text" class="field-value" value="{{ $report->tingkat_risiko ?? '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-block">
                                        <label class="field-label">PICA Level</label>
                                        <input type="text" class="field-value" value="{{ $report->level ?? '-' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <span class="section-badge">4</span>
                                <div>
                                    <h5>Analisis Risiko</h5>
                                    <p>Uraian risiko dan pengendalian dari hasil inspeksi.</p>
                                </div>
                            </div>

                            <div class="field-block">
                                <label class="field-label">Risiko</label>
                                <textarea class="field-textarea" readonly>{{ $report->risiko ?? '-' }}</textarea>
                            </div>

                            <div class="field-block">
                                <label class="field-label">Pengendalian</label>
                                <textarea class="field-textarea" readonly>{{ $report->pengendalian ?? '-' }}</textarea>
                            </div>
                        </div>

                        <div class="section-card" style="margin-bottom: 0;">
                            <div class="section-title">
                                <span class="section-badge">5</span>
                                <div>
                                    <h5>Tindak Lanjut</h5>
                                    <p>Status tindak lanjut dan bukti dokumentasi perbaikan.</p>
                                </div>
                            </div>

                            <div class="field-block">
                                <label class="field-label">Tindak Lanjut</label>
                                <textarea class="field-textarea" readonly>{{ $report->tindak_lanjut ?? '-' }}</textarea>
                            </div>

                            <div class="field-block">
                                <label class="field-label">Foto Bukti Tindak Lanjut</label>
                                @if(count($tindakLanjutImages) > 0)
                                    <div class="image-grid">
                                        @foreach($tindakLanjutImages as $index => $img)
                                            <div class="image-card">
                                                <a href="{{ $img }}" target="_blank">
                                                    <img src="{{ $img }}" alt="Foto Tindak Lanjut {{ $index + 1 }}">
                                                </a>
                                                <div class="image-meta">Foto Bukti {{ $index + 1 }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state">Belum ada foto bukti tindak lanjut.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
