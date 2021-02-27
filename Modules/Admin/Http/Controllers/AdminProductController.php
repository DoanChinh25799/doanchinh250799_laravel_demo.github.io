<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestProduct;
use App\Models\Models\Category;
use App\Models\Models\Pro_Properties;
use App\Models\Models\Product;
use App\Models\Models\Property;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('getcategory:id,c_name');
        $name = $request->name;
        $cate = $request->cate;
        $categories = $this->getCategories();
        if($name) $products->where('p_name','like','%'.$name.'%');
        if($cate) $products->where('p_category_id',$cate);
        $products = $products->orderBy('id','DESC')->paginate(10);

        $viewData = [
            'products'=>$products,
            'categories'=>$categories,
            'name'=>$name,
            'cate'=>$cate,
        ];
        return view('admin::product.index', $viewData);
    }

    public function create()
    {
        $categories = $this->getCategories();
        $products = $this->getProducts();
        $colors = DB::table('colors')->select('id','color_name','color_note')->get();
        $sizes = DB::table('sizes')->select('id','size_name','size_note')->get();
        $viewData = [
            'products'=>$products,
            'categories'=>$categories,
            'colors'=>$colors,
            'sizes'=>$sizes,
        ];
        return view('admin::product.create', $viewData);
    }
    public function getCategories(){
        return Category::all();
    }

    public function getProducts(){
        return Product::all();
    }

    public function getProperties(){
        return Property::all();
    }

    public function store(RequestProduct $request)
    {
        $this->insert_update($request);
        return redirect()->back();
    }

    public function edit($id){
        $product = Product::find($id);
        $colors = DB::table('colors')->select('id','color_name','color_note')->get();
        $sizes = DB::table('sizes')->select('id','size_name','size_note')->get();
        $categories = $this->getCategories();
        $products = $this->getProducts();
        $viewData = [
            'product'=>$product,
            'products'=>$products,
            'categories'=>$categories,
            'colors'=>$colors,
            'sizes'=>$sizes,
        ];
        return view('admin::product.update', $viewData);
    }

    public function update(RequestProduct $requestProduct, $id){
        $this->insert_update($requestProduct, $id);
        return redirect()->route('admin.get.list.product');
    }

    public function insert_update($requestProduct, $id=''){
        $flag=1;
        try {
            $product = new Product();
            if($id){
                $product = Product::find($id);
            }
            $product->p_name = $requestProduct->p_name;
            $product->p_slug = Str::slug($requestProduct->p_name);
            $product->p_category_id = $requestProduct->p_category_id;
            $product->p_barcode = $requestProduct->p_barcode;
            $product->p_description = $requestProduct->p_description;
            $product->p_content = $requestProduct->p_content;
            $product->p_title_seo = $requestProduct->p_meta_title?$requestProduct->p_meta_title:$requestProduct->p_name;
            $product->p_description_seo = $requestProduct->p_meta_description?$requestProduct->p_meta_description:$requestProduct->p_name;
            $product->p_parent = $requestProduct->p_parent?$requestProduct->p_parent:0;
            $product->color_id = $requestProduct->color_id;
            $product->size_id = $requestProduct->size_id;
            $product->p_purchase_price = $requestProduct->p_purchase_price;
            $product->p_sale_price = $requestProduct->p_sale_price;
            $product->p_promotion = $requestProduct->p_promotion?$requestProduct->p_promotion:0;
            $product->p_amount = $requestProduct->p_amount?$requestProduct->p_amount:0;

            if ($requestProduct->hasFile('p_img')) {
                $file = upload_image('p_img');
                if(isset($file['name'])){
                    $product->p_img = $file['name'];
                }
            }
            //dd($product);
            $product->save();

            $product_ud = Product::find($product->id);

            if($product_ud->p_parent==0){
                $product_ud->p_parent = $product->id;
            }
            $product_ud->save();

        }catch (\Exception $exception){
            $flag = 0;
            Log::error('[Error insert or update Products!]'.$exception->getMessage());
            //Session::flash('error', 'Cập nhật thất bại!'.$exception->getMessage());

        }
        if($flag==1){
            Session::flash('success', 'Cập nhật thành công!');
        }
        else{
            Session::flash('error', 'Cập nhật thất bại!');
        }
        return redirect()->back();
    }

    public function action($action, $id){
        if($action){
            $product = Product::find($id);
            switch ($action){
                case 'delete':
                    $product->delete();
                    Session::flash('success', 'Xóa thành công!');
                    break;
                case 'hot':
                    $product->p_hot = $product->p_hot ? 0 : 1;
                    $product->save();
                    break;
                case 'active':
                    $product->p_active = $product->p_active ? 0 : 1;
                    $product->save();
                    break;
            }
        }
        return redirect()->back();
    }

}
