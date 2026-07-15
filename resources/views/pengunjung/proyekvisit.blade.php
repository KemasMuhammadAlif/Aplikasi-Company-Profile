<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Berkah Alam Tabantang – Portfolio Proyek</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* Membuat tulisan menjadi interaktif saat diarahkan kursor */
        .footer-modal-link {
            cursor: pointer;
            /* Mengubah kursor menjadi bentuk tangan (pointer) */
            color: rgba(255, 255, 255, 0.4);
            /* Warna awal agak redup */
            text-decoration: none;
            /* Menghilangkan garis bawah bawaan link */
            transition: color 0.2s ease, text-decoration 0.2s ease;
            /* Efek transisi biar halus pas berubah warna */
        }

        /* Efek saat kursor menempel (Hover) */
        .footer-modal-link:hover {
            color: #ffffff;
            /* Tulisannya langsung 'hidup' berubah jadi putih cerah */
            text-decoration: underline;
            /* Opsional: memberi garis bawah tipis saat di-hover agar makin jelas bisa diklik */
        }

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

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: var(--navy);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            margin-top: 64px;
            background: var(--navy);
            position: relative;
            overflow: hidden;
            padding: 72px 48px 64px;
        }

        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('/background.png') center/cover no-repeat;
            opacity: 0.12;
        }

        .page-header-inner {
            position: relative;
            z-index: 2;
            max-width: 640px;
        }

        .page-eyebrow {
            font-size: 11px;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 600;
            margin-bottom: 12px;
        }

        .page-header h1 {
            font-size: clamp(40px, 6vw, 72px);
            font-weight: 800;
            color: #fff;
            line-height: 1;
            margin-bottom: 16px;
        }

        .page-header p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.7;
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            padding: 56px 48px;
            background: var(--offwhite);
            min-height: 60vh;
        }

        /* ── STATS ROW ── */
        .stats-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .stats-row-left {
            font-size: 14px;
            color: var(--mid-gray);
        }

        .stats-row-left strong {
            color: var(--navy);
            font-weight: 700;
        }

        .view-toggle {
            display: flex;
            gap: 4px;
        }

        .view-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--lt-gray);
            border-radius: var(--radius-sm);
            background: #fff;
            color: var(--mid-gray);
            font-size: 16px;
            cursor: pointer;
            transition: all .2s;
        }

        .view-btn.active,
        .view-btn:hover {
            background: var(--navy);
            color: #fff;
            border-color: var(--navy);
        }

        /* ── PROJECT GRID ── */
        .proyek-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 48px;
        }

        .proyek-card {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            aspect-ratio: 4/3;
            background: var(--navy-mid);
            cursor: pointer;
            transition: transform .3s ease, box-shadow .3s ease;
            max-height: 900px;
            max-width: 900px;
            aspect-ratio: 16/9;
        }

        .proyek-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 48px rgba(14, 27, 46, 0.18);
        }

        .proyek-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .proyek-card:hover img {
            transform: scale(1.06);
        }

        .proyek-card-no-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .proyek-card-no-img i {
            font-size: 48px;
            color: rgba(255, 255, 255, 0.2);
        }

        .proyek-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 35%, rgba(10, 20, 40, .92) 100%);
        }

        .proyek-card-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 24px;
            color: #fff;
        }

        .proyek-badge {
            display: inline-block;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            border-radius: 3px;
            padding: 3px 8px;
            margin-bottom: 8px;
        }

        .badge-commercial {
            background: var(--blue);
        }

        .badge-residential {
            background: #059669;
        }

        .badge-infrastructure {
            background: #7c3aed;
        }

        .badge-healthcare {
            background: #dc2626;
        }

        .badge-default {
            background: var(--mid-gray);
        }

        .proyek-card-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .proyek-card-meta {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .proyek-card-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .proyek-card-link {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity .2s, background .2s;
        }

        .proyek-card:hover .proyek-card-link {
            opacity: 1;
        }

        .proyek-card-link:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* ── FEATURED CARD (wide) ── */
        .proyek-card-featured {
            /* grid-column: span 2; */
            /* aspect-ratio: unset; */
            /* min-height: 320px; */
        }

        /* ── HIDDEN (for load more) ── */
        .proyek-card.hidden {
            display: none;
        }

        /* ── LOAD MORE ── */
        .load-more-wrap {
            text-align: center;
            padding: 8px 0 16px;
        }

        .btn-load-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--navy);
            border: 1.5px solid var(--lt-gray);
            border-radius: 8px;
            padding: 13px 32px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-load-more:hover {
            background: var(--navy);
            color: #fff;
            border-color: var(--navy);
        }

        .btn-load-more i {
            transition: transform .2s;
        }

        .btn-load-more:hover i {
            transform: translateY(2px);
        }

        .btn-load-more.all-loaded {
            opacity: 0.4;
            cursor: default;
            pointer-events: none;
        }

        /* ── FOOTER ── */
        footer {
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

        .footer-links {
            list-style: none;
            padding-left: 0;
            margin-left: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 14px;
            transition: color .2s;
            padding-left: 0;
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

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .5s ease, transform .5s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
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

            .page-header {
                padding: 56px 24px 48px;
            }

            .filter-bar {
                padding: 0 24px;
            }

            .main-content {
                padding: 40px 24px;
            }

            .proyek-grid {
                grid-template-columns: 1fr 1fr;
            }

            .proyek-card-featured {
                grid-column: span 2;
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

            .page-header {
                margin-top: 70px;
            }
        }

        @media (max-width: 576px) {
            .navbar-custom {
                padding: 0 16px;
            }

            .page-header {
                padding: 40px 16px;
            }

            .filter-bar {
                padding: 0 16px;
            }

            .main-content {
                padding: 32px 16px;
            }

            .proyek-grid {
                grid-template-columns: 1fr;
            }

            .proyek-card-featured {
                grid-column: span 1;
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

        a.proyek-card {
            display: block;
            text-decoration: none;
            color: inherit;
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

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="page-header">
        <div class="page-header-inner">
            <p class="page-eyebrow">Portfolio Kami</p>
            <h1>Portofolio</h1>
            <p>Temukan proyek-proyek yang telah kami bangun dengan presisi dan integritas struktural.</p>
        </div>
    </div>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <div class="main-content">

        {{-- Stats Row --}}
        <div class="stats-row reveal">
            <div class="stats-row-left">
                Menampilkan <strong id="showing-count">6</strong> dari <strong id="total-count">0</strong> proyek
            </div>
        </div>

        {{-- Project Grid --}}
        <div class="proyek-grid" id="proyekGrid">

            @forelse($proyeks as $index => $proyek)
            {{-- Kartu pertama jadi featured (span 2) --}}
            <a href="{{ route('pengunjung.proyekdetail', $proyek->id_proyek) }}"
                class="proyek-card {{ $index >= 6 ? 'hidden' : '' }} reveal"
                data-category="{{ strtolower($proyek->kategori ?? 'default') }}"
                style="background: linear-gradient(135deg, #{{ substr(md5($proyek->nama_proyek), 0, 6) }} 0%, #0e1b2e 100%);">

                @if($proyek->thumbnail)
                <img src="{{ asset('storage/' . $proyek->thumbnail->dokumentasi) }}"
                    alt="{{ $proyek->nama_proyek }}" loading="lazy">
                @else
                <div class="proyek-card-no-img">
                    <i class="bi bi-building"></i>
                </div>
                @endif

                <div class="proyek-card-overlay"></div>

                <div class="proyek-card-body">
                    <span class="proyek-badge badge-{{ strtolower($proyek->kategori ?? 'default') }}">
                        {{ $proyek->kategori ?? 'Proyek' }}
                    </span>
                    <div class="proyek-card-title">{{ $proyek->nama_proyek }}</div>
                    <div class="proyek-card-meta">
                        @if($proyek->lokasi)
                        <span><i class="bi bi-geo-alt"></i> {{ $proyek->lokasi }}</span>
                        @endif
                        @if($proyek->tanggal_selesai)
                        <span><i class="bi bi-calendar3"></i> Selesai {{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->year }}</span>
                        @endif
                    </div>
                </div>

                <div class="proyek-card-link">
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </a>

            @empty

            {{-- FALLBACK STATIS --}}
            <div class="proyek-card proyek-card-featured reveal" data-category="commercial"
                style="background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-buildings"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-commercial">Commercial</span>
                    <div class="proyek-card-title">The Nexus Center</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Jakarta</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2022</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            <div class="proyek-card reveal" data-category="residential"
                style="background: linear-gradient(135deg, #134e4a 0%, #0f766e 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-house-door"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-residential">Residential</span>
                    <div class="proyek-card-title">Azure Bay Heights</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Surabaya</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2023</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            <div class="proyek-card reveal" data-category="commercial"
                style="background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-building"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-commercial">Commercial</span>
                    <div class="proyek-card-title">Vertex Innovation Hub</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Bandung</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2021</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            <div class="proyek-card reveal" data-category="healthcare"
                style="background: linear-gradient(135deg, #4c0519 0%, #9f1239 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-hospital"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-healthcare">Healthcare</span>
                    <div class="proyek-card-title">Starlight Medical Wing</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Medan</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2023</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            <div class="proyek-card reveal" data-category="infrastructure"
                style="background: linear-gradient(135deg, #3b0764 0%, #6d28d9 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-train-front"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-infrastructure">Infrastructure</span>
                    <div class="proyek-card-title">Edison Transit Hub</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Jakarta</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2022</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            <div class="proyek-card reveal" data-category="commercial"
                style="background: linear-gradient(135deg, #1c1917 0%, #44403c 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-gem"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-commercial">Commercial</span>
                    <div class="proyek-card-title">The Prism Hotel</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Bali</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2024</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            {{-- Kartu hidden untuk load more --}}
            <div class="proyek-card hidden reveal" data-category="infrastructure"
                style="background: linear-gradient(135deg, #0c4a6e 0%, #0369a1 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-water"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-infrastructure">Infrastructure</span>
                    <div class="proyek-card-title">Lakeside Dam Project</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Kalimantan</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2020</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            <div class="proyek-card hidden reveal" data-category="residential"
                style="background: linear-gradient(135deg, #052e16 0%, #15803d 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-houses"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-residential">Residential</span>
                    <div class="proyek-card-title">Green Valley Residences</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Bogor</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2019</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            <div class="proyek-card hidden reveal" data-category="commercial"
                style="background: linear-gradient(135deg, #27272a 0%, #52525b 100%);">
                <div class="proyek-card-no-img"><i class="bi bi-shop"></i></div>
                <div class="proyek-card-overlay"></div>
                <div class="proyek-card-body">
                    <span class="proyek-badge badge-commercial">Commercial</span>
                    <div class="proyek-card-title">Citadel Mall Expansion</div>
                    <div class="proyek-card-meta">
                        <span><i class="bi bi-geo-alt"></i> Makassar</span>
                        <span><i class="bi bi-calendar3"></i> Selesai 2021</span>
                    </div>
                </div>
                <div class="proyek-card-link"><i class="bi bi-arrow-up-right"></i></div>
            </div>

            @endforelse
        </div>
    </div>

    {{-- Load More --}}
    <div class="load-more-wrap reveal">
        <button class="btn-load-more" id="loadMoreBtn">
            Load More Projects <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    </div>

    {{-- ═══ FOOTER ═══ --}}
    <footer id="kontak">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">PT <span>BAT</span></div>
                <p class="footer-desc">Kami mengutamakan integritas, keamanan, inovasi, dan kepuasan pelanggan. 
                Kami berkomitmen untuk beroperasi dengan standar tertinggi dalam hal kualitas, keamanan, dan keberlanjutan lingkungan.</p>
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
                    <li><a href="#">Design & Build</a></li>
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
    <div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                <div class="modal-header" style="border-bottom: 1px solid #eee; padding: 20px 24px;">
                    <h5 class="modal-title" id="privacyPolicyModalLabel" style="font-family: 'Barlow Condensed', sans-serif; font-weight: 800; color: #0d1b2e;">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 24px; color: #6b7280; font-size: 15px; line-height: 1.7;">
                    Kami berkomitmen menjaga privasi data Anda. Semua informasi yang dikumpulkan hanya digunakan untuk keperluan layanan kami dan tidak akan dijual kepada pihak ketiga.
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termsOfServiceModal" tabindex="-1" aria-labelledby="termsOfServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                <div class="modal-header" style="border-bottom: 1px solid #eee; padding: 20px 24px;">
                    <h5 class="modal-title" id="termsOfServiceModalLabel" style="font-family: 'Barlow Condensed', sans-serif; font-weight: 800; color: #0d1b2e;">Terms of Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 24px; color: #6b7280; font-size: 15px; line-height: 1.7;">
                    Dengan mengakses situs ini, Anda menyetujui syarat dan ketentuan yang berlaku di PT Berkah Alam Tabantang. Seluruh konten di dalam situs ini dilindungi oleh undang-undang hak cipta.
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ── Navbar scroll shadow ──
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').style.boxShadow =
                window.scrollY > 10 ? '0 2px 16px rgba(0,0,0,0.08)' : 'none';
        });

        // ── Scroll reveal ──
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 60);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08
        });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // ── Filter & Load More logic ──
        const allCards = Array.from(document.querySelectorAll('.proyek-card'));
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const showingEl = document.getElementById('showing-count');
        const totalEl = document.getElementById('total-count');
        const PER_PAGE = 6;

        let currentFilter = 'all';
        let visibleCount = PER_PAGE;

        // Count per category
        const counts = {
            all: allCards.length
        };
        allCards.forEach(c => {
            const cat = c.dataset.category || 'default';
            counts[cat] = (counts[cat] || 0) + 1;
        });


        totalEl.textContent = allCards.length;

        function applyFilter() {
            const filtered = allCards.filter(c =>
                currentFilter === 'all' || c.dataset.category === currentFilter
            );

            allCards.forEach(c => c.style.display = 'none');

            filtered.forEach((c, i) => {
                if (i < visibleCount) {
                    c.style.display = '';
                    c.classList.remove('hidden');
                } else {
                    c.style.display = 'none';
                }
            });

            const showing = Math.min(visibleCount, filtered.length);
            showingEl.textContent = showing;
            totalEl.textContent = filtered.length;

            if (visibleCount >= filtered.length) {
                loadMoreBtn.textContent = 'Semua Proyek Ditampilkan';
                loadMoreBtn.classList.add('all-loaded');
            } else {
                loadMoreBtn.innerHTML = 'Load More Projects <i class="bi bi-chevron-down"></i>';
                loadMoreBtn.classList.remove('all-loaded');
            }
        }

        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.dataset.filter;
                visibleCount = PER_PAGE;
                applyFilter();
            });
        });

        // Load More
        loadMoreBtn.addEventListener('click', () => {
            visibleCount += PER_PAGE;
            applyFilter();
        });

        // Init
        applyFilter();

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