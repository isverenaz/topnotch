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

        <img class="shape-1 animation-round" src="{{asset('site/assets/images/shape/shape-8.png')}}" alt="Shape">

        <img class="shape-2" src="{{ asset('site/assets/images/shape/shape-23.png') }}" alt="Shape">

        <div class="container">
            <!-- Page Banner Start -->
            <div class="page-banner-content">
                <ul class="breadcrumb">
                    <li><a href="{{ route('site.index') }}">@lang('site.home')</a></li>
                    <li class="active">@lang('site.page_not_found')</li>
                </ul>
            </div>
            <!-- Page Banner End -->
        </div>

        <!-- Shape Icon Box Start -->
        <div class="shape-icon-box">

            <img class="icon-shape-1 animation-left" src="{{asset('site/assets/images/shape/shape-5.png')}}" alt="Shape">

            <div class="box-content">
                <div class="box-wrapper">
                    <i class="flaticon-badge"></i>
                </div>
            </div>

            <img class="icon-shape-2" src="{{asset('site/assets/images/shape/shape-6.png')}}" alt="Shape">

        </div>
        <!-- Shape Icon Box End -->

        <img class="shape-3" src="{{asset('site/assets/images/shape/shape-24.png')}}" alt="Shape">

        <img class="shape-author" src="{{asset('site/assets/images/shape/shape-11.png')}}" alt="Shape">

    </div>
    <!-- Page Banner End -->
    <!-- Error Start -->
    <div class="section section-padding mt-n10">
        <div class="container">

            <!-- Error Wrapper Start -->
            <div class="error-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Error Images Start -->
                        <div class="error-images">
                            <img src="{{ asset('site/assets/images/error.png') }}" alt="Error">
                        </div>
                        <!-- Error Images End -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Error Content Start -->
                        <div class="error-content">
                            <h5 class="sub-title">@lang('site.page_not_found')</h5>
                            <h2 class="main-title">@lang('site.error_message')</h2>
                            <a href="{{ route('site.index') }}" class="btn btn-primary btn-hover-dark">@lang('site.back_to_home')</a>
                        </div>
                        <!-- Error Content End -->
                    </div>
                </div>
            </div>
            <!-- Error Wrapper End -->

        </div>
    </div>
    <!-- Error End -->

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
