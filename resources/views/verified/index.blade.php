
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Informasi Tanda Tangan Elektronik - {{ config('app.name') }}</title>

    <link rel="icon" href="{{ asset('dashboard/assets/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">

    <style>
        :root {
            --primary: #153b66;
            --primary-dark: #102d4e;
            --accent: #e8a838;
            --text: #243449;
            --muted: #758397;
            --border: #e5eaf0;
            --background: #f4f7fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--background);
            color: var(--text);
            font-family: "Segoe UI", Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .signature-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .signature-container {
            width: 100%;
            max-width: 620px;
        }

        .signature-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 38px rgba(22, 46, 75, 0.07);
        }

        .card-accent {
            height: 5px;
            background: linear-gradient(
                90deg,
                var(--primary-dark),
                var(--primary),
                var(--accent)
            );
        }

        .signature-content {
            padding: 38px 42px;
        }

        .company-header {
            text-align: center;
            padding-bottom: 28px;
            border-bottom: 1px solid var(--border);
        }

        .company-logo {
            width: 100%;
            max-width: 280px;
            height: auto;
            object-fit: contain;
        }

        .company-caption {
            margin-top: 15px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--muted);
            text-transform: uppercase;
        }

        .document-heading {
            text-align: center;
            padding: 30px 0 26px;
        }

        .signature-icon {
            width: 62px;
            height: 62px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 18px;
            border-radius: 18px;
            background: #edf3fa;
            color: var(--primary);
            font-size: 30px;
        }

        .document-title {
            margin: 0;
            font-size: 22px;
            font-weight: 750;
            line-height: 1.4;
            color: var(--primary-dark);
        }

        .document-subtitle {
            margin: 12px auto 0;
            max-width: 430px;
            font-size: 13px;
            line-height: 1.8;
            color: var(--muted);
        }

        .section-label {
            margin-bottom: 14px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.3px;
            color: var(--muted);
            text-transform: uppercase;
        }

        .identity-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }

        .identity-row {
            display: flex;
            padding: 17px 20px;
            gap: 16px;
            border-bottom: 1px solid var(--border);
        }

        .identity-row:last-child {
            border-bottom: none;
        }

        .identity-label {
            width: 115px;
            flex-shrink: 0;
            font-size: 13px;
            color: var(--muted);
        }

        .identity-value {
            flex: 1;
            min-width: 0;
            font-size: 13px;
            font-weight: 700;
            color: var(--primary-dark);
            text-align: right;
            text-transform: uppercase;
            overflow-wrap: anywhere;
        }

        .signature-notice {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            margin-top: 24px;
            padding: 18px;
            border: 1px solid #dce8f4;
            border-radius: 11px;
            background: #f4f8fc;
        }

        .notice-icon {
            flex-shrink: 0;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e3edf8;
            color: var(--primary);
            font-size: 19px;
        }

        .notice-title {
            margin: 0 0 6px;
            font-size: 13px;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .notice-description {
            margin: 0;
            font-size: 12px;
            line-height: 1.8;
            color: #617286;
        }

        .card-footer-custom {
            padding: 22px 42px;
            background: #fafbfd;
            border-top: 1px solid var(--border);
            text-align: center;
        }

        .footer-description {
            margin: 0;
            font-size: 11px;
            line-height: 1.8;
            color: var(--muted);
        }

        .page-footer {
            margin-top: 23px;
            text-align: center;
            font-size: 11px;
            color: #97a3b2;
        }

        .page-footer strong {
            color: #718096;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .signature-page {
                padding: 20px 12px;
                align-items: flex-start;
            }

            .signature-content {
                padding: 28px 22px;
            }

            .company-logo {
                max-width: 235px;
            }

            .document-title {
                font-size: 19px;
            }

            .document-subtitle {
                font-size: 12px;
            }

            .identity-row {
                padding: 15px;
                gap: 10px;
            }

            .identity-label {
                width: 85px;
                font-size: 12px;
            }

            .identity-value {
                font-size: 12px;
            }

            .card-footer-custom {
                padding: 20px;
            }
        }

        @media print {
            body {
                background: #fff;
            }

            .signature-page {
                min-height: auto;
                padding: 0;
            }

            .signature-card {
                box-shadow: none;
            }

            .page-footer {
                display: none;
            }
        }
    </style>
</head>

<body>

    <main class="signature-page">
        <div class="signature-container">

            <article class="signature-card">

                <div class="card-accent"></div>

                <div class="signature-content">

                    <!-- IDENTITAS PERUSAHAAN -->
                    <header class="company-header">

                        <img
                            src="{{ asset('dashboard/assets/images/logo-full.png') }}"
                            alt="PT SIMS Jaya Kaltim"
                            class="company-logo"
                        >

                        <div class="company-caption">
                            Electronic Signature Information
                        </div>

                    </header>

                    <!-- JUDUL DOKUMEN -->
                    <section class="document-heading">

                        <div class="signature-icon">
                            <i class="ti ti-signature"></i>
                        </div>

                        <h1 class="document-title">
                            Informasi Tanda Tangan Elektronik
                        </h1>

                        <p class="document-subtitle">
                            Halaman ini memuat informasi identitas
                            penandatangan elektronik yang tercatat
                            dalam sistem PT SIMS Jaya Kaltim.
                        </p>

                    </section>

                    <!-- IDENTITAS PENANDATANGAN -->
                    <section>

                        <div class="section-label">
                            Identitas Penandatangan
                        </div>

                        <div class="identity-card">

                            <div class="identity-row">
                                <span class="identity-label">
                                    Nama Lengkap
                                </span>

                                <span class="identity-value">
                                    {{ $user->name ?? '-' }}
                                </span>
                            </div>

                            <div class="identity-row">
                                <span class="identity-label">
                                    NIK
                                </span>

                                <span class="identity-value">
                                    {{ $user->nik ?? '-' }}
                                </span>
                            </div>

                            <div class="identity-row">
                                <span class="identity-label">
                                    Jabatan
                                </span>

                                <span class="identity-value">
                                    {{ $user->role ?? '-' }}
                                </span>
                            </div>

                        </div>

                    </section>

                    <!-- KETERANGAN TANDA TANGAN -->
                    <section class="signature-notice">

                        <div class="notice-icon">
                            <i class="ti ti-file-certificate"></i>
                        </div>

                        <div>

                            <h2 class="notice-title">
                                Keterangan Tanda Tangan Elektronik
                            </h2>

                            <p class="notice-description">
                                Identitas di atas merupakan data
                                penandatangan elektronik yang tercatat
                                dalam sistem PT SIMS Jaya Kaltim.
                                Informasi ini ditampilkan sebagai
                                referensi identitas penandatangan
                                pada dokumen terkait.
                            </p>

                        </div>

                    </section>

                </div>

                <!-- FOOTER CARD -->
                <footer class="card-footer-custom">

                    <p class="footer-description">
                        Informasi ini diterbitkan melalui sistem
                        informasi PT SIMS Jaya Kaltim sebagai bagian
                        dari dokumentasi tanda tangan elektronik.
                    </p>

                </footer>

            </article>

            <div class="page-footer">
                &copy; {{ date('Y') }}
                <strong>PT SIMS Jaya Kaltim</strong>
                <span> · Sistem Informasi Perusahaan</span>
            </div>

        </div>
    </main>

</body>
</html>
