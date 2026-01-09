<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function create()
    {
        // Menampilkan view form tambah pengeluaran
        // Pastikan file resources/views/pengeluaran/create.blade.php nanti dibuat
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        Pengeluaran::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }
}
