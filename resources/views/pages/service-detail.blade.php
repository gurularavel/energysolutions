@extends('layouts.app')

@section('title', $service->title . ' - Energy Solutions')

@section('content')

<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url({{ $service->hasMedia('breadcrumb_image') ? $service->getFirstMediaUrl('breadcrumb_image') : asset('assets/images/breadcrumb/1-1.png') }});"></div>
    <div class="shape-box"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="{{ lroute('home') }}">{{ __('frontend.nav.home') }}</a></li>
                            <li><a href="{{ lroute('home') }}#services">{{ __('frontend.nav.services') }}</a></li>
                            <li class="active">{{ $service->title }}</li>
                        </ul>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>{{ $service->title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="service-details-area">
    <div class="container">
        <div class="row">

            <div class="col-xl-4 col-lg-5 order-box-2">
                <div class="service-details__sidebar">

                    <div class="view-all-service">
                        <ul class="service-pages">
                            @foreach($allServices as $svc)
                            <li class="{{ $svc->id === $service->id ? 'active' : '' }}">
                                <a href="{{ lroute('services.show', ['service' => $svc->slug]) }}">
                                    {{ $svc->title }} <span class="icon-right-arrow"></span>
                                </a>
                            </li>
                            @endforeach
                            <li class="{{ $service->type === 'experiment' ? 'active' : '' }}">
                                <a href="{{ lroute('experiment.show') }}">
                                    {{ __('frontend.service.experiments') }} <span class="icon-right-arrow"></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="service-details-contact-info text-center">
                        <div class="sidebar-info-box-bg"
                            style="background-image: url({{ asset('assets/images/sidebar/sidebar-info-box-bg.jpg') }});"></div>
                        <div class="icon"><span class="icon-phone-call"></span></div>
                        <h3>{{ __('frontend.service.contact_us') }}</h3>
                        <h2><a href="tel:{{ $settings->phone ?? '(+994 10) 225-24-78' }}">{{ $settings->phone ?? '(+994 10) 225-24-78' }}</a></h2>
                    </div>

                </div>
            </div>

            <div class="col-xl-8 col-lg-7 order-box-1">
                <div class="service-details__content">

                    @if($service->hasMedia('featured_image'))
                    <div class="img-box-outer">
                        <div class="img-box1">
                            <img src="{{ $service->getFirstMediaUrl('featured_image') }}" alt="{{ $service->title }}" />
                        </div>
                        <div class="icon">
                            <span class="{{ $service->featured_icon_class ?? 'icon-creative' }}"></span>
                        </div>
                    </div>
                    @endif

                    <div class="text-box1">
                        <h2>{{ $service->title }}</h2>
                    </div>

                    @php
                        $group1Items = $service->checklistItems->where('section_group', 'group1')->values();
                        $group2Items = $service->checklistItems->where('section_group', 'group2')->values();
                        $allItems = $service->checklistItems->whereNull('section_group')->values();
                        if($allItems->isEmpty()) $allItems = $service->checklistItems->values();
                    @endphp

                    @if($group1Items->isNotEmpty() || $allItems->isNotEmpty())
                    <div class="case-deatils-text-box">
                        <ul>
                            @foreach(($group1Items->isNotEmpty() ? $group1Items : $allItems->take(ceil($allItems->count()/2))) as $item)
                            <li>
                                <span class="icon-check"></span> {{ $item->content }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @php $supportingImages = $service->getMedia('supporting_images'); @endphp
                    @if($supportingImages->isNotEmpty())
                    <div class="row">
                        @foreach($supportingImages->take(2) as $img)
                        <div class="col-xl-6">
                            <div class="img-box">
                                <img src="{{ $img->getUrl() }}" alt="{{ $img->name }}" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($group2Items->isNotEmpty() || ($allItems->count() > ceil($allItems->count()/2)))
                    <div class="case-deatils-text-box">
                        <ul>
                            @foreach(($group2Items->isNotEmpty() ? $group2Items : $allItems->skip(ceil($allItems->count()/2))) as $item)
                            <li>
                                <span class="icon-check"></span> {{ $item->content }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($supportingImages->count() > 2)
                    <div class="row">
                        @foreach($supportingImages->skip(2)->take(2) as $img)
                        <div class="col-xl-6">
                            <div class="img-box">
                                <img src="{{ $img->getUrl() }}" alt="{{ $img->name }}" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @foreach($service->accordionSections as $accordion)
                    <div class="service-details-faq-content">
                        <ul class="accordion-box">
                            <li class="accordion block active-block">
                                <div class="acc-btn">{{ $accordion->title }}</div>
                                <div class="acc-content current">
                                    <div class="content">
                                        {!! $accordion->content !!}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
