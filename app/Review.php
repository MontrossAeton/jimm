<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'gym_id', 'rating', 'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function gym()
    {
        return $this->belongsTo('App\Gym')->withTrashed();
    }
}
