<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Concert Tix')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#0c0b14;--panel:#171522;--panel2:#211d30;--purple:#a855f7;--muted:#aaa5ba}
        *{box-sizing:border-box} body{background:var(--bg);color:#f8f7fc;font-family:'DM Sans',sans-serif;min-height:100vh}
        h1,h2,h3,h4,h5,.navbar-brand{font-family:'Outfit',sans-serif}
        .navbar{background:rgba(15,13,24,.94);border-bottom:1px solid #282438}
        .navbar-brand{font-weight:800;letter-spacing:.5px}.brand-dot{color:#c084fc}
        .nav-link{color:#c8c3d5!important}.nav-link:hover{color:#fff!important}
        .muted{color:var(--muted)}.panel{background:var(--panel);border:1px solid #302a40;border-radius:20px}
        .btn-purple{background:linear-gradient(100deg,#9333ea,#c026d3);color:#fff;border:0;font-weight:700;border-radius:12px;padding:11px 18px}
        .btn-purple:hover{color:#fff;filter:brightness(1.12)}.btn-outline-soft{border:1px solid #514765;color:#eee;border-radius:12px}
        .btn-outline-soft:hover{background:#292238;color:white}.hero{border-radius:24px;overflow:hidden;min-height:340px;display:flex;align-items:end;background-size:cover;background-position:center;position:relative}
        .hero:before{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(9,7,17,.94),rgba(9,7,17,.15)),linear-gradient(0deg,rgba(9,7,17,.55),transparent)}
        .hero-content{position:relative;padding:clamp(24px,5vw,56px);max-width:680px}
        .event-card{overflow:hidden;transition:.2s}.event-card:hover{transform:translateY(-4px);border-color:#7651a5}
        .event-img{height:205px;object-fit:cover;width:100%}.price{color:#d8a7ff}.pill{background:#30213f;color:#e4c8ff;border:1px solid #593b72;padding:6px 11px;border-radius:99px;font-size:.78rem}
        .form-control,.form-select{background:#211d30;border:1px solid #413852;color:white;border-radius:11px;padding:12px}
        .form-control:focus,.form-select:focus{background:#211d30;color:white;border-color:#a855f7;box-shadow:0 0 0 .2rem #a855f733}
        .form-control::placeholder{color:#898298}.seat{width:58px;height:42px;border:1px solid #615873;background:#211d30;color:#eee;border-radius:9px;font-size:.8rem}
        .seat.selected{background:#16a36a;border-color:#16a36a;color:white}.seat:disabled{opacity:.35}
        .stage{background:linear-gradient(90deg,#6b21a8,#c026d3);padding:10px;border-radius:10px;text-align:center;letter-spacing:4px;font-weight:700}
        .step{width:30px;height:30px;border-radius:50%;display:inline-grid;place-items:center;background:#39294c;color:#d8b4fe;font-weight:700}
        .ticket-cut{border-top:1px dashed #615873;margin:22px 0}
        @media print{body{background:white;color:#111}.no-print,nav{display:none!important}.panel{background:white;color:#111;border:1px solid #ddd}.muted{color:#555}}
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container py-2">
        <a class="navbar-brand" href="{{ route('home') }}">CONCERT<span class="brand-dot">TIX.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="nav">
            <div class="navbar-nav ms-auto gap-lg-3">
                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                <a class="nav-link" href="{{ route('home') }}#events">Jelajahi Konser</a>
            </div>
        </div>
    </div>
</nav>
<main class="container py-4 py-lg-5">@yield('content')</main>
<footer class="container py-4 muted small text-center no-print">© 2026 ConcertTix · Demo antarmuka pemesanan tiket</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
