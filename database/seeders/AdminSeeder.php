<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin;
        $admin->name = "Admin";
        $admin->password = "1324";
        $admin->email = "admin@132.com";
        $admin->save();
        dd(12313);
    }
}
