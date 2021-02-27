<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    use AuthenticatesUsers;
    public function getLogin(){
        return view('admin::auth.login');
    }

    public function postLogin(Request $request){
        $admin = $request->only('email', 'password');

        if (Auth::guard('admins')->attempt($admin)) {
            return redirect()->route('admin.home');
        }
        redirect()->back();
    }

    public function getLogout(){
        Auth::guard('admins')->logout();
        return redirect()->route('admin.login');
    }
}
