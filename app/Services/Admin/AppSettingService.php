<?php
namespace App\Services\Admin;
use App\Models\AppSettings;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;

class AppSettingService
{
    use StoreImageTrait;

    public function store($request)
    {
        try {
            AppSettings::truncate();
            $setting = new AppSettings;
            $setting->app_name = $request['app_name'];
            $setting->sales_tax = $request['sales_tax'];
            $setting->company_name = $request['company_name'];
            $setting->company_phone = $request['company_phone'];
            $setting->company_address1 = $request['company_address1'];
            $setting->company_address2 = $request['company_address2'];
            $setting->company_city = $request['company_city'];
            $setting->company_state = $request['company_state'];
            $setting->company_zip = $request['company_zip'];
            $setting->company_email = $request['company_email'];
            $setting->company_registration_no = $request['company_registration_no'];

            if (preg_match('#^data:image.*?base64,#', $request['logo'])) {
                $logoimage = $this->StoreBase64Image($request['logo'], '/settings/');
            } else {
                $logoimage = ($setting) ? $setting->logo : '';
            }

            if (preg_match('#^data:image.*?base64,#', $request['favicon'])) {
                $favimage = $this->StoreBase64Image($request['favicon'], '/settings/');
            } else {
                $favimage = ($setting) ? $setting->favicon : '';
            }

            $setting->logo = $logoimage;
            $setting->favicon = $favimage;
            $setting->save();

            $message = "Data updated";
            
            $response['message'] = $message;
            $response['errors'] = false;
            $response['status_code'] = 201;

            return response()->json($response, 201);
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }

    public function imageDelete($request)
    {
        try {
            $id = $request->id;
            $field_name = $request->field_name;
            $ras = AppSettings::where('id', $id)->first();
            if ($ras) {
                Storage::disk('public')->delete('/settings/' . $ras->$field_name);
                $ras->$field_name = '';
                $ras->save();
            }
            return "success";
        } catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
