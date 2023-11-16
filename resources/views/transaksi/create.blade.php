@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Tambah Transaksi</h2>
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

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="tipe" class="form-label">Tipe</label>
                    <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required>
                        <option value="" disabled selected>Pilih jenis transaksi</option>
                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                </div>
                <div id="loading-indicator" style="display: none;">Loading...</div>
                <div class="form-group" id="kategori_container" style="display:none;">
                    <label for="kategori_id">Kategori:</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                        <!-- Kategori options akan diisi menggunakan JavaScript -->
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="nominal">Nominal:</label>
                        <input type="text" name="nominal" id="nominal" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Deskripsi:</strong>
                        <textarea class="form-control" style="height:150px" name="deskripsi" placeholder="Deskripsi"></textarea>
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
        // Tambahkan kode berikut pada bagian JavaScript di dalam view
        document.getElementById('jenis_transaksi').addEventListener('change', function() {
            var jenisTransaksi = this.value;
            var kategoriContainer = document.getElementById('kategori_container');
            var kategoriSelect = document.getElementById('kategori_id');
            var loading = document.getElementById('loading-indicator');

            if (jenisTransaksi === 'Pemasukan' || jenisTransaksi === 'Pengeluaran') {
                kategoriContainer.style.display = 'block';
                loading.style.display = 'block';
                // Gunakan AJAX untuk mengambil data kategori
                fetch("/get-kategori/" + jenisTransaksi)
                    .then(response => response.json())
                    .then(data => {
                        // Bersihkan opsi yang ada
                        kategoriSelect.innerHTML = '';

                        // Tambahkan opsi baru berdasarkan data dari server
                        data.forEach(kategori => {
                            var option = document.createElement('option');
                            option.value = kategori.id;
                            option.text = kategori.nama;
                            kategoriSelect.add(option);
                        });
                        loading.style.display = 'none';
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        loading.style.display = 'none';
                    });
            } else {
                kategoriContainer.style.display = 'none';
                loading.style.display = 'none';
            }
        });
    </script>
@endsection
