<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display the Service Management page.
     * TODO: Ganti data dummy ini dengan query dari database (Eloquent / DB facade).
     */
    public function index()
    {
        // ─── DATA DUMMY ──────────────────────────────────────────────────────
        // Nanti ganti dengan: $services = Layanan::all();
        // lalu di blade akses pakai $service->title, $service->icon, dst.
        $services = [
            [
                'title' => 'General Contracting',
                'description' => 'Full-spectrum management of construction projects, ensuring safety, quality, and timely delivery from start to finish.',
                'icon' => 'bi-tools',
            ],
            [
                'title' => 'Project Management',
                'description' => 'Expert oversight of timelines, budgets, and resources to optimize project efficiency and stakeholder satisfaction.',
                'icon' => 'bi-diagram-3',
            ],
            [
                'title' => 'Infrastructure Development',
                'description' => 'Specialized engineering for public works, transportation, and large-scale industrial infrastructure projects.',
                'icon' => 'bi-building',
            ],
            [
                'title' => 'Design & Build',
                'description' => 'A streamlined approach combining design and construction phases into a single point of responsibility.',
                'icon' => 'bi-pencil-square',
            ],
        ];
        // ─────────────────────────────────────────────────────────────────────

        return view('admin.layanan', compact('services'));
    }
}