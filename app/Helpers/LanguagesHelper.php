<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class LanguagesHelper
{
    public static function data($request,$language = null)
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
            $request->image->move(public_path('uploads/languages'), $image);
        }else{
            $image = !empty($language->image)? $language->image: NULL;
        }
        $data = [
            'parent_id' => $request->parent_id ?? NULL,
            'teacher_id' => $request->teacher_id ?? NULL,
            'image' => $image,
            'name' => $name,
            'slug' => $slug,
            'status' => $request->status ?? 0,
            'is_main' => $request->is_main ?? 0,
        ];
        return $data;
    }
}
