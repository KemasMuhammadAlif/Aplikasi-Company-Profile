<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    // Tampilkan semua layanan
    public function index()
    {
        $services = Layanan::latest('id_layanan')->get();
        return view('admin.layanan', compact('services'));
    }

    // Simpan layanan baru
    public function store(Request $request)
    {
        Layanan::create([
            'id_admin'     => Auth::guard('admin')->id(),
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
            'icon'         => $request->icon,
        ]);

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        Layanan::findOrFail($id)->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
            'icon'         => $request->icon,
        ]);

        return back()->with('success', 'Berhasil diupdate');
    }

    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}
