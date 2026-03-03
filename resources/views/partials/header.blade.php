<header class="main-header header-style-one">

    <div class="header">
        <div class="auto-container">
            <div class="outer-box">

                <div class="header-left">
                    <div class="main-logo-box">
                        <a href="{{ lroute('home') }}">
                            @if($settings->hasMedia('logo'))
                                <img src="{{ $settings->getFirstMediaUrl('logo') }}" alt="{{ $settings->company_name }}" title="">
                            @else
                                <img src="{{ asset('assets/images/resources/logo.png') }}" alt="Energy Solutions" title="">
                            @endif
                        </a>
                    </div>

                    <div class="nav-outer style1 clearfix">
                        <div class="mobile-nav-toggler">
                            <div class="inner">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                        </div>
                        <nav class="main-menu style1 navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix scroll-nav">
                                    <li><a href="{{ lroute('home') }}#banner">{{ __('frontend.nav.home') }}</a></li>

                                    <li class="dropdown {{ request()->routeIs('services.show') ? 'current' : '' }}">
                                        <a href="{{ lroute('home') }}#services">{{ __('frontend.nav.services') }}</a>
                                        <ul>
                                            @foreach($allServices as $service)
                                                <li><a href="{{ lroute('services.show', ['service' => $service->slug]) }}">{{ $service->title }}</a></li>
                                            @endforeach
                                            <li><a href="{{ lroute('experiment.show') }}">{{ __('frontend.nav.experiments') }}</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="{{ lroute('certificates') }}">{{ __('frontend.nav.certificates') }}</a></li>

                                    <li class="dropdown {{ request()->routeIs('gallery') || request()->routeIs('video-gallery') ? 'current' : '' }}">
                                        <a href="{{ lroute('gallery') }}">{{ __('frontend.nav.gallery') }}</a>
                                        <ul>
                                            <li><a href="{{ lroute('gallery') }}">{{ __('frontend.nav.photo_gallery') }}</a></li>
                                            <li><a href="{{ lroute('video-gallery') }}">{{ __('frontend.nav.video_gallery') }}</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="{{ lroute('home') }}#blank">{{ __('frontend.nav.order_form') }}</a></li>
                                    <li><a href="{{ lroute('home') }}#blog">{{ __('frontend.nav.news') }}</a></li>
                                    <li><a href="{{ lroute('home') }}#contact">{{ __('frontend.nav.contact') }}</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="header-right">
                    <div class="phone-number-box1">
                        <div class="icon">
                            <span class="icon-phone-call"></span>
                        </div>
                        <div class="phone">
                            <a href="tel:{{ $settings->phone }}">{{ $settings->phone ?? '(+994 10) 225-24-78' }}</a>
                        </div>
                    </div>

                    {{-- Language switcher --}}
                    <div class="lang-switcher" style="display:flex;gap:4px;align-items:center;margin-left:12px">
                        @foreach(['az' => 'AZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label)
                            @php
                                try {
                                    $params = array_merge(request()->route()->parameters(), ['locale' => $code]);
                                    $url = route(request()->route()->getName(), $params);
                                } catch (\Throwable $e) {
                                    $url = '/' . $code;
                                }
                            @endphp
                            <a href="{{ $url }}"
                               style="font-size:12px;font-weight:600;padding:2px 6px;border-radius:3px;{{ $currentLocale === $code ? 'background:#c8a227;color:#fff' : 'color:#555' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <div class="serach-button-style1">
                        <button type="button" class="search-toggler">
                            <i class="icon-magnifying-glass"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="sticky-header">
        <div class="container">
            <div class="clearfix">
                <div class="logo float-left">
                    <a href="{{ lroute('home') }}" class="img-responsive">
                        @if($settings->hasMedia('sticky_logo'))
                            <img src="{{ $settings->getFirstMediaUrl('sticky_logo') }}" alt="" title="">
                        @else
                            <img src="{{ asset('assets/images/resources/sticky-logo.png') }}" alt="" title="">
                        @endif
                    </a>
                </div>
                <div class="right-col float-right">
                    <nav class="main-menu clearfix"></nav>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon fa fa-times-circle"></span></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="{{ lroute('home') }}">
                    @if($settings->hasMedia('mobile_logo'))
                        <img src="{{ $settings->getFirstMediaUrl('mobile_logo') }}" alt="" title="">
                    @else
                        <img src="{{ asset('assets/images/resources/mobilemenu-logo.png') }}" alt="" title="">
                    @endif
                </a>
            </div>
            <div class="menu-outer"></div>

            {{-- Mobile language switcher --}}
            <div class="mobile-lang-switcher" style="display:flex;justify-content:center;gap:8px;padding:12px 0 4px">
                @foreach(['az' => 'AZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label)
                    @php
                        try {
                            $params = array_merge(request()->route()->parameters(), ['locale' => $code]);
                            $url = route(request()->route()->getName(), $params);
                        } catch (\Throwable $e) {
                            $url = '/' . $code;
                        }
                    @endphp
                    <a href="{{ $url }}"
                       style="font-size:13px;font-weight:700;padding:4px 12px;border-radius:4px;text-decoration:none;{{ $currentLocale === $code ? 'background:#c8a227;color:#fff' : 'background:#f0f0f0;color:#555' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="social-links">
                <ul class="clearfix">
                    @if($settings->facebook_url)
                        <li><a href="{{ $settings->facebook_url }}"><span class="fab fa fa-facebook-square"></span></a></li>
                    @endif
                    @if($settings->twitter_url)
                        <li><a href="{{ $settings->twitter_url }}"><span class="fab fa fa-twitter-square"></span></a></li>
                    @endif
                    @if($settings->pinterest_url)
                        <li><a href="{{ $settings->pinterest_url }}"><span class="fab fa fa-pinterest-square"></span></a></li>
                    @endif
                    @if($settings->youtube_url)
                        <li><a href="{{ $settings->youtube_url }}"><span class="fab fa fa-youtube-square"></span></a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

</header>
