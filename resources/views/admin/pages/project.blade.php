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
    <h1 class="page-title">Manajemen Proyek</h1>

    @include('partials.alert')

    {{-- Projects Grid --}}
    <div class="projects-grid">

        {{-- ADD NEW PROJECT --}}
        <a href="#" class="add-project-card" data-bs-toggle="modal" data-bs-target="#modalAddProject">
            <div class="add-icon-wrap">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-project-label">Tambahkan Proyek</span>
        </a>

        {{-- PROJECT CARDS --}}
        @forelse ($projects as $project)
            <div class="project-card">

                {{-- Thumbnail --}}
                <div class="card-img-wrap">
                    @if ($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail->dokumentasi) }}" alt="{{ $project->nama_proyek }}">
                    @else
                        <div style="width:100%;height:100%;background:#e2e8f0;
                                                display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-image" style="font-size:32px;color:#94a3b8;"></i>
                        </div>
                    @endif
                </div>

                {{-- Body --}}
                <div class="card-body-custom">
                    <div class="card-title-custom">{{ $project->nama_proyek }}</div>
                    <p class="card-desc">{{ $project->deskripsi }}</p>

                    <div class="card-footer-custom">
                        <span class="card-date">
                            <i class="bi bi-calendar3"></i>
                            {{ $project->tanggal ?? '-' }}
                        </span>
                        <span class="card-date">
                            <i class="bi bi-geo-alt"></i>
                            {{ $project->lokasi ?? '-' }}
                        </span>
                    </div>

                    {{-- Tombol Edit & Hapus --}}
                    <div class="card-actions">
                        <button class="btn-action-icon" onclick="openEditModal(
                                        '{{ $project->id_proyek }}',
                                        '{{ addslashes($project->nama_proyek) }}',
                                        '{{ addslashes($project->deskripsi) }}',
                                        '{{ $project->tanggal }}',
                                        '{{ addslashes($project->lokasi) }}'
                                    )">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <button class="btn-action-icon delete" onclick="openDeleteModal(
                                        '{{ $project->id_proyek }}',
                                        '{{ addslashes($project->nama_proyek) }}'
                                    )">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
                Belum ada project. Klik "Tambahkan Proyek" untuk memulai.
            </div>
        @endforelse

    </div>


    {{-- ════════════════════════════════════════
    MODAL: ADD NEW PROJECT
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalAddProject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-add-project">
            <div class="modal-content modal-content-custom">

                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Tambahkan Proyek Baru</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body-custom">
                    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group-custom">
                            <label class="form-label-custom">Judul Proyek</label>
                            <input type="text" name="nama_proyek" class="form-input-custom"
                                placeholder="e.g., Central Station Retrofit">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Lokasi</label>
                            <input type="text" name="lokasi" class="form-input-custom" placeholder="e.g., Jakarta Selatan">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea name="deskripsi" class="form-input-custom form-textarea-custom"
                                placeholder="Deskripsi proyek..." rows="4"></textarea>
                        </div>

                        <div class="form-row-2col">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Tanggal Target</label>
                                <div class="input-icon-wrap">
                                    <i class="bi bi-calendar3 input-left-icon"></i>
                                    <input type="date" name="tanggal" class="form-input-custom form-input-icon">
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

                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn-modal-submit">
                                Simpan Proyek
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- ════════════════════════════════════════
    MODAL: EDIT PROJECT
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalEditProject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-add-project">
            <div class="modal-content modal-content-custom">

                <div class="modal-header-custom">
                    <div>
                        <div class="modal-eyebrow">Edit Aset</div>
                        <h5 class="modal-title-custom">Edit Proyek</h5>
                    </div>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body-custom">
                    <form id="formEditProject" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group-custom">
                            <label class="form-label-custom">Judul Proyek</label>
                            <input type="text" name="nama_proyek" id="edit_nama_proyek" class="form-input-custom"
                                placeholder="Judul proyek">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Lokasi</label>
                            <input type="text" name="lokasi" id="edit_lokasi" class="form-input-custom"
                                placeholder="Lokasi proyek">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea name="deskripsi" id="edit_deskripsi" class="form-input-custom form-textarea-custom"
                                rows="4" placeholder="Deskripsi proyek..."></textarea>
                        </div>

                        <div class="form-row-2col">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Tanggal</label>
                                <div class="input-icon-wrap">
                                    <i class="bi bi-calendar3 input-left-icon"></i>
                                    <input type="date" name="tanggal" id="edit_tanggal"
                                        class="form-input-custom form-input-icon">
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <label class="form-label-custom">Gambar Baru (opsional)</label>
                                <label class="upload-area" for="editImageInput">
                                    <i class="bi bi-upload upload-icon"></i>
                                    <span class="upload-label" id="editUploadLabel">Unggah Gambar</span>
                                    <input type="file" name="image" id="editImageInput" accept="image/*"
                                        style="display:none;" onchange="handleEditFileChange(this)">
                                </label>
                            </div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn-modal-submit">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- ════════════════════════════════════════
    MODAL: HAPUS PROJECT
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalDeleteProject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
            <div class="modal-content modal-content-custom">

                <div class="modal-header-custom">
                    <div>
                        <div class="modal-eyebrow">Konfirmasi</div>
                        <h5 class="modal-title-custom">Hapus Proyek</h5>
                    </div>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <div class="modal-body-custom">
                    <p style="font-size:14px;color:#475569;margin-bottom:20px;">
                        Apakah Anda yakin ingin menghapus proyek
                        <strong id="delete_project_name"></strong>?
                        Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <form id="formDeleteProject" method="POST">
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
        /* ════ GRID ════ */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        /* ════ ADD CARD ════ */
        .add-project-card {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            min-height: 300px;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.2s, background 0.2s;
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

        /* ════ PROJECT CARD ════ */
        .project-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.2s, transform 0.2s;
            display: flex;
            flex-direction: column;
            /* ← penting */
        }

        .project-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            transform: translateY(-2px);
        }

        /* ════ IMAGE ════ */
        .card-img-wrap {
            width: 100%;
            height: 180px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ════ BODY ════ */
        .card-body-custom {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
            /* ← isi sisa ruang */
            gap: 8px;
        }

        .card-title-custom {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
        }

        .card-desc {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
            word-break: break-word;
            white-space: normal;
        }

        .card-footer-custom {
            display: flex;
            gap: 12px;
            font-size: 12px;
            color: #64748b;
            flex-wrap: wrap;
        }

        .card-date {
            display: flex;
            align-items: center;
            gap: 4px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function handleFileChange(input) {
            document.getElementById('uploadLabel').textContent =
                input.files[0] ? input.files[0].name : 'Unggah Gambar';
        }

        function handleEditFileChange(input) {
            document.getElementById('editUploadLabel').textContent =
                input.files[0] ? input.files[0].name : 'Unggah Gambar';
        }

        function openEditModal(id, nama, deskripsi, tanggal, lokasi) {
            document.getElementById('edit_nama_proyek').value = nama;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_tanggal').value = tanggal;
            document.getElementById('edit_lokasi').value = lokasi;
            document.getElementById('editUploadLabel').textContent = 'Unggah Gambar';
            document.getElementById('formEditProject').action = '/admin/project/' + id;

            new bootstrap.Modal(document.getElementById('modalEditProject')).show();
        }

        function openDeleteModal(id, nama) {
            document.getElementById('delete_project_name').textContent = nama;
            document.getElementById('formDeleteProject').action = '/admin/project/' + id;

            new bootstrap.Modal(document.getElementById('modalDeleteProject')).show();
        }
    </script>
@endpush