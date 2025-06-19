<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class TeachersHelper
{
    public static function data($request,$teacher = null)
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
            $request->image->move(public_path('uploads/teachers'), $image);
        }else{
            $image = !empty($teacher->image)? $teacher->image: NULL;
        }
        $data = [
            'image' => $image,
            'name' => $name,
            'slug' => $slug,
            'status' => $request->status ?? 0,
            'position_id' => $request->position_id ?? 0,
            'is_main' => $request->is_main ?? 0,
        ];
        return $data;
    }
}
