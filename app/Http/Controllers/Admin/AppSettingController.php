<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\AppSettingRequest;
use App\Models\AppSettings;
use App\Services\Admin\AppSettingService;

class AppSettingController extends Controller
{
    protected $settings;

    public function __construct(AppSettingService $AppSettingService)
    {
        $this->settings = $AppSettingService;
    }

    public function index(Request $request)
    {
        $nav = 'appsettings';
        $sub_nav = '';
        $page_title = 'App Settings';
        $data['row'] = AppSettings::first();
        $data['action'] = route('admin-appsettings-store');
        return view('admin.appsettings.index', compact('nav', 'sub_nav', 'page_title'), $data);
    }

    public function store(AppSettingRequest $request)
    {
        return $this->settings->store($request->validated());
    }

    public function imageDelete(Request $request)
    {
        echo $this->settings->imageDelete($request);
    }
}
