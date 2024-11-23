@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold">Edit Buku</h1>

        <form action="{{ route('buku.update', $buku->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul_buku" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                <input type="text" name="judul_buku" id="judul_buku"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('judul_buku', $buku->judul_buku) }}" required>
                @error('judul_buku')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="autor_buku" class="block text-sm font-medium text-gray-700">Autor Buku</label>
                <input type="text" name="autor_buku" id="autor_buku"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('autor_buku', $buku->autor_buku) }}" required>
                @error('autor_buku')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_terbit_buku" class="block text-sm font-medium text-gray-700">Tanggal Terbit</label>
                <input type="date" name="tanggal_terbit_buku" id="tanggal_terbit_buku"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('tanggal_terbit_buku', $buku->tanggal_terbit_buku) }}" required>
                @error('tanggal_terbit_buku')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="member_id">Anggota</label>
                <select name="member_id" id="member_id" class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Tidak pilih</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ $member->id == $buku->member_id ? 'selected' : '' }}>{{ $member->nama_member }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <div class="space-y-2">
                    @foreach($kategoris as $kategori)
                        <div>
                            <input type="checkbox" name="kategori[]" value="{{ $kategori->id }}" id="kategori_{{ $kategori->id }}"
                                class="mr-2 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                {{ in_array($kategori->id, $buku->kategori->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label for="kategori_{{ $kategori->id }}">{{ $kategori->nama_kategori }}</label>
                        </div>
                    @endforeach
                </div>
                @error('kategori')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="px-4 py-2 text-white bg-sky-500 rounded-lg hover:bg-sky-600 focus:ring-2 focus:ring-indigo-500">
                Simpan
            </button>
        </form>
    </div>
@endsection
