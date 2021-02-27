<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Admin System</title>
    <link href="{{asset('themes_admin/css/styles.css')}}" rel="stylesheet"/>
    <link href="{{asset('themes_admin/css/bootstrap.min.css')}}">
    <script src="{{asset('themes_admin/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('themes_admin/js/jquery-3.5.1.js')}}"></script>

    <script src="{{asset('themes_admin/js/bootstrap.min.js')}}"></script>

    <script src="https://kit.fontawesome.com/97ba42d8aa.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#output_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#input_img').change(function () {
            readURL(this);
        });
    </script>
{{--    @yield('ckeditor')--}}
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <img style="width: 50px; height: 50px; border-radius: 50%; background-size: cover" src="{{pare_url_file(get_data_user('admins','avatar'))}}">
    <a class="navbar-brand" href="#">Xin chào!   {{get_data_user('admins','name')}}</a>

{{--    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>--}}
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
                   aria-describedby="basic-addon2"/>
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{route('admin.home')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        TỔNG QUAN
                    </a>

                    <div class="sb-sidenav-menu-heading"><span><a href="#"><i
                                    class="fas fa-home"></i> DANH SÁCH</a> </span>
                        <div class="{{Route::currentRouteName()}}=='admin.get.list.category'?'active':'">
                            <a class="nav-link" href="{{route('admin.get.list.category')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Danh mục
                            </a>
                        </div>

                        <div class="{{Route::currentRouteName()}}=='admin.get.list.product'?'active':'">
                            <a class="nav-link" href="{{route('admin.get.list.product')}}">
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                                Sản phẩm
                            </a>
                        </div>

                        <div class="{{Route::currentRouteName()}}=='admin.get.list.article'?'active':'">
                            <a class="nav-link" href="{{route('admin.get.list.article')}}">
                                <div class="sb-nav-link-icon"><i class="far fa-newspaper"></i></div>
                                Tin tức
                            </a>
                        </div>

                        <div class="{{Route::currentRouteName()}}=='admin.get.list.properties'?'active':'">
                            <a class="nav-link" href="{{route('admin.get.list.properties')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-feather-alt"></i></div>
                                Thuộc tính sp
                            </a>
                        </div>
                        <div class="{{Route::currentRouteName()}}=='admin.get.list.account'?'active':'">
                            <a class="nav-link" href="{{route('admin.get.list.account')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                                Tài khoản
                            </a>
                        </div>
                        <div class="{{Route::currentRouteName()}}=='admin.get.list.transaction'?'active':'">
                            <a class="nav-link" href="{{route('admin.get.list.transaction')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                                Đơn hàng
                            </a>
                        </div>

                        <div class="{{Route::currentRouteName()}}=='admin.get.list.contact'?'active':'">
                            <a class="nav-link" href="{{route('admin.get.list.contact')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text"></i></div>
                                Liên hệ
                            </a>
                        </div>

                    </div>

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @if ( Session::has('success') )
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif

            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif
            @yield('content')
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2019</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

@yield('ckeditor')
@yield('script')
</body>
</html>
