<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class UniversitiesHelper
{
    public static function data($request,$university = null)
    {
        $locales = Translation::where('status',1)->get();
        $name = []; $slug = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $name[$code] = $request->input("name.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("name.".$code, '')));
        }
        if($request->hasFile('image')){
            $image = time().$request->image->extension();
            $request->image->move(public_path('uploads/universities'), $image);
        }else{
            $image = !empty($university->image)? $university->image: NULL;
        }
        $data = [
            'image' => $image,
            'name' => $name,
            'slug' => $slug,
            'status' => $request->status ?? 0,
            'country_id' => $request->country_id ?? 0,
            'is_main' => $request->is_main ?? 0,
        ];
        return $data;
    }
}
