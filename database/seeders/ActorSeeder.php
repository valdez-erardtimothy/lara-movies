<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorSeeder extends Seeder
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
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));
        for($i = 0; $i<50; $i++) {
            Actor::create([
                'actor_fullname' => $faker->actor,
                'actor_notes' => $faker->sentence()
            ]);
        }
    }
}
