<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Layanan;

class FaqvisitController extends Controller
{
    public function index()
    {
        $kategoris         = \App\Models\FaqKategori::orderBy('urutan')
            ->with(['faqs' => fn($q) => $q->orderBy('urutan')])
            ->get();
        $faqsTanpaKategori = \App\Models\Faq::whereNull('id_kategori')->orderBy('urutan')->get();
        $layanans          = \App\Models\Layanan::all();
        $logoPerusahaan    = \App\Models\ProfilPerusahaan::first()?->logo;

        return view('pengunjung.faqvisit', compact('kategoris', 'faqsTanpaKategori', 'layanans', 'logoPerusahaan'));
    }
}
