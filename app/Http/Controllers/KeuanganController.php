<?php

namespace App\Http\Controllers;

use App\Models\keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->start_date && $request->end_date){
            $dataKeuangan = keuangan::whereBetween('tanggal_transaksi',[$request->start_date, $request->end_date])->get();
            $pemasukan = keuangan::where('jenis_transaksi','masuk')->whereBetween('tanggal_transaksi',[$request->start_date, $request->end_date])->get();
            $pengeluaran = keuangan::where('jenis_transaksi','keluar')->whereBetween('tanggal_transaksi',[$request->start_date, $request->end_date])->get();
        }
        else{
            $dataKeuangan = keuangan::paginate(100);
            $pemasukan = keuangan::where('jenis_transaksi','masuk')->get();
            $pengeluaran = keuangan::where('jenis_transaksi','keluar')->get();
        }
        return view('keuangan.index',[
            'keuangans'=>$dataKeuangan,
            'pemasukan'=>$pemasukan,
            'pengeluaran'=>$pengeluaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->masuk && $request->keluar){
            return back();
        }
        else{
            if($request->masuk){
                $jenisTransaksi = "masuk";
                $nominal = $request->masuk;
            }
            if($request->keluar){
                $jenisTransaksi = "keluar";
                $nominal = $request->keluar;
            }

            keuangan::create([
                'tanggal_transaksi'=>$request->tanggal_transaksi,
                'keterangan'=>$request->keterangan,
                'nominal'=>$nominal,
                'jenis_transaksi'=>$jenisTransaksi
            ]);
    
            return back();
        }
        

       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
