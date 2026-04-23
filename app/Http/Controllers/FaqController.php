<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    // Tampilkan semua FAQ
    public function index()
    {
        $faqs = Faq::latest('id_faq')->get();
        return view('admin.faq', compact('faqs'));
    }

    // Tampilkan form tambah FAQ
    public function create()
    {
        return view('admin.faq-create');
    }

    // Simpan FAQ baru
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban'    => 'required|string',
        ]);

        Faq::create([
            'id_admin'   => Auth::guard('admin')->id(),
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq-edit', compact('faq'));
    }

    // Update FAQ
    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'jawaban'    => 'required|string',
        ]);

        Faq::findOrFail($id)->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ berhasil diupdate!');
    }

    // Hapus FAQ
    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faq')->with('success', 'FAQ berhasil dihapus!');
    }
}