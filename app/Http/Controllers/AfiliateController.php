<?php

namespace App\Http\Controllers;

use App\Models\mediaAfiliate;
use App\Models\platformAfiliate;
use App\Models\produkAfiliate;
use App\Models\produkAfiliate_mediaAfiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AfiliateController extends Controller
{
    function indexPlatform(Request $request) {
        $platform = platformAfiliate::orderBy('created_at', 'DESC')->get();
        return view('afiliate.indexPlatform',[
            'platforms'=>$platform
        ]);
    }

    function storePlatform(Request $request) {
        $request->validate([
            'namaPlatform'=>['required'],
            'linkPlatform'=>['required'],
            'logoPlatform'=>['required'],
        ]);

        platformAfiliate::create([
            'name'=>$request->namaPlatform,
            'link'=>$request->linkPlatform,
            'logo'=>$request->logoPlatform
        ]);
      return back()->with('berhasil', 'Platform Berhasil Ditambah');
    }

    function editPlatform($id)  {
        $decrypt_id = decrypt($id);
        return view('afiliate.editPlatform',[
            'platform'=>platformAfiliate::find($decrypt_id)
        ]);
    }

    function updatePlatform($id, Request $request)  {
        $request->validate([
            'namaPlatform'=>['required'],
            'linkPlatform'=>['required'],
            'logoPlatform'=>['required'],
        ]);

        platformAfiliate::find(decrypt($id))->update([
            'name'=>$request->namaPlatform,
            'link'=>$request->linkPlatform,
            'logo'=>$request->logoPlatform
        ]);
      return redirect(env('APP_URL').'/platform-afiliate')->with('berhasil', 'Platform Berhasil Diupdate');
    }

    function deletePlatform($id)  {
      $cek = produkAfiliate::where('platformAfiliate_id',decrypt($id) )->count();
      if($cek == 0){
        platformAfiliate::find(decrypt($id))->delete();
        return back()->with('berhasil', 'Platform Afiliate Berhasil Dihapus');
      }
      else{
        return back()->with('gagal', 'Platform Afiliate Memiliki Relasi, Tidak Bisa Dihapus');
      }

     
    }







    function indexProduk(Request $request){
        $platforms = platformAfiliate::orderby('name', 'DESC')->get();
      
        return view('afiliate.indexProduk',[
            'platforms'=>$platforms,
            'produks'=>produkAfiliate::orderby('updated_at', 'DESC')->paginate(30)
        ]);
    }

    function storeProduk(Request $request){
        // dd($request);
        $request->validate([
            'platformAfiliateId'=>['required'],
            'namaProduk'=>['required',],
            'hargaProduk'=>['required'],
            'penjualanProduk'=>['required'],
            'linkProduk'=>['required'],
            'linkKomisiEkstra'=>['required'],
        ]);
      

       $masukanData =  produkAfiliate::create([
            'platformAfiliate_id'=> decrypt($request->platformAfiliateId) ,
            'nama'=>$request->namaProduk,
            'slug'=> Str::slug($request->namaProduk),
            'harga'=>$request->hargaProduk,
            'penjualan'=>$request->penjualanProduk,
            'link_produk'=>$request->linkProduk,
            'link_komisi_ekstra'=>$request->linkKomisiEkstra
        ]);

        produkAfiliate_mediaAfiliate::create([
            'produk_afiliate_id'=>$masukanData->id,
            'media_afiliate_id'=>'1'
        ]);


        return back()->with('berhasil', 'Berhasil Menambahkan Produk Afiliate');

    }
    function deleteProduk($id) {
        $encrypt = decrypt($id);
       
        produkAfiliate::find($encrypt)->delete();

        return back()->with('berhasil', 'Data Produk Afiliate Berhasil Dihapus');
    }

    function updateProduk($id) {
        $platforms = platformAfiliate::orderby('name', 'DESC')->get();
        return view('afiliate.updateProduk',[
            'platforms'=>$platforms,
            'produk'=>produkAfiliate::find(decrypt($id))
        ]);
    }

    function hapusFotoProduk(Request $request)  {
        $id = decrypt($request->id);
        if($id = 1 ){
            return back()->with('gagal', ' Foto Default Tidak dapat Dihapus');
        }
        $media = mediaAfiliate::find($id);
        $filePath = storage_path('app/public/' . $media->file);
        if (File::exists($filePath)) {
            File::delete($filePath);
            mediaAfiliate::find($media->id)->delete();
        }

        return back()->with('berhasil', 'Berhasil Menghapus Data');
    }

    function tambahFotoProduk(Request $request)  {
       
         //simpan Media
         if ($request->file('media')) {
            foreach ($request->file('media') as $media) {
             $idmedia =   mediaAfiliate::create([
                    'file' => $media->store('media_afiliate', 'public'),
                ]);

                produkAfiliate_mediaAfiliate::create([
                    'produk_afiliate_id'=>$request->produk_id,
                    'media_afiliate_id'=> $idmedia->id
                ]);

            }

            return back()->with('berhasil', 'Media Berhasil Ditambah');
        }

        return back()->with('gagal', 'Tidak Ada Media');
    }

    function prosesUpdateProduk($id, Request $request) {
      
        $request->validate([
            'platformAfiliateId'=>['required'],
            'namaProduk'=>['required',],
            'hargaProduk'=>['required'],
            'penjualanProduk'=>['required'],
            'linkProduk'=>['required'],
            'linkKomisiEkstra'=>['required'],
        ]);
      

       $masukanData =  produkAfiliate::find(decrypt($id))->update([
            'platformAfiliate_id'=> decrypt($request->platformAfiliateId) ,
            'nama'=>$request->namaProduk,
            'slug'=> Str::slug($request->namaProduk),
            'harga'=>$request->hargaProduk,
            'penjualan'=>$request->penjualanProduk,
            'link_produk'=>$request->linkProduk,
            'link_komisi_ekstra'=>$request->linkKomisiEkstra
        ]);

     


        return back()->with('berhasil', 'Berhasil Update Produk Afiliate');
    }
    function viewImport()  {
        return view('afiliate.import',[
            'platforms'=>platformAfiliate::all()
        ]);
    }
}
