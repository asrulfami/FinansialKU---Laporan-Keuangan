<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class PemasukanController extends Controller
{
    // Menampilkan halaman form
    public function create()
    {
        return view('pemasukan.create');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date', 
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Simpan ke tabel transactions dengan tipe 'in' (Pemasukan)
        Transaction::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'amount' => $request->amount,
            'category' => $request->category,
            'description' => $request->description,
            'type' => 'in',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pemasukan berhasil ditambahkan!');
    }
}