<?php
namespace App\View\Components\Site;
use App\Models\Category;
use App\Models\Country;
use App\Models\InstituteCategory;
use App\Models\LaboratoryCategory;
use App\Models\Language;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Translation;
use App\Models\UsefulCategory;
use App\Models\VirtualLaboratory;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $currentLang = LaravelLocalization::getCurrentLocale();
        $translations =  Translation::where(['status' => 1])->get();
        $setting = Setting::first();
        $countries = Country::with('universities')->where(['status' => 1])->orderBy('name->'.$currentLang,'ASC')->get();
        $languages = Language::with('parentLanguages')->where(['status' => 1])->orderBy('name->'.$currentLang,'ASC')->get();
        $categories = Category::where(['status' => 1])->orderBy('title->'.$currentLang,'ASC')->get();
        return view('components.site.header',compact('currentLang','languages','setting','countries','translations','categories'));
    }
}
