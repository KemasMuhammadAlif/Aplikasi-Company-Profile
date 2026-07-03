@extends('layouts.app')

@section('title', 'Manajemen Ulasan')
@section('search_placeholder', 'Search Service...')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Admin</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Ulasan</span>
    </div>

    <h1 class="page-title">Manajemen Ulasan</h1>

    {{-- Ulasan Grid --}}
    <div class="ulasan-grid">

        @forelse ($ulasans as $ulasan)
            <div class="ulasan-card">

                {{-- Card Header --}}
                <div class="ulasan-card-header">
                    <span class="ulasan-header-icon">
                        <i class="bi bi-chat-square-text"></i>
                    </span>
                    <span class="ulasan-header-label">
                        {{ $ulasan->reviewer->nama ?? 'Anonim' }}
                        @if($ulasan->anonymous)
                            <small style="font-size:10px;color:#64748b;margin-left:8px;">(Anonim publik)</small>
                        @endif

                    {{-- Bintang Rating --}}
                    <span style="margin-left:auto;color:#f97316;font-size:11px;display:flex;gap:2px;">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($ulasan->rating ?? 5))
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star" style="color:#d1d5db;"></i>
                            @endif
                        @endfor
                    </span>
                </div>

                {{-- Card Body --}}
                <div class="ulasan-card-body">
                    <p class="ulasan-text">{{ $ulasan->pesan }}</p>

                    {{-- Tampilkan balasan kalau ada --}}
                    @if($ulasan->balasan)
                        <div
                            style="margin-top:12px;padding:10px 14px;background:#f0f6ff;border-left:3px solid #2563eb;border-radius:0 8px 8px 0;">
                            <div
                                style="font-size:10px;font-weight:700;color:#2563eb;letter-spacing:1px;text-transform:uppercase;margin-bottom:6px;">
                                <i class="bi bi-shield-fill"></i> Balasan Admin
                            </div>
                            <p style="font-size:13px;color:#475569;line-height:1.65;margin:0;font-style:italic;">
                                {{ $ulasan->balasan }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Card Footer --}}
                {{-- Card Footer --}}
                <div class="ulasan-card-footer">

                    {{-- Email memanjang ke kanan --}}
                    <div class="ulasan-footer-email">
                        {{ $ulasan->reviewer->email ?? '' }}
                    </div>

                    {{-- Tombol di bawah email --}}
                    <div class="ulasan-footer-actions">
                        {{-- Balas --}}
                        <button class="ulasan-reply-btn" onclick="openBalasUlasan(
                        '{{ $ulasan->id_review }}',
                        '{{ addslashes($ulasan->balasan ?? '') }}')">
                            <i class="bi bi-reply"></i>
                            {{ $ulasan->balasan ? 'Edit Balasan' : 'Balas' }}
                        </button>

                        {{-- Hapus --}}
                        <button class="ulasan-delete-btn" onclick="openHapusUlasan('{{ $ulasan->id_review }}')">
                            <i class="bi bi-trash"></i>
                            Hapus
                        </button>
                    </div>

                </div>

            </div>
        @empty
            <div class="text-muted" style="grid-column:1/-1;padding:60px 0;text-align:center;font-size:14px;">
                Belum ada ulasan.
            </div>
        @endforelse

        {{-- Pesan tidak ditemukan saat search --}}
        <div id="search-empty-msg" style="display:none;grid-column:1/-1;padding:48px 0;text-align:center;">
            <i class="bi bi-search" style="font-size:32px;color:#cbd5e1;display:block;margin-bottom:12px;"></i>
            <p style="font-size:14px;color:#94a3b8;margin:0;">Tidak ada ulasan yang cocok.</p>
        </div>

    </div>

    </div>
    </div>
    </div>

    {{-- ════════════════════════════════════════
    MODAL: BALAS ULASAN
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalBalasUlasan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
            <div class="modal-content border-0 overflow-hidden"
                style="border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.25);">

                {{-- Header: dark navy, uppercase --}}
                <div
                    style="background: #1a2236; padding: 18px 22px; display: flex; align-items: center; justify-content: space-between;">
                    <h5
                        style="font-size: 14px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.8px; margin: 0;">
                        Balas Ulasan
                    </h5>
                    <button type="button" data-bs-dismiss="modal"
                        style="width: 28px; height: 28px; border-radius: 6px; border: none; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.70); display: flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: background 0.15s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.18)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- Body --}}
                <div style="background: #fff; padding: 22px 22px 24px;">
                    <form id="formBalasUlasan" action="#" method="POST">
                        @csrf

                        <input type="hidden" name="id_testimoni" id="balas_id_testimoni">

                        {{-- Label + Textarea --}}
                        <div style="margin-bottom: 20px;">
                            <label
                                style="display: block; font-size: 9.5px; font-weight: 700; letter-spacing: 0.9px; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">
                                Tulis Balasan Anda
                            </label>
                            <textarea name="balasan" id="balas_text" rows="5" placeholder="Tuliskan balasan anda"
                                style="width: 100%; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 11px 14px; font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; background: #f8fafc; outline: none; resize: none; line-height: 1.6; transition: border-color 0.2s, box-shadow 0.2s;"
                                onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.10)'; this.style.background='#fff'"
                                onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.background='#f8fafc'"></textarea>
                        </div>

                        {{-- Buttons --}}
                        <div style="display: flex; justify-content: flex-end; gap: 8px;">
                            <button type="button" data-bs-dismiss="modal"
                                style="height: 36px; padding: 0 16px; border: none; border-radius: 6px; background: #f1f5f9; color: #374151; font-size: 11px; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; transition: background 0.15s;"
                                onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                Batal
                            </button>
                            <button type="submit"
                                style="height: 36px; padding: 0 18px; border: none; border-radius: 6px; background: #2563eb; color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; transition: background 0.18s, box-shadow 0.18s;"
                                onmouseover="this.style.background='#1d4ed8'; this.style.boxShadow='0 4px 14px rgba(37,99,235,0.30)'"
                                onmouseout="this.style.background='#2563eb'; this.style.boxShadow='none'">
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- ════════════════════════════════════════
    MODAL: HAPUS ULASAN
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalHapusUlasan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content border-0 overflow-hidden"
                style="border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.25);">

                {{-- Header --}}
                <div
                    style="background: #1a2236; padding: 18px 22px; display: flex; align-items: flex-start; justify-content: space-between;">
                    <div>
                        <div
                            style="font-size: 10px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: #6b89c0; margin-bottom: 4px;">
                            Konfirmasi
                        </div>
                        <h5 style="font-size: 14px; font-weight: 800; color: #fff; margin: 0;">
                            Hapus Ulasan
                        </h5>
                    </div>
                    <button type="button" data-bs-dismiss="modal"
                        style="width: 28px; height: 28px; border-radius: 6px; border: none; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.70); display: flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: background 0.15s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.18)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- Body --}}
                <div style="background: #fff; padding: 22px 22px 24px;">
                    <p style="font-size: 14px; color: #475569; margin-bottom: 20px; line-height: 1.6;">
                        Apakah Anda yakin ingin menghapus ulasan ini?
                        Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                    </p>

                    <form id="formHapusUlasan" method="POST">
                        @csrf
                        @method('DELETE')

                        <div style="display: flex; justify-content: flex-end; gap: 8px;">
                            <button type="button" data-bs-dismiss="modal"
                                style="height: 36px; padding: 0 16px; border: none; border-radius: 6px; background: #f1f5f9; color: #374151; font-size: 11px; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; transition: background 0.15s;"
                                onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                Batal
                            </button>
                            <button type="submit"
                                style="height: 36px; padding: 0 18px; border: none; border-radius: 6px; background: #ef4444; color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 0.6px; text-transform: uppercase; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; transition: background 0.18s, box-shadow 0.18s;"
                                onmouseover="this.style.background='#dc2626'; this.style.boxShadow='0 4px 14px rgba(239,68,68,0.30)'"
                                onmouseout="this.style.background='#ef4444'; this.style.boxShadow='none'">
                                Ya, Hapus
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* ══ ULASAN GRID ══ */
        .ulasan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 18px;
        }

        /* ══ ULASAN CARD ══ */
        .ulasan-card {
            background: #fff;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            min-height: 220px;
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
            border: 1px solid #f1f5f9;
        }

        .ulasan-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.09);
            transform: translateY(-2px);
        }

        /* ── Card Header ── */
        .ulasan-card-header {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 14px 16px 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .ulasan-header-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .ulasan-header-label {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
        }

        /* ── Card Body ── */
        .ulasan-card-body {
            padding: 14px 16px;
            flex: 1;
        }

        .ulasan-text {
            font-size: 13px;
            color: #1e293b;
            line-height: 1.70;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 6;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ── Card Footer ── */
        .ulasan-card-footer {
            display: flex;
            flex-direction: column;
            /* ← ubah jadi column */
            gap: 8px;
            padding: 10px 14px 12px;
            border-top: 1px solid #f8fafc;
        }

        .ulasan-footer-email {
            font-size: 11px;
            color: #94a3b8;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            /* ← email memanjang dengan ... kalau kepanjangan */
            width: 100%;
        }

        .ulasan-footer-actions {
            display: flex;
            gap: 6px;
            justify-content: flex-end;
            /* ← tombol di kanan */
        }

        /* ══ REPLY BUTTON ══ */
        .ulasan-reply-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            height: 28px;
            padding: 0 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .ulasan-reply-btn:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #93c5fd;
        }

        .ulasan-reply-btn i {
            font-size: 12px;
        }

        /* ══ DELETE BUTTON ══ */
        .ulasan-delete-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            height: 28px;
            padding: 0 10px;
            border-radius: 6px;
            border: 1px solid #fee2e2;
            background: #fff5f5;
            color: #ef4444;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .ulasan-delete-btn:hover {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .ulasan-delete-btn i {
            font-size: 12px;
        }

        @media (max-width: 576px) {
            .ulasan-grid {
                grid-template-columns: 1fr;
            }
            .ulasan-card-header {
                flex-wrap: wrap;
                gap: 6px;
            }
            .ulasan-card-header span:last-child {
                margin-left: 0 !important;
                width: 100%;
                margin-top: 4px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function openBalasUlasan(id, existingBalasan) {
            document.getElementById('balas_id_testimoni').value = id;
            document.getElementById('balas_text').value = existingBalasan || '';
            document.getElementById('formBalasUlasan').action = '/admin/ulasan/' + id + '/balas';
            new bootstrap.Modal(document.getElementById('modalBalasUlasan')).show();
        }

        function openHapusUlasan(id) {
            document.getElementById('formHapusUlasan').action = '/admin/ulasan/' + id;
            new bootstrap.Modal(document.getElementById('modalHapusUlasan')).show();
        }
    </script>
@endpush