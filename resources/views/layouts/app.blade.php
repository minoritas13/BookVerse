<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Laravel App') }}</title>

    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen text-gray-800 bg-gray-50">

    {{-- Header --}}
    @auth
        @if (Auth::user()->role === 'admin')
            @include('components.admin_header')
        @else
            @include('components.user_header')
        @endif
    @else
        <header class="bg-white shadow">
            <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                <h1 class="text-2xl font-bold text-blue-600">
                    <a href="{{ url('/') }}">BookVerse</a>
                </h1>

                <nav class="space-x-4">
                    <a href="{{ route('books.index') }}" class="text-gray-700 hover:text-blue-600">Daftar Buku</a>
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Daftar
                    </a>
                </nav>
            </div>
        </header>
    @endauth


    {{-- Main Content --}}
    <main class="container flex-1 px-4 py-8 mx-auto">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

</body>

</html>
