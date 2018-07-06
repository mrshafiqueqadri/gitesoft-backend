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
        $this->call([
            UsersSeed::class,
        	Countries::class,
        	Genres::class,
        	Films::class,
            FilmComments::class,
            FilmRatings::class,
        ]);
    }
}
