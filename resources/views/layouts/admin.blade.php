<div class="flex min-h-screen">
    <aside class="w-64 p-4 bg-blue-700 text-white">
        <h2 class="text-2xl font-bold mb-6">📚 BookVerse Admin</h2>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block hover:bg-blue-600 p-2 rounded">Dashboard</a>
            <a href="{{ route('admin.books') }}" class="block hover:bg-blue-600 p-2 rounded">Manajemen Buku</a>
            <a href="{{ route('admin.users.index') }}" class="block hover:bg-blue-600 p-2 rounded">Manajemen User</a>
        </nav>
    </aside>

    <main class="flex-1 p-8 bg-gray-50">
        @yield('content')
    </main>
</div>
