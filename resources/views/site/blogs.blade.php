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
                    <li class="active">@lang('site.blogs')</li>
                </ul>
                <h2 class="title">@lang('site.blog_text')</h2>
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

    <!-- Blog Start -->
    <div class="section section-padding mt-n10">
        <div class="container">

            <!-- Blog Wrapper Start -->
            <div class="blog-wrapper">
                <div class="row">
                    @if($blogs[0]['title'][$currentLang])
                        @foreach($blogs as $blog)
                        <div class="col-lg-4 col-md-6">

                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-image" style=" text-align: center;!important;">
                                    <a href="{{ route('site.blogDetail',['category' => $blog['category']['slug'][$currentLang], 'slug' => $blog['slug'][$currentLang]]) }}"><img style="max-height: 196px;max-width: 198px; text-align: center;!important;" src="{{ asset("uploads/news/".$blog['image']) }}" alt="{{$blog['title'][$currentLang]}}"></a>
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
                    @endif
                </div>
            </div>
            <!-- Blog Wrapper End -->

            <!-- Page Pagination End -->
            {{--<div class="page-pagination">
                <ul class="pagination justify-content-center">
                    <li><a href="#"><i class="icofont-rounded-left"></i></a></li>
                    <li><a class="active" href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
                </ul>
            </div>--}}
            <!-- Page Pagination End -->

        </div>
    </div>
    <!-- Blog End -->
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
