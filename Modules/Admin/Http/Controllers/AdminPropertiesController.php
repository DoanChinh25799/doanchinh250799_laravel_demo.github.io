<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestProperties;
use App\Models\Models\Property;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class AdminPropertiesController extends Controller
{
    public function index()
    {
        $properties = DB::table('properties')->select('id','pro_name','pro_note')->get();
        $viewData=[
            'properties'=>$properties
        ];
        return view('admin::properties.index', $viewData);
    }

    public function create()
    {
        return view('admin::properties.create');
    }

    public function store(RequestProperties $requestProperties)
    {
        $this ->insert_update($requestProperties);
        return redirect()->back();
    }

    public function edit($id){
        $property = Property::find($id);
        //$category = DB::table('categories')->find($id);
        return view('admin::Properties.update',compact('property'));
    }

    public function update(RequestProperties $requestProperties, $id){

        $this->insert_update($requestProperties, $id);
        return redirect()->route('admin.get.list.properties');
    }

    public function insert_update($requestProperties , $id=''){
        $flag=1;
        try {
            $property = new Property();
            if($id){
                //$category = DB::table('categories')->find($id);
                $property = Property::find($id);
            }
            $property->pro_name = $requestProperties->pro_name;
            $property->pro_note = $requestProperties->pro_note;
            $property -> save();
        }catch (\Exception $exception){
            $flag = 0;
            Log::error('[Error insert or update Properties!]'.$exception->getMessage());
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
            $property = Property::find($id);
            switch ($action){
                case 'delete':
                    $property->delete();
                    Session::flash('success', 'Xóa thành công!');
                    break;
            }
        }
        return redirect()->back();
    }
}
