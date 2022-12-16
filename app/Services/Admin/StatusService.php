<?php
namespace App\Services\Admin;
use App\Models\Status;

class StatusService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = Status::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            }
            $data['statuses'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['statuses']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['statuses']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['statuses']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['statuses']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['statuses']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            Status::where('id', $request->id)
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
                $status = Status::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $status = new Status;
                $message = "Data added";
            }

            $status->name = $request['name'];
            $status->color = $request['color'];
            $status->orders = $request['orders'];
            $status->status = isset($request['status']) ? 1 : 0;
            $status->save();
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
            $ras = Status::findOrFail($id);
            Status::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
