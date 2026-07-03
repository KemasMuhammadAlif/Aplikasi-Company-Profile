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

    {{-- HEADER TOOLBAR --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <button class="btn-tambah-kat" data-bs-toggle="modal" data-bs-target="#modalCreateKategori">
                <i class="bi bi-folder-plus"></i> Tambah Kategori
            </button>
            <button class="btn-tambah-faq" data-bs-toggle="modal" data-bs-target="#modalCreateFaq">
                <i class="bi bi-plus-lg"></i> Tambah FAQ
            </button>
        </div>
    </div>

    {{-- BOARD --}}
    <div id="faqBoard">

        {{-- Tanpa Kategori --}}
        <div class="faq-kat-block mb-3">
            <div class="faq-kat-header">
                <span><i class="bi bi-inbox me-2"></i>Tanpa Kategori</span>
            </div>
            <ul class="sortable-faq" data-kategori="">
                @forelse($faqsTanpaKategori as $faq)
                <li class="faq-drag-item" data-id="{{ $faq->id_faq }}">
                    <span class="drag-handle"><i class="bi bi-grip-vertical"></i></span>
                    <div class="faq-drag-body">
                        <div class="faq-drag-q">{{ $faq->pertanyaan }}</div>
                        <div class="faq-drag-a">{{ Str::limit($faq->jawaban, 80) }}</div>
                    </div>
                    <div class="faq-drag-acts">
                        <button class="service-icon-btn" onclick="openEditFaq('{{ $faq->id_faq }}','{{ addslashes($faq->pertanyaan) }}','{{ addslashes($faq->jawaban) }}','')">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="service-icon-btn" onclick="openDeleteFaq('{{ $faq->id_faq }}','{{ addslashes($faq->pertanyaan) }}')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </li>
                @empty
                <li class="faq-empty-drop">Belum ada FAQ. Drag FAQ ke sini atau tambah baru.</li>
                @endforelse
            </ul>
        </div>

        {{-- Per Kategori --}}
        @foreach($kategoris as $kat)
        <div class="faq-kat-block mb-3">
            <div class="faq-kat-header">
                <span><i class="bi bi-folder2-open me-2"></i>{{ $kat->nama_kategori }}</span>
                <div class="d-flex gap-1">
                    <button class="service-icon-btn" onclick="openEditKat('{{ $kat->id_kategori }}','{{ addslashes($kat->nama_kategori) }}')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="service-icon-btn" onclick="openDeleteKat('{{ $kat->id_kategori }}','{{ addslashes($kat->nama_kategori) }}')">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            <ul class="sortable-faq" data-kategori="{{ $kat->id_kategori }}">
                @forelse($kat->faqs as $faq)
                <li class="faq-drag-item" data-id="{{ $faq->id_faq }}">
                    <span class="drag-handle"><i class="bi bi-grip-vertical"></i></span>
                    <div class="faq-drag-body">
                        <div class="faq-drag-q">{{ $faq->pertanyaan }}</div>
                        <div class="faq-drag-a">{{ Str::limit($faq->jawaban, 80) }}</div>
                    </div>
                    <div class="faq-drag-acts">
                        <button class="service-icon-btn" onclick="openEditFaq('{{ $faq->id_faq }}','{{ addslashes($faq->pertanyaan) }}','{{ addslashes($faq->jawaban) }}','{{ $kat->id_kategori }}')">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="service-icon-btn" onclick="openDeleteFaq('{{ $faq->id_faq }}','{{ addslashes($faq->pertanyaan) }}')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </li>
                @empty
                <li class="faq-empty-drop">Drag FAQ ke sini</li>
                @endforelse
            </ul>
        </div>
        @endforeach

    </div>


    {{-- ══ MODAL TAMBAH KATEGORI ══ --}}
    <div class="modal fade" id="modalCreateKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-create-service">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Tambah Kategori</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body-custom">
                    <form action="{{ route('admin.faq.kategori.store') }}" method="POST">
                        @csrf
                        <div class="form-group-custom">
                            <label class="form-label-custom">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-input-custom" required placeholder="contoh: Informasi Perusahaan">
                        </div>
                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MODAL EDIT KATEGORI ══ --}}
    <div class="modal fade" id="modalEditKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-create-service">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Edit Kategori</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body-custom">
                    <form id="formEditKat" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group-custom">
                            <label class="form-label-custom">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="editKatNama" class="form-input-custom" required>
                        </div>
                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MODAL HAPUS KATEGORI ══ --}}
    <div class="modal fade" id="modalDeleteKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-create-service">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Hapus Kategori</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body-custom">
                    <p style="font-size:14px;color:#475569;margin-bottom:20px;">
                        Yakin hapus kategori <strong id="deleteKatName"></strong>?<br>
                        <small class="text-muted">FAQ di dalamnya akan jadi tanpa kategori.</small>
                    </p>
                    <form id="formDeleteKat" method="POST">
                        @csrf @method('DELETE')
                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-submit" style="background:#ef4444;">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MODAL TAMBAH FAQ ══ --}}
    <div class="modal fade" id="modalCreateFaq" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-create-service">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Tambah FAQ Baru</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body-custom">
                    <form action="{{ route('admin.faq.store') }}" method="POST">
                        @csrf
                        <div class="form-group-custom">
                            <label class="form-label-custom">Kategori</label>
                            <select name="id_kategori" class="form-input-custom">
                                <option value="">-- Tanpa Kategori --</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">Pertanyaan</label>
                            <input type="text" name="pertanyaan" class="form-input-custom" required placeholder="Tuliskan pertanyaan...">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">Jawaban</label>
                            <textarea name="jawaban" class="form-input-custom form-textarea-custom" rows="4" required placeholder="Berikan jawaban..."></textarea>
                        </div>
                        <div class="modal-actions">
                            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-modal-submit">Simpan FAQ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ MODAL EDIT FAQ ══ --}}
    <div class="modal fade" id="modalEditFaq" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-create-service">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Edit FAQ</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body-custom">
                    <form id="formEditFaq" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group-custom">
                            <label class="form-label-custom">Kategori</label>
                            <select name="id_kategori" id="editFaqKat" class="form-input-custom">
                                <option value="">-- Tanpa Kategori --</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">Pertanyaan</label>
                            <input type="text" name="pertanyaan" id="editFaqQ" class="form-input-custom" required>
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom">Jawaban</label>
                            <textarea name="jawaban" id="editFaqA" class="form-input-custom form-textarea-custom" rows="4" required></textarea>
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

    {{-- ══ MODAL HAPUS FAQ ══ --}}
    <div class="modal fade" id="modalDeleteFaq" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-create-service">
            <div class="modal-content modal-content-custom">
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom">Hapus FAQ</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body-custom">
                    <p style="font-size:14px;color:#475569;margin-bottom:20px;">
                        Yakin ingin hapus FAQ <strong id="deleteFaqName"></strong>?
                    </p>
                    <form id="formDeleteFaq" method="POST">
                        @csrf @method('DELETE')
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
.btn-tambah-kat {
    padding: 8px 16px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    background: #fff;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all .2s;
}
.btn-tambah-kat:hover { background: #f8fafc; border-color: #94a3b8; }

.btn-tambah-faq {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    background: #2563eb;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background .2s;
}
.btn-tambah-faq:hover { background: #1d4ed8; }

.faq-kat-block {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
}
.faq-kat-header {
    background: #f8fafc;
    padding: 10px 16px;
    font-weight: 600;
    font-size: 14px;
    color: #1e293b;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e2e8f0;
}
.sortable-faq {
    list-style: none;
    padding: 8px;
    margin: 0;
    min-height: 56px;
}
.faq-drag-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 12px;
    margin-bottom: 6px;
    transition: box-shadow .15s;
}
.faq-drag-item:hover { box-shadow: 0 2px 8px rgba(0,0,0,.07); }
.faq-drag-item.sortable-ghost { opacity: 0.3; background: #dbeafe; }
.drag-handle { cursor: grab; color: #94a3b8; padding-top: 2px; flex-shrink: 0; font-size: 16px; }
.faq-drag-body { flex: 1; }
.faq-drag-q { font-weight: 600; font-size: 13px; color: #1e293b; }
.faq-drag-a { font-size: 12px; color: #64748b; margin-top: 2px; }
.faq-drag-acts { display: flex; gap: 4px; flex-shrink: 0; }
.faq-empty-drop {
    text-align: center;
    font-size: 13px;
    color: #94a3b8;
    padding: 14px;
    border: 1px dashed #cbd5e1;
    border-radius: 6px;
    list-style: none;
}
.service-icon-btn {
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
.service-icon-btn:hover {
    background: #eff6ff;
    color: #2563eb;
    border-color: #93c5fd;
}
.service-icon-btn:last-child:hover {
    background: #fee2e2;
    color: #dc2626;
    border-color: #fecaca;
}
.modal-create-service { max-width: 440px; }

@media (max-width: 576px) {
    .faq-drag-item {
        flex-wrap: wrap;
    }
    .faq-drag-acts {
        width: 100%;
        justify-content: flex-end;
        margin-top: 8px;
        border-top: 1px solid #f1f5f9;
        padding-top: 8px;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
// Init drag & drop
document.querySelectorAll('.sortable-faq').forEach(el => {
    Sortable.create(el, {
        group: 'faq',
        handle: '.drag-handle',
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: saveOrder,
    });
});

function saveOrder() {
    const items = [];
    document.querySelectorAll('.sortable-faq').forEach(zone => {
        const kategori = zone.dataset.kategori;
        zone.querySelectorAll('.faq-drag-item').forEach((item, index) => {
            items.push({ id: item.dataset.id, kategori: kategori, urutan: index });
        });
    });

    fetch('{{ route("admin.faq.reorder") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ items })
    });
}

// Modal Kategori
function openEditKat(id, nama) {
    document.getElementById('editKatNama').value = nama;
    document.getElementById('formEditKat').action = `/admin/faq-kategori/${id}`;
    new bootstrap.Modal(document.getElementById('modalEditKategori')).show();
}
function openDeleteKat(id, nama) {
    document.getElementById('deleteKatName').textContent = nama;
    document.getElementById('formDeleteKat').action = `/admin/faq-kategori/${id}`;
    new bootstrap.Modal(document.getElementById('modalDeleteKategori')).show();
}

// Modal FAQ
function openEditFaq(id, pertanyaan, jawaban, kategori) {
    document.getElementById('editFaqQ').value = pertanyaan;
    document.getElementById('editFaqA').value = jawaban;
    document.getElementById('editFaqKat').value = kategori;
    document.getElementById('formEditFaq').action = `/admin/faq/${id}`;
    new bootstrap.Modal(document.getElementById('modalEditFaq')).show();
}
function openDeleteFaq(id, pertanyaan) {
    document.getElementById('deleteFaqName').textContent = pertanyaan;
    document.getElementById('formDeleteFaq').action = `/admin/faq/${id}`;
    new bootstrap.Modal(document.getElementById('modalDeleteFaq')).show();
}
</script>
@endpush