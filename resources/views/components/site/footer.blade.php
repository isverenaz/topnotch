@php
    $setting = $data['setting'] ?? null;
    $siteName = $data['siteName'] ?? config('app.name', 'Topnotch.az');
    $siteAddress = $data['siteAddress'] ?? null;
    $sitePhone = $data['sitePhone'] ?? null;
    $siteEmail = $data['siteEmail'] ?? null;
    $footerLogo = !empty(data_get($setting, 'footer_logo'))
        ? asset('uploads/settings/' . data_get($setting, 'footer_logo'))
        : asset('site/assets/img/logo-icon.png');
    $copyrightYear = now()->year;
@endphp

<section class="bg-cover newsletter bg-main" style="background:url({{ asset('site/assets/img/detail-bg-2.jpg') }});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8 col-sm-12">
                <div class="text-center">
                    <div class="subscribe-caption d-block mb-4">
                        <h2 class="text-light">@lang('site.newsletter_title')</h2>
                        <p class="text-light opacity-75">@lang('site.newsletter_text')</p>
                    </div>
                    <a href="{{ route('site.signup') }}" class="btn btn-dark rounded-pill px-5">@lang('site.newsletter_button')</a>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="dark-footer">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="footer-widget">
                        <img src="{{ $footerLogo }}" class="img-footer" alt="{{ $siteName }}" />
                        <div class="footer-add">
                            @if(!empty($siteAddress))
                                <address class="mb-4 lh-base">{!! nl2br(e($siteAddress)) !!}<br>{{ $siteName }}</address>
                            @endif
                            @if(!empty($sitePhone))
                                <div class="d-flex align-items-center call-now gap-2 mb-3">
                                    <div class="square--30 circle bg-light-main text-main"><i class="bi bi-telephone"></i></div>
                                    <div class="fs-6 fw-semibold">{{ $sitePhone }}</div>
                                </div>
                            @endif
                            @if(!empty($siteEmail))
                                <div class="d-flex align-items-center call-now gap-2">
                                    <div class="square--30 circle bg-light-main text-main"><i class="bi bi-envelope"></i></div>
                                    <div class="fs-6 fw-semibold">{{ $siteEmail }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="footer-widget">
                        <h4 class="widget-title">@lang('site.footer_services')</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ route('site.study-abroad') }}">@lang('site.study_abroads')</a></li>
                            <li><a href="{{ route('site.courses') }}">@lang('site.courses_title')</a></li>
                            <li><a href="{{ route('site.schools') }}">@lang('site.schools')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-5">
                    <div class="footer-widget">
                        <h4 class="widget-title">@lang('site.footer_other')</h4>
                        <ul class="footer-menu">
                            <li><a href="{{ route('site.about') }}">@lang('site.about_us')</a></li>
                            <li><a href="{{ route('site.faqs') }}">@lang('site.faq')</a></li>
                            <li><a href="{{ route('site.contact') }}">@lang('site.contact_us')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-lg-6 col-md-6">
                    <p class="mb-0">
                        © {{ $copyrightYear }} {{ $siteName }} — @lang('site.footer_copyright')
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 text-md-end">
                    <ul class="footer-bottom-social">
                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                        <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="bi bi-arrow-up"></i></a>
</div>
<script src="{{ asset('site/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('site/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('site/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('site/assets/js/slick.js') }}"></script>
<script src="{{ asset('site/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('site/assets/js/counterup.min.js') }}"></script>
<script src="{{ asset('site/assets/js/custom.js') }}"></script>
<script>
    const toggle = document.getElementById('billingSwitch');
    const prices = document.querySelectorAll('.card-price');

    function updatePrices(isYearly) {
        prices.forEach(price => {
            const monthly = price.getAttribute('data-monthly');
            const yearly = price.getAttribute('data-yearly');
            if (isYearly) {
                price.innerHTML = `$${yearly}<span class="text-dark fw-normal fs-6">/year</span>`;
            } else {
                price.innerHTML = `$${monthly}<span class="text-dark fw-normal fs-6">/mo</span>`;
            }
        });
    }

    if (toggle) {
        toggle.addEventListener('change', () => {
            updatePrices(toggle.checked);
        });

        updatePrices(toggle.checked);
    }
</script>
@yield('site.js')
</body>
</html>
