@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
    <meta name="description" content="TopNotch xaricdə təhsil, dil kursları və yay məktəbləri üzrə peşəkar xidmətlər təklif edir. Təhsil arzularınızı gerçəkləşdirmək üçün bizə müraciət edin.">
    <!-- Açar sözlər (isteğe bağlı, Google üçün az əhəmiyyətlidir) -->
    <meta name="keywords" content="xaricdə təhsil, dil kursları, yay məktəbləri, xaricdə oxumaq, təhsil məsləhətləri, TopNotch">
    <!-- Sosial şəbəkələr üçün Open Graph -->
    <meta property="og:title" content="TopNotch – Xaricdə Təhsil, Dil Kursları və Yay Məktəbləri">
    <meta property="og:description" content="Xaricdə təhsil, dil kursları və yay məktəbləri üçün ən doğru ünvan – TopNotch.">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://topnotch.az/uploads/settings/1750436451.favicon.png">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="TopNotch – Xaricdə Təhsil, Dil Kursları və Yay Məktəbləri">
    <meta name="twitter:description" content="Xaricdə təhsil və dil kursları üçün peşəkar dəstək. TopNotch ilə arzularınıza çatın.">
    <meta name="twitter:image" content="https://topnotch.az/uploads/settings/1750436451.favicon.png">
    <!-- Favicon -->
    <style>
        .hero-photo-slider .swiper-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 0 0 16px 16px;
        }

        .hero-photo-item {
            position: relative;
            width: 100%;
            height: 690px;
            overflow: hidden;
            border-radius: 0 0 16px 16px;
        }

        .hero-photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        .hero-photo-overlay {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 45%;
            background: linear-gradient(
                to top,
                rgba(0, 0, 0, 0.80),
                rgba(0, 0, 0, 0.35),
                rgba(0, 0, 0, 0)
            );
            z-index: 1;
        }

        .hero-photo-content {
            position: absolute;
            left: 28px;
            right: 28px;
            bottom: 28px;
            z-index: 2;
            max-width: 850px;
        }

        .hero-photo-content h1 {
            color: #ffffff;
            font-size: 28px;
            line-height: 1.3;
            font-weight: 700;
            margin: 0;
        }

        .hero-photo-content p {
            color: #ffffff;
            font-size: 18px;
            line-height: 1.5;
            margin-top: 8px;
            margin-bottom: 0;
        }

        /* Slider düymələri */
        .hero-button-prev,
        .hero-button-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.92);
            color: #1f2e55;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .hero-button-prev {
            left: 18px;
        }

        .hero-button-next {
            right: 18px;
        }

        .hero-button-prev i,
        .hero-button-next i {
            font-size: 26px;
        }

        /* Tablet */
        @media (max-width: 991px) {
            .hero-photo-item {
                height: 500px;
            }

            .hero-photo-content h1 {
                font-size: 24px;
            }

            .hero-photo-content p {
                font-size: 16px;
            }
        }

        /* Mobil */
        @media (max-width: 576px) {
            .hero-photo-slider .swiper-container,
            .hero-photo-item {
                border-radius: 0 0 12px 12px;
            }

            .hero-photo-item {
                height: 320px;
            }

            .hero-photo-content {
                left: 16px;
                right: 16px;
                bottom: 18px;
            }

            .hero-photo-content h1 {
                font-size: 18px;
                line-height: 1.25;
            }

            .hero-photo-content p {
                font-size: 13px;
                line-height: 1.4;
                margin-top: 5px;
            }

            .hero-button-prev,
            .hero-button-next {
                width: 36px;
                height: 36px;
            }

            .hero-button-prev {
                left: 10px;
            }

            .hero-button-next {
                right: 10px;
            }

            .hero-button-prev i,
            .hero-button-next i {
                font-size: 20px;
            }
        }

        /* Çox balaca telefonlar */
        @media (max-width: 380px) {
            .hero-photo-item {
                height: 280px;
            }

            .hero-photo-content h1 {
                font-size: 16px;
            }

            .hero-photo-content p {
                font-size: 12px;
            }

            .hero-button-prev,
            .hero-button-next {
                width: 32px;
                height: 32px;
            }
        }
        .brand-marquee-active .swiper-wrapper {
            transition-timing-function: linear !important;
        }

        .brand-marquee-active .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-marquee-active .single-brand img {
            max-height: 80px;
            object-fit: contain;
        }
        .study-abroad-active .swiper-wrapper {
            transition-timing-function: linear !important;
        }

        .study-abroad-active .swiper-slide {
            height: auto;
        }
    </style>
    <!-- Google Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("site/assets/css/vendor/plugins.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/assets/css/style.min.css") }}">
