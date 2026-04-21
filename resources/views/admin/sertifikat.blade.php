@extends('layouts.app')

@section('title', 'Certificate Management')
@section('search_placeholder', 'Search Certificate...')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Admin</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Certificates</span>
    </div>

    {{-- Page Header --}}
    <h1 class="cert-page-title">Certificate Management</h1>
    <p class="cert-page-subtitle">
        Manage official company credentials, environmental compliance licenses, and safety
        certifications across all operational branches.
    </p>

    {{-- Certificates Grid --}}
    <div class="cert-grid">

        {{-- ── ADD NEW CERTIFICATE ── --}}
        <a href="#" class="add-cert-card">
            <div class="add-cert-icon">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-cert-label">Add New<br>Certificate</span>
        </a>

        {{-- ── CERTIFICATE CARDS ── --}}
        @forelse ($certificates as $cert)
            <a href="#" class="cert-card" style="background-image: url('{{ $cert['image'] }}');">

                {{-- dark overlay --}}
                <div class="cert-overlay"></div>

                {{-- Card content --}}
                <div class="cert-content">

                    {{-- Top: category badge --}}
                    <div class="cert-top">
                        <span class="cert-cat-badge cert-cat-{{ $cert['category_color'] }}">
                            {{ $cert['category'] }}
                        </span>
                    </div>

                    {{-- Bottom: title + desc + status --}}
                    <div class="cert-bottom">
                        <div class="cert-title">{{ $cert['title'] }}</div>
                        <p class="cert-desc">{{ $cert['description'] }}</p>

                        <div class="cert-footer">
                            <span class="cert-status cert-status-{{ $cert['status_type'] }}">
                                @if ($cert['status_type'] === 'valid')
                                    <i class="bi bi-check-circle-fill"></i>
                                @elseif ($cert['status_type'] === 'expiring')
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                @elseif ($cert['status_type'] === 'lifetime')
                                    <i class="bi bi-shield-fill"></i>
                                @elseif ($cert['status_type'] === 'active')
                                    <i class="bi bi-circle-fill"></i>
                                @elseif ($cert['status_type'] === 'renewal')
                                    <i class="bi bi-arrow-repeat"></i>
                                @endif
                                {{ $cert['status_label'] }}
                            </span>
                            <button class="cert-action-btn" onclick="event.preventDefault()">
                                @if ($cert['status_type'] === 'valid')
                                    <i class="bi bi-box-arrow-up-right"></i>
                                @elseif ($cert['status_type'] === 'expiring')
                                    <i class="bi bi-arrow-clockwise"></i>
                                @elseif ($cert['status_type'] === 'lifetime')
                                    <i class="bi bi-eye"></i>
                                @elseif ($cert['status_type'] === 'active')
                                    <i class="bi bi-pencil"></i>
                                @elseif ($cert['status_type'] === 'renewal')
                                    <i class="bi bi-clock-history"></i>
                                @endif
                            </button>
                        </div>
                    </div>

                </div>
            </a>
        @empty
            <div class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
                Belum ada sertifikat. Klik "Add New Certificate" untuk memulai.
            </div>
        @endforelse

    </div>

@endsection

@push('styles')
    <style>
        /* ── PAGE HEADER ── */
        .cert-page-title {
            font-size: 36px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            line-height: 1.15;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .cert-page-subtitle {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.65;
            max-width: 560px;
            margin-bottom: 28px;
        }

        /* ── GRID ── */
        .cert-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        /* ── ADD NEW CERTIFICATE ── */
        .add-cert-card {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            min-height: 200px;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.2s, background 0.2s;
        }

        .add-cert-card:hover {
            border-color: #2563eb;
            background: #f0f6ff;
        }

        .add-cert-icon {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #64748b;
            transition: background 0.2s, color 0.2s;
        }

        .add-cert-card:hover .add-cert-icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .add-cert-label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-align: center;
            line-height: 1.5;
            text-decoration: none;
        }

        /* ── CERTIFICATE CARD ── */
        .cert-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            min-height: 200px;
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .cert-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
        }

        /* dark gradient overlay */
        .cert-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    rgba(10, 15, 30, 0.45) 0%,
                    rgba(10, 15, 30, 0.72) 55%,
                    rgba(10, 15, 30, 0.90) 100%);
            border-radius: 12px;
        }

        /* content sits above overlay */
        .cert-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
            padding: 16px;
        }

        /* ── CATEGORY BADGE ── */
        .cert-cat-badge {
            display: inline-block;
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 4px;
            color: #fff;
        }

        .cert-cat-blue {
            background: #2563eb;
        }

        .cert-cat-orange {
            background: #f59e0b;
        }

        .cert-cat-gray {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
        }

        .cert-cat-green {
            background: #059669;
        }

        .cert-cat-indigo {
            background: #6366f1;
        }

        /* ── BOTTOM SECTION ── */
        .cert-bottom {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .cert-title {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
            letter-spacing: -0.2px;
        }

        .cert-desc {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.55;
            margin: 0 0 8px;
        }

        /* ── FOOTER: status + action ── */
        .cert-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 10px;
            margin-top: 2px;
        }

        .cert-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .cert-status i {
            font-size: 11px;
        }

        /* status colours */
        .cert-status-valid {
            color: #4ade80;
        }

        .cert-status-expiring {
            color: #fb923c;
        }

        .cert-status-lifetime {
            color: #60a5fa;
        }

        .cert-status-active {
            color: #34d399;
        }

        .cert-status-renewal {
            color: #94a3b8;
        }

        /* action icon button */
        .cert-action-btn {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: none;
            background: rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.80);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            flex-shrink: 0;
        }

        .cert-action-btn:hover {
            background: rgba(255, 255, 255, 0.22);
            color: #fff;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .cert-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 580px) {
            .cert-grid {
                grid-template-columns: 1fr;
            }

            .cert-page-title {
                font-size: 26px;
            }
        }
    </style>
@endpush