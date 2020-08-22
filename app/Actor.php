<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    
    public $timestamps=false; 

    public function films() {
        $this->belongsToMany('App\Film')->using('App\FilmActor');
    }
}
