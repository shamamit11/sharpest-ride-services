<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'services';

    protected $fillable = ['name', 'status'];
}
