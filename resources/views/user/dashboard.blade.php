@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    {{-- Header --}}
    <div class="py-6 text-white bg-blue-700 shadow-md">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-semibold">Dashboard Pengguna</h1>
            <p class="mt-1 text-sm">Selamat datang, {{ $user->name }} 👋</p>
        </div>
    </div>

    {{-- Konten Utama --}}
    <div class="container grid gap-8 px-6 py-10 mx-auto md:grid-cols-2">
        {{-- Profil User --}}
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold text-blue-700">Profil Pengguna</h2>
            <div class="space-y-3 text-gray-700">
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Telepon:</strong> {{ $user->telepon ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
                <p><strong>Role:</strong>
                    <span class="capitalize px-2 py-1 rounded text-white
                        {{ $user->role === 'admin' ? 'bg-red-500' : 'bg-blue-500' }}">
                        {{ $user->role }}
                    </span>
                </p>
            </div>
        </div>

        {{-- Riwayat Peminjaman --}}
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-xl font-semibold text-blue-700">Riwayat Peminjaman</h2>

            @if ($loans->isEmpty())
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
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') }}</td>
                                    <td class="px-4 py-2">
                                        {{ $loan->tanggal_kembali ? \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-white
                                            {{ $loan->status === 'dikembalikan' ? 'bg-green-500' : ($loan->status === 'terlambat' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($loan->details->isEmpty())
                                            <p class="italic text-gray-400">Tidak ada detail</p>
                                        @else
                                            <ul class="pl-5 list-disc">
                                                @foreach ($loan->details as $detail)
                                                    <li>
                                                        {{ $detail->book->judul ?? 'Buku tidak ditemukan' }}
                                                    </li>
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
    </div>
</div>
@endsection
