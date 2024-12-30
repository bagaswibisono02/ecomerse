<?php

namespace App\Http\Controllers;

use App\Models\kategory;
use App\Models\pesanan;
use App\Models\produk;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiMainController extends Controller
{
    public function index()
    {
        $produks = produk::with('media')->get();
        $response = $produks->map(function ($produk) {
            $media = $produk->media->map(function ($item) {
                $item->file = encrypt($item->file); // Enkripsi file_path
                return $item;
            });
    
            $produk->media = $media;
            return $produk;
        });

        return response()->json([
            'produk' => $response,
        ], 200);
        // return response()->json([
        //     'produk' => produk::with('media')->get(),
        // ], 200);
       
    }

    public function login()
    {
        return [
            'pesan' => 'anda belum login',
        ];
    }
    public function prosesLogin(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 'Login failed'], 401);
        }
        // Buat token menggunakan Sanctum
        $token = $user->createToken('login')->plainTextToken;

        // Kembalikan token ke client
        return response()->json(['token' => $token], 200);
    }

    function register(Request $request) {
        //  return $request->toArray();
       $simpan =  User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password'=> bcrypt($request->password),
            'contact'=>$request->contact,
            'hak_akses'=>'User'
        ]);

        if($simpan){
            return [
                'status'=> 200,
                'pesan' => 'Berhasil Register',
                'data'=>$simpan->toArray(),
            ];
        }
        else {
            return [
                'status'=> 200,
                'pesan' => 'Gagal Register',
            ]; 
        }
    }

    function cekLogin(Request $request)  {
        // Jika pengguna sudah diautentikasi
        if ($request->user()) {
            return response()->json([
                'loggedIn' => true,
                'user' => $request->user() // Mengembalikan data pengguna
            ], 200);
        }

        // Jika pengguna belum login (atau token tidak valid)
        return response()->json([
            'loggedIn' => false,
            'message' => 'User is not authenticated'
        ], 401);
    }
    function lihatProduk($id){

        $produks = produk::with('media')->where('id',$id)->get();
        
        $response = $produks->map(function ($produk) {
            $media = $produk->media->map(function ($item) {
                $item->file = encrypt($item->file); // Enkripsi file_path
                return $item;
            });
    
            $produk->media = $media;
            return $produk;
        });

        
  
        return response()->json(['produk'=>$response],200);
    }

    function kategory() {
        $kategory = kategory::all();
        return response()->json($kategory);
    }

    function search($parameter){

     


        $produks = produk::with('media')
        ->where('nama','like', '%'.$parameter.'%')->get();


        $response = $produks->map(function ($produk) {
            $media = $produk->media->map(function ($item) {
                $item->file = encrypt($item->file); // Enkripsi file_path
                return $item;
            });
    
            $produk->media = $media;
            return $produk;
        });

        if($produks->count() != 0){
            return response()->json([
                'produk' => $response,
            ], 200);
        }
        else{
            return response()->json([
                'produk' => "tidak ada data ditemukan",
            ],200);
        }
    }

    function keranjang(Request $request){
        if($request->filter){
            if($request->filter == 'keranjang'){
                $produks = pesanan::where('status', 'keranjang')
                ->where('user_id',Auth::user()->id )
                ->get();
            }

        }
        else{
            $produk = Auth::user()->pesanan;
        }
    }
}
