@extends('layouts.app')

@section('content')
<div class="min-h-screen p-8 bg-gray-50">
    <h1 class="mb-8 text-3xl font-bold text-gray-800">📊 Dashboard Admin</h1>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- PANEL 1: DAFTAR PEMINJAMAN --}}
    <div class="p-6 mb-10 bg-white shadow-md rounded-xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">📚 Daftar Peminjaman</h2>
            <span class="px-3 py-1 text-sm text-blue-700 bg-blue-100 rounded-full">
                Total: {{ $loans->total() }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg">
                <thead>
                    <tr class="text-sm font-medium text-gray-700 uppercase bg-gray-100">
                        <th class="px-4 py-3 text-left">Peminjam</th>
                        <th class="px-4 py-3 text-left">Tgl Pinjam</th>
                        <th class="px-4 py-3 text-left">Tgl Kembali</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($loans as $loan)
                        <tr class="text-sm border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $loan->user->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $loan->tanggal_pinjam }}</td>
                            <td class="px-4 py-3">{{ $loan->tanggal_kembali ?? '-' }}</td>
                            {{-- Status badge --}}
                            <td class="px-4 py-3">
                                @php
                                    $badgeText = $loan->status;
                                    if ($loan->status === 'dipinjam') {
                                        $badgeClasses = 'text-blue-700 bg-blue-100';
                                    } elseif ($loan->status === 'dikembalikan') {
                                        $badgeClasses = 'text-green-700 bg-green-100';
                                    } elseif ($loan->status === 'terlambat') {
                                        $badgeClasses = 'text-red-700 bg-red-100';
                                    } else {
                                        $badgeClasses = 'text-gray-700 bg-gray-100';
                                    }
                                @endphp
                                <span class="{{ $badgeClasses }} px-2 py-1 text-xs font-medium rounded-full">
                                    {{ $badgeText }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('admin.loans.updateStatus', $loan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="p-1 text-sm border rounded">
                                        <option value="dipinjam" {{ $loan->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                        <option value="dikembalikan" {{ $loan->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                        <option value="terlambat" {{ $loan->status == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                                    </select>
                                    <button type="submit" class="px-3 py-1 ml-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">Belum ada data pinjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    </div>

    {{-- PANEL 2: MANAJEMEN USER --}}
    <div class="p-6 bg-white shadow-md rounded-xl">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">👥 Manajemen User</h2>
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                + Tambah User
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr class="text-sm font-medium text-gray-700 uppercase">
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-left">Telepon</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="text-sm border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            {{-- Role badge --}}
                            <td class="px-4 py-3">
                                @php
                                    $roleBadge = $user->role === 'admin'
                                        ? 'text-purple-700 bg-purple-100'
                                        : 'text-gray-700 bg-gray-100';
                                @endphp
                                <span class="{{ $roleBadge }} px-2 py-1 text-xs font-medium rounded-full">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $user->telepon ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">Belum ada user terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
