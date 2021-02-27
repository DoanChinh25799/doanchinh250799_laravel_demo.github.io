@extends('layouts.products')
@section('content')
    <div class="col-md-9 product-price1">
        @if(isset($productDetail))
            <div class="col-md-5 single-top">
                <div class="flexslider">
                    <ul class="slides">
                        @if(isset($groupproducts))
                            @foreach($groupproducts as $pd)
                                <li data-thumb="{{pare_url_file($pd->p_img)}}">
{{--                                    style="height: 305.75px; width: 304px"--}}
                                    <img   style="height: 305.75px; width: 304px" src="{{pare_url_file($pd->p_img)}}"/>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <!-- FlexSlider -->
                <script defer src="{{asset('js/jquery.flexslider.js')}}"></script>
                <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen"/>

                <script>
                    // Can also be used with $(document).ready()
                    $(window).load(function () {
                        $('.flexslider').flexslider({
                            animation: "slide",
                            controlNav: "thumbnails"
                        });
                    });
                </script>
            </div>
            <div class="col-md-7 single-top-in simpleCart_shelfItem">
                <div class="single-para ">
                    <h4>{{$productDetail->p_name}}</h4>
                    <div class="star-on">
                        <ul class="star-footer">
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                            <li><a href="#"><i> </i></a></li>
                        </ul>
                        <div class="review">
                            <a href="#"> 1 customer review </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <h5 class="item_price">{{number_format($productDetail->p_sale_price*(1-$productDetail->p_promotion/100),0,',','.')}}đ</h5>

                    @if($productDetail->p_promotion>0)
                        <h5><span style="text-decoration-line: line-through">{{number_format($productDetail->p_sale_price,0,',','.')}}đ</span>   <span>(Giảm {{$productDetail->p_promotion}}%)</span></h5>
                    @endif

                    <p>{{$productDetail->p_description}} </p>
                    <ul class="tag-men">
                        <li><span>TAG</span>
                            <span class="women1">: Women,</span></li>
                        <li><span>SKU</span>
                            <span class="women1">: CK09</span></li>
                    </ul>
                    <form action="" method="POST">
                        @csrf
                    <div class="available">
                        <div class="form-group">
                            <ul>
                                <li class="size-in">Màu sắc
                                    <select name="color_id" id="">
                                        <option value="-1">--- Chọn màu sắc ---</option>
                                        @if(isset($colors))
                                            @foreach($colors as $key=>$value)
                                                <option
                                                    value="{{$key}}">{{$value}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </li>
                                <li class="size-in">Kích thước
                                    <select name="size_id">
                                        <option value="-1">--- Chọn kích thước ---</option>
                                        @if(isset($sizes))
                                            @foreach($sizes as $key=>$value)
                                                <option
                                                    value="{{$key}}">{{$value}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>

                    </div>

{{--                        <a href="{{route('add.shopping.cart.group',[$productDetail->id,])}}" class="add-cart item_add">ADD TO CART</a>--}}

                        <button type="submit" style=" background-color: #EF5F21; color: white; border-radius: 7px; height: 33px"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <!---->
            <div class="cd-tabs is-ended">
                <nav>
                    <ul class="cd-tabs-navigation">
                        <li><a class="js_product_detail" href="{{route('get.detail.content.product',$productDetail->id)}}" data-id="{{$productDetail->id}}" data-toggle="modal"
                               data-target="#ModalDetail">Chi tiết</a></li>
                        <li><a data-content="fashion" href="#0">Đề xuất </a></li>
                        <li><a data-content="television" href="#0" class="selected ">Đánh giá (1)</a></li>

                    </ul>
                </nav>
                <ul class="cd-tabs-content">
                    <li data-content="fashion">
                        <div class="facts">
                            <p> There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't look
                                even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be
                                sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum
                                generators on the Internet tend to repeat predefined chunks as necessary, making this the
                                first true generator on the Internet. It uses a dictionary of over 200 Latin words,
                                combined </p>
                            <ul>
                                <li>Research</li>
                                <li>Design and Development</li>
                                <li>Porting and Optimization</li>
                                <li>System integration</li>
                                <li>Verification, Validation and Testing</li>
                                <li>Maintenance and Support</li>
                            </ul>
                        </div>

                    </li>
                    <li data-content="cinema">
                        <div class="facts1">
                            <div class="color"><p>Color</p>
                                <span>Blue, Black, Red</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="color">
                                <p>Size</p>
                                <span>S, M, L, XL</span>
                                <div class="clearfix"></div>
                            </div>

                        </div>

                    </li>
                    <li data-content="television" class="selected">
                        <div class="comments-top-top">
                            <div class="top-comment-left">
                                <img class="img-responsive" src="{{asset('images/co.png')}}" alt="">
                            </div>
                            <div class="top-comment-right">
                                <h6><a href="#">Hendri</a> - September 3, 2014</h6>
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <p>Wow nice!</p>
                            </div>
                            <div class="clearfix"></div>
                            <a class="add-re" href="#">ADD REVIEW</a>
                        </div>

                    </li>
                    <div class="clearfix"></div>
                </ul>
            </div>

        @endif
        <div class=" bottom-product">
            <h4 style="padding-left: 15px; margin-bottom: 15px;">SẢN PHẨM TƯƠNG TỰ</h4>
            @if(isset($productCategory))
                @foreach($productCategory as $pro)
                    <div class="col-md-4 bottom-cd simpleCart_shelfItem">
                        <div class="product-at ">
                            <a href="{{route('get.detail.product',[$pro->p_slug, $pro->id])}}"><img class="img-responsive" src="{{pare_url_file($pro->p_img)}}" alt="">
                                <div class="pro-grid">
                                    <span class="buy-in">Buy Now</span>
                                </div>
                            </a>
                        </div>
                        <p class="descrip" style="font-size: 12px; margin: 0.3em 0 1em; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; color: #4a3a3a; text-align: center">
                            {{$pro->p_description}}
                        </p>
                        <a href="{{route('add.shopping.cart',$pro->id)}}" class="item_add"><p class="number item_price"><i> </i>{{$pro->p_sale_price}}đ
                            </p></a>
                    </div>
                @endforeach
            @endif
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div id="ModalDetail" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg result" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi sản phẩm #<b class="product_id"></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="pro_content">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('detail')
    <script type="text/javascript">
        $(function () {
            $(".js_product_detail").click(function(event) {
                event.preventDefault();
                let $this = $(this);
                let url = $this.attr('href');
                $("#pro_content").html('');
                $(".product_id").text('').text($this.attr('data-id'));
                $("#ModalDetail").modal('show');

                $.ajax({
                    url:url,
                }).done(function(result){
                    if(result){
                        $("#pro_content").append(result);
                    }
                });
            });
        })
    </script>
@stop
