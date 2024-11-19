<?php

namespace App\Modules\Organization\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Device extends FormRequest
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
            'name'     => 'required',
            'canteen_id'       => 'required',
            'status'       => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Device name is required.',
            'address.required' => __('Organization::FormValidation.addressrequired'),
            'mobile.required' => __('Organization::FormValidation.mobilerequired'),
            'email.required' => __('Organization::FormValidation.emailrequired'),
            'email.email' => __('Organization::FormValidation.emailEmail'),
            'status.required' => __('Organization::FormValidation.statusrequired'),
        ];
    }
}
