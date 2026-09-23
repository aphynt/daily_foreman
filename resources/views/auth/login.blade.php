<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Digitalisasi laporan foreman untuk efisiensi alur proses dan peningkatan akurasi data">
    <meta name="keywords" content="Laporan Harian Pengawas">
    <meta name="author" content="IT - PT. SIMS JAYA KALTIM">

    <link rel="icon" href="{{ asset('dashboard/assets') }}/images/icon.png" type="image/x-icon">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Dashboard - Daily Foreman">
    <meta property="og:description" content="Digitalisasi laporan foreman untuk efisiensi alur proses dan peningkatan akurasi data">
    <meta property="og:image" content="http://foreman.ptsims.co.id/dashboard/assets/images/icon512.png">
    <meta property="og:url" content="http://foreman.ptsims.co.id">
    <meta property="og:site_name" content="Daily Foreman">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --navy-950: #061426;
            --navy-900: #0a1d35;
            --navy-800: #0f2a4a;
            --blue-600: #2563eb;
            --blue-500: #3b82f6;
            --blue-100: #dbeafe;
            --cyan-400: #22d3ee;
            --green-500: #10b981;
            --slate-950: #0f172a;
            --slate-700: #334155;
            --slate-600: #475569;
            --slate-500: #64748b;
            --slate-400: #94a3b8;
            --slate-300: #cbd5e1;
            --slate-200: #e2e8f0;
            --slate-100: #f1f5f9;
            --slate-50: #f8fafc;
            --white: #ffffff;
            --danger: #ef4444;
            --radius-xl: 28px;
            --radius-lg: 18px;
            --radius-md: 14px;
            --shadow-xl: 0 30px 70px rgba(6, 20, 38, 0.18);
            --transition: 180ms ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--slate-950);
            background: #eef4fb;
            line-height: 1.5;
            overscroll-behavior: none;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        button,
        input {
            font: inherit;
        }

        .page-shell {
            position: relative;
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
            overflow: hidden;
            isolation: isolate;
            background:
                radial-gradient(circle at 15% 15%, rgba(59, 130, 246, 0.14), transparent 30%),
                radial-gradient(circle at 86% 82%, rgba(34, 211, 238, 0.12), transparent 28%),
                linear-gradient(145deg, #f8fbff 0%, #edf4fc 46%, #e7f0fb 100%);
        }

        .page-shell::before,
        .page-shell::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            filter: blur(2px);
            pointer-events: none;
            z-index: -1;
        }

        .page-shell::before {
            width: 360px;
            height: 360px;
            top: -120px;
            right: -110px;
            background: linear-gradient(145deg, rgba(37, 99, 235, 0.14), rgba(34, 211, 238, 0.07));
        }

        .page-shell::after {
            width: 280px;
            height: 280px;
            left: -90px;
            bottom: -110px;
            background: linear-gradient(145deg, rgba(15, 42, 74, 0.10), rgba(59, 130, 246, 0.06));
        }

        .auth-card {
            width: min(1120px, 100%);
            min-height: 650px;
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(420px, 0.9fr);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: var(--radius-xl);
            background: rgba(255, 255, 255, 0.88);
            box-shadow: var(--shadow-xl);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .brand-panel {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 54px;
            color: var(--white);
            background:
                radial-gradient(circle at 78% 18%, rgba(59, 130, 246, 0.34), transparent 32%),
                radial-gradient(circle at 14% 90%, rgba(34, 211, 238, 0.14), transparent 34%),
                linear-gradient(145deg, var(--navy-950) 0%, var(--navy-900) 55%, #0c2d50 100%);
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            right: -110px;
            top: -100px;
            border: 1px solid rgba(255, 255, 255, 0.11);
            border-radius: 50%;
            box-shadow:
                0 0 0 55px rgba(255, 255, 255, 0.035),
                0 0 0 110px rgba(255, 255, 255, 0.025);
        }

        .brand-panel::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(to bottom right, black, transparent 72%);
            pointer-events: none;
        }

        .brand-top,
        .brand-copy,
        .brand-meta {
            position: relative;
            z-index: 1;
        }

        .brand-logo-wrap {
            display: inline-flex;
            align-items: center;
            max-width: 340px;
            padding: 12px 16px;
            border: 1px solid rgba(255, 255, 255, 0.13);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.16);
        }

        .brand-logo {
            display: block;
            width: min(300px, 100%);
            height: auto;
        }

        .brand-copy {
            max-width: 520px;
            margin: 54px 0;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            padding: 8px 12px;
            border: 1px solid rgba(147, 197, 253, 0.22);
            border-radius: 999px;
            color: #bfdbfe;
            background: rgba(59, 130, 246, 0.11);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: var(--green-500);
            box-shadow: 0 0 0 5px rgba(16, 185, 129, 0.12);
        }

        .brand-title {
            max-width: 500px;
            margin-bottom: 20px;
            color: var(--white);
            font-size: clamp(34px, 4vw, 54px);
            font-weight: 760;
            letter-spacing: -0.045em;
            line-height: 1.05;
        }

        .brand-description {
            max-width: 470px;
            color: rgba(226, 232, 240, 0.78);
            font-size: 15px;
            line-height: 1.8;
        }

        .feature-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            color: #dbeafe;
            background: rgba(255,255,255,0.045);
            font-size: 13px;
            font-weight: 600;
        }

        .feature-icon {
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            display: grid;
            place-items: center;
            border-radius: 9px;
            color: #93c5fd;
            background: rgba(59,130,246,0.15);
        }

        .feature-icon svg {
            width: 16px;
            height: 16px;
        }

        .brand-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(203, 213, 225, 0.62);
            font-size: 12px;
        }

        .brand-meta-line {
            width: 34px;
            height: 1px;
            background: rgba(148, 163, 184, 0.42);
        }

        .form-panel {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 58px 54px;
            background:
                linear-gradient(180deg, rgba(255,255,255,.98), rgba(248,250,252,.96));
        }

        .form-wrap {
            width: 100%;
            max-width: 410px;
        }

        .mobile-logo {
            display: none;
            justify-content: center;
            margin-bottom: 26px;
        }

        .mobile-logo img {
            width: min(260px, 80vw);
            height: auto;
        }

        .secure-badge {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            padding: 8px 11px;
            border: 1px solid #dce7f6;
            border-radius: 999px;
            color: var(--blue-600);
            background: #f4f8ff;
            font-size: 12px;
            font-weight: 700;
        }

        .secure-badge svg {
            width: 15px;
            height: 15px;
        }

        .form-title {
            margin-bottom: 10px;
            color: var(--slate-950);
            font-size: clamp(28px, 3vw, 36px);
            font-weight: 760;
            letter-spacing: -0.035em;
            line-height: 1.15;
        }

        .form-subtitle {
            margin-bottom: 34px;
            color: var(--slate-500);
            font-size: 14px;
            line-height: 1.7;
        }

        .field-group {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            margin-bottom: 9px;
            color: var(--slate-700);
            font-size: 13px;
            font-weight: 700;
        }

        .input-shell {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            width: 19px;
            height: 19px;
            transform: translateY(-50%);
            color: var(--slate-400);
            pointer-events: none;
            transition: color var(--transition);
        }

        .form-control {
            width: 100%;
            height: 54px;
            padding: 0 48px 0 46px;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-md);
            outline: none;
            color: var(--slate-950);
            background: var(--white);
            font-size: 16px;
            font-weight: 500;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.02);
            transition: border-color var(--transition), box-shadow var(--transition), background var(--transition);
        }

        .form-control::placeholder {
            color: #a7b2c3;
            font-weight: 400;
        }

        .form-control:hover {
            border-color: var(--slate-300);
        }

        .input-shell:focus-within .form-control {
            border-color: var(--blue-500);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
            background: #ffffff;
        }

        .input-shell:focus-within .input-icon {
            color: var(--blue-600);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 11px;
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            transform: translateY(-50%);
            border: 0;
            border-radius: 10px;
            color: var(--slate-400);
            background: transparent;
            cursor: pointer;
            transition: color var(--transition), background var(--transition);
        }

        .password-toggle:hover,
        .password-toggle:focus-visible {
            color: var(--slate-700);
            background: var(--slate-100);
            outline: none;
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-top: 2px;
        }


        .forgot-link {
            color: var(--blue-600);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: color var(--transition);
        }

        .forgot-link:hover {
            color: var(--navy-800);
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .remember-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--slate-600);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
        }

        .remember-wrap input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            flex: 0 0 20px;
            display: grid;
            place-items: center;
            border: 1.5px solid var(--slate-300);
            border-radius: 6px;
            background: var(--white);
            transition: border-color var(--transition), background var(--transition), box-shadow var(--transition);
        }

        .custom-checkbox svg {
            width: 13px;
            height: 13px;
            color: var(--white);
            opacity: 0;
            transform: scale(.7);
            transition: opacity var(--transition), transform var(--transition);
        }

        .remember-wrap input:checked + .custom-checkbox {
            border-color: var(--blue-600);
            background: var(--blue-600);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
        }

        .remember-wrap input:checked + .custom-checkbox svg {
            opacity: 1;
            transform: scale(1);
        }

        .remember-wrap input:focus-visible + .custom-checkbox {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .13);
        }

        .submit-btn {
            position: relative;
            width: 100%;
            min-height: 54px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 28px;
            padding: 14px 18px;
            overflow: hidden;
            border: 0;
            border-radius: var(--radius-md);
            color: var(--white);
            background: linear-gradient(135deg, var(--navy-900), #123a67 68%, #164b82);
            box-shadow: 0 12px 24px rgba(10, 29, 53, 0.20);
            cursor: pointer;
            font-size: 15px;
            font-weight: 750;
            letter-spacing: .01em;
            transition: transform var(--transition), box-shadow var(--transition), filter var(--transition);
        }

        .submit-btn::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, transparent 20%, rgba(255,255,255,.14) 42%, transparent 64%);
            transform: translateX(-120%);
            transition: transform 450ms ease;
        }

        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(10, 29, 53, 0.25);
            filter: brightness(1.04);
        }

        .submit-btn:hover::before {
            transform: translateX(120%);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 4px rgba(37,99,235,.16), 0 14px 28px rgba(10, 29, 53, .22);
        }

        .submit-btn svg {
            width: 17px;
            height: 17px;
        }

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 24px;
            padding: 14px 15px;
            border: 1px solid #e5edf7;
            border-radius: 13px;
            color: var(--slate-500);
            background: #f8fbff;
            font-size: 12px;
            line-height: 1.6;
        }

        .security-note svg {
            width: 17px;
            height: 17px;
            flex: 0 0 17px;
            margin-top: 1px;
            color: var(--green-500);
        }

        .footer {
            margin-top: 28px;
            text-align: center;
            color: var(--slate-400);
            font-size: 11.5px;
        }

        .footer strong {
            color: var(--slate-600);
            font-weight: 700;
        }

        .notifier-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: min(390px, calc(100vw - 40px));
            display: none;
            padding: 14px 16px;
            border-radius: 14px;
            color: var(--white);
            box-shadow: 0 18px 42px rgba(15, 23, 42, .2);
            font-size: 14px;
            font-weight: 600;
            transition: opacity .3s ease, transform .3s ease;
        }

        .notifier-container.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .notifier-container.hide {
            display: block;
            opacity: 0;
            transform: translateY(-8px);
            pointer-events: none;
        }

        @keyframes riseIn {
            from {
                opacity: 0;
                transform: translateY(16px) scale(.99);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .auth-card {
            animation: riseIn .55s cubic-bezier(.2,.8,.2,1) both;
        }

        @media (max-width: 960px) {
            .page-shell {
                padding: 22px;
            }

            .auth-card {
                width: min(520px, 100%);
                min-height: auto;
                grid-template-columns: 1fr;
            }

            .brand-panel {
                display: none;
            }

            .form-panel {
                padding: 42px 36px 32px;
            }

            .mobile-logo {
                display: flex;
            }

            .form-wrap {
                max-width: 430px;
            }
        }

        @media (max-width: 560px) {
            .page-shell {
                align-items: stretch;
                padding: 0;
                background: var(--white);
            }

            .page-shell::before,
            .page-shell::after {
                display: none;
            }

            .auth-card {
                width: 100%;
                min-height: 100vh;
                min-height: 100dvh;
                border: 0;
                border-radius: 0;
                box-shadow: none;
                animation: none;
            }

            .form-panel {
                align-items: flex-start;
                padding: 34px 22px 24px;
            }

            .mobile-logo {
                margin-bottom: 30px;
            }

            .secure-badge {
                margin-bottom: 15px;
            }

            .form-title {
                font-size: 30px;
            }

            .form-subtitle {
                margin-bottom: 28px;
            }

            .form-control {
                height: 52px;
            }

            .submit-btn {
                min-height: 52px;
                margin-top: 24px;
            }

            .security-note {
                margin-top: 20px;
            }

            .footer {
                margin-top: 26px;
                padding-bottom: env(safe-area-inset-bottom, 0);
            }

            .notifier-container {
                top: 12px;
                right: 12px;
                max-width: calc(100vw - 24px);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    @include('layout.alert.general')

    <main class="page-shell">
        <section class="auth-card" aria-label="Login {{ config('app.name') }}">
            <aside class="brand-panel">
                <div class="brand-top">
                    <a href="javascript:void(0);" class="brand-logo-wrap" aria-label="PT. SIMS JAYA KALTIM">
                        <img
                            src="{{ asset('dashboard/assets') }}/images/logo-full.png"
                            alt="Company Logo"
                            class="brand-logo"
                        >
                    </a>
                </div>

                <div class="brand-copy">
                    <div class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        Integrated Digital Workspace
                    </div>

                    <h1 class="brand-title">{{ config('app.name') }}</h1>
                    <p class="brand-description">
                        Digitalisasi laporan foreman untuk  proses kerja menjadi lebih efisien,
                        konsisten, dan akurat dalam satu sistem terintegrasi.
                    </p>

                    <div class="feature-list">
                        <div class="feature-item">
                            <span class="feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                            </span>
                            Secure Access
                        </div>

                        <div class="feature-item">
                            <span class="feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 3v18h18"></path>
                                    <path d="m7 16 4-5 4 3 4-6"></path>
                                </svg>
                            </span>
                            Accurate Reporting
                        </div>
                    </div>
                </div>

                <div class="brand-meta">
                    <span class="brand-meta-line"></span>
                    Powered by SATU SIMS
                </div>
            </aside>

            <div class="form-panel">
                <div class="form-wrap">
                    <div class="mobile-logo">
                        <img src="{{ asset('dashboard/assets') }}/images/logo-full.png" alt="Company Logo">
                    </div>

                    <div class="secure-badge">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        Secure Login
                    </div>

                    <h2 class="form-title">Selamat datang!</h2>
                    <p class="form-subtitle">
                        Masuk ke <strong>{{ config('app.name') }}</strong> menggunakan NIK dan password Anda.
                    </p>

                    <form action="{{ route('login.post') }}" method="post">
                        @csrf

                        <div class="field-group">
                            <label for="floatingInput" class="field-label">NIK</label>
                            <div class="input-shell">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="floatingInput"
                                    placeholder="Masukkan NIK..."
                                    name="nik"
                                    oninput="this.value = this.value.toUpperCase()"
                                    autocomplete="username"
                                    required
                                >
                            </div>
                        </div>

                        <div class="field-group">
                            <label for="floatingInput1" class="field-label">Password</label>
                            <div class="input-shell">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="floatingInput1"
                                    placeholder="Masukkan Password..."
                                    name="password"
                                    autocomplete="current-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    id="passwordToggle"
                                    aria-label="Tampilkan password"
                                    aria-pressed="false"
                                >
                                    <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696C3.303 8.27 6.386 6 12 6c5.614 0 8.697 2.27 9.938 5.652a1 1 0 0 1 0 .696C20.697 15.73 17.614 18 12 18c-5.614 0-8.697-2.27-9.938-5.652"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="form-options">
                            <label for="customCheckc1" class="remember-wrap">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    id="customCheckc1"
                                    checked
                                >
                                <span class="custom-checkbox" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m5 12 4 4L19 6"></path>
                                    </svg>
                                </span>
                                <span>Ingat Saya!</span>
                            </label>
                            <a href="{{ route('password.recovery') }}" class="forgot-link">Lupa password?</a>
                        </div>

                        <button type="submit" class="submit-btn">
                            <span>Masuk</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14"></path>
                                <path d="m13 6 6 6-6 6"></path>
                            </svg>
                        </button>
                    </form>

                    <div class="security-note">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20 13c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V5l8-3 8 3z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                        <span>Pastikan NIK dan password hanya digunakan pada perangkat yang Anda percaya.</span>
                    </div>

                    <div class="footer">
                        © 2024 <strong>IT - PT. SIMS JAYA KALTIM</strong>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="notifier-container hide"></div>

    <script>
        // UI only: show / hide password. Tidak mengubah proses autentikasi.
        const passwordInput = document.getElementById('floatingInput1');
        const passwordToggle = document.getElementById('passwordToggle');

        if (passwordInput && passwordToggle) {
            passwordToggle.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                passwordToggle.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
                passwordToggle.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
            });
        }

        // Existing notifier logic retained.
        function showNotifier(message, type = 'success') {
            const notifier = document.querySelector('.notifier-container');
            notifier.textContent = message;
            notifier.className = 'notifier-container show';
            notifier.style.backgroundColor = type === 'success' ? '#28a745' : '#dc3545';

            setTimeout(() => {
                notifier.className = 'notifier-container hide';
            }, 5000);
        }

        // Example usage:
        // showNotifier('Login berhasil!', 'success');
        // showNotifier('NIK atau password salah', 'error');
    </script>
</body>
</html>
