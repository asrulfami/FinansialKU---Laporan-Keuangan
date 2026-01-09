<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user yang ada
        $users = User::all();

        // Jika tidak ada user, buat satu user default untuk testing
        if ($users->isEmpty()) {
            $users = collect([User::factory()->create([
                'name' => 'User Demo',
                'email' => 'user@demo.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ])]);
        }

        foreach ($users as $user) {
            // Buat 50 transaksi acak dalam 30 hari terakhir untuk setiap user
            for ($i = 0; $i < 50; $i++) {
                // Tentukan tipe: 70% kemungkinan Pengeluaran, 30% Pemasukan
                $type = rand(0, 10) > 3 ? 'out' : 'in';
                
                // Tanggal acak dalam 30 hari terakhir
                $date = Carbon::now()->subDays(rand(0, 30))->setTime(rand(8, 20), rand(0, 59));
                
                $categoriesIn = ['Gaji', 'Bonus', 'Freelance', 'Investasi', 'Hadiah'];
                $categoriesOut = ['Makanan', 'Transportasi', 'Sewa', 'Belanja', 'Hiburan', 'Kesehatan', 'Pendidikan'];

                $category = $type === 'in' 
                    ? $categoriesIn[array_rand($categoriesIn)] 
                    : $categoriesOut[array_rand($categoriesOut)];

                $amount = $type === 'in'
                    ? rand(500000, 5000000) // Pemasukan: 500rb - 5jt
                    : rand(15000, 300000);  // Pengeluaran: 15rb - 300rb

                Transaction::create([
                    'user_id' => $user->id,
                    'date' => $date,
                    'amount' => $amount,
                    'category' => $category,
                    'description' => 'Otomatis: ' . $category,
                    'type' => $type,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
