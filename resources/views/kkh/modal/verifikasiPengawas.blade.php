<div class="modal fade" id="modalVerifikasiPengawas" tabindex="-1" aria-labelledby="modalVerifikasiPengawasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <form id="formVerifikasiPengawas">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalVerifikasiPengawasLabel" style="color: white">
                        <i class="bi bi-person-check-fill"></i> Verifikasi Kelayakan Bekerja
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body p-4">
                    <input type="hidden" id="pengawas_row_id" name="rowID">
                    <input type="hidden" id="pengawas_status_layak" name="status_layak">

                    <p class="fw-semibold mb-3">
                        Pilih hasil verifikasi kelayakan bekerja:
                    </p>

                    <div class="d-flex flex-column flex-sm-row gap-3 mb-4">
                        <button type="button"
                            class="btn btn-success flex-fill btn-lg btn-pilih-kelayakan d-flex align-items-center justify-content-center gap-2"
                            data-status="1">
                            <i class="bi bi-check-circle-fill fs-5"></i> Layak Bekerja
                        </button>

                        <button type="button"
                            class="btn btn-danger flex-fill btn-lg btn-pilih-kelayakan d-flex align-items-center justify-content-center gap-2"
                            data-status="0">
                            <i class="bi bi-x-circle-fill fs-5"></i> Tidak Layak Bekerja
                        </button>
                    </div>
                </div>

                <div class="modal-footer border-0 justify-content-center py-3">
                    <button type="button" class="btn btn-outline-secondary btn-lg rounded-3 px-4" data-bs-dismiss="modal">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan CSS opsional untuk efek hover -->
<style>
    .btn-pilih-kelayakan:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.2s ease-in-out;
    }

    @media (max-width: 576px) {
        .d-flex.flex-sm-row {
            flex-direction: column !important;
        }
    }
</style>
