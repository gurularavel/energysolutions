@if($testimonials->isNotEmpty())
<section class="testimonial-style1-area">
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3></h3>
            </div>
            <h2>{{ __('frontend.sections.testimonials') }}</h2>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="testimonial-style1-content">
                    <div class="theme_carousel testimonial-carousel owl-theme owl-carousel" data-options='{
                        "loop": true, "margin": 30, "autoheight":true, "lazyload":true,
                        "nav": false, "dots": false, "autoplay": true, "autoplayTimeout": 5000,
                        "smartSpeed": 500,
                        "responsive":{"0":{"items":"1"},"600":{"items":"1"},"768":{"items":"1"},"992":{"items":"2"},"1200":{"items":"2"}}
                    }'>
                        @foreach($testimonials as $testimonial)
                        <div class="single-testimonial-style1">
                            <div class="text">
                                <p>{{ $testimonial->quote }}</p>
                            </div>
                            <div class="bottom-box">
                                <div class="client-name">
                                    <h3>{{ $testimonial->client_name }}</h3>
                                    <span>{{ $testimonial->client_title }}</span>
                                </div>
                                <div class="client-img">
                                    <div class="inner">
                                        @if($testimonial->hasMedia('photo'))
                                            <img src="{{ $testimonial->getFirstMediaUrl('photo') }}" alt="{{ $testimonial->client_name }}">
                                        @else
                                            <img src="{{ asset('assets/images/testimonial/testimonial-v1-1.jpg') }}" alt="{{ $testimonial->client_name }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
