@extends('layouts.app')
<!--content-->
<!---->
@section('content')

    <div class="container">
        <div class="title-cart">
            <h2>Thanh toán giỏ hàng</h2>
        </div>
        <div class="container wrapper">
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="">
                    @csrf
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                        <!--REVIEW ORDER-->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Thông tin giỏ hàng
                                <div class="pull-right"><small><a class="" href="{{route('get.list.cart')}}">Cập nhật</a></small></div>
                            </div>
                            <div class="panel-body">
                                @foreach($listcart as $product)
                                    <div class="form-group">
                                        <div class="col-sm-3 col-xs-3">
                                            <img class="img-responsive" style="width: 110px; height: 100px" src="{{pare_url_file($product->options->image)}}" />
                                        </div>
                                        <div class="col-sm-5 col-xs-5">
                                            <div class="col-xs-12"><h5><b>{{$product->name}}</b></h5></div>
                                            <div class="col-xs-12"><small>Số lượng x <span>{{$product->qty}}</span></small></div>
                                            <div class="col-xs-12"><small>Màu sắc: {{$product->options->color_id}}</small></div>
                                            <div class="col-xs-12"><small>Kích thước: {{$product->options->size_id}}</small></div>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 text-left">
                                            <div class="col-xs-12" style="margin-top: 20px"><small>Đơn giá: {{number_format($product->options->price_old,0,',','.')}}  <span>VNĐ</span></small></div>
                                            <div class="col-xs-12"><small>Khuyến mại: {{$product->options->promotion}}%</small></div>
                                            <div class="col-xs-12"><small>Thành tiền: <br>{{number_format($product->price * $product->qty,0,',','.')}} VNĐ</small></div>
{{--                                            <h6>Đơn giá: {{number_format($product->options->price_old,0,',','.')}}  <span>VNĐ</span></h6>--}}
{{--                                            <h6>Khuyến mại: {{$product->options->promotion}}%</h6>--}}
{{--                                            <h5>Thành tiền: {{number_format($product->price * $product->qty,0,',','.')}} VNĐ </h5>--}}
                                        </div>
                                    </div>
                                    <div class="form-group"><hr /></div>
                                @endforeach

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <strong>Tổng tiền</strong>
                                        <b><div class="pull-right"><span>{{Cart::subtotal()}}</span><span>   VNĐ</span></div></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--REVIEW ORDER END-->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                        <!--SHIPPING METHOD-->
                        <div class="panel panel-info">
                            <div class="panel-heading">Thông tin thanh toán</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-6 col-xs-12">
                                        <strong>Tên người nhận:</strong>
                                        <input type="text" name="first_name" class="form-control" value="{{get_data_user('web','name')}}" />
                                    </div>
                                    <div class="span1"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Địa chỉ:</strong></div>
                                    <div class="col-md-12">
                                        <input type="text" name="address" class="form-control" value="{{get_data_user('web','address')}}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Số điện thoại:</strong></div>
                                    <div class="col-md-12"><input type="text" name="phone" class="form-control" value="{{get_data_user('web','phone')}}" /></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Địa chỉ email:</strong></div>
                                    <div class="col-md-12"><input type="email" name="email_address" class="form-control" value="{{get_data_user('web','email')}}" /></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Ghi chú:</strong></div>
                                    <div class="col-md-12">
                                        <textarea class="form-control" cols="30" rows="4" name="note"  value=""></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!--SHIPPING METHOD END-->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" style="float: right; padding-right: 16px;">
                                Xác nhận thông tin
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="row cart-footer">

            </div>
        </div>
    </div>
@stop
