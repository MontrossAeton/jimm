<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'status', 'type', 'remarks', 'date_added', 'date_expired', 'price'
    ];

    protected $dates = [
        'date_added', 'date_expired'
    ];

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
}
