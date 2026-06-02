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

    @include('partials.alert')

    {{-- FAQ Grid --}}
    <div class="services-grid" id="faqGrid">

        {{-- ADD NEW FAQ --}}
        <a href="#" class="add-service-card" data-bs-toggle="modal" data-bs-target="#modalCreateFaq">
            <div class="add-icon-wrap">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-service-label">Tambah FAQ</span>
        </a>

        {{-- FAQ CARDS --}}
        @forelse ($faqs as $faq)
            <div class="service-card faq-item">

                <div class="service-icon-wrap">
                    <i class="bi bi-question-lg"></i>
                </div>

                <div class="service-title search-target-question">{{ $faq->pertanyaan }}</div>
                <p class="service-desc search-target-answer">{{ $faq->jawaban }}</p>

                {{-- Tombol Edit & Hapus --}}
                <div class="card-actions">
                    <button class="btn-action" onclick="openEditModal(
                                                            '{{ $faq->id_faq }}',
                                                            '{{ addslashes($faq->pertanyaan) }}',
                                                            '{{ addslashes($faq->jawaban) }}'
                                                        )">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn-action" onclick="openDeleteModal(
                                                            '{{ $faq->id_faq }}',
                                                            '{{ addslashes($faq->pertanyaan) }}'
                                                        )">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

            </div>
        @empty
            <div id="emptyState" class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
                Belum ada FAQ. Klik "Tambah FAQ" untuk memulai.
            </div>
        @endforelse

        {{-- Empty State untuk Pencarian --}}
        <div id="searchEmptyState" class="text-muted d-none" style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
            FAQ yang Anda cari tidak ditemukan.
        </div>

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
                            <input type="text" name="pertanyaan" class="form-input-custom" required
                                placeholder="Tuliskan pertanyaan...">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Jawaban</label>
                            <textarea name="jawaban" class="form-input-custom form-textarea-custom" rows="5" required
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
                            <input type="text" name="pertanyaan" id="edit_pertanyaan" class="form-input-custom" required
                                placeholder="Tuliskan pertanyaan...">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Jawaban</label>
                            <textarea name="jawaban" id="edit_jawaban" class="form-input-custom form-textarea-custom"
                                rows="5" required placeholder="Berikan jawaban..."></textarea>
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
        
        .d-none {
            display: none !important;
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

        // Fitur Pencarian Real-time Otomatis terhubung dengan Input di Layout Navbar Anda
        document.addEventListener('DOMContentLoaded', function() {
            // Cari elemen input search di navbar berdasarkan placeholder yang di-set di atas
            const searchInput = document.querySelector('input[placeholder="Cari FAQ..."]');
            
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const filter = this.value.toLowerCase();
                    const faqItems = document.querySelectorAll('.faq-item');
                    let visibleCount = 0;

                    faqItems.forEach(function(item) {
                        const question = item.querySelector('.search-target-question').textContent.toLowerCase();
                        const answer = item.querySelector('.search-target-answer').textContent.toLowerCase();

                        if (question.includes(filter) || answer.includes(filter)) {
                            item.style.setProperty('display', 'flex', 'important');
                            visibleCount++;
                        } else {
                            item.style.setProperty('display', 'none', 'important');
                        }
                    });

                    // Tampilkan pesan kosong jika pencarian tidak ada hasil
                    const emptyState = document.getElementById('searchEmptyState');
                    if (emptyState) {
                        if (visibleCount === 0 && filter !== '') {
                            emptyState.classList.remove('d-none');
                        } else {
                            emptyState.classList.add('d-none');
                        }
                    }
                });
            }
        });
    </script>
@endpush