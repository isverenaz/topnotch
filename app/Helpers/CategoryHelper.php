<?php

namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class CategoryHelper
{
    public static function data($request)
    {
        $locales = Translation::where('status',1)->get();
        $title = []; $slug = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $title[$code] = $request->input("title.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("title.".$code, '')));
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'status' => $request->status,
        ];

        return $data;
    }
}
