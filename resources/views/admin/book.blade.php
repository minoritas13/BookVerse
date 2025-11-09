@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Daftar Buku</h2>
        <a href="{{ route('admin.book.create') }}"
           class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
           + Tambah Buku
        </a>
    </div>

    {{-- Filter kategori --}}
    <form method="GET" action="{{ route('admin.books') }}" class="mb-4">
        <select name="kategori" class="p-2 border rounded" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            <option value="fiksi" {{ request('kategori') == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
            <option value="non_fiksi" {{ request('kategori') == 'non_fiksi' ? 'selected' : '' }}>Non Fiksi</option>
             <option value="pelajaran" {{ request('pelajaran') == 'pelajaran' ? 'selected' : '' }}>Pelajaran</option>
        </select>
    </form>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel data buku --}}
    <table class="min-w-full border border-gray-200 rounded-lg shadow">
        <thead>
            <tr class="text-sm leading-normal text-gray-700 uppercase bg-gray-100">
                <th class="px-6 py-3 text-left">Judul</th>
                <th class="px-6 py-3 text-left">Penulis</th>
                <th class="px-6 py-3 text-left">Penerbit</th>
                <th class="px-6 py-3 text-left">Tahun</th>
                <th class="px-6 py-3 text-left">Kategori</th>
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
                    <td class="px-6 py-3 capitalize">{{ $book->kategori ?? '-' }}</td>
                    <td class="px-6 py-3 space-x-2 text-center">
                        <a href="{{ route('admin.book.edit', $book->id) }}"
                           class="px-3 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('admin.book.destroy', $book->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-700"
                                    onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-4 text-center text-gray-500">Tidak ada data buku</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
