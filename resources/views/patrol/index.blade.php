@include('layout.head', ['title' => 'Laporan Harian SE Section Patrol'])
@include('layout.sidebar')
@include('layout.header')
<style>
    .center-checkbox {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    @media (min-width: 769px) {

        .tab-pane .form-control,
        .tab-pane .form-select {
            font-size: 9pt;
            padding: 6px;
        }

        .tab-pane button {
            font-size: 9pt;
            padding: 6px;
        }

        .table tbody td,
        .table thead th {
            font-size: 9pt;
            padding: 6px;
        }
    }

    @media (max-width: 768px) {

        .tab-pane .form-control,
        .tab-pane .form-select {
            font-size: 9pt;
            padding: 6px;
        }

        .tab-pane button {
            font-size: 9pt;
            padding: 6px;
        }

        .table tbody td,
        .table thead th {
            font-size: 9pt;
            padding: 6px;
        }

        .description-text {
            word-wrap: break-word;
            white-space: normal;
            max-width: 100%;
            overflow-wrap: break-word;
        }

    }

    /* Ensure Select2/Choices search input visible and full width (esp. on mobile) */
    .select2-container { width: 100% !important; }
    .select2-dropdown { z-index: 2050; }
    .select2-search--dropdown { display: block !important; }
    .select2-search__field { display: block !important; min-width: 100% !important; }

    /* Placeholder untuk search field Select2 */
    .select2-search--dropdown .select2-search__field::placeholder {
        color: #999;
        opacity: 1;
    }
    .select2-search--dropdown .select2-search__field::-webkit-input-placeholder {
        color: #999;
    }
    .select2-search--dropdown .select2-search__field::-moz-placeholder {
        color: #999;
        opacity: 1;
    }
    .select2-search--dropdown .select2-search__field:-ms-input-placeholder {
        color: #999;
    }

    /* Placeholder untuk search field Choices */
    .choices__list--dropdown .choices__input::placeholder {
        color: #999;
        opacity: 1;
    }

    .choices { width: 100%; }
    .choices__list--dropdown .choices__input { display: block; width: 100%; }
    /* Fix: ensure rendered value not clipped/sunken across libraries */
    .select2-container { font-size: 9pt; }
    .select2-container .select2-selection--single {
        min-height: 36px;
        height: auto;
        border: 1px solid #ced4da; /* match .form-select border */
        border-radius: .375rem; /* match .form-select radius */
        display: flex;
        align-items: center; /* vertically center value */
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        display: flex;
        align-items: center;
        height: 100%;
        line-height: 1.3;
        padding-right: 28px; /* space for arrow */
        padding-left: .75rem; /* match .form-select left padding */
        white-space: normal;
        font-size: inherit; /* follow 9pt */
    }
    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 100%;
    }

    /* Choices.js */
    .choices { font-size: 9pt; }
    .choices__inner {
        min-height: 36px;
        line-height: 1.3;
        display: flex;
        align-items: center;
        border: 1px solid #ced4da;
        border-radius: .375rem;
        padding-left: .75rem;
    }

    /* TomSelect */
    .ts-control {
        min-height: 36px;
        line-height: 1.3;
        display: flex;
        align-items: center;
        border: 1px solid #ced4da;
        border-radius: .375rem;
        padding-left: .75rem;
        font-size: 9pt;
    }

    /* Strong overrides to mirror .form-select exact height and vertical centering */
    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single {
        height: 38px !important;       /* match Bootstrap default */
        min-height: 38px !important;
        padding: 0 !important;         /* remove internal padding that offsets text */
    }
    .select2-container .select2-selection--single .select2-selection__rendered,
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;  /* vertically center text exactly */
        height: 100% !important;
        padding-top: .375rem !important;
        padding-bottom: .375rem !important;
        padding-left: .75rem !important;
        padding-right: 2rem !important; /* safe space for arrow */
    }
    .select2-container .select2-selection--single .select2-selection__placeholder,
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        line-height: 1.5 !important;  /* placeholder centered too */
    }
    .select2-container .select2-selection--single .select2-selection__arrow,
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;       /* arrow fills the control height */
        right: .5rem !important;
    }
    .select2-container * { box-sizing: border-box; }

    /* Choices strong overrides to mirror .form-select */
    .choices { font-size: 9pt; }
    .choices__inner {
        height: 38px !important;
        min-height: 38px !important;
        display: flex !important;
        align-items: center !important;
        border: 1px solid #ced4da !important;
        border-radius: .375rem !important;
        padding: .375rem .75rem !important;
        box-sizing: border-box !important;
    }
    .choices__list--single .choices__item { line-height: 1.5 !important; }

    /* TomSelect strong overrides to mirror .form-select */
    .ts-control {
        height: 38px !important;
        min-height: 38px !important;
        padding: .375rem .75rem !important;
        box-sizing: border-box !important;
    }
    .ts-control .item { line-height: 1.5 !important; }
    .ts-control input { height: 38px !important; }

    /* Tingkatkan z-index untuk dropdown di dalam accordion */
    #accordionJobPending .select2-dropdown { z-index: 1080 !important; }
    #accordionJobPending .choices__list--dropdown { z-index: 1080 !important; }

    /* Pastikan accordion body tidak memotong dropdown */
    #accordionJobPending .accordion-body { overflow: visible !important; }
    #accordionJobPending .accordion-collapse { overflow: visible !important; }
    #accordionJobPending .table-responsive { overflow: visible !important; }

    /* Mobile: Accordion compact optimization */
    @media (max-width: 768px) {
        /* Accordion body padding lebih kecil */
        #accordionJobPending .accordion-body {
            padding: 0.5rem !important;
            overflow: visible !important;
        }

        /* Accordion header lebih compact */
        #accordionJobPending .accordion-button {
            padding: 10px 12px;
            font-size: 14px;
        }

        /* Button hapus lebih kecil */
        #accordionJobPending .btn-danger {
            font-size: 13px;
            padding: 8px 14px;
            width: 100%;
            margin-top: 0.5rem;
        }

        /* Table responsive dengan overflow terkontrol */
        #accordionJobPending .table-responsive {
            overflow: visible !important;
            margin: 0 -0.5rem;
        }

        /* Table di dalam accordion lebih compact */
        #accordionJobPending .table {

            font-size: 12px;
            margin-bottom: 0.5rem;
            width: 100%;
        }

        #accordionJobPending .table th,
        #accordionJobPending .table td {
            word-break: break-word;
            white-space: normal !important;
            padding: 8px 6px !important;
            vertical-align: middle;
            font-size: 12px;
        }
        #accordionTemuanTindakLanjut .table th,
        #accordionTemuanTindakLanjut .table td {
            word-break: break-word;
            white-space: normal !important;
            padding: 8px 6px !important;
            vertical-align: middle;
            font-size: 12px;
        }

        #accordionSubKegiatan .table th,
        #accordionSubKegiatan .table td {
            word-break: break-word;
            white-space: normal !important;
            padding: 8px 6px !important;
            vertical-align: middle;
            font-size: 12px;
        }


        #accordionJobPending .table th {
            width: 40%;
            font-weight: 600;
            background-color: #f8f9fa;
            white-space: normal;
            word-wrap: break-word;
        }

        #accordionJobPending .table td {
            width: 60%;
        }

        /* Form control di dalam accordion */
        #accordionJobPending .form-control,
        #accordionJobPending .form-select {
            font-size: 13px;
            padding: 6px 8px;
            min-height: 38px;
            width: 100%;
        }

        /* Input datetime-local lebih besar untuk prevent zoom */
        #accordionJobPending input[type="datetime-local"],
        #accordionJobPending input[type="text"] {
            font-size: 16px;
        }

        /* Select2 dropdown di accordion harus muncul di atas */
        #accordionJobPending .select2-container {
            z-index: 1090 !important;
        }

        #accordionJobPending .select2-container--open {
            z-index: 1090 !important;
        }

        /* Pastikan dropdown tidak terpotong */
        #accordionJobPending .select2-dropdown {
            z-index: 1091 !important;
            position: fixed !important;
        }

        /* Accordion collapse harus bisa overflow untuk dropdown */
        #accordionJobPending .accordion-collapse {
            overflow: visible !important;
        }

        /* Hidden text UUID lebih kecil */
        #accordionJobPending td {
            word-break: break-word;
        }
    }
