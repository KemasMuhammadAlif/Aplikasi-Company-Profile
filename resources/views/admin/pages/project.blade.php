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
            <div style="width:100%;height:100%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;">
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
                            {{ $project->id_proyek }},
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


{{-- ════ MODAL: ADD PROJECT ════ --}}
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

                    <div class="form-group-custom">
                        <label class="form-label-custom">Tanggal Target</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-calendar3 input-left-icon"></i>
                            <input type="date" name="tanggal" class="form-input-custom form-input-icon">
                        </div>
                    </div>

                    {{-- Upload Banyak Foto --}}
                    <div class="form-group-custom">
                        <label class="form-label-custom">Foto Dokumentasi (bisa pilih banyak)</label>
                        <label class="upload-area" for="addImagesInput" id="addUploadArea">
                            <i class="bi bi-images upload-icon"></i>
                            <span class="upload-label" id="addUploadLabel">Klik untuk pilih foto</span>
                            <input type="file" name="images[]" id="addImagesInput" accept="image/*"
                                multiple style="display:none;" onchange="handleAddImages(this)">
                        </label>
                        {{-- Preview foto yang dipilih --}}
                        <div class="foto-preview-list" id="addFotoPreview"></div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal-submit">Simpan Proyek</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


{{-- ════ MODAL: EDIT PROJECT ════ --}}
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
                        <input type="text" name="nama_proyek" id="edit_nama_proyek" class="form-input-custom">
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Lokasi</label>
                        <input type="text" name="lokasi" id="edit_lokasi" class="form-input-custom">
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-input-custom form-textarea-custom" rows="4"></textarea>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Tanggal</label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-calendar3 input-left-icon"></i>
                            <input type="date" name="tanggal" id="edit_tanggal" class="form-input-custom form-input-icon">
                        </div>
                    </div>

                    {{-- Foto yang sudah ada (dropdown) --}}
                    <div class="form-group-custom">
                        <label class="form-label-custom">Foto yang Sudah Ada</label>
                        <div class="foto-dropdown-wrap">
                            <select id="editFotoDropdown" class="form-input-custom" onchange="previewSelectedFoto(this)">
                                <option value="">-- Pilih foto untuk dilihat/dihapus --</option>
                            </select>
                            <button type="button" class="btn-hapus-foto" id="btnHapusFoto" onclick="hapusFotoSelected()" style="display:none;">
                                <i class="bi bi-trash"></i> Hapus Foto Ini
                            </button>
                        </div>
                        {{-- Preview foto yang dipilih dari dropdown --}}
                        <div class="foto-dropdown-preview" id="editDropdownPreview" style="display:none;">
                            <img id="editPreviewImg" src="" alt="Preview">
                        </div>
                    </div>

                    {{-- Upload foto baru --}}
                    <div class="form-group-custom">
                        <label class="form-label-custom">Tambah Foto Baru (opsional)</label>
                        <label class="upload-area" for="editImagesInput">
                            <i class="bi bi-images upload-icon"></i>
                            <span class="upload-label" id="editUploadLabel">Klik untuk pilih foto</span>
                            <input type="file" name="images[]" id="editImagesInput" accept="image/*"
                                multiple style="display:none;" onchange="handleEditImages(this)">
                        </label>
                        <div class="foto-preview-list" id="editFotoPreview"></div>
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


