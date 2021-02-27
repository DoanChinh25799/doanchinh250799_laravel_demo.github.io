<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Models\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function getLogin(){
        $categories = DB::table('categories')->select('id','c_name','c_slug','c_title_seo','c_description_seo','c_active')->get();
        $sale = Product::where([
            'p_active'=>Product::STATUS_PUBLIC,
        ])->orderBy('p_promotion','DESC')->limit(1)->get();
        $viewData = [
            'categories'=>$categories,
            'sale'=>$sale,
        ];
        return view('auth.login', $viewData);
    }

    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::validate($credentials)){
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            }
        }
        else{
            Session::flash('error','Sai email hoặc mật khẩu.');
            redirect()->back();
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
