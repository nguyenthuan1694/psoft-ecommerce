<link rel="stylesheet" href="{{ asset('frontend/css/header1.css') }}" />
<div class="overlay-custom"></div>

<div class="utility-nav d-none d-md-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <p class="small"><i class="fa fa-envelope"></i> nguyenthuan1694@gmail.com </p>
            </div>

            <div class="col-12 col-md-6" style="text-align: right;">
                <p class="small">Hotline: 090 8855 483</p>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-md navbar-light bg-light main-menu" style="box-shadow: none;">
    <div class="container">
        <button type="button" id="sidebarCollapseCustom" class="btn btn-list-icon d-block d-md-none">
            <i class="fas fa-list"></i>
        </button>

        <a class="btn btn-success" href="{{ route('home') }}">
            <img style="width: 150px" src="{{ asset('frontend/images/logos/logo_login.png') }}" class="img-fluid" alt="">
        </a>

        <ul class="navbar-nav ml-auto d-block d-md-none">
            @include('frontend.includes.cart_menu')
        </ul>

        <div class="collapse navbar-collapse">
            <form class="form-inline my-2 my-lg-0 mx-auto" action="{{ route('search') }}" method="get">
                <input class="form-control" name="query" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" />
                <button class="btn btn-success my-2 my-sm-0 btnCustom" type="submit"><i class="fas fa-search"></i></button>
            </form>

            <ul class="navbar-nav">
                @include('frontend.includes.cart_menu')
                <!-- <li class="nav-item ml-md-3">
                    <a class="btn btn-primary" href="#"><i class="bx bxs-user-circle mr-1"></i> Log In / Register</a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light bg-light sub-menu">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav menuCustom mx-auto">
                <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="has-child">
                    <a href="#" class="nav-link sub">Sản phẩm <i class="fas fa-sort-down subicont-current"></i></a>
                    <ul class="sub-ul-menu">
                        @include('frontend.includes.categories_top_menu', ['categories' => $categories])
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></i>Giới thiệu</a>
                    <!-- <i class="fas fa-exchange-alt"> -->
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'news-of-event' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('news-of-event') }}">Tin tức</a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="search-bar d-block d-md-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form class="form-inline my-3 mx-auto" action="{{ route('search') }}" method="get">
                <input class="form-control" name="query" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search" />
                <button class="btn btn-success my-sm-0 btnCustom" type="submit"><i class="fas fa-search"></i></button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar -->
<nav id="sidebarCustom">
    <div class="sidebar-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-8 pl-0">
                    <a class="btn btn-success" href="{{ route('home') }}">
                        <img style="width: 150px" src="{{ asset('frontend/images/logos/logo_login.png') }}" class="img-fluid" alt="">
                    </a>
                </div>

                <div class="col-4">
                    <button type="button" id="sidebarCollapseX" class="btn btn-default-sidebar">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <ul class="list-unstyled components links">
        <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}"><i class="bx bx-home mr-3"></i> Trang chủ</a>
        </li>
        <li class="has-child-fix">
            <a href="#" class="nav-link sub"> Sản phẩm <i class="fas fa-sort-down subicont"></i></a>
            <ul class="sub-ul-menu-fix">
                @include('frontend.includes.categories_top_menu', ['categories' => $categories])
            </ul>
        </li>
        
        <li class="nav-item">
                <a class="nav-link" href="#">Giới thiệu</a>
                <!-- <i class="fas fa-exchange-alt"> -->
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'news-of-event' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('news-of-event') }}">Tin tức</a>
            </li>
            <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
            </li>
    </ul>
</nav>
