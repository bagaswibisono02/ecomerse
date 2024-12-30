@extends('layouts.sidebar')
@section('content')
    <div class="container">
   
        <a href="/produk/create" class= "m-3 btn btn-primary">Tambah Produk</a>
        <a class="btn btn-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategory
        </a>
        <ul class="dropdown-menu">
            <li> <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Category
                </button></li>
            <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#lihatKategory">
                    Lihat Category
                </button></li>
        </ul>
        {{-- modal lihat --}}
        <div class="modal fade" id="lihatKategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Daftar Category</h1>
                        <button type="button" class="btn-close" id="close-category" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul style="list-style-type: none">
                            @foreach ($kategory as $kt)
                                <li>
                                    <div id="lihat{{ $kt->id }}">
                                        {{ $kt->name }}
                                        <button type="button" class="d-inline btn bg-light border-0"
                                            onclick="buka({{ $kt->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="text-warning bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                            </svg>
                                        </button>
                                        <form class="d-inline" action="/kategori/{{ encrypt($kt->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="text-danger nav-item btn"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor" class="bi bi-trash3"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg></button>
                                        </form>
                                    </div>
                                    <div id="buka{{ $kt->id }}" style="display: none">
                                        <form action="/kategori/{{ encrypt($kt->id) }}" class="d-flex" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="" name="nama"
                                                    value="{{ $kt->name }}" aria-label="Recipient's username"
                                                    aria-describedby="basic-addon2">
                                                <button type="submit" class="input-group-text">Simpan</button>
                                                <button type="button" onclick="tutup({{ $kt->id }})"
                                                    class="btn btn-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                    </svg>
                                                </button>
                                            </div>


                                        </form>
                                    </div>




                                </li>
                            @endforeach
                        </ul>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>

            </div>
        </div>


        <!-- Modal tambah -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/kategori" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <div class="container mt-2">

            <div class="d-flex flex-wrap">
                @foreach ($produks as $p)
                    <div class="col-md-2 m-1">
                        <div class="card">
                            <img style="max-height: 200px; "
                                src="{{ env('APP_URL') . '/file?file=' . encrypt('/' . $p->media->first()->file) }}"
                                class=" product-img ard-img-top" alt="Produk 1">
                            <div class="card-body">
                                <h5 class="card-title small"> <a href="/produk/{{ encrypt($p->id) }}">
                                        {{ Str::limit($p->nama, 50, '...') }}</a></h5>
                                <br>
                                <h6 class="card-subtitle small mb-2 text-muted">Harga: @currency($p->harga)</h6>
                              
                                <div class="d-flex justify-content-between align-items-center">
                                 
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
                                                    href="/produk/{{ encrypt($p->id) }}/edit">Update</a>
                                            </li>
                                            <li>
                                                <form action="/produk/{{ encrypt($p->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item"
                                                        onclick="return confirm('Yakin Ingin Hapus Produk Ini ?')">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <a class="text-muted">Terjual 900</a>



                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{ $produks->links() }}
        </div>

        <style>
            .card:hover {
                transform: scale(1.03);
                transition: transform 0.2s ease-in-out;
                border-color: rgb(209, 24, 24)
            }
        </style>

    </div>
    <script>
        function buka(id) {

            document.getElementById('lihat' + id).style.display = 'none';
            document.getElementById('buka' + id).style.display = 'block';


        }

        function tutup(id) {

            document.getElementById('lihat' + id).style.display = 'block';
            document.getElementById('buka' + id).style.display = 'none';


        }
    </script>
@endsection
