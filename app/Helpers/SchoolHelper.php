<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class SchoolHelper
{
    public static function data($request, $school = null)
    {
        $locales = Translation::where('status',1)->get();
        $name = []; $slug = []; $text = []; $full_text = []; $campaign = [];
        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $name[$code] = $request->input("name.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("name.".$code, '')));
            $text[$code] = $request->input("text.".$code, '');
            $full_text[$code] = $request->input("full_text.".$code, '');
            $campaign[$code] = $request->input("campaign.".$code, '');
        }
        if($request->hasFile('image')){
            $image = time().$request->image->extension();
            $request->image->move(public_path('uploads/schools'), $image);
        }else{
            $image = !empty($school->image)? $school->image: NULL;
        }
        $data = [
            'category_id' => $request->category_id ?? 0,
            'country_id' => $request->country_id ?? 0,
            'language_id' => $request->language_id ?? 0,
            'parent_language_id' => $request->parent_language_id ?? 0,
            'teacher_id' => $request->teacher_id ?? 0,
            'image' => $image,
            'name' => $name,
            'text' => $text,
            'full_text' => $full_text,
            'slug' => $slug,
            'status' => $request->status ?? 0,
            'is_main' => $request->is_main ?? 0,
            'is_campaign' => $request->is_campaign ?? 0,
            'campaign' => $campaign ?? 0,
        ];
        return $data;
    }
}
