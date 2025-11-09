@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="mb-4 text-xl font-semibold">Tambah Buku Baru</h2>

    <form action="{{ route('admin.book.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Judul Buku</label>
            <input type="text" name="judul" class="w-full p-2 border rounded" value="{{ old('judul') }}">
            @error('judul') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Penulis</label>
            <input type="text" name="penulis" class="w-full p-2 border rounded" value="{{ old('penulis') }}">
            @error('penulis') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Penerbit</label>
            <input type="text" name="penerbit" class="w-full p-2 border rounded" value="{{ old('penerbit') }}">
            @error('penerbit') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="w-full p-2 border rounded" value="{{ old('tahun_terbit') }}">
            @error('tahun_terbit') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Kategori</label>
            <select name="kategori" class="w-full p-2 border rounded">
                <option value="">Pilih Kategori</option>
                <option value="fiksi" {{ old('kategori') == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
                <option value="non_fiksi" {{ old('kategori') == 'non_fiksi' ? 'selected' : '' }}>Non Fiksi</option>
                <option value="pelajaran" {{ old('kategori') == 'pelajaran' ? 'selected' : '' }}>Pelajaran</option>
            </select>
            @error('kategori') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.books') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
