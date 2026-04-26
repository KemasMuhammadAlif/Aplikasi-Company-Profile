<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Layanan;

class FaqvisitController extends Controller
{
    public function index()
    {
        $faqs     = Faq::latest('id_faq')->get();
        $layanans = Layanan::all();

        return view('pengunjung.faqvisit', compact('faqs', 'layanans'));
    }
}