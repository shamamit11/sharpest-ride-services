<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\ApiRequest;

class CustomerRequest extends ApiRequest
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
            'code' => '',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'phone' => '',
            'orders' => '',
            'status' => 'nullable',
            'source' => 'nullable',
            'remarks' => 'nullable',
            'staff_id' => 'required',
        ];
    }
}
