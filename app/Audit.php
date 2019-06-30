<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'user_id', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function log($user, $description)
    {
        $this->user_id = $user->id;
        $this->description = $description;
        $this->save();
    }
}
