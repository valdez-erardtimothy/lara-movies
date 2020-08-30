<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FilmActor extends Pivot
{
    //

    protected $table = 'film_actors';

    public function actorRole() {
        return $this->belongsTo('App\ActorRole');
    }

    public function film() {
        return $this->belongsTo(\App\Film::class);
    }
    
    public function actor() {
        return $this->belongsTo(\App\Actor::class);
    }
    
}
