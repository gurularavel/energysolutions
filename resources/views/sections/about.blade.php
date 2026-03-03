<section id="about"></section>
<section class="service-style1-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="service-style1__title">
                    <div class="sec-title sec-title--style2">
                        <div class="sub-title">
                            <div class="border-box"></div>
                            <h3>Haqqımızda</h3>
                        </div>
                    </div>
                    <div class="inner-text">
                        <p>{{ $about->content ?? '" Energy Solutions" MMC 2020-ci ildən fəaliyyət göstərir və əsas fəaliyyət istiqaməti neft-qaz yataqlarının effektiv işlənməsini təmin etmək üçün zəruri geoloji-laboratoriya tədqiqatlarını aparır' }}</p>
                    </div>
                    @if($about && $about->button_text)
                    <div class="btns-box">
                        <a class="btn-one" href="{{ $about->button_link ?? '#' }}">
                            <span class="txt">{{ $about->button_text }}<i class="icon-refresh arrow"></i></span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-7">
                <div class="service-style1__content">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="single-service-style1">
                                <div class="shape-box"></div>
                                <div class="icon-holder"><span class="icon-mobile-analytics"></span></div>
                                <div class="title-holder"><h3><a href="{{ lroute('home') }}#services">Xidmətlər</a></h3></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="single-service-style1">
                                <div class="shape-box"></div>
                                <div class="icon-holder"><span class="icon-help"></span></div>
                                <div class="title-holder">
                                    <h3>
                                        <a href="{{ $settings->policy_pdf ? asset($settings->policy_pdf) : asset('assets/policy/Policy.pdf') }}" target="_blank">Siyasətlərimiz</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="single-service-style1">
                                <div class="shape-box"></div>
                                <div class="icon-holder"><span class="icon-checking"></span></div>
                                <div class="title-holder"><h3><a href="{{ lroute('certificates') }}">Lisenziya və<br> Sertifikatlar</a></h3></div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="single-service-style1">
                                <div class="shape-box"></div>
                                <div class="icon-holder"><span class="icon-creative"></span></div>
                                <div class="title-holder"><h3><a href="#">Layihələr</a></h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
