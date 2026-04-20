<div class="modal fade" id="modalVerifikasiP3K" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formVerifikasiP3K" class="modal-content">
            @csrf
            <input type="hidden" name="rowID" id="p3k_row_id">
            <input type="hidden" name="fit_or" id="p3k_fit_or">
            <div class="modal-header">
                <h5 class="modal-title">Verifikasi Klinik / P3K</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" name="catatan" id="catatan_p3k_modal" rows="4" required
                    placeholder="Tuliskan catatan verifikasi klinik..."></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Verifikasi</button>
            </div>
        </form>
    </div>
</div>
