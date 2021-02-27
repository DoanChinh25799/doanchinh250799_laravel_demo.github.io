<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Models\Account;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class AdminAccountController extends Controller
{
    public function index(Request $request)
    {
//        $users = User::whereRaw(1);
//
//        $users = $users->orderBy('id','DESC')->paginate(10);
//
//        $viewData = [
//            'user'=>$users
//        ];

        $users = DB::table('users')->paginate(10);
        $viewData = [
            'users'=>$users
        ];
        return view('admin::account.index', $viewData);
    }

    public function action($action, $id){
        if($action){
            $user = Account::find($id);
            switch ($action){
                case 'delete':
                    $user->delete();
                    Session::flash('success', 'Xóa thành công!');
                    break;
                case 'active':
                    $user->active = $user->active ? 0 : 1;
                    $user->save();
                    break;
            }
        }
        return redirect()->back();
    }

}
