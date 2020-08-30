<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActorRole extends Model
{
    //

    public $timestamps=false;

    public function filmActor() {
        $this->hasMany('App\FilmActor');
    }
}
