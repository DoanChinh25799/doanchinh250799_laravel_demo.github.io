@extends('layouts.app')
<!--content-->
<!---->
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="blog">
                <div class="">
                    <div class="blog-top">
                        <div class="article-content">
                            <div class=" grid_3 grid-1">
                                <h3><a href="#">{{$articleDetail->a_name}}</a></h3>
                                <a href="#"><img src="{{pare_url_file($articleDetail->a_avatar)}}" class="img-responsive" alt=""/></a>
                                <div class="blog-poast-info">
                                    <ul>
                                        <li><a class="admin" href="#"><i> </i> Admin </a></li>
                                        <li><span><i class="date"> </i>{{$articleDetail->updated_at}}</span></li>
                                        <li><a class="p-blog" href="#"><i class="comment"> </i>100 Bình luận</a></li>
                                    </ul>
                                </div>
                                <div >
                                    {!! $articleDetail->a_content !!}
                                </div>
                            </div>
                        </div>

                        {{--                <div class="single-bottom">--}}

                        {{--                    <h3>Leave A Comment</h3>--}}
                        {{--                    <form>--}}

                        {{--                        <input type="text" value="Name" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Name';}">--}}

                        {{--                        <input type="text" value="Email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Email';}">--}}

                        {{--                        <input type="text" value="Subject" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Subject';}">--}}


                        {{--                        <textarea cols="77" rows="6" value=" " onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>--}}

                        {{--                        <input type="submit" value="Send">--}}

                        {{--                    </form>--}}
                        {{--                </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="new-article">
                <div class="">
                    <h3 class="">Danh sách bài viết mới</h3>
                </div>
                <ul class="menu">
                    @if(isset($articleNews))
                        @foreach($articleNews as $article)
                            <li class="item{{$article->id}}"><a class="color{{$article->id}}" href="{{route('get.detail.article',[$article->a_slug, $article->id])}}"><i class="fas fa-external-link-alt"></i>   {{$article->a_name}}</a>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

@stop
