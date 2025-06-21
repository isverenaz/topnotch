<!-- Header Section Start -->
<div class="header-section">

    <!-- Header Top Start -->
    <div class="header-top d-none d-lg-block">
        <div class="container">

            <!-- Header Top Wrapper Start -->
            <div class="header-top-wrapper">

                <!-- Header Top Left Start -->
                <div class="header-top-left">
                    <p>@lang('reklam.header_title')</p>
                </div>
                <!-- Header Top Left End -->

                <!-- Header Top Medal Start -->
                <div class="header-top-medal">
                    <div class="top-info">
                        @if(!empty($setting['phone']))
                            <p><i class="flaticon-phone-call"></i> <a href="tel:{{$setting['phone']}}">{{$setting['phone']}}</a></p>
                        @endif
                        @if(!empty($setting['email']))
                            <p><i class="flaticon-email"></i> <a href="mailto:{{$setting['email']}}">{{$setting['email']}}</a></p>
                        @endif
                    </div>
                </div>
                <!-- Header Top Medal End -->

                <!-- Header Top Right Start -->
                <div class="header-top-right">
                    <ul class="social">
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

            </div>
            <!-- Header Top Wrapper End -->

        </div>
    </div>
    <!-- Header Top End -->

    <!-- Header Main Start -->
    <div class="header-main">
        <div class="container">

            <!-- Header Main Start -->
            <div class="header-main-wrapper">
                @if(!empty($setting['footer_logo']))
                <!-- Header Logo Start -->
                <div class="header-logo">
                    <a href="{{ route('site.index') }}">
                        <img src="{{ asset('uploads/settings/'.$setting['footer_logo']) }}" style="max-height: 53px;" alt="{{$setting['title'][$currentLang]}}">
                    </a>
                </div>
                @endif
                <!-- Header Logo End -->

                <!-- Header Menu Start -->
                <div class="header-menu d-none d-lg-block">
                    <ul class="nav-menu">
                        @if(!empty($countries[0]))
                        <li>
                            <a href="{{ route('site.study-abroad') }}">@lang('site.study_abroads')</a>
                            <ul class="sub-menu">
                                @foreach($countries as $country)
                                    @if(!empty($country['universities'][0]))
                                    <li>
                                        <a href="{{ route('site.study-abroad',['country' => $country['slug'][$currentLang], 'university' => '']) }}">{{$country['name'][$currentLang]}}</a>
                                        <ul class="sub-menu">
                                            @foreach($country['universities'] as $university)
                                            <li><a href="{{ route('site.study-abroad',['country' => $country['slug'][$currentLang], 'university' => $university['slug'][$currentLang]]) }}">{!! $university['name'][$currentLang] !!}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @if(!empty($languages[0]))
                        <li>
                            <a href="{{ route('site.language-courses') }}">@lang('site.language_courses')</a>
                            <ul class="sub-menu">
                                @foreach($languages as $lang)
                                    @if(!empty($lang['parentLanguages'][0]))
                                        <li>
                                            <a href="{{ route('site.language-courses',['language' => $lang['slug'][$currentLang], 'leve' => '']) }}">{{$lang['name'][$currentLang]}}</a>
                                            <ul class="sub-menu">
                                                @foreach($lang['parentLanguages'] as $parentLang)
                                                    <li>
                                                        <a href="{{ route('site.language-courses',['language' => $lang['slug'][$currentLang], 'leve' => $parentLang['slug'][$currentLang]]) }}">{{$parentLang['name'][$currentLang]}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route("site.schools") }}">@lang('site.schools')</a>
                            @if(!empty($schoolCategories))
                            <ul class="sub-menu">
                                @foreach($schoolCategories as $schoolCategory)
                                <li>
                                    <a href="{{ route("site.schools",['schoolCategory' => $schoolCategory['slug'][$currentLang]]) }}">{{$schoolCategory['title'][$currentLang]}}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li>
                            <a href="{{ route("site.blogs") }}">@lang('site.blogs')</a>
                            @if(!empty($categories))
                            <ul class="sub-menu">
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route("site.blogs",['category' => $category['slug'][$currentLang]]) }}">{{$category['title'][$currentLang]}}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        <li>
                            <a href="#">{{ ucwords($currentLang) }}</a>
                            @if(!empty($translations[0]))
                            <ul class="sub-menu">
                                @foreach($translations as $localeCode => $properties)
                                    @if($properties['code'] != $currentLang)
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedURL($properties['code'], route('site.index')) }}" hreflang="{{ $properties['code'] }}">
                                        {{ ucwords($properties['code']) }}
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                    </ul>
                </div>
                <!-- Header Menu End -->

                <!-- Header Sing In & Up Start -->
                <div class="header-sign-in-up d-none d-lg-block">
                    <ul>
                        <li><a class="sign-up" href="{{ route('site.signup') }}">@lang('site.signup_us')</a></li>
                    </ul>
                </div>
                <!-- Header Sing In & Up End -->

                <!-- Header Mobile Toggle Start -->
                <div class="header-toggle d-lg-none">
                    <a class="menu-toggle" href="javascript:void(0)">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <!-- Header Mobile Toggle End -->

            </div>
            <!-- Header Main End -->

        </div>
    </div>
    <!-- Header Main End -->

