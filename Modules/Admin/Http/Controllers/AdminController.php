<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Models\Contact;
use App\Models\Models\Product;
use App\Models\Models\Transaction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $transaction = Transaction::where([
            'tr_status'=>0,
        ])->orderBy('id','DESC')->paginate(10);
        $contacts = Contact::where([
            'status' => 0,
        ])->orderBy('id','DESC')->paginate(10);
        $products = Product::where([
            'p_active'=>Product::STATUS_PUBLIC
        ])->orderBy('id','DESC')->limit(10)->paginate(5);
        $viewData = [
            'transactions'=>$transaction,
            'contacts'=>$contacts,
            'products'=>$products,
        ];

        return view('admin::index', $viewData);
    }
}
