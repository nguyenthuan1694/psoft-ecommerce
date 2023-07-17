@extends('frontend.layouts.app')

@section('content')
   <style>
    .lazyloaded {
        opacity: 1;
        transition: opacity 400ms;
        transition-delay: 0ms;
    }
    .title-contact {
        color: #044943;
    }
    .contact-content {
        font-style: italic;
        color: #044943;
    }
   </style>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-3">
                    <h4 class="text-center title-contact">PSOFT</h4>
                    <div>
                        <p class="contact-content">
                            <strong>“Psoft là một trong những doanh nghiệp uy tín có trụ sở tại TPHCM với nhiều năm&nbsp;kinh nghiệm hoạt động&nbsp;trong lĩnh vực công nghệ thông tin.
                            công ty chúng tôi chuyên cung cấp dịch vụ website, phần mềm, server lưu trữ dữ liệu, quảng cáo trực tuyến, thương mại điện tử.&nbsp;Với đội ngũ kỹ thuật viên giỏi, 
                            có trình độ chuyên môn cao, đội ngũ nhân viên tư vấn nhiệt tình, được đào tạo bài bản về chuyên môn, 
                            dịch vụ và thái độ phục vụ khách hàng của đội ngũ nhân viên.“</strong>
                        </p>
                        <h5 class="title-contact"><span>THÔNG TIN LIÊN HỆ</span></h5>
                        <ul>
                            <li><span style="font-size: 95%;"><strong>Trụ sở chính:</strong>
                                <b>296 Hòa Bình Phường Hiệp Tân Quận Tân Phú TP.HCM</b></span>
                            </li>
                            <li><span style="font-size: 95%;"><strong>Website:</strong>&nbsp;<a href="https://Psoft.com" target="_blank" rel="noopener">https://Psoft.com</a></span></li>
                            <li><span style="font-size: 95%;"><strong>Hotline:</strong> <strong>090.8855.483</strong></span></li>
                            <li><strong>Email: nguyenthuan1694@gmail.com</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">HỖ TRỢ TRỰC TUYẾN</h4>
                        </div>
                        <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                            <div class="avatar me-3">
                                <img src="{{ asset('frontend/images/avatars/team-1.jpg') }}" alt="kal" class="border-radius-lg shadow">
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-2 text-sm">Nguyễn Văn Thuận</h6>
                                <p class="mb-2 text-sm"><strong>Nhân viên tư vấn</strong></p>
                                <p class="mb-2 text-sm"><strong>Phone</strong> : 090.8855.483</p>
                                <p class="mb-0 text-sm"><strong>Zalo:</strong> 090.8855.483</p>
                            </div>
                            
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="avatar me-3">
                                <img src="{{ asset('frontend/images/avatars/team-2.jpg') }}" alt="kal" class="border-radius-lg shadow">
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-2 text-sm">Nguyễn Văn Thuận</h6>
                                <p class="mb-2 text-sm"><strong>Nhân viên tư vấn</strong></p>
                                <p class="mb-2 text-sm"><strong>Phone</strong> : 090.8855.483</p>
                                <p class="mb-0 text-sm"><strong>Zalo:</strong> 090.8855.483</p>
                            </div>
                            
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        </ul>
                        </div>
                    </div>
                    </div>
            </div>
            <div style="border: 2px #186760 solid; border-radius: 5px; margin: 25px 0 25px 0;">
                <iframe class="lazyloaded" width="100%" height="400px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2330.548218545332!2d106.62267191046728!3d10.773019585502354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752c1f3e464a67%3A0xb46325dba1084e44!2zMjk2IEjDsmEgQsOsbmgsIFBow7ogVGjhuqFuaCwgVMOibiBQaMO6LCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmggNzAwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1688021035016!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection