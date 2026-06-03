<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BAT – Resource Center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

    <style>
/* Membuat tulisan menjadi interaktif saat diarahkan kursor */
.footer-modal-link {
    cursor: pointer; /* Mengubah kursor menjadi bentuk tangan (pointer) */
    color: rgba(255, 255, 255, 0.4); /* Warna awal agak redup */
    text-decoration: none; /* Menghilangkan garis bawah bawaan link */
    transition: color 0.2s ease, text-decoration 0.2s ease; /* Efek transisi biar halus pas berubah warna */
}

/* Efek saat kursor menempel (Hover) */
.footer-modal-link:hover {
    color: #ffffff; /* Tulisannya langsung 'hidup' berubah jadi putih cerah */
    text-decoration: underline; /* Opsional: memberi garis bawah tipis saat di-hover agar makin jelas bisa diklik */
}

        :root {
            --navy: #0d1b2e;
            --navy-mid: #162337;
            --blue: #1a56db;
            --blue-lt: #2f7aef;
            --orange: #f97316;
            --offwhite: #f7f6f2;
            --lt-gray: #e4e4dc;
            --mid-gray: #6b7280;
            --radius: 6px;
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
        h4,
        h5 {
            font-family: 'Barlow Condensed', sans-serif;
            letter-spacing: 0.02em;
        }

        /* ── NAVBAR ─────────────────────────────── */
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 48px;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid var(--lt-gray);
            transition: box-shadow .3s;
        }

        .nav-brand {
            position: absolute;
            left: 48px;
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
        .nav-links a.active {
            color: var(--navy);
        }

        .nav-links a.active {
            color: var(--gold);
            border-bottom: 2px solid var(--gold);
            padding-bottom: 2px;
        }

        /* ── HERO ────────────────────────────────── */
        .hero {
            margin-top: 64px;
            position: relative;
            min-height: 340px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            background: var(--navy);
            padding: 64px 24px 80px;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background: url('/background.png') center/cover no-repeat;
            opacity: 0.2;
            filter: grayscale(30%);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(13, 27, 46, .7) 0%, rgba(13, 27, 46, .95) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 680px;
            animation: fadeUp .7s ease both;
        }

        .hero-badge {
            display: inline-block;
            background: var(--orange);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-radius: 3px;
            padding: 4px 12px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: clamp(36px, 6vw, 68px);
            font-weight: 900;
            color: #fff;
            line-height: 1;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .hero-search {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            max-width: 540px;
            margin: 0 auto;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
        }

        .hero-search input {
            flex: 1;
            border: none;
            outline: none;
            padding: 14px 20px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: var(--navy);
        }

        .hero-search input::placeholder {
            color: #aaa;
        }

        .hero-search button {
            background: var(--blue);
            border: none;
            color: #fff;
            padding: 14px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background .2s;
        }

        .hero-search button:hover {
            background: var(--blue-lt);
        }

        /* ── CATEGORY CARDS ─────────────────────── */
        .categories {
            background: #fff;
            border-bottom: 1px solid var(--lt-gray);
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .category-card {
            padding: 32px 28px;
            border-right: 1px solid var(--lt-gray);
            cursor: pointer;
            transition: background .2s;
            position: relative;
        }

        .category-card:last-child {
            border-right: none;
        }

        .category-card:hover {
            background: var(--offwhite);
        }

        .category-card.active {
            border-top: 3px solid var(--orange);
            background: #fff;
        }

        .category-card.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--orange);
        }

        .category-icon {
            font-size: 22px;
            color: var(--navy);
            margin-bottom: 14px;
            display: block;
        }

        .category-card.active .category-icon {
            color: var(--orange);
        }

        .category-name {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .category-desc {
            font-size: 13px;
            color: var(--mid-gray);
            line-height: 1.6;
        }

        /* ── FAQ SECTION ─────────────────────────── */
        .faq-section {
            padding: 72px 48px;
            background: #fff;
            max-width: 860px;
            margin: 0 auto;
        }

        .faq-eyebrow {
            width: 48px;
            height: 4px;
            background: var(--blue);
            margin-bottom: 16px;
            border-radius: 2px;
        }

        .faq-title {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 900;
            text-transform: uppercase;
            color: var(--navy);
            margin-bottom: 40px;
            letter-spacing: 0.03em;
        }

        .faq-list {
            list-style: none;
        }

        .faq-item {
            border-top: 1px solid var(--lt-gray);
        }

        .faq-item:last-child {
            border-bottom: 1px solid var(--lt-gray);
        }

        .faq-question {
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            padding: 22px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            cursor: pointer;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--navy);
            transition: color .2s;
        }

        .faq-question:hover {
            color: var(--blue);
        }

        .faq-question.open {
            color: var(--blue);
        }

        .faq-chevron {
            font-size: 18px;
            flex-shrink: 0;
            transition: transform .3s ease;
            color: var(--mid-gray);
        }

        .faq-question.open .faq-chevron {
            transform: rotate(180deg);
            color: var(--blue);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height .35s ease, padding .35s ease;
        }

        .faq-answer.open {
            max-height: 300px;
            padding-bottom: 20px;
        }

        .faq-answer p {
            font-size: 15px;
            line-height: 1.8;
            color: var(--mid-gray);
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

        .footer div {
            text-align: left;
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


        /* ── ANIMATIONS ──────────────────────────── */
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

        /* ── RESPONSIVE ──────────────────────────── */
        @media (max-width: 768px) {
            .navbar-custom {
                padding: 0 20px;
            }

            .category-grid {
                grid-template-columns: 1fr 1fr;
            }

            .faq-section {
                padding: 48px 20px;
            }

            .cta-banner {
                margin: 0 20px 48px;
                padding: 40px 24px;
            }

            footer {
                padding: 40px 20px 20px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .category-grid {
                grid-template-columns: 1fr;
            }

            .category-card {
                border-right: none;
                border-bottom: 1px solid var(--lt-gray);
            }
        }

    </style>
</head>

<body>

    {{-- ═══ NAVBAR ═══ --}}
    <nav class="navbar-custom">
        <a href="{{ route('homepage') }}" class="nav-brand">
            <img src="{{ $logoPerusahaan ? asset('storage/' . $logoPerusahaan) : asset('logo.png') }}" alt="PT BAT" style="height: 36px; width: auto;">
            PT BAT
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('homepage') }}">Beranda</a></li>
            <li><a href="{{ route('homepage') }}#sejarah">Sejarah</a></li>
            <li><a href="{{ route('homepage') }}#layanan">Layanan</a></li>
            <li><a href="{{ route('pengunjung.proyekvisit') }}">Proyek</a></li>
            <li><a href="{{ route('homepage') }}#kontak">Kontak</a></li>
            <li><a href="{{ route('pengunjung.faqvisit') }}" class="active">FAQ</a></li>
        </ul>
    </nav>

    {{-- ═══ HERO ═══ --}}
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-badge">Resource Center</span>
            <h1>Industrial Intelligence Support</h1>
            <div class="hero-search">
                <input type="text" placeholder="Search project management, safety protocols, or licensing...">
                <button type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </section>

    {{-- ═══ CATEGORY CARDS ═══ --}}
    <div class="categories">
        <div class="category-grid">
            <div class="category-card active">
                <i class="bi bi-diagram-3 category-icon"></i>
                <div class="category-name">Project Management</div>
                <div class="category-desc">Timelines, budgeting, and phase communication protocols.</div>
            </div>
            <div class="category-card active">
                <i class="bi bi-shield-check category-icon"></i>
                <div class="category-name">Safety & Compliance</div>
                <div class="category-desc">OSHA standards, job-site safety, and hazard mitigation.</div>
            </div>
            <div class="category-card active">
                <i class="bi bi-patch-check category-icon"></i>
                <div class="category-name">Licensing & Permits</div>
                <div class="category-desc">State certifications, bond documentation, and city permits.</div>
            </div>
            <div class="category-card active">
                <i class="bi bi-question-circle category-icon"></i>
                <div class="category-name">General Inquiries</div>
                <div class="category-desc">Partnering with PT BAT, regions served, and media.</div>
            </div>
        </div>
    </div>

    {{-- ═══ FAQ ═══ --}}
    <div class="faq-section">
        <div class="reveal">
            <div class="faq-eyebrow"></div>
            <h2 class="faq-title">Pertanyaan yang Sering Diajukan</h2>
        </div>

        <ul class="faq-list reveal">
            @forelse($faqs as $faq)
            <li class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    {{ $faq->pertanyaan }}
                    <i class="bi bi-chevron-down faq-chevron"></i>
                </button>
                <div class="faq-answer">
                    <p>{{ $faq->jawaban }}</p>
                </div>
            </li>
            @empty
            <li style="padding:40px 0;text-align:center;color:var(--mid-gray);">
                Belum ada FAQ yang tersedia.
            </li>
            @endforelse
        </ul>
    </div>


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
        // FAQ toggle
        function toggleFaq(btn) {
            const answer = btn.nextElementSibling;
            const isOpen = btn.classList.contains('open');

            // Close all
            document.querySelectorAll('.faq-question').forEach(q => {
                q.classList.remove('open');
                q.nextElementSibling.classList.remove('open');
            });

            // Open clicked if it was closed
            if (!isOpen) {
                btn.classList.add('open');
                answer.classList.add('open');
            }
        }

        // Category filter (visual only)
        function filterFaq(cat) {
            document.querySelectorAll('.category-card').forEach(c => c.classList.remove('active'));
            event.currentTarget.classList.add('active');
        }

        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const obs = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 100);
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        reveals.forEach(el => obs.observe(el));

        // Navbar scroll
        window.addEventListener('scroll', () => {
            document.querySelector('.navbar-custom').style.boxShadow =
                window.scrollY > 10 ? '0 2px 16px rgba(0,0,0,0.08)' : 'none';
        });
    </script>
</body>

</html>
