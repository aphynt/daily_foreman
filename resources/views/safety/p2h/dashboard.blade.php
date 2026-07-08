@include('layout.head', ['title' => 'Dashboard P2H'])
@include('layout.sidebar')
@include('layout.header')

<style>
    :root {
        --p2h-primary: #16a34a;
        --p2h-primary-soft: #dcfce7;

        --p2h-success: #22c55e;
        --p2h-success-soft: #dcfce7;

        --p2h-warning: #f59e0b;
        --p2h-warning-soft: #fef3c7;

        --p2h-danger: #ef4444;
        --p2h-danger-soft: #fee2e2;

        --p2h-info: #16a34a;
        --p2h-info-soft: #dcfce7;

        --p2h-text: #0f172a;
        --p2h-subtext: #64748b;
        --p2h-border: #e2e8f0;
        --p2h-bg: #f8fafc;
        --p2h-card: #ffffff;

        --p2h-shadow: 0 10px 30px rgba(22,163,74,.10);
        --p2h-radius: 22px;
    }

    .pc-content {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 100vh;
    }

    .p2h-page-header {
        background: linear-gradient(
            135deg,
            #166534 0%,
            #16a34a 55%,
            #4ade80 100%
        );

        border-radius:28px;
        padding:28px;
        color:#fff;
        box-shadow:0 18px 40px rgba(22,163,74,.22);
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }

    .p2h-page-header::before,
    .p2h-page-header::after {
        content: '';
        position: absolute;
        border-radius: 999px;
        background: rgba(255,255,255,0.12);
    }

    .p2h-page-header::before {
        width: 220px;
        height: 220px;
        top: -70px;
        right: -60px;
    }

    .p2h-page-header::after {
        width: 140px;
        height: 140px;
        bottom: -50px;
        right: 120px;
    }

    .p2h-title {
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 6px;
        letter-spacing: 0.2px;
    }

    .p2h-subtitle {
        margin: 0;
        color: rgba(255,255,255,0.88);
        font-size: 0.95rem;
    }

    .p2h-stat-grid {
        margin-bottom: 24px;
    }

    .p2h-stat-card {
        background: var(--p2h-card);
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 24px;
        box-shadow: var(--p2h-shadow);
        padding: 20px;
        height: 100%;
        transition: all 0.25s ease;
    }

    .p2h-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.10);
    }

    .p2h-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .p2h-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 700;
    }

    .p2h-stat-label {
        font-size: 0.95rem;
        color: var(--p2h-subtext);
        margin-bottom: 4px;
    }

    .p2h-stat-value {
        font-size: 2rem;
        line-height: 1;
        font-weight: 800;
        color: var(--p2h-text);
        margin-bottom: 6px;
    }

    .p2h-stat-desc {
        font-size: 0.86rem;
        color: var(--p2h-subtext);
        margin: 0;
    }

    .icon-warning {
        background: var(--p2h-warning-soft);
        color: #b45309;
    }

    .icon-danger {
        background: var(--p2h-danger-soft);
        color: #b91c1c;
    }

    .icon-info {
        background:#dcfce7;
        color:#166534;
    }

    .p2h-section-card {
        background: var(--p2h-card);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: var(--p2h-radius);
        box-shadow: var(--p2h-shadow);
        overflow: hidden;
        height: 100%;
        min-height: 650px;
        display: flex;
        flex-direction: column;
    }

    .p2h-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--p2h-border);
        flex-shrink: 0;
    }

    .p2h-section-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .p2h-section-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
    }

    .p2h-section-title {
        font-size: 1.02rem;
        font-weight: 700;
        margin: 0;
        color: var(--p2h-text);
    }

    .p2h-section-subtitle {
        margin: 2px 0 0;
        font-size: 0.82rem;
        color: var(--p2h-subtext);
    }

    .p2h-badge-count {
        min-width: 38px;
        height: 38px;
        padding: 0 12px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.92rem;
    }

    .badge-warning-soft {
        background: var(--p2h-warning-soft);
        color: #92400e;
    }

    .badge-danger-soft {
        background: var(--p2h-danger-soft);
        color: #991b1b;
    }

    .badge-info-soft {
        background:#dcfce7;
        color:#166534;
    }

    .p2h-table-wrap {
        padding: 0 16px 16px 16px;
        flex: 1;
        min-height: 0;
    }

    .p2h-table-scroll {
        height: 600px;
        overflow-y: auto;
        overflow-x: hidden;
        position: relative;
    }

    .p2h-table-scroll::-webkit-scrollbar {
        width: 0;
        height: 0;
    }

    .p2h-table-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .p2h-table-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .p2h-table-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .p2h-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .p2h-table thead th {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--p2h-subtext);
        border: none !important;
        padding: 14px 14px 4px 14px;
        background: #fff !important;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    @media (max-width: 767.98px) {
        .p2h-table-scroll {
            height: 600px;
        }
    }

    .p2h-table tbody tr {
        background: #f8fafc;
        transition: all 0.2s ease;
    }

    .p2h-table tbody tr:hover {
        background: #f1f5f9;
    }

    .p2h-table tbody td {
        vertical-align: middle;
        border-top: 1px solid #eef2f7 !important;
        border-bottom: 1px solid #eef2f7 !important;
        font-size: 0.92rem;
        color: var(--p2h-text);
    }

    .p2h-table tbody td:first-child {
        border-left: 1px solid #eef2f7 !important;
        border-top-left-radius: 14px;
        border-bottom-left-radius: 14px;
        width: 32%;
        font-weight: 700;
        color: #334155;
    }

    .p2h-table tbody td:last-child {
        border-right: 1px solid #eef2f7 !important;
        border-top-right-radius: 14px;
        border-bottom-right-radius: 14px;
    }

    .p2h-nik {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        background: #eef2ff;
        color: #3730a3;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .p2h-empty {
        text-align: center;
        padding: 34px 18px !important;
        background: transparent !important;
        border: none !important;
    }

    .p2h-empty-box {
        border: 1px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 18px;
        padding: 24px 16px;
    }

    .p2h-empty-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 12px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e2e8f0;
        color: #475569;
        font-weight: 700;
        font-size: 20px;
    }

    .p2h-empty-title {
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--p2h-text);
        margin-bottom: 4px;
    }

    .p2h-empty-text {
        margin: 0;
        color: var(--p2h-subtext);
        font-size: 0.87rem;
    }

    .p2h-footer-note {
        margin-top: 18px;
        font-size: 0.82rem;
        color: var(--p2h-subtext);
        text-align: right;
    }

    @media (max-width: 767.98px) {
        .p2h-table-scroll {
            height: 260px;
        }
    }
