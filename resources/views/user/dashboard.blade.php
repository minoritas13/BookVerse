@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">

    {{-- Header --}}
    <div class="py-8 text-white bg-gradient-to-r from-blue-700 to-indigo-700 shadow-md">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">📚 Dashboard Pengguna</h1>
            <p class="mt-1 text-sm">Selamat datang kembali, 
                <span class="font-semibold">{{ $user->name ?? 'Pengguna' }}</span> 👋
            </p>
        </div>
    </div>

    <div class="container px-6 py-10 mx-auto space-y-10">

        {{-- Statistik Cepat --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div class="p-5 text-center bg-white rounded-xl shadow hover:shadow-md transition">
                <h3 class="text-gray-500">Total Buku Dipinjam</h3>
                <p class="mt-2 text-3xl font-bold text-blue-600">{{ $totalLoans ?? 0 }}</p>
            </div>
            <div class="p-5 text-center bg-white rounded-xl shadow hover:shadow-md transition">
                <h3 class="text-gray-500">Buku Sedang Dipinjam</h3>
                <p class="mt-2 text-3xl font-bold text-yellow-500">{{ $currentLoans ?? 0 }}</p>
            </div>
            <div class="p-5 text-center bg-white rounded-xl shadow hover:shadow-md transition">
                <h3 class="text-gray-500">Buku Dikembalikan</h3>
                <p class="mt-2 text-3xl font-bold text-green-600">{{ $returnedLoans ?? 0 }}</p>
            </div>
        </div>

        {{-- Profil User --}}
        <div class="grid gap-6 md:grid-cols-2">
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-xl font-semibold text-blue-700">👤 Profil Pengguna</h2>
                <div class="space-y-3 text-gray-700">
                    <p><strong>Nama:</strong> {{ $user->name ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                    <p><strong>Telepon:</strong> {{ $user->telepon ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
                    <p><strong>Role:</strong>
                        <span class="capitalize px-2 py-1 rounded text-white
                            {{ ($user->role ?? 'user') === 'admin' ? 'bg-red-500' : 'bg-blue-500' }}">
                            {{ $user->role ?? 'user' }}
                        </span>
                    </p>
                </div>
            </div>

            {{-- Buku yang Sedang Dipinjam --}}
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-xl font-semibold text-blue-700">📖 Buku yang Sedang Dipinjam</h2>
                @if (!isset($activeLoans) || $activeLoans->isEmpty())
                    <p class="text-gray-500">Belum ada buku yang sedang dipinjam.</p>
                @else
                    <div class="grid gap-4 md:grid-cols-2">
                        @foreach ($activeLoans as $loan)
                            @if(isset($loan->details) && $loan->details->isNotEmpty())
                                @foreach ($loan->details as $detail)
                                    <div class="p-4 bg-gray-50 border rounded-lg hover:shadow transition">
                                        <h3 class="font-semibold text-gray-800">
                                            {{ $detail->book->judul ?? 'Buku tidak ditemukan' }}
                                        </h3>
                                        <p class="text-sm text-gray-500">Penulis: {{ $detail->book->penulis ?? '-' }}</p>
                                        <p class="mt-1 text-xs text-gray-400">
                                            Dipinjam: {{ $loan->tanggal_pinjam ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') : '-' }}
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Riwayat Peminjaman --}}
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-4 text-xl font-semibold text-blue-700">🕓 Riwayat Peminjaman</h2>

            @if (!isset($loans) || $loans->isEmpty())
                <p class="text-gray-500">Belum ada riwayat peminjaman.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-200">
                        <thead class="text-gray-700 bg-blue-100">
                            <tr>
                                <th class="px-4 py-2 border">Tanggal Pinjam</th>
                                <th class="px-4 py-2 border">Tanggal Kembali</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border">Detail Buku</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $loan->tanggal_pinjam ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') : '-' }}</td>
                                    <td class="px-4 py-2">
                                        {{ $loan->tanggal_kembali ? \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-white
                                            {{ $loan->status === 'dikembalikan' ? 'bg-green-500' : ($loan->status === 'terlambat' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                            {{ ucfirst($loan->status ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        @if (!isset($loan->details) || $loan->details->isEmpty())
                                            <p class="italic text-gray-400">Tidak ada detail</p>
                                        @else
                                            <ul class="pl-5 list-disc">
                                                @foreach ($loan->details as $detail)
                                                    <li>{{ $detail->book->judul ?? 'Buku tidak ditemukan' }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Rekomendasi Buku --}}
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-4 text-xl font-semibold text-blue-700">✨ Rekomendasi Buku untuk Kamu</h2>

            @if (!isset($recommendedBooks) || $recommendedBooks->isEmpty())
                <p class="text-gray-500">Belum ada rekomendasi buku saat ini.</p>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($recommendedBooks as $book)
                        <div class="p-4 bg-gray-50 border rounded-lg hover:shadow-lg transition">
                            <h3 class="font-semibold text-gray-800">{{ $book->judul ?? '-' }}</h3>
                            <p class="text-sm text-gray-500">{{ $book->penulis ?? '-' }}</p>
                            <p class="text-xs mt-1 text-gray-400 capitalize">{{ $book->kategori ?? '-' }}</p>
                            @if(isset($book->id))
                            <a href="{{ route('books.show', $book->id) }}"
                               class="inline-block mt-2 text-sm text-blue-600 hover:underline">
                                Lihat Detail →
                            </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
