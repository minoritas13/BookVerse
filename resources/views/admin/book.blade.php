@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center gap-2">
                📚 <span>Manajemen Buku</span>
            </h2>
            <p class="text-gray-500 mt-1">Kelola koleksi buku perpustakaan Anda dengan mudah.</p>
        </div>
        <a href="{{ route('admin.book.create') }}"
           class="mt-4 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg shadow hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-semibold">
            ➕ Tambah Buku
        </a>
    </div>

    <!-- Filter -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <form method="GET" action="{{ route('admin.books') }}" class="flex items-center gap-2">
            <label for="kategori" class="font-medium text-gray-600">Filter Kategori:</label>
            <select name="kategori" id="kategori"
                    class="p-2 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 transition"
                    onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="fiksi" {{ request('kategori') == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
                <option value="non_fiksi" {{ request('kategori') == 'non_fiksi' ? 'selected' : '' }}>Non Fiksi</option>
            </select>
        </form>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="px-4 py-2 bg-green-100 text-green-700 rounded-lg shadow-sm border border-green-200 text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Daftar Buku -->
    @if ($books->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($books as $book)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-200 overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 truncate">{{ $book->judul }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $book->penulis }}</p>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 rounded-full 
                                {{ $book->kategori === 'fiksi' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($book->kategori ?? 'Umum') }}
                            </span>
                        </div>

                        <div class="mt-4 text-sm text-gray-500 space-y-1">
                            <p><span class="font-semibold text-gray-700">📖 Penerbit:</span> {{ $book->penerbit }}</p>
                            <p><span class="font-semibold text-gray-700">📅 Tahun:</span> {{ $book->tahun_terbit ?? '-' }}</p>
                        </div>

                        <div class="mt-5 flex items-center justify-between border-t pt-3">
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
        <div class="text-center py-10 text-gray-500 bg-white rounded-xl border">
            <p class="text-lg">📭 Belum ada data buku yang tersedia.</p>
        </div>
    @endif

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $books->links() }}
    </div>
</div>
@endsection
