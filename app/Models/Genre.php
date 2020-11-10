<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    public $timestamps=false;

    public function film() { 
        return $this->hasMany('App\Models\Film');
    }
}
