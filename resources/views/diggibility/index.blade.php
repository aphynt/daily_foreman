@include('layout.head', ['title' => 'Analisis Kualitas Material Blasting'])
@include('layout.sidebar')
@include('layout.header')

<style>
.dig-page{
    background:#eef3f6;
    min-height:calc(100vh - 70px);
    padding:18px 22px;
}
.dig-wrap{
    max-width:1500px;
    margin:auto;
}
.dig-hero{
    position:relative;
    min-height:176px;
    padding:30px 28px;
    margin-bottom:16px;
    overflow:hidden;
    color:#fff;
    background:
        radial-gradient(circle at 85% 30%,rgba(25,105,190,.35),transparent 32%),
        linear-gradient(115deg,#020b16 0%,#071b31 38%,#0b3157 72%,#02070d 100%);
    box-shadow:0 8px 25px rgba(0,25,55,.18);
}
.dig-hero::before{
    content:"";
    position:absolute;
    width:420px;
    height:420px;
    right:-180px;
    top:-230px;
    border-radius:50%;
    background:rgba(24,112,205,.18);
    filter:blur(20px);
}
.dig-hero::after{
    content:"";
    position:absolute;
    width:300px;
    height:1px;
    right:80px;
    bottom:35px;
    background:linear-gradient(90deg,transparent,rgba(67,158,236,.5),transparent);
    transform:rotate(-18deg);
}
.dig-kicker{
    position:relative;
    z-index:2;
    letter-spacing:2px;
    font-weight:800;
    margin-bottom:6px;
}
.dig-title{
    position:relative;
    z-index:2;
    line-height:.92;
    font-weight:900;
    margin:0 0 10px;
    text-transform:uppercase;
    max-width:650px;
    font-size: 30px;
}
.dig-sub{
    position:relative;
    z-index:2;
    opacity:.85;
}
.dig-new{
    position:absolute;
    z-index:3;
    right:25px;
    bottom:25px;
    background:#f47b2b;
    color:#fff;
    border:0;
    padding:12px 20px;
    font-weight:800;
    text-decoration:none;
    transition:.2s;
}
.dig-new:hover{
    background:#ff9145;
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(244,123,43,.3);
}
.dig-summary{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    background:#fff;
    border:1px solid #ccd9e2;
    margin-bottom:16px;
}
.dig-summary-item{
    min-height:72px;
    padding:13px 18px;
    border-right:1px solid #d5dfe7;
}
.dig-summary-item:last-child{
    border-right:0;
}
.dig-label{
    color:#71869a;
    text-transform:uppercase;
    font-weight:800;
    letter-spacing:.4px;
}
.dig-number{
    line-height:1;
    margin-top:4px;
    font-weight:900;
    color:#174473;
}
.dig-section{
    background:#fff;
    border:1px solid #c4d3de;
    padding:17px;
    margin-bottom:12px;
}
.dig-section-title{
    line-height:1;
    font-weight:900;
    color:#174476;
    text-transform:uppercase;
}
.dig-section-sub{
    color:#74899c;
    margin:6px 0 14px;
}
.dig-filter{
    display:grid;
    grid-template-columns:1.2fr 1.2fr 1.1fr .9fr .9fr auto;
    gap:9px;
    border-top:1px solid #d8e1e8;
    padding-top:14px;
}
.dig-filter label{
    display:block;
    color:#5e7387;
    font-weight:800;
    margin-bottom:5px;
}
.dig-filter select,
.dig-filter input{
    width:100%;
    height:36px;
    border:1px solid #bdcdd9;
    background:#fff;
    color:#345675;
    padding:5px 10px;
    outline:none;
}
.dig-filter select:focus,
.dig-filter input:focus{
    border-color:#1e568e;
}
.dig-filter button{
    height:36px;
    background:#fff;
    border:1px solid #aebfce;
    color:#345a78;
    font-weight:900;
    padding:0 15px;
    margin-top:18px;
}
.dig-cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:8px;
    margin-bottom:12px;
}
.dig-card{
    min-height:91px;
    background:#fff;
    border-left:3px solid #23966f;
    padding:14px 15px;
    box-shadow:0 2px 7px rgba(30,60,80,.05);
}
.dig-card.normal{
    border-left-color:#2467b1;
}
.dig-card.indikasi{
    border-left-color:#e38b15;
}
.dig-card.keras{
    border-left-color:#d5413b;
}
.dig-card .big{
    line-height:1;
    margin:5px 0;
    font-weight:900;
    color:#17446f;
}
.dig-card .small{
    color:#7890a3;
}

