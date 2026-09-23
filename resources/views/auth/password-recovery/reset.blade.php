<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Password Baru - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('dashboard/assets') }}/images/icon.png" type="image/x-icon">
    <style>
        :root{--navy:#0a1d35;--navy2:#123a67;--blue:#2563eb;--text:#0f172a;--muted:#64748b;--line:#e2e8f0;--green:#10b981}
        *{box-sizing:border-box;margin:0;padding:0}body{min-height:100vh;min-height:100dvh;display:grid;place-items:center;padding:24px;font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif;color:var(--text);background:radial-gradient(circle at 15% 15%,rgba(59,130,246,.13),transparent 30%),linear-gradient(145deg,#f8fbff,#eaf2fb)}input,button{font:inherit}.card{width:min(470px,100%);padding:34px;border:1px solid rgba(255,255,255,.9);border-radius:24px;background:rgba(255,255,255,.97);box-shadow:0 28px 70px rgba(6,20,38,.14)}.logo{text-align:center;margin-bottom:24px}.logo img{width:min(260px,80%)}.badge{display:inline-flex;align-items:center;gap:8px;padding:7px 10px;border-radius:999px;background:#ecfdf5;color:#047857;font-size:11px;font-weight:800;margin-bottom:16px}.dot{width:7px;height:7px;border-radius:50%;background:var(--green)}h1{font-size:28px;letter-spacing:-.035em;margin-bottom:8px}.sub{color:var(--muted);font-size:13.5px;line-height:1.65;margin-bottom:24px}.nik{padding:12px 13px;border:1px solid #dbeafe;border-radius:12px;background:#f8fbff;font-size:12px;color:#475569;margin-bottom:20px}.nik strong{color:#0f172a}.field{margin-bottom:16px}.field label{display:block;font-size:12.5px;font-weight:750;color:#334155;margin-bottom:8px}.wrap{position:relative}.input{width:100%;height:52px;border:1px solid var(--line);border-radius:13px;padding:0 46px 0 14px;outline:none;font-size:16px}.input:focus{border-color:#3b82f6;box-shadow:0 0 0 4px rgba(59,130,246,.1)}.eye{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:36px;height:36px;border:0;border-radius:9px;background:transparent;color:#64748b;cursor:pointer}.eye:hover{background:#f1f5f9}.btn{width:100%;height:52px;border:0;border-radius:13px;background:linear-gradient(135deg,var(--navy),var(--navy2));color:#fff;font-weight:800;cursor:pointer;box-shadow:0 12px 24px rgba(10,29,53,.18);margin-top:6px}.errors{margin-bottom:18px;padding:13px 14px;border:1px solid #fecaca;border-radius:12px;background:#fff1f2;color:#b91c1c;font-size:12.5px;line-height:1.55}.hint{font-size:11.5px;color:#94a3b8;line-height:1.6;margin-top:14px}.back{display:block;text-align:center;color:#64748b;text-decoration:none;font-size:12.5px;font-weight:700;margin-top:22px}@media(max-width:560px){body{padding:0;background:#fff;display:block}.card{width:100%;min-height:100dvh;border:0;border-radius:0;box-shadow:none;padding:30px 22px}}
    </style>
</head>
<body>
<main class="card">
    <div class="logo"><img src="{{ asset('dashboard/assets') }}/images/logo-full.png" alt="PT. SIMS JAYA KALTIM"></div>
    <div class="badge"><span class="dot"></span> Identitas Terverifikasi</div>
    <h1>Buat Password Baru</h1>
    <p class="sub">Verifikasi NIK dan tanggal lahir berhasil. Buat password baru untuk akun {{ config('app.name') }}.</p>
    <div class="nik">Akun terverifikasi: <strong>{{ $nik }}</strong></div>

    @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="post" action="{{ route('password.recovery.manual.update') }}" autocomplete="off">
        @csrf
        <div class="field">
            <label for="password">Password Baru</label>
            <div class="wrap">
                <input class="input" id="password" type="password" name="password" autocomplete="new-password" placeholder="Minimal 8 karakter..." required>
                <button class="eye" type="button" data-eye="password" aria-label="Tampilkan password">◉</button>
            </div>
        </div>
        <div class="field">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="wrap">
                <input class="input" id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Ulangi password baru..." required>
                <button class="eye" type="button" data-eye="password_confirmation" aria-label="Tampilkan password">◉</button>
            </div>
        </div>
        <button class="btn" type="submit">Simpan Password Baru</button>
        <p class="hint">Password minimal 8 karakter dan harus mengandung huruf serta angka. Sesi verifikasi berlaku terbatas.</p>
    </form>
    <a class="back" href="{{ route('password.recovery') }}">← Ulangi verifikasi</a>
</main>
<script>
document.querySelectorAll('[data-eye]').forEach(btn=>btn.addEventListener('click',()=>{const el=document.getElementById(btn.dataset.eye);el.type=el.type==='password'?'text':'password';btn.setAttribute('aria-label',el.type==='password'?'Tampilkan password':'Sembunyikan password')}));
</script>
</body>
</html>
