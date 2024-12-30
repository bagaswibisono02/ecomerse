<?php

namespace App\Http\Controllers;

use App\Models\kab_kota;
use App\Models\kecamatan;
use App\Models\kelurahan;
use App\Models\provinsi;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    function kab(Request $request) {
        $idProv = decrypt($request->q);

        $provinsi =   provinsi::find($idProv);
      
        return view('ajax.kab',[
            'kabs'=>$provinsi->kab_kota
        ]);
    }


    function kec(Request $request) {
        $idKab = decrypt($request->q);

        $kab = kab_kota::find($idKab);
        return view('ajax.kec',[
            'kecamatan'=>$kab->kecamatan
        ]);
    }

    function kel(Request $request) {
        $idKec = decrypt($request->q);
        $kec = kecamatan::find($idKec);
        return view('ajax.kel',[
            'kels'=>$kec->kelurahan
        ]);
    }
}
