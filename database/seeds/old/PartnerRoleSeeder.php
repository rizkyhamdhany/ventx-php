<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class PartnerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'partner';
        $role_employee->description = 'Gotix';
        $role_employee->save();

        $employee = new User();
        $employee->name = 'Admin Gotix';
        $employee->email = 'admin@gotix.com';
        $employee->password = bcrypt('admingotix132');
        $employee->save();
        $employee->roles()->attach($role_employee);
    }
}
