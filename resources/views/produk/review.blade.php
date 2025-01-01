@extends('layouts.navUser')
@section('body')
    <!-- Main Content -->

    <main class="">

        <div class="container mt-5">
            <h2 class="mb-4">Product Reviews</h2>

            <!-- Review Section -->
            @foreach ($pesanans as $pesanan)
                <div class="order-card card p-2" id="pesanandetail">
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

                    </div>
                </div>

                <hr class="m">
            @endforeach

            <!-- Review Submission Form (Visible after order received) -->
            <div class="card">
                <div class="card-header">
                    <strong>Submit Your Review</strong>
                </div>
                <div class="card-body">
                    <!-- Check if the order is received to enable the review form -->
                    <!-- Example: Assuming order status is received, so the form is enabled. -->
                    <form autocomplete="off"
                        @if (request()->get('review')) action="/submit-review/{{ request()->get('review') }}/edit"
                         @else
                         action="/submit-review" @endif
                        id="inputHidden" method="POST" enctype="multipart/form-data">
                        <!-- Star Rating -->
                        @csrf
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="stars">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <span id="errorMessage" style="display:none" class="text-danger">Pilih Rating Terlebih
                                Dahulu</span>
    

                                <input type="hidden" value="{{$pesanan->review->bintang}}" name="rating" id="ratingValue"
                                required>
                            <input type="hidden" name="pesanan" value="{{ request()->get('keranjang') }}">
                            <div class="bg-light m2 d-flex flex-wrap" id="filePreviewContainer">

                                <div id="filePreview" class="costum-div d-flex flex-wrap">
                                    @if (request()->get('review'))
                                        @foreach ($pesanan->review->mediaReview as $item)
                                            <img src="/file?file={{ encrypt($item->file) }}" alt="" srcset="">
                                        @endforeach
                                    @endif

                                </div>

                            </div>
                            <input type="file" onchange="previewFiles()" id="fileInput" class="form-control" multiple
                                accept="image/*" name="fotoReview[]">
                        </div>

                        <!-- Review Text -->
                        <div class="mb-3">
                            <label for="review" class="form-label">Write Your Review</label>
                            <textarea class="form-control" id="review" name="review" rows="3" placeholder="Enter your review here"
                                required> @if (request()->get('review'))
@foreach ($pesanans as $pesanan)
{{ $pesanan->review->hasil }}
@endforeach
@endif
</textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>

        </div>

        <script>
            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');

                    // Reset all stars
                    stars.forEach(star => star.classList.remove('selected'));
                    document.getElementById('ratingValue').value = value
                    // Set the selected stars
                    for (let i = 0; i < value; i++) {
                        stars[i].classList.add('selected');
                    }
                });
            });

            document.getElementById("inputHidden").addEventListener("submit", function(e) {
                const hiddenInput = document.getElementById("ratingValue").value;
                const errorMessage = document.getElementById("errorMessage");

                if (!hiddenInput) {
                    e.preventDefault(); // Mencegah pengiriman form
                    errorMessage.style.display = "inline"; // Tampilkan pesan error
                } else {
                    errorMessage.style.display = "none";

                }
            });

            window.addEventListener('load', function() {
                // Ambil semua elemen dengan class 'star'
                const stars = document.querySelectorAll('.star');
                let data = document.getElementById('ratingValue').value 
                // Tambahkan class 'selected' ke masing-masing elemen
                stars.forEach(star => {
                    const value = star.getAttribute('data-value');
                 
                   
                    if (value <= data) {
                        star.classList.add('selected');
                    }
                });

            });
        </script>
    </main>
@endsection
