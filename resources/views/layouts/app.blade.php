<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT BAT - @yield('title', 'Portfolio Management')</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #1a2236;
            --sidebar-width: 220px;
            --sidebar-text: #a8b4cc;
            --sidebar-active-bg: #2563eb;
            --sidebar-hover-bg: rgba(255, 255, 255, 0.06);
            --topbar-height: 64px;
            --body-bg: #f4f6fb;
            --card-radius: 12px;
            --badge-infra: #f59e0b;
            --badge-commercial: #6366f1;
            --badge-energy: #10b981;
            --status-active: #22c55e;
            --status-planning: #f59e0b;
            --status-completed: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--body-bg);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* ───── SIDEBAR ───── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow: hidden;
        }

        .sidebar-brand {
            padding: 20px 24px 16px;
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            flex-shrink: 0;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 12px;
            overflow-y: auto;
        }

        .nav-item-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 8px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            margin-bottom: 2px;
        }

        .nav-item-custom i {
            font-size: 16px;
            width: 18px;
            flex-shrink: 0;
        }

        .nav-item-custom:hover {
            background: var(--sidebar-hover-bg);
            color: #fff;
        }

        .nav-item-custom.active {
            background: var(--sidebar-active-bg);
            color: #ffffff;
            font-weight: 600;
        }

        .sidebar-user {
            padding: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: var(--sidebar-active-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-info .user-name {
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.3;
        }

        .user-info .user-role {
            color: var(--sidebar-text);
            font-size: 10.5px;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        /* ───── MAIN WRAPPER ───── */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ───── TOPBAR ───── */
        .topbar {
            height: var(--topbar-height);
            background: #ffffff;
            border-bottom: 1px solid #e8ecf2;
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .search-wrap {
            flex: 1;
            max-width: 420px;
        }

        .search-input {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 8px 14px 8px 38px;
            font-size: 13.5px;
            background: #f8fafc;
            color: #374151;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background: #fff;
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px;
            pointer-events: none;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-left: auto;
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }

        .icon-btn:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .topbar-divider {
            width: 1px;
            height: 22px;
            background: #e2e8f0;
            margin: 0 8px;
        }

        .btn-support {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 6px 16px;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            background: #fff;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-support:hover {
            background: #f8fafc;
        }

        .btn-profile {
            border: none;
            border-radius: 8px;
            padding: 6px 18px;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            background: var(--sidebar-active-bg);
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-profile:hover {
            background: #1d4ed8;
        }

        /* ───── PAGE CONTENT ───── */
        .page-content {
            flex: 1;
            padding: 32px 32px;
        }

        /* ───── BREADCRUMB ───── */
        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 500;
            color: #9ca3af;
            margin-bottom: 10px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .breadcrumb-custom a {
            color: #9ca3af;
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            color: #374151;
        }

        .breadcrumb-custom .bc-active {
            color: var(--sidebar-active-bg);
            font-weight: 600;
        }

        .breadcrumb-custom .bc-sep {
            color: #d1d5db;
        }

        .page-title {
            font-size: 30px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 28px;
            letter-spacing: -0.3px;
        }

        /* ───── PROJECT GRID ───── */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        /* ───── ADD NEW CARD ───── */
        .add-project-card {
            border: 2px dashed #cbd5e1;
            border-radius: var(--card-radius);
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            min-height: 260px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            text-decoration: none;
        }

        .add-project-card:hover {
            border-color: #2563eb;
            background: #f0f6ff;
        }

        .add-icon-wrap {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #64748b;
            transition: background 0.2s, color 0.2s;
        }

        .add-project-card:hover .add-icon-wrap {
            background: #dbeafe;
            color: #2563eb;
        }

        .add-project-label {
            font-size: 12.5px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        /* ───── PROJECT CARD ───── */
        .project-card {
            border-radius: var(--card-radius);
            background: #fff;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: box-shadow 0.2s, transform 0.2s;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            flex-direction: column;
        }

        .project-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            transform: translateY(-2px);
        }

        .card-img-wrap {
            position: relative;
            height: 160px;
            overflow: hidden;
        }

        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* category badge on image */
        .cat-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 4px;
            color: #fff;
        }

        .cat-infrastructure {
            background: var(--badge-infra);
        }

        .cat-commercial {
            background: var(--badge-commercial);
        }

        .cat-energy {
            background: var(--badge-energy);
        }

        .cat-default {
            background: #2563eb;
        }

        .card-body-custom {
            padding: 18px 18px 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title-custom {
            font-size: 15.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 6px;
        }

        .card-desc {
            font-size: 12.5px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 14px;
            flex: 1;
        }

        .card-footer-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-date {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: #94a3b8;
            font-weight: 500;
        }

        .card-date i {
            font-size: 12px;
        }

        /* status badges */
        .status-badge {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .status-active {
            background: #dcfce7;
            color: #15803d;
        }

        .status-planning {
            background: #fef3c7;
            color: #b45309;
        }

        .status-completed {
            background: #f1f5f9;
            color: #475569;
        }

        .status-on-hold {
            background: #fee2e2;
            color: #b91c1c;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ═══════════ SIDEBAR ═══════════ --}}
    <aside class="sidebar">
        <div class="sidebar-brand">PT BAT</div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.project') }}"
                class="nav-item-custom {{ request()->routeIs('admin.project') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                Projects
            </a>
            <a href="{{ route('admin.layanan') }}"
                class="nav-item-custom {{ request()->routeIs('admin.layanan') ? 'active' : '' }}">
                <i class="bi bi-layers"></i>
                Layanan
            </a>
            <a href="{{ route('admin.sertifikat') }}"
                class="nav-item-custom {{ request()->routeIs('admin.sertifikat') ? 'active' : '' }}">
                <i class="bi bi-patch-check"></i>
                Sertifikat
            </a>
            <a href="{{ route('admin.faq') }}"
                class="nav-item-custom {{ request()->routeIs('admin.faq') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                FAQ
            </a>

            <form method="POST" action="{{ route('admin.logout') }}" id="logout-form" style="display:none;">
                @csrf
            </form>
            <a href="#" class="nav-item-custom" style="color: #f87171; margin-top: 8px;"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                Keluar
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="user-avatar">A</div>
            <div class="user-info">
                <div class="user-name">Admin User Profile</div>
                <div class="user-role">Construction Management</div>
            </div>
        </div>
    </aside>

    {{-- ═══════════ MAIN ═══════════ --}}
    <div class="main-wrapper">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="search-wrap position-relative">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="search-input" placeholder="@yield('search_placeholder', 'Search...')">
            </div>

            <div class="topbar-actions">
                <button class="icon-btn" title="Notifications">
                    <i class="bi bi-bell"></i>
                </button>
                <button class="icon-btn" title="Help">
                    <i class="bi bi-question-circle"></i>
                </button>
                <div class="topbar-divider"></div>
                <button class="btn-support">Support</button>
                <button class="btn-profile">Profile</button>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="page-content">
            @yield('content')
        </main>

    </div>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>