<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['vehicle_make_id', 'name', 'status'];

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id', 'id');
    }
}
