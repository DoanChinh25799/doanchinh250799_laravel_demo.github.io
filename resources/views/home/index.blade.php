@extends('layouts.app')
@section('content')
    @include('components.banner')
    <div class="content">
        <div class="container">
            <div class="content-top">
                @if(isset($productHot))
                    <h1>SẢN PHẨM NỔI BẬT</h1>
                    <div class="grid-in">
                        @foreach($productHot as $hot)
                            <div class="col-md-4 grid-top">
                            <a href="{{route('get.detail.product',[Illuminate\Support\Str::slug($hot->p_name),$hot->id])}}" class="b-link-stripe b-animate-go  thickbox">
                                <div class="home-img">
                                    @if($hot->p_amount == 0)
                                        <span style="position: absolute; background: red; color: white; text-align: center; padding: 2px 58px; border-radius: 5px; font-size: 15px; font-style: italic; float: left">Tạm hết hàng</span>
                                    @endif
                                    <img class="img-responsive" src="{{pare_url_file($hot->p_img)}}" alt="">
                                </div>
                                <div class="b-wrapper">
                                    <h3 class="b-animate b-from-left    b-delay03 ">
                                        @if($hot->p_promotion!=0)
                                            <span>Giá bán: {{number_format($hot->p_sale_price*(1-($hot->p_promotion)/100),0,',','.')}}đ (Giảm {{$hot->p_promotion}}%) <b style="text-decoration-line: line-through;">{{number_format($hot->p_sale_price,0,',','.')}}đ</b></span>
                                        @else
                                            <span>Giá bán: {{number_format($hot->p_sale_price*(1-($hot->p_promotion)/100),0,',','.')}}đ</span>
                                        @endif
                                    </h3>
                                </div>
                            </a>
                            <p style=" white-space: nowrap;text-overflow: ellipsis; overflow: hidden;"><a href="{{route('get.detail.product',[Illuminate\Support\Str::slug($hot->p_name),$hot->id])}}">{{$hot->p_name}}</a></p>
                        </div>
                        @endforeach
                        <div class="clearfix"> </div>
                    </div>
                @endif
            </div>
            <!----->
            <div class="content-top">
                @if(isset($productHot))
                    <h2>SẢN PHẨM MỚI</h2>
                    <div class="grid-in">
                        @foreach($productNews as $new)
                            <div class="col-md-4 grid-top">
                                <a href="{{route('get.detail.product',[Illuminate\Support\Str::slug($new->p_name),$new->id])}}" class="b-link-stripe b-animate-go  thickbox">
                                    <div class="home-img">
                                        @if($new->p_amount == 0)
                                            <span style="position: absolute; background: red; color: white; text-align: center; padding: 2px 58px; border-radius: 5px; font-size: 15px; font-style: italic; float: left">Tạm hết hàng</span>
                                        @endif
                                        <img class="img-responsive" src="{{pare_url_file($new->p_img)}}" alt="">
                                    </div>
                                    <div class="b-wrapper">
                                        <h3 class="b-animate b-from-left    b-delay03 ">
                                            @if($new->p_promotion!=0)
                                                <span>Giá bán: {{number_format($new->p_sale_price*(1-($new->p_promotion)/100),0,',','.')}}đ (Giảm {{$new->p_promotion}}%) <b style="text-decoration-line: line-through;">{{number_format($new->p_sale_price,0,',','.')}}đ</b></span>
                                            @else
                                                <span>Giá bán: {{number_format($new->p_sale_price*(1-($new->p_promotion)/100),0,',','.')}}đ</span>
                                            @endif
                                        </h3>
                                    </div>
                                </a>
                                <p style=" white-space: nowrap;text-overflow: ellipsis; overflow: hidden;"><a href="{{route('get.detail.product',[Illuminate\Support\Str::slug($new->p_name),$new->id])}}">{{$new->p_name}}</a></p>
                            </div>
                        @endforeach
                        <div class="clearfix"> </div>
                    </div>
                @endif
            </div>

            <div class="content-top-bottom">
                @if(isset($productPopular))
                    <h2>SẢN PHẨM ĐƯỢC MUA NHIỀU</h2>
                    <div class="grid-in">
                        @foreach($productPopular as $popular)
                            <div class="col-md-4 grid-top">
                                <a href="{{route('get.detail.product',[Illuminate\Support\Str::slug($popular->p_name),$popular->id])}}" class="b-link-stripe b-animate-go  thickbox">
                                    <div class="home-img">
                                        @if($popular->p_amount == 0)
                                            <span style="position: absolute; background: red; color: white; text-align: center; padding: 2px 58px; border-radius: 5px; font-size: 15px; font-style: italic; float: left">Tạm hết hàng</span>
                                        @endif
                                        <img class="img-responsive" src="{{pare_url_file($popular->p_img)}}" alt="">
                                    </div>
                                    <div class="b-wrapper">
                                        <h3 class="b-animate b-from-left    b-delay03 ">
                                            @if($popular->p_promotion!=0)
                                                <span>Giá bán: {{number_format($popular->p_sale_price*(1-($popular->p_promotion)/100),0,',','.')}}đ (Giảm {{$popular->p_promotion}}%) <b style="text-decoration-line: line-through;">{{number_format($popular->p_sale_price,0,',','.')}}đ</b></span>
                                            @else
                                                <span>Giá bán: {{number_format($popular->p_sale_price*(1-($popular->p_promotion)/100),0,',','.')}}đ</span>
                                            @endif
                                        </h3>
                                    </div>
                                </a>
                                <p style=" white-space: nowrap;text-overflow: ellipsis; overflow: hidden; text-align: center"><a href="{{route('get.detail.product',[Illuminate\Support\Str::slug($popular->p_name),$popular->id])}}">{{$popular->p_name}}</a></p>
                            </div>
                        @endforeach
                        <div class="clearfix"> </div>
                    </div>
                @endif
                <div class="clearfix"> </div>
            </div>
        </div>
        <!---->
        <div class="content-bottom">
            <ul>
                <li><a href="#"><img class="img-responsive" src="{{asset('images/lo.png')}}" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="{{asset('images/lo1.png')}}" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="{{asset('images/lo2.png')}}" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="{{asset('images/lo3.png')}}" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="{{asset('images/lo4.png')}}" alt=""></a></li>
                <li><a href="#"><img class="img-responsive" src="{{asset('images/lo5.png')}}" alt=""></a></li>
                <div class="clearfix"> </div>
            </ul>
        </div>
    </div>
@stop
