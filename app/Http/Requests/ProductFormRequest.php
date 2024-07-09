<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
			'slug' => $isRequired.'',
			'description' => $isRequired.'string',
			'moreDescrciption' => $isRequired.'string',
			'additionalInfos' => $isRequired.'string',
			'stock' => $isRequired.'string',
			'soldePrice' => $isRequired.'string',
			'regularPrice' => $isRequired.'string',
			'imageUrls' => $isRequired.'array|max:5',
			'imageUrls.*' => 'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
			'brand' => $isRequired.'string',
            'isAvailable' => 'required|boolean',
			'isBestSeller' => 'required|boolean',
			'isNewArrival' => 'required|boolean',
			'isFeatured' => 'required|boolean',
			'isSpecialOffer' => 'required|boolean',
            'categories'=>$isRequired.'exists:categories,id'

        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->input('name')),
            'isAvailable' => $this->boolean('isAvailable'),
            'isBestSeller' => $this->boolean('isBestSeller'),
            'isNewArrival' => $this->boolean('isNewArrival'),
            'isFeatured' => $this->boolean('isFeatured'),
            'isSpecialOffer' => $this->boolean('isSpecialOffer'),

        ]);
    }
}
