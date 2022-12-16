<?php
namespace App\Services\Admin;
use App\Models\RepairOrders;
use App\Models\RepairOrderService as ROService;

class RepairOrderService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = RepairOrders::select('*');
            if ($q) {
                $search_key = $q;
                $query->where(function ($qry) use ($search_key) {
                    $qry->where('code', 'LIKE', '%' . $search_key . '%');
                    $qry->orWhere('created_at', 'LIKE', '%' . $search_key . '%');
                    $qry->orWhereHas('customer', function ($qry1) use ($search_key) {
                        $qry1->where('name', 'LIKE', '%' . $search_key . '%');
                    });
                    $qry->orWhereHas('status', function ($qry2) use ($search_key) {
                        $qry2->where('name', 'LIKE', '%' . $search_key . '%');
                    });
                    $qry->orWhereHas('staff', function ($qry3) use ($search_key) {
                        $qry3->where('name', 'LIKE', '%' . $search_key . '%');
                    });
                });
            }
            $data['repairorders'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['repairorders']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['repairorders']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['repairorders']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['repairorders']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['repairorders']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function store($request)
    {
        try {
            if ($request['id']) {
                $id = $request['id'];
                $rorder = RepairOrders::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $rorder = new RepairOrders;
                $rorder->code = $rand_value = "RO".time();
                $rorder->customer_id = $request['customer_id'];
                $rorder->vehicle_make_id = $request['vehicle_make_id'];
                $rorder->vehicle_model_id = $request['vehicle_model_id'];
                $rorder->year = $request['year'];
                $rorder->engine = $request['engine'];
                $rorder->vehicle_type_id = $request['vehicle_type_id'];
                $rorder->vin_no = $request['vin_no'];
                $rorder->odometer_reading = $request['odometer_reading'];
                $rorder->license_plate = $request['license_plate'];
                $message = "Data added";
            }
            $rorder->remarks = $request['remarks'];
            $rorder->staff_id = $request['staff_id'];
            $rorder->status_id = $request['status_id'];
            $rorder->save();

            $repairId = $rorder->id;
            ROService::where('repair_order_id', $repairId)->delete();

            if (count($request['qty']) > 0) {
                foreach ($request['qty'] as $key => $qty) {
                    if ($qty && $qty > 0) {
                        $ro_service = new ROService;
                        $ro_service->repair_order_id = $repairId;
                        $ro_service->service_id = $request['service_id'][$key];
                        $ro_service->service_type_id = $request['service_type_id'][$key];
                        $ro_service->price = $request['price'][$key] * $qty;
                        $ro_service->qty = $qty;
                        $ro_service->part_type_id = $request['part_type_id'][$key];
                        $ro_service->save();
                    }
                }
            }

            $response['message'] = $message;
            $response['errors'] = false;
            $response['status_code'] = 201;
            return response()->json($response, 201);
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function delete($request)
    {
        try {
            $id = $request->id;
            $ras = RepairOrders::findOrFail($id);
            RepairOrders::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public static function getQtyByRepairIdAndServiceTypeId($service_type_id, $repair_order_id) {
        $data = ROService::where(['service_type_id' => $service_type_id, 'repair_order_id' => $repair_order_id])->first();
        $qty = 0;
        if($data) {
            $qty = $data->qty;
        }
        return $qty;
    }

    public static function getPartTypeByRepairIdAndServiceTypeId($service_type_id, $repair_order_id) {
        $data = ROService::where(['service_type_id' => $service_type_id, 'repair_order_id' => $repair_order_id])->first();
        $part_type = '';
        if($data) {
            $part_type = $data->part_type_id;
        }
        return $part_type;
    }
}
