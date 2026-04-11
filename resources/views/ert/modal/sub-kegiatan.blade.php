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
                        <label for="sub">Sub Kegiatan / Detail</label>
                        <select class="form-select" id="sub" name="sub[]" onchange="handleChangeShift(this.value)" data-trigger>
                            <option value="">-- Pilih Sub Kegiatan --</option>

                            <option value="Monitoring Rencana Tanggap Darurat All Area">Monitoring Rencana Tanggap Darurat All Area</option>
                            <option value="ERT Induction Training (Pasca Cuti)">ERT Induction Training (Pasca Cuti)</option>
                            <option value="Inspeksi Area Kritis">Inspeksi Area Kritis</option>
                            <option value="Meeting Internal ERT">Meeting Internal ERT</option>
                            <option value="Update Pembuatan Jalur Evakuasi Hazard map">Update Pembuatan Jalur Evakuasi Hazard map</option>
                            <option value="Inspeksi Dan Update Emergency Escort Point">Inspeksi Dan Update Emergency Escort Point</option>
                            <option value="Inspeksi Tool Equipment & Accessories (TEA)">Inspeksi Tool Equipment & Accessories (TEA)</option>
                            <option value="Mapping Kebutuhan Personil ERT / Pembuatan Roster">Mapping Kebutuhan Personil ERT / Pembuatan Roster</option>
                            <option value="Review Training Need Analysis Personil ERT">Review Training Need Analysis Personil ERT</option>
                            <option value="Inspeksi Terencana Level 2 – Workshop (B-A, Support, Track, Tyre, Rebuild, Pump, Washing Bay, KWN/KRI, IWACO, K2B)">Inspeksi Terencana Level 2 – Workshop (B-A, Support, Track, Tyre, Rebuild, Pump, Washing Bay, KWN/KRI, IWACO, K2B)</option>

                            <option value="P2H Unit Ambulance & P3K">P2H Unit Ambulance & P3K</option>
                            <option value="P2H Unit Rescue Car">P2H Unit Rescue Car</option>
                            <option value="APAR Inspection – Building">APAR Inspection – Building</option>

                            <option value="Fire Alarm Inspection">Fire Alarm Inspection</option>
                            <option value="Hydrant Inspection">Hydrant Inspection</option>
                            <option value="Eye Wash Inspection">Eye Wash Inspection</option>
                            <option value="Inspeksi Rambu Muster Point">Inspeksi Rambu Muster Point</option>
                            <option value="Perawatan Turn of Gear (TOG) / Peralatan">Perawatan Turn of Gear (TOG) / Peralatan</option>
                            <option value="Program Kompetensi Training Internal">Program Kompetensi Training Internal</option>
                            <option value="Training Internal ERT Volunteer – Teori & Physical Ability">Training Internal ERT Volunteer – Teori & Physical Ability</option>
                            <option value="Pelaksanaan Review Emergency Drill">Pelaksanaan Review Emergency Drill</option>
                            <option value="Update Waktu & Jarak Response Per Area Kerja/Pit">Update Waktu & Jarak Response Per Area Kerja/Pit</option>
                            <option value="Emergency Call Check SCC – Area Kerja / Pit">Emergency Call Check SCC – Area Kerja / Pit</option>
                            <option value="Radio Modulation Check (SCC SIMS – RTD Kideco)">Radio Modulation Check (SCC SIMS – RTD Kideco)</option>
                            <option value="Pembuatan Laporan Kegiatan Pemulihan">Pembuatan Laporan Kegiatan Pemulihan</option>
                            <option value="Safety Talk – Sosialisasi Pengelolaan Tanggap Darurat">Safety Talk – Sosialisasi Pengelolaan Tanggap Darurat</option>
                            <option value="Pembuatan Safety Campaign (Flyer/Banner/Spanduk)">Pembuatan Safety Campaign (Flyer/Banner/Spanduk)</option>
                            <option value="Laporan Program dan Update IBPR ERT">Laporan Program dan Update IBPR ERT</option>
                            <option value="Lain-Lain">Lain-Lain</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kategori">Kategori</label>
                        <input class="form-control" id="kategori" name="kategori[]" rows="2">
                    </div>

                    <div class="mb-3">
                        <label for="frekuensi">Frekuensi</label>
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
                        <input class="form-control" id="keterangan" name="keterangan[]" rows="2">
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
        "Monitoring Rencana Tanggap Darurat All Area": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "Daily/Shift",
            lokasi: "All Area"
        },
        "ERT Induction Training (Pasca Cuti)": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "Daily/Shift",
            lokasi: "Training Center"
        },
        "Inspeksi Area Kritis": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "Daily/Shift",
            lokasi: "Area Kritis"
        },
        "Meeting Internal ERT": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "2x/Bulan",
            lokasi: "Station ERT"
        },
        "Update Pembuatan Jalur Evakuasi Hazard map": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Seluruh Pit"
        },
        "Inspeksi Dan Update Emergency Escort Point": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "All Area"
        },
        "Inspeksi Tool Equipment & Accessories (TEA)": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Base ERT"
        },
        "Mapping Kebutuhan Personil ERT / Pembuatan Roster": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Base ERT"
        },
        "Review Training Need Analysis Personil ERT": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Base ERT"
        },
        "Inspeksi Terencana Level 2 – Workshop (B-A, Support, Track, Tyre, Rebuild, Pump, Washing Bay, KWN/KRI, IWACO, K2B)": {
            kategori: "Identifikasi & Pencegahan Keadaan Darurat",
            frekuensi: "11x/Bulan",
            lokasi: "All Area"
        },
        "P2H Unit Ambulance & P3K": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "Daily/Shift",
            lokasi: "Base ERT"
        },
        "P2H Unit Rescue Car": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "Daily/Shift",
            lokasi: "Base ERT"
        },
        "APAR Inspection – Building": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Gedung/Office"
        },
        "Fire Alarm Inspection": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Gedung/Office"
        },
        "Hydrant Inspection": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Seluruh Area"
        },
        "Eye Wash Inspection": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Workshop, Fuel Station, Pit Stop"
        },
        "Inspeksi Rambu Muster Point": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "All Area"
        },
        "Perawatan Turn of Gear (TOG) / Peralatan": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "Station ERT"
        },
        "Program Kompetensi Training Internal": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Minggu",
            lokasi: "Station ERT"
        },
        "Training Internal ERT Volunteer – Teori & Physical Ability": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Minggu",
            lokasi: "Station ERT"
        },
        "Pelaksanaan Review Emergency Drill": {
            kategori: "Kesiapan Tanggap Darurat",
            frekuensi: "1x/Bulan",
            lokasi: "All Area"
        },
        "Update Waktu & Jarak Response Per Area Kerja/Pit": {
            kategori: "Respon (Response)",
            frekuensi: "1x/Bulan",
            lokasi: "All Area"
        },
        "Emergency Call Check SCC – Area Kerja / Pit": {
            kategori: "Respon (Response)",
            frekuensi: "1x/Bulan",
            lokasi: "All Area"
        },
        "Radio Modulation Check (SCC SIMS – RTD Kideco)": {
            kategori: "Respon (Response)",
            frekuensi: "Daily/Shift",
            lokasi: "Station ERT"
        },
        "Pembuatan Laporan Kegiatan Pemulihan": {
            kategori: "Respon (Response)",
            frekuensi: "1x/Bulan",
            lokasi: "Station ERT"
        },
        "Safety Talk – Sosialisasi Pengelolaan Tanggap Darurat": {
            kategori: "Respon (Response)",
            frekuensi: "2x/Bulan",
            lokasi: "All Area"
        },
        "Pembuatan Safety Campaign (Flyer/Banner/Spanduk)": {
            kategori: "Respon (Response)",
            frekuensi: "1x/Bulan",
            lokasi: "All Area"
        },
        "Laporan Program dan Update IBPR ERT": {
            kategori: "Evaluasi",
            frekuensi: "1x/Bulan",
            lokasi: "Station ERT"
        },
        "Lain-Lain": {
            kategori: "",
            frekuensi: "",
            lokasi: ""
        }
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
        //     kategori.readOnly = true;
        //     frekuensi.readOnly = true;
        //     lokasi.readOnly = true;
        // }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const sub = document.getElementById('sub');
        if (sub.value) {
            handleChangeShift(sub.value);
        }
    });
</script>
