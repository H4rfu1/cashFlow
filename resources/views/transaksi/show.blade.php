@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Detail Transaksi</h2>
                </div>
                <div class="pull-right p-2">
                    <a class="btn btn-primary" href="{{ route('transaksi.index') }}"> Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipe:</strong>
                    {{ $transaksi->jenis_transaksi }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipe:</strong>
                    {{ $transaksi->nama_kategori }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nominal:</strong>
                    {{ 'Rp ' . number_format($transaksi->nominal, 2, ',', '.') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deskripsi:</strong>
                    {{ $transaksi->deskripsi }}
                </div>
            </div>
        </div>
    </div>
@endsection
