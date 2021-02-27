<?php

namespace App\Http\Controllers;

use App\Models\Models\Article;
use App\Models\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends FrontendController
{
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    public function index()
    {
        $productHot = Product::where([
            'p_hot'=>Product::HOT_ON,
            'p_active'=>Product::STATUS_PUBLIC
        ])->orderBy('id','DESC')->limit(6)->get();

        $productNews = Product::where([
            'p_active'=>Product::STATUS_PUBLIC,
        ])->orderBy('id','DESC')->limit(6)->get();

        $productPopular = Product::where([
            'p_active'=>Product::STATUS_PUBLIC,
        ])->orderBy('p_pay','DESC')->limit(6)->get();

        $articleNews = Article::orderBy('id','DESC')->limit(5)->get();
        $viewData = [
            'productHot'=>$productHot,
            'articleNews'=>$articleNews,
            'productNews'=>$productNews,
            'productPopular' => $productPopular,
        ];
        return view('home.index', $viewData);
    }
}
