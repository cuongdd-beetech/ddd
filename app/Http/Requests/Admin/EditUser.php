<?php

namespace App\Http\Requests\admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\AgeRule;

class EditUser extends FormRequest
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
            'email' => 'required|email|max:100|unique:users,email,' .$this->route('id'),
            'user_name' => 'required',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'birthday' => new AgeRule,
            'file_upload' => 'image|mimes:jpeg,png,jpg',
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
