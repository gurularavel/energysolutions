<section class="slogan-style2-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slogan-style2-content">
                    <div class="title">
                        <h2>{{ __('frontend.forms.complaint_title') }}<br>
                            <a href="mailto:{{ $settings->email ?? 'office@energysolutions.az' }}">{{ $settings->email ?? 'office@energysolutions.az' }}</a>
                        </h2>
                    </div>
                    <div class="button-box">
                        <a class="btn-one" href="{{ $settings->complaint_form_pdf ? asset($settings->complaint_form_pdf) : asset('assets/form/esslfform.pdf') }}" target="_blank">
                            <span class="txt">{{ __('frontend.buttons.download_form') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
