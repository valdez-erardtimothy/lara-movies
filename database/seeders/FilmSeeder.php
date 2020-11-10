<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Genre;
use APp\Models\Actor;
use App\Models\Producer;
use App\Models\ActorRole;




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

        $genre_count = Genre::count();
        // $actors_count= \App\Actor::count();
        // $producers_count = \App\Producer::count();
        // $roles_count = \App\ActorRole::count();

        for($i = 0 ; $i < 50; $i++) {
            $runtime_arr = explode(':', $faker->runtime);
            $runtime_min = $runtime_arr[0]*60;
            $runtime_min += $runtime_arr[1];

            // create the film entry 
            $film = Film::create([
                'film_title' => $faker->movie,
                'story' => $faker->overview,
                'release_date' => $faker->date(),
                'duration' => $runtime_min,
                'additional_info' => $faker->sentence(),
            ]);

            // genre
            $film->genre()->associate(Genre::find($faker->randomDigit%$genre_count+1));
            // insert 10 producers
            $film->producer()->sync(Producer::limit(10)->inRandomOrder()->get());

            // insert max of 10 character
            foreach(Actor::inRandomOrder()->limit(10)->get() as $actor) {
                $film->actor()->attach($actor, [
                    'character' => $faker->character,
                    'role_id' => ActorRole::inRandomOrder()->first()->id
                ]);
            }
            
            $film->save();
            
        }
    }
}
