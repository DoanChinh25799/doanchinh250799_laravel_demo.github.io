@extends('layouts.app')
<!--content-->
<!---->
@section('content')
    <div class="blog">
        <div class="container">
            <h1>Blog</h1>
            <div class="blog-top">
                @if(isset($articles))
                    <?php $i = 0?>
                    @foreach($articles as $article)
                        <div class="col-md-6 grid_3">
                            <h3><a href="{{route('get.detail.article',[$article->a_slug,$article->id])}}">{{$article->a_name}}</a></h3>
                            <a href="{{route('get.detail.article',[$article->a_slug,$article->id])}}"><img src="{{pare_url_file($article->a_avatar)}}" class="img-responsive" alt="" style="height: 303.45px; width: 540px"/></a>

                            <div class="blog-poast-info">
                                <ul>
                                    <li><a class="admin" href="#"><i> </i> Admin </a></li>
                                    <li><span><i class="date"> </i>{{$article->updated_at}}</span></li>
                                    <li><a class="p-blog" href="#"><i class="comment"> </i>100 Bình luận</a></li>
                                </ul>
                            </div>
                            <p>{{$article->a_description}}</p>
                            <div class="button"><a href="{{route('get.detail.article',[$article->a_slug,$article->id])}}">xem thêm</a></div>
                        </div>
                        <?php $i++?>
                            @if($i%2==0)
                                <div class="clearfix"> </div>
                            @endif
                    @endforeach
                        <div class="clearfix"></div>
                        <div class="row" style="float: right; padding: 20px">
                            {!! $articles->links() !!}
                        </div>
                @endif
            </div>
        </div>
    </div>
@stop
