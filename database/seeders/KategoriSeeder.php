<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            ['nama' => 'Gaji', 'deskripsi' => 'Pemasukan', 'tipe' => 'Pemasukan'],
            ['nama' => 'Sewa Kost', 'deskripsi' => 'Pengeluaran', 'tipe' => 'Pengeluaran'],
            ['nama' => 'Tunjangan', 'deskripsi' => 'Pemasukan', 'tipe' => 'Pemasukan'],
            ['nama' => 'Bonus', 'deskripsi' => 'Pemasukan', 'tipe' => 'Pemasukan'],
            ['nama' => 'Makan', 'deskripsi' => 'Pengeluaran', 'tipe' => 'Pengeluaran'],
            ['nama' => 'Pakaian', 'deskripsi' => 'Pengeluaran', 'tipe' => 'Pengeluaran'],
            ['nama' => 'Nonton Bioskop', 'deskripsi' => 'Pengeluaran', 'tipe' => 'Pengeluaran'],
        ]);
    }
}
