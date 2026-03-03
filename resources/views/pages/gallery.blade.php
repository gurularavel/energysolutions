@extends('layouts.app')

@section('title', 'Foto Qalereya - Energy Solutions')

@section('content')

<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg" style="background-image: url({{ asset('assets/images/breadcrumb/8-1.png') }});"></div>
    <div class="shape-box"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">
                    <div class="breadcrumb-menu">
                        <ul>
                            <li><a href="{{ lroute('home') }}">Əsas səhifə</a></li>
                            <li class="active">Foto Qalereya</li>
                        </ul>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>Foto Qalereya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-inner gallery-page-section">
    <div class="container">
        <div class="site-filters style-1 clearfix center mb-5">
            <ul class="filters" data-toggle="buttons">
                <li class="btn active">
                    <input type="radio">
                    <a href="javascript:void(0);">Hamısını göstər</a>
                </li>
                @foreach($categories as $category)
                <li data-filter=".{{ $category->filter_class }}" class="btn">
                    <input type="radio">
                    <a href="javascript:void(0);">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix">
            <ul id="masonry" class="row lightgallery">
                @foreach($images as $image)
                <li class="card-container col-lg-6 col-md-6 col-sm-6 m-b30 {{ $image->category->filter_class }}">
                    <div class="image-tooltip-effect dz-box style-2">
                        @if($image->hasMedia('gallery_image'))
                            <a class="dz-media {{ $image->height_class }}" style="background-image:url('{{ $image->getFirstMediaUrl('gallery_image') }}');"></a>
                        @elseif($image->alt_text)
                            <a class="dz-media {{ $image->height_class }}" style="background-image:url('{{ asset('gallery-static/images/' . $image->alt_text) }}');"></a>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('gallery-static/css/style.css') }}">
<style>
/* Gallery page z-index fix */
.gallery-page-section {
    position: relative;
    z-index: 11;
    padding: 80px 0 100px;
    background: #fff;
}
/* Override bootstrap btn styles on filter items */
.site-filters.style-1 .filters li.btn {
    background: transparent;
    border: none;
    padding: 0;
}
.site-filters.style-1 .filters li.btn:focus,
.site-filters.style-1 .filters li.btn:active {
    outline: none;
    box-shadow: none;
}
.m-b30 { margin-bottom: 30px; }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    var $grid = $('#masonry').isotope({
        itemSelector: '.card-container',
        layoutMode: 'masonry'
    });

    $('.filters').on('click', '.btn', function() {
        var filterValue = $(this).attr('data-filter');
        if (!filterValue) {
            filterValue = '*';
        }
        $grid.isotope({ filter: filterValue });
        $('.filters .btn').removeClass('active');
        $(this).addClass('active');
    });
});
</script>
@endpush
