<?php

namespace App\Http\Controllers;

use App\Models\kategory;
use App\Models\keuangan;
use App\Models\pencarian;
use App\Models\pesanan;
use App\Models\platformAfiliate;
use App\Models\produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class mainController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->hak_akses == 'User') {
                return redirect()->intended('panel');
            } else {
                return redirect()->intended('dashboard');
            }

        }

        return back()->with('gagal', 'Periksa Kombinasi email dan password anda');
    }

    public function dashboard()
    {
        return view('dashboard', [
            'kategoryes' => kategory::orderBy('dicari', 'DESC')->get(),
            'users'=>User::all(),
            'produks'=>produk::all(),
            'pemesanans'=>pesanan::all(),
            'pencarians' => pencarian::orderBy('created_at', 'ASC')->get(),
            'transaksis' => keuangan::orderBy('created_at', 'ASC')->limit(50)->get(),
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function getfile(Request $request)
    {
        $decryptFile = decrypt($request->file);
        // return $decryptFile;
        $filename = $decryptFile;
        $path = storage_path('app/public/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file, 200)->header("Content-Type", $type);
    }

    public function index()
    {
        $trending = Produk::withCount(['users as total_time' => function ($query) {
            $query->select(DB::raw("SUM(times)"))
            ;
        }])
            ->having('total_time', '>', 0)
            ->orderBy('total_time', 'desc')
            ->get();

        if (Auth::check()) {
            $foryou = Produk::withCount(['users as total_time' => function ($query) {
                $query->where('user_id', Auth::id())
                    ->select(DB::raw("SUM(times)"))
                ;
            }])
                ->having('total_time', '>', 0)
                ->orderBy('total_time', 'desc')
                ->get();
            $idForyou = $foryou->pluck('id')->toArray();
        }
        else{
   
            $foryou= Produk::orderBy('created_at', 'DESC')->paginate(12);
            $idForyou = $foryou->pluck('id')->toArray();
        }
        return view('produk.lihatUser', [
            'trendings' => $trending,
            'foryous' => $foryou,
            'terbaru'=>produk::whereNotIn('id', $idForyou)->orderBy('created_at','desc')->paginate(50),
            'afiliasi'=>platformAfiliate::all(),
            'kategorys' => kategory::all(),
        ]);
    }

    public function loginUser()
    {
        return view('login');
    }
    public function registerUser()
    {
        return view('register');
    }
    public function prosesRegisterUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'contact' => ['required'],
        ]);

        if ($request->password != $request->password2) {
            return back()->with('gagal', 'Password Tidak Sama')->withInput();
        }

        $cek = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'contact' => $request->contact,
            'hak_akses' => 'User',
        ]);
        if ($cek) {
            return redirect('/login')->with('berhasil', 'Berhasil Registrasi Silahkan Login');
        } else {
            return back()->with('gaga', 'Gagal Registrasi Silahkan Hubungi Admin');
        }
    }

    public function panel(Request $request)
    {

        $produk = pesanan::Filter($request->filter)->orderby('created_at','desc')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.panel', [
            'pesanans' => $produk,
            'kategorys' => kategory::all(),
        ]);
    }

    public function masukanKeranjang(Request $request)
    {
        $id = decrypt(($request->produk));
        $cek = pesanan::where('user_id', Auth::user()->id)
            ->where('produk_id', $id)
            ->where('status', 'keranjang')
            ->get();
        if ($cek->count() > 0) {
            return 'ada';
        } else {

            $masukan = pesanan::create([
                'user_id' => Auth::user()->id,
                'produk_id' => $id,
                'status' => 'keranjang',
            ]);

            if ($masukan) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function search(Request $request)
    {

        if ($request->kategory) {
            $kategory = kategory::where('name','like', '%'.$request->kategory.'%')->first();
            $kategory_klik = intval(($kategory->dicari));

            $kategory->update([
                'dicari' => $kategory_klik + 1,
            ]);
        }

        if ($request->parameter) {

            if (pencarian::where('parameter', 'LIKE', '%' . $request->parameter . '%')->get()->count() < 1) {
                pencarian::create([
                    'parameter' => $request->parameter,
                ]);
            }

        }

        return view('produk.search', [
            'produks' => produk::Parameter($request->parameter)->Kategory($kategory->id ?? '')->get(),
            'kategorys' => kategory::all(),
        ]);
    }

    function profile() {
        return view('profile.index',[
            'kategorys' => kategory::all(),
        ]);
    }
    
    function updateProfile(Request $request){
        user::find(Auth::user()->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'contact'=>$request->contact
        ]);

        return back();
    }

    function forgotPassword() {
        return view('user.forgotPassword');
    }
    function kirimEmail(Request $request) {

       $cek =  User::firstWhere('email', $request->email);

       if(!$cek){
        return back()->with('gagal','Email Tidak Ditemukan');
       }
        $details = [
            'email' => $request->email,
            'link'=>env('APP_URL').'/reset-password?auth='.encrypt($cek->id)
        ];
    
        Mail::send('email.thameplateemail', ['details' => $details], function ($message) use ($details) {
            $message->to($details['email'])
                    ->subject('Forgot Password');
        });
    
        return "Link Reset Password Di kirim Ke email";
    }

    function shopee(Request $request){
        return view('shopee.index',[
            'shopes'=>platformAfiliate::find(decrypt($request->param)),
            'afiliasi'=>platformAfiliate::all(),
            'kategorys' => kategory::all(),
        ]);
    }

    function lihatShopee(Request $request) {

        return view('shopee.produk',[
            'link_komisi' => decrypt($request->produk),
            'afiliasi'=>platformAfiliate::all(),
            'kategorys' => kategory::all(),
        ]);
    
    }

    function downloadQris(Request $request){
        $decryptFile = decrypt($request->file);
        // return $decryptFile;
        $filename = $decryptFile;
        $path = storage_path('app/public/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response()->download($path);
    }

    function resetPassword(Request $request){
        return view('resetpassword',[
            'auth'=>$request->auth
        ]);
    }

    function reset(Request $request)  {
        if ($request->password != $request->password2) {
            return back()->with('gagal', 'Password Tidak Sama')->withInput();
        }
       $cek =  User::find(decrypt($request->auth))->update([
            'password'=>bcrypt($request->password)
        ]);

        if($cek){
            return redirect('/login')->with('berhasil', 'Berhasil Silahkan Login');
        }
        else{
            return redirect('/login')->with('gagal', 'Berhasil Silahkan Login');
        }
    }
}
