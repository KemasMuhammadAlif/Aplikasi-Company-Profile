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
    <h1 class="page-title">FAQ Manajemen</h1>

    {{-- FAQ Grid --}}
    <div class="services-grid">

        {{-- ── ADD NEW FAQ → trigger modal ── --}}
        <a href="#" class="add-service-card" data-bs-toggle="modal" data-bs-target="#modalCreateFaq">
            <div class="add-icon-wrap">
                <i class="bi bi-plus-lg"></i>
            </div>
            <span class="add-service-label">Tambah FAQ</span>
        </a>

        {{-- ── FAQ CARDS ── --}}
        @forelse ($faqs as $faq)
            <a href="#" class="service-card">
                <div class="service-icon-wrap">
                    <i class="bi {{ $faq['icon'] }}"></i>
                </div>
                <div class="service-title">{{ $faq['question'] }}</div>
                <p class="service-desc">{{ $faq['answer'] }}</p>
            </a>
        @empty
            <div class="text-muted" style="grid-column:1/-1;padding:40px 0;text-align:center;font-size:14px;">
                Belum ada FAQ. Klik "Tambah FAQ" untuk memulai.
            </div>
        @endforelse

    </div>

    {{-- ════════════════════════════════════════
    MODAL: CREATE NEW FAQ
    ════════════════════════════════════════ --}}
    <div class="modal fade" id="modalCreateFaq" tabindex="-1" aria-labelledby="modalCreateFaqLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">

            {{-- modal-content WAJIB ada agar Bootstrap render dengan benar --}}
            <div class="modal-content border-0 p-0 overflow-hidden"
                style="border-radius: 14px; box-shadow: 0 24px 64px rgba(0,0,0,0.28);">

                {{-- ── HEADER (dark navy) ── --}}
                <div
                    style="background: #1a2236; padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                    <h5 id="modalCreateFaqLabel"
                        style="font-size: 17px; font-weight: 800; color: #fff; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">
                        Create New FAQ
                    </h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"
                        style="width: 32px; height: 32px; border-radius: 8px; border: none; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.70); display: flex; align-items: center; justify-content: center; font-size: 14px; cursor: pointer; flex-shrink: 0; transition: background 0.15s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.18)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- ── BODY ── --}}
                <div style="background: #fff; padding: 24px 24px 28px;">
                    <form action="{{ route('admin.faq.store') }}" method="POST" id="formCreateFaq">
                        @csrf

                        {{-- FAQ Name --}}
                        <div style="margin-bottom: 20px;">
                            <label for="faqName"
                                style="display: block; font-size: 10.5px; font-weight: 700; letter-spacing: 0.9px; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">
                                FAQ Name
                            </label>
                            <input type="text" id="faqName" name="question" placeholder="Tuliskan FAQ anda"
                                style="width: 100%; height: 44px; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 0 14px; font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; background: #f8fafc; outline: none; transition: border-color 0.2s, box-shadow 0.2s;"
                                onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.10)'; this.style.background='#fff'"
                                onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.background='#f8fafc'">
                        </div>

                        {{-- Jawaban --}}
                        <div style="margin-bottom: 24px;">
                            <label for="faqAnswer"
                                style="display: block; font-size: 10.5px; font-weight: 700; letter-spacing: 0.9px; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">
                                Jawaban
                            </label>
                            <textarea id="faqAnswer" name="answer" rows="5"
                                placeholder="Berikan jawaban dari pertanyaan anda"
                                style="width: 100%; border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 11px 14px; font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; background: #f8fafc; outline: none; resize: none; line-height: 1.6; transition: border-color 0.2s, box-shadow 0.2s;"
                                onfocus="this.style.borderColor='#2563eb'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.10)'; this.style.background='#fff'"
                                onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.background='#f8fafc'"></textarea>
                        </div>

                        {{-- Action Buttons --}}
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <button type="button" data-bs-dismiss="modal"
                                style="height: 44px; border: none; border-radius: 8px; background: #f1f5f9; color: #374151; font-size: 11.5px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; transition: background 0.15s;"
                                onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                Batal
                            </button>
                            <button type="submit"
                                style="height: 44px; border: none; border-radius: 8px; background: #2563eb; color: #fff; font-size: 11.5px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; transition: background 0.18s, box-shadow 0.18s;"
                                onmouseover="this.style.background='#1d4ed8'; this.style.boxShadow='0 4px 14px rgba(37,99,235,0.30)'"
                                onmouseout="this.style.background='#2563eb'; this.style.boxShadow='none'">
                                Simpan FAQ
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
        /* ── GRID ── */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        /* ── ADD CARD ── */
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
            text-align: center;
        }

        /* ── FAQ CARD ── */
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