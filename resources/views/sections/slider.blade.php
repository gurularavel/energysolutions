<section id="banner" class="main-slider style1">
    <div class="slider-box">
        <div class="banner-carousel owl-theme owl-carousel">
            @foreach($sliders as $slide)
            <div class="slide">
                <div class="image-layer" style="background-image:url({{ $slide->getFirstMediaUrl('background_image') ?: asset('assets/images/slides/slide-v1-1.jpg') }})"></div>
                <div class="shape-box"></div>
                <div class="auto-container">
                    <div class="content">
                        <div class="big-title">
                            <h2>{!! nl2br(e($slide->heading)) !!}</h2>
                        </div>
                        @if($slide->button_text)
                        <div class="btns-box">
                            <a class="btn-one" href="{{ $slide->button_link ?? '#' }}">
                                <span class="txt">{{ $slide->button_text }}<i class="icon-refresh arrow"></i></span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
