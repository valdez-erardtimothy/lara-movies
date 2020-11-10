<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\User;

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
        $faker = \Faker\Factory::create();
        foreach (Film::all() as $film) {
            foreach(User::inRandomOrder()->limit(10)->get() as $user) {
                $film->user()->syncWithoutDetaching([$user->id => [
                    'rating' => $faker->numberBetween($min = 1, $max = 5),
                    'comment' => $faker->sentence()
                    ]
                ]);
            }
        }
    }
}
