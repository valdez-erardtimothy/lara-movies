<?php

use Illuminate\Database\Seeder;
use App\Film;
use App\Actor;

class PosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // populate films with poster
        foreach(Film::all() as $film) {
            $film->clearMediaCollection();
            $film->addMediaFromUrl("https://placeimg.com/600/900/arch")->toMediaCollection();
        }

        foreach(Actor::all() as $actor) {
            $actor->clearMediaCollection();
            $actor->addMediaFromUrl("https://placeimg.com/600/600/people")->toMediaCollection();
        }
    }
}
