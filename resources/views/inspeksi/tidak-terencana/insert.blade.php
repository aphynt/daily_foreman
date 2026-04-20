@include('layout.head', ['title' => 'Inspeksi Tidak Terencana dan Kepatuhan Golden Rules'])
@include('layout.sidebar')
@include('layout.header')

<style>
    .inspection-card {
        border: 0;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
    }

    .page-title {
        font-weight: 700;
        color: #1e293b;
    }

    .sub-title {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 0;
    }

    .modern-note {
        background: linear-gradient(135deg, #fff7ed, #fffbeb);
        border: 1px solid #fed7aa;
        border-left: 5px solid #f59e0b;
        border-radius: 14px;
        padding: 16px 18px;
        color: #7c2d12;
    }

    .modern-note strong {
        display: inline-block;
        margin-bottom: 8px;
        font-size: 15px;
    }

    .section-label {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        color: #475569;
        margin-bottom: 10px;
    }

    .search-option {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 14px;
        transition: all .2s ease;
        background: #fff;
        cursor: pointer;
        width: 100%;
    }

    .search-option:hover {
        border-color: #3b82f6;
        background: #f8fbff;
    }

    .search-option input[type="radio"] {
        margin-right: 8px;
    }

    .field-card {
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px;
        background: #f8fafc;
        margin-bottom: 18px;
    }

    .violation-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 12px;
    }

    .violation-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 14px;
        background: #fff;
        transition: all .2s ease;
    }

    .violation-item:hover {
        border-color: #94a3b8;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
    }

    .violation-code {
        min-width: 28px;
        height: 28px;
        border-radius: 8px;
        background: #e2e8f0;
        color: #0f172a;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12px;
        margin-top: 1px;
    }

    .hidden-section {
        display: none;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
    }

    .btn-submit-modern {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
    }

    .text-muted-small {
        font-size: 12px;
        color: #64748b;
    }

    .readonly-box {
        background-color: #e9ecef;
    }
