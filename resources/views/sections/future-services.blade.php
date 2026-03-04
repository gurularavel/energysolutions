<section class="slogan-style2-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slogan-style2-content">
                    <div class="title">
                        <h2>{{ $futureServices->content ?? 'Gələcəkdə göstərmək istədiyimiz xidmətlər' }}</h2>
                    </div>
                    @if($futureServices && $futureServices->button_text)
                    <div class="button-box">
                        <a class="btn-one" href="{{ $futureServices->button_link ?? '#' }}"><span class="txt">{{ $futureServices->button_text }}</span></a>
                    </div>
                    @else
                    <div class="button-box">
                        <a class="btn-one" href="#"><span class="txt">{{ __('frontend.buttons.more') }}</span></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
