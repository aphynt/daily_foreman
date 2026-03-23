<div class="modal fade" id="editReferensi{{ $conf->id }}" tabindex="-1" aria-labelledby="modalSupportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSupportLabel">Edit Referensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('reference.update', $conf->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" value="{{ $conf->keterangan }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Value</label>
                        <input type="text" class="form-control" name="value" value="{{ $conf->value }}" required>
                    </div>
                    <div class="col-md-4">
                        <h5>Is Active</h5>

                        <input type="hidden" name="statusenabled" value="0">

                        <div class="form-check form-switch custom-switch-v1 mb-2">
                            <input type="checkbox"
                                class="form-check-input input-light-success"
                                name="statusenabled"
                                value="1"
                                {{ $conf->statusenabled ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
