<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest {


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
            'owner_id' => 'required',
            'name'     => 'required|unique:regions,name,' . $this->id,
            'icon'     => 'required',
        ];
    }


    public function messages()
    {
        return [
            'owner.required' => 'Owners field is required',
            'name.required'  => 'Region Name field is required',
            'icon.required'  => 'Select Icon from Icon field',
        ];
    }
}
