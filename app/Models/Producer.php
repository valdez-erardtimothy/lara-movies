<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    //
    public $timestamps = false;

    public function film() {
        return $this->belongsToMany('App\Models\Film', 'film_producers');
    }
}
