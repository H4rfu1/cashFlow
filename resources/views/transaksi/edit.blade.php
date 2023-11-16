@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Transaksi</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('transaksi.index') }}"> Back</a>
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

        <form action="{{ route('transaksi.update',$transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="jenis_transaksi" class="form-label">Tipe</label>
                    <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required>
                        <option value="Pemasukan" {{ $transaksi->jenis_transaksi == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="Pengeluaran" {{ $transaksi->jenis_transaksi == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>
                <div id="loading-indicator" style="display: none;">Loading...</div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="kategori_id">Kategori:</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <!-- Kategori options akan diisi menggunakan JavaScript -->
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Deskripsi:</strong>
                        <textarea class="form-control" style="height:150px" name="deskripsi" placeholder="Deskripsi">{{ $transaksi->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nominal:</strong>
                        <input type="text" name="nominal" value="{{ $transaksi->nominal }}" class="form-control" placeholder="Nominal">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center p-4">
                    <a class="btn btn-primary m-2" href="{{ route('transaksi.index') }}">Kembali</a>
                    <button type="submit" class="btn btn-success ">Simpan</button>
                </div>
            </div>

        </form>
    </div>
    <script>
        // Ambil kategori saat halaman dimuat
        window.onload = function () {
            var loading = document.getElementById('loading-indicator');
            loading.style.display = 'block';
            getKategoriOptions();
            loading.style.display = 'none';
        };

        // Fungsi untuk mendapatkan kategori menggunakan Ajax
        function getKategoriOptions() {
            var jenisTransaksi = document.getElementById('jenis_transaksi').value;
            var kategoriSelect = document.getElementById('kategori_id');

            fetch("/get-kategori/" + jenisTransaksi)
                .then(response => response.json())
                .then(data => {
                    kategoriSelect.innerHTML = '';
                    data.forEach(kategori => {
                        var option = document.createElement('option');
                        option.value = kategori.id;
                        option.text = kategori.nama;
                        kategoriSelect.add(option);
                    });
                    // Set opsi yang terpilih berdasarkan data transaksi
                    kategoriSelect.value = "{{ $transaksi->kategori_id }}";
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        // Tambahkan event listener untuk mengubah kategori saat jenis transaksi berubah
        document.getElementById('jenis_transaksi').addEventListener('change', function () {
            var loading = document.getElementById('loading-indicator');
            loading.style.display = 'block';
            alert('test');
            getKategoriOptions();
            loading.style.display = 'none';
        });
    </script>
@endsection
