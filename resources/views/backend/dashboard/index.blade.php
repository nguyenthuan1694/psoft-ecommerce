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
                                <i class="material-icons">weekend</i>
                            </div>
                            <p class="card-category">Bookings</p>
                            <h3 class="card-title">184</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">warning</i>
                                <a href="#pablo">Get More Space...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">equalizer</i>
                            </div>
                            <p class="card-category">Website Visits</p>
                            <h3 class="card-title">75.521</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats"><i class="material-icons">local_offer</i> Tracked from Google Analytics</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Revenue</p>
                            <h3 class="card-title">$34,245</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats"><i class="material-icons">date_range</i> Last 24 Hours</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="fa fa-twitter"></i>
                            </div>
                            <p class="card-category">Followers</p>
                            <h3 class="card-title">+245</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats"><i class="material-icons">update</i> Just Updated</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                      <i class="material-icons">timeline</i>
                    </div>
                    <h4 class="card-title">Coloured Line Chart
                      <small> - Rounded</small>
                    </h4>
                  </div>
                  <div class="card-body">
                    <div id="colouredRoundedLineChart" class="ct-chart"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                      <i class="material-icons">insert_chart</i>
                    </div>
                    <h4 class="card-title">Multiple Bars Chart
                      <small>- Bar Chart</small>
                    </h4>
                  </div>
                  <div class="card-body">
                    <div id="multipleBarsChart" class="ct-chart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="card">
                  <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                      <i class="material-icons">timeline</i>
                    </div>
                    <h4 class="card-title">Coloured Bars Chart
                      <small> - Rounded</small>
                    </h4>
                  </div>
                  <div class="card-body">
                    <div id="colouredBarsChart" class="ct-chart"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="card card-chart">
                  <div class="card-header card-header-icon card-header-danger">
                    <div class="card-icon">
                      <i class="material-icons">pie_chart</i>
                    </div>
                    <h4 class="card-title">Pie Chart</h4>
                  </div>
                  <div class="card-body">
                    <div id="chartPreferences" class="ct-chart"></div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-12">
                        <h6 class="card-category">Legend</h6>
                      </div>
                      <div class="col-md-12">
                        <i class="fa fa-circle text-info"></i> Apple
                        <i class="fa fa-circle text-warning"></i> Samsung
                        <i class="fa fa-circle text-danger"></i> Windows Phone
                      </div>
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
