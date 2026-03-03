@if($stats->isNotEmpty())
<section id="certificate"></section>
<section class="company-benefits-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <ul class="fact-counter-box">
                    @foreach($stats as $stat)
                    <li class="single-fact-counter">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="{{ $stat->speed }}" data-stop="{{ $stat->number }}">0</span>
                            </div>
                        </div>
                        <div class="title">
                            <h3>{{ $stat->label }}</h3>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-xl-5 col-lg-6 col-md-6">
                <div class="company-benefits-content">
                    <div class="top-text">
                        <p>{{ $certText->content ?? 'Qeyd edilən bütün xidmətlər yüksək ixtisaslı və sertifikatlaşdırılmış mütəxəssislər tərəfindən İSO standartlarının tələblərinə uyğun aparılır.' }}</p>
                    </div>
                    <div class="bottom-content">
                        <div class="btns-box">
                            <a class="btn-one" href="{{ lroute('certificates') }}">
                                <span class="txt">Ətraflı<i class="icon-refresh arrow"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="company-benefits-img-box">
                    <div class="shape-1 paroller-2"></div>
                    <div class="shape-2 paroller-2"></div>
                    <div class="inner">
                        @if($certText && $certText->background_image)
                            <img src="{{ asset('storage/' . $certText->background_image) }}" alt="">
                        @else
                            <img src="{{ asset('assets/images/resources/company-benefits-img-1.jpg') }}" alt="">
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
