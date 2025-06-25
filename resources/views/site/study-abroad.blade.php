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
        <div class="container">
            <!-- Slider Content Start -->
            <div class="slider-content">

                <h2 class="main-title" style="color: aliceblue"> @lang('site.study_abroads')
                @if(!empty($country))
                    / {{$country['name'][$currentLang]}}
                @endif
                @if(!empty($country) &&  !empty($university))
                    / {{$university['name'][$currentLang]}}
                @endif
                </h2>
                <p style="margin: 0 auto; font-size: 42px; line-height: 1.6;">
                    @lang('site.study_abroads_text')
                </p>
            </div>
            <!-- Slider Content End -->
        </div>
    </div>
    <!-- Slider End -->
    <div class="section section-padding">
        <div class="container">
            <!-- Courses Wrapper Start  -->
            <div class="courses-wrapper-02">
                <div class="row">
                    @if(!empty($studyAbroads[0]['title'][$currentLang]))
                        @foreach($studyAbroads as $studyAbroad)
                            <div class="col-lg-4 col-md-6">
                                <!-- Single Courses Start -->
                                <div class="single-courses">
                                    <div class="courses-images">
                                        <a href="{{ route('site.study-abroad-details',['country' => $studyAbroad['country']['slug'][$currentLang], 'university' => $studyAbroad['university']['slug'][$currentLang], 'slug' => $studyAbroad['slug'][$currentLang]]) }}">
                                            <img src="{{ asset("uploads/studyAbroads/".$studyAbroad['image']) }}" alt="{{$studyAbroad['name'][$currentLang]}}">
                                        </a>
                                        <div class="courses-option dropdown">
                                            <button class="option-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><i class="icofont-share-alt"></i> @lang('site.share')</a></li>
                                                <li><a href="{{ route('site.signup') }}"><i class="icofont-plus"></i> @lang('site.signup')</a></li>
                                                <li><a href="{{ route('site.contact') }}"><i class="icofont-plus"></i> @lang('site.contact')</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="courses-content">
                                        <div class="courses-author">
                                            <div class="author">
                                                @if(!empty($studyAbroad['university']['image']))
                                                <div class="author-thumb">
                                                    <a href="#"><img src="{{ asset("uploads/universities/".$studyAbroad['university']['image']) }}" alt="Author"></a>
                                                </div>
                                                @endif
                                                <div class="author-name">
                                                    <a class="name" href="#">{{$studyAbroad['university']['name'][$currentLang]}}</a>
                                                    <a class="name-2" href="#">{{$studyAbroad['country']['name'][$currentLang]}}</a>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="title">
                                            <a href="{{ route('site.study-abroad-details',['country' => $studyAbroad['country']['slug'][$currentLang], 'university' => $studyAbroad['university']['slug'][$currentLang], 'slug' => $studyAbroad['slug'][$currentLang]]) }}">{{$studyAbroad['name'][$currentLang]}}</a>
                                        </h4>
                                        <div class="courses-rating">
                                            <p>{!! $studyAbroad['text'][$currentLang] !!}</p>
                                            @if(!empty($studyAbroad['is_campaign']))
                                            <div class="rating-progress-bar">
                                                <div class="rating-line" style="width: 38%;"></div>
                                            </div>
                                            @endif
                                            <div class="rating-meta">
                                                <p><a  href="{{ route('site.study-abroad-details',['country' => $studyAbroad['country']['slug'][$currentLang], 'university' => $studyAbroad['university']['slug'][$currentLang], 'slug' => $studyAbroad['slug'][$currentLang]]) }}">@lang('site.read_more')</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Courses End -->
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- Courses Wrapper End  -->

        </div>
    </div>
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
