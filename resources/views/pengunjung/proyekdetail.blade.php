<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Berkah Alam Tabantang – {{ $proyek->nama_proyek }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0e1b2e;
            --navy-mid: #162337;
            --blue: #1d5fc4;
            --blue-lt: #2f7aef;
            --gold: #f0a500;
            --offwhite: #f5f4f0;
            --mid-gray: #6b7280;
            --lt-gray: #e8e8e3;
            --radius-sm: 4px;
            --radius-md: 10px;
            --radius-lg: 18px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fff;
            color: var(--navy);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Barlow Condensed', sans-serif;
            letter-spacing: -0.01em;
        }

        /* ── NAVBAR ── */
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
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
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-links a {
            color: var(--mid-gray);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--navy);
        }

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

        .nav-search-btn:hover {
            color: var(--navy);
        }

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--navy);
        }

        /* ── LAYOUT ── */
        .page-wrapper {
            margin-top: 64px;
            display: flex;
            min-height: calc(100vh - 64px);
            width: 100%;
            grid-template-columns: 1fr;

        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 320px;
            flex-shrink: 0;
            background: var(--offwhite);
            border-right: 1px solid var(--lt-gray);
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
        }

        main {
            flex: 1;
            min-width: 0;
        }

        .sidebar-item {
            padding: 24px 28px;
            border-bottom: 1px solid var(--lt-gray);
            animation: slideIn .4s ease both;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-12px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .sidebar-item:nth-child(1) {
            animation-delay: .05s;
        }

        .sidebar-item:nth-child(2) {
            animation-delay: .10s;
        }

        .sidebar-item:nth-child(3) {
            animation-delay: .15s;
        }

        .sidebar-item:nth-child(4) {
            animation-delay: .20s;
        }

        .sidebar-item:nth-child(5) {
            animation-delay: .25s;
        }

        .sidebar-item:first-child {
            padding-top: 36px;
        }

        .sidebar-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--mid-gray);
            margin-bottom: 10px;
        }

        .sidebar-value {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.1;
            letter-spacing: .5px;
        }

        .sidebar-value.sm {
            font-size: 15px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0;
        }

        .sidebar-desc {
            font-size: 14px;
            line-height: 1.8;
            color: var(--mid-gray);
        }

        .sidebar-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(29, 95, 196, .1);
            color: var(--blue);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 100px;
            padding: 5px 14px;
            margin-top: 10px;
        }

        .sidebar-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 500;
            color: var(--mid-gray);
            text-decoration: none;
            transition: color .2s;
            margin-bottom: 12px;
        }

        .sidebar-back:hover {
            color: var(--navy);
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            background: #fff;
            padding: 48px 48px 0;
        }

        .content-header {
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .content-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--blue);
            margin-bottom: 4px;
        }

        .content-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--navy);
        }

        .photo-count-badge {
            font-size: 13px;
            font-weight: 500;
            color: var(--mid-gray);
            background: var(--offwhite);
            border: 1px solid var(--lt-gray);
            border-radius: 100px;
            padding: 6px 16px;
        }

        /* ── PHOTO GRID ── */
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            align-items: start;
            padding-bottom: 48px;
        }

        .photo-item {
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: transparent;
            cursor: pointer;
            position: relative;
            /* aspect-ratio: 4/3; */
        }

        .photo-item:first-child {
            grid-column: 1 / -1;
            max-height: 480px;
            /* aspect-ratio: 16/7; */
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            border-radius: var(--radius-lg);
            transition: transform .5s ease;
            display: block;
        }

        .photo-item:hover img {
            transform: scale(1.04);
        }

        .photo-item-overlay {
            position: absolute;
            inset: 0;
            background: rgba(14, 27, 46, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .3s;
        }

        .photo-item:hover .photo-item-overlay {
            background: rgba(14, 27, 46, 0.35);
        }

        .photo-item-overlay i {
            color: #fff;
            font-size: 28px;
            opacity: 0;
            transition: opacity .3s;
        }

        .photo-item:hover .photo-item-overlay i {
            opacity: 1;
        }

        .photo-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 32px 20px 16px;
            background: linear-gradient(transparent, rgba(14, 27, 46, .7));
            color: #fff;
            font-size: 12px;
            font-weight: 500;
            opacity: 0;
            transition: opacity .3s;
        }

        .photo-item:hover .photo-caption {
            opacity: 1;
        }

        .empty-photos {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 24px;
            color: var(--mid-gray);
        }

        .empty-photos i {
            font-size: 56px;
            margin-bottom: 16px;
            display: block;
            opacity: .3;
        }

        /* ── LIGHTBOX ── */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.94);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 24px;
            backdrop-filter: blur(4px);
        }

        .lightbox.open {
            display: flex;
        }

        .lightbox-inner {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 90vw;
            max-height: 88vh;
        }

        .lightbox img {
            max-width: 88vw;
            max-height: 82vh;
            object-fit: contain;
            border-radius: var(--radius-md);
            animation: lbIn .25s ease;
        }

        @keyframes lbIn {
            from {
                opacity: 0;
                transform: scale(.93);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .lb-counter {
            position: absolute;
            bottom: -36px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, .4);
            font-size: 12px;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .lightbox-close {
            position: fixed;
            top: 20px;
            right: 24px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, .15);
            color: #fff;
            font-size: 18px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
        }

        .lightbox-close:hover {
            background: rgba(255, 255, 255, .2);
        }

        .lightbox-nav {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, .12);
            color: #fff;
            font-size: 20px;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
        }

        .lightbox-nav:hover {
            background: rgba(255, 255, 255, .18);
        }

        .lightbox-prev {
            left: 20px;
        }

        .lightbox-next {
            right: 20px;
        }

        /* ── FOOTER ── */
        footer {
            width: 100%;
            background: var(--navy);
            color: rgba(255, 255, 255, 0.65);
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

        .footer-brand span {
            color: var(--gold);
        }

        .footer-desc {
            font-size: 14px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 24px;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 15px;
            text-decoration: none;
            transition: all .2s;
        }

        .social-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .footer-heading {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 20px;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
            margin-left: 0;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 14px;
            transition: color .2s;
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .footer-contact-item i {
            color: var(--blue);
            font-size: 16px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }

        .footer-bottom-links {
            display: flex;
            gap: 24px;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 13px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1200px) {
            .nav-links {
                position: static;
                transform: none;
                left: auto;
                gap: 18px;
            }
        }

        @media (max-width: 992px) {
            .navbar-custom {
                padding: 0 24px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 32px;
            }
        }

        @media (max-width: 768px) {
            .navbar-custom {
                height: 70px;
                padding: 0 18px;
            }

            .nav-brand {
                font-size: 16px;
                max-width: 80%;
            }

            .nav-brand img {
                width: 34px;
            }

            .nav-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background: #fff;
                flex-direction: column;
                transform: none;
                gap: 0;
                box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
                border-top: 1px solid #eee;
                z-index: 999;
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links li {
                width: 100%;
            }

            .nav-links a {
                display: block;
                width: 100%;
                padding: 18px 22px;
                border-bottom: 1px solid #f2f2f2;
            }

            .nav-links a.active {
                border-bottom: 1px solid #f2f2f2;
                padding-bottom: 18px;
                position: relative;
            }

            .nav-links a.active::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 22px;
                width: 30px;
                height: 3px;
                background-color: var(--gold);
                border-radius: 2px;
            }

            .page-wrapper {
                margin-top: 70px;
                min-height: calc(100vh - 70px);
                flex-direction: column;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--lt-gray);
            }

            .main-content {
                padding: 24px 20px 0;
            }

            .photo-grid {
                grid-template-columns: 1fr;
            }

            .photo-item:first-child {
                grid-column: auto;
            }

            footer {
                padding: 40px 20px 20px;
            }
        }

        @media (max-width: 576px) {
            .navbar-custom {
                padding: 0 16px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }
        }

        .wa-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            text-decoration: none;
            z-index: 9999;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .3);
        }

        .wa-float:hover {
            color: white;
            transform: scale(1.05);
        }

        .wa-message {
            position: fixed;
            bottom: 90px;
            right: 20px;
            background: white;
            color: #333;
            padding: 10px 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .15);
            font-size: 14px;
            font-weight: 600;
            z-index: 9999;
        }

        /* Segitiga kecil */
        .wa-message::after {
            content: '';
            position: absolute;
            bottom: -8px;
            right: 20px;
            border-width: 8px 8px 0;
            border-style: solid;
            border-color: white transparent transparent;
        }
    </style>
