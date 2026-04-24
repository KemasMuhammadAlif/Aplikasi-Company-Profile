@extends('layouts.app')

@section('title', 'FAQ Manajemen')
@section('search_placeholder', 'Cari FAQ...')

@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-custom">
    <a href="#">Admin</a>
    <span class="bc-sep">›</span>
    <span class="bc-active">FAQ</span>
</div>

{{-- Page Title --}}
<h1 class="page-title">Manajemen FAQ</h1>

{{-- Alert Sukses --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- FAQ Grid --}}
<div class="services-grid">

    {{-- ADD NEW FAQ --}}
    <a href="#" class="add-service-card"
        data-bs-toggle="modal" data-bs-target="#modalCreateFaq">
        <div class="add-icon-wrap">
            <i class="bi bi-plus-lg"></i>
        </div>
        <span class="add-service-label">Tambah FAQ</span>
    </a>

    {{-- FAQ CARDS --}}
    @forelse ($faqs as $faq)
    <div class="service-card">

        <div class="service-icon-wrap">
            <i class="bi bi-question-lg"></i>
        </div>

        <div class="service-title">{{ $faq->pertanyaan }}</div>
        <p class="service-desc">{{ $faq->jawaban }}</p>

        {{-- Tombol Edit & Hapus --}}
        <div class="card-actions">
            <button class="btn-action"
                onclick="openEditModal(
                            '{{ $faq->id_faq }}',
                            '{{ addslashes($faq->pertanyaan) }}',
                            '{{ addslashes($faq->jawaban) }}'
                        )">
                <i class="bi bi-pencil"></i>
            </button>

            <button class="btn-action"
                onclick="openDeleteModal(
                            '{{ $faq->id_faq }}',
                            '{{ addslashes($faq->pertanyaan) }}'
                        )">
                <i class="bi bi-trash"></i>
            </button>
        </div>

    </div>
    @empty
    <div class="text-muted"
        style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
        Belum ada FAQ. Klik "Tambah FAQ" untuk memulai.
    </div>
    @endforelse

</div>


{{-- ════════════════════════════════════════
    MODAL: CREATE FAQ
    ════════════════════════════════════════ --}}
<div class="modal fade" id="modalCreateFaq" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-create-service">
        <div class="modal-content modal-content-custom">

            <div class="modal-header-custom">
                <h5 class="modal-title-custom">Tambah FAQ Baru</h5>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body-custom">
                <form action="{{ route('admin.faq.store') }}" method="POST">
                    @csrf

                    <div class="form-group-custom">
                        <label class="form-label-custom">Pertanyaan</label>
                        <input type="text" name="pertanyaan"
                            class="form-input-custom"
                            placeholder="Tuliskan pertanyaan...">
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Jawaban</label>
                        <textarea name="jawaban"
                            class="form-input-custom form-textarea-custom"
                            rows="5"
                            placeholder="Berikan jawaban..."></textarea>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-modal-submit">
                            Simpan FAQ
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


{{-- ════════════════════════════════════════
    MODAL: EDIT FAQ
    ════════════════════════════════════════ --}}
<div class="modal fade" id="modalEditFaq" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-create-service">
        <div class="modal-content modal-content-custom">

            <div class="modal-header-custom">
                <h5 class="modal-title-custom">Edit FAQ</h5>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body-custom">
                <form id="formEditFaq" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-custom">
                        <label class="form-label-custom">Pertanyaan</label>
                        <input type="text" name="pertanyaan" id="edit_pertanyaan"
                            class="form-input-custom"
                            placeholder="Tuliskan pertanyaan...">
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Jawaban</label>
                        <textarea name="jawaban" id="edit_jawaban"
                            class="form-input-custom form-textarea-custom"
                            rows="5"
                            placeholder="Berikan jawaban..."></textarea>
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
    MODAL: HAPUS FAQ
    ════════════════════════════════════════ --}}
<div class="modal fade" id="modalDeleteFaq" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-create-service">
        <div class="modal-content modal-content-custom">

            <div class="modal-header-custom">
                <h5 class="modal-title-custom">Hapus FAQ</h5>
                <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="modal-body-custom">
                <p style="font-size:14px;color:#475569;margin-bottom:20px;">
                    Yakin ingin hapus FAQ
                    <strong id="delete_faq_name"></strong>?
                </p>

                <form id="formDeleteFaq" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-actions">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-modal-submit"
                            style="background:#ef4444;">
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
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    .add-service-card {
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

    .add-service-card:hover {
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

    .add-service-card:hover .add-icon-wrap {
        background: #dbeafe;
        color: #2563eb;
    }

    .add-service-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .service-card {
        background: #fff;
        border-radius: 12px;
        padding: 28px 24px 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .service-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
        transform: translateY(-2px);
    }

    .service-icon-wrap {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #2563eb;
        flex-shrink: 0;
    }

    .service-title {
        font-size: 15.5px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.35;
    }

    .service-desc {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.6;
        margin: 0;
    }

    .card-actions {
        display: flex;
        justify-content: flex-end;
        gap: 6px;
        margin-top: auto;
        padding-top: 8px;
    }

    .btn-action {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-action:hover {
        background: #eff6ff;
        color: #2563eb;
        border-color: #93c5fd;
    }

    .btn-action:nth-child(2):hover {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .modal-create-service {
        max-width: 440px;
    }

    .modal-content-custom {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(0, 0, 0, 0.22);
    }

    .modal-header-custom {
        background: #1a2236;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title-custom {
        font-size: 17px;
        font-weight: 800;
        color: #fff;
        letter-spacing: 0.5px;
        margin: 0;
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
        transition: background 0.15s, color 0.15s;
    }

    .modal-close-btn:hover {
        background: rgba(255, 255, 255, 0.18);
        color: #fff;
    }

    .modal-body-custom {
        background: #fff;
        padding: 24px 24px 26px;
    }

    .form-group-custom {
        margin-bottom: 20px;
    }

    .form-label-custom {
        display: block;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.9px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .form-input-custom {
        width: 100%;
        height: 44px;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 0 14px;
        font-size: 13.5px;
        color: #1e293b;
        background: #f8fafc;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
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

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 10px;
    }

    .btn-modal-cancel {
        height: 34px;
        padding: 0 12px;
        border: none;
        border-radius: 6px;
        background: #f1f5f9;
        color: #374151;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.15s;
    }

    .btn-modal-cancel:hover {
        background: #e2e8f0;
    }

    .btn-modal-submit {
        height: 34px;
        padding: 0 12px;
        border: none;
        border-radius: 6px;
        background: #2563eb;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.18s, box-shadow 0.18s;
    }

    .btn-modal-submit:hover {
        background: #1d4ed8;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.30);
    }
</style>
@endpush

@push('scripts')
<script>
    // Buka Modal Edit
    function openEditModal(id, pertanyaan, jawaban) {
        document.getElementById('edit_pertanyaan').value = pertanyaan;
        document.getElementById('edit_jawaban').value = jawaban;
        document.getElementById('formEditFaq').action = '/admin/faq/' + id;

        new bootstrap.Modal(document.getElementById('modalEditFaq')).show();
    }

    // Buka Modal Hapus
    function openDeleteModal(id, pertanyaan) {
        document.getElementById('delete_faq_name').textContent = pertanyaan;
        document.getElementById('formDeleteFaq').action = '/admin/faq/' + id;

        new bootstrap.Modal(document.getElementById('modalDeleteFaq')).show();
    }
</script>
@endpush