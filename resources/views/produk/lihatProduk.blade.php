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
                        <p>Varian <br>
                            @foreach ($produk->varian as $varian)
                                <button class="badge bordered bg-success border-success">
                                    {{ $varian->nama }}
                                </button>
                            @endforeach
                        </p>

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
            <div class="container mt-5">
                <h2 class="mb-4">Product Reviews</h2>

                @if ($reviews->count() <= 0)
                    <h5 class="text-secondary">Belum Ada Review</h5>
                @endif

                @foreach ($reviews as $review)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="me-3">
                                    <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User" />
                                </div>
                                <div>
                                    <h5 class="card-title">{{ $review->user->name }}</h5>
                                    <p class="text-muted">{{ $review->created_at }}</p>
                                    @if ($review->mediaReview)
                                        <div class="d-flex" style="overflow: scroll">
                                            @foreach ($review->mediaReview as $m)
                                                <div class=" col-12 col-lg-2 col-md-6 m-1">
                                                    <img width="100%" src="{{ '/file?file=' . encrypt($m->file) }}"
                                                        alt="">
                                                </div>
                                            @endforeach

                                        </div>
                                        dd
                                    @endif
                                    <div class="d-flex">
                                        <span class="star @if ($review->bintang >= '1') selected @endif "
                                            data-value="1">&#9733;</span>
                                        <span class="star @if ($review->bintang >= '2') selected @endif"
                                            data-value="2">&#9733;</span>
                                        <span class="star @if ($review->bintang >= '3') selected @endif"
                                            data-value="3">&#9733;</span>
                                        <span class="star @if ($review->bintang >= '4') selected @endif"
                                            data-value="4">&#9733;</span>
                                        <span class="star @if ($review->bintang >= '5') selected @endif"
                                            data-value="5">&#9733;</span>
                                    </div>
                                    <p class="card-text mt-2">{{ $review->hasil }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $reviews->links() }}
                </div>


            </div>

            <div>

                <section class="trending">
                    <h5>Kategory Sama</h5>
                    <div class="d-flex flex-wrap">
                        @foreach ($produkSerupa as $foryou)
                            <div class="product-item col-5 m-2 col-sm-4 col-md-3 col-xl-2  me-sm- m-md-2 position-relative "
                                style="min-height: 380px">
                                <div class="productk-detail position-relative">
                                    <span style="width: 30px; height:30px"
                                        class="d-flex align-items-center justify-content-center position-absolute p-1 top-0 mt-1 me-1 end-0 rounded-5 bg-white ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                    </span>
                                    <img onerror="this.src='{{ env('APP_URL') . '/file?file=' . encrypt('depositphotos_247872612-stock-illustration-no-image-available-icon-vector.webp') }}';"
                                        src="{{ env('APP_URL') . '/file?file=' . encrypt($foryou->media[0]->file) }}"
                                        alt="">
                                    <div class="position-relative p-2">
                                        <div class="mt-2 me-2"> <a
                                                href="{{ route('detail.produk', ['slug' => Str::slug($foryou->nama), 'data' => Crypt::encrypt(['id' => encrypt($foryou->id), 'nama' => $foryou->nama])]) }}"
                                                class="text-dark text-decoration-none">
                                                {{ Str::limit($foryou->nama, 35, '...') }}</a></div>
                                        <div class="position-absolute top-50 end-0 translate-top me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                            </svg>
                                        </div>
                                    </div>
                                    <small class="p-2"> <span class="text-success"> Terjual</span>
                                        {{ $foryou->id + 321 }}</small>
                                    <p class="p-2">@currency($foryou->harga)</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="/checkout?produk={{ encrypt($foryou->id) }}"
                                            class=" btn btn-dark rounded-5 text-center text-white">Beli Sekarang</a>
                                    </div>

                                </div>
                            </div>
                        @endforeach


                    </div>
                </section>

                <div class="d-flex justify-content-center">
                    <a class="btn btn-light m-4 bordered border border-primary"
                        href="/search?kategory={{ $produk->kategory->name }}">Tampilkan Lebih</a>
                </div>
            </div>

        </div>
        <input type="hidden" id="produk" value="{{ $produk->id }}">


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
    </div>
    @endsection
