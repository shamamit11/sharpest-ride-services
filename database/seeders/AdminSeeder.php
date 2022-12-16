<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Admin::where('email', 'info@mysharpestrides.com')->doesntExist()) {
            $admin = new Admin;
            $admin->name = 'Sharpest Rides';
            $admin->email = 'info@mysharpestrides.com';
            $admin->username = 'admin';
            $admin->password = Hash::make('admin@12345');
            $admin->user_type = 'S';
            $admin->save();
        }
    }
}