</head>

<body>

    {{-- ═══ NAVBAR ═══ --}}
    <nav class="navbar-custom" id="mainNav">
        <a href="{{ route('homepage') }}" class="nav-brand">
            <img src="{{ $logoPerusahaan ? asset('storage/' . $logoPerusahaan) : asset('logo.png') }}" alt="PT BAT" style="height: 36px; width: auto;">
            PT Berkah Alam Tabantang
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('homepage') }}">Beranda</a></li>
            <li><a href="{{ route('homepage') }}#sejarah">Deskripsi</a></li>
            <li><a href="{{ route('homepage') }}#layanan">Layanan</a></li>
            <li><a href="{{ route('pengunjung.proyekvisit') }}" class="active">Proyek</a></li>
            <li><a href="{{ route('homepage') }}#kontak">Kontak</a></li>
            <li><a href="{{ route('pengunjung.faqvisit') }}">FAQ</a></li>
        </ul>
        <button class="nav-toggle">
            ☰
        </button>
    </nav>

    {{-- ═══ PAGE WRAPPER ═══ --}}
    <div class="page-wrapper">

        {{-- ═══ SIDEBAR ═══ --}}
        <aside class="sidebar">
            <div class="sidebar-item">
                <a href="{{ route('pengunjung.proyekvisit') }}" class="sidebar-back">
                    <i class="bi bi-arrow-left"></i> Semua Proyek
                </a>
                <div class="sidebar-value">{{ $proyek->nama_proyek }}</div>
                <span class="sidebar-badge">
                    <i class="bi bi-circle-fill" style="font-size:6px"></i> Selesai
                </span>
            </div>

            @if($proyek->lokasi)
            <div class="sidebar-item">
                <div class="sidebar-label">Lokasi</div>
                <div class="sidebar-value sm">
                    <i class="bi bi-geo-alt" style="color: var(--blue); margin-right: 6px;"></i>
                    {{ $proyek->lokasi }}
                </div>
            </div>
            @endif

            @if($proyek->tanggal)
            <div class="sidebar-item">
                <div class="sidebar-label">Tanggal Selesai</div>
                <div class="sidebar-value sm">
                    <i class="bi bi-calendar3" style="color: var(--blue); margin-right: 6px;"></i>
                    {{ \Carbon\Carbon::parse($proyek->tanggal)->translatedFormat('d F Y') }}
                </div>
            </div>
            @endif

            @if($proyek->deskripsi)
            <div class="sidebar-item">
                <div class="sidebar-label">Tentang Proyek</div>
                <p class="sidebar-desc">{{ $proyek->deskripsi }}</p>
            </div>
            @endif
            </main>
        </aside>

        {{-- ═══ MAIN ═══ --}}
        <main>
            <div class="main-content">

                <div class="content-header">
                    <div>
                        <div class="content-eyebrow">Dokumentasi Proyek</div>
                        <div class="content-title">{{ $proyek->nama_proyek }}</div>
                    </div>
                    @if($proyek->dokumentasi->count() > 0)
                    @endif
                </div>

                {{-- Photo Grid --}}
                <div class="photo-grid">
                    @forelse($proyek->dokumentasi as $foto)
                    <div class="photo-item" onclick="openLightbox({{ $loop->index }})">
                        <img
                            src="{{ asset('storage/' . $foto->dokumentasi) }}"
                            alt="Foto {{ $loop->iteration }} – {{ $proyek->nama_proyek }}"
                            loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                        <div class="photo-item-overlay">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </div>
                        <div class="photo-caption">Foto {{ $loop->iteration }}</div>
                    </div>
                    @empty
                    <div class="empty-photos">
                        <i class="bi bi-image-alt"></i>
                        <p style="font-size:15px; font-weight:500;">Belum ada dokumentasi foto untuk proyek ini.</p>
                    </div>
                    @endforelse
                </div>
        </main>
    </div>

    {{-- ═══ FOOTER ═══ --}}
    <footer id="kontak">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">PT <span>BAT</span></div>
                <p class="footer-desc">Kami mengutamakan integritas, keamanan, inovasi, dan kepuasan pelanggan. Kami
                    berkomitmen untuk beroperasi dengan standar tertinggi dalam hal kualitas, keamanan, dan keberlanjutan lingkungan.</p>
                <div class="footer-social">
                    <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            <div>
                <div class="footer-heading">Quick Links</div>
                <ul class="footer-links">
                    <li><a href="{{ route('pengunjung.proyekvisit') }}">Proyek Kami</a></li>
                    <li><a href="{{ route('homepage') }}#layanan">Layanan Konstruksi</a></li>
                    <li><a href="{{ route('homepage') }}#sejarah">Deskripsi Perusahaan</a></li>
                    <li><a href="{{ route('pengunjung.faqvisit') }}">FAQ</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">Layanan Kami</div>
                <ul class="footer-links">
                    @forelse($layanans->take(5) as $layanan)
                    <li><a href="{{ route('homepage') }}#layanan">{{ $layanan->nama_layanan }}</a></li>
                    @empty
                    <li><a href="#">General Contracting</a></li>
                    <li><a href="#">Project Management</a></li>
                    <li><a href="#">Design &amp; Build</a></li>
                    <li><a href="#">Infrastructure Dev</a></li>
                    @endforelse
                </ul>
            </div>
            <div>
                <div class="footer-heading">Kontak Kami</div>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Ruko Marbella 2 Blok D6 No.7 Batam Center - Kota Batam</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>+62 813 6332 7109 / +62 822 6877 7317</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span>berkahat@yahoo.com</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} PT Berkah Alam Tabantang. Semua hak dilindungi.</span>
            <div class="footer-bottom-links">
                <!-- Tambahkan class="footer-modal-link" dan href -->
                <a href="javascript:void(0)" class="footer-modal-link" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal">Privacy Policy</a>
                <a href="javascript:void(0)" class="footer-modal-link" data-bs-toggle="modal" data-bs-target="#termsOfServiceModal">Terms of Service</a>
            </div>
        </div>
    </footer>
    </div>

    {{-- ═══ LIGHTBOX ═══ --}}
    <div class="lightbox" id="lightbox" onclick="closeLightboxOnBg(event)">
        <button class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></button>
        <button class="lightbox-nav lightbox-prev" onclick="changeLightbox(-1)"><i class="bi bi-chevron-left"></i></button>
        <div class="lightbox-inner">
            <img id="lightboxImg" src="" alt="">
            <span class="lb-counter" id="lbCounter"></span>
        </div>
        <button class="lightbox-nav lightbox-next" onclick="changeLightbox(1)"><i class="bi bi-chevron-right"></i></button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').style.boxShadow =
                window.scrollY > 10 ? '0 2px 16px rgba(0,0,0,0.08)' : 'none';
        });

        const images = {!! $fotoJson !!};
        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            updateLightbox();
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }

        function closeLightboxOnBg(e) {
            if (e.target === document.getElementById('lightbox')) closeLightbox();
        }

        function changeLightbox(dir) {
            if (images.length === 0) return;
            currentIndex = (currentIndex + dir + images.length) % images.length;
            updateLightbox();
        }

        function updateLightbox() {
            const img = document.getElementById('lightboxImg');
            img.style.animation = 'none';
            img.offsetHeight;
            img.style.animation = '';
            img.src = images[currentIndex].src;
            img.alt = images[currentIndex].alt;
            document.getElementById('lbCounter').textContent =
                (currentIndex + 1) + ' / ' + images.length;
        }

        document.addEventListener('keydown', (e) => {
            if (!document.getElementById('lightbox').classList.contains('open')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') changeLightbox(1);
            if (e.key === 'ArrowLeft') changeLightbox(-1);
        });

        const toggle = document.querySelector('.nav-toggle');
        const menu = document.querySelector('.nav-links');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('show');
        });

        setTimeout(() => {
            document.querySelector('.wa-message').style.display = 'none';
        }, 5000);
    </script>

    <div class="wa-message">
        👋 Hubungi Kami
    </div>

    <a href="https://wa.me/6281363327109?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20layanan%20PT%20Berkah%20Alam%20Tabantang."
        class="wa-float"
        target="_blank">
        <i class="bi bi-whatsapp"></i>
    </a>
</body>

</html>