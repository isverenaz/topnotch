<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CourseCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title.az' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => Lang::get('validation.required', ['attribute' => ':attribute']),
        ];
    }
}
