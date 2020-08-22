<?php

use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        
        for($i = 0 ; $i < 10; $i++) {
            \App\Genre::create(['genre' => $faker->movieGenre]);
        }
    }
}
