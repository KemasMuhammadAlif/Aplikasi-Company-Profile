@extends('layouts.app')

@section('title', 'Portfolio Management')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Admin</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Proyek</span>
    </div>

    {{-- Page Title --}}
    <h1 class="page-title">Manajemen Proyek</h1>

    {{-- Projects Grid --}}
    <div class="projects-grid">

        {{-- Tombol Add --}}
        <a href="{{ route('admin.project.create') }}" class="add-project-card">
            <div class="add-icon-wrap">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-project-label">Tambah Proyek</span>
        </a>

        {{-- Project Cards --}}
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
                            {{ $project->tanggal }}
                        </span>
                        <span class="card-date">
                            <i class="bi bi-geo-alt"></i>
                            {{ $project->lokasi }}
                        </span>
                    </div>
                </div>

                {{-- Tombol Hapus --}}
                <form method="POST" action="{{ route('admin.project.destroy', $project->id_proyek) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus proyek ini?')"
                        class="btn btn-sm btn-danger mt-2 w-100">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>

            </div>
        @empty
            <div class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;">
                Belum ada proyek. Klik "Tambah Proyek" untuk memulai.
            </div>
        @endforelse
    </div>

@endsection