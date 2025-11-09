@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="relative w-full h-[320px] shadow-lg rounded-b-3xl overflow-hidden">
    <div class="absolute inset-0 scale-105 bg-center bg-cover"
        style="background-image: url('{{ asset('assets/bg.jpg') }}');">
    </div>
</div>

<div class="container px-4 py-8 mx-auto">
    {{-- Form Pencarian --}}
    <form method="GET" class="flex items-center gap-4 mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari judul atau penulis..."
            class="w-64 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Cari
        </button>
    </form>

    {{-- Tabel Data Buku --}}
    <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="text-sm leading-normal text-gray-700 uppercase bg-gray-100">
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
                            <p class="text-lg">Tidak ada buku ditemukan.</p>
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
