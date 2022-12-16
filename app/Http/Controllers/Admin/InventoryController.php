<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\InventoryRequest;
use App\Models\Inventory;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Models\Supplier;
use App\Models\Staff;
use App\Models\Customer;
use App\Models\Finance;
use App\Models\Status;
use App\Services\Admin\InventoryService;

//use DataTables;

class InventoryController extends Controller
{
    protected $inventory;

    public function __construct(InventoryService $InventoryService)
    {
        $this->inventory = $InventoryService;
    }

    public function index(Request $request)
    {
        $nav = 'inventories';
        $sub_nav = '';
        $page_title = 'Inventories';
        $data = $this->inventory->list($request);
        return view('admin.inventories.index', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addEdit(Request $request)
    {
        $nav = 'inventories';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Inventory" : "Edit Inventory";
        $data['action'] = route('admin-inventories-addaction');
        $data['row'] = Inventory::where('id', $id)->first();
        $data['makes'] = VehicleMake::where('status', '1')->get();
        $data['models'] = VehicleModel::where('status', '1')->get();
        $data['vehicletypes'] = VehicleType::where('status', '1')->orderBy('orders', 'asc')->get();
        $data['suppliers'] = Supplier::where('status', '1')->orderBy('orders', 'asc')->get();
        $data['staffs'] = Staff::where('status', '1')->orderBy('orders', 'asc')->get();
        $data['customers'] = Customer::where('status', '1')->orderBy('orders', 'asc')->get();
        $data['finances'] = Finance::where('status', '1')->orderBy('orders', 'asc')->get();
        $data['statuses'] = Status::where('status', '1')->orderBy('orders', 'asc')->get();
        return view('admin.inventories.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(InventoryRequest $request)
    {
        return $this->inventory->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->inventory->delete($request);
    }
}
