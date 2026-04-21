<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ Management page.
     * TODO: Ganti data dummy ini dengan query dari database (Eloquent / DB facade).
     */
    public function index()
    {
        // ─── DATA DUMMY ──────────────────────────────────────────────────────
        // Nanti ganti dengan: $faqs = Faq::all();
        // Fields yang dibutuhkan view: question, answer, icon
        $faqs = [
            [
                'question' => 'How do i contact you?',
                'answer' => 'idk lol',
                'icon' => 'bi-telephone',
            ],
            [
                'question' => 'Ask smth',
                'answer' => 'Expert oversight of timelines, budgets, and resources to optimize project efficiency and stakeholder satisfaction.',
                'icon' => 'bi-diagram-3',
            ],
            [
                'question' => 'How to Pay',
                'answer' => 'Specialized engineering for public works, transportation, and large-scale industrial infrastructure projects.',
                'icon' => 'bi-credit-card',
            ],
        ];
        // ─────────────────────────────────────────────────────────────────────

        return view('admin.faq', compact('faqs'));
    }
}