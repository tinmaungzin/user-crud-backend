<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends APIRequest
{
    public function rules()
    {
        return [
            'email' => ['email:rfc,dns',
                Rule::unique('users','email')->ignore($this->user)]
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
