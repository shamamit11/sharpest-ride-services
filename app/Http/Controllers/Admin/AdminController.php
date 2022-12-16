<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Services\Admin\AdminService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PasswordRequest;

class AdminController extends Controller
{
    protected $settings;

    public function __construct(AdminService $AdminService)
    {
        $this->settings = $AdminService;
    }

    public function index(Request $request)
    {
        $nav = 'adminsettings';
        $sub_nav = '';
        $page_title = 'Account Settings';
        $admin_id = Auth::guard('admin')->id();
		$data['row'] = Admin::where('id', $admin_id)->first();
        $data['action'] = route('admin-adminsettings-store');
        $data['password_action'] = route('admin-adminsettings-password');
        return view('admin.settings.index', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function store(AdminRequest $request)
    {
        return $this->settings->store($request->validated());
    }

    public function imageDelete(Request $request)
    {
        echo $this->settings->imageDelete($request);
    }

    public function password(PasswordRequest $request)
    {
        $res =  $this->settings->password($request->validated());

        if($res == 'success') {
            Auth::guard('admin')->logout();
            return redirect(route('admin-login'));
        }
        else {
            return $res;
        }
    }

}
