<?php

use Illuminate\Database\Seeder;

class FilmComments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\FilmComment::class, 20)->create();
    }
}
