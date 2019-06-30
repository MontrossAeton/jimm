<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'title', 'description', 'user_id', 'attachment'
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
