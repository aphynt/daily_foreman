@include('layout.head', ['title' => 'Produksi Per Jam'])
@include('layout.sidebar')
@include('layout.header')

@php
    $actual = (float) ($data['actual'] ?? 0);
    $plan = (float) ($data['plan'] ?? 0);
    $percent = $plan > 0 ? ($actual / $plan) * 100 : 0;
    $progressWidth = max(0, min($percent, 100));
    $progressColor = $percent < 65 ? '#dc5259' : ($percent <= 85 ? '#d88c20' : ($percent <= 100 ? '#16845b' : '#497fe5'));
    $isSiang = ($data['waktu'] ?? 'Siang') === 'Siang';
    $tabs = $isSiang
        ? [
            ['id' => 'shift-siang', 'label' => 'Shift Siang', 'key' => 'Siang'],
            ['id' => 'history-shift-malam', 'label' => 'History Shift Malam', 'key' => 'HistoryMalam'],
        ]
        : [
            ['id' => 'shift-malam', 'label' => 'Shift Malam', 'key' => 'Malam'],
            ['id' => 'history-shift-siang', 'label' => 'History Shift Siang', 'key' => 'HistorySiang'],
        ];
@endphp

<style>
    .production-page {
        --prd-bg: #ffffff;
        --prd-subtle: #f5f7fb;
        --prd-border: #e0e6ef;
        --prd-text: #182638;
        --prd-muted: #56677e;
        --prd-track: #e8edf4;
        --prd-active: #245cbe;
        --prd-active-text: #ffffff;
        color: var(--prd-text);
    }
    [data-pc-theme="dark"] .production-page,
    [data-bs-theme="dark"] .production-page,
    [data-theme="dark"] .production-page,
    body.dark .production-page,
    body.dark-mode .production-page {
        --prd-bg: #202b3c;
        --prd-subtle: #172234;
        --prd-border: #405069;
        --prd-text: #f2f6fc;
        --prd-muted: #c3cee0;
        --prd-track: #39485d;
        --prd-active: #78aaff;
        --prd-active-text: #102139;
    }
    .production-page .prd-card {
        background: var(--prd-bg);
        border: 1px solid var(--prd-border);
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(8, 25, 52, .045);
        overflow: hidden;
    }
    .production-page .prd-heading {
        color: var(--prd-text) !important;
        font-weight: 700;
        font-size: 1.1rem;
        line-height: 1.4;
    }
    .production-page .prd-muted {
        color: var(--prd-muted) !important;
    }
    .production-page .prd-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        border-radius: 12px;
        background: var(--prd-subtle);
        color: var(--prd-active);
        font-size: 21px;
    }
    .production-page .prd-kpi {
        font-size: clamp(1.6rem, 2.2vw, 2.15rem);
        line-height: 1.2;
        letter-spacing: -.04em;
        font-weight: 750;
        color: var(--prd-text);
        font-variant-numeric: tabular-nums;
    }
    .production-page .prd-stat {
        padding: 12px 14px;
        background: var(--prd-subtle);
        border: 1px solid var(--prd-border);
        border-radius: 10px;
    }
    .production-page .prd-stat strong,
    .production-page .prd-value,
    .production-page .prd-hour,
    .production-page .prd-rate {
        color: var(--prd-text) !important;
        font-weight: 700;
        font-variant-numeric: tabular-nums;
    }
    .production-page .prd-progress {
        height: 14px;
        border-radius: 999px;
        background: var(--prd-track);
        overflow: hidden;
    }
    .production-page .prd-progress .progress-bar {
        border-radius: 999px;
        transition: width .2s ease;
    }
    .production-page .prd-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        border-bottom: 1px solid var(--prd-border);
        padding-bottom: 14px;
    }
    .production-page .prd-tabs .nav-link {
        color: var(--prd-text) !important;
        background: var(--prd-subtle);
        border: 1px solid var(--prd-border);
        border-radius: 9px;
        padding: 10px 15px;
        font-size: .9rem;
        font-weight: 650;
    }
    .production-page .prd-tabs .nav-link.active {
        background: var(--prd-active) !important;
        color: var(--prd-active-text) !important;
        border-color: var(--prd-active) !important;
    }
    .production-page .prd-hour-row {
        padding: 14px 0;
        border-bottom: 1px solid var(--prd-border);
    }
    .production-page .prd-hour-row:last-child {
        border-bottom: 0;
    }
    .production-page .prd-hour {
        font-size: .96rem;
        white-space: nowrap;
    }
    .production-page .prd-value {
        font-size: .9rem;
    }
    .production-page .prd-rate {
        font-size: .85rem;
        white-space: nowrap;
    }
    .production-page .prd-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border: 1px solid var(--prd-border);
        border-radius: 8px;
        background: var(--prd-subtle);
        color: var(--prd-text);
        font-size: .82rem;
        font-weight: 650;
    }
    .production-page .prd-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }
    .production-page .prd-empty {
        text-align: center;
        padding: 35px 12px;
        color: var(--prd-muted);
    }
    @media (max-width: 767.98px) {
        .production-page .prd-card .card-body { padding: 17px; }
        .production-page .prd-hour-row { padding: 12px 0; }
        .production-page .prd-tabs .nav-item { flex: 1; }
        .production-page .prd-tabs .nav-link { width: 100%; text-align: center; padding: 9px; }
    }
</style>