</style>

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <h3 class="page-title mb-1">Inspeksi Tidak Terencana dan Kepatuhan Golden Rules</h3>
                        <p class="sub-title">Form inspeksi kepatuhan golden rules dengan pencarian berdasarkan NIK, input manual, atau unit focus.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card inspection-card">
                    <div class="card-body">
                        <form action="{{ route('inspeksi.tidakterencana.post') }}" method="POST" id="submitformInspeksiGoldenRules">
                            @csrf

                            <div class="modern-note mb-4">
                                <strong>NOTE</strong>
                                <ul class="mb-0 ps-3">
                                    <li>Pilih metode pencarian data berdasarkan <b>NIK</b>, <b>Manual</b>, atau <b>Focus Unit HD</b>.</li>
                                    <li>Jika pilih <b>NIK</b>, user cukup pilih NIK lalu nama terisi otomatis.</li>
                                    <li>Jika pilih <b>Manual</b>, user bisa input sendiri NIK dan nama.</li>
                                    <li>Jika pilih <b>Focus</b>, user pilih unit HD lalu NIK dan nama panggil terisi otomatis dari API.</li>
                                    <li>Pelanggaran dapat dipilih lebih dari satu, termasuk opsi <b>Lainnya</b>.</li>
                                </ul>
                            </div>

                            {{-- SEARCHING BY --}}
                            <div class="field-card">
                                <div class="section-label">Searching By</div>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label class="search-option">
                                            <input type="radio" name="searching_by" value="manual">
                                            <span>Manual</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="search-option">
                                            <input type="radio" name="searching_by" value="nik" checked>
                                            <span>NIK</span>
                                        </label>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="search-option">
                                            <input type="radio" name="searching_by" value="focus">
                                            <span>Focus</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- MODE MANUAL --}}
                            <div id="manualSection" class="field-card hidden-section">
                                <div class="section-label">Input Manual</div>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control form-control-sm" name="manual_nik" id="manual_nik" placeholder="Tulis NIK" >
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control form-control-sm" name="manual_nama" id="manual_nama" placeholder="Tulis nama">
                                    </div>
                                </div>
                            </div>
                            {{-- MODE NIK --}}
                            <div id="nikSection" class="field-card">
                                <div class="section-label">Pilih Berdasarkan NIK</div>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <label class="form-label">NIK</label>
                                        <select class="form-control form-control-sm" name="nik_select" id="nik_select" data-trigger>
                                            <option value="">Pilih NIK</option>
                                            @foreach ($users as $us)
                                                <option value="{{ $us->nik }}" data-nama="{{ $us->name }}">{{ $us->nik }} | {{ $us->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control form-control-sm readonly-box" name="nik_nama" id="nik_nama" readonly>
                                    </div>
                                </div>
                            </div>

                            {{-- MODE FOCUS --}}
                            <div id="focusSection" class="field-card hidden-section">
                                <div class="section-label">Pilih Berdasarkan Focus Unit</div>
                                <div class="row">
                                    <div class="col-md-4 col-12 mb-3">
                                        <label class="form-label">Unit HD</label>
                                        <select class="form-control form-control-sm" name="focus_unit_hd" id="focus_unit_hd" data-trigger>
                                            <option value="">Pilih Unit HD</option>
                                            @foreach ($operator as $opr)
                                                <option value="{{ $opr->VHC_ID }}">{{ $opr->VHC_ID }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-12 mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control form-control-sm readonly-box" name="focus_nik" id="focus_nik" readonly>
                                    </div>

                                    <div class="col-md-4 col-12 mb-3">
                                        <label class="form-label">Nama Panggil</label>
                                        <input type="text" class="form-control form-control-sm readonly-box" name="focus_nama" id="focus_nama" readonly>
                                    </div>
                                </div>
                            </div>

                            {{-- FIELD FINAL YANG DIKIRIM --}}
                            <input type="hidden" name="nik" id="final_nik">
                            <input type="hidden" name="nama" id="final_nama">

                            {{-- INFORMASI INSPEKSI --}}
                            <div class="field-card">
                                <div class="section-label">Informasi Inspeksi</div>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal" required>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label class="form-label">Waktu</label>
                                        <input type="time" class="form-control form-control-sm" id="time" name="waktu" required>
                                    </div>

                                    <div class="col-md-12 col-12 mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <textarea class="form-control form-control-sm" name="keterangan" rows="3" placeholder="Tambahkan keterangan bila diperlukan"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- PELANGGARAN --}}
                            <div class="field-card">
                                <div class="section-label">Pelanggaran (Bisa Pilih Lebih dari Satu)</div>
                                <div class="violation-grid">
                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="A">
                                        <span class="violation-code">A</span>
                                        <span>Melebihi batas kecepatan</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="B">
                                        <span class="violation-code">B</span>
                                        <span>Pelanggaran rambu (STOP, mendahului, parkir, dll)</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="C">
                                        <span class="violation-code">C</span>
                                        <span>Tidak menjaga jarak aman</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="D">
                                        <span class="violation-code">D</span>
                                        <span>No seat belt</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="E">
                                        <span class="violation-code">E</span>
                                        <span>Tidak menggunakan APD sesuai pekerjaan</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="F">
                                        <span class="violation-code">F</span>
                                        <span>Merokok di area terlarang</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="G">
                                        <span class="violation-code">G</span>
                                        <span>Tidak membawa mine permit / kimper</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="H">
                                        <span class="violation-code">H</span>
                                        <span>Tidak melaksanakan LOTO</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="I">
                                        <span class="violation-code">I</span>
                                        <span>Tidak melakukan P2H</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="J">
                                        <span class="violation-code">J</span>
                                        <span>Tidak mengisi KKH</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="K">
                                        <span class="violation-code">K</span>
                                        <span>Random Fatique</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" name="pelanggaran[]" value="L">
                                        <span class="violation-code">L</span>
                                        <span>Tidak Ada Pelanggaran</span>
                                    </label>

                                    <label class="violation-item">
                                        <input type="checkbox" id="pelanggaranLainnya" name="pelanggaran[]" value="Z">
                                        <span class="violation-code">Z</span>
                                        <span>Lainnya</span>
                                    </label>
                                </div>

                                <div class="mt-3" id="lainnyaWrapper" style="display: none;">
                                    <label class="form-label">Isi Pelanggaran Lainnya</label>
                                    <input type="text" class="form-control form-control-sm" name="pelanggaran_lainnya" id="pelanggaran_lainnya" placeholder="Tulis pelanggaran lainnya">
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-sm btn-submit-modern" id="submitButtonInspeksiGoldenRules">
                                    Submit
                                </button>
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
    const formInspeksiGoldenRules = document.getElementById('submitformInspeksiGoldenRules');
    const submitButtonInspeksiGoldenRules = document.getElementById('submitButtonInspeksiGoldenRules');

    const manualSection = document.getElementById('manualSection');
    const manualNik = document.getElementById('manual_nik');
    const manualNama = document.getElementById('manual_nama');

    const nikSection = document.getElementById('nikSection');
    const focusSection = document.getElementById('focusSection');
    const radioSearchingBy = document.querySelectorAll('input[name="searching_by"]');

    const nikSelect = document.getElementById('nik_select');
    const nikNama = document.getElementById('nik_nama');

    const focusUnitHd = document.getElementById('focus_unit_hd');
    const focusNik = document.getElementById('focus_nik');
    const focusNama = document.getElementById('focus_nama');

    const finalNik = document.getElementById('final_nik');
    const finalNama = document.getElementById('final_nama');

    const pelanggaranLainnya = document.getElementById('pelanggaranLainnya');
    const lainnyaWrapper = document.getElementById('lainnyaWrapper');
    const pelanggaranLainnyaInput = document.getElementById('pelanggaran_lainnya');

    // mapping user dari blade
    const usersData = @json(
        $users->map(function($u) {
            return [
                'nik' => (string) $u->nik,
                'name' => $u->name,
            ];
        })->values()
    );

    function toggleSearchSection() {
        const selected = document.querySelector('input[name="searching_by"]:checked').value;

        nikSection.classList.add('hidden-section');
        manualSection.classList.add('hidden-section');
        focusSection.classList.add('hidden-section');

        nikSelect.required = false;
        manualNik.required = false;
        manualNama.required = false;
        focusUnitHd.required = false;

        if (selected === 'nik') {
            nikSection.classList.remove('hidden-section');
            nikSelect.required = true;
            syncNikToFinal();
        }

        if (selected === 'manual') {
            manualSection.classList.remove('hidden-section');
            manualNik.required = true;
            manualNama.required = true;
            syncManualToFinal();
        }

        if (selected === 'focus') {
            focusSection.classList.remove('hidden-section');
            focusUnitHd.required = true;

            finalNik.value = focusNik.value || '';
            finalNama.value = focusNama.value || '';
        }
    }

    ['input', 'change', 'blur'].forEach(evt => {
        manualNik.addEventListener(evt, syncManualToFinal);
        manualNama.addEventListener(evt, syncManualToFinal);
    });

    function syncManualToFinal() {
        finalNik.value = (manualNik.value || '').trim();
        finalNama.value = (manualNama.value || '').trim();
    }

    function toggleLainnyaInput() {
        if (pelanggaranLainnya.checked) {
            lainnyaWrapper.style.display = 'block';
            pelanggaranLainnyaInput.required = true;
        } else {
            lainnyaWrapper.style.display = 'none';
            pelanggaranLainnyaInput.required = false;
            pelanggaranLainnyaInput.value = '';
        }
    }

    function syncNikToFinal() {
        const nik = (nikSelect.value || '').toString();
        const selectedUser = usersData.find(user => user.nik === nik);

        nikNama.value = selectedUser ? selectedUser.name : '';
        finalNik.value = selectedUser ? selectedUser.nik : '';
        finalNama.value = selectedUser ? selectedUser.name : '';
    }

    async function handleFocusChange() {
        const unit = focusUnitHd.value;

        focusNik.value = '';
        focusNama.value = '';
        finalNik.value = '';
        finalNama.value = '';

        if (!unit) return;

        try {
            const response = await fetch(`/inspeksi/tidakterencana/operatorFocus/${unit}`);
            const result = await response.json();

            focusNik.value = result.nik || '';
            focusNama.value = result.nama_panggil || '';

            finalNik.value = result.nik || '';
            finalNama.value = result.nama_panggil || '';
        } catch (error) {
            console.error('Gagal mengambil data unit HD:', error);
            alert('Data unit HD gagal diambil dari API.');
        }
    }

    radioSearchingBy.forEach(radio => {
        radio.addEventListener('change', toggleSearchSection);
    });

    // pakai beberapa event supaya aman walau ada plugin trigger
    ['change', 'input', 'blur'].forEach(evt => {
        nikSelect.addEventListener(evt, syncNikToFinal);
    });

    focusUnitHd.addEventListener('change', handleFocusChange);
    pelanggaranLainnya.addEventListener('change', toggleLainnyaInput);

    formInspeksiGoldenRules.addEventListener('submit', function(e) {
        const checkedPelanggaran = document.querySelectorAll('input[name="pelanggaran[]"]:checked');
        const selected = document.querySelector('input[name="searching_by"]:checked').value;

        if (selected === 'manual') {
            syncManualToFinal();
            if (!finalNik.value || !finalNama.value) {
                e.preventDefault();
                alert('Silakan isi NIK dan nama secara manual terlebih dahulu.');
                return;
            }
        }


        if (selected === 'nik') {
            syncNikToFinal();
            if (!finalNik.value || !finalNama.value) {
                e.preventDefault();
                alert('Silakan pilih NIK terlebih dahulu.');
                return;
            }
        }

        if (selected === 'focus' && (!finalNik.value || !finalNama.value)) {
            e.preventDefault();
            alert('Data NIK dan nama dari unit HD belum terisi.');
            return;
        }

        submitButtonInspeksiGoldenRules.disabled = true;
        submitButtonInspeksiGoldenRules.innerText = 'Processing...';

        setTimeout(function() {
            submitButtonInspeksiGoldenRules.disabled = false;
            submitButtonInspeksiGoldenRules.innerText = 'Submit';
        }, 7000);
    });

    window.onload = function() {
        const currentDate = new Date();

        const dd = ("0" + currentDate.getDate()).slice(-2);
        const mm = ("0" + (currentDate.getMonth() + 1)).slice(-2);
        const yyyy = currentDate.getFullYear();
        const formattedDate = yyyy + "-" + mm + "-" + dd;

        const hours = ("0" + currentDate.getHours()).slice(-2);
        const minutes = ("0" + currentDate.getMinutes()).slice(-2);
        const formattedTime = hours + ":" + minutes;

        document.getElementById("date").value = formattedDate;
        document.getElementById("time").value = formattedTime;

        toggleSearchSection();
        toggleLainnyaInput();

        // delay kecil supaya kalau data-trigger inisialisasi plugin, value select sudah sinkron
        setTimeout(() => {
            syncNikToFinal();
        }, 200);
    };
</script>
