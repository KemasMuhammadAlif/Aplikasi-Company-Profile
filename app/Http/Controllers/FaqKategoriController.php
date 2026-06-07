<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqKategori;
use App\Models\Faq;

class FaqKategoriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);

        FaqKategori::create([
            'nama_kategori' => $request->nama_kategori,
            'urutan'        => FaqKategori::max('urutan') + 1,
        ]);

        return redirect()->route('admin.faq')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);
        FaqKategori::findOrFail($id)->update(['nama_kategori' => $request->nama_kategori]);
        return redirect()->route('admin.faq')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id)
    {
        Faq::where('id_kategori', $id)->update(['id_kategori' => null]);
        FaqKategori::findOrFail($id)->delete();
        return redirect()->route('admin.faq')->with('success', 'Kategori berhasil dihapus!');
    }
}