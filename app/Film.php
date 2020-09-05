<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Film extends Model implements HasMedia
{
    use InteractsWithMedia;
    // for mass assignment
    protected $fillable = ['film_title', 'story', 'release_date', 'duration', 'additional_info', 'genre_id'];

    public $timestamps = false;
    use SoftDeletes;
    public function producer() {
        return $this->belongsToMany('App\Producer', 'film_producers');
    }

    public function actor() {
        return $this->belongsToMany('\App\Actor','film_actors')->withPivot('character', 'role_id')->using('App\FilmActor');
    }

    public function genre() {
        return $this->belongsTo('App\Genre');
    }

    public function user() {
        return $this->belongsToMany('\App\user','film_ratings')->withPivot('rating', 'comment');
    }
}
