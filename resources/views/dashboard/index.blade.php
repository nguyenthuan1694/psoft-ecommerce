@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <!-- Container -->
    <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-sm">
                    <div class="card-body">
                        <span class="d-block text-center font-25 font-weight-500 text-dark text-uppercase mb-10">Đồ án quản lý nhà sách</span>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                <span class="d-block">
                                    <span class="display-5 font-weight-400 text-dark"></span>
                                    <small>Họ tên:</small>
                                    <strong>Hồ Nguyễn Thanh Thảo</strong>
                                </span>
                                <span class="d-block">
                                    <span class="display-5 font-weight-400 text-dark"></span>
                                    <small>Mã số sinh viên:</small>
                                    <strong>21850026</strong>
                                </span>
                            </div>
                            <div>
                                <span class="text-danger font-12 font-weight-600"></span>
                            </div>
                        </div>
                        <div class="progress progress-bar-xs mt-30">
                            <div class="progress-bar bg-success w-100" role="progressbar" 
                            aria-valuenow="" aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Container -->
@endsection

@section('script')
@endsection
