@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="mb-4 text-xl font-semibold">Edit Data User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" name="name" class="w-full p-2 border rounded" value="{{ old('name', $user->name) }}">
            @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded" value="{{ old('email', $user->email) }}">
            @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Password (Kosongkan jika tidak ingin diubah)</label>
            <input type="password" name="password" class="w-full p-2 border rounded">
            @error('password') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Role</label>
            <select name="role" class="w-full p-2 border rounded">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Telepon</label>
            <input type="text" name="telepon" class="w-full p-2 border rounded" value="{{ old('telepon', $user->telepon) }}">
        </div>

        <div>
            <label class="block text-sm font-medium">Alamat</label>
            <textarea name="alamat" class="w-full p-2 border rounded">{{ old('alamat', $user->alamat) }}</textarea>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
