<?php
namespace App\Services\Admin;
use App\Models\Customer;

class CustomerService
{
    public function list($per_page, $page, $q) {
        try {
            $data['q'] = $q;
            $query = Customer::select('*');
            if ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
                $query->orWhere('code', 'LIKE', '%' . $q . '%');
                $query->orWhere('phone', 'LIKE', '%' . $q . '%');
                $query->orWhere('mobile', 'LIKE', '%' . $q . '%');
                $query->orWhere('email', 'LIKE', '%' . $q . '%');
            }
            $data['customers'] = $query->orderBy('id', 'desc')->paginate($per_page);
            $data['customers']->appends(array('q' => $q));
            if ($page != 1) {
                $data['total_data'] = $data['customers']->total();
                $data['count'] = ($per_page * $page) - $per_page + 1;
                $data['from_data'] = $data['count'];
                $to_data = $page * $data['customers']->count();
                $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['total_data'];
            } else {
                $data['total_data'] = $data['customers']->total();
                $data['count'] = 1;
                $data['from_data'] = 1;
                $data['to_data'] = $data['customers']->count();
            }
            return $data;
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function status($request)
    {
        try {
            Customer::where('id', $request->id)
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
                $customer = Customer::findOrFail($id);
                $message = "Data updated";
            } else {
                $id = 0;
                $customer = new Customer;
                $customer->code = $rand_value = "SR".time();
                $message = "Data added";
            }
            $customer->name = $request['name'];
            $customer->email = $request['email'];
            $customer->phone = $request['phone'];
            $customer->mobile = $request['mobile'];
            $customer->source = $request['source'];
            $customer->staff_id = $request['staff_id'];
            $customer->remarks = $request['remarks'];
            $customer->orders = $request['orders'];
            $customer->status = isset($request['status']) ? 1 : 0;
            $customer->save();
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
            $ras = Customer::findOrFail($id);
            Customer::where('id', $id)->delete();
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