</style>


<div class="pc-container">
    <div class="pc-content">
        <div>
            <div id="basicwizard" class="form-wizard row justify-content-center">
                <div class="col-sm-12 col-md-6 col-xxl-4 text-center">
                    <h3>Laporan Harian SE Section Patrol</h3>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item" data-target-form="#contactDetailForm"><a href="#contactDetail"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link active"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/emergency.png"
                                            alt="EX"> <span class="d-none d-sm-inline">Log
                                            On</span></a></li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#unitPitstopForm"><a href="#unitPitstop"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/planner.png" alt="EX">
                                        <span class="d-none d-sm-inline">Sub Kegiatan</span></a></li>
                                <!-- end nav item -->
                                <li class="nav-item" data-target-form="#temuanTindakLanjutForm"><a href="#temuanTindakLanjut"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/research.png"
                                            alt="EX">
                                        <span class="d-none d-sm-inline">Temuan & Tindak Lanjut</span></a></li>
                                <li class="nav-item" data-target-form="#jobPendingForm"><a href="#jobPending"
                                        data-bs-toggle="tab" data-toggle="tab" class="nav-link icon-btn"><img
                                            class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/pending.png"
                                            alt="EX">
                                        <span class="d-none d-sm-inline">Job Pending</span></a></li>
                                <!-- end nav item -->
                                <li class="nav-item"><a href="#finish" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link icon-btn"><img class="pc-icon"
                                            src="{{ asset('dashboard/assets') }}/images/widget/finishBB.png" alt="EX">
                                        <span class="d-none d-sm-inline">Finish</span></a></li>
                                <!-- end nav item -->
                            </ul>
                        </div>
                    </div>
                    @if ($daily != null)
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Info!</strong>
                            Sedang membuat draft Laporan Harian. Jangan lupa selesaikan jika laporan sudah selesai.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="#" method="post"
                                onsubmit="return validateForm()" id="submitFormKerja">
                                @csrf
                                <input type="text" style="display: none;" name="uuid" id="uuid" value="{{ old('uuid', $daily['uuid'] ?? '') }}">

                                <div class="tab-content">
                                    <!-- START: Define your progress bar here -->
                                    <div id="bar" class="progress mb-3" style="height: 7px">
                                        <div
                                            class="bar progress-bar progress-bar-striped progress-bar-animated bg-success">
                                        </div>
                                    </div><!-- END: Define your progress bar here -->
                                    <!-- START: Define your tab pans here -->
                                    <div class="tab-pane show active" id="contactDetail">
                                        <div class="text-center">
                                            <h3 class="mb-2">Informasi Dasar</h3>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-sm-6">


                                                        <div class="mb-3"><label class="form-label">Tanggal</label>
                                                            <input type="text" class="form-control" id="pc-datepicker-1"
                                                                name="date" value="{{ old('tanggal', $daily['tanggal'] ?? '') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="mb-3"> <label class="form-label"
                                                                for="shiftID">Shift</label>
                                                            <select class="form-select" id="shiftID"
                                                                onchange="handleChangeShift(this.value)"
                                                                name="shift_id">
                                                                <option selected disabled></option>
                                                                @foreach ($data['shift'] as $sh)
                                                                <option value="{{ $sh->id }}" {{ isset($daily) && $daily['shift'] == $sh->id ? 'selected' : '' }}>
                                                                    {{ $sh->keterangan }}
                                                                </option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="unitPitstop">
                                        <div class="text-center">
                                            <h3 class="mb-2">Sub Kegiatan</h3>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="mt-2">
                                                <button class="btn btn-primary mb-3" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#tambahSubKegiatan">
                                                    <i class="fa-solid fa-add"></i> Tambah Kegiatan
                                                </button>
                                                @include('patrol.modal.sub-kegiatan')
                                                <div class="accordion" id="accordionSubKegiatan"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="temuanTindakLanjut">
                                        <div class="text-center">
                                            <h3 class="mb-2">Temuan dan Tindak Lanjut</h3>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="mt-2">
                                                <button class="btn btn-primary mb-3" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#tambahTemuanTindakLanjut">
                                                    <i class="fa-solid fa-add"></i> Tambah Temuan dan Tindak Lanjut
                                                </button>
                                                @include('patrol.modal.temuan-tindak-lanjut')
                                                <div class="accordion" id="accordionTemuanTindakLanjut"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="jobPending">
                                        <div class="text-center">
                                            <h3 class="mb-2">Job Pending</h3>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="mt-2">
                                                <button class="btn btn-primary mb-3" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#tambahJobPending">
                                                    <i class="fa-solid fa-add"></i> Tambah Job Pending
                                                </button>
                                                @include('patrol.modal.job-pending')
                                                <div class="accordion" id="accordionJobPending"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end education detail tab pane -->
                                    <div class="tab-pane" id="finish">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="text-center"><i
                                                        class="ph-duotone ph-note f-50 text-danger"></i>
                                                    <h3 class="mt-4 mb-3">Terimakasih!</h3>
                                                    <p>Pastikan semua data pada form telah diisi dengan benar sebelum
                                                        melanjutkan ke tahap akhir.</p>
                                                    <div class="mb-3">
                                                        <div class="form-check d-inline-block"><input type="checkbox"
                                                                class="form-check-input" id="customCheck1" checked> <label
                                                                class="form-check-label" for="customCheck1">Saya sudah
                                                                mengisi form ini dengan benar</label></div>
                                                    </div>
                                                    <a href="javascript:void(0);" onclick="saveAsDraft('finish')"><span class="badge bg-success" style="font-size:14px"><i class="fa-solid fa-save"></i> Submit</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="d-flex wizard justify-content-end flex-wrap gap-2 mt-5">
                                        <div class="d-flex">
                                            <div id="save_as_draft_id" class="save-as-draft me-2">
                                                <a href="javascript:void(0);" onclick="saveAsDraft('draft')"><span class="badge bg-warning" style="font-size:12px"><i class="fa-solid fa-save"></i> Simpan Draft</span></a>
                                            </div>
                                            <div id="kembaliButton" class="previous me-2">
                                                <a href="javascript:void(0);"><span class="badge bg-secondary" style="font-size:12px"><i class="fa-solid fa-arrow-left"></i> Kembali</span></a>
                                                {{-- <a href="javascript:void(0);" class="btn btn-secondary btn-md">
                                                    <i class="fa-solid fa-arrow-left"></i> Kembali
                                                </a> --}}
                                            </div>
                                            <div id="lanjutButton" class="next me-3">
                                                <a href="javascript:void(0);"><span class="badge bg-success" style="font-size:12px">Lanjut <i class="fa-solid fa-arrow-right"></i></span></a>
                                                {{-- <a href="javascript:void(0);" class="btn btn-success btn-md">
                                                    Lanjut <i class="fa-solid fa-arrow-right"></i>
                                                </a> --}}
                                            </div>
                                        </div>

                                        <div style="display: none;">
                                            <div class="first me-3">
                                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm">
                                                    <i class="fa-solid fa-arrow-up"></i> Lembar Pertama
                                                </a>
                                            </div>
                                            <div class="last">
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm">
                                                    Finish <i class="fa-solid fa-check"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')


