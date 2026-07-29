@php
    $pageTitle = __('site.signup_us');
    $pageText = __('site.contact_full_text');
@endphp

@extends('site.layouts.app')

@section('site.title')
    {{ $pageTitle }}
@endsection

@section('site.meta_description')
    {{ \Illuminate\Support\Str::limit(trim(strip_tags($pageText)), 160) }}
@endsection

@section('site.meta_keywords')
    {{ implode(', ', array_filter([$pageTitle, __('site.study_abroads'), __('site.language_courses'), __('site.contact_us')])) }}
@endsection

@section('site.content')
    <section class="bg-gredient page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="pageTitle-wrap text-center">
                        <h1 class="text-light">{{ $pageTitle }}</h1>
                        <p class="text-light mb-0">{!! $pageText !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-7">
                    <div class="card border h-100">
                        <div class="card-header bg-white border-bottom">
                            <h4 class="card-title mb-0">@lang('site.signup_us')</h4>
                        </div>
                        <div class="card-body p-4">
                            <div id="signup-form-alert" class="alert d-none mb-4"></div>
                            <form id="signupForm" action="{{ route('site.sendContact') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-lg-6 col-md-12">
                                    <label class="form-label">@lang('site.name')</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    <div class="text-danger small js-field-error" data-field="name"></div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label class="form-label">@lang('site.surname')</label>
                                    <input type="text" name="surname" class="form-control" value="{{ old('surname') }}">
                                    <div class="text-danger small js-field-error" data-field="surname"></div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label class="form-label">@lang('site.phone')</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+994XX XXX XX XX">
                                    <div class="text-danger small js-field-error" data-field="phone"></div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label class="form-label">@lang('site.email')</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    <div class="text-danger small js-field-error" data-field="email"></div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">@lang('site.note')</label>
                                    <textarea name="message" class="form-control" rows="5" placeholder="{{ __('site.study_abroad_form_text') }}">{{ old('message') }}</textarea>
                                    <div class="text-danger small js-field-error" data-field="message"></div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-main px-5">@lang('site.send')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card border h-100">
                        <div class="card-body p-4">
                            <h4 class="mb-3">@lang('site.study_abroads')</h4>
                            <p class="text-muted-2 mb-4">@lang('site.study_abroad_form_text')</p>

                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="square--40 circle bg-light-main text-main flex-shrink-0"><i class="bi bi-mortarboard-fill"></i></div>
                                    <div>
                                        <h6 class="mb-1">@lang('site.study_abroads')</h6>
                                        <p class="text-muted-2 mb-0">@lang('site.study_abroads_text')</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3">
                                    <div class="square--40 circle bg-light-main text-main flex-shrink-0"><i class="bi bi-translate"></i></div>
                                    <div>
                                        <h6 class="mb-1">@lang('site.language_courses')</h6>
                                        <p class="text-muted-2 mb-0">@lang('site.language_courses_text')</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3">
                                    <div class="square--40 circle bg-light-main text-main flex-shrink-0"><i class="bi bi-building"></i></div>
                                    <div>
                                        <h6 class="mb-1">@lang('site.schools')</h6>
                                        <p class="text-muted-2 mb-0">@lang('site.contact_full_text')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('site.js')
    <script>
        (function ($) {
            const $form = $('#signupForm');
            const $alert = $('#signup-form-alert');

            function resetMessages() {
                $alert.addClass('d-none').removeClass('alert-success alert-danger').text('');
                $form.find('.js-field-error').text('');
            }

            function showAlert(type, message) {
                $alert.removeClass('d-none alert-success alert-danger')
                    .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
                    .text(message);
            }

            function setFieldErrors(errors) {
                if (!errors) return;
                Object.keys(errors).forEach(function (field) {
                    const message = Array.isArray(errors[field]) ? errors[field][0] : errors[field];
                    $form.find('.js-field-error[data-field="' + field + '"]').text(message || '');
                });
            }

            $form.on('submit', function (event) {
                event.preventDefault();
                resetMessages();

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    success: function (response) {
                        if (response && response.success) {
                            showAlert('success', response.message || @json(__('site.contact_request_success')));
                            $form[0].reset();
                        } else {
                            showAlert('danger', response.message || @json(__('site.error_message')));
                        }
                    },
                    error: function (xhr) {
                        const response = xhr.responseJSON || {};
                        if (xhr.status === 422) {
                            showAlert('danger', response.message || @json(__('site.error_message')));
                            setFieldErrors(response.errors || {});
                            return;
                        }

                        showAlert('danger', response.message || @json(__('site.error_message')));
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
