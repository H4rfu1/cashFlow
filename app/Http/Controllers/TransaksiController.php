<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Menghitung total pemasukan
        $totalPemasukan = Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('nominal');

        // Menghitung total pengeluaran
        $totalPengeluaran = Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('nominal');

        // Menghitung saldo
        $saldo = $totalPemasukan - $totalPengeluaran;
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $transaksi = Transaksi::whereBetween('transaksis.created_at', [$start_date, $end_date])
            ->join('kategoris', 'transaksis.kategori_id', '=', 'kategoris.id')
            ->select('transaksis.*', 'kategoris.nama as nama_kategori')
            ->oldest()
            ->paginate(5);
        }else{
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $transaksi = Transaksi::whereBetween('transaksis.created_at', [$startOfMonth, $endOfMonth])
            ->join('kategoris', 'transaksis.kategori_id', '=', 'kategoris.id')
            ->select('transaksis.*', 'kategoris.nama as nama_kategori')
            ->oldest()
            ->paginate(5);
        }
        return view('transaksi.index',compact(['transaksi','saldo']))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required',
            'kategori_id' => 'required',
            'nominal' => 'required',
            'deskripsi' => 'required',
        ]);

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success','Transaksi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::join('kategoris', 'transaksis.kategori_id', '=', 'kategoris.id')
            ->select('transaksis.*', 'kategoris.nama as nama_kategori')
            ->where('transaksis.id', $id)
            ->first();
        // dd($transaksi);
        return view('transaksi.show',compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit',compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'jenis_transaksi' => 'required',
            'kategori_id' => 'required',
            'nominal' => 'required',
            'deskripsi' => 'required',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success','Transaksi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success','Transaksi deleted successfully');
    }
}
