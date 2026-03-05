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
                        $supportingByGroup = $service->supportingImages->groupBy('after_group');

                        $checklistGroups = $service->checklistItems
                            ->filter(fn($i) => $i->section_group)
                            ->pluck('section_group')
                            ->unique();

                        $imageGroups = $service->supportingImages
                            ->filter(fn($i) => $i->after_group)
                            ->pluck('after_group')
                            ->unique();

                        $allGroups = $checklistGroups->merge($imageGroups)->unique()->sort()->values();

                        $groupTitles = $service->checklistGroups->keyBy('group_key');

                        $ungroupedItems = $service->checklistItems
                            ->filter(fn($i) => !$i->section_group)
                            ->values();
                    @endphp

                    @if($allGroups->isNotEmpty())
                        @foreach($allGroups as $group)
                            @php
                                $groupItems = $service->checklistItems->where('section_group', $group)->values();
                                $groupTitle = $groupTitles->get($group);
                            @endphp

                            @if($groupTitle && $groupTitle->title)
                            <div class="text-box2">
                                <h2>{{ $groupTitle->title }}</h2>
                            </div>
                            @endif
                            @if($groupTitle && $groupTitle->content)
                            <div class="case-deatils-text-box">
                                {!! $groupTitle->content !!}
                            </div>
                            @endif

                            @if($groupItems->isNotEmpty())
                                @php
                                    // Ardıcıl 'list' tipli itemləri qruplaşdır,
                                    // 'text_image' olanları ayrıca render et
                                    $listBuffer = collect();
                                @endphp
                                @foreach($groupItems as $item)
                                    @if($item->item_type === 'text_image')
                                        @if($listBuffer->isNotEmpty())
                                        <div class="case-deatils-text-box">
                                            <ul>
                                                @foreach($listBuffer as $li)
                                                <li><span class="icon-check"></span> {!! $li->content !!}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @php $listBuffer = collect(); @endphp
                                        @endif
                                        <div class="row" style="margin-bottom:30px;">
                                            <div class="col-xl-6">
                                                <div class="case-deatils-text-box">
                                                    <ul>
                                                        <li><span class="icon-check"></span> {!! $item->content !!}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                @if($item->hasMedia('item_image'))
                                                <div class="img-box">
                                                    <img src="{{ $item->getFirstMediaUrl('item_image') }}" alt="{{ $item->content }}" />
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        @php $listBuffer->push($item); @endphp
                                    @endif
                                @endforeach
                                @if($listBuffer->isNotEmpty())
                                <div class="case-deatils-text-box">
                                    <ul>
                                        @foreach($listBuffer as $li)
                                        <li><span class="icon-check"></span> {!! $li->content !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            @endif

                            @php $groupImages = $supportingByGroup->get($group, collect()); @endphp
                            @if($groupImages->isNotEmpty())
                            <div class="row">
                                @foreach($groupImages as $img)
                                <div class="col-xl-6">
                                    <div class="img-box">
                                        @if($img->hasMedia('image'))
                                            <img src="{{ $img->getFirstMediaUrl('image') }}" alt="{{ $img->alt_text }}" />
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        @endforeach
                    @elseif($ungroupedItems->isNotEmpty())
                        @php $listBuffer = collect(); @endphp
                        @foreach($ungroupedItems as $item)
                            @if($item->item_type === 'text_image')
                                @if($listBuffer->isNotEmpty())
                                <div class="case-deatils-text-box">
                                    <ul>
                                        @foreach($listBuffer as $li)
                                        <li><span class="icon-check"></span> {!! $li->content !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @php $listBuffer = collect(); @endphp
                                @endif
                                <div class="row" style="margin-bottom:30px;">
                                    <div class="col-xl-6">
                                        <div class="case-deatils-text-box">
                                            <ul>
                                                <li><span class="icon-check"></span> {!! $item->content !!}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        @if($item->hasMedia('item_image'))
                                        <div class="img-box">
                                            <img src="{{ $item->getFirstMediaUrl('item_image') }}" alt="{{ $item->content }}" />
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                @php $listBuffer->push($item); @endphp
                            @endif
                        @endforeach
                        @if($listBuffer->isNotEmpty())
                        <div class="case-deatils-text-box">
                            <ul>
                                @foreach($listBuffer as $li)
                                <li><span class="icon-check"></span> {!! $li->content !!}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    @endif

                    @if($service->accordionSections->isNotEmpty())
                    <div class="service-details-faq-content">
                        <ul class="accordion-box">
                            @foreach($service->accordionSections as $loop_accordion => $accordion)
                            <li class="accordion block {{ $loop_accordion === 0 ? 'active-block' : '' }}">
                                <div class="acc-btn {{ $loop_accordion === 0 ? 'active' : '' }}">{{ $accordion->title }}</div>
                                <div class="acc-content" style="{{ $loop_accordion === 0 ? 'display:block;' : 'display:none;' }}">
                                    <div class="content">
                                        {!! $accordion->content !!}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </div>

            {{-- Accordion images: outside two-column layout, full-width (matches services6.html) --}}
            @foreach($service->accordionSections as $accordion)
                @if($accordion->hasMedia('accordion_images'))
                <div class="service-details-faq-content">
                    <div class="row">
                        @foreach($accordion->getMedia('accordion_images') as $img)
                        <div class="col-xl-6">
                            <div class="img-box">
                                <img src="{{ $img->getUrl() }}" alt="{{ $accordion->title }}" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach

        </div>
    </div>
</section>

@endsection
