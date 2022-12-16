<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    use HasFactory;

    protected $table = 'app_settings';

    protected $fillable = ['app_name', 'sales_tax', 'logo', 'favicon','company_name','company_phone', 'company_address1', 'company_address2', 'company_city', 'company_state', 'company_zip', 'company_email', 'company_registration_no'];
}
