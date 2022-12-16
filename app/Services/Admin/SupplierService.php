<?php
namespace App\Services\Admin;
use App\Models\Supplier;

class SupplierService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = Supplier::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            }
            $data['suppliers'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['suppliers']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['suppliers']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['suppliers']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['suppliers']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['suppliers']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            Supplier::where('id', $request->id)
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
                $supplier = Supplier::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $supplier = new Supplier;
                $message = "Data added";
            }
            $supplier->name = $request['name'];
            $supplier->orders = $request['orders'];
            $supplier->status = isset($request['status']) ? 1 : 0;
            $supplier->save();
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
            $ras = Supplier::findOrFail($id);
            Supplier::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
