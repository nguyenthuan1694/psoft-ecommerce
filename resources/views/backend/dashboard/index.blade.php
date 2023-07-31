@extends('backend.layouts.app')

@section('content')
<div class="content">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">shopping_basket</i>
                            </div>
                            <p class="card-category">Orders</p>
                            <h3 class="card-title">{{ $orderTotal }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">local_offer</i> 
                                <a href="{{ route('orders.index') }}">Get More Space...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">local_parking</i>
                            </div>
                            <p class="card-category">Sản phẩm</p>
                            <h3 class="card-title">{{ $productTotal }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                              <i class="material-icons">local_offer</i> 
                              <a href="{{ route('products.index') }}">Get More Space...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">text_fields</i>
                            </div>
                            <p class="card-category">Tin tức</p>
                            <h3 class="card-title">{{ $newsTotal }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                              <i class="material-icons">local_offer</i> 
                              <a href="{{ route('news.index') }}">Get More Space...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">image</i>
                            </div>
                            <p class="card-category">Banner</p>
                            <h3 class="card-title">{{ $bannerTotal }}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                              <i class="material-icons">local_offer</i> 
                              <a href="{{ route('banners.index') }}">Get More Space...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initCharts();
    });
</script>  
@endsection
