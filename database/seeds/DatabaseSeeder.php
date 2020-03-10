<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(AccountTableSeeder::class);
        $this->call(MainmenuTableSeeder::class);
        $this->call(SubmenuTableSeeder::class);
        $this->call(AccountTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ProductMultipleImgSeeder::class);
    }
}
