@extends('layouts.navUser')
@section('body')
    @php
        use Carbon\Carbon;
    @endphp
    <div class=" container p-3 card bg-light rounder-5 mt-0  mt-md-5">
        <div class=" justify-content-around d-flex m-0 m-md-2">
            <a href="/panel"
                class="flex-fill @if (Request::get('filter') == '') bg-primary  text-white  @else text-dark @endif rounded-4 text-center m-2 p-2 text-decoration-none">
                <span class="d-inline d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-card-list" viewBox="0 0 16 16">
                        <path
                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                        <path
                            d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>
                </span>
                <span class="d-none d-md-inline">Semua</span></a>
            <a href="/panel?filter=tunggubayar"
                class="flex-fill @if (Request::get('filter') == 'tunggubayar') bg-primary  text-white  @else text-dark @endif rounded-4 text-center m-2 p-2 text-decoration-none">
                <span class="d-inline d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cash-stack" viewBox="0 0 16 16">
                        <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                        <path
                            d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                    </svg>
                </span>
                <span class="d-none d-md-inline">Menunggu Pembayaran</span>
            </a>
            <a href="/panel?filter=keranjang"
                class="@if (Request::get('filter') == 'keranjang') bg-primary  text-white  @else text-dark @endif flex-fill rounded-4 text-center  m-2 p-2  text-decoration-none">
                <span class="d-inline d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cart4" viewBox="0 0 16 16">
                        <path
                            d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                    </svg>
                </span>
                <span class="d-none d-md-inline">Keranjang</span>
            </a>
            <a href="/panel?filter=diproses"
                class="@if (Request::get('filter') == 'diproses') bg-primary  text-white  @else text-dark @endif flex-fill rounded-4 text-center   m-2 p-2  text-decoration-none">
                <span class="d-inline d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                    </svg>
                </span>
                <span class="d-none d-md-inline">Diproses</span>
            </a>
            <a href="/panel?filter=batal"
                class="@if (Request::get('filter') == 'batal') bg-primary  text-white  @else text-dark @endif flex-fill rounded-4 text-center  m-2 p-2  text-decoration-none">
                <span class="d-inline d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                    </svg>
                </span>
                <span class="d-none d-md-inline">Batal</span>
            </a>
            <a href="/panel?filter=selesai"
                class="@if (Request::get('filter') == 'selesai') bg-primary  text-white  @else text-dark @endif flex-fill rounded-4 text-center  m-2 p-2  text-decoration-none">
                <span class="d-inline d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </span>
                <span class="d-none d-md-inline">Selesai</span>
            </a>
        </div>

        @foreach ($pesanans as $pesanan)
            <div class="order-card p-2" id="pesanandetail">
                <div class="order-header d-flex justify-content-between">
                    <span><strong>ID Pesanan:</strong> #{{ $pesanan->id + 999 }}
                        <span>No Resi :


                            @if ($pesanan->resi == 'diterima' or $pesanan->resi == null or $pesanan->resi == 'direvisi')
                                <span>Sedang Diproses</span>
                            @elseif ($pesanan->resi != 'ditolak')
                                <a href="/lihatresi?pesanan={{ encrypt($pesanan->id) }}">{{ $pesanan->resi }}</a>
                            @elseif ($pesanan->resi == 'ditolak')
                                <a href="/pembayaran?keranjang={{ encrypt($pesanan->id) }}">Upload Ulang</a>
                            @else
                                Sedang Diproses
                            @endif
                        </span>
                    </span>




                </div>
                <div class="order-body d-flex mt-3">
                    <div class="col-4 col-md-2">
                        <img class="img-fluid "
                            src="{{ url('') . '/file?file=' . encrypt($pesanan->produk->media[0]->file) }}"
                            class="product-img" alt="Produk 1">
                    </div>

                    <div class="product-info">
                        <p class="text-sm " style="height:70px; overflow:scroll">
                            {{ Str::limit($pesanan->produk->nama, 150) }} <br> <small> Pengiriman :
                                {{ $pesanan->alamatPenerima->alamat . ', ' . $pesanan->alamatPenerima->kelurahan->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->kab_kota->nama . ', ' . $pesanan->alamatPenerima->kelurahan->kecamatan->kab_kota->provinsi->nama }}
                                @if ($pesanan->status == 'tunggubayar')
                                    <a
                                        href="/pesanan/{{ encrypt($pesanan->id) }}/{{ encrypt(Auth::user()->id) }}?keranjang={{ encrypt($pesanan->id) }}">Ganti
                                        Alamat</a>
                                @endif
                            </small>
                        </p>


                        @if ($pesanan->resi == 'ditolak')
                            <span class="text-danger">*Resi Tidak Valid Silahkan Upload Ulang</span>
                            <br>
                        @endif
                        <span
                            class="badge  
                        @if ($pesanan->status == 'keranjang') bg-info
                        @elseif($pesanan->status == 'diproses' or $pesanan->status == 'Berhasil')
                        bg-warning
                         @elseif($pesanan->status == 'batal')
                         bg-danger
                          @elseif($pesanan->status == 'selesai')
                            bg-success
                             @elseif($pesanan->status == 'tunggubayar')
                             bg-primary @endif ">{{ $pesanan->status }}</span>
                        <p> @ {{ $pesanan->jumlah }} x @currency($pesanan->produk->harga)</p>

                        <p><strong>Total</strong> @currency($pesanan->produk->harga * $pesanan->jumlah)</p>



                    </div>
                    <div class="order-footer">
                        @if ($pesanan->status == 'tunggubayar')
                            <a class="btn btn-action btn-success bg-success"
                                href="/pembayaran?keranjang={{ encrypt($pesanan->id) }}">Bayar</a>
                        @elseif($pesanan->status == 'keranjang')
                            <a class="btn btn-danger btn-action"
                                href="/checkout?keranjang={{ encrypt($pesanan->id) }}">Checkout</a>
                        @elseif($pesanan->status == 'Berhasil')
                            <a class="btn btn-primary btn-action"
                                href="/lihat-pesanan?keranjang={{ encrypt($pesanan->id) }}">Lihat</a>
                        @elseif($pesanan->resi == 'ditolak')
                            <a href="/pembayaran?keranjang={{ encrypt($pesanan->id) }}" class="btn btn-danger">Update
                                Resi</a>
                        @elseif($pesanan->status == 'selesai' && !$pesanan->review)
                            <a class="btn btn-primary btn-action"
                                href="/review?keranjang={{ encrypt($pesanan->id) }}">Review</a>
                        @elseif($pesanan->status == 'selesai' && $pesanan->review)
                            <a class="btn btn-primary btn-action"
                                href="/review?keranjang={{ encrypt($pesanan->id) }}&review={{ encrypt($pesanan->review->id) }}">Edit Review</a>
                        @endif


                    </div>
                </div>
            </div>

            <hr class="m">
        @endforeach
    </div>
@endsection
