<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ad_type' => 'required',
            'ad_name' => 'required|max:25',
            'ad_description' => 'nullable|max:2500',
            'ad_price' => 'required',
            'ad_images' => 'nullable|max:5',
        ];
    }
}
