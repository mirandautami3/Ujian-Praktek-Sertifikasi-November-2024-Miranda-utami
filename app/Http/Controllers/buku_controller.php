<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Member;
use App\Models\Kategori;


class buku_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil data member dan kategori untuk filter
    $members = Member::all();
    $kategoris = Kategori::all();

    // Mulai query untuk buku
    $bukus = Buku::query();

    // Filter berdasarkan member_id jika ada
    if ($request->has('member_id') && $request->member_id != '') {
        $bukus->where('member_id', $request->member_id);
    }

    // Filter berdasarkan kategori_id jika ada
    if ($request->has('kategori_id') && $request->kategori_id != '') {
        $bukus->whereHas('kategori', function($query) use ($request) {
            $query->where('kategori.id', $request->kategori_id);
        });
    }

    // Ambil data buku yang sudah difilter
    $bukus = $bukus->get();

    // Tampilkan halaman dengan data buku dan filter
    return view('buku.index', compact('bukus', 'members', 'kategoris'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data kategori untuk dipilih saat menambah buku
        $kategoris = Kategori::all();
        $members = Member::all();
        return view('buku.create', compact('kategoris', 'members'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255|unique:buku,judul_buku',
            'autor_buku' => 'required|string|max:255',
            'tanggal_terbit_buku' => 'required|date',
            'member_id' => 'nullable|exists:member,id',  // Membolehkan member_id null atau valid ID member
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori,id',
        ]);


        // Simpan buku baru
        $buku = Buku::create([
            'judul_buku' => $validated['judul_buku'],
            'autor_buku' => $validated['autor_buku'],
            'tanggal_terbit_buku' => $validated['tanggal_terbit_buku'],
            'member_id' => $validated['member_id'] ?? null,
        ]);

        // Menyambungkan buku dengan kategori yang dipilih
        $buku->kategori()->attach($validated['kategori']);

        // Redirect setelah berhasil menambah buku
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari buku berdasarkan ID beserta kategori terkait
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari buku berdasarkan ID dan ambil kategori terkait
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        $members = Member::all();
        return view('buku.edit', compact('buku', 'kategoris', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255|unique:buku,judul_buku,' . $id,
            'autor_buku' => 'required|string|max:255',
            'tanggal_terbit_buku' => 'required|date',
            'member_id' => 'nullable|exists:member,id',  // Membolehkan member_id null atau valid ID member
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori,id',
        ]);


        // Temukan buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Perbarui data buku
        $buku->update([
            'judul_buku' => $validated['judul_buku'],
            'autor_buku' => $validated['autor_buku'],
            'tanggal_terbit_buku' => $validated['tanggal_terbit_buku'],
            'member_id' => $validated['member_id'] ?? null,
        ]);

        // Perbarui hubungan kategori buku
        $buku->kategori()->sync($validated['kategori']); // sync() untuk mengganti kategori yang terhubung

        // Redirect setelah berhasil mengupdate buku
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Hapus relasi kategori terkait dengan buku
        $buku->kategori()->detach(); // Menghapus hubungan banyak-ke-banyak

        // Hapus buku setelah relasi dihapus
        $buku->delete();

        // Redirect setelah berhasil menghapus buku
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
