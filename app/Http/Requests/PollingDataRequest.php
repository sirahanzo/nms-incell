<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollingDataRequest extends FormRequest {


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
            'device_id' => 'required',
            'name'      => 'required',
            'unit'      => 'required',
        ];
    }


    public function messages()
    {
        return [
            'device_id.required' => 'DEVICE field is required',
            'name.required'      => 'NAME field is required',
            'unit.required'      => 'UNIT field is required',

        ];
    }
}
