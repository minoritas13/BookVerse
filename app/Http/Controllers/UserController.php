<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

    public function create()
    {
        return view('admin.create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus!');
    }
}
