@extends('layouts.app')

@section('title', __('frontend.pages.future_services') . ' - Energy Solutions')

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
                            <li class="active">{{ __('frontend.pages.future_services') }}</li>
                        </ul>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>{{ __('frontend.pages.future_services') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-style2-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                @if($section && $section->page_content)
                    <div class="static-page-content">
                        {!! $section->page_content !!}
                    </div>
                @else
                    <div class="static-page-content">
                        <p>{{ $section->content ?? __('frontend.pages.future_services') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
