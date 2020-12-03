<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest {


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
            'name'          => 'required',
            'site_id_label' => 'required|unique:sites,site_id_label,' . $this->id, //as site_type
            'city_oid'      => 'required',
            'address'       => 'required',
            'latitude'      => 'required',
            'longitude'     => 'required',
            'total_pack'    => 'required',
            'icon'          => 'required',
        ];
    }


    public function messages()
    {

        return [
            'name.required'          => 'SITE NAME field is required',
            'site_id_label.required' => 'SITE ID field is required',
            'city_oid.required'      => 'SUB REGION/AREA NAME field is required',
            'address.required'       => 'Address field is required',
            'latitude.required'      => 'Latitude GPS Location field is required',
            'longitude.required'     => 'Longitude GPS Location field is required',
            'total_pack.required'    => "Select Number Pack from Battery Pack Use field",
            'icon.required'          => "Select Icon from Icon field",


        ];
    }
}
