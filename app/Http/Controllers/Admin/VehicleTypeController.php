<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\VehicleTypeRequest;
use App\Models\VehicleType;
use App\Services\Admin\VehicleTypeService;

class VehicleTypeController extends Controller
{
    protected $vehicletype;

    public function __construct(VehicleTypeService $VehicleTypeService)
    {
        $this->vehicletype = $VehicleTypeService;
    }

    public function index(Request $request)
    {
        $nav = 'vehicletypes';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Vehicle Types';
        $result = $this->vehicletype->list($per_page, $page, $q);
        return view('admin.vehicletypes.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->vehicletype->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'vehicletypes';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Vehicle Type" : "Edit Vehicle Type";
        $data['action'] = route('admin-vehicletypes-addaction');
        $data['row'] = VehicleType::where('id', $id)->first();
        $data['orders'] = getMax('vehicle_types', 'orders');
        return view('admin.vehicletypes.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(VehicleTypeRequest $request)
    {
        return $this->vehicletype->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->vehicletype->delete($request);
    }
}
