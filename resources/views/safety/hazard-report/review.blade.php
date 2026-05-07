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

    .btn-modern {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
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
        color: white;
    }

    .form-title {
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .evidence-thumb {
        width: 100%;
        height: 180px;
        object-fit: cover;
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

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM UPDATE HANYA UNTUK DETAIL + REKOMENDASI --}}
        <form method="POST"
              action="{{ route('hazard-report.update', $data->uuid) }}"
              enctype="multipart/form-data"
              id="hazardEditForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-sm-12">

                    {{-- DESKRIPSI INSPEKSI --}}
                    <div class="card card-modern mb-4">
                        <div class="card-body">
                            <div class="section-title mb-3">Deskripsi Inspeksi</div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label class="form-label">No Inspeksi:</label>
                                        <input type="text"
                                               class="form-control"
                                               value="{{ $data->no_inspeksi }}"
                                               readonly>
                                    </div>

                                    <div class="row">
                                        @if (in_array(Auth::user()->id, [1, 3]))
                                            <div class="col-md-6 mb-3">
                                            <label class="form-label">Pembuat:</label>
                                            <input class="form-control" value="{{ $data->pic_name }}" readonly>
                                        </div>
                                        @endif
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kepada:</label>
                                            <input class="form-control" value="{{ $data->kepada }}" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Perusahaan:</label>
                                            <select name="perusahaan" class="form-select">
                                                <option value="">-- Pilih Perusahaan --</option>
                                                <option value="PT. SIMS JAYA KALTIM" {{ old('perusahaan', $data->perusahaan) == 'PT. SIMS JAYA KALTIM' ? 'selected' : '' }}>PT. SIMS JAYA KALTIM</option>
                                                <option value="PT. ABM" {{ old('perusahaan', $data->perusahaan) == 'PT. ABM' ? 'selected' : '' }}>PT. ABM</option>
                                                <option value="PT. KJM" {{ old('perusahaan', $data->perusahaan) == 'PT. KJM' ? 'selected' : '' }}>PT. KJM</option>
                                                <option value="PT. SM" {{ old('perusahaan', $data->perusahaan) == 'PT. SM' ? 'selected' : '' }}>PT. SM</option>
                                                <option value="PT. UT" {{ old('perusahaan', $data->perusahaan) == 'PT. UT' ? 'selected' : '' }}>PT. UT</option>
                                                <option value="PT. TRAKINDO" {{ old('perusahaan', $data->perusahaan) == 'PT. TRAKINDO' ? 'selected' : '' }}>PT. TRAKINDO</option>
                                                <option value="PT. HEXINDO" {{ old('perusahaan', $data->perusahaan) == 'PT. HEXINDO' ? 'selected' : '' }}>PT. HEXINDO</option>
                                                <option value="PT. IWACO" {{ old('perusahaan', $data->perusahaan) == 'PT. IWACO' ? 'selected' : '' }}>PT. IWACO</option>
                                                <option value="PT. K2B" {{ old('perusahaan', $data->perusahaan) == 'PT. K2B' ? 'selected' : '' }}>PT. K2B</option>
                                                <option value="PT. HMSI" {{ old('perusahaan', $data->perusahaan) == 'PT. HMSI' ? 'selected' : '' }}>PT. HMSI</option>
                                                <option value="PT. TRJA" {{ old('perusahaan', $data->perusahaan) == 'PT. TRJA' ? 'selected' : '' }}>PT. TRJA</option>
                                                <option value="PT. KWN" {{ old('perusahaan', $data->perusahaan) == 'PT. KWN' ? 'selected' : '' }}>PT. KWN</option>
                                                <option value="PT. KRI" {{ old('perusahaan', $data->perusahaan) == 'PT. KRI' ? 'selected' : '' }}>PT. KRI</option>
                                                <option value="PT. BIMA EV" {{ old('perusahaan', $data->perusahaan) == 'PT. BIMA EV' ? 'selected' : '' }}>PT. BIMA EV</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Shift:</label>
                                            <select name="shift" class="form-select">
                                                <option value="">-- Pilih Shift --</option>
                                                @foreach($shift as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('shift', $data->shift_id ?? $data->shift) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->keterangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Departemen Tujuan:</label>

                                            <select name="departemen" class="form-select">
                                            <option value="">-- Pilih Departemen --</option>
                                            @foreach($dep as $dept)
                                                <option value="{{ $dept->id }}"
                                                    {{ old('departemen', $data->departemen) == $dept->id ? 'selected' : '' }}>
                                                    {{ $dept->keterangan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Lokasi:</label>
                                            <input type="text"
                                                   name="lokasi"
                                                   class="form-control"
                                                   value="{{ old('lokasi', $data->lokasi) }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tingkat Risiko:</label>
                                            <select name="tingkat_risiko" class="form-select">
                                                <option value="">-- Pilih Tingkat Risiko --</option>
                                                <option value="Tidak Signifikan" {{ old('tingkat_risiko', $data->tingkat_risiko) == 'Tidak Signifikan' ? 'selected' : '' }}>Tidak Signifikan</option>
                                                <option value="Rendah" {{ old('tingkat_risiko', $data->tingkat_risiko) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                                <option value="Sedang" {{ old('tingkat_risiko', $data->tingkat_risiko) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                                <option value="Tinggi" {{ old('tingkat_risiko', $data->tingkat_risiko) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                                <option value="Ekstrim" {{ old('tingkat_risiko', $data->tingkat_risiko) == 'Ekstrim' ? 'selected' : '' }}>Ekstrim</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Bahaya:</label>
                                        <textarea name="bahaya" class="form-control">{{ old('bahaya', $data->bahaya) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Risiko:</label>
                                        <textarea name="risiko" class="form-control">{{ old('risiko', $data->risiko) }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Report</label>
                                            <input type="datetime-local"
                                                   name="tanggal_pelaporan"
                                                   class="form-control"
                                                   value="{{ old('tanggal_pelaporan', $data->tanggal_pelaporan ? \Carbon\Carbon::parse($data->tanggal_pelaporan)->format('Y-m-d\TH:i') : '') }}">
                                        </div>

                                        {{-- <div class="col-md-6 mb-3">
                                            <label class="form-label">Due Date</label>
                                            <input type="date"
                                                   name="due_date"
                                                   class="form-control"
                                                   value="{{ old('due_date', $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('Y-m-d') : '') }}">
                                        </div> --}}
                                    </div>
                                </div>

                                {{-- FOTO TEMUAN --}}
                                <div class="col-md-5">
                                    <div class="section-title">Evidence</div>
                                    <div class="border rounded p-3">

                                        <div class="row g-3 mb-3">
                                            @if($data->dokumentasi_1)
                                                <div class="col-6 text-center">
                                                    <img src="{{ $data->dokumentasi_1 }}" class="img-thumbnail evidence-thumb">
                                                    <a href="{{ $data->dokumentasi_1 }}" target="_blank"
                                                       class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                        <i class="fas fa-search"></i> Lihat Foto
                                                    </a>
                                                </div>
                                            @endif

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

                                        <div class="mb-3">
                                            <label class="form-label">Ganti Dokumentasi 1</label>
                                            <input type="file" name="dokumentasi_1" class="form-control" accept="image/*">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Ganti Dokumentasi 2</label>
                                            <input type="file" name="dokumentasi_2" class="form-control" accept="image/*">
                                        </div>

                                        @if(!$data->dokumentasi_1 && !$data->dokumentasi_2)
                                            <p class="text-muted text-center">Tidak ada gambar</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- REKOMENDASI --}}
                    <div class="card card-modern mb-4">
                        <div class="card-body">
                            <div class="section-title mb-3">Rekomendasi Tindakan</div>

                            <div class="mb-3">
                                <label class="form-label">Pengendalian Awal:</label>
                                <textarea name="pengendalian_awal" class="form-control">{{ old('pengendalian_awal', $data->pengendalian_awal) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rekomendasi Tindakan Perbaikan:</label>
                                <textarea name="tindakan_perbaikan" class="form-control">{{ old('tindakan_perbaikan', $data->tindakan_perbaikan) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggapan Safety</label>
                                <textarea name="catatan_verified_scc" class="form-control">{{ old('catatan_verified_scc', $data->catatan_verified_scc) }}</textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" name="aksi" value="update" id="btnUpdateHazard" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>

                                <button type="submit" name="aksi" value="terima" class="btn btn-success">
                                    <i class="fas fa-check-circle me-1"></i> Terima
                                </button>

                                <button type="submit" name="aksi" value="tolak" class="btn btn-danger">
                                    <i class="fas fa-times-circle me-1"></i> Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- BAGIAN TANGGAPAN TETAP SEPERTI ASLI --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-modern">
                    <div class="card-body">

                        <div class="section-title mb-3">Tanggapan</div>

                        <div class="row">

                            <!-- TANGGAPAN Safety -->
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-3 h-100">

                                    <div class="fw-bold mb-2 text-primary">
                                        <i class="fas fa-user-shield me-1"></i> Tanggapan Safety
                                    </div>

                                    {{-- @if(!$data->verified_scc)
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
                                    @endif --}}

                                    @if($data->catatan_verified_scc)
                                        <div class="d-flex gap-3">
                                            <div>
                                                <strong>{{ $data->nama_scc }}</strong>

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
                                                    {{ \Carbon\Carbon::parse($data->verified_datetime_scc)->locale('id')->translatedFormat('l, d F Y H:i') }}
                                                </div>

                                                <p class="mt-2 mb-0">
                                                    {{ $data->catatan_verified_scc }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-muted fst-italic">
                                            Belum/tidak ada tanggapan dari Safety
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
                                        @if (Auth::user()->departemen_id == $data->departemen)
                                            <form method="POST" action="{{ route('hazard-report.close') }}" enctype="multipart/form-data">
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
                                                    {{ \Carbon\Carbon::parse($data->verified_datetime_penerima)->locale('id')->translatedFormat('l, d F Y H:i') }}
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
            </div>
        </div>

    </div>
</section>

@include('layout.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('hazardEditForm');
        const submitBtn = document.getElementById('btnUpdateHazard');

        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Updating...';
            });
        }
    });
</script>
