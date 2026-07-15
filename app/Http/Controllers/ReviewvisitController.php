<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Support\Facades\DB;

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
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:100',
        ]);

        // Menerapkan DB Transaction untuk menjamin atomisitas data Reviewer & Review
        DB::transaction(function () use ($request, $anonymous) {
            if ($anonymous) {
                // Simpan nama dan email asli di database, tetapi publik tetap anonim.
                $reviewer = Reviewer::create([
                    'nama'  => $request->nama,
                    'email' => $request->email,
                ]);
            } else {
                $reviewer = Reviewer::firstOrCreate(
                    ['email' => $request->email],
                    ['nama'  => $request->nama]
                );
            }

            $admin = \App\Models\Admin::first();
            $adminId = $admin ? $admin->id_admin : 1;

            // Menyimpan review menggunakan Eloquent ORM biasa agar kompatibel di InfinityFree
            Review::create([
                'id_admin'    => $adminId,
                'id_reviewer' => $reviewer->id_reviewer,
                'pesan'       => $request->pesan,
                'rating'      => (int) $request->rating,
                'anonymous'   => $anonymous,
            ]);
        });

        return response()->json([
            'success' => true
        ]);
    }
}
