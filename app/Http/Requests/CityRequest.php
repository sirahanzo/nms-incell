<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest {


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
            'region_oid' => 'required',
            'name'       => 'required|unique:cities,name,' . $this->id,
            'icon'       => 'required',
        ];
    }


    public function messages()
    {
        return [
            'region_oid.required' => 'Region Name field is required',
            'name.required'       => 'Sub Region/Area Name field is required',
            'icon.required'       => "Select Icon from Icon field",
        ];
    }
}
