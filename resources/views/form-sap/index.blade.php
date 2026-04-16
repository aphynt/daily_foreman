@include('layout.head', ['title' => 'Inspeksi PICA'])
@include('layout.sidebar')
@include('layout.header')

<style>
    :root {
        --pica-primary: #2563eb;
        --pica-primary-soft: rgba(37, 99, 235, 0.08);
        --pica-success: #16a34a;
        --pica-text: #0f172a;
        --pica-muted: #64748b;
        --pica-border: #e2e8f0;
        --pica-bg: #f8fafc;
        --pica-card: #ffffff;
        --pica-radius: 18px;
        --pica-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        --pica-shadow-soft: 0 4px 14px rgba(15, 23, 42, 0.06);
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
        font-weight: 700;
        color: var(--pica-text);
        margin: 0;
        letter-spacing: -0.02em;
    }

    .page-subtitle {
        color: var(--pica-muted);
        font-size: 0.95rem;
        margin-top: 6px;
    }

    .card {
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: var(--pica-radius);
        box-shadow: var(--pica-shadow);
        overflow: hidden;
        background: var(--pica-card);
    }

    .card-body {
        padding: 28px;
    }

    .form-section {
        border: 1px solid var(--pica-border);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        box-shadow: var(--pica-shadow-soft);
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .form-section-badge {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: var(--pica-primary-soft);
        color: var(--pica-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .form-section-title h5 {
        margin: 0;
        font-weight: 700;
        color: var(--pica-text);
    }

    .form-section-title p {
        margin: 2px 0 0;
        color: var(--pica-muted);
        font-size: 0.88rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--pica-text);
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        border: 1px solid var(--pica-border);
        min-height: 46px;
        padding: 10px 14px;
        font-size: 0.95rem;
        color: var(--pica-text);
        background-color: #fff;
        transition: all 0.2s ease;
        box-shadow: none;
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .form-control::placeholder,
    .form-select {
        color: #94a3b8;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: rgba(37, 99, 235, 0.45);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    .form-text-modern {
        display: block;
        margin-top: 6px;
        font-size: 0.82rem;
        color: var(--pica-muted);
    }

    .modern-divider {
        border: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #dbeafe, transparent);
        margin: 8px 0 0;
    }

    .file-input-wrap .form-control {
        padding: 10px 12px;
        background: #fcfdff;
    }

    .file-input-wrap .form-text-modern {
        margin-top: 8px;
    }

    .submit-wrap {
        position: sticky;
        bottom: 12px;
        z-index: 10;
        margin-top: 28px;
    }

    .submit-panel {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        border-radius: 16px;
        padding: 14px;
    }

    .btn-posting {
        width: 100%;
        min-height: 50px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.01em;
        transition: all 0.2s ease;
        box-shadow: 0 10px 18px rgba(34, 197, 94, 0.22);
    }

    .btn-posting:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 22px rgba(34, 197, 94, 0.25);
    }

    .btn-posting:disabled {
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

    @media (min-width: 769px) {
        .tab-pane .form-control,
        .tab-pane .form-select,
        .tab-pane button,
        .table tbody td,
        .table thead th {
            font-size: 9pt;
            padding: 6px;
        }
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 18px;
        }

        .form-section {
            padding: 16px;
            border-radius: 14px;
        }

        .page-title-wrap h3 {
            font-size: 1.35rem;
        }

        .tab-pane .form-control,
        .tab-pane .form-select,
        .tab-pane button,
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
</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-md-10 col-xxl-9 mb-4">
                <div class="page-title-wrap">
                    <h3>Inspeksi PICA</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="laporanForm" action="{{ route('form-pengawas-sap.post') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="form-section">
                                <div class="form-section-title">
                                    <span class="form-section-badge">1</span>
                                    <div>
                                        <h5>Informasi Inspektor</h5>
                                        <p>Isi data petugas yang terlibat dalam inspeksi.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inspektor1" class="form-label">Inspektor 1</label>
                                    <select class="form-select" id="inspektor1" name="inspektor1" data-trigger required>
                                        <option value="{{ Auth::user()->name }}" selected>{{ Auth::user()->name }}</option>
                                        @foreach ($pic as $p)
                                            <option value="{{ $p->nik }}">{{ $p->name }} ({{ $p->departemen }})</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text-modern">Default terisi dengan akun yang sedang login.</small>
                                </div>


                                <div class="mb-3">
                                    <label for="inspektor2" class="form-label">Inspektor 2 <span class="text-muted">(jika ada)</span></label>
                                    <select class="form-select" id="inspektor2" name="inspektor2" data-trigger>
                                        <option value="" selected>-- Pilih Inspektor 2 jika ada --</option>
                                        @foreach ($pic as $p)
                                            <option value="{{ $p->nik }}">{{ $p->name }} ({{ $p->departemen }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inspektor3" class="form-label">Inspektor 3 <span class="text-muted">(jika ada)</span></label>
                                    <select class="form-select" id="inspektor3" name="inspektor3" data-trigger>
                                        <option value="" selected>-- Pilih Inspektor 3 jika ada --</option>
                                        @foreach ($pic as $p)
                                            <option value="{{ $p->nik }}">{{ $p->name }} ({{ $p->departemen }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inspektor4" class="form-label">Inspektor 4 <span class="text-muted">(jika ada)</span></label>
                                    <select class="form-select" id="inspektor4" name="inspektor4" data-trigger>
                                        <option value="" selected>-- Pilih Inspektor 4 jika ada --</option>
                                        @foreach ($pic as $p)
                                            <option value="{{ $p->nik }}">{{ $p->name }} ({{ $p->departemen }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inspektor5" class="form-label">Inspektor 5 <span class="text-muted">(jika ada)</span></label>
                                    <input class="form-control" id="inspektor5" placeholder="Masukkan nama inspektor tambahan" name="inspektor5">
                                </div>

                                <div class="mb-3">
                                    <label for="level" class="form-label">PICA Level</label>
                                    <select class="form-select" id="level" name="level" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>


                            </div>

                            <div class="form-section">
                                <div class="form-section-title">
                                    <span class="form-section-badge">2</span>
                                    <div>
                                        <h5>Detail Lokasi & Waktu</h5>
                                        <p>Tentukan konteks inspeksi.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="shift" class="form-label">Shift</label>
                                    <select class="form-select" id="shift" name="shift" data-trigger required>
                                        @foreach ($shift as $sh)
                                            <option value="{{ $sh->id }}">{{ $sh->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="area" class="form-label">Area</label>
                                    <select class="form-select" id="area" name="area" data-trigger required>
                                        @foreach ($area as $ar)
                                            <option value="{{ $ar->id }}">{{ $ar->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="pc-timepicker-1" class="form-label">Jam Kejadian</label>
                                    <input type="text" id="pc-timepicker-1" class="form-control" value="" name="jamKejadian" placeholder="Pilih atau masukkan jam kejadian">
                                </div>






                            </div>

                            <div class="form-section">
                                <div class="form-section-title">
                                    <span class="form-section-badge">3</span>
                                    <div>
                                        <h5>Temuan Inspeksi</h5>
                                        <p>Catat temuan utama beserta dokumentasi pendukung.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Temuan KTA/TTA</label>
                                    <textarea class="form-control" placeholder="Jelaskan temuan secara singkat, jelas, dan spesifik" name="temuan" required></textarea>
                                </div>

                                <div class="mb-3 file-input-wrap">
                                    <label class="form-label">Foto Temuan 1</label>
                                    <input type="file" class="form-control" name="file_temuan" accept="image/*" required />
                                    <small class="form-text-modern">Format gambar disarankan JPG, PNG, atau WEBP.</small>
                                </div>

                                <div class="mb-3 file-input-wrap">
                                    <label class="form-label">Foto Temuan 2 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_temuan2" accept="image/*" />
                                </div>

                                {{-- <div class="mb-3 file-input-wrap">
                                    <label class="form-label">Foto Temuan 3 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_temuan3" accept="image/*" />
                                </div> --}}

                                <div class="mb-3">
                                    <label for="tingkatRisiko" class="form-label">Tingkat Risiko</label>
                                    <select class="form-select" id="tingkatRisiko" name="tingkatRisiko" required>
                                        <option value="Ringan">Ringan</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Tinggi">Tinggi</option>
                                    </select>
                                </div>



                                <div class="mb-0">
                                    <label for="departemen" class="form-label">PIC Departemen</label>
                                    <select class="form-select" id="departemen" name="departemen" data-trigger required>
                                        <option value="{{ $departemenSelected?->id ?? null }}">
                                            {{ $departemenSelected?->keterangan ?? 'Pilih Departemen' }}
                                        </option>
                                        @foreach ($departemen as $dep)
                                            <option value="{{ $dep->id }}">{{ $dep->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-section-title">
                                    <span class="form-section-badge">4</span>
                                    <div>
                                        <h5>Analisis Risiko</h5>
                                        <p>Tambahkan dampak dan pengendalian yang relevan.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Risiko</label>
                                    <textarea class="form-control" placeholder="Jelaskan potensi risiko dari temuan ini" name="risiko"></textarea>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Pengendalian</label>
                                    <textarea class="form-control" placeholder="Jelaskan pengendalian yang sudah ada atau yang disarankan" name="pengendalian"></textarea>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-section-title">
                                    <span class="form-section-badge">5</span>
                                    <div>
                                        <h5>Tindak Lanjut</h5>
                                        <p>Isi rencana atau bukti tindakan perbaikan.</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tindak Lanjut</label>
                                    <textarea class="form-control" placeholder="Masukkan tindak lanjut yang dilakukan" name="tindakLanjut"></textarea>
                                </div>

                                <div class="mb-3 file-input-wrap">
                                    <label class="form-label">Foto Bukti Tindak Lanjut 1</label>
                                    <input type="file" class="form-control" name="file_tindakLanjut" accept="image/*" />
                                </div>

                                <div class="mb-3 file-input-wrap">
                                    <label class="form-label">Foto Bukti Tindak Lanjut 2 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_tindakLanjut2" accept="image/*" />
                                </div>

                                {{-- <div class="mb-0 file-input-wrap">
                                    <label class="form-label">Foto Bukti Tindak Lanjut 3 <span class="text-muted">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="file_tindakLanjut3" accept="image/*" />
                                </div> --}}
                            </div>

                            <div class="submit-wrap">
                                <div class="submit-panel">
                                    <button type="submit" class="btn-posting" id="submitSAP">
                                        Posting Laporan
                                    </button>
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
            submitSAP.innerText = 'Memproses...';

            const oldAlerts = formSAP.querySelectorAll('.alert');
            oldAlerts.forEach(el => el.remove());

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

                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-info mt-3';
                alertDiv.innerText = 'Gambar sedang dioptimalkan dan form akan segera dikirim...';
                formSAP.prepend(alertDiv);

                clearTimeout(safetyTimer);
                formSAP.submit();
            } catch (err) {
                console.error('Error during compression/submit:', err);
                clearTimeout(safetyTimer);
                submitSAP.disabled = false;
                submitSAP.innerText = originalText;

                const errDiv = document.createElement('div');
                errDiv.className = 'alert alert-danger mt-3';
                errDiv.innerText = 'Terjadi kendala saat memproses gambar. Form tetap dikirim tanpa kompresi.';
                formSAP.prepend(errDiv);

                formSAP.submit();
            }
        });
    });
</script>
