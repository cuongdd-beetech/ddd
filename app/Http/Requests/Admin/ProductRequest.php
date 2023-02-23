<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'stock'=>'required|min:0|max:10000|numeric',
            'expired_at'=> 'required|date|after:today',
            'file_upload' => 'image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:3000',
            'sku'=> 'required|min:10|max:20|regex:/^[a-zA-Z0-9]*$/',
            'category_id' => 'required|exists:products,category_id'
        ];
    }
}
