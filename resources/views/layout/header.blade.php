<header class="pc-header">
<style>
    .user-avtar{
        width:45px !important;
        height:45px !important;
        min-width:45px;
        min-height:45px;
        border-radius:50% !important;
        object-fit:cover !important;
        object-position:center 20% !important;
        display:block;
    }
    .profile-user-avatar{
        width:65px !important;
        height:65px !important;
        min-width:65px;
        min-height:65px;
        border-radius:50% !important;
        object-fit:cover !important;
        object-position:center 20% !important;
        display:block;
    }
    .header-brand {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        padding: 4px 0;
    }
    .header-brand-logo {
        width: 130px;
        max-width: 100%;
        height: auto;
        object-fit: contain;
        transition: filter .2s ease;
    }
    .header-brand-badge {
        display: inline-flex;
        align-items: center;
        max-width: 230px;
        padding: 6px 11px;
        border: 1px solid #d9e2ed;
        border-radius: 6px;
        background: #f2f6fa;
        color: #172b42;
        font-size: 11px;
        font-weight: 700;
        line-height: 1.3;
        letter-spacing: .1px;
        white-space: normal;
    }
    .header-profile-nik {
        color: #4b5563;
        font-size: 12px;
    }
    body[data-pc-theme="dark"] .header-brand-logo {
        filter: brightness(0) invert(1);
    }
    body[data-pc-theme="dark"] .header-brand-badge {
        background: #26364a;
        border-color: #415269;
        color: #fff;
    }
    body[data-pc-theme="dark"] .header-profile-nik {
        color: #e2e8f0;
    }
    @media (max-width: 575px) {
        .header-brand {
            gap: 7px;
        }
        .header-brand-logo {
            width: 94px;
        }
        .header-brand-badge {
            max-width: 125px;
            padding: 5px 7px;
            font-size: 9px;
        }
    }
</style>
    <div class="header-wrapper">
        <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse"><a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i
                            class="ti ti-menu-2"></i></a></li>
                <li class="pc-h-item pc-sidebar-popup"><a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i
                            class="ti ti-menu-2"></i></a></li>
                <li class="pc-h-item d-inline-flex align-items-center">
                    <div class="header-brand">
                        <img src="{{ asset('dashboard/assets') }}/images/logo-full.png" class="header-brand-logo" alt="Logo PT SIMS Jaya Kaltim">
                        <span class="header-brand-badge theme-version">{{ config('app.name') }}</span>
                    </div>
                </li>
            </ul>
        </div><!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">

                <li class="dropdown pc-h-item header-user-profile"><a
                        class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false"><img
                            src="{{ Auth::user()->avatar ? 'https://hrlink.ptsims.co.id/asset/foto/karyawan/' . Auth::user()->avatar : asset('dashboard/assets/images/user/avatar-1.png') }}" alt="user-image" class="user-avtar"></a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Profile</h5>
                        </div>
                        <div class="dropdown-body">
                            <div class="profile-notification-scroll position-relative"
                                style="max-height: calc(100vh - 225px)">
                                <div class="d-flex mb-1">
                                    <div class="flex-shrink-0"><img src="{{ Auth::user()->avatar ? 'https://hrlink.ptsims.co.id/asset/foto/karyawan/' . Auth::user()->avatar : asset('dashboard/assets/images/user/avatar-1.png') }}"
                                    alt="user-image"
                                    class="user-avtar wid-35"></div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ Auth::user()->name }}</h6><span class="header-profile-nik">{{ Auth::user()->nik }}</span>
                                    </div>
                                </div>
                                <hr class="border-secondary border-opacity-50">
                                {{-- <div class="card">
                                    <div class="card-body py-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5 class="mb-0 d-inline-flex align-items-center"><svg
                                                    class="pc-icon text-muted me-2">
                                                    <use xlink:href="#custom-notification-outline"></use>
                                                </svg>Pemberitahuan</h5>
                                            <div class="form-check form-switch form-check-reverse m-0"><input
                                                    class="form-check-input f-18" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <p class="text-span">Manage</p><a href="{{ route('profile.index') }}" class="dropdown-item"><span><svg
                                            class="pc-icon text-muted me-2">
                                            <use xlink:href="#custom-setting-outline"></use>
                                        </svg> <span>Profil</span> </span></a>
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePassword">
                                            <span> <svg class="pc-icon text-muted me-2"> <use xlink:href="#custom-share-bold"></use> </svg>
                                                <span>Ganti Password</span>
                                            </span>
                                        </a>

                                <hr class="border-secondary border-opacity-50">
                                <div class="pc-dark">
                                    <h6 class="mb-1">Tema</h6>
                                    <div class="row theme-color theme-layout">
                                        <div class="col-4">
                                            <div class="d-grid"><button class="preset-btn btn active" data-value="true"
                                                    data-bs-toggle="tooltip" title="Light"><svg
                                                        class="pc-icon text-warning">
                                                        <use xlink:href="#custom-sun-1"></use>
                                                    </svg></button></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-grid"><button class="preset-btn btn" data-value="false"
                                                    data-bs-toggle="tooltip" title="Dark"><svg
                                                        class="pc-icon">
                                                        <use xlink:href="#custom-moon"></use>
                                                    </svg></button></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-grid"><button class="preset-btn btn" data-value="default"
                                                    data-bs-toggle="tooltip"
                                                    title="Automatically sets the theme based on user's operating system's color scheme."><span
                                                        class="pc-lay-icon d-flex align-items-center justify-content-center"><i
                                                            class="ph-duotone ph-cpu"></i></span></button></div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-secondary border-opacity-50">
                                <div class="card-body">
                                    <div class="d-grid mb-12">
                                        <a href="{{ route('logout') }}" class="text-decoration-none">
                                            <span class="badge w-100" style="font-size:14px;background-color:#001932">
                                                <svg class="pc-icon me-2">
                                                    <use xlink:href="#custom-logout-1-outline"></use>
                                                </svg>
                                                Logout
                                            </span>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>

