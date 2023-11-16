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
                        <h2>Saldo Saat Ini: {{ $saldo }}</h2>
                        <h3>Total Pemasukan (all time): {{ $totalPemasukan }}</h3>
                        <h3>Total Pengeluaran (all time): {{ $totalPengeluaran }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
