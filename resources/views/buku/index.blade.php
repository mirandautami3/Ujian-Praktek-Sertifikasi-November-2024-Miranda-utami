@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-semibold">Daftar Buku</h1>
            <a href="{{ route('buku.create') }}" class="px-4 py-2 bg-sky-500 text-white rounded">Tambah Buku</a>
        </div>

        <!-- Form Filter -->
        <div class="mb-4">
            <form action="{{ route('buku.index') }}" method="GET" class="flex gap-4">
                <div>
                    <label for="member_id" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                    <select name="member_id" id="member_id"
                        class="mt-1 px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Semua Anggota</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->nama_member }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori_id" id="kategori_id"
                        class="mt-1 px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">Filter</button>
                </div>

            </form>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-1/4">Nama Buku</th>
                        <th scope="col" class="px-6 py-3 w-1/4">Autor Buku</th>
                        <th scope="col" class="px-6 py-3 w-1/4">Tanggal Terbit</th>
                        <th scope="col" class="px-6 py-3 w-1/4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukus as $buku)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $buku->judul_buku }}</td>
                            <td class="px-6 py-4">{{ $buku->autor_buku }}</td>
                            <td class="px-6 py-4">{{ $buku->tanggal_terbit_buku }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('buku.show', $buku->id) }}"
                                        class="px-4 py-2 bg-sky-400 text-white rounded hover:bg-sky-500">Detail</a>

                                    <a href="{{ route('buku.edit', $buku->id) }}"
                                        class="px-4 py-2 bg-sky-600 text-white rounded hover:bg-sky-700">Edit/Pinjam</a>

                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-sky-700 text-white rounded hover:bg-sky-800"
                                            onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-6 py-4">Tidak ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
