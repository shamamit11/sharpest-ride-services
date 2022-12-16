<?php
namespace App\Services\Admin;
use App\Models\ServiceTypes;

class ServiceTypeService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = ServiceTypes::select('*');
            if ($q) {
                $search_key = $q;
                $query->where(function ($qry) use ($search_key) {
                    $qry->where('name', 'LIKE', '%' . $search_key . '%');
                    $qry->orWhereHas('service', function ($qry1) use ($search_key) {
                        $qry1->where('name', 'LIKE', '%' . $search_key . '%');
                    });
                });
            }
            $data['servicetypes'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['servicetypes']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['servicetypes']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['servicetypes']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['servicetypes']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['servicetypes']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            ServiceTypes::where('id', $request->id)
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
                $servicetype = ServiceTypes::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $servicetype = new ServiceTypes;
                $message = "Data added";
            }
            $servicetype->name = $request['name'];
            $servicetype->price = $request['price'];
            $servicetype->service_id = $request['service_id'];
            $servicetype->save();
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
            $ras = ServiceTypes::findOrFail($id);
            ServiceTypes::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
