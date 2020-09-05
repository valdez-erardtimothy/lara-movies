<?php

use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        foreach (\App\Film::all() as $film) {
            foreach(\App\User::inRandomOrder()->limit(10)->get() as $user) {
                $film->user()->syncWithoutDetaching([$user->id => [
                    'rating' => $faker->numberBetween($min = 1, $max = 5),
                    'comment' => $faker->sentence()
                    ]
                ]);
            }
        }
    }
}
