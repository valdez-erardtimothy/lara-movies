<?php

namespace App\Models;

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
        return $this->belongsToMany('App\Models\Producer', 'film_producers');
    }

    public function actor() {
        return $this->belongsToMany('\App\Models\Actor','film_actors')->withPivot('character', 'role_id')->using('App\Models\FilmActor');
    }

    public function genre() {
        return $this->belongsTo('App\Models\Genre');
    }

    public function user() {
        return $this->belongsToMany('\App\Models\user','film_ratings')->withPivot('rating', 'comment');
    }
}
