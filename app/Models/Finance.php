<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'finances';

    protected $fillable = ['name', 'order', 'status'];
}
