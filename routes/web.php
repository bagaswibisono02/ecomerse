<?php

use App\Http\Controllers\AfiliateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\KategoryController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\PengirimanController;

Route::get('/admin', [mainController::class ,'login']);
Route::get('/logout', [mainController::class ,'logout']);
Route::post('/login', [mainController::class ,'prosesLogin']);
Route::get('/dashboard', [mainController::class ,'dashboard'])->middleware(['auth','admin']);
Route::resource('/produk',ProdukController::class);
Route::resource('/kategori',kategoryController::class);
Route::resource('/penerima',PenerimaController::class);
Route::resource('/pesanan',PesananController::class);
Route::resource('/keuangan',KeuanganController::class);
Route::resource('/supplier',SupplierController::class);

//file
Route::get('/file', [mainController::class ,'getfile']); //get file
Route::get('/download-qris', [mainController::class ,'downloadQris']); //dwonload qris
Route::post('/upload-verifikasi-pembayaran', [pesananController::class ,'uploadPembayaran']); //dwonload qris

Route::get('/varian/{id}', [ProdukController::class ,'hapusVarian']);
Route::post('/hapus-foto-produk', [ProdukController::class ,'hapusFotoProduk']);

//user
Route::get('/', [mainController::class ,'index']);
Route::get('/forgot-password', [mainController::class ,'forgotPassword']);
Route::post('/forgot-password', [mainController::class ,'kirimEmail']);
Route::get('/search', [mainController::class ,'search']);
Route::get('/lihat-pesanan', [PesananController::class ,'detailPesanan'])->middleware(['auth']);
Route::get('/logout', [mainController::class ,'logout'])->middleware(['auth']);
Route::get('/pembayaran', [PesananController::class ,'pembayaran'])->middleware(['auth']);
Route::get('/masukan-keranjang', [mainController::class ,'masukanKeranjang'])->middleware(['auth']);
Route::get('/register', [mainController::class ,'registerUser']);
Route::post('/register', [mainController::class ,'prosesRegisterUser']);
Route::get('/login', [mainController::class ,'loginUser'])->name('login');
Route::get('/panel', [mainController::class ,'panel'])->middleware(['auth']);
Route::get('/detail-produk', [ProdukController::class ,'lihatProduk'])->name('detail.produk');
Route::get('/checkout', [PesananController::class ,'checkout'])->middleware("auth");
Route::Post('/checkout', [PesananController::class ,'createSnapToken'])->middleware(['auth']);
Route::get('/midtrans/notification', [midtransController::class ,'handleNotification']);
Route::get('/midtrans/notification/finish', [midtransController::class ,'finish']);
Route::get('/resi', [PesananController::class ,'resi'])->middleware(['auth']);
Route::post('/resi/{id}', [PesananController::class ,'tambahResi'])->middleware(['auth']);
Route::post('/resi/{id}/edit', [PesananController::class ,'editResi'])->middleware(['auth']);
Route::get('/supplier-pesan/{id}', [PesananController::class ,'pesanSupplier'])->middleware(['auth']);
Route::get('/profile', [mainController::class ,'profile'])->middleware(['auth']);
Route::post('/profile', [mainController::class ,'updateProfile'])->middleware(['auth']);

//api tempat
Route::get('/kab', [PengirimanController::class ,'kab']);
Route::get('/kec', [PengirimanController::class ,'kec']);
Route::get('/kel', [PengirimanController::class ,'kel']);
Route::get('/load-penerima', [PenerimaController::class ,'load']);

//PlatformAfiliate
Route::get('/platform-afiliate', [AfiliateController::class ,'indexPlatform']);
Route::post('/platform-afiliate', [AfiliateController::class ,'storePlatform']);
Route::get('/platform-afiliate/{id}/edit', [AfiliateController::class ,'editPlatform']);
Route::post('/platform-afiliate/{id}/update', [AfiliateController::class ,'updatePlatform']);
Route::post('/platform-afiliate/{id}/delete', [AfiliateController::class ,'deletePlatform']);

//produk afiliate
Route::get('/import-afiliate', [AfiliateController::class ,'viewImport']);
Route::get('/produk-afiliate', [AfiliateController::class ,'indexProduk']);
Route::post('/produk-afiliate', [AfiliateController::class ,'storeProduk']);
Route::post('/produk-afiliate/{id}/delete', [AfiliateController::class ,'deleteProduk']);
Route::get('/produk-afiliate/{id}/edit', [AfiliateController::class ,'updateProduk']);
Route::post('/hapus-foto-produkAfiliate', [AfiliateController::class ,'hapusFotoProduk']);
Route::post('/tambahFotoAfiliate', [AfiliateController::class ,'tambahFotoProduk']);
Route::post('/produk-afiliate/{id}/update', [AfiliateController::class ,'prosesUpdateProduk']);

//user shoope
Route::get('/shopee', [mainController::class ,'shopee']);
Route::get('/shopee/lihat', [mainController::class ,'lihatShopee']);
Route::post('/kirim-link', [mainController::class ,'kirimEmail']);
Route::get('/reset-password', [mainController::class ,'resetPassword']);
Route::post('/reset', [mainController::class ,'reset']);


//pesaan
Route::get('/terima', [PesananController::class ,'terima']);
Route::get('/tolak', [PesananController::class ,'tolak']);
Route::get('/lihatresi', [PesananController::class ,'lihatResi']);

// @if (Carbon::parse($pesanan->created_at)->diffInHours(now()) > 24 && $pesanan->status == 'tunggubayar')
// <form action="/hapuspesanan/{{ encrypt($pesanan->id) }}" method="post">
//     @csrf
//     <button class="btn btn-light border border-dark" type="submit"
//         onclick="return confirm('Yakin Ingin Menghapus Data Pesanan ? ')">Hapus</button>
// </form>
// @else
//   @endif