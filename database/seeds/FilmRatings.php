<?php

use Illuminate\Database\Seeder;

class FilmRatings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\FilmRating::class, 40)->create();
    }
}
