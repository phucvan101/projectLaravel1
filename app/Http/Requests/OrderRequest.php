<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            // dùng somtimes cho các trường để khi update trường nào có sẵn không muốn update thì không bị lỗi validate
            'customer_name' => 'sometimes|required',
            'customer_phone' => 'sometimes|required',
            'customer_address' => 'sometimes|required',
            'customer_email' => 'sometimes|required|email',
            'status' => 'sometimes|required|in:pending,confirmed,shipping,delivered,cancelled',
        ];
    }
}
