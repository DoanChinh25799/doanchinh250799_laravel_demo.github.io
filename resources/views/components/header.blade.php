<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="search">
                <form action="{{route('get.search.list.product')}}" id="searchform" method="GET">
                    <input type="text" value="{{isset($key)?$key:""}}" name="key" placeholder="Tìm kiếm">
                    <input type="submit" value="Go">
                </form>
            </div>
            <div class="header-left">
                @if(Auth::check())
                    <?php $user = Auth::user()?>
                        <ul>
                            <li> <a href="#"><span><img src="{{pare_url_file($user->avatar)}}" style="max-width: 40px; max-height: 40px"> </span> Xin chào! {{$user->name}}</a></li>
                            <li> <a class="lock" href="{{route('get.logout.user')}}">Đăng xuất</a></li>
                        </ul>
                @else
                    <ul>
                        <li ><a class="lock"  href="{{route('get.login')}}"  >Đăng nhập</a></li>
                        <li><a class="lock" href="{{route('get.register')}}"  >Đăng ký</a></li>
                        <li>
                        </li>
                    </ul>
                @endif
                <div class="cart box_1">
                    <a href="{{route('get.list.cart')}}">
                        <h3> <div class="total">
                                <span class="">{{Cart::subtotal()}}đ</span> (<span>{{Cart::count()}}</span> sản phẩm)</div>
                            <img src="{{asset('images/cart.png')}}" alt=""/></h3>
                    </a>
                    <p><a href="{{route('del.shopping.cart')}}" class="simpleCart_empty">Empty Cart</a></p>

                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="container">
        <div class="head-top">
            <div class="logo">
                <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
            </div>
            <div class=" h_menu4">
                <ul class="memenu skyblue">
                    <li class="active grid"><a class="color8" href="{{route('home')}}">Trang chủ</a></li>
                    <li class="grid"><a class="color1" href="{{route('get.list.product',['thoi-trang-nam',4])}}">Sản phẩm</a>
                        <div class="mepanel" style="width: 350px">
                            <div class="row">
                                <div class="col">
                                    <div class="h_nav">
                                        <ul style="text-align: center">
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <li><a class="color{{$category->id}}" href="{{route('get.list.product',[$category->c_slug, $category->id])}}">{{$category->c_name}}</a>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a class="color4" href="{{route('get.list.article')}}">Tin tức</a></li>
                    <li><a class="color6" href="{{route('get.contact')}}">Liên hệ</a></li>
                </ul>
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>

</div>
