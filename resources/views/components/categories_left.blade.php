<div class="col-md-3 product-price">

    <div class=" rsidebar span_1_of_left">
        <div class="of-left">
            <h3 class="cate">Thể loại</h3>
        </div>
        <ul class="menu">
            @if(isset($categories))
                @foreach($categories as $category)
                    <li class="item{{$category->id}}"><a class="color{{$category->id}}" href="{{route('get.list.product',[$category->c_slug, $category->id])}}">{{$category->c_name}}</a>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="product-middle">

        <div class="fit-top">
            <h6 class="shop-top">Lorem Ipsum</h6>
            <a href="single.html" class="shop-now">SHOP NOW</a>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="sellers">
        <div class="of-left-in">
            <h3 class="tags-price">Khoảng giá</h3>
        </div>
        <div class="tags-price">
            <ul>
                <li><a class="{{Request::get('price')==1?'active':''}}" href="{{request()->fullUrlWithQuery(['price' => 1])}}">Dưới 100.000đ</a></li>
                <li><a class="{{Request::get('price')==2?'active':''}}" href="{{request()->fullUrlWithQuery(['price' => 2])}}">100.000đ-300.000đ</a></li>
                <li><a class="{{Request::get('price')==3?'active':''}}" href="{{request()->fullUrlWithQuery(['price' => 3])}}">300.000đ-700.000đ</a></li>
                <li><a class="{{Request::get('price')==4?'active':''}}" href="{{request()->fullUrlWithQuery(['price' => 4])}}">700.000đ-1.500.000đ</a></li>
                <li><a class="{{Request::get('price')==5?'active':''}}" href="{{request()->fullUrlWithQuery(['price' => 5])}}">Trên 1.500.000đ</a></li>

                <div class="clearfix"></div>
            </ul>

        </div>

    </div>
    <div class="sellers">
        <div class="of-left-in">
            <h3 class="tag">Tags</h3>
        </div>
        <div class="tags">
            <ul>
                <li><a href="#">design</a></li>
                <li><a href="#">fashion</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">dress</a></li>
                <li><a href="#">fashion</a></li>
                <li><a href="#">dress</a></li>
                <li><a href="#">design</a></li>
                <li><a href="#">dress</a></li>
                <li><a href="#">design</a></li>
                <li><a href="#">fashion</a></li>
                <li><a href="#">lorem</a></li>
                <li><a href="#">dress</a></li>

                <div class="clearfix"></div>
            </ul>

        </div>

    </div>
    <!---->
    <div class="product-bottom">
        <div class="of-left-in">
            <h3 class="best">Best Sellers</h3>
        </div>
        @if(isset($bestsellers))
            @foreach($bestsellers as $best)
                <div class="product-go">
                    <div class=" fashion-grid">
                        <a href="{{route('get.detail.product',[$best->p_slug, $best->id])}}"><img class="img-responsive " src="{{pare_url_file($best->p_img)}}" alt=""></a>

                    </div>
                    <div class=" fashion-grid1">
                        <h6 class="best2"><a href="#">{{$best->p_name}}</a></h6>

                        <span class=" price-in1">{{number_format($best->p_sale_price,0,',','.')}} VNĐ</span>
                    </div>

                    <div class="clearfix"></div>
                </div>
            @endforeach
        @endif

    </div>
</div>
