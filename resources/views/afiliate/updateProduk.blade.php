@extends('layouts.sidebar')
@section('content')
    <div class="container">
        <div class="foto m-3 col-10 d-flex  crd flex-wrap">
            @if ($produk->media->count() == 1)
                <div class=" ">
                    <img class="m-2" src="{{ env('APP_URL') . '/file?file=' . encrypt($media->file) }}" width="200px"
                        height="auto" style="overflow: hidden;margin: 3px" alt="">

                </div>
            @else
                @foreach ($produk->media->skip(1) as $media)
                    <div class="">
                        <img class="m-2" src="{{ env('APP_URL') . '/file?file=' . encrypt($media->file) }}"
                            width="200px" height="auto" style="overflow: hidden;margin: 3px" alt="">
                        <form action="/hapus-foto-produkAfiliate" class="col-12 d-flex jutify-content-center"
                            method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ encrypt($media->id) }}">
                            <button class="btn col-12 "><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg></button>
                        </form>
                    </div>
                @endforeach
            @endif


        </div>

        <div class="bg-light card m2" id="filePreviewContainer">

            <div id="filePreview"></div>

        </div>
        <form action="/tambahFotoAfiliate" enctype="multipart/form-data" class="m-3 card col-10" method="post">
            <div class="d-flex">
                @csrf
                <input type="hidden" required name="produk_id" value="{{ $produk->id }}">
                <input type="file" required class="form-control" accept="image/*,video/*" id="fileInput" multiple
                    onchange="previewFiles()" name="media[]">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        <form action="/produk-afiliate/{{ encrypt($produk->id) }}/update" class="card col-10 m-3" method="post">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Produk Afiliate</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Platform Afilite</label>
                    <select class="form-control" name="platformAfiliateId" id="">
                        <option>=Pilih Platform Afiliate=</option>
                        @foreach ($platforms as $platform)
                            <option @if ($platform->id == $produk->platformAfiliate_id) @selected(true) @endif
                                value="{{ encrypt($platform->id) }}"> {{ $platform->name }}</option>
                        @endforeach
                    </select>
                    @error('namaProduk')
                        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                    <input type="text" value="{{ $produk->nama }}" required name="namaProduk" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('namaProduk')
                        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Harga Produk</label>
                    <input type="number" value="{{ $produk->harga }}" required name="hargaProduk" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('hargaProduk')
                        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                    @enderror

                </div>


                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Penjualan </label>
                    <input type="text" required value="{{ $produk->penjualan }}" name="penjualanProduk"
                        class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('PenjualanProduk')
                        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Link Produk </label>
                    <input type="url" value="{{ $produk->link_produk }}" required name="linkProduk"
                        class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('linkProduk')
                        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Link Komii Ekstra </label>
                    <input type="url" value="{{ $produk->link_komisi_ekstra }}" required name="linkKomisiEkstra"
                        class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('linkKomisiEkstra')
                        <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <script src="/script.js"></script>
@endsection
