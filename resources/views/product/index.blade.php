@extends('layouts.products')
<!--content-->
<!---->
@section('content')
    <div class="col-md-9 product1">
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" id="form_order">
            <div class="input-group">
                <div class="form-control">
                    <select name="orderby" class="orderby" style="width: 200px">
                        <option {{Request::get('orderby')=='md'|| Request::get('orderby')?"selected='selected":''}} value="md">Sắp xếp</option>
                        <option {{Request::get('orderby')=='orby_desc'?"selected='selected":''}} value="orby_desc">Mới nhất</option>
                        <option {{Request::get('orderby')=='orby_price_incre'?"selected='selected":''}} value="orby_price_incre">Giá tăng dần</option>
                        <option {{Request::get('orderby')=='orby_price_decre'?"selected='selected":''}} value="orby_price_decre">Giá giảm dần</option>
                    </select>
                </div>
            </div>
        </form>
        @if(isset($categories1))
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item">Thể loại</li>
                <li class="breadcrumb-item active" aria-current="page">{{$categories1->c_name}}</li>
            </ol>
        </nav>
        @else
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Kết quả tìm kiếm cho '{{$key}}'</li>
                </ol>
            </nav>

        @endif
        @if(isset($products))
            <div class=" bottom-product">
                <?php $i=0 ?>
                @foreach($products as $product)
                    <div class="col-md-4 bottom-cd simpleCart_shelfItem">
                        <div class="product-at ">
                            <a href="{{route('get.detail.product',[$product->p_slug, $product->id])}}">
                                <div class="cate-img">
                                    @if($product->p_amount == 0)
                                        <span style="position: absolute; background: red; color: white; text-align: center; padding: 2px 58px; border-radius: 5px; font-size: 15px; font-style: italic; float: left">Tạm hết hàng</span>
                                    @endif
                                    <img class="img-responsive" src="{{pare_url_file($product->p_img)}}" alt="">
                                </div>
                                <div class="pro-grid">
                                    <span class="buy-in">Mua ngay</span>
                                </div>
                            </a>
                        </div>
                        <p class="tun">{{$product->p_name}}</p>
                        <a href="{{route('add.shopping.cart',$product->id)}}" class="item_add"><p class="number item_price"><i> </i>{{number_format($product->p_sale_price,0,',','.')}}VNĐ</p></a>
                    </div>
                        <?php $i++ ?>
                    @if($i%3==0)
                        <div class="clearfix"></div>
                        <hr>
                    @endif
                @endforeach
                <div class="clearfix"></div>
                    <div class="row" style="float: right; padding: 20px">
                        {!! $products->appends(Request::all())->links() !!}
                    </div>
            </div>
        @endif

    </div>
    <div class="clearfix"></div>
@stop

@section('script')
    <script type="text/javascript">
        $(function (){
            $('.orderby').change(function (){
                $('#form_order').submit();
            })
        })
    </script>
@stop

