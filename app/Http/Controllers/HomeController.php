<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Menghitung saldo saat ini
        $saldo = $this->hitungSaldo();

        // Menghitung total pemasukan (all time)
        $totalPemasukan = Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('nominal');

        // Menghitung total pengeluaran (all time)
        $totalPengeluaran = Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('nominal');

        return view('home', compact('saldo', 'totalPemasukan', 'totalPengeluaran'));
    }

    private function hitungSaldo()
    {
        // Menghitung saldo saat ini
        $totalPemasukan = Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return $saldo;
    }
}
