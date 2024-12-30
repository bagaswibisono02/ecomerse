@extends('layouts.navUser')
@section('body')
    <script>
        $(document).ready(function() {

            $("button#kerajang").click(function() {
                console.log('keranjang')
            })


        });
    </script>
    <!-- Detail Produk -->

    <div class="container  mt-4">
        <div id="berhasil" class="d-none">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="" id="pesanberhasil">Pesanan Berhasil Dimasukan Keranjang</div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div id="ada" class="d-none">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="" id="pesanberhasil">Pesanan Sudah Ada Dalam Keranjang</div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div id="gagal" class="d-none">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="text-dark" id="pesangagal">Error Silahkan Login Terlebih Dahulu</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div class="row ">
            <!-- Gambar Produk -->
            <div class="col-12 border border-none border-md-secondary row bg-light">
                <div class=" col-12 col-md-6 col-lg-4">
                    <div class="foto col-12 row flex-row flex-nowrap " id="filePreviewContainer" style="overflow-x: scroll">
                        @foreach ($produk->media as $media)
                            <div class="" style="width: 400px:height:auto">
                                <img class="" src="{{ env('APP_URL') . '/file?file=' . encrypt($media->file) }}"
                                    width="100%" height="auto" style="overflow: hidden" alt="">
                            </div>
                        @endforeach
                    </div>
                    <div id="tombol" class="d-flex m-2  justify-content-center">
                        <div class="d-flex">
                            <button id="scrollLeft" class="btn btn-light" onclick="scrollLeftBtn()">&#10094;</button>
                            <button id="scrollRight" class="btn btn-light" onclick="scrollRightBtn()">&#10095;</button>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Produk -->
                <div class=" col-12 col-md-6 col-lg-8  mt-4">
                    <div>
                        <h2>{{ $produk->nama }}</h2>
                        <p class="text-muted">Kategori: {{ $produk->kategory->name }}</p>
                        <p>Varian <br>   @foreach ($produk->varian as $varian)
                            <button class="badge bordered bg-success border-success">
                                {{ $varian->nama }}
                            </button>
                        @endforeach</p>
                     
                        <small>
                            {{-- <del class="text-secondary"> @currency($produk->harga)</del> --}}
                        </small>
                        <h4 class="text-danger">
                            @currency($produk->harga)
                        </h4>
                        <small>
                            <img width="50px"
                                src="https://images.tokopedia.net/img/cache/700/VqbcmM/2022/2/22/682b7c8a-6a43-4c9a-a0ef-92d221af7fb9.jpg"
                                alt=""> Gratis Ongkir
                        </small>
                        <p>Daerah Gratis Ongkir : Semarang, Bandung, Jakarta</p>

                    </div>


                    <div>
                        <div class="">
                            <button onclick="keranjang('{{ encrypt($produk->id) }}')" id="keranjang"
                                class="btn bodered border border-success border-2">Masukan
                                Kerajang</button>
                            <a href="/checkout?produk={{ encrypt($produk->id) }}" class="btn btn-danger text-white ">Pesan
                                Sekarang</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

            <hr>


            <!-- Informasi Tambahan -->
            <div class="row mt-2">
                <div class="bg-white col-12">
                    <h5>Detail Produk</h5>
                    <div class="bg-white">
                        {!! $produk->keterangan !!}
                    </div>
                </div>
            </div>

        </div>
        <input type="hidden" id="produk" value="{{ $produk->id }}">

        {{-- <div class="bg-white mt-3">
            <h5>Review Product</h5>
            <div>
                <div class="d-flex align-items-center">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/002/387/693/small_2x/user-profile-icon-free-vector.jpg"
                        class="rounded-circle" alt="Circular Image" style="width: 30px; height: 30px;">
                    <h6 class="my-auto">Sinta Dika</h6>
                    
                </div>
                <p>
                    bahsgaga aksja
                </p>
                <div class="d-flex flex-wrap">
                    @foreach ($produk->media as $media)
                        <div class="col-1">
                            <img width="60px" src="{{ env('APP_URL') . '/file?file=' . encrypt($media->file) }}"
                                alt="">
                        </div>

                    @endforeach
                </div>
            </div>
        </div> --}}

        <script src="/script.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function keranjang(produk) {


                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {

                    // produk = document.getElementById("produk").value
                    console.log(produk)
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == true) {
                            document.getElementById("berhasil").classList.remove('d-none')
                            // document.getElementById("pesanberhasil").innerHTML = this.responseTex
                        } else if (this.responseText == 'ada') {
                            document.getElementById("ada").classList.remove('d-none')
                        } else {
                            // document.getElementById("pesangagal").innerHTML = this.responseText
                            document.getElementById("gagal").classList.remove('d-none')
                        }
                    }
                };
                xmlhttp.open("GET", "/masukan-keranjang?produk=" + produk, true);
                xmlhttp.send();

            }
        </script>
    @endsection
