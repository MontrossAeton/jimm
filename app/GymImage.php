<?php

namespace App;

use App\Gym;
use Illuminate\Database\Eloquent\Model;

class GymImage extends Model
{
    protected $fillable = [
        'gym_id', 'type', 'path',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class)->withTrashed();
    }
}
