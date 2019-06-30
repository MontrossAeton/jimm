<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'gym_id', 'status', 'remarks', 'confirmed_at', 'reserved_at'
    ];

    protected $dates = [
        'reserved_at', 'confirmed_at'
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
