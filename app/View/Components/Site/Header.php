<?php

namespace App\View\Components\Site;

use App\Models\CourseCategory;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Translation;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Header extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        $lang = LaravelLocalization::getCurrentLocale() ?? 'az';
        $languages = ['az', 'en', 'ru'];

        $mainLanguages = Language::with(['parentLanguages' => function ($query) {
                $query->where('status', 1)->orderBy('order_by', 'asc')->orderByDesc('id');
            }])
            ->whereNull('parent_id')
            ->where('status', 1)
            ->orderBy('order_by', 'asc')
            ->orderByDesc('id')
            ->get()
            ->map(function ($language) use ($lang) {
                return (object) [
                    'id' => $language->id,
                    'title' => data_get($language, "name.$lang") ?? data_get($language, 'name.az') ?? __('site.language'),
                    'url' => route('site.courses', ['language' => $language->id]),
                    'children' => collect($language->parentLanguages)->map(function ($level) use ($lang, $language) {
                        return (object) [
                            'id' => $level->id,
                            'title' => data_get($level, "name.$lang") ?? data_get($level, 'name.az') ?? __('site.leve'),
                            'url' => route('site.courses', ['language' => $language->id, 'level' => $level->id]),
                        ];
                    }),
                ];
            });

        $courseCategories = CourseCategory::with(['languageCourses' => function ($query) {
                $query->where('status', 1)->orderByDesc('id');
            }])
            ->where('status', 1)
            ->orderBy('order_by', 'asc')
            ->orderByDesc('id')
            ->get()
            ->map(function ($category) use ($lang) {
                return (object) [
                    'id' => $category->id,
                    'title' => data_get($category, "title.$lang") ?? data_get($category, 'title.az') ?? __('site.course_categories'),
                    'children' => collect($category->languageCourses)->map(function ($course) use ($lang) {
                        return (object) [
                            'title' => data_get($course, "name.$lang") ?? data_get($course, 'name.az') ?? __('site.course'),
                            'url' => route('site.courses-details', [data_get($course, "slug.$lang") ?? data_get($course, 'slug.az')]),
                        ];
                    }),
                    'url' => route('site.courses', ['category' => $category->id]),
                ];
            });

        $data = [
            'lang' => $lang,
            'languageLinks' => collect($languages)->map(function ($locale) use ($lang) {
                return (object) [
                    'code' => $locale,
                    'label' => strtoupper($locale),
                    'url' => LaravelLocalization::getLocalizedURL($locale, null, [], true),
                    'active' => $locale === $lang,
                ];
            })->values(),
            'langIcon' => Translation::where(['code' => $lang, 'status' => 1])->first(),
            'langs' => Translation::where('status', 1)->get(),
            'setting' => Setting::where('title->' . $lang, '!=', null)->first(),
            'mainLanguages' => $mainLanguages,
            'courseCategories' => $courseCategories,
        ];

        return view('components.site.header', compact('data'));
    }
}
