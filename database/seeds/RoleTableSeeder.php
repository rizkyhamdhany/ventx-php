<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'superadmin';
        $role_employee->description = 'Nalar TMS Admin';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'sm-operator';
        $role_manager->description = 'Festival Budaya Operator';
        $role_manager->save();
    }
}
