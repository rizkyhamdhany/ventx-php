<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank = new Bank();
        $bank->name = "BCA";
        $bank->account_name = "Adzka Fairuz";
        $bank->account_number = "";
        $bank->save();
        $bank = new Bank();
        $bank->name = "Mandiri";
        $bank->account_name = "Arina Sani";
        $bank->account_number = "";
        $bank->save();
        $bank = new Bank();
        $bank->name = "BNI";
        $bank->account_name = "Adzka Fairuz";
        $bank->account_number = "";
        $bank->save();
    }
}
