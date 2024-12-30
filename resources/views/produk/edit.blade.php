@extends('layouts.sidebar')
@section('content')
    @php
        $daerah = $produk->provinsi->pluck('id')->toArray();
    @endphp
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
                    <img class="m-2" src="{{ env('APP_URL') . '/file?file=' . encrypt($media->file) }}" width="200px"
                        height="200px" style="overflow: hidden;margin: 3px" alt="">
                    <form action="/hapus-foto-produk" class="col-12 d-flex jutify-content-center" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ encrypt($media->id) }}">
                        <button class="btn col-12 "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-trash3 text-danger" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                            </svg></button>
                    </form>
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

        <!-- Form controls -->
        <form action="/produk/{{ encrypt($produk->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12 card">
                <div class="col-md-10">
                    <div class="card mb-4">

                        <div class="card-body">
                            <div class="mb-3">


                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                <input type="text" value="{{ $produk->nama }}" class="form-control"
                                    id="exampleFormControlInput1" name="nama" required placeholder="Nama Produk..." />
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Foto/video Produk</label>
                                <input class="form-control" type="file" id="fileInput" name="media[]" multiple
                                    accept="image/*,video/*" onchange="previewFiles()" />
                                @error('media')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Kategori</label>
                                <select name="category_id" required class="form-select">
                                    <option>Pilih</option>
                                    @foreach ($kategoryes as $k)
                                        <option value="{{ $k->id }}"
                                            @if ($k->id == $produk->kategory_id) @selected(true) @endif>
                                            {{ $k->name }}</option>
                                    @endforeach


                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="harga"
                                    required value="{{ $produk->harga }}" placeholder="Harga Produk..." />
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <table class="table" id="myTable">
                                    <tr>
                                        <td>link</td>
                                        <td>Harga Asli</td>
                                    </tr>
                                    @foreach ($produk->supplier as $suppli)
                                        <tr>

                                            <td><input class="form-control" placeholder="Link Supplier"
                                                    value="{{ $suppli->supplier }}" type="url" name="link[]"></td>
                                            <td><input class="form-control" placeholder="Harga"
                                                    value="{{ $suppli->harga }}" type="number" name="hargaAsli[]">
                                                    <input type="hidden" name="idSupplier[]" value="{{ $suppli->id}}">

                                            </td>
                                           
                                        </tr>
                                    @endforeach


                                </table>

                                <div>
                                    <button class="btn d-float float-end btn-primary" type="button"
                                        onclick="tambahLink()">Add</button>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Varian</label><br>
                                <div class="d-flex flex-wrap" id="container-varian">
                                    @foreach ($produk->varian as $v)
                                    @csrf
                                        <div class="input-group col-3 mb-3">
                                            <input type="text" value="{{ $v->nama }}" readonly class="form-control" style="max-width: 200px" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <a type="submit" href="/varian/{{ encrypt($v->id) }}" class="input-group-text" id="basic-addon2">X </a>
                                          </div>
                                    @endforeach
                                  


                                </div>

                             
                                <div class="input-group  mb-3">
                                    <input type="text" id="input-varian" name="input-varian"
                                        class="w-auto d-inline bordered border-3 border-light"
                                        value="Nama Varian">
                                        <button class="btn btn-success" type="button" onclick="masukanVarian()">Tambah</button>
                                    
                                </div>


                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Daerah Gratis Ongkir</label>
                                <div class="d-flex flex-column flex-wrap " style="max-height: 400px">
                                    @foreach ($provinsis as $provinsi)
                                        <div class="d-inline col-3 me-2 flex-ill">
                                            <input type="checkbox"
                                                @if (in_array($provinsi->id, $daerah)) @checked(true) @endif
                                                id="provinsi{{ $provinsi->id }}" name="provinsi[]"
                                                value="{{ $provinsi->id }}">
                                            <label for="provinsi{{ $provinsi->id }}"> {{ $provinsi->nama }}</label>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Deskripsi</label>
                                <input id="x" type="hidden" value="{!! $produk->keterangan !!}" required
                                    name="keterangan">
                                <trix-editor input="x"></trix-editor>
                            </div>
                            @error('keterangan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="">
                                <button type="submit" class="btn btn-primary"> Simpan</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <script src="/script.js"></script>
    </div>
@endsection
