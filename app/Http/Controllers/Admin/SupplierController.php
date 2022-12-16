<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\SupplierRequest;
use App\Models\Supplier;
use App\Services\Admin\SupplierService;

class SupplierController extends Controller
{
    protected $supplier;

    public function __construct(SupplierService $SupplierService)
    {
        $this->supplier = $SupplierService;
    }

    public function index(Request $request)
    {
        $nav = 'suppliers';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Suppliers';
        $result = $this->supplier->list($per_page, $page, $q);
        return view('admin.suppliers.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->supplier->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'suppliers';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Supplier" : "Edit Supplier";
        $data['action'] = route('admin-suppliers-addaction');
        $data['row'] = Supplier::where('id', $id)->first();
        $data['orders'] = getMax('suppliers', 'orders');
        return view('admin.suppliers.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(SupplierRequest $request)
    {
        return $this->supplier->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->supplier->delete($request);
    }
}
