<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FilmActor extends Pivot
{
    //

    protected $table = 'film_actors';

    public function actorRole() {
        $this->belongsTo('App\ActorRole');
    }
    
}
