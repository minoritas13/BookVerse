<header class="sticky top-0 z-50 bg-white shadow-md">
    <nav class="container flex items-center justify-between px-4 py-3 mx-auto">
        {{-- Logo atau nama aplikasi --}}
        <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">
            BookVerse
        </a>

        {{-- Jika sudah login --}}
        @auth
            <ul class="hidden space-x-6 font-medium text-gray-700 md:flex">
                <li><a href="{{ route('user.dashboard') }}" class="transition hover:text-blue-600">Dashboard</a></li>
                <li><a href="{{ route('books.index') }}" class="transition hover:text-blue-600">Books</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="transition hover:text-red-600">Logout</button>
                    </form>
                </li>
            </ul>
        @else
            {{-- Jika belum login --}}
            <a href="{{ route('login.form') }}"
               class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Login
            </a>
        @endauth
    </nav>
</header>
