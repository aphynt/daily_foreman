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

    .card-modern {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 10px;
        color: #555;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 12px;
        border: 1px solid #e4e6ef;
        transition: all .2s;
        color: black;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.15);
    }

    textarea.form-control {
        min-height: 90px;
    }

    .form-label {
        font-weight: 500;
        color: #444;
    }

    .form-section {
        background: #fafafa;
        padding: 18px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .btn-modern {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all .2s;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }

    .form-title {
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .ts-control {
        border-radius: 10px !important;
        border: 1px solid #e4e6ef !important;
        padding: 10px !important;
    }

    .ts-control.focus {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.15);
    }

    .ts-dropdown {
        border-radius: 10px;
        border: 1px solid #eee;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .ts-dropdown .option {
        padding: 10px;
    }

    .ts-dropdown .option.active {
        background: #f1f5ff;
        color: #4f46e5;
    }

    .btn-upload {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        padding: 12px 32px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 10px;
        color: white;
        letter-spacing: 0.3px;
        transition: all .2s ease;
    }

    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-upload:active {
        transform: scale(0.97);
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
                <div class="card card-modern mb-4">
                    <div class="card-body">

                        <div class="section-title mb-3">Deskripsi Inspeksi</div>

                        <div class="row">

                            <!-- DETAIL LAPORAN -->
                            <div class="col-md-7">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                         <label class="form-label">No Inspeksi:</label>
                                    <input class="form-control" value="{{ $data->no_inspeksi }}" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Perusahaan:</label>
                                        <input class="form-control" value="{{ $data->perusahaan }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (Auth::user()->role == 'ADMIN')
                                        <div class="col-md-6 mb-3">
                                        <label class="form-label">Pembuat:</label>
                                        <input class="form-control" value="{{ $data->pic_name }}" readonly>
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kepada:</label>
                                        <input class="form-control" value="{{ $data->kepada }}" readonly>
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Shift:</label>
                                        <input class="form-control" value="{{ $data->shift }}" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Departemen Tujuan:</label>
                                        <input class="form-control" value="{{ $data->nama_departemen }}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Lokasi:</label>
                                        <input class="form-control" value="{{ $data->lokasi }}" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tingkat Risiko:</label>
                                        <input class="form-control" value="{{ $data->tingkat_risiko }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Bahaya:</label>
                                    <textarea class="form-control" readonly>{{ $data->bahaya }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Risiko:</label>
                                    <textarea class="form-control" readonly>{{ $data->risiko }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Report</label>
                                        <input class="form-control"
                                            value="{{ $data->tanggal_pelaporan ? \Carbon\Carbon::parse($data->tanggal_pelaporan)->locale('id')->translatedFormat('l, d F Y H:m') : '-' }}"
                                            readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Due Date</label>
                                        <input class="form-control" value="{{ $data->due_date ?? '-' }}" readonly>
                                    </div>
                                </div>

                            </div>


                            <!-- FOTO TEMUAN -->
                            <div class="col-md-5">

                                <div class="section-title">Evidence</div>

                                <div class="border rounded p-3">

                                    <div class="row g-3">

                                        <!-- FOTO 1 -->
                                        @if($data->dokumentasi_1)
                                        <div class="col-6 text-center">
                                            <img src="{{ $data->dokumentasi_1 }}" class="img-thumbnail evidence-thumb">

                                            <a href="{{ $data->dokumentasi_1 }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                <i class="fas fa-search"></i> Lihat Foto
                                            </a>
                                        </div>
                                        @endif


                                        <!-- FOTO 2 -->
                                        @if($data->dokumentasi_2)
                                        <div class="col-6 text-center">
                                            <img src="{{ $data->dokumentasi_2 }}" class="img-thumbnail evidence-thumb">

                                            <a href="{{ $data->dokumentasi_2 }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                <i class="fas fa-search"></i> Lihat Foto
                                            </a>
                                        </div>
                                        @endif

                                    </div>

                                    @if(!$data->dokumentasi_1 && !$data->dokumentasi_2)
                                    <p class="text-muted text-center">Tidak ada gambar</p>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="card card-modern mb-4">
                    <div class="card-body">

                        <div class="section-title mb-3">Rekomendasi Tindakan</div>

                        <div class="row">

                            <!-- DETAIL LAPORAN -->
                            <div class="col-md-12">


                                <div class="mb-3">
                                    <label class="form-label">Pengendalian Awal:</label>
                                    <textarea class="form-control" readonly>{{ $data->pengendalian_awal }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rekomendasi Tindakan Perbaikan:</label>
                                    <textarea class="form-control" readonly>{{ $data->tindakan_perbaikan }}</textarea>
                                </div>



                            </div>




                        </div>

                    </div>
                </div>
                <div class="card card-modern">
                    <div class="card-body">

                        <div class="section-title mb-3">Tanggapan</div>

                        <div class="row">

                            <!-- TANGGAPAN SCC -->
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-3 h-100">

                                    <div class="fw-bold mb-2 text-primary">
                                        <i class="fas fa-user-shield me-1"></i> Tanggapan SCC
                                    </div>
                                    @if(!$data->verified_scc)

                                        @if (Auth::user()->id == 3)
                                        <form method="POST" action="{{ route('hazard-report.verify.scc') }}">
                                            @csrf

                                            <input type="hidden" name="uuid" value="{{ $data->uuid }}">

                                            <div class="mb-3">
                                                <label class="form-label">Komentar SCC</label>
                                                <textarea name="catatan_scc" class="form-control"></textarea>
                                            </div>

                                            <div class="d-flex gap-2">

                                                <button type="submit" name="status" value="accept" class="btn btn-success">
                                                    Accept
                                                </button>

                                                <button type="submit" name="status" value="reject" class="btn btn-danger">
                                                    Reject
                                                </button>

                                            </div>

                                        </form>
                                        @endif

                                    @endif

                                    @if($data->catatan_verified_scc)

                                    <div class="d-flex gap-3">

                                        <div>
                                            <strong>{{ $data->nama_scc }}</strong>

                                            {{-- STATUS SCC --}}
                                            <div class="mt-1">
                                                @if($data->verified_scc == 'accept' || $data->verified_scc == 1)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i> Accepted
                                                    </span>
                                                @elseif($data->verified_scc == 'reject' || $data->verified_scc == 0)
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times-circle me-1"></i> Rejected
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-clock me-1"></i> Review
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="text-muted small mt-1">
                                                {{ \Carbon\Carbon::parse($data->verified_datetime_scc)->locale('id')->translatedFormat('l, d F Y H:m') }}
                                            </div>

                                            <p class="mt-2 mb-0">
                                                {{ $data->catatan_verified_scc }}
                                            </p>
                                        </div>

                                    </div>

                                    @else

                                    <div class="text-muted fst-italic">
                                        Belum/tidak ada tanggapan dari SCC
                                    </div>

                                    @endif

                                </div>
                            </div>


                            <!-- TANGGAPAN PENERIMA -->
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-3 h-100">

                                    <div class="fw-bold mb-2 text-success">
                                        <i class="fas fa-user-check me-1"></i> Tanggapan Departemen
                                    </div>
                                    @if($data->verified_scc == 'accept' && !$data->verified_penerima)

                                        @if (
                                            Auth::user()->departemen_id == $data->departemen &&
                                            in_array(Auth::user()->role, ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT'])
                                        )
                                        <form method="POST" action="{{ route('hazard-report.close') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="uuid" value="{{ $data->uuid }}">

                                            <div class="mb-3">
                                                <label class="form-label">Komentar Penyelesaian</label>
                                                <textarea name="catatan_penerima" class="form-control"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Foto Dokumentasi Perbaikan</label>
                                                <input type="file" name="dokumentasi_perbaikan_1" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <input type="file" name="dokumentasi_perbaikan_2" class="form-control">
                                            </div>

                                            <button class="btn btn-success">
                                                Close Hazard
                                            </button>

                                        </form>
                                        @endif

                                    @endif
                                    @if($data->status == 2)

                                    <div class="mt-3">

                                        <div class="fw-bold mb-2 text-success">
                                            <i class="fas fa-check-circle"></i> Hazard Closed
                                        </div>

                                        <div class="row">

                                            @if($data->dokumentasi_perbaikan_1)
                                            <div class="col-6">
                                                <img src="{{ $data->dokumentasi_perbaikan_1 }}" class="img-thumbnail">
                                            </div>
                                            @endif

                                            @if($data->dokumentasi_perbaikan_2)
                                            <div class="col-6">
                                                <img src="{{ $data->dokumentasi_perbaikan_2 }}" class="img-thumbnail">
                                            </div>
                                            @endif

                                        </div>

                                    </div>

                                    @endif

                                    @if($data->catatan_verified_penerima)

                                    <div class="d-flex gap-3">

                                        <div>
                                            <strong>{{ $data->nama_penerima }}</strong>

                                            <div class="text-muted small">
                                                {{ \Carbon\Carbon::parse($data->verified_datetime_penerima)->locale('id')->translatedFormat('l, d F Y H:m') }}
                                            </div>

                                            <p class="mt-2 mb-0">
                                                {{ $data->catatan_verified_penerima }}
                                            </p>
                                        </div>

                                    </div>

                                    @else

                                    <div class="text-muted fst-italic">
                                        Belum ada tanggapan dari Departemen
                                    </div>

                                    @endif

                                </div>
                            </div>

                        </div>

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
        let bulan = String(now.getMonth() + 1).padStart(2, '0');
        let hari = String(now.getDate()).padStart(2, '0');
        let tahun = now.getFullYear();

        document.getElementById("pc-datepicker-1").value = bulan + "/" + hari + "/" + tahun;

        // ===== FORMAT JAM HH:MM AM/PM =====
        let jam = now.getHours();
        let menit = String(now.getMinutes()).padStart(2, '0');

        let ampm = jam >= 12 ? "PM" : "AM";
        jam = jam % 12;
        jam = jam ? jam : 12;
        jam = String(jam).padStart(2, '0');

        document.getElementById("pc-timepicker-1").value = jam + ":" + menit + " " + ampm;

    };
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll('.modern-select').forEach(function (el) {

            new TomSelect(el, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                dropdownClass: 'ts-dropdown-modern',
                controlClass: 'ts-control-modern'
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
                    return new File([obj], originalName, {
                        type: obj.type || 'image/jpeg',
                        lastModified: Date.now()
                    });
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
                console.warn('Cannot convert compressed result to File in this browser; skipping replace for',
                    inputElement.name);
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
                errDiv.innerText =
                    'Terjadi kesalahan saat memproses gambar. Mengirim form tanpa kompresi.';
                formSAP.prepend(errDiv);

                formSAP.submit();
            }
        });
    });

</script>
