@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 max-w-2xl">
    <a href="{{ route('books.index') }}"
        class="inline-flex items-center mb-6 text-blue-700 font-medium hover:underline hover:gap-2 transition">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali
    </a>

    <!-- Card Info Buku -->
    <div class="p-8 bg-gradient-to-br from-blue-100 via-white to-white rounded-2xl shadow-xl flex flex-col gap-5 mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $book->judul }}</h1>
        <div class="flex flex-wrap gap-5 text-gray-800">
            <div>
                <span class="font-semibold">Penulis:</span>
                <span>{{ $book->penulis }}</span>
            </div>
            <div>
                <span class="font-semibold">Penerbit:</span>
                <span>{{ $book->penerbit }}</span>
            </div>
            <div>
                <span class="font-semibold">Tahun Terbit:</span>
                <span>{{ $book->tahun_terbit ?? '-' }}</span>
            </div>
            <div>
                <span class="font-semibold">Kategori:</span>
                <span class="inline-block rounded-lg px-2 py-1 bg-blue-200 text-blue-900 text-xs font-bold uppercase tracking-wider ml-1">
                    {{ $book->kategori ?? '-' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Form Peminjaman -->
    <form action="{{ route('loans.store') }}" method="POST" class="bg-white rounded-2xl shadow p-8 flex flex-col gap-6">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <div>
            <label for="loan_date" class="block mb-1 text-sm font-semibold text-gray-800">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="loan_date"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                   required>
        </div>

        <div>
            <label for="return_date" class="block mb-1 text-sm font-semibold text-gray-800">Tanggal Kembali (Opsional)</label>
            <input type="date" name="tanggal_kembali" id="return_date"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
        </div>

        <div>
            <label for="jumlah" class="block mb-1 text-sm font-semibold text-gray-800">Jumlah Buku</label>
            <input type="number" name="jumlah" id="jumlah" value="1" min="1"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
        </div>

        <button type="submit"
            class="w-full py-3 mt-2 text-lg font-bold rounded-xl bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500 text-white shadow-lg hover:from-blue-500 hover:to-blue-700 hover:scale-105 transition">
            Pinjam Buku Ini
        </button>
    </form>
</div>
@endsection
