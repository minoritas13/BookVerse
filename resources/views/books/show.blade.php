@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">
        <a href="{{ route('books.index') }}" class="inline-block mb-4 text-blue-600 hover:underline">&larr; Kembali</a>

        <div class="p-6 bg-white rounded-lg shadow">
            <h1 class="mb-4 text-2xl font-bold">{{ $book->judul }}</h1>

            <div class="space-y-2">
                <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
                <p><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
                <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit ?? '-' }}</p>
                <p><strong>Kategori:</strong> {{ $book->kategori ?? '-' }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('loans.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <div>
            <label for="loan_date" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="loan_date"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring focus:ring-blue-200" required>
        </div>

        <div>
            <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal Kembali (Opsional)</label>
            <input type="date" name="tanggal_kembali" id="return_date"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Buku</label>
            <input type="number" name="jumlah" id="jumlah" value="1" min="1"
                class="w-full p-2 mt-1 border border-gray-300 rounded-md focus:ring focus:ring-blue-200">
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
            Pinjam Buku Ini
        </button>
    </form>
@endsection
