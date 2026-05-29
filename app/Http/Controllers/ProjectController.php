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

    // Simpan proyek baru (bisa banyak foto)
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'nullable|date',
            'lokasi'      => 'nullable|string|max:200',
            'images'      => 'nullable|array',
            'images.*'    => 'image|max:4096',
        ]);

        $proyek = Proyek::create([
            'id_admin'    => Auth::guard('admin')->id(),
            'nama_proyek' => $request->nama_proyek,
            'deskripsi'   => $request->deskripsi,
            'tanggal'     => $request->tanggal,
            'lokasi'      => $request->lokasi,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('dokumentasi', 'public');
                DokumentasiProyek::create([
                    'id_proyek'   => $proyek->id_proyek,
                    'dokumentasi' => $path,
                ]);
            }
        }

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil ditambahkan!');
    }

    // Update proyek (tambah foto baru, tidak hapus yang lama)
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'nullable|date',
            'lokasi'      => 'nullable|string|max:200',
            'images'      => 'nullable|array',
            'images.*'    => 'image|max:4096',
        ]);

        $proyek = Proyek::findOrFail($id);
        $proyek->update([
            'nama_proyek' => $request->nama_proyek,
            'deskripsi'   => $request->deskripsi,
            'tanggal'     => $request->tanggal,
            'lokasi'      => $request->lokasi,
        ]);

        // Upload foto baru (tambah, tidak hapus yang lama)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('dokumentasi', 'public');
                DokumentasiProyek::create([
                    'id_proyek'   => $proyek->id_proyek,
                    'dokumentasi' => $path,
                ]);
            }
        }

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil diupdate!');
    }

    // Hapus 1 foto dokumentasi
    public function destroyFoto(int $id)
    {
        $dok = DokumentasiProyek::findOrFail($id);
        Storage::disk('public')->delete($dok->dokumentasi);
        $dok->delete();

        return response()->json(['success' => true]);
    }

    // Hapus proyek beserta semua foto
    public function destroy(int $id)
    {
        $proyek = Proyek::with('dokumentasi')->findOrFail($id);

        foreach ($proyek->dokumentasi as $dok) {
            Storage::disk('public')->delete($dok->dokumentasi);
        }

        $proyek->delete();

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil dihapus!');
    }

    // Ambil daftar foto untuk dropdown (AJAX)
    public function getFotos(int $id)
    {
        $fotos = DokumentasiProyek::where('id_proyek', $id)->get()->map(function ($f) {
            return [
                'id'  => $f->id_dok_proyek,
                'src' => asset('storage/' . $f->dokumentasi),
                'nama' => basename($f->dokumentasi),
            ];
        });

        return response()->json($fotos);
    }
}