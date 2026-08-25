@include('layout.head', ['title' => 'Diggibility'])
@include('layout.sidebar')
@include('layout.header')

<style>
    .digging-page {
        background: #f4f7fa;
        min-height: calc(100vh - 70px);
        padding: 25px;
    }

    .digging-wrapper {
        max-width: 1500px;
        margin: auto;
    }

    .digging-grid {
        display: grid;
        grid-template-columns: 1fr 1.25fr;
        gap: 20px;
    }

    .digging-card {
        background: #fff;
        border: 1px solid #d9e1e8;
        box-shadow: 0 2px 10px rgba(30,58,90,.05);
    }

    .digging-header {
        padding: 22px 30px;
        border-bottom: 1px solid #dce4eb;
    }

    .section-number {
        font-size: 11px;
        font-weight: 800;
        color: #7890a8;
        letter-spacing: 2px;
        margin-bottom: 4px;
    }

    .section-title {
        font-size: 28px;
        font-weight: 800;
        color: #173b68;
        letter-spacing: .5px;
        margin: 0;
        text-transform: uppercase;
    }

    .timer-box {
        background: #f0f4f7;
        border-left: 3px solid #d1dce5;
        padding: 10px 16px;
        text-align: right;
    }

    .timer-label {
        font-size: 9px;
        font-weight: 800;
        color: #7890a8;
        letter-spacing: 1.5px;
    }

    #timerDisplay {
        font-family: monospace;
        color: #244d79;
        font-size: 20px;
        font-weight: 800;
    }

    .left-body {
        padding: 20px 30px 30px;
    }

    .stats {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        border: 1px solid #d4dee7;
        margin-bottom: 18px;
    }

    .stat {
        padding: 12px 15px;
        border-right: 1px solid #d4dee7;
    }

    .stat:last-child {
        border-right: 0;
        background: #dff3e7;
    }

    .stat-label {
        font-size: 10px;
        color: #7990a5;
        font-weight: 800;
        text-transform: uppercase;
    }

    .stat-value {
        font-size: 25px;
        color: #173f6d;
        font-weight: 800;
        line-height: 1.2;
    }

    #categoryDisplay {
        font-size: 12px;
        color: #16814b;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;
    }

    .control-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 8px;
    }

    .control-btn {
        height: 61px;
        border: 0;
        font-size: 17px;
        font-weight: 800;
        letter-spacing: .5px;
    }

    .btn-digging {
        background: #205798;
        color: white;
    }

    .btn-stop {
        background: #edf2f5;
        color: #7c8ea0;
    }

    .btn-stop.active {
        background: #efb0aa;
        color: #a5332a;
    }

    .btn-cancel-last {
        width: 100%;
        height: 37px;
        border: 1px solid #d4dee7;
        background: white;
        color: #60778e;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .passes-grid {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: 5px;
        margin-bottom: 12px;
    }

    .pass-box {
        height: 55px;
        background: #e9eef2;
        color: #7890a5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 800;
    }

    .pass-box.done {
        background: #ef792d;
        color: white;
    }

    .pass-box.current {
        background: #205798;
        color: white;
    }

    .pass-table {
        width: 100%;
        border-collapse: collapse;
    }

    .pass-table th {
        background: #edf2f5;
        color: #748ba0;
        font-size: 10px;
        text-align: left;
        padding: 9px 14px;
    }

    .pass-table td {
        border: 1px solid #dbe3e9;
        border-left: 0;
        border-right: 0;
        padding: 9px 14px;
        color: #1d416b;
        font-weight: 700;
    }

    .right-body {
        padding: 18px 30px 30px;
    }

    .verified {
        color: #24804e;
        font-size: 11px;
        font-weight: 700;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-group {
        margin-bottom: 14px;
    }

    .form-label {
        font-size: 11px;
        color: #49657f;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        min-height: 42px;
        border: 1px solid #ccd8e2;
        border-radius: 0;
        color: #52708d;
        font-size: 13px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #205798;
        box-shadow: 0 0 0 2px rgba(32,87,152,.08);
    }

    .option-title {
        font-size: 11px;
        color: #49657f;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .choice-group {
        display: flex;
        gap: 8px;
    }

    .choice-btn {
        border: 1px solid #ccd8e2;
        background: #fff;
        color: #55708a;
        min-width: 90px;
        padding: 8px 14px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
    }

    .choice-btn.active {
        background: #205798;
        color: white;
        border-color: #205798;
    }

    .save-btn {
        width: 100%;
        height: 52px;
        border: 0;
        background: #001932;
        color: white;
        font-size: 18px;
        font-weight: 800;
        letter-spacing: .5px;
        margin-top: 8px;
    }

    .required {
        color: #df392e;
    }

    .table-scroll {
        max-height: 250px;
        overflow-y: auto;
        border: 1px solid #dbe3e9;
    }

    @media(max-width: 1000px) {
        .digging-grid {
            grid-template-columns: 1fr;
        }

    }

    @media(max-width: 600px) {
        .digging-page {
            padding: 10px;
        }

        .left-body,
        .right-body {
            padding: 15px;
        }

        .digging-header {
            padding: 15px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .passes-grid {
            grid-template-columns: repeat(5, 1fr);
        }

        .stats {
            grid-template-columns: 1fr;
        }

        .stat {
            border-right: 0;
            border-bottom: 1px solid #d4dee7;
        }

    }

    .dig-modal{
        position:fixed;
        inset:0;
        z-index:99999;
        display:none;
        align-items:center;
        justify-content:center;
        background:rgba(10,28,45,.72);
        padding:20px;
    }

    .dig-modal.show{
        display:flex;
    }

    .dig-modal-box{
        width:100%;
        max-width:440px;
        background:#fff;
        border:1px solid #d5e0e8;
        box-shadow:0 20px 60px rgba(0,0,0,.25);
        text-align:center;
        padding:30px;
        animation:digModalIn .2s ease-out;
    }

    .dig-modal-icon{
        width:58px;
        height:58px;
        margin:0 auto 15px;
        border-radius:50%;
        background:#dff3e7;
        color:#188357;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:900;
        border:3px solid #bce4ce;
    }

    .dig-modal-icon.error{
        background:#fbe3e1;
        color:#c43b34;
        border-color:#f1c0bc;
    }

    .dig-modal-title{
        color:#174476;
        font-weight:900;
        margin-bottom:8px;
    }

    .dig-modal-text{
        color:#71869a;
        margin-bottom:20px;
    }

    .dig-modal-info{
        display:grid;
        grid-template-columns:1fr 1fr;
        border:1px solid #d4dee7;
        margin-bottom:20px;
        text-align:left;
    }

    .dig-modal-info div{
        padding:12px;
        background:#f7f9fb;
        border-right:1px solid #d4dee7;
    }

    .dig-modal-info div:last-child{
        border-right:0;
    }

    .dig-modal-info span{
        display:block;
        color:#7890a5;
        margin-bottom:4px;
    }

    .dig-modal-info b{
        color:#174476;
    }

    .dig-modal-button{
        width:100%;
        height:43px;
        border:0;
        background:#205798;
        color:#fff;
        font-weight:800;
        cursor:pointer;
    }

    .dig-modal-button:hover{
        background:#174a82;
    }

    .error-button{
        background:#c43b34;
    }

    @keyframes digModalIn{
        from{
            opacity:0;
            transform:translateY(12px) scale(.97);
        }
        to{
            opacity:1;
            transform:translateY(0) scale(1);
        }
    }

    @media(max-width:500px){
        .dig-modal-box{
            padding:22px;
        }

        .dig-modal-info{
            grid-template-columns:1fr;
        }

        .dig-modal-info div{
            border-right:0;
            border-bottom:1px solid #d4dee7;
        }

        .dig-modal-info div:last-child{
            border-bottom:0;
        }
    }

    .validation-toast{
        position:fixed;
        top:20px;
        left:50%;
        transform:translate(-50%,-140%);
        z-index:99999;
        min-width:320px;
        max-width:520px;
        background:#3d0505;
        color:#fff;
        border-radius:8px;
        padding:13px 16px;
        display:flex;
        align-items:center;
        gap:10px;
        box-shadow:0 8px 25px rgba(0,0,0,.25);
        opacity:0;
        transition:all .35s ease;
    }

    .validation-toast.show{
        transform:translate(-50%,0);
        opacity:1;
    }

    .validation-toast-icon{
        width:16px;
        height:16px;
        border-radius:50%;
        background:#ff9b9b;
        color:#651111;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:900;
        flex:none;
    }

    .validation-toast-title{
        font-weight:800;
        margin-bottom:2px;
    }

    .validation-toast-message{
        color:#ffb5b5;
    }

    .field-error{
        border-color:#d63d3d !important;
        background:#fff8f8 !important;
    }

    .field-error-text{
        color:#d63d3d;
        margin-top:4px;
    }

</style>

<div id="validationToast" class="validation-toast">
    <div class="validation-toast-icon">!</div>
    <div>
        <div class="validation-toast-title">Informasi</div>
        <div class="validation-toast-message" id="validationToastMessage"></div>
    </div>
</div>
<div class="pc-container">
    <div class="pc-content digging-page">
        <div class="digging-wrapper">
            <div class="digging-grid">
                <div class="digging-card">
                    <div class="digging-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="section-number">01 / PENGUKURAN</div>
                            <h2 class="section-title">DIGGING TIME</h2>
                        </div>
                        <div class="timer-box">
                            <div class="timer-label">ACTIVE SLOT</div>
                            <div id="timerDisplay">00:00.00</div>
                        </div>
                    </div>

                    <div class="left-body">
                        <div class="stats">
                            <div class="stat">
                                <div class="stat-label">Total Passes</div>
                                <div class="stat-value">
                                    <span id="totalPasses">0</span>
                                    <small style="font-size:10px">/ maks. 30</small>
                                </div>
                            </div>

                            <div class="stat">
                                <div class="stat-label">Average Digging Time</div>
                                <div class="stat-value">
                                    <span id="averageTime">0.00</span>
                                    <small style="font-size:10px">detik</small>
                                </div>
                            </div>

                            <div class="stat">
                                <div class="stat-label">Status</div>
                                <div id="categoryDisplay">BELUM ADA DATA</div>
                            </div>
                        </div>

                        <div class="control-buttons">
                            <button type="button" id="btnDigging" class="control-btn btn-digging">
                                ◯ &nbsp; DIGGING
                            </button>

                            <button type="button" id="btnStop" class="control-btn btn-stop" disabled>
                                ■ &nbsp; STOP
                            </button>
                        </div>

                        <button type="button" class="btn-cancel-last" id="btnCancelLast">
                            ↻ &nbsp; Batalkan terakhir
                        </button>

                        <div class="passes-grid" id="passesGrid">
                            @for($i = 1; $i <= 30; $i++)
                                <div class="pass-box" data-pass="{{ $i }}">{{ $i }}</div>
                            @endfor
                        </div>
                        <div class="table-scroll">
                            <table class="pass-table">
                                <thead>
                                    <tr>
                                        <th>PASS</th>
                                        <th>DIGGING TIME</th>
                                    </tr>
                                </thead>

                                <tbody id="passTableBody">
                                    <tr>
                                        <td colspan="2" class="text-center" style="color:#94a3b8">
                                            Belum ada pengukuran
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-2" style="font-size:10px;color:#7d91a5">Standard Digging Time:
                            <b>maks. 11 detik</b>
                        </div>
                    </div>
                </div>

                <div class="digging-card">
                    <div class="digging-header d-flex justify-content-between">
                        <div>
                            <div class="section-number">
                                02 / LAPORAN
                            </div>
                            <h2 class="section-title">
                                DATA PELAKSANAAN
                            </h2>

                        </div>
                    </div>

                    <div class="right-body">
                        <form id="diggingForm" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        No. Unit <span class="required">*</span>
                                    </label>

                                    <select class="form-select" id="no_unit">
                                        <option value="">Pilih unit</option>

                                        @foreach($ex as $unit)
                                            <option
                                                value="{{ $unit->VHC_ID }}"
                                                data-gps-lon="{{ $unit->GPS_LON }}"
                                                data-gps-lat="{{ $unit->GPS_LAT }}"
                                                data-opr-nrp="{{ $unit->OPR_NRP }}"
                                                data-opr-name="{{ $unit->OPR_NAME }}"
                                            >
                                                {{ $unit->VHC_ID }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tinggi Jenjang (m)
                                        <span class="required">*</span>
                                    </label>
                                    <input type="number" step="0.01" class="form-control" id="tinggi_jenjang" placeholder="0.00">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        Lokasi <span class="required">*</span>
                                    </label>
                                    <select class="form-select" id="lokasi">
                                        <option value="">Pilih lokasi</option>
                                        @foreach ($region as $reg)
                                            <option value="{{ $reg->keterangan }}">{{ $reg->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        Titik Koordinat
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="titik_koordinat"
                                        placeholder="Contoh: -0.123456, 117.123456">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Jenis Material
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-select" id="jenis_material">
                                        <option value="">Pilih material</option>
                                        <option value="Free Dig">Free Dig</option>
                                        <option value="Blasting Layer 1">Blasting Layer 1</option>
                                        <option value="Blasting Layer 2">Blasting Layer 2</option>
                                        <option value="Hard Material">Hard Material</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        Nama Operator <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="nama_operator"
                                        placeholder="Nama operator">
                                    <input type="hidden" id="nik_operator">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="form-label">Nama Pengawas
                                    <span class="required">*</span>
                                </label>
                                <select class="form-select" id="nama_pengawas">
                                    <option value="{{ auth()->user()->nik }}" data-nama="{{ auth()->user()->name }}">{{ auth()->user()->nik }} - {{ auth()->user()->name }}</option>
                                    @foreach ($pengawas as $foreman)
                                        <option
                                            value="{{ $foreman->nik }}"
                                            data-nama="{{ $foreman->name }}">
                                            {{ $foreman->nik }} - {{ $foreman->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="option-title">Jumlah Passes Bucket</div>
                                <div class="choice-group">
                                    <button type="button" class="choice-btn" data-name="passes_bucket" data-value="4 Passes">4 Passes</button>
                                    <button type="button" class="choice-btn" data-name="passes_bucket" data-value="5 Passes">5 Passes</button>
                                    <button type="button" class="choice-btn" data-name="passes_bucket" data-value="> 5 Passes">> 5 Passes</button>
                                </div>
                                <input type="hidden" id="passes_bucket">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <div class="option-title">Operator dalam kondisi fit?</div>
                                    <div class="choice-group">
                                        <button type="button" class="choice-btn active" data-name="operator_fit" data-value="Ya">Fit</button>
                                        <button type="button" class="choice-btn" data-name="operator_fit" data-value="Tidak">Tidak Fit</button>
                                    </div>
                                    <input type="hidden" id="operator_fit" value="Ya">
                                </div>
                                <div class="form-group">
                                    <div class="option-title">Kinerja operator rendah?</div>
                                    <div class="choice-group">
                                        <button type="button" class="choice-btn active" data-name="kinerja_operator_rendah" data-value="Tidak">Tidak</button>
                                        <button type="button" class="choice-btn" data-name="kinerja_operator_rendah" data-value="Ya">Ya</button>
                                    </div>
                                    <input type="hidden" id="kinerja_operator_rendah" value="Tidak">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="option-title">Keterangan Area
                                    <span class="required">*</span>
                                </div>
                                <div class="choice-group">
                                    <button type="button" class="choice-btn" data-name="keterangan_area" data-value="Sisi Highwall">Sisi Highwall</button>
                                    <button type="button" class="choice-btn" data-name="keterangan_area" data-value="Sisi Tengah">Sisi Tengah</button>
                                    <button type="button" class="choice-btn" data-name="keterangan_area" data-value="Sisi Freeface">Sisi Freeface</button>
                                </div>
                                <input type="hidden" id="keterangan_area">
                            </div>
                            <button type="button" class="save-btn" id="btnSave">➤ &nbsp; SIMPAN DATA AKHIR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="successModal" class="dig-modal">
    <div class="dig-modal-box">

        <div class="dig-modal-icon">
            ✓
        </div>

        <div class="dig-modal-title">
            DATA BERHASIL DISIMPAN
        </div>

        <div class="dig-modal-text">
            Laporan diggibility berhasil disimpan.
        </div>

        <div class="dig-modal-info">
            <div>
                <span>KATEGORI</span>
                <b id="modalKategori">-</b>
            </div>
            <div>
                <span>AVERAGE DIGGING TIME</span>
                <b id="modalAverage">-</b>
            </div>
        </div>

        <button type="button"
                class="dig-modal-button"
                onclick="closeSuccessModal()">
            TUTUP
        </button>

    </div>
</div>

<div id="errorModal" class="dig-modal">
    <div class="dig-modal-box">

        <div class="dig-modal-icon error">
            !
        </div>

        <div class="dig-modal-title">
            GAGAL MENYIMPAN DATA
        </div>

        <div class="dig-modal-text" id="errorModalText">
            Terjadi kesalahan saat menyimpan data.
        </div>

        <button type="button"
                class="dig-modal-button error-button"
                onclick="closeErrorModal()">
            TUTUP
        </button>

    </div>
</div>
@include('layout.footer')
<script>
    document.getElementById('no_unit').addEventListener('change', function () {
        const option = this.options[this.selectedIndex];
        if (!option.value) {
            document.getElementById('titik_koordinat').value = '';
            document.getElementById('nama_operator').value = '';
            document.getElementById('nik_operator').value = '';
            return;
        }

        const gpsLon = option.dataset.gpsLon || '';
        const gpsLat = option.dataset.gpsLat || '';
        const oprNrp = option.dataset.oprNrp || '';
        const oprName = option.dataset.oprName || '';

        if (gpsLat && gpsLon) {
            document.getElementById('titik_koordinat').value = `${gpsLat}, ${gpsLon}`;
        } else {
            document.getElementById('titik_koordinat').value = '';
        }

        document.getElementById('nik_operator').value = oprNrp;
        document.getElementById('nama_operator').value = oprName;
    });

    let currentPass = 0;
    let passes = [];
    let startTime = null;
    let timerInterval = null;

    const timerDisplay = document.getElementById('timerDisplay');
    const btnDigging = document.getElementById('btnDigging');
    const btnStop = document.getElementById('btnStop');
    btnDigging.addEventListener('click', function () {
        if (passes.length >= 30) {
            alert('Maksimal 30 pass.');
            return;
        }

        startTime = Date.now();
        timerInterval = setInterval(updateTimer, 10);
        btnDigging.disabled = true;
        btnStop.disabled = false;
        btnStop.classList.add('active');
    });


    btnStop.addEventListener('click', function () {
        if (!startTime) {
            return;
        }
        const duration = (Date.now() - startTime) / 1000;
        clearInterval(timerInterval);
        timerInterval = null;
        currentPass++;
        passes.push({
            pass_no: currentPass,
            digging_time: parseFloat(duration.toFixed(2))
        });

        startTime = null;
        timerDisplay.textContent = '00:00.00';
        btnDigging.disabled = false;
        btnStop.disabled = true;
        btnStop.classList.remove('active');
        renderPasses();
    });

    function updateTimer()
    {
        if (!startTime) return;
        const elapsed = Date.now() - startTime;
        const totalSeconds = elapsed / 1000;
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = Math.floor(totalSeconds % 60);
        const milliseconds = Math.floor((elapsed % 1000) / 10);
        timerDisplay.textContent =
            `${String(minutes).padStart(2,'0')}:` +
            `${String(seconds).padStart(2,'0')}.` +
            `${String(milliseconds).padStart(2,'0')}`;
    }

    function renderPasses()
    {
        const tbody = document.getElementById('passTableBody');
        tbody.innerHTML = '';
        passes.forEach(pass => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    ${String(pass.pass_no).padStart(2,'0')}
                </td>
                <td>
                    ${pass.digging_time.toFixed(2)}
                    <small style="color:#8294a5">
                        detik
                    </small>
                </td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById('totalPasses').textContent = passes.length;
        calculateAverage();

        document.querySelectorAll('.pass-box')
            .forEach(box => {
                const no = parseInt(box.dataset.pass);
                box.classList.remove(
                    'done',
                    'current'
                );

                if (
                    passes.some(
                        p => p.pass_no === no
                    )
                ) {
                    box.classList.add('done');
                }

            });
    }

    function calculateAverage()
    {
        if (!passes.length) {
            document.getElementById('averageTime').textContent = '0.00';
            document.getElementById('categoryDisplay').textContent = 'BELUM ADA DATA';
            return;
        }


        const total =
            passes.reduce(
                (sum, item) =>
                    sum + item.digging_time,
                0
            );

        const average = total / passes.length;
        document.getElementById('averageTime').textContent = average.toFixed(2);

        let category;
        if (average <= 12) {
            category = 'MATERIAL BAGUS';
        } else if (average < 15) {
            category = 'INDIKASI MATERIAL KERAS';
        } else {
            category = 'MATERIAL KERAS';
        }

        document.getElementById('categoryDisplay').textContent = category;
    }

    document.getElementById('btnCancelLast')
        .addEventListener('click', function () {
            if (!passes.length) {
                alert('Belum ada pengukuran.');
                return;
            }


            passes.pop();

            currentPass = passes.length;
            renderPasses();
        });

    document.querySelectorAll('.choice-btn')
        .forEach(button => {
            button.addEventListener('click', function () {
                const name = this.dataset.name;
                const value = this.dataset.value;
                document.getElementById(name).value = value;
                document
                    .querySelectorAll(
                        `.choice-btn[data-name="${name}"]`
                    )
                    .forEach(btn => {
                        btn.classList.remove('active');
                    });
                this.classList.add('active');
            });

        });

    document.getElementById('btnSave').addEventListener('click', async function () {
            if (passes.length === 0) {
                if (
                    !confirm(
                        'Belum ada data digging time.\n\n' +
                        'Anda belum memasukkan pass.\n\n' +
                        'Tetap simpan?'
                    )
                ) {
                    return;
                }
            }

            const noUnit = document.getElementById('no_unit').value.trim();
            const tinggiJenjang = document.getElementById('tinggi_jenjang').value.trim();
            const lokasi = document.getElementById('lokasi').value;
            const material = document.getElementById('jenis_material').value;
            const operator = document.getElementById('nama_operator').value.trim();
            const pengawas = document.getElementById('nama_pengawas').value.trim();
            const area = document.getElementById('keterangan_area').value;

            document.querySelectorAll('.field-error')
                .forEach(el => el.classList.remove('field-error'));

            document.querySelectorAll('.field-error-text')
                .forEach(el => el.remove());

            const requiredFields = [
                { id: 'no_unit', value: noUnit, name: 'No. Unit Alat' },
                { id: 'tinggi_jenjang', value: tinggiJenjang, name: 'Tinggi Jenjang' },
                { id: 'lokasi', value: lokasi, name: 'Lokasi' },
                { id: 'jenis_material', value: material, name: 'Jenis Material' },
                { id: 'nama_operator', value: operator, name: 'Nama Operator' },
                { id: 'nama_pengawas', value: pengawas, name: 'Nama Pengawas' },
                { id: 'keterangan_area', value: area, name: 'Keterangan Area' }
            ];

            const emptyFields = [];

            requiredFields.forEach(field => {
                if (!field.value) {
                    const element = document.getElementById(field.id);

                    emptyFields.push(field.name);

                    if (element) {
                        element.classList.add('field-error');

                        const error = document.createElement('div');
                        error.className = 'field-error-text';
                        error.textContent = 'Field ini wajib diisi.';

                        element.parentElement.appendChild(error);
                    }
                }
            });

            if (emptyFields.length) {
                showValidationToast(emptyFields);

                const firstError = document.querySelector('.field-error');

                if (firstError) {
                    firstError.focus();
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }

                return;
            }

            if (!passes.length) {
                showValidationToast(['Data digging time']);

                return;
            }
            const pengawasOption =
                document.getElementById('nama_pengawas').selectedOptions[0];

            const nikPengawas =
                pengawasOption?.value || '';

            const namaPengawas =
                pengawasOption?.dataset.nama || '';

            const data = {
                tanggal: new Date().toISOString().substring(0, 10),
                jam: new Date().toTimeString().substring(0, 5),
                no_unit: document.getElementById('no_unit').value,
                tinggi_jenjang: document.getElementById('tinggi_jenjang').value,
                lokasi: document.getElementById('lokasi').value,
                titik_koordinat: document.getElementById('titik_koordinat').value,
                jenis_material: document.getElementById('jenis_material').value,
                nik_operator: document.getElementById('nik_operator').value,
                nama_operator: document.getElementById('nama_operator').value,
                nik_pengawas: nikPengawas,
                nama_pengawas: namaPengawas,
                passes_bucket: document.getElementById('passes_bucket').value,
                operator_fit: document.getElementById('operator_fit').value,
                kinerja_operator_rendah: document.getElementById('kinerja_operator_rendah').value,
                keterangan_area: document.getElementById('keterangan_area').value,
                passes: passes
            };

            const button = this;
            button.disabled = true;
            button.innerHTML = 'MENYIMPAN...';
            try {
                const response =
                    await fetch(
                        "{{ route('diggibility.post') }}",
                        {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN':
                                    document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        }
                    );
                const result = await response.json();
                if (!response.ok || !result.success) {
                    throw new Error(
                        result.message ||
                        'Gagal menyimpan data.'
                    );
                }
                showSuccessModal(
                    result.data.kategori,
                    result.data.average
                );

                // resetForm();
                setTimeout(() => {
                    window.location.href = "{{ route('diggibility') }}";
                }, 3000);
            } catch (error) {
                console.error(error);
                showErrorModal(
                    error.message ||
                    'Terjadi kesalahan saat menyimpan data.'
                );

            } finally {
                button.disabled = false;
                button.innerHTML = '➤ &nbsp; SIMPAN DATA AKHIR';
            }
        });

    function resetForm()
    {
        passes = [];
        currentPass = 0;
        startTime = null;
        if (timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
        }
        document.getElementById('diggingForm').reset();
        document.getElementById('operator_fit').value = 'Ya';
        document.getElementById('kinerja_operator_rendah').value = 'Tidak';
        document.getElementById('passTableBody').innerHTML = `
            <tr>
                <td colspan="2" class="text-center" style="color:#94a3b8">
                    Belum ada pengukuran
                </td>
            </tr>
        `;

        document.getElementById('totalPasses').textContent = '0';
        document.getElementById('averageTime').textContent = '0.00';
        document.getElementById('categoryDisplay').textContent = 'BELUM ADA DATA';

        document.querySelectorAll('.pass-box').forEach(box => {
            box.classList.remove('done');
        });

        document.querySelectorAll('.choice-btn').forEach(btn => {
                btn.classList.remove('active');
            });
        document.querySelector(
                '.choice-btn[data-name="operator_fit"][data-value="Ya"]'
            )
            ?.classList.add('active');

        document
            .querySelector(
                '.choice-btn[data-name="kinerja_operator_rendah"][data-value="Tidak"]'
            )
            ?.classList.add('active');

        timerDisplay.textContent = '00:00.00';
        btnDigging.disabled = false;
        btnStop.disabled = true;
    }

    function showSuccessModal(kategori, average)
    {
        document.getElementById('modalKategori').textContent =
            kategori || '-';

        document.getElementById('modalAverage').textContent =
            (average || 0) + ' detik';

        document.getElementById('successModal')
            .classList.add('show');
    }

    function closeSuccessModal()
    {
        document.getElementById('successModal')
            .classList.remove('show');
    }

    function showErrorModal(message)
    {
        document.getElementById('errorModalText').textContent =
            message || 'Terjadi kesalahan saat menyimpan data.';

        document.getElementById('errorModal')
            .classList.add('show');
    }

    function closeErrorModal()
    {
        document.getElementById('errorModal')
            .classList.remove('show');
    }

    function showValidationToast(fields)
    {
        const toast = document.getElementById('validationToast');
        const message = document.getElementById('validationToastMessage');

        message.textContent =
            'Mohon lengkapi: ' + fields.join(', ') + '.';

        toast.classList.add('show');

        clearTimeout(window.validationToastTimer);

        window.validationToastTimer = setTimeout(() => {
            toast.classList.remove('show');
        }, 4000);
    }

    function validateForm()
    {
        const fields = [];

        document.querySelectorAll('.field-error-text')
            .forEach(el => el.remove());

        document.querySelectorAll('.field-error')
            .forEach(el => el.classList.remove('field-error'));

        const requiredFields = [
            {
                id:'no_unit',
                name:'No. Unit Alat'
            },
            {
                id:'tinggi_jenjang',
                name:'Tinggi Jenjang'
            },
            {
                id:'lokasi',
                name:'Lokasi'
            },
            {
                id:'jenis_material',
                name:'Jenis Material'
            },
            {
                id:'nama_operator',
                name:'Nama Operator'
            },
            {
                id:'nama_pengawas',
                name:'Nama Pengawas'
            }
        ];

        requiredFields.forEach(field => {

            const element =
                document.getElementById(field.id);

            if (!element || !element.value.trim()) {

                fields.push(field.name);

                element.classList.add('field-error');

                const error =
                    document.createElement('div');

                error.className = 'field-error-text';
                error.textContent = 'Field ini wajib diisi.';

                element.parentElement.appendChild(error);
            }
        });

        const area =
            document.querySelector(
                'input[name="keterangan_area"]:checked'
            );

        if (!area) {

            fields.push('Keterangan Area');

            const areaContainer =
                document.querySelector('.area-container');

            if (areaContainer) {

                const error =
                    document.createElement('div');

                error.className = 'field-error-text';
                error.textContent = 'Pilih salah satu area.';

                areaContainer.appendChild(error);
            }
        }

        if (fields.length > 0) {

            showValidationToast(fields);

            const firstError =
                document.querySelector('.field-error');

            if (firstError) {
                firstError.focus();
            }

            return false;
        }

        return true;
    }

</script>