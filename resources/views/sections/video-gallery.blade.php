@if($latestVideos->isNotEmpty())
<section id="video-gallery" class="blog-style1-area vg-section-home" style="background:#f8f9fa">
    <div class="container">
        <div class="sec-title text-center">
            <div class="icon"><span class="flaticon-play-button"></span></div>
            <div class="sub-title"><h3></h3></div>
            <h2>{{ __('frontend.sections.video_gallery') }}</h2>
        </div>

        <div class="row">
            @foreach($latestVideos as $video)
            <div class="col-xl-4 col-lg-4 col-md-6 m-b30">
                <div class="vg-home-card" data-embed="{{ $video->getEmbedUrl() }}" data-title="{{ $video->title }}">
                    <div class="vg-home-thumb">
                        <img src="{{ $video->getThumbnailUrl() }}" alt="{{ $video->title }}" loading="lazy">
                        <div class="vg-home-play">
                            <span><i class="fa fa-play"></i></span>
                        </div>
                    </div>
                    @if($video->title)
                    <div class="vg-home-caption">
                        <h6>{{ $video->title }}</h6>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center" style="margin-top:30px">
            <a href="{{ lroute('video-gallery') }}" class="btn-one">{{ __('frontend.buttons.all_videos') }}</a>
        </div>
    </div>
</section>

{{-- Video Modal (shared, only once on homepage) --}}
<div id="vgHomeModal" class="vg-modal-overlay">
    <div class="vg-modal-box">
        <button class="vg-modal-close" id="vgHomeModalClose">&times;</button>
        <div class="vg-modal-title" id="vgHomeModalTitle"></div>
        <div class="vg-iframe-wrap">
            <iframe id="vgHomeIframe" src="" frameborder="0" allow="autoplay; encrypted-media; fullscreen" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endif

@push('styles')
<style>
/* Section z-index: footer-area has z-index:10, sections need z-index > 10 */
.vg-section-home {
    position: relative;
    z-index: 11;
}

/* Home video cards */
.vg-home-card {
    cursor: pointer;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transition: transform .25s, box-shadow .25s;
    background: #fff;
}
.vg-home-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 32px rgba(0,0,0,0.18);
}
.vg-home-thumb {
    position: relative;
    overflow: hidden;
    padding-top: 56.25%;
    background: #111;
}
.vg-home-thumb img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s, opacity .3s;
}
.vg-home-card:hover .vg-home-thumb img {
    transform: scale(1.05);
    opacity: .85;
}
.vg-home-play {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
}
.vg-home-play span {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.92);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform .2s, background .2s;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}
.vg-home-play span i {
    color: #e63030;
    font-size: 20px;
    margin-left: 4px;
}
.vg-home-card:hover .vg-home-play span {
    transform: scale(1.12);
}
.vg-home-caption {
    padding: 12px 16px 14px;
}
.vg-home-caption h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #222;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Shared modal styles (if not on video-gallery page) */
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
.vg-modal-close:hover { background: rgba(255,255,255,0.25); }
.vg-modal-title {
    padding: 14px 52px 14px 18px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    background: rgba(255,255,255,0.07);
}
.vg-modal-title:empty { display: none; }
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
    var $modal  = $('#vgHomeModal');
    var $iframe = $('#vgHomeIframe');
    var $title  = $('#vgHomeModalTitle');

    $(document).on('click', '.vg-home-card', function () {
        var embed = $(this).data('embed');
        var title = $(this).data('title') || '';
        if (!embed) return;
        $title.text(title);
        $iframe.attr('src', embed);
        $modal.addClass('is-open');
        $('body').css('overflow', 'hidden');
    });

    $('#vgHomeModalClose').on('click', closeModal);
    $modal.on('click', function (e) {
        if ($(e.target).is($modal)) closeModal();
    });
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && $modal.hasClass('is-open')) closeModal();
    });

    function closeModal() {
        $modal.removeClass('is-open');
        $iframe.attr('src', '');
        $('body').css('overflow', '');
    }
});
</script>
@endpush
