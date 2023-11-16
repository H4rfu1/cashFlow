@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Management Transaksi</h2>
                </div>
                <div class="pull-right pb-4">
                    <a class="btn btn-success" href="{{ route('transaksi.create') }}"> Tambah Transaksi</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- Form Penyaringan -->
        <form method="GET" action="{{ route('transaksi.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Tipe</th>
                <th>Nominal</th>
                <th>Tanggal dibuat</th>
                <th width="280px">Action</th>
            </tr>
            @if(! empty($transaksi->items()))
                @foreach ($transaksi as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nama_kategori }}</td>
                    <td>{{ 'Rp ' . number_format($s->nominal, 2, ',', '.') }}</td>
                    <td>{{ $s->jenis_transaksi }}</td>
                    <td>{{ $s->created_at->format('d F Y') }}</td>
                    <td>
                        <form action="{{ route('transaksi.destroy',$s->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">

                            <a class="btn btn-info" href="{{ route('transaksi.show',$s->id) }}">Detail</a>

                            <a class="btn btn-warning" href="{{ route('transaksi.edit',$s->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                {{ 'No Data' }}
            @endif
        </table>

        {!! $transaksi->links('pagination::bootstrap-4') !!}
    </div>

    <script>
        function deleteConfirmation(id) {
            $('#deleteModal').modal('show');

            $('#deleteButton').on('click', function() {
                $('#deleteModal').modal('hide');
                // Lakukan penghapusan atau redirect ke route delete di sini
                window.location.href = '/transaksi/' + id + '/delete';
            });
        }
    </script>
@endsection
