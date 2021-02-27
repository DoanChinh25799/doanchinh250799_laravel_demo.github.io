<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\RequestArticle;
use App\Models\Models\Article;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Session;
class AdminArticleController extends Controller
{

    public function index(Request $request)
    {
        $articles = Article::whereRaw(1);
        $name = $request->name;
        if($name) $articles->where('a_name','like','%'.$request->name.'%');
        $articles = $articles->paginate(10);
        $viewData = [
            'articles'=>$articles
        ];
        return view('admin::article.index', $viewData, compact('name'));
    }


    public function create()
    {
        return view('admin::article.create');
    }

    public function store(RequestArticle $requestArticle){
        $this->insert_update($requestArticle);
        return redirect()->back();
    }

    public function edit($id){
        $article = Article::find($id);
        return view('admin::article.create',compact('article'));
    }

    public function update(RequestArticle  $requestArticle, $id){
        $this->insert_update($requestArticle, $id);
        return redirect()->route('admin.get.list.article');
    }

    public function insert_update($requestArticle, $id=''){
        $flag=1;
        try {
            $article = new Article();
            if($id) $article = Article::find($id);
            $article->a_name = $requestArticle->a_name;
            $article->a_slug = Str::slug($requestArticle->a_name);
            $article->a_description = $requestArticle->a_description;
            $article->a_content = $requestArticle->a_content;
            $article->a_title_seo = $requestArticle->a_title_seo?$requestArticle->a_title_seo:$requestArticle->a_name;
            $article->a_description_seo = $requestArticle->a_description_seo?$requestArticle->a_description_seo:$requestArticle->a_description;

            if ($requestArticle->hasFile('a_avatar')) {
                $file = upload_image('a_avatar');
                if(isset($file['name'])){
                    $article->a_avatar=$file['name'];
                }
            }
            $article->save();
        }catch (\Exception $exception){
            $flag = 0;
            Log::error('[Lỗi thêm mới-cập nhật tin tức!]'.$exception->getMessage());
        }

        if($flag==1){
            Session::flash('success', 'Cập nhật thành công!');
        }
        else{
            Session::flash('error', 'Cập nhật thất bại!');
        }
    }

    public function action($action, $id){
        if($action){
            $article = Article::find($id);
            switch ($action){
                case 'delete':
                    $article->delete();
                    Session::flash('success', 'Xóa thành công!');
                    break;
                case 'active':
                    $article->a_active = $article->a_active ? 0 : 1;
                    $article->save();
                    break;
            }
        }
        return redirect()->route('admin.get.list.article');
    }
}
