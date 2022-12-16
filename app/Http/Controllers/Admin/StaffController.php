<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\StaffRequest;
use App\Models\Staff;
use App\Services\Admin\StaffService;

class StaffController extends Controller
{
    protected $staff;

    public function __construct(StaffService $StaffService)
    {
        $this->staff = $StaffService;
    }

    public function index(Request $request)
    {
        $nav = 'staffs';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Staffs';
        $result = $this->staff->list($per_page, $page, $q);
        return view('admin.staffs.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->staff->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'staffs';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Staff" : "Edit Staff";
        $data['action'] = route('admin-staffs-addaction');
        $data['row'] = Staff::where('id', $id)->first();
        $data['orders'] = getMax('staffs', 'orders');
        return view('admin.staffs.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(StaffRequest $request)
    {
        return $this->staff->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->staff->delete($request);
    }
}
