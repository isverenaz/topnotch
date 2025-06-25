@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <li class="active">@lang('site.contact_us')</li>
                </ul>
                <h2 class="title">@lang('site.contact_full_text')</h2>
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
    <!-- Contact Map Start -->
    <div class="section section-padding-02">
        <div class="container">

            <!-- Contact Map Wrapper Start -->
            <div class="contact-map-wrapper">
                <iframe id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d194473.18588939894!2d49.8549596!3d40.394592499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8d0b2baef5a7f5e9%3A0x53afc0baf5698489!2sTop%20Notch%20Language%20HUB!5e0!3m2!1sen!2saz!4v1748205353721!5m2!1sen!2saz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
{{--                <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Mission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>--}}
            </div>
            <!-- Contact Map Wrapper End -->

        </div>
    </div>
    <!-- Contact Map End -->

    <!-- Contact Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- Contact Wrapper Start -->
            <div class="contact-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6">

                        <!-- Contact Info Start -->
                        <div class="contact-info">

                            <img class="shape animation-round" src="{{ asset("site/assets/images/shape/shape-12.png") }}" alt="Shape">

                            <!-- Single Contact Info Start -->
                            <div class="single-contact-info">
                                <div class="info-icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">@lang('site.phone_nergiz').</h6>
                                    @if(!empty($setting['phone']))
                                        <p><i class="flaticon-phone-call"></i> <a href="tel:{{$setting['phone']}}">{{$setting['phone']}}</a></p>
                                    @endif
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="info-icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">@lang('site.phone_ilahe').</h6>
                                        <p><i class="flaticon-phone-call"></i> <a href="tel:+994 50 540 92 93">+994 50 540 92 93</a></p>
                                </div>
                            </div>
                            <!-- Single Contact Info End -->
                            <!-- Single Contact Info Start -->
                            <div class="single-contact-info">
                                <div class="info-icon">
                                    <i class="flaticon-email"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">@lang('site.email').</h6>
                                    @if(!empty($setting['email']))
                                        <p><i class="flaticon-email"></i> <a href="mailto:{{$setting['email']}}">{{$setting['email']}}</a></p>
                                    @endif
                                </div>
                            </div>
                            <!-- Single Contact Info End -->
                            <!-- Single Contact Info Start -->
                            <div class="single-contact-info">
                                <div class="info-icon">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">@lang('site.address').</h6>
                                    <p>{{$setting['address'][$currentLang] ?? ''}}</p>
                                </div>
                            </div>
                            <!-- Single Contact Info End -->
                        </div>
                        <!-- Contact Info End -->

                    </div>
                    <div class="col-lg-6">

                        <!-- Contact Form Start -->
                        <div class="contact-form">
                            <h3 class="title">@lang('site.contact_text')</h3>

                            <div class="form-wrapper">
                                <form id="contactForm" action="" method="POST">
                                    @csrf
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="text" id="name" name="name" placeholder="@lang('site.full_name')">
                                    </div>
                                    <!-- Single Form End -->
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="email" id="email" name="email" placeholder="info@topnotch.az">
                                    </div>
                                    <!-- Single Form End -->
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <input type="text" id="phone" name="phone" placeholder="+99450*******">
                                    </div>
                                    <!-- Single Form End -->
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <textarea id="message" name="message" placeholder="@lang('site.note')"></textarea>
                                    </div>
                                    <!-- Single Form End -->
                                    <p class="form-message"></p>
                                    <!-- Single Form Start -->
                                    <div class="single-form">
                                        <button class="btn btn-primary btn-hover-dark w-100">@lang('site.send') <i class="flaticon-right"></i></button>
                                    </div>
                                    <!-- Single Form End -->
                                </form>
                            </div>
                        </div>
                        <!-- Contact Form End -->

                    </div>
                </div>
            </div>
            <!-- Contact Wrapper End -->

        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('site.js')
    <!-- Modernizer & jQuery JS -->
    <script src="{{ asset('site/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <script src="{{ asset('site/assets/js/plugins.min.js') }}"></script>

    <script>
        $('#contactForm').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let url = "{{ route('site.sendContact') }}";
            let formData = form.serialize();

            // Əvvəlki xətaları təmizləyək
            form.find('.form-message').html('').removeClass('text-danger text-success');

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Uğurlu mesaj
                    if (response.status === 422) {
                        // let errors = response.errors;
                        /*let errorHtml = '<ul>';
                        $.each(errors, function (key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });*/
                        // errorHtml += '</ul>';
                        form.find('.form-message').addClass('text-danger').html(response.message);
                    } else {
                        form.find('.form-message').addClass('text-success').html(response.message);
                        form.trigger("reset");
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul>';
                        $.each(errors, function (key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                        errorHtml += '</ul>';
                        form.find('.form-message').addClass('text-danger').html(errorHtml);
                    } else {
                        form.find('.form-message').addClass('text-danger').html('Xəta baş verdi, zəhmət olmasa yenidən cəhd edin.');
                    }
                }
            });
        });
    </script>
    <!-- Main JS -->
{{--    <script src="{{ asset('site/assets/js/main.js') }}"></script>--}}
@endsection
