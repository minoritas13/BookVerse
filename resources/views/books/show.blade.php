@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 max-w-2xl">

    <!-- Tombol Kembali Modern -->
    <div class="mb-8 flex items-center justify-center">
        <a href="{{ route('books.index') }}"
           class="flex items-center gap-2 px-5 py-2 rounded-full bg-gradient-to-r from-blue-500 via-blue-700 to-blue-500 text-white font-semibold shadow-lg
                  transition-all duration-200 hover:bg-blue-700 hover:scale-105 focus:outline-none ring-2 ring-blue-200">
            <svg class="w-5 h-5" fill="none" stroke="white" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Buku
        </a>
    </div>

    <!-- Card Info Buku -->
    <div class="p-8 bg-gradient-to-br from-blue-100 via-white to-white rounded-2xl shadow-2xl flex flex-col gap-6 mb-8 border border-blue-200">
        <h1 class="text-4xl text-center font-extrabold text-gray-900 mb-2 drop-shadow-lg">{{ $book->judul }}</h1>
        <div class="flex flex-wrap justify-center gap-8 text-gray-800">
            <div class="text-center">
                <span class="font-semibold">Penulis:</span>
                <span>{{ $book->penulis }}</span>
            </div>
            <div class="text-center">
                <span class="font-semibold">Penerbit:</span>
                <span>{{ $book->penerbit }}</span>
            </div>
            <div class="text-center">
                <span class="font-semibold">Tahun Terbit:</span>
                <span>{{ $book->tahun_terbit ?? '-' }}</span>
            </div>
            <div class="text-center">
                <span class="font-semibold">Kategori:</span>
                <span class="inline-block rounded-xl px-3 py-1 bg-blue-200 text-blue-900 text-xs font-bold uppercase tracking-wider ml-1 shadow">
                    {{ $book->kategori ?? '-' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Form Peminjaman -->
    <form action="{{ route('loans.store') }}" method="POST"
          class="bg-white rounded-2xl shadow-xl px-6 py-8 flex flex-col gap-8 border border-gray-100">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <div>
            <label for="loan_date" class="block mb-2 text-base font-semibold text-blue-900">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="loan_date"
                   class="w-full px-4 py-2 rounded-lg border border-blue-200 focus:ring-2 focus:ring-blue-400 transition">
        </div>

        <div>
            <label for="return_date" class="block mb-2 text-base font-semibold text-blue-900">Tanggal Kembali (Opsional)</label>
            <input type="date" name="tanggal_kembali" id="return_date"
                   class="w-full px-4 py-2 rounded-lg border border-blue-200 focus:ring-2 focus:ring-blue-400 transition">
        </div>

        <div>
            <label for="jumlah" class="block mb-2 text-base font-semibold text-blue-900">Jumlah Buku</label>
            <input type="number" name="jumlah" id="jumlah" value="1" min="1"
                   class="w-full px-4 py-2 rounded-lg border border-blue-200 focus:ring-2 focus:ring-blue-400 transition">
        </div>

        <button type="submit"
            class="w-full py-3 text-lg font-bold rounded-xl bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500 text-white shadow-lg
                   hover:from-blue-500 hover:to-blue-700 hover:scale-105 transition">
            Pinjam Buku Ini
        </button>
    </form>
</div>
@endsection
