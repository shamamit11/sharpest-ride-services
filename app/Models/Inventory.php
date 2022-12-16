<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventories';

    protected $fillable = ['added_date','vehicle_make_id', 'vehicle_model_id', 'vehicle_type_id','year','vin_no','stock_no','supplier_id','staff_id','pack_no','purchase_amount','purchase_date','sell_date','customer_id','sell_amount','title_status','finance_id','description','status_id'];

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id', 'id');
    }

    public function vehicletype()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function finance()
    {
        return $this->belongsTo(Finance::class, 'finance_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
