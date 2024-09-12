<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressFormRequest extends FormRequest
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
			'clientName' => $isRequired.'string',
			'street' => $isRequired.'string',
			'codePostal' => $isRequired.'string',
			'city' => $isRequired.'string',
			'state' => $isRequired.'string',
			'noreDetails' =>'string',
            'addressType' => $isRequired.'in:Adresse de livraison,Adresse de facturation', // Validation stricte des valeurs acceptées
            'user_id' => $isRequired.'exists:users,id',

        ];
    }
    public function prepareForValidation()
    {
        $this->merge([

        ]);
    }
}
