<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
        return [
            // key: rule
            'name' => 'bail|sometimes|required|unique:products|max:255|min:10',
            'price' => 'sometimes|required',
            'category_id' => 'sometimes|required',
            'content' => 'sometimes|required',
        ];
    }
}
