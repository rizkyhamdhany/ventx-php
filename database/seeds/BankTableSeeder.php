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
<<<<<<< HEAD
        $bank->account_number = "";
=======
        $bank->account_number = "130001502303";
>>>>>>> b057535a661bd2feba77ee9a3e242677c836e7bb
        $bank->save();
        $bank = new Bank();
        $bank->name = "BNI";
        $bank->account_name = "Adzka Fairuz";
        $bank->account_number = "";
        $bank->save();
    }
}
