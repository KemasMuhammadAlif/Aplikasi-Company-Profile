<?php
// ── DATA DUMMY ──────────────────────────────────────────────
$proyek = [
    'nama_proyek' => 'The Nexus Center',
    'lokasi'      => 'Jakarta Selatan',
    'tanggal'     => 'Januari 2023 – Februari 2026',
    'deskripsi'   => 'Kompleks perkantoran 45 lantai bersertifikat LEED Platinum di jantung pusat kota. Proyek ini menggabungkan teknologi bangunan cerdas dengan desain arsitektur kontemporer yang berkelanjutan, menciptakan lingkungan kerja kelas dunia.',
    'kategori'    => 'Gedung Komersial',
];

$fotos = [
    ['src' => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=900&q=80', 'alt' => 'Eksterior Gedung'],
    ['src' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=900&q=80', 'alt' => 'Proses Konstruksi'],
    ['src' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=900&q=80', 'alt' => 'Detail Struktur'],
    ['src' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=900&q=80', 'alt' => 'Interior Lobi'],
    ['src' => 'https://images.unsplash.com/photo-1541976590-713941681591?w=900&q=80', 'alt' => 'Tampak Malam'],
    ['src' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=900&q=80', 'alt' => 'Ruang Kerja'],
];

$layanans = ['General Contracting', 'Project Management', 'Design & Build', 'Infrastructure Dev', 'Consulting'];

$nav_links = [
    ['label' => 'Beranda',  'href' => '#'],
    ['label' => 'Proyek',   'href' => '#', 'active' => true],
    ['label' => 'Layanan',  'href' => '#'],
    ['label' => 'Sejarah',  'href' => '#'],
    ['label' => 'Kontak',   'href' => '#'],
    ['label' => 'FAQ',      'href' => '#'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BAT – <?= htmlspecialchars($proyek['nama_proyek']) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy:     #0d1b2e;
            --blue:     #1a56db;
            --gold:     #f0a500;
            --offwhite: #f4f5f7;
            --lt-gray:  #e2e4e8;
            --mid-gray: #6b7280;
            --radius:   12px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--offwhite);
            color: var(--navy);
            min-height: 100vh;
        }

        h1, h2, h3, .brand-font { font-family: 'Barlow Condensed', sans-serif; }

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
            box-shadow: 0 1px 12px rgba(0,0,0,.04);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--navy);
            text-decoration: none;
            letter-spacing: .5px;
        }

        .nav-logo-box {
            width: 36px; height: 36px;
            background: var(--navy);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            font-size: 16px;
            font-weight: 900;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            list-style: none;
        }

        .nav-links a {
            color: var(--mid-gray);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color .2s;
            padding-bottom: 2px;
        }

        .nav-links a:hover { color: var(--navy); }

        .nav-links a.active {
            color: var(--gold);
            font-weight: 600;
            border-bottom: 2px solid var(--gold);
        }

        /* ── LAYOUT ── */
        .page-wrapper {
            margin-top: 64px;
            display: grid;
            grid-template-columns: 300px 1fr;
            min-height: calc(100vh - 64px);
        }

        /* ── SIDEBAR ── */
        .sidebar {
            background: var(--offwhite);
            border-right: 1px solid var(--lt-gray);
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
        }

        .sidebar-item {
            padding: 28px 28px;
            border-bottom: 1px solid var(--lt-gray);
            animation: slideIn .4s ease both;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-12px); }
            to   { opacity: 1; transform: none; }
        }

        .sidebar-item:nth-child(1) { animation-delay: .05s; }
        .sidebar-item:nth-child(2) { animation-delay: .10s; }
        .sidebar-item:nth-child(3) { animation-delay: .15s; }
        .sidebar-item:nth-child(4) { animation-delay: .20s; }
        .sidebar-item:nth-child(5) { animation-delay: .25s; }

        .sidebar-item:first-child { padding-top: 40px; }

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
            font-size: 32px;
            font-weight: 900;
            color: var(--navy);
            line-height: 1.1;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .sidebar-value.sm {
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 1.5px;
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
            background: rgba(26,86,219,.1);
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
            margin-bottom: 4px;
        }
        .sidebar-back:hover { color: var(--navy); }

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
            color: var(--mid-gray);
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
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .photo-item {
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 4/3;
            background: #dde1e8;
            cursor: pointer;
            position: relative;
        }

        .photo-item:first-child {
            grid-column: 1 / -1;
            aspect-ratio: 16/8;
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
            display: block;
        }

        .photo-item:hover img { transform: scale(1.04); }

        .photo-item-overlay {
            position: absolute;
            inset: 0;
            background: rgba(13,27,46,0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .3s;
        }

        .photo-item:hover .photo-item-overlay { background: rgba(13,27,46,0.35); }

        .photo-item-overlay i {
            color: #fff;
            font-size: 28px;
            opacity: 0;
            transition: opacity .3s;
        }

        .photo-item:hover .photo-item-overlay i { opacity: 1; }

        .photo-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 32px 20px 16px;
            background: linear-gradient(transparent, rgba(13,27,46,.7));
            color: #fff;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: .5px;
            opacity: 0;
            transition: opacity .3s;
        }

        .photo-item:hover .photo-caption { opacity: 1; }

        /* ── LIGHTBOX ── */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.94);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 24px;
            backdrop-filter: blur(4px);
        }

        .lightbox.open { display: flex; }

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
            border-radius: 8px;
            animation: lbIn .25s ease;
        }

        @keyframes lbIn {
            from { opacity: 0; transform: scale(.93); }
            to   { opacity: 1; transform: none; }
        }

        .lb-counter {
            position: absolute;
            bottom: -36px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255,255,255,.4);
            font-size: 12px;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .lightbox-close {
            position: fixed;
            top: 20px; right: 24px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,.15);
            color: #fff;
            font-size: 18px;
            width: 44px; height: 44px;
            border-radius: 50%;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background .2s;
        }
        .lightbox-close:hover { background: rgba(255,255,255,.2); }

        .lightbox-nav {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,.12);
            color: #fff;
            font-size: 20px;
            width: 52px; height: 52px;
            border-radius: 50%;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background .2s;
        }
        .lightbox-nav:hover { background: rgba(255,255,255,.18); }
        .lightbox-prev { left: 20px; }
        .lightbox-next { right: 20px; }

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
        /* ── RESPONSIVE ── */
        @media (max-width: 960px) {
            .page-wrapper { grid-template-columns: 260px 1fr; }
            .main-content { padding: 36px 32px 0; }
        }

        @media (max-width: 768px) {
            .navbar-custom { padding: 0 20px; }
            .nav-links { display: none; }
            .page-wrapper { grid-template-columns: 1fr; }
            .sidebar {
                position: static;
                height: auto;
                border-right: none;
                border-bottom: 1px solid var(--lt-gray);
            }
            .main-content { padding: 24px 20px 0; }
            .photo-grid { grid-template-columns: 1fr; }
            .photo-item:first-child { grid-column: auto; aspect-ratio: 4/3; }
            footer { padding: 40px 20px 20px; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px; }
        }

        @media (max-width: 480px) {
            .footer-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar-custom" id="mainNav">
        <a href="{{ route('homepage') }}" class="nav-brand">
            <img src="{{ asset('logo.png') }}" alt="PT BAT" style="height: 36px; width: auto;">
            PT BAT
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('homepage') }}">Beranda</a></li>
            <li><a href="{{ route('homepage') }}#sejarah">Sejarah</a></li>
            <li><a href="{{ route('homepage') }}#layanan">Layanan</a></li>
            <li><a href="{{ route('pengunjung.proyekvisit') }}" class="active">Proyek</a></li>
            <li><a href="{{ route('homepage') }}#kontak">Kontak</a></li>
            <li><a href="{{ route('pengunjung.faqvisit') }}" >FAQ</a></li>
        </ul>
        <button class="nav-search-btn"><i class="bi bi-search"></i></button>
    </nav>

    <!-- PAGE WRAPPER -->
    <div class="page-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <!-- Back link -->
            <div class="sidebar-item">
                <a href="#" class="sidebar-back">
                    <i class="bi bi-arrow-left"></i> Semua Proyek
                </a>
                <div class="sidebar-value"><?= htmlspecialchars($proyek['nama_proyek']) ?></div>
                <span class="sidebar-badge"><i class="bi bi-circle-fill" style="font-size:6px"></i> Selesai</span>
            </div>

            <!-- Lokasi -->
            <div class="sidebar-item">
                <div class="sidebar-label">Lokasi</div>
                <div class="sidebar-value sm"><?= strtoupper(htmlspecialchars($proyek['lokasi'])) ?></div>
            </div>

            <!-- Tanggal -->
            <div class="sidebar-item">
                <div class="sidebar-label">Periode</div>
                <div class="sidebar-value sm"><?= htmlspecialchars($proyek['tanggal']) ?></div>
            </div>

            <!-- Deskripsi -->
            <div class="sidebar-item">
                <div class="sidebar-label">Tentang Proyek</div>
                <p class="sidebar-desc"><?= htmlspecialchars($proyek['deskripsi']) ?></p>
            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <main>
            <div class="main-content">

                <div class="content-header">
                    <div>
                        <div class="content-eyebrow">Dokumentasi Proyek</div>
                    </div>
                </div>

                <div class="photo-grid">
                    <?php foreach ($fotos as $i => $foto): ?>
                    <div class="photo-item" onclick="openLightbox(<?= $i ?>)">
                        <img
                            src="<?= htmlspecialchars($foto['src']) ?>"
                            alt="<?= htmlspecialchars($foto['alt']) ?>"
                            loading="<?= $i < 2 ? 'eager' : 'lazy' ?>"
                        >
                        <div class="photo-item-overlay">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </div>
                        <div class="photo-caption"><?= htmlspecialchars($foto['alt']) ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>

            {{-- ═══ FOOTER ═══ --}}
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
                    <li><a href="{{ route('pengunjung.proyekvisit') }}">Proyek Kami</a></li>
                    <li><a href="{{ route('homepage') }}#layanan">Layanan Konstruksi</a></li>
                    <li><a href="{{ route('homepage') }}#sejarah">Sejarah Perusahaan</a></li>
                    <li><a href="{{ route('pengunjung.faqvisit') }}">FAQ</a></li>
                    <li><a href="#">Karir</a></li>
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
        </main>
    </div>

    <!-- LIGHTBOX -->
    <div class="lightbox" id="lightbox" onclick="closeLightboxOnBg(event)">
        <button class="lightbox-close" onclick="closeLightbox()"><i class="bi bi-x-lg"></i></button>
        <button class="lightbox-nav lightbox-prev" onclick="changeLightbox(-1)"><i class="bi bi-chevron-left"></i></button>
        <div class="lightbox-inner">
            <img id="lightboxImg" src="" alt="">
            <span class="lb-counter" id="lbCounter"></span>
        </div>
        <button class="lightbox-nav lightbox-next" onclick="changeLightbox(1)"><i class="bi bi-chevron-right"></i></button>
    </div>

    <script>
        const images = <?= json_encode(array_map(fn($f) => ['src' => $f['src'], 'alt' => $f['alt']], $fotos)) ?>;
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
            currentIndex = (currentIndex + dir + images.length) % images.length;
            updateLightbox();
        }

        function updateLightbox() {
            const img = document.getElementById('lightboxImg');
            img.style.animation = 'none';
            img.offsetHeight; // reflow
            img.style.animation = '';
            img.src = images[currentIndex].src;
            img.alt = images[currentIndex].alt;
            document.getElementById('lbCounter').textContent =
                (currentIndex + 1) + ' / ' + images.length;
        }

        document.addEventListener('keydown', (e) => {
            if (!document.getElementById('lightbox').classList.contains('open')) return;
            if (e.key === 'Escape')     closeLightbox();
            if (e.key === 'ArrowRight') changeLightbox(1);
            if (e.key === 'ArrowLeft')  changeLightbox(-1);
        });
    </script>
</body>
</html>