.dig-area-title{
    font-weight:900;
    color:#174476;
    text-transform:uppercase;
    margin-bottom:7px;
}
.dig-area-value{
    line-height:1;
    font-weight:900;
    color:#164b78;
}
.dig-area-value small{
    font-weight:600;
    color:#71869a;
}
.dig-area-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:8px;
}
.dig-area-grid-lokasi{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:8px;
}
.dig-area-box{
    min-height:145px;
    background:#fff;
    border:1px solid #cbd8e2;
    padding:13px;
}
.dig-area-box.area-bagus{
    border-color:#28a879;
}
.dig-area-box.area-indikasi{
    border-color:#e58a0b;
}
.dig-area-box.area-keras{
    border-color:#d34842;
}
.dig-area-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
}
.area-badge{
    padding:4px 7px;
    font-weight:900;
    white-space:nowrap;
}
.badge-bagus{
    background:#dff3e9;
    color:#188357;
}
.badge-indikasi{
    background:#fff0d6;
    color:#b86d08;
}
.badge-keras{
    background:#fbe1df;
    color:#c43b34;
}
.dig-mini{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:5px;
    margin-top:9px;
}
.dig-mini div{
    background:#f8fafb;
    border:1px solid #d6e0e6;
    padding:7px;
    color:#71869a;
}
.dig-mini b{
    display:block;
    line-height:1;
    color:#174476;
    margin-bottom:3px;
}
.dig-mini .mini-bagus{
    background:#f3faf7;
}
.dig-mini .mini-indikasi{
    background:#fff9ee;
}
.dig-mini .mini-keras{
    background:#fff5f4;
}
.dig-progress{
    height:6px;
    background:#e5ebef;
    margin:11px 0 7px;
    overflow:hidden;
}
.dig-progress span{
    display:block;
    height:100%;
}
.area-bagus .dig-progress span{
    background:#22966f;
}
.area-indikasi .dig-progress span{
    background:#e38b15;
}
.area-keras .dig-progress span{
    background:#d5413b;
}
.area-summary{
    color:#71869a;
    margin-top:6px;
}

