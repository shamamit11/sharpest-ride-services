<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\ApiRequest;

class RepairOrderRequest extends ApiRequest
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
            'customer_id' => 'required',
            'vehicle_make_id' => 'required',
            'vehicle_model_id' => 'required',
            'year' => 'required',
            'engine' => 'required',
            'vehicle_type_id' => 'required',
            'vin_no' => 'required',
            'odometer_reading' => 'required',
            'license_plate' => 'required',
            'remarks' => '',
            'staff_id' => 'required',
            'status_id' => 'required',
            'qty' => '',
            'service_id' => '',
            'service_type_id' => '',
            'price' => '',
            'part_type_id' => ''
        ];
    }
}
