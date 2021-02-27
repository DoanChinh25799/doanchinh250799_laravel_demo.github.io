<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Models\Category;
use App\Models\Models\Contact;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Session;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $contacts = DB::table('contacts')->select('id','name','email','subject','content','status')->get();
        $viewData=[
            'contacts'=> $contacts
        ];
        return view('admin::contact.index', $viewData);
    }

    public function action($action, $id){
        if($action){
            $contact = Contact::find($id);
            switch ($action){
                case 'delete':
                    $contact->delete();
                    Session::flash('success', 'Xóa thành công!');
                    break;
                case 'active':
                    $contact->status = $contact ->status ? 0 : 1;
                    $contact->save();
                    break;
            }
        }
        return redirect()->back();
    }
}
