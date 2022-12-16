<?php
namespace App\Services\Admin;

use App\Models\Inventory;

class InventoryService
{
    public function list($request) {
        $data['count'] = 1;
        $data['data'] = Inventory::select('*')->orderBy('added_date', 'asc')->get();
        return $data;
    }

    public function store($request)
    {
        try {
            if ($request['id']) {
                $id = $request['id'];
                $inventory = Inventory::find($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $inventory = new Inventory;
                $message = "Data added";
            }
            $inventory->added_date = $request['added_date'];
            $inventory->vehicle_make_id = $request['vehicle_make_id'];
            $inventory->vehicle_model_id = $request['vehicle_model_id'];
            $inventory->vehicle_type_id = $request['vehicle_type_id'];
            $inventory->year = $request['year'];
            $inventory->vin_no = $request['vin_no'];
            $inventory->stock_no = $request['stock_no'];
            $inventory->supplier_id = $request['supplier_id'];
            $inventory->staff_id = $request['staff_id'];
            $inventory->pack_no = $request['pack_no'];
            $inventory->purchase_amount = $request['purchase_amount'];
            $inventory->purchase_date = $request['purchase_date'];
            $inventory->sell_date = $request['sell_date'];
            $inventory->customer_id = $request['customer_id'];
            $inventory->sell_amount = $request['sell_amount'];
            $inventory->title_status = $request['title_status'];
            $inventory->finance_id = $request['finance_id'];
            $inventory->description = $request['description'];
            $inventory->status_id = $request['status_id'];
            $inventory->save();
            $response['message'] = $message;
            $response['errors'] = false;
            $response['status_code'] = 201;
            return response()->json($response, 201);
        }
        catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
    
    public function delete($request)
    {
        try {
            $id = $request->id;
            $ras = Inventory::findOrFail($id);
            Inventory::where('id', $id)->delete();
            return "success";
        } catch (Exception $e) {
            return "error";
        }

    }
}
