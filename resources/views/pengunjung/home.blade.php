<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Berkah Alam Tabantang – Engineering Excellence</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy:      #0e1b2e;
            --navy-mid:  #162337;
            --blue:      #1d5fc4;
            --blue-lt:   #2f7aef;
            --gold:      #f0a500;
            --offwhite:  #f5f4f0;
            --mid-gray:  #6b7280;
            --lt-gray:   #e8e8e3;
            --radius-sm: 4px;
            --radius-md: 10px;
            --radius-lg: 18px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fff;
            color: var(--navy);
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Barlow Condensed', sans-serif;
            letter-spacing: -0.01em;
        }

        /* ── NAVBAR ── */
        .navbar-custom {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid var(--lt-gray);
            transition: box-shadow .3s;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--navy);
            text-decoration: none;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: var(--mid-gray);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-links a:hover,
        .nav-links a.active { color: var(--navy); }

        .nav-links a.active {
            color: var(--gold);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 2px;
        }

        .nav-search-btn {
            background: none;
            border: none;
            color: var(--mid-gray);
            font-size: 18px;
            cursor: pointer;
            padding: 4px 8px;
            transition: color .2s;
        }
        .nav-search-btn:hover { color: var(--navy); }

        /* ── HERO ── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: var(--navy);
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background: url('/background.png') center/cover no-repeat;
            opacity: 0.35;
            filter: grayscale(20%);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(110deg, rgba(14,27,46,.95) 40%, rgba(14,27,46,.5) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 640px;
            padding: 0 48px;
            animation: fadeSlideUp .9s ease both;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(240,165,0,0.15);
            border: 1px solid rgba(240,165,0,.4);
            border-radius: 100px;
            padding: 5px 14px;
            font-size: 11px;
            font-weight: 600;
            color: var(--gold);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .hero h1 {
            font-size: clamp(48px, 7vw, 82px);
            font-weight: 800;
            color: #fff;
            line-height: 1;
            margin-bottom: 24px;
        }

        .hero h1 span { color: var(--gold); }

        .hero-desc {
            font-size: 17px;
            line-height: 1.7;
            color: rgba(255,255,255,0.7);
            max-width: 480px;
            margin-bottom: 40px;
        }

        .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }

        .btn-primary-custom {
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, transform .15s;
        }
        .btn-primary-custom:hover { background: var(--blue-lt); color: #fff; transform: translateY(-2px); }

        .btn-outline-custom {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.4);
            border-radius: 8px;
            padding: 13px 28px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: border-color .2s, background .2s;
        }
        .btn-outline-custom:hover { border-color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.06); color: #fff; }

        /* ── CERT STRIP ── */
        .cert-strip {
            background: var(--offwhite);
            border-bottom: 1px solid var(--lt-gray);
            padding: 22px 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cert-strip-label {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--mid-gray);
            font-weight: 600;
            margin-right: 40px;
        }

        .cert-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 28px;
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            border-right: 1px solid var(--lt-gray);
        }
        .cert-item:last-child { border-right: none; }
        .cert-item i { font-size: 18px; color: var(--blue); }

        /* ── SECTION COMMONS ── */
        section { padding: 96px 48px; }

        .section-eyebrow {
            font-size: 11px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--blue);
            font-weight: 600;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 800;
            color: var(--navy);
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .section-subtitle {
            font-size: 16px;
            color: var(--mid-gray);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 56px;
        }

        /* ── SEJARAH ── */
        .sejarah-section {
            background: #fff;
            padding: 96px 48px;
            border-bottom: 1px solid var(--lt-gray);
        }

        .sejarah-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 80px;
            align-items: start;
        }

        .sejarah-left {
            position: sticky;
            top: 100px;
        }

        .sejarah-left-border {
            border-left: 4px solid var(--blue);
            padding-left: 20px;
        }

        .sejarah-left h2 {
            font-size: 42px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1;
        }

        .sejarah-right h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .sejarah-right p {
            font-size: 15px;
            line-height: 1.85;
            color: var(--mid-gray);
            margin-bottom: 16px;
        }

        .sejarah-right p:last-child { margin-bottom: 0; }

        /* ── VISI MISI ── */
        .visi-misi-section {
            background: var(--navy);
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .visi-misi-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('/background.png') center/cover no-repeat;
            opacity: 0.08;
        }

        .visi-misi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
            z-index: 1;
        }

        .visi-card {
            padding: 64px 56px;
            border-right: 1px solid rgba(255,255,255,0.08);
        }

        .misi-card {
            padding: 64px 56px;
        }

        .vm-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .visi-card .vm-icon {
            background: rgba(29,95,196,0.2);
            color: #60a5fa;
        }

        .misi-card .vm-icon {
            background: rgba(240,165,0,0.15);
            color: var(--gold);
        }

        .vm-title {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 16px;
        }

        .vm-text {
            font-size: 15px;
            line-height: 1.85;
            color: rgba(255,255,255,0.6);
        }

        .misi-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .misi-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 15px;
            line-height: 1.7;
            color: rgba(255,255,255,0.65);
        }

        .misi-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
            margin-top: 8px;
        }

        /* ── PROYEK ── */
        .proyek-section { background: #fff; }

        .proyek-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 48px;
        }

        .proyek-header .text-part { max-width: 560px; }
        .proyek-header .section-subtitle { margin-bottom: 0; }

        .proyek-nav-btns { display: flex; gap: 10px; }

        .nav-btn {
            width: 44px; height: 44px;
            border: 1.5px solid var(--lt-gray);
            border-radius: 50%;
            background: #fff;
            color: var(--navy);
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s;
        }
        .nav-btn:hover { background: var(--navy); color: #fff; border-color: var(--navy); }

        .proyek-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .proyek-card {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            aspect-ratio: 4/3;
            background: var(--navy-mid);
            cursor: pointer;
        }

        .proyek-card img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }
        .proyek-card:hover img { transform: scale(1.06); }

        .proyek-card-no-img {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%);
        }
        .proyek-card-no-img i { font-size: 48px; color: rgba(255,255,255,0.3); }

        .proyek-card-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(180deg, transparent 40%, rgba(10,20,40,.92) 100%);
        }

        .proyek-card-body {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 24px;
            color: #fff;
        }

        .proyek-badge {
            display: inline-block;
            background: var(--blue);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 4px;
            padding: 3px 8px;
            margin-bottom: 8px;
        }

        .proyek-card-title { font-size: 20px; font-weight: 700; margin-bottom: 4px; line-height: 1.2; }

        .proyek-card-meta {
            font-size: 12px;
            color: rgba(255,255,255,0.65);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .proyek-card-meta span { display: flex; align-items: center; gap: 4px; }

        .proyek-card-link {
            position: absolute;
            top: 16px; right: 16px;
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 14px;
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity .2s;
        }
        .proyek-card:hover .proyek-card-link { opacity: 1; }

        .proyek-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 0;
            color: var(--mid-gray);
        }
        .proyek-empty i { font-size: 56px; display: block; margin-bottom: 16px; opacity: .35; }

        /* ── LAYANAN ── */
        .layanan-section { background: var(--offwhite); }

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
        }

        .layanan-card {
            background: #fff;
            border-radius: var(--radius-md);
            padding: 36px 28px;
            border: 1px solid var(--lt-gray);
            transition: box-shadow .25s, transform .25s;
        }
        .layanan-card:hover { box-shadow: 0 12px 40px rgba(14,27,46,.1); transform: translateY(-4px); }

        .layanan-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            background: rgba(29,95,196,.1);
            display: flex; align-items: center; justify-content: center;
            color: var(--blue);
            font-size: 22px;
            margin-bottom: 20px;
        }

        .layanan-name { font-size: 20px; font-weight: 700; color: var(--navy); margin-bottom: 10px; }
        .layanan-desc { font-size: 14px; color: var(--mid-gray); line-height: 1.7; }
        .layanan-empty { grid-column: 1 / -1; text-align: center; padding: 60px 0; color: var(--mid-gray); }

        /* ── REVIEW ── */
        .review-section { background: #fff; }

        .review-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 56px;
        }

        .review-header a {
            font-size: 13px;
            font-weight: 600;
            color: var(--blue);
            text-decoration: none;
            border-bottom: 1.5px solid var(--blue);
            padding-bottom: 1px;
        }

        .review-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            align-items: start;
        }

        .review-card {
            background: var(--offwhite);
            border-radius: var(--radius-md);
            padding: 32px;
            border: 1px solid var(--lt-gray);
        }

        .review-stars { color: var(--gold); font-size: 14px; margin-bottom: 16px; display: flex; gap: 3px; }

        .review-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--blue);
            margin-bottom: 12px;
        }

        .review-text { font-size: 16px; line-height: 1.75; color: var(--navy); font-style: italic; margin-bottom: 24px; }
        .reviewer-name { font-size: 13px; font-weight: 700; color: var(--navy); text-transform: uppercase; letter-spacing: 0.5px; }
        .reviewer-role { font-size: 11px; color: var(--mid-gray); letter-spacing: 0.3px; margin-top: 2px; }

        .review-big-card {
            background: var(--navy);
            color: #fff;
            border-radius: var(--radius-lg);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 340px;
            position: relative;
            overflow: hidden;
        }

        .review-big-card::before {
            content: '';
            position: absolute; inset: 0;
            background: url('/Image.png') center/cover no-repeat;
            opacity: 0.18;
        }

        .review-counter { position: absolute; bottom: 32px; left: 40px; z-index: 2; }

        .counter-number {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 56px;
            font-weight: 800;
            color: var(--gold);
            line-height: 1;
        }

        .counter-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            margin-top: 4px;
        }

        /* ── FAQ ── */
        .faq-section { background: var(--offwhite); }

        .faq-layout {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 80px;
            align-items: start;
        }

        .faq-left { position: sticky; top: 100px; }

        .accordion-custom .accordion-item {
            background: #fff;
            border: 1px solid var(--lt-gray);
            border-radius: var(--radius-md) !important;
            margin-bottom: 12px;
            overflow: hidden;
        }

        .accordion-custom .accordion-button {
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: var(--navy);
            background: #fff;
            padding: 20px 24px;
            box-shadow: none;
            border-radius: var(--radius-md) !important;
        }

        .accordion-custom .accordion-button:not(.collapsed) {
            color: var(--blue);
            background: rgba(29,95,196,.04);
        }

        .accordion-custom .accordion-body {
            font-size: 14px;
            line-height: 1.8;
            color: var(--mid-gray);
            padding: 0 24px 24px;
        }

        .faq-empty { text-align: center; padding: 60px 0; color: var(--mid-gray); }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            color: rgba(255,255,255,0.65);
            padding: 72px 48px 32px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 48px;
            margin-bottom: 56px;
        }

        .footer-brand {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        .footer-brand span { color: var(--gold); }

        .footer-desc { font-size: 14px; line-height: 1.8; color: rgba(255,255,255,0.5); margin-bottom: 24px; }

        .footer-social { display: flex; gap: 12px; }

        .social-btn {
            width: 36px; height: 36px;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.5);
            font-size: 15px;
            text-decoration: none;
            transition: all .2s;
        }
        .social-btn:hover { border-color: var(--gold); color: var(--gold); }

        .footer-heading {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.85);
            margin-bottom: 20px;
        }

        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px; transition: color .2s; }
        .footer-links a:hover { color: #fff; }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
        }
        .footer-contact-item i { color: var(--blue); font-size: 16px; margin-top: 2px; flex-shrink: 0; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }

        .footer-bottom-links { display: flex; gap: 24px; }
        .footer-bottom-links a { color: rgba(255,255,255,0.4); text-decoration: none; font-size: 13px; }

        /* ── ANIMATIONS ── */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s ease, transform .6s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ── */
        @media (max-width: 992px) {
            section { padding: 64px 24px; }
            .navbar-custom { padding: 0 24px; }
            .cert-strip { padding: 18px 24px; }
            .cert-item { padding: 6px 14px; font-size: 12px; }
            .proyek-grid { grid-template-columns: 1fr 1fr; }
            .review-grid { grid-template-columns: 1fr; }
            .faq-layout { grid-template-columns: 1fr; gap: 40px; }
            .faq-left { position: static; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
            .proyek-header { flex-direction: column; gap: 20px; align-items: flex-start; }
            .sejarah-layout { grid-template-columns: 1fr; gap: 32px; }
            .sejarah-left { position: static; }
            .visi-misi-grid { grid-template-columns: 1fr; }
            .visi-card { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
        }

        @media (max-width: 576px) {
            .hero-content { padding: 0 24px; }
            .proyek-grid { grid-template-columns: 1fr; }
            .layanan-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar-custom" id="mainNav">
        <a href="{{ route('homepage') }}" class="nav-brand">
            <img src="{{ asset('logo.png') }}" alt="PT BAT" style="height: 36px; width: auto;">
            PT BAT
        </a>
        <ul class="nav-links">
            <li><a href="#beranda" class="active">Beranda</a></li>
            <li><a href="{{ route('pengunjung.proyekvisit') }}">Proyek</a></li>
            <li><a href="#layanan">Layanan</a></li>
            <li><a href="#sejarah">Sejarah</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="{{ route('pengunjung.faqvisit') }}">FAQ</a></li>
        </ul>
        <button class="nav-search-btn"><i class="bi bi-search"></i></button>
    </nav>

    {{-- HERO --}}
    <section class="hero" id="beranda">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-badge">
                <i class="bi bi-award-fill"></i>
                Industry Leader Since 1998
            </div>
            <h1>Engineering <span>Excellence</span> into Every Beam.</h1>
            <p class="hero-desc">
                Dari infrastruktur kompleks hingga ruang komersial premium, kami menghadirkan
                presisi, keamanan, dan inovasi di setiap proyek.
            </p>
            <div class="hero-actions">
                <a href="#proyek" class="btn-primary-custom">
                    Lihat Portfolio <i class="bi bi-arrow-right"></i>
                </a>
                <a href="#layanan" class="btn-outline-custom">Layanan Kami</a>
            </div>
        </div>
    </section>

    {{-- CERT STRIP --}}
    @if($sertifikat->count() > 0)
    <div class="cert-strip">
        <span class="cert-strip-label">Diakui oleh</span>
        @foreach($sertifikat as $sert)
        <div class="cert-item">
            <i class="bi {{ $sert->icon ?? 'bi-patch-check' }}"></i>
            {{ $sert->sertifikat }}
        </div>
        @endforeach
    </div>
    @else
    <div class="cert-strip">
        <span class="cert-strip-label">Diakui oleh Lembaga Industri</span>
        <div class="cert-item"><i class="bi bi-patch-check"></i> ISO 9001</div>
        <div class="cert-item"><i class="bi bi-shield-check"></i> LEED GOLD</div>
        <div class="cert-item"><i class="bi bi-award"></i> OSHA Certified</div>
        <div class="cert-item"><i class="bi bi-building"></i> AIA Member</div>
        <div class="cert-item"><i class="bi bi-hammer"></i> AGC Build</div>
    </div>
    @endif

    {{-- SEJARAH --}}
    <section class="sejarah-section" id="sejarah">
        <div class="sejarah-layout reveal">
            <div class="sejarah-left">
                <div class="sejarah-left-border">
                    <p class="section-eyebrow">Tentang Kami</p>
                    <h2 class="section-title">Sejarah Kami</h2>
                </div>
            </div>
            <div class="sejarah-right">
                @if(isset($profil) && $profil)
                    <h3>{{ $profil->nama_perusahaan }}</h3>
                    @if($profil->sejarah)
                        @foreach(explode("\n", $profil->sejarah) as $paragraph)
                            @if(trim($paragraph))
                            <p>{{ trim($paragraph) }}</p>
                            @endif
                        @endforeach
                    @endif
                @else
                    <h3>Established at the intersection of demand and expertise, PT BAT began as a specialized structural masonry firm in East Coast hubs.</h3>
                    <p>Founded in 1998, our journey started with a single crane and a commitment to unwavering quality. Over three decades, we have evolved from a regional contractor into a national industrial powerhouse, delivering over 450 major infrastructure projects across the globe.</p>
                    <p>Our growth has been defined by technological adoption. In 2005, we were among the first to implement BIM (Building Information Modeling) at scale, a move that solidified our reputation for surgical precision in high-risk environments.</p>
                    <p>Today, PT BAT is synonymous with industrial durability. We don't just build structures; we build the foundations of modern commerce, from automated distribution centers to complex hydroelectric facilities.</p>
                @endif
            </div>
        </div>
    </section>

    {{-- VISI MISI --}}
    <div class="visi-misi-section">
        <div class="visi-misi-grid">
            <div class="visi-card reveal">
                <div class="vm-icon"><i class="bi bi-eye"></i></div>
                <div class="vm-title">Visi</div>
                @if(isset($profil) && $profil && $profil->visi)
                    <p class="vm-text">{{ $profil->visi }}</p>
                @else
                    <p class="vm-text">Menjadi tolok ukur global untuk integritas struktural dan inovasi teknik, mengubah lanskap industri melalui metodologi bangunan yang berkelanjutan dan berbasis presisi.</p>
                @endif
            </div>
            <div class="misi-card reveal">
                <div class="vm-icon"><i class="bi bi-check2-circle"></i></div>
                <div class="vm-title">Misi</div>
                @if(isset($profil) && $profil && $profil->misi)
                    <ul class="misi-list">
                        @foreach(explode("\n", $profil->misi) as $item)
                            @if(trim($item))
                            <li>
                                <span class="misi-dot"></span>
                                <span>{{ trim($item) }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <ul class="misi-list">
                        <li><span class="misi-dot"></span><span>Menghasilkan konstruksi berkualitas tanpa kompromi melalui standar keselamatan yang ketat.</span></li>
                        <li><span class="misi-dot"></span><span>Mengintegrasikan teknologi mutakhir (BIM/AI) ke dalam siklus hidup proyek.</span></li>
                        <li><span class="misi-dot"></span><span>Membangun kemitraan jangka panjang yang didasarkan pada transparansi dan hasil yang terukur.</span></li>
                    </ul>
                @endif
            </div>
        </div>
    </div>

    {{-- PROYEK --}}
    <section class="proyek-section" id="proyek">
        <div class="proyek-header reveal">
            <div class="text-part">
                <p class="section-eyebrow">Portfolio Kami</p>
                <h2 class="section-title">Warisan Pondasi yang Kuat</h2>
                <p class="section-subtitle">
                    Lebih dari 25 tahun pengalaman mengerjakan proyek berdampak tinggi di sektor
                    residensial, komersial, dan infrastruktur.
                </p>
            </div>
            <div class="proyek-nav-btns">
                <button class="nav-btn" id="prevBtn"><i class="bi bi-chevron-left"></i></button>
                <button class="nav-btn" id="nextBtn"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

        <div class="proyek-grid" id="proyekGrid">
            @forelse($proyeks as $proyek)
            <div class="proyek-card reveal">
                @if($proyek->thumbnail)
                    <img src="{{ asset('storage/' . $proyek->thumbnail->dokumentasi) }}" alt="{{ $proyek->nama_proyek }}" loading="lazy">
                @else
                    <div class="proyek-card-no-img"><i class="bi bi-building"></i></div>
                @endif
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge">
                        {{ $proyek->tanggal ? 'Selesai ' . \Carbon\Carbon::parse($proyek->tanggal)->year : 'Proyek' }}
                    </span>
                    <div class="proyek-card-title">{{ $proyek->nama_proyek }}</div>
                    <div class="proyek-card-meta">
                        @if($proyek->lokasi)
                        <span><i class="bi bi-geo-alt"></i> {{ $proyek->lokasi }}</span>
                        @endif
                        @if($proyek->deskripsi)
                        <span>{{ Str::limit($proyek->deskripsi, 40) }}</span>
                        @endif
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>
            @empty
            <div class="proyek-empty">
                <i class="bi bi-building"></i>
                <p>Belum ada proyek yang ditampilkan.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- LAYANAN --}}
    <section class="layanan-section" id="layanan">
        <div class="text-center mb-5 reveal">
            <p class="section-eyebrow">Apa yang Kami Tawarkan</p>
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle mx-auto">
                Solusi konstruksi komprehensif yang dirancang untuk memenuhi tuntutan arsitektur dan infrastruktur modern.
            </p>
        </div>
        <div class="layanan-grid">
            @forelse($layanans as $layanan)
            <div class="layanan-card reveal">
                <div class="layanan-icon"><i class="bi {{ $layanan->icon ?? 'bi-gear' }}"></i></div>
                <div class="layanan-name">{{ $layanan->nama_layanan }}</div>
                @if($layanan->deskripsi)
                <p class="layanan-desc">{{ $layanan->deskripsi }}</p>
                @endif
            </div>
            @empty
            <div class="layanan-empty">
                <i class="bi bi-layers" style="font-size:48px;display:block;margin-bottom:12px;opacity:.35;"></i>
                <p>Belum ada layanan yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </section>

    {{-- REVIEW --}}
    <section class="review-section">
        <div class="review-header reveal">
            <div>
                <p class="section-eyebrow">Kepuasan Klien</p>
                <h2 class="section-title">Apa Kata Klien Kami</h2>
                <p class="section-subtitle" style="margin-bottom:0">
                    Umpan balik jujur dari mitra yang telah kami bangun masa depannya di sektor industri berat dan komersial.
                </p>
            </div>
            <a href="#">SEE FULL REVIEW</a>
        </div>
        <div class="review-grid">
            <div class="review-card reveal">
                <div class="review-stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <p class="review-text">"Presisi dan integritas struktural yang ditunjukkan selama ekspansi Fasilitas Petrokimia melampaui standar industri. PT BAT adalah pilihan pertama kami untuk proyek berisiko tinggi."</p>
                <div class="reviewer-name">Anders Magnusson</div>
                <div class="reviewer-role">Director of Operations, Nordic Energy</div>
            </div>
            <div>
                <div class="review-card reveal" style="margin-bottom:24px;">
                    <div class="review-label">Safety Protocol Excellence</div>
                    <p class="review-text">"Komitmen mereka terhadap protokol keselamatan Zero-Harm bukan sekadar omong kosong. Kami menyaksikannya setiap hari di proyek pencakar langit."</p>
                    <div class="reviewer-name">Sarah Jenkins</div>
                    <div class="reviewer-role">Compliance Lead, Metrobuild II</div>
                </div>
            </div>
            <div class="review-card reveal">
                <div class="review-stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
                <p class="review-text">"Menyelesaikan proyek jembatan 3 minggu lebih awal dari jadwal tanpa mengorbankan satu milimeter pun presisinya."</p>
                <div class="reviewer-name">David Chen</div>
                <div class="reviewer-role">Principal Engineer</div>
            </div>
            <div class="review-big-card reveal">
                <div></div>
                <div class="review-counter">
                    <div class="counter-number">200+</div>
                    <div class="counter-label">Projects Completed</div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    @if($faqs->count() > 0)
    <section class="faq-section" id="faq">
        <div class="faq-layout">
            <div class="faq-left reveal">
                <p class="section-eyebrow">FAQ</p>
                <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                <p class="section-subtitle" style="margin-bottom:0">
                    Temukan jawaban atas pertanyaan umum tentang layanan dan proses kerja kami.
                </p>
            </div>
            <div class="reveal">
                <div class="accordion accordion-custom" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button
                                class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faqItem{{ $faq->id_faq }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                            >{{ $faq->pertanyaan }}</button>
                        </h2>
                        <div id="faqItem{{ $faq->id_faq }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">{{ $faq->jawaban }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- FOOTER --}}
    <footer id="kontak">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">PT <span>BAT</span></div>
                <p class="footer-desc">Memimpin industri konstruksi dengan inovasi dan integritas tanpa mengorbankan kualitas. Kami spesialis di bidang infrastruktur publik, komersial, dan residensial.</p>
                <div class="footer-social">
                    <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            <div>
                <div class="footer-heading">Quick Links</div>
                <ul class="footer-links">
                    <li><a href="#proyek">Proyek Kami</a></li>
                    <li><a href="#layanan">Layanan Konstruksi</a></li>
                    <li><a href="#sejarah">Sejarah Perusahaan</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#">Karir</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">Layanan Kami</div>
                <ul class="footer-links">
                    @forelse($layanans->take(5) as $layanan)
                    <li><a href="#layanan">{{ $layanan->nama_layanan }}</a></li>
                    @empty
                    <li><a href="#layanan">General Contracting</a></li>
                    <li><a href="#layanan">Project Management</a></li>
                    <li><a href="#layanan">Design & Build</a></li>
                    <li><a href="#layanan">Infrastructure Dev</a></li>
                    @endforelse
                </ul>
            </div>
            <div>
                <div class="footer-heading">Kontak Kami</div>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Jl. Industrial Way Suite 408, Jakarta 12345</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>+62 (21) 123-4567</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span>info@pt-bat.co.id</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} PT Berkah Alam Tabantang. Semua hak dilindungi.</span>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Kebijakan Cookie</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Proyek carousel
        const cards = document.querySelectorAll('#proyekGrid .proyek-card');
        let page = 0;
        const perPage = 3;

        function showPage(p) {
            cards.forEach((c, i) => {
                c.style.display = (i >= p * perPage && i < (p + 1) * perPage) ? '' : 'none';
            });
        }

        if (cards.length > perPage) {
            showPage(0);
            document.getElementById('nextBtn').addEventListener('click', () => {
                const maxPage = Math.ceil(cards.length / perPage) - 1;
                page = page < maxPage ? page + 1 : 0;
                showPage(page);
            });
            document.getElementById('prevBtn').addEventListener('click', () => {
                const maxPage = Math.ceil(cards.length / perPage) - 1;
                page = page > 0 ? page - 1 : maxPage;
                showPage(page);
            });
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const target = document.querySelector(a.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>