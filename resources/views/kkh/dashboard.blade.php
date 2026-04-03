@include('layout.head', ['title' => 'Dashboard KKH'])
@include('layout.sidebar')
@include('layout.header')

<style>
    :root {
        --kkh-primary: #2563eb;
        --kkh-primary-soft: #dbeafe;
        --kkh-warning: #f59e0b;
        --kkh-warning-soft: #fef3c7;
        --kkh-danger: #ef4444;
        --kkh-danger-soft: #fee2e2;
        --kkh-info: #3b82f6;
        --kkh-info-soft: #dbeafe;
        --kkh-text: #0f172a;
        --kkh-subtext: #64748b;
        --kkh-border: #e2e8f0;
        --kkh-bg: #f8fafc;
        --kkh-card: #ffffff;
        --kkh-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        --kkh-radius: 22px;
    }

    .pc-content {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 100vh;
    }

    .kkh-page-header {
        background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 55%, #60a5fa 100%);
        border-radius: 28px;
        padding: 28px;
        color: #fff;
        box-shadow: 0 18px 40px rgba(37, 99, 235, 0.22);
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .kkh-page-header::before,
    .kkh-page-header::after {
        content: '';
        position: absolute;
        border-radius: 999px;
        background: rgba(255,255,255,0.12);
    }

    .kkh-page-header::before {
        width: 220px;
        height: 220px;
        top: -70px;
        right: -60px;
    }

    .kkh-page-header::after {
        width: 140px;
        height: 140px;
        bottom: -50px;
        right: 120px;
    }

    .kkh-title {
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 6px;
        letter-spacing: 0.2px;
    }

    .kkh-subtitle {
        margin: 0;
        color: rgba(255,255,255,0.88);
        font-size: 0.95rem;
    }

    .kkh-stat-grid {
        margin-bottom: 24px;
    }

    .kkh-stat-card {
        background: var(--kkh-card);
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 24px;
        box-shadow: var(--kkh-shadow);
        padding: 20px;
        height: 100%;
        transition: all 0.25s ease;
    }

    .kkh-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.10);
    }

    .kkh-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .kkh-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 700;
    }

    .kkh-stat-label {
        font-size: 0.95rem;
        color: var(--kkh-subtext);
        margin-bottom: 4px;
    }

    .kkh-stat-value {
        font-size: 2rem;
        line-height: 1;
        font-weight: 800;
        color: var(--kkh-text);
        margin-bottom: 6px;
    }

    .kkh-stat-desc {
        font-size: 0.86rem;
        color: var(--kkh-subtext);
        margin: 0;
    }

    .icon-warning {
        background: var(--kkh-warning-soft);
        color: #b45309;
    }

    .icon-danger {
        background: var(--kkh-danger-soft);
        color: #b91c1c;
    }

    .icon-info {
        background: var(--kkh-info-soft);
        color: #1d4ed8;
    }

    .kkh-section-card {
        background: var(--kkh-card);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: var(--kkh-radius);
        box-shadow: var(--kkh-shadow);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .kkh-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--kkh-border);
        flex-shrink: 0;
    }

    .kkh-section-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kkh-section-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
    }

    .kkh-section-title {
        font-size: 1.02rem;
        font-weight: 700;
        margin: 0;
        color: var(--kkh-text);
    }

    .kkh-section-subtitle {
        margin: 2px 0 0;
        font-size: 0.82rem;
        color: var(--kkh-subtext);
    }

    .kkh-badge-count {
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
        background: var(--kkh-warning-soft);
        color: #92400e;
    }

    .badge-danger-soft {
        background: var(--kkh-danger-soft);
        color: #991b1b;
    }

    .badge-info-soft {
        background: var(--kkh-info-soft);
        color: #1d4ed8;
    }

    .kkh-table-wrap {
        padding: 0 16px 16px 16px;
        flex: 1;
        min-height: 0;
    }

    .kkh-table-scroll {
        height: 400px;
        overflow-y: auto;
        overflow-x: hidden;
        position: relative;
    }

    .kkh-table-scroll::-webkit-scrollbar {
        width: 0;
        height: 0;
    }

    .kkh-table-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .kkh-table-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .kkh-table-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .kkh-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .kkh-table thead th {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--kkh-subtext);
        border: none !important;
        padding: 14px 14px 4px 14px;
        background: #fff !important;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    @media (max-width: 767.98px) {
        .kkh-table-scroll {
            height: 260px;
        }
    }

    .kkh-table tbody tr {
        background: #f8fafc;
        transition: all 0.2s ease;
    }

    .kkh-table tbody tr:hover {
        background: #f1f5f9;
    }

    .kkh-table tbody td {
        vertical-align: middle;
        border-top: 1px solid #eef2f7 !important;
        border-bottom: 1px solid #eef2f7 !important;
        font-size: 0.92rem;
        color: var(--kkh-text);
    }

    .kkh-table tbody td:first-child {
        border-left: 1px solid #eef2f7 !important;
        border-top-left-radius: 14px;
        border-bottom-left-radius: 14px;
        width: 32%;
        font-weight: 700;
        color: #334155;
    }

    .kkh-table tbody td:last-child {
        border-right: 1px solid #eef2f7 !important;
        border-top-right-radius: 14px;
        border-bottom-right-radius: 14px;
    }

    .kkh-nik {
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

    .kkh-empty {
        text-align: center;
        padding: 34px 18px !important;
        background: transparent !important;
        border: none !important;
    }

    .kkh-empty-box {
        border: 1px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 18px;
        padding: 24px 16px;
    }

    .kkh-empty-icon {
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

    .kkh-empty-title {
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--kkh-text);
        margin-bottom: 4px;
    }

    .kkh-empty-text {
        margin: 0;
        color: var(--kkh-subtext);
        font-size: 0.87rem;
    }

    .kkh-footer-note {
        margin-top: 18px;
        font-size: 0.82rem;
        color: var(--kkh-subtext);
        text-align: right;
    }

    @media (max-width: 767.98px) {
        .kkh-table-scroll {
            height: 260px;
        }
    }
</style>

@php
    $jumlahBelumDiverifikasi = $kkhBelumDiverifikasi->count();
    $jumlahUnfit = $kkhUnfit->count();
    $jumlahTidurKurang = $kkhdibawah6Jam->count();
    $totalKasus = $jumlahBelumDiverifikasi + $jumlahUnfit + $jumlahTidurKurang;
@endphp

<section class="pc-container">
    <div class="pc-content">
        <div class="kkh-page-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="kkh-title">Dashboard Kesiapan Kerja Harian (KKH)</div>
                    <p class="kkh-subtitle">
                        Monitoring cepat untuk status verifikasi, kondisi unfit, dan karyawan dengan durasi tidur di bawah 6 jam.
                    </p>
                </div>
                <div class="col-lg-4 mt-3 mt-lg-0 text-lg-end">
                    <div style="font-size: .85rem; color: rgba(255,255,255,.85);">Total temuan hari ini</div>
                    <div style="font-size: 2.2rem; font-weight: 800; line-height: 1;">{{ $totalKasus }}</div>
                </div>
            </div>
        </div>

        <div class="row kkh-stat-grid g-3">
            <div class="col-md-4">
                <div class="kkh-stat-card">
                    <div class="kkh-stat-top">
                        <div>
                            <div class="kkh-stat-label">Belum Diverifikasi</div>
                            <div class="kkh-stat-value">{{ $jumlahBelumDiverifikasi }}</div>
                        </div>
                        <div class="kkh-stat-icon icon-warning">!</div>
                    </div>
                    <p class="kkh-stat-desc">Data KKH yang masih menunggu verifikasi pengawas.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="kkh-stat-card">
                    <div class="kkh-stat-top">
                        <div>
                            <div class="kkh-stat-label">Unfit</div>
                            <div class="kkh-stat-value">{{ $jumlahUnfit }}</div>
                        </div>
                        <div class="kkh-stat-icon icon-danger">×</div>
                    </div>
                    <p class="kkh-stat-desc">Karyawan dengan status tidak fit untuk bekerja.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="kkh-stat-card">
                    <div class="kkh-stat-top">
                        <div>
                            <div class="kkh-stat-label">Tidur di Bawah 6 Jam</div>
                            <div class="kkh-stat-value">{{ $jumlahTidurKurang }}</div>
                        </div>
                        <div class="kkh-stat-icon icon-info">zZ</div>
                    </div>
                    <p class="kkh-stat-desc">Perlu perhatian karena durasi tidur kurang dari 6 jam.</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-xl-4 col-md-6">
                <div class="kkh-section-card">
                    <div class="kkh-section-header">
                        <div class="kkh-section-title-wrap">
                            <div class="kkh-section-icon icon-warning">!</div>
                            <div>
                                <h5 class="kkh-section-title">Belum Diverifikasi</h5>
                                <p class="kkh-section-subtitle">Menunggu approval pengawas</p>
                            </div>
                        </div>
                        <div class="kkh-badge-count badge-warning-soft">{{ $jumlahBelumDiverifikasi }}</div>
                    </div>

                    <div class="kkh-table-wrap">
                        <div class="kkh-table-scroll auto-scroll">
                            <div class="table-responsive">
                                <table class="table kkh-table">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Departemen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kkhBelumDiverifikasi as $item)
                                            <tr>
                                                <td><span class="kkh-nik">{{ $item->NIK_PENGISI }}</span></td>
                                                <td>{{ $item->NAMA_PENGISI }}</td>
                                                <td>{{ $item->DEPARTEMEN }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="kkh-empty">
                                                    <div class="kkh-empty-box">
                                                        <div class="kkh-empty-icon">✓</div>
                                                        <div class="kkh-empty-title">Tidak ada data</div>
                                                        <p class="kkh-empty-text">Semua data sudah diverifikasi.</p>
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
                <div class="kkh-section-card">
                    <div class="kkh-section-header">
                        <div class="kkh-section-title-wrap">
                            <div class="kkh-section-icon icon-danger">×</div>
                            <div>
                                <h5 class="kkh-section-title">Unfit</h5>
                                <p class="kkh-section-subtitle">Status tidak fit bekerja</p>
                            </div>
                        </div>
                        <div class="kkh-badge-count badge-danger-soft">{{ $jumlahUnfit }}</div>
                    </div>

                    <div class="kkh-table-wrap">
                        <div class="kkh-table-scroll auto-scroll">
                            <div class="table-responsive">
                                <table class="table kkh-table">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Departemen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kkhUnfit as $item)
                                            <tr>
                                                <td><span class="kkh-nik">{{ $item->NIK_PENGISI }}</span></td>
                                                <td>{{ $item->NAMA_PENGISI }}</td>
                                                <td>{{ $item->DEPARTEMEN }}</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="kkh-empty">
                                                    <div class="kkh-empty-box">
                                                        <div class="kkh-empty-icon">✓</div>
                                                        <div class="kkh-empty-title">Tidak ada data</div>
                                                        <p class="kkh-empty-text">Tidak ada karyawan unfit hari ini.</p>
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
                <div class="kkh-section-card">
                    <div class="kkh-section-header">
                        <div class="kkh-section-title-wrap">
                            <div class="kkh-section-icon icon-info">zZ</div>
                            <div>
                                <h5 class="kkh-section-title">Tidur di bawah 6 jam</h5>
                                <p class="kkh-section-subtitle">Perlu perhatian kondisi istirahat</p>
                            </div>
                        </div>
                        <div class="kkh-badge-count badge-info-soft">{{ $jumlahTidurKurang }}</div>
                    </div>

                    <div class="kkh-table-wrap">
                        <div class="kkh-table-scroll auto-scroll">
                            <div class="table-responsive">
                                <table class="table kkh-table">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Departemen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kkhdibawah6Jam as $item)
                                            <tr>
                                                <td><span class="kkh-nik">{{ $item->NIK_PENGISI }}</span></td>
                                                <td>{{ $item->NAMA_PENGISI }}</td>
                                                <td>{{ $item->DEPARTEMEN }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="kkh-empty">
                                                    <div class="kkh-empty-box">
                                                        <div class="kkh-empty-icon">✓</div>
                                                        <div class="kkh-empty-title">Tidak ada data</div>
                                                        <p class="kkh-empty-text">Tidak ada karyawan dengan tidur kurang dari 6 jam.</p>
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


        <div class="kkh-footer-note">
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
