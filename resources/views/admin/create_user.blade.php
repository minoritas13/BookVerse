@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="mb-4 text-xl font-semibold">Tambah User Baru</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name') }}">
            @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded" value="{{ old('email') }}">
            @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="w-full p-2 border rounded">
            @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Role</label>
            <select name="role" class="w-full p-2 border rounded">
                <option value="">Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Telepon</label>
            <input type="text" name="telepon" class="w-full p-2 border rounded" value="{{ old('telepon') }}">
        </div>

        <div>
            <label class="block text-sm font-medium">Alamat</label>
            <textarea name="alamat" class="w-full p-2 border rounded">{{ old('alamat') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
