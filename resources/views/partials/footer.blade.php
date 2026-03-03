<section id="contact" class="main-contact-form-area">
<footer class="footer-area">
    <div class="footer">
        <div class="container">
            <div class="row text-right-rtl">

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="single-footer-widget single-footer-widget--company-info marbtm50">
                        <div class="our-company-info">
                            <div class="text-box">
                                <p>{{ $settings->address ?? 'Bəhruz Nuriyev 1/77, Nizami r, Bakı, Azərbaycan' }}</p>
                            </div>
                            <h2><a href="tel:{{ $settings->phone }}">{{ $settings->phone ?? '(+994 10) 225-24-78' }}</a></h2>
                            <h3><a href="mailto:{{ $settings->email }}">{{ $settings->email ?? 'office@energysolutions.az' }}</a></h3>
                            <div class="footer-social-link">
                                <ul class="clearfix">
                                    @if($settings->twitter_url)
                                        <li><a href="{{ $settings->twitter_url }}"><i class="icon-twitter"></i></a></li>
                                    @endif
                                    @if($settings->facebook_url)
                                        <li><a href="{{ $settings->facebook_url }}"><i class="icon-facebook-circular-logo"></i></a></li>
                                    @endif
                                    @if($settings->pinterest_url)
                                        <li><a href="{{ $settings->pinterest_url }}"><i class="icon-pinterest"></i></a></li>
                                    @endif
                                    @if($settings->instagram_url)
                                        <li><a href="{{ $settings->instagram_url }}"><i class="icon-instagram"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="single-footer-widget single-footer-widget--link-box marbtm50">
                        <div class="title">
                            <h3>{{ __('frontend.footer.site_map') }}</h3>
                        </div>
                        <div class="footer-widget-links">
                            <ul>
                                <li><a href="{{ lroute('home') }}#banner">{{ __('frontend.nav.home') }}</a></li>
                                <li><a href="{{ lroute('home') }}#about">{{ __('frontend.footer.about') }}</a></li>
                                <li><a href="{{ lroute('home') }}#services">{{ __('frontend.nav.services') }}</a></li>
                                <li><a href="{{ lroute('home') }}#blog">{{ __('frontend.nav.news') }}</a></li>
                            </ul>
                            <ul class="right">
                                <li><a href="{{ lroute('home') }}#blank">{{ __('frontend.nav.order_form') }}</a></li>
                                <li><a href="{{ lroute('certificates') }}">{{ __('frontend.nav.certificates') }}</a></li>
                                <li><a href="{{ lroute('gallery') }}">{{ __('frontend.nav.gallery') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="bottom-inner">
                <div class="footer-logo-style1">
                    <a href="{{ lroute('home') }}">
                        @if($settings->hasMedia('footer_logo'))
                            <img src="{{ $settings->getFirstMediaUrl('footer_logo') }}" alt="Energy Solutions" title="">
                        @else
                            <img src="{{ asset('assets/images/footer/footer-logo.png') }}" alt="Energy Solutions" title="">
                        @endif
                    </a>
                </div>
                <div class="copyright">
                    <p>{!! $settings->footer_copyright ?? 'Copyright &copy; 2024 <a href="https://itnom.com">IT-NOM</a> All Rights Reserved.' !!}</p>
                </div>
            </div>
        </div>
    </div>

</footer>
