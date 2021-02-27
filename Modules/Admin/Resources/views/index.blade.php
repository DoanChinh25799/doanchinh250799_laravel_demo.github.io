@extends('admin::layouts.master')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">1000 THÀNH VIÊN</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">1000 SẢN PHẨM</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">1000 ĐƠN HÀNG</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">1000 BÀI VIẾT</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Danh sách đơn hàng mới</div>
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
                                    <th>Ghi chú</th>
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
{{--                                            <a href="{{route('admin.get.action.transaction',['delete',$transaction->id])}}"><i class="fas fa-trash-alt"></i> Xóa</a>--}}
                                            <a id="aurl" class="js_order_item" data-id="{{$transaction->id}}" data-toggle="modal"
                                               data-target="#ModalOrder" href="{{route('admin.get.view.order', $transaction->id)}}">    <i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Danh sách sản phẩm mới</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 15px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Phân loại</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($products))
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
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
                                            <td>
                                                <div class="f_active">
                                                    <a href="{{route('admin.get.action.product',['active',$product->id])}}" class="badge {{$product->getStatus($product->p_active)['class']}}">
                                                        {{$product->getStatus($product->p_active)['name']}}
                                                    </a>
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
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Danh sách liên hệ mới</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 15px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Chủ đề</th>
                                    <th>Nội dung</th>
                                    <th>Tình trạng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($contacts))
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{$contact->id}}</td>
                                            <td>{{$contact->name}}</td>
                                            <td>{{$contact->subject}}</td>
                                            <td>{{$contact->content}}</td>
                                            <td>
                                                <a href="{{route('admin.get.action.contact',['active',$contact->id])}}" class="badge {{$contact->status ==1? 'badge-primary':'badge-warning'}}">{{$contact->status  ==1? 'Đã xử lý':'Chưa xử lý'}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
@endsection

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

