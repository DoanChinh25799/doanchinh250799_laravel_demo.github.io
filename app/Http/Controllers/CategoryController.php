<?php

namespace App\Http\Controllers;

use App\Models\Models\Category;
use App\Models\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CategoryController extends FrontendController
{
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    public function getListProduct(Request $request){
        $url = $request->segment(2);
        $url = preg_split("/(-)/i",$url);
//        $bestsellers = Product::where([
//            'p_active'=>Product::STATUS_PUBLIC,
//            'p_parent','<>','id'
//        ])->orderBy('p_pay','DESC')->limit(5)->get();
        $bestsellers = DB::table('products')->where([
            ['p_active','=',Product::STATUS_PUBLIC],
        ])->whereColumn('p_parent','=','id')->orderBy('p_pay','DESC')->limit(5)->get();
        if ($id = array_pop($url)){
            $categories1 = Category::find($id);
//            $products = Product::where([
//                'p_category_id'=>$id,
//                'p_active'=>Product::STATUS_PUBLIC,
//                'p_parent'=>-1,
//            ]);
            $products = DB::table('products')->where([
                ['p_category_id','=',$id],
                ['p_active','=',Product::STATUS_PUBLIC],
            ])->whereColumn('p_parent','=','id');

            if($request->price){
                $price = $request->price;
                switch ($price){
                    case '1':
                        $products->where('p_sale_price','<',100000);
                        break;
                    case '2':
                        $products->whereBetween('p_sale_price',[100000,300000]);
                        break;
                    case '3':
                        $products->whereBetween('p_sale_price',[300000,700000]);
                        break;
                    case '4':
                        $products->whereBetween('p_sale_price',[700000,1500000]);
                        break;
                    case '5':
                        $products->where('p_sale_price','>',1500000);
                        break;
                }
            }

            if($request->orderby){
                $orderby = $request->orderby;
                switch ($orderby){
                    case 'orby_desc':
                        $products->orderBy('id','DESC');
                        break;
                    case 'orby_price_incre':
                        $products->orderBy('p_sale_price','ASC');
                        break;
                    case 'orby_price_decre':
                        $products->orderBy('p_sale_price','DESC');
                        break;
                }
            }

            $products = $products->paginate(9);

            $viewData = [
                'products'=>$products,
                'categories1'=>$categories1,
                'bestsellers'=>$bestsellers,
            ];
            return view('product.index',$viewData);
        }

        if($request->key){
            $products = DB::table('products')->where([
                'p_active'=>Product::STATUS_PUBLIC,
            ])->whereColumn('p_parent','=','id')->where('p_name','like','%'.$request->key.'%')->paginate(9);
            $keyP = $request->key;
            $viewData = [
                'products'=>$products,
                'key'=>$keyP,
                'bestsellers'=>$bestsellers,
            ];
            return view('product.index',$viewData);
        }

        return redirect('/');
    }
}