<script>
    // Inisialisasi enhancer untuk select dengan data-trigger
    function initSelectEnhancer(context = document) {
        try {
            // Prefer Select2 if available (lebih stabil di mobile)
            if (window.jQuery && jQuery.fn && jQuery.fn.select2) {
                jQuery('select[data-trigger]', context).not('[data-initialized="1"]').each(function() {
                    const $el = jQuery(this);
                    // Temukan parent terbaik untuk dropdown agar tidak terpotong/z-index masalah di mobile
                    let parentEl = $el.closest('.modal').get(0);
                    if (!parentEl) {
                        // Untuk accordion, gunakan body agar tidak tertutup
                        parentEl = $el.closest('#accordionJobPending').length ? document.body : $el.closest('.pc-container, .card, body').get(0) || document.body;
                    }
                    $el.select2({
                        width: '100%',
                        dropdownAutoWidth: true,
                        minimumResultsForSearch: 0, // paksa search selalu muncul
                        dropdownParent: jQuery(parentEl),
                        placeholder: 'Cari Nama Disini',
                        // Perbaiki perilaku fokus input search di mobile
                        selectOnClose: false,
                        // Batasi tinggi dropdown agar hanya 5 item terlihat
                        dropdownCss: { 'max-height': '150px', 'overflow-y': 'auto' },
                        language: {
                            inputTooShort: function() {
                                return 'Cari Nama Disini';
                            },
                            searching: function() {
                                return 'Mencari...';
                            }
                        }
                    });
                    // Mencegah accordion collapse saat klik select
                    $el.on('mousedown select2:opening', function(e) {
                        e.stopPropagation();
                    });
                    // Customize search placeholder after Select2 opens & prevent accordion collapse
                    $el.on('select2:open', function() {
                        // Set placeholder on search field - use multiple selectors to ensure we catch it
                        setTimeout(function() {
                            // Try multiple ways to find the search field
                            let searchField = jQuery('.select2-container--open .select2-search--dropdown .select2-search__field');
                            if (searchField.length === 0) {
                                searchField = jQuery('.select2-dropdown .select2-search__field');
                            }
                            if (searchField.length === 0) {
                                searchField = jQuery('.select2-search__field:visible');
                            }

                            if (searchField.length > 0) {
                                searchField.attr('placeholder', 'Cari Nama Disini');
                                searchField.prop('placeholder', 'Cari Nama Disini');
                            }
                        }, 10);
                        // Prevent accordion collapse
                        jQuery('.select2-dropdown').on('mousedown', function(e) { e.stopPropagation(); });
                    });
                    $el.attr('data-initialized', '1');
                    try { console.debug('Initialized with Select2:', $el.attr('name')); } catch(e) {}
                });
            }

            // Choices.js (fallback)
            if (window.Choices) {
                context.querySelectorAll('select[data-trigger]:not([data-initialized="1"])')
                    .forEach(el => {
                        // Skip jika sudah ada instance choices aktif
                        if (el.dataset && el.dataset.choices === 'active') {
                            return;
                        }
                        const instance = new Choices(el, {
                            searchEnabled: true,
                            searchChoices: true,
                            shouldSort: false,
                            itemSelectText: '',
                            searchResultLimit: 1000,
                            searchFloor: 0,
                        });
                        // Mencegah accordion collapse
                        el.addEventListener('mousedown', function(e) { e.stopPropagation(); });
                        el.addEventListener('showDropdown', function(e) {
                            e.stopPropagation();
                            // Set placeholder pada input pencarian Choices saat dropdown dibuka
                            setTimeout(function() {
                                // Cari container .choices terdekat dari select asli
                                let container = el.nextElementSibling;
                                if (!(container && container.classList && container.classList.contains('choices'))) {
                                    container = el.parentElement ? el.parentElement.querySelector('.choices') : null;
                                }
                                let searchInput = null;
                                if (container) {
                                    searchInput = container.querySelector('.choices__list--dropdown .choices__input');
                                }
                                if (!searchInput) {
                                    // fallback global yang sedang terbuka
                                    searchInput = document.querySelector('.choices.is-open .choices__list--dropdown .choices__input');
                                }
                                if (searchInput) {
                                    searchInput.setAttribute('placeholder', 'Cari Nama Disini');
                                }
                            }, 10);
                        });
                        el.setAttribute('data-initialized', '1');
                        try { console.debug('Initialized with Choices:', el.getAttribute('name')); } catch(e) {}
                    });
            }

            // TomSelect
            if (window.TomSelect) {
                context.querySelectorAll('select[data-trigger]:not([data-initialized="1"])')
                    .forEach(el => {
                        new TomSelect(el, { create: false, maxOptions: 1000, placeholder: 'Cari Nama Disini' });
                        el.setAttribute('data-initialized', '1');
                        try { console.debug('Initialized with TomSelect:', el.getAttribute('name')); } catch(e) {}
                    });
            }
        } catch (e) {
            console.warn('initSelectEnhancer error:', e);
        }
    }

    // Safe stub to avoid ReferenceError when called elsewhere
    function initOperatorReady(context = document) {
        // No-op: reserved for any special handling of Operator Ready selects
    }

    function escapeHtml(text) {
        if (text === null || text === undefined) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Jalankan saat halaman siap
    document.addEventListener('DOMContentLoaded', function() {
        initSelectEnhancer(document);
        initOperatorReady(document);

        // Re-init saat modal tambah pitstop ditampilkan
        const modalEl = document.getElementById('tambahPitstopModal');
        if (modalEl) {
            modalEl.addEventListener('shown.bs.modal', function () {
                // Destroy Select2 instances initialized while modal was hidden
                if (window.jQuery && jQuery.fn && jQuery.fn.select2) {
                    jQuery('select[data-trigger]', modalEl).each(function() {
                        const $el = jQuery(this);
                        if ($el.data('select2')) {
                            try { $el.select2('destroy'); } catch(e) {}
                            $el.removeAttr('data-initialized');
                        }
                    });
                }
                // Destroy choices jika sudah terpasang pada elemen di modal
                if (window.Choices) {
                    modalEl.querySelectorAll('select[data-trigger]').forEach(el => {
                        if (el.dataset && el.dataset.choices === 'active') {
                            try { el.choices && el.choices.destroy(); } catch(e) {}
                            el.removeAttribute('data-initialized');
                        }
                    });
                }
                initSelectEnhancer(modalEl);
                initOperatorReady(modalEl);
            });
        }

        const subKegiatanAccordion = document.getElementById('accordionSubKegiatan');
        if (subKegiatanAccordion) {
            subKegiatanAccordion.addEventListener('shown.bs.collapse', function (ev) {
                const target = ev.target; // panel collapse yang baru terbuka
                // Jika sudah ter-init Select2 saat hidden, destroy dahulu agar layout & search di mobile benar
                if (window.jQuery && jQuery.fn && jQuery.fn.select2) {
                    jQuery('select[data-trigger]', target).each(function() {
                        const $el = jQuery(this);
                        if ($el.data('select2')) {
                            try { $el.select2('destroy'); } catch(e) {}
                            $el.removeAttr('data-initialized');
                        }
                    });
                }
                // Destroy Choices juga jika ada
                if (window.Choices) {
                    target.querySelectorAll('select[data-trigger]').forEach(el => {
                        if (el.dataset && el.dataset.choices === 'active') {
                            try { el.choices && el.choices.destroy(); } catch(e) {}
                            el.removeAttribute('data-initialized');
                        }
                    });
                }
                initSelectEnhancer(target);
                initOperatorReady(target);
            });
        }

        const temuanTindakLanjutAccordion = document.getElementById('accordionTemuanTindakLanjut');
        if (temuanTindakLanjutAccordion) {
            temuanTindakLanjutAccordion.addEventListener('shown.bs.collapse', function (ev) {
                const target = ev.target; // panel collapse yang baru terbuka
                // Jika sudah ter-init Select2 saat hidden, destroy dahulu agar layout & search di mobile benar
                if (window.jQuery && jQuery.fn && jQuery.fn.select2) {
                    jQuery('select[data-trigger]', target).each(function() {
                        const $el = jQuery(this);
                        if ($el.data('select2')) {
                            try { $el.select2('destroy'); } catch(e) {}
                            $el.removeAttr('data-initialized');
                        }
                    });
                }
                // Destroy Choices juga jika ada
                if (window.Choices) {
                    target.querySelectorAll('select[data-trigger]').forEach(el => {
                        if (el.dataset && el.dataset.choices === 'active') {
                            try { el.choices && el.choices.destroy(); } catch(e) {}
                            el.removeAttribute('data-initialized');
                        }
                    });
                }
                initSelectEnhancer(target);
                initOperatorReady(target);
            });
        }

        // Re-init saat panel accordion ditampilkan (menghindari init pada elemen tersembunyi di mobile)
        const jobPendingAccordion = document.getElementById('accordionJobPending');
        if (jobPendingAccordion) {
            jobPendingAccordion.addEventListener('shown.bs.collapse', function (ev) {
                const target = ev.target; // panel collapse yang baru terbuka
                // Jika sudah ter-init Select2 saat hidden, destroy dahulu agar layout & search di mobile benar
                if (window.jQuery && jQuery.fn && jQuery.fn.select2) {
                    jQuery('select[data-trigger]', target).each(function() {
                        const $el = jQuery(this);
                        if ($el.data('select2')) {
                            try { $el.select2('destroy'); } catch(e) {}
                            $el.removeAttr('data-initialized');
                        }
                    });
                }
                // Destroy Choices juga jika ada
                if (window.Choices) {
                    target.querySelectorAll('select[data-trigger]').forEach(el => {
                        if (el.dataset && el.dataset.choices === 'active') {
                            try { el.choices && el.choices.destroy(); } catch(e) {}
                            el.removeAttribute('data-initialized');
                        }
                    });
                }
                initSelectEnhancer(target);
                initOperatorReady(target);
            });
        }

    });
</script>

<script>
    $(document).ready(function() {
        // Mengecek tab yang aktif saat halaman dimuat
        checkTabActive();

        // Menambahkan event listener untuk saat tab berubah
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
            checkTabActive();
            // Re-init select enhancer pada tab yang aktif
            const activePane = document.querySelector('.tab-pane.active');
            if (activePane && typeof initSelectEnhancer === 'function') {
                initSelectEnhancer(activePane);
            }
        });

        function checkTabActive() {
            if ($('#finish').hasClass('active')) {
                $('#lanjutButton').hide();
                $('#save_as_draft_id').hide();
            } else if($('#contactDetail').hasClass('active')){
                $('#kembaliButton').hide();
                $('#lanjutButton').show();
                $('#save_as_draft_id').show();
            }else {
                $('#lanjutButton').show();
                $('#save_as_draft_id').show();
                $('#kembaliButton').show();
            }
        }
    });
