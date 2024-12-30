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
    <script type="text/javascript" src="{{ env('MIDTRANS_SCRIPT_URL') }}" data-client-key="{{ env("MIDTRANS_CLIENT_KEY") }}"></script>
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
      
        <div class=" col-4"><a class="text-dark text-decoration-none" href="/">MVAL</a> <button id="kategory" class=" btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
            <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
            <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z"/>
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
{{-- 
            @foreach ($afiliasi as $afil)
                <a class=" {{ request()->is('shopee*') ? 'text-primary' : 'text-dark' }} nav-link  text-decoration-none" href="/shopee?param={{ encrypt($afil->id) }}">Di {{ $afil->name }}</a>
            @endforeach --}}
        </div>
        <div class="profile-icon d-none d-md-inline">
            @auth
                <a class=" btn text-white text-decoration-none btn-danger" href="/panel">
                    Hello, {{ Auth::user()->name }}</a>
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
    <div style="max-height: 50px;z-index:99999" class=" border-top border-1 border-dark fixed-bottom bg-light d-md-none">
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
</body>

</html>
