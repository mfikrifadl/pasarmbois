<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductPost extends FormRequest
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
            'pp_id_category' => 'required',
            'pp_id_measurement' => 'required',
            'pp_title' => 'unique:App\Product|required',
            'pp_basic_price' => 'required|numeric',
            'pp_selling_price' => 'required|numeric',
            'pp_qty' => 'required|numeric',
            'pp_weight' => 'required|numeric',
            'pp_description' => 'required',
            'pp_status' => 'required',
            'pp_email' => 'required|email',
            'pp_phone' => 'required|numeric',
        ];
    }
}
