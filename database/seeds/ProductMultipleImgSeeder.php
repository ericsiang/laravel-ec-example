<?php

use Illuminate\Database\Seeder;

class ProductMultipleImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ProductMultipleImg::class,50)->create();
    }
}
