<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    
    public $timestamps=false; 

    public function films() {
        return $this->belongsToMany('App\Film','film_actors')->using('App\FilmActor');
    }
}
