@if($blogPosts->isNotEmpty())
<section id="blog" class="blog-style1-area">
    <div class="container">
        <div class="sec-title text-center">
            <div class="icon"><span class="icon-heartbeat"></span></div>
            <div class="sub-title"><h3></h3></div>
            <h2>{{ __('frontend.sections.news') }}</h2>
        </div>
        <div class="row">
            @foreach($blogPosts as $post)
            <div class="col-xl-4 col-lg-12">
                <div class="single-blog-style1">
                    <div class="img-holder">
                        @if($post->hasMedia('image'))
                            <img src="{{ $post->getFirstMediaUrl('image') }}" alt="{{ $post->title }}">
                        @else
                            <img src="{{ asset('assets/images/blog/blog-v1-' . $loop->iteration . '.jpg') }}" alt="{{ $post->title }}">
                        @endif
                        @if($post->published_at)
                        <div class="date-box">
                            <p>{{ $post->published_at->translatedFormat('d F') }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="text-holder">
                        <div class="meta-info"><ul></ul></div>
                        <h3><a>{{ $post->title }}</a></h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
