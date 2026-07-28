<?php
namespace App\View\Components\Site;
use App\Models\Category;
use App\Models\EducationalDegree;
use App\Models\InstituteCategory;
use App\Models\LaboratoryCategory;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\UsefulCategory;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Footer extends Component
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
        $lang = LaravelLocalization::getCurrentLocale() ?? 'az';
        $setting = Setting::first();

        $data = [
            'lang' => $lang,
            'setting' => $setting,
            'siteAddress' => data_get($setting, "address.$lang") ?? data_get($setting, 'address.az') ?? data_get($setting, 'address.en') ?? data_get($setting, 'address.ru'),
            'sitePhone' => data_get($setting, 'phone'),
            'siteEmail' => data_get($setting, 'email'),
            'siteName' => data_get($setting, "title.$lang") ?? data_get($setting, 'title.az') ?? config('app.name', 'Topnotch.az'),
        ];

        return view('components.site.footer', compact('data'));
    }
}
