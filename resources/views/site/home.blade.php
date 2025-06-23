@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
    <style>
        /* === Slider əsas konteyner === */
        .slider-section {
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 150px 0 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        /* === Qarartma effekti === */
        .slider-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4); /* 40% qara şəffaf overlay */
            z-index: 1;
        }

        /* === Slider məzmunu === */
        .slider-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            margin: 0 auto;
            color: #ffffff; /* Yazılar ağ */
        }

        /* Alt başlıq */
        .slider-content .sub-title {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        /* Başlıq */
        .slider-content .main-title {
            font-size: 36px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        /* Açıqlama mətn */
        .slider-content p {
            font-size: 18px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        /* Qoşul düyməsi */
        .slider-content .btn {
            background-color: #ffffff;
            color: #000;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        /* Hover effekti */
        .slider-content .btn:hover {
            background-color: #000;
            color: #fff;
        }

        /* === Mobil üçün uyğunlaşdırma === */
        @media (max-width: 768px) {
            .slider-section {
                padding: 100px 20px 80px;
            }

            .slider-content .main-title {
                font-size: 24px;
            }

            .slider-content p {
                font-size: 16px;
            }

            .slider-content .btn {
                font-size: 16px;
                padding: 10px 25px;
            }

            .slider-courses-box,
            .slider-rating-box {
                display: none; /* İstəyə bağlı mobil versiyada gizlətmək olar */
            }
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
    <div class="section slider-section" style="background-image: url('https://marmaragroup.az/wp-content/uploads/2018/08/shutterstock_59887279.jpg')!important;">

        <!-- Slider Shape Start -->
        {{--<div class="slider-shape">
            <img class="shape-1 animation-round" src="{{ asset("site/assets/images/shape/shape-8.png") }}" alt="Shape">
        </div>--}}
        <!-- Slider Shape End -->

        <div class="container">
            <!-- Slider Content Start -->
            <div class="slider-content">
                <h1 class="main-title" style="color: aliceblue">{{$slider['title'][$currentLang] ?? ''}}</h1>
                <p style="margin: 0 auto; font-size: 42px; line-height: 1.6;">
                    {!! $slider['text'][$currentLang] ?? '' !!}
                </p>
            </div>
            <!-- Slider Content End -->
        </div>

        <!-- Slider Courses Box Start -->
        <div class="slider-courses-box">

            <img class="shape-1 animation-left" src="{{ asset("site/assets/images/shape/shape-5.png") }}" alt="Shape">

            <div class="box-content">
                <div class="box-wrapper">
                    <i class="flaticon-open-book"></i>
                    <span class="count">1,235</span>
                    <p>@lang('site.course')</p>
                </div>
            </div>

            <img class="shape-2" src="{{ asset("site/assets/images/shape/shape-6.png") }}" alt="Shape">

        </div>
        <!-- Slider Courses Box End -->

        <!-- Slider Rating Box Start -->
        <div class="slider-rating-box">

            <div class="box-rating">
                <div class="box-wrapper">
                    <span class="count">4.8 <i class="flaticon-star"></i></span>
                    <p>@lang('site.student')</p>
                </div>
            </div>

            <img class="shape animation-up" src="{{ asset("site/assets/images/shape/shape-7.png") }}" alt="Shape">

        </div>
        <!-- Slider Rating Box End -->
    {{--    @if(!empty($slider['image']))
        <!-- Slider Images Start -->
        <div class="slider-images">
            <div class="images">
                <img src="{{ asset("uploads/sliders/".$slider['image']) }}" alt="Slider">
--}}{{--                <img src="{{ asset("site/assets/images/slider/slider-1.png") }}" alt="Slider">--}}{{--
            </div>
        </div>
        @endif--}}
        <!-- Slider Images End -->

        <!-- Slider Video Start -->
        <div class="slider-video">
            <img class="shape-1" src="{{ asset("site/assets/images/shape/shape-9.png") }}" alt="Shape">

            <div class="video-play">
                <img src="{{ asset("site/assets/images/shape/shape-10.png") }}" alt="Shape">
                <a href="https://www.youtube.com/watch?v=BRvyWfuxGuU" class="play video-popup"><i class="flaticon-play"></i></a>
            </div>
        </div>
        <!-- Slider Video End -->

    </div>
    <!-- Slider End -->

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
                        @foreach($categories as $cat)
                            <li class="swiper-slide"><button class="active" data-bs-toggle="tab" data-bs-target="#{{$cat['slug'][$currentLang]}}">{{$cat['title'][$currentLang]}}</button></li>
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

                @foreach($categories as $cat)
                <div class="tab-pane fade show active" id="{{$cat['slug'][$currentLang]}}">
                    <!-- All Courses Wrapper Start -->
                    <div class="courses-wrapper">
                        <div class="row">
                            @foreach($cat['news'] as $blog)
                                <div class="col-lg-4 col-md-6">

                                    <!-- Single Blog Start -->
                                    <div class="single-blog">
                                        <div class="blog-image">
                                            <a href="{{ route('site.blogDetail',['category' => $blog['category']['slug'][$currentLang], 'slug' => $blog['slug'][$currentLang]]) }}"><img src="{{ asset("uploads/news/".$blog['image']) }}" alt="{{$blog['title'][$currentLang]}}"></a>
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
                    <!-- All Courses Wrapper End -->
                </div>
                @endforeach
            </div>
            <!-- All Courses tab content End -->
        </div>
    </div>
    <!-- All Courses End -->

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
            @if(!empty($services))
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

            <!-- Section Title Start -->
            <div class="section-title shape-03 text-center">
                <h5 class="sub-title">@lang('site.study_abroads')</h5>
                <h2 class="main-title">@lang('site.study_abroads_text')</h2>
            </div>
            <!-- Section Title End -->
            @if(!empty($studyAbroads))
            <!-- Blog Wrapper Start -->
            <div class="blog-wrapper">
                <div class="row">
                    @foreach($studyAbroads as $studyAbroad)
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Courses Start -->
                            <div class="single-blog">
                                <div class="blog-image">
                                    <a href="{{ route('site.study-abroad-details',['country' => $studyAbroad['country']['slug'][$currentLang], 'university' => $studyAbroad['university']['slug'][$currentLang], 'slug' => $studyAbroad['slug'][$currentLang]]) }}">
                                        <img src="{{ asset("uploads/studyAbroads/".$studyAbroad['image']) }}" alt="{{$studyAbroad['name'][$currentLang]}}">
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
                                    {{--<div class="courses-meta">
                                        <span> <i class="icofont-clock-time"></i> {{$studyAbroad['university']}}</span>
                                        <span> <i class="icofont-read-book"></i> 29 baxış </span>
                                    </div>--}}
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

    @if(!empty($universities[0]))
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
    @endif
@endsection
@section('site.js')
    <!-- Modernizer & jQuery JS -->
    <script src="{{ asset('site/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <script src="{{ asset('site/assets/js/plugins.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
@endsection
