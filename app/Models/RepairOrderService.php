<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairOrderService extends Model
{
    use HasFactory;

    protected $table = 'repair_order_services';

    protected $fillable = ['repair_order_id', 'service_id', 'service_type_id', 'part_type_id', 'qty', 'price'];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceTypes::class, 'service_type_id', 'id');
    }

    public function parts()
    {
        return $this->belongsTo(PartTypes::class, 'part_type_id', 'id');
    }

}
