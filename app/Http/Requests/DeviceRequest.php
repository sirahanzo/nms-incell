<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest {


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
            'name'            => 'required',
            'manufacturer_id' => 'required',
            'device_type_id'  => 'required',
            'api_key'         => 'required',
            'api_label'       => 'required',
            //'snmp_version'    => 'required',
            //'snmp_timeout'    => 'required',
            //'snmp_retries'    => 'required',
            //'snmp_read'       => 'required',
            //'snmp_write'      => 'required',
            //'snmp_port'       => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required'            => 'DEVICE NAME field is required',
            'manufacturer_id.required' => 'MANUFACTURE field is required',
            'device_type_id.required'  => 'DEVICE TYPE field is required',
            'api_key.required'         => 'A.P.I KEY field is required',
            'api_label.required'       => 'A.P.I LABEL field is required',
            //'snmp_version.required'    => 'SNMP VERSION field is required',
            //'snmp_timeout.required'    => 'SNMP Timeout field is required',
            //'snmp_retries.required'    => 'SNMP Retries field is required',
            //'snmp_read.required'       => 'SNMP Read field is required',
            //'snmp_write.required'      => 'SNMP Write field is required',
            //'snmp_port.required'       => 'SNMP Port field is required',

        ];
    }
}
