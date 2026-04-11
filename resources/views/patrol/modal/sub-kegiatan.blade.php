<style>
    .is-valid,
    .is-invalid {
        background-image: none !important;
    }

    .was-validated .form-control:valid,
    .was-validated .form-control:invalid,
    .is-valid,
    .is-invalid {
        border-color: #ced4da !important;
        box-shadow: none !important;
        background-image: none !important;
    }
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .form-check-label {
        font-weight: bold;
        margin-right: 10px;
    }
</style>

<div class="modal fade" id="tambahSubKegiatan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Sub Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="formSubKegiatan" novalidate>
                    <div class="mb-3">
                        <label for="sub">Kegiatan</label>
                        <select class="form-select" id="sub" name="sub[]" onchange="handleChangeShift(this.value)" data-trigger>
                            <option value="">-- Pilih Sub Kegiatan --</option>

                            <option value="Safety Talk / P5M">Safety Talk / P5M</option>
                            <option value="Checklist Standard PIT - Excellent Patrol">Checklist Standard PIT - Excellent Patrol</option>
                            <option value="Inspeksi Terencana (Level 2)">Inspeksi Terencana (Level 2)</option>
                            <option value="Sidak/Sweeping (Inspeksi Tidak Terencana)">Sidak/Sweeping (Inspeksi Tidak Terencana)</option>
                            <option value="Monitoring Pengawas">Monitoring Pengawas</option>
                            <option value="Pengukuran Pencahayaan">Pengukuran Pencahayaan</option>
                            <option value="Kelengkapan & Standar Rambu">Kelengkapan & Standar Rambu</option>
                            <option value="Observasi Perilaku Khusus/Area Kritis">Observasi Perilaku Khusus/Area Kritis</option>
                            <option value="Mari Ngopi">Mari Ngopi</option>
                            <option value="Meeting Koordinasi">Meeting Koordinasi</option>

                            <option value="Monitoring Blasting">Monitoring Blasting</option>
                            <option value="Support Excort Mobilisasi Unit">Support Excort Mobilisasi Unit</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kategori">Sub Kegiatan / Detail</label>
                        <input class="form-control" id="kategori" name="kategori[]" rows="2">
                    </div>

                    <div class="mb-3">
                        <label for="frekuensi">Waktu Pelaksanaan</label>
                        <input class="form-control" id="frekuensi" name="frekuensi[]" rows="2">
                    </div>

                    <div class="mb-3">
                        <label for="lokasi">Lokasi</label>
                        <input class="form-control" id="lokasi" name="lokasi[]" rows="2">
                    </div>

                    <div class="mb-3 d-flex align-items-center gap-3">
                        <label class="form-label mb-0">Status</label>

                        <div class="form-check form-check-inline mb-0">
                            <input class="form-check-input" type="radio" name="status[]" id="status_v" value="✔">
                            <label class="form-check-label" for="status_v">✔</label>
                        </div>

                        <div class="form-check form-check-inline mb-0">
                            <input class="form-check-input" type="radio" name="status[]" id="status_x" value="✘">
                            <label class="form-check-label" for="status_x">✘</label>
                        </div>

                        <div class="form-check form-check-inline mb-0">
                            <input class="form-check-input" type="radio" name="status[]" id="status_minus" value="-">
                            <label class="form-check-label" for="status_minus">-</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan[]" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto">Dokumentasi</label>
                        <input type="file" class="form-control" id="foto" accept="image/*" name="foto[]">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveSubKegiatan">Tambah</button>
            </div>
        </div>
    </div>
</div>

<script>
    let subSelect;

    document.addEventListener('DOMContentLoaded', function () {
        const element = document.getElementById('sub');


        if (subSelect) {
            subSelect.destroy();
        }

        subSelect = new Choices(element, {
            shouldSort: false
        });
    });

    const subKegiatanData = {
        "Safety Talk / P5M": {
            kategori: "SM B1 & SM B2",
            frekuensi: "Awal Shift",
            lokasi: "Area Tambang"
        },
        "Checklist Standard PIT - Excellent Patrol": {
            kategori: "SM B1 & SM B2",
            frekuensi: "Daily/Shift",
            lokasi: "Seluruh PIT"
        },
        "Inspeksi Terencana (Level 2)": {
            kategori: "All Area, A3 Barat (Sump), B2 (Sump)",
            frekuensi: "Pagi (sesuai Jadwal)",
            lokasi: "SM B1 & B2"
        },
        "Sidak/Sweeping (Inspeksi Tidak Terencana)": {
            kategori: "Seat Belt, Simper, Kecepatan, Jarak Aman, Kepatuhan Rambu, APD",
            frekuensi: "Sepanjang Shift",
            lokasi: "Random Area"
        },
        "Monitoring Pengawas": {
            kategori: "KLKH Pengawas, Keberadaan & Fungsi Pengawas",
            frekuensi: "100%/Shift",
            lokasi: "Seluruh PIT"
        },
        "Pengukuran Pencahayaan": {
            kategori: "Shift Malam (2x/Minggu)",
            frekuensi: "Malam",
            lokasi: "Front Loading, Disposal, Pitstop dll"
        },
        "Kelengkapan & Standar Rambu": {
            kategori: "Minimal 3 Titik/Hari",
            frekuensi: "Siang/Malam",
            lokasi: "Jalan Tambang"
        },
        "Observasi Perilaku Khusus/Area Kritis": {
            kategori: "10 Orang/Minggu",
            frekuensi: "Sepanjang Shift",
            lokasi: "Seluruh PIT"
        },
        "Mari Ngopi": {
            kategori: "SM B1 & SM B2",
            frekuensi: "Daily/Shift",
            lokasi: "Seluruh PIT"
        },
        "Meeting Koordinasi": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "Daily Meeting, Meeting Internal SE, Mitra Kerja, Koordinasi Safety Representative",
            lokasi: "View Point, Kantor, Pondok"
        },
        "Monitoring Blasting": {
            kategori: "Standby di View Point",
            frekuensi: "Jam Istirahat",
            lokasi: "View Point"
        },
        "Support Excort Mobilisasi Unit": {
            kategori: "Excort Commander",
            frekuensi: "Sesuai Permintaan",
            lokasi: "Seluruh PIT"
        },

    };

    function handleChangeShift(selectedValue) {
        const kategori = document.getElementById('kategori');
        const frekuensi = document.getElementById('frekuensi');
        const lokasi = document.getElementById('lokasi');

        if (subKegiatanData[selectedValue]) {
            kategori.value = subKegiatanData[selectedValue].kategori || '';
            frekuensi.value = subKegiatanData[selectedValue].frekuensi || '';
            lokasi.value = subKegiatanData[selectedValue].lokasi || '';
        } else {
            kategori.value = '';
            frekuensi.value = '';
            lokasi.value = '';
        }

        // if (selectedValue === 'Lain-Lain') {
        //     kategori.readOnly = true;
        //     frekuensi.readOnly = false;
        //     lokasi.readOnly = false;

        //     kategori.value = 'Evaluasi';
        //     frekuensi.value = '';
        //     lokasi.value = '';
        // } else {
        //     // kategori.readOnly = true;
        //     // frekuensi.readOnly = true;
        //     // lokasi.readOnly = true;
        // }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const sub = document.getElementById('sub');
        if (sub.value) {
            handleChangeShift(sub.value);
        }
    });
</script>
