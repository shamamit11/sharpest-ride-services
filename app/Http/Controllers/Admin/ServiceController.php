<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Services;
use App\Services\Admin\ServicesService;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(ServicesService $ServicesService)
    {
        $this->service = $ServicesService;
    }

    public function index(Request $request)
    {
        $nav = 'services';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Services';
        $result = $this->service->list($per_page, $page, $q);
        return view('admin.services.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->service->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'services';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Service" : "Edit Service";
        $data['action'] = route('admin-services-addaction');
        $data['row'] = Services::where('id', $id)->first();
        return view('admin.services.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(ServiceRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->service->delete($request);
    }
}
