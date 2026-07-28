<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class CommitsHelper
{
    public static function data($request)
    {
        $locales = Translation::where('status',1)->get();
        $name = [];
        $slug = [];
        $description = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $name[$code] = $request->input("name.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("title.".$code, '')));
            $description[$code] = $request->input("description.".$code, '');
        }

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/commits'), $image);
        } else {
            $image = !empty($request->old_image) ? $request->old_image : null;
        }

        $data = [
            'image' => $image,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'datetime' => $request->datetime ?? now(),
        ];
        return $data;
    }
}
