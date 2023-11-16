@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <h2>Saldo Saat Ini: {{ 'Rp ' . number_format($saldo, 2, ',', '.') }}</h2>
                        <h3>Total Pemasukan (all time): {{ 'Rp ' . number_format($totalPemasukan, 2, ',', '.') }}</h3>
                        <h3>Total Pengeluaran (all time): {{ 'Rp ' . number_format($totalPengeluaran, 2, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
