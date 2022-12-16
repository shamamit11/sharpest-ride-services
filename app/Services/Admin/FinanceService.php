<?php
namespace App\Services\Admin;
use App\Models\Finance;

class FinanceService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = Finance::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
            }
            $data['finances'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['finances']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['finances']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['finances']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['finances']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['finances']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            Finance::where('id', $request->id)
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
                $finance = Finance::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $finance = new Finance;
                $message = "Data added";
            }
            $finance->name = $request['name'];
            $finance->orders = $request['orders'];
            $finance->status = isset($request['status']) ? 1 : 0;
            $finance->save();
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
            $ras = Finance::findOrFail($id);
            Finance::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
