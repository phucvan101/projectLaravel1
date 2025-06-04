<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Container\Attributes\DB;

class CategoryAddRequest extends FormRequest
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
            //
            'name' => 'bail|required|unique:categories|string|max:255',
            'parent_id' => [
                'sometimes',
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        return true; // Cho phép parent_id = 0
                    }

                    if (!\DB::table('categories')->where('id', $value)->exists()) {
                        $fail('Parent ID không hợp lệ.');
                    }
                },
            ]
        ];
    }
}
