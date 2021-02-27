<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Http\Request;

class CheckAdminLogin
{
    public function handle($request, Closure $next)
    {
        if(get_data_user('admins','u_category')){

            return $next($request);
        }
        return redirect()->route('admin.login');
    }
}
