<style>
    .is-valid,
    .is-invalid {
        background-image: none !important;
    }

    /* input[type="time"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    } */

    .was-validated .form-control:valid,
    .was-validated .form-control:invalid,
    .is-valid,
    .is-invalid {
        border-color: #ced4da !important;
        /* Warna default */
        box-shadow: none !important;
        /* Hapus bayangan */
        background-image: none !important;
    }
</style>
<div class="modal fade" id="tambahJobPending" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Job Pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formJobPending" novalidate>
                    <div class="mb-3">
                        <label for="description">Pekerjaan/Kegiatan Pending</label>
                        <textarea class="form-control" id="kegiatan_pending" name="kegiatan_pending[]" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description">Alasan Belum Selesai</label>
                        <textarea class="form-control" id="alasan_belum_selesai" name="alasan_belum_selesai[]" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description">Foto (jika ada)</label>
                        <input type="file" class="form-control" id="foto_pending" accept="image/*" name="foto_pending[]">
                    </div>
                    <div class="mb-3">
                        <label for="description">Prioritas</label>
                        <select class="form-select" data-trigger id="prioritas" onchange="handleChangeShift(this.value)" name="prioritas">
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description">Instruksi Shift Berikutnya</label>
                        <textarea class="form-control" id="instruksi_shift_berikutnya" name="instruksi_shift_berikutnya[]" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveJobPending">Tambah</button>
            </div>
        </div>
    </div>
</div>
