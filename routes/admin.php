<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('login', 'AuthController@login')->name('admin-login');
Route::post('check/login', 'AuthController@checkLogin')->name('admin-checkLogin');
Route::get('forgot-password', 'AuthController@forgotPassword')->name('admin-forgot-password');

Route::group(['middleware' => 'adminauth'], function () {
    // Route::get('/', 'DashboardController@index')->name('admin-dashboard');
    Route::get('/', 'RepairOrderController@index')->name('admin-dashboard');
    Route::get('logout', 'AuthController@logout')->name('admin-logout');

    Route::controller('MakeController')->group(function () {
        Route::get('/make', 'index')->name('admin-make');
        Route::post('/make/status', 'status')->name('admin-make-status');
        Route::get('/make/add', 'addEdit')->name('admin-make-add');
        Route::post('/make/addaction', 'addAction')->name('admin-make-addaction');
        Route::post('/make/imagedelete', 'imageDelete')->name('admin-make-imagedelete');
        Route::post('/make/delete', 'delete')->name('admin-make-delete');
    });

    Route::controller('ModelController')->group(function () {
        Route::get('/model', 'index')->name('admin-model');
        Route::post('/model/status', 'status')->name('admin-model-status');
        Route::get('/model/add', 'addEdit')->name('admin-model-add');
        Route::post('/model/addaction', 'addAction')->name('admin-model-addaction');
        Route::post('/model/delete', 'delete')->name('admin-model-delete');
    });

    Route::controller('VehicleTypeController')->group(function () {
        Route::get('/vehicletypes', 'index')->name('admin-vehicletypes');
        Route::post('/vehicletypes/status', 'status')->name('admin-vehicletypes-status');
        Route::get('/vehicletypes/add', 'addEdit')->name('admin-vehicletypes-add');
        Route::post('/vehicletypes/addaction', 'addAction')->name('admin-vehicletypes-addaction');
        Route::post('/vehicletypes/delete', 'delete')->name('admin-vehicletypes-delete');
    });

    Route::controller('StaffController')->group(function () {
        Route::get('/staffs', 'index')->name('admin-staffs');
        Route::post('/staffs/status', 'status')->name('admin-staffs-status');
        Route::get('/staffs/add', 'addEdit')->name('admin-staffs-add');
        Route::post('/staffs/addaction', 'addAction')->name('admin-staffs-addaction');
        Route::post('/staffs/delete', 'delete')->name('admin-staffs-delete');
    });

    Route::controller('CustomerController')->group(function () {
        Route::get('/customers', 'index')->name('admin-customers');
        Route::post('/customers/status', 'status')->name('admin-customers-status');
        Route::get('/customers/add', 'addEdit')->name('admin-customers-add');
        Route::post('/customers/addaction', 'addAction')->name('admin-customers-addaction');
        Route::post('/customers/delete', 'delete')->name('admin-customers-delete');
    });

    Route::controller('PartTypeController')->group(function () {
        Route::get('/parttypes', 'index')->name('admin-parttypes');
        Route::post('/parttypes/status', 'status')->name('admin-parttypes-status');
        Route::get('/parttypes/add', 'addEdit')->name('admin-parttypes-add');
        Route::post('/parttypes/addaction', 'addAction')->name('admin-parttypes-addaction');
        Route::post('/parttypes/delete', 'delete')->name('admin-parttypes-delete');
    });

    Route::controller('ServiceController')->group(function () {
        Route::get('/services', 'index')->name('admin-services');
        Route::post('/services/status', 'status')->name('admin-services-status');
        Route::get('/services/add', 'addEdit')->name('admin-services-add');
        Route::post('/services/addaction', 'addAction')->name('admin-services-addaction');
        Route::post('/services/delete', 'delete')->name('admin-services-delete');
    });

    Route::controller('ServiceTypeController')->group(function () {
        Route::get('/servicetypes', 'index')->name('admin-servicetypes');
        Route::post('/servicetypes/status', 'status')->name('admin-servicetypes-status');
        Route::get('/servicetypes/add', 'addEdit')->name('admin-servicetypes-add');
        Route::post('/servicetypes/addaction', 'addAction')->name('admin-servicetypes-addaction');
        Route::post('/servicetypes/delete', 'delete')->name('admin-servicetypes-delete');
    });

    Route::controller('StatusController')->group(function () {
        Route::get('/status', 'index')->name('admin-status');
        Route::get('/status/add', 'addEdit')->name('admin-status-add');
        Route::post('/status/status', 'status')->name('admin-status-status');
        Route::post('/status/addaction', 'addAction')->name('admin-status-addaction');
        Route::post('/status/delete', 'delete')->name('admin-status-delete');
    });

    Route::controller('RepairOrderController')->group(function () {
        Route::get('/repairorders', 'index')->name('admin-repairorders');
        Route::get('/repairorders/add', 'addEdit')->name('admin-repairorders-add');
        Route::post('/repairorders/addaction', 'addAction')->name('admin-repairorders-addaction');
        Route::post('/repairorders/delete', 'delete')->name('admin-repairorders-delete');
        Route::get('/repairorders/view', 'view')->name('admin-repairorders-view');
    });

    Route::controller('AppSettingController')->group(function () {
        Route::get('/appsettings', 'index')->name('admin-appsettings');
        Route::post('/appsettings/store', 'store')->name('admin-appsettings-store');
        Route::post('/appsettings/imagedelete', 'imageDelete')->name('admin-appsettings-imagedelete');
    });

    Route::controller('AdminController')->group(function () {
        Route::get('/adminsettings', 'index')->name('admin-adminsettings');
        Route::post('/adminsettings/store', 'store')->name('admin-adminsettings-store');
        Route::post('/adminsettings/imagedelete', 'imageDelete')->name('admin-adminsettings-imagedelete');
        Route::post('/adminsettings/password', 'password')->name('admin-adminsettings-password');
    });

});
