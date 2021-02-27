@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.category')}}">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý danh mục sản phẩm</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Danh mục sản phẩm<a href="{{route('admin.get.create.category')}}" class="float-right"><i class="fas fa-plus-circle"></i> Thêm</a></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Title-Seo</th>
                        <th>Description</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Title-Seo</th>
                        <th>Description</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->c_name}}</td>
                                    <td>{{$category->c_title_seo}}</td>
                                    <td>{{$category->c_description_seo}}</td>
{{--                                    <td>--}}
{{--                                        <a href="">--}}
{{--                                            {{$category->getStatus($category->c_active)['name']}}--}}
{{--                                        </a>--}}
{{--                                    </td>--}}

                                    <td>
                                        <a href="{{route('admin.get.action.category',['active',$category->id])}}" class="badge {{$category->c_active ==1? 'badge-primary':'badge-warning'}}">{{$category->c_active ==1? 'Public':'Private'}}</a>
                                    </td>
                                    <td>
                                        <div class="edit-delete">
                                            <a href="{{route('admin.get.edit.category', $category->id)}}"><i class="fas fa-edit"></i> Sửa</a>
                                            <a href="{{route('admin.get.action.category', ['delete', $category->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>
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
