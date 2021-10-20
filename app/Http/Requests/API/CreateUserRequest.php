<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;

class CreateUserRequest extends APIRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'bail|required|unique:users|email:rfc,dns',
            'password' => 'bail|required|min:6|confirmed',
        ];
    }
    public function authorize()
    {
        return parent::authorize();
    }

    public function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator);
    }
}
