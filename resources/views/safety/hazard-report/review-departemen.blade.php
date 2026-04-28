@include('layout.head', ['title' => 'Hazard Report - Review Departemen'])
@include('layout.sidebar')
@include('layout.header')

<style>
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
        background: linear-gradient(135deg, #16a34a, #15803d);
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
                    <h3 class="form-title">Hazard Report - Review Departemen</h3>
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

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
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

        {{-- DETAIL HAZARD (READONLY) --}}
        <div class="card card-modern mb-4">
            <div class="card-body">
                <div class="section-title mb-3">Deskripsi Inspeksi</div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label class="form-label">No Inspeksi:</label>
                            <input class="form-control" value="{{ $data->no_inspeksi }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kepada:</label>
                            <input class="form-control" value="{{ $data->kepada }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Perusahaan:</label>
                            <input class="form-control" value="{{ $data->perusahaan }}" readonly>
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

                        <div class="mb-3">
                            <label class="form-label">Tanggal Report:</label>
                            <input class="form-control"
                                   value="{{ $data->tanggal_pelaporan ? \Carbon\Carbon::parse($data->tanggal_pelaporan)->locale('id')->translatedFormat('l, d F Y H:i') : '-' }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="section-title">Evidence</div>
                        <div class="border rounded p-3">
                            <div class="row g-3">
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

                            @if(!$data->dokumentasi_1 && !$data->dokumentasi_2)
                                <p class="text-muted text-center mb-0">Tidak ada gambar</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- REKOMENDASI (READONLY) --}}
        <div class="card card-modern mb-4">
            <div class="card-body">
                <div class="section-title mb-3">Rekomendasi Tindakan</div>

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

        {{-- TANGGAPAN SCC (READONLY) --}}
        <div class="card card-modern mb-4">
            <div class="card-body">
                <div class="section-title mb-3">Tanggapan SCC</div>

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
                                {{ $data->verified_datetime_scc ? \Carbon\Carbon::parse($data->verified_datetime_scc)->locale('id')->translatedFormat('l, d F Y H:i') : '-' }}
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

        {{-- FORM UPDATE DEPARTEMEN --}}
        @if(
            $data->verified_scc == 'accept' &&
            (
                (Auth::user()->departemen_id == $data->departemen &&
                in_array(Auth::user()->role, ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT']))
                || Auth::user()->id == 3
            )
        )
            <form method="POST"
                  action="{{ route('hazard-report.update.departemen', $data->uuid) }}"
                  enctype="multipart/form-data"
                  id="departemenForm">
                @csrf
                @method('PUT')

                <div class="card card-modern mb-4">
                    <div class="card-body">
                        <div class="section-title mb-3">Update Departemen</div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Penerima / Tindak Lanjut</label>
                            <textarea name="catatan_verified_penerima" class="form-control">{{ old('catatan_verified_penerima', $data->catatan_verified_penerima) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload Dokumentasi Perbaikan 1</label>
                                <input type="file" name="dokumentasi_perbaikan_1" class="form-control" accept="image/*">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload Dokumentasi Perbaikan 2</label>
                                <input type="file" name="dokumentasi_perbaikan_2" class="form-control" accept="image/*">
                            </div>
                        </div>

                        @if($data->dokumentasi_perbaikan_1 || $data->dokumentasi_perbaikan_2)
                            <div class="border rounded p-3 mb-3">
                                <div class="section-title mb-2">Dokumentasi Perbaikan Saat Ini</div>
                                <div class="row g-3">
                                    @if($data->dokumentasi_perbaikan_1)
                                        <div class="col-6 text-center">
                                            <img src="{{ $data->dokumentasi_perbaikan_1 }}" class="img-thumbnail evidence-thumb">
                                            <a href="{{ $data->dokumentasi_perbaikan_1 }}" target="_blank"
                                               class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                <i class="fas fa-search"></i> Lihat Foto
                                            </a>
                                        </div>
                                    @endif

                                    @if($data->dokumentasi_perbaikan_2)
                                        <div class="col-6 text-center">
                                            <img src="{{ $data->dokumentasi_perbaikan_2 }}" class="img-thumbnail evidence-thumb">
                                            <a href="{{ $data->dokumentasi_perbaikan_2 }}" target="_blank"
                                               class="btn btn-sm btn-outline-primary mt-2 w-100">
                                                <i class="fas fa-search"></i> Lihat Foto
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($data->verified_penerima)
                            <div class="alert alert-info">
                                Status tanggapan departemen:
                                <strong>
                                    @if($data->verified_penerima == 'accept' || $data->verified_penerima == 1)
                                        Accepted
                                    @elseif($data->verified_penerima == 'reject' || $data->verified_penerima == 0)
                                        Rejected
                                    @else
                                        {{ $data->verified_penerima }}
                                    @endif
                                </strong>
                                <br>
                                Waktu:
                                {{ $data->verified_datetime_penerima ? \Carbon\Carbon::parse($data->verified_datetime_penerima)->locale('id')->translatedFormat('l, d F Y H:i') : '-' }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-modern" id="btnUpdateDepartemen">
                                <i class="fas fa-save me-1"></i> Update Departemen
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</section>

@include('layout.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('departemenForm');
        const submitBtn = document.getElementById('btnUpdateDepartemen');

        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
            });
        }
    });
</script>
