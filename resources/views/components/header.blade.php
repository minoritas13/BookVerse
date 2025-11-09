<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto flex items-center justify-between px-4 py-3">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">
            {{ config('app.name', 'MyApp') }}
        </a>

        <ul class="hidden md:flex space-x-6 font-medium text-gray-700">
            <li><a href="/" class="hover:text-blue-600 transition">Home</a></li>
            <li><a href="/about" class="hover:text-blue-600 transition">About</a></li>
            <li><a href="/contact" class="hover:text-blue-600 transition">Contact</a></li>
        </ul>

        {{-- Tombol hamburger (mobile) --}}
        <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </nav>
</header>
