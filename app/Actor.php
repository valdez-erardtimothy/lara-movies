<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    
    public $timestamps=false; 

    public function film() {
        return $this->belongsToMany('App\Film','film_actors')->using('App\FilmActor')->withPivot('character', 'role_id');
    }
}
