@extends('site.layouts.app')

@section('site.title')
    @lang('site.page_not_found')
@endsection

@section('site.meta_description')
    @lang('site.error_message')
@endsection

@section('site.meta_keywords')
    {{ implode(', ', array_filter([__('site.page_not_found'), __('site.back_to_home')])) }}
@endsection

@section('site.css')
@endsection

@section('site.content')
    <section class="error-wrap py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="text-center py-5">
                        <img src="{{ asset('site/assets/img/logo-icon.png') }}" class="img-fluid mb-4" alt="{{ config('app.name') }}">
                        <h1 class="mb-3">@lang('site.page_not_found')</h1>
                        <p class="mb-4">@lang('site.error_message')</p>
                        <a class="btn btn-main px-4" href="{{ route('site.index') }}">@lang('site.back_to_home')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('site.js')
@endsection
