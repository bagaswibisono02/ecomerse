@extends('layouts.sidebar')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/platform-afiliate" method="post">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Platform</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Platform</label>
                                <input type="text" required name="namaPlatform" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('namaPlatform')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Link Platform</label>
                                <input type="url" required name="linkPlatform" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('linkPlatform')
                                    <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                                @enderror
    
                            </div>
    
    
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Logo Platform</label>
                                <input type="url" required name="logoPlatform" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('logoPlatform')
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
                @foreach ($platforms as $p)
                    <div class="col-md-2 m-1">
                        <div class="card">
                            <img style="max-height: 200px; "
                                src="{{ $p->logo }}"
                                class=" product-img ard-img-top" alt="{{ $p->name }}">
                            <div class="card-body">
                                <h5 class="card-title small"> <a target="_BLANK" href="{{ $p->link }}">
                                        {{ $p->name }}</a></h5>
                                <br>
                                <h6 class="card-subtitle small mb-2 text-muthttps://shopee.co.id/ed">{{ $p->clicked }} Diklik</h6>
                              
                                <div class="d-flex justify-content-between align-items-center">
                                 <a href="" class="btn btn-success">Produk</a>
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
                                                    href="/platform-afiliate/{{ encrypt($p->id) }}/edit">Update</a>
                                            </li>
                                            <li>
                                                <form action="/platform-afiliate/{{ encrypt($p->id) }}/delete" method="post">
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
