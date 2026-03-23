@include('layout.head', ['title' => 'Profil'])
@include('layout.sidebar')
@include('layout.header')


<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Profil</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body py-0">
                        <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab"
                                    href="#profile-1" role="tab" aria-selected="true"><i
                                        class="ti ti-user me-2"></i>General</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-tab-4" data-bs-toggle="tab"
                                    href="#profile-4" role="tab" aria-selected="true"><i
                                        class="ti ti-lock me-2"></i>Ganti Password</a></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                        <div class="row">
                            <div class="col-lg-4 col-xxl-3">
                                <div class="card">
                                    <div class="card-body position-relative">
                                        <div class="position-absolute end-0 top-0 p-3"><span
                                                class="badge bg-primary">Summary</span></div>
                                        <div class="text-center mt-3">
                                                <div class="chat-avtar d-inline-flex mx-auto"><img class="rounded-circle img-fluid wid-70"
                                                    src="{{ Auth::user()->avatar ? asset('storage/avatar/'.Auth::user()->avatar) : asset('dashboard/assets') }}/images/user/avatar-1.png"></div>
                                            <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                            <p class="text-muted text-sm">{{ Auth::user()->role }}</p>
                                            <hr class="my-3 border border-secondary-subtle">
                                            <hr class="my-3 border border-secondary-subtle">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="ti ti-calendar-event text-primary me-2"></i>
                                                <span class="text-muted me-2">Member Sejak:</span>
                                                <span>
                                                    {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d M Y') }}
                                                </span>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">
                                                <i class="ti ti-phone text-primary me-2"></i>
                                                <span class="text-muted me-2">No HP:</span>
                                                <span>
                                                    {{ Auth::user()->no_hp ?? '-' }}
                                                </span>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">
                                                <i class="ti ti-building text-primary me-2"></i>
                                                <span class="text-muted me-2">Section:</span>
                                                <span>
                                                    {{ Auth::user()->section ?? '-' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xxl-9">
                                <div class="card">
                                    <div class="position-absolute end-0 top-0 p-3"><span
                                                class="badge bg-primary">Account</span></div>
                                    <div class="card-header">
                                        <h5>Personal Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0 pt-0">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="mb-1 text-muted">NIK</p>
                                                        <p class="mb-0">{{ $poka->Nik }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1 text-muted">Nama Lengkap</p>
                                                        <p class="mb-0">{{ $poka->Nama }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="mb-1 text-muted">No. Handphone</p>
                                                        <p class="mb-0">{{ $poka->No_Hp }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1 text-muted">Tanggal Lahir</p>
                                                        <p class="mb-0">{{ $poka->DOB }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="mb-1 text-muted">Agama</p>
                                                        <p class="mb-0">{{ $poka->Agama }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1 text-muted">Suku</p>
                                                        <p class="mb-0">{{ $poka->Suku }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0 pb-0">
                                                <p class="mb-1 text-muted">Email</p>
                                                <p class="mb-0">{{ $poka->Alamat_Email }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Active Sessions</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">

                                            @foreach($sessions as $session)

                                            <li class="list-group-item px-0">
                                                <div class="d-flex align-items-center justify-content-between">

                                                    <div>

                                                        <p class="mb-1">
                                                            {{ Str::limit($session->user_agent,40) }}

                                                            @if($session->id === session()->getId())
                                                            <span class="badge bg-success ms-2">Current</span>
                                                            @endif

                                                        </p>

                                                        <p class="mb-0 text-muted">
                                                            IP : {{ $session->ip_address }}
                                                        </p>

                                                        <p class="mb-0 text-muted small">
                                                            Last activity :
                                                            {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                                                        </p>

                                                    </div>

                                                    @if($session->id !== session()->getId())
                                                    <form method="POST" action="{{ route('session.logout') }}">
                                                        @csrf
                                                        <input type="hidden" name="session_id"
                                                            value="{{ $session->id }}">

                                                        <button class="btn btn-link-danger">
                                                            Logout
                                                        </button>
                                                    </form>
                                                    @endif

                                                </div>
                                            </li>

                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                        <div class="card">
                            <form action="{{ route('profile.change-password') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Password Lama</label>
                                                <input type="password" name="password_lama" class="form-control" required>
                                            </div>
                                            <div class="mb-3"><label class="form-label">Password Baru</label>
                                                <input type="password" name="password_baru" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5>Rekomendasi Password:</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <i class="ti ti-circle-check text-success f-16 me-2"></i>
                                                    Minimal 5 karakter
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="ti ti-circle-check text-success f-16 me-2"></i>
                                                    Mengandung minimal 1 huruf kecil (a-z)
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="ti ti-circle-check text-success f-16 me-2"></i>
                                                    Mengandung minimal 1 huruf besar (A-Z)
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="ti ti-circle-check text-success f-16 me-2"></i>
                                                    Mengandung minimal 1 angka (0-9)
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end btn-page">
                                    <div class="btn btn-primary">
                                        <button type="submit" class="btn btn-primary px-4 py-2">
                                            <i class="ti ti-device-floppy me-1"></i>
                                            Update Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- [ sample-page ] end -->
        </div><!-- [ Main Content ] end -->
    </div>
</div>

@include('layout.footer')
