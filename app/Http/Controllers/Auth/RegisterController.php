<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Models\Product;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Session;

class RegisterController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    use RegistersUsers;

    public function getRegister()
    {
        $sale = Product::where([
            'p_active'=>Product::STATUS_PUBLIC,
        ])->orderBy('p_promotion','DESC')->limit(2)->get();
        $viewData = [
            'sale'=>$sale,
        ];
        return view('auth.register', $viewData);
    }

    public function postRegister(Request $request)
    {
        $flag = 1;
        try {
            $user = new User();

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            if($user->email){
                $flag=0;
                $mess = 'Email đã có!';
            }
            $user->dateofbirth = $request->dateofbirth;
            $user->address = $request->address;
            $user->sex = $request->sex;
            $user->password = bcrypt($request->password);
            $confirmpass = $request->password_confirmation;

            if($confirmpass!=$request->password){
                $flag = 0;
                $mess = "Mật khẩu không khớp!";
                redirect()->back();
            }

            if ($request->hasFile('avatar')) {
                $file = upload_image('avatar');
                if (isset($file['name'])) {
                    $user->avatar = $file['name'];
                }
            }

            if($flag==1)
            $user->save();

            if ($user->id) {
                return redirect()->route('get.login');
            }
        } catch (\Exception $exception) {
            $flag = 0;
            Log::error('[Error insert or update Products!]'.$exception->getMessage());
        }
        if ($flag == 1) {
            Session::flash('success', 'Đăng ký thành công!');
        } else {
            Session::flash('error', $mess?$mess:'Đăng ký thất bại!');
        }

        return redirect()->back();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

}
