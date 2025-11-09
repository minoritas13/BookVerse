@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col items-start justify-between mb-8 sm:flex-row sm:items-center">
        <div>
            <h1 class="flex items-center gap-2 text-4xl font-extrabold text-gray-800">
                📊 Dashboard Admin
            </h1>
            <p class="mt-1 text-gray-500">Pantau aktivitas dan kelola data sistem Anda dengan mudah.</p>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Panel: Daftar Peminjaman --}}
    <div class="p-6 mb-10 bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="flex items-center gap-2 text-xl font-semibold text-gray-800">📘 Daftar Peminjaman</h2>
            <span class="px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                Total: {{ $loans->total() }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full overflow-hidden text-sm border border-gray-200 rounded-lg">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-5 py-3 text-left">Peminjam</th>
                        <th class="px-5 py-3 text-left">Tgl Pinjam</th>
                        <th class="px-5 py-3 text-left">Tgl Kembali</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($loans as $loan)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-5 py-3">{{ $loan->user->name ?? '-' }}</td>
                            <td class="px-5 py-3">{{ $loan->tanggal_pinjam }}</td>
                            <td class="px-5 py-3">{{ $loan->tanggal_kembali ?? '-' }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $statusColors = [
                                        'dipinjam' => 'bg-blue-100 text-blue-700',
                                        'dikembalikan' => 'bg-green-100 text-green-700',
                                        'terlambat' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColors[$loan->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-center">
                                <form action="{{ route('admin.loans.updateStatus', $loan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="p-1 text-sm border rounded-md focus:ring focus:ring-blue-200">
                                        <option value="dipinjam" {{ $loan->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                        <option value="dikembalikan" {{ $loan->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                        <option value="terlambat" {{ $loan->status == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                                    </select>
                                    <button type="submit" class="px-3 py-1 ml-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                                        Simpan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 text-center text-gray-500">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    </div>

    {{-- Panel: Manajemen User --}}
    <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="flex items-center gap-2 text-xl font-semibold text-gray-800">👥 Manajemen User</h2>
            <a href="{{ route('admin.users.create') }}"
               class="px-4 py-2 text-sm font-semibold text-white transition rounded-md shadow bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700">
                + Tambah User
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full overflow-hidden text-sm border border-gray-200 rounded-lg">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-5 py-3 text-left">Nama</th>
                        <th class="px-5 py-3 text-left">Email</th>
                        <th class="px-5 py-3 text-left">Role</th>
                        <th class="px-5 py-3 text-left">Telepon</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-5 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $user->email }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $roleColor = $user->role === 'admin'
                                        ? 'bg-purple-100 text-purple-700'
                                        : 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $roleColor }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-5 py-3">{{ $user->telepon ?? '-' }}</td>
                            <td class="px-5 py-3 space-x-2 text-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="px-3 py-1 text-sm text-white transition bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-sm text-white transition bg-red-600 rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 text-center text-gray-500">Belum ada user terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
