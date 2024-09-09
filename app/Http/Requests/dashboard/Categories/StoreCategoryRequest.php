<?php

namespace App\Http\Requests\Dashboard\Categories;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
    public function rules(): array
    {
        return Category::rules();
    }

    public function messages()
    {
//        return [
//            'required' => ':Attribute deosn't enter',
//            'name.required' => 'Please enter your name.',
//            'name.max' => 'The name may not be greater than 255 characters.',
//        ];
    }
}
