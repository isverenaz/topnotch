<!-- Footer Start  -->
<div class="section footer-section">

    <!-- Footer Widget Section Start -->
    <div class="footer-widget-section">


        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 order-md-1 order-lg-1">
                    <!-- Footer Widget Start -->
                    <div class="footer-widget">
                        @if(!empty($setting['footer_logo']))
                        <div class="widget-logo">
                            <a href="{{ route('site.index') }}">
                                <img src="{{ asset('uploads/settings/'.$setting['footer_logo']) }}" style="max-height: 53px;" alt="{{$setting['title'][$currentLang] ?? ''}}">
                            </a>
                        </div>
                        @endif

                        <div class="widget-address">
                            <h4 class="footer-widget-title">{{$setting['title'][$currentLang] ?? ''}}</h4>
                            <p>{{$setting['address'][$currentLang] ?? ''}}</p>
                        </div>

                        <ul class="widget-info">
                            <li>
                                @if(!empty($setting['phone']))
                                    <p><i class="flaticon-phone-call"></i> <a href="tel:{{$setting['phone']}}">{{$setting['phone']}}</a></p>
                                @endif
                            </li>
                            <li>
                                @if(!empty($setting['email']))
                                    <p><i class="flaticon-email"></i> <a href="mailto:{{$setting['email']}}">{{$setting['email']}}</a></p>
                                @endif
                            </li>
                        </ul>

                        <ul class="widget-social">
                            @if(!empty($setting['facebook']))
                                <li><a href="{{$setting['facebook']}}"><i class="flaticon-facebook"></i></a></li>
                            @endif
                            @if(!empty($setting['linkedin']))
                                <li><a href="{{$setting['linkedin']}}"><i class="flaticon-linkedin"></i></a></li>
                            @endif
                            @if(!empty($setting['youtube']))
                                <li><a href="{{$setting['youtube']}}"><i class="flaticon-youtube"></i></a></li>
                            @endif
                            @if(!empty($setting['instagram']))
                                <li><a href="{{$setting['instagram']}}"><i class="flaticon-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    <!-- Footer Widget End -->

                </div>
                <div class="col-lg-3 col-md-6 order-md-2 order-lg-2">

                    <!-- Footer Widget Link Start -->
                    <div class="footer-widget-link">

                        <!-- Footer Widget Start -->
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">@lang('site.education_degree')</h4>

                            <ul class="widget-link">
                                @if(!empty($degrees[0]['name'][$currentLang]))
                                @foreach($degrees as $degree)
                                    <li><a href="{{ route('site.degree-study-abroad',['degree' => $degree['slug'][$currentLang]]) }}">{{$degree['name'][$currentLang]}}</a></li>
                                @endforeach
                                @endif
                            </ul>

                        </div>
                        <!-- Footer Widget End -->

                    </div>
                    <!-- Footer Widget Link End -->

                </div>
                <div class="col-lg-3 col-md-6 order-md-3 order-lg-3">
                    <div class="footer-widget-link">

                    <!-- Footer Widget Start -->
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">@lang('site.our_additions')</h4>

                        <ul class="widget-link">
                            <li><a href="{{ route('site.about') }}">@lang('site.about_us')</a></li>
                            <li><a href="{{ route('site.faqs') }}">@lang('site.faq')</a></li>
                            <li><a href="{{ route("site.contact") }}">@lang('site.contact_us')</a></li>
                            {{--<li><a href="{{ route('site.conditions') }}">Şərtlər</a></li>
                                        <li><a href="{{ route('site.rules') }}">Qaydalar</a></li>--}}
                        </ul>

                    </div>
                    <!-- Footer Widget End -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Footer Widget Section End -->

    <!-- Footer Copyright Start -->
    <div class="footer-copyright">
        <div class="container">

            <!-- Footer Copyright Start -->
            <div class="copyright-wrapper">

                <div class="copyright-text">
                    <p>&copy; <?php echo date('Y') ?> <span> @lang('site.site_name') </span> @lang('site.copyright') <i class="icofont-heart-alt"></i> by <a href="https://instagram.com/asgarov.az/">Anvar Asgarov</a></p>
                </div>
            </div>
            <!-- Footer Copyright End -->

        </div>
    </div>
    <!-- Footer Copyright End -->

</div>
<!-- Footer End -->

<!--Back To Start-->
<a href="#" class="back-to-top">
    <i class="icofont-simple-up"></i>
</a>
<!--Back To End-->

</div>
@yield('site.js')
</body>
</html>
