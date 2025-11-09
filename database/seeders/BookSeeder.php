<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel books.
     */
    public function run(): void
    {
        $books = [
            [
                'id' => Str::uuid(),
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'kategori' => 'fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Bumi Manusia',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun_terbit' => 1980,
                'kategori' => 'non_fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2018,
                'kategori' => 'fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Penguin Random House',
                'tahun_terbit' => 2018,
                'kategori' => 'fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'kategori' => 'non_fiksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Book::insert($books);
    }
}
