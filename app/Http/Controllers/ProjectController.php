<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\DokumentasiProyek;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Tampilkan semua proyek
    public function index()
    {
        $projects = Proyek::with('thumbnail')->latest('tanggal')->get();
        return view('admin.pages.project', compact('projects'));
    }

    // Simpan proyek baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'nullable|date',
            'image'       => 'nullable|image|max:2048',
        ]);

        $proyek = Proyek::create([
            'id_admin'    => Auth::guard('admin')->id(),
            'nama_proyek' => $request->nama_proyek,
            'deskripsi'   => $request->deskripsi,
            'tanggal'     => $request->tanggal,
            'lokasi'      => $request->lokasi,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('dokumentasi', 'public');
            DokumentasiProyek::create([
                'id_proyek'   => $proyek->id_proyek,
                'dokumentasi' => $path,
            ]);
        }

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil ditambahkan!');
    }

    // Update proyek
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'nullable|date',
            'image'       => 'nullable|image|max:2048',
        ]);

        $proyek = Proyek::findOrFail($id);
        $proyek->update([
            'nama_proyek' => $request->nama_proyek,
            'deskripsi'   => $request->deskripsi,
            'tanggal'     => $request->tanggal,
            'lokasi'      => $request->lokasi,
        ]);

        if ($request->hasFile('image')) {
            // Hapus foto lama
            if ($proyek->thumbnail) {
                Storage::disk('public')->delete($proyek->thumbnail->dokumentasi);
                $proyek->thumbnail->delete();
            }
            // Upload foto baru
            $path = $request->file('image')->store('dokumentasi', 'public');
            DokumentasiProyek::create([
                'id_proyek'   => $proyek->id_proyek,
                'dokumentasi' => $path,
            ]);
        }

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil diupdate!');
    }

    // Hapus proyek
    public function destroy($id)
    {
        $proyek = Proyek::with('dokumentasi')->findOrFail($id);

        foreach ($proyek->dokumentasi as $dok) {
            Storage::disk('public')->delete($dok->dokumentasi);
        }

        $proyek->delete();

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil dihapus!');
    }
}