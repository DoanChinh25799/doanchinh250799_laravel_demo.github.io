<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestCategory;
use App\Models\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

//use Psy\Util\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;
use Session;

class AdminCategoryController extends Controller
{
    public function index()
    {
        // Phân trang
//        $categories = DB::table('categories')->paginate(10);
//        $viewData = [
//            'categories'=>$categories
//        ];
//        return view('admin::category.index', $viewData);

        $categories = DB::table('categories')->select('id','c_name','c_title_seo','c_description_seo','c_active')->get();
        $viewData=[
            'categories'=>$categories
        ];
        return view('admin::category.index', $viewData);
    }

    public function create()
    {
        return view('admin::category.create');
    }

    public function store(RequestCategory $requestCategory)
    {
        $this ->insert_update($requestCategory);
        return redirect()->back();
    }

    public function edit($id){
        $category = Category::find($id);
        //$category = DB::table('categories')->find($id);
        return view('admin::category.update',compact('category'));
    }

    public function update(RequestCategory $requestCategory, $id){

        $this->insert_update($requestCategory, $id);
        return redirect()->route('admin.get.list.category');
    }

    public function insert_update($requestCategory, $id=''){
        $flag=1;
        try {
            $category = new Category();
            if($id){
                //$category = DB::table('categories')->find($id);
                $category = Category::find($id);
            }
            $category->c_name = $requestCategory->name;
            $category->c_slug = Str::slug($requestCategory->name);
            $category->c_icon = Str::slug($requestCategory->icon);
            $category->c_title_seo = $requestCategory->meta_title ? $requestCategory->meta_title : $requestCategory->name;
            $category->c_description_seo = $requestCategory->meta_description;
            $category -> save();
        }catch (\Exception $exception){
            $flag = 0;
            Log::error('[Error insert or update Categories!]'.$exception->getMessage());
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
            $category = Category::find($id);
            switch ($action){
                case 'delete':
                    $category->delete();
                    Session::flash('success', 'Xóa thành công!');
                    break;
                case 'active':
                    $category->c_active = $category ->c_active ? 0 : 1;
                    $category->save();
                    break;
            }
        }
        return redirect()->back();
    }
}
