<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BAT – Ulasan Klien</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0d1b2e;
            --blue: #1a56db;
            --blue-lt: #2f7aef;
            --orange: #f97316;
            --gray-bg: #f4f5f7;
            --lt-gray: #e2e4e8;
            --mid-gray: #6b7280;
            --radius: 10px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--gray-bg);
            color: var(--navy);
        }

        h1,
        h2,
        h3 {
            font-family: 'Barlow Condensed', sans-serif;
        }

        /* ── NAVBAR ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--lt-gray);
            padding: 16px 40px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .back-btn {
            width: 36px;
            height: 36px;
            border: 1.5px solid var(--lt-gray);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            text-decoration: none;
            font-size: 16px;
            transition: all .2s;
        }

        .back-btn:hover {
            background: var(--navy);
            color: #fff;
            border-color: var(--navy);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            background: #fff;
            border-bottom: 1px solid var(--lt-gray);
            padding: 40px 40px 36px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
        }

        .page-header-left h1 {
            font-size: clamp(36px, 5vw, 56px);
            font-weight: 900;
            text-transform: uppercase;
            color: var(--navy);
            line-height: 1;
            margin-bottom: 8px;
        }

        .page-header-left p {
            font-size: 15px;
            color: var(--mid-gray);
        }

        .review-cta-box {
            border-left: 3px solid var(--blue);
            padding: 16px 24px;
            min-width: 220px;
            text-align: center;
            flex-shrink: 0;
        }

        .review-cta-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--mid-gray);
            margin-bottom: 8px;
        }

        .review-cta-stars {
            color: var(--orange);
            font-size: 20px;
            display: flex;
            justify-content: center;
            gap: 4px;
            margin-bottom: 10px;
        }

        .btn-write-review {
            background: none;
            border: none;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color .2s;
        }

        .btn-write-review:hover {
            color: var(--blue-lt);
        }

        /* ── REVIEW LIST ── */
        .review-list {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .review-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 28px 32px;
            border: 1px solid var(--lt-gray);
        }

        .review-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 14px;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .reviewer-avatar {
            width: 52px;
            height: 52px;
            border-radius: 8px;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--mid-gray);
            font-size: 24px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .reviewer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .reviewer-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.5px;
            /* text-transform: uppercase; */
            color: var(--navy);
        }

        .reviewer-role {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            /* text-transform: uppercase; */
            color: var(--mid-gray);
            margin-top: 2px;
        }

        .review-stars-sm {
            color: var(--orange);
            font-size: 16px;
            display: flex;
            gap: 2px;
            flex-shrink: 0;
        }

        .review-text {
            font-size: 15px;
            line-height: 1.8;
            color: #374151;
            margin-bottom: 16px;
        }

        .btn-reply {
            background: none;
            border: none;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 0;
            transition: color .2s;
        }

        .btn-reply:hover {
            color: var(--blue-lt);
        }

        /* ── ADMIN REPLY ── */
        .admin-reply {
            margin-top: 16px;
            background: #f8f9fc;
            border-left: 3px solid var(--blue);
            border-radius: 0 8px 8px 0;
            padding: 16px 20px;
        }

        .admin-reply-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 13px;
        }

        .admin-name {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--blue);
        }

        .reply-date {
            font-size: 11px;
            color: var(--mid-gray);
            letter-spacing: 0.5px;
        }

        .admin-reply-text {
            font-size: 14px;
            line-height: 1.75;
            color: var(--mid-gray);
            font-style: italic;
        }

        /* ── EMPTY STATE ── */
        .review-empty {
            text-align: center;
            padding: 80px 0;
            color: var(--mid-gray);
        }

        .review-empty i {
            font-size: 56px;
            display: block;
            margin-bottom: 16px;
            opacity: .3;
        }

        /* ── MODAL ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(13, 27, 46, 0.55);
            z-index: 1000;
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 12px;
            width: 100%;
            max-width: 580px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalIn .25s ease both;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(.97);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 28px 0;
            margin-bottom: 24px;
        }

        .modal-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-step {
            width: 28px;
            height: 28px;
            background: var(--blue);
            border-radius: 6px;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .modal-title h2 {
            font-size: 22px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--navy);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--mid-gray);
            cursor: pointer;
            transition: color .2s;
            line-height: 1;
        }

        .modal-close:hover {
            color: var(--navy);
        }

        .modal-body {
            padding: 0 28px 28px;
        }

        /* ── FORM ── */
        .form-label-custom {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--navy);
            margin-bottom: 8px;
            display: block;
        }

        .form-label-custom span {
            color: var(--orange);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control-custom {
            width: 100%;
            border: 1.5px solid var(--lt-gray);
            border-radius: 6px;
            padding: 12px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--navy);
            background: #f8f9fb;
            outline: none;
            transition: border-color .2s;
            resize: none;
        }

        .form-control-custom:focus {
            border-color: var(--blue);
            background: #fff;
        }

        .form-control-custom::placeholder {
            color: #aab0bc;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .char-count {
            text-align: right;
            font-size: 11px;
            color: var(--mid-gray);
            margin-top: 4px;
        }

        /* ── STAR RATING ── */
        .star-rating-wrap {
            display: flex;
            flex-direction: row;
            /* ← kiri ke kanan */
            gap: 6px;
            margin-bottom: 4px;
        }

        .star-rating-wrap input {
            display: none;
        }

        .star-rating-wrap label {
            font-size: 28px;
            color: #d1d5db;
            cursor: pointer;
            transition: color .15s;
            line-height: 1;
        }

        /* Highlight bintang yang dipilih dan sebelumnya */
        .star-rating-wrap input:checked~label {
            color: #d1d5db;
            /* reset semua setelahnya */
        }

        .star-rating-wrap input:checked+label,
        .star-rating-wrap input:checked~input:checked+label {
            color: var(--orange);
        }

        .star-rating {
            display: flex;
            gap: 6px;
            margin-bottom: 4px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 28px;
            color: #d1d5db;
            cursor: pointer;
            transition: color .15s;
            line-height: 1;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: var(--orange);
        }

        .star-rating {
            flex-direction: row-reverse;
        }

        .star-rating label:hover,
        .star-rating input:checked~label {
            color: var(--orange);
        }

        .star-rating label:hover~label {
            color: var(--orange);
        }

        /* ── CHECKBOX ── */
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 24px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: var(--blue);
            flex-shrink: 0;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 13px;
            line-height: 1.6;
            color: var(--mid-gray);
            cursor: pointer;
        }

        .checkbox-group label a {
            color: var(--blue);
        }

        .anonymous-note {
            font-size: 13px;
            color: var(--mid-gray);
            margin-bottom: 16px;
            display: none;
        }

        /* ── SUBMIT BTN ── */
        .btn-submit {
            width: 100%;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 16px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background .2s, transform .15s;
        }

        .btn-submit:hover {
            background: var(--blue-lt);
            transform: translateY(-1px);
        }

        /* ── SUCCESS MSG ── */
        .success-msg {
            display: none;
            text-align: center;
            padding: 40px 28px;
        }

        .success-msg i {
            font-size: 56px;
            color: #22c55e;
            display: block;
            margin-bottom: 16px;
        }

        .success-msg h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .success-msg p {
            font-size: 15px;
            color: var(--mid-gray);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 600px) {
            .page-header {
                flex-direction: column;
                gap: 20px;
                padding: 24px 20px;
            }

            .review-list {
                padding: 0 16px;
                margin: 24px auto;
            }

            .topbar {
                padding: 14px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .modal-body,
            .modal-header {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- TOPBAR --}}
    <div class="topbar">
        <a href="{{ route('homepage') }}#review" class="back-btn"><i class="bi bi-arrow-left"></i></a>
    </div>

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div class="page-header-left">
            <h1>Ulasan dari Klien Kami</h1>
            <p>Terimakasih telah meninggalkan ulasan</p>
        </div>
        <div class="review-cta-box">
            <div class="review-cta-label">Tinggalkan Ulasan Anda</div>
            <div class="review-cta-stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <button class="btn-write-review" onclick="openModal()">Ulasan Anda</button>
        </div>
    </div>

    {{-- REVIEW LIST --}}
    <div class="review-list">

        @forelse($reviews as $review)
        <div class="review-card">
            <div class="review-card-header">
                <div class="reviewer-info">
                    <div class="reviewer-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div>
                        <div class="reviewer-name">{{ $review->anonymous ? 'Anonim' : ($review->reviewer->nama ?? 'Anonim') }}</div>
                        @unless($review->anonymous)
                        <div class="reviewer-role">{{ $review->reviewer->email ?? '' }}</div>
                        @endunless
                    </div>
                </div>

                {{-- Bintang sesuai rating dari DB --}}
                <div class="review-stars-sm">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <=($review->rating ?? 5))
                        <i class="bi bi-star-fill" style="color:var(--orange);"></i>
                        @else
                        <i class="bi bi-star" style="color:#d1d5db;"></i>
                        @endif
                        @endfor
                </div>
            </div>

            <p class="review-text">{{ $review->pesan }}</p>

            {{-- Admin Reply — hanya tampil kalau ada balasan --}}
            @if($review->balasan)
            <div class="admin-reply">
                <div class="admin-reply-header">
                    <div class="admin-info">
                        <div class="admin-avatar"><i class="bi bi-shield-fill"></i></div>
                        <div class="admin-name">{{ $review->admin->nama_admin ?? 'PT BAT Admin' }}</div>
                    </div>
                </div>
                <p class="admin-reply-text">"{{ $review->balasan }}"</p>
            </div>
            @endif
        </div>
        @empty
        <div class="review-empty">
            <i class="bi bi-chat-square-text"></i>
            <p>Belum ada ulasan. Jadilah yang pertama!</p>
        </div>
        @endforelse

    </div>

    {{-- MODAL --}}
    <div class="modal-overlay" id="reviewModal" onclick="handleOverlayClick(event)">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-title">
                    <div class="modal-step">1</div>
                    <h2>Ulasan Anda</h2>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body" id="modalFormBody">
                <form id="reviewForm" action="{{ route('pengunjung.review.store') }}" method="POST">
                    @csrf

                    {{-- Star Rating --}}
                    <div class="form-group">
                        <label class="form-label-custom">Peringkat Keseluruhan <span>*</span></label>
                        <div class="star-rating-wrap">
                            <input type="radio" name="rating" id="star1" value="1">
                            <label for="star1"><i class="bi bi-star-fill"></i></label>
                            <input type="radio" name="rating" id="star2" value="2">
                            <label for="star2"><i class="bi bi-star-fill"></i></label>
                            <input type="radio" name="rating" id="star3" value="3">
                            <label for="star3"><i class="bi bi-star-fill"></i></label>
                            <input type="radio" name="rating" id="star4" value="4">
                            <label for="star4"><i class="bi bi-star-fill"></i></label>
                            <input type="radio" name="rating" id="star5" value="5" checked>
                            <label for="star5"><i class="bi bi-star-fill"></i></label>
                        </div>
                        <div style="font-size:12px;color:var(--mid-gray);margin-top:6px;">
                            Rating: <strong id="rating-value">5</strong> bintang
                        </div>
                    </div>
                    {{-- Ulasan --}}
                    <div class="form-group">
                        <label class="form-label-custom" for="pesan">Ulasan <span>*</span></label>
                        <textarea
                            id="pesan"
                            name="pesan"
                            class="form-control-custom"
                            rows="5"
                            maxlength="1000"
                            placeholder="Ceritakan pengalaman Anda bekerja bersama kami..."
                            oninput="updateCount(this)"
                            required></textarea>
                        <div class="char-count"><span id="charCount">0</span> / 1000</div>
                    </div>

                    {{-- Opsi Anonim --}}
                    <div class="checkbox-group">
                        <input type="checkbox" id="anonymous" name="anonymous" value="1">
                        <label for="anonymous">Kirim sebagai anonim (nama dan email tidak akan terlihat)</label>
                    </div>

                    {{-- Nama & Email --}}
                    <div class="form-row" id="reviewerFields">
                        <div class="form-group">
                            <label class="form-label-custom" for="nama">Nama Pengguna <span>*</span></label>
                            <input type="text" id="nama" name="nama" class="form-control-custom" placeholder="Nama lengkap Anda" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom" for="email">Email <span>*</span></label>
                            <input type="email" id="email" name="email" class="form-control-custom" placeholder="alamat@email.com" required>
                        </div>
                    </div>
                    <div class="anonymous-note" id="anonymousNote">Ulasan akan dikirim tanpa menampilkan nama dan email.</div>

                    {{-- Checkbox --}}
                    <div class="checkbox-group">
                        <input type="checkbox" id="agree" required>
                        <label for="agree">
                            Saya menyetujui <a href="#">Syarat dan Ketentuan</a> serta memberikan izin kepada
                            PT BAT untuk mempublikasikan ulasan ini secara transparan untuk
                            keperluan jaminan kualitas.
                        </label>
                    </div>

                    <button type="submit" class="btn-submit">Kirim</button>
                </form>
            </div>

            {{-- Success State --}}
            <div class="success-msg" id="successMsg">
                <i class="bi bi-check-circle-fill"></i>
                <h3>Ulasan Terkirim!</h3>
                <p>Terima kasih telah meninggalkan ulasan. Tim kami akan meninjau dan mempublikasikannya segera.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ── Star Rating ──
        const stars = document.querySelectorAll('.star-rating-wrap input');
        const labels = document.querySelectorAll('.star-rating-wrap label');

        function updateStars(value) {
            labels.forEach((label, index) => {
                label.style.color = index < value ? 'var(--orange)' : '#d1d5db';
            });
            document.getElementById('rating-value').textContent = value;
        }

        updateStars(5); // default 5 bintang

        stars.forEach((input, index) => {
            input.nextElementSibling.addEventListener('mouseover', () => {
                updateStars(index + 1);
            });

            input.nextElementSibling.addEventListener('mouseout', () => {
                const checked = document.querySelector('.star-rating-wrap input:checked');
                updateStars(checked ? parseInt(checked.value) : 5);
            });

            input.addEventListener('change', () => {
                updateStars(index + 1);
            });
        });

        // ── Modal ──
        function openModal() {
            document.getElementById('reviewModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('reviewModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        function handleOverlayClick(e) {
            if (e.target === document.getElementById('reviewModal')) closeModal();
        }

        function updateCount(el) {
            document.getElementById('charCount').textContent = el.value.length;
        }

        function updateAnonymousMode() {
            const anonymous = document.getElementById('anonymous').checked;
            const reviewerFields = document.getElementById('reviewerFields');
            const anonymousNote = document.getElementById('anonymousNote');
            const nameInput = document.getElementById('nama');
            const emailInput = document.getElementById('email');

            reviewerFields.style.display = anonymous ? 'none' : 'grid';
            anonymousNote.style.display = anonymous ? 'block' : 'none';
            nameInput.required = !anonymous;
            emailInput.required = !anonymous;
        }

        document.getElementById('anonymous').addEventListener('change', updateAnonymousMode);
        updateAnonymousMode();

        // ── Form Submit — HANYA SATU ──
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');

            // Disable tombol agar tidak submit 2x
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengirim...';

            const data = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: data
                })
                .then(async res => {

                    const result = await res.json();

                    if (!res.ok) {
                        console.log(result);
                        throw new Error(result.message || JSON.stringify(result.errors));
                    }

                    return result;
                })
                .then(data => {
                    if (data.success) {
                        document.getElementById('modalFormBody').style.display = 'none';
                        document.getElementById('successMsg').style.display = 'block';

                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                })
                .catch(err => {
                    console.error(err);

                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Kirim';

                    alert(err.message);
                });
        });
    </script>
</body>

</html>