<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\PartTypeRequest;
use App\Models\PartTypes;
use App\Services\Admin\PartTypeService;

class PartTypeController extends Controller
{
    protected $parttype;

    public function __construct(PartTypeService $PartTypeService)
    {
        $this->parttype = $PartTypeService;
    }

    public function index(Request $request)
    {
        $nav = 'parttypes';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Part Types';
        $result = $this->parttype->list($per_page, $page, $q);
        return view('admin.parttypes.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->parttype->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'parttypes';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Part Type" : "Edit Part Type";
        $data['action'] = route('admin-parttypes-addaction');
        $data['row'] = PartTypes::where('id', $id)->first();
        return view('admin.parttypes.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(PartTypeRequest $request)
    {
        return $this->parttype->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->parttype->delete($request);
    }
}
