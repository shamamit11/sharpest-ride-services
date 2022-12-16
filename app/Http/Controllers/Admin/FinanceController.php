<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\FinanceRequest;
use App\Models\Finance;
use App\Services\Admin\FinanceService;

class FinanceController extends Controller
{
    protected $finance;

    public function __construct(FinanceService $FinanceService)
    {
        $this->finance = $FinanceService;
    }

    public function index(Request $request)
    {
        $nav = 'finances';
        $sub_nav = '';
        $per_page = 50;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $page_title = 'Finances';
        $result = $this->finance->list($per_page, $page, $q);
        return view('admin.finances.index', compact('nav', 'sub_nav', 'page_title'), $result);
    }

    public function status(Request $request)
    {
        $this->finance->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'finances';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = $page_title = ($id == 0) ? "Add Finance" : "Edit Finance";
        $data['action'] = route('admin-finances-addaction');
        $data['row'] = Finance::where('id', $id)->first();
        $data['orders'] = getMax('finances', 'orders');
        return view('admin.finances.add', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function addAction(FinanceRequest $request)
    {
        return $this->finance->store($request->validated());
    }

    public function delete(Request $request)
    {
        echo $this->finance->delete($request);
    }
}
