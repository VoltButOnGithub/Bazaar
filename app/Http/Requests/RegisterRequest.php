<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\UserTypesEnum;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:25',
            'username' => 'required|unique:App\Models\User,username|max:30|min:3',
            'password' => 'required|min:3|max:30',
            'type' => 'required',
            'url' => [
                'exclude_unless:type,' . UserTypesEnum::BUSINESS->value,
                'unique:App\Models\Business,url',
                'max:30',
            ],
        ];
    }
}
