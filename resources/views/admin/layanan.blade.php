@extends('layouts.app')

@section('title', 'Manajemen Layanan')
@section('search_placeholder', 'Cari Layanan...')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Admin</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Layanan</span>
    </div>

    {{-- Page Title --}}
    <h1 class="page-title">Manajemen Layanan</h1>

    {{-- Services Grid --}}
    <div class="services-grid">

        {{-- ── ADD NEW SERVICE → trigger modal ── --}}
        <a href="#"
           class="add-service-card"
           data-bs-toggle="modal"
           data-bs-target="#modalCreateService">
            <div class="add-icon-wrap">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-service-label">Tambah Layanan</span>
        </a>

        {{-- ── SERVICE CARDS ── --}}
        @forelse ($services as $service)
            <a href="#" class="service-card">
                <div class="service-icon-wrap">
                    <i class="bi {{ $service['icon'] }}"></i>
                </div>
                <div class="service-title">{{ $service['title'] }}</div>
                <p class="service-desc">{{ $service['description'] }}</p>
            </a>
        @empty
            <div class="text-muted"
                 style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
                Belum ada layanan. Klik "Add New Service" untuk memulai.
            </div>
        @endforelse

    </div>

    {{-- ════════════════════════════════════════
         MODAL: CREATE NEW SERVICE
    ════════════════════════════════════════ --}}
    <div class="modal fade"
         id="modalCreateService"
         tabindex="-1"
         aria-labelledby="modalCreateServiceLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-create-service">
            <div class="modal-content-custom">

                {{-- ── HEADER (dark navy) ── --}}
                <div class="modal-header-custom">
                    <h5 class="modal-title-custom" id="modalCreateServiceLabel">
                        Tambah Layanan Baru
                    </h5>
                    <button type="button"
                            class="modal-close-btn"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- ── BODY ── --}}
                <div class="modal-body-custom">
                    <form action="{{ route('admin.layanan.store') }}"
                          method="POST"
                          id="formCreateService">
                        @csrf

                        {{-- Service Name --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="serviceName">
                                Nama Layanan
                            </label>
                            <input
                                type="text"
                                id="serviceName"
                                name="title"
                                class="form-input-custom"
                                placeholder="e.g. Electrical Integration"
                            >
                        </div>

                        {{-- Description --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="serviceDesc">
                                Deskripsi Layanan
                            </label>
                            <textarea
                                id="serviceDesc"
                                name="description"
                                class="form-input-custom form-textarea-custom"
                                placeholder="Briefly describe the operational scope of this service..."
                                rows="4"
                            ></textarea>
                        </div>

                        {{-- Icon Selection --}}
                        <div class="form-group-custom">
                            <label class="form-label-custom">Pilihan Icon</label>

                            {{-- Hidden input menyimpan value icon yang dipilih --}}
                            <input type="hidden" name="icon" id="selectedIcon" value="bi-tools">

                            <div class="icon-grid">
                                @php
                                    $icons = [
                                        'bi-tools',
                                        'bi-people',
                                        'bi-archive',
                                        'bi-lightning-charge',
                                        'bi-diagram-3',
                                        'bi-search',
                                        'bi-building',
                                        'bi-gear',
                                        'bi-pencil-square',
                                        'bi-truck',
                                        'bi-shield-check',
                                        'bi-layers',
                                    ];
                                @endphp

                                @foreach ($icons as $icon)
                                    <button
                                        type="button"
                                        class="icon-option {{ $loop->first ? 'selected' : '' }}"
                                        data-icon="{{ $icon }}"
                                        onclick="selectIcon(this)"
                                        title="{{ $icon }}"
                                    >
                                        <i class="bi {{ $icon }}"></i>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="modal-actions">
                            <button type="button"
                                    class="btn-modal-cancel"
                                    data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn-modal-submit">
                                Buat Layanan
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
    /* ════ SERVICES GRID ════ */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    /* ════ ADD CARD ════ */
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

    /* ════ SERVICE CARD ════ */
    .service-card {
        background: #fff;
        border-radius: 12px;
        padding: 28px 24px 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        text-decoration: none;
        transition: box-shadow 0.2s, transform 0.2s;
        min-height: 240px;
    }

    .service-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.10);
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
        margin-bottom: 4px;
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

    /* ════ MODAL SIZING ════ */
    .modal-create-service {
        max-width: 440px;
    }

    /* ════ MODAL CONTENT ════ */
    .modal-content-custom {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(0,0,0,0.22);
    }

    /* ════ HEADER (dark navy) ════ */
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
        color: #ffffff;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin: 0;
    }

    .modal-close-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        background: rgba(255,255,255,0.08);
        color: rgba(255,255,255,0.70);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.15s, color 0.15s;
        flex-shrink: 0;
    }

    .modal-close-btn:hover {
        background: rgba(255,255,255,0.18);
        color: #fff;
    }

    /* ════ BODY ════ */
    .modal-body-custom {
        background: #ffffff;
        padding: 24px 24px 26px;
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
        text-transform: uppercase;
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

    .form-input-custom::placeholder { color: #b0bac8; }

    .form-input-custom:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
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

    /* selected state — sesuai design figma */
    .icon-option.selected {
        border-color: #2563eb;
        background: #eff6ff;
        color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
    }

    /* ════ ACTION BUTTONS ════ */
    .modal-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 4px;
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

    .btn-modal-cancel:hover { background: #e2e8f0; }

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
        box-shadow: 0 4px 14px rgba(37,99,235,0.30);
    }
</style>
@endpush

@push('scripts')
<script>
    function selectIcon(el) {
        // hapus selected dari semua
        document.querySelectorAll('.icon-option').forEach(btn => {
            btn.classList.remove('selected');
        });
        // set selected ke yang diklik
        el.classList.add('selected');
        // simpan value ke hidden input
        document.getElementById('selectedIcon').value = el.dataset.icon;
    }
</script>
@endpush