@extends('layouts.app')

@section('content')

{{-- header --}}
    <div class="relative w-full h-[320px] shadow-lg rounded-b-3xl overflow-hidden">
        <div class="absolute inset-0 scale-105 bg-center bg-cover"
            style="background-image: url('{{ asset('assets/bg.jpg') }}');">
        </div>

        <div class="container relative z-10 flex flex-col justify-start h-full px-6 mx-auto mt-12">
            <h1 class="text-5xl font-extrabold leading-tight tracking-wide text-white drop-shadow-md">
                BOOKVERSE
            </h1>
            <p class="max-w-3xl mt-3 text-2xl text-white drop-shadow-sm">
                Perpustakaan digital modern untuk eksplorasi buku berkualitas, dari fiksi hingga referensi akademik.
            </p>
        </div>
    </div>



<div class="container px-6 mx-auto mt-12">

    {{-- filter --}}
    <div class="p-8 mb-8 bg-white border border-gray-200 shadow-xl rounded-2xl">
        <h2 class="flex items-center mb-4 text-2xl font-bold text-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-7 w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 12.414V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-8.586L3.293 6.707A1 1 0 013 6V4z" />
            </svg>
            Filter Buku
        </h2>

        <form action="{{ route('books.index') }}" method="GET"
            class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            <div>
                <label for="kategori" class="block mb-2 font-semibold text-gray-700">Kategori:</label>
                <select name="kategori" id="kategori" onchange="this.form.submit()"
                    class="w-full px-4 py-3 border border-gray-300 shadow-sm rounded-xl focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value="">Semua</option>
                    <option value="fiksi" {{ request('kategori') == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
                    <option value="non_fiksi" {{ request('kategori') == 'non_fiksi' ? 'selected' : '' }}>Non Fiksi</option>
                    <option value="pelajaran" {{ request('kategori') == 'pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                </select>
            </div>
        </form>
    </div>


    {{-- tabel --}}
    <div class="overflow-hidden bg-white border border-gray-200 shadow-xl rounded-2xl">

        <div class="flex items-center justify-between p-6 text-white bg-gradient-to-r from-indigo-500 to-indigo-700">
            <h2 class="text-2xl font-semibold">Daftar Buku</h2>
            <span class="text-sm opacity-80">Total: {{ $books->count() }} buku</span>
        </div>

        <table class="min-w-full">
            <thead>
                <tr class="text-sm text-gray-700 uppercase bg-gray-100 border-b">
                    <th class="px-6 py-3 text-left">Judul</th>
                    <th class="px-6 py-3 text-left">Penulis</th>
                    <th class="px-6 py-3 text-left">Penerbit</th>
                    <th class="px-6 py-3 text-left">Tahun Terbit</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @forelse ($books as $book)
                    <tr class="transition-all duration-150 hover:bg-indigo-50">
                        <td class="px-6 py-4 font-semibold">{{ $book->judul }}</td>
                        <td class="px-6 py-4">{{ $book->penulis }}</td>
                        <td class="px-6 py-4">{{ $book->penerbit }}</td>
                        <td class="px-6 py-4">{{ $book->tahun_terbit ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('user.books.show', $book->id) }}"
                                class="inline-flex items-center px-5 py-2 font-medium text-white transition-all duration-150 bg-indigo-600 shadow-md rounded-xl hover:bg-indigo-700 hover:shadow-lg">
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


    <div class="flex justify-center mt-10">
        {{ $books->withQueryString()->links() }}
    </div>

</div>

@endsection
