@extends('site.layouts.app')
@section('site.title')
@endsection

@section('site.meta_description')
    {{ __('site.teachers_text') }}
@endsection

@section('site.meta_keywords')
    {{ implode(', ', array_filter([__('site.teachers'), __('site.teacher'), __('site.about_us')])) }}
@endsection

@section('site.css')
    <!-- Google Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("site/assets/css/vendor/plugins.min.css") }}">
    <link rel="stylesheet" href="{{ asset("site/assets/css/style.min.css") }}">
    <style>
        .teacher-post-image{
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: #f8f9fa;
            /*background: linear-gradient(135deg,#f8f9fa,#eef2f7);*/
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .teacher-post-image img{
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            transition: transform .5s ease;
            padding: 10px;
        }

        .teacher-post-image:hover img{
            transform: scale(1.15);
        }

        /* Modal slider */
        .teacher-modal img{
            width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }

        .teacher-nav{
            position:absolute;
            top:50%;
            transform:translateY(-50%);
            background:#00000070;
            color:#fff;
            border:none;
            padding:10px 15px;
            cursor:pointer;
            font-size:20px;
        }

        .teacher-prev{ left:10px; }
        .teacher-next{ right:10px; }
    </style>
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
                    <li class="active">@lang('site.teachers')</li>
                </ul>
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
    <!-- Team Member's Start -->
    <div class="section section-padding mt-n1">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title shape-03 text-center">
                <h5 class="sub-title">@lang('site.our_teachers')</h5>
                <h2 class="main-title">@lang('site.teachers_text')</h2>
            </div>
            <!-- Section Title End -->
            <div class="row g-4">
                @foreach($teachers as $key => $teacher)
                    <div class="col-lg-4 col-md-6 col-12">

                        <div class="teacher-post-card">

                            <div class="teacher-post-image"
                                 data-bs-toggle="modal"
                                 data-bs-target="#teacherModal"
                                 data-index="{{ $key }}">

                                <img src="{{ !empty($teacher['image'])
                    ? asset('uploads/teachers/'.$teacher['image'])
                    : asset('site/assets/images/user.jpg') }}"
                                     alt="{{ $teacher['name'][$currentLang] }}">

                            </div>

                            <div class="teacher-post-content">
                <span class="teacher-category">
                    {{ $teacher['position']['name'][$currentLang] ?? '' }}
                </span>

                                <h3 class="teacher-title">
                                    {{ $teacher['name'][$currentLang] }}
                                </h3>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <div class="modal fade teacher-modal" id="teacherModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content position-relative">

                <button type="button" class="btn-close position-absolute end-0 m-3"
                        data-bs-dismiss="modal"></button>

                <button class="teacher-nav teacher-prev">&#10094;</button>
                <button class="teacher-nav teacher-next">&#10095;</button>

                <img id="teacherModalImg" src="" alt="teacher">

            </div>
        </div>
    </div>
    <!-- Team Member's End -->
@endsection
@section('site.js')
    <script>
        const teachers = @json($teachers);
        let currentIndex = 0;

        document.querySelectorAll('.teacher-post-image').forEach(el => {
            el.addEventListener('click', function () {
                currentIndex = parseInt(this.dataset.index);
                openModal();
            });
        });

        function openModal() {
            setImage();
        }

        function setImage() {
            let img = teachers[currentIndex]['image'];

            document.getElementById('teacherModalImg').src =
                img ? `/uploads/teachers/${img}` : '/site/assets/images/user.jpg';
        }

        document.querySelector('.teacher-next').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % teachers.length;
            setImage();
        });

        document.querySelector('.teacher-prev').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + teachers.length) % teachers.length;
            setImage();
        });
    </script>
    <!-- Modernizer & jQuery JS -->
    <script src="{{ asset('site/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <script src="{{ asset('site/assets/js/plugins.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
@endsection
