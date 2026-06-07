<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqKategori;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $kategoris         = FaqKategori::orderBy('urutan')->with(['faqs'])->get();
        $faqsTanpaKategori = Faq::whereNull('id_kategori')->orderBy('urutan')->get();
        return view('admin.pages.faq', compact('kategoris', 'faqsTanpaKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan'  => 'required|string',
            'jawaban'     => 'required|string',
            'id_kategori' => 'nullable|integer|exists:faq_kategori,id_kategori',
        ]);

        Faq::create([
            'id_admin'    => Auth::guard('admin')->id(),
            'id_kategori' => $request->id_kategori ?: null,
            'pertanyaan'  => $request->pertanyaan,
            'jawaban'     => $request->jawaban,
            'urutan'      => Faq::where('id_kategori', $request->id_kategori)->max('urutan') + 1,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan'  => 'required|string',
            'jawaban'     => 'required|string',
            'id_kategori' => 'nullable|integer|exists:faq_kategori,id_kategori',
        ]);

        Faq::findOrFail($id)->update([
            'pertanyaan'  => $request->pertanyaan,
            'jawaban'     => $request->jawaban,
            'id_kategori' => $request->id_kategori ?: null,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ berhasil diupdate!');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faq')->with('success', 'FAQ berhasil dihapus!');
    }

    // AJAX — dipanggil saat drag & drop selesai
    public function reorder(Request $request)
    {
        foreach ($request->items as $item) {
            Faq::where('id_faq', $item['id'])->update([
                'id_kategori' => $item['kategori'] ?: null,
                'urutan'      => $item['urutan'],
            ]);
        }
        return response()->json(['success' => true]);
    }
}