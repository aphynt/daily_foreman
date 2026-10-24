@include('layout.head', ['title' => 'Form Inspeksi'])
@include('layout.sidebar')
@include('layout.header')

@php
    $sapKondisiTidakAman = [
        "Sarana Pelindung/Pengaman tidak memadai",
        "APD tidak memadai, tidak layak/rusak",
        "Alat, peralatan dan material yang rusak",
        "Area kerja sempit dan Ruang Gerak Terbatas",
        "Bahaya kebakaran dan ledakan",
        "Pemeliharaan kebersihan/housekeeping yang buruk",
        "Kondisi lingkungan berbahaya (nature factor) : (Gas, debu, asap, gas beracun, kabut, angin ribut, Gempa, lapisan labil, retakan)",
        "Paparan kebisingan",
        "Paparan radiasi",
        "Paparan terhadap suhu tinggi atau rendah",
        "Pencahayaan yang kurang atau berlebihan/silau",
        "Ventilasi yang tidak memadai",
        "Sistem dan sarana peringatan yang tidak memadai",
        "Kondisi area kerja yang berbahaya (job factor) : (Jalan licin, Jalan bergelombang, blind spot, batuan gantung, superelevasi negatif)",
    ];
    $sapTindakanTidakAman = [
        "Mengoperasikan unit tanpa wewenang",
        "Gagal Memberi peringatan",
        "Gagal mengamankan, memperkokoh",
        "Mengoperasikan unit/peralatan di luar prosedur yang ditentukan",
        "Membuat peralatan safety tidak berfungsi",
        "Menggunakan peralatan yang rusak",
        "Tidak memakai APD secara benar",
        "Pemuatan / pembebanan material tidak sesuai prosedur",
        "Penempatan material/peralatan/unit tidak sesuai prosedur",
        "Mengangkat dengan cara yang salah",
        "Berada pada posisi/daerah yang tidak aman",
        "Memperbaiki unit/alat yang sedang beroperasi atau berenergi",
        "Berada di bawah pengaruh obat-obatan atau alcohol",
        "Bercanda berlebihan atau tidak serius melakukan pekerjaan",
        "Menggunakan peralatan yang tidak sesuai",
        "Mengabaikan pengamanan (tidak menerapkan LOTO/Barikade/Safety Cone)",
    ];
    $detailTemuan = old('detail_temuan', []);
    if (!is_array($detailTemuan)) { $detailTemuan = []; }
@endphp


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

<style>
.sap-trend-card{border:1px solid #e2e8f0;border-radius:14px;background:#fff;overflow:hidden;box-shadow:0 4px 14px rgba(15,23,42,.04)}
.sap-trend-heading{display:flex;align-items:center;gap:12px;padding:14px 16px;background:linear-gradient(135deg,rgba(37,99,235,.08),rgba(79,70,229,.04));border-bottom:1px solid #e2e8f0;color:#1e293b}
.sap-trend-heading>i{font-size:22px;color:#2563eb}.sap-trend-heading .small{color:#64748b;margin-top:2px}
.sap-trend-item{display:flex;align-items:flex-start;gap:10px;width:100%;height:100%;padding:11px 12px;border:1px solid #e2e8f0;border-radius:10px;background:#fff;cursor:pointer;transition:.18s ease;font-size:.9rem;line-height:1.4}
.sap-trend-item:hover{border-color:#93b4f5;background:#f7faff}.sap-trend-item input{margin-top:3px;flex:0 0 auto;accent-color:#2563eb}.sap-trend-item:has(input:checked){border-color:#2563eb;background:#eff6ff}
</style>


<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-md-10 col-xxl-9 mb-4">
                <div class="page-title-wrap">
                    <h3>Form Inspeksi</h3>
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
                                            <option value="{{ $p->name }}">{{ $p->name }} ({{ $p->departemen }})</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text-modern">Default terisi dengan akun yang sedang login.</small>
                                </div>


                                <div class="mb-3">
                                    <label for="inspektor2" class="form-label">Inspektor 2 <span class="text-muted">(jika ada)</span></label>
                                    <select class="form-select" id="inspektor2" name="inspektor2" data-trigger>
                                        <option value="" selected>-- Pilih Inspektor 2 jika ada --</option>
                                        @foreach ($pic as $p)
                                            <option value="{{ $p->name }}">{{ $p->name }} ({{ $p->departemen }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inspektor3" class="form-label">Inspektor 3 <span class="text-muted">(jika ada)</span></label>
                                    <select class="form-select" id="inspektor3" name="inspektor3" data-trigger>
                                        <option value="" selected>-- Pilih Inspektor 3 jika ada --</option>
                                        @foreach ($pic as $p)
                                            <option value="{{ $p->name }}">{{ $p->name }} ({{ $p->departemen }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="inspektor4" class="form-label">Inspektor 4 <span class="text-muted">(jika ada)</span></label>
                                    <select class="form-select" id="inspektor4" name="inspektor4" data-trigger>
                                        <option value="" selected>-- Pilih Inspektor 4 jika ada --</option>
                                        @foreach ($pic as $p)
                                            <option value="{{ $p->name }}">{{ $p->name }} ({{ $p->departemen }})</option>
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
                                    <input class="form-control" id="area" placeholder="Masukkan area" name="area" required>
                                    {{-- <select class="form-select" id="area" name="area" data-trigger required>
                                        @foreach ($area as $ar)
                                            <option value="{{ $ar->id }}">{{ $ar->keterangan }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>

                                <div class="mb-3">
                                    <label for="pc-datepicker-1" class="form-label">Tanggal Kejadian</label>
                                    <input type="date" class="form-control form-control-sm pb-2" id="date" name="tanggalKejadian" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pc-timepicker-1" class="form-label">Jam Kejadian</label>
                                    <input type="time" class="form-control form-control-sm pb-2" id="time" name="jamKejadian" required>
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
                                        <option value="Tidak Signifikan">Tidak Signifikan</option>
                                        <option value="Rendah">Rendah</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Tinggi">Tinggi</option>
                                        <option value="Ekstrim">Ekstrim</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="kategoriBahaya" class="form-label">Kategori Bahaya</label>
                                    <select class="form-select modern-select" data-trigger id="kategoriBahaya" name="kategoriBahaya" required>
                                        <option value="">Pilih Kategori Bahaya</option>
                                        <option value="Tindakan Tidak Aman">Tindakan Tidak Aman</option>
                                        <option value="Kondisi Tidak Aman">Kondisi Tidak Aman</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="typeBahaya" class="form-label">Type Bahaya</label>
                                    <select class="form-select modern-select" data-trigger id="typeBahaya" name="typeBahaya" required>
                                        <option value="">Pilih Type Bahaya</option>
                                        <option value="Safety">Safety</option>
                                        <option value="Health">Health</option>
                                        <option value="Environment">Environment</option>
                                    </select>
                                </div>

                                {{-- TREND TEMUAN: checklist mengikuti referensi Hazard Report --}}
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Trend Temuan</label>
                                    <div class="text-muted small mb-3">Pilih satu atau lebih trend temuan yang sesuai. Daftar mengikuti Kategori Bahaya.</div>
                                    <div id="sapChecklistKondisi" class="sap-trend-card mb-3 {{ old('kategoriBahaya', '') === 'Kondisi Tidak Aman' ? '' : 'd-none' }}">
                                        <div class="sap-trend-heading"><i class="ti ti-alert-triangle"></i><div><strong>Kondisi Tidak Aman</strong><div class="small">Pilih trend temuan yang sesuai</div></div></div>
                                        <div class="row g-2 p-3">
                                            @foreach($sapKondisiTidakAman as $i => $item)
                                                <div class="col-md-6 col-12"><label class="sap-trend-item" for="sap_kta_{{ $i }}"><input id="sap_kta_{{ $i }}" type="checkbox" name="detail_temuan[]" value="{{ $item }}" {{ in_array($item, $detailTemuan, true) ? 'checked' : '' }}><span>{{ $item }}</span></label></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="sapChecklistTindakan" class="sap-trend-card {{ old('kategoriBahaya', '') === 'Tindakan Tidak Aman' ? '' : 'd-none' }}">
                                        <div class="sap-trend-heading"><i class="ti ti-user-exclamation"></i><div><strong>Tindakan Tidak Aman</strong><div class="small">Pilih trend temuan yang sesuai</div></div></div>
                                        <div class="row g-2 p-3">
                                            @foreach($sapTindakanTidakAman as $i => $item)
                                                <div class="col-md-6 col-12"><label class="sap-trend-item" for="sap_tta_{{ $i }}"><input id="sap_tta_{{ $i }}" type="checkbox" name="detail_temuan[]" value="{{ $item }}" {{ in_array($item, $detailTemuan, true) ? 'checked' : '' }}><span>{{ $item }}</span></label></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label for="departemen" class="form-label">PIC Tindak Lanjut</label>
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

                                <div class="mb-3">
                                    <label class="form-label">Pengendalian Awal Saat Ini (yang Sudah Dilakukan)</label>
                                    <textarea class="form-control" placeholder="Tuliskan pengendalian awal yang saat ini sudah dilakukan" name="pengendalian"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rekomendasi Tindakan Perbaikan</label>
                                    <textarea class="form-control" placeholder="Tuliskan rekomendasi tindakan perbaikan yang disarankan" name="tindakan_perbaikan"></textarea>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-section-title">
                                    <span class="form-section-badge">5</span>
                                    <div>
                                        <h5>Tindak Lanjut</h5>
                                        <p>Diisi apabila sudah ada tindak lanjut</p>
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
    window.onload = function() {
        var currentDate = new Date();

        // Format tanggal Indonesia (DD-MM-YYYY)
        var dd = ("0" + currentDate.getDate()).slice(-2); // Menambahkan 0 jika tanggal < 10
        var mm = ("0" + (currentDate.getMonth() + 1)).slice(-2); // Menambahkan 0 jika bulan < 10
        var yyyy = currentDate.getFullYear();
        var formattedDate = yyyy + "-" + mm + "-" + dd; // Tanggal untuk input type="date" (YYYY-MM-DD)

        // Format waktu (HH:MM)
        var hours = ("0" + currentDate.getHours()).slice(-2); // Menambahkan 0 jika jam < 10
        var minutes = ("0" + currentDate.getMinutes()).slice(-2); // Menambahkan 0 jika menit < 10
        var formattedTime = hours + ":" + minutes;

        // Isi input dengan tanggal dan waktu saat ini
        document.getElementById("date").value = formattedDate;
        document.getElementById("time").value = formattedTime;
    }

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


<script>
document.addEventListener('DOMContentLoaded', function () {
    const kategori = document.getElementById('kategoriBahaya');
    const kondisi = document.getElementById('sapChecklistKondisi');
    const tindakan = document.getElementById('sapChecklistTindakan');
    if (!kategori || !kondisi || !tindakan) return;
    function toggleTrend() {
        const value = kategori.value;
        kondisi.classList.toggle('d-none', value !== 'Kondisi Tidak Aman');
        tindakan.classList.toggle('d-none', value !== 'Tindakan Tidak Aman');
        // Hapus pilihan pada kategori yang disembunyikan agar data tidak rancu.
        const hidden = value === 'Kondisi Tidak Aman' ? tindakan : kondisi;
        if (value === 'Kondisi Tidak Aman' || value === 'Tindakan Tidak Aman') {
            hidden.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        }
    }
    kategori.addEventListener('change', toggleTrend);
    toggleTrend();
});
</script>
