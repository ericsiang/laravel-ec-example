<?php

use Illuminate\Database\Seeder;

class SubmenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Submenu::class,5)->create();
    }
}
