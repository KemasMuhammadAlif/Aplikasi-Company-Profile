<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class UlasanController extends Controller
{
    // Tampilkan semua ulasan
    public function index()
    {
        $ulasans = Review::with('reviewer', 'admin')->latest('id_review')->get();
        return view('admin.pages.ulasan', compact('ulasans'));
    }

    // Simpan balasan admin
    public function balas(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required|string|max:1000',
        ]);

        Review::findOrFail($id)->update([
            'balasan' => $request->balasan,
        ]);

        return redirect()->route('admin.ulasan')->with('success', 'Balasan berhasil disimpan!');
    }

    // Hapus ulasan
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->route('admin.ulasan')->with('success', 'Ulasan berhasil dihapus!');
    }
}