</style>

@php
    $jumlahSudahDiverifikasi = $sudahVerifikasi->count();
    $jumlahTemuanUnit = $notOk->count();
    $jumlahBelumDiverifikasi = $belumVerifikasi->count();
    $totalKasus = $jumlahBelumDiverifikasi + $jumlahTemuanUnit;
@endphp

<section class="pc-container">
    <div class="pc-content">
        <div class="p2h-page-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="p2h-title">Dashboard Pemeriksaan dan Perawatan Harian (P2H)</div>
                    <p class="p2h-subtitle">
                        Monitoring status verifikasi dan temuan hasil pemeriksaan P2H
                    </p>
                </div>
                <div class="col-lg-4 mt-3 mt-lg-0 text-lg-end">
                    <div style="font-size: .85rem; color: rgba(255,255,255,.85);">Total Temuan dan P2H Belum Diverifikasi Hari Ini</div>
                    <div style="font-size: 2.2rem; font-weight: 800; line-height: 1;">{{ $totalKasus }}</div>
                </div>
            </div>
        </div>

        <div class="row p2h-stat-grid g-3">
            <div class="col-md-4">
                <div class="p2h-stat-card">
                    <div class="p2h-stat-top">
                        <div>
                            <div class="p2h-stat-label">Belum Diverifikasi</div>
                            <div class="p2h-stat-value">{{ $jumlahBelumDiverifikasi }}</div>
                        </div>
                        <div class="p2h-stat-icon icon-warning">!</div>
                    </div>
                    <p class="p2h-stat-desc">Jumlah data P2H yang masih menunggu verifikasi oleh pengawas</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p2h-stat-card">
                    <div class="p2h-stat-top">
                        <div>
                            <div class="p2h-stat-label">Unit dengan Temuan</div>
                            <div class="p2h-stat-value">{{ $jumlahTemuanUnit }}</div>
                        </div>
                        <div class="p2h-stat-icon icon-danger">×</div>
                    </div>
                    <p class="p2h-stat-desc">Jumlah unit yang memiliki temuan berkategori A atau AA</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p2h-stat-card">
                    <div class="p2h-stat-top">
                        <div>
                            <div class="p2h-stat-label">Sudah Diverifikasi</div>
                            <div class="p2h-stat-value">{{ $jumlahSudahDiverifikasi }}</div>
                        </div>
                        <div class="p2h-stat-icon icon-info">✓</div>
                    </div>
                    <p class="p2h-stat-desc">Jumlah data P2H yang telah diverifikasi oleh pengawas</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-xl-4 col-md-6">
                <div class="p2h-section-card">
                    <div class="p2h-section-header">
                        <div class="p2h-section-title-wrap">
                            <div class="p2h-section-icon icon-warning">!</div>
                            <div>
                                <h5 class="p2h-section-title">Belum Diverifikasi</h5>
                                <p class="p2h-section-subtitle">Menunggu verifikasi oleh pengawas</p>
                            </div>
                        </div>
                        <div class="p2h-badge-count badge-warning-soft">{{ $jumlahBelumDiverifikasi }}</div>
                    </div>

                    <div class="p2h-table-wrap">
                        <div class="p2h-table-scroll auto-scroll">
                            <div class="table-responsive">
                                <table class="table p2h-table">
                                    <thead>
                                        <tr>
                                            <th>Vehicle</th>
                                            <th>NIK Operator</th>
                                            <th>Nama Operator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($belumVerifikasi as $item)
                                            <tr>
                                                <td><span class="p2h-nik">{{ $item->VHC_ID }}</span></td>
                                                <td>{{ $item->OPR_NRP }}</td>
                                                <td>{{ $item->PERSONALNAME }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="p2h-empty">
                                                    <div class="p2h-empty-box">
                                                        <div class="p2h-empty-icon">✓</div>
                                                        <div class="p2h-empty-title">Tidak ada data</div>
                                                        <p class="p2h-empty-text">Semua data sudah diverifikasi.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="p2h-section-card">
                    <div class="p2h-section-header">
                        <div class="p2h-section-title-wrap">
                            <div class="p2h-section-icon icon-danger">×</div>
                            <div>
                                <h5 class="p2h-section-title">Temuan</h5>
                                <p class="p2h-section-subtitle">Unit dengan temuan berkategori A atau AA</p>
                            </div>
                        </div>
                        <div class="p2h-badge-count badge-danger-soft">{{ $jumlahTemuanUnit }}</div>
                    </div>

                    <div class="p2h-table-wrap">
                        <div class="p2h-table-scroll auto-scroll">
                            <div class="table-responsive">
                                <table class="table p2h-table">
                                    <thead>
                                        <tr>
                                            <th>Vehicle</th>
                                            <th>NIK Operator</th>
                                            <th>Nama Operator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($notOk as $item)
                                            <tr>
                                                <td><span class="p2h-nik">{{ $item->VHC_ID }}</span></td>
                                                <td>{{ $item->OPR_NRP }}</td>
                                                <td>{{ $item->PERSONALNAME }}</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="p2h-empty">
                                                    <div class="p2h-empty-box">
                                                        <div class="p2h-empty-icon">✓</div>
                                                        <div class="p2h-empty-title">Tidak ada data</div>
                                                        <p class="p2h-empty-text">Tidak ada karyawan unfit hari ini.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-12">
                <div class="p2h-section-card">
                    <div class="p2h-section-header">
                        <div class="p2h-section-title-wrap">
                            <div class="p2h-section-icon icon-info">zZ</div>
                            <div>
                                <h5 class="p2h-section-title">Sudah Diverifikasi</h5>
                                <p class="p2h-section-subtitle">Telah diverifikasi oleh pengawas</p>
                            </div>
                        </div>
                        <div class="p2h-badge-count badge-info-soft">{{ $jumlahSudahDiverifikasi }}</div>
                    </div>

                    <div class="p2h-table-wrap">
                        <div class="p2h-table-scroll auto-scroll">
                            <div class="table-responsive">
                                <table class="table p2h-table">
                                    <thead>
                                        <tr>
                                            <th>Vehicle</th>
                                            <th>NIK Operator</th>
                                            <th>Nama Operator</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sudahVerifikasi as $item)
                                            <tr>
                                                <td><span class="p2h-nik">{{ $item->VHC_ID }}</span></td>
                                                <td>{{ $item->OPR_NRP }}</td>
                                                <td>{{ $item->PERSONALNAME }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="p2h-empty">
                                                    <div class="p2h-empty-box">
                                                        <div class="p2h-empty-icon">✓</div>
                                                        <div class="p2h-empty-title">Tidak ada data</div>
                                                        <p class="p2h-empty-text">Tidak ada karyawan dengan tidur kurang dari 6 jam.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="p2h-footer-note">
            Auto refresh setiap 5 menit
        </div>
    </div>
</section>

@include('layout.footer')

<script>
    setTimeout(function () {
        location.reload();
    }, 300000);
</script>
<script>
    function initAutoScroll() {
        const scrollBoxes = document.querySelectorAll('.auto-scroll');

        scrollBoxes.forEach((box) => {
            let direction = 1; // 1 = turun, -1 = naik
            let isPaused = false;
            let interval = null;
            let pauseTimeout = null;

            function getMaxScroll() {
                return box.scrollHeight - box.clientHeight;
            }

            function startScroll() {
                if (interval) clearInterval(interval);

                interval = setInterval(() => {
                    const maxScroll = getMaxScroll();

                    if (maxScroll <= 0 || isPaused) return;

                    box.scrollTop += direction * 1; // pakai angka bulat, jangan 0.3

                    if (box.scrollTop >= maxScroll) {
                        box.scrollTop = maxScroll;
                        direction = -1;
                        isPaused = true;

                        clearTimeout(pauseTimeout);
                        pauseTimeout = setTimeout(() => {
                            isPaused = false;
                        }, 1200);
                    }

                    if (box.scrollTop <= 0) {
                        box.scrollTop = 0;
                        direction = 1;
                        isPaused = true;

                        clearTimeout(pauseTimeout);
                        pauseTimeout = setTimeout(() => {
                            isPaused = false;
                        }, 1200);
                    }
                }, 25); // makin besar = makin pelan
            }

            box.addEventListener('mouseenter', function () {
                isPaused = true;
            });

            box.addEventListener('mouseleave', function () {
                isPaused = false;
            });

            startScroll();
        });
    }

    window.addEventListener('load', function () {
        initAutoScroll();
    });
</script>
