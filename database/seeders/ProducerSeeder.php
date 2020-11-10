<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producer;

class ProducerSeeder extends Seeder
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
        foreach(range(0,100) as $index) {
            Producer::create([
                'producer_fullname' => $faker->studio,
                'email' => $faker->email,
                'website' => $faker->domainName 
            ]);
        }
    }
}
