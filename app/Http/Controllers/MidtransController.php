<?php

namespace App\Http\Controllers;

use App\Models\keuangan;
use App\Models\pesanan;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function handleNotification(Request $request)
    {
        $notification = $request->all();

        $id=explode('-',$notification['order_id'])[0];
       

        $additionalData = [
            'order_id' => $notification['order_id'],
            'transaction_status' => $notification['transaction_status'],
            // 'payment_type' => $notification['payment_type'],
        ];
        $pesanan = pesanan::find($id);

        // Proses notifikasi sesuai dengan status
        if ($notification['status_code'] == '200') {
          $idkeuangan =   keuangan::create([
                'keterangan' => "Pembayaran-" . $pesanan->id,
                'tanggal_transaksi' => date("Y-m-d H:i:s"),
                'jenis_transaksi' => 'masuk',
                'nominal' => floatval($pesanan->jumlah) * floatval($pesanan->produk->harga),
            ]);

     
            
            $pesanan->update([
                'status' => 'Berhasil',
                'keuangan_id'=>$idkeuangan->id
            ]);

            
            return redirect('/panel?filter=diproses');
            // return response()->json("Pembayar Berhasil Sedang mengalhkan halaman");
        } elseif ($notification['status_code'] === '201') {
            // Pembayaran tertunda
            $pesanan->update([
                'status' => 'Pendding',
            ]);
        } elseif ($notification['status_code'] === '202') {
            $pesanan->update([
                'status' => 'Expire',
            ]);
        } elseif ($notification['status_code'] === 'cancel') {
            $pesanan->update([
                'status' => 'Canceled',
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    function finish()  {
        return redirect('/panel?keranjang=diproses');
    }
}
