@extends('layouts.app')

@section('content')
    <style>
        @keyframes moveMoney {
            0% { transform: translateX(-150px); }
            30% { transform: translateX(100vw); } /* Bergerak lewat layar dalam ~4.5 detik */
            100% { transform: translateX(100vw); } /* Diam di luar layar sisa waktu (Jeda ~10 detik) */
        }
        .money-animation {
            position: fixed;
            top: 150px;
            left: 0;
            animation: moveMoney 15s linear infinite;
            z-index: 0;
            pointer-events: none;
        }
    </style>

    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">

            <!-- Card Form Pengeluaran -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Tambah Pengeluaran Baru</h2>

                    {{-- Pastikan route 'pengeluaran.store' sudah didefinisikan di web.php --}}
                    <form action="{{ route('pengeluaran.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Input Tanggal -->
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Transaksi</label>
                                <input type="date" name="tanggal" id="tanggal" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <!-- Input Jumlah -->
                            <div>
                                <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pengeluaran (Rp)</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="jumlah" id="jumlah" class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="0" min="0" max="999999999999999" required>
                                </div>
                            </div>

                            <!-- Input Kategori -->
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select name="kategori" id="kategori" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Transportasi">Transportasi</option>
                                    <option value="Tagihan">Tagihan</option>
                                    <option value="Belanja">Belanja</option>
                                    <option value="Hiburan">Hiburan</option>
                                    <option value="Kesehatan">Kesehatan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <!-- Input Keterangan -->
                            <div class="md:col-span-2">
                                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500" placeholder="Contoh: Bayar listrik bulan ini..."></textarea>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition shadow-md flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Simpan Pengeluaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SVG Uang Bergerak -->
    <div class="money-animation text-green-500 opacity-60">
        <svg class="w-24 h-24 drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05 1.18 1.91 2.53 1.91 1.29 0 2.13-.72 2.13-1.71 0-1.12-.88-1.58-2.33-2.08l-.9-.33c-2.02-.7-3.27-1.7-3.27-3.56 0-1.87 1.45-3.09 3.14-3.47V3h2.67v1.93c1.5.25 2.9 1.25 2.99 3.12h-1.92c-.13-.91-1.13-1.56-2.37-1.56-1.16 0-1.92.64-1.92 1.58 0 1.1.81 1.51 2.11 1.96l.9.32c2.2.78 3.52 1.82 3.52 3.71 0 2.05-1.55 3.32-3.29 3.63z"/>
        </svg>
    </div>
@endsection