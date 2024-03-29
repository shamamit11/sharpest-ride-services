<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\ApiRequest;

class ServiceTypeRequest extends ApiRequest
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
            'service_id' => 'required',
            'vehicle_make_id' => '',
            'vehicle_model_id' => '',
            'name' => 'required',
            'price' => ''
        ];
    }
}
