@extends('layouts.app')

@section('content')

{{-- header --}}
    <div class="relative w-full h-[320px] shadow-lg rounded-b-3xl overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center scale-105"
            style="background-image: url('{{ asset('assets/bg.jpg') }}');">
        </div>

        <div class="relative z-10 container mx-auto px-6 h-full flex flex-col justify-start mt-12">
            <h1 class="text-5xl font-extrabold text-white drop-shadow-md tracking-wide leading-tight">
                BOOKVERSE
            </h1>
            <p class="mt-3 text-2xl text-white max-w-3xl drop-shadow-sm">
                Perpustakaan digital modern untuk eksplorasi buku berkualitas, dari fiksi hingga referensi akademik.
            </p>
        </div>
    </div>



<div class="container mx-auto px-6 mt-12">

    {{-- filter --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 mb-8">
        <h2 class="text-2xl font-bold text-indigo-700 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 12.414V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-8.586L3.293 6.707A1 1 0 013 6V4z" />
            </svg>
            Filter Buku
        </h2>

        <form action="{{ route('books.index') }}" method="GET"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <div>
                <label for="kategori" class="block text-gray-700 font-semibold mb-2">Kategori:</label>
                <select name="kategori" id="kategori" onchange="this.form.submit()"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value="">Semua</option>
                    <option value="fiksi" {{ request('kategori') == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
                    <option value="non_fiksi" {{ request('kategori') == 'non_fiksi' ? 'selected' : '' }}>Non Fiksi</option>
                    <option value="pelajaran" {{ request('kategori') == 'pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                </select>
            </div>
        </form>
    </div>


    {{-- tabel --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

        <div class="p-6 bg-gradient-to-r from-indigo-500 to-indigo-700 text-white flex justify-between items-center">
            <h2 class="text-2xl font-semibold">Daftar Buku</h2>
            <span class="text-sm opacity-80">Total: {{ $books->count() }} buku</span>
        </div>

        <table class="min-w-full">
            <thead>
                <tr class="uppercase text-sm bg-gray-100 text-gray-700 border-b">
                    <th class="px-6 py-3 text-left">Judul</th>
                    <th class="px-6 py-3 text-left">Penulis</th>
                    <th class="px-6 py-3 text-left">Penerbit</th>
                    <th class="px-6 py-3 text-left">Tahun Terbit</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-700 text-sm divide-y divide-gray-200">
                @forelse ($books as $book)
                    <tr class="hover:bg-indigo-50 transition-all duration-150">
                        <td class="px-6 py-4 font-semibold">{{ $book->judul }}</td>
                        <td class="px-6 py-4">{{ $book->penulis }}</td>
                        <td class="px-6 py-4">{{ $book->penerbit }}</td>
                        <td class="px-6 py-4">{{ $book->tahun_terbit ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('user.books.show', $book->id) }}"
                                class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white rounded-xl font-medium shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all duration-150">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            <span class="text-3xl"></span>
                            <p class="mt-2 text-lg">Tidak ada buku ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="mt-10 flex justify-center">
        {{ $books->withQueryString()->links() }}
    </div>

</div>

@endsection
