@extends('layouts.app')

@section('title', 'Profil Perusahaan')
@section('search_placeholder', 'Search Service...')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Admin</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Profil Perusahaan</span>
    </div>

    <h1 class="page-title">Manajemen Profil Perusahaan</h1>

    @include('partials.alert')

    {{-- ══════════════════════════════════════
    ROW 1: ADD CARD + LOGO + VISION + MISSION
    ══════════════════════════════════════ --}}
    <div class="profil-top-grid">

        {{-- ADD NEW PROFIL --}}
        <a href="#" class="add-profil-card" data-bs-toggle="modal" data-bs-target="#modalAddProfil">
            <div class="add-profil-icon">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-profil-label">Tambah<br>Profil Perusahaan</span>
        </a>

        {{-- ADD LOGO --}}
        <a href="#" class="add-profil-card" data-bs-toggle="modal" data-bs-target="#modalAddLogo">
            <div class="add-profil-icon">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-profil-label">Ubah<br>Logo Perusahaan</span>
        </a>

        {{-- VISION STATEMENT --}}
        <div class="statement-card">
            <div class="statement-card-header">
                <div class="statement-badge vision-badge">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <div>
                    <div class="statement-type-label">Vision Statement</div>
                    <div class="statement-sub-label">Statement Text</div>
                </div>
            </div>

            <p class="statement-body-text">
                {{ $profil->visi ?? 'To become the global cornerstone of industrial innovation, bridging the gap between traditional...' }}
            </p>

            <div class="statement-card-footer">
                <button class="stmt-icon-btn" onclick="openEditProfil('visi', '{{ addslashes($profil->visi ?? '') }}')">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="stmt-icon-btn stmt-danger" onclick="openDeleteProfil('visi')">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>

        {{-- MISSION STATEMENT --}}
        <div class="statement-card">
            <div class="statement-card-header">
                <div class="statement-badge mission-badge">
                    <i class="bi bi-rocket-takeoff-fill"></i>
                </div>
                <div>
                    <div class="statement-type-label">Mission Statement</div>
                    <div class="statement-sub-label">Mission Objectives</div>
                </div>
            </div>

            <p class="statement-body-text">
                {{ $profil->misi ?? 'Our mission is to engineer high-integrity infrastructure components that exceed safety standards, utilizing....' }}
            </p>

            <div class="statement-card-footer">
                <button class="stmt-icon-btn" onclick="openEditProfil('misi', '{{ addslashes($profil->misi ?? '') }}')">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="stmt-icon-btn stmt-danger" onclick="openDeleteProfil('misi')">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════════════
    ROW 2: COMPANY HISTORY
    ══════════════════════════════════════ --}}
    <div class="history-card">

        {{-- Header bar --}}
        <div class="history-card-header">
            <div class="history-header-left">
                <span class="history-header-icon">
                    <i class="bi bi-clock-history"></i>
                </span>
                <span class="history-header-title">Company History</span>
            </div>
            <div class="history-toolbar">
                <button class="toolbar-btn" onclick="execFormat('bold')" title="Bold">
                    <strong>B</strong>
                </button>
                <button class="toolbar-btn" onclick="execFormat('italic')" title="Italic">
                    <em>I</em>
                </button>
                <button class="toolbar-btn" onclick="execFormat('insertUnorderedList')" title="List">
                    <i class="bi bi-list-ul"></i>
                </button>
            </div>
        </div>

        {{-- Sub-label --}}
        <div class="history-sub-label">Detailed Narrative</div>

        {{-- Editable content area --}}
        <div class="history-editor-wrap">
            <div class="history-editor" id="historyEditor" contenteditable="true"
                data-placeholder="Tuliskan sejarah perusahaan...">
                {!! $profil->sejarah ?? '<p>Founded in 1978 during the peak of the industrial revolution in the Midwest, Industrial Corp began as a small-scale tooling shop specializing in high-tolerance aerospace parts.</p>
                    <p>Over the next four decades, the company survived three major economic shifts by pivoting towards sustainable energy components and robotic...</p>' !!}
            </div>
        </div>

        {{-- Footer: Simpan button --}}
        <div class="history-card-footer">
            <form action="{{ route('admin.profil.history') }}" method="POST" id="formHistory">
                @csrf
                <input type="hidden" name="sejarah" id="historyInput">
                <button type="submit" class="btn-simpan" onclick="submitHistory(event)">
                    Simpan
                </button>
            </form>
        </div>

    </div>

    {{-- ══════════════════════════════════════
    MODAL: TAMBAH PROFIL PERUSAHAAN
    ══════════════════════════════════════ --}}
    <div class="modal fade" id="modalAddProfil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 360px;">
            <div class="modal-content modal-content-custom">

                {{-- HEADER: dark navy, full uppercase --}}
                <div class="modal-header-custom" style="padding: 16px 20px;">
                    <h5 class="modal-title-custom" style="font-size:13px; letter-spacing:1px; text-transform:uppercase;">
                        Tambahkan Profil Perusahaan
                    </h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- BODY --}}
                <div class="modal-body-custom" style="padding: 20px 20px 22px;">
                    <form action="{{ route('admin.profil.store') }}" method="POST" id="formAddProfil">
                        @csrf

                        {{-- Dropdown: Pilih Jenis --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom" style="font-size:9.5px; letter-spacing:0.8px;">
                                Pilih Anda Ingin Menambahkan Apa
                            </label>
                            <div class="profil-select-wrap">
                                <select name="jenis" id="profilJenisSelect" class="form-input-custom profil-select"
                                    onchange="updateProfilPlaceholder(this.value)">
                                    <option value="sejarah">Sejarah</option>
                                    <option value="visi">Visi</option>
                                    <option value="misi">Misi</option>
                                </select>
                                <i class="bi bi-chevron-down profil-select-chevron"></i>
                            </div>
                        </div>

                        {{-- Textarea: Deskripsi --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom" style="font-size:9.5px; letter-spacing:0.8px;">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" id="profilDeskripsiInput"
                                class="form-input-custom form-textarea-custom" rows="5"
                                placeholder="Tuliskan deskripsi anda"></textarea>
                        </div>

                        {{-- Buttons --}}
                        <div class="modal-actions" style="margin-top: 6px;">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn-modal-submit">
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL: TAMBAH LOGO--}}
    <div class="modal fade" id="modalAddLogo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg-custom">
            <div class="modal-content modal-content-custom">

                <div class="modal-header-custom">
                    <div>
                        <div class="modal-eyebrow">Logo PT. Berkah Alam Tabantang</div>
                        <h5 class="modal-title-custom">Tambah Logo</h5>
                    </div>

                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body-custom">

                    <form action="') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                Upload Logo
                            </label>

                            <label class="upload-area" for="addImageInput" id="addUploadArea">
                                <i class="bi bi-upload upload-icon"></i>

                                <span class="upload-label" id="addUploadLabel">
                                    Upload Logo
                                </span>

                                <input
                                    type="file"
                                    name="logo"
                                    id="addImageInput"
                                    accept="image/*"
                                    style="display:none;"
                                    onchange="handleAddFiles(this)">
                            </label>

                            {{-- preview --}}
                            <div class="img-preview-list" id="addPreviewList"></div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn-modal-submit">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════
    MODAL: EDIT VISION / MISSION
    ══════════════════════════════════════ --}}
    <div class="modal fade" id="modalEditProfil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:460px;">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <div>
                        <div class="modal-eyebrow">Edit Profil</div>
                        <h5 class="modal-title-custom" id="editProfilTitle">Edit Statement</h5>
                    </div>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body-custom">
                    <form id="formEditProfil" action="{{ route('admin.profil.update') }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="field" id="editProfilField">
                        <div class="form-group-custom">
                            <label class="form-label-custom" id="editProfilLabel">Teks</label>
                            <textarea name="value" id="editProfilValue" class="form-input-custom form-textarea-custom"
                                rows="5"></textarea>
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

    {{-- ══════════════════════════════════════
    MODAL: DELETE
    ══════════════════════════════════════ --}}
    <div class="modal fade" id="modalDeleteProfil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Hapus Data</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body-custom">
                    <p style="font-size:14px;color:#475569;margin-bottom:20px;">
                        Yakin ingin menghapus <strong id="deleteProfilLabel"></strong>?
                    </p>
                    <form id="formDeleteProfil" action="{{ route('admin.profil.destroy') }}" method="POST">
                        @csrf @method('DELETE')
                        <input type="hidden" name="field" id="deleteProfilField">
                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-submit" style="background:#ef4444;">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* ══ TOP GRID ══ */
        .profil-top-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            margin-bottom: 18px;
        }

        /* ADD CARD */
        .add-profil-card {
            border: 2px dashed #d1d9e6;
            border-radius: 12px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-height: 200px;
            text-decoration: none;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .add-profil-card:hover {
            border-color: #2563eb;
            background: #f0f6ff;
        }

        .add-profil-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #64748b;
            transition: background 0.2s, color 0.2s;
        }

        .add-profil-card:hover .add-profil-icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .add-profil-label {
            font-size: 10.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-align: center;
            line-height: 1.6;
        }

        /* STATEMENT CARD */
        .statement-card {
            background: #fff;
            border-radius: 12px;
            padding: 18px 18px 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            min-height: 200px;
        }

        .statement-card-header {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 14px;
        }

        .statement-badge {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .vision-badge {
            background: #eff6ff;
            color: #2563eb;
        }

        .mission-badge {
            background: #fff7ed;
            color: #f97316;
        }

        .statement-type-label {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            color: #64748b;
        }

        .statement-sub-label {
            font-size: 8.5px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #94a3b8;
            margin-top: 2px;
        }

        .statement-body-text {
            font-size: 13px;
            color: #1e293b;
            line-height: 1.65;
            margin: 0;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .statement-card-footer {
            display: flex;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        .stmt-icon-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.15s;
        }

        .stmt-icon-btn:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #93c5fd;
        }

        .stmt-danger:hover {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
        }

        /* ══ HISTORY CARD ══ */
        .history-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .history-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .history-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .history-header-icon {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .history-header-title {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            color: #374151;
        }

        /*LOGO*/
        .logo-card {
            background: #fff;
            border-radius: 12px;
            padding: 18px 18px 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            min-height: 200px;
        }

        .logo-card-header {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 14px;
        }

        .statement-badge {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .logo-type-label {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            color: #64748b;
        }

        .logo-sub-label {
            font-size: 8.5px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #94a3b8;
            margin-top: 2px;
        }

        .logo-body-text {
            font-size: 13px;
            color: #1e293b;
            line-height: 1.65;
            margin: 0;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .logo-card-footer {
            display: flex;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        .logo-icon-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            cursor: pointer;
            transition: all 0.15s;
        }

        .logo-icon-btn:hover {
            background: #eff6ff;
            color: #2563eb;
            border-color: #93c5fd;
        }

        .logo-danger:hover {
            background: #fee2e2;
            color: #dc2626;
            border-color: #fecaca;
        }

        /* Toolbar */
        .history-toolbar {
            display: flex;
            gap: 4px;
        }

        .toolbar-btn {
            width: 26px;
            height: 26px;
            border-radius: 5px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .toolbar-btn:hover {
            background: #e2e8f0;
        }

        /* Sub-label */
        .history-sub-label {
            padding: 10px 20px 6px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.9px;
            text-transform: uppercase;
            color: #94a3b8;
        }

        /* Editor */
        .history-editor-wrap {
            padding: 0 16px 4px;
        }

        .history-editor {
            min-height: 180px;
            padding: 12px 14px;
            font-size: 13px;
            color: #374151;
            line-height: 1.75;
            outline: none;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            transition: border-color 0.2s, background 0.2s;
        }

        .history-editor:focus {
            border-color: #2563eb;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
        }

        .history-editor:empty::before {
            content: attr(data-placeholder);
            color: #b0bac8;
        }

        .history-editor p {
            margin-bottom: 12px;
        }

        .history-editor p:last-child {
            margin-bottom: 0;
        }

        /* Footer */
        .history-card-footer {
            display: flex;
            justify-content: flex-end;
            padding: 12px 20px;
            border-top: 1px solid #f1f5f9;
            background: #fafafa;
        }

        .btn-simpan {
            height: 36px;
            padding: 0 22px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background 0.18s, box-shadow 0.18s;
        }

        .btn-simpan:hover {
            background: #1d4ed8;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.30);
        }

        /* ══ MODAL ADD PROFIL — select dropdown ══ */
        .profil-select-wrap {
            position: relative;
        }

        .profil-select {
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            padding-right: 36px;
            background: #fff;
            border-color: #e2e8f0;
            font-weight: 500;
            color: #1e293b;
        }

        .profil-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .profil-select-chevron {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 12px;
            pointer-events: none;
            transition: transform 0.2s;
        }

        /* Textarea dalam modal add */
        #profilDeskripsiInput {
            min-height: 110px;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .profil-top-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 580px) {
            .profil-top-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Update placeholder textarea saat pilihan dropdown berubah
        function updateProfilPlaceholder(jenis) {
            const placeholders = {
                sejarah: 'Tuliskan sejarah perusahaan...',
                visi: 'Tuliskan visi perusahaan...',
                misi: 'Tuliskan misi perusahaan...',
            };
            const el = document.getElementById('profilDeskripsiInput');
            if (el) el.placeholder = placeholders[jenis] || 'Tuliskan deskripsi anda';
        }

        function openEditProfil(field, value) {
            const labels = {
                visi: 'Visi Perusahaan',
                misi: 'Misi Perusahaan'
            };
            document.getElementById('editProfilField').value = field;
            document.getElementById('editProfilValue').value = value;
            document.getElementById('editProfilTitle').textContent = 'Edit ' + (labels[field] || field);
            document.getElementById('editProfilLabel').textContent = labels[field] || field;
            new bootstrap.Modal(document.getElementById('modalEditProfil')).show();
        }

        function openDeleteProfil(field) {
            const labels = {
                visi: 'Visi Perusahaan',
                misi: 'Misi Perusahaan'
            };
            document.getElementById('deleteProfilField').value = field;
            document.getElementById('deleteProfilLabel').textContent = labels[field] || field;
            new bootstrap.Modal(document.getElementById('modalDeleteProfil')).show();
        }

        function submitHistory(e) {
            document.getElementById('historyInput').value =
                document.getElementById('historyEditor').innerHTML;
        }

        function execFormat(command) {
            document.getElementById('historyEditor').focus();
            document.execCommand(command, false, null);
        }
    </script>
@endpush