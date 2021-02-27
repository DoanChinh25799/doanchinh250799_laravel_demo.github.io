<?php

namespace App\Http\Controllers;

use App\Models\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends FrontendController
{
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    public function getListArticle()
    {
        $articles = DB::table('articles')->select('id', 'a_slug', 'a_name', 'a_description', 'a_content', 'a_avatar', 'a_view', 'updated_at')->orderBy('id','DESC')->paginate(6);
        $viewData = [
            'articles' => $articles,
        ];
        return view('article.index', $viewData);
    }

    public function getDetailArticle(Request $request)
    {
        $url = $request->segment(2);
        $url = preg_split("/(-)/i", $url);
        if ($id = array_pop($url)) {
            $articleDetail = Article::where([
                'a_active' => Article::STATUS_PUBLIC,
            ])->find($id);
            $articleNews = DB::table('articles')->where('a_active',1)->orderBy('id','DESC')->limit(10)->get();
            $viewData = [
                'articleDetail' => $articleDetail,
                'articleNews'=>$articleNews,
            ];
            return view('article.detail', $viewData);
        }
        return redirect('/');
    }
}
