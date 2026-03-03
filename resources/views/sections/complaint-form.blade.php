<section class="slogan-style2-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="slogan-style2-content">
                    <div class="title">
                        <h2>Şikayətləriniz üçün formanı<br>dolduraraq bizə ünvanlayın<br>
                            <a href="mailto:{{ $settings->email ?? 'office@energysolutions.az' }}">{{ $settings->email ?? 'office@energysolutions.az' }}</a>
                        </h2>
                    </div>
                    <div class="button-box">
                        <a class="btn-one" href="{{ $settings->complaint_form_pdf ? asset($settings->complaint_form_pdf) : asset('assets/form/esslfform.pdf') }}" target="_blank">
                            <span class="txt">Formanı yükləyin</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
