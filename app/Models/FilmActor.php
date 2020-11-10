<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FilmActor extends Pivot
{
    //

    protected $table = 'film_actors';

    public function actorRole() {
        return $this->belongsTo('App\Models\ActorRole');
    }

    public function film() {
        return $this->belongsTo(\App\Models\Film::class);
    }
    
    public function actor() {
        return $this->belongsTo(\App\Models\Actor::class);
    }
    
}
