<section id="services" class="service-style2-area">
    <div class="service-style2--primary-bg"></div>
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3></h3>
            </div>
            <h2>Xidmətlərimiz</h2>
        </div>
        <div class="row text-right-rtl">
            @foreach($services as $service)
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="single-service-style2">
                    <div class="img-holder">
                        <div class="inner">
                            @if($service->hasMedia('card_image'))
                                <img src="{{ $service->getFirstMediaUrl('card_image') }}" alt="{{ $service->title }}">
                            @else
                                <img src="{{ asset('assets/images/services/service-v1-' . $loop->iteration . '.jpg') }}" alt="{{ $service->title }}">
                            @endif
                        </div>
                        <div class="icon">
                            <span class="{{ $service->card_icon_class ?? 'icon-check' }}"></span>
                        </div>
                    </div>
                    <div class="title-holder">
                        <h3><a href="{{ lroute('services.show', ['service' => $service->slug]) }}">{{ $service->title }}</a></h3>
                        <div class="text"></div>
                        <div class="btn-box">
                            <a href="{{ lroute('services.show', ['service' => $service->slug]) }}"><span class="icon-right-arrow"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
