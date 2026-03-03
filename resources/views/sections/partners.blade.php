@if($partners->isNotEmpty())
<section class="partner-area">
    <div class="container">
        <div class="brand-content">
            <div class="inner">
                <ul class="partner-box partner-carousel owl-carousel owl-theme owl-dot-style1 rtl-carousel">
                    @foreach($partners as $partner)
                    <li class="single-partner-logo-box">
                        <a href="{{ $partner->link ?? '#' }}">
                            @if($partner->hasMedia('logo'))
                                <img src="{{ $partner->getFirstMediaUrl('logo') }}" alt="{{ $partner->name }}">
                            @else
                                <img src="{{ asset('assets/images/brand/brand-logo-' . $loop->iteration . '.png') }}" alt="{{ $partner->name }}">
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endif
