<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class PengeluaranController extends Controller
{
    public function create()
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'amount' => $request->amount,
            'category' => $request->category,
            'description' => $request->description,
            'type' => 'out', // Menandakan tipe Pengeluaran
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }
}
