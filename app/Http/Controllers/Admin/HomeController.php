<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Repositories\SlidersRepositoryImpl;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $sliderRepository;
    protected $currentLang;

    public function __construct(SlidersRepositoryImpl $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
        $locales = Translation::where('status',1)->pluck('code')->toArray();
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang,$locales)){
            return self::notFound();
        }
    }
    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found',compact('currentLang'));
    }
    public function index()
    {
        if (!Auth::user()->can('sliders-view')) {
            return view('admin.home.index');
        }

        $sliders = $this->sliderRepository->getAll();
        $currentLang = $this->currentLang;
        return view('admin.sliders.index',compact('sliders','currentLang'));
    }

}
