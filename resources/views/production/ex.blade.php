@include('layout.head', ['title' => 'Produksi EX Per Jam'])
@include('layout.sidebar')
@include('layout.header')
<script src="{{ asset('dashboard/assets') }}/js/plugins/chart.js"></script>
<style>
    .pc-content {
        --ex-text: #111111;
        --ex-muted: #333333;
        --ex-surface: #ffffff;
        --ex-subtle: #f1f5f9;
        --ex-border: #dce3eb;
        --ex-track: #e2e8f0;
        --ex-accent: #2563eb;
    }
    .pc-content .card {
        border: 1px solid var(--ex-border);
        border-radius: 12px;
        background: var(--ex-surface);
        box-shadow: 0 2px 10px rgba(15,23,42,.035);
    }
    .pc-content .card-header {
        background: transparent;
        border-bottom: 1px solid var(--ex-border);
        padding: 16px 20px;
    }
    .pc-content .card-body {
        padding: 20px;
    }
    .pc-content h5, .pc-content h6, .pc-content .chart-title, .pc-content .kpi-time {
        color: var(--ex-text) !important;
        font-weight: 700;
    }
    .pc-content {
        color: var(--ex-text);
    }
    .pc-content p,
    .pc-content label,
    .pc-content span:not(.progress-bar):not(.badge),
    .pc-content small,
    .pc-content .kpi-item,
    .pc-content .accordion-body,
    .pc-content .text-body,
    .pc-content .text-secondary,
    .pc-content .text-muted {
        color: var(--ex-text) !important;
    }
    .pc-content .text-success, .pc-content .kpi-value {
        color: var(--ex-text) !important;
        font-weight: 700;
    }
    .pc-content .btn-link-secondary {
        color: var(--ex-text) !important;
        background: var(--ex-subtle);
        border: 1px solid var(--ex-border);
        border-radius: 9px;
        text-decoration: none;
        cursor: default;
    }
    .pc-content .badge.bg-light-dark {
        color: var(--ex-text) !important;
        background: var(--ex-surface) !important;
        font-size: 13px;
        padding: 8px 11px;
    }
    .pc-content .progress {
        background: var(--ex-track);
        border-radius: 8px;
        overflow: hidden;
    }
    .pc-content .nav-pills .nav-link.active,
    .pc-content .progress-bar,
    .pc-content .btn-primary,
    .pc-content .btn-primary span {
        color: #ffffff !important;
    }
    .pc-content .progress-bar {
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        white-space: nowrap;
    }
    .pc-content .accordion-item {
        background: var(--ex-surface);
        border: 1px solid var(--ex-border) !important;
        border-radius: 10px !important;
        overflow: hidden;
    }
    .pc-content .accordion-button {
        background: var(--ex-subtle);
        color: var(--ex-text);
        font-size: 14px;
        box-shadow: none;
        padding: 14px 16px;
    }
    .pc-content .accordion-button:not(.collapsed) {
        background: rgba(37,99,235,.11);
        color: var(--ex-text) !important;
        box-shadow: none;
    }
    .pc-content .accordion-button,
    .pc-content .accordion-button:hover,
    .pc-content .accordion-button:focus,
    .pc-content .accordion-button:not(.collapsed),
    .pc-content .accordion-header .accordion-button {
        color: var(--ex-text) !important;
    }
    .pc-content .accordion-button .fw-semibold,
    .pc-content .accordion-body .kpi-desktop,
    .pc-content .accordion-body .kpi-time,
    .pc-content .accordion-body .kpi-value {
        color: var(--ex-text) !important;
    }
    .pc-content .accordion-button:focus {
        box-shadow: 0 0 0 2px rgba(37,99,235,.22);
    }
    .pc-content .accordion-button::after {
        filter: none;
    }
    .pc-content .nav-pills {
        gap: 8px;
    }
    .pc-content .nav-pills .nav-link {
        color: var(--ex-text);
        background: var(--ex-subtle);
        border: 1px solid var(--ex-border);
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 13px;
    }
    .pc-content .nav-pills .nav-link.active {
        background: var(--ex-accent);
        border-color: var(--ex-accent);
        color: #fff;
    }
    .pc-content .form-control {
        color: var(--ex-text);
        background: var(--ex-surface);
        border-color: var(--ex-border);
        min-height: 38px;
    }
    .pc-content .kpi-mobile {
        display: none;
    }
    .pc-content .kpi-desktop {
        display: block;
    }
    .pc-content .kpi-mobile-item {
        background: var(--ex-subtle);
        border: 1px solid var(--ex-border);
        border-radius: 9px;
        padding: 12px;
    }
    .pc-content .kpi-time {
        font-size: 14px;
        margin-bottom: 8px;
    }
    .pc-content .kpi-value {
        margin-top: 8px;
        font-size: 13px;
    }
    .pc-content .kpi-progress .progress {
        height: 18px;
    }
    .pc-content .kpi-item {
        padding: 2px 0;
    }
    .pc-content .chart-panel {
        background: var(--ex-subtle);
        border: 1px solid var(--ex-border);
        border-radius: 10px;
        padding: 16px;
    }
    .pc-content .chart-dark canvas {
        background: transparent;
    }
    .staging-img {
        max-width: 100%;
        object-fit: contain;
    }
    [data-pc-theme="dark"] .pc-content, [data-bs-theme="dark"] .pc-content, body.dark .pc-content, body[data-theme="dark"] .pc-content, .dark-theme .pc-content {
        --ex-text: #ffffff;
        --ex-muted: #ffffff;
        --ex-surface: #202936;
        --ex-subtle: #2a3647;
        --ex-border: #405066;
        --ex-track: #405066;
        --ex-accent: #7fb0ff;
    }
    [data-pc-theme="dark"] .pc-content .accordion-button::after, [data-bs-theme="dark"] .pc-content .accordion-button::after, body.dark .pc-content .accordion-button::after {
        filter: invert(1);
    }
    [data-pc-theme="dark"] .pc-content .nav-pills .nav-link.active, [data-bs-theme="dark"] .pc-content .nav-pills .nav-link.active, body.dark .pc-content .nav-pills .nav-link.active {
        background: #3165c6;
        color: #fff;
        border-color: #3165c6;
    }
    @media (max-width: 767px) {
        .pc-content .kpi-desktop {
            display: none;
        }
        .pc-content .kpi-mobile {
            display: block;
        }
        .pc-content .card-body {
            padding: 14px;
        }
        .pc-content .card-header {
            padding: 14px;
        }
        .pc-content .nav-pills .nav-link {
            font-size: 12px;
            padding: 8px 10px;
        }
        .pc-content .accordion-body {
            padding: 12px;
        }
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <form method="GET" class="mb-3">
                <div class="input-group" style="max-width:300px">
                    <input
                        type="date"
                        class="form-control form-control-sm"
                        name="tanggal"
                        value="{{ request('tanggal', now()->format('Y-m-d')) }}"
                    >
                    <button type="submit" class="btn btn-primary btn-sm">
                        Tampilkan
                    </button>
                </div>
            </form>
            <div class="col-xl-6 col-md-6 mt-2">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center my-3">
                            <div class="flex-shrink-0">
                                <div class="avtar avtar-s bg-light-success">
                                    <i class="ti ti-list-check f-20"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-0">Produksi Overburden</h5>
                            </div>
                        </div>
                        <div class="my-3">
                            <p class="mb-2">
                                Pencapaian Produksi
                                <span class="float-end">
                                    {{ number_format($data['plan'] != 0 ? ($data['actual'] / $data['plan']) * 100 : 0, 2) }}%
                                </span>
                            </p>
                            @php
                                $percent = $data['plan'] != 0
                                    ? ($data['actual'] / $data['plan']) * 100
                                    : 0;
                                if ($percent < 65) {
                                    $color = '#fb8078';
                                } elseif ($percent <= 85) {
                                    $color = '#ffa500';
                                } elseif ($percent <= 100) {
                                    $color = '#039201';
                                } else {
                                    $color = '#4e7be6';
                                }
                                $percentFormatted = number_format($percent, 2);
                                $width = min($percent, 100);
                            @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar"
                                    role="progressbar"
                                    style="width: {{ $percent > 0 ? max(12, $width) : 0 }}%; background-color: {{ $color }};"
                                    aria-valuenow="{{ $percentFormatted }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ $percentFormatted }}%
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-3">
                            <div class="btn btn-link-secondary">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 mx-2 text-start">Actual</div>
                                    <div class="badge bg-light-dark">
                                        {{ number_format($data['actual'], 0, ',', '.') }} BCM
                                    </div>
                                </div>
                            </div>
                            <div class="btn btn-link-secondary">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 mx-2 text-start">Plan</div>
                                    <div class="badge bg-light-dark">
                                        {{ number_format($data['plan'], 0, ',', '.') }} BCM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                            $perExAktif = collect($data['kategori']['PerExAktif']);
                            $perExHistory = collect($data['kategori']['PerExHistory']);
                            $allExIds = $data['kategori']['OrderedExIds'];
                            $perExAktifGrouped   = collect($data['kategori']['PerExAktif'])->groupBy('LOD_LOADERID');
                            $perExHistoryGrouped = collect($data['kategori']['PerExHistory'])->groupBy('LOD_LOADERID');
                            $jamSiang = [7,8,9,10,11,12,13,14,15,16,17,18];
                            $jamMalam = [19,20,21,22,23,0,1,2,3,4,5,6];
                            $chartExLabels = [];
                            $chartExProd   = [];
                            $chartExPlan   = [];
                            $grouped = collect($data['kategori']['PerExAktif'])
                                ->groupBy('LOD_LOADERID');
                            foreach ($allExIds as $ex) {
                                $rows = collect($grouped->get($ex, []));
                                $chartExLabels[] = $ex;
                                $chartExProd[] = round($rows->sum('PRODUCTION'));
                                $chartExPlan[] = round($rows->sum('PLAN_PRODUCTION'));
                            }
                            @endphp
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const labels   = @json($chartExLabels);
                                    const actual  = @json($chartExProd);
                                    const plan    = @json($chartExPlan);
                                    const ctx = document.getElementById('chartPerExca');
                                    if (!ctx) return;
                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels,
                                            datasets: [
                                                {
                                                    label: 'Actual',
                                                    data: actual,
                                                    backgroundColor: '#00b050',
                                                    borderRadius: 6,
                                                    barThickness: 22,
                                                    barThickness: 15,
                                                    maxBarThickness: 22
                                                }
                                            ]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            layout: { padding: { top: 24 } },
                                            plugins: {
                                                legend: {
                                                    labels: {
                                                        color: '#e5e7eb',
                                                        font: { weight: '600' }
                                                    }
                                                },
                                                tooltip: {
                                                    backgroundColor: '#111',
                                                    titleColor: '#fff',
                                                    bodyColor: '#fff',
                                                    padding: 8,
                                                    callbacks: {
                                                        label: c => ` ${c.raw}`
                                                    }
                                                }
                                            },
                                            scales: {
                                                x: {
                                                    ticks: {
                                                        color: '#d1d5db',
                                                        font: { size: 11, weight: '600' }
                                                    },
                                                    grid: {
                                                        color: 'rgba(255,255,255,.08)'
                                                    }
                                                },
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        color: '#9ca3af',
                                                        font: { size: 11 }
                                                    },
                                                    grid: {
                                                        color: 'rgba(255,255,255,.08)'
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'BCM',
                                                        color: '#9ca3af'
                                                    }
                                                }
                                            }
                                        },
                                        plugins: [{
                                            id: 'valueBox',
                                            afterDatasetsDraw(chart) {
                                                const { ctx } = chart;
                                                ctx.save();
                                                ctx.font = '10px Arial';
                                                ctx.textAlign = 'center';
                                                chart.data.datasets.forEach((ds, di) => {
                                                    const meta = chart.getDatasetMeta(di);
                                                    meta.data.forEach((bar, i) => {
                                                        const val = ds.data[i];
                                                        if (!val) return;
                                                        const x = bar.x;
                                                        const y = bar.y - 6;
                                                        ctx.fillStyle = '#fff';
                                                        ctx.fillRect(x - 16, y - 14, 32, 14);
                                                        ctx.fillStyle = '#000';
                                                        ctx.fillText(val, x, y - 3);
                                                    });
                                                });
                                                ctx.restore();
                                            }
                                        }]
                                    });
                                });
                            </script>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Productivity EXCA</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionPerExShift">
                        @foreach ($allExIds as $ex)
                            @php
                                $exVal = trim((string)$ex);
                            @endphp
                            @if ($exVal === '' || strtoupper($exVal) === 'NULL')
                                @continue
                            @endif
                            @php
                                $rowsAktif   = collect($perExAktifGrouped->get($ex, []));
                                $rowsHistory = collect($perExHistoryGrouped->get($ex, []));
                                $siangAktif = []; $malamAktif = [];
                                $siangHist  = []; $malamHist  = [];
                                foreach ($rowsAktif as $r) {
                                    $h = (int) $r->HOUR;
                                    if ($h >= 7 && $h <= 18) $siangAktif[] = $r;
                                    else $malamAktif[] = $r;
                                }
                                foreach ($rowsHistory as $r) {
                                    $h = (int) $r->HOUR;
                                    if ($h >= 7 && $h <= 18) $siangHist[] = $r;
                                    else $malamHist[] = $r;
                                }
                                $collapseId = 'collapse_ex_'.$loop->index;
                                $paneSiang  = 'pane_siang_'.$loop->index;
                                $paneMalam  = 'pane_malam_'.$loop->index;
                            @endphp
                            <div class="accordion-item mb-3 border rounded">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-semibold"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $collapseId }}">
                                        {{ $exVal }}
                                    </button>
                                </h2>
                                <div id="{{ $collapseId }}" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <ul class="nav nav-pills mb-3">
                                            @if ($data['waktu']=='Siang')
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="pill"
                                                    href="#{{ $paneSiang }}">Shift Siang</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="pill"
                                                    href="#{{ $paneMalam }}">History Shift Malam</a>
                                                </li>
                                            @else
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="pill"
                                                    href="#{{ $paneMalam }}">Shift Malam</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="pill"
                                                    href="#{{ $paneSiang }}">History Shift Siang</a>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="tab-content">
                                        <div class="tab-pane fade @if($data['waktu']=='Siang') show active @endif"
                                            id="{{ $paneSiang }}">
                                        @php
                                        $rows = $data['waktu']=='Siang' ? $siangAktif : $siangHist;
                                        $map  = collect($rows)->keyBy(fn($r)=>(int)$r->HOUR);
                                        @endphp
                                        @foreach ($jamSiang as $h)
                                            @php
                                            $item = $map->get($h);
                                            $prod = $item->PRODUCTION ?? 0;
                                            $plan = $item->PLAN_PRODUCTION ?? 0;
                                            $percent = $plan > 0 ? ($prod/$plan)*100 : 0;
                                            if ($percent < 65) $color = '#fb8078';
                                            elseif ($percent <= 85) $color = '#ffa500';
                                            elseif ($percent <= 100) $color = '#039201';
                                            else $color = '#4e7be6';
                                            @endphp
                                            <div class="kpi-item">
                                                <div class="kpi-desktop">
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-2 text-nowrap">
                                                            {{ str_pad($h,2,'0',STR_PAD_LEFT) }}:00
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="progress" style="height:18px">
                                                                <div class="progress-bar"
                                                                    style="width: {{ $percent > 0 ? min(max($percent, 12), 100) : 0 }}%;
                                                                            background: {{ $color }}">
                                                                    {{ number_format($percent,2) }}%
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-end text-success">
                                                            {{ round($prod) }} / {{ round($plan) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kpi-mobile">
                                                    <div class="kpi-mobile-item mb-3">
                                                        <div class="kpi-time">
                                                            {{ str_pad($h,2,'0',STR_PAD_LEFT) }}:00
                                                        </div>
                                                        <div class="kpi-progress">
                                                            <div class="progress">
                                                                <div class="progress-bar"
                                                                    style="width: {{ $percent > 0 ? min(max($percent, 12), 100) : 0 }}%;
                                                                            background: {{ $color }}">
                                                                    {{ number_format($percent,2) }}%
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="kpi-value">
                                                            {{ round($prod) }} / {{ round($plan) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        <div class="tab-pane fade @if($data['waktu']=='Malam') show active @endif"
                                            id="{{ $paneMalam }}">
                                        @php
                                        $rows = $data['waktu']=='Malam' ? $malamAktif : $malamHist;
                                        $map  = collect($rows)->keyBy(fn($r)=>(int)$r->HOUR);
                                        @endphp
                                        @foreach ($jamMalam as $h)
                                        @php
                                        $item = $map->get($h);
                                        $prod = $item->PRODUCTION ?? 0;
                                        $plan = $item->PLAN_PRODUCTION ?? 0;
                                        $percent = $plan > 0 ? ($prod/$plan)*100 : 0;
                                        if ($percent < 65) $color = '#fb8078';
                                        elseif ($percent <= 85) $color = '#ffa500';
                                        elseif ($percent <= 100) $color = '#039201';
                                        else $color = '#4e7be6';
                                        @endphp
                                        <div class="kpi-item">
                                                <div class="kpi-desktop">
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-2 text-nowrap">
                                                            {{ str_pad($h,2,'0',STR_PAD_LEFT) }}:00
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="progress" style="height:18px">
                                                                <div class="progress-bar"
                                                                    style="width: {{ $percent > 0 ? min(max($percent, 12), 100) : 0 }}%;
                                                                            background: {{ $color }}">
                                                                    {{ number_format($percent,2) }}%
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-end text-success">
                                                            {{ round($prod) }} / {{ round($plan) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kpi-mobile">
                                                    <div class="kpi-mobile-item mb-3">
                                                        <div class="kpi-time">
                                                            {{ str_pad($h,2,'0',STR_PAD_LEFT) }}:00
                                                        </div>
                                                        <div class="kpi-progress">
                                                            <div class="progress">
                                                                <div class="progress-bar"
                                                                    style="width: {{ $percent > 0 ? min(max($percent, 12), 100) : 0 }}%;
                                                                            background: {{ $color }}">
                                                                    {{ number_format($percent,2) }}%
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="kpi-value">
                                                            {{ round($prod) }} / {{ round($plan) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="row">
                            <h6>Keterangan:</h6>
                            <div class="col-6 col-sm-4 col-md-3 mb-4">
                                <div class="progress" style="height: 20px">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: 100%;background-color:#fb8078" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100">
                                        < 65%</div> </div> </div> <div class="col-6 col-sm-4 col-md-3 mb-4">
                                            <div class="progress" style="height: 20px">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 100%;background-color:#ffa500" aria-valuenow="100"
                                                    aria-valuemin="0" aria-valuemax="100">65 s/d 85 (%)</div>
                                            </div>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-3 mb-4">
                                        <div class="progress" style="height: 20px">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: 100%;background-color:#039201" aria-valuenow="100"
                                                aria-valuemin="0" aria-valuemax="100">86 s/d 100 (%)</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-3 mb-4">
                                        <div class="progress" style="height: 20px">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: 100%;background-color:#4e7be6" aria-valuenow="100"
                                                aria-valuemin="0" aria-valuemax="100">> 100 (%)</div>
                                        </div>
                                    </div>
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
    (function () {
        const datepickerElement = document.querySelector('#pc-datepicker-10');
        if (datepickerElement && typeof DateRangePicker !== 'undefined') new DateRangePicker(datepickerElement, {
            buttonClass: 'btn'
        });
    })();
</script>
    <script>
        setTimeout(function () {
            location.reload();
        }, 300000);
    </script>
    <script>
        function getUrutanJam(mode) {
            if (mode === 'Malam') {
                return [19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5, 6];
            }
            return [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
        }
    </script>
    <script>
        "use strict";
        const categories = [
            "00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00",
            "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00",
            "22:00", "23:00"
        ];
        const kategori = {
            "Siang": [],
            "Malam": []
        };
        categories.forEach(time => {
            const hour = parseInt(time.split(":")[0]);
            if (hour >= 7 && hour <= 18) {
                kategori.Siang.push(time);
            } else {
                kategori.Malam.push(time);
            }
        });
    </script>
