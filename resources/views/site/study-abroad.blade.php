@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
    <!-- Google Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("site/assets/css/vendor/plugins.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/assets/css/style.min.css") }}">
@endsection
@section('site.content')
    <!-- Page Banner Start -->
    <div class="section page-banner">

        <img class="shape-1 animation-round" src="{{ asset("site/assets/images/shape/shape-8.png") }}" alt="Shape">

        <img class="shape-2" src="{{ asset("site/assets/images/shape/shape-23.png") }}" alt="Shape">

        <div class="container">
            <!-- Page Banner Start -->
            <div class="page-banner-content">
                <ul class="breadcrumb">
                    <li><a href="{{ route('site.index') }}">@lang('site.home')</a></li>
                    <li @if(empty($country) && empty($university)) class="active" @endif> @lang('site.study_abroads')</li>
                    @if(!empty($country))
                        <li @empty($university) class="active" @endempty>{{$country['name'][$currentLang]}}</li>
                    @endif
                    @if(!empty($university))
                        <li class="active">{{$university['name'][$currentLang]}}</li>
                    @endif
                </ul>
                <h2 class="title">@lang('site.study_abroads_text')</h2>
            </div>
            <!-- Page Banner End -->
        </div>

        <!-- Shape Icon Box Start -->
        <div class="shape-icon-box">

            <img class="icon-shape-1 animation-left" src="{{ asset("site/assets/images/shape/shape-5.png") }}" alt="Shape">

            <div class="box-content">
                <div class="box-wrapper">
                    <i class="flaticon-badge"></i>
                </div>
            </div>
            <img class="icon-shape-2" src="{{ asset("site/assets/images/shape/shape-6.png") }}" alt="Shape">
        </div>
        <!-- Shape Icon Box End -->
        <img class="shape-3" src="{{ asset("site/assets/images/shape/shape-24.png") }}" alt="Shape">
        <img class="shape-author" src="{{ asset("site/assets/images/author/author-11.jpg") }}" alt="Shape">
    </div>
    <!-- Page Banner End -->
    <div class="section section-padding">
        <div class="container">
            <!-- Courses Wrapper Start  -->
            <div class="courses-wrapper-02">
                <div class="row">
                    @if(!empty($studyAbroads))
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
