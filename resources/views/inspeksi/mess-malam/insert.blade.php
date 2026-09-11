@include('layout.head', ['title' => 'Inspeksi Mess (Malam)'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-xxl-4">
                        <h3>Inspeksi Mess (Malam)</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mt-3">
                            <form action="{{ route('inspeksi.messmalam.post') }}" method="POST" id="submitformInspeksiMessMalam" enctype="multipart/form-data">
                                @csrf
                                <!-- Inputan di atas tabel -->
                                <div class="row mb-3">
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="tanggal_inspeksi" required>
                                    </div>
                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Jam</label>
                                        <input type="time" class="form-control form-control-sm" id="time" name="jam_inspeksi" required>
                                    </div>

                                    <div class="col-md-6 col-12 px-2 py-2">
                                        <label>Perusahaan</label>
                                        <select class="form-control form-control-sm pb-2" id="exampleFormControlSelect2" name="perusahaan" data-trigger required>
                                            <option selected disabled></option>
                                            @foreach ($users['perusahaan'] as $perusahaan)
                                                <option value="{{ $perusahaan->id }}">{{ $perusahaan->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <h5>1. PEKERJA</h5>
                                <hr>
                                <!-- Form dengan radio button -->
                                <div class="mb-3">
                                    <label>1.1 Terdapat pekerja yang belum tidur di sekitar Mess </label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pekerja_11_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pekerja_11_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>1.2 Terdapat pekerja yang berada di dalam kamar tetapi tidak tidur</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pekerja_12_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="pekerja_12_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>

                                <h5>2. FASILITAS</h5>
                                <hr>
                                <div class="mb-3">
                                    <label>2.1 TV sudah OFF keseluruhan di sekitar Mess</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_21_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_21_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.2 TV masih ada yang ON di sekitar Mess/ Kamar</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_22_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_22_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.3 Terdapat TV di ruang khusus untuk nonton bersama</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_23_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_23_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.4 Sekitar bangunan mess kondisi suara cukup tenang untuk istirahat </label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_24_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="fasilitas_24_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>2.5 Terdapat Petugas Keamanan / Security</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_25_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="tabung_25_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5>3. CAMPAIGN</h5>
                                <div class="mb-3">
                                    <label>3.1 Surat Edaran Cukup Istirahat</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_31_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_31_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.2 Safety Awareness Pengelolaan Fatique di Bulan Puasa </label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_32_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_32_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.3 Healhty Awareness Asupan Gizi Pekerja</label>
                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_33_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_33_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label>3.4 Spanduk Pola Hidup Sehat dan atau Tata Kelola Fatique</label>

                                    <div class="d-flex justify-content-start">
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_34_check" value="true" required /> Ya
                                        </label>
                                        <label class="me-3 px-2 py-2">
                                            <input type="radio" name="campaign_34_check" value="false" /> Tidak
                                        </label>
                                    </div>
                                </div>

                                <hr>
                                <!-- Catatan -->
                                <div class="form-group mt-3">
                                    <label for="notes">Catatan:</label>
                                    <textarea id="notes" name="additional_notes" class="form-control form-control-sm pb-2" rows="3"
                                        placeholder="Tambahkan catatan..."></textarea>
                                </div>
                                <hr>
                                <!-- Catatan -->
                                <div class="mb-3">
                                    <label class="form-label">Upload foto temuan & kondisi 1:</label>
                                    <input type="file" class="form-control" name="dokumentasi_1" accept="image/*"  />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload foto temuan & kondisi 2 (jika ada):</label>
                                    <input type="file" class="form-control" name="dokumentasi_2" accept="image/*"  />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload foto temuan & kondisi 3 (jika ada):</label>
                                    <input type="file" class="form-control" name="dokumentasi_3" accept="image/*"  />
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Inspektor</label>
                                        <select class="form-control form-control-sm" name="inspektor" data-trigger required>
                                            <option value="{{ Auth::user()->nik }}" selected>{{ Auth::user()->name }} ({{ Auth::user()->nik }})</option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('inspektor') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 px-2 py-2">
                                        <label>Pendamping</label>
                                        <select class="form-control form-control-sm" name="pendamping" data-trigger>
                                            <option value="" disabled selected></option>
                                            @foreach ($users['inspektor'] as $inspektor)
                                                <option value="{{ $inspektor->nik }}"
                                                    {{ old('pendamping') == $inspektor->nik ? 'selected' : '' }}>
                                                    {{ $inspektor->name }} ({{ $inspektor->nik }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- Tombol Submit -->
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm" id="submitButtonInspeksiMessMalam">Submit</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')

<script>

    const formInspeksiMessMalam = document.getElementById('submitformInspeksiMessMalam');
    const submitButtonInspeksiMessMalam = document.getElementById('submitButtonInspeksiMessMalam');

    formInspeksiMessMalam.addEventListener('submit', function() {
        // Nonaktifkan tombol submit ketika form sedang diproses
        submitButtonInspeksiMessMalam.disabled = true;
        submitButtonInspeksiMessMalam.innerText = 'Processing...';
        setTimeout(function() {
            submitButtonInspeksiMessMalam.disabled = false;
            submitButtonInspeksiMessMalam.innerText = 'Submit';
        }, 7000);
    });
</script>

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
    document.querySelector("form").addEventListener("submit", function(e) {
        const radioGroups = Array.from(new Set([...document.querySelectorAll("input[type='radio']")].map(r => r
            .name)));
        const incompleteGroups = radioGroups.filter(groupName => {
            return !document.querySelector(`input[name="${groupName}"]:checked`);
        });

        if (incompleteGroups.length > 0) {
            e.preventDefault();
            alert("Silakan isi semua pilihan True/False/N/A sebelum mengirimkan form!");
        }
    });
</script>
