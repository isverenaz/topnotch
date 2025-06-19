<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

try {
    Route::group([
    'prefix' => implode('/', [LaravelLocalization::setLocale(), '']),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {
        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/about', 'HomeController@about')->name('about');
        Route::get('/faqs', 'HomeController@faqs')->name('faqs');
        Route::get('/conditions', 'HomeController@conditions')->name('conditions');
        Route::get('/rules', 'HomeController@rules')->name('rules');
        Route::get('/study-abroad/{country?}/{university?}', 'HomeController@studyAbroad')->name('study-abroad');
        Route::get('/study-abroad-degree/{degree?}', 'HomeController@degreeStudyAbroad')->name('degree-study-abroad');
        Route::get('/study-abroad-details/{country?}/{university?}/{slug}', 'HomeController@studyAbroadDetails')->name('study-abroad-details');
        Route::get('/language-courses/{language?}/{leve?}', 'HomeController@languageCourses')->name('language-courses');
        Route::get('/language-courses-details/{language?}/{leve?}/{slug}', 'HomeController@languageCoursesDetails')->name('language-courses-details');
        Route::get('/blogs/{category?}', 'HomeController@blogs')->name('blogs');
        Route::get('/blog-detail/{category?}/{slug}', 'HomeController@blogDetail')->name('blogDetail');
        Route::get('/contact', 'HomeController@contact')->name('contact');
        Route::get('/404', 'HomeController@notPage')->name('404');
        Route::get('/signup', 'HomeController@signup')->name('signup');
        Route::post('/send-contact', 'AjaxController@sendContact')->name('sendContact');

        Route::get('/project-detail/{slug}', 'HomeController@projectDetail')->name('projectDetail');
        Route::get('/service-detail/{slug}', 'HomeController@serviceDetail')->name('serviceDetail');
    });
    Route::fallback(function () {
        abort(404);
    });
}catch (\Exception $exception){
    return response($exception->getMessage(), 500);
}
