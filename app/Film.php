<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    
    public $timestamps = false;
    public function producer() {
        return $this->belongsToMany('App\Producer', 'film_producers');
    }

    public function actor() {
        return $this->belongsToMany('\App\Actor','film_actors')->using('App\FilmActor');
    }

    public function genre() {
        return $this->belongsTo('App\Genre');
    }
}
