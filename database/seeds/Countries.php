<?php

use Illuminate\Database\Seeder;

class Countries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Country::class, 10)->create();
    }
}
