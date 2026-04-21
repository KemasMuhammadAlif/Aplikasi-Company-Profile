<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display the Portfolio Management page.
     * TODO: Ganti data dummy ini dengan query dari database (Eloquent / DB facade).
     */
    public function index()
    {
        // ─── DATA DUMMY ──────────────────────────────────────────────────────
        // Nanti ganti dengan: $projects = Project::latest()->get();
        // lalu di blade akses pakai $project->title, $project->image, dst.
        $projects = [
            [
                'title' => 'Terminal 4 Expansion',
                'description' => 'Structural steel installation and foundation...',
                'category' => 'Infrastructure',
                'date' => 'Oct 2024',
                'status' => 'Active',
                'image' => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80',
            ],
            [
                'title' => 'Apex Tower Phase II',
                'description' => 'Vertical core development and exterior curtain wall...',
                'category' => 'Commercial',
                'date' => 'Dec 2024',
                'status' => 'Planning',
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&q=80',
            ],
            [
                'title' => 'Solar Array Grid Connect',
                'description' => 'Installation of high-capacity energy storage...',
                'category' => 'Energy',
                'date' => 'Jan 2025',
                'status' => 'Active',
                'image' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=600&q=80',
            ],
        ];
        // ─────────────────────────────────────────────────────────────────────

        return view('admin.project', compact('projects'));
    }
}