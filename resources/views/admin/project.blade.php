@extends('layouts.app')

@section('title', 'Portfolio Management')

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb-custom">
        <a href="#">Portfolio</a>
        <span class="bc-sep">›</span>
        <span class="bc-active">Active Projects</span>
    </div>

    {{-- Page Title --}}
    <h1 class="page-title">Portfolio Management</h1>

    {{-- Projects Grid --}}
    <div class="projects-grid">

        {{-- ── ADD NEW PROJECT ── --}}
        <a href="#" class="add-project-card">
            <div class="add-icon-wrap">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-project-label">Add New Project</span>
        </a>

        {{-- ── PROJECT CARDS ── --}}
        @forelse ($projects as $project)
            <a href="#" class="project-card">

                {{-- Thumbnail --}}
                <div class="card-img-wrap">
                    @if ($project['image'])
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}">
                    @else
                        <div
                            style="width:100%;height:100%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-image" style="font-size:32px;color:#94a3b8;"></i>
                        </div>
                    @endif

                    {{-- Category Badge --}}
                    <span class="cat-badge cat-{{ strtolower($project['category']) }}">
                        {{ $project['category'] }}
                    </span>
                </div>

                {{-- Body --}}
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

@endsection