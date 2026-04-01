<div class="modal fade" id="changeRole{{ $us->id }}" tabindex="-1" aria-labelledby="modalSupportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSupportLabel">Ganti Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.change-role', $us->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ $us->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>NIK</label>
                        <input type="text" class="form-control" value="{{ $us->nik }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Pilih role</label>
                        <select class="form-select" name="role" required>
                            <option value="{{ $us->role }}" selected disabled>{{ $us->role }}</option>
                            <option value="WORKER">WORKER</option>
                            <option value="FOREMAN">FOREMAN</option>
                            <option value="SUPERVISOR">SUPERVISOR</option>
                            <option value="SUPERINTENDENT">SUPERINTENDENT</option>
                            <option value="MANAGEMENT">MANAGEMENT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Pilih Departemen</label>
                        <select class="form-select" name="departemen_id" required>
                            <option value="{{ $us->departemen_id }}" selected disabled>{{ $us->departemen }}</option>
                            @foreach ($departemen as $dep)
                                <option value="{{ $dep->id }}">{{ $dep->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Pilih Posisi</label>
                        <select class="form-select" name="position" required>
                            <option value="{{ $us->position }}" selected disabled>{{ $us->position }}</option>
                            @foreach ($position as $pos)
                                <option value="{{ $pos->id }}|{{ $pos->name }}">{{ $pos->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
