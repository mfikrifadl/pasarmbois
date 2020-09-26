<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'pu_id_role' => 'required',
            'pu_username' => 'required|unique:user',
            'pud_email' => 'required|unique:email',
            'pu_password' => 'required'
        ];
    }
}
