@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold">Edit Member</h1>

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                @error('nama_kategori')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
