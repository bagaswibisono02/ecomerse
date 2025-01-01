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
                        <img src="{{ env('APP_URL') . '/file?file=' . encrypt($pesanan->produk->media[0]->file) }}"
                            alt="Produk" class="img-fluid rounded">
                    </div>

                    <!-- Product Information Section -->
                    <div class="col-md-8">
                        <h5 class="card-title">Nama Produk: <strong>{{ $pesanan->produk->nama }}</strong></h5>
                        <p><strong>Harga:</strong> @currency($pesanan->produk->harga)</p>
                        <p><strong>Harga:</strong> @currency($pesanan->produk->harga)</p>
                        <p><strong>Jumlah:</strong> {{ $pesanan->jumlah }}</p>
                        <p><strong>Total Harga:</strong> @currency($pesanan->jumlah * $pesanan->produk->harga)</p>
                        <p><strong>Alamat Pengiriman:</strong>
                            {{ $pesanan->alamatPenerima->alamat . ', ' . $pesanan->alamatPenerima->kelurahan->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->kab_kota->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->kab_kota->provinsi->nama }}
                        </p>
                        <p><strong>Penerima:</strong> {{ $pesanan->alamatPenerima->nama }}</p>
                        <!-- Order Status -->
                        <div class="mt-4">
                            <h6>Status Pemesanan: <span class="badge bg-warning">{{ $pesanan->status }}</span></h6>

                            <h6>Resi : <span class="badge bg-warning">{{ $pesanan->resi }}</span></h6>

                        </div>

                        <!-- Order Actions -->
                        <div class="mt-4">
                            <h6>Aksi Pemesanan</h6>
                            <a href="{{ $pesanan->link_beli }}" class="btn btn-primary" target="_Blank">Cek Supplier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="d-flex ">
            <div class="col-6">
                <h5>Perjalanan Paket</h5>
                <div class="col-12">
                    <table class="table">

                        @foreach ($pesanan->pengiriman as $p)
                            <tr id="{{ $p->id }}">
                                <td>{{ $p->status }}</td>
                                <td>{{ $p->created_at }} 
                                    @if ($pesanan->status != 'selesai')
                                    <button class="btn btn-success"
                                    onclick="tampilUpdateResi('{{ $p->id }}')">Update</button>
                                </td>
                                    @endif
                                   
                            </tr>
                            @if ($pesanan->status != 'selesai')
                            <tr id="form-{{ $p->id }}" class="d-none">
                                <form action="/resi/{{ encrypt($p->id) }}/edit" method="POST">
                                    @csrf
                                    <td><input class="form" type="text" name="status" value="{{ $p->status }}">
                                    </td>
                                    <td><button type="submit" class="btn btn-danger">Update</button></td>
                                </form>
                            </tr>
                            @endif
                           
                        @endforeach
                        @if ($pesanan->status != 'selesai')
                        <form action="/resi/{{ encrypt($pesanan->id) }}" method="POST">
                            @csrf
                            <tr>
                                <td><input class="input-grup" type="text" name="status"></td>
                                <td><button class="btn btn-success">Tambah</button></td>
                            </tr>
                        </form>
                        @endif
                      
                    </table>
                </div>
            </div>
            <div class="col-6 p-2 ">

                <img class="col-12  col-md-8 col-lg-4 "
                src="{{ env('APP_URL') . '/file?file=' . encrypt($pesanan->konfirmasiPembayaran->bukti_transaksi) }}"
                alt="File Hilang / Rusak">
                @if ($pesanan->status != 'selesai')
                <form class="col-12  col-md-8 col-lg-4 d-flex justify-content-center" action="/pesanan-diterima/{{ encrypt($pesanan->id) }}" method="post">
                    @csrf
                    <button onclick="return confirm('Yakin Pesanan Selesai')" class="btn btn-warning">Selesai</button>
                    </form>
                @endif
                
            </div>



        </div>


    </div>
@endsection
