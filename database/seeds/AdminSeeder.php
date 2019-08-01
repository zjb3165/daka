<?php

use Illuminate\Database\Seeder;
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
        /*$admin = new Admin();
        $admin->username = 'root';
        $admin->password = bcrypt('jumper@daka');
        $admin->name = '系统管理员';
        $admin->permissions = [];
        $admin->save();*/
        $admin = Admin::find(1);
        if ($admin) {
            $admin->password = bcrypt('123456');
            $admin->save();
        }
    }
}
