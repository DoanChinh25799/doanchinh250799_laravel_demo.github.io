<div class="banner">
    <div class="container1">
        <script src="{{asset('js/responsiveslides.min.js')}}"></script>
        <script>
            $(function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
            });
        </script>
        @if(isset($articleNews))
            <div id="top" class="callbacks_container">
                <ul class="rslides" id="slider">
                    @foreach($articleNews as $arNews)
                        <li>
                            <div class="banner-img" style="background-image: url({{pare_url_file($arNews->a_avatar)}})">
                                <div class="banner-format">
                                    <div class="banner-text">
                                        <div class="align-text-bottom">
                                            <h3>{{$arNews->a_name}}</h3>
                                            <p>{{$arNews->a_description}}</p>
                                            <a href="{{route('get.detail.article',[$arNews->a_slug, $arNews->id])}}">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
