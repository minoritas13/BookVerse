@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">

        <a href="{{ route('books.index') }}" 
            class="inline-flex items-center mb-6 text-blue-600 transition hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" 
                class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" 
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke daftar buku
        </a>

        {{-- Card Detail Buku --}}
        <div class="p-8 transition-transform bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-xl hover:shadow-2xl hover:scale-[1.01]">
            <h1 class="mb-6 text-3xl font-bold text-indigo-700">{{ $book->judul }}</h1>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <p class="text-lg"><strong class="text-blue-500">Penulis:</strong> {{ $book->penulis }}</p>
                <p class="text-lg"><strong class="text-blue-500">Penerbit:</strong> {{ $book->penerbit }}</p>
                <p class="text-lg"><strong class="text-blue-500">Tahun Terbit:</strong> {{ $book->tahun_terbit ?? '-' }}</p>
                <p class="text-lg"><strong class="text-blue-500">Kategori:</strong> {{ $book->kategori ?? '-' }}</p>
            </div>
        </div>

        {{-- Form Peminjaman --}}
        <div class="p-8 mt-8 bg-white rounded-xl shadow-lg">
            <h2 class="mb-4 text-3xl font-bold text-indigo-700">Form Peminjaman Buku</h2>
            <p class="mb-6 text-gray-600">Isi data di bawah untuk melakukan peminjaman buku.</p>

            <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <div>
                    <label for="loan_date" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="loan_date"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:outline-none" 
                        required>
                </div>

                <div>
                    <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal Kembali (Opsional)</label>
                    <input type="date" name="tanggal_kembali" id="return_date"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:outline-none">
                </div>

                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Buku</label>
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:outline-none">
                </div>
                <button type="submit" 
                    class="w-full py-3 text-lg font-semibold text-white transition bg-blue-600 rounded-md shadow-md hover:bg-blue-700 hover:shadow-xl">
                    Pinjam Buku
                </button>
            </form>
        </div>
    </div>
@endsection
