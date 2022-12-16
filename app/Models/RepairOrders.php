<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RepairOrders extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'repair_orders';

    protected $fillable = ['code', 'customer_id', 'vehicle_make_id', 'vehicle_model_id', 'year', 'engine', 'vehicle_type_id', 'vin_no', 'odometer_reading', 'license_plate', 'remarks', 'staff_id', 'status_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id', 'id');
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
