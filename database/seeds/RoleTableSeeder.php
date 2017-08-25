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
<<<<<<< HEAD
        $role_manager->name = 'ftb-operator';
        $role_manager->description = 'Festival Budaya Operator';
=======
        $role_manager->name = 'eo';
        $role_manager->description = 'Smilemotion Operator';
>>>>>>> 5c518e1320d0c2fed4e7760ee4e2e990b0136344
        $role_manager->save();
    }
}
