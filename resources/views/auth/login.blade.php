@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[70vh] bg-gray-50 py-12">

    <div class="w-full max-w-md p-8 bg-white shadow-md rounded-xl">
        {{-- Flash message --}}
        @if (session('error'))
            <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form Title --}}
        <h2 class="mb-3 text-3xl font-bold text-center text-blue-700">
            Masuk ke Akun Anda
        </h2>

        {{-- Login Form --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan email anda">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan kata sandi">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="border-gray-300 rounded">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">Lupa kata sandi?</a>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-2 font-medium text-white transition-colors duration-200 bg-blue-600 rounded hover:bg-blue-700">
                Login
            </button>

            {{-- Redirect ke register --}}
            <p class="mt-4 text-sm text-center text-gray-600">
                Belum punya akun?
                <a href="{{ route('register.form') }}" class="font-medium text-blue-600 hover:underline">Daftar di sini</a>
            </p>
        </form>
    </div>
</div>
@endsection
