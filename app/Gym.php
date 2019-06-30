<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gym extends Model
{
    use SoftDeletes;
    public function user() {
        return $this->hasOne('App\User')->withTrashed();
    }

    public function users() {
        return $this->hasMany('App\User')->withTrashed();
    }

    public function services() {
        return $this->hasMany('App\Service');
    }

    public function gym_images() {
        return $this->hasMany('App\GymImage');
    }

    public function reservations() {
        return $this->hasMany('App\Reservation');
    }

    public function owner() {
        return User::where('gym_id', $this->id)->first();
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }

    protected $fillable = [
        'name', 'branch', 'street', 'city',
        'logo', 'landline', 'mobile', 'website',
        'long', 'lat', 'status', 'operating_hours'
    ];
}