@endsection
@section('site.content')
    <!-- Slider Start -->
    @if(!empty($sliders) && count($sliders) > 0)
        <div class="hero-photo-section">
            <div class="hero-photo-slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        @foreach($sliders as $slider)
                            <div class="swiper-slide">
                                <div class="hero-photo-item">
                                    <img
                                        src="{{ asset('uploads/sliders/'.$slider['image']) }}"
                                        alt="{{ $slider['title'][$currentLang] ?? '' }}"
                                        @if(!$loop->first) loading="lazy" @endif
                                    >

                                    <div class="hero-photo-overlay"></div>

                                    <div class="hero-photo-content">
                                        @if(!empty($slider['title'][$currentLang]))
                                            <h1>{{ $slider['title'][$currentLang] }}</h1>
                                        @endif

                                        @if(!empty($slider['text'][$currentLang]))
                                            <p>{!! $slider['text'][$currentLang] !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    @if(count($sliders) > 1)
                        <div class="hero-button-prev">
                            <i class="icofont-rounded-left"></i>
                        </div>

                        <div class="hero-button-next">
                            <i class="icofont-rounded-right"></i>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endif
    <!-- Slider End -->
    @if(!empty($categories[0]['title'][$currentLang]))
    <!-- All Courses Start -->
    <div class="section section-padding-02">
        <div class="container">

            <!-- All Courses Top Start -->
            <div class="courses-top">

                <!-- Section Title Start -->
                <div class="section-title shape-01">
                    <h2 class="main-title">@lang('site.blog_text')</h2>
                </div>
                <!-- Section Title End -->
            </div>
            <!-- All Courses Top End -->

            <!-- All Courses Tabs Menu Start -->
            <div class="courses-tabs-menu courses-active">
                <div class="swiper-container">
                    <ul class="swiper-wrapper nav">
                        @foreach($categories as $catKey => $cat)
                            <li class="swiper-slide"><button class="@if(++$catKey ==1) active @endif" data-bs-toggle="tab" data-bs-target="#{{$cat['slug'][$currentLang]}}{{$cat['id']}}">{{$cat['title'][$currentLang]}}</button></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Add Pagination -->
                <div class="swiper-button-next"><i style="color: #1f2e55;!important;" class="icofont-rounded-right"></i></div>
                <div class="swiper-button-prev"><i style="color: #1f2e55;!important;" class="icofont-rounded-left"></i></div>
            </div>
            <!-- All Courses Tabs Menu End -->
            <!-- All Courses tab content Start -->
            <div class="tab-content courses-tab-content">

                @foreach($categories as $catKey => $cat)
                <div class="tab-pane fade @if(++$catKey ==1) show active @endif " id="{{$cat['slug'][$currentLang]}}{{$cat['id']}}">
                    <!-- All Courses Wrapper Start -->
                    @if(!empty($cat['news'][0]['title'][$currentLang]))
                    <div class="courses-wrapper">
                        <div class="row">
                            @foreach($cat['news'] as $blog)
                                <div class="col-lg-4 col-md-6">

                                    <!-- Single Blog Start -->
                                    <div class="single-blog">
                                        <div class="blog-image" style=" text-align: center;!important;">
                                            <a href="{{ route('site.blogDetail',['category' => $blog['category']['slug'][$currentLang], 'slug' => $blog['slug'][$currentLang]]) }}">
                                                <img style="max-height: 196px;max-width: 198px; text-align: center;!important;" src="{{ asset("uploads/news/".$blog['image']) }}" alt="{{$blog['title'][$currentLang]}}"></a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-author">
                                                <div class="author">
                                                    <div class="author-name">
                                                        <a class="name" href="{{ route('site.blogDetail',['category' => $blog['category']['slug'][$currentLang], 'slug' => $blog['slug'][$currentLang]]) }}">{{$blog['title'][$currentLang]}}</a>
                                                    </div>
                                                </div>
                                                <div class="tag">
                                                    <a href="{{ route('site.blogs',['category' => $blog['category']['slug'][$currentLang]]) }}">{{$blog['category']['title'][$currentLang]}}</a>
                                                </div>
                                            </div>

                                            <h4 class="title"><a href="{{ route('site.blogDetail',['category' => $blog['category']['slug'][$currentLang], 'slug' => $blog['slug'][$currentLang]]) }}">{{$blog['text'][$currentLang]}}</a></h4>

                                            <div class="blog-meta">
                                                <span> <i class="icofont-calendar"></i>{{ date('d.m.Y',strtotime($blog['datetime'])) }}</span>
                                                {{--                                        <span> <i class="icofont-eye"></i> {{$blog['reads']}}+ </span>--}}
                                            </div>

                                            <a href="{{ route('site.blogDetail',['category' => $blog['category']['slug'][$currentLang], 'slug' => $blog['slug'][$currentLang]]) }}" class="btn btn-secondary btn-hover-primary">@lang('site.read_more')</a>
                                        </div>
                                    </div>
                                    <!-- Single Blog End -->

                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <!-- All Courses Wrapper End -->
                </div>
                @endforeach
            </div>
            <!-- All Courses tab content End -->
        </div>
    </div>
    @endif
    <!-- All Courses End -->
    <br><br><br>

    <!-- Download App Start -->
    <div style="top: 23px;!important;" class="section section-padding download-section">

        <div class="app-shape-1"></div>
        <div class="app-shape-2"></div>
        <div class="app-shape-3"></div>
        <div class="app-shape-4"></div>

        <div class="container">

            <!-- Download App Wrapper Start -->
            <div class="download-app-wrapper mt-n6">

                <!-- Section Title Start -->
                <div class="section-title section-title-white">
                    <h5 class="sub-title">@lang('site.home_title_one')</h5>
                    <h2 class="main-title">@lang('site.home_text_one')</h2>
                </div>
                <!-- Section Title End -->

                <img class="shape-1 animation-right" src="{{ asset("site/assets/images/shape/shape-14.png") }}" alt="Shape">

                <!-- Download App Button End -->
                <div class="download-app-btn">
                    <ul class="app-btn">
                        <li><a href="{{ route('site.signup') }}">@lang('site.signup')</a></li>
                    </ul>
                </div>
                <!-- Download App Button End -->

            </div>
            <!-- Download App Wrapper End -->

        </div>
    </div>
    <!-- Download App End -->

    <!-- How It Work End -->
    <div class="section section-padding mt-n1">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title shape-03 text-center">
                <h5 class="sub-title">@lang('site.home_service_title')</h5>
                <h2 class="main-title">@lang('site.home_service_text')</h2>
            </div>
            <!-- Section Title End -->
            @if(!empty($services[0]['title'][$currentLang]))
                <!-- How it Work Wrapper Start -->
                <div class="how-it-work-wrapper">
                    @foreach($services as $service)
                        <!-- Single Work Start -->
                        <div class="work-arrow">
                            <img class="arrow" src="{{ asset("site/assets/images/shape/shape-17.png") }}" alt="Shape">
                        </div>
                        <!-- Single Work End -->
                        <!-- Single Work Start -->
                        <div class="single-work" style="    background-image: url(https://marmaragroup.az/wp-content/uploads/2018/08/shutterstock_59887279.jpg) !important;">
                            <img class="shape-1" src="{{ asset("site/assets/images/shape/shape-15.png") }}" alt="Shape">

                            <div class="work-icon">
                                <i class="flaticon-transparency"></i>
                            </div>
                            <div class="work-content">
                                <h3 class="title">{{$service['title'][$currentLang]}}</h3>
                                <p>{!! $service['text'][$currentLang] !!}</p>
                            </div>
                        </div>
                        <!-- Single Work End -->


                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- How It Work End -->

    <!-- Download App Start -->
    <div class="section section-padding download-section">

        <div class="app-shape-1"></div>
        <div class="app-shape-2"></div>
        <div class="app-shape-3"></div>
        <div class="app-shape-4"></div>

        <div class="container">

            <!-- Download App Wrapper Start -->
            <div class="download-app-wrapper mt-n6">

                <!-- Section Title Start -->
                <div class="section-title section-title-white">
                    <h5 class="sub-title">@lang('site.home_title_two')</h5>
                    <h2 class="main-title">@lang('site.home_text_two')</h2>
                </div>
                <!-- Section Title End -->

                <img class="shape-1 animation-right" src="{{ asset("site/assets/images/shape/shape-14.png") }}" alt="Shape">

                <!-- Download App Button End -->
                <div class="download-app-btn">
                    <ul class="app-btn">
                        <li><a href="{{ route('site.signup') }}">@lang('site.signup')</a></li>
                    </ul>
                </div>
                <!-- Download App Button End -->

            </div>
            <!-- Download App Wrapper End -->

        </div>
    </div>
    <!-- Download App End -->
    <!-- Blog Start -->


    <div class="section section-padding mt-n1">
        <div class="container">

            <div class="section-title shape-03 text-center">
                <h5 class="sub-title">@lang('site.study_abroads')</h5>
                <h2 class="main-title">@lang('site.study_abroads_text')</h2>
            </div>

            @if(!empty($studyAbroads[0]['name'][$currentLang]))
                <div class="blog-wrapper study-abroad-active">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            @foreach($studyAbroads as $studyAbroad)
                                <div class="swiper-slide">
                                    <div class="single-blog">
                                        <div class="blog-image" style="text-align: center !important;">
                                            <a href="{{ route('site.study-abroad-details', [
                                            'country' => $studyAbroad['country']['slug'][$currentLang],
                                            'university' => $studyAbroad['university']['slug'][$currentLang],
                                            'slug' => $studyAbroad['slug'][$currentLang]
                                        ]) }}">
                                                <img
                                                    style="max-height: 196px; max-width: 198px; text-align: center !important;"
                                                    src="{{ asset('uploads/studyAbroads/'.$studyAbroad['image']) }}"
                                                    alt="{{ $studyAbroad['name'][$currentLang] }}"
                                                >
                                            </a>
                                        </div>

                                        <div class="blog-content">
                                            <div class="blog-author">
                                                <div class="author">
                                                    @if(!empty($studyAbroad['university']['image']))
                                                        <div class="author-thumb">
                                                            <a href="#">
                                                                <img
                                                                    src="{{ asset('uploads/universities/'.$studyAbroad['university']['image']) }}"
                                                                    alt="{{ $studyAbroad['university']['name'][$currentLang] }}"
                                                                >
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <div class="author-name">
                                                        <a class="name" href="#">
                                                            {{ $studyAbroad['university']['name'][$currentLang] }}
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="tag">
                                                    <a href="#">
                                                        {{ $studyAbroad['country']['name'][$currentLang] }}
                                                    </a>
                                                </div>
                                            </div>

                                            <h4 class="title">
                                                <a href="{{ route('site.study-abroad-details', [
                                                'country' => $studyAbroad['country']['slug'][$currentLang],
                                                'university' => $studyAbroad['university']['slug'][$currentLang],
                                                'slug' => $studyAbroad['slug'][$currentLang]
                                            ]) }}">
                                                    {{ $studyAbroad['name'][$currentLang] }}
                                                </a>
                                            </h4>

                                            <a href="{{ route('site.study-abroad-details', [
                                            'country' => $studyAbroad['country']['slug'][$currentLang],
                                            'university' => $studyAbroad['university']['slug'][$currentLang],
                                            'slug' => $studyAbroad['slug'][$currentLang]
                                        ]) }}" class="btn btn-secondary btn-hover-primary">
                                                @lang('site.read_more')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>


    @if(!empty($universities[0]['name'][$currentLang]))
        <div class="section section-padding-02">
            <div class="container">

                <div class="brand-logo-wrapper">

                    <img class="shape-1" src="{{ asset('site/assets/images/shape/shape-19.png') }}" alt="Shape">
                    <img class="shape-2 animation-round" src="{{ asset('site/assets/images/shape/shape-20.png') }}" alt="Shape">

                    <div class="section-title shape-03">
                        <h2 class="main-title">@lang('site.partner_text')</h2>
                    </div>

                    @if(!empty($universities))
                        <div class="brand-logo brand-marquee-active">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">

                                    @foreach($universities as $university)
                                        <div class="single-brand swiper-slide">
                                            <img
                                                src="{{ asset('uploads/universities/'.$university['image']) }}"
                                                alt="{{ $university['name'][$currentLang] }}"
                                            >
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    @endif

    {{--<div class="section section-padding mt-n1">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title shape-03 text-center">
                <h5 class="sub-title">@lang('site.study_abroads')</h5>
                <h2 class="main-title">@lang('site.study_abroads_text')</h2>
            </div>
            <!-- Section Title End -->
            @if(!empty($studyAbroads[0]['name'][$currentLang]))
            <!-- Blog Wrapper Start -->
            <div class="blog-wrapper ">
                <div class="row">
                    @foreach($studyAbroads as $studyAbroad)
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Courses Start -->
                            <div class="single-blog">
                                <div class="blog-image" style=" text-align: center;!important;">
                                    <a href="{{ route('site.study-abroad-details',['country' => $studyAbroad['country']['slug'][$currentLang], 'university' => $studyAbroad['university']['slug'][$currentLang], 'slug' => $studyAbroad['slug'][$currentLang]]) }}">
                                        <img style="max-height: 196px;max-width: 198px; text-align: center;!important;" src="{{ asset("uploads/studyAbroads/".$studyAbroad['image']) }}" alt="{{$studyAbroad['name'][$currentLang]}}">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-author">
                                        <div class="author">
                                            @if(!empty($studyAbroad['university']['image']))
                                                <div class="author-thumb">
                                                    <a href="#"><img src="{{ asset("uploads/universities/".$studyAbroad['university']['image']) }}" alt="Author"></a>
                                                </div>
                                            @endif
                                            <div class="author-name">
                                                <a class="name" href="#">{{$studyAbroad['university']['name'][$currentLang]}}</a>
                                            </div>
                                        </div>
                                        <div class="tag">
                                            <a href="#">{{$studyAbroad['country']['name'][$currentLang]}}</a>
                                        </div>
                                    </div>

                                    <h4 class="title"><a href="{{ route('site.study-abroad-details',['country' => $studyAbroad['country']['slug'][$currentLang], 'university' => $studyAbroad['university']['slug'][$currentLang], 'slug' => $studyAbroad['slug'][$currentLang]]) }}">{{$studyAbroad['name'][$currentLang]}}</a></h4>
                                    --}}{{--<div class="courses-meta">
                                        <span> <i class="icofont-clock-time"></i> {{$studyAbroad['university']}}</span>
                                        <span> <i class="icofont-read-book"></i> 29 baxış </span>
                                    </div>--}}{{--
                                    <a href="{{ route('site.study-abroad-details',['country' => $studyAbroad['country']['slug'][$currentLang], 'university' => $studyAbroad['university']['slug'][$currentLang], 'slug' => $studyAbroad['slug'][$currentLang]]) }}" class="btn btn-secondary btn-hover-primary">@lang('site.read_more')</a>
                                </div>
                            </div>
                            <!-- Single Courses End -->
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <!-- Blog Wrapper End -->

        </div>
    </div>

    @if(!empty($universities[0]['name'][$currentLang]))
        <!-- Brand Logo Start -->
        <div class="section section-padding-02">
            <div class="container">

                <!-- Brand Logo Wrapper Start -->
                <div class="brand-logo-wrapper">

                    <img class="shape-1" src="{{ asset("site/assets/images/shape/shape-19.png") }}" alt="Shape">

                    <img class="shape-2 animation-round" src="{{ asset("site/assets/images/shape/shape-20.png") }}" alt="Shape">

                    <!-- Section Title Start -->
                    <div class="section-title shape-03">
                        <h2 class="main-title">@lang('site.partner_text')</h2>
                    </div>
                    <!-- Section Title End -->
                    @if(!empty($universities))
                        <!-- Brand Logo Start -->
                        <div class="brand-logo brand-active">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($universities as $university)
                                        <!-- Single Brand Start -->
                                        <div class="single-brand swiper-slide">
                                            <img src="{{ asset("uploads/universities/".$university['image']) }}" alt="{{$university['name'][$currentLang]}}">
                                        </div>
                                        <!-- Single Brand End -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Brand Logo End -->

                </div>
                <!-- Brand Logo Wrapper End -->

            </div>
        </div>
        <!-- Brand Logo End -->
    @endif--}}
