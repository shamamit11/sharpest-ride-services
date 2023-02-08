<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\ServiceTypeRequest;
use App\Models\ServiceTypes;
use App\Models\Services;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Services\Admin\ServiceTypeService;

class ServiceTypeController extends Controller
{
    protected $servicetype;

    public function __construct(ServiceTypeService $ServiceTypeService)
    {
        $this->servicetype = $ServiceTypeService;
    }

    public function index(Request $request)
    {
        $nav = 'servicetypes';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Service Types';
        $result = $this->servicetype->list($per_page, $page, $q);
        return view('admin.servicetypes.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->servicetype->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'servicetypes';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Service Type" : "Edit Service Type";
        $data['action'] = route('admin-servicetypes-addaction');
        $data['row'] = ServiceTypes::where('id', $id)->first();
        $data['services'] = Services::where('status', 1)->get();
        $data['vehicle_makes'] = VehicleMake::where('status', 1)->get();
        $data['vehicle_models'] = VehicleModel::where('status', 1)->get();
        return view('admin.servicetypes.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(ServiceTypeRequest $request)
    {
        return $this->servicetype->store($request->validated());
    }

    public function editView(Request $request)
    {
        $nav = 'servicetypes';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Service Type" : "Edit Service Type";
        $data['action'] = route('admin-servicetypes-editaction');
        $data['row'] = ServiceTypes::where('id', $id)->first();
        $data['services'] = Services::where('status', 1)->get();
        $data['vehicle_makes'] = VehicleMake::where('status', 1)->get();
        $data['vehicle_models'] = VehicleModel::where('status', 1)->get();
        return view('admin.servicetypes.edit', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function editAction(ServiceTypeRequest $request)
    {
        return $this->servicetype->edit($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->servicetype->delete($request);
    }
}
