<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ServiceTypes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_types';

    protected $fillable = ['service_id', 'name', 'price'];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id', 'id');
    }
}
