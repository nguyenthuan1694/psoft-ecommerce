<nav class="hk-nav hk-nav-light">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#report_drp">
                        <i class="ion ion-md-analytics"></i>
                        <span class="nav-link-text">Thống kê báo cáo</span>
                    </a>
                    <ul id="report_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('reportIn.index') }}">Báo cáo tồn sách</a>
                                </li>
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('reportRebt.index') }}">Báo có công nợ</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#book_drp">
                        <i class="ion ion-ios-book" ></i>
                        <span class="nav-link-text">Danh sách sách</span>
                    </a>
                    <ul id="book_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('book.index') }}">Danh sách</a>
                                </li>
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('book.create') }}">Nhập sách</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#bill_drp">
                        <i class="ion ion-md-list-box" ></i>
                        <span class="nav-link-text">Danh sách hóa đơn</span>
                    </a>
                    <ul id="bill_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('bill.index') }}">D.sách hóa đơn</a>
                                </li>
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('bill.create') }}">Lập hóa đơn</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#receipts_drp">
                        <i class="ion ion-md-list-box" ></i>
                        <span class="nav-link-text">Danh sách phiếu thu</span>
                    </a>
                    <ul id="receipts_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('receipt.index') }}">D.sách phiếu thu</a>
                                </li>
                                <li class="nav-item ml-5">
                                    <a class="nav-link" href="{{ route('receipt.create') }}">Lập phiếu thu</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
