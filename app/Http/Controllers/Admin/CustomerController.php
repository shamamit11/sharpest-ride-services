<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Customer;
use App\Models\Staff;
use App\Services\Admin\CustomerService;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(CustomerService $CustomerService)
    {
        $this->customer = $CustomerService;
    }

    public function index(Request $request)
    {
        $nav = 'customers';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Customers';
        $result = $this->customer->list($per_page, $page, $q);
        return view('admin.customers.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->customer->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'customers';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Customer" : "Edit Customer";
        $data['action'] = route('admin-customers-addaction');
        $data['row'] = Customer::where('id', $id)->first();
        $data['orders'] = getMax('customers', 'orders');
        $data['staffs'] = Staff::where('status', 1)->get();
        return view('admin.customers.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(CustomerRequest $request)
    {
        return $this->customer->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->customer->delete($request);
    }
}
