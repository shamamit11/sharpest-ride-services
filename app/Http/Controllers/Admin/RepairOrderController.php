<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\RepairOrderRequest;
use App\Models\RepairOrders;
use App\Models\RepairOrderService;
use App\Models\Customer;
use App\Models\PartTypes;
use App\Models\Services;
use App\Models\ServiceTypes;
use App\Models\VehicleEngine;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Models\VehicleYear;
use App\Models\Staff;
use App\Models\Status;
use App\Models\AppSettings;
use App\Services\Admin\RepairOrderService as ROService;
use App\Services\Admin\ServicesService;

class RepairOrderController extends Controller
{
    protected $repairorder;

    public function __construct(ROService $RepairOrderService)
    {
        $this->repairorder = $RepairOrderService;
    }

    public function index(Request $request)
    {
        $nav = 'repairorders';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Repair Orders';
        $result = $this->repairorder->list($per_page, $page, $q);
        return view('admin.repairorders.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function addEdit(Request $request)
    {
        $services = new ServicesService;

        $nav = 'repairorders';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Repair Order" : "Edit Repair Order";
        $data['action'] = route('admin-repairorders-addaction');
        $data['row'] = RepairOrders::where('id', $id)->first();
        $data['repair_services'] = RepairOrderService::where('repair_order_id', $id)->get();
        $data['customers'] = Customer::where('status', 1)->get();
        $data['part_types'] = PartTypes::where('status', 1)->get();
        $data['service_types'] = ServiceTypes::orderBy('service_id', 'ASC')->get();
        $data['vehicle_makes'] = VehicleMake::where('status', 1)->get();
        $data['vehicle_models'] = VehicleModel::where('status', 1)->get();
        $data['vehicle_types'] = VehicleType::where('status', 1)->get();
        $data['staffs'] = Staff::where('status', 1)->get();
        $data['statuses'] = Status::where('status', 1)->get();

        if($id == 0) {
            return view('admin.repairorders.add', compact('nav', 'sub_nav', 'page_title'), $data);
        } else {
            return view('admin.repairorders.edit', compact('nav', 'sub_nav', 'page_title'), $data);
        }

    }

    public function view(Request $request)
    {
        $services = new ServicesService;

        $nav = 'repairorders';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = "Invoice";
        $data['row'] = $repair_order = RepairOrders::where('id', $id)->first();
        $data['customer'] = Customer::where('id', $repair_order->customer_id)->first();

        $data['repair_services'] = RepairOrderService::where('repair_order_id', $id)->get();

        $data['app_settings'] = AppSettings::first();

        $data['part_types'] = PartTypes::where('status', 1)->get();
        $data['service_types'] = ServiceTypes::orderBy('service_id', 'ASC')->get();
        $data['vehicle_makes'] = VehicleMake::where('status', 1)->get();
        $data['vehicle_models'] = VehicleModel::where('status', 1)->get();
        $data['vehicle_types'] = VehicleType::where('status', 1)->get();
        $data['staffs'] = Staff::where('status', 1)->get();
        $data['statuses'] = Status::where('status', 1)->get();

        return view('admin.repairorders.view', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(RepairOrderRequest $request)
    {
        return $this->repairorder->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->repairorder->delete($request);
    }
}
