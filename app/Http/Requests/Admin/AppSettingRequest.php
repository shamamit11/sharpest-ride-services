<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\ApiRequest;

class AppSettingRequest extends ApiRequest
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
            'id' => 'integer|nullable',
            'app_name' => 'required',
            'sales_tax' => 'required',
            'logo' => '',
            'favicon' => '',
            'company_name' => 'required',
            'company_phone' => 'required',
            'company_address1' => 'required',
            'company_address2' => '',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_zip' => 'required',
            'company_email' => 'required',
            'company_registration_no' => ''
        ];
    }
}