@endsection
@section('site.js')
    <!-- Modernizer & jQuery JS -->
    <script src="{{ asset('site/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <script src="{{ asset('site/assets/js/plugins.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function () {

            let heroSlideCount = $('.hero-photo-slider .swiper-slide').length;

            new Swiper('.hero-photo-slider .swiper-container', {
                slidesPerView: 1,
                loop: heroSlideCount > 1,
                speed: 1600,
                autoplay: heroSlideCount > 1 ? {
                    delay: 5000,
                    disableOnInteraction: false
                } : false,
                navigation: {
                    nextEl: '.hero-button-next',
                    prevEl: '.hero-button-prev'
                }
            });

        });
    </script>
    <script>
        $(document).ready(function () {

            new Swiper('.study-abroad-active .swiper-container', {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                speed: 9000,
                allowTouchMove: false,
                autoplay: {
                    delay: 1,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 25
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                }
            });

        });
    </script>
    <script>
        $(document).ready(function () {

            new Swiper('.brand-marquee-active .swiper-container', {
                slidesPerView: 5,
                spaceBetween: 50,
                loop: true,
                speed: 6000,
                allowTouchMove: false,
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false
                },
                breakpoints: {
                    0: {
                        slidesPerView: 2,
                        spaceBetween: 25
                    },
                    576: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 40
                    },
                    992: {
                        slidesPerView: 5,
                        spaceBetween: 50
                    }
                }
            });

        });
    </script>
@endsection
