<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //arina, saraswati, faza, karina, aldirra, palupi, bya
    public function run()
    {
        $role_employee = Role::where('name', 'superadmin')->first();
        $role_manager  = Role::where('name', 'ftb-operator')->first();
        $employee = new User();
        $employee->name = 'Admin Nalar';
        $employee->email = 'rizky@nalar.com';
        $employee->password = bcrypt('nalartms132');
        $employee->save();
        $employee->roles()->attach($role_employee);
        $manager = new User();
        $manager->name = 'Arina';
        $manager->email = 'arina@festivalbudaya.org';
        $manager->password = bcrypt('festivalbudaya132');
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}
