<?php

use App\UserAccount;
use Illuminate\Database\Seeder;

class UserAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAccount::create([
            'email' => 'a@a.a',
            'password' => Hash::make('password'),
        ]);
    }
}
