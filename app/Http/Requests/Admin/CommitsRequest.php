<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CommitsRequest extends FormRequest
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
        return [
            'name.az' => 'required|string|max:255',
            'description.az' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => Lang::get('validation.required', ['attribute' => ':attribute']),
        ];
    }
}
