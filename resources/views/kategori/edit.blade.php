@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Kategori</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('kategori.index') }}"> Back</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Error!</strong> <br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategori.update',$kategori->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama:</strong>
                        <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control" placeholder="Nama">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tipe" class="form-label">Tipe</label>
                    <select class="form-select" id="tipe" name="tipe" required>
                        <option value="Pemasukan" {{ $kategori->tipe == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="Pengeluaran" {{ $kategori->tipe == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Deskripsi:</strong>
                        <textarea class="form-control" style="height:150px" name="deskripsi" placeholder="Deskripsi">{{ $kategori->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center p-4">
                    <a class="btn btn-primary m-2" href="{{ route('kategori.index') }}">Kembali</a>
                    <button type="submit" class="btn btn-success ">Simpan</button>
                </div>
            </div>

        </form>
    </div>
@endsection
