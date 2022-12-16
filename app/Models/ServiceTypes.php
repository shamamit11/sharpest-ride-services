<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ServiceTypes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_types';

    protected $fillable = ['service_id', 'vehicle_make_id', 'vehicle_model_id', 'name', 'price'];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id', 'id');
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id', 'id');
    }
}
