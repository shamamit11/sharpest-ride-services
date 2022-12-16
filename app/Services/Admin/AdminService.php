<?php
namespace App\Services\Admin;
use App\Models\Admin;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminService
{
    use StoreImageTrait;

    public function store($request)
    {
        try {
            $id = $request['id'];
            $setting = Admin::findOrFail($id);
            $setting->name = $request['name'];

            if (preg_match('#^data:image.*?base64,#', $request['image'])) {
                $image = $this->StoreBase64Image($request['image'], '/settings/');
            } else {
                $image = ($setting) ? $setting->image : '';
            }

            $setting->image = $image;
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
            $ras = Admin::where('id', $id)->first();
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

    public function password($request)
    {
        try {
            if ((Hash::check( $request['old_password'], Auth::guard('admin')->user()->password)) == false) {
                $message = 'Incorrect email or password provided.';
                return $message;
            } else {
                Admin::where('id', Auth::guard('admin')->id())->update(['password' => Hash::make($request['new_password'])]);
                return "success";
            } 
        }
        catch (\Exception$e) {
            return response()->json(['errors' => $e->getMessage()], 401);
        }
    }
}
