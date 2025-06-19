<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class LanguageCoursesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $isCreate = $this->isMethod('post');
        return [
            'language_id' => 'required|integer|exists:languages,id',
            'parent_language_id' => 'required|integer|exists:languages,id',
            'image' => $isCreate ? 'image|mimes:jpeg,png,jpg,gif,svg': 'image|mimes:jpeg,png,jpg,gif,svg',
            'name.az' => 'required|string|max:255',
            'text.az' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => Lang::get('validation.required', ['attribute' => ':attribute']),
            '*.integer' => Lang::get('validation.integer', ['attribute' => ':attribute']),
            '*.exists' => Lang::get('validation.exists', ['attribute' => ':attribute']),
            '*.string' => Lang::get('validation.string', ['attribute' => ':attribute']),
            'image.image' => 'Yalnız şəkil faylları yüklənə bilər.',
            'image.mimes' => 'Şəkil yalnız jpeg, png, jpg, gif və ya svg formatında olmalıdır.',
        ];
    }
}
