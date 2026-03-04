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
                    <div class="lang-switcher" style="position:relative;margin-left:12px">
                        <button onclick="this.nextElementSibling.classList.toggle('open')"
                                style="font-size:12px;font-weight:700;padding:4px 10px;border-radius:4px;background:#20bad1;color:#fff;border:none;cursor:pointer;display:flex;align-items:center;gap:5px">
                            {{ strtoupper($currentLocale) }}
                            <span style="font-size:9px">&#9660;</span>
                        </button>
                        <div class="lang-dropdown"
                             style="display:none;position:absolute;top:calc(100% + 4px);right:0;background:#fff;border:1px solid #e0e0e0;border-radius:4px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.1);z-index:9999;min-width:60px">
                            @foreach(['az' => 'AZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label)
                                @if($code !== $currentLocale)
                                    @php
                                        try {
                                            $params = array_merge(request()->route()->parameters(), ['locale' => $code]);
                                            $url = route(request()->route()->getName(), $params);
                                        } catch (\Throwable $e) {
                                            $url = '/' . $code;
                                        }
                                    @endphp
                                    <a href="{{ $url }}"
                                       style="display:block;font-size:12px;font-weight:700;padding:6px 14px;color:#333;text-decoration:none;white-space:nowrap"
                                       onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background=''">
                                        {{ $label }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <script>
                        document.addEventListener('click', function(e) {
                            var dd = document.querySelector('.lang-dropdown');
                            if (dd && !dd.previousElementSibling.contains(e.target)) {
                                dd.classList.remove('open');
                            }
                        });
                        document.querySelector('.lang-dropdown') && (function() {
                            var style = document.createElement('style');
                            style.textContent = '.lang-dropdown.open{display:block!important}';
                            document.head.appendChild(style);
                        })();
                    </script>

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
            <div class="mobile-lang-switcher" style="display:flex;justify-content:center;padding:12px 0 4px">
                <div style="position:relative;display:inline-block">
                    <button onclick="this.nextElementSibling.classList.toggle('mob-open')"
                            style="font-size:13px;font-weight:700;padding:5px 14px;border-radius:4px;background:#20bad1;color:#fff;border:none;cursor:pointer;display:flex;align-items:center;gap:6px">
                        {{ strtoupper($currentLocale) }}
                        <span style="font-size:10px">&#9660;</span>
                    </button>
                    <div class="mob-lang-dropdown"
                         style="display:none;position:absolute;top:calc(100% + 4px);left:50%;transform:translateX(-50%);background:#fff;border:1px solid #e0e0e0;border-radius:4px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.15);z-index:9999;min-width:70px;text-align:center">
                        @foreach(['az' => 'AZ', 'ru' => 'RU', 'en' => 'EN'] as $code => $label)
                            @if($code !== $currentLocale)
                                @php
                                    try {
                                        $params = array_merge(request()->route()->parameters(), ['locale' => $code]);
                                        $url = route(request()->route()->getName(), $params);
                                    } catch (\Throwable $e) {
                                        $url = '/' . $code;
                                    }
                                @endphp
                                <a href="{{ $url }}"
                                   style="display:block;font-size:13px;font-weight:700;padding:7px 14px;color:#333;text-decoration:none">
                                    {{ $label }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <style>.mob-lang-dropdown.mob-open{display:block!important}</style>
                <script>
                    document.addEventListener('click', function(e) {
                        var dd = document.querySelector('.mob-lang-dropdown');
                        if (dd && !dd.previousElementSibling.contains(e.target)) {
                            dd.classList.remove('mob-open');
                        }
                    });
                </script>
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