.dig-table{
    width:100%;
    border-collapse:collapse;
}
.dig-table th{
    background:#eef3f6;
    color:#617b91;
    text-align:left;
    padding:9px;
}
.dig-table td{
    border-top:1px solid #dce4e9;
    padding:9px;
    color:#345572;
}
.dig-badge{
    padding:7px 10px;
    font-weight:900;
    white-space:nowrap;
}
.badge-bagus{
    background:#dff3e9;
    color:#188357;
}
.badge-indikasi{
    background:#fff0d6;
    color:#b86d08;
}
.badge-keras{
    background:#fbe1df;
    color:#c43b34;
}
.dig-report{
    border:1px solid #cbd8e2;
    background:#fff;
    margin-top:9px;
    padding:14px;
}
.dig-report-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.dig-report-date{
    color:#7890a4;
    margin-bottom:3px;
}
.dig-report-unit{
    font-weight:900;
    color:#174476;
}
.dig-report-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    background:#f5f8fa;
    margin-top:9px;
}
.dig-report-grid div{
    padding:10px 12px;
    border-right:1px solid #d7e0e7;
}
.dig-report-grid div:last-child{
    border-right:0;
}
.dig-report-grid span{
    display:block;
    color:#7b8fa1;
    text-transform:uppercase;
    margin-bottom:3px;
}
.dig-report-grid b{
    color:#1a4268;
}
.dig-report-foot{
    display:flex;
    align-items:center;
    margin-top:10px;
    color:#8293a2;
}
.dig-report-foot .dig-view{
    margin-left:8px;
}
.dig-report-foot .dig-view:first-of-type{
    margin-left:auto;
}
.dig-view{
    border:1px solid #b8cad8;
    background:#fff;
    padding:7px 11px;
    color:#355a78;
    font-weight:800;
}
.report-overlay{
    position:fixed;
    inset:0;
    z-index:9999;
    background:rgba(15,35,52,.78);
    display:none;
    align-items:center;
    justify-content:center;
    padding:18px;
}
.report-overlay.show{
    display:flex;
}
.report-modal{
    width:min(765px,100%);
    max-height:96vh;
    background:#fff;
    box-shadow:0 20px 60px rgba(0,0,0,.3);
    display:flex;
    flex-direction:column;
}
.report-header{
    height:74px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 18px;
    border-bottom:1px solid #d7e0e7;
}
.report-brand{
    display:flex;
    align-items:center;
    gap:10px;
}
.report-logo{
    width:42px;
    height:42px;
    border-radius:50%;
    border:1px solid #d5dfe7;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#1b4d83;
}
.report-brand-small{
    color:#607991;
    font-weight:800;
    letter-spacing:1.5px;
}
.report-brand-title{
    color:#174a80;
    font-weight:900;
    letter-spacing:1px;
}
.report-close{
    width:34px;
    height:34px;
    border:0;
    background:#edf3f7;
    color:#42647f;
    cursor:pointer;
}
.report-body{
    padding:30px 38px;
    overflow-y:auto;
    background:
        radial-gradient(circle at 10% 20%,rgba(220,228,234,.2),transparent 25%),
        #fff;
}
.report-title{
    text-align:center;
    color:#174574;
}
.report-title h2{
    margin:0;
    font-weight:900;
}
.report-title div{
    color:#627b91;
    letter-spacing:1px;
    margin-top:4px;
}
.report-line{
    height:1px;
    background:#1d5aa0;
    margin:14px 0 11px;
}
.report-status{
    display:inline-block;
    background:#e7f0fa;
    color:#1d5790;
    padding:8px 12px;
    font-weight:800;
    margin-bottom:12px;
}
.report-average{
    border:2px solid #1c59a0;
    background:#e7f0fa;
    text-align:center;
    padding:18px;
}
.report-average-label{
    color:#1d4f82;
    font-weight:800;
    letter-spacing:1px;
}
.report-average-value{
    color:#15529a;
    font-weight:900;
    line-height:1;
    margin-top:6px;
    font-size: 60px;
}
.report-average-unit{
    color:#24517e;
    font-weight:800;
}
.report-average-info{
    display:flex;
    justify-content:center;
    gap:7px;
    border-top:1px solid #b6cae0;
    width:max-content;
    max-width:100%;
    margin:10px auto 0;
    padding-top:7px;
    color:#24517e;
    font-weight:800;
}
.report-info{
    display:grid;
    grid-template-columns:1fr 1fr;
    border:1px solid #cbd8e2;
    margin-top:14px;
}
.report-info > div{
    min-height:54px;
    padding:9px 12px;
    border-right:1px solid #d5dfe7;
    border-bottom:1px solid #d5dfe7;
}
.report-info > div:nth-child(even){
    border-right:0;
}
.report-info span{
    display:block;
    color:#70869a;
    font-weight:800;
    margin-bottom:3px;
}
.report-info b{
    color:#183f65;
}
.report-footer-info{
    display:flex;
    justify-content:space-between;
    gap:20px;
    padding:14px 0 5px;
    color:#71879a;
}
.report-pass-section{
    margin-top:15px;
    border-top:1px solid #d5dfe7;
    padding-top:12px;
}
.report-pass-title{
    color:#174574;
    font-weight:900;
    margin-bottom:7px;
}
.report-pass-section table{
    width:100%;
    border-collapse:collapse;
}
.report-pass-section th{
    background:#1e5795;
    color:#fff;
    padding:8px;
    text-align:left;
}
.report-pass-section td{
    border:1px solid #d6e0e7;
    padding:7px 9px;
    color:#345675;
}
.report-actions{
    display:flex;
    justify-content:flex-end;
    gap:8px;
    padding:14px 18px;
    background:#f1f5f8;
    border-top:1px solid #d5dfe7;
}
.report-btn{
    border:0;
    padding:11px 18px;
    font-weight:800;
    cursor:pointer;
}
.report-btn-delete{
    background:#fbe3e1;
    color:#c43b34;
    border:1px solid #efc2be;
}
.report-btn-delete:hover{
    background:#c43b34;
    color:#fff;
}

.report-btn-close{
    background:#e8eef2;
    color:#365675;
}
.report-btn-print{
    background:#e8eef2;
    color:#365675;
}
.report-btn-pdf{
    background:#205798;
    color:#fff;
    min-width:180px;
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
@media(max-width:1100px){
    .dig-filter{
        grid-template-columns:repeat(3,1fr);
    }
    .dig-filter button{
        margin-top:0;
    }
}
@media(max-width:800px){
    .dig-page{
        padding:12px;
    }
    .dig-cards{
        grid-template-columns:repeat(2,1fr);
    }
    .dig-area-grid{
        grid-template-columns:1fr;
    }
    .dig-area-grid-lokasi{
        grid-template-columns:1fr;
    }
}
@media(max-width:600px){
    .dig-hero{
        min-height:190px;
        padding:22px 18px;
    }
    .dig-new{
        right:18px;
        bottom:18px;
    }
    .dig-summary{
        grid-template-columns:1fr;
    }
    .dig-summary-item{
        border-right:0;
        border-bottom:1px solid #d5dfe7;
    }
    .dig-filter{
        grid-template-columns:1fr 1fr;
    }
    .dig-cards{
        grid-template-columns:1fr 1fr;
    }
    .dig-report-grid{
        grid-template-columns:1fr;
    }
    .dig-report-grid div{
        border-right:0;
        border-bottom:1px solid #d7e0e7;
    }
    .report-overlay{
        padding:8px;
    }
    .report-modal{
        max-height:98vh;
    }
    .report-body{
        padding:20px 15px;
    }
    .report-info{
        grid-template-columns:1fr;
    }
    .report-info > div,
    .report-info > div:nth-child(even){
        border-right:0;
    }
    .report-footer-info{
        flex-direction:column;
    }
    .report-actions{
        flex-wrap:wrap;
    }
    .report-btn-pdf{
        flex:1;
    }
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
</style>

<div class="pc-container">
    <div class="pc-content dig-page">
        <div class="dig-wrap">

            <div class="dig-hero">
                {{-- <div class="dig-kicker">DATABASE TEAM / LIVE</div> --}}
                <div class="dig-title">ANALISIS KUALITAS<br>MATERIAL BLASTING.</div>
                <a href="{{ route('diggibility.insert') }}" class="dig-new">＋ Laporan baru</a>
            </div>

            <div class="dig-summary">
                <div class="dig-summary-item">
                    <div class="dig-label">Laporan Terisi</div>
                    <div class="dig-number">{{ $totalLaporan }}</div>
                </div>
                <div class="dig-summary-item">
                    <div class="dig-label">Pengawas Terdata</div>
                    <div class="dig-number">{{ $totalPengawas }}</div>
                </div>
                <div class="dig-summary-item">
                    <div class="dig-label">Material Bagus</div>
                    <div class="dig-number">{{ $persenBagus }}%</div>
                </div>
            </div>

            <div class="dig-section">
                <div class="dig-section-title">Analisis Kualitas Material</div>
                <div class="dig-section-sub">Gunakan filter untuk melihat perubahan kualitas material pada rentang tanggal atau lokasi tertentu.</div>

                <form method="GET" action="{{ route('diggibility') }}" class="dig-filter">
                    <div>
                        <label>PENGAWAS</label>
                        <select name="pengawas">
                            <option value="">Semua pengawas</option>
                            @foreach($pengawas as $item)
                                <option value="{{ $item }}" {{ request('pengawas') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>LOKASI</label>
                        <select name="lokasi">
                            <option value="">Semua lokasi</option>
                            @foreach($lokasiList as $item)
                                <option value="{{ $item }}" {{ request('lokasi') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>JENIS MATERIAL</label>
                        <select name="jenis_material">
                            <option value="">Semua material</option>
                            @foreach($materialList as $item)
                                <option value="{{ $item }}" {{ request('jenis_material') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>DARI TANGGAL</label>
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                    </div>

                    <div>
                        <label>SAMPAI TANGGAL</label>
                        <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                    </div>

                    <button type="submit">TERAPKAN</button>
                </form>
            </div>

            <div class="dig-cards">
                <div class="dig-card">
                    <div class="dig-label">Material Bagus</div>
                    <div class="big">{{ $totalBagus }}</div>
                    <div class="small">{{ $persenBagus }}% laporan</div>
                </div>
                <div class="dig-card normal">
                    <div class="dig-label">Material Normal</div>
                    <div class="big">{{ $totalBagus }}</div>
                    <div class="small">{{ $persenBagus }}% laporan</div>
                </div>
                <div class="dig-card indikasi">
                    <div class="dig-label">Indikasi Keras</div>
                    <div class="big">{{ $totalIndikasi }}</div>
                    <div class="small">{{ $persenIndikasi }}% perlu perhatian</div>
                </div>
                <div class="dig-card keras">
                    <div class="dig-label">Material Keras</div>
                    <div class="big">{{ $totalKeras }}</div>
                    <div class="small">{{ $persenKeras }}% perlu evaluasi blasting</div>
                </div>
            </div>

            <div class="dig-section">
                <div class="dig-label">ANALISIS SISI AREA</div>
                <div class="dig-section-title">HIGHWALL - TENGAH - FREEFACE</div>

                <div class="dig-area-grid">
                    @foreach(['Sisi Highwall','Sisi Tengah','Sisi Freeface'] as $namaArea)
                        @php
                            $item = $area->get($namaArea, ['total'=>0,'bagus'=>0,'indikasi'=>0,'keras'=>0]);
                            $status = $item['keras'] > 0 ? 'keras' : ($item['indikasi'] > 0 ? 'indikasi' : 'bagus');
                        @endphp
                        <div class="dig-area-box area-{{ $status }}">
                            <div class="dig-area-head">
                                <div class="dig-area-title">{{ $namaArea }}</div>
                                @if($status === 'bagus' && $item['total'] > 0)
                                    <span class="area-badge badge-bagus">DOMINAN BAGUS</span>
                                @elseif($status === 'keras' && $item['total'] > 0)
                                    <span class="area-badge badge-keras">PRIORITAS EVALUASI</span>
                                @elseif($status === 'indikasi' && $item['total'] > 0)
                                    <span class="area-badge badge-indikasi">INDIKASI</span>
                                @endif
                            </div>
                            <div class="dig-area-value">{{ $item['total'] }} <small>laporan</small></div>
                            <div class="dig-mini">
                                <div class="mini-bagus"><b>{{ $item['bagus'] }}</b>Bagus</div>
                                <div class="mini-indikasi"><b>{{ $item['indikasi'] }}</b>Indikasi</div>
                                <div class="mini-keras"><b>{{ $item['keras'] }}</b>Keras</div>
                            </div>
                            <div class="dig-progress">
                                <span style="width:{{ $item['total'] ? (($status === 'bagus' ? $item['bagus'] : ($status === 'indikasi' ? $item['indikasi'] : $item['keras'])) / $item['total']) * 100 : 0 }}%"></span>
                            </div>
                            <div class="area-summary">
                                {{ $item['total'] ? round(($item['bagus'] / $item['total']) * 100) : 0 }}% Material Bagus · {{ $item['indikasi'] }} temuan indikasi · {{ $item['keras'] }} temuan keras
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="dig-area-grid-lokasi">
                <div class="dig-section">
                    <div class="dig-label">PERBANDINGAN LOKASI</div>
                    <div class="dig-section-title">LOKASI TERDATA</div>

                    @forelse($lokasi as $nama => $item)
                        <div class="dig-area-box" style="margin-top:5px">
                            <div class="dig-area-title">{{ $nama }}</div>
                            <div class="dig-mini">
                                <div><b>{{ $item['total'] }}</b>Total</div>
                                <div><b>{{ $item['bagus'] }}</b>Bagus</div>
                                <div><b>{{ $item['keras'] }}</b>Keras</div>
                            </div>
                        </div>
                    @empty
                        <div class="dig-section-sub">Belum ada data lokasi.</div>
                    @endforelse
                </div>

                <div class="dig-section">
                    <div class="dig-label">PERUBAHAN PERIODIK</div>
                    <div class="dig-section-title">TREND KUALITAS HARIAN</div>

                    <table class="dig-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Bagus</th>
                                <th>Keras</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trend as $tanggal => $item)
                                <tr>
                                    <td>{{ $tanggal }}</td>
                                    <td>{{ $item['total'] }}</td>
                                    <td>{{ $item['bagus'] }}</td>
                                    <td>{{ $item['keras'] }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                @forelse($data->take(30) as $item)
                    @php
                        $badge = match($item->kategori) {
                            'MATERIAL BAGUS' => 'badge-bagus',
                            'INDIKASI MATERIAL KERAS' => 'badge-indikasi',
                            default => 'badge-keras'
                        };
                    @endphp

                    <div class="dig-report">
                        <div class="dig-report-head">
                            <div>
                                <div class="dig-report-date">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}, {{ $item->jam }}
                                </div>
                                <div class="dig-report-unit">
                                    {{ $item->no_unit }} · {{ $item->lokasi }}
                                </div>
                            </div>
                            <span class="dig-badge {{ $badge }}">{{ $item->kategori }}</span>
                        </div>

                        <div class="dig-report-grid">
                            <div>
                                <span>PENGAWAS</span>
                                <b>{{ $item->nama_pengawas ?: '-' }}</b>
                            </div>
                            <div>
                                <span>AVG. DIGGING TIME</span>
                                <b>{{ number_format($item->average_digging_time, 2) }} detik</b>
                            </div>
                            <div>
                                <span>SISI AREA</span>
                                <b>{{ $item->keterangan_area ?: '-' }}</b>
                            </div>
                        </div>

                        <div class="dig-report-foot">
                            <span>♙ Operator: {{ $item->nama_operator ?: '-' }}</span>
                            <button type="button" class="dig-view" onclick="showReport({{ $item->id }})">▣ Lihat laporan</button>
                            <button type="button" class="dig-view report-btn-delete" onclick="deleteReport({{ $item->id }})">▣ Hapus</button>
                        </div>
                    </div>
                @empty
                    <div class="dig-section text-center">Belum ada laporan.</div>
                @endforelse
            </div>

        </div>
    </div>
</div>
<div id="reportModal" class="report-overlay">
    <div class="report-modal">

        <div class="report-header">
            <div class="report-brand">
                <div class="report-logo">◉</div>
                <div>
                    <div class="report-brand-small">MONITORING</div>
                    <div class="report-brand-title">DIGGIBILITY</div>
                </div>
            </div>

            <button type="button" class="report-close" onclick="closeReport()">
                ×
            </button>
        </div>

        <div class="report-body">

            <div class="report-title">
                <h3>MONITORING DIGGIBILITY MATERIAL BLASTING</h3>
            </div>

            <div class="report-line"></div>

            <div class="report-status" id="reportKategori">
                MATERIAL NORMAL
            </div>

            <div class="report-average">

                <div class="report-average-label">
                    AVERAGE DIGGING TIME
                </div>

                <div class="report-average-value" id="reportAverage">
                    0.00
                </div>

                <div class="report-average-unit">
                    DETIK
                </div>

                <div class="report-average-info">
                    <span id="reportKategoriBottom">MATERIAL NORMAL</span>
                    <span>•</span>
                    <span id="reportArea">SISI HIGHWALL</span>
                </div>

            </div>

            <div class="report-info">
                <div>
                    <span>ID LAPORAN</span>
                    <b id="reportId">-</b>
                </div>
                <div>
                    <span>WAKTU LAPORAN</span>
                    <b id="reportWaktu">-</b>
                </div>
                <div>
                    <span>NO. UNIT</span>
                    <b id="reportUnit">-</b>
                </div>
                <div>
                    <span>LOKASI</span>
                    <b id="reportLokasi">-</b>
                </div>
                <div>
                    <span>TITIK KOORDINAT</span>
                    <b id="reportKoordinat">-</b>
                </div>
                <div>
                    <span>TINGGI JENJANG</span>
                    <b id="reportTinggi">-</b>
                </div>
                <div>
                    <span>JENIS MATERIAL</span>
                    <b id="reportMaterial">-</b>
                </div>
                <div>
                    <span>OPERATOR</span>
                    <b id="reportOperator">-</b>
                </div>
                <div>
                    <span>PENGAWAS</span>
                    <b id="reportPengawas">-</b>
                </div>
                <div>
                    <span>PASSES BUCKET</span>
                    <b id="reportPassesBucket">-</b>
                </div>
                <div>
                    <span>TOTAL PASSES</span>
                    <b id="reportTotalPasses">-</b>
                </div>

            </div>

            <div class="report-footer-info">
                <span>Dibuat oleh: <b id="reportCreatedBy">-</b></span>
            </div>

            <div class="report-pass-section">
                <div class="report-pass-title">
                    RINCIAN PASS
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>PASS</th>
                            <th>DIGGING TIME</th>
                        </tr>
                    </thead>
                    <tbody id="reportPassBody"></tbody>
                </table>
            </div>
        </div>

        <div class="report-actions">
            <button
                type="button"
                class="report-btn report-btn-close"
                onclick="closeReport()">
                Tutup
            </button>

            {{-- <button
                type="button"
                class="report-btn report-btn-print"
                onclick="printReport()">
                ⇩ &nbsp; Cetak
            </button> --}}

            {{-- <button
                type="button"
                class="report-btn report-btn-pdf"
                onclick="sendReportPdf()">
                ➤ &nbsp; Download PDF
            </button> --}}

        </div>

    </div>
</div>
@include('layout.footer')

<script>
    async function showReport(id)
    {
        try {
            const response = await fetch(
                "{{ url('/diggibility/show') }}/" + id
            );

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message || 'Data tidak ditemukan.');
            }
            const d = result.data;
            document.getElementById('reportId').textContent = d.uuid || d.id || '-';
            document.getElementById('reportWaktu').textContent = formatReportDate(d.tanggal, d.jam);
            document.getElementById('reportUnit').textContent = d.no_unit || '-';
            document.getElementById('reportLokasi').textContent = d.lokasi || '-';
            document.getElementById('reportKoordinat').textContent = d.titik_koordinat || '-';
            document.getElementById('reportTinggi').textContent = d.tinggi_jenjang ? d.tinggi_jenjang + ' m' : '-';
            document.getElementById('reportMaterial').textContent = d.jenis_material || '-';
            document.getElementById('reportOperator').textContent = `${d.nik_operator || '-'} - ${d.nama_operator || '-'}`;
            document.getElementById('reportPengawas').textContent = `${d.nik_pengawas || '-'} - ${d.nama_pengawas || '-'}`;
            document.getElementById('reportPassesBucket').textContent = d.passes_bucket || '-';
            document.getElementById('reportTotalPasses').textContent = d.total_passes || 0;
            document.getElementById('reportAverage').textContent = Number(d.average_digging_time || 0).toFixed(2);
            document.getElementById('reportKategori').textContent = d.kategori || '-';
            document.getElementById('reportKategoriBottom').textContent = d.kategori || '-';
            document.getElementById('reportArea').textContent = d.keterangan_area || '-';
            document.getElementById('reportCreatedBy').textContent = d.nama_pic || '-';
            const passBody = document.getElementById('reportPassBody');
            passBody.innerHTML = '';
            if (d.passes && d.passes.length) {
                d.passes.forEach(pass => {
                    passBody.innerHTML += `
                        <tr>
                            <td>${String(pass.pass_no).padStart(2, '0')}</td>
                            <td>${Number(pass.digging_time).toFixed(2)} detik</td>
                        </tr>
                    `;
                });
            } else {
                passBody.innerHTML = `
                    <tr>
                        <td colspan="2" class="text-center">
                            Tidak ada detail pass.
                        </td>
                    </tr>
                `;

            }
            document.getElementById('reportModal').classList.add('show');
        } catch (error) {
            console.error(error);
            Swal.fire({
                icon:'error',
                title:'Gagal',
                text:error.message
            });

        }
    }

    async function deleteReport(id)
    {
        const confirm = await Swal.fire({
            icon:'warning',
            title:'Hapus laporan?',
            text:'Laporan ini akan dihapus dari daftar.',
            showCancelButton:true,
            confirmButtonText:'Ya, hapus',
            cancelButtonText:'Batal',
            confirmButtonColor:'#c43b34',
            cancelButtonColor:'#6c7a89'
        });

        if (!confirm.isConfirmed) {
            return;
        }

        try {
            const response = await fetch(
                "{{ url('/diggibility/destroy') }}/" + id,
                {
                    method:'DELETE',
                    headers:{
                        'Accept':'application/json',
                        'X-CSRF-TOKEN':document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                }
            );

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(
                    result.message || 'Gagal menghapus laporan.'
                );
            }

            await Swal.fire({
                icon:'success',
                title:'Berhasil',
                text:'Laporan berhasil dihapus.',
                timer:1500,
                showConfirmButton:false
            });

            window.location.reload();

        } catch (error) {
            console.error(error);

            Swal.fire({
                icon:'error',
                title:'Gagal menghapus',
                text:error.message || 'Terjadi kesalahan.'
            });
        }
    }

    function closeReport()
    {
        document.getElementById('reportModal').classList.remove('show');
    }

    function formatReportDate(tanggal, jam)
    {
        if (!tanggal) return '-';
        const date = new Date(tanggal + 'T00:00:00');
        const options = {
            day:'2-digit',
            month:'short',
            year:'numeric'
        };

        let result = date.toLocaleDateString(
            'id-ID',
            options
        );

        if (jam) {
            result += ', ' + jam;
        }

        return result;
    }

    document.getElementById('reportModal')
        .addEventListener('click', function(e){
            if (e.target === this) {
                closeReport();
            }

        });

    document.addEventListener('keydown', function(e){
        if (e.key === 'Escape') {
            closeReport();
        }

    });

</script>