{{-- ════ MODAL: HAPUS PROJECT ════ --}}
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
                    Semua foto dokumentasi juga akan dihapus.
                </p>

                <form id="formDeleteProject" method="POST">
                    @csrf
                    @method('DELETE')
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
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
    }

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

    .project-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
    }

    .project-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
        transform: translateY(-2px);
    }

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

    .card-body-custom {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
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

    /* ── Foto Preview List ── */
    .foto-preview-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .foto-preview-item {
        position: relative;
        width: 72px;
        height: 72px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
    }

    .foto-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .foto-preview-remove {
        position: absolute;
        top: 2px;
        right: 2px;
        width: 18px;
        height: 18px;
        background: rgba(239, 68, 68, 0.9);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        line-height: 1;
    }

    /* ── Dropdown foto ── */
    .foto-dropdown-wrap {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .foto-dropdown-wrap select {
        flex: 1;
    }

    .btn-hapus-foto {
        display: flex;
        align-items: center;
        gap: 6px;
        background: #ef4444;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s;
    }

    .btn-hapus-foto:hover {
        background: #dc2626;
    }

    .foto-dropdown-preview {
        margin-top: 10px;
        border-radius: 10px;
        overflow: hidden;
        max-height: 200px;
    }

    .foto-dropdown-preview img {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e2e8f0;
    }
</style>
@endpush

@push('scripts')
<script>
    // ── ADD: Handle banyak foto ──
    let addFiles = [];

    function handleAddImages(input) {
        const newFiles = Array.from(input.files);
        addFiles = addFiles.concat(newFiles);
        renderAddPreviews();
        updateAddInput();
    }

    function renderAddPreviews() {
        const container = document.getElementById('addFotoPreview');
        container.innerHTML = '';
        addFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const wrap = document.createElement('div');
                wrap.className = 'foto-preview-item';
                wrap.innerHTML = `
                    <img src="${e.target.result}" alt="preview">
                    <button type="button" class="foto-preview-remove" onclick="removeAddFile(${index})">×</button>
                `;
                container.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('addUploadLabel').textContent =
            addFiles.length > 0 ? addFiles.length + ' foto dipilih' : 'Klik untuk pilih foto';
    }

    function removeAddFile(index) {
        addFiles.splice(index, 1);
        renderAddPreviews();
        updateAddInput();
    }

    function updateAddInput() {
        const input = document.getElementById('addImagesInput');
        const dt = new DataTransfer();
        addFiles.forEach(f => dt.items.add(f));
        input.files = dt.files;
    }

    // Reset add modal saat ditutup
    document.getElementById('modalAddProject').addEventListener('hidden.bs.modal', function() {
        addFiles = [];
        document.getElementById('addFotoPreview').innerHTML = '';
        document.getElementById('addUploadLabel').textContent = 'Klik untuk pilih foto';
        document.getElementById('addImagesInput').value = '';
    });


    // ── EDIT: Handle banyak foto baru ──
    let editFiles = [];
    let currentEditProyekId = null;

    function handleEditImages(input) {
        const newFiles = Array.from(input.files);
        editFiles = editFiles.concat(newFiles);
        renderEditPreviews();
        updateEditInput();
    }

    function renderEditPreviews() {
        const container = document.getElementById('editFotoPreview');
        container.innerHTML = '';
        editFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const wrap = document.createElement('div');
                wrap.className = 'foto-preview-item';
                wrap.innerHTML = `
                    <img src="${e.target.result}" alt="preview">
                    <button type="button" class="foto-preview-remove" onclick="removeEditFile(${index})">×</button>
                `;
                container.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('editUploadLabel').textContent =
            editFiles.length > 0 ? editFiles.length + ' foto dipilih' : 'Klik untuk pilih foto';
    }

    function removeEditFile(index) {
        editFiles.splice(index, 1);
        renderEditPreviews();
        updateEditInput();
    }

    function updateEditInput() {
        const input = document.getElementById('editImagesInput');
        const dt = new DataTransfer();
        editFiles.forEach(f => dt.items.add(f));
        input.files = dt.files;
    }


    // ── EDIT: Buka modal & load foto dari server ──
    function openEditModal(id, nama, deskripsi, tanggal, lokasi) {
        currentEditProyekId = id;
        editFiles = [];

        document.getElementById('edit_nama_proyek').value = nama;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('edit_tanggal').value = tanggal;
        document.getElementById('edit_lokasi').value = lokasi;
        document.getElementById('editUploadLabel').textContent = 'Klik untuk pilih foto';
        document.getElementById('editFotoPreview').innerHTML = '';
        document.getElementById('editImagesInput').value = '';
        document.getElementById('editDropdownPreview').style.display = 'none';
        document.getElementById('btnHapusFoto').style.display = 'none';

        document.getElementById('formEditProject').action = '/admin/project/' + id;

        // Load daftar foto dari server
        loadFotoDropdown(id);

        new bootstrap.Modal(document.getElementById('modalEditProject')).show();
    }

    function loadFotoDropdown(proyekId) {
        const select = document.getElementById('editFotoDropdown');
        select.innerHTML = '<option value="">Memuat foto...</option>';

        fetch('/admin/project/' + proyekId + '/fotos')
            .then(res => res.json())
            .then(fotos => {
                select.innerHTML = '<option value="">-- Pilih foto untuk dilihat/dihapus --</option>';
                fotos.forEach(foto => {
                    const opt = document.createElement('option');
                    opt.value = foto.id;
                    opt.dataset.src = foto.src;
                    opt.textContent = foto.nama;
                    select.appendChild(opt);
                });
            })
            .catch(() => {
                select.innerHTML = '<option value="">Gagal memuat foto</option>';
            });
    }

    function previewSelectedFoto(select) {
        const selected = select.options[select.selectedIndex];
        const preview = document.getElementById('editDropdownPreview');
        const img = document.getElementById('editPreviewImg');
        const btnHapus = document.getElementById('btnHapusFoto');

        if (selected.value) {
            img.src = selected.dataset.src;
            preview.style.display = 'block';
            btnHapus.style.display = 'flex';
        } else {
            preview.style.display = 'none';
            btnHapus.style.display = 'none';
        }
    }

    function hapusFotoSelected() {
        const select = document.getElementById('editFotoDropdown');
        const fotoid = select.value;
        const nama = select.options[select.selectedIndex].textContent;

        if (!fotoid) return;
        if (!confirm('Hapus foto "' + nama + '"?')) return;

        fetch('/admin/project/foto/' + fotoid, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Hapus dari dropdown
                    select.remove(select.selectedIndex);
                    select.value = '';
                    document.getElementById('editDropdownPreview').style.display = 'none';
                    document.getElementById('btnHapusFoto').style.display = 'none';
                }
            })
            .catch(() => alert('Gagal menghapus foto.'));
    }

    // Reset edit modal saat ditutup
    document.getElementById('modalEditProject').addEventListener('hidden.bs.modal', function() {
        editFiles = [];
        document.getElementById('editFotoPreview').innerHTML = '';
        document.getElementById('editDropdownPreview').style.display = 'none';
        document.getElementById('btnHapusFoto').style.display = 'none';
    });


    // ── DELETE modal ──
    function openDeleteModal(id, nama) {
        document.getElementById('delete_project_name').textContent = nama;
        document.getElementById('formDeleteProject').action = '/admin/project/' + id;
        new bootstrap.Modal(document.getElementById('modalDeleteProject')).show();
    }
</script>
@endpush