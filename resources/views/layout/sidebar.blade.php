<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header justify-content-center"><a href="#" class="b-brand text-primary">
                <span class="badge bg-light-success rounded-pill ms-2 theme-version fs-4">{{ config('app.name') }}</span></a></div>
        <div class="navbar-content">
            <a style="color:#001932;" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0"><img src="{{ Auth::user()->avatar ? asset('storage/avatar/'.Auth::user()->avatar) : asset('dashboard/assets') }}/images/user/avatar-1.png"
                                    alt="user-image" class="user-avtar wid-45 rounded-circle"></div>
                            <div class="flex-grow-1 ms-3 me-2">
                                <h6 class="mb-0" style="font-size: 12px">{{ Auth::user()->name }}</h6>
                                <small>{{ Auth::user()->roleRel->name }}</small>
                            </div><svg class="pc-icon">
                                    <use xlink:href="#custom-sort-outline"></use>
                                </svg>
                        </div>

                        <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                            <div class="pt-3">
                                <a href="#!" data-bs-toggle="modal" data-bs-target="#changePassword"><svg class="pc-icon text-muted me-2"> <use xlink:href="#custom-share-bold"></use> </svg> <span>Ganti Password</span></a>
                                <a href="{{ route('profile.index') }}"><i class="ti ti-settings"></i><span>Profil</span></a>
                                <a href="{{ route('logout') }}"><i class="ti ti-power"></i><span>Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <ul class="pc-navbar">
                <li class="pc-item pc-caption"><label>Navigation</label></li>

                {{-- HOME --}}
                @if (canAccess('dashboard.index'))
                <li class="pc-item"><a href="{{ route('dashboard.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/house.png" alt="NT"></span><span class="pc-mtext">Home</span></a></li>
                @endif

                {{-- PRODUKSI --}}
                @if (canAccess('production.index'))
                <li class="pc-item"><a href="{{ route('production.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/production.png" alt="NT"></span><span class="pc-mtext">Produksi Per Jam</span></a></li>
                @endif
                @if (canAccess('production.ex'))
                <li class="pc-item"><a href="{{ route('production.ex') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/production-ex.png" alt="NT"></span><span class="pc-mtext">Produksi EX Per Jam</span></a></li>
                @endif

                @if (canAccess('stagingplan'))
                <li class="pc-item"><a href="{{ route('stagingplan') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/blueprint.png" alt="NT"></span><span class="pc-mtext">Staging Plan</span></a></li>
                @endif

                {{-- PAYLOAD --}}
                @if (canAccess('payloadritation.exa'))
                <li class="pc-item"><a href="{{ route('payloadritation.exa') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/loading.png" alt="NT"></span><span class="pc-mtext">Payload & Ritation</span></a></li>
                @endif

                {{-- MONITORING PAYLOAD --}}
                @if (canAccess('monitoringpayload'))
                <li class="pc-item"><a href="{{ route('monitoringpayload') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/kpi.png" alt="NT"></span><span class="pc-mtext">Monitoring Payload</span></a></li>
                @endif

                {{-- DASHBOARD --}}
                @if (
                    canAccess('front-loading.index') ||
                    canAccess('alat-support.index') ||
                    canAccess('catatan-pengawas.index') ||
                    canAccess('bb.loading-point.index') ||
                    canAccess('bb.unit-support.index') ||
                    canAccess('bb.catatan-pengawas.index') ||
                    canAccess('pengawas-pitstop.operator') ||
                    canAccess('laporan-kata-sandi.jamMonitor')
                )
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                        <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/dashboard.png" alt="DS"> </span><span class="pc-mtext">Dashboard</span> <span class="pc-arrow"><i data-feather="chevron-right"></i></span> <span class="pc-badge">4</span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item pc-hasmenu"><a href="#!" class="pc-link">Produksi<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                @if (canAccess('front-loading.index'))
                                <li class="pc-item"><a class="pc-link" href="{{ route('front-loading.index') }}">Front Loading</a></li>
                                @endif
                                @if (canAccess('alat-support.index'))
                                <li class="pc-item"><a class="pc-link" href="{{ route('alat-support.index') }}">Alat Support</a></li>
                                @endif
                                @if (canAccess('catatan-pengawas.index'))
                                <li class="pc-item"><a class="pc-link" href="{{ route('catatan-pengawas.index') }}">Catatan Pengawas</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class="pc-item pc-hasmenu"><a href="#!" class="pc-link">Batu Bara<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                @if (canAccess('bb.loading-point.index'))
                                <li class="pc-item"><a class="pc-link" href="{{ route('bb.loading-point.index') }}">Loading Point</a></li>
                                @endif
                                @if (canAccess('bb.unit-support.index'))
                                <li class="pc-item"><a class="pc-link" href="{{ route('bb.unit-support.index') }}">Unit Support</a></li>
                                @endif
                                @if (canAccess('bb.catatan-pengawas.index'))
                                <li class="pc-item"><a class="pc-link" href="{{ route('bb.catatan-pengawas.index') }}">Catatan Pengawas</a></li>
                                @endif
                            </ul>
                        </li>
                        @if (canAccess('pengawas-pitstop.operator'))
                        <li class="pc-item"><a class="pc-link" href="{{ route('pengawas-pitstop.operator') }}">Pitstop</a></li>
                        @endif
                        @if (canAccess('laporan-kata-sandi.jamMonitor'))
                        <li class="pc-item"><a class="pc-link" href="{{ route('laporan-kata-sandi.jamMonitor') }}">Kata Sandi</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                @if (canAccess('sop.index'))
                <li class="pc-item"><a href="{{ route('sop.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/sop.png" alt="NT"></span><span class="pc-mtext">SOP</span></a></li>
                @endif

                @if (canAccess('hazard-report.index'))
                <li class="pc-item"><a href="{{ route('hazard-report.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/hazard.png" alt="NT"></span><span class="pc-mtext">Hazard Report</span></a></li>
                @endif

                <li class="pc-item pc-caption"><label>Laporan Harian</label></li>
                {{-- LAPORAN HARIAN --}}
                @if (
                    canAccess('pengawas-produksi-pitstop.index') ||
                    canAccess('form-pengawas-batubara.show') ||
                    canAccess('form-pengawas-sap.show') ||
                    canAccess('laporan-kata-sandi.show') ||
                    canAccess('jobpending.produksi.detail') ||
                    canAccess('jobpending.safety.detail') ||
                    canAccess('p2h.show') ||
                    canAccess('ert.show') ||
                    canAccess('patrol.show')
                )

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                        <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/list.png" alt="DS"> </span><span class="pc-mtext">Daftar Laporan</span> <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        @if (canAccess('pengawas-produksi-pitstop.index'))<li class="pc-item"><a class="pc-link" href="{{ route('pengawas-produksi-pitstop.index') }}">Pengawas OB</a></li>@endif
                        @if (canAccess('form-pengawas-batubara.show'))<li class="pc-item"><a class="pc-link" href="{{ route('form-pengawas-batubara.show') }}">Pengawas Coal</a></li>@endif
                        @if (canAccess('form-pengawas-sap.show'))<li class="pc-item"><a class="pc-link" href="{{ route('form-pengawas-sap.show') }}">Laporan Inspeksi</a></li>@endif
                        @if (canAccess('laporan-kata-sandi.show'))<li class="pc-item"><a class="pc-link" href="{{ route('laporan-kata-sandi.show') }}">Laporan Kata Sandi</a></li>@endif
                        @if (canAccess('jobpending.produksi.detail'))<li class="pc-item"><a class="pc-link" href="{{ route('jobpending.produksi.detail') }}">Laporan Job Pending Produksi</a></li>@endif
                        {{-- @if (canAccess('jobpending.safety.detail'))<li class="pc-item"><a class="pc-link" href="{{ route('jobpending.safety.detail') }}">Laporan Job Pending Safety</a></li>@endif --}}
                        @if (canAccess('p2h.show'))<li class="pc-item"><a class="pc-link" href="{{ route('p2h.show') }}">Laporan P2H</a></li>@endif
                        @if (canAccess('ert.show'))<li class="pc-item"><a class="pc-link" href="{{ route('ert.show') }}">Laporan Safety ERT</a></li>@endif
                        @if (canAccess('patrol.show'))<li class="pc-item"><a class="pc-link" href="{{ route('patrol.show') }}">Laporan Safety Patrol</a></li>@endif
                    </ul>
                </li>
                @endif

                {{-- FORM LAPORAN KERJA --}}
                @if (
                    canAccess('form-pengawas-new.index') ||
                    canAccess('form-pengawas-batubara.index') ||
                    canAccess('pengawas-pitstop.index') ||
                    canAccess('laporan-kata-sandi.index') ||
                    canAccess('ert.index') ||
                    canAccess('patrol.index')
                )
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                        <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" alt="DS"> </span><span class="pc-mtext">Form Laporan Kerja</span> <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        @if (canAccess('form-pengawas-new.index'))<li class="pc-item"><a class="pc-link" href="{{ route('form-pengawas-new.index') }}">Pengawas Produksi</a></li>@endif
                        @if (canAccess('form-pengawas-batubara.index'))<li class="pc-item"><a class="pc-link" href="{{ route('form-pengawas-batubara.index') }}">Pengawas Batu Bara</a></li>@endif
                        @if (canAccess('pengawas-pitstop.index'))<li class="pc-item"><a class="pc-link" href="{{ route('pengawas-pitstop.index') }}">Pengawas Pitstop</a></li>@endif
                        @if (canAccess('laporan-kata-sandi.index'))<li class="pc-item"><a class="pc-link" href="{{ route('laporan-kata-sandi.index') }}">Laporan Kata Sandi</a></li>@endif
                        @if (canAccess('ert.index'))<li class="pc-item"><a class="pc-link" href="{{ route('ert.index') }}">Emergency Response Team</a></li>@endif
                        @if (canAccess('patrol.index'))<li class="pc-item"><a class="pc-link" href="{{ route('patrol.index') }}">Patrol</a></li>@endif
                    </ul>
                </li>
                @endif

                @if (canAccess('sap.index'))
                <li class="pc-item"><a href="{{ route('sap.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" alt="NT"></span><span class="pc-mtext">Form SAP</span></a></li>
                @endif



                {{-- JOB PENDING --}}
                @if (canAccess('jobpending.produksi'))
                <li class="pc-item"><a href="{{ route('jobpending.produksi') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/job-creation.png" alt="NT"></span><span class="pc-mtext">Job Pending Produksi</span></a></li>
                @endif

                {{-- @if (canAccess('jobpending.safety'))
                <li class="pc-item"><a href="{{ route('jobpending.safety') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/job-creation.png" alt="NT"></span><span class="pc-mtext">Job Pending Safety</span></a></li>
                @endif --}}

                <li class="pc-item pc-caption"><label>Kesiapan & Verifikasi</label></li>

                {{-- VERIFIKASI --}}
                @if (
                    canAccess('verifikasi.klkh') ||
                    canAccess('monitoring.p2h')
                )
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                        <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/stamp.png" alt="DS"> </span><span class="pc-mtext">Verifikasi</span> <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        @if (canAccess('verifikasi.klkh'))<li class="pc-item"><a class="pc-link" href="{{ route('verifikasi.klkh') }}">KLKH</a></li>@endif
                        @if (canAccess('monitoring.p2h'))<li class="pc-item"><a class="pc-link" href="{{ route('monitoring.p2h') }}">P2H</a></li>@endif
                    </ul>
                </li>
                @endif

                {{-- P2H UNIT --}}
                @if (canAccess('p2h.index'))
                <li class="pc-item"><a href="{{ route('p2h.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/worker.png" alt="NT"></span><span class="pc-mtext">P2H Unit</span></a></li>
                @endif

                {{-- KKH --}}
                @if (canAccess('kkh.all') || canAccess('kkh.name'))
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                        <img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/ergonomic.png" alt="DS"> </span><span class="pc-mtext">KKH</span> <span class="pc-arrow"><i data-feather="chevron-right"></i></span> <span class="pc-badge">2</span>
                    </a>
                    <ul class="pc-submenu">
                        @if (canAccess('kkh.all'))<li class="pc-item"><a class="pc-link" href="{{ route('kkh.all') }}">Seleksi per Tanggal</a></li>@endif
                        @if (canAccess('kkh.name'))<li class="pc-item"><a class="pc-link" href="{{ route('kkh.name') }}">Seleksi per Nama</a></li>@endif
                    </ul>
                </li>
                @endif



                {{-- ADMIN / MANAGEMENT --}}
                @if (canAccess('rosterkerja.produksi'))
                <li class="pc-item"><a href="{{ route('rosterkerja.produksi') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/project.png" alt="NT"></span><span class="pc-mtext">Roster Kerja Produksi</span></a></li>
                @endif

                @if (canAccess('rosterkerja.safety'))
                <li class="pc-item"><a href="{{ route('rosterkerja.safety') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/project.png" alt="NT"></span><span class="pc-mtext">Roster Kerja Safety</span></a></li>
                @endif

                @if (canAccess('monitoringlaporankerjaklkh'))
                <li class="pc-item"><a href="{{ route('monitoringlaporankerjaklkh') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/spyware.png" alt="NT"></span><span class="pc-mtext">Monitoring Laporan Kerja</span></a></li>
                @endif

                {{-- CONFIG --}}
                @if (canAccess('user.index') || canAccess('log.index'))
                <li class="pc-item pc-caption"><label>Configuration</label></li>
                @endif
                @if (canAccess('user.index'))
                <li class="pc-item"><a href="{{ route('user.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/user.png" alt="NT"></span><span class="pc-mtext">Users</span></a></li>
                @endif
                @if (canAccess('permission.index'))
                <li class="pc-item"><a href="{{ route('permission.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/user.png" alt="NT"></span><span class="pc-mtext">Permission Route</span></a></li>
                @endif
                @if (canAccess('reference.index'))
                <li class="pc-item"><a href="{{ route('reference.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/user.png" alt="NT"></span><span class="pc-mtext">Reference</span></a></li>
                @endif
                @if (canAccess('log.index'))
                <li class="pc-item"><a href="{{ route('log.index') }}" class="pc-link"><span class="pc-micon"><img class="pc-icon" src="{{ asset('dashboard/assets') }}/images/widget/log.png" alt="NT"></span><span class="pc-mtext">Logging User</span></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@include('layout.modal.change-password')
