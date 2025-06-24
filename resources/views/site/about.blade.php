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
                    <li class="active">@lang('site.about_us')</li>
                </ul>
                <h2 class="title">@lang('site.about_text')</h2>
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
    <!-- About Start -->
    <div class="section">

        <div class="section-padding-02 mt-n10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">

                        <!-- About Images Start -->
                        <div class="about-images">
                            <div class="images">
                                <img src="{{ asset("site/assets/images/about.jpg") }}" alt="About">
                            </div>

                        </div>
                        <!-- About Images End -->

                    </div>
                    <div class="col-lg-6">
                        <!-- About Content Start -->
                        <div class="about-content">
                            <h5 class="sub-title">@lang('site.welcome').</h5>
                            <h2 class="main-title">
                                @lang('site.about_title')</h2>
                            @lang('site.about_full_text')
                            <a href="{{ route('site.signup') }}" class="btn btn-primary btn-hover-dark">@lang('site.signup')</a>
                            <br>
                            <br>
                            <br>
                        </div>
                        <!-- About Content End -->

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- About End -->
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
                    <h5 class="sub-title">@lang('site.about_title')</h5>
                    <h2 class="main-title">@lang('site.about_text')</h2>
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

    <!-- Team Member's Start -->
    <div class="section section-padding mt-n1">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title shape-03 text-center">
                <h5 class="sub-title">@lang('site.team')</h5>
                <h2 class="main-title">@lang('site.team_text')</h2>
            </div>
            <!-- Section Title End -->

            <!-- Team Wrapper Start -->
            <div class="team-wrapper">
                <div class="row row-cols-lg-5 row-cols-sm-3 row-cols-2 ">
                    @foreach($teachers as $teacher)
                        <div class="col">

                            <!-- Single Team Start -->
                            <div class="single-team">
                                <div class="team-thumb">
                                    <img src="{{ !empty($teacher['image'])? asset("uploads/teachers/".$teacher['image']): asset('site/assets/images/user.jpg') }}" alt="Author">
                                </div>
                                <div class="team-content">
                                    <h4 class="name">{{ $teacher['name'][$currentLang] }}</h4>
                                    <span class="designation">{{$teacher['position']['name'][$currentLang]}}</span>
                                </div>
                            </div>
                            <!-- Single Team End -->

                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Team Wrapper End -->

        </div>
    </div>
    <!-- Team Member's End -->
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
