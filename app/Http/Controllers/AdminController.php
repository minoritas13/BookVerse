<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user')->latest()->paginate(10);
        $users = User::latest()->paginate(10);

        return view('admin.dashboard',compact('loans','users'));

    }

    public function books(Request $request)
    {
        $query = Book::query();

        // Filter berdasarkan kategori jika dipilih
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('penulis', 'like', '%' . $request->search . '%');
        }

        $books = $query->paginate(10);

        return view('admin.book', compact('books'));

        $books = Book::latest()->paginate(10); // pagination biar rapi
    }
}
