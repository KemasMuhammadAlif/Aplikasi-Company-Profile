@extends('layouts.app')

@section('title', 'Manajemen Sertifikat')
@section('search_placeholder', 'Cari sertifikat...')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Admin</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Sertifikat</span>
    </div>

    {{-- Page Header --}}
    <h1 class="cert-page-title">Manajemen Sertifikat</h1>

    {{-- Certificates Grid --}}
    <div class="cert-grid">

        {{-- ── ADD NEW CERTIFICATE ── --}}
        <a href="#" class="add-cert-card" data-bs-toggle="modal" data-bs-target="#modalAddCertificate">
            <div class="add-cert-icon">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-cert-label">Tambah Sertifikat<br>Baru</span>
        </a>

        {{-- ── CERTIFICATE CARDS ── --}}
        {{-- SERVICE CARDS --}}
        @forelse ($certificates as $cert)
            <div class="cert-card">
                <div class="cert-icon-wrap">
                    <i class="bi {{ $cert->icon ?? 'bi-patch-check' }}"></i>
                </div>
                <div class="cert-title">{{ $cert->sertifikat }}</div>

                <div class="cert-actions">
                    <button class="btn-action" onclick="openEditModal(
                                    '{{ $cert->id_dok_perusahaan }}',
                                    '{{ addslashes($cert->sertifikat) }}',
                                    '{{ $cert->icon }}'
                                )">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn-action" onclick="openDeleteModal(
                                    '{{ $cert->id_dok_perusahaan }}',
                                    '{{ addslashes($cert->sertifikat) }}'
                                )">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        @empty
            <div class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;">
                Belum ada sertifikat. Klik "Tambah Sertifikat Baru" untuk memulai.
            </div>
        @endforelse

    </div>

    {{-- ════════════════════════════════════════
    MODAL: ADD NEW CERTIFICATE
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalAddCertificate" tabindex="-1" aria-labelledby="modalAddCertificateLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-add-cert">
            <div class="modal-content modal-content-custom">

                {{-- HEADER (dark navy) --}}
                <div class="modal-header-custom">
                    <div>
                        <h5 class="modal-title-custom" id="modalAddCertificateLabel">
                            Tambah Sertifikat Baru
                        </h5>
                    </div>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- BODY --}}
                {{-- MODAL ADD --}}
                <div class="modal-body-custom">
                    <form action="{{ route('admin.sertifikat.store') }}" method="POST">
                        @csrf

                        <div class="form-group-custom">
                            <label class="form-label-custom">Nama Sertifikat</label>
                            <input type="text" name="sertifikat" class="form-input-custom" placeholder="e.g. ISO 9001:2015">
                        </div>

                        {{-- Icon Selection --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom">Pilihan Icon</label>
                            <input type="hidden" name="icon" id="selectedCertIcon" value="bi-patch-check">

                            <div class="icon-grid">
                                @php
                                    $certIcons = [
                                        'bi-patch-check',
                                        'bi-award',
                                        'bi-diagram-3',
                                        'bi-shield-check',
                                        'bi-clipboard-check',
                                        'bi-check-circle',
                                        'bi-star',
                                        'bi-trophy',
                                        'bi-bookmark-check',
                                        'bi-file-earmark-check',
                                        'bi-person-check',
                                        'bi-building',
                                    ];
                                @endphp

                                @foreach ($certIcons as $icon)
                                    <button type="button" class="icon-option {{ $loop->first ? 'selected' : '' }}"
                                        data-icon="{{ $icon }}"
                                        onclick="selectCertIcon(this, 'selectedCertIcon', 'modalAddCertificate')"
                                        title="{{ $icon }}">
                                        <i class="bi {{ $icon }}"></i>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-submit">Simpan Sertifikat</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditCertificate" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-add-cert">
            <div class="modal-content modal-content-custom">

                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Ubah Sertifikat</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- MODAL EDIT --}}
                <div class="modal-body-custom">
                    <form id="formEditCertificate" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group-custom">
                            <label class="form-label-custom">Nama Sertifikat</label>
                            <input type="text" id="edit_sertifikat" name="sertifikat" class="form-input-custom">
                        </div>

                        {{-- Icon Selection --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom">Pilihan Icon</label>
                            <input type="hidden" name="icon" id="selectedEditCertIcon" value="bi-patch-check">

                            <div class="icon-grid">
                                @foreach ($certIcons as $icon)
                                    <button type="button" class="icon-option" data-icon="{{ $icon }}"
                                        onclick="selectCertIcon(this, 'selectedEditCertIcon', 'modalEditCertificate')"
                                        title="{{ $icon }}">
                                        <i class="bi {{ $icon }}"></i>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteCertificate" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
            <div class="modal-content modal-content-custom">

                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Hapus Sertifikat</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body-custom">
                    <p>
                        Yakin ingin hapus <strong id="delete_cert_name"></strong>?
                    </p>

                    <form id="formDeleteCertificate" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn-modal-submit" style="background:#ef4444;">
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
        /* ════ PAGE HEADER ════ */
        .cert-page-title {
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.3px;
            line-height: 1.20;
            margin-bottom: 28px;
        }

        /* ════ GRID ════ */
        .cert-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        /* ════ ADD CARD ════ */
        .add-cert-card {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            min-height: 240px;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.2s, background 0.2s;
        }

        .add-cert-card:hover {
            border-color: #2563eb;
            background: #f0f6ff;
        }

        .add-cert-icon {
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
        }

        /* ════ CERTIFICATE CARD ════ */
        .cert-card {
            background: #fff;
            border-radius: 12px;
            padding: 28px 24px 24px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            border: 0.5px solid #e2e8f0;
            text-decoration: none;
            min-height: 240px;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .cert-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            transform: translateY(-2px);
        }

        .cert-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #2563eb;
            margin-bottom: 4px;
            flex-shrink: 0;
        }

        .cert-cat-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: #94a3b8;
        }

        .cert-title {
            font-size: 15.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
        }

        .cert-desc {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
            flex: 1;
        }

        /* ════ CARD FOOTER ════ */
        .cert-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #f1f5f9;
            padding-top: 12px;
            margin-top: auto;
        }

        .cert-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 4px 9px;
            border-radius: 6px;
        }

        .cert-status i {
            font-size: 10px;
        }

        .cert-status-valid {
            background: #dcfce7;
            color: #166534;
        }

        .cert-status-expiring {
            background: #fef3c7;
            color: #92400e;
        }

        .cert-status-lifetime {
            background: #eff6ff;
            color: #1e40af;
        }

        .cert-status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .cert-status-renewal {
            background: #f1f5f9;
            color: #475569;
        }

        .cert-action-btn {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            border: 0.5px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            flex-shrink: 0;
            transition: background 0.15s, color 0.15s;
        }

        .cert-action-btn:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        /* ════ MODAL SIZING ════ */
        .modal-add-cert {
            max-width: 440px;
        }

        /* ════ MODAL CONTENT ════ */
        .modal-content-custom {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.22);
        }

        /* ════ MODAL HEADER (dark navy) ════ */
        .modal-header-custom {
            background: #1a2236;
            padding: 20px 24px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .modal-eyebrow {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: #6b89c0;
            margin-bottom: 5px;
        }

        .modal-title-custom {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            /* text-transform: uppercase; */
            letter-spacing: 0.3px;
            margin: 0;
            line-height: 1.2;
        }

        .modal-close-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.70);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            cursor: pointer;
            flex-shrink: 0;
            margin-top: 2px;
            transition: background 0.15s, color 0.15s;
        }

        .modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        /* ════ MODAL BODY ════ */
        .modal-body-custom {
            background: #ffffff;
            padding: 24px 24px 26px;
            position: relative;
            z-index: 20;
        }

        /* ════ FORM GROUP ════ */
        .form-group-custom {
            margin-bottom: 20px;
        }

        .form-label-custom {
            display: block;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.9px;
            /* text-transform: uppercase; */
            color: #64748b;
            margin-bottom: 8px;
        }

        /* ════ INPUT / TEXTAREA ════ */
        .form-input-custom {
            width: 100%;
            height: 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0 14px;
            font-size: 13.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-input-custom::placeholder {
            color: #b0bac8;
        }

        .form-input-custom:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
            background: #fff;
        }

        .form-textarea-custom {
            height: auto;
            padding: 11px 14px;
            resize: none;
            line-height: 1.55;
        }

        /* ════ ICON GRID ════ */
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
        }

        .icon-option {
            aspect-ratio: 1;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #64748b;
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s, color 0.15s;
            padding: 0;
        }

        .icon-option:hover {
            border-color: #93c5fd;
            background: #eff6ff;
            color: #2563eb;
        }

        .icon-option.selected {
            border-color: #2563eb;
            background: #eff6ff;
            color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        /* ════ MODAL ACTION BUTTONS ════ */
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-modal-cancel {
            height: 44px;
            border: none;
            border-radius: 8px;
            background: #f1f5f9;
            color: #374151;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background 0.15s;
        }

        .btn-modal-cancel:hover {
            background: #e2e8f0;
        }

        .btn-modal-submit {
            height: 44px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background 0.18s, box-shadow 0.18s;
        }

        .btn-modal-submit:hover {
            background: #1d4ed8;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.30);
        }

        .cert-card {
            position: relative;
        }

        .cert-actions {
            position: absolute;
            bottom: 12px;
            right: 12px;
            display: flex;
            gap: 6px;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-action:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-modal-cancel,
        .btn-modal-submit {
            height: 34px;
            padding: 0 12px;
            border-radius: 6px;
            font-size: 11px;
            letter-spacing: 0.6px;
        }

        /* ════ RESPONSIVE ════ */
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

@push('scripts')
    <script>
        // ── Icon Picker ──
        function selectCertIcon(el, inputId, modalId) {
            document.querySelectorAll('#' + modalId + ' .icon-option').forEach(btn => {
                btn.classList.remove('selected');
            });
            el.classList.add('selected');
            document.getElementById(inputId).value = el.dataset.icon;
        }

        // ── Buka Modal Edit ──
        function openEditModal(id, sertifikat, icon) {
            document.getElementById('edit_sertifikat').value = sertifikat;
            document.getElementById('selectedEditCertIcon').value = icon;
            document.getElementById('formEditCertificate').action = '/admin/sertifikat/' + id;

            // Set icon aktif
            document.querySelectorAll('#modalEditCertificate .icon-option').forEach(btn => {
                btn.classList.remove('selected');
                if (btn.dataset.icon === icon) btn.classList.add('selected');
            });

            new bootstrap.Modal(document.getElementById('modalEditCertificate')).show();
        }

        // ── Buka Modal Hapus ──
        function openDeleteModal(id, nama) {
            document.getElementById('delete_cert_name').textContent = nama;
            document.getElementById('formDeleteCertificate').action = '/admin/sertifikat/' + id;

            new bootstrap.Modal(document.getElementById('modalDeleteCertificate')).show();
        }
    </script>
@endpush