@extends('layouts.app')
{{-- Extend dari layout --}}

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-semibold">Daftar Kategori</h1>
            <a href="{{ route('kategori.create') }}" class="px-4 py-2 bg-sky-500 text-white rounded">Tambah Kategori</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-1/4">Nama Kategori</th>
                        <th scope="col" class="px-6 py-3 w-1/4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $kategori->nama_kategori }}</td>
                            <td class="px-6 py-4">
                                <!-- Button Detail, Edit, Hapus menggunakan Flexbox untuk rapi -->
                                <div class="flex gap-2">
                                    <a href="{{ route('kategori.show', $kategori->id) }}"
                                        class="px-4 py-2 bg-sky-400 text-white rounded hover:bg-sky-500">Detail</a>

                                    <a href="{{ route('kategori.edit', $kategori->id) }}"
                                        class="px-4 py-2 bg-sky-600 text-white rounded hover:bg-sky-700">Edit</a>

                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-sky-700 text-white rounded hover:bg-sky-800"
                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center px-6 py-4">Tidak ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
