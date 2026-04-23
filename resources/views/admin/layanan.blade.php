@extends('layouts.app')

@section('title', 'Service Management')
@section('search_placeholder', 'Search Service...')

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

    {{-- Tombol Add --}}
    <a href="{{ route('admin.layanan.create') }}" class="add-service-card">
        <div class="add-icon-wrap">
            <i class="bi bi-plus-lg"></i>
        </div>
        <span class="add-service-label">Tambah Layanan</span>
    </a>

    {{-- Service Cards --}}
    @forelse ($services as $service)
    <div class="service-card">

        <div class="service-icon-wrap">
            <i class="bi bi-tools"></i>
        </div>

        <div class="service-title">{{ $service->nama_layanan }}</div>
        <p class="service-desc">{{ $service->deskripsi }}</p>

        {{-- Tombol Edit & Hapus --}}
        <div class="d-flex gap-2 mt-auto">
            <a href="{{ route('admin.layanan.edit', $service->id_layanan) }}"
                class="btn btn-sm btn-warning w-100">
                <i class="bi bi-pencil"></i> Edit
            </a>

            <form method="POST" action="{{ route('admin.layanan.destroy', $service->id_layanan) }}" class="w-100">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus layanan ini?')"
                    class="btn btn-sm btn-danger w-100">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
        </div>

    </div>
    @empty
    <div class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
        Belum ada layanan. Klik "Add New Service" untuk memulai.
    </div>
    @endforelse

</div>

@endsection

@push('styles')
<style>
    /* ── SERVICES GRID ── */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    /* ── ADD NEW SERVICE CARD ── */
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
        transition: border-color 0.2s, background 0.2s;
        text-decoration: none;
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

    /* ── SERVICE CARD ── */
    .service-card {
        background: #fff;
        border-radius: 12px;
        padding: 28px 24px 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        text-decoration: none;
        transition: box-shadow 0.2s, transform 0.2s;
        min-height: 240px;
    }

    .service-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
        transform: translateY(-2px);
    }

    /* icon box */
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
</style>
@endpush