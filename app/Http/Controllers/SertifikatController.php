<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenPerusahaan;

class SertifikatController extends Controller
{
    public function index()
    {
        $certificates = DokumenPerusahaan::latest('id_dok_perusahaan')->get();
        return view('admin.sertifikat', compact('certificates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sertifikat' => 'required|string|max:255',
            'icon'       => 'nullable|string|max:50',
        ]);

        DokumenPerusahaan::create([
            'id_profil'  => 1,
            'sertifikat' => $request->sertifikat,
            'icon'       => $request->icon ?? 'bi-patch-check',
        ]);

        return redirect()->route('admin.sertifikat')->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sertifikat' => 'required|string|max:255',
            'icon'       => 'nullable|string|max:50',
        ]);

        DokumenPerusahaan::findOrFail($id)->update([
            'sertifikat' => $request->sertifikat,
            'icon'       => $request->icon ?? 'bi-patch-check',
        ]);

        return redirect()->route('admin.sertifikat')->with('success', 'Sertifikat berhasil diupdate!');
    }

    public function destroy($id)
    {
        DokumenPerusahaan::findOrFail($id)->delete();
        return redirect()->route('admin.sertifikat')->with('success', 'Sertifikat berhasil dihapus!');
    }
}
