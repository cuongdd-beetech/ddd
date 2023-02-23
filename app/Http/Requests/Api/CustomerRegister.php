<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|unique:customers,email|max:100',
            'phone' => 'required|numeric|unique:customers,phone',
            'password' => 'required|string|confirmed'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([$validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
