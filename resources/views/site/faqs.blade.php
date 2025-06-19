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
                    <li><a href="{{ route('site.index') }}">Əsas səhifə</a></li>
                    <li class="active">Bizimlə əlaqə</li>
                </ul>
                <h2 class="title">Bizi əlaqə saxlayıb <span>İstədiyiniz dili öyrənib, İstədiyiniz universitetdə</span> təhsil ala bilərsiniz.</h2>
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
    <!-- FAQ Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- FAQ Tab Content Start -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1">
                    <!-- FAQ Wrapper Start -->
                    <div class="faq-wrapper">
                        @foreach($faqs as $faq)
                            <!-- Single FAQ Item Start -->
                            <div class="single-faq-item">
                                <div class="row align-items-center">
                                    <div class="col-lg-5">
                                        <div class="faq-title">
                                            <h4 class="title">{{$faq['question'][$currentLang]}}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="faq-text">
                                            <p>{!! $faq['answer'][$currentLang] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single FAQ Item End -->
                        @endforeach
                    </div>
                    <!-- FAQ Wrapper End -->
                </div>
            </div>
            <!-- FAQ Tab Content End -->

        </div>
    </div>
    <!-- FAQ End -->
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
