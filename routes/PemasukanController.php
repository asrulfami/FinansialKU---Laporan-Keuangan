<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    public function create()
    {
        // Menampilkan view form tambah pemasukan
        // Pastikan file resources/views/pemasukan/create.blade.php nanti dibuat
        return view('pemasukan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
            'category' => $request->category,
            'type' => 'in', // Menandakan tipe Pemasukan
        ]);

        return redirect()->route('dashboard')->with('success', 'Pemasukan berhasil ditambahkan.');
    }
}