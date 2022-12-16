<?php
namespace App\Services\Admin;
use App\Models\Services;
use App\Models\ServiceTypes;

class ServicesService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = Services::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            }
            $data['services'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['services']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['services']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['services']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['services']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['services']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            Services::where('id', $request->id)
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
                $service = Services::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $service = new Services;
                $message = "Data added";
            }
            $service->name = $request['name'];
            $service->status = isset($request['status']) ? 1 : 0;
            $service->save();
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
            $ras = Services::findOrFail($id);
            Services::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function getAllServicesWithTypes() {
        $final_services = [];

        $services = Services::where('status', 1)->get();

        foreach($services as $service){
            $serviceTypes = ServiceTypes::where(['service_id' => $service->id])->get();
            $fdata = array("service_name" => $service->name, "service_types" => $serviceTypes);
            array_push($final_services, $fdata);
        }
        //dd($final_services);
        return $final_services;
    }
}
