
@include('layout.head', ['title' => 'Matching Fleet'])
@include('layout.sidebar')
@include('layout.header')
@php
    $totalFleet = $matchingFleet->flatten(1)->count();
    $formatValue = function ($value, $decimal = 1) {
        if ($value === null || $value === '') return '-';
        return is_numeric($value) ? number_format((float) $value, $decimal, '.', ',') : $value;
    };

@endphp
<style>
.pc-content{color:#172033}
.matching-card{border:1px solid #dbe3ef;border-radius:12px;overflow:hidden}
.matching-card .card-body{padding:20px}
.matching-title{font-size:17px;font-weight:700;color:#24334d;margin-bottom:4px}
.matching-subtitle{font-size:12px;color:#8792a5}
.matching-toolbar{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:18px}
.matching-search{width:280px;max-width:100%}
.matching-search .form-control{font-size:13px;border-radius:7px;min-height:38px}
.desktop-fleet{display:block;width:100%}
.matching-wrapper{width:100%;overflow-x:auto;overflow-y:hidden;-webkit-overflow-scrolling:touch;border:1px solid #e5eaf2;border-radius:6px}
#matching-table{width:100%;min-width:1250px;border-collapse:collapse;font-size:12px;margin-bottom:0}
#matching-table thead th{background:#7090f1!important;color:#fff!important;text-align:center;vertical-align:middle;padding:12px 9px;border:1px solid #819cf2;font-weight:700;white-space:nowrap}
#matching-table tbody td{padding:11px 9px;border-bottom:1px solid #e5eaf0;vertical-align:middle;white-space:nowrap;color:#26354c}
#matching-table tbody tr:nth-child(even) td{background:#f8faff}
#matching-table tbody tr:hover td{background:#edf3ff}
#matching-table .pit-cell{background:#f1f5ff!important;color:#294c9b!important;font-weight:700;text-align:center;vertical-align:middle;min-width:125px}
#matching-table .fleet-cell{color:#263b63;font-weight:600}
#matching-table .number-cell{text-align:center;font-variant-numeric:tabular-nums}
.matching-footer{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-top:15px}
.matching-info{color:#64748b;font-size:12px}
.matching-page-size{width:85px;font-size:12px;border-radius:7px}
.matching-pagination{display:flex;align-items:center;gap:5px}
.matching-pagination button{min-width:31px;height:31px;border:1px solid #dce3ed;border-radius:6px;background:#fff;color:#52647d;font-size:12px}
.matching-pagination button.active{background:#7090f1;border-color:#7090f1;color:#fff}
.matching-pagination button:disabled{opacity:.4;cursor:not-allowed}
.mobile-fleet{display:none}
.fleet-mobile-card{background:#fff;border:1px solid #dce4f0;border-radius:10px;padding:14px;margin-bottom:12px}
.fleet-mobile-header{display:flex;justify-content:space-between;align-items:center;gap:10px;padding-bottom:12px;border-bottom:1px solid #e5eaf2}
.fleet-mobile-name{font-size:15px;font-weight:700;color:#243b65}
.pit-badge{background:#e9efff;color:#3156a5;padding:5px 10px;border-radius:20px;font-size:10px;font-weight:700;white-space:nowrap}
.mobile-section-title{font-size:11px;font-weight:700;color:#6382d5;text-transform:uppercase;margin:15px 0 9px;letter-spacing:.4px}
.mobile-data-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:9px}
.mobile-data-item{background:#f5f7fc;padding:11px;border-radius:7px;min-width:0}
.mobile-data-item small{display:block;color:#64748b;font-size:10px;margin-bottom:5px;line-height:1.4}
.mobile-data-item strong{display:block;font-size:13px;color:#172b4d;font-weight:700;overflow-wrap:anywhere}
@media(max-width:991.98px){
    .matching-card .card-body{padding:15px}
    #matching-table{min-width:1200px}
}
@media(max-width:767.98px){
    .matching-card .card-body{padding:12px}
    .matching-toolbar{align-items:stretch;flex-direction:column}
    .matching-search{width:100%}
    .desktop-fleet{display:none}
    .mobile-fleet{display:block}
    .matching-footer{align-items:flex-start;flex-direction:column}
    .fleet-mobile-card{padding:12px}
    .mobile-data-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
    .matching-pagination{flex-wrap:wrap}
    .matching-page-size{width:75px}
}
@media(max-width:360px){
    .mobile-data-grid{grid-template-columns:1fr}
}
[data-pc-theme="dark"] .matching-card,[data-bs-theme="dark"] .matching-card{background:#1c2431;border-color:#3b4759}
[data-pc-theme="dark"] .matching-title,[data-bs-theme="dark"] .matching-title{color:#fff}
[data-pc-theme="dark"] #matching-table tbody td,[data-bs-theme="dark"] #matching-table tbody td{color:#e2e8f0;border-color:#3b4759}
[data-pc-theme="dark"] #matching-table tbody tr:nth-child(even) td,[data-bs-theme="dark"] #matching-table tbody tr:nth-child(even) td{background:#253246}
[data-pc-theme="dark"] #matching-table .pit-cell,[data-bs-theme="dark"] #matching-table .pit-cell{background:#293b59!important;color:#bcd0ff!important}
[data-pc-theme="dark"] .fleet-mobile-card,[data-bs-theme="dark"] .fleet-mobile-card{background:#202b3b;border-color:#3b4759}
[data-pc-theme="dark"] .mobile-data-item,[data-bs-theme="dark"] .mobile-data-item{background:#29384c}
[data-pc-theme="dark"] .mobile-data-item strong,[data-bs-theme="dark"] .mobile-data-item strong{color:#fff}
[data-pc-theme="dark"] .fleet-mobile-name,[data-bs-theme="dark"] .fleet-mobile-name{color:#dbeafe}
[data-pc-theme="dark"] .matching-pagination button,[data-bs-theme="dark"] .matching-pagination button{background:#253246;color:#fff;border-color:#465771}
[data-pc-theme="dark"] .matching-pagination button.active,[data-bs-theme="dark"] .matching-pagination button.active{background:#7090f1}
@media print{
    .matching-toolbar,.matching-footer,.mobile-fleet{display:none!important}
    .matching-wrapper{overflow:visible}
    #matching-table{min-width:100%;font-size:9px}
}
</style>
<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h4 class="mb-2">Matching Fleet</h4>
                        <p class="text-muted mb-0">Monitoring kesesuaian Loader dan Hauler</p>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($errorMessage))
            <div class="alert alert-danger mt-3">{{ $errorMessage }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
        <div class="row mt-3">
            <div class="col-12">
                <div class="card matching-card">
                    <div class="card-body">
                        <div class="matching-toolbar">
                            <div class="matching-search">
                                <input type="text" id="fleetSearch" class="form-control" placeholder="Cari PIT atau Fleet...">
                            </div>
                        </div>
                        <div class="desktop-fleet">
                            <div class="matching-wrapper">
                                <table id="matching-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="3">PIT</th>
                                            <th colspan="3">Loader</th>
                                            <th rowspan="3">Need Dumptruck</th>
                                            <th colspan="4">Hauler</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2">Fleet</th>
                                            <th rowspan="2">Productivity</th>
                                            <th rowspan="2">Loading Time</th>
                                            <th rowspan="2">Distance</th>
                                            <th rowspan="2">MF</th>
                                        </tr>
                                    </thead>
                                    @forelse($matchingFleet as $pit => $fleets)
                                        <tbody class="pit-group" data-pit="{{ $pit }}">
                                            @foreach($fleets as $index => $item)
                                                <tr class="fleet-row">
                                                    @if($index === 0)
                                                        <td class="pit-cell" rowspan="{{ $fleets->count() }}">{{ $pit }}</td>
                                                    @endif
                                                    <td class="fleet-cell">{{ $item['VHC_ID'] ?? '-' }}</td>
                                                    <td class="number-cell">{{ $formatValue($item['PDTY_LOADER'] ?? null, 1) }}</td>
                                                    <td class="number-cell">{{ $formatValue($item['LOADINGTIME'] ?? null) }}</td>
                                                    <td class="number-cell">{{ $formatValue($item['NTRUCK_NEED'] ?? null, 1) }}</td>
                                                    <td class="number-cell">{{ $formatValue($item['AVG_RIT_CYCLEDISTANCE'] ?? null) }}</td>
                                                    <td class="number-cell">{{ $formatValue($item['MF'] ?? null) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @empty
                                        <tbody>
                                            <tr>
                                                <td colspan="7" class="text-center py-5">Data Matching Fleet belum tersedia.</td>
                                            </tr>
                                        </tbody>
                                    @endforelse
                                </table>
                            </div>
                            <div class="matching-footer">
                                <div class="matching-info" id="desktopInfo">
                                    Total PIT: {{ $matchingFleet->count() }} | Total Fleet: {{ $totalFleet }}
                                </div>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="matching-info">Page size:</span>
                                        <select id="desktopPageSize" class="form-select matching-page-size">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20" selected>20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    <div class="matching-pagination" id="desktopPagination"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-fleet" id="mobileFleet">
                            @forelse($matchingFleet as $pit => $fleets)
                                @foreach($fleets as $item)
                                    <div class="fleet-mobile-card">
                                        <div class="fleet-mobile-header">
                                            <div class="fleet-mobile-name">{{ $item['VHC_ID'] ?? '-' }}</div>
                                            <span class="pit-badge">{{ $pit }}</span>
                                        </div>
                                        <div class="mobile-section-title">Loader</div>
                                        <div class="mobile-data-grid">
                                            <div class="mobile-data-item">
                                                <small>Productivity</small>
                                                <strong>{{ $formatValue($item['PDTY_LOADER'] ?? null) }}</strong>
                                            </div>
                                            <div class="mobile-data-item">
                                                <small>Loading Time</small>
                                                <strong>{{ $formatValue($item['LOADINGTIME'] ?? null) }}</strong>
                                            </div>
                                        </div>
                                        <div class="mobile-section-title">Hauler</div>
                                        <div class="mobile-data-grid">
                                            <div class="mobile-data-item">
                                                <small>Need Dumptruck</small>
                                                <strong>{{ $formatValue($item['NTRUCK_NEED'] ?? null, 1) }}</strong>
                                            </div>
                                            <div class="mobile-data-item">
                                                <small>Distance</small>
                                                <strong>{{ $formatValue($item['AVG_RIT_CYCLEDISTANCE'] ?? null) }}</strong>
                                            </div>
                                            <div class="mobile-data-item">
                                                <small>Match Factor</small>
                                                <strong>{{ $formatValue($item['MF'] ?? null) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @empty
                                <div class="text-center py-4">Data Matching Fleet belum tersedia.</div>
                            @endforelse
                        </div>
                        <div class="matching-footer mobile-footer">
                            <div class="matching-info" id="mobileInfo">Total Fleet: {{ $totalFleet }}</div>
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="matching-info">Page size:</span>
                                    <select id="mobilePageSize" class="form-select matching-page-size">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20" selected>20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div class="matching-pagination" id="mobilePagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('fleetSearch');
    const desktopGroups = Array.from(document.querySelectorAll('#matching-table tbody.pit-group'));
    const mobileCards = Array.from(document.querySelectorAll('#mobileFleet .fleet-mobile-card'));
    const desktopPageSize = document.getElementById('desktopPageSize');
    const mobilePageSize = document.getElementById('mobilePageSize');
    const desktopPagination = document.getElementById('desktopPagination');
    const mobilePagination = document.getElementById('mobilePagination');
    const desktopInfo = document.getElementById('desktopInfo');
    const mobileInfo = document.getElementById('mobileInfo');
    const mobileFooter = document.querySelector('.mobile-footer');
    let filteredGroups = [...desktopGroups];
    let filteredCards = [...mobileCards];
    let desktopPage = 1;
    let mobilePage = 1;
    function isMobile() {
        return window.matchMedia('(max-width: 767.98px)').matches;
    }
    function updateLayout() {
        mobileFooter.style.display = isMobile() ? 'flex' : 'none';
    }
    function createPagination(container, current, total, callback) {
        container.innerHTML = '';
        const prev = document.createElement('button');
        prev.type = 'button';
        prev.textContent = 'Prev';
        prev.disabled = current <= 1;
        prev.addEventListener('click', () => callback(current - 1));
        container.appendChild(prev);
        for (let i = 1; i <= total; i++) {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = i;
            if (i === current) button.classList.add('active');
            button.addEventListener('click', () => callback(i));
            container.appendChild(button);
        }
        const next = document.createElement('button');
        next.type = 'button';
        next.textContent = 'Next';
        next.disabled = current >= total;
        next.addEventListener('click', () => callback(current + 1));
        container.appendChild(next);
    }
    function renderDesktop() {
        const pageSize = parseInt(desktopPageSize.value, 10);
        const total = filteredGroups.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));
        desktopPage = Math.min(desktopPage, totalPages);
        const start = (desktopPage - 1) * pageSize;
        const end = start + pageSize;
        desktopGroups.forEach(group => group.style.display = 'none');
        filteredGroups.slice(start, end).forEach(group => group.style.display = '');
        desktopInfo.textContent = total === 0 ? 'Tidak ada data' : `Menampilkan PIT ${start + 1} - ${Math.min(end, total)} dari ${total} PIT`;
        createPagination(desktopPagination, desktopPage, totalPages, function (page) {
            desktopPage = page;
            renderDesktop();
        });
    }
    function renderMobile() {
        const pageSize = parseInt(mobilePageSize.value, 10);
        const total = filteredCards.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));
        mobilePage = Math.min(mobilePage, totalPages);
        const start = (mobilePage - 1) * pageSize;
        const end = start + pageSize;
        mobileCards.forEach(card => card.style.display = 'none');
        filteredCards.slice(start, end).forEach(card => card.style.display = '');
        mobileInfo.textContent = total === 0 ? 'Tidak ada data' : `Menampilkan ${start + 1} - ${Math.min(end, total)} dari ${total} Fleet`;
        createPagination(mobilePagination, mobilePage, totalPages, function (page) {
            mobilePage = page;
            renderMobile();
        });
    }
    function applySearch() {
        const keyword = searchInput.value.toLowerCase().trim();
        filteredGroups = desktopGroups.filter(group => group.textContent.toLowerCase().includes(keyword));
        filteredCards = mobileCards.filter(card => card.textContent.toLowerCase().includes(keyword));
        desktopPage = 1;
        mobilePage = 1;
        renderDesktop();
        renderMobile();
    }
    searchInput.addEventListener('input', applySearch);
    desktopPageSize.addEventListener('change', function () {
        desktopPage = 1;
        renderDesktop();
    });
    mobilePageSize.addEventListener('change', function () {
        mobilePage = 1;
        renderMobile();
    });
    window.addEventListener('resize', updateLayout);
    updateLayout();
    renderDesktop();
    renderMobile();
});
</script>
