<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan semua data buku.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Filter berdasarkan kategori jika dipilih
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $books = $query->paginate(10);

        return view('books.index', compact('books'));

        $books = Book::latest()->paginate(10); // pagination biar rapi
    }

    /**
     * Menampilkan detail buku berdasarkan ID (UUID).
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function create()
    {
        return view('admin.create_book');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'kategori' => 'nullable|string|max:100',
        ]);

        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.books')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'kategori' => 'nullable|string|max:100',
        ]);

        $book->update($request->all());

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.edit_book', compact('book'));
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }
}
