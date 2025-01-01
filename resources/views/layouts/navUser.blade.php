<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script type="text/javascript" src="{{ env('MIDTRANS_SCRIPT_URL') }}"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("button#kategory").click(function() {
                $("section#kategory").animate({
                    height: 'toggle'
                });
            });
        });
    </script>
</head>

<body class="">
    <div class="bg-primary text-white text-decoration-none">
        <div class="col-12 p-2">
            <a href="https://profile.bagaswibisono.com" class=" text-white text-decoration-none">Tentang Kami</a>
        </div>

    </div>
    <!-- Header -->
    <header class="d-flex justify-content-between d-md-none">

        <div class=" col-4"><a class="text-dark text-decoration-none" href="/">MVAL</a> <button id="kategory"
                class=" btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-tags-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                    <path
                        d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z" />
                </svg></button></div>
        <div class=" col-8">

            <form action="/search" method="get" class="col-12">
                <div class="input-group">
                    <input type="text" placeholder="Cari" name="parameter" class="col-8">
                    <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></button>
                </div>

                @csrf
            </form>
        </div>
    </header>

    <header class="position-relative d-none d-md-flex ">
        <div class="logo"><a class="text-dark text-decoration-none" href="/">MVAL</a></div>
        <div class="nav position-relative col-4 col-md-8 ">

            <form action="/search" method="get">
                <div class="input-group mb-3">
                    <input type="text" placeholder="Cari" name="parameter" class="search-bar">
                    <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></button>
                </div>

                @csrf
            </form>
            <button id="kategory" class="round-btn">CATEGORY</button>
        </div>
        <div class="profile-icon d-none d-md-inline">
            @auth
                <div class="dropdown-center">
                    <button class="nav nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hello, {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/panel">Pesanan</a></li>
                        <li><a class="dropdown-item" href="/chat">Chat</a></li>
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </div>
            @endauth
            @guest
                <a class="btn text-white text-decoration-none btn-danger" href="/login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                        <path fill-rule="evenodd"
                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                    </svg>
                    Login</a>
            @endguest
        </div>

    </header>

    <section id="kategory" class="bg-white ms-3 me-3 " style="display: none">
        <div class="d-flex flex-wrap">
            @foreach ($kategorys as $kategori)
                <a class="btn m-1 text-black text-decoration-none"
                    href="/search?kategory={{ $kategori->name }}">{{ $kategori->name }}</a>
            @endforeach
        </div>

    </section>

    @yield('body')



    <!-- Bottom Navigation -->
    <div style="max-height: 50px;z-index:99999"
        class=" border-top border-1 border-dark fixed-bottom bg-light d-md-none">
        <div class="container-fluid">
            <ul style="list-style-type: none" class=" d-flex justify-content-around w-100">
                <li class="nav-item">
                    <a class="nav-link text-center" href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path
                                d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                        </svg><br>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="/panel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cart4" viewBox="0 0 16 16">
                            <path
                                d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                        </svg><br>
                        Cart
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="/profile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg><br>
                        Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <script src="/script.js"></script>

    <footer class="bg-light col-12">
        <div>
            <h5 class="d-block">Myshop</h5>
            <p>
                MyShop adalah platform e-commerce yang menyediakan berbagai macam produk berkualitas dengan fitur utama
                gratis ongkir untuk semua produk, sehingga Anda dapat berbelanja tanpa khawatir dengan biaya pengiriman.
                Selain itu, "MyShop" juga menawarkan diskon yang selalu ada untuk berbagai produk, memberikan kesempatan
                bagi pelanggan untuk mendapatkan harga lebih terjangkau. Kami berkomitmen untuk memberikan pengalaman
                berbelanja yang menyenangkan dan efisien dengan pilihan produk yang lengkap, mulai dari elektronik,
                pakaian, kesehatan, kecantikan, hingga kebutuhan sehari-hari. Dengan berbagai promo menarik dan layanan
                yang memudahkan, "MyShop" menjadi pilihan utama bagi Anda yang ingin berbelanja dengan harga terbaik
                tanpa batasan biaya pengiriman.
            </p>
        </div>

    </footer>
    <div class="m-3 d-flex flex-wrap">
        @foreach ($kategorys as $kategori)
            <a class="m-1 text-black text-decoration-none"
                href="/search?kategory={{ $kategori->name }}">#{{ $kategori->name }}</a>
        @endforeach
    </div>

    <footer class="card text-dark text-decoration-none m-2">
        <div class="col-12">
            <div class="row">
                <!-- Links Section -->
                <div class="col-md-4">
                    <h5>Tentang Kami</h5>
                    <ul class="list-unstyled">
                        <li><a href="/about-us" class="text-dark">Tentang Kami</a></li>
                        <li><a href="/faq" class="text-dark">FAQ</a></li>
                        <li><a href="/contact" class="text-dark">Kontak Kami</a></li>
                        <li><a href="/privacy-policy" class="text-dark">Kebijakan Privasi</a></li>
                        <li><a href="/terms-conditions" class="text-dark">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <!-- Social Media Section -->
                <div class="col-md-4">
                    <h5>Ikuti Kami</h5>
                    <ul class="list-unstyled d-flex">
                        <li class="m-3"><a href="https://facebook.com/myshop" target="_blank"
                                class="text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                </svg></a>
                        </li>
                        <li class="m-3"><a href="https://twitter.com/myshop" target="_blank"
                                class="text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path
                                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                                </svg></a>
                        </li>
                        <li class="m-3"><a href="https://instagram.com/myshop" target="_blank" class="text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                </svg></a>
                        </li>
                        <li class="m-3"><a href="https://youtube.com/myshop" target="_blank"
                                class="text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                    height="25" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                    <path
                                        d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                                </svg></a></li>
                    </ul>
                </div>

                <!-- Newsletter Section -->
                <div class="col-md-4">
                    <h5>Pelayanan</h5>
                    <ul style="list-style-type: none">
                        <li>Free Ongkir</li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col text-center">
                    <p>&copy; MyShop. Semua hak cipta dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
