<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    /**
     * Display the Certificate Management page.
     * TODO: Ganti data dummy ini dengan query dari database (Eloquent / DB facade).
     */
    public function index()
    {
        // ─── DATA DUMMY ──────────────────────────────────────────────────────
        // Nanti ganti dengan: $certificates = Sertifikat::all();
        // Fields yang dibutuhkan view:
        //   title, description, category, category_color,
        //   status_label, status_type (valid|expiring|lifetime|active|renewal),
        //   image (URL gambar background)
        $certificates = [
            [
                'title' => 'ISO 9001:2015',
                'description' => 'Quality Management Systems implementation and surveillance audit status.',
                'category' => 'Quality System',
                'category_color' => 'blue',
                'status_label' => 'Valid Until 2025',
                'status_type' => 'valid',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'title' => 'K3 Certificate',
                'description' => 'Occupational Health and Safety Expert (Ahli K3) general operational license.',
                'category' => 'Safety Permit',
                'category_color' => 'orange',
                'status_label' => 'Expiring in 30 Days',
                'status_type' => 'expiring',
                'image' => 'https://images.unsplash.com/photo-1590274853856-f22d5ee3d228?w=600&q=80',
            ],
            [
                'title' => 'IUKN Nasional',
                'description' => 'Izin Usaha Kawasan Nasional - Prime industrial zone operations permit.',
                'category' => 'National Standard',
                'category_color' => 'gray',
                'status_label' => 'Lifetime Validity',
                'status_type' => 'lifetime',
                'image' => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80',
            ],
            [
                'title' => 'ISO 14001:2015',
                'description' => 'Environmental Management Systems for sustainable production sites.',
                'category' => 'Eco Compliance',
                'category_color' => 'green',
                'status_label' => 'Active Status',
                'status_type' => 'active',
                'image' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=600&q=80',
            ],
            [
                'title' => 'ASME Section IX',
                'description' => 'Welding and Brazing Qualifications for pressure vessel manufacturing.',
                'category' => 'Technical Process',
                'category_color' => 'gray',
                'status_label' => 'Renewal Required',
                'status_type' => 'renewal',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&q=80',
            ],
        ];
        // ─────────────────────────────────────────────────────────────────────

        return view('admin.sertifikat', compact('certificates'));
    }
}