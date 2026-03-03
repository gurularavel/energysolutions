<section class="slogan-area">
    <div class="slogan-area__bg" style="background-image: url({{ asset('assets/images/parallax-background/slogan-area-bg.jpg') }});"></div>
    <div class="shape wow slideInRight" data-wow-delay="1400ms" data-wow-duration="5500ms"
        style="background-image: url({{ asset('assets/images/shape/shape-1.png') }});">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slogan-text-box">
                    <h2 class="paroller">{!! $slogan2->content ?? 'Ən yaxşı sınaq işlərini <span style="background-image: url(' . asset('assets/images/shape/zig-zag.png') . ');">və</span><br>laboratoriya tədqiqatlarını<br> təqdim edirik' !!}</h2>
                    @if($slogan2 && $slogan2->button_text)
                    <div class="slogan-btn-box paroller">
                        <a class="btn-one" href="{{ $slogan2->button_link ?? '#' }}">
                            <span class="txt">{{ $slogan2->button_text }}</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
