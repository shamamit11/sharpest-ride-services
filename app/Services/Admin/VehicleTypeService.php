<?php
namespace App\Services\Admin;
use App\Models\VehicleType;

class VehicleTypeService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = VehicleType::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            }
            $data['vehicletypes'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['vehicletypes']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['vehicletypes']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['vehicletypes']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['vehicletypes']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['vehicletypes']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            VehicleType::where('id', $request->id)
                ->update([
                    $request->field_name => $request->val,
                ]);
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function store($request)
    {
        try {
            if ($request['id']) {
                $id = $request['id'];
                $vehicletype = VehicleType::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $vehicletype = new VehicleType;
                $message = "Data added";
            }
            $vehicletype->name = $request['name'];
            $vehicletype->orders = $request['orders'];
            $vehicletype->status = isset($request['status']) ? 1 : 0;
            $vehicletype->save();
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
            $ras = VehicleType::findOrFail($id);
            VehicleType::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
