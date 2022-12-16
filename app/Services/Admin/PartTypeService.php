<?php
namespace App\Services\Admin;
use App\Models\PartTypes;

class PartTypeService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = PartTypes::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            }
            $data['parttypes'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['parttypes']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['parttypes']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['parttypes']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['parttypes']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['parttypes']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            PartTypes::where('id', $request->id)
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
                $parttype = PartTypes::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $parttype = new PartTypes;
                $message = "Data added";
            }
            $parttype->name = $request['name'];
            $parttype->status = isset($request['status']) ? 1 : 0;
            $parttype->save();
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
            $ras = PartTypes::findOrFail($id);
            PartTypes::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
