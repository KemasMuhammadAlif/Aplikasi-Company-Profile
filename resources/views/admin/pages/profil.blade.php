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

    {{-- ══════════════════════════════════════
    ROW 1: ADD CARD + LOGO + VISION
    ══════════════════════════════════════ --}}
    <div class="profil-row-1">

        {{-- COL 1: Logo Perusahaan --}}
        <div class="logo-card">
            <div class="logo-card-header">
                <span class="logo-header-icon"><i class="bi bi-image"></i></span>
                <span class="logo-header-label">Logo Perusahaan</span>
            </div>

            <div class="logo-preview-wrap">
                @if (!empty($profil->logo))
                    <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Perusahaan" class="logo-preview-img">
                @else
                    <div class="logo-preview-placeholder">
                        <div class="logo-placeholder-ball"></div>
                    </div>
                @endif
            </div>

            <form action="{{ route('admin.profil.logo') }}" method="POST" enctype="multipart/form-data" id="formChangeLogo">
                @csrf
                <label class="btn-ganti-gambar" for="logoInput">
                    <i class="bi bi-cloud-upload"></i>
                    Ganti Gambar
                </label>
                <input type="file" name="logo" id="logoInput" accept="image/*" style="display:none;"
                    onchange="previewLogo(this)">
            </form>
        </div>

        {{-- COL 2: Vision Statement --}}
        <div class="statement-card">
            <div class="statement-card-header">
                <div class="statement-badge vision-badge">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <div>
                    <div class="statement-type-label">Pernyataan Visi</div>
                    <div class="statement-sub-label">Teks Pernyataan</div>
                </div>
            </div>
            <p class="statement-body-text">
                {{ $profil->visi ?? 'Tuliskan visi perusahaan' }}
            </p>
            <div class="statement-card-footer">
                <button class="stmt-icon-btn" onclick="openEditProfil('visi', '{{ addslashes($profil->visi ?? '') }}')">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </div>


        {{-- COL 3: Mission Statement --}}
        <div class="statement-card">
            <div class="statement-card-header">
                <div class="statement-badge mission-badge">
                    <i class="bi bi-rocket-takeoff-fill"></i>
                </div>
                <div>
                    <div class="statement-type-label">Pernyataan Misi</div>
                    <div class="statement-sub-label">Tujuan Misi</div>
                </div>
            </div>
            <p class="statement-body-text">
                {{ $profil->misi ?? 'Tuliskan misi perusahaan' }}
            </p>
            <div class="statement-card-footer">
                <button class="stmt-icon-btn" onclick="openEditProfil('misi', '{{ addslashes($profil->misi ?? '') }}')">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════
    ROW 3: COMPANY HISTORY
    ══════════════════════════════════════ --}}
    <div class="history-card">

        <div class="history-card-header">
            <div class="history-header-left">
                <span class="history-header-icon">
                    <i class="bi bi-clock-history"></i>
                </span>
                <span class="history-header-title">Sejarah Perusahaan</span>
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

        <div class="history-sub-label">Narasi Terperinci</div>

        <div class="history-editor-wrap">
            <div class="history-editor" id="historyEditor" contenteditable="true"
                data-placeholder="Tuliskan sejarah perusahaan...">
                {!! $profil->sejarah ?? '<p>Founded in 1978 during the peak of the industrial revolution in the Midwest, Industrial Corp began as a small-scale tooling shop specializing in high-tolerance aerospace parts.</p><p>Over the next four decades, the company survived three major economic shifts by pivoting towards sustainable energy components and robotic...</p>' !!}
            </div>
        </div>

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
    MODAL: TAMBAH PROFIL
    ══════════════════════════════════════ --}}
    <div class="modal fade" id="modalAddProfil" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom" style="font-size:13px;letter-spacing:1px;text-transform:uppercase;">
                        Tambahkan Profil Perusahaan
                    </h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body-custom" style="padding:20px 20px 22px;">
                    <form action="{{ route('admin.profil.store') }}" method="POST">
                        @csrf
                        <div style="margin-bottom:14px;">
                            <input type="text" name="judul" class="form-input-custom" placeholder="Dr..."
                                style="font-style:italic;color:#b0bac8;">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom" style="font-size:9.5px;">
                                Pilih Anda Ingin Menambahkan Apa
                            </label>
                            <div style="position:relative;">
                                <select name="jenis" id="profilJenisSelect" class="form-input-custom"
                                    style="padding-right:36px;cursor:pointer;background:#fff;"
                                    onchange="updateProfilPlaceholder(this.value)">
                                    <option value="sejarah">Sejarah</option>
                                    <option value="visi">Visi</option>
                                    <option value="misi">Misi</option>
                                </select>
                                <i class="bi bi-chevron-down"
                                    style="position:absolute;right:13px;top:50%;transform:translateY(-50%);color:#64748b;font-size:12px;pointer-events:none;"></i>
                            </div>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom" style="font-size:9.5px;">Deskripsi</label>
                            <textarea name="deskripsi" id="profilDeskripsiInput"
                                class="form-input-custom form-textarea-custom" rows="5"
                                placeholder="Tuliskan deskripsi anda"></textarea>
                        </div>
                        <div class="modal-actions" style="margin-top:6px;"> <button type="button" class="btn-modal-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn-modal-submit">Establish Service</button>
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
        /* ══ ROW 1: 3 kolom ══ */
        .profil-row-1 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        /* ══ ROW 2: 1 kolom kiri ══ */
        .profil-row-2 {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 16px;
            margin-bottom: 18px;
        }

        /* ══ ADD CARD ══ */
        .add-profil-card {
            border: 2px dashed #d1d9e6;
            border-radius: 12px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-height: 190px;
            text-decoration: none;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .add-profil-card:hover {
            border-color: #2563eb;
            background: #f0f6ff;
        }

        .add-profil-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #64748b;
            transition: background 0.2s, color 0.2s;
        }

        .add-profil-card:hover .add-profil-icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .add-profil-label {
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-align: center;
            line-height: 1.6;
        }

        /* ══ LOGO CARD ══ */
        .logo-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .logo-card-header {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 13px 16px 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .logo-header-icon {
            width: 22px;
            height: 22px;
            border-radius: 5px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            flex-shrink: 0;
        }

        .logo-header-label {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
        }

        /* Preview area */
        .logo-preview-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            min-height: 110px;
        }

        .logo-preview-img {
            max-width: 100%;
            max-height: 100px;
            object-fit: contain;
            border-radius: 8px;
        }

        /* Placeholder — globe/sphere style seperti Figma */
        .logo-preview-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #38bdf8, #0ea5e9 40%, #0369a1 80%, #0c4a6e);
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Ganti Gambar button */
        .btn-ganti-gambar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: calc(100% - 32px);
            margin: 0 16px 14px;
            height: 34px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            background: #fff;
            color: #374151;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s, color 0.2s;
            text-decoration: none;
        }

        .btn-ganti-gambar:hover {
            border-color: #2563eb;
            background: #eff6ff;
            color: #2563eb;
        }

        .btn-ganti-gambar i {
            font-size: 13px;
        }

        /* ══ STATEMENT CARD ══ */
        .statement-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px 16px 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            min-height: 190px;
        }

        .statement-card-header {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
        }

        .statement-badge {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
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
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
        }

        .statement-sub-label {
            font-size: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: #94a3b8;
            margin-top: 2px;
        }

        .statement-body-text {
            font-size: 12.5px;
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
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        .stmt-icon-btn {
            width: 26px;
            height: 26px;
            border-radius: 5px;
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .history-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 18px;
            border-bottom: 1px solid #f1f5f9;
        }

        .history-header-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .history-header-icon {
            width: 24px;
            height: 24px;
            border-radius: 5px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }

        .history-header-title {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #374151;
        }

        .history-toolbar {
            display: flex;
            gap: 3px;
        }

        .toolbar-btn {
            width: 24px;
            height: 24px;
            border-radius: 5px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .toolbar-btn:hover {
            background: #e2e8f0;
        }

        .history-sub-label {
            padding: 8px 18px 4px;
            font-size: 8.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #94a3b8;
        }

        .history-editor-wrap {
            padding: 0 14px 6px;
        }

        .history-editor {
            min-height: 160px;
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
            margin-bottom: 10px;
        }

        .history-editor p:last-child {
            margin-bottom: 0;
        }

        .history-card-footer {
            display: flex;
            justify-content: flex-end;
            padding: 10px 18px;
            border-top: 1px solid #f1f5f9;
            background: #fafafa;
        }

        .btn-simpan {
            height: 34px;
            padding: 0 20px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: #fff;
            font-size: 11.5px;
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

        /* Responsive */
        @media (max-width: 900px) {
            .profil-row-1 {
                grid-template-columns: 1fr 1fr;
            }

            .profil-row-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 580px) {
            .profil-row-1 {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Preview logo sebelum upload
        function previewLogo(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const wrap = document.querySelector('.logo-preview-wrap');
                    wrap.innerHTML = '<img src="' + e.target.result + '" class="logo-preview-img" alt="Preview">';
                };
                reader.readAsDataURL(input.files[0]);
                // Auto submit form
                document.getElementById('formChangeLogo').submit();
            }
        }

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
            const labels = { visi: 'Visi Perusahaan', misi: 'Misi Perusahaan' };
            document.getElementById('editProfilField').value = field;
            document.getElementById('editProfilValue').value = value;
            document.getElementById('editProfilTitle').textContent = 'Edit ' + (labels[field] || field);
            document.getElementById('editProfilLabel').textContent = labels[field] || field;
            new bootstrap.Modal(document.getElementById('modalEditProfil')).show();
        }

        function openDeleteProfil(field) {
            const labels = { visi: 'Visi Perusahaan', misi: 'Misi Perusahaan' };
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