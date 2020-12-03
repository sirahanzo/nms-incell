<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {


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
            'name'            => 'required|max:255',
            'username'        => 'required|max:255|unique:users,username,' . $this->id,
            'email'           => 'required|unique:users,email,' . $this->id,
            'phone'           => 'required|unique:users,phone,' . $this->id,
            'password'        => 'required|min:6|confirmed',
            'role_id'         => 'required',
            'owner_id'        => 'required',
            'region_oid'      => 'required',
            'notification_id' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required'            => 'The Full Name field is required',
            'username.required'        => 'The User Name field is required',
            'email.required'           => 'The Email field is required',
            'phone.required'           => 'The Phone field is required',
            'password.required'        => 'The Password field is required',
            'role_id.required'         => 'The Level field is required',
            'owner_id.required'        => 'The Owners field is required',
            'region_oid.required'      => 'The Region field is required',
            'notification_id.required' => 'The Notifcation field is required',
            //'email.required'    => 'The Email Address field is required',

        ];
    }

}
