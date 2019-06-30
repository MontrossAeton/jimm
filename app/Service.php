<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'description', 'gym_id', 'rate', 'status', 'image',
    ];

    public function gym() {
        return $this->belongsTo('App\Gym')->withTrashed();
    }
}
