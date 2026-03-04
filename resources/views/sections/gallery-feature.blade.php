<section class="case-stories-area">
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <div class="border-box"></div>
                <h3></h3>
            </div>
            <h2>{{ Str::upper(__('frontend.sections.gallery')) }}</h2>
        </div>
        <div class="row">
            @foreach($galleryFeatures as $feature)
            <div class="col-xl-6 col-lg-6">
                <div class="case-stories__single">
                    <div class="img-box">
                        @if($feature->hasMedia('image'))
                            <img src="{{ $feature->getFirstMediaUrl('image') }}" alt="{{ $feature->title }}">
                        @else
                            <img src="{{ asset('assets/images/resources/case-stories-img' . $loop->iteration . '.jpg') }}" alt="{{ $feature->title }}">
                        @endif
                    </div>
                    <div class="content-box">
                        <div class="top-text">
                            <h2>{{ $feature->title }}</h2>
                            <div class="line"></div>
                        </div>
                        <div class="bottom-text">
                            <div class="text">
                                @if($feature->description)
                                    <p>{{ $feature->description }}</p>
                                @endif
                            </div>
                            <div class="icon">
                                <a href="{{ lroute('gallery') }}"><span class="icon-right-arrow"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
