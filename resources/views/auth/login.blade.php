@extends('layouts.app')
@section('content')
<div class="container">
    <div class="account">
        <h1>Đăng nhập</h1>
        <div class="account-pass">
            <div class="col-md-8 account-top">
                <div class="form-horizontal">
                    <hr />
                    <form method="POST" action="{{ route('post.login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ghi nhớ mật khẩu') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Đăng nhập') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Quên mật khẩu?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(isset($sale))
                @foreach($sale as $sal)
                    <div class="col-md-1"></div>
                    <div class="col-md-3 left-account ">
                        <a href="{{route('get.detail.product',[$sal->p_slug, $sal->id])}}"><img class="img-responsive " src="{{pare_url_file($sal->p_img)}}" alt="" style="height:100%; width:100%"></a>
                        <div class="five">
                            <h2>{{$sal->p_promotion}}% </h2><span>discount</span>
                        </div>
                        <a href="{{route('get.register')}}" class="create">Đăng ký</a>
                        <div class="clearfix"> </div>
                    </div>
                @endforeach
            @endif
            <div class="clearfix"> </div>
        </div>

    </div>

</div>
@endsection
