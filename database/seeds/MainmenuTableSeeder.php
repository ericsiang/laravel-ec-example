<?php

use Illuminate\Database\Seeder;

class MainmenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Mainmenu::class,5)->create();
    }
}
