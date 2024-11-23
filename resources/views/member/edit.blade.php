@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold">Edit Member</h1>

        <form action="{{ route('member.update', $member->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_member" class="block text-sm font-medium text-gray-700">Nama Member</label>
                <input type="text" name="nama_member" id="nama_member"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('nama_member', $member->nama_member) }}" required>
                @error('nama_member')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input
                    type="text"
                    name="no_telepon"
                    id="no_telepon"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('no_telepon', $member->no_telepon) }}"
                    maxlength="12"
                    pattern="\d{12}"
                    title="Nomor telepon harus berisi tepat 12 angka."
                    required
                >
                @error('no_telepon')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label for="tanggal_bergabung" class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                <input type="date" name="tanggal_bergabung" id="tanggal_bergabung"
                    class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('tanggal_bergabung', $member->tanggal_bergabung) }}" required>
                @error('tanggal_bergabung')
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
