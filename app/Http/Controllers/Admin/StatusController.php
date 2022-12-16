<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\StatusRequest;
use App\Models\Status;
use App\Services\Admin\StatusService;

class StatusController extends Controller
{
    protected $status;

    public function __construct(StatusService $StatusService)
    {
        $this->status = $StatusService;
    }

    public function index(Request $request)
    {
        $nav = 'status';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Statuses';
        $result = $this->status->list($per_page, $page, $q);
        return view('admin.status.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->status->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'status';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Status" : "Edit Status";
        $data['action'] = route('admin-status-addaction');
        $data['row'] = Status::where('id', $id)->first();
        $data['orders'] = getMax('statuses', 'orders');
        return view('admin.status.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(StatusRequest $request)
    {
        return $this->status->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->status->delete($request);
    }
}
