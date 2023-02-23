<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\AgeRule;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email|max:100',
            'user_name' => 'required|unique:users,user_name',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'birthday' => new AgeRule, 
            'file_upload' => 'required|image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:3000',
            'province_id' => 'required',
            'commune_id' => 'required',
            'district_id' => 'required'
        ];
    }

    /**
     *  get index view with data get from db
     *
     * @return message
     */
    public function message()
    {
        return [
            'email.required' => 'You must enter your :atrribute',
            'email.unique' => 'This value was created in DB',
            'first_name.required' => 'You must enter your first name',
            'first_name.min' => 'first name must less or equal than :max characters',
            'last_name.required' => 'You must enter your last name',
        ];
    }

}
