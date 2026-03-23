@include('layout.head', ['title' => 'Users'])
@include('layout.sidebar')
@include('layout.header')

<section class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-xl-12 col-md-12">

                <div class="mb-3 row align-items-center">
                    <div class="col-md-6 mb-2">
                        <form action="{{ route('user.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, NIK, atau role..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Search
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 mb-2 text-md-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#insertUser">
                            <span class="badge bg-success" style="font-size: 16px">
                                <i class="fas fa-plus"></i> Tambah User
                            </span>
                        </a>
                    </div>
                </div>

                @include('user.modal.insert')

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user as $index => $us)
                                        <tr>
                                            <td>
                                                {{ ($user->currentPage() - 1) * $user->perPage() + $index + 1 }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <img src="{{ asset('dashboard/assets/images/user/avatar-1.png') }}"
                                                            alt="user-image"
                                                            class="wid-40 hei-40 rounded">
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $us->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="fw-semibold">{{ $us->nik }}</td>
                                            <td class="fw-semibold">{{ $us->role }}</td>
                                            <td>
                                                @if ($us->statusenabled)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Non Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#resetPassword{{ $us->id }}">
                                                        <span class="badge bg-secondary">Reset Password</span>
                                                    </a>

                                                    @if ($us->statusenabled)
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#statusEnabled{{ $us->id }}">
                                                            <span class="badge bg-warning">Nonaktifkan</span>
                                                        </a>
                                                    @else
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#statusEnabled{{ $us->id }}">
                                                            <span class="badge bg-success">Aktifkan</span>
                                                        </a>
                                                    @endif

                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#changeRole{{ $us->id }}">
                                                        <span class="badge bg-info">Ganti Role</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        @include('user.modal.statusEnabled')
                                        @include('user.modal.resetPassword')
                                        @include('user.modal.changeRole')
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                Data user tidak ditemukan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                Menampilkan {{ $user->firstItem() ?? 0 }} - {{ $user->lastItem() ?? 0 }}
                                dari {{ $user->total() }} data
                            </small>

                            {{ $user->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
