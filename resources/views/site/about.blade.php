@php
    $aboutTitle = data_get($about, "title.$currentLang") ?? data_get($about, 'title.az') ?? __('site.about_us');
    $aboutSubTitle = data_get($about, "sub_title.$currentLang") ?? data_get($about, 'sub_title.az') ?? __('site.welcome');
    $aboutText = data_get($about, "text.$currentLang") ?? data_get($about, 'text.az');
    $aboutImage = !empty($about?->image) ? asset('uploads/about/' . $about->image) : asset('site/assets/img/hero-img-3.png');
@endphp

@extends('site.layouts.app')

@section('site.title')
    {{ $aboutTitle }}
@endsection

@section('site.meta_description')
    {!! $aboutText !!}
@endsection

@section('site.meta_keywords')
    {{ implode(', ', array_filter([$aboutTitle, __('site.about_us'), __('site.study_abroads'), __('site.language_courses')])) }}
@endsection

@section('site.css')
@endsection

@section('site.content')
    <section class="about-hero py-5">
        <div class="container">
            <div class="row align-items-center g-4 g-xl-5">
                <div class="col-lg-6 col-md-12">
                    <div class="about-hero-copy">
                        <h1 class="display-2 fw-semibold page-title">
                            {{ $aboutTitle }}
                        </h1>
                        <p class="fs-5 about-subtitle">
                            {{ $aboutSubTitle }}
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('site.signup') }}" class="btn btn-main rounded-pill px-4">@lang('site.signup')</a>
                            <a href="{{ route('site.contact') }}" class="btn btn-gray rounded-pill px-4">@lang('site.contact')</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="facts-img about-hero-media">
                        <img src="{{ $aboutImage }}" class="img-fluid" alt="{{ $aboutTitle }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Page Header Intro End ================================== -->

    <!-- ========================== About Facts List Section =============================== -->
    <section class="about-content py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="about-content-body">
                        <h2>{{ $aboutTitle }}</h2>
                        <div class="about-richtext">{!! $aboutText !!}</div>
                        <a href="{{ route('site.signup') }}" class="btn btn-main rounded-pill px-5 mt-4">@lang('site.signup')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================== About Facts List Section =============================== -->

    @if($teachers->count())
        <!-- ============================ Featured Instructor Start ================================== -->
        <section class="bg-light">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <div class="sec-heading center">
                            <h2>@lang('site.teachers')</h2>
                            <p>@lang('site.teachers_text')</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="arrow_slide four_slide arrow_middle">
                            @foreach($teachers as $teacher)
                                @php
                                    $teacherName = data_get($teacher, "name.$currentLang") ?? data_get($teacher, 'name.az');
                                    $teacherPosition = data_get($teacher, "position.name.$currentLang") ?? data_get($teacher, 'position.name.az');
                                    $fallbackAvatar = ['user-1.jpg', 'user-2.jpg', 'user-3.jpg'][$loop->index % 3];
                                @endphp

                                <div class="singles_items">
                                    <div class="card rounded-4 border">
                                        <div class="p-2 d-flex flex-column gap-3">

                                            <!--img-->
                                            <a href="#">
                                                <img src="{{ !empty($teacher->image) ? asset('uploads/teachers/'.$teacher->image) : asset('site/assets/img/'.$fallbackAvatar) }}" alt="{{ $teacherName }}" class="img-fluid w-100 rounded-4">
                                            </a>

                                            <!--content-->
                                            <div class="d-flex flex-column gap-4">
                                                <div class="d-flex flex-column gap-2">
                                                    <div class="tutor-head-info">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <h5 class="mb-0"><a href="#" class="text-reset">{{ $teacherName }}</a></h5>
                                                            <span class="verified-tutor">
																<i class="bi bi-patch-check-fill text-green"></i>
															</span>
                                                        </div>
                                                        @if($teacherPosition)
                                                        <span class="text-muted-2">{{ $teacherPosition }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
        </section>
    @endif
@endsection

@section('site.js')
@endsection
