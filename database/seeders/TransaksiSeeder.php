<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksis')->insert([
            [
                'jenis_transaksi' => 'Pemasukan',
                'kategori_id' => 1, // ID dari kategori Gaji
                'nominal' => 5000.00,
                'deskripsi' => 'Pemasukan gaji bulanan',
            ],
            [
                'jenis_transaksi' => 'Pengeluaran',
                'kategori_id' => 2, // ID dari kategori Sewa Kost
                'nominal' => 1000.00,
                'deskripsi' => 'Pembayaran sewa kost bulanan',
            ],
            // Tambahkan data transaksi lainnya sesuai kebutuhan
        ]);
    }
}
