@include('layout.head', ['title' => 'Hazard Report'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .center-checkbox {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    @media (min-width: 769px) {

        .tab-pane .form-control,
        .tab-pane .form-select {
            font-size: 9pt;
            padding: 6px;
        }

        .tab-pane button {
            font-size: 9pt;
            padding: 6px;
        }

        .table tbody td,
        .table thead th {
            font-size: 9pt;
            padding: 6px;
        }
    }

    @media (max-width: 768px) {

        .tab-pane .form-control,
        .tab-pane .form-select {
            font-size: 9pt;
            padding: 6px;
        }

        .tab-pane button {
            font-size: 9pt;
            padding: 6px;
        }

        .table tbody td,
        .table thead th {
            font-size: 9pt;
            padding: 6px;
        }

        .description-text {
            word-wrap: break-word;
            white-space: normal;
            max-width: 100%;
            overflow-wrap: break-word;
        }

    }
    .card-modern{
        border:none;
        border-radius:14px;
        box-shadow:0 6px 20px rgba(0,0,0,0.08);
    }

    .section-title{
        font-weight:600;
        font-size:15px;
        margin-bottom:10px;
        color:#555;
    }

    .form-control,
    .form-select{
        border-radius:10px;
        padding:10px 12px;
        border:1px solid #e4e6ef;
        transition:all .2s;
    }

    .form-control:focus,
    .form-select:focus{
        border-color:#4f46e5;
        box-shadow:0 0 0 2px rgba(79,70,229,0.15);
    }

    textarea.form-control{
        min-height:90px;
    }

    .form-label{
        font-weight:500;
        color:#444;
    }

    .form-section{
        background:#fafafa;
        padding:18px;
        border-radius:12px;
        margin-bottom:20px;
    }

    .btn-modern{
        background:linear-gradient(135deg,#22c55e,#16a34a);
        border:none;
        padding:12px 30px;
        font-size:16px;
        border-radius:10px;
        color:white;
        font-weight:600;
        transition:all .2s;
    }

    .btn-modern:hover{
        transform:translateY(-1px);
        box-shadow:0 6px 14px rgba(0,0,0,0.15);
    }

    .form-title{
        font-weight:700;
        font-size:24px;
        margin-bottom:15px;
    }
    .ts-control{
        border-radius:10px !important;
        border:1px solid #e4e6ef !important;
        padding:10px !important;
    }

    .ts-control.focus{
        border-color:#4f46e5 !important;
        box-shadow:0 0 0 2px rgba(79,70,229,0.15);
    }

    .ts-dropdown{
        border-radius:10px;
        border:1px solid #eee;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    }

    .ts-dropdown .option{
        padding:10px;
    }

    .ts-dropdown .option.active{
        background:#f1f5ff;
        color:#4f46e5;
    }

    .btn-upload{
        background:linear-gradient(135deg,#22c55e,#16a34a);
        border:none;
        padding:12px 32px;
        font-size:16px;
        font-weight:600;
        border-radius:10px;
        color:white;
        letter-spacing:0.3px;
        transition:all .2s ease;
    }

    .btn-upload:hover{
        transform:translateY(-2px);
        box-shadow:0 8px 20px rgba(0,0,0,0.15);
    }

    .btn-upload:active{
        transform:scale(0.97);
    }
</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-md-10 col-xxl-9 mb-4">
                <div class="col-sm-12 col-md-6 col-xxl-4 justify-content-center">
                    <h3 class="form-title">Hazard Report</h3>
                </div>
                <div class="col-md-4">
                <div class="d-flex gap-2">

                    <a href="{{ url()->previous() }}"
                        class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 py-2 rounded">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                    </a>
                </div>
            </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-modern">
                    <div class="card-body">
                        <form id="laporanForm" action="{{ route('hazard-report.post') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-section">

                            <div class="section-title">Informasi Laporan</div>
                                <div class="mb-3">
                                    <label class="form-label">Kepada:</label>
                                    <input class="form-control" name="kepada" placeholder="Masukkan kepada siapa ditujukan..." required>
                                </div>
                                <div class="mb-3">
                                    <label for="perusahaan" class="form-label">Perusahaan:</label>
                                    <select class="form-select modern-select" data-trigger id="perusahaan" name="perusahaan" required>
                                        <option value="">--Pilih perusahaan--</option>
                                        <option value="PT. SIMS JAYA KALTIM">PT. SIMS JAYA KALTIM</option>
                                        <option value="PT. ABM">PT. ABM</option>
                                        <option value="PT. KJM">PT. KJM</option>
                                        <option value="PT. SM">PT. SM</option>
                                        <option value="PT. UT">PT. UT</option>
                                        <option value="PT. TRAKINDO">PT. TRAKINDO</option>
                                        <option value="PT. HEXINDO">PT. HEXINDO</option>
                                        <option value="PT. IWACO">PT. IWACO</option>
                                        <option value="PT. K2B">PT. K2B</option>
                                        <option value="PT. HMSI">PT. HMSI</option>
                                        <option value="PT. TRJA">PT. TRJA</option>
                                        <option value="PT. KWN">PT. KWN</option>
                                        <option value="PT. KRI">PT. KRI</option>
                                        <option value="PT. BIMA EV">PT. BIMA EV</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="departemen" class="form-label">Departemen:</label>
                                    <select class="form-select modern-select" data-trigger id="departemen" name="departemen" required>
                                        <option value="">--Pilih Departemen--</option>
                                        @foreach ($dep as $d)
                                            <option value="{{ $d->id }}">{{ $d->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="shift" class="form-label">Shift:</label>
                                    <select class="form-select modern-select" data-trigger id="shift" name="shift" required>
                                        <option value="">--Pilih Shift--</option>
                                        @foreach ($shift as $sh)
                                            <option value="{{ $sh->id }}">{{ $sh->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="text" id="pc-datepicker-1"
                                        class="form-control"
                                        value="{{ date('m/d/Y') }}"
                                        name="tanggal_pelaporan">
                                </div>

                                <div class="mb-3">
                                    <label>Jam Kejadian</label>
                                    <input type="text" id="pc-timepicker-1"
                                        class="form-control"
                                        value="{{ date('h:i A') }}"
                                        name="jam_pelaporan">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Lokasi:</label>
                                    <input class="form-control" name="lokasi" placeholder="Masukkan detail lokasi..."  required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload Bukti 1:</label>
                                    <input type="file" class="form-control" name="dokumentasi_1" accept="image/*" required/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload Bukti 2 :</label>
                                    <p>(jika ada)</p>
                                    <input type="file" class="form-control" name="dokumentasi_2" accept="image/*"  />
                                </div>
                            </div>
                            <hr>
                            <div class="form-section">

                                <div class="section-title">Analisis Risiko</div>
                                <div class="mb-3">
                                    <label class="form-label">Bahaya:</label>
                                    <textarea class="form-control" placeholder="Masukkan bahayanya..." name="bahaya" required></textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Risiko:</label>
                                    <textarea class="form-control" placeholder="Masukkan risiko..." name="risiko" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="tingkat_risiko" class="form-label">Tingkat Risiko:</label>
                                    <select class="form-select modern-select" data-trigger id="tingkat_risiko" name="tingkat_risiko">
                                        <option value="">--Pilih Tingkat Risiko--</option>
                                        <option value="Tidak Signifikan">Tidak Signifikan</option>
                                        <option value="Rendah">Rendah</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Tinggi">Tinggi</option>
                                        <option value="Ekstrim">Ekstrim</option>
                                    </select>
                                </div>

                                <!-- Pengendalian Awal-->

                            </div>
                            <hr>
                            <div class="form-section">

                                <div class="section-title">Rekomendasi Tindakan</div>
                                <div class="mb-3">
                                        <label class="form-label">Pengendalian Awal:</label>
                                        <textarea class="form-control" placeholder="Masukkan pengendalian awal..." name="pengendalian_awal"></textarea>
                                    </div>
                                <div class="mb-3">
                                    <label class="form-label">Rekomendasi Tindakan Perbaikan</label>
                                    <textarea class="form-control" placeholder="Masukkan rekomendasi tindakan perbaikan..." name="tindakan_perbaikan"></textarea>
                                </div>
                            </div>


                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-upload" id="submitSAP">
                                    ⬆ Upload Hazard Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- [ file-upload ] end -->
        </div><!-- [ Main Content ] end -->
    </div>
</section>


@include('layout.footer')

<script>
    const choices = new Choices('#tingkat_risiko', {
        searchEnabled: true,
        shouldSort: false
    });
window.onload = function () {

    let now = new Date();

    // ===== FORMAT TANGGAL MM/DD/YYYY =====
    let bulan = String(now.getMonth() + 1).padStart(2,'0');
    let hari = String(now.getDate()).padStart(2,'0');
    let tahun = now.getFullYear();

    document.getElementById("pc-datepicker-1").value = bulan + "/" + hari + "/" + tahun;

    // ===== FORMAT JAM HH:MM AM/PM =====
    let jam = now.getHours();
    let menit = String(now.getMinutes()).padStart(2,'0');

    let ampm = jam >= 12 ? "PM" : "AM";
    jam = jam % 12;
    jam = jam ? jam : 12;
    jam = String(jam).padStart(2,'0');

    document.getElementById("pc-timepicker-1").value = jam + ":" + menit + " " + ampm;

};
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.modern-select').forEach(function(el){

        new TomSelect(el,{
            create:false,
            sortField:{
                field:"text",
                direction:"asc"
            },
            dropdownClass:'ts-dropdown-modern',
            controlClass:'ts-control-modern'
        });

    });

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
                    return new File([obj], originalName, { type: obj.type || 'image/jpeg', lastModified: Date.now() });
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

            submitSAP.disabled = true;
            const originalText = submitSAP.innerText;
            submitSAP.innerText = 'Processing...';


            const safetyTimer = setTimeout(() => {
                submitSAP.disabled = false;
                submitSAP.innerText = originalText;
            }, 30000);

            try {
                const inputTemuan = formSAP.querySelector('input[name="file_temuan"]');
                const inputTindak = formSAP.querySelector('input[name="file_tindakLanjut"]');

                const options = {
                    maxSizeMB: 1.0,
                    maxWidthOrHeight: 1920,
                    useWebWorker: true,
                    initialQuality: 0.75
                };

                let compressedTemuan = null;
                let compressedTindak = null;

                if (inputTemuan && inputTemuan.files && inputTemuan.files.length > 0) {
                    compressedTemuan = await compressFileWithLib(inputTemuan.files[0], options);
                }
                if (inputTindak && inputTindak.files && inputTindak.files.length > 0) {
                    compressedTindak = await compressFileWithLib(inputTindak.files[0], options);
                }

                if (compressedTemuan) replaceInputFile(inputTemuan, compressedTemuan);
                if (compressedTindak) replaceInputFile(inputTindak, compressedTindak);

                // pemberitahuan kecil ke user
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-info mt-2';
                alertDiv.innerText = 'Gambar dikompres (client-side). Mengirim form...';
                formSAP.prepend(alertDiv);

                clearTimeout(safetyTimer);
                formSAP.submit();
            } catch (err) {
                console.error('Error during compression/submit:', err);
                clearTimeout(safetyTimer);
                submitSAP.disabled = false;
                submitSAP.innerText = originalText;

                const errDiv = document.createElement('div');
                errDiv.className = 'alert alert-danger mt-2';
                errDiv.innerText = 'Terjadi kesalahan saat memproses gambar. Mengirim form tanpa kompresi.';
                formSAP.prepend(errDiv);

                formSAP.submit();
            }
        });
    });
</script>

