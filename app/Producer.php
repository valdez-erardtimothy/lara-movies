<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    //
    public $timestamps = false;

    public function film() {
        return $this->belongsToMany('App\Film', 'film_producer');
    }
}
