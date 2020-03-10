<?php

use App\Account;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Account::create([
            'account' => 'admin',
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);
        factory(\App\Account::class,1)->create();    
        //DB::table('accounts')->delete();
    }
}
