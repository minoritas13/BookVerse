@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <div class="mb-10">
        <h1 class="text-center text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-blue-500 to-teal-400 drop-shadow mb-4 tracking-tight animate__animated animate__fadeInDown">
            Daftar Buku
        </h1>
        <p class="text-center text-lg text-gray-500">Temukan koleksi buku terbaik untuk dibaca dan dipinjam!</p>
    </div>
    {{-- Filter kategori --}}
    <form action="{{ route('books.index') }}" method="GET" class="flex items-center justify-center mb-6 gap-3">
        <label for="kategori" class="text-base font-semibold text-gray-700">Filter Kategori:</label>
        <select name="kategori" id="kategori" onchange="this.form.submit()"
                class="block w-48 px-4 py-2 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-500 shadow-md bg-white transition duration-200">
            <option value="">Semua</option>
            <option value="fiksi" {{ request('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
            <option value="non_fiksi" {{ request('kategori') == 'Non Fiksi' ? 'selected' : '' }}>Non Fiksi</option>
        </select>
    </form>

    {{-- Tabel data buku --}}
    <div class="overflow-x-auto bg-white rounded-2xl shadow-2xl ring-1 ring-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-500 via-blue-700 to-blue-900 text-white">
                <tr>
                    <th class="px-6 py-4 text-center text-lg font-bold">Judul</th>
                    <th class="px-6 py-4 text-center text-lg font-bold">Penulis</th>
                    <th class="px-6 py-4 text-center text-lg font-bold">Penerbit</th>
                    <th class="px-6 py-4 text-center text-lg font-bold">Tahun Terbit</th>
                    <th class="px-6 py-4 text-center text-lg font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($books as $book)
                    <tr class="group hover:bg-blue-50 transition">
                        <td class="px-6 py-4 text-center font-semibold text-gray-700 group-hover:text-blue-700">{{ $book->judul }}</td>
                        <td class="px-6 py-4 text-center text-gray-500 group-hover:text-blue-600">{{ $book->penulis }}</td>
                        <td class="px-6 py-4 text-center text-gray-500">{{ $book->penerbit }}</td>
                        <td class="px-6 py-4 text-center">{{ $book->tahun_terbit ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('user.books.show', $book->id) }}"
                               class="inline-block px-5 py-2 rounded-full bg-gradient-to-r from-blue-600 to-blue-400 text-white font-bold shadow-md
                               transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-700 transition-all duration-200">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-lg">
                            Tidak ada buku ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-10">
        {{ $books->withQueryString()->links() }}
    </div>
</div>
@endsection
