@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.properties')}}">Thuộc tính</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý thuộc tính sản phẩm</h1>

    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    @include("admin::properties.form")
                </div>
            </div>
        </div>
    </div>
@stop
