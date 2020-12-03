<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceNodeRequest extends FormRequest
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
            //
            'name'             => 'required',
            'serial_number'    => 'required',
            //this temporary not use until next information
            //'ipaddress'        => 'required|ip|unique:device_nodes,ipaddress,'.$this->id,
            'site_oid'         => 'required',
            'device_id'        => 'required',
            //'poller_ipaddress' => 'required|ip',
        ];
    }

    public function messages()
    {

        return [
            'name.required'             => 'NODE NAME field is required',
            'serial_number.required'    => 'SERIAL NUMBER field is required',
            'ipaddress.required'        => 'IPAddress field is required',
            'site_oid.required'         => 'SITE NAME field is required',
            'device_id.required'        => 'DEVICE NAME field is required',
            //'poller_ipaddress.required' => 'SERVER POLLER field is required',

            //'ipaddress.ip'        => 'IPADDRESS field is must be a valid ipaddress',
            //'poller_ipaddress.ip' => 'SERVER POLLER field is must be a valid ipaddress',


        ];
    }
}
