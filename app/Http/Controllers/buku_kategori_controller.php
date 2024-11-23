<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuKategoriController extends Controller
{
    /**
     * Menambahkan kategori ke buku tertentu.
     */
    public function addKategoriToBuku(Request $request, $buku_id)
    {
        // Validasi ID kategori yang diterima
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($buku_id);

        // Cari kategori berdasarkan ID yang diterima
        $kategori = Kategori::findOrFail($request->kategori_id);

        // Menambahkan kategori ke buku
        $buku->kategoris()->attach($kategori);

        // Redirect ke halaman buku dengan pesan sukses
        return redirect()->route('buku.show', $buku_id)
            ->with('success', 'Kategori berhasil ditambahkan ke buku.');
    }

    /**
     * Menghapus kategori dari buku tertentu.
     */
    public function removeKategoriFromBuku(Request $request, $buku_id)
    {
        // Validasi ID kategori yang diterima
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($buku_id);

        // Cari kategori berdasarkan ID yang diterima
        $kategori = Kategori::findOrFail($request->kategori_id);

        // Menghapus kategori dari buku
        $buku->kategoris()->detach($kategori);

        // Redirect ke halaman buku dengan pesan sukses
        return redirect()->route('buku.show', $buku_id)
            ->with('success', 'Kategori berhasil dihapus dari buku.');
    }
}
