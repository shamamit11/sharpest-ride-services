<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PartTypes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'part_types';

    protected $fillable = ['name', 'status'];

}
