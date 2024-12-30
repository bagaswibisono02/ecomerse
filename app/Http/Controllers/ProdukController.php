<?php

namespace App\Http\Controllers;

use App\Models\free_ongkir;
use App\Models\kategory;
use App\Models\media_produk;
use App\Models\produk;
use App\Models\produk_user;
use App\Models\provinsi;
use App\Models\supplier;
use App\Models\varian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('produk.index', [
            'produks' => produk::orderBy('created_at','desc')->paginate(50),
            'kategory' => kategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create', [
            'kategoryes' => kategory::orderBy('name', 'ASC')->get(),
            'provinsis' => provinsi::orderBy('nama', 'ASC')->get(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'category_id' => 'required',
            'keterangan' => 'required',
            'harga' => 'required',
            'media' => 'required',
            'link' => 'required',
            'harga' => 'required',
        ]);

        $produk = produk::create([
            'kategory_id' => $request->category_id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'harga' => $request->harga,
        ]);

        //masukan supplier
        if ($request->link) {
            for ($x = 0; $x < count($request->link); $x++) {
                supplier::create([
                    'produk_id' => $produk->id,
                    'supplier' => $request->link[$x],
                    'harga' => $request->hargaAsli[$x],
                ]);
            }
        }

        // masukan daerah gratis ongkir
        if ($request->link) {
            for ($x = 0; $x < count($request->link); $x++) {
                free_ongkir::create([
                    'produk_id' => $produk->id,
                    'daerah_id' => $request->provinsi[$x],
                ]);
            }
        }

        //simpan Media
        if ($request->file('media')) {
            foreach ($request->file('media') as $media) {
                media_produk::create([
                    'produk_id' => intval($produk->id),
                    'file' => $media->store('media_produk', 'public'),
                ]);

            }
        }

        //simpan Varian
        if ($request->datavarian) {
            for ($x = 0; $x < count($request->datavarian); $x++) {
                varian::create([
                    'produk_id' => $produk->id,
                    'nama' => $request->datavarian[$x],
                ]);
            }
        }

        return redirect('/produk')->with('berhasil', 'Produk Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($produk)
    {
        $id = decrypt($produk);

        return view('produk.show', [
            'produk' => produk::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($produk)
    {
        $id = decrypt($produk);

        return view('produk.edit', [
            'produk' => produk::find($id),
            'kategoryes' => kategory::orderBy('name', 'ASC')->get(),
            'provinsis' => provinsi::orderBy('nama', 'ASC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $produk)
    {
       

        $idProduk = decrypt($produk);
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'category_id' => 'required',
            'keterangan' => 'required',
            'harga' => 'required',
        ]);

 

        // dd($request->hargaAsli, produk::find($idProduk)->supplier->pluck('harga')->toArray());

        //update produk
        produk::find($idProduk)->update([
            'kategory_id' => $request->category_id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'harga' => $request->harga,
        ]);

        //update supplier
        //cek perubahan supplier
        $supplierLama = produk::find($idProduk)->supplier->pluck('supplier')->toArray();
        $supplierBaru = $request->link;
        $hargaLama = produk::find($idProduk)->supplier->pluck('harga')->toArray();
        $hargaBaru = $request->hargaAsli;
        if ($supplierBaru) {

            if (array_diff($supplierLama, $supplierBaru) || array_diff($hargaLama, $hargaBaru)) {
                supplier::where('produk_id', $idProduk)->delete();
                for ($x = 0; $x < count($request->link); $x++) {

                    if ($request->link[$x] != null) {
                        supplier::create([
                            'produk_id' => $idProduk,
                            'supplier' => $request->link[$x],
                            'harga' => $request->hargaAsli[$x],
                        ]);
                    }

                }
            } elseif (count($supplierLama) == 0) {
                for ($x = 0; $x < count($request->link); $x++) {

                    if ($request->link[$x] != null) {
                        supplier::create([
                            'produk_id' => $idProduk,
                            'supplier' => $request->link[$x],
                            'harga' => $request->hargaAsli[$x],
                        ]);
                    }

                }
            }
        }

        // update daerah gratis ongkir

        $daerahLama = produk::find($idProduk)->provinsi->pluck('id')->toArray();
        $daerahBaru = $request->provinsi;
        if (array_diff($daerahLama, $daerahBaru)) {
            free_ongkir::where('produk_id', $idProduk)->delete();
            for ($x = 0; $x < count($request->provinsi); $x++) {
                free_ongkir::create([
                    'produk_id' => $idProduk,
                    'daerah_id' => $request->provinsi[$x],
                ]);
            }
        } else if (count($daerahLama) == 0) {
            for ($x = 0; $x < count($request->provinsi); $x++) {
                free_ongkir::create([
                    'produk_id' => $idProduk,
                    'daerah_id' => $request->provinsi[$x],
                ]);
            }
        }

        //jika ada foto baru masukan
        if ($request->file('media')) {
            foreach ($request->file('media') as $media) {
                media_produk::create([
                    'produk_id' => intval($idProduk),
                    'file' => $media->store('media_produk', 'public'),
                ]);

            }
        }

        //tambah varian di update 
       if($request->datavarian){
         //simpan Varian
         if ($request->datavarian) {
            for ($x = 0; $x < count($request->datavarian); $x++) {
                varian::create([
                    'produk_id' =>$idProduk,
                    'nama' => $request->datavarian[$x],
                ]);
            }
        }
       }

        return back()->with('berhasil', 'Berhasil Update Produk');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($produk)
    {
        $id = decrypt($produk);
        $produk = produk::find($id);

        // hapus foto terkait
        foreach ($produk->media as $media) {
            $filePath = storage_path('app/public/' . $media->file);
            if (File::exists($filePath)) {
                File::delete($filePath);
                media_produk::find($media->id)->delete();
            }
        }
        // hapus produk
        $cek = $produk->delete();
        if ($cek) {
            return redirect('/produk')->with('berhasil', 'Produk Dan Foto Berhasil Dihapus');
        } else {
            return redirect('/produk')->with('gagal', 'Produk Dan Foto gagal Dihapus');
        }

    }

    public function hapusFotoProduk(Request $request)
    {
        $id = decrypt($request->id);
        // Nama file yang akan dihapus
        $filePath = storage_path('app/public/' . media_produk::find($id)->file);

// Cek apakah file ada
        if (File::exists($filePath)) {
            // Hapus file
            File::delete($filePath);
            media_produk::find($id)->delete();

            return back();
        } else {
            return back()->with('gagal', 'File Tidak Ditemukan');
        }
    }

    public function lihatProduk(Request $request)
    {

        $data = decrypt($request->data);
        $encrypted_id = $data['id'];
        $produk_id = decrypt($encrypted_id);

        if (Auth::check()) {
            $cekLihatBelum = produk_user::where('user_id', Auth::User()->id)->where('produk_id', $produk_id)->first();

            if ($cekLihatBelum) {
                $angka = $cekLihatBelum->times + 1;

                $cekLihatBelum->update([
                    'times' => $angka,
                ]);

            } else {
                produk_user::create([
                    'user_id' => Auth::User()->id,
                    'produk_id' => $produk_id,
                    'times' => "1",

                ]);
            }

        }
        return view('produk.lihatProduk', [
            'produk' => produk::find($produk_id),
            'kategorys' => kategory::all(),
        ]);
    }

    function hapusVarian($id) {
        $id_varian = decrypt($id);

        varian::find($id_varian)->delete();
        return back();
    }
}
