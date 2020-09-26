<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            'pp_id_category' => 'sometimes|required',
            'pp_id_measurement' => 'sometimes|required',
            'pp_title' => 'sometimes|required',
            'pp_basic_price' => 'sometimes|required|numeric',
            'pp_selling_price' => 'sometimes|required|numeric',
            'pp_qty' => 'sometimes|required|numeric',
            'pp_weight' => 'sometimes|required|numeric',
            'pp_description' => 'sometimes|required',
            'pp_status' => 'sometimes|required',
            'pp_email' => 'sometimes|required|email',
            'pp_phone' => 'sometimes|required|numeric',
        ];
    }
}
