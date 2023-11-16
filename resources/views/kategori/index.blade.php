@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Management Kategori</h2>
                </div>
                <div class="pull-right pb-4">
                    <a class="btn btn-success" href="{{ route('kategori.create') }}"> Tambah Kategori</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th width="280px">Action</th>
            </tr>
            @if(! empty($kategori->items()))
                @foreach ($kategori as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->tipe }}</td>
                    <td>
                        <form action="{{ route('kategori.destroy',$s->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">

                            <a class="btn btn-info" href="{{ route('kategori.show',$s->id) }}">Detail</a>

                            <a class="btn btn-warning" href="{{ route('kategori.edit',$s->id) }}">Edit</a>

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

        {!! $kategori->links('pagination::bootstrap-4') !!}
    </div>

    <script>
        function deleteConfirmation(id) {
            $('#deleteModal').modal('show');

            $('#deleteButton').on('click', function() {
                $('#deleteModal').modal('hide');
                // Lakukan penghapusan atau redirect ke route delete di sini
                window.location.href = '/kategori/' + id + '/delete';
            });
        }
    </script>
@endsection
