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
<div class="modal fade" id="tambahTemuanTindakLanjut" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Temuan dan Tindak Lanjut</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTemuanTindakLanjut" enctype="multipart/form-data" novalidate>
                    <div class="mb-3">
                        <label for="foto_temuan">Foto Temuan</label>
                        <input type="file" class="form-control" id="foto_temuan" accept="image/*" name="foto_temuan[]">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_temuan">Deskripsi Temuan</label>
                        <textarea class="form-control" id="deskripsi_temuan" name="deskripsi_temuan[]" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tindak_lanjut">Tindak Lanjut</label>
                        <textarea class="form-control" id="tindak_lanjut" name="tindak_lanjut[]" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select class="form-select" data-trigger id="status" onchange="handleChangeShift(this.value)" name="status">
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveTemuanTindakLanjut">Tambah</button>
            </div>
        </div>
    </div>
</div>
