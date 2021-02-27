@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.product')}}">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý sản phẩm</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Danh sách sản phẩm<a href="{{route('admin.get.create.product')}}" class="float-right"><i class="fas fa-plus-circle"></i>  Thêm</a></div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-12">
                    <form class="form-inline" action="{{route('admin.get.list.product')}}">
                        <div class="form-group">
                            <input name="name" type="text" class="form-control mb-2 mr-sm-2" placeholder="Tìm kiếm tên..." id="name" value="{{$name ?? ''}}">
                        </div>
                        <div class="form-group">
                            <select name="cate" id="cate" class="form-control mb-2 mr-sm-2">
                                <option value="">Danh mục...</option>
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
                        <th>Mã vạch</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Hot</th>
                        <th>Trạng thái</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Mã vạch</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Hot</th>
                        <th>Trạng thái</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @if(isset($products))
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->p_barcode}}</td>
                                    <td>
                                        <img src="{{pare_url_file($product->p_img)}}" alt="" class="img-responsive-ad">
                                    </td>
                                    <td>{{$product->p_name}}
                                        <ul class="detail_pro">
                                            <li>
                                                <span><i class="fas fa-dollar-sign">    </i>    {{$product->p_sale_price}}(đ)</span>
                                            </li>
                                            <li>
                                                <span><i class="fas fa-dollar-sign">    </i>    {{$product->p_promotion}}(%)</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>{{isset($product->getcategory->c_name)?$product->getcategory->c_name:'[N\A]'}}</td>
                                    <td>{{$product->p_amount}}</td>
                                    <td>
                                        <div class="f-active">
                                            <a href="{{route('admin.get.action.product',['hot',$product->id])}}" class="badge {{$product->getHot($product->p_hot)['class']}}">
                                                {{$product->getHot($product->p_hot)['name']}}
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="f_active">
                                            <a href="{{route('admin.get.action.product',['active',$product->id])}}" class="badge {{$product->getStatus($product->p_active)['class']}}">
                                                {{$product->getStatus($product->p_active)['name']}}
                                            </a>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="edit-delete">
                                            <div class="row">
                                                <a href="{{route('admin.get.edit.product', $product->id)}}"><i class="fas fa-edit"></i> Sửa</a>
                                            </div>
                                            <div class="row">
                                                <a href="{{route('admin.get.action.product', ['delete', $product->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                {!! $products->appends(Request::all())->links() !!}

            </div>
        </div>
    </div>
@stop
