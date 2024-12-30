@extends('layouts.sidebar')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add
        </button>
        <a href="/import-afiliate" class="btn btn-success">Import</a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/produk-afiliate" method="post">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk Afiliate</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Platform Afilite</label>
                             <select class="form-control" name="platformAfiliateId" id="">
                                <option>=Pilih Platform Afiliate=</option>
                                @foreach ($platforms as $platform)
                                    <option value="{{ encrypt($platform->id) }}"> {{ $platform->name }}</option>
                                @endforeach
                             </select>
                                @error('namaProduk')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                <input type="text" required name="namaProduk" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('namaProduk')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Harga Produk</label>
                                <input type="number" required name="hargaProduk" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('hargaProduk')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
    
                            </div>
    
    
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Penjualan </label>
                                <input type="text" required name="penjualanProduk" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('PenjualanProduk')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
    
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Link Produk </label>
                                <input type="url" required name="linkProduk" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('linkProduk')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
    
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Link Komii Ekstra </label>
                                <input type="url" required name="linkKomisiEkstra" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('linkKomisiEkstra')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
    
                            </div>

                        </div>

                    

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mt-2">

            <div class="d-flex flex-wrap">
                @foreach ($produks as $p)
              
                    <div class="col-md-2 m-1">
                        <div class="card">
                            @if ($p->media->count() == 1)
                            <img style="max-height: 200px; "
                            src="{{ env('APP_URL').'/file?file='. encrypt( $p->media[0]->file) }}"
                            class=" product-img ard-img-top" alt="{{ $p->name }}">
                            @else
                            <img style="max-height: 200px; "
                            src="{{ env('APP_URL').'/file?file='. encrypt( $p->media[1]->file) }}"
                            class=" product-img ard-img-top" alt="{{ $p->name }}">
                            @endif
                           
                            <div class="card-body">
                                <h5 class="card-title small"> <a target="_BLANK" href="{{ $p->link }}">
                                        {{ $p->nama }}</a></h5>
                                <br>
                              
                              
                                <div class="d-flex justify-content-between align-items-center">
                               <Span>@currency($p->harga)</Span>
                                    <div class="btn-group dropup">
                                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-three-dots-vertical"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu dropup " width=>
                                            <li><a class="dropdown-item"
                                                    href="/produk-afiliate/{{ encrypt($p->id) }}/edit">Update</a>
                                            </li>
                                            <li>
                                                <form action="/produk-afiliate/{{ encrypt($p->id) }}/delete" method="post">
                                                    @csrf
                                                    <button class="dropdown-item"
                                                        onclick="return confirm('Yakin Ingin Hapus Supplier Afiliate Ini ?')">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                



                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
