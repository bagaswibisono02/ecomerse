@extends('layouts.navUser')
@section('body')
      <!-- Main Content -->
      <main>
    
        <section class="trending">
            <h5>Pencarian</h5>
            @if ($produks->count()==0)
                <p class="text-center text-secondary">Produk Tidak Ditemukan, Kami Akan Segera Menambahkan Produk Yang Anda Cari</p>
            @else
            <div class="d-flex flex-wrap ">
                @foreach ($produks as $foryou)
                <div class=" col-5 product-item position-relative m-2" style="min-height: 380px">
                    <div class="productk-detail position-relative">
                        <span style="width: 30px; height:30px" class="d-flex align-items-center justify-content-center position-absolute p-1 top-0 mt-1 me-1 end-0 rounded-5 bg-white ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                              </svg>
                        </span>
                        <img src="{{ env('APP_URL')."/file?file=".encrypt($foryou->media[0]->file) }}" alt="">
                        <div class="position-relative p-2">
                            <div class="mt-2 me-2" > <a href="{{ route('detail.produk', ['data' => Crypt::encrypt(['id' => encrypt($foryou->id) , 'nama' => $foryou->nama])]) }}" class="text-dark text-decoration-none"> {{ Str::limit($foryou->nama, 35, '...')  }}</a></div>
                            <div class="position-absolute top-50 end-0 translate-top me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                  </svg>
                            </div>
                        </div>
                        <small class="p-2"> <span class="text-success"> Terjual</span> {{ $foryou->id + 321 }}</small>
                        <p class="p-2">@currency($foryou->harga)</p>
                        <div class="d-flex justify-content-center">
                            <button class=" btn btn-dark rounded-5 text-center text-white">Beli Sekarang</button>
                        </div>
                       
                    </div>
                </div>
                @endforeach
           
             
            </div>
            @endif
           
        </section>
    </main>


@endsection