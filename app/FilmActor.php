<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FilmActor extends Pivot
{
    //

    public function actorRole() {
        $this->belongsTo('\App\ActorRole');
    }
    
}
