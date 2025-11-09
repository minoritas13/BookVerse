<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoansController extends Controller
{
    /**
     * Simpan data peminjaman.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|uuid|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:loan_date',
            'jumlah' => 'nullable|integer|min:1',
        ]);

        // 1️⃣ Buat data peminjaman utama (loans)
        $loan = Loan::create([
            'id' => Str::uuid(),
            'user_id' => Auth::id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        // 2️⃣ Buat detail peminjaman (loan_details)
        LoanDetail::create([
            'id' => Str::uuid(),
            'loan_id' => $loan->id,
            'book_id' => $request->book_id,
            'jumlah' => $request->jumlah ?? 1,
        ]);

        return redirect()
            ->route('user.books.show', $request->book_id)
            ->with('success', 'Buku berhasil dipinjam!');
    }

    /**
     * Update status peminjaman tanpa denda.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:dipinjam,dikembalikan,terlambat'
        ]);

        $loan = Loan::findOrFail($id);
        $loan->status = $request->status;

        // Jika status dikembalikan, isi tanggal_kembali
        if ($request->status === 'dikembalikan' && !$loan->tanggal_kembali) {
            $loan->tanggal_kembali = now();
        }

        $loan->save();

        $pesan = 'Status pinjaman berhasil diperbarui!';
        // Pesan denda sudah dihapus

        return redirect()->route('admin.loans')->with('success', $pesan);
    }
}
