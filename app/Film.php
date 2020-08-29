<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    // for mass assignment
    protected $fillable = ['film_title', 'story', 'release_date', 'duration', 'additional_info', 'genre_id'];
    public $timestamps = false;
    public function producer() {
        return $this->belongsToMany('App\Producer', 'film_producers');
    }

    public function actor() {
        return $this->belongsToMany('\App\Actor','film_actors')->withPivot('character', 'role_id')->using('App\FilmActor');
    }

    public function genre() {
        return $this->belongsTo('App\Genre');
    }
}
