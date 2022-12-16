<?php
namespace App\Services\Admin;
use App\Models\Staff;

class StaffService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = Staff::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            }
            $data['staffs'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['staffs']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['staffs']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['staffs']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['staffs']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['staffs']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            Staff::where('id', $request->id)
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
                $staff = Staff::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $staff = new Staff;
                $message = "Data added";
            }

            $staff->name = $request['name'];
            $staff->orders = $request['orders'];
            $staff->status = isset($request['status']) ? 1 : 0;
            $staff->save();
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
            $ras = Staff::findOrFail($id);
            Staff::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
