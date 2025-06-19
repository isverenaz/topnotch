<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class StudyAbroadsHelper
{
    public static function data($request,$studyAbroad = null)
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
            $request->image->move(public_path('uploads/studyAbroads'), $image);
        }else{
            $image = !empty($studyAbroad->image)? $studyAbroad->image: NULL;
        }
        $data = [
            'country_id' => $request->country_id ?? 0,
            'university_id' => $request->university_id ?? 0,
            'degree_id' => $request->degree_id ?? 0,
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
