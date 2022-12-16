<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\ApiRequest;

class InventoryRequest extends ApiRequest
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
            'added_date' => 'required',
            'vehicle_make_id' => 'required',
            'vehicle_model_id' => 'required',
            'vehicle_type_id' => 'required',
            'year' => 'required',
            'vin_no' => 'required',
            'stock_no' => 'required',
            'supplier_id' => 'required',
            'staff_id' => 'required',
            'pack_no' => 'required',
            'purchase_amount' => 'required',
            'purchase_date' => 'nullable',
            'sell_date' => 'nullable',
            'customer_id' => 'nullable',
            'sell_amount' => 'nullable',
            'title_status' => 'nullable',
            'finance_id' => 'nullable',
            'description' => 'nullable',
            'status_id' => 'nullable',
        ];
    }
}
