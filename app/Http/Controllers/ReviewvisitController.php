<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reviewer;

class ReviewvisitController extends Controller
{
    public function index()
    {
        $reviews = Review::with('reviewer', 'admin')->latest('id_review')->get();
        return view('pengunjung.review', compact('reviews'));
    }

    public function store(Request $request)
    {
        $anonymous = $request->boolean('anonymous');

        // Validasi yang selalu wajib
        $request->validate([
            'pesan'  => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Validasi hanya jika bukan anonim
        if (!$anonymous) {
            $request->validate([
                'nama'  => 'required|string|max:100',
                'email' => 'required|email|max:100',
            ]);
        }

        if ($anonymous) {
            $reviewer = Reviewer::create([
                'nama'  => 'Anonim',
                'email' => 'anonymous+' . uniqid() . '@example.com',
            ]);
        } else {
            $reviewer = Reviewer::firstOrCreate(
                ['email' => $request->email],
                ['nama'  => $request->nama]
            );
        }

        Review::create([
            'id_admin'    => 1,
            'id_reviewer' => $reviewer->id_reviewer,
            'pesan'       => $request->pesan,
            'rating'      => (int) $request->rating,
            'anonymous'   => $anonymous,
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
