@extends('layouts.app')

@section('title', __('frontend.pages.certificates') . ' - Energy Solutions')

@section('content')

<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url({{ asset('assets/images/breadcrumb/7-1.png') }});"></div>
    <div class="shape-box"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="{{ lroute('home') }}">{{ __('frontend.nav.home') }}</a></li>
                            <li class="active">{{ __('frontend.pages.certificates') }}</li>
                        </ul>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>{{ __('frontend.pages.certificates') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-style2-area">
    <div class="container">
        @foreach($certificates->chunk(2) as $chunk)
        <div class="row mb-4">
            @foreach($chunk as $certificate)
            <div class="col-xl-6">
                <div class="about-style1__image clearfix">
                    <div class="inner">
                        @if($certificate->hasMedia('certificate_image'))
                            <img src="{{ $certificate->getFirstMediaUrl('certificate_image') }}" alt="{{ $certificate->title }}">
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section>

@endsection
