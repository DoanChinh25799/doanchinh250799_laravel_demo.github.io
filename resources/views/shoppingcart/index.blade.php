@extends('layouts.app')
<!--content-->
<!---->
@section('content')
    <div class="container">
        <div class="title-cart">
            <h2>Có {{Cart::count()}} mặt hàng giỏ của bạn</h2>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1?>
                        @foreach($listcart as $key => $product)
                            <tr>
                                <td>#{{$i}}</td>
                                <td>
                                    <img style="width: 100px; height: 80px" src="{{pare_url_file($product->options->image)}}">
                                </td>
                                <td>
                                    <a href="#">{{$product->name}}</a>
                                    <div>
                                        Màu sắc: {{$product->options->color_id}}
                                    </div>
                                    <div>
                                        Kích thước: {{$product->options->size_id}}
                                    </div>
                                </td>
                                <td>
                                    <div class="edit-delete">
                                        <a href='{{route('change.qty.shopping.cart',['decrement', $key])}}'><i class="fas fa-minus"></i></a>
                                        <span class="border">{{$product->qty}}</span>
                                        <a href='{{route('change.qty.shopping.cart',['increment', $key])}}'><i class="fas fa-plus"></i></a>
                                    </div>
                                </td>
                                <td>{{number_format($product->options->price_old,0,',','.')}}đ</td>
                                <td>{{$product->options->promotion}}%</td>
                                <td>{{number_format($product->price * $product->qty,0,',','.')}}đ</td>
                                <td>
                                    <div class="edit-delete">
                                        <a href="{{route('del.shopping.cart.item', $key)}}">  <i class="fas fa-trash"></i>  Xóa</a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bottom-cart">
            <div class="col-md-2" style="float: right">
                <a href="{{route('get.form.pay')}}" class="btn btn-success" >Thanh toán</a>
            </div>
            <div style="float: right" class="col-md-3" ><h4 style=" color: #023a66">Tổng tiền:   {{Cart::subtotal()}}đ</h4></div>
        </div>

        <div class="clearfix"></div>
    </div>
@stop
