@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Daftar Buku</h1>

    {{-- Filter kategori --}}
    <form action="{{ route('books.index') }}" method="GET" class="mb-4">
        <label for="kategori" class="mr-2 text-gray-700">Filter Kategori:</label>
        <select name="kategori" id="kategori" onchange="this.form.submit()"
                class="px-3 py-2 border border-gray-300 rounded">
            <option value="">Semua</option>
            <option value="fiksi" {{ request('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
            <option value="non_fiksi" {{ request('kategori') == 'Non Fiksi' ? 'selected' : '' }}>Non Fiksi</option>
        </select>
    </form>

    {{-- Tabel data buku --}}
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
        <thead>
            <tr class="text-sm leading-normal text-gray-700 uppercase bg-gray-100">
                <th class="px-6 py-3 text-left">Judul</th>
                <th class="px-6 py-3 text-left">Penulis</th>
                <th class="px-6 py-3 text-left">Penerbit</th>
                <th class="px-6 py-3 text-left">Tahun Terbit</th>
                <th class="px-6 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-600">
            @forelse ($books as $book)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $book->judul }}</td>
                    <td class="px-6 py-3">{{ $book->penulis }}</td>
                    <td class="px-6 py-3">{{ $book->penerbit }}</td>
                    <td class="px-6 py-3">{{ $book->tahun_terbit ?? '-' }}</td>
                    <td class="px-6 py-3 text-center">
                        <a href="{{ route('user.books.show', $book->id) }}"
                           class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">
                           Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada buku ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $books->withQueryString()->links() }}
    </div>
</div>
@endsection
