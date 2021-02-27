@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.account')}}">Danh sách tài khoản</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý tài khoản</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Tài khoản<a href="#" class="float-right"><i class="fas fa-plus-circle"></i> Thêm</a></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên người dùng</th>
                        <th>Ảnh</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($users))
                        @foreach($users as $user)
                            <tr>
                                <td>#{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <img src="{{pare_url_file($user->avatar)}}" alt="" class="img-responsive-ad">
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    <div class="f_active">
                                        @if($user->active == 1)
                                            <a href="{{route('admin.get.action.account',['active',$user->id])}}" class="badge badge-primary">Public</a>
                                        @else
                                            <a href="{{route('admin.get.action.account',['active',$user->id])}}" class="badge badge-warning">Private</a>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <div class="edit-delete">
                                        <div class="row">
                                            <a href="{{route('admin.get.action.account', ['delete', $user->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>
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
