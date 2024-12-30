<?php

namespace App\Http\Controllers;

use App\Models\alamat_penerima;
use App\Models\kategory;
use App\Models\konfirmasiPembayaran;
use Carbon\Carbon;
use App\Models\pengiriman;
use App\Models\pesanan;
use App\Models\keuangan;
use App\Models\produk;
use App\Models\provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Midtrans\Config;

class PesananController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env("MIDTRANS_IS_SANITIZED");
        Config::$is3ds = env("MIDTRANS_IS_3DS");
    }

    public function createSnapToken(Request $request)
    {

        $request->validate([
            'penerima' => ['required'],
            'varian' => ['required'],
        ]);
        // Mendapatkan URL sebelumnya
        $previousUrl = url()->previous();

        if (strpos($previousUrl, 'keranjang')) {
            $pesanan_id = decrypt($request->keranjang);
            $pesanan = pesanan::find($pesanan_id);
            $produk = produk::find($pesanan->produk->id);
            $total = floatval($request->jumlahBeli) * floatval($pesanan->produk->harga);
            $qtty = $pesanan->jumlah;

            $pesanan->update([
                'alamat_penerima_id' => decrypt($request->penerima),
                'jumlah' => $request->jumlahBeli,
                'catatan' => $request->catatan,
                'varian' => $request->varian,
            ]);
            $id = $produk->id;
        } else {
            $id = decrypt($request->produk);
            $produk = produk::find($id);
            $total = floatval($produk->harga) * floatval($request->jumlahBeli);
            $masukan = pesanan::create([
                'user_id' => Auth::user()->id,
                'produk_id' => $id,
                'alamat_penerima_id' => decrypt($request->penerima),
                'jumlah' => $request->jumlahBeli,
                'catatan' => $request->catatan,
                'varian' => $request->varian,
                'status' => 'tunggubayar',
            ]);

            $pesanan_id = $masukan->id;
            $qtty = $request->jumlah;
        }

        /*Query ke api */
        // try {

        //     $params = array(
        //         'transaction_details' => array(
        //             'order_id' => $pesanan_id . '-' . time(),
        //             'gross_amount' => $total,
        //         ),
        //         // 'item_details' => array(
        //         //     'id' => $id,
        //         //     'price' => floatval($total),
        //         //     'quantity' => intval($qtty),
        //         //     'name' => $produk->nama,
        //         // ),
        //         'customer_details' => array(
        //             'first_name' => Auth::user()->name,
        //             'email' => Auth::user()->email,
        //             'phone' => Auth::user()->contact,
        //         ),
        //     );

        //     $snapToken = Snap::getSnapToken($params);
        //     pesanan::find($pesanan_id)->update([
        //         'snap_token' => $snapToken,
        //         'status' => 'tunggubayar',
        //     ]);

        //     $encrypt = encrypt($pesanan_id);

        //     return redirect('/pembayaran?keranjang=' . $encrypt);
        // } catch (\Exception $e) {
        //     return back()->with('error', $e->getMessage());
        // }

        return redirect('/pembayaran?keranjang=' . encrypt($pesanan_id));
    }
    public function checkout(Request $request)
    {

        if ($request->keranjang) {
            $id_pesanan = decrypt($request->keranjang);
            $keranjang = pesanan::find($id_pesanan);
            $produk = produk::find($keranjang->produk->id);
        } elseif ($request->produk) {
            $id_produk = decrypt($request->produk);
            $produk = produk::find($id_produk);
        } else {

            return back();
        }

        return view('produk.checkout', [
            'produk' => $produk,
            'penerimas' => alamat_penerima::where('user_id', Auth::User()->id)->with(['kelurahan.kecamatan.kab_kota.provinsi'])->get(),
            'kategorys' => kategory::all(),
            'provinsis' => provinsi::orderBy('nama', 'ASC')->get(),
        ]);
    }

    public function pembayaran(Request $request)
    {

        $pesanan = decrypt($request->keranjang);

        return view('produk.pembayaran', [
            'pesanan' => pesanan::find($pesanan),
            'kategorys' => kategory::all(),
        ]);
    }

    public function index(Request $request)
    {

        $pesanan = pesanan::FilterId(request()->query('query'))
            ->FilterStatus(request()->query('status'))
        // ->FilterTanggal(request()->query('start_date'),request()->query('end_date'))
            ->get();

        return view('pesanan.index', [
            'pesanans' => $pesanan,
        ]);
    }

    public function update(Request $request, $ids)
    {
        $id = decrypt($ids);
        $pesanan = pesanan::find($id);
        $this->pengiriman(intval($id), 'Diproses Penjual');
        $pesanan->update([
            'resi' => $request->resi,
            'link_beli' => $request->link_beli,
            'jasa_kirim' => $request->jasa_kirim,
        ]);
        return back()->with('berhasil', 'Berhasil Memasukan Resi');
    }

    public function detailPesanan(Request $request)
    {
        $keranjang = decrypt($request->keranjang);

        return view('pesanan.detail', [
            'pesanan' => pesanan::find($keranjang),
            'kategorys' => kategory::all(),
        ]);

    }

    public function pengiriman($pesanan_id, $status)
    {
        $masukan = pengiriman::create([
            'pesanan_id' => $pesanan_id,
            'status' => $status,
        ]);

        if ($masukan) {
            return true;
        } else {
            return back()->with('pesan', "eror saat memasukan data ");
        }

    }

    public function resi(Request $request)
    {
        $id_pesanan = decrypt($request->pesanan);
        return view('pesanan.resi', [
            'pesanan' => pesanan::find($id_pesanan),
        ]);
    }

    public function tambahResi(Request $request, $id)
    {
        $pesanan_id = decrypt($id);

        pengiriman::create([
            'pesanan_id' => $pesanan_id,
            'status' => $request->status,
        ]);
        return back();
    }

    public function editResi(Request $request, $id)
    {
        $pengiriman_id = decrypt($id);

        pengiriman::find($pengiriman_id)->update([
            'status' => $request->status,
        ]);
        return back();
    }

    public function pesanSupplier($id)
    {
        $key = decrypt($id);
        return view('pesanan.supplier', [
            'produk' => produk::find($key),
        ]);
    }
    public function uploadPembayaran(Request $request)
    {
        $request->validate([
            'form-pembayaran' => 'required',
        ]);

        $file = $request->file('form-pembayaran');

        //cek revisi atau baru
        $pesanan = pesanan::find(decrypt($request->pesanan));
        if ($pesanan->konfirmasiPembayaran) {
            $filename = $pesanan->konfirmasiPembayaran->bukti_transaksi;
            $path = storage_path('app/public/' . $filename);

            //
            $id_konfirmasiPembayaran=$pesanan->konfirmasiPembayaran->id;

            if (File::exists($path)) {
                File::delete($path);
             
                konfirmasiPembayaran::find($id_konfirmasiPembayaran)->update([
                    'bukti_transaksi' => $file->store('bukti_pembayaran', 'public'),
                ]);
                $pesanan->update([
                    'status' => 'diproses',
                    'resi'=>'direvisi'
                ]);
                return redirect('/panel?filter=diproses');
            } else {
                konfirmasiPembayaran::find($id_konfirmasiPembayaran)->update([
                    'bukti_transaksi' => $file->store('bukti_pembayaran', 'public'),
                ]);
                $pesanan->update([
                    'status' => 'diproses',
                    'resi'=>'direvisi'
                ]);
                return redirect('/panel?filter=diproses');
            }
        }

        konfirmasiPembayaran::create([
            'pesanan_id' => decrypt($request->pesanan),
            'bukti_transaksi' => $file->store('bukti_pembayaran', 'public'),
        ]);

        $pesanan->update([
            'status' => 'diproses',
        ]);

        return redirect('/panel?filter=diproses');

    }

    public function terima(Request $request)
    {
        $id = decrypt($request->pesanan);
        $pesanan =   pesanan::find($id);
     $pesanan->update([
            'resi' => 'diterima',
        ]);

        keuangan::create([
            'tanggal_transaksi'=>Carbon::now(),
            'keterangan'=>'Pembayaran Pesanan-'.$id,
            'nominal'=>$pesanan->jumlah * $pesanan->produk->harga,
            'jenis_transaksi'=>'masuk'
        ]);

        return back();
    }

    public function tolak(Request $request)
    {
        $id = decrypt($request->pesanan);
        pesanan::find($id)->update([
            'resi' => 'ditolak',
        ]);
        return back();
    }

    function lihatResi(Request $request){
        if(!$request->pesanan){
            return back();
        }
        $id_pesanan = decrypt($request->pesanan);
        return view('pesanan.lihatResi',[
            'pesanan'=>pesanan::find($id_pesanan),
            'kategorys' => kategory::all(),
        ]);
    }

}
