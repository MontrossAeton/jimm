<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'user_id', 'title', 'height', 'width', 'size', 'url', 'description', 'status', 'attachment', 'duration', 'price', 'expiration_date'
    ];

    protected $dates = [
        'expiration_date'
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
