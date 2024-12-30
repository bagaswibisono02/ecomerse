@extends('layouts.sidebar')
@section('content')
    <div class="container">
        @if (session('gagal'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('gagal') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="foto d-flex flex-wrap">
            @foreach ($produk->media as $media)
                <div class="">
                    <img class="m-2" src="{{ env('APP_URL') . '/file?file=' . encrypt($media->file )}}" width="200px" height="200px"
                        style="overflow: hidden;margin: 3px" alt="">

                </div>
              
            @endforeach
        </div>
        <div class="bg-light m2" id="filePreviewContainer">

            <div id="filePreview"></div>

        </div>
        <div id="tombol" class="d-flex m-2 d-none justify-content-center">
            <div class="d-flex">
                <button id="scrollLeft" class="btn btn-light" onclick="scrollLeftBtn()">&#10094;</button>
                <button id="scrollRight" class="btn btn-light" onclick="scrollRightBtn()">&#10095;</button>
            </div>
        </div>
        <a href="/produk/{{ encrypt($produk->id) }}/edit" class="btn btn-success m-3">Edit</a> <br>
        <!-- Form controls -->
       
            <div class="col-12 card">
                <div class="col-md-8">
                    <div class="card mb-4">

                        <div class="card-body">
                            <div class="mb-3">


                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                <div class="">{{ $produk->nama }}</div>
                       
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Link</label>
                                <table class="table">
                                    @foreach ($produk->supplier as $s)
                                        <tr>
                                            <td><a href="{{  $s->supplier }}" target="_Blank"> {{ Str::limit( $s->supplier, 40, ',,,')  }}</a></td>
                                            <td>@currency($s->harga)</td>
                                            <td class="text-success"> @currency($produk->harga - $s->harga) </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Kategori</label>
                               <div class="">{{ $produk->kategory->name }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Harga</label>
                               <div class="">{{ $produk->harga }}</div>
                            </div>
                          
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Deskripsi</label>
                               <div>
                                {!! $produk->keterangan !!}
                               </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
    <script src="/script.js"></script>
    </div>
@endsection
