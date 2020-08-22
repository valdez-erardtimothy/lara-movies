<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    
    public $timestamps = false;
    public function producer() {
        $this->belongsToMany('App\Producer');
    }

    public function actor() {
        $this->belongsToMany('\App\Actor')->using('App\FilmActor');
    }
}
