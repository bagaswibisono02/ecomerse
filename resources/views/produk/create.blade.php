@extends('layouts.sidebar')
@section('content')
    <div class="container">
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
        <form action="/produk" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-12 card">
                <div class="col-md-10">
                    <div class="card mb-4">

                        <div class="card-body">
                            <div class="mb-3">


                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="nama"
                                    required placeholder="Nama Produk..." />
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Foto/video Produk</label>
                                <input class="form-control" required type="file" id="fileInput" name="media[]" multiple
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
                                        <option value="{{ $k->id }}">{{ $k->name }}</option>
                                    @endforeach


                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="harga"
                                    required placeholder="Harga Produk..." />
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
                                    <tr>
                                        <td><input class="form-control" placeholder="Link Supplier" type="url"
                                                name="link[]"></td>
                                        <td><input class="form-control" placeholder="Harga" type="number"
                                                name="hargaAsli[]"></td>
                                    </tr>

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
                                            <input type="checkbox" id="provinsi{{ $provinsi->id }}" name="provinsi[]"
                                                value="{{ $provinsi->id }}">
                                            <label for="provinsi{{ $provinsi->id }}"> {{ $provinsi->nama }}</label>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Deskripsi</label>
                                <input id="x" type="hidden" required name="keterangan">
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
