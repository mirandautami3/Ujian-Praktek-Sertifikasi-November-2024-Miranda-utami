<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Buku;

class member_controller extends Controller
{
    public function index()
    {
        return view('member.index', [
            'members' => Member::with('buku')->get(), // Sertakan data buku yang dipinjam
        ]);
    }

    public function create()
    {
        // Ambil semua buku yang belum dipinjam
        return view('member.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:12|unique:member,no_telepon',
            'tanggal_bergabung' => 'required|date',

        ]);

        // Simpan data member baru
        Member::create([
            'nama_member' => $request->nama_member,
            'no_telepon' => $request->no_telepon,
            'tanggal_bergabung' => $request->tanggal_bergabung,
        ]);


        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan beserta buku yang dipinjam');
    }

    public function show(string $id)
    {
        $member = Member::with('buku')->findOrFail($id); // Sertakan data buku yang dipinjam
        return view('member.show', compact('member'));
    }

    public function edit(string $id)
    {
        $member = Member::findOrFail($id);
        return view('member.edit', compact('member'));
    }

    public function update(Request $request, $id)
{
    // Validasi inputan
    $validated = $request->validate([
        'nama_member' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:12|unique:member,no_telepon,'. $id,
        'tanggal_bergabung' => 'required|date',
    ]);

    // Cari member berdasarkan ID
    $member = Member::findOrFail($id);

    // Update data member
    $member->update([
        'nama_member' => $validated['nama_member'],
        'no_telepon' => $validated['no_telepon'],
        'tanggal_bergabung' => $validated['tanggal_bergabung'],
    ]);

    // Redirect setelah berhasil
    return redirect()->route('member.index')->with('success', 'Member berhasil diupdate.');
}


    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);

        // Lepaskan semua buku yang sedang dipinjam
        Buku::where('member_id', $member->id)->update(['member_id' => null]);

        $member->delete();

        return redirect()->route('member.index')->with('success', 'Member dan buku yang dipinjam berhasil dihapus');
    }
}
