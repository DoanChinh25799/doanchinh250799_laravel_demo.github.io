@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.contact')}}">Liên hệ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý danh mục liên hệ</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Danh sách liên hệ<a href="{{route('admin.get.create.category')}}" class="float-right"><i class="fas fa-plus-circle"></i> Thêm</a></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Chủ đề</th>
                        <th>Nội dung</th>
                        <th>Tình trạng</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Chủ đề</th>
                        <th>Nội dung</th>
                        <th>Tình trạng</th>
                        <th>Thao tác</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @if(isset($contacts))
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{$contact->id}}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->subject}}</td>
                                <td>{{$contact->content}}</td>
                                <td>
                                    <a href="{{route('admin.get.action.contact',['active',$contact->id])}}" class="badge {{$contact->status ==1? 'badge-primary':'badge-warning'}}">{{$contact->status  ==1? 'Đã xử lý':'Chưa xử lý'}}</a>
                                </td>
                                <td>
                                    <div class="edit-delete">
                                        <a href="{{route('admin.get.action.contact', ['delete', $contact->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>
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
