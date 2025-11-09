@extends('layouts.app')

@section('content')
    <div class="flex justify-end space-x-2">
        <a href="{{ route('admin.books') }}" class="px-4 py-2 text-blue-700">Kembali</a>
    </div>
    
    <div class="p-6 bg-white rounded-lg shadow">
        <h2 class="mb-4 text-xl font-semibold">Edit Buku</h2>

        @if (session('success'))
            <div class="p-3 mb-4 text-green-700 bg-green-100 border border-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.book.update', $book->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Judul Buku</label>
                <input type="text" name="judul" class="w-full p-2 border rounded"
                    value="{{ old('judul', $book->judul) }}">
                @error('judul')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Penulis</label>
                <input type="text" name="penulis" class="w-full p-2 border rounded"
                    value="{{ old('penulis', $book->penulis) }}">
                @error('penulis')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Penerbit</label>
                <input type="text" name="penerbit" class="w-full p-2 border rounded"
                    value="{{ old('penerbit', $book->penerbit) }}">
                @error('penerbit')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="w-full p-2 border rounded"
                    value="{{ old('tahun_terbit', $book->tahun_terbit) }}">
                @error('tahun_terbit')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Kategori</label>
                <select name="kategori" class="w-full p-2 border rounded">
                    <option value="">Pilih Kategori</option>
                    <option value="fiksi" {{ old('kategori', $book->kategori) == 'fiksi' ? 'selected' : '' }}>Fiksi
                    </option>
                    <option value="non_fiksi" {{ old('kategori', $book->kategori) == 'non_fiksi' ? 'selected' : '' }}>Non
                        Fiksi</option>
                </select>
                @error('kategori')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
@endsection
