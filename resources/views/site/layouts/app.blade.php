<!DOCTYPE html>
<html lang="{{$lang??'az'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@lang('site.site_name')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    @if(!empty($data['setting']['favicon']))
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/settings/'.$data['setting']['favicon']) }}">
    @endif
    @yield('site.css')
    <style>
        .header-language select {
            background-color: #1f2b37;
            color: #fff;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            width: 70px;
        }
    </style>
</head>
<body>
<div class="main-wrapper">
<x-site.header />
@yield('site.content')
<x-site.footer />
