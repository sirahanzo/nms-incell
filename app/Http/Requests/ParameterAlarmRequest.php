<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParameterAlarmRequest extends FormRequest {


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
            'device_id'       => 'required',
            'name'            => 'required',
            'alias'           => 'required|unique:parameters,alias,' . $this->id,
            //'unit'            => 'required',
            'severity_id'     => 'required',
            'notification_id' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'device_id.required'       => 'DEVICE field is required',
            'name.required'            => 'NAME field is required',
            'alias.required'           => 'ALIAS NAME field is required',
            //'unit.required'            => 'UNIT field is required',
            'severity_id.required'     => 'SEVERITY field is required',
            'notification_id.required' => 'NOTIFICATION TYPE field is required',

            'alias.unique' => 'ALARM NAME has already registered! '


        ];
    }
}
