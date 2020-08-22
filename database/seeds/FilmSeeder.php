<?php

use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // declarations
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Character($faker));

        $genre_count = \App\Genre::count();
        $actors_count= \App\Actor::count();
        $producers_count = \App\Producer::count();
        $roles_count = \App\ActorRole::count();

        for($i = 0 ; $i < 100; $i++) {
            $runtime_arr = explode(':', $faker->runtime);
            $runtime_min = $runtime_arr[0]*60;
            $runtime_min += $runtime_arr[1];

            // create the film entry 
            $film = \App\Film::create([
                'film_title' => $faker->movie,
                'story' => $faker->overview,
                'release_date' => $faker->date(),
                'duration' => $runtime_min,
                'additional_info' => $faker->sentence(),
            ]);

            // genre
            $film->genre()->associate(\App\Genre::find($faker->randomDigit%$genre_count+1));
            // insert max of 10 producers
            $producer_insert_ids = [];
            foreach(range(1,10) as $index) {
                $producer_insert_ids[] = $faker->numberBetween(1, $producers_count);
            }
            $producer_insert_ids = array_unique($producer_insert_ids);
            foreach($producer_insert_ids as $id) {
                $film->producer()->attach($id);
            }

            // insert max of 20 characters
            
            $actor_insert_ids = [];
            foreach(range(1,20) as $index) {
                $actor_insert_ids[] = $faker->numberBetween(1, $actors_count);
            }
            $actor_insert_ids = array_unique($actor_insert_ids);
            foreach($actor_insert_ids as $id) {
                $film->actor()->attach($id, 
                ['character' => $faker->character,
                 'role_id' => $faker->randomDigit%$roles_count+1
                ]);
            }
            
            $film->save();
            
        }
    }
}
