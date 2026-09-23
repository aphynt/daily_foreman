@include('layout.head', ['title' => 'Dashboard'])
@include('layout.sidebar')
@include('layout.header')
<style>
    :root {
        --dash-primary: #2563eb;
        --dash-primary-hover: #1d4ed8;
        --dash-primary-soft: #eff6ff;
        --dash-bg: #ffffff;
        --dash-bg-soft: #f8fafc;
        --dash-card: #ffffff;
        --dash-card-soft: #fbfcfe;
        --dash-text: #24324a;
        --dash-heading: #1f2f46;
        --dash-muted: #8b98aa;
        --dash-muted-2: #98a2b3;
        --dash-border: #e6ebf2;
        --dash-border-hover: #cbdaf0;
        --dash-input: #ffffff;
        --dash-shadow: 0 8px 28px rgba(15,39,68,.07);
        --dash-shadow-hover: 0 14px 30px rgba(15,39,68,.12);
        --dash-blue-icon-bg: #eef6ff;
        --dash-green-icon-bg: #eefbf6;
        --dash-orange-icon-bg: #fff7ed;
        --dash-purple-icon-bg: #f7f2ff;
        --dash-cyan-icon-bg: #eefbfc;
    }

    body[data-pc-theme="dark"] {
        --dash-primary: #60a5fa;
        --dash-primary-hover: #93c5fd;
        --dash-primary-soft: #172554;
        --dash-bg: #0f172a;
        --dash-bg-soft: #111827;
        --dash-card: #111827;
        --dash-card-soft: #131c2c;
        --dash-text: #d8e0eb;
        --dash-heading: #eef2f7;
        --dash-muted: #94a3b8;
        --dash-muted-2: #7f8da3;
        --dash-border: #273449;
        --dash-border-hover: #3b506d;
        --dash-input: #111827;
        --dash-shadow: 0 8px 28px rgba(0,0,0,.22);
        --dash-shadow-hover: 0 14px 32px rgba(0,0,0,.34);
        --dash-blue-icon-bg: #172554;
        --dash-green-icon-bg: #0e2d27;
        --dash-orange-icon-bg: #332312;
        --dash-purple-icon-bg: #271b3d;
        --dash-cyan-icon-bg: #123039;
    }

    .page-header {
        padding-bottom: 0 !important;
    }

    .dashboard-greeting {
        position: relative;
        overflow: hidden;
        min-height: 76px;
        margin: 0;
        padding: 17px 20px;
        display: flex;
        align-items: center;
        border: 1px solid #dbe7f7;
        border-radius: 16px;
        color: #16345b;
        background:
            radial-gradient(circle at 95% 20%, rgba(59,130,246,.13) 0, rgba(59,130,246,0) 28%),
            linear-gradient(135deg,#f8fbff 0%,#ffffff 58%,#f3f8ff 100%);
        box-shadow: 0 5px 18px rgba(37,99,235,.055);
        font-size: 17px;
        font-weight: 700;
        letter-spacing: -.15px;
    }

    body[data-pc-theme="dark"] .dashboard-greeting {
        color: #dbeafe;
        border-color: #273449;
        background:
            radial-gradient(circle at 95% 20%, rgba(59,130,246,.13) 0, rgba(59,130,246,0) 28%),
            linear-gradient(135deg,#111827 0%,#101827 58%,#0f172a 100%);
        box-shadow: 0 6px 20px rgba(0,0,0,.20);
    }

    .dashboard-greeting::before {
        content: '';
        width: 4px;
        align-self: stretch;
        margin-right: 12px;
        border-radius: 999px;
        background: linear-gradient(180deg,#2563eb,#60a5fa);
    }

    .dashboard-greeting .wave {
        width: 34px;
        height: 34px;
        margin-left: 10px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #fff7e6;
        box-shadow: inset 0 0 0 1px #ffe5ad;
        font-size: 19px;
    }

    body[data-pc-theme="dark"] .dashboard-greeting .wave {
        background: #332610;
        box-shadow: inset 0 0 0 1px #5b441d;
    }

    .feature-menu {
        margin-bottom: 23px;
        --bs-gutter-x: .65rem;
        --bs-gutter-y: .65rem;
    }

    .feature-section-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 15px;
        margin: 3px 0 2px;
        padding: 0 2px;
    }

    .feature-section-heading h5 {
        margin: 0 0 3px;
        color: var(--dash-heading);
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -.2px;
    }

    .feature-section-heading p {
        margin: 0;
        color: var(--dash-muted);
        font-size: 14px;
        line-height: 1.45;
    }

    .feature-section-badge {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 10px;
        border: 1px solid var(--dash-border);
        border-radius: 9px;
        color: var(--dash-muted);
        background: var(--dash-card);
        font-size: 12px;
        font-weight: 600;
    }

    .satu-sims-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.08) !important;
        border-radius: 16px !important;
        background:
            radial-gradient(circle at 88% 12%,rgba(96,165,250,.27),transparent 25%),
            linear-gradient(120deg,#071d35 0%,#0d3763 52%,#145da0 100%);
        box-shadow: 0 10px 26px rgba(5,31,58,.17) !important;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    body[data-pc-theme="dark"] .satu-sims-card {
        background:
            radial-gradient(circle at 88% 12%,rgba(96,165,250,.20),transparent 25%),
            linear-gradient(120deg,#07111f 0%,#0a2949 52%,#103f6e 100%);
        box-shadow: 0 12px 28px rgba(0,0,0,.32) !important;
    }

    .satu-sims-card::before,
    .satu-sims-card::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .satu-sims-card::before {
        width: 170px;
        height: 170px;
        top: -105px;
        right: -32px;
        background: rgba(255,255,255,.065);
    }

    .satu-sims-card::after {
        width: 105px;
        height: 105px;
        right: 90px;
        bottom: -80px;
        background: rgba(255,255,255,.04);
    }

    .satu-sims-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 32px rgba(5,31,58,.23) !important;
    }

    .satu-sims-card .card-body {
        position: relative;
        z-index: 2;
        min-height: 74px;
        padding: 14px 17px !important;
    }

    .satu-sims-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.14);
        border-radius: 12px;
        color: #fff;
        background: rgba(255,255,255,.10);
        backdrop-filter: blur(7px);
    }

    .satu-sims-icon i {
        font-size: 19px !important;
    }

    .satu-sims-card h6 {
        margin-bottom: 2px !important;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: -.1px;
    }

    .satu-sims-card small {
        font-size: 13px;
        letter-spacing: .1px;
    }

    .satu-sims-card > .card-body > .ti-external-link {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: rgba(255,255,255,.09);
        transition: transform .2s ease, background .2s ease;
    }

    .satu-sims-card:hover > .card-body > .ti-external-link {
        transform: translate(2px,-2px);
        background: rgba(255,255,255,.16);
    }

    .feature-menu > [class*="col-"] > a.text-decoration-none {
        display: block;
        height: 100%;
    }

    .feature-card {
        position: relative;
        overflow: hidden;
        min-height: 110px;
        margin-bottom: 0 !important;
        border: 1px solid var(--dash-border) !important;
        border-radius: 13px !important;
        background: linear-gradient(145deg,var(--dash-card) 0%,var(--dash-card-soft) 100%);
        box-shadow: 0 2px 8px rgba(15,39,68,.035);
        transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease, background .18s ease;
    }

    body[data-pc-theme="dark"] .feature-card {
        box-shadow: 0 3px 10px rgba(0,0,0,.18);
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 16px;
        right: 16px;
        height: 2px;
        border-radius: 0 0 999px 999px;
        opacity: 0;
        background: linear-gradient(90deg,#2563eb,#60a5fa);
        transition: opacity .18s ease;
    }

    .feature-card:hover {
        transform: translateY(-3px);
        border-color: var(--dash-border-hover) !important;
        box-shadow: var(--dash-shadow-hover);
    }

    .feature-card:hover::before {
        opacity: 1;
    }

    .feature-card .card-body {
        min-height: 110px;
        padding: 12px 8px 10px !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .feature-card img.card-img-top {
        width: 26px !important;
        height: 26px !important;
        max-width: 26px !important;
        object-fit: contain;
        box-sizing: content-box;
        margin-bottom: 8px;
        padding: 8px;
        border: 1px solid #dce9fb;
        border-radius: 11px;
        background: var(--dash-blue-icon-bg);
        box-shadow: 0 3px 9px rgba(37,99,235,.055);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    body[data-pc-theme="dark"] .feature-card img.card-img-top {
        border-color: #30415b;
        box-shadow: none;
    }

    .feature-card:hover img.card-img-top {
        transform: translateY(-1px) scale(1.04);
        box-shadow: 0 6px 13px rgba(37,99,235,.09);
    }

    .feature-card .card-title {
        min-height: 32px;
        margin: 0 !important;
        padding: 0 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dash-text);
        font-size: 13px !important;
        font-weight: 650;
        line-height: 1.3;
        letter-spacing: -.05px;
        text-align: center;
        transition: color .18s ease;
    }

    .feature-card:hover .card-title {
        color: var(--dash-primary);
    }

    .feature-menu > [class*="col-"]:nth-of-type(5n+1) .feature-card img.card-img-top {
        background: var(--dash-blue-icon-bg);
    }

    .feature-menu > [class*="col-"]:nth-of-type(5n+2) .feature-card img.card-img-top {
        background: var(--dash-green-icon-bg);
    }

    .feature-menu > [class*="col-"]:nth-of-type(5n+3) .feature-card img.card-img-top {
        background: var(--dash-orange-icon-bg);
    }

    .feature-menu > [class*="col-"]:nth-of-type(5n+4) .feature-card img.card-img-top {
        background: var(--dash-purple-icon-bg);
    }

    .feature-menu > [class*="col-"]:nth-of-type(5n+5) .feature-card img.card-img-top {
        background: var(--dash-cyan-icon-bg);
    }


    .sap-wrapper {
        overflow: hidden;
        margin-top: 4px;
        border: 1px solid var(--dash-border);
        border-radius: 18px;
        background: var(--dash-card);
        box-shadow: var(--dash-shadow);
    }

    .sap-header {
        padding: 18px 21px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        border-bottom: 1px solid var(--dash-border);
        background:
            radial-gradient(circle at 90% 0%,rgba(37,99,235,.07),transparent 27%),
            linear-gradient(135deg,var(--dash-card-soft) 0%,var(--dash-card) 70%);
    }

    .sap-header-left {
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sap-main-icon {
        width: 45px;
        height: 45px;
        flex: 0 0 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--dash-border);
        border-radius: 12px;
        background: var(--dash-primary-soft);
    }

    .sap-main-icon img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    .sap-title {
        margin: 0 0 2px;
        color: var(--dash-heading);
        font-size: 19px;
        font-weight: 700;
        letter-spacing: -.15px;
    }

    .sap-subtitle {
        margin: 0;
        color: var(--dash-muted);
        font-size: 13px;
        line-height: 1.4;
    }

    .sap-search-wrapper {
        width: 300px;
        max-width: 100%;
    }

    .sap-search {
        height: 42px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0 13px;
        border: 1px solid var(--dash-border);
        border-radius: 10px;
        color: var(--dash-muted);
        background: var(--dash-input);
        box-shadow: 0 2px 7px rgba(15,39,68,.025);
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .sap-search:focus-within {
        border-color: #76a7ee;
        box-shadow: 0 0 0 3px rgba(37,99,235,.075);
    }

    .sap-search input {
        width: 100%;
        border: 0;
        outline: 0;
        color: var(--dash-text);
        background: transparent;
        font-size: 13px;
    }

    .sap-search input::placeholder {
        color: var(--dash-muted-2);
    }

    .sap-content {
        padding: 20px;
        background: var(--dash-card);
    }

    .sap-section {
        margin-bottom: 23px;
    }

    .sap-section:last-of-type {
        margin-bottom: 0;
    }

    .sap-section-header {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .sap-section-title {
        margin: 0 0 2px;
        color: var(--dash-heading);
        font-size: 16px;
        font-weight: 700;
        letter-spacing: -.05px;
    }

    .sap-section-description {
        color: var(--dash-muted);
        font-size: 12.5px;
        line-height: 1.4;
    }

    .sap-count {
        min-width: 27px;
        height: 25px;
        padding: 0 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--dash-border);
        border-radius: 7px;
        color: var(--dash-muted);
        background: var(--dash-bg-soft);
        font-size: 12px;
        font-weight: 700;
    }

    .sap-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill,minmax(400px,1fr));
        gap: 10px;
    }

    .sap-menu-item {
        position: relative;
        min-height: 72px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        gap: 11px;
        border: 1px solid var(--dash-border);
        border-radius: 12px;
        color: inherit;
        background: var(--dash-card);
        text-decoration: none !important;
        box-shadow: 0 2px 7px rgba(15,39,68,.023);
        transition: transform .17s ease, border-color .17s ease, box-shadow .17s ease, background .17s ease;
    }

    body[data-pc-theme="dark"] .sap-menu-item {
        box-shadow: 0 2px 8px rgba(0,0,0,.15);
    }

    .sap-menu-item:hover {
        transform: translateY(-2px);
        border-color: var(--dash-border-hover);
        box-shadow: 0 8px 18px rgba(15,39,68,.07);
    }

    body[data-pc-theme="dark"] .sap-menu-item:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,.25);
    }

    .sap-menu-item:active {
        transform: translateY(0);
    }

    .sap-menu-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .2px;
    }

    .sap-menu-icon.blue {
        color: #2563eb;
        background: #edf5ff;
    }

    .sap-menu-icon.green {
        color: #15966d;
        background: #ebfaf4;
    }

    .sap-menu-icon.orange {
        color: #d97706;
        background: #fff6e9;
    }

    .sap-menu-icon.purple {
        color: #7c3aed;
        background: #f5efff;
    }

    .sap-menu-icon.cyan {
        color: #0f8fa4;
        background: #eaf9fc;
    }

    body[data-pc-theme="dark"] .sap-menu-icon.blue {
        color: #60a5fa;
        background: #172554;
    }

    body[data-pc-theme="dark"] .sap-menu-icon.green {
        color: #34d399;
        background: #0e2d27;
    }

    body[data-pc-theme="dark"] .sap-menu-icon.orange {
        color: #fbbf24;
        background: #332312;
    }

    body[data-pc-theme="dark"] .sap-menu-icon.purple {
        color: #c084fc;
        background: #271b3d;
    }

    body[data-pc-theme="dark"] .sap-menu-icon.cyan {
        color: #22d3ee;
        background: #123039;
    }

    .sap-menu-content {
        flex: 1;
        min-width: 0;
    }

    .sap-menu-title {
        margin-bottom: 3px;
        color: var(--dash-text);
        font-size: 14px;
        font-weight: 700;
        transition: color .17s ease;
    }

    .sap-menu-description {
        overflow: hidden;
        color: var(--dash-muted);
        font-size: 12px;
        line-height: 1.4;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .sap-menu-item:hover .sap-menu-title {
        color: var(--dash-primary);
    }

    .sap-menu-arrow {
        width: 30px;
        height: 30px;
        flex: 0 0 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: var(--dash-muted-2);
        transition: color .17s ease, background .17s ease, transform .17s ease;
    }

    .sap-menu-arrow svg {
        width: 17px;
        height: 17px;
    }

    .sap-menu-item:hover .sap-menu-arrow {
        color: var(--dash-primary);
        background: var(--dash-primary-soft);
        transform: translateX(2px);
    }

    /* =========================================================
       EMPTY STATE
       ========================================================= */

    .sap-empty {
        padding: 45px 18px;
        text-align: center;
        color: var(--dash-muted);
    }

    .sap-empty-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--dash-border);
        border-radius: 50%;
        color: var(--dash-muted);
        background: var(--dash-bg-soft);
    }

    .sap-empty h6 {
        margin-bottom: 3px;
        color: var(--dash-heading);
        font-size: 15px;
        font-weight: 700;
    }

    .sap-empty p {
        margin: 0;
        color: var(--dash-muted);
        font-size: 13px;
    }

    /* =========================================================
       TABLET
       ========================================================= */

    @media (max-width: 991.98px) {
        .feature-card,
        .feature-card .card-body {
            min-height: 106px;
        }

        .sap-grid {
            grid-template-columns: repeat(2,minmax(0,1fr));
        }
    }

    /* =========================================================
       MOBILE / TABLET
       ========================================================= */

    @media (max-width: 767.98px) {
        .dashboard-greeting {
            min-height: 64px;
            padding: 12px 14px;
            border-radius: 14px;
            font-size: 15px;
        }

        .dashboard-greeting::before {
            width: 4px;
            margin-right: 9px;
        }

        .dashboard-greeting .wave {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            font-size: 17px;
        }

        .feature-menu {
            margin-bottom: 19px;
            --bs-gutter-x: .45rem;
            --bs-gutter-y: .45rem;
        }

        .feature-section-heading {
            align-items: center;
        }

        .feature-section-heading h5 {
            font-size: 18px;
        }

        .feature-section-heading p {
            font-size: 12px;
        }

        .feature-section-badge {
            display: none;
        }

        .satu-sims-card {
            border-radius: 14px !important;
        }

        .satu-sims-card .card-body {
            min-height: 64px;
            padding: 11px 13px !important;
        }

        .satu-sims-icon {
            width: 39px;
            height: 39px;
            flex-basis: 39px;
            border-radius: 10px;
        }

        .satu-sims-icon i {
            font-size: 17px !important;
        }

        .satu-sims-card h6 {
            font-size: 14px;
        }

        .satu-sims-card small {
            font-size: 11.5px;
        }

        .feature-card,
        .feature-card .card-body {
            min-height: 102px;
        }

        .feature-card {
            border-radius: 11px !important;
        }

        .feature-card .card-body {
            padding: 10px 4px 8px !important;
        }

        .feature-card img.card-img-top {
            width: 24px !important;
            height: 24px !important;
            max-width: 24px !important;
            margin-bottom: 7px;
            padding: 7px;
            border-radius: 9px;
        }

        .feature-card .card-title {
            min-height: 30px;
            padding: 0 2px;
            font-size: 12px !important;
            line-height: 1.25;
        }

        .sap-wrapper {
            border-radius: 15px;
        }

        .sap-header {
            padding: 14px;
            flex-direction: column;
            align-items: stretch;
            gap: 11px;
        }

        .sap-search-wrapper {
            width: 100%;
        }

        .sap-content {
            padding: 14px;
        }

        .sap-grid {
            grid-template-columns: 1fr;
        }

        .sap-title {
            font-size: 17px;
        }

        .sap-subtitle {
            font-size: 12px;
        }

        .sap-section-title {
            font-size: 15px;
        }

        .sap-section-description {
            font-size: 11.5px;
        }

        .sap-menu-title {
            font-size: 13.5px;
        }

        .sap-menu-description {
            font-size: 11.5px;
            white-space: normal;
        }
    }

    @media (max-width: 575.98px) {
        .pc-content {
            padding-left: 10px;
            padding-right: 10px;
        }

        .row > * {
            margin-top: .12rem;
        }

        .feature-menu > .col-4 {
            width: 33.333333%;
            flex: 0 0 auto;
            padding-left: 4px;
            padding-right: 4px;
        }

        .feature-menu > .col-12 {
            width: 100%;
            flex: 0 0 auto;
            padding-left: 3px;
            padding-right: 3px;
        }

        .feature-card,
        .feature-card .card-body {
            min-height: 100px;
        }

        .feature-card {
            border-radius: 10px !important;
        }

        .feature-card .card-body {
            padding: 10px 4px 8px !important;
        }

        .feature-card img.card-img-top {
            width: 24px !important;
            height: 24px !important;
            max-width: 24px !important;
            margin-bottom: 7px;
            padding: 7px;
            border-radius: 8px;
        }

        .feature-card .card-title {
            min-height: 31px;
            padding: 0 3px;
            font-size: 11.5px !important;
            font-weight: 650;
            line-height: 1.25;
        }

        .dashboard-greeting {
            min-height: 62px;
            padding: 11px 13px;
            border-radius: 13px;
            font-size: 15px;
        }

        .dashboard-greeting .wave {
            width: 29px;
            height: 29px;
            font-size: 17px;
        }

        .feature-section-heading h5 {
            font-size: 18px;
        }

        .feature-section-heading p {
            font-size: 12px;
        }

        .sap-header {
            padding: 13px;
        }

        .sap-content {
            padding: 13px;
        }

        .sap-title {
            font-size: 17px;
        }

        .sap-subtitle {
            font-size: 12px;
            line-height: 1.4;
        }

        .sap-main-icon {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
            border-radius: 10px;
        }

        .sap-main-icon img {
            width: 21px;
            height: 21px;
        }

        .sap-search {
            height: 39px;
        }

        .sap-search input {
            font-size: 13px;
        }

        .sap-section {
            margin-bottom: 19px;
        }

        .sap-section-title {
            font-size: 15px;
        }

        .sap-section-description {
            font-size: 11.5px;
            line-height: 1.4;
        }

        .sap-count {
            font-size: 11.5px;
        }

        .sap-menu-item {
            min-height: 70px;
            padding: 9px 10px;
            gap: 10px;
            border-radius: 10px;
        }

        .sap-menu-icon {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
            border-radius: 10px;
            font-size: 9px;
        }

        .sap-menu-title {
            font-size: 13.5px;
        }

        .sap-menu-description {
            font-size: 11.5px;
            line-height: 1.4;
        }

        .sap-menu-arrow {
            width: 28px;
            height: 28px;
            flex-basis: 28px;
        }

        .sap-menu-arrow svg {
            width: 15px;
            height: 15px;
        }
    }

    @media (max-width: 380px) {
        .pc-content {
            padding-left: 8px;
            padding-right: 8px;
        }

        .feature-menu {
            --bs-gutter-x: .3rem;
            --bs-gutter-y: .3rem;
        }

        .feature-menu > .col-4 {
            padding-left: 3px;
            padding-right: 3px;
        }

        .feature-card,
        .feature-card .card-body {
            min-height: 98px;
        }

        .feature-card img.card-img-top {
            width: 23px !important;
            height: 23px !important;
            max-width: 23px !important;
            padding: 6px;
        }

        .feature-card .card-title {
            min-height: 29px;
            font-size: 11px !important;
            line-height: 1.2;
        }

        .dashboard-greeting {
            font-size: 14px;
        }

        .satu-sims-card h6 {
            font-size: 13.5px;
        }

        .satu-sims-card small {
            font-size: 11px;
        }

        .sap-menu-title {
            font-size: 13px;
        }

        .sap-menu-description {
            font-size: 11px;
        }
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12 mb-3">
                        <div class="page-header-title mb-0">
                            <h5 class="dashboard-greeting">
                                Semangat Pagi, {{ Auth::user()->name }}!
                                <span class="wave ms-2">👋</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3 feature-menu">
            <div class="col-12">
                <div class="feature-section-heading">
                    <div>
                        <h5>Fitur Pilihan</h5>
                    </div>
                    <span class="feature-section-badge">
                        <i class="ti ti-layout-grid"></i> Menu Utama
                    </span>
                </div>
            </div>
            <div class="col-12">
                <a href="https://poka.ptsims.co.id" class="text-decoration-none">
                    <div class="card border-0 shadow-sm satu-sims-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="satu-sims-icon">
                                <i class="ti ti-arrow-left text-white fs-4"></i>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <h6 class="mb-1 text-white fw-bold">
                                    Kembali ke SATU SIMS
                                </h6>
                                <small class="text-white-50">
                                    Portal utama aplikasi
                                </small>
                            </div>
                            <i class="ti ti-external-link text-white fs-5"></i>
                        </div>
                    </div>
                </a>
            </div>
            @if (
                canAccess('hazard-report.insert') ||
                canAccess('form-pengawas-new.index') ||
                canAccess('form-pengawas-batubara.index') ||
                canAccess('pengawas-pitstop.index') ||
                canAccess('ert.index') ||
                canAccess('patrol.index') ||
                canAccess('form-pengawas-sap.index')
            )
                @if (canAccess('hazard-report.insert'))
                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    <a href="{{ route('hazard-report.insert') }}" class="text-decoration-none">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/hazard.png" style="max-width: 20px">
                                <h6 class="card-title" style="font-size:11px">Form Hazard Report</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if (Auth::user()->role != 'WORKER')
                    @if (canAccess('form-pengawas-sap.index'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('form-pengawas-sap.index') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form Inspeksi</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if (canAccess('observasibank.insert'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('observasibank.insert') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form Observasi BANK</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if (canAccess('form-pengawas-new.index'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('form-pengawas-new.index') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form Produksi</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if (canAccess('form-pengawas-batubara.index'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('form-pengawas-batubara.index') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form Batu Bara</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif

                    @if (canAccess('pengawas-pitstop.index'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('pengawas-pitstop.index') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form Pit Stop</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if (canAccess('inspeksi.tidakterencana'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('inspeksi.tidakterencana') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form Sidak</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if (canAccess('ert.index'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('ert.index') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form ERT</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if (canAccess('patrol.index'))
                    <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                        <a href="{{ route('patrol.index') }}" class="text-decoration-none">
                            <div class="card feature-card h-100">
                                <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                    <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                    <h6 class="card-title" style="font-size:11px">Form Patrol</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                @endif
            @else

                @if (canAccess('form-pengawas-new\.show'))
                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    <a href="{{ route('form-pengawas-new\.show') }}" class="text-decoration-none">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                <h6 class="card-title" style="font-size:11px">Laporan Harian Produksi</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if (canAccess('form-pengawas-batubara.show'))
                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    <a href="{{ route('form-pengawas-batubara.show') }}" class="text-decoration-none">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/pencil.png" style="max-width: 20px">
                                <h6 class="card-title" style="font-size:11px">Laporan Harian Batu Bara</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if (canAccess('form-pengawas-sap.show'))
                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    <a href="{{ route('form-pengawas-sap.show') }}" class="text-decoration-none">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/to-do-list.png" style="max-width: 20px">
                                <h6 class="card-title" style="font-size:11px">Laporan Inspeksi</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
            @endif
            @if (Auth::user()->role != 'WORKER')
                @if (canAccess('jobpending.produksi'))
                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    <a href="{{ route('jobpending.produksi') }}" class="text-decoration-none">
                        <div class="card feature-card h-100">
                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">
                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/job-creation.png" style="max-width: 20px">
                                <h6 class="card-title" style="font-size:11px">Job Pending Produksi</h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if (canAccess('p2h.index'))
                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    <a href="{{ route('p2h.index') }}" class="text-decoration-none">
                        <div class="card feature-card h-100">

                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">

                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/worker.png" style="max-width: 20px">

                                <h6 class="card-title" style="font-size:11px">Verifikasi P2H</h6>

                            </div>

                        </div>

                    </a>

                </div>

                @endif

                @if (canAccess('kkh.all'))

                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">

                    <a href="{{ route('kkh.all') }}" class="text-decoration-none">

                        <div class="card feature-card h-100">

                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">

                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/ergonomic.png" style="max-width: 20px">

                                <h6 class="card-title" style="font-size:11px">Verifikasi KKH</h6>

                            </div>

                        </div>

                    </a>

                </div>

                @endif

                @if (canAccess('diggibility'))

                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">

                    <a href="{{ route('diggibility') }}" class="text-decoration-none">

                        <div class="card feature-card h-100">

                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">

                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/blasting.png" style="max-width: 20px">

                                <h6 class="card-title" style="font-size:11px">Digging Time</h6>

                            </div>

                        </div>

                    </a>

                </div>

                @endif

                @if (canAccess('production.index'))

                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">

                    <a href="{{ route('production.index') }}" class="text-decoration-none">

                        <div class="card feature-card h-100">

                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">

                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/production.png" style="max-width: 20px">

                                <h6 class="card-title" style="font-size:11px">Produksi Per Jam</h6>

                            </div>

                        </div>

                    </a>

                </div>

                @endif

                @if (canAccess('payloadritation.exa'))

                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">

                    <a href="{{ route('payloadritation.exa') }}" class="text-decoration-none">

                        <div class="card feature-card h-100">

                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">

                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/loading.png" style="max-width: 20px">

                                <h6 class="card-title" style="font-size:11px">Payload & Ritation</h6>

                            </div>

                        </div>

                    </a>

                </div>

                @endif

                @if (canAccess('production.ex'))

                <div class="col-4 col-md-4 col-lg-3 col-xl-3 col-xxl-2">

                    <a href="{{ route('production.ex') }}" class="text-decoration-none">

                        <div class="card feature-card h-100">

                            <div class="card-body text-center" style="padding-left:2px; padding-right:2px;">

                                <img class="img-fluid card-img-top" src="{{ asset('dashboard/assets') }}/images/widget/production-ex.png" style="max-width: 20px">

                                <h6 class="card-title" style="font-size:11px">Produksi EX Per Jam</h6>

                            </div>

                        </div>

                    </a>

                </div>

                @endif

            @endif

        </div>

        {{-- FORM SAP LIST --}}

        @if (Auth::user()->role != 'WORKER')

            @if (
                canAccess('form-pengawas-sap.index') ||
                canAccess('klkh.loading-point') ||
                canAccess('klkh.haul-road') ||
                canAccess('klkh.disposal') ||
                canAccess('klkh.lumpur') ||
                canAccess('klkh.ogs') ||
                canAccess('klkh.batubara') ||
                canAccess('klkh.simpangempat') ||
                canAccess('klkh.it') ||
                canAccess('inspeksi.jalantambang') ||
                canAccess('inspeksi.disposal') ||
                canAccess('inspeksi.frontloading') ||
                canAccess('inspeksi.ogs') ||
                canAccess('inspeksi.slurrypump') ||
                canAccess('inspeksi.workshop') ||
                canAccess('inspeksi.tidakterencana') ||
                canAccess('observasibank')
            )

            @php
                $sapMenus = [
                    [
                        'title' => 'Form Pengawas',
                        'subtitle' => 'Form inspeksi dan pengawasan',
                        'code' => 'SAP',
                        'class' => 'blue',
                        'items' => [
                            [
                                'name' => 'Inspeksi',
                                'description' => 'Form inspeksi SAP',
                                'route' => 'form-pengawas-sap.index',
                                'access' => 'form-pengawas-sap.index'
                            ],
                        ]
                    ],
                    [
                        'title' => 'KLKH',
                        'subtitle' => 'Keselamatan, kesehatan dan lingkungan kerja',
                        'code' => 'KLKH',
                        'class' => 'green',
                        'items' => [
                            [
                                'name' => 'KLKH Loading Point',
                                'description' => 'Pemeriksaan area loading point',
                                'route' => 'klkh.loading-point',
                                'access' => 'klkh.loading-point'
                            ],

                            [
                                'name' => 'KLKH Haul Road',
                                'description' => 'Pemeriksaan kondisi jalan angkut',
                                'route' => 'klkh.haul-road',
                                'access' => 'klkh.haul-road'
                            ],

                            [
                                'name' => 'KLKH Disposal / Dumping Point',
                                'description' => 'Pemeriksaan area disposal',
                                'route' => 'klkh.disposal',
                                'access' => 'klkh.disposal'
                            ],

                            [
                                'name' => 'KLKH Dumping di Kolam Air/Lumpur',
                                'description' => 'Pemeriksaan aktivitas dumping',
                                'route' => 'klkh.lumpur',
                                'access' => 'klkh.lumpur'
                            ],

                            [
                                'name' => 'KLKH OGS',
                                'description' => 'Pemeriksaan area OGS',
                                'route' => 'klkh.ogs',
                                'access' => 'klkh.ogs'
                            ],

                            [
                                'name' => 'KLKH Batubara',
                                'description' => 'Pemeriksaan aktivitas batubara',
                                'route' => 'klkh.batubara',
                                'access' => 'klkh.batubara'
                            ],

                            [
                                'name' => 'KLKH Intersection',
                                'description' => 'Pemeriksaan area simpang empat',
                                'route' => 'klkh.simpangempat',
                                'access' => 'klkh.simpangempat'
                            ],

                            [
                                'name' => 'KLKH Troubleshooting IT',
                                'description' => 'Form pemeriksaan troubleshooting IT',
                                'route' => 'klkh.it',
                                'access' => 'klkh.it'
                            ],

                        ]

                    ],

                    [
                        'title' => 'Inspeksi Tambang',
                        'subtitle' => 'Inspeksi area dan aktivitas operasional',
                        'code' => 'INS',
                        'class' => 'orange',
                        'items' => [
                            [
                                'name' => 'Jalan Tambang',
                                'description' => 'Inspeksi kondisi jalan tambang',
                                'route' => 'inspeksi.jalantambang',
                                'access' => 'inspeksi.jalantambang'
                            ],
                            [
                                'name' => 'Disposal',
                                'description' => 'Inspeksi area disposal',
                                'route' => 'inspeksi.disposal',
                                'access' => 'inspeksi.disposal'
                            ],
                            [
                                'name' => 'Front Loading',
                                'description' => 'Inspeksi area front loading',
                                'route' => 'inspeksi.frontloading',
                                'access' => 'inspeksi.frontloading'
                            ],
                            [
                                'name' => 'Area OGS',
                                'description' => 'Inspeksi kondisi area OGS',
                                'route' => 'inspeksi.ogs',
                                'access' => 'inspeksi.ogs'
                            ],
                            [
                                'name' => 'Sump',
                                'description' => 'Inspeksi area sump',
                                'route' => 'inspeksi.slurrypump',
                                'access' => 'inspeksi.slurrypump'
                            ],
                            [
                                'name' => 'Workshop',
                                'description' => 'Inspeksi area workshop',
                                'route' => 'inspeksi.workshop',
                                'access' => 'inspeksi.workshop'
                            ],
                        ]
                    ],
                    [
                        'title' => 'Checklist & Kepatuhan',
                        'subtitle' => 'Form checklist, lingkungan dan kepatuhan',
                        'code' => 'SE',
                        'class' => 'purple',
                        'items' => [
                            [
                                'name' => 'Inspeksi Tidak Terencana',
                                'description' => 'Kepatuhan terhadap Golden Rules',
                                'route' => 'inspeksi.tidakterencana',
                                'access' => 'inspeksi.tidakterencana'
                            ],
                            [
                                'name' => 'Checklist Inspeksi Fuel Skid',
                                'description' => 'Pemeriksaan fasilitas fuel skid',
                                'route' => 'inspeksi.fuelskid',
                                'access' => 'inspeksi.fuelskid'
                            ],
                            [
                                'name' => 'Checklist TPS Limbah B3',
                                'description' => 'Pemeriksaan TPS limbah B3',
                                'route' => 'inspeksi.tpslimbahb3',
                                'access' => 'inspeksi.tpslimbahb3'
                            ],
                            [
                                'name' => 'Checklist Inspeksi Gudang B3',
                                'description' => 'Pemeriksaan gudang B3',
                                'route' => 'inspeksi.gudangb3',
                                'access' => 'inspeksi.gudangb3'
                            ],
                            [
                                'name' => 'Penilaian Terhadap Kantin',
                                'description' => 'Elemen penilaian fasilitas kantin',
                                'route' => 'inspeksi.penilaianterhadapkantin',
                                'access' => 'inspeksi.penilaianterhadapkantin'
                            ],
                        ]
                    ],
                    [
                        'title' => 'Observasi',
                        'subtitle' => 'Form observasi lapangan',
                        'code' => 'OBS',
                        'class' => 'cyan',
                        'items' => [
                            [
                                'name' => 'Observasi Bank',
                                'description' => 'Form observasi dan pencatatan lapangan',
                                'route' => 'observasibank',
                                'access' => 'observasibank'
                            ],
                        ]
                    ],
                ];
            @endphp
            <div class="col-12">
                <div class="sap-wrapper">
                    {{-- HEADER --}}
                    <div class="sap-header">
                        <div class="sap-header-left">
                            <div class="sap-main-icon">
                                <img src="{{ asset('dashboard/assets/images/widget/to-do-list.png') }}" alt="SAP">
                            </div>
                            <div>
                                <h4 class="sap-title">Form SAP</h4>
                                <p class="sap-subtitle">Pilih form inspeksi atau checklist yang ingin digunakan</p>
                            </div>
                        </div>
                        <div class="sap-search-wrapper">
                            <div class="sap-search">
                                <svg width="18" height="18"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.35-4.35"></path>
                                </svg>
                                <input type="text" id="sapSearch" placeholder="Cari form..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="sap-content">
                        @foreach ($sapMenus as $group)
                            @php
                                $accessibleItems = collect($group['items'])->filter(fn($item) => canAccess($item['access']));
                            @endphp
                            @if ($accessibleItems->count() > 0)
                                <div class="sap-section">
                                    <div class="sap-section-header">
                                        <div>
                                            <h6 class="sap-section-title">
                                                {{ $group['title'] }}
                                            </h6>
                                            <div class="sap-section-description">
                                                {{ $group['subtitle'] }}
                                            </div>
                                        </div>
                                        <span class="sap-count">
                                            {{ $accessibleItems->count() }}
                                        </span>
                                    </div>
                                    <div class="sap-grid">
                                        @foreach ($accessibleItems as $item)
                                            <a href="{{ route($item['route']) }}" class="sap-menu-item" data-search="{{ strtolower($item['name'].' '.$item['description'].' '.$group['title']) }}">
                                                <div class="sap-menu-icon {{ $group['class'] }}">
                                                    {{ $group['code'] }}
                                                </div>
                                                <div class="sap-menu-content">
                                                    <div class="sap-menu-title">
                                                        {{ $item['name'] }}
                                                    </div>
                                                    <div class="sap-menu-description">
                                                        {{ $item['description'] }}
                                                    </div>
                                                </div>
                                                <div class="sap-menu-arrow">
                                                    <svg width="18" height="18"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2">
                                                        <path d="m9 18 6-6-6-6"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div id="sapEmpty" class="sap-empty d-none">
                            <div class="sap-empty-icon">
                                <svg
                                    width="30"
                                    height="30"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.35-4.35"></path>
                                </svg>
                            </div>
                            <h6>Form tidak ditemukan</h6>
                            <p>Coba gunakan kata kunci lainnya.</p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const searchInput = document.getElementById('sapSearch');
                    const menuItems   = document.querySelectorAll('.sap-menu-item');
                    const sections    = document.querySelectorAll('.sap-section');
                    const emptyState  = document.getElementById('sapEmpty');
                    if (!searchInput) {
                        return;
                    }
                    searchInput.addEventListener('input', function () {
                        const keyword = this.value
                            .toLowerCase()
                            .trim();
                        let totalVisible = 0;
                        menuItems.forEach(function (item) {
                            const searchText =
                                item.dataset.search || '';
                            const isMatch = searchText.includes(keyword);
                            item.style.display =
                                isMatch ? 'flex' : 'none';
                            if (isMatch) {
                                totalVisible++;
                            }
                        });

                        sections.forEach(function (section) {
                            const visibleItems =
                                Array.from(
                                    section.querySelectorAll('.sap-menu-item')
                                ).filter(function (item) {
                                    return item.style.display !== 'none';
                                });
                            section.style.display =
                                visibleItems.length > 0
                                    ? 'block'
                                    : 'none';
                        });

                        if (totalVisible === 0) {
                            emptyState.classList.remove('d-none');
                        } else {
                            emptyState.classList.add('d-none');
                        }
                    });
                });
            </script>
            @endif
        @endif
    </div>
</div>
@include('layout.footer')
