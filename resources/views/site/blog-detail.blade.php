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
    <div class="section page-banner">

        <img class="shape-1 animation-round" src="{{ asset("site/assets/images/shape/shape-8.png") }}" alt="Shape">

        <img class="shape-2" src="{{ asset("site/assets/images/shape/shape-23.png") }}" alt="Shape">

        <div class="container">
            <!-- Page Banner Start -->
            <div class="page-banner-content">
                <ul class="breadcrumb">
                    <li><a href="{{ route('site.index') }}">@lang('site.home')</a></li>
                    <li>{{$blog['category']['title'][$currentLang]}}</li>
                    <li class="active">{{$blog['title'][$currentLang]}}</li>
                </ul>
                <h2 class="title">{{$blog['text'][$currentLang] ?? ''}}</h2>
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
    <!-- Courses Start -->
    <div class="section section-padding mt-n10">
        <div class="container">
            <div class="row gx-10">
                <div class="col-lg-8">

                    <!-- Courses Details Start -->
                    <div class="courses-details">
                        @if(!empty($blog['image']))
                            <div class="courses-details-images">
                                <img src="{{ asset("uploads/news/".$blog['image']) }}" alt="{{$blog['title'][$currentLang]}}">
                                <span class="tags">@lang('site.blogs')</span>
                            </div>
                        @endif
                        <h2 class="title">{{$blog['title'][$currentLang] ?? ''}}</h2>

                        <div class="courses-details-admin">
                            <div class="admin-author">
                                {{--@if(!empty($languageCourse['teacher']['image']))
                                    <div class="author-thumb">
                                        <a href="#"><img src="{{ asset("uploads/teachers/".$languageCourse['teacher']['image']) }}" alt="{{ $languageCourse['teacher']['name'][$currentLang] }}"></a>
                                    </div>
                                @endif--}}
                                {{--<div class="author-content">
                                    <a class="name">{{ $languageCourse['teacher']['name'][$currentLang] }}</a>
                                    <span class="Enroll"><i class="icofont-eye"></i>{{$languageCourse['read'] ?? 0}}</span>
                                </div>--}}
                            </div>
                        </div>

                        <!-- Courses Details Tab Start -->
                        <div class="courses-details-tab">
                            <!-- Details Tab Content Start -->
                            <div class="details-tab-content">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="description">

                                        <!-- Tab Description Start -->
                                        <div class="tab-description">
                                            <div class="description-wrapper">
                                                {!! $blog['fulltext'][$currentLang] ?? '' !!}
                                            </div>
                                        </div>
                                        <!-- Tab Description End -->

                                    </div>
                                </div>
                            </div>
                            <!-- Details Tab Content End -->

                        </div>
                        <!-- Courses Details Tab End -->

                    </div>
                    <!-- Courses Details End -->

                </div>
                <div class="col-lg-4">
                    <!-- Courses Details Sidebar Start -->
                    <div class="sidebar">

                        <!-- Sidebar Widget Information Start -->
                        <div class="sidebar-widget widget-information">
                            <div class="info-list">
                                <ul>
                                    <li><i class="icofont-man-in-glasses"></i> <strong>@lang('site.category')</strong> <span> {{$blog['category']['title'][$currentLang]}}</span></li>
{{--                                    <li><i class="icofont-man-in-glasses"></i> <strong>@lang('site.leve')</strong><span style="font-size: 13px;!important;">{{$languageCourse['leve']['name'][$currentLang]}}</span></li>--}}
                                                                        <li><i class="icofont-clock-time"></i> <strong>Duration</strong> <span>{{ date('d.m.Y',strtotime($blog['datetime'])) }}</span></li>
                                    {{--                                    <li><i class="icofont-ui-video-play"></i> <strong>Lectures</strong> <span>29</span></li>--}}
                                    {{--                                    <li><i class="icofont-bars"></i> <strong>Level</strong> <span>Secondary</span></li>--}}
                                    {{--                                    <li><i class="icofont-book-alt"></i> <strong>Language</strong> <span>English</span></li>--}}
                                    {{--                                    <li><i class="icofont-certificate-alt-1"></i> <strong>Certificate</strong> <span>Yes</span></li>--}}
                                </ul>
                            </div>
                            <div class="info-btn">
                                <a href="{{ route('site.signup') }}" class="btn btn-primary btn-hover-dark">@lang('site.signup_us')</a>
                            </div>
                        </div>
                        <!-- Sidebar Widget Information End -->

                        <!-- Sidebar Widget Share Start -->
                        <div class="sidebar-widget">
                            <h4 class="widget-title">@lang('site.share'):</h4>

                            <ul class="social">
                                <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                                <li><a href="#"><i class="flaticon-linkedin"></i></a></li>
                                <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                                <li><a href="#"><i class="flaticon-skype"></i></a></li>
                                <li><a href="#"><i class="flaticon-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- Sidebar Widget Share End -->

                    </div>
                    <!-- Courses Details Sidebar End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->
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
