@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.properties')}}">Thuộc tính</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý thuộc tính sản phẩm</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Danh sách thuộc tính sản phẩm<a href="{{route('admin.get.create.properties')}}" class="float-right"><i class="fas fa-plus-circle"></i>  Thêm</a></div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-12">
                    <form class="form-inline" action="{{route('admin.get.list.properties')}}">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control mb-2 mr-sm-2" placeholder="Tìm kiếm tên..." id="name" value="{{$name ?? ''}}">
                        </div>
                        <div class="form-group">
                            <select name="cate" id="cate" class="form-control mb-2 mr-sm-2">
                                <option value="">Thuộc tính...</option>
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"{{$cate == $category->id?"selected='selected'":""}}>{{$category->c_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên thuộc tính</th>
                        <th>Ghi chú</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Tên thuộc tính</th>
                        <th>Ghi chú</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @if(isset($properties))
                            @foreach($properties as $property)
                                <tr>
                                    <td>{{$property->id}}</td>
                                    <td>{{$property->pro_name}}</td>
                                    <td>{{$property->pro_note}}</td>
                                    <td>
                                        <div class="edit-delete">
                                            <div class="row">
                                                <a href="{{route('admin.get.edit.properties', $property->id)}}"><i class="fas fa-edit"></i> Sửa</a>
                                            </div>
                                            <div class="row">
                                                <a href="{{route('admin.get.action.properties', ['delete', $property->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>
                                            </div>
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
