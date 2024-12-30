@extends('layouts.sidebar')
@section('content')
    <div class="container my-5">
        <!-- Card for Order Details -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Detail Pemesanan Produk</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Product Image Section -->
                    <div class="col-md-4">
                        <img src="{{ env('APP_URL') . '/file?file=' . encrypt($produk->media[0]->file) }}" alt="Produk"
                            class="img-fluid rounded">
                    </div>

                    <!-- Product Information Section -->
                    <div class="col-md-8">
                        <h5 class="card-title">Nama Produk: <strong>{{ $produk->nama }}</strong></h5>
                        <p><strong>Harga:</strong> @currency($produk->harga)</p>
                        <p><strong>Jumlah:</strong> {{ $jumlah }}</p>
                        <p><strong>Total Harga:</strong> @currency($jumlah * $produk->harga)</p>
                        <p><strong>Alamat Pengiriman:</strong>
                            {{ $alamatPenerima->alamat . ', ' . $alamatPenerima->kelurahan->nama . ', ' . $alamatPenerima->kelurahan->kecamatan->nama . ', ' . $alamatPenerima->kelurahan->kecamatan->kab_kota->nama . ', ' . $alamatPenerima->kelurahan->kecamatan->kab_kota->provinsi->nama }}
                        </p>
                        <p><strong>Penerima:</strong> {{ $alamatPenerima->nama }}</p>
                        <!-- Order Status -->
                        <div class="mt-4">
                            <h6>Status Pemesanan: <span class="badge bg-warning">{{ $status }}</span></h6>

                            <h6>Resi : <span class="badge bg-warning">{{ $resi }}</span></h6>

                        </div>

                        <!-- Order Actions -->
                        <div class="mt-4">
                            <h6>Aksi Pemesanan</h6>
                            <a href="{{ $link_beli }}" class="btn btn-primary" target="_Blank">Cek Supplier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <h5>Perjalanan Paket</h5>
        <div class="col-6">
            <table class="table">

                @foreach ($pengiriman as $p)
              
                    <tr id="{{ $p->id }}">
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->created_at }} <button class="btn btn-success"
                                onclick="tampilUpdateResi('{{ $p->id }}')">Update</button></td>
                    </tr>
                    <tr id="form-{{ $p->id }}" class="d-none">
                        <form action="/resi/{{ encrypt($p->id) }}/edit" method="POST">
                            @csrf
                            <td><input class="form" type="text" name="status" value="{{ $p->status }}"> </td>
                            <td><button type="submit" class="btn btn-danger">Update</button></td>
                        </form>
                    </tr>
                @endforeach
                <form action="/resi/{{ encrypt($id) }}" method="POST">
                    @csrf
                    <tr>
                        <td><input class="input-grup" type="text" name="status"></td>
                        <td><button class="btn btn-success">Tambah</button></td>
                    </tr>
                </form>
            </table>
        </div>


    </div>
@endsection