</script>

<script>
    function compressImage(file, maxWidth = 800, quality = 0.7) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            const reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = (event) => {
                img.src = event.target.result;
            };

            img.onload = () => {
                const canvas = document.createElement('canvas');
                const scale = maxWidth / img.width;

                canvas.width = maxWidth;
                canvas.height = img.height * scale;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                canvas.toBlob(
                    (blob) => {
                        if (!blob) {
                            reject(new Error('Compression failed'));
                            return;
                        }

                        const compressedFile = new File([blob], file.name, {
                            type: 'image/jpeg',
                            lastModified: Date.now(),
                        });

                        resolve(compressedFile);
                    },
                    'image/jpeg',
                    quality
                );
            };

            img.onerror = (error) => reject(error);
        });
    }
</script>

<!-- untuk save as draft -->
<script>
    function generateUUID() {
        return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }

    function saveAsDraft(actionType) {
        if (!validateForm()) {
            return;
        }

        const formData = new FormData();

        const uuidElement = document.getElementById('uuid');
        const uuid = uuidElement ? uuidElement.value : null;

        formData.append('uuid', uuid);
        formData.append('actionType', actionType);

        formData.append('date', document.querySelector('#pc-datepicker-1').value);
        formData.append('shift_id', document.querySelector('#shiftID').value);

        const subKegiatanData = [];
        const subKegiatanAccordions = document.querySelectorAll('#accordionSubKegiatan .accordion-item');

        subKegiatanAccordions.forEach((accordion) => {
            const uuidKegiatan = accordion.querySelector('input[name*="[uuidSubKegiatan]"]')?.value || null;
            if (!uuidKegiatan) return;

            const existing_foto_kegiatan = accordion.querySelector('input[name*="[existing_foto_kegiatan]"]')?.value || null;
            const existing_foto_kegiatan_url = accordion.querySelector('input[name*="[existing_foto_kegiatan_url]"]')?.value || null;
            const sub = accordion.querySelector('input[name*="[sub]"]')?.value || null;
            const kategori = accordion.querySelector('input[name*="[kategori]"]')?.value || null;
            const frekuensi = accordion.querySelector('input[name*="[frekuensi]"]')?.value || null;
            const lokasi = accordion.querySelector('input[name*="[lokasi]"]')?.value || null;
            const status = accordion.querySelector('input[name*="[status]"]')?.value || null;
            const keterangan = accordion.querySelector('input[name*="[keterangan]"]')?.value || null;

            subKegiatanData.push({
                uuid: uuidKegiatan,
                existing_foto_kegiatan: existing_foto_kegiatan,
                existing_foto_kegiatan_url: existing_foto_kegiatan_url,
                sub: sub,
                kategori: kategori,
                frekuensi: frekuensi,
                lokasi: lokasi,
                status: status,
                keterangan: keterangan,
            });

            if (uploadedKegiatanFiles[uuidKegiatan]) {
                formData.append(`kegiatan_files[${uuidKegiatan}]`, uploadedKegiatanFiles[uuidKegiatan]);
            }
        });

        formData.append('subKegiatan', JSON.stringify(subKegiatanData));

        const temuanTindakLanjutData = [];
        const temuanTindakLanjutAccordions = document.querySelectorAll('#accordionTemuanTindakLanjut .accordion-item');

        temuanTindakLanjutAccordions.forEach((accordion) => {
            const uuidTemuan = accordion.querySelector('input[name*="[uuidTemuanTindakLanjut]"]')?.value || null;
            if (!uuidTemuan) return;

            const existing_foto_temuan = accordion.querySelector('input[name*="[existing_foto_temuan]"]')?.value || null;
            const existing_foto_temuan_url = accordion.querySelector('input[name*="[existing_foto_temuan_url]"]')?.value || null;
            const deskripsi_temuan = accordion.querySelector('input[name*="[deskripsi_temuan]"]')?.value || null;
            const tindak_lanjut = accordion.querySelector('input[name*="[tindak_lanjut]"]')?.value || null;
            const status = accordion.querySelector('input[name*="[status]"]')?.value || null;

            temuanTindakLanjutData.push({
                uuid: uuidTemuan,
                existing_foto_temuan: existing_foto_temuan,
                existing_foto_temuan_url: existing_foto_temuan_url,
                deskripsi_temuan: deskripsi_temuan,
                tindak_lanjut: tindak_lanjut,
                status: status,
            });

            if (uploadedTemuanFiles[uuidTemuan]) {
                formData.append(`temuan_files[${uuidTemuan}]`, uploadedTemuanFiles[uuidTemuan]);
            }
        });

        formData.append('temuanTindakLanjut', JSON.stringify(temuanTindakLanjutData));

        const jobPendingData = [];
        const jobPendingAccordions = document.querySelectorAll('#accordionJobPending .accordion-item');

        jobPendingAccordions.forEach((accordion) => {
            const uuid = accordion.querySelector('input[name*="uuidJobPending"]')?.value || null;
            if (!uuid) return;

            const existing_foto_pending = accordion.querySelector('input[name*="[existing_foto_pending]"]')?.value || null;
            const existing_foto_pending_url = accordion.querySelector('input[name*="[existing_foto_pending_url]"]')?.value || null;
            const kegiatan_pending = accordion.querySelector('input[name*="[kegiatan_pending]"]')?.value || null;
            const alasan_belum_selesai = accordion.querySelector('input[name*="[alasan_belum_selesai]"]')?.value || null;
            const prioritas = accordion.querySelector('input[name*="[prioritas]"]')?.value || null;
            const instruksi_shift_berikutnya = accordion.querySelector('input[name*="[instruksi_shift_berikutnya]"]')?.value || null;

            jobPendingData.push({
                uuid: uuid,
                kegiatan_pending: kegiatan_pending,
                alasan_belum_selesai: alasan_belum_selesai,
                prioritas: prioritas,
                instruksi_shift_berikutnya: instruksi_shift_berikutnya,
                existing_foto_pending: existing_foto_pending,
                existing_foto_pending_url: existing_foto_pending_url,
            });
            if (uploadedJobPendingFiles[uuid]) {
                formData.append(`job_pending_files[${uuid}]`, uploadedJobPendingFiles[uuid]);
            }
        });

        formData.append('jobPending', JSON.stringify(jobPendingData));

        fetch('/save-draft-patrol', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById('uuid').value = data.uuid;

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Saving Success',
                }).then(() => {
                    if (actionType === 'finish') {
                        window.location.href = "{{ route('patrol.show') }}";
                    } else {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: `Failed to save: ${data.error}`,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Error saving: ${error.message}`,
            });
        });
    }
</script>

{{-- Script Form Sub Kegiatan --}}
<script>
    let subKegiatanCount = 0;
    let uploadedKegiatanFiles = {};


    function renderFotoKegiatan(existingPath = '', existingUrl = '', fileName = '') {
        if (existingUrl) {
            return `
                <div class="d-flex flex-column gap-2">
                    <img src="${existingUrl}" alt="Dokumentasi"
                        style="max-width: 220px; max-height: 220px; object-fit: cover; border: 1px solid #ddd; border-radius: 8px; padding: 4px;">
                    <div>
                        <a href="${existingUrl}" target="_blank" class="btn btn-sm btn-primary">Lihat Foto</a>
                    </div>
                    <small class="text-muted">${escapeHtml(existingPath)}</small>
                </div>
            `;
        }

        if (fileName) {
            return `
                <div class="d-flex flex-column gap-2">
                    <small class="text-muted">${escapeHtml(fileName)}</small>
                </div>
            `;
        }

        if (existingPath) {
            return `<span>${escapeHtml(existingPath)}</span>`;
        }

        return `<span>-</span>`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const element = document.getElementById('sub');

        if (subSelect) {
            subSelect.destroy();
        }

        subSelect = new Choices(element, {
            shouldSort: false
        });

        if (element.value) {
            handleChangeShift(element.value);
        }

        const subKegiatan = @json($subKegiatan ?? []);
        const accordionSubKegiatan = document.getElementById('accordionSubKegiatan');

        if (accordionSubKegiatan && Array.isArray(subKegiatan)) {
            subKegiatan.forEach((itemSubKegiatan, index) => {
                const accordionIdSubKegiatan = `subKegiatan${index + 1}`;
                const collapseSubKegiatanId = `collapseSubKegiatan${index + 1}`;

                const fotoHtml = renderFotoKegiatan(
                    itemSubKegiatan.existing_foto_kegiatan || '',
                    itemSubKegiatan.existing_foto_kegiatan_url || '',
                    ''
                );

                const accordionItemSubKegiatan = `
                    <div class="accordion-item"
                         id="${accordionIdSubKegiatan}"
                         data-subkegiatan-id="${itemSubKegiatan.id || ''}">
                        <h2 class="accordion-header" id="heading${accordionIdSubKegiatan}">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#${collapseSubKegiatanId}"
                                aria-expanded="false"
                                aria-controls="${collapseSubKegiatanId}">
                                #${index + 1} ${escapeHtml(itemSubKegiatan.sub || '')}
                            </button>
                        </h2>
                        <div id="${collapseSubKegiatanId}" class="accordion-collapse collapse"
                            aria-labelledby="heading${accordionIdSubKegiatan}"
                            data-bs-parent="#accordionSubKegiatan">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>UUID</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][uuidSubKegiatan]" value="${escapeHtml(itemSubKegiatan.uuid || '')}">
                                                ${escapeHtml(itemSubKegiatan.uuid || '')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Kegiatan</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][sub]" value="${escapeHtml(itemSubKegiatan.sub || '')}">
                                                ${escapeHtml(itemSubKegiatan.sub || '')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Sub Kegiatan / Detail</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][kategori]" value="${escapeHtml(itemSubKegiatan.kategori || '')}">
                                                ${escapeHtml(itemSubKegiatan.kategori || '')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Pelaksanaan</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][frekuensi]" value="${escapeHtml(itemSubKegiatan.frekuensi || '')}">
                                                ${escapeHtml(itemSubKegiatan.frekuensi || '')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][lokasi]" value="${escapeHtml(itemSubKegiatan.lokasi || '')}">
                                                ${escapeHtml(itemSubKegiatan.lokasi || '')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][status]" value="${escapeHtml(itemSubKegiatan.status || '')}">
                                                ${escapeHtml(itemSubKegiatan.status || '')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][keterangan]" value="${escapeHtml(itemSubKegiatan.keterangan || '')}">
                                                ${escapeHtml(itemSubKegiatan.keterangan || '')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumentasi</th>
                                            <td>
                                                <input type="hidden" name="subKegiatan[${index}][existing_foto_kegiatan]" value="${escapeHtml(itemSubKegiatan.existing_foto_kegiatan || '')}">
                                                <input type="hidden" name="subKegiatan[${index}][existing_foto_kegiatan_url]" value="${escapeHtml(itemSubKegiatan.existing_foto_kegiatan_url || '')}">
                                                <div class="foto-preview-wrapper">${fotoHtml}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="hapusSubKegiatan('${accordionIdSubKegiatan}')">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                `;

                accordionSubKegiatan.insertAdjacentHTML('beforeend', accordionItemSubKegiatan);
                subKegiatanCount = index + 1;
            });
        }
    });

    function handleChangeShift(selectedValue) {
        const kategori = document.getElementById('kategori');
        const frekuensi = document.getElementById('frekuensi');
        const lokasi = document.getElementById('lokasi');

        if (subKegiatanData[selectedValue]) {
            kategori.value = subKegiatanData[selectedValue].kategori || '';
            frekuensi.value = subKegiatanData[selectedValue].frekuensi || '';
            lokasi.value = subKegiatanData[selectedValue].lokasi || '';
        } else {
            kategori.value = '';
            frekuensi.value = '';
            lokasi.value = '';
        }

        if (selectedValue === 'Lain-Lain') {
            kategori.readOnly = true;
            frekuensi.readOnly = false;
            lokasi.readOnly = false;

            kategori.value = 'Evaluasi';
            frekuensi.value = '';
            lokasi.value = '';
        } else {
            kategori.readOnly = true;
            frekuensi.readOnly = true;
            lokasi.readOnly = true;
        }
    }

    document.getElementById('saveSubKegiatan').addEventListener('click', async function () {
        const sub = document.getElementById('sub').value;
        const kategori = document.getElementById('kategori').value;
        const frekuensi = document.getElementById('frekuensi').value;
        const lokasi = document.getElementById('lokasi').value;
        const keterangan = document.getElementById('keterangan').value;
        const fotoInput = document.getElementById('foto');
        const status = document.querySelector('input[name="status[]"]:checked')?.value || '';

        let foto = fotoInput?.files?.[0] || null;

        if (!sub) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Sub kegiatan harus dipilih!'
            });
            return;
        }

        if (!kategori) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Kategori harus diisi!'
            });
            return;
        }

        if (!frekuensi) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Frekuensi harus diisi!'
            });
            return;
        }

        if (!lokasi) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Lokasi harus diisi!'
            });
            return;
        }

        if (!status) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Status harus dipilih!'
            });
            return;
        }

        if (foto) {
            foto = await compressImage(foto, 800, 0.7);
        }

        subKegiatanCount++;

        const uuidBaru = generateUUID();
        const accordionIdSubKegiatan = `subKegiatan${subKegiatanCount}`;
        const collapseSubKegiatanId = `collapseSubKegiatan${subKegiatanCount}`;
        const currentIndex = subKegiatanCount - 1;

        if (foto) {
            uploadedKegiatanFiles[uuidBaru] = foto;
        }

        const previewUrl = foto ? URL.createObjectURL(foto) : '';
        const namaFile = foto ? foto.name : '';

        const fotoHtml = foto
            ? `
                <div class="d-flex flex-column gap-2">
                    <img src="${previewUrl}" alt="Preview Dokumentasi"
                        style="max-width: 220px; max-height: 220px; object-fit: cover; border: 1px solid #ddd; border-radius: 8px; padding: 4px;">
                    <div>
                        <a href="${previewUrl}" target="_blank" class="btn btn-sm btn-primary">Lihat Foto</a>
                    </div>
                    <small class="text-muted">${escapeHtml(namaFile)}</small>
                </div>
            `
            : `<span>-</span>`;

        const newAccordionItemSubKegiatan = `
            <div class="accordion-item" id="${accordionIdSubKegiatan}" data-subkegiatan-id="">
                <h2 class="accordion-header" id="heading${accordionIdSubKegiatan}">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#${collapseSubKegiatanId}"
                        aria-expanded="false"
                        aria-controls="${collapseSubKegiatanId}">
                        Sub Kegiatan #${subKegiatanCount}
                    </button>
                </h2>
                <div id="${collapseSubKegiatanId}" class="accordion-collapse collapse"
                    aria-labelledby="heading${accordionIdSubKegiatan}"
                    data-bs-parent="#accordionSubKegiatan">
                    <div class="accordion-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>UUID</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][uuidSubKegiatan]" value="${uuidBaru}">
                                        ${uuidBaru}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kegiatan</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][sub]" value="${escapeHtml(sub)}">
                                        ${escapeHtml(sub)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sub Kegiatan / Detail</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][kategori]" value="${escapeHtml(kategori)}">
                                        ${escapeHtml(kategori)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Waktu Pelaksanaan</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][frekuensi]" value="${escapeHtml(frekuensi)}">
                                        ${escapeHtml(frekuensi)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][lokasi]" value="${escapeHtml(lokasi)}">
                                        ${escapeHtml(lokasi)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][status]" value="${escapeHtml(status)}">
                                        ${escapeHtml(status)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][keterangan]" value="${escapeHtml(keterangan)}">
                                        ${escapeHtml(keterangan) || '-'}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dokumentasi</th>
                                    <td>
                                        <input type="hidden" name="subKegiatan[${currentIndex}][existing_foto_kegiatan]" value="">
                                        <input type="hidden" name="subKegiatan[${currentIndex}][existing_foto_kegiatan_url]" value="">
                                        <div class="foto-preview-wrapper">${fotoHtml}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="hapusSubKegiatan('${accordionIdSubKegiatan}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('accordionSubKegiatan').insertAdjacentHTML('beforeend', newAccordionItemSubKegiatan);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil ditambahkan, mohon klik Simpan Draft',
            showConfirmButton: true
        }).then(() => {
            const modalElement = document.getElementById('tambahSubKegiatan');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    });

    document.getElementById('tambahSubKegiatan').addEventListener('hidden.bs.modal', function () {
        document.getElementById('formSubKegiatan').reset();

        const kategori = document.getElementById('kategori');
        const frekuensi = document.getElementById('frekuensi');
        const lokasi = document.getElementById('lokasi');

        kategori.readOnly = true;
        frekuensi.readOnly = true;
        lokasi.readOnly = true;

        if (document.querySelectorAll('input[name="status[]"]').length) {
            document.querySelectorAll('input[name="status[]"]').forEach(el => el.checked = false);
        }

        if (subSelect) {
            subSelect.removeActiveItems();
            subSelect.setChoiceByValue('');
        }
    });

    function hapusSubKegiatan(accordionIdSubKegiatan) {
        const item = document.getElementById(accordionIdSubKegiatan);
        const subKegiatanId = item ? item.getAttribute('data-subkegiatan-id') : null;

        const uuidInput = item ? item.querySelector('input[name*="[uuidSubKegiatan]"]') : null;
        const uuidValue = uuidInput ? uuidInput.value : null;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                if (subKegiatanId) {
                    fetch(`/delete-patrol-subKegiatan/${subKegiatanId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })
                    .then((response) => {
                        if (response.ok) {
                            if (item) item.remove();
                            if (uuidValue && uploadedKegiatanFiles[uuidValue]) {
                                delete uploadedKegiatanFiles[uuidValue];
                            }

                            Swal.fire('Dihapus!', 'Data berhasil dihapus.', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                    });
                } else {
                    if (item) item.remove();
                    if (uuidValue && uploadedKegiatanFiles[uuidValue]) {
                        delete uploadedKegiatanFiles[uuidValue];
                    }

                    Swal.fire('Dihapus!', 'Data berhasil dihapus.', 'success');
                }
            }
        });
    }
</script>

{{-- Script Form Temuan dan Tindak Lanjut --}}
<script>
    let temuanTindakLanjutCount = 0;
    let uploadedTemuanFiles = {};



    function renderFotoTemuan(existingPath = '', existingUrl = '', fileName = '') {
        if (existingUrl) {
            return `
                <div class="d-flex flex-column gap-2">
                    <img src="${existingUrl}" alt="Foto Temuan"
                        style="max-width: 220px; max-height: 220px; object-fit: cover; border: 1px solid #ddd; border-radius: 8px; padding: 4px;">
                    <div>
                        <a href="${existingUrl}" target="_blank" class="btn btn-sm btn-primary">Lihat Foto</a>
                    </div>
                    <small class="text-muted">${escapeHtml(existingPath)}</small>
                </div>
            `;
        }

        if (fileName) {
            return `<span>${escapeHtml(fileName)}</span>`;
        }

        if (existingPath) {
            return `<span>${escapeHtml(existingPath)}</span>`;
        }

        return `<span>-</span>`;
    }

    document.addEventListener("DOMContentLoaded", function () {
        const temuanTindakLanjut = @json($temuanTindakLanjut);
        const accordionTemuanTindakLanjut = document.getElementById('accordionTemuanTindakLanjut');

        temuanTindakLanjut.forEach((itemTemuanTindakLanjut, index) => {
            const accordionIdTemuanTindakLanjut = `temuanTindakLanjut${index + 1}`;
            const collapseTemuanTindakLanjutId = `TemuanTindakLanjut${index + 1}`;

            const fotoHtml = renderFotoTemuan(
                itemTemuanTindakLanjut.foto_temuan || '',
                itemTemuanTindakLanjut.foto_temuan_url || '',
                ''
            );

            const accordionItemTemuanTindakLanjut = `
                <div class="accordion-item"
                     id="${accordionIdTemuanTindakLanjut}"
                     data-temuantindaklanjut-id="${itemTemuanTindakLanjut.id || ''}">
                    <h2 class="accordion-header" id="heading${accordionIdTemuanTindakLanjut}">
                        <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#${collapseTemuanTindakLanjutId}"
                            aria-expanded="false"
                            aria-controls="${collapseTemuanTindakLanjutId}">
                            Temuan dan Tindak Lanjut #${index + 1}
                        </button>
                    </h2>
                    <div id="${collapseTemuanTindakLanjutId}" class="accordion-collapse collapse"
                        aria-labelledby="heading${accordionIdTemuanTindakLanjut}"
                        data-bs-parent="#accordionTemuanTindakLanjut">
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>UUID</th>
                                        <td>
                                            <input type="hidden" name="temuanTindakLanjut[${index}][uuidTemuanTindakLanjut]" value="${escapeHtml(itemTemuanTindakLanjut.uuid || '')}">
                                            ${escapeHtml(itemTemuanTindakLanjut.uuid || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Foto Temuan</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="temuanTindakLanjut[${index}][existing_foto_temuan]" value="${escapeHtml(itemTemuanTindakLanjut.foto_temuan || '')}">
                                            <input type="hidden" name="temuanTindakLanjut[${index}][existing_foto_temuan_url]" value="${escapeHtml(itemTemuanTindakLanjut.foto_temuan_url || '')}">
                                            <div class="foto-preview-wrapper">${fotoHtml}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi Temuan</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="temuanTindakLanjut[${index}][deskripsi_temuan]" value="${escapeHtml(itemTemuanTindakLanjut.deskripsi_temuan || '')}">
                                            ${escapeHtml(itemTemuanTindakLanjut.deskripsi_temuan || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tindak Lanjut</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="temuanTindakLanjut[${index}][tindak_lanjut]" value="${escapeHtml(itemTemuanTindakLanjut.tindak_lanjut || '')}">
                                            ${escapeHtml(itemTemuanTindakLanjut.tindak_lanjut || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="temuanTindakLanjut[${index}][status]" value="${escapeHtml(itemTemuanTindakLanjut.status || '')}">
                                            ${escapeHtml(itemTemuanTindakLanjut.status || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="hapusTemuanTindakLanjut('${accordionIdTemuanTindakLanjut}')">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;

            accordionTemuanTindakLanjut.insertAdjacentHTML('beforeend', accordionItemTemuanTindakLanjut);
            temuanTindakLanjutCount = index + 1;
        });
    });

    document.getElementById('saveTemuanTindakLanjut').addEventListener('click', async () => {
        const fileInputFotoTemuan = document.getElementById('foto_temuan');
        let foto_temuan = fileInputFotoTemuan.files[0];
        if (foto_temuan) {
            foto_temuan = await compressImage(foto_temuan, 800, 0.7);
        }else{
            foto_temuan = null;
        }
        const deskripsi_temuan = document.getElementById('deskripsi_temuan').value;
        const tindak_lanjut = document.getElementById('tindak_lanjut').value;
        const status = document.getElementById('status').value;

        if (!deskripsi_temuan) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Kolom deskripsi temuan harus diisi!'
            });
            return;
        }

        temuanTindakLanjutCount++;

        const uuidBaru = generateUUID();
        const accordionIdTemuanTindakLanjut = `temuanTindakLanjut${temuanTindakLanjutCount}`;
        const collapseTemuanTindakLanjutId = `collapseTemuanTindakLanjut${temuanTindakLanjutCount}`;
        const currentIndex = temuanTindakLanjutCount - 1;

        if (foto_temuan) {
            uploadedTemuanFiles[uuidBaru] = foto_temuan;
        }

        const previewUrl = foto_temuan ? URL.createObjectURL(foto_temuan) : '';
        const namaFile = foto_temuan ? foto_temuan.name : '';

        const fotoHtml = foto_temuan
            ? `
                <div class="d-flex flex-column gap-2">
                    <img src="${previewUrl}" alt="Preview Foto Temuan"
                        style="max-width: 220px; max-height: 220px; object-fit: cover; border: 1px solid #ddd; border-radius: 8px; padding: 4px;">
                    <div>
                        <a href="${previewUrl}" target="_blank" class="btn btn-sm btn-primary">Lihat Foto</a>
                    </div>
                    <small class="text-muted">${escapeHtml(namaFile)}</small>
                </div>
            `
            : `<span>-</span>`;

        const newAccordionItemTemuanTindakLanjut = `
            <div class="accordion-item" id="${accordionIdTemuanTindakLanjut}" data-temuantindaklanjut-id="">
                <h2 class="accordion-header" id="heading${accordionIdTemuanTindakLanjut}">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#${collapseTemuanTindakLanjutId}"
                        aria-expanded="false"
                        aria-controls="${collapseTemuanTindakLanjutId}">
                        Temuan dan Tindak Lanjut #${temuanTindakLanjutCount}
                    </button>
                </h2>
                <div id="${collapseTemuanTindakLanjutId}" class="accordion-collapse collapse"
                    aria-labelledby="heading${accordionIdTemuanTindakLanjut}"
                    data-bs-parent="#accordionTemuanTindakLanjut">
                    <div class="accordion-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>UUID</th>
                                    <td>
                                        <input type="hidden" name="temuanTindakLanjut[${currentIndex}][uuidTemuanTindakLanjut]" value="${uuidBaru}">
                                        ${uuidBaru}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto Temuan</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="temuanTindakLanjut[${currentIndex}][existing_foto_temuan]" value="">
                                        <input type="hidden" name="temuanTindakLanjut[${currentIndex}][existing_foto_temuan_url]" value="">
                                        <div class="foto-preview-wrapper">${fotoHtml}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deskripsi Temuan</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="temuanTindakLanjut[${currentIndex}][deskripsi_temuan]" value="${escapeHtml(deskripsi_temuan)}">
                                        ${escapeHtml(deskripsi_temuan)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tindak Lanjut</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="temuanTindakLanjut[${currentIndex}][tindak_lanjut]" value="${escapeHtml(tindak_lanjut)}">
                                        ${escapeHtml(tindak_lanjut)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="temuanTindakLanjut[${currentIndex}][status]" value="${escapeHtml(status)}">
                                        ${escapeHtml(status)}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="hapusTemuanTindakLanjut('${accordionIdTemuanTindakLanjut}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('accordionTemuanTindakLanjut').insertAdjacentHTML('beforeend', newAccordionItemTemuanTindakLanjut);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil ditambahkan, mohon klik Simpan Draft',
            showConfirmButton: true
        }).then(() => {
            const modalElement = document.getElementById('tambahTemuanTindakLanjut');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    });

    document.getElementById('tambahTemuanTindakLanjut').addEventListener('hidden.bs.modal', () => {
        document.getElementById('formTemuanTindakLanjut').reset();
    });

    function hapusTemuanTindakLanjut(accordionIdTemuanTindakLanjut) {
        const item = document.getElementById(accordionIdTemuanTindakLanjut);
        const temuanTindakLanjutId = item ? item.getAttribute('data-temuantindaklanjut-id') : null;

        const uuidInput = item ? item.querySelector('input[name*="[uuidTemuanTindakLanjut]"]') : null;
        const uuidValue = uuidInput ? uuidInput.value : null;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                if (temuanTindakLanjutId) {
                    fetch(`/delete-patrol-temuanTindakLanjut/${temuanTindakLanjutId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })
                    .then((response) => {
                        if (response.ok) {
                            if (item) item.remove();
                            if (uuidValue && uploadedTemuanFiles[uuidValue]) {
                                delete uploadedTemuanFiles[uuidValue];
                            }

                            Swal.fire(
                                'Dihapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    });
                } else {
                    if (item) item.remove();
                    if (uuidValue && uploadedTemuanFiles[uuidValue]) {
                        delete uploadedTemuanFiles[uuidValue];
                    }

                    Swal.fire(
                        'Dihapus!',
                        'Data berhasil dihapus.',
                        'success'
                    );
                }
            }
        });
    }
</script>


{{-- Script Form Job Pending --}}
<script>
    let jobPendingCount = 0;
    let uploadedJobPendingFiles = {};

    function renderFotoJobPending(existingPath = '', existingUrl = '', fileName = '') {
        if (existingUrl) {
            return `
                <div class="d-flex flex-column gap-2">
                    <img src="${existingUrl}" alt="Foto Job Pending"
                        style="max-width: 220px; max-height: 220px; object-fit: cover; border: 1px solid #ddd; border-radius: 8px; padding: 4px;">
                    <div>
                        <a href="${existingUrl}" target="_blank" class="btn btn-sm btn-primary">Lihat Foto</a>
                    </div>
                    <small class="text-muted">${escapeHtml(existingPath)}</small>
                </div>
            `;
        }

        if (fileName) {
            return `
                <div class="d-flex flex-column gap-2">
                    <small class="text-muted">${escapeHtml(fileName)}</small>
                </div>
            `;
        }

        if (existingPath) {
            return `<span>${escapeHtml(existingPath)}</span>`;
        }

        return `<span>-</span>`;
    }

    document.addEventListener("DOMContentLoaded", function () {
        const jobPending = @json($jobPending ?? []);
        const accordionJobPending = document.getElementById('accordionJobPending');

        jobPending.forEach((jobPending, index) => {
            const accordionId = `jobPending${index + 1}`;
            const collapseJobPendingId = `collapseJobPending${index + 1}`;

            const fotoHtml = renderFotoJobPending(
                jobPending.existing_foto_pending || '',
                jobPending.existing_foto_pending_url || '',
                ''
            );

            const accordionItem = `
                <div class="accordion-item" id="${accordionId}" data-jobPending-id="${jobPending.id || ''}">
                    <h2 class="accordion-header" id="heading${accordionId}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseJobPendingId}" aria-expanded="false" aria-controls="${collapseJobPendingId}">
                            Job Pending #${index + 1}
                        </button>
                    </h2>
                    <div id="${collapseJobPendingId}" class="accordion-collapse collapse" aria-labelledby="heading${accordionId}" data-bs-parent="#accordionJobPending">
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>UUID</th>
                                        <td>
                                            <input type="hidden" name="jobPending[${index}][uuidJobPending]" value="${escapeHtml(jobPending.uuid || '')}">
                                            ${escapeHtml(jobPending.uuid || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan/Kegiatan Pending</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="jobPending[${index}][kegiatan_pending]" value="${escapeHtml(jobPending.kegiatan_pending || '')}">
                                            ${escapeHtml(jobPending.kegiatan_pending || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alasan Belum Selesai</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="jobPending[${index}][alasan_belum_selesai]" value="${escapeHtml(jobPending.alasan_belum_selesai || '')}">
                                            ${escapeHtml(jobPending.alasan_belum_selesai || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Prioritas</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="jobPending[${index}][prioritas]" value="${escapeHtml(jobPending.prioritas || '')}">
                                            ${escapeHtml(jobPending.prioritas || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Instruksi Shift Berikutnya</th>
                                        <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                            <input type="hidden" name="jobPending[${index}][instruksi_shift_berikutnya]" value="${escapeHtml(jobPending.instruksi_shift_berikutnya || '')}">
                                            ${escapeHtml(jobPending.instruksi_shift_berikutnya || '')}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Foto Pending</th>
                                        <td>
                                            <input type="hidden" name="jobPending[${index}][existing_foto_pending]" value="${escapeHtml(jobPending.existing_foto_pending || '')}">
                                            <input type="hidden" name="jobPending[${index}][existing_foto_pending_url]" value="${escapeHtml(jobPending.existing_foto_pending_url || '')}">
                                            <div class="foto-preview-wrapper">${fotoHtml}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="hapusJobPending('${accordionId}')">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;

            accordionJobPending.insertAdjacentHTML('beforeend', accordionItem);
            jobPendingCount = index + 1;
        });
    });

    document.getElementById('saveJobPending').addEventListener('click', async () => {
        const kegiatan_pending = document.getElementById('kegiatan_pending').value;
        const alasan_belum_selesai = document.getElementById('alasan_belum_selesai').value;
        const prioritas = document.getElementById('prioritas').value;
        const instruksi_shift_berikutnya = document.getElementById('instruksi_shift_berikutnya').value;
        const fotoInput = document.getElementById('foto_pending');

        let foto_pending = fotoInput?.files?.[0] || null;

        if (!kegiatan_pending) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Kolom deskripsi harus diisi!'
            });
            return;
        }

        if (foto_pending) {
            foto_pending = await compressImage(foto_pending, 800, 0.7);
        }

        jobPendingCount++;

        const uuidBaru = generateUUID();
        const accordionId = `jobPending${jobPendingCount}`;
        const collapseJobPendingId = `collapseJobPending${jobPendingCount}`;
        const currentIndex = jobPendingCount - 1;

        if (foto_pending) {
            uploadedJobPendingFiles[uuidBaru] = foto_pending;
        }

        const previewUrl = foto_pending ? URL.createObjectURL(foto_pending) : '';
        const namaFile = foto_pending ? foto_pending.name : '';

        const fotoHtml = foto_pending
            ? `
                <div class="d-flex flex-column gap-2">
                    <img src="${previewUrl}" alt="Preview Foto Pending"
                        style="max-width: 220px; max-height: 220px; object-fit: cover; border: 1px solid #ddd; border-radius: 8px; padding: 4px;">
                    <div>
                        <a href="${previewUrl}" target="_blank" class="btn btn-sm btn-primary">Lihat Foto</a>
                    </div>
                    <small class="text-muted">${escapeHtml(namaFile)}</small>
                </div>
            `
            : `<span>-</span>`;

        const newAccordionItem = `
            <div class="accordion-item" id="${accordionId}" data-jobPending-id="">
                <h2 class="accordion-header" id="heading${accordionId}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseJobPendingId}" aria-expanded="false" aria-controls="${collapseJobPendingId}">
                        Job Pending #${jobPendingCount}
                    </button>
                </h2>
                <div id="${collapseJobPendingId}" class="accordion-collapse collapse" aria-labelledby="heading${accordionId}" data-bs-parent="#accordionJobPending">
                    <div class="accordion-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>UUID</th>
                                    <td>
                                        <input type="hidden" name="jobPending[${currentIndex}][uuidJobPending]" value="${uuidBaru}">
                                        ${uuidBaru}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan/Kegiatan Pending</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="jobPending[${currentIndex}][kegiatan_pending]" value="${escapeHtml(kegiatan_pending)}">
                                        ${escapeHtml(kegiatan_pending)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Alasan Belum Selesai</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="jobPending[${currentIndex}][alasan_belum_selesai]" value="${escapeHtml(alasan_belum_selesai)}">
                                        ${escapeHtml(alasan_belum_selesai)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Prioritas</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="jobPending[${currentIndex}][prioritas]" value="${escapeHtml(prioritas)}">
                                        ${escapeHtml(prioritas)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Instruksi Shift Berikutnya</th>
                                    <td style="word-wrap: break-word; white-space: normal; max-width: 100%; overflow-wrap: break-word;">
                                        <input type="hidden" name="jobPending[${currentIndex}][instruksi_shift_berikutnya]" value="${escapeHtml(instruksi_shift_berikutnya)}">
                                        ${escapeHtml(instruksi_shift_berikutnya)}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto Pending</th>
                                    <td>
                                        <input type="hidden" name="jobPending[${currentIndex}][existing_foto_pending]" value="">
                                        <input type="hidden" name="jobPending[${currentIndex}][existing_foto_pending_url]" value="">
                                        <div class="foto-preview-wrapper">${fotoHtml}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusJobPending('${accordionId}')">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('accordionJobPending').insertAdjacentHTML('beforeend', newAccordionItem);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil ditambahkan, mohon klik Simpan Draft',
            showConfirmButton: true
        }).then(() => {
            const modalElement = document.getElementById('tambahJobPending');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    });

    document.getElementById('tambahJobPending').addEventListener('hidden.bs.modal', () => {
        document.getElementById('formJobPending').reset();
    });

    function hapusJobPending(accordionId) {
        const item = document.getElementById(accordionId);
        const jobPendingId = item ? item.getAttribute('data-jobPending-id') : null;

        const uuidInput = item ? item.querySelector('input[name*="[uuidJobPending]"]') : null;
        const uuidValue = uuidInput ? uuidInput.value : null;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                if (jobPendingId) {
                    fetch(`/delete-patrol-jobPending/${jobPendingId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })
                    .then((response) => {
                        if (response.ok) {
                            if (item) item.remove();
                            if (uuidValue && uploadedJobPendingFiles[uuidValue]) {
                                delete uploadedJobPendingFiles[uuidValue];
                            }

                            Swal.fire(
                                'Dihapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    });
                } else {
                    if (item) item.remove();
                    if (uuidValue && uploadedJobPendingFiles[uuidValue]) {
                        delete uploadedJobPendingFiles[uuidValue];
                    }

                    Swal.fire(
                        'Dihapus!',
                        'Data berhasil dihapus.',
                        'success'
                    );
                }
            }
        });
    }
</script>

{{-- Script Finishing --}}
<script>
    function validateForm() {
       const date = document.getElementById("pc-datepicker-1");
        const select1 = document.getElementById("shiftID");


        if (!date.value || !select1.value ) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: "Kolom Tanggal dan Shift harus diisi",
                confirmButtonText: 'OK'
            });
            return false;
        }

        return true;
    }

</script>

<script>
    document.querySelectorAll('input[type="datetime-local"]').forEach(input => {
    input.addEventListener('change', function() {
        console.log('Datetime selected:', this.value);
        // picker browser sudah otomatis tertutup
    });
});
</script>
