@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="mb-8 text-4xl font-extrabold text-gray-900 tracking-tight">Daftar Buku</h1>

    {{-- Filter kategori --}}
    <form action="{{ route('books.index') }}" method="GET" class="flex items-center mb-6 gap-3">
        <label for="kategori" class="text-base font-medium text-gray-700">Filter Kategori:</label>
        <select name="kategori" id="kategori" onchange="this.form.submit()"
                class="block w-48 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition duration-200 bg-white shadow-sm">
            <option value="">Semua</option>
            <option value="fiksi" {{ request('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
            <option value="non_fiksi" {{ request('kategori') == 'Non Fiksi' ? 'selected' : '' }}>Non Fiksi</option>
        </select>
    </form>

    {{-- Tabel data buku --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-blue-500 via-blue-700 to-blue-900 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-lg font-semibold">Judul</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold">Penulis</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold">Penerbit</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold">Tahun Terbit</th>
                    <th class="px-6 py-4 text-center text-lg font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($books as $book)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4">{{ $book->judul }}</td>
                        <td class="px-6 py-4">{{ $book->penulis }}</td>
                        <td class="px-6 py-4">{{ $book->penerbit }}</td>
                        <td class="px-6 py-4">{{ $book->tahun_terbit ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('user.books.show', $book->id) }}"
                               class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-800 hover:scale-105 transition duration-150">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Tidak ada buku ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center mt-8">
        {{ $books->withQueryString()->links() }}
    </div>
</div>
@endsection
