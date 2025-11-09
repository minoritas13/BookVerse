@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="flex flex-col items-start justify-between mb-8 sm:flex-row sm:items-center">
        <div>
            <h2 class="flex items-center gap-2 text-3xl font-extrabold text-gray-800">
                📚 <span>Manajemen Buku</span>
            </h2>
            <p class="mt-1 text-gray-500">Kelola koleksi buku perpustakaan Anda dengan mudah.</p>
        </div>
        <a href="{{ route('admin.book.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 mt-4 font-semibold text-white transition-all duration-200 rounded-lg shadow sm:mt-0 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700">
            ➕ Tambah Buku
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

    <form method="GET" class="flex items-center gap-4 my-10">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari judul atau penulis..."
            class="w-64 p-2 border rounded">
        <button type="submit"
            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Cari
        </button>
    </form>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="px-4 py-2 text-sm font-medium text-green-700 bg-green-100 border border-green-200 rounded-lg shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Daftar Buku -->
    @if ($books->count() > 0)
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($books as $book)
                <div class="overflow-hidden transition duration-200 bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md">
                    <div class="p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 truncate">{{ $book->judul }}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $book->penulis }}</p>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 rounded-full
                                {{ $book->kategori === 'fiksi' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($book->kategori ?? 'Umum') }}
                            </span>
                        </div>

                        <div class="mt-4 space-y-1 text-sm text-gray-500">
                            <p><span class="font-semibold text-gray-700">📖 Penerbit:</span> {{ $book->penerbit }}</p>
                            <p><span class="font-semibold text-gray-700">📅 Tahun:</span> {{ $book->tahun_terbit ?? '-' }}</p>
                        </div>

                        <div class="flex items-center justify-between pt-3 mt-5 border-t">
                            <a href="{{ route('admin.book.edit', $book->id) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-400 text-gray-900 rounded-md hover:bg-yellow-500 transition font-semibold text-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.book.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white rounded-md hover:bg-red-700 transition font-semibold text-sm">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="py-10 text-center text-gray-500 bg-white border rounded-xl">
            <p class="text-lg">📭 Belum ada data buku yang tersedia.</p>
        </div>
    @endif

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
