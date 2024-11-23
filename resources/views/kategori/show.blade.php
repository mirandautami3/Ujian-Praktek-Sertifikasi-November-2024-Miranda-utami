@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Detail Kategori</h1>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Nama Kategori</label>
                <p class="mt-1 text-lg">{{ $kategori->nama_kategori }}</p>
            </div>
        </div>
    </div>
@endsection
