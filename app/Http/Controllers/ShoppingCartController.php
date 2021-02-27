<?php

namespace App\Http\Controllers;

use App\Models\Models\Order;
use App\Models\Models\Product;
use App\Models\Models\Transaction;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ShoppingCartController extends FrontendController
{
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    public function addProduct(Request $request, $id){
        $product = Product::select('id','p_name','p_sale_price','p_amount','p_img','p_promotion','color_id','size_id')->find($id);

        if(!$product){
            return redirect('/');
        }
        $price = $product->p_sale_price;
        if($product->p_promotion){
            $price = $price*(1 - $product->p_promotion/100);
        }

        if($product->p_amount==0){
            Session::flash('error','Sản phẩm này đã hết hàng.');
            return  redirect()->back();
        }

        $color = DB::table('colors')->where('id','=',$product->color_id)->select('color_name')->first();
        $size = DB::table('sizes')->where('id','=',$product->size_id)->select('size_name')->first();

        Cart::add([
            'id' => $product->id,
            'name' => $product->p_name,
            'qty' => 1,
            'price' => $price,
            'weight'=>0,
            'options' => [
                'image' => $product-> p_img,
                'promotion'=> $product-> p_promotion,
                'price_old'=> $product -> p_sale_price,
//                'color_id'=>$product->color_id,
//                'size_id'=>$product->size_id,
                'color_id'=>$color->color_name,
                'size_id'=>$size->size_name,
            ],
        ]);
        return redirect()->back()->with('success','Đã thêm vào giỏ hàng.');
    }

    public function delProduct($key){
        Cart::remove($key);
        return redirect()->back();
    }

    public function changeQty($action,$key){
        if($action){
            $pro = Cart::get($key);

            $product = Cart::get($key)->toArray();
            $p = DB::table('products')->where('id','like',$product['id'])->first();
            switch ($action){
                case 'increment':
                    if(($p->p_amount-$pro->qty)>0){
                        Cart::update($key,$pro->qty+1);
                        break;
                    }
                    else{
                        Session::flash('error','Số lượng sản phẩm không đủ!');
                        break;
                    }

                case 'decrement':
                    Cart::update($key,$pro->qty-1);
                    break;
            }
        }
        return redirect()->back();
    }

    public function delCart(){
        Cart::destroy();
        return redirect()->back();
    }

    public function getListShoppingCart(){
        $listcart = Cart::content();
        $viewData = [
            'listcart'=>$listcart,
        ];
        return view('shoppingcart.index',$viewData);
    }

    public function getFormPay(){
        $listcart = Cart::content();
        $viewData = [
            'listcart'=>$listcart,
        ];
        return view('shoppingcart.formpay', $viewData);
    }

    public function saveInfoCart(Request $request){
        $total = str_replace(',','',Cart::subtotal(0,3));
        $transactionId = Transaction::insertGetId([
            'tr_user_id'=>get_data_user('web'),
            'tr_total'=>(int)$total,
            'tr_note'=>$request->note,
            'tr_address'=>$request->address,
            'tr_phone'=>$request->phone,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);

        if($transactionId){
            $products = Cart::content();
            foreach ($products as $product){
                Order::insert([
                    'or_transaction_id'=>$transactionId,
                    'or_product_id'=>$product->id,
                    'or_qty'=>$product->qty,
                    'or_price'=>$product->options->price_old,
                    'or_sale'=>$product->options->promotion,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ]);
            }
        }
        Cart::destroy();
        return redirect()->route('home');
    }
}
