<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('dashboard/assets') }}/images/icon.png" type="image/x-icon">
    <style>
        :root{--navy:#0a1d35;--navy2:#123a67;--blue:#2563eb;--green:#10b981;--text:#0f172a;--muted:#64748b;--line:#e2e8f0;--soft:#f8fafc;--white:#fff;--danger:#dc2626}
        *{box-sizing:border-box;margin:0;padding:0}body{min-height:100vh;min-height:100dvh;font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif;color:var(--text);background:radial-gradient(circle at 10% 15%,rgba(59,130,246,.13),transparent 28%),radial-gradient(circle at 88% 85%,rgba(34,211,238,.10),transparent 26%),linear-gradient(145deg,#f8fbff,#eaf2fb);padding:28px}
        button,input{font:inherit}.shell{width:min(980px,100%);margin:auto;min-height:calc(100vh - 56px);display:flex;align-items:center;justify-content:center}.card{width:100%;display:grid;grid-template-columns:.8fr 1.2fr;overflow:hidden;border:1px solid rgba(255,255,255,.9);border-radius:28px;background:rgba(255,255,255,.94);box-shadow:0 28px 70px rgba(6,20,38,.16)}
        .side{position:relative;padding:46px;color:#fff;background:radial-gradient(circle at 85% 10%,rgba(59,130,246,.32),transparent 34%),linear-gradient(145deg,#061426,#0a1d35 60%,#0c2d50);display:flex;flex-direction:column;justify-content:space-between;min-height:650px}.logo{display:inline-flex;background:#fff;padding:10px 14px;border-radius:14px;max-width:270px}.logo img{display:block;width:100%;height:auto}.side h1{font-size:38px;line-height:1.08;letter-spacing:-.04em;margin-bottom:16px}.side p{color:rgba(226,232,240,.78);font-size:14px;line-height:1.75}.pill{display:inline-flex;width:max-content;align-items:center;gap:8px;padding:8px 11px;border:1px solid rgba(147,197,253,.22);border-radius:999px;color:#bfdbfe;background:rgba(59,130,246,.1);font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:20px}.dot{width:7px;height:7px;border-radius:50%;background:var(--green);box-shadow:0 0 0 5px rgba(16,185,129,.12)}.side-foot{font-size:11px;color:rgba(203,213,225,.55)}
        .content{padding:46px 48px}.back{display:inline-flex;align-items:center;gap:7px;color:var(--muted);text-decoration:none;font-size:13px;font-weight:700;margin-bottom:28px}.back:hover{color:var(--blue)}.title{font-size:30px;letter-spacing:-.035em;margin-bottom:8px}.subtitle{font-size:14px;color:var(--muted);line-height:1.7;margin-bottom:26px}
        .tabs{display:grid;grid-template-columns:1fr 1fr;padding:5px;background:#f1f5f9;border-radius:14px;margin-bottom:24px}.tab{border:0;background:transparent;padding:11px 12px;border-radius:10px;color:#64748b;font-weight:750;font-size:13px;cursor:pointer}.tab.active{background:#fff;color:#0f172a;box-shadow:0 3px 10px rgba(15,23,42,.07)}.panel{display:none}.panel.active{display:block}.option-head{display:flex;gap:13px;align-items:flex-start;padding:16px;border:1px solid #e6edf6;border-radius:15px;background:#f9fbfe;margin-bottom:20px}.ico{width:42px;height:42px;flex:0 0 42px;display:grid;place-items:center;border-radius:12px;background:#e8f1ff;color:var(--blue);font-size:20px}.option-head strong{display:block;font-size:14px;margin-bottom:4px}.option-head span{display:block;font-size:12.5px;color:var(--muted);line-height:1.55}
        .field{margin-bottom:16px}.field label{display:block;font-size:12.5px;font-weight:750;color:#334155;margin-bottom:8px}.input{width:100%;height:52px;border:1px solid var(--line);border-radius:13px;padding:0 15px;background:#fff;color:var(--text);outline:none;font-size:16px;transition:.18s}.input:focus{border-color:#3b82f6;box-shadow:0 0 0 4px rgba(59,130,246,.1)}.btn{width:100%;height:52px;border:0;border-radius:13px;background:linear-gradient(135deg,var(--navy),var(--navy2));color:#fff;font-weight:800;cursor:pointer;box-shadow:0 12px 24px rgba(10,29,53,.18);margin-top:6px}.btn:hover{filter:brightness(1.05)}.errors{margin-bottom:18px;padding:13px 14px;border:1px solid #fecaca;border-radius:12px;background:#fff1f2;color:#b91c1c;font-size:12.5px;line-height:1.55}.note{margin-top:20px;color:#64748b;font-size:11.5px;line-height:1.6;text-align:center}.footer{text-align:center;color:#94a3b8;font-size:11px;margin-top:26px}.footer strong{color:#64748b}
        @media(max-width:820px){body{padding:0;background:#fff}.shell{min-height:100dvh}.card{display:block;border:0;border-radius:0;box-shadow:none}.side{display:none}.content{padding:28px 22px 24px;max-width:520px;margin:auto}.tabs{grid-template-columns:1fr}.tab{padding:12px}.title{font-size:28px}.footer{padding-bottom:env(safe-area-inset-bottom,0)}}
    </style>
</head>
<body>
<div class="shell">
    <section class="card">
        <aside class="side">
            <div class="logo"><img src="{{ asset('dashboard/assets') }}/images/logo-full.png" alt="PT. SIMS JAYA KALTIM"></div>
            <div>
                <div class="pill"><span class="dot"></span> Account Recovery</div>
                <h1>Pulihkan akses akun dengan aman.</h1>
                <p>Pilih sinkronisasi password dari SATU SIMS atau verifikasi identitas menggunakan NIK, No. KTP dan tanggal lahir.</p>
            </div>
            <div class="side-foot">Powered by SATU SIMS</div>
        </aside>

        <main class="content">
            <a class="back" href="{{ route(config('password_recovery.login_route', 'login')) }}">← Kembali ke login</a>
            <h2 class="title">Reset Password</h2>
            <p class="subtitle">Pilih metode pemulihan akun yang akan digunakan.</p>

            @if ($errors->any())
                <div class="errors">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="tabs">
                <button type="button" class="tab active" data-tab="satu">Ikuti Password SATU SIMS</button>
                <button type="button" class="tab" data-tab="manual">Reset Manual</button>
            </div>

            <section class="panel active" id="panel-satu">
                <div class="option-head">
                    <div class="ico">↻</div>
                    <div>
                        <strong>Samakan dengan SATU SIMS</strong>
                        <span>Masukkan NIK dan password SATU SIMS. Setelah terverifikasi, password {{ config('app.name') }} akan dibuat sama.</span>
                    </div>
                </div>
                <form method="post" action="{{ route('password.recovery.satu-sims') }}" autocomplete="off">
                    @csrf
                    <div class="field">
                        <label for="satu_nik">NIK</label>
                        <input class="input" id="satu_nik" type="text" name="nik" maxlength="50" placeholder="Masukkan NIK..." autocomplete="username" oninput="this.value=this.value.toUpperCase()" required>
                    </div>
                    <div class="field">
                        <label for="satu_password">Password SATU SIMS</label>
                        <input class="input" id="satu_password" type="password" name="satu_sims_password" maxlength="255" placeholder="Masukkan password SATU SIMS..." autocomplete="current-password" required>
                    </div>
                    <button class="btn" type="submit">Verifikasi & Samakan Password</button>
                </form>
            </section>

            <section class="panel" id="panel-manual">
                <div class="option-head">
                    <div class="ico">✓</div>
                    <div>
                        <strong>Verifikasi Identitas Karyawan</strong>
                        <span>Masukkan NIK, No. KTP, dan tanggal lahir. Ketiganya harus cocok pada data HR sebelum Anda dapat membuat password baru.</span>
                    </div>
                </div>

                <form method="post" action="{{ route('password.recovery.manual.verify') }}" autocomplete="off">
                    @csrf

                    <div class="field">
                        <label for="manual_nik">NIK</label>
                        <input
                            class="input"
                            id="manual_nik"
                            type="text"
                            name="nik"
                            value="{{ old('nik') }}"
                            maxlength="50"
                            placeholder="Masukkan NIK..."
                            autocomplete="username"
                            oninput="this.value=this.value.toUpperCase()"
                            required
                        >
                    </div>

                    <div class="field">
                        <label for="no_ktp">No. KTP</label>
                        <input
                            class="input"
                            id="no_ktp"
                            type="text"
                            name="no_ktp"
                            value="{{ old('no_ktp') }}"
                            maxlength="30"
                            inputmode="numeric"
                            placeholder="Masukkan No. KTP..."
                            autocomplete="off"
                            required
                        >
                    </div>

                    <div class="field">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input
                            class="input"
                            id="tanggal_lahir"
                            type="date"
                            name="tanggal_lahir"
                            value=""
                            autocomplete="bday"
                            required
                        >
                    </div>

                    <button class="btn" type="submit">
                        Verifikasi Identitas
                    </button>
                </form>
            </section>

            <p class="note">Untuk keamanan, percobaan verifikasi dibatasi dan data password tidak pernah ditampilkan kembali.</p>
            <div class="footer">© 2024 <strong>IT - PT. SIMS JAYA KALTIM</strong></div>
        </main>
    </section>
</div>
<script>
(() => {
    const tabs = document.querySelectorAll('[data-tab]');
    const panels = document.querySelectorAll('.panel');
    const open = (name) => {
        tabs.forEach(t => t.classList.toggle('active', t.dataset.tab === name));
        panels.forEach(p => p.classList.toggle('active', p.id === 'panel-' + name));
    };
    tabs.forEach(t => t.addEventListener('click', () => open(t.dataset.tab)));
    @if($errors->has('identity')) open('manual'); @endif
})();
</script>
</body>
</html>
