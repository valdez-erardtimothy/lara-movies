<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Actor extends Model implements HasMedia
{
    //
    use InteractsWithMedia;
    public $timestamps=false; 
    use SoftDeletes;
    
    public function film() {
        return $this->belongsToMany('App\Film','film_actors')->using('App\FilmActor')->withPivot('character', 'role_id');
    }
}
