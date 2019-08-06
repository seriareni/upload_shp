<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController extends Controller
{
    public function index(Request $request){
        if($request->session()->exists('activeUser')){
            return redirect('dashboard');
        }

        return view('login');
    }

    public function cekLogin(Request $request){

//        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

//        $activeUser = UserModel::where('email','=', $email)->first();
        $activeUser = UserModel::where('username','=', $username)->first();

        if(is_null($activeUser)){
            //data gak ada
            $params = [
                'message' => 'Login Gagal, Masukkan username dan password'
            ];
            $this->loginMenu();
        }else{
            if($activeUser->password == sha1($password)){

                $request->session()->put('activeUser',$activeUser); // activeuser diambil session ke home.
                $activeUser->remember_token=sha1($activeUser->user_id.date('YmdHis'));
                $activeUser->save();

                return redirect('dashboard');
            }
            $params = [
                'message' => 'Login Gagal, Password tidak sesuai'
            ];
            $this->loginMenu();
        }

        return view('login', $params);
    // }

    }

    public function loginMenu(){

        return view('dashboard');
    }

    public function cekLogout(Request $request){

        $request->session()->flash('$activeUser',null);

        Session::flush();
        return redirect('login');
    }

    public function cobaLogin(Request $request){
        if($request->session()->exists('activeUser')){
            return redirect('backend/home');
        }
        return view('login/coba');
    }

}