<div class="pc-container">
    <div class="pc-content production-page">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <div>
                <h4 class="prd-heading mb-1">Produksi Per Jam</h4>
            </div>
            <span class="prd-pill"><i class="ti ti-refresh"></i> Refresh otomatis 5 menit</span>
        </div>

        <div class="row g-3 align-items-start">
            <div class="col-xl-4 col-lg-5">
                <div class="card prd-card mb-0">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <span class="prd-icon"><i class="ti ti-chart-bar"></i></span>
                            <div>
                                <h5 class="prd-heading mb-0">Produksi Overburden</h5>
                            </div>
                        </div>

                        <div class="d-flex align-items-end justify-content-between gap-2 mb-2">
                            <div>
                                <div class="prd-muted small mb-1">Pencapaian</div>
                                <div class="prd-kpi">{{ number_format($percent, 2, ',', '.') }}%</div>
                            </div>
                        </div>
                        <div class="progress prd-progress mb-4" role="progressbar" aria-valuenow="{{ round($progressWidth, 2) }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ $progressWidth }}%; background-color: {{ $progressColor }};"></div>
                        </div>

                        <div class="row g-2">
                            <div class="col-sm-6 col-lg-12 col-xxl-6">
                                <div class="prd-stat h-100">
                                    <div class="prd-muted small mb-1">Actual</div>
                                    <strong>{{ number_format($actual, 0, ',', '.') }} BCM</strong>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12 col-xxl-6">
                                <div class="prd-stat h-100">
                                    <div class="prd-muted small mb-1">Plan</div>
                                    <strong>{{ number_format($plan, 0, ',', '.') }} BCM</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card prd-card mb-0">
                    <div class="card-body p-4">
                        <h5 class="prd-heading mb-3">Rincian Produksi per Jam</h5>
                        <ul class="nav nav-pills prd-tabs mb-3" role="tablist">
                            @foreach ($tabs as $index => $tab)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                            id="{{ $tab['id'] }}-tab"
                                            data-bs-toggle="pill"
                                            data-bs-target="#{{ $tab['id'] }}"
                                            type="button"
                                            role="tab"
                                            aria-controls="{{ $tab['id'] }}"
                                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                        {{ $tab['label'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach ($tabs as $index => $tab)
                                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                     id="{{ $tab['id'] }}"
                                     role="tabpanel"
                                     aria-labelledby="{{ $tab['id'] }}-tab"
                                     tabindex="0">
                                    @forelse (($data['kategori'][$tab['key']] ?? []) as $item)
                                        @php
                                            $hourActual = (float) ($item->PRODUCTION ?? 0);
                                            $hourPlan = (float) ($item->PLAN_PRODUCTION ?? 0);
                                            $hourPercent = $hourPlan > 0 ? $hourActual / $hourPlan * 100 : 0;
                                            $hourWidth = max(0, min($hourPercent, 100));
                                            $hourColor = $hourPercent < 65 ? '#dc5259' : ($hourPercent <= 85 ? '#d88c20' : ($hourPercent <= 100 ? '#16845b' : '#497fe5'));
                                        @endphp
                                        <div class="prd-hour-row">
                                            <div class="row g-2 align-items-center">
                                                <div class="col-3 col-md-2">
                                                    <span class="prd-hour">{{ str_pad((string) $item->HOUR, 2, '0', STR_PAD_LEFT) }}:00</span>
                                                </div>
                                                <div class="col-9 col-md-7">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="progress prd-progress flex-grow-1" role="progressbar" aria-label="Pencapaian pukul {{ $item->HOUR }}" aria-valuenow="{{ round($hourWidth, 2) }}" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar" style="width: {{ $hourWidth }}%; background-color: {{ $hourColor }};"></div>
                                                        </div>
                                                        <span class="prd-rate">{{ number_format($hourPercent, 2, ',', '.') }}%</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3 text-md-end ps-3 ps-md-0">
                                                    <div class="prd-value">{{ number_format($hourActual, 0, ',', '.') }} / {{ number_format($hourPlan, 0, ',', '.') }}</div>
                                                    <div class="prd-muted small">Distance: {{ number_format($item->HAUL_DISTANCE ?? 0, 2, ',', '.') }} km</div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="prd-empty">Belum ada data produksi untuk shift ini.</div>
                                    @endforelse
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-3" style="border-top: 1px solid var(--prd-border);">
                            <h6 class="prd-heading mb-3" style="font-size: .95rem;">Keterangan Pencapaian</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="prd-pill"><span class="prd-dot" style="background:#dc5259"></span> Di bawah 65%</span>
                                <span class="prd-pill"><span class="prd-dot" style="background:#d88c20"></span> 65–85%</span>
                                <span class="prd-pill"><span class="prd-dot" style="background:#16845b"></span> Di atas 85–100%</span>
                                <span class="prd-pill"><span class="prd-dot" style="background:#497fe5"></span> Di atas 100%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<script>
    setTimeout(function () {
        location.reload();
    }, 300000);

    function getUrutanJam(mode) {
        return mode === 'Malam'
            ? [19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5, 6]
            : [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
    }

    const categories = Array.from({length: 24}, (_, hour) => String(hour).padStart(2, '0') + ':00');
    const kategori = {
        Siang: categories.filter(time => Number(time.slice(0, 2)) >= 7 && Number(time.slice(0, 2)) <= 18),
        Malam: categories.filter(time => Number(time.slice(0, 2)) < 7 || Number(time.slice(0, 2)) >= 19)
    };
</script>
