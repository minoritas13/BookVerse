@extends('layouts.app')

@section('content')
    <div class="container p-6 mx-auto">

        @if (session('success'))
            <div id="notif-success" class="max-w-md mx-auto mb-6">
                <div
                    class="flex items-center px-4 py-3 text-white bg-green-500 rounded-lg shadow-lg animate__animated animate__fadeInDown">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4" />
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    const notif = document.getElementById('notif-success');
                    if (notif) notif.style.display = 'none';
                }, 3000);
            </script>
        @endif


        <a href="{{ route('books.index') }}"
            class="inline-flex items-center mb-6 text-blue-600 transition hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke daftar buku
        </a>

        {{-- Card Detail Buku --}}
        <div
            class="p-8 transition-transform bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-xl hover:shadow-2xl hover:scale-[1.01]">
            <h1 class="mb-6 text-3xl font-bold text-indigo-700">{{ $book->judul }}</h1>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <p class="text-lg"><strong class="text-blue-500">Penulis:</strong> {{ $book->penulis }}</p>
                <p class="text-lg"><strong class="text-blue-500">Penerbit:</strong> {{ $book->penerbit }}</p>
                <p class="text-lg"><strong class="text-blue-500">Tahun Terbit:</strong> {{ $book->tahun_terbit ?? '-' }}</p>
                <p class="text-lg"><strong class="text-blue-500">Kategori:</strong> {{ $book->kategori ?? '-' }}</p>
            </div>
        </div>

        {{-- Form Peminjaman --}}
        <div class="p-8 mt-8 bg-white shadow-lg rounded-xl">
            <h2 class="mb-4 text-3xl font-bold text-indigo-700">Form Peminjaman Buku</h2>
            <p class="mb-6 text-gray-600">Isi data di bawah untuk melakukan peminjaman buku.</p>

            <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <div>
                    <label for="loan_date" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="loan_date"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:outline-none"
                        required>
                </div>

                <div>
                    <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal Kembali
                        (Opsional)</label>
                    <input type="date" name="tanggal_kembali" id="return_date"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:outline-none">
                </div>

                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Buku</label>
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1"
                        class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:outline-none">
                </div>
                <button type="submit"
                    class="w-full py-3 text-lg font-semibold text-white transition bg-blue-600 rounded-md shadow-md hover:bg-blue-700 hover:shadow-xl">
                    Pinjam Buku
                </button>
            </form>
        </div>
    </div>

    <!-- Script otomatis tanggal kembali -->
    <script>
        document.getElementById('loan_date').addEventListener('change', function() {
            const loanDate = new Date(this.value);
            if (isNaN(loanDate)) return;

            loanDate.setDate(loanDate.getDate() + 7);
            const year = loanDate.getFullYear();
            const month = ('0' + (loanDate.getMonth() + 1)).slice(-2);
            const day = ('0' + loanDate.getDate()).slice(-2);
            document.getElementById('return_date').value = `${year}-${month}-${day}`;
        });
    </script>
@endsection
