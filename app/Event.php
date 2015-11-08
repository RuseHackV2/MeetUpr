<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    public function users() {
        return $this->hasMany('App\User');
    }

    public function boardgame() {
        return $this->belongsTo('App\Boardgame');
    }
}
