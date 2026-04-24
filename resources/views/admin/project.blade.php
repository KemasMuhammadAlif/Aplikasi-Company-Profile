@extends('layouts.app')

@section('title', 'Manajemen Proyek')
@section('search_placeholder', 'Cari proyek...')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Admin</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Proyek</span>
    </div>

    {{-- Page Title --}}
    <h1 class="page-title">Manajemen Project</h1>

    {{-- Projects Grid --}}
    <div class="projects-grid">

        {{-- ── ADD NEW PROJECT → trigger modal ── --}}
        <a href="#" class="add-project-card" data-bs-toggle="modal" data-bs-target="#modalAddProject">
            <div class="add-icon-wrap">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-project-label">Tambahkan Proyek</span>
        </a>

        {{-- ── PROJECT CARDS ── --}}
        @forelse ($projects as $project)
            <a href="#" class="project-card">

                <div class="card-img-wrap">
                    @if ($project['image'])
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}">
                    @else
                        <div
                            style="width:100%;height:100%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-image" style="font-size:32px;color:#94a3b8;"></i>
                        </div>
                    @endif
                    <span class="cat-badge cat-{{ strtolower($project['category']) }}">
                        {{ $project['category'] }}
                    </span>
                </div>

                <div class="card-body-custom">
                    <div class="card-title-custom">{{ $project['title'] }}</div>
                    <p class="card-desc">{{ $project['description'] }}</p>
                    <div class="card-footer-custom">
                        <span class="card-date">
                            <i class="bi bi-calendar3"></i>
                            {{ $project['date'] }}
                        </span>
                        <span class="status-badge status-{{ strtolower($project['status']) }}">
                            {{ $project['status'] }}
                        </span>
                    </div>
                </div>

            </a>
        @empty
            <div class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
                Belum ada project. Klik "Add New Project" untuk memulai.
            </div>
        @endforelse

    </div>

    {{-- ════════════════════════════════════════
    MODAL: ADD NEW PROJECT
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalAddProject" tabindex="-1" aria-labelledby="modalAddProjectLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-add-project">
            <div class="modal-content modal-content-custom">

                {{-- ── MODAL HEADER (dark) ── --}}
                <div class="modal-header-custom">
                    <div>
                        <div class="modal-eyebrow">Pendaftaran Aset Baru</div>
                        <h5 class="modal-title-custom" id="modalAddProjectLabel">Tambahkan Proyek Baru</h5>
                    </div>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- ── MODAL BODY ── --}}
                <div class="modal-body-custom">
                    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data"
                        id="formAddProject">
                        @csrf

                        {{-- Row 1: Project Title + Category --}}
                        <div class="form-row-2col">

                            <div class="form-group-custom">
                                <label class="form-label-custom">Judul Proyek</label>
                                <input type="text" name="title" class="form-input-custom"
                                    placeholder="e.g., Central Station Retrofit">
                            </div>
                        </div>

                        {{-- Row 2: Technical Description (full width) --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea name="description" class="form-input-custom form-textarea-custom"
                                placeholder="Define the core engineering objectives and milestones..." rows="4"></textarea>
                        </div>

                        {{-- Row 3: Target Date + Project Image --}}
                        <div class="form-row-2col">

                            <div class="form-group-custom">
                                <label class="form-label-custom">Tanggal Target</label>
                                <div class="input-icon-wrap">
                                    <i class="bi bi-calendar3 input-left-icon"></i>
                                    <input type="date" name="target_date" class="form-input-custom form-input-icon">
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label class="form-label-custom">Gambar Proyek</label>
                                <label class="upload-area" for="projectImageInput">
                                    <i class="bi bi-upload upload-icon"></i>
                                    <span class="upload-label" id="uploadLabel">Unggah Gambar</span>
                                    <input type="file" name="image" id="projectImageInput" accept="image/*"
                                        style="display:none;" onchange="handleFileChange(this)">
                                </label>
                            </div>

                        </div>

                        {{-- Row 4: Buttons --}}
                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn-modal-submit">
                                Buat Proyek
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
        /* ════ MODAL SIZING ════ */
        .modal-add-project {
            max-width: 480px;
        }

        /* ════ MODAL CONTENT WRAPPER ════ */
        .modal-content-custom {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.22);
        }

        /* ════ HEADER (dark navy) ════ */
        .modal-header-custom {
            background: #1a2236;
            padding: 22px 26px 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .modal-eyebrow {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #6b89c0;
            margin-bottom: 4px;
        }

        .modal-title-custom {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            letter-spacing: -0.2px;
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
            transition: background 0.15s, color 0.15s;
            margin-top: 2px;
        }

        .modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        /* ════ BODY ════ */
        .modal-body-custom {
            background: #ffffff;
            padding: 24px 26px 26px;
        }

        /* ════ 2-COLUMN ROW ════ */
        .form-row-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 0;
        }

        /* ════ FORM GROUP ════ */
        .form-group-custom {
            margin-bottom: 18px;
        }

        .form-label-custom {
            display: block;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 7px;
        }

        /* ════ INPUT BASE ════ */
        .form-input-custom {
            width: 100%;
            height: 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0 14px;
            font-size: 13px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            appearance: none;
            -webkit-appearance: none;
        }

        .form-input-custom::placeholder {
            color: #b0bac8;
        }

        .form-input-custom:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
            background: #fff;
        }

        /* ════ TEXTAREA ════ */
        .form-textarea-custom {
            height: auto;
            padding: 12px 14px;
            resize: none;
            line-height: 1.55;
        }

        /* ════ SELECT ════ */
        .select-wrap {
            position: relative;
        }

        .form-select-custom {
            cursor: pointer;
            padding-right: 36px;
        }

        .select-chevron {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 12px;
            pointer-events: none;
        }

        /* ════ DATE INPUT WITH ICON ════ */
        .input-icon-wrap {
            position: relative;
        }

        .input-left-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 14px;
            pointer-events: none;
        }

        .form-input-icon {
            padding-left: 38px;
        }

        /* ════ UPLOAD AREA ════ */
        .upload-area {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            height: 44px;
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            background: #f8fafc;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }

        .upload-area:hover {
            border-color: #2563eb;
            background: #f0f6ff;
        }

        .upload-icon {
            font-size: 13px;
            color: #64748b;
        }

        .upload-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            font-size: 10.5px;
            letter-spacing: 0.7px;
        }

        /* ════ ACTION BUTTONS ════ */
        .modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 6px;
        }

        .btn-modal-cancel {
            height: 44px;
            border: 1.5px solid #1a2236;
            border-radius: 8px;
            background: #fff;
            color: #1a2236;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-modal-cancel:hover {
            background: #f1f5f9;
        }

        .btn-modal-submit {
            height: 44px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.18s, box-shadow 0.18s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-modal-submit:hover {
            background: #1d4ed8;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.30);
        }
    </style>
@endpush

@push('scripts')
    <script>
        function handleFileChange(input) {
            const label = document.getElementById('uploadLabel');
            if (input.files && input.files[0]) {
                label.textContent = input.files[0].name;
            } else {
                label.textContent = 'Upload Schematic';
            }
        }
    </script>
@endpush