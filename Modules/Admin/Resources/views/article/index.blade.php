@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.article')}}">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý tin tức</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Danh sách tin tức<a href="{{route('admin.get.create.article')}}" class="float-right"><i class="fas fa-plus-circle"></i>  Thêm</a></div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-12">
                    <form class="form-inline" action="{{route('admin.get.list.article')}}">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control mb-2 mr-sm-2" placeholder="tên bài viết..." id="name" value="{{$name ?? ''}}">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <select name="cate" id="cate" class="form-control mb-2 mr-sm-2">--}}
{{--                                <option value="">Danh mục...</option>--}}
{{--                                @if(isset($categories))--}}
{{--                                    @foreach($categories as $category)--}}
{{--                                        <option value="{{$category->id}}"{{$cate == $category->id?"selected='selected'":""}}>{{$category->c_name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th width="15%">Tên bài viết</th>
                        <th width="15%">Hình ảnh</th>
                        <th width="20%">Mô tả</th>
                        <th width="10%">Trạng thái</th>
                        <th width="10%">Tác giả</th>
                        <th width="10%">Ngày viết</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Tên bài viết</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Tác giả</th>
                        <th>Ngày viết</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @if(isset($articles))
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{$article->id}}</td>
                                    <td>{{$article->a_name}}</td>
                                    <td>
                                        <img src="{{pare_url_file($article->a_avatar)}}" alt="" class="img-responsive-ad">
                                    </td>
                                    <td>{{$article->a_description}}
                                    </td>
{{--                                    <td>{{isset($article->getcategory->c_name)?$product->getcategory->c_name:'[N\A]'}}</td>--}}
                                    <td>
                                        <div class="f-active">
                                            <a href="{{route('admin.get.action.article',['active',$article->id])}}" class="badge {{$article->getStatus($article->p_active)['class']}}">
                                                {{$article->getStatus($article->a_active)['name']}}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        {{$article->a_author_id}}
                                    </td>
                                    <td>
                                        {{$article->created_at}}
                                    </td>
                                    <td>
                                        <div class="edit-delete">
                                            <a href="{{route('admin.get.edit.article', $article->id)}}"><i class="fas fa-edit"></i> Sửa</a>
                                            <a href="{{route('admin.get.action.article', ['delete', $article->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
