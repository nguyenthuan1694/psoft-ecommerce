<div class="sidebar" data-color="rose" data-background-color="black">
    <div class="logo">
        <a href="{{ route('admin.home') }}" class="simple-text logo-mini">
            P
        </a>
        <a href="{{ route('admin.home') }}" class="simple-text logo-normal">
            Soft
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Route::currentRouteName() == 'admin.home' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'categories.index' || 
                Route::currentRouteName() == 'categories.create') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#category">
                    <i class="material-icons">storage</i>
                    <p>
                        Danh mục
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ (Route::currentRouteName() == 'categories.index' || 
                Route::currentRouteName() == 'categories.create') ? 'show' : '' }}" id="category">
                    <ul class="nav">
                        <li class="nav-item {{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('categories.index') }}">
                                <span class="sidebar-mini"> DS </span>
                                <span class="sidebar-normal"> Danh sách danh mục </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'categories.create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('categories.create') }}">
                                <span class="sidebar-mini"> TM </span>
                                <span class="sidebar-normal"> Thêm mới danh mục</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'products.index' || 
                Route::currentRouteName() == 'products.create' || Route::currentRouteName() == 'product.trashed') 
                ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#products">
                    <i class="material-icons">local_parking</i>
                    <p>
                        Sản phẩm
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ (Route::currentRouteName() == 'products.index' || 
                Route::currentRouteName() == 'products.create' || Route::currentRouteName() == 'product.trashed') 
                ? 'show' : '' }}" id="products">
                    <ul class="nav">
                        <li class="nav-item {{ Route::currentRouteName() == 'products.index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <span class="sidebar-mini"> DS </span>
                                <span class="sidebar-normal"> Danh sách sản phẩm </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'products.create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('products.create') }}">
                                <span class="sidebar-mini"> TM </span>
                                <span class="sidebar-normal"> Thêm mới sản phẩm </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'product.trashed' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('product.trashed') }}">
                                <span class="sidebar-mini"> SPH </span>
                                <span class="sidebar-normal"> Sản phẩm đã hủy </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'orders.index' || Route::currentRouteName() == 'order.trashed') 
                ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#orderEx">
                    <i class="material-icons">shopping_basket</i>
                    <p>
                        Order
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ (Route::currentRouteName() == 'orders.index' || Route::currentRouteName() == 'order.trashed') 
                ? 'show' : '' }}" id="orderEx">
                    <ul class="nav">
                        <li class="nav-item {{ Route::currentRouteName() == 'orders.index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <span class="sidebar-mini"> DS </span>
                                <span class="sidebar-normal"> Danh sách order </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'order.trashed' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('order.trashed') }}">
                                <span class="sidebar-mini"> ODH </span>
                                <span class="sidebar-normal"> order đã hủy </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'news.index' || Route::currentRouteName() == 'news.create' || Route::currentRouteName() == 'new.trashed') 
                ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#newsEx">
                    <i class="material-icons">text_fields</i>
                    <p>
                        Tin Tức
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ (Route::currentRouteName() == 'news.index' || Route::currentRouteName() == 'news.create'|| Route::currentRouteName() == 'new.trashed') 
                ? 'show' : '' }}" id="newsEx">
                    <ul class="nav">
                        <li class="nav-item {{ Route::currentRouteName() == 'news.index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('news.index') }}">
                                <span class="sidebar-mini"> DS </span>
                                <span class="sidebar-normal"> Danh sách tin tức </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'news.create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('news.create') }}">
                                <span class="sidebar-mini"> TT </span>
                                <span class="sidebar-normal"> Thêm tin tức mới </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'new.trashed' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('new.trashed') }}">
                                <span class="sidebar-mini"> TDH </span>
                                <span class="sidebar-normal"> Tin đã hủy </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ (Route::currentRouteName() == 'banners.index' || Route::currentRouteName() == 'banner.trashed' || Route::currentRouteName() == 'banners.create') 
                ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#bannerEx">
                    <i class="material-icons">image</i>
                    <p>
                        Banner
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ (Route::currentRouteName() == 'banners.index' || Route::currentRouteName() == 'banner.trashed' || Route::currentRouteName() == 'banners.create') 
                ? 'show' : '' }}" id="bannerEx">
                    <ul class="nav">
                        <li class="nav-item {{ Route::currentRouteName() == 'banners.index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('banners.index') }}">
                                <span class="sidebar-mini"> DS </span>
                                <span class="sidebar-normal"> Danh sách banner </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'banners.create' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('banners.create') }}">
                                <span class="sidebar-mini"> TM </span>
                                <span class="sidebar-normal"> Thêm mới banner </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::currentRouteName() == 'banner.trashed' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('banner.trashed') }}">
                                <span class="sidebar-mini"> BNH </span>
                                <span class="sidebar-normal"> Banner đã hủy </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

@section('script')

<script>
    // Activate parent and child elements when User Profile is selected
$(document).ready(function() {
    var url = window.location;
    $('ul.nav a[href="' + url + '"]').parent().addClass('active');
    $('ul.nav a').filter(function() {
        return this.href == url;
    }).parent().addClass('active').parent().parent().addClass('show');
});
</script>
@endsection