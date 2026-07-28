<?php

namespace App\View\Composer;

use App\Models\Category;
use App\Models\Company;
use App\Models\CourseCategory;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Translation;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ViewComposer
{
    public function compose(View $view)
    {
        $lang = LaravelLocalization::getCurrentLocale() ?? 'az';
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
            'langIcon' => Translation::where(['code' => $lang,'status' =>1])->first(),
            'langs' => Translation::where('status',1)->get(),
            'setting' => Setting::where('title->'.$lang,'!=',NULL)->first(),
            'mainLanguages' => $mainLanguages,
            'courseCategories' => $courseCategories,
        ];
        $view->with(['data' => $data]);
    }
}
