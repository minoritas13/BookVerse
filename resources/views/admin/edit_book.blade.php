@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Back Button --}}
    <div class="flex justify-start mb-6">
        <a href="{{ route('admin.books') }}"
           class="flex items-center gap-2 px-4 py-2 text-indigo-600 hover:underline font-medium">
            ← Kembali ke daftar buku
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

        <div class="px-6 py-5 border-b bg-gray-50 rounded-t-xl">
            <h2 class="text-xl font-bold text-indigo-700">Edit Informasi Buku</h2>
            <p class="mt-1 text-sm text-gray-500">Perbarui data buku secara akurat dan rapi.</p>
        </div>

        @if (session('success'))
            <div class="mx-6 mt-4 p-3 text-green-700 bg-green-50 border border-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.book.update', $book->id) }}" method="POST" class="px-6 py-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Judul Buku</label>
                <input type="text" name="judul"
                    value="{{ old('judul', $book->judul) }}"
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-gray-800">
                @error('judul')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Penulis</label>
                <input type="text" name="penulis"
                    value="{{ old('penulis', $book->penulis) }}"
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-gray-800">
                @error('penulis')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Penerbit</label>
                <input type="text" name="penerbit"
                    value="{{ old('penerbit', $book->penerbit) }}"
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-gray-800">
                @error('penerbit')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Tahun Terbit</label>
                <input type="number" name="tahun_terbit"
                    value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-gray-800">
                @error('tahun_terbit')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
                <select name="kategori"
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-200 text-gray-800">
                    <option value="">Pilih Kategori</option>
                    <option value="fiksi" {{ old('kategori', $book->kategori) == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
                    <option value="non_fiksi" {{ old('kategori', $book->kategori) == 'non_fiksi' ? 'selected' : '' }}>Non Fiksi</option>
                    <option value="pelajaran" {{ old('pelajaran', $book->kategori) == 'pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                </select>
                @error('kategori')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="px-5 py-2.5 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition shadow-sm">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
