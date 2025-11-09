@extends('layouts.app')

@section('content')
<div class="max-w-md p-8 mx-auto mt-10 bg-white rounded-lg shadow-lg">
    {{-- Flash success message --}}
    @if (session('success'))
        <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Title --}}
    <h2 class="mb-6 text-2xl font-bold text-center text-blue-700">
        Daftar Akun Baru
    </h2>

    {{-- Form --}}
    <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                   placeholder="Masukkan nama lengkap">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                   placeholder="Masukkan email">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi</label>
            <input type="password" id="password" name="password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                   placeholder="Minimal 8 karakter, kombinasi huruf besar, kecil, angka & simbol">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Confirmation --}}
        <div>
            <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                   placeholder="Ulangi kata sandi">
        </div>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit"
                    class="w-full py-2 font-semibold text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                Daftar Sekarang
            </button>
        </div>

        {{-- Redirect ke login --}}
        <p class="mt-4 text-sm text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login.form') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
        </p>
    </form>
</div>
@endsection
