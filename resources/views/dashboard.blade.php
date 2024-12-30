@extends('layouts.sidebar')
@section('content')
    <div class="container">
        <br>
        <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Kategori Teratas</h5>
                            <small class="text-muted"> {{ $kategoryes->count() }}  Kategori</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ $kategoryes->sum('dicari') }}</h2>
                                <span>Total Pencarian</span>
                            </div>
                          
                        </div>
                       
                        <ul class="p-0 m-0" style="max-height: 250px; overflow:scroll">
                            @foreach ($kategoryes as $k)
                            <li class="d-flex mb-4 pb-1 p-2">

                               
                                    
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $k->name }}</h6>
                                            <small class="text-muted">


                                            </small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $k->dicari }}</small>
                                        </div>
                                    </div>
                               

                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->

            {{-- searcing --}}
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Pencarian Teratas</h5>
                            <small class="text-muted"> {{ $pencarians->count() }}  Pencarian</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ $pencarians->count() }}</h2>
                                <span>Total Pencarian</span>
                            </div>
                          
                        </div>
                       
                        <ul class="p-0 m-0" style="max-height: 250px; overflow:scroll">
                            @foreach ($pencarians as $p)
                            <li class="d-flex mb-4 pb-1 p-2">

                               
                                    
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $p->parameter }}</h6>
                                            <small class="text-muted">


                                            </small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $k->created_at }}</small>
                                        </div>
                                    </div>
                               

                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Transactions</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0" style="max-height: 250px; overflow:scroll">
                            @foreach ($transaksis as $t)
                            @if ($t->jenis_transaksi =='masuk')
                            <li class="d-flex mb-4 pb-1">
                              
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                               
                                    <div class="user-progress text-success d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-success">@currency($t->nominal)</h6>
                                        <span class="text-muted">IDR</span>
                                    </div>
                                </div>
                            </li>
                            @else
                            <li class="d-flex mb-4 pb-1">
                           
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  
                                    <div class="text-danger user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0 text-danger">@currency($t->nominal)</h6>
                                        <span class="text-muted">IDR</span>
                                    </div>
                                </div>
                            </li>
                            @endif
                            
                            @endforeach
                      
               
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->
        </div>

    </div>
@endsection
