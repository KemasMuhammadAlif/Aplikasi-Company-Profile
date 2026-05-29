<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Layanan;
use App\Models\Faq;
use App\Models\DokumenPerusahaan;
use App\Models\Review;
use App\Models\ProfilPerusahaan;

class HomepageController extends Controller
{
    public function index()
    {
        $proyeks    = Proyek::with('thumbnail')->latest('tanggal')->take(6)->get();
        $layanans   = Layanan::all();
        $faqs       = Faq::all();
        $sertifikat = DokumenPerusahaan::all();
        $profil     = ProfilPerusahaan::first();

        $reviews = Review::with(['reviewer', 'admin'])
            ->latest('id_review')
            ->take(3)
            ->get();

        return view('pengunjung.home', compact(
            'proyeks',
            'faqs',
            'layanans',
            'sertifikat',
            'profil',
            'reviews'
        ));
    }

    public function faqvisit()
    {
        $faqs     = Faq::all();
        $layanans = Layanan::all();

        return view('pengunjung.faqvisit', compact('faqs', 'layanans'));
    }

    public function proyekvisit()
    {
        $proyeks  = Proyek::with('thumbnail')->latest('tanggal')->get();
        $layanans = Layanan::all();

        return view('pengunjung.proyekvisit', compact('proyeks', 'layanans'));
    }

    public function proyekdetail(int $id)
    {
        $proyek   = Proyek::with('dokumentasi')->findOrFail($id);
        $layanans = Layanan::all();

        $fotoJson = $proyek->dokumentasi->map(function ($f) {
            return [
                'src' => asset('storage/' . $f->dokumentasi),
                'alt' => 'Foto Proyek',
            ];
        })->toJson();

        return view('pengunjung.proyekdetail', compact('proyek', 'layanans', 'fotoJson'));
    }

    public function review()
    {
        $reviews = Review::with(['reviewer', 'admin'])->get();
        return view('pengunjung.review', compact('reviews'));
    }
}