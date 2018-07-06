<?php

use Illuminate\Database\Seeder;

class Films extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Film::class, 10)->create();
    }
}
