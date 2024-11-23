@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Detail Buku</h1>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Judul Buku</label>
                <p class="mt-1 text-lg">{{ $buku->judul_buku }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Autor Buku</label>
                <p class="mt-1 text-lg">{{ $buku->autor_buku }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Tanggal Terbit Buku</label>
                <p class="mt-1 text-lg">{{ $buku->tanggal_terbit_buku }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Peminjam</label>
                <p class="mt-1 text-lg">
                    @if($buku->member)
                        {{ $buku->member->nama_member }}
                    @else
                        Tidak ada member
                    @endif
                </p>

            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Kategori</label>
                @foreach ($buku->kategori as $kategori)
                    <p class="mt-1 text-lg">{{ $kategori->nama_kategori }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection

