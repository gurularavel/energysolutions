@extends('layouts.app')

@section('title', 'Video Qalereya - Energy Solutions')

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
                            <li class="active">Video Qalereya</li>
                        </ul>
                    </div>
                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>Video Qalereya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-inner vg-page-section">
    <div class="container">

        @if($videos->isEmpty())
            <div class="text-center py-5">
                <p style="color:#999;font-size:16px">Video mövcud deyil.</p>
            </div>
        @else
        <div class="row" id="video-grid">
            @foreach($videos as $video)
            <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
                <div class="video-card" data-embed="{{ $video->getEmbedUrl() }}" data-title="{{ $video->title }}">
                    <div class="video-thumb">
                        <img src="{{ $video->getThumbnailUrl() }}" alt="{{ $video->title }}" loading="lazy">
                        <div class="video-play-btn">
                            <span><i class="fa fa-play"></i></span>
                        </div>
                    </div>
                    @if($video->title)
                    <div class="video-caption">
                        <h6>{{ $video->title }}</h6>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

{{-- Video Modal --}}
<div id="videoModal" class="vg-modal-overlay">
    <div class="vg-modal-box">
        <button class="vg-modal-close" id="videoModalClose">&times;</button>
        <div class="vg-modal-title" id="videoModalTitle"></div>
        <div class="vg-iframe-wrap">
            <iframe id="videoIframe" src="" frameborder="0" allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Section z-index fix — footer-area is position:fixed z-index:10 */
.vg-page-section {
    position: relative;
    z-index: 11;
    padding: 80px 0 120px;
    background: #fff;
}

/* Video Card */
.video-card {
    cursor: pointer;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transition: transform .25s, box-shadow .25s;
    background: #fff;
}
.video-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 32px rgba(0,0,0,0.18);
}
.video-thumb {
    position: relative;
    overflow: hidden;
    padding-top: 56.25%; /* 16:9 */
    background: #111;
}
.video-thumb img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s, opacity .3s;
}
.video-card:hover .video-thumb img {
    transform: scale(1.05);
    opacity: .85;
}
.video-play-btn {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
}
.video-play-btn span {
    width: 64px;
    height: 64px;
    background: rgba(255,255,255,0.92);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .2s, background .2s;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}
.video-play-btn span i {
    color: #e63030;
    font-size: 22px;
    margin-left: 4px;
}
.video-card:hover .video-play-btn span {
    transform: scale(1.12);
    background: #fff;
}
.video-caption {
    padding: 14px 16px 16px;
}
.video-caption h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #222;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Modal */
.vg-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.88);
    z-index: 99999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.vg-modal-overlay.is-open {
    display: flex;
    animation: vgFadeIn .2s ease;
}
@keyframes vgFadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}
.vg-modal-box {
    position: relative;
    width: 100%;
    max-width: 900px;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6);
    animation: vgSlideUp .25s ease;
}
@keyframes vgSlideUp {
    from { transform: translateY(30px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}
.vg-modal-close {
    position: absolute;
    top: 10px;
    right: 14px;
    background: rgba(255,255,255,0.12);
    border: none;
    color: #fff;
    font-size: 26px;
    line-height: 1;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s;
}
.vg-modal-close:hover {
    background: rgba(255,255,255,0.25);
}
.vg-modal-title {
    padding: 14px 52px 14px 18px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    background: rgba(255,255,255,0.07);
    min-height: 0;
}
.vg-modal-title:empty {
    display: none;
}
.vg-iframe-wrap {
    position: relative;
    padding-top: 56.25%;
}
.vg-iframe-wrap iframe {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
}
</style>
@endpush

@push('scripts')
<script>
$(function () {
    var $modal  = $('#videoModal');
    var $iframe = $('#videoIframe');
    var $title  = $('#videoModalTitle');

    // Open
    $(document).on('click', '.video-card', function () {
        var embed = $(this).data('embed');
        var title = $(this).data('title') || '';
        if (!embed) return;
        $title.text(title);
        $iframe.attr('src', embed);
        $modal.addClass('is-open');
        $('body').css('overflow', 'hidden');
    });

    // Close button
    $('#videoModalClose').on('click', closeModal);

    // Click outside modal box
    $modal.on('click', function (e) {
        if ($(e.target).is($modal)) closeModal();
    });

    // ESC key
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    function closeModal() {
        $modal.removeClass('is-open');
        $iframe.attr('src', '');   // stop video
        $('body').css('overflow', '');
    }
});
</script>
@endpush
