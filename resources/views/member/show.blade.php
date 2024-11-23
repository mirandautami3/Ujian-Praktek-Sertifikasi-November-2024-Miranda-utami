@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Detail Member</h1>

        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Nama Member</label>
                <p class="mt-1 text-lg">{{ $member->nama_member }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Nomor Telepon</label>
                <p class="mt-1 text-lg">{{ $member->no_telepon }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-sky-500">Tanggal Bergabung</label>
                <p class="mt-1 text-lg">{{ $member->tanggal_bergabung }}</p>
            </div>
        </div>

        <!-- Daftar Buku yang Dipinjam -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold mb-4">Buku yang Dipinjam</h2>

            @if($member->buku->isEmpty())
                <p class="text-lg text-gray-500">Tidak ada buku yang dipinjam.</p>
            @else
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul Buku</th>
                            <th scope="col" class="px-6 py-3">Autor buku</th>
                            <th scope="col" class="px-6 py-3">Tanggal terbit buku</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($member->buku as $buku)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $buku->judul_buku }}</td>
                                <td class="px-6 py-4">{{ $buku->autor_buku }}</td>
                                <td class="px-6 py-4">{{ $buku->tanggal_terbit_buku }}</td>
                                {{-- <td class="px-6 py-4">
                                    {{ $buku->pivot->tanggal_kembali ? $buku->pivot->tanggal_kembali->format('d-m-Y') : 'Belum Kembali' }}
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
