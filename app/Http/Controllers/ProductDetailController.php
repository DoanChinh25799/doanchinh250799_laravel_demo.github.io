<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProduct;
use App\Models\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Cart;
use Session;

class ProductDetailController extends FrontendController
{
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    public function productDetail(Request $request){
        $url = $request->segment(2);
        $url = preg_split("/(-)/i",$url);
        $bestsellers = DB::table('products')->where([
            'p_active'=>Product::STATUS_PUBLIC,
        ])->whereColumn('p_parent','=','id')->orderBy('p_pay','DESC')->limit(5)->get();

        if($id = array_pop($url)){
            $productDetail = DB::table('products')->where([
                'p_active'=>Product::STATUS_PUBLIC,
            ])->whereColumn('p_parent','=','id')->find($id);
            // Gợi ý sp cùng thể loại
            $productCategory = DB::table('products')->where('p_active','=',1)->where('p_category_id','=',$productDetail->p_category_id)->where('id','<>',$id)->limit(6)->orderBy('id','DESC')->get();

            // ds sp cùng cha
            $groupproducts = Product::where([
                'p_active'=>Product::STATUS_PUBLIC,
                'p_parent'=>$id,
            ])->get();

            $colors = array();
            $sizes = array();
            foreach ($groupproducts as $pd){
                $color = DB::table('colors')->where('id','=',$pd->color_id)->select('color_name')->first();
                $size = DB::table('sizes')->where('id','=',$pd->size_id)->select('size_name')->first();
                $c = $color->color_name;
                $s = $size->size_name;
                $colors[$pd->color_id] = $c;
                $sizes[$pd->size_id] = $s;
            }
            $colors = array_unique($colors);
            $sizes = array_unique($sizes);

            $viewData = [
                'productDetail'=>$productDetail,
                'productCategory'=>$productCategory,
                'bestsellers'=>$bestsellers,
                'groupproducts'=>$groupproducts,
                'colors'=>$colors,
                'sizes'=>$sizes,
            ];
            return view('product.detail',$viewData);
        }
        return redirect('/');
    }

    public function addToCart(Request $request){
        $url = $request->segment(2);
        $url = preg_split("/(-)/i",$url);
        if($id = array_pop($url)){
            if($request->color_id == '-1' || request()->size_id == '-1'){
                return redirect()->back()->with('error','Bạn phải chọn màu sắc và kích thước sản phẩm.');
            }
            $product = Product::select('id','p_name','p_sale_price','p_amount','p_img','p_promotion','color_id','size_id')->where([
                'p_active'=>Product::STATUS_PUBLIC,
                'p_parent'=>$id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
            ])->first();
//
            if(!$product){
                return redirect()->back()->with('error','Sản phẩm có màu hoặc size này đã hết hàng.');
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
                    'color_id'=>$color->color_name,
                    'size_id'=>$size->size_name,
                ],
            ]);
            return redirect()->back()->with('success','Đã thêm vào giỏ hàng.');
        }
        else{
            return redirect()->back()->with('error','Sản phẩm có màu hoặc size này đã hết hàng.');
        }
    }

    public function productContent(Request $request, $id){
        if($request->ajax()){
            $productDetail = Product::where([
                'id'=>$id,
            ])->get();
            $html = view('product.content',compact('productDetail'))->render();
            return \response()->json($html);
        }
    }
}
