<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MethodFormRequest extends FormRequest
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
        $isRequired = request()->isMethod("POST") ?"required|": "";
        return [
            //
            'name' => $isRequired.'string',
			'description' => $isRequired.'string',
			'moreDescription' => $isRequired.'string',
			'imageUrl' => $isRequired.'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
			'test_public_key' => $isRequired.'string',
			'test_private_key' => $isRequired.'string',
			'prod_public_key' => $isRequired.'string',
			'pro_private_key' => $isRequired.'string'
			
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            
        ]);
    }
}