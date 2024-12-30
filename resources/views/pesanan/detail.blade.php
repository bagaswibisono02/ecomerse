@extends('layouts.navUser')
@section('body')
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
                <img src="{{ env('APP_URL') . '/file?file=' . encrypt($pesanan->produk->media[0]->file) }}" alt="Produk"
                    class="img-fluid rounded">
            </div>

            <!-- Product Information Section -->
            <div class="col-md-8">
                <h5 class="card-title">Nama Produk: <strong>{{ $pesanan->produk->nama }}</strong></h5>
                <p><strong>Harga:</strong> @currency($pesanan->produk->harga)</p>
                <p><strong>Jumlah:</strong> {{ $pesanan->jumlah }}</p>
                <p><strong>Total Harga:</strong> @currency($pesanan->jumlah * $pesanan->produk->harga)</p>
                <p><strong>Alamat Pengiriman:</strong>
                    {{ $pesanan->alamatPenerima->alamat . ', ' . $pesanan->alamatPenerima->kelurahan->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->kab_kota->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->kab_kota->provinsi->nama }}
                </p>
                <p><strong>Penerima:</strong> {{ $pesanan->alamatPenerima->nama }}</p>
                <!-- Order Status -->
                <div class="mt-4">
                    <h6>Status Pemesanan: <span class="badge bg-success">{{ $pesanan->status }}</span></h6>

                    <h6>Resi : <span class="badge bg-success">{{ $pesanan->resi }}</span></h6>

                </div>

                <!-- Order Actions -->
                <div class="mt-4">
                    <h6>Aksi Pemesanan</h6>
                    <a href="https://wa.me/+6287813720480" class="btn btn-primary" target="_Blank">Chat Penjual</a>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>

  <!-- Modal Contact Seller -->
  <div class="modal fade" id="contactSellerModal" tabindex="-1" aria-labelledby="contactSellerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactSellerModalLabel">Hubungi Penjual</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="message" class="form-label">Pesan Anda</label>
              <textarea class="form-control" id="message" rows="3" placeholder="Tulis pesan untuk penjual..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container mb-5">
    <h5>Perjalanan Paket</h5>
    <div class="col-6">
        <table class="table">

            @foreach ($pesanan->pengiriman as $p)
          
                <tr id="{{ $p->id }}">
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->created_at }}</td>
                </tr>
         
            @endforeach
          
        </table>
    </div>


</div>
@endsection