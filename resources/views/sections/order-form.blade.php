<section id="blank"></section>
<section class="features-style2-area">
    <div class="features-style2-area__bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="features-style2__content">
                    <div class="features-style2__content-bg"
                        style="background-image: url({{ asset('assets/images/resources/features-style2__content-bg.jpg') }});">
                    </div>
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="top-title">
                        <h2>{{ __('frontend.forms.order_title') }}<br>
                            <a href="mailto:{{ $settings->email ?? 'office@energysolutions.az' }}">{{ $settings->email ?? 'office@energysolutions.az' }}</a>
                        </h2>
                    </div>
                    <div class="shape-1"></div>
                    <div class="shape-2"></div>
                    <div class="top-title">
                        <a class="btn-one" href="{{ $settings->order_form_pdf ? asset($settings->order_form_pdf) : asset('assets/form/orderformenergysol.pdf') }}" target="_blank">
                            <span class="txt">{{ __('frontend.buttons.download_form') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
