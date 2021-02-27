@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.get.list.transaction')}}">Danh sách đơn hàng</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
        <h1 class="mt-4">Quản lý đơn hàng</h1>
    </div>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Đơn hàng<a href="#" class="float-right"><i
                    class="fas fa-plus-circle"></i> Thêm</a></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Tổng tiền</th>
                        <th width= "15%">Ghi chú</th>
                        <th>Tình trạng</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                #{{$transaction->id}}
                            </td>
                            <td>
                                {{isset($transaction->tr_user_id)?$transaction->user->name:'[N/A]'}}
                            </td>
                            <td>
                                {{$transaction->tr_address}}
                            </td>
                            <td>
                                {{$transaction->tr_phone}}
                            </td>
                            <td>
                                {{number_format($transaction->tr_total,0,',','.')}}đ
                            </td>
                            <td>
                                {{$transaction->tr_note}}
                            </td>
                            <td>
                                @if($transaction->tr_status == 1)
                                    <a href="#" class="badge badge-primary">Đã xác nhận</a>
                                @else
                                    <a href="{{route('admin.get.active.transaction',$transaction->id)}}" class="badge badge-warning">Chưa xác nhận</a>
                                @endif
                            </td>
                            <td>
                                {{date_format($transaction->created_at,'d-m-Y')}}
                            </td>
                            <td>
                                <a href="{{route('admin.get.action.transaction',['delete',$transaction->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>
                                <a id="aurl" class="js_order_item" data-id="{{$transaction->id}}" data-toggle="modal"
                                   data-target="#ModalOrder" href="{{route('admin.get.view.order', $transaction->id)}}">    <i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $transactions->appends(Request::all())->links() !!}
            </div>
        </div>
    </div>

    <div id="ModalOrder" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg result" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết mã đơn hàng #<b class="transaction_id"></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="md_content">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $(function () {
            $(".js_order_item").click(function(event) {
                event.preventDefault();
                let $this = $(this);
                let url = $this.attr('href');
                $("#md_content").html('');
                $(".transaction_id").text('').text($this.attr('data-id'));
                $("#ModalOrder").modal('show');

                $.ajax({
                    url:url,
                }).done(function(result){
                    if(result){
                        $("#md_content").append(result);
                    }
                });
            });
        })
    </script>
@stop