</div>
<!-- Header Section End -->

<!-- Mobile Menu Start -->
<div class="mobile-menu">

    <!-- Menu Close Start -->
    <a class="menu-close" href="javascript:void(0)">
        <i class="icofont-close-line"></i>
    </a>
    <!-- Menu Close End -->

    <!-- Mobile Top Medal Start -->
    <div class="mobile-top">
        @if(!empty($setting['phone']))
            <p><i class="flaticon-phone-call"></i> <a href="tel:{{$setting['phone']}}">{{$setting['phone']}}</a></p>
        @endif
        @if(!empty($setting['email']))
            <p><i class="flaticon-email"></i> <a href="mailto:{{$setting['email']}}">{{$setting['email']}}</a></p>
        @endif
    </div>
    <!-- Mobile Top Medal End -->

    <!-- Mobile Sing In & Up Start -->
    <div class="mobile-sign-in-up">
        <ul>
            <li><a class="sign-up" href="{{ route('site.signup') }}">@lang('site.signup_us')</a></li>
        </ul>
    </div>
    <!-- Mobile Sing In & Up End -->

    <!-- Mobile Menu Start -->
    <div class="mobile-menu-items">
        <ul class="nav-menu">
            @if(!empty($countries[0]))
            <li>
                <a href="{{ route('site.study-abroad') }}">@lang('site.study_abroads')</a>
                <ul class="sub-menu">
                    @foreach($countries as $country)
                        @if(!empty($country['universities'][0]))
                            <li>
                                <a href="{{ route('site.study-abroad',['country' => $country['slug'][$currentLang], 'university' => '']) }}">{{$country['name'][$currentLang]}}</a>
                                <ul class="sub-menu">
                                    @foreach($country['universities'] as $university)
                                        <li><a href="{{ route('site.study-abroad',['country' => $country['slug'][$currentLang], 'university' => $university['slug'][$currentLang]]) }}">{!! $university['name'][$currentLang] !!}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
            @endif
            @if(!empty($languages[0]))
                <li>
                    <a href="{{ route('site.language-courses') }}">@lang('site.language_courses')</a>
                    <ul class="sub-menu">
                        @foreach($languages as $lang)
                            @if(!empty($lang['parentLanguages'][0]))
                                <li>
                                    <a href="{{ route('site.language-courses',['language' => $lang['slug'][$currentLang], 'leve' => '']) }}">{{$lang['name'][$currentLang]}}</a>
                                    <ul class="sub-menu">
                                        @foreach($lang['parentLanguages'] as $parentLang)
                                            <li>
                                                <a href="{{ route('site.language-courses',['language' => $lang['slug'][$currentLang], 'leve' => $parentLang['slug'][$currentLang]]) }}">{{$parentLang['name'][$currentLang]}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
                <li>
                    <a href="{{ route("site.schools") }}">@lang('site.schools')</a>
                    @if(!empty($schoolCategories))
                        <ul class="sub-menu">
                            @foreach($schoolCategories as $schoolCategory)
                                <li>
                                    <a href="{{ route("site.schools",['schoolCategory' => $schoolCategory['slug'][$currentLang]]) }}">{{$schoolCategory['title'][$currentLang]}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                <li>
                    <a href="{{ route("site.blogs") }}">@lang('site.blogs')</a>
                    @if(!empty($categories))
                        <ul class="sub-menu">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route("site.blogs",['category' => $category['slug'][$currentLang]]) }}">{{$category['title'][$currentLang]}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                <li>
                    <a href="#">{{ ucwords($currentLang) }}</a>
                    @if(!empty($translations[0]))
                        <ul class="sub-menu">
                            @foreach($translations as $localeCode => $properties)
                                @if($properties['code'] != $currentLang)
                                    <li>
                                        <a href="{{ LaravelLocalization::getLocalizedURL($properties['code'], route('site.index')) }}" hreflang="{{ $properties['code'] }}">
                                            {{ ucwords($properties['code']) }}
                                        </a>
                                        @endif
                                    </li>
                                    @endforeach
                        </ul>
                    @endif
                </li>
        </ul>

    </div>
    <!-- Mobile Menu End -->

    <!-- Mobile Menu End -->
    <div class="mobile-social">
        <ul class="social">
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
    <!-- Mobile Menu End -->

</div>
<!-- Mobile Menu End -->
<!-- Overlay Start -->
<div class="overlay"></div>
<!-- Overlay End -->
