@extends('layouts.navUser')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div id="upload-pembayaran" class="col-12 bg-primary d-flex flex-column align-items-center justify-content-center"
                style="height: 200px">
                <span class="text-white text-center col-12">Inovice Pambayaran </span>
                <span class=" d-inline col-10 col-md-8 col-lg-6 text-center btn btn-warning"> <b>@currency($pesanan->jumlah * $pesanan->produk->harga)</b></span>
            </div>
            <form action="/upload-verifikasi-pembayaran" method="post" class="m-5" enctype="multipart/form-data">
                <h3>Upload Slip Pembayaran</h3>
                <p>ketentuan Slip Pembayaran</p>
                <ol>
                    <li>Terdapat keterangan "Berhasil"</li>
                    <li>Memasukan Nominal Yang Sama Sesuai Dengan Pesanan</li>
                    <li>Tambahkan Nomer Pesanan (optional)</li>
                    <li>Contoh <!-- Button trigger modal -->
                        <span type="button" class="nav-link text-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            klik
                        </span>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Contoh Slip Pembayaran</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                         <img width="100%" src="{{ env('APP_URL') . '/file?file=' . encrypt('Anonymous.png') }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
                @csrf

                @if ($pesanan->resi =='ditolak')
                <div class="col-12 col-md-8 col-lg-6">
                    @if ($pesanan->konfirmasiPembayaran)
                    <img width="100%" id="imagePreview" src="{{ env('APP_URL').'/file?file='.encrypt($pesanan->konfirmasiPembayaran->bukti_transaksi) }}" alt="">
                    <span class="text-danger">*Bukti Pembayaran Anda Tidak Valid dan data transaksi tidak ada di rekening penerima. Silahkan Perbaharui dengan Bukti yang valid</span>
                   @else
                   <img width="100%" id="imagePreview" src="" alt="">
                   <span class="text-danger">*Silahakan Upload Slip Transaksi</span>
                    @endif
                   
                </div>
                @else
                <div class="col-12 col-md-8 col-lg-6">
                <img width="100%" id="imagePreview" src="" alt="">
                </div>
                @endif
                <div class="input-group">
                    <input type="file" onchange="previewImage(event)" accept="image/*" name="form-pembayaran" id="form-pembayaran" class="form-control">
                    <input type="hidden"  name="pesanan" value="{{ encrypt($pesanan->id) }}">
                    <button class="btn btn-primary"
                        onclick="return confirm('Pastikan Slip Transaksi Valid Sebelum Dikirim')"
                        type="submit">Kirim</button>
                </div>

            </form>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            CR CODE
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex flex-column justify-content-center">
                            <img width="60%" src="{{ env('APP_URL') . '/file?file=' . encrypt('qris.png') }}"
                                alt="">
                            <div>
                                <button onclick="download('{{encrypt('qris.png') }}')" class="btn btn-primary m-3">Download Qris Pembayaran</button>
                                <p>Cara Melakukan Pembayaran</p>
                                <ol>
                                    <li>Download Gambar Qris</li>
                                    <li>Buka Aplikasi Mbanking</li>
                                    <li>Masuk ke pembayaran Qris</li>
                                    <li>Pilih Qris dari galeri</li>
                                    <li>Masukan Nominal Pembayaran Sesuai Pesanan</li>
                                    <li>Konfirmasi Transfer</li>
                                    <li>Upload Bukti Pembayaran di <a href="#upload-pembayaran">Sini</a></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Bank Transfer Mbanking
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <span>Nomer Rekening <span class="badge bg-primary text-white" id="norek">5859459400992029</span></span>
                            <button onclick="salin()" class="btn btn-secondary">Salin</button><br>
                            <span>Nama Penerima <span class="badge bg-primary text-white">Mval</span></span> <br>
                            <div>
                                <p>Cara Melakukan Pembayaran</p>
                                <ol>
                                    <li>Buka Aplikasi Mbanking</li>
                                    <li>Masuk ke Menu transfer</li>
                                    <li>Masukan Nomer Rekening Penerima</li>
                                    <li>Pilih bank penerima sebagai "Bank Neo Commerse"</li>
                                    <li>Tambahkan nomor pesanan(optional)</li>
                                    <li>Masukan Nominal Pembayaran Sesuai Nominal Pesanan</li>
                                    <li>Upload Bukti Pembayaran di <a href="#upload-pembayaran">Sini</a></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTree" aria-expanded="false" aria-controls="collapseTwo">
                            ATM
                        </button>
                    </h2>
                    <div id="collapseTree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <span>Nomer Rekening <span class="badge bg-primary text-white">5859459400992029</span></span>
                            <button>Salin</button><br>
                            <span>Nama Penerima <span class="badge bg-primary text-white">Mval</span></span> <br>
                            <div>
                                <p>Cara Melakukan Pembayaran</p>
                                <ol>
                                    <li>Masukan Kartu ATM</li>
                                    <li>Masukan Pin ATM</li>
                                    <li>Masukan kode bank Penerima lalu diikuti nomer rekening</li>
                                    <li>Kode Bank Neo Commerse adalah <b>490</b></li>
                                    <li>Masukan no referensi sesuai nomer pesanan (optional) </li>
                                    <li>Masukan Nominal Pembayaran Sesuai Nominal Pesanan</li>
                                    <li>Upload Bukti Pembayaran di <a href="#upload-pembayaran">Sini</a></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">



    </script>
    <script>

function download(filename) {
           
           const url = `/download-qris?file=${filename}`;
           console.log(url)
           fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob();
    })
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = "QRis Myshop"; // Nama file yang akan diunduh
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to download file');
    });
       }

       function salin(){
        const text = document.getElementById('norek').innerText;
        navigator.clipboard.writeText(text).then(() => {
        alert('Behasil Di salin');
    }).catch(err => {
        alert('gagal Menyalin');
    });
       }

       function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result; // Set preview source
                    // preview.classList.remove('d-none'); // Tampilkan gambar
                };
                reader.readAsDataURL(input.files[0]); // Baca file sebagai Data URL
            } else {
                preview.src = ''; // Kosongkan preview
                preview.classList.add('d-none'); // Sembunyikan gambar
            }
        }
    </script>
@endsection
