<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Buku;

class kategori_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua kategori
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori',
        ]);

        // Simpan kategori baru
        Kategori::create($validated);

        // Redirect setelah berhasil menambah kategori
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // // Ambil semua buku yang terkait dengan kategori ini
        // $bukus = $kategori->buku()->get();

        return view('kategori.show', compact('kategori'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $id,
        ]);

        // Cari kategori berdasarkan ID dan update datanya
        $kategori = Kategori::findOrFail($id);
        $kategori->update($validated);

        // Redirect setelah berhasil memperbarui kategori
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);
        $kategori->buku()->detach();
        // Hapus kategori
        $kategori->delete();

        // Redirect setelah berhasil menghapus kategori
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
