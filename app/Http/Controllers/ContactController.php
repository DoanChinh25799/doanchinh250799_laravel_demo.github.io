<?php

namespace App\Http\Controllers;

use App\Models\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends FrontendController
{
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    public function getContact(){
        return view('contact.index');
    }

    public function saveContact(Request $request){
        $data = $request->except('_token');
        $data['created_at']=$data['updated_at']=Carbon::now();
        Contact::insert($data);
        return redirect()->route('home');
    }
}
