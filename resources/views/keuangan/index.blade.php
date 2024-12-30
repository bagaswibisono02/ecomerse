@extends('layouts.sidebar')
@section('content')
    <div class="container">
        <! -- Form Filter Tanggal -->
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">Dari Tanggal:</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control"
                                id="start_date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">Sampai Tanggal:</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control"
                                id="end_date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                        <button type="button" id="resetButton" class="btn btn-secondary mt-4">Reset</button>
                    </div>

                </div>
            </form>

            <!-- Menampilkan Total Pemasukan dan Pengeluaran -->
            <div class="d-flex mt-4">
                <div class="flex-fill m-1">
                    <div class="flex-fill alert alert-success">
                        <h4>Total Pemasukan: <br> @currency($pemasukan->sum('nominal')) </h4>
                    </div>
                </div>
                <div class="flex-fill m-1">
                    <div class="flex-fill alert alert-danger">
                        <h4>Total Pengeluaran: <br> @currency($pengeluaran->sum('nominal'))</h4>
                    </div>
                </div>
                <div class="flex-fill m-1">
                    <div class="flex-fill alert alert-primary">
                        <h4>Total Saldo: <br> @currency($pemasukan->sum('nominal')- $pengeluaran->sum('nominal'))</h4>
                    </div>
                </div>
            </div>


            <!-- Tabel Transaksi -->
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>masuk</th>
                        <th>keluar</th>


                    </tr>
                </thead>
                <tbody>
                    @forelse($keuangans as $item)
                        @if ($item->jenis_transaksi == 'masuk')
                            <tr>
                                <td>{{ $item->tanggal_transaksi }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>@currency($item->nominal)</td>
                                <td>-</td>


                            </tr>
                        @else
                            <tr>
                                <td>{{ $item->tanggal_transaksi }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>-</td>
                                <td>@currency($item->nominal)</td>

                            </tr>
                        @endif

                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                        </tr>
                    @endforelse
                    <form action="/keuangan" method="post">
                        @csrf
                        <tr id="input" style="display: none">
                            <td><input type="date" name="tanggal_transaksi"></td>
                            <td><input type="text" name="keterangan"></td>
                            <td><input type="number" name="masuk"></td>
                            <td><input type="number" name="keluar"> <button class="btn btn-success" type="submit">Simpan</button></td>
                        </tr>
                    </form>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="d-flex justify-content-end"><button type="button" class="btn btn-danger text-white" id="toogle"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                          </svg></button></td>
                    </tr>
                </tbody>

                
            </table>
    </div>
    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
            // Menghapus nilai input tipe date
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';
        });
    </script>
